<?php

namespace App\Imports;

use App\Models\soalEssayNoEnkripsi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Crypt;

// class SoalEssayNoEnkripsiImport implements ToModel {
class SoalEssayNoEnkripsiImport implements ToModel, WithHeadingRow {
    public function model(array $row){
        return new soalEssayNoEnkripsi([
            'soal' =>$row['soal'],
        ]);
    }
}
