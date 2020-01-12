<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class calon extends Controller
{
    public function index()
    {
        return role('login', 'calon.calon');
    }
}
