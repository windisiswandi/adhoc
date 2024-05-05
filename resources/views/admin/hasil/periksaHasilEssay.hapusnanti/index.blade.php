@extends('ppkHalamanUjian.master')
@section('title','Perikas Hasil Soal Essay')
@section('cssTambahan')
<link rel="stylesheet" href="{{ asset('summernote-0.8.18-dist/summernote.min.css') }}">
<link rel="stylesheet" href="{{ asset('summernote-0.8.18-dist/summernote-bs4.min.css') }}">
@endsection

@section('contentSatu')
<div class="content-header">
</div>

<script type="text/javascript">var BASE_URL = "<?php print URL::to('/'); ?>";</script>
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script>
    @php
            $idPesertaUjian = $idPesertaUjian;
    @endphp
    setInterval(function() {
    $('.btn-none').show();
    }, 500);

    var idPeserta = "<?php echo "$idPesertaUjian"; ?>"

    function formPeriksaEssay(idPeserta,indexSoal,statusPeriksa) {
        location.href = BASE_URL+"/admin/cat/periksa/ujian/essay/"+idPeserta+"/"+indexSoal+"/"+statusPeriksa;
        window.addEventListener("load", event => {
            document.getElementById("reload").onclick = function() {
                location.reload(true);
            }
        });
    }


    function selesai() {
        let text;
        if (confirm("Apakah anda yakin keluar ? Pastikan Anda Telah Menjawab Seluruh Pertanyaan. Klik tombol OK berarti anda keluar dari Kelas dan TIDAK bisa kembali mengikuti tes. Klik tombol CANCEL untuk kembali mengerjakan soal") == true) {
                location.href = "{{route('selesai.Tes.Rekrutmen.Ppk.Submit', '')}}"+"/"+idPeserta;
        } else
        {
            text = "Anda Batal Keluar!";
        }
    }



</script>
@endsection

@section('contentDua')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        @php
                            $noSoal = $noUrutId + 1;
                        @endphp
                        <h6 class="m-0">@php echo 'No. ';echo $noUrutId + 1;@endphp</h6>
                    </div>
                    <div class="card-body">
                        {{-- soal pilihan ganda --}}
                        <form class="" action="{{ route('periksa.Essay.Simpan') }}" method="POST">
                            @csrf
                                    @php
                                        use Illuminate\Support\Facades\Crypt;
                                        // echo Crypt::decryptString($soalUjianEssay[$noUrutId]['soal']);
                                        // echo ($soalUjianEssay[$noUrutId]['soal']);
                                    @endphp
                                    {{-- Form Group untuk Radio Button --}}
                                    {{-- <input type="text" value = '{{ $sisaWaktu }}' id=durasi name="durasi"> --}}
                                    <input type="hidden" value="{{ $noUrutId }}" name="no_urut">
                                    <input type="hidden" value="{{ $idPesertaUjian }}" name="id_peserta">
                                    <input type="hidden" value="{{ $soalUjianEssay[$noUrutId]['id_soal'] }}" name="id_soal">

                                    <div class="form-group clearfix">
                                        <table border="0">
                                            <tr>
                                                <th width="20px"></th>
                                                <th width="1000px"></th>
                                            </tr>
                                            <tr>
                                                <div class="form-group">
                                                    <label class="h6 text-secondary">{{ 'Soal' }}</label>
                                                    <p>{{ Crypt::decrypt($soalUjianEssay[$noUrutId]['soal']) }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label class="h6 text-secondary">{{ 'Jawaban' }}</label>
                                                    <textarea class="form-control @error('jawaban_essay') is-invalid @enderror" name="jawaban_essay" id="periksaJawabanUjian" rows="10" disabled>{{$soalUjianEssay[$noUrutId]['jawaban'] == null ? 'Tidak Ada Jawaban' : $soalUjianEssay[$noUrutId]['jawaban']}}</textarea>
                                                </div>

                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="h6 text-secondary">{{ 'Nilai' }}</label>
                                                            <input type="number" class="form-control @error('nilai') is-invalid @enderror" name="nilai" value="{{$soalUjianEssay[$noUrutId]['nilai'] == null ? '' : $soalUjianEssay[$noUrutId]['nilai']}}">
                                                            @error('nilai')
                                                                <div class="error invalid-feedback">
                                                                    {{$message}}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="h6 text-secondary">{{ 'Catatan' }}</label>
                                                            <textarea class="form-control @error('catatan') is-invalid @enderror" name="catatan" rows="3" >{{$soalUjianEssay[$noUrutId]['catatan'] == null ? '' : $soalUjianEssay[$noUrutId]['catatan']}}</textarea>
                                                            @error('catatan')
                                                                <div class="error invalid-feedback">
                                                                    {{$message}}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        </table>
                                    </div>
                                    <input type="submit" class="btn btn-info btn-none" value="simpan" style="display: none">
                            </form>


                         
                        {{--  --}}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        @php
                        $arraytIdSelanjutnya = $noUrutId + 1;
                        // $arraytIdSebelumnya = $noUrutId - 1;

                        if ($noUrutId == 0) {
                            $arraytIdSebelumnya = 0 ;
                        }
                        if ($noUrutId > 0) {
                            $arraytIdSebelumnya = $noUrutId - 1;
                        }
                        @endphp
                            @if ($noUrutId > 0)
                                <button onclick="formPeriksaEssay('<?php echo $idPesertaUjian ?>','<?php echo $arraytIdSebelumnya ?>','<?php echo $statusPeriksa ?>')" class="btn btn-success btn-circle btn-none" style="display: none">
                                    <i class="fas fa-arrow-left"></i>
                                </button>
                            @endif
                            @if ($noUrutId < ($jumlahSoalEssay - 1) )
                                <button onclick="formPeriksaEssay('<?php echo $idPesertaUjian ?>','<?php echo $arraytIdSelanjutnya ?>','<?php echo $statusPeriksa ?>')" class="btn btn-warning btn-circle btn-none" style="display: none">
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3">

                {{-- <div class="col-lg-3"> --}}
                    <div class="card">
                        <div class="card-header">
                            <h6 class="m-0">Matriks Periksa Jawaban Soal Essay</h6>
                        </div>
                        <div class="card-body text-justify">
                            @foreach ($soalUjianEssay as $key => $item)
                            @php
                                $noUrutId = $key;
                            @endphp
                                @if (is_null($item['nilai']))
                                    <button onclick="formPeriksaEssay('<?php echo $idPesertaUjian ?>','<?php echo $key ?>','<?php echo $statusPeriksa ?>')" class="btn btn-outline-primary btn-sm mb-1 btn-none" style="display: none">
                                        @if ($noUrutId + 1 < 10)
                                            @php
                                                $tampil = $noUrutId + 1;
                                            @endphp
                                            {{ '0'.$tampil }}
                                        @else
                                            {{ $noUrutId + 1 }}
                                        @endif
                                    </button>
                                @else
                                    <button onclick="formPeriksaEssay('<?php echo $idPesertaUjian ?>','<?php echo $key ?>','<?php echo $statusPeriksa ?>')" class="btn btn-primary btn-sm mb-1 btn-none" style="display: none">
                                        @if ($noUrutId + 1 < 10)
                                        @php
                                        $tampil = $noUrutId + 1;
                                        @endphp
                                            {{ '0'.$tampil }}
                                        @else
                                            {{ $noUrutId + 1 }}
                                        @endif
                                    </button>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-lg-12">
                            @if ($noSoal == $jumlahSoalEssay)
                                <form action="{{ route('selesai.periksa.Essay.Simpan') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id_peserta" value="{{ $idPesertaUjian }}">
                                    <input type="submit" value="selesai" class="btn btn-danger">
                                </form>

                            @endif
                        </div>
                    </div>
                {{-- </div> --}}




            </div>


            
        </div>
    </div>
</div>

@endsection
