<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HasilTesPpkExport;
use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use PDF;


class HasilController extends Controller {

    public function index(Request $request) {

        $kelasSelected = $request->kelas;
        $wilayahSelected = $request->wilayah;

        $hasil = collect($this->getAllHasil());
        $hasil = $hasil->when($kelasSelected, function($query,$kelasSelected) {
                            return
                            $query->where('id_kelas', $kelasSelected);
                        })
                        ->when($wilayahSelected, function($query,$wilayahSelected) {
                            return
                            $query->where('wilayah',$wilayahSelected);
                        });

        if ($request->submit === "exportExcel") {

            $file = 'excel-hasil-pilihan-ganda-'.date('Y-m-d_H-i-s').'.xlsx';
            return Excel::download(new HasilTesPpkExport($hasil), $file);
        }

        if ($request->submit === "cetakPdf") {

            $pdf = PDF::loadView('admin.hasil.export-pdf', [
                'hasil' => $hasil,
                'kelas' =>  Kelas::find($request->kelas),
                'wilayah' => $request->wilayah,
            ]);
            return $pdf->download('PENGUMUMAN HASIL SELEKSI TERTULIS.pdf');
        }

        return view('admin.hasil.index',[
            'hasil' => $hasil,
            'kelas' => Kelas::all(),
            'wilayah' => User::get()->unique('wilayah')->where('tipe','peserta')->pluck('wilayah'),

            # Parameter
            'kelasSelected' => $kelasSelected,
            'wilayahSelected' => $wilayahSelected

        ]);
    }

    private function getAllHasil() {
        $data = DB::select(" SELECT
                    pesertas.id_user,
                    hasils.id_peserta,
                    users.no_pendaftaran,
                    users.name AS nama_peserta,
                    kelas.nama_kelas,
                    users.wilayah,
                    hasils.nilai_pilihan_ganda,
                    hasils.nilai_soal_essay,
                    hasils.total_nilai,
                    hasils.id AS id_hasil,
                    pesertas.id_kelas
                FROM
                    hasils
                    LEFT JOIN pesertas ON hasils.id_peserta = pesertas.id
                    LEFT JOIN kelas ON pesertas.id_kelas = kelas.id
                    LEFT JOIN users ON pesertas.id_user = users.id
                ORDER BY users.name ASC
        ");
        return $data;
    }

}
