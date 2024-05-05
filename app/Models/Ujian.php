<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model {
    use HasFactory;

    public function pesertaTesPpk() {
        return $this->belongsTo(pesertaTesPpk::class,'id_peserta');
    }

    public function kelasTesPpk() {
        return $this->belongsTo(kelasTesPpk::class,'id_kelas');
    }

}
