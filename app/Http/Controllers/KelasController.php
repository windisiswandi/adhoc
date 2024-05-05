<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Peserta;
use App\Models\soalEssay;
use App\Models\SoalPilihanBerganda;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class KelasController extends Controller {

    public function index() {

        $kelas = Kelas::orderBy('nama_kelas', 'asc')->paginate(20);
        return view('admin.kelas.index',[
            'kelas' => $kelas
        ]);
    }


    public function create() {

        return view('admin.kelas.create');
    }


    public function edit($idKelas) {


    }

    public function destroy($idKelas) {
        try {
            $kelas = Kelas::find($idKelas);
            if (!$kelas) {
                throw new \Exception('Kelas tidak ditemukan');
            }

            $peserta = Peserta::where('id_kelas', $kelas->id)->first();
            if ($peserta) {
                throw new \Exception('Kelas tidak dapat dihapus! Kelas telah digunakan');
            }

            $kelas->delete();
            Alert::toast('Kelas berhasil dihapus', 'success')->autoClose(5000)->timerProgressBar();
        } catch (\Exception $e) {
            Alert::toast($e->getMessage(), 'error')->autoClose(5000)->timerProgressBar();
        }
        return redirect()->route('kelas.Index');
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas',
            'jumlah_pilihan_ganda' => 'required|numeric|min:0',
            'waktu_pengerjaan' => 'required|numeric|min:1',
            'tanggal' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jumlahBankSoalPilihanBerganda = SoalPilihanBerganda::count();
        $jumlahBankSoalEssay = soalEssay::count();

        try {
            # Kroscek jumlah soal pilihan ganda
            if ($request->jumlah_pilihan_ganda > 0) {
                if ($jumlahBankSoalPilihanBerganda === 0) {
                    throw new \Exception('Bank Soal Pilihan Ganda Tidak Ada');
                } elseif ($jumlahBankSoalPilihanBerganda < $request->jumlah_pilihan_ganda) {
                    throw new \Exception('Jumlah Soal Pilihan Ganda Melebihi Bank Soal Pilihan Ganda');
                }
            }

            # Kroscek jumlah soal essay
            if ($request->jumlah_essay > 0) {
                if ($jumlahBankSoalEssay === 0) {
                    throw new \Exception('Bank Soal Essay tidak ada');
                } elseif ($jumlahBankSoalEssay < $request->jumlah_essay) {
                    throw new \Exception('Jumlah Soal Essay Melebihi Bank Soal Essay');
                }
            }

            if ($request->waktu_pengerjaan < 1) {
                throw new \Exception('Durasi waktu pengerjaan minimal 1 menit');
            }
            # Jika semua kondisi telah terpenuhi
            if ((intval($request->jumlah_essay) <= $jumlahBankSoalEssay) && (intval($request->jumlah_pilihan_ganda) <= $jumlahBankSoalPilihanBerganda)) {
                $kelas = new Kelas;
                $kelas->nama_kelas = $request->nama_kelas;
                $kelas->waktu_pengerjaan = $request->waktu_pengerjaan;
                $kelas->jml_pil_ganda = $request->jumlah_pilihan_ganda;
                $kelas->jml_essay = 0;
                $kelas->tanggal = $request->tanggal;
                $kelas->status = 1;
                $kelas->save();
                Alert::toast('Kelas berhasil ditambahkan','success')->autoClose(5000)->timerProgressBar();
                return redirect()->route('kelas.Index');
            }
        } catch (\Exception $e) {
            Alert::toast($e->getMessage(),'error')->autoClose(5000)->timerProgressBar();
            return redirect()->back()->withInput();
        }
    }


}
