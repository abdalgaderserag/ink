<?php

namespace App\Http\Controllers\Api;

use App\Follow;
use App\Http\Resources\ShowCollection;
use App\Ink;
use App\Http\Controllers\Controller;
use App\Show;
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
        if ($type == "home" || $type == "search") {
            $shows = Auth::user()->show;
//        TODO : get the new first
            return response()->json(new ShowCollection($shows->sortBy('score')), 200);
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
