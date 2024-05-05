<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\Kelas;
use App\Models\Peserta;
use App\Models\soalEssay;
use App\Models\SoalPilihanBerganda;
use App\Models\Ujian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UjianController extends Controller {

    public function getData(Request $request) {

        try {

            $peserta = Peserta::findOrFail($request->id_peserta);

            # cek apakah peserta juga terdaftar dalam tabel user dan status  == peserta
            # cek apakah auth()->user_id = $peserta->id_user
            # jika peserta ada, cek apakah statusnya = 1
            if (auth()->user()->id !== $peserta->id_user || $peserta->status !== 1) {
                return redirect()->back();
            }

            $ujian = Ujian::where('id_peserta', $request->id_peserta)->first();

            if (!$ujian) {
                $kelas = Kelas::findOrFail($peserta->id_kelas);

                $soalPilihanGanda = SoalPilihanBerganda::inRandomOrder()->select('id')->limit($kelas->jml_pil_ganda)->get();
                $arraySoalPilihanGanda = [];
                        foreach ($soalPilihanGanda as $item) {
                            $arraySoalPilihanGanda[] = array(
                                                    'id' => $item['id'],
                                                    'jawaban' => null,
                                                    'nilai_benar' => null ,
                                                    );
                        }
                        $dataSoalPilihanGanda = $arraySoalPilihanGanda;



                $soalEssay = SoalEssay::inRandomOrder()->limit($kelas->jml_essay)->get();
                $soalEssay = SoalEssay::inRandomOrder()->select('id')->limit($kelas->jml_essay)->get();

                $arraySoalEsssay = [];
                foreach ($soalEssay as $item){
                    $arraySoalEsssay[] = array(
                                        'id' => $item['id'],
                                        'jawaban' => null,
                                        );
                }
                $dataSoalEssay = $arraySoalEsssay;



                $ujian = new Ujian;
                $ujian->id_peserta = $request->id_peserta;
                $ujian->json_soal_pilihan_ganda = json_encode($dataSoalPilihanGanda,JSON_PRETTY_PRINT);
                $ujian->json_soal_essay = json_encode($dataSoalEssay,JSON_PRETTY_PRINT);
                $ujian->status = 1;
                $ujian->save();

                return view('peserta.infoAwal', [
                    'kelas' => $kelas,
                    'peserta' => $peserta,
                ]);
            } else {
                return redirect()->back();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function ujian() {

        try {
            $peserta = Peserta::where('id_user',auth()->user()->id)->first();
            $kelas = Kelas::where('id',$peserta->id_kelas)->first();

            return view('peserta.formUjian', [
                'idPeserta' => $peserta->id,
                'sisaWaktu' => $peserta->sisa_waktu,
                'indexSoal' => 0,
                'kelas' => $kelas
            ]);

        } catch (\Exception $e) {
            return redirect()->route('home');
        }
    }


    public function sisaWaktu($idPeserta,$durasi) {

        $peserta = Peserta::find($idPeserta);
        $sisaWaktu = $peserta->sisa_waktu;

        # jika durasi lebih besar dari 0
        if($durasi > 0) {
            # jika durasi lebih besari dari sisa waktu yang ada
            if ($durasi > $sisaWaktu) {
                $peserta->sisa_waktu = $sisaWaktu;
            }
            $peserta->sisa_waktu = $durasi;
            $peserta->save();
            return true;
        }

        if ($durasi < 0) {
            $this->selesaiSubmit();
        }
    }


    public function tampilSoal($indexSoal) {

        $peserta = Peserta::where('id_user',auth()->user()->id)->where('status',1)->first();

        if ($peserta) {

            $masterSoalPilihanGanda = [];

            $ujian = Ujian::where('id_peserta',$peserta->id)->first();
            $soalPilihanGandaPeserta = collect(json_decode($ujian->json_soal_pilihan_ganda, true));

            if($soalPilihanGandaPeserta->count()){
                $masterSoalPilihanGanda = SoalPilihanBerganda::where('id',$soalPilihanGandaPeserta[$indexSoal]['id'])
                                            ->select('id','soal','pil_a','pil_b','pil_c','pil_d')->first();
            }

            return view('peserta.tampilSoal',[
                'index' => $indexSoal,
                'idPeserta' => $peserta->id,
                'soalPilihanGanda' => $soalPilihanGandaPeserta,
                'masterSoalPilihanGanda' => $masterSoalPilihanGanda,

            ]);
        }
    }

    public function simpanJawaban(Request $request) {

        $ujian = Ujian::where('id_peserta',$request->idPeserta)->where('status',1)->first();

        if ($ujian) {

            $soalPilihanGandaPeserta = json_decode ($ujian->json_soal_pilihan_ganda,true);
            $masterSoalPilihanGanda = SoalPilihanBerganda::find($soalPilihanGandaPeserta[$request->index]['id']);

            $soalPilihanGandaPeserta[$request->index]['jawaban'] = $request->jawaban; // {"id":85,"nilai_benar":null,"jawaban":"D"}

            if ($request->jawaban == $masterSoalPilihanGanda->kunci) {
                $soalPilihanGandaPeserta[$request->index]['nilai_benar'] = $masterSoalPilihanGanda->nilai_benar;
            }

            $ujian->json_soal_pilihan_ganda = json_encode($soalPilihanGandaPeserta,JSON_PRETTY_PRINT);
            $ujian->save();
        }
    }

    public function selesaiSubmit() {

        # hitung nilai hasil pilihan ganda
        $peserta = Peserta::where('id_user',auth()->user()->id)->where('status',1)->first();

        if ($peserta) {

            $ujian = Ujian::where('id_peserta',$peserta->id)->where('status',1)->first();

            $pilihanGanda = collect(json_decode($ujian->json_soal_pilihan_ganda,true));

                $totalNilaiPilihanGanda = 0;
                foreach ($pilihanGanda as $item) {
                    $jumlah = intval($item['nilai_benar']) ;
                    $totalNilaiPilihanGanda = $totalNilaiPilihanGanda + $jumlah;
                }

            $ujian->status = 0;
            $ujian->save();

            $peserta->status = 0;
            $peserta->save();

            $hasil = new Hasil;
            $hasil->id_peserta = $peserta->id;
            $hasil->nilai_pilihan_ganda = Crypt::encrypt($totalNilaiPilihanGanda);
            $hasil->nilai_soal_essay = null;
            $hasil->total_nilai = null;
            $hasil->save();

            return view('peserta.infoAkhir',[
                'tampilHasil' => Hasil::where('id_peserta',$peserta->id)->first()
            ]);

        } else {
            return redirect()->route('home');
        }
    }
}
