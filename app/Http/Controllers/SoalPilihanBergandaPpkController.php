<?php

namespace App\Http\Controllers;

use App\Imports\soalPilihanBergandaPpkImport;
use App\Models\soalPilihanBergandaPpk;
use App\Models\kategoriUjian;
use App\Models\kategoriSoal;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SoalPilihanBergandaPpkController extends Controller {

    // public function __construct() {
    //     $this->middleware(['auth','statusAdminCat']);
    // }

    public function index() {

        $soalPilihanGanda = soalPilihanBergandaPpk::latest()->paginate(10);
        $totalSoalPilihanGanda = soalPilihanBergandaPpk::all();
        return view('ppk.soalPilihanGanda.index',[
            'soalPilihanGanda' => $soalPilihanGanda,
            'totalSoalPilihanGanda' => count($totalSoalPilihanGanda)
        ]);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(soalPilihanBergandaPpk $soalPilihanBergandaPpk)
    {
        //
    }


    public function edit(soalPilihanBergandaPpk $soalPilihanBergandaPpk)
    {
        //
    }


    public function update(Request $request, soalPilihanBergandaPpk $soalPilihanBergandaPpk)
    {
        //
    }


    public function destroy(soalPilihanBergandaPpk $soalPilihanBergandaPpk)
    {
        //
    }

    public function importPilihanGanda(Request $request) {

        Excel::import(new soalPilihanBergandaPpkImport(), request()->file('file'));
        return back();
    }
}
