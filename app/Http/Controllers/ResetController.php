<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ResetController extends Controller {

    public function resetDashboard() {

        DB::table('hasils')->truncate();
        DB::table('soal_pilihan_bergandas')->truncate();
        DB::table('soal_pilihan_berganda_no_enkripsis')->truncate();
        DB::table('soal_essays')->truncate();
        DB::table('soal_essay_no_enkripsis')->truncate();
        DB::table('ujians')->truncate();
        DB::table('kelas')->truncate();
        DB::table('kelas_non_c_a_t_s')->truncate();
        DB::table('pesertas')->truncate();
        DB::table('sessions')->truncate();
        DB::table('users')->where('tipe','!=','admin')->delete();
        return redirect()->route('home');
    }

    public function upatePassword() {

        return view('admin.resetPassword.index');
    }

    public function updateStorePassword(Request $request) {

        $validator = Validator::make($request->all(), [
                    'oldpassword'           => 'required',
                    'password'              => 'required|different:oldpassword|confirmed|min:8',
                    'password_confirmation' => 'required'
                                ],
                    [
                    'oldpassword.required'  =>  "Password lama tidak boleh kosong",
                    'password.required'  =>  "Kolom Password baru tidak boleh kosong",
                    'password.confirmed' =>  "Kolom Konfirmasi password tidak sesuai",
                    'password.min'       =>  "Gunakan minimal 8 karakter untuk Password",
                    'password.different' =>  "Password Baru harus berbeda dengan password lama",
                    'password_confirmation.required' => 'Kolom Konfirmasi Password tidak boleh kosong'
                    ]
        );

        # Validasi
        if ($validator->fails()) {
            return redirect()->route('update.Password')->withErrors($validator)->withInput();
        } else {
            # Cek apakah hasil hashing old password dengan new password sama
            # Jika sama return , ganti password gagal
            if (!Hash::check($request->oldpassword,$request->user()->password)) {
                Alert::toast('Password lama tidak sesuai','error')->autoClose(5000)->timerProgressBar();
                return redirect()->route('update.Password')->withInput();
            } else {
                $admin = User::find(auth()->user()->id);
                $admin->password = Hash::make($request->password);
                $admin->save();
                Auth::logout();
                Alert::toast('Ubah Kata Sandi Berhasil','success');
                return redirect()->route('login');
            }
        }
    }

}
