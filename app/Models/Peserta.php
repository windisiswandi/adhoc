<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model {

    use HasFactory;

    protected $fillable = ['sisa_waktu'];

    public function kelas() {
        return $this->belongsTo(Kelas::class,'id_kelas');
    }

    public function pesertaUjian() {
        return $this->belongsTo(User::class,'id_user');
    }

    public function UjianTes() {
        return $this->hasMany(ujianTesPpk::class,'id_peserta','id');
    }
}
