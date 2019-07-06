<?php

namespace App\Http\Controllers\Api;

use App\Follow;
use App\Ink;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Inks extends Controller
{
    /**
     * Handle the incoming request.
     *
     *
     * @param $type
     * @return \Illuminate\Http\Response
     */
    public function __invoke($type)
    {
        $shows = Auth::user()->show()->with('inks.media');
        //        return response('sad',200);
//        return response()->json(Ink::with('user','media','like')->get(),200);
        if ($type == "home" || $type == "search") {
            $inks = Ink::with('user', 'media', 'like')->get();
            $slugs = Follow::where('follower_id', Auth::id())->get('followed_slug');
            $inks = Ink::with('user', 'media', 'like')->get();
        } else if ($type == "profile") {
            $inks = Ink::where('user_slug', Auth::user()->slug)->with('user', 'media', 'like')->get();
        } else {
            $slug = $type;
            $inks = Ink::where('user_slug', $slug)->with('user', 'media', 'like')->get();
        }
//        return $inks->toJson();
        return response()->json($inks, 200);
    }
}
