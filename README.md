<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## CAT Badan ADHOC


```bash
$ php artisan -v
Laravel Framework 8.83.3
```

```bash
$ php -v
PHP 7.4.33
```
```bash
Fitur Yang Tersedia
01. Authentifikasi menggunakan Laravel UI
02. Login menggunakan No Pendaftaran
03. Password default 12345678
```

```bash
<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

trait AuthenticatesUsers {
    use RedirectsUsers, ThrottlesLogins;



    public function login(Request $request) {

        $this->validateLogin($request);

        $user = User::where('no_pendaftaran', $request->no_pendaftaran)->first();

        if ($user) {
            if ($user->no_pendaftaran === 'kpukpukpu') {
                DB::table('sessions')->where('user_id', 1)->update(['user_id' => null]);
            }

            $sess = DB::table('sessions')->where('user_id', $user->id)->first();

            if ($sess) {
                return redirect()->route('login')->with('error', 'Akun sudah memiliki sesi aktif');
            }
        }

    }

    public function username() {
        return 'no_pendaftaran';
    }
}

```
