<?php

namespace App\Http\Middleware;

use App\Models\kelasTesPpk;
use Carbon\Carbon;
use Closure;
use DateTime;
use DateInterval;
use Illuminate\Http\Request;

class statusKelasTesPpk {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {

        $kelas = kelasTesPpk::all();
        if ($kelas->count() > 0) {
            foreach ($kelas as $key => $item) {

                $tanggal_ujian  = date_create($item->tanggal);
                $tanggal_sekarang = date_create(); // waktu sekarang
                $tanggal_ujian = date_add($tanggal_ujian, date_interval_create_from_date_string('72 hours'));
                $updateStatus = kelasTesPpk::find($item->id);

                if ($tanggal_ujian < $tanggal_sekarang ) {
                    $updateStatus->status = 0;
                }
                $updateStatus->save();
            }
            return $next($request);
        }
        if ($kelas->count() == 0) {
            return $next($request);
        }
        else {
             return redirect()->back();
        }
    }
}
