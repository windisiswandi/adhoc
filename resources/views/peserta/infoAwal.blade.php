@extends('peserta.master')
@section('title','Informasi Ujian')
@section('contentDua')
<div class="content">
    <div class="container-fluid">
        <div class=" row mb-3">
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Informasi Ujian</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                            <th scope="row" witdh = 30>Nama Kelas</th>
                                <td>:</td>
                                <td>{{$kelas->nama_kelas == null ? '-' : $kelas->nama_kelas }}</td>
                            </tr>
                            <tr>
                                <th scope="row" witdh = 30>No Pendaftaran</th>
                                <td>:</td>
                                <td>{{$peserta->pesertaUjian->no_pendaftaran == null ? '-' : $peserta->pesertaUjian->no_pendaftaran }}</td>
                            </tr>
                            <tr>
                                <th scope="row" witdh = 30>Nama Peserta Ujian</th>
                                <td>:</td>
                                <td>{{$peserta->pesertaUjian->name == null ? '-' : $peserta->pesertaUjian->name }}</td>
                            </tr>
                            @if ($kelas->jml_pil_ganda > 0)
                            <tr>
                                <th scope="row">Jumlah Soal Pilihan Berganda</th>
                                <td>:</td>
                                <td>{{$kelas->jml_pil_ganda == null ? '-' : $kelas->jml_pil_ganda }}</td>
                            </tr>
                            @endif
                            @if ($kelas->jml_essay > 0)
                            <tr>
                                <th scope="row">Jumlah Soal Essai</th>
                                <td>:</td>
                                <td>{{$kelas->jml_essay == null ? '-' : $kelas->jml_essay }}</td>
                            </tr>
                            @endif
                            <tr>
                                <th scope="row">Waktu Pengerjaan</th>
                                <td>:</td>
                                <td>{{$kelas->waktu_pengerjaan == null ? '-' : $kelas->waktu_pengerjaan.' Menit' }}</td>
                            </tr>
                        </table>
                        <a href="{{ route('Ujian.Index') }}" class="btn btn-primary">Mulai</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Tata Tertib Pelaksanaan Ujian</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('images/pngegg3.png') }}" class="w-50">
                        </div>
                        <p>
                            Peserta DILARANG melakukan kecurangan dalam ujian dan WAJIB mengerjakan tes secara mandiri (DILARANG membuka kamus, internet atau meminta bantuan kepada orang lain)
                        </p>
                        <p>
                            Segala bentuk kecurangan pada saat tes akan ditindak tegas. Bagi peserta yang melanggar maka skor dan hasil ujian tidak akan diterbitkan, dan akan mendapatkan sanksi sesuai tingkat kecurangannya
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
