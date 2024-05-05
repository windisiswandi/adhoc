<?php

namespace App\Exports;

use App\Models\soalPilihanBergandaNoEnkripsi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class soalPilihanBergandaForEnkripsiExport implements FromView {
    public function view(): View {

        $soalPilihanGanda  = DB::table('soal_pilihan_berganda_no_enkripsis')->get();
        return view('admin.soalPilihanBergandaNoEnkripsi.exportExcel', [
            'soalPilihanGanda' => $soalPilihanGanda
        ]);
    }
}
