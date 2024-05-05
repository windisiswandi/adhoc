@extends('admin.master')
@section('title','Tambah Peserta')
@section('layout','Tambah Peserta')
@section('menuPpk','text-primary text-bold')
@section('menuPesertaUjian','active')
@section('parent','Master Data')
@section('child','Tambah Peserta')

@section('cssTambahan')
<link rel="stylesheet" href="{{ asset('css/bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap4DataTable.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap4DataTableResponsive.css') }}">

<style>
    table{
        width:100%;
        }
    #example_filter{
        float:right;
        }
    #example_paginate{
        float:right;
        }
    label {
        display: inline-flex;
        margin-bottom: .5rem;
        margin-top: .5rem;
        }
</style>
@endsection

@section('jsTambahan')
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabelPeserta').DataTable(
            {
            "aLengthMenu": [[100, 200, -1], [100, 200, "All"]],
            "iDisplayLength": 100
            }
        );
    } );

    function checkAll(bx) {
        var cbs = document.getElementsByTagName('input');
        for(var i=0; i < cbs.length; i++) {
            if(cbs[i].type == 'checkbox') {
            cbs[i].checked = bx.checked;
            }
        }
    }
</script>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <form method="POST" action="{{ route('peserta.Store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <select name="kelas" class="form-control @error('kelas') is-invalid @enderror" style="width: 100%;" value="{{ old('kelas') }}" required>
                            <option value="">Pilih Kelas</option>
                            @foreach ($kelas as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                            @endforeach
                        </select>
                        @error('kelas')
                        <div class="error invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="table-responsive">
                        <div id="table1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                            <div class="row dt-row">
                                <div class="col-sm-12">
                                    <table class="table dataTable no-footer table-bordered table-striped dtr-inline" id="tabelPeserta" style="width:100%" aria-describedby="tabel-user">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" onclick="checkAll(this)"></th>
                                                <th>No Pendaftaran</th>
                                                <th>Nama</th>
                                                <th>Wilayah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user as  $item)
                                            <tr>
                                                <td><input type="checkbox" value="{{ $item->id }}" name="item[{{ $item->id }}]" id="{{ $item->id }}"></td>
                                                <td>{{ $item->no_pendaftaran }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->wilayah }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th><input type="checkbox" onclick="checkAll(this)"></th>
                                                <th>No Pendaftaran</th>
                                                <th>Nama</th>
                                                <th>Wilayah</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="mx-auto mt-2"> {{ $user->links() }}</div>

                </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ 'Submit' }}</button>
            </div>
        </div>
        </form>
    </div>
</div>

@endsection
