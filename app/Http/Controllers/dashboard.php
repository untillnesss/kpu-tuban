<?php

namespace App\Http\Controllers;

class dashboard extends Controller
{
    public function index()
    {
        return role('login', 'dashboard.dashboard');
    }
}
