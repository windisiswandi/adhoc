<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class soalPilihanBergandaPpk extends Model {
    use HasFactory;

    protected $fillable = [ 'id_standar_kompetensi','id_materi_pokok','soal','pil_a','pil_b',
                            'pil_c','pil_d','kunci','nilai_benar','nilai_salah','kriteria',
                            'sumber_soal','status'
    ];

    public function getMateriPokok() {
        return $this->belongsTo(materiPokok::class,'id_materi_pokok');
    }
}
