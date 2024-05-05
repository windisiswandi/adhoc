<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelasTesPpk extends Model {
    use HasFactory;

    protected $fillable = [
        'nama_kelas','status','waktu_pengerjaan','jml_pil_ganda','jml_essay','tanggal','jam','ambang_batas','json_komposisi_soal_ganda'
    ];

    public function pesertaTesPpk() {
        return $this->hasMany(pesertaTesPpk::class,'id_kelas','id');
    }

    // public function kelasUjianTesPpk() {
    //     return $this->hasMany(ujianTesPpk::class,'id_kelas','id');
    // }
}
