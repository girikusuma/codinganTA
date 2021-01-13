<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VolumeController extends Controller
{
    
    public function index()
    {
        return view('volumesilinder/index');
    }

    public function show($id)
    {
        return view('volumesilinder/list', ['volume' => $id]);
    }
}
