<?php

namespace App\Http\Controllers;

use App\Models\CalonPeserta;
use App\Models\Peserta;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Imports\PpkImport;

class CalonPesertaController extends Controller {


    public function index (Request $request) {

        $title = "";
        $text = "Hapus data calon peserta?";
        confirmDelete($title, $text);
        return view('admin.calonPeserta.index');
    }

    public function getJson() {

        $user = User::leftJoin('pesertas', 'users.id', '=', 'pesertas.id_user')
                ->select('users.id', 'users.name', 'users.no_pendaftaran','users.wilayah','pesertas.id AS id_peserta', 'pesertas.status')
                ->where('users.tipe', '!=', 'admin')
                ->orderByDesc('users.updated_at')
                ->get();

        return DataTables::of($user)
        ->addIndexColumn()
        ->make(true);

    }

    public function create() {

        return view('admin.calonPeserta.create');
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'no_pendaftaran' => 'required|string|max:255|unique:users,no_pendaftaran',
            'wilayah' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        try {
            $calonPeserta = new User;
            $calonPeserta->name = $request->name;
            $calonPeserta->tipe = 'peserta';
            $calonPeserta->status = 1;
            $calonPeserta->no_pendaftaran = $request->no_pendaftaran;
            $calonPeserta->wilayah = $request->wilayah;
            $calonPeserta->password = Hash::make(12345678);
            $calonPeserta->save();

            Alert::toast('Calon Peserta berhasil ditambahkan','success')->autoClose(5000)->timerProgressBar();
            return redirect()->route('calon.Peserta.Index');
        } catch (\Exception $e) {
            // Handle any exceptions here
            Alert::toast('Terjadi kesalahan: ' . $e->getMessage(), 'error')->autoClose(5000)->timerProgressBar();
            return redirect()->back();
        }
    }

    public function edit($idCalonPeserta) {

        $calonPeserta = User::find($idCalonPeserta);

        return view('admin.calonPeserta.edit',[
            'calonPeserta' => $calonPeserta
        ]);
    }

    public function update(Request $request){
        try {
            $calonPeserta = User::findOrFail($request->id_calon_peserta);
            $calonPeserta->name = $request->name;
            $calonPeserta->wilayah = $request->wilayah;
            $calonPeserta->save();
            Alert::toast('Calon Peserta berhasil diedit','success')->autoClose(5000)->timerProgressBar();
        } catch (ModelNotFoundException $e) {
            Alert::toast('Calon Peserta tidak ditemukan','error')->autoClose(5000)->timerProgressBar();
            return redirect()->route('calon.Peserta.Index');
        } catch (\Exception $e) {
            // Tangani kesalahan umum di sini
            Alert::toast('Terjadi kesalahan saat mengedit calon peserta','error')->autoClose(5000)->timerProgressBar();
        }
        return redirect()->route('calon.Peserta.Index');
    }



    public function hapus($idCalonPeserta) {
        try {
            # jika bukan admin
            if (auth()->user()->tipe !== 'admin') {
                throw new \Exception('Akses tidak tersedia');
            }

            $peserta = Peserta::where('id_user', $idCalonPeserta)->first();
            # jika sudah menjadi peserta
            if ($peserta) {
                throw new \Exception('Calon sudah menjadi peserta');
            }

            $user = User::findOrFail($idCalonPeserta);
            $user->delete();

            Alert::toast('Calon Peserta berhasil dihapus','success')->autoClose(5000)->timerProgressBar();
            return redirect()->back();
        } catch (ModelNotFoundException $e) {
            Alert::toast('Calon peserta tidak ditemukan','warning')->autoClose(5000)->timerProgressBar();
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withWarning($e->getMessage());
        }
    }
    public function hapusSesi($idCalonPeserta) {


        if (auth()->user()->tipe !== 'admin') {
            return redirect()->back();
        }

        try {
            $deletedRows = DB::table('sessions')->where('user_id', $idCalonPeserta)->delete();

            if ($deletedRows > 0) {
                Alert::toast('Sesi aktif berhasil dihapus','success')->autoClose(5000)->timerProgressBar();
            } elseif ($deletedRows === 0) {
                Alert::toast('Tidak ada sesi aktif untuk dihapus','info')->autoClose(5000)->timerProgressBar();
            }
        } catch (\Exception $e) {
            // Tangani kesalahan umum di sini
            Alert::toast('Terjadi kesalahan saat menghapus sesi aktif','error')->autoClose(5000)->timerProgressBar();
        }

        return redirect()->back();
    }

    public function importExcel(Request $request) {

        $file = request()->file('file');

        $import = new PpkImport();
        $import->import($request->file('file'));

        if($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }
        return redirect()->route('calon.Peserta.Index')->with('success','Data Berhasil di Import');
    }
}
