<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalKonvensional extends Model
{
    use HasFactory;

    protected $table = 'soal_konvensionals';

    protected $fillable = ['id_kelas', 'json_soal', 'paket_soal'];

    public function kelas()
    {
        return $this->belongsTo(kelasTesPpk::class, 'id_kelas');
    }
}
