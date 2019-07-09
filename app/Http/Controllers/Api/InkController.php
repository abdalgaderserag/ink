<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\InkRequest;
use App\Ink;
use App\Follow;
use App\Media;
use App\Http\Controllers\Controller;
use App\Show;
use Illuminate\Support\Facades\Auth;

class InkController extends Controller
{
    public function all($type = "home")
    {
        if ($type == "home" || $type == "search") {
            $inks = Ink::with('user', 'media', 'like')->get();
        } else if ($type == "profile") {
            $inks = Ink::where('user_slug', Auth::user()->slug)->with('user', 'media', 'like')->get();
        } else {
            $slug = $type;
            $inks = Ink::where('user_slug', $slug)->with('user', 'media', 'like')->get();
        }
        return $inks->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(Ink::where('user_slug', Auth::user()->slug), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(InkRequest $request)
    {
        $ink = new Ink();
        $ink->user_slug = Auth::user()->slug;
        $ink->save();
        $media = new Media();
        $media->ink_id = $ink->id;
        if (!empty($request->text))
            $media->text = $request->text;
        /*
        if (!empty($request->media)) {
            $media = "{";
            $i = 0;
//


            foreach ($request->media as $med) {
                $media = $media .'"'. $med . '",';
                $i++;
            }
            $media = $media . "}";


//            if ($media)
//                $media = null;
            $media->media = $media;

        }
        */
        foreach ($request->media as $g) {
            $media->media = $media->media . $g . ',';
        }
        $media->save();

        $ink = Ink::find($ink->id)->with('user', 'media', 'like')->get();

        return response()->json($ink->last(), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ink $ink
     * @return \Illuminate\Http\Response
     */
    public function show(Ink $ink)
    {
//        TODO unComment this
//        $show = Show::where('owner_id',Auth::id())->where('user_slug',$ink->user->slug)->first();
//        $show->score = $show->score + config('ink.rank.scores.view');
//        $show->save();
        return response($ink->comment()->with('user', 'replies.media', 'replies.like', 'replies.user', 'media', 'like')->get(), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Media $media
     * @return \Illuminate\Http\Response
     */
    public function update(InkRequest $request, Media $media)
    {
        //
        $media->text = $request->text;
        $media->save();
        return response()->json($media, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ink $ink
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ink $ink)
    {
        //
        $ink->media()->delete();
        $ink->delete();
        return response()->json($ink, 200);
    }
}
