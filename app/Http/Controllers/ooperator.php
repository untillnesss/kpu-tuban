<?php

namespace App\Http\Controllers;

class ooperator extends Controller
{
    public function index()
    {
        return role('login', 'ooperator.ooperator');
    }
}
