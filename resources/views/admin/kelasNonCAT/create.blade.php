@extends('admin.master')
@section('title','Tambah Kelas')
@section('layout','Tambah Kelas')
@section('menuPpk','text-primary text-bold')
@section('menuKelasNonCAT','active')
@section('parent')
<a href="{{ route('kelas.Non.CAT.Index') }}">Kelas</a>
@endsection
@section('child','Tambah')

@section('jsTambahan')
<script src="{{ asset('js/SweatAlert/sweetalert2@10.js') }}"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card ">
            <form action="{{ route('kelas.Non.CAT.Store') }}" method="POST">
                @csrf
                <div class="card-header">

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Nama Kelas</label>
                                <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror" name="nama_kelas" value="{{ old('nama_kelas') }}" autocomplete="nama_kelas" placeholder="Masukan Nama Kelas" required>
                                @error('nama_kelas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Durasi Waktu Pengerjaan</label>
                                <input type="number" class="form-control @error('waktu_pengerjaan') is-invalid @enderror" name="waktu_pengerjaan" value="{{ old('waktu_pengerjaan') }}" autocomplete="waktu_pengerjaan" placeholder="Masukan Waktu Pengerjaan" required>
                                @error('waktu_pengerjaan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal') }}" autocomplete="tanggal" placeholder="Masukan Tanggal" required>
                                @error('tanggal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>Jumlah Soal Pilihan Ganda</label>
                                <input type="number" class="form-control @error('jumlah_pilihan_ganda') is-invalid @enderror" name="jumlah_pilihan_ganda" value="{{ old('jumlah_pilihan_ganda') }}" autocomplete="jumlah_pilihan_ganda" placeholder="Masukan Jumlah Soal Pilihan Ganda" required>
                                @error('jumlah_pilihan_ganda')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{ 'Submit' }}</button>
                </div>

            </form>

        </div>

    </div>
</div>
@endsection
