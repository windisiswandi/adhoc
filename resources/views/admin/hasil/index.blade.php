@extends('admin.master')

@section('title','Hasil Tes Tertulis')
@section('layout','Hasil Tes Tertulis')
@section('menuPpk','text-primary text-bold')
@section('menuHasilAssessment','active')
@section('parent','Home')
@section('child','Hasil Tes Tertulis')

@section('content')
{{-- batas --}}
<form action="{{ route('hasil.Index') }}" method="get">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <select name="kelas"  class="form-control @error('provinsi') is-invalid @enderror" style="width: 100%;">
                    <option value="">Pilih Kelas</option>
                    @foreach ($kelas as $item)
                    <option
                      @php if ($item->id == $kelasSelected) {
                        echo "selected ='selected'"; }
                      @endphp value="{{ $item->id }}">{{ $item->nama_kelas }}
                    </option>
                    @endforeach
              </select>
              @error('provinsi')
                <div class="error invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <select name="wilayah" class="form-control @error('satker') is-invalid @enderror" style="width: 100%;">
                    <option value="">Pilih Wilayah</option>
                    @foreach ($wilayah as $item)
                    <option
                      @php if ($item == $wilayahSelected) {
                        echo "selected ='selected'"; }
                      @endphp value="{{ $item }}">{{ $item }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-md-6">
            <button name ="submit" type="submit" class="btn btn-warning" value="filter">Filter</button>
            <a href="{{ route('hasil.Index') }}" class="btn btn-secondary">Reset</a>
            <button name ="submit" type="submit" class="btn btn-primary" value="cetakPdf">Cetak PDF</button>
            <button name ="submit" type="submit" class="btn btn-success" value="exportExcel">Export Excel</button>
        </div>
    </div>


    </form>
{{-- batas --}}

<div class="row">
    <div class="col-12">
        <div class="table-responsive-sm">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="background-color: white">
                    <th>No</th>
                    <th>No Pendaftaran</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Wilayah</th>
                    <th>Nilai Pilihan Ganda</th>
                </tr>
                </thead>
                <tbody id="calonPesertaAssessmentTable">
                    @forelse( $hasil as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->no_pendaftaran }}</td>
                        <td>{{ $item->nama_peserta }}</td>
                        <td>{{ $item->nama_kelas }}</td>
                        <td>{{ $item->wilayah }}</td>
                        <td>{{ Crypt::decrypt($item->nilai_pilihan_ganda) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan = "8">Data tidak tersedia</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
