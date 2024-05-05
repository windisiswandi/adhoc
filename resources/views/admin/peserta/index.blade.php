@extends('admin.master')

@section('title','Daftar Peserta')
@section('layout','Daftar Peserta')
@section('menuPpk','text-primary text-bold')
@section('menuPesertaUjian','active')
@section('parent','Master Data')
@section('child','Peserta')

@section('cssTambahan')
<link rel="stylesheet" href="{{ asset('css/bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap4DataTable.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap4DataTableResponsive.css') }}">
<link rel="stylesheet" href="{{ asset('css/iziToast.css') }}">
@endsection

@section('jsTambahan')
<script type="text/javascript" src="{{ asset('js/DataTablesFlexible/Newjquery-3.5.1.js') }}"> </script>
<script type="text/javascript" src="{{ asset('js/DataTablesFlexible/Newjquery.dataTables.min.js') }}"> </script>
<script type="text/javascript" src="{{ asset('js/DataTablesFlexible/NewdataTables.bootstrap4.min.js') }}"> </script>
<script src="{{ asset('js/SweatAlert/sweetalert2@10.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#tabel-peserta').DataTable({
            buttons: [
        'copy', 'excel', 'pdf'
    ],
            processing: true,
            serverSide: true,
            ajax: '{{ route("peserta.Index.Get.Json") }}',
            columns: [
                {   "data": null,
                    "class": "align-top",
                    "orderable": true,
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                },
                {"name": "no_pendaftaran", "data": "no_pendaftaran"},
                {"name": "nama", "data": "nama"},
                {"name": "wilayah", "data": "wilayah"},
                {"name": "nama_kelas", "data": "nama_kelas"},
                {
                    "orderable": true,
                    "searchable": true,
                    data: function(row) {
                        let aksi = '<span class="text-danger">Belum Mengikuti Ujian</span>';
                        if (row.status_ujian == 0) {
                            aksi = '<span class="text-success">Telah Menyelesaikan Ujian</span>';
                        }
                        if (row.status_ujian == 1) {
                            aksi = '<span class="text-primary">Belum Menyelesaikan Ujian</span>';
                        }
                        return aksi;
                    }
                },
                {
                "orderable": true,
                "searchable": true,
                data: function(row) {
                    hapus = '';
                    if (row.id_ujian == null) {
                        hapus = `<a href="{{ route('peserta.Destroy', '') }}/${row.id_peserta}" class="badge badge-danger" data-confirm-delete="true">Hapus Peserta</a> `;
                    }
                    return hapus ;
                    }
                }

            ]
        });
    });

</script>
@endsection



@section('content')
<div class="row">
    <div class="col-12 mb-2">
        <div class="btn-group" role="group">
            <a href="{{ route('peserta.Create') }}" class="btn btn-success">Tambah Data</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div id="table1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                        <div class="row dt-row">
                            <div class="col-sm-12">
                                <table class="table dataTable no-footer table-bordered table-striped dtr-inline" id="tabel-peserta" style="width:100%" aria-describedby="tabel-user">
                                    <thead>
                                        <tr>
                                            <th class="sorting sorting_asc" tabindex="0">No</th>
                                            <th class="sorting" tabindex="0">No Pendaftaran</th>
                                            <th class="sorting" tabindex="0">Nama</th>
                                            <th class="sorting" tabindex="0">Wilayah</th>
                                            <th class="sorting" tabindex="0">Kelas</th>
                                            <th class="sorting" tabindex="0">Status</th>
                                            <th class="sorting" tabindex="0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
