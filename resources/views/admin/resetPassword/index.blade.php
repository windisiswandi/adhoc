@extends('admin.master')

@section('title','Update Password')
@section('layout','Update Password')
@section('menuUpdatePassword','active')
@section('parent','Password')
@section('child','Update')

@section('jsTambahan')
<script src="{{ asset('js/SweatAlert/sweetalert2@10.js') }}"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">Update Password</h3>
            </div>
        <form class="form-horizontal" method="POST" action="{{ route('update.Store.Password') }}">
            @csrf
        <div class="card-body">

            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Password Lama</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" name="oldpassword" placeholder="Password Lama">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Password Baru</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" name="password" placeholder="Password Baru">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Konfirmasi Password Baru</label>
                <div class="col-sm-10">
                <input type="password" name="password_confirmation" id="password_confirm" class="form-control" placeholder="Konfirmasi Ulang Password Baru">
                </div>
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info">Submit</button>
        </div>
        </form>
        </div>

    </div>
</div>
@endsection
