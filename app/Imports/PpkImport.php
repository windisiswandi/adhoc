<?php

namespace App\Imports;

use App\Models\User;
use App\Imports\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures as ConcernsSkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;

class PpkImport implements ToModel, WithValidation, WithHeadingRow, SkipsOnFailure {

    use Importable, ConcernsSkipsFailures;

    public function model(array $row) {

        return new User([

            'no_pendaftaran' => $row['no_pendaftaran'],
            'name' => $row['name'],
            'wilayah' => $row['wilayah'],
            'tipe' => 'peserta',
            'password' => Hash::make(12345678),
            'status' => 1,
        ]);
    }

    public function rules(): array {
        return [
            'name' => 'required|string|max:255',
            'no_pendaftaran' => 'required|string|max:255|unique:users,no_pendaftaran',
            'wilayah' => 'required|string|max:255',
        ];
    }

    public function customValidationMessages() {
        return [
            'name.required' => 'Kolom Nama Tidak Boleh Kosong',
            'wilayah.required' => 'Kolom Wilayah Tidak Boleh Kosong',
            'no_pendaftaran.required' => 'Kolom Email Tidak Boleh Kosong',
            'no_pendaftaran.unique' => 'No Pendaftaran Sudah Terdaftar',
        ];
    }

}
