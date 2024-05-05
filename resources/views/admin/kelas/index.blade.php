@extends('admin.master')
@section('title','Daftar Kelas')
@section('layout','Daftar Kelas')
@section('menuPpk','text-primary text-bold')
@section('menuKelasUjian','active')
@section('parent','Master Data')
@section('child','Daftar Kelas')

@section('jsTambahan')
<script src="{{ asset('js/SweatAlert/sweetalert2@10.js') }}"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-12 mb-2">
        <div class="btn-group" role="group">
            <a href="{{ route('kelas.Create') }}" class="btn btn-success">Tambah Kelas</a>
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
                        <th>Jumlah Peserta</th>
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
                                <td class="text-center">
                                    @php
                                    $peserta =  count($item->peserta);
                                    echo $peserta;
                                    @endphp
                                </td>
                                <td>
                                    @if ($peserta < 1)
                                        <a href="{{ route('kelas.Destroy',$item->id) }}" class="badge badge-danger">Hapus Kelas</a>
                                    @endif
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
