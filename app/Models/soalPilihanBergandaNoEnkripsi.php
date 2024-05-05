<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class soalPilihanBergandaNoEnkripsi extends Model {
    use HasFactory;

    
    protected $fillable = [ 'soal',
                            'pil_a',
                            'pil_b',
                            'pil_c',
                            'pil_d',
                            'kunci',
                            'nilai_benar',
                            'nilai_salah'
                            ];
}
