<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class standarKomptensi extends Model {
    use HasFactory;

    public function materiPokok() {
        return $this->hasMany(materiPokok::class,'id_standar_kompetensi','id');
    }

}
