<?php

namespace App\Imports;

use App\Models\materiPokok;
use App\Models\soalPilihanBergandaPpk;
use App\Models\SoalPilihanBerganda;
use App\Models\standarKomptensi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Crypt;


class soalPilihanBergandaPpkImport implements ToModel, WithHeadingRow {

    public function model(array $row) {

        return new SoalPilihanBerganda([
            'soal' =>$row['soal'],
            'pil_a' => $row['pilihan_a'],
            'pil_b' => $row['pilihan_b'],
            'pil_c' => $row['pilihan_c'],
            'pil_d' => $row['pilihan_d'],
            'kunci' => $row['kunci'],
            'nilai_benar' => $row['nilai_benar'],
            'nilai_salah' => $row['nilai_salah'],
            'status' => 1
        ]);
    }
}
