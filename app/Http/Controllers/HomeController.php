<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Peserta;
use App\Models\Ujian;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\pesertaTesPpk;
use App\Models\ujianTesPpk;
use App\Models\kelasTesPpk;

class HomeController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        if (auth()->user()->tipe == 'admin') {

            $calonPeserta = DB::table('users')->where('tipe','peserta')->count();
            $totalSoal = DB::table('soal_pilihan_bergandas')->count();
            $totalKelas = DB::table('kelas')->count();
            $totalPeserta = DB::table('pesertas')->count();

            return view('admin.home',[
                'calonPeserta' => $calonPeserta,
                'totalSoal' => $totalSoal,
                'totalKelas' => $totalKelas,
                'totalPeserta' => $totalPeserta
            ]);
        }

        elseif (auth()->user()->tipe == 'peserta') {


        # cek apakakah User terdapat dalam tabel Peserta Ujian

        $peserta = Peserta::where('id_user',auth()->user()->id)->where('status',1)->first();

        if ($peserta) {
            $ujian = Ujian::where('id_peserta',$peserta->id)->where('status',1)->first();
            if ($ujian) {

                return view('peserta.infoAwal',[
                    'kelas' => Kelas::find($peserta->id_kelas),
                    'peserta' =>$peserta,
                    'IndexSoalUjian' => 0
                ]);

            } else {

                return view('peserta.home',[
                    'peserta' => $peserta
                    ]);
            }

        } else {
            return view('peserta.homeNotUjian');
        }
        }
    }

}
