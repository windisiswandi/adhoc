@extends('peserta.master')
@section('title','Home')
@section('contentDua')
<div class="content">
    <div class="container-fluid">
        <div class=" row mb-3">
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Informasi</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"> Hi, <b>{{ Auth::user()->name }} </b>
                            , anda belum memiliki jadwal ujian
                        </p>
                        <div class="text-center">
                            <img src="{{ asset('images/pngegg2.png') }}" class="w-50">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Tata Tertib Pelaksanaan Ujian</h5>
                    </div>
                    <div class="card-body">
                        <p>
                            Peserta DILARANG melakukan kecurangan dalam ujian dan WAJIB melaksanakan ujian secara mandiri (DILARANG membuka kamus, internet atau meminta bantuan kepada orang lain)
                        </p>
                        <p>
                            Segala bentuk kecurangan pada saat ujian akan ditindak tegas. Bagi peserta yang melanggar maka skor dan hasil ujian tidak akan diterbitkan, dan akan mendapatkan sanksi sesuai tingkat kecurangannya
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
