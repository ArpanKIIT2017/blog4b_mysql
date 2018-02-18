<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Likes;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->guest())
            return view('home');
        else
            return redirect('userDash');
    }

    public function indexAuth()
    {
        $user_id = auth()->user()->id;
        $user=User::find($user_id);
        
        return view('dashboard')->with('posts',$user->posts);
        
        //return view('dashboard')->with('posts',$posts);
    }
}
