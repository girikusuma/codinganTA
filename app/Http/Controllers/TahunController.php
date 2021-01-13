<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TahunController extends Controller
{
    
    public function index()
    {
        return view('tahunproduksi/index');
    }

    public function show($id)
    {
        return view('tahunproduksi/list', ['tahun' => $id]);
    }
}
