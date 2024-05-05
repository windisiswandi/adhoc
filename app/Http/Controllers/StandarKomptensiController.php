<?php

namespace App\Http\Controllers;

use App\Models\standarKomptensi;
use Illuminate\Http\Request;
use SebastianBergmann\LinesOfCode\Counter;

class StandarKomptensiController extends Controller {

    public function __construct()
    {
        $this->middleware(['auth','statusKelasTesPpk','statusAdminCat']);
    }

    public function index() {

        $standarKomptensi = standarKomptensi::paginate(10);
        return view('ppk.standarKompetensi.index',[
            'standarKomptensi' => $standarKomptensi,
            'totalStandarKompetensi' => count(standarKomptensi::all())
        ]);
    }
}
