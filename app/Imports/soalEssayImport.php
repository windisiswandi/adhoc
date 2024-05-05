<?php

namespace App\Imports;

use App\Models\soalEssay;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class soalEssayImport implements ToModel, WithHeadingRow {
    public function model(array $row) {
        return new soalEssay([
            'soal' =>$row['soal'],
        ]);
    }
}
