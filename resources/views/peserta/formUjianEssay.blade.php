@extends('peserta.master')
@section('title','Ujian Essay')

@push('css')
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/summernote/summernote-bs4.min.css') }}">
@endpush

@push('scripts')
<script>
    let idPeserta = "<?php echo $idPeserta; ?>";
    let durasi = "<?php echo $sisaWaktu; ?>";
    let finish = new Date().getTime() + (parseInt(durasi) * 1000);
    let prevDistance = finish - new Date().getTime();

    // Fungsi interval countdown
    let countdownInterval = setInterval(function() {
        let now = new Date().getTime();
        let distance = finish - now;

        // Perhitungan jam, menit, dan detik dari jarak durasi yang tersisa
        let hours = Math.floor(distance / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);

        durasi = (hours * 3600) + (minutes * 60) + seconds;
        document.querySelector(".counter").innerHTML = hours + " : " + minutes + " : " + seconds;

        if (distance === prevDistance) {
            clearInterval(countdownInterval);
            location.reload();
        }
        // Update nilai `prevDistance`
        prevDistance = distance;

        if (distance < 0) {
            clearInterval(countdownInterval);
            document.querySelector(".counter").innerHTML = "Waktu Habis";
            location.href = "{{ route('ujian.Selesai.Submit') }}";
        }
    }, 1000);

    // load timer diawal
    window.addEventListener('load', function() {
        let interval = setInterval(function() {
            $.ajax({
                type: "GET",
                url: "{{ url('ujian/sisa-waktu') }}/"+idPeserta+'/'+durasi,
                dataType: 'html',
                success: function(data) {
                    if (!data) {
                        clearInterval(interval);
                        location.reload();
                    }
                },
                error: function() {
                    clearInterval(interval);
                    location.reload();
                }
            });
        }, 3000);
    });
</script>

<script>

    $(document).ready(function() {
        tampilSoal();
    });

    // Read Database
    function tampilSoal(index = 0) {
        $.get("{{ url('ujian/tampil-soal-essay') }}/" + index, {}, function(data, status) {
            $("#read").html(data);
        });
    }

    function simpanJawabanAndNext() {

        let jawaban = $("#jawabanEssay").val();
        let idPeserta = $("#id_peserta").val();
        let idSoal = $("#id_soal").val();
        let index = $("#index").val();
        let totalSoalEssay = $("#total_soal_essay").val();

        index = parseInt(index);
        totalSoalEssay = parseInt(totalSoalEssay);

        if (jawaban === undefined) {
            jawaban = null;
        }
        $.ajax({
            type: "get",
            url: "{{ url('ujian/simpan-jawaban-essay') }}",
            data: {
                jawaban: jawaban ,
                idPeserta : idPeserta,
                idSoal : idSoal,
                index : index,
                totalSoalEssay : totalSoalEssay
            },
            success: function(data) {
                $(".btn-close").click();
                let newIndex = index + 1;
                if (newIndex == totalSoalEssay) {
                    newIndex = index
                }
                tampilSoal(newIndex);
            }
        });
    }
</script>
<script src="{{ asset('AdminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
@endpush

@section('contentSatu')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col">
                @if ($kelas->jml_pil_ganda > 0)
                <a href="{{ route('Ujian.Index') }}" class="btn btn-outline-light">Pilihan Ganda</a>
                @endif
                @if ($kelas->jml_essay > 0)
                    <a href="{{ route('Ujian.Index.Essay') }}" class="btn btn-light active">Essai</a>
                @endif
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#staticBackdrop">
                    Akhiri Ujian
                </button>
            </div>
            <div class="col-auto">
                <h3 class="m-0 font-weight-bold text-danger counter"></h3>
            </div>
        </div>
    </div>
</div>


{{-- modal --}}
<div class="modal fade " id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Informasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Apakah anda yakin keluar ? <br>
            Pastikan telah menjawab seluruh pertanyaan. <br>
            Klik tombol 'Selesai' untuk menyelesaikan ujian <br>
            Klik tombol 'Kembali' untuk kembali mengerjakan soal <br>
            <a href="{{ route('ujian.Selesai.Submit') }}" class="btn btn-danger mt-2">Selesai</a>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>

        </div>
        </div>
    </div>
</div>
{{-- modal --}}
@endsection

@section('contentDua')
<div id="read"></div>
@endsection
