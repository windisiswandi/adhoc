<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
// use Illuminate\Cache;
// use Cache;
use Carbon\Carbon;

class LogController extends Controller {

    public function __construct() {
        $this->middleware(['auth','statusAdminCat']);
    }

    public function index() {

        $users = User::all();
        return view('ppk.log.index',[
            'users' => $users
        ]);

    }
}
