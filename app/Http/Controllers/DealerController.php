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
        return view('dealer/list', ['lokasi' => $id2]);
    }
}
