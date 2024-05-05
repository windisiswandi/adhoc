<?php

namespace App\Exports;

use App\Models\HasilTesPpk;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class HasilTesPpkExport implements FromView {

    public $collectionHasil = [];

    public function  __construct($collectionHasil) {

        $this->collectionHasil = $collectionHasil;
    }

    public function view(): View {

        return view('admin.hasil.export', [
            'hasil' => $this->collectionHasil
        ]);
    }
}
