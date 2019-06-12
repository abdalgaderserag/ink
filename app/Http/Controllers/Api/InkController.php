<?php

namespace App\Http\Controllers\Api;

use App\Ink;
use App\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InkController extends Controller
{
    public function all($type = "home")
    {
        return response()->json(Ink::with('user','media','like')->get(),200);
        if ($type == "home") {
//            $inks = Ink::with('user','media')->get();
            $slugs = DB::table('follows')->where('followed_id',Auth::id())->get('follower_id');
            $inks = Ink::with('user','media','like')->whereIn('user_slug',$slugs)->get();
        }
        else if ($type == "profile"){
            $inks = Ink::where('user_slug', Auth::user()->slug)->with('user','media')->get();
        }
        else{
            $slug = explode('/',$type);
            $inks = Ink::where('user_slug', $slug[1])->with('user','media')->get();
        }
//        $inks = Ink::with('user','media')->get();
        return response()->json($inks,200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json('sad',200);
        return response()->json(Ink::where('user_slug',Auth::user()->slug),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $ink = new Ink();
        $ink->user_slug = Auth::user()->slug;
        $ink->save();
        $media = new Media();
        $media->ink_id = $ink->id;
        $media->text = $request->text;
        $media->save();
        return response()->json($ink,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ink  $ink
     * @return \Illuminate\Http\Response
     */
    public function show(Ink $ink)
    {
        return response($ink->comment()->with('user','replies.media','replies.likes', 'replies.user','media','like')->get(),200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ink  $ink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ink $ink)
    {
        //
        $ink->media()->text = $request->text;
        $ink->save();
        return response()->json(true,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ink  $ink
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ink $ink)
    {
        //
        $ink->media()->delete();
        $ink->delete();
        return response()->json($ink,200);
    }
}
