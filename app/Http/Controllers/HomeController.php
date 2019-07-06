<?php

namespace App\Http\Controllers;

use App\Follow;
use App\Show;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $access;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $fo = Follow::find(10);
//        return $fo->follower->slug;
//        return $shows = Auth::user()->show()->with('inks.media')->get();
        return view('home')->with(['access' => Auth::user()->createToken('home')->accessToken]);
    }

    public function search()
    {
        return view('search')->with('access', Auth::user()->createToken('search')->accessToken);
    }
}
