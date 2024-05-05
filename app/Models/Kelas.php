<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model {
    use HasFactory;

    protected $fillable = [
        'nama_kelas','status','waktu_pengerjaan','jml_pil_ganda','jml_essay','tanggal','jam','ambang_batas','json_komposisi_soal_ganda'
    ];

    public function peserta() {
        return $this->hasMany(Peserta::class,'id_kelas','id');
    }
}
