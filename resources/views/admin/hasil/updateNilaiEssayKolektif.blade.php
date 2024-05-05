@extends('ppk.master')

@section('title','Update Nilai Essay')
@section('layout','Update Nilai Essay')
@section('menuPpk','text-primary text-bold')
@section('menuHasilAssessment','active')
@section('parent','Home')
@section('child','Update Nilai Essays')


@section('content')

<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card card-outline card-primary">
            <div class="card-header">
                <span class="badge badge-info">{{$kelas == null ? 'Semua Kelas' : $kelas}}</span>
                <div class="card-tools">
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                <form action="{{route('input.Nilai.Kolektif')}}" method="POST">
                @csrf
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>No Pendaftaran</th>
                        <th>Nama</th>
                        <th>Nilai Essay</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($periksaHasil as $key=> $item)
                    <tr>
                        <input type="hidden" name="item[{{$key}}][id]" value="{{$item->id}}" >
                        <input type="hidden" name="item[{{$key}}][nilai_pilihan_ganda]" value="{{$item->nilai_pilihan_ganda}}" >
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$item->no_pendaftaran == null ? '-' : $item->no_pendaftaran}}</td>
                        <td>{{$item->nama == null ? '-' : $item->nama}}</td>
                        <td><input type="number" name="item[{{$key}}][nilai_soal_essay]" class="form-control"></td>
                        
                    
                    
                    </tr>
                    @endforeach  
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection