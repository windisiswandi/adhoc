<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model {

    use HasFactory;

    protected $fillable = [
        'id_peserta',
        'nilai_pilihan_ganda',
        'nilai_soal_essay',
        'total_nilai',
    ];


    public function ujian() {
        return $this->belongsTo(Ujian::class,'id_peserta','id_peserta');
    }

    public function peserta() {
        return $this->belongsTo(Peserta::class,'id_peserta');
    }

}
