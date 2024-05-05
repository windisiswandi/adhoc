@extends('admin.master')
@section('title','Daftar Soal Pilihan Ganda')
@section('layout','Daftar Soal Pilihan Ganda')
@section('menuPpk','text-primary text-bold')
@section('menuPilihanGanda','active')
@section('parent','Master Data')
@section('child','Daftar Soal Pilihan Ganda')
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
            <a href="" class="btn btn-info disabled" disabled>{{ 'Total Data '.$totalSoalPilihanGanda  }}</a>
        </div>
    </div>
</div>

{{-- Start Modal import Data --}}
<div class="modal fade" id="modalImportExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Import Data Soal Pilihan Ganda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                @include('admin.soalPilihanBerganda.include.formImport')
        </div>
    </div>
</div>
{{-- end Modal Import Data --}}
@endsection
