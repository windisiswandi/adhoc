@extends('admin.master')
@section('title','Daftar Soal Wawancara')
@section('layout','Daftar Soal Wawancara (*)')
@section('menuPpk','text-primary text-bold')
@section('menuSoalEssayNoEnkripsi','active')
@section('parent','Master Data')
@section('child','Daftar Soal Wawancara')
@section('jsTambahan')
    <script src="{{ asset('AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function () {
        bsCustomFileInput.init();
        });
    </script>
@endsection

@section('content')
<div class="row">
    <div class="col-12 mb-2">
        <div class="btn-group mb-2" role="group">
            <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalImportExcel">{{ 'Import Excel' }}</a>
            <a href="" class="btn btn-info disabled" disabled>{{ 'Total Data '.$totalSoalEssayNoEnkripsi  }}</a>
            <a href="{{ route('export.Soal.Essay.For.Enkripsi') }}" class="btn btn-success">{{ 'Download'}}</a>
        </div>
    </div>
</div>

{{-- Start Modal import Data --}}
<div class="modal fade" id="modalImportExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Import Data Soal Wawancara No Enkripsi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                @include('admin.soalEssayNoEnkripsi.include.formImport')
        </div>
    </div>
</div>
{{-- end Modal Import Data --}}
@endsection
