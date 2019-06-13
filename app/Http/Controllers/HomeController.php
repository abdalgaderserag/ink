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
    private $access;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//
//        if (!Auth::check()) {
//            Auth::loginUsingId(1);
//            $user = Auth::user();
//            $this->access = $user->createToken('MyTok')->accessToken;
//        }
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$inks = Ink::all();
        //return view('home')->with('inks', $inks);
        return view('home')->with('access',Auth::user()->createToken('accc')->accessToken);
    }

    public function profile($slug = '')
    {
        if ($slug == '')
            $slug = Auth::user()->slug;
        $inks = Ink::all()->where('user_slug', $slug);
        return view('profile')->with(['inks' => $inks, 'user' => User::where('slug', $slug)->first()]);
    }
}
