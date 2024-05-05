
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>

<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css?v=3.2.0') }}">
@livewireStyles
@yield('cssTambahan')
{{-- <body class="hold-transition sidebar-mini"> --}}
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-secondary elevation-4">
            <a href="{{ route('home') }}" class="brand-link">
                <img src="{{ asset('images/logoKPU.png') }}" alt="AdminLTE Logo" class="brand-image img-circle">
                <span class="brand-text font-weight-light"><h6 class="text-bold">
                    Tes Tertulis <br>
                    Berbasis Komputer
                    </h6></span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link @yield('menuBeranda')">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-header">Master Data</li>

                                <li class="nav-item">
                                    <a href="{{ route('calon.Peserta.Index') }}" class="nav-link @yield('menuCalonPeserta')">
                                        <i class="fas fa-user-plus"></i>
                                        <p>Calon Peserta</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('soal.Pilihan.Berganda.Index') }}" class="nav-link @yield('menuPilihanGanda')">
                                        <i class="fas fa-calendar-alt"></i>
                                        <p>Soal Pilihan Ganda</p>
                                    </a>
                                </li>

                        <li class="nav-item">
                            <a href="{{ route('kelas.Index') }}" class="nav-link @yield('menuKelasUjian')">
                                <i class="fas fa-tablet"></i>
                                <p>Kelas</p>
                            </a>
                        </li>

                        <li class="nav-header">Peserta </li>
                        <li class="nav-item">
                            <a href="{{ route('peserta.Index') }}" class="nav-link @yield('menuPesertaUjian')">
                                <i class="fas fa-user-shield"></i>
                                <p>Peserta </p>
                            </a>
                        </li>
                        <li class="nav-header">Laporan</li>
                            <li class="nav-item">
                                <a href="{{ route('hasil.Index') }}"class="nav-link @yield('menuHasilAssessment')">
                                    <i class="fas fa-sort-alpha-up"></i>
                                    <p>Hasil</p>
                                </a>
                            </li>
                        <li class="nav-header">Pengaturan</li>
                        <li class="nav-item">
                            <a href="{{ route('update.Password') }}" class="nav-link @yield('menuUpdatePassword')"><i class="fas fa-expand-arrows-alt"></i><p> Update Password</p></a>
                        </li>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4 class="m-0">@yield('layout')</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">@yield('parent')</a></li>
                                <li class="breadcrumb-item active">@yield('child')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
            Versi 2.0
            </div>
            <strong>&copy; 2024</strong>
        </footer>
    </div>

    {{-- @include('sweetalert::alert') --}}
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js?v=3.2.0') }}"></script>
@livewireScripts
@yield('jsTambahan')
@include('sweetalert::alert')
</body>
</html>
