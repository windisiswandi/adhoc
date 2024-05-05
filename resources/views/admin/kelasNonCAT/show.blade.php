@extends('ppk.master')
@section('title','Detail Gelombang Tes PPK')
@section('layout','Detail Gelombang Tes PPK')
@section('menuPpk','text-primary text-bold')
@section('menuKelasUjian','active')
@section('parent')
<a href="{{ route('kelas.Ppk.Tes.Index') }}">Gelombang Tes PPK</a>
@endsection
@section('child','Detail')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>{{__('Nama Gelombang Tes')}}</th>
                        <td>:</td>
                        <td>{{$kelas->nama_kelas}}</td>
                        <th>{{__('Tanggal dan Waktu Tes')}}</th>
                        <td>:</td>
                        <td>{{\Carbon\Carbon::create($kelas->tanggal)->isoFormat('LLLL')}}</td>
                    </tr>
                    <tr>
                        <th>{{__('Waktu Pengerjaan')}}</th>
                        <td>:</td>
                        <td>{{$kelas->waktu_pengerjaan.' menit'}}</td>
                        <th>{{__('Jumlah Soal')}}</th>
                        <td>:</td>
                        <td>{{$kelas->jml_pil_ganda}}</td>
                    </tr>
                </table>
                <hr>
                <table class="table">
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Standar Kompetensi</th>
                        <th rowspan="2">Materi Pokok</th>
                        <th colspan="3">Jml Soal Dg Tingkat Kesulitan</th>
                    </tr>
                    <tr>
                        <th>Mudah</th>
                        <th>Sedang</th>
                        <th>Sulit</th>
                    </tr>
                    <tbody>
                        @forelse($komposisi as $i => $komp)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$komp['nama_standar_kompetensi']}}</td>
                            <td>{{$komp['nama_materi_pokok']}}</td>
                            <td>{{!is_null($komp['mudah'])?$komp['mudah']:0}}</td>
                            <td>{{!is_null($komp['sedang'])?$komp['sedang']:0}}</td>
                            <td>{{!is_null($komp['sulit'])?$komp['sulit']:0}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Data tidak ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>            
        </div>
    </div>
</div>
@endsection