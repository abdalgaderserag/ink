<?php

namespace App\Http\Controllers\Api;

use App\Follow;
use App\Http\Requests\InkRequest;
use App\Ink;
use App\Media;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class InkController extends Controller
{
    public function all($type = "home")
    {
//        return response('sad',200);
//        return response()->json(Ink::with('user','media','like')->get(),200);
        if ($type == "home" || $type == "search") {
//            $inks = Ink::with('user','media')->get();
            $slugs = Follow::where('follower_id', Auth::id())->get('followed_slug');
//            $slugs = new SlugsToArray($slugs);
//            $data = array();
//            $i = 0;
//            foreach ($slugs as $slug) {
//                $data[$i] = $slug['followed_slug'];
//                $i++;
//            }
            $inks = Ink::with('user', 'media', 'like')->get();
        } else if ($type == "profile") {
            $inks = Ink::where('user_slug', Auth::user()->slug)->with('user', 'media', 'like')->get();
        } else {
            $slug = $type;
            $inks = Ink::where('user_slug', $slug)->with('user', 'media', 'like')->get();
        }
//        $inks = Ink::with('user','media')->get();
        return $inks->toJson();
        return response()->json($inks, 200);
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
        //
        $ink = new Ink();
        $ink->user_slug = Auth::user()->slug;
        $ink->save();
        $media = new Media();
        $media->ink_id = $ink->id;
        if ($request->filled('text'))
            $media->text = $request->text;
        if ($request->filled('images')) {
            $images = '"[';
            foreach ($request->images as $image) {
                $images = $images . '"' . $image . '",';
            }
            $images = $images . ']"';
            $media->images = $images;
        }
        if ($request->filled('videos')){
            $videos = '"[';
            foreach ($request->videos as $video) {
                $videos = $videos . '"' . $video . '",';
            }
            $videos = $videos . ']"';
            $media->videos = $videos;
        }
        $media->save();

        $ink['media'] = $media;
        return response()->json($ink, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ink $ink
     * @return \Illuminate\Http\Response
     */
    public function show(Ink $ink)
    {
        return response($ink->comment()->with('user', 'replies.media', 'replies.like', 'replies.user', 'media', 'like')->get(), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Ink $ink
     * @return \Illuminate\Http\Response
     */
    public function update(InkRequest $request, Ink $ink)
    {
        //
        $ink->media()->text = $request->text;
        $ink->save();
        return response()->json(true, 200);
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
