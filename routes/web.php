<?php

use App\Http\Controllers\CalonPesertaController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\HasilTesPpkController;
use App\Http\Controllers\PesertaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriSoalController;
use App\Http\Controllers\SoalPilihanGandaController;
use App\Http\Controllers\KategoriUjianController;
use App\Http\Controllers\KelasTesPpkController;
use App\Http\Controllers\KelasUjianController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MateriPokokController;
use App\Http\Controllers\PengawasUjianController;
use App\Http\Controllers\pesertaTesPpkController;
use App\Http\Controllers\PesertaTesPpkControlller;
use App\Http\Controllers\PesertaUjianController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SoalEssayController;
use App\Http\Controllers\SoalEssayNoEnkripsiController;
use App\Http\Controllers\SoalKonvensionalController;
use App\Http\Controllers\SoalModelSkalaController;
use App\Http\Controllers\SoalPilihanBergandaNoEnkripsiController;
use App\Http\Controllers\SoalPilihanBergandaPpkController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\UjianTesPpkController;
use App\Models\soalPilihanBergandaNoEnkripsi;
use App\Http\Controllers\SoalPilihanBergandaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KelasNonCATController;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Gd\Commands\RotateCommand;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('index');
});


Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::prefix('/calon/peserta/')->middleware(['auth','statusAdminCat'])->group(function () {
    # Route Calon Peserta
    Route::get('/',[CalonPesertaController::class,'index'])->name('calon.Peserta.Index');
    Route::get('/get-json',[CalonPesertaController::class,'getJson'])->name('calon.Peserta.Index.Get.Json');

    Route::get('/edit/{idCalonPeserta}',[CalonPesertaController::class,'edit'])->name('calon.Peserta.Edit');
    Route::post('/update',[CalonPesertaController::class,'update'])->name('calon.Peserta.Update');

    Route::get('/create', [CalonPesertaController::class, 'create'])->name('calon.Peserta.Create');
    Route::post('/store', [CalonPesertaController::class, 'store'])->name('calon.Peserta.Store');

    Route::post('/import',[CalonPesertaController::class,'importExcel'])->name('calon.Peserta.Import');

    Route::get('/hapus/sesi/{idCalonPeserta}',[CalonPesertaController::class,'hapusSesi'])->name('calon.Peserta.Hapus.Sesi');
    Route::delete('/hapus/{idCalonPeserta}', [CalonPesertaController::class, 'hapus'])->name('calon.Peserta.Hapus');
});


Route::prefix('/soal')->middleware(['auth','statusAdminCat'])->group(function () {
    # Route Soal Pilihan Berganda
    Route::get('/pilihan-ganda',[SoalPilihanBergandaController::class,'index'])->name('soal.Pilihan.Berganda.Index');
    Route::post('/import/pilihan-ganda',[SoalPilihanBergandaController::class,'importPilihanGanda'])->name('import.Pilihan.Berganda.Index');

});


Route::prefix('/kelas')->middleware(['auth','statusAdminCat'])->group(function () {
    # Route Kelas
    Route::get('/',[KelasController::class,'index'])->name('kelas.Index');
    Route::get('/create',[KelasController::class,'create'])->name('kelas.Create');
    Route::post('/store',[KelasController::class,'store'])->name('kelas.Store');

    Route::get('/destroy/{idKelas}',[KelasController::class,'destroy'])->name('kelas.Destroy');
});


Route::prefix('/peserta')->middleware(['auth','statusAdminCat'])->group(function () {

    # Route Peserta
    Route::get('/',[PesertaController::class,'index'])->name('peserta.Index');
    Route::get('/get-json',[PesertaController::class,'getJson'])->name('peserta.Index.Get.Json');
    Route::delete('/destroy/{idPeserta}',[PesertaController::class,'destroy'])->name('peserta.Destroy');

    Route::get('/create',[PesertaController::class,'create'])->name('peserta.Create');
    Route::post('/store',[PesertaController::class,'store'])->name('peserta.Store');
});


Route::prefix('/ujian')->middleware('auth')->group(function () {

    # Route ujian
    Route::post('/get-data',[UjianController::class,'getData'])->name('get.Data.Ujian');
    Route::get('/',[UjianController::class,'ujian'])->name('Ujian.Index');

    # Route AJAX ujian dengan soal pilihan ganda
    Route::get('/tampil-soal/{indexSoal}',[UjianController::class,'tampilSoal'])->name('ujian.Tampil.Soal');
    Route::get('/simpan-jawaban',[UjianController::class,'simpanJawaban'])->name('ujian.Simpan.Jawaban');

    # Route AJAX ambil durasi /sisa waktu ujian
    Route::get('/sisa-waktu/{idPeserta}/{sisaWaktu}',[UjianController::class,'sisaWaktu'])->name('sisa.Waktu');

    # Route ketika peserta klik button selesai dan ketika durasi
    Route::get('/selesai/submit',[UjianController::class,'selesaiSubmit'])->name('ujian.Selesai.Submit');

});

Route::prefix('/hasil')->middleware(['auth','statusAdminCat'])->group(function () {

    # Route hasil
    Route::get('/',[HasilController::class,'index'])->name('hasil.Index');
});


Route::prefix('/reset')->middleware(['auth','statusAdminCat'])->group(function () {

    # Route reset dashboard
    Route::get('/dashboard',[ResetController::class,'resetDashboard'])->name('reset.Dashboard');

    # Route reset password
    Route::get('/password',[ResetController::class,'upatePassword'])->name('update.Password');
    Route::post('/password',[ResetController::class,'updateStorePassword'])->name('update.Store.Password');
});


use App\Models\SoalPilihanBerganda;
use Illuminate\Http\Request;
Route::get('/kuncijawaban', function () {
    $soal = SoalPilihanBerganda::all();
    return view('welcome', ["soals" => $soal]);
});

Route::get('/change_crypt', function () {
    return view('welcome', ["change_crypt" => true]);
});

Route::get('/get_encrypt', function (Request $req) {
    return Crypt::encrypt($req->input);
})->name('get_encrypt');

Route::get('/get_decrypt', function (Request $req) {
    return Crypt::decrypt($req->input);
})->name('get_decrypt');

Route::get('/get_key', function (Request $req) {
    return env("APP_KEY");
});