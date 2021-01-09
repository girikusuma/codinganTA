<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
        return view ('index');
    }

    public function browsing(){
        return view ('browsing');
    }
    
    public function searching(){
        return view ('searching');
    }
}
