<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return view('servicecentre/index');
    }

    public function location($id)
    {
        return view('servicecentre/daerah', ['daerah' => $id]);
    }

    public function show($id, $id2)
    {
        return view('servicecentre/list', ['kab' => $id2, 'prov' => $id]);
    }

    public function detail($id, $id2, $id3)
    {
        return view('servicecentre/detail', ['provinsi' => $id, 'kabupaten' => $id2, 'service' => $id3]);
    }
}
