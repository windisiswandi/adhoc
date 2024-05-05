@extends('peserta.master')
@section('title','Dashboard')
@section('contentDua')
<div class="content">
    <div class="container-fluid">
        <div class=" row mb-3">
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Tes Rekrutmen</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"> Hi, Selamat datang <b>{{ Auth::user()->name }}</b>
                            Klik tombol 'Siap Mengikuti Ujian' apabila anda telah siap mengikuti ujian
                        </p>
                        <div class="text-center">
                            <img src="{{ asset('images/pngegg2.png') }}" class="w-50">
                        </div>
                        <form action="{{ route('get.Data.Ujian') }}" method="post">
                            @csrf
                            <input type="hidden" name="id_peserta" value="{{ $peserta->id }}">
                            <input type="submit" value="Siap Mengikuti Ujian" class="btn btn-primary" >
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Tata Tertib Pelaksanaan Tes</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('images/pngegg3.png') }}" class="w-50">
                        </div>
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
