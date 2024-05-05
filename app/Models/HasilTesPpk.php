<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilTesPpk extends Model {
    use HasFactory;
    protected $fillable = [
        'id_peserta_tes_ppk',
        'nik',
        'nama',
        'kelas',
        'no_pendaftaran',
        'wilayah',
        'kelurahan',
        'nilai_pilihan_ganda',
        'nilai_soal_essay',
        'total_nilai',
        'status_periksa_soal_essay'
    ];

    

    public function ujianTesPpk() {
        return $this->belongsTo(ujianTesPpk::class,'id_peserta_tes_ppk','id_peserta');
    }

    
}
