<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        return view('typemotor/index');
    }

    public function show($id)
    {
        return view('typemotor/list', ['type' => $id]);
    }
}
