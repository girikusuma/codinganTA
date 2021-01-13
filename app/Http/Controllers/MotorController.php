<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MotorController extends Controller
{
    public function menu()
    {
        return view ('sepedamotor/menu');
    }
    
    public function index()
    {
        return view ('sepedamotor/index');
    }

    public function show($id)
    {
        return view('sepedamotor/detail', ['idmotor' => $id]);
    }
}
