<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class apiapi extends Controller
{
    public function dologin(Request $a)
    {
        if(Auth::attempt(['email' => $a->email, 'password' => $a->pass])){
            Session::put('user', Auth::user());
            return returnjson(true);
        }
        return returnjson(false);
    }
}
