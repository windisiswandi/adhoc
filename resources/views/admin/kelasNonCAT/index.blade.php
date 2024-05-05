@extends('admin.master')

@section('title','Daftar Kelas Non CAT')
@section('layout','Daftar Kelas Non CAT')
@section('menuPpk','text-primary text-bold')
@section('menuKelasNonCAT','active')
@section('parent','Master Data')
@section('child','Daftar Kelas')

@section('jsTambahan')
<script src="{{ asset('js/SweatAlert/sweetalert2@10.js') }}"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-12 mb-2">
        <div class="btn-group" role="group">
            <a href="{{ route('kelas.Non.CAT.Create') }}" class="btn btn-success">Tambah Kelas</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Tanggal</th>
                        <th>Durasi</th>
                        <th>Jumlah Soal Pilihan Ganda</th>
                        <th>Unduh</th>
                        <th></th>
                    </tr>
                    </thead>
                        <tbody>
                            @foreach ( $kelas as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div>
                                        {{$item->nama_kelas == null ? '-' : $item->nama_kelas}}
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        {{ Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                    </div>
                                    <div>
                                        @php
                                            $date = (new DateTime($item->tanggal))->format('H:i')
                                        @endphp
                                    </div>
                                </td>
                                <td>{{ $item->waktu_pengerjaan.' Menit' }}</td>
                                <td class="text-bold">
                                    {{ $item->jml_pil_ganda }}
                                </td>
                                <td>
                                    <a href="{{ route('kelas.Non.CAT.Generate.Word.Soal',$item->id) }}" class="badge badge-success">Soal</a>
                                    <a href="{{ route('kelas.Non.CAT.Generate.Jawban.Pilihan.Ganda',$item->id) }}" class="badge badge-info">Jawaban</a>
                                </td>
                                <td>
                                    <a href="{{ route('kelas.Non.CAT.Destroy',$item->id) }}" class="badge badge-danger">Hapus</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="mx-auto mt-2"> {{ $kelas->links() }}</div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
