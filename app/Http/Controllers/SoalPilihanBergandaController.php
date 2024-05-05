<?php

namespace App\Http\Controllers;

use App\Models\SoalPilihanBerganda;
use Illuminate\Http\Request;

use App\Imports\soalPilihanBergandaPpkImport;
use Maatwebsite\Excel\Facades\Excel;

class SoalPilihanBergandaController extends Controller  {

    public function index() {

        $soalPilihanGanda = SoalPilihanBerganda::latest()->paginate(10);
        $totalSoalPilihanGanda = SoalPilihanBerganda::all();
        return view('admin.soalPilihanBerganda.index',[
            'soalPilihanGanda' => $soalPilihanGanda,
            'totalSoalPilihanGanda' => count($totalSoalPilihanGanda)
        ]);
    }

    public function importPilihanGanda(Request $request) {

        Excel::import(new soalPilihanBergandaPpkImport(), request()->file('file'));
        return back();
    }
}
