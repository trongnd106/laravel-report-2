<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DevController extends Controller
{
    public function create()
    {
        return view('dev.create');
    }
}
