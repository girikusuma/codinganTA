<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MerekController extends Controller
{

    public function index()
    {
        return view('merekmotor/index');
    }
    
    public function show($id)
    {
        return view('merekmotor/list', ['merek' => $id]);
    }
}
