<?php

namespace App\Http\Livewire\Admin\KelasAsssesment;

use App\Models\kategoriUjian;
use App\Models\soalBenarSalah;
use App\Models\soalModelSkala;
use App\Models\soalPilihanGanda;
use App\Models\soalSebabAkibat;
use Livewire\Component;

class Create extends Component
{
    public  $kategori,
            $idKategoriGet,
            $cekSoalPilihanGanda = [],
            $cekSoalSebabAkibat = [],
            $cekSoalBenarSalah = [],
            $cekSoalMetodeSkala = []
            ;

    public function mount() {
        $this->kategori = kategoriUjian::where('status',1)->get();
    }

    public function updatedidKategoriGet() {
        $this->cekSoalPilihanGanda = soalPilihanGanda::where('id_kategori',$this->idKategoriGet)->where('status',1)->get();
        $this->cekSoalSebabAkibat = soalSebabAkibat::where('id_kategori',$this->idKategoriGet)->where('status',1)->get();
        $this->cekSoalBenarSalah = soalBenarSalah::where('id_kategori',$this->idKategoriGet)->where('status',1)->get();
        $this->cekSoalMetodeSkala = soalModelSkala::where('id_kategori',$this->idKategoriGet)->where('status',1)->get();
    }
    
    public function render() {
        return view('livewire.admin.kelas-asssesment.create');
    }
}
