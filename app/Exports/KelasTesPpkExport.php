<?php

namespace App\Exports;

use App\Models\kelasTesPpk;
use App\Models\pesertaTesPpk;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class KelasTesPpkExport implements FromView {


    public function  __construct($idKelasTesPpk) {
        $this->idKelasTesPpk= $idKelasTesPpk;
    }

    public function view(): View {

        $kelas = kelasTesPpk::find($this->idKelasTesPpk);
        $pesertaTes = pesertaTesPpk::where('id_kelas',$this->idKelasTesPpk)->get();

        return view('ppk.kelas.export-kelas', [
            'pesertaTes' => $pesertaTes,
            'kelas' => $kelas
        ]);
    }
}
