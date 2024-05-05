<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Peserta;
use App\Models\Ujian;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PesertaController extends Controller {
        public function index (Request $request) {

        $title = "";
        $text = "Hapus data peserta?";
        confirmDelete($title, $text);
        return view('admin.peserta.index');
    }

    public function getJson() {

        $peserta = Peserta::leftJoin('users', 'pesertas.id_user', '=', 'users.id')
                    ->leftJoin('kelas', 'pesertas.id_kelas', '=', 'kelas.id')
                    ->leftJoin('ujians', 'pesertas.id', '=', 'ujians.id_peserta')
                    ->select('pesertas.id as id_peserta', 'users.id as id_user', 'users.name as nama', 'users.no_pendaftaran', 'users.wilayah', 'kelas.nama_kelas', 'ujians.id as id_ujian', 'ujians.status as status_ujian')
                    ->where('users.tipe', '!=', 'admin')
                    ->get();
        return DataTables::of($peserta)
        ->addIndexColumn()
        ->make(true);

    }

    public function destroy($idPeserta) {

        try {
            $ujian = Ujian::where('id_peserta', $idPeserta)->first();

            if (is_null($ujian)) {
                $peserta = Peserta::find($idPeserta);

                if (!is_null($peserta)) {

                    $calonPeserta = User::where('id',$peserta->id_user)->first();
                    $calonPeserta->status = 1;
                    $calonPeserta->save();

                    $peserta->delete();

                    Alert::toast('Data peserta berhasil dihapus', 'success')->autoClose(5000)->timerProgressBar();
                } else {
                    throw new \Exception('Data peserta tidak ditemukan');
                }
            } else {
                throw new \Exception('Peserta tidak dapat dihapus! Peserta telah terdaftar mengikuti ujian');
            }
        } catch (\Exception $e) {
            Alert::toast($e->getMessage(), 'error')->autoClose(5000)->timerProgressBar();
        }
        return redirect()->route('peserta.Index');
    }

    public function create() {
        try {
            $user = User::where('status', 1)->orderBy('name', 'ASC')->where('users.tipe', '!=', 'admin')->paginate(100);
            $kelas = Kelas::orderBy('nama_kelas', 'ASC')->get();

            if ($user->count() == 0 || $kelas->count() == 0) {
                throw new \Exception("Gagal mendapatkan data! Semua calon peserta telah memiliki kelas");
            }

            return view('admin.peserta.create', [
                'user' => $user,
                'kelas' => $kelas
            ]);
        } catch (\Exception $e) {
            Alert::toast($e->getMessage(), 'error')->autoClose(5000)->timerProgressBar();
            return redirect()->route('peserta.Index');
        }
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'kelas' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->has('item')) {
            try {
                DB::beginTransaction();

                $kelas = Kelas::find($request->kelas);

                foreach ($request->item as $item) {
                    $peserta = new Peserta();
                    $peserta->id_kelas = $request->kelas;
                    $peserta->id_user = $item;
                    $peserta->status = 1;
                    $peserta->sisa_waktu = $kelas->waktu_pengerjaan * 60 ;
                    $peserta->save();

                    $calonPeserta = User::find($item);
                    $calonPeserta->status = 0;
                    $calonPeserta->save();
                }

                DB::commit();
                Alert::toast('Peserta berhasil ditambahkan', 'success')->autoClose(5000)->timerProgressBar();
            } catch (\Exception $e) {
                DB::rollback();
                Alert::toast('Gagal menambahkan peserta', 'error')->autoClose(5000)->timerProgressBar();
                return redirect()->back()->withErrors($validator)->withInput();
            }
        } else {
            Alert::toast('Tidak ada data yang dipilih', 'error')->autoClose(5000)->timerProgressBar();
        }

        return redirect()->route('peserta.Index');
    }



}
