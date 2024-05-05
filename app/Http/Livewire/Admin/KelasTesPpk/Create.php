<?php

namespace App\Http\Livewire\Admin\KelasTesPpk;

use App\Models\kelasTesPpk;
use App\Models\materiPokok;
use App\Models\soalPilihanBergandaPpk;
use App\Models\standarKomptensi;
use Livewire\Component;
use Maatwebsite\Excel\Concerns\ToArray;
use Prophecy\Call\Call;

class Create extends Component {

    public  $jumlahSoalGanda = null,
            $jumlahSoalEssay,
            $soalBerdasarkanMateriPokok,
            $collection,
            $materiPokok =[],

            $wrNamaKelas,
            $wRWaktuPengerjaan,
            // $wrAmbangBatas,
            $wRJam,
            $wRTanggal,

            $wRiDStandarKomptensi,
            $wRMateriPokok,

            $wROpsiPertama=array(),
            $wROpsiKedua=array(),
            $wROpsiKetiga=array(),

            $alert,
            $data
    ;

    public function updatedjumlahSoalGanda() {

        if (empty($this->jumlahSoalGanda) || ($this->jumlahSoalGanda == 0)) {
            $this->jumlahSoalGanda = null;
        }

        $soalPilihanGanda = soalPilihanBergandaPpk::query()
        /* ->join('standar_komptensis AS sk', 'sk.id', 'id_standar_kompetensi')
        ->join('materi_pokoks AS mpk', 'id_materi_pokok' , 'mpk.id') */
        // ->whereDoesntHave('materi')
        ->get();

        if (!is_null($soalPilihanGanda)) {
            $this->collection = collect(soalPilihanBergandaPpk::where('status',1)->get());
            $idStandarKompetensi = $this->collection->pluck('id_materi_pokok')->unique();
            $idArray = json_decode($idStandarKompetensi,true);
            foreach ($idArray as $key => $item) {
                    $id[$key] = $item;
            }
        } else {
            return abort(404);
        }

        $materiPokok = materiPokok::all();
        if (!is_null($materiPokok)) {
            $this->soalBerdasarkanMateriPokok= materiPokok::whereIn('id', $id)->get();
        }else {
            return abort(404);
        }

        foreach ($this->soalBerdasarkanMateriPokok as $i => $soal) {
            $this->wROpsiPertama[$soal->id] = 0;
            $this->wROpsiKedua[$soal->id] = 0;
            $this->wROpsiKetiga[$soal->id] = 0;
        }
    }


    public function store() {

        $validatedDate = $this->validate([
            'wrNamaKelas' => 'required | unique:kelas_tes_ppks,nama_kelas',
            'wRWaktuPengerjaan' => 'required',
            'jumlahSoalGanda' => 'required',
            'wRTanggal' => 'required',
            // 'wRJam' => 'required',
            // 'wrAmbangBatas' => 'required',
        ],
        [
            'wrNamaKelas.required' => 'Nama Gelombang Tes Tidak Boleh Kosong',
            'wrNamaKelas.unique' => 'Nama Kelas Tes Sudah Tersedia, Silakan Menggunakan Nama Yang Lain',
            'wRWaktuPengerjaan.required' => 'Waktu Pengerjaan Tidak Boleh Kosong',
            'jumlahSoalGanda.required' => 'Jumlah Soal Ganda Tidak Boleh Kosong',
            'wRTanggal.required' => 'Tanggal Tidak Boleh Kosong',
            // 'wRJam.required' => 'Jam Tidak Boleh Kosong',
            // 'wrAmbangBatas.required' => 'Ambang Batas Tidak Boleh Kosong',

        ]
    );

    // dd($validatedDate);

    if(is_null($this->wROpsiPertama) && is_null($this->wROpsiKedua) && is_null($this->wROpsiKetiga)){
        $this->alert = 'danger';
        session()->flash('message', 'Komposisi Soal Harus Diisi');
        return back();
    }

    if (!is_null($this->wROpsiPertama)) {
        foreach ($this->wROpsiPertama as $key => $item) {
            // dd($item);
            // $x = collect($key);
            // foreach ($x as $y) {
                $mp = materiPokok::find($key);
                $idKomptensi = $mp->id_standar_kompetensi;
                // $idMateri = json_decode($y,true)['id'];
                $getKompetensi = standarKomptensi::find($idKomptensi);
                // $getMateri = materiPokok::find($idMateri);

                $jumlahPilihanBergandaMudah = soalPilihanBergandaPpk::where('id_standar_kompetensi',$idKomptensi)
                                            ->where('id_materi_pokok',$key)
                                            ->where('kriteria',1)
                                            ->get();

                if (count($jumlahPilihanBergandaMudah) >= intval($item)  ) {
                    $mudah = $item;
                } else {
                    $mudah = 0;
                }
            // }

            $data[] = array(
                'id_standar_kompetensi' => $idKomptensi,
                'nama_standar_kompetensi' => $getKompetensi->nama,
                'id_materi_pokok' => $key,
                'nama_materi_pokok' => $mp->nama,
                'kriteria' => 1,
                'jumlah_kriteria_mudah' => $mudah != '0' ? $mudah : 0,
                'jumlah_kriteria_sedang' => null,
                'jumlah_kriteria_sulit' => null
            );
        }

    }


    if (!is_null($this->wROpsiKedua)) {
        foreach ($this->wROpsiKedua as $key => $item) {
            // $x = collect($key);
            // dd($item);
            // foreach ($item as $y) {
                // $idKomptensi = json_decode($y,true)['id_standar_kompetensi'];
                // $idMateri = json_decode($y,true)['id'];
                $mp = materiPokok::find($key);
                $idKomptensi = $mp->id_standar_kompetensi;
                $getKompetensi = standarKomptensi::find($idKomptensi);
                // $getMateri = materiPokok::find($idMateri);

                $jumlahPilihanBergandaSedang = soalPilihanBergandaPpk::where('id_standar_kompetensi',$idKomptensi)
                                                ->where('id_materi_pokok',$key)
                                                ->where('kriteria',2)
                                                ->get();

                if (count($jumlahPilihanBergandaSedang) >= intval($item)  ) {
                    $sedang = $item;
                } else {
                    $sedang = 0;
                }
                $data[] = array(
                            'id_standar_kompetensi' => $idKomptensi,
                            'nama_standar_kompetensi' => $getKompetensi->nama,
                            // 'id_materi_pokok' => $idMateri,
                            'id_materi_pokok' => $key,
                            // 'nama_materi_pokok' => $getMateri->nama,
                            'nama_materi_pokok' => $mp->nama,
                            'kriteria' => 2,
                            'jumlah_kriteria_mudah' => null,
                            'jumlah_kriteria_sedang' => $sedang != '0' ? $sedang : 0,
                            'jumlah_kriteria_sulit' => null,
                        );
            // }
        }
    }


    if (!is_null($this->wROpsiKetiga)) {
        foreach ($this->wROpsiKetiga as $key => $item) {
            // $x = collect($key);
            // foreach ($x as $y) {
                // $idKomptensi = json_decode($y,true)['id_standar_kompetensi'];
                // $idMateri = json_decode($y,true)['id'];
                $mp = materiPokok::find($key);
                $idKomptensi = $mp->id_standar_kompetensi;
                // $getMateri = materiPokok::find($idMateri);
                $getKompetensi = standarKomptensi::find($idKomptensi);

                $PilihanBergandaSulit= soalPilihanBergandaPpk::where('id_standar_kompetensi',$idKomptensi)
                                        ->where('id_materi_pokok',$key)
                                        ->where('kriteria',3)
                                        ->get();

                    if (count($PilihanBergandaSulit) >= intval($item)  ) {
                        $sulit = $item;
                    } else {
                        $sulit = 0;
                    }

                    $data[] = array(
                        'id_standar_kompetensi' => $idKomptensi,
                        'nama_standar_kompetensi' => $getKompetensi->nama,
                        'id_materi_pokok' => $key,
                        'nama_materi_pokok' => $mp->nama,
                        'kriteria' => 3,
                        'jumlah_kriteria_mudah' => null,
                        'jumlah_kriteria_sedang' => null,
                        'jumlah_kriteria_sulit' => $sulit != '0' ? $sulit : 0,
                    );
            // }
        }
    }
    // dd($data);
    $total = 0;
    foreach ($data as $dt) {
        $jumlah = intval($dt['jumlah_kriteria_mudah']) + intval($dt['jumlah_kriteria_sedang']) + intval($dt['jumlah_kriteria_sulit']);
        $total = $total + $jumlah;
    }

    if ( $total == intval($this->jumlahSoalGanda)) {
        $jsonFile = json_encode($data,JSON_PRETTY_PRINT);
        kelasTesPpk::create([
                'nama_kelas' => $this->wrNamaKelas,
                'waktu_pengerjaan' => $this->wRWaktuPengerjaan,
                'jml_pil_ganda' => $this->jumlahSoalGanda,
                'jml_essay' => $this->jumlahSoalEssay,
                'tanggal' => $this->wRTanggal,
                'status' => 1,
                'json_komposisi_soal_ganda' =>  $jsonFile
            ]);
        $this->alert = 'success';
        session()->flash('message', 'Data berhasil ditambahkan. Silahkan tambah kelas tanpa melakukan refresh halaman');
    }
    else {
        $this->alert = 'danger';

        session()->flash('message', 'Jumlah Permintaan Data dengan Komposisi Tidak Sesuai '.$this->jumlahSoalGanda.' total. = '.$total);
    }
    }


    public function render() {
        return view('livewire.admin.kelas-tes-ppk.create');
    }
}
