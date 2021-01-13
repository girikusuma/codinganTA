<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransmisiController extends Controller
{
    
    public function index()
    {
        return view('transmisi/index');
    }

    public function show($id)
    {
        return view('transmisi/list', ['transmisi' => $id]);
    }
}
