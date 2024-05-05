<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\kelasTesPpk;
use App\Models\Peserta;
use Illuminate\Http\Request;
use App\Models\pesertaTesPpk;
use App\Models\ujianTesPpk;
use App\Models\User;
use App\Models\HasilTesPpk;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Crypt;





class pesertaTesPpkController extends Controller {





    public function store(Request $request) {

        if ($request->item !== null)  {
            foreach ($request->item as $inputUser) {

                $kelasAktif = pesertaTesPpk::where('id_user',$inputUser)->where('status',1)->get();
                $collection = collect($kelasAktif)->pluck('id_user');

                if (!$collection->contains($inputUser)) {
                $pesertaTesPpk = new pesertaTesPpk();
                    $kelas = kelasTesPpk::find($request->kelas);
                $pesertaTesPpk->id_kelas= $request->kelas;
                $pesertaTesPpk->id_user = $inputUser;
                $pesertaTesPpk->status = 1;
                $pesertaTesPpk->sisa_waktu = $kelas->waktu_pengerjaan * 60 ;
                $pesertaTesPpk->save();

                $calonPeserta = User::find($inputUser);
                $calonPeserta->status = 0;
                $calonPeserta->save();

                } else {
                    return redirect()->route('peserta.Ppk.Tes.Index');
                }

            }
        } else {
            return redirect()->back();
        }
        return redirect()->route('peserta.Ppk.Tes.Index');
    }



}
