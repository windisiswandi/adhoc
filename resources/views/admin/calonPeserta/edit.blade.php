@extends('admin.master')
@section('title','Edit Calon Peserta ')
@section('layout','Edit Calon Peserta ')
@section('menuPpk','text-primary text-bold')
@section('menuCalonPeserta','active')
@section('parent')
<a href="{{ route('calon.Peserta.Index') }}">Calon Peserta</a>
@endsection
@section('child','Edit')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            </div>
            <form method="POST" action="{{ route('calon.Peserta.Update') }}">
            @csrf
            <input type="hidden" name="id_calon_peserta" value="{{ $calonPeserta->id }}">
            <div class="card-body">
                <div class="form-group">
                    <label>Nomor Pendaftaran</label>
                    <input type="text" class="form-control @error('no_pendaftaran') is-invalid @enderror" name="no_pendaftaran" value="{{ $calonPeserta->no_pendaftaran }}" autocomplete="no_pendaftaran" placeholder="Masukan No Pendaftaran" disabled>
                    @error('no_pendaftaran')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $calonPeserta->name }}" autocomplete="name" placeholder="Masukan nama">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Wilayah</label>
                    <input type="text" class="form-control @error('wilayah') is-invalid @enderror" name="wilayah" value="{{ $calonPeserta->wilayah }}" autocomplete="name" placeholder="Masukan wilalyah">
                    @error('wilayah')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>

    </div>
</div>

@endsection
