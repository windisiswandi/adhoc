@extends('admin.master')
@section('title','Dashboard')
@section('layout','Dashboard')
@section('menuPpk','text-primary text-bold')
@section('parent','Home')
@section('child','Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        {{-- small box  --}}
        <div class="small-box bg-info">
        <div class="inner">
            <h3>{{ $calonPeserta }}</h3>
            <p>Calon Peserta</p>
        </div>
        <div class="icon">
            <i class="fas fa-user-plus"></i>
        </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        {{-- small box  --}}
        <div class="small-box bg-success">
        <div class="inner">
            <h3>{{ $totalSoal }}</h3>
            <p>Soal Tes Tersedia</p>
        </div>

        <div class="icon">
            <i class="fas fa-book"></i>
            </div>

        </div>
    </div>

    <div class="col-lg-3 col-6">
        {{-- small box  --}}
        <div class="small-box bg-warning">
        <div class="inner">
            <h3>{{ $totalKelas }}</h3>
            <p>Kelas Tersedia</p>
        </div>
        <div class="icon">
            <i class="nav-icon fas fas fa-table"></i>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        {{-- small box --}}
        <div class="small-box bg-danger">
        <div class="inner">
            <h3>{{ $totalPeserta }}</h3>
            <p>Peserta Tes</p>
        </div>
        <div class="icon">
            <i class="fas fa-user-shield"></i>
        </div>
        </div>
    </div>
</div>

 <div class="row">
    <div class="col-lg-6">
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <p>
                    Tombol RESET diaktifkan HANYA ketika uji coba menggunakan Data Dummy telah selesai dilakukan.
                    DILARANG untuk meng-aktifkan tombol RESET ketika Aplikasi sedang digunakan untuk keperluan Tes
                    <a href="{{ route('reset.Dashboard') }}" class="nav-link" onclick="myFunction()">Reset</a>
                </p>

                    {{--  --}}
                    <script>
                        function myFunction() {
                            let text;
                            if (confirm("Apakah anda yakin melakukan reset aplikasi ? Tindakan Reset akan menghapus data dalam aplikasi") == true) {
                                location.href = "{{route('reset.Dashboard')}}";
                            } else {
                                text = "Batal";
                            }
                            }
                        </script>

            </div>
        </div>
    </div>
</div>
@endsection
