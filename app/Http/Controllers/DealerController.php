<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DealerController extends Controller
{
    public function index()
    {
        return view('dealer/index');
    }

    public function location($id)
    {
        return view('dealer/daerah', ['daerah' => $id]);
    }

    public function show($id, $id2)
    {
        return view('dealer/list', ['kab' => $id2, 'prov' => $id]);
    }

    public function detail($id, $id2, $id3)
    {
        return view('dealer/detail', ['provinsi' => $id, 'kabupaten' => $id2, 'dealer' => $id3]);
    }
}