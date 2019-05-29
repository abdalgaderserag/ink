<?php

namespace App\Http\Controllers;

use App\Follow;
use App\Http\Resources\Ink\FollowerToUser;
use App\Http\Resources\Ink\UserToInk;
use App\Ink;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
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
        $inks = Ink::all();
        return view('home')->with('inks', $inks);
    }

    public function profile($slug = '')
    {
        if ($slug == '')
            $slug = Auth::user()->slug;
        $inks = Ink::all()->where('user_slug', $slug);
        return view('profile')->with(['inks' => $inks,'user' => User::where('slug',$slug)->first()]);
    }
}
