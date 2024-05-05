<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materiPokok extends Model {
    use HasFactory;

    public function getStandarKompetensi() {
        return $this->belongsTo(standarKomptensi::class,'id_standar_kompetensi');
    }

    public function soalPilihanGandaPpk() {
        return $this->hasMany(soalPilihanBergandaPpk::class,'id_materi_pokok','id');
    }

    public function kriteriaMudah($id)
    {
        return $this->whereHas('soalPilihanGandaPpk', function($q){
            $q->where('kriteria', 1);
        })->where('id', $id)->exists();
    }

    public function kriteriaSedang($id)
    {
        return $this->whereHas('soalPilihanGandaPpk', function($q){
            $q->where('kriteria', 2);
        })->where('id', $id)->exists();
    }

    public function kriteriaSulit($id)
    {
        return $this->whereHas('soalPilihanGandaPpk', function($q){
            $q->where('kriteria', 3);
        })->where('id', $id)->exists();
    }
}
