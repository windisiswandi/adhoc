<?php

namespace App\Exports;

use App\Models\soalEssayNoEnkripsi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class soalEssayForEnkripsiExport implements FromView {

    public function view(): View {

        $soalEssay  = DB::table('soal_essay_no_enkripsis')->get();
        return view('admin.soalEssayNoEnkripsi.exportExcel', [
            'soalEssay' => $soalEssay
        ]);
    }
}
