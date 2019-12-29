<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class login extends Controller
{
    public function index()
    {
        return role('guest','login.login');
    }

    public function dologout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}
