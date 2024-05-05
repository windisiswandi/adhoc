@extends('peserta.master')
@section('title','Hasil')
@section('contentDua')
<div class="content">
    <div class="container-fluid">
        <div class=" row mb-3">
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Informasi Hasil</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th scope="row" witdh = 30>No Pendaftaran</th>
                                <td>:</td>
                                <td> {{$tampilHasil->peserta->pesertaUjian == null ? '-' : $tampilHasil->peserta->pesertaUjian->no_pendaftaran }}</td>
                            </tr>
                            <tr>
                                <th scope="row" witdh = 30>Nama</th>
                                <td>:</td>
                                <td> {{$tampilHasil->peserta->pesertaUjian == null ? '-' : $tampilHasil->peserta->pesertaUjian->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row" witdh = 30>Kelas</th>
                                <td>:</td>
                                <td> {{$tampilHasil->peserta->kelas == null ? '-' : $tampilHasil->peserta->kelas->nama_kelas }}</td>
                            </tr>
                            <tr>
                                <th scope="row" witdh = 30>Nilai Pilihan Ganda</th>
                                <td>:</td>
                                <td>
                                    {{ Crypt::decrypt($tampilHasil->nilai_pilihan_ganda ) }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Petunjuk Hasil</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('images/pngegg3.png') }}" class="w-50">
                            <p>
                                Tes Telah Usai. Terimakasih telah berpartisipasi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
