<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tes Tertulis Berbasis Komputer | Login</title>
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline">
            <div class="card-header text-center">
                <img src="{{ asset('images/logoKPU.png') }}" width="49" height="56"><br><a href="" class="h1"></a>
                <div class="text-center">
                    Komisi Pemilihan Umum <br>
                    Republik Indonesia
                </div>
            </div>

            <div class="card-body">
                @if(session()->has('error'))
                    <div class="alert alert-warning alert-dismissible fade show">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <p class="login-box-msg">Tes Tertulis Berbasis Komputer</p>
                <form class="pt-3" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name ="no_pendaftaran"class="form-control form-control-lg @error('no_pendaftaran') is-invalid @enderror" placeholder="Masukan No Pendaftaran">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('no_pendaftaran')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password"  name ="password" class="form-control form-control-lg @error ('password') is-invalid @enderror"  placeholder="Masukan Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-block btn-outline-primary">Masuk</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
    <script>
        // Set waktu penundaan dalam milidetik (3 menit = 180000 milidetik)
        const delayTime = 180000;
        let timer;

        // Fungsi untuk memulai hitung mundur
        function startTimer() {
            timer = setTimeout(() => {
                location.href = "{{route('login')}}";
            }, delayTime);
        }

        // Fungsi untuk menghentikan timer jika ada aksi
        function resetTimer() {
            clearTimeout(timer);
            startTimer();
        }

        // Mulai hitung mundur ketika halaman dimuat
        document.addEventListener("DOMContentLoaded", () => {
            startTimer();
        });

        document.addEventListener("click", resetTimer);
    </script>
</body>
</html>
