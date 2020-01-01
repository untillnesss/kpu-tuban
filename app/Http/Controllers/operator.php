<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\toperator;
use Hash;

class operator extends Controller
{
    public function index()
    {
        return role('login', 'operator.operator');
    }
}
