<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesertaTesPpk extends Model {

    use HasFactory;

    protected $fillable = ['sisa_waktu'];

    public function kelas() {
        return $this->belongsTo(kelasTesPpk::class,'id_kelas');
    }

    public function peserta() {
        return $this->belongsTo(User::class,'id_user');
    }

    public function UjianTes() {
        return $this->hasMany(ujianTesPpk::class,'id_peserta','id');
    }

}
