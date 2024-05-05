{{-- @extends('errors::minimal')
@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden')) --}}

@extends('peserta.masterNew')
@section('title','Dashboard')

@section('content')
<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <div class="card-body">
                <div class="callout callout-info">
                    Hi, Selamat datang <b>{{ Auth::user()->name }}</b>
                    Klik tombol 'Siap Mengikuti Ujian' apabila anda telah siap mengikuti ujian
                </div>
                <div class="text-center">
                    <img src="{{ asset('images/pngegg2.png') }}" class="w-50">
                </div>
                <div class="text-center">
                    {{-- <a href="{{ route('ujian.AmbilData',[$cekPesertaUjian->id,$cekPesertaUjian->id_kelas,$jumlahSoalPilihanGanda]) }}" class="btn btn-warning">{{ 'Siap Mengikuti Ujian' }}</a> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tata Tertib Pelaksanaan Tes</h6>
            </div>
            <div class="card-body">
                <p>
                    Peserta DILARANG melakukan kecurangan dalam tes dan WAJIB mengerjakan tes secara mandiri (DILARANG membuka kamus, internet atau meminta bantuan kepada orang lain)
                </p>
                <p>
                    Segala bentuk kecurangan pada saat tes akan ditindak tegas. Bagi peserta yang melanggar maka skor dan sertifikat tidak akan diterbitkan, dan akan mendapatkan sanksi sesuai tingkat kecurangannya
                </p>
            </div>
        </div>
    </div>
@endsection

