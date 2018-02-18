<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    //
    public function index()
    {
        $s = "bhodro chele";
        return view('home')->with('msg',$s);
    }
    
}

?>