<?php

namespace App\Imports;

use App\Models\soalPilihanBergandaNoEnkripsi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SoalPilihanBergandaNoEnkripsiImport implements ToModel,WithHeadingRow {
    public function model(array $row) {

        return new soalPilihanBergandaNoEnkripsi([
            'soal' =>$row['soal'],
            'pil_a' => $row['pilihan_a'],
            'pil_b' => $row['pilihan_b'],
            'pil_c' => $row['pilihan_c'],
            'pil_d' => $row['pilihan_d'],
            'kunci' => $row['kunci'],
            'nilai_benar' => $row['nilai_benar']
        ]);
    }
}
