<?php

namespace App\Http\Controllers\Api;

use App\Follow;
use App\Http\Requests\InkRequest;
use App\Ink;
use App\Media;
use App\Http\Controllers\Controller;
use App\Show;
use Illuminate\Support\Facades\Auth;

class InkController extends Controller
{
    public function all($type = "home")
    {
//        return response('sad',200);
//        return response()->json(Ink::with('user','media','like')->get(),200);
        if ($type == "home" || $type == "search") {
            $inks = Ink::with('user', 'media', 'like')->get();
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
        $ink = new Ink();
        $ink->user_slug = Auth::user()->slug;
        $ink->save();
        $media = new Media();
        $media->ink_id = $ink->id;
        if ($request->filled('text'))
            $media->text = $request->text;
        if ($request->filled('media') && false) {
            $media = "{";
            $i = 0;

            $path = explode('\\', storage_path());
            $string = '';
            foreach ($path as $str) {
                $string = $string . $str . '/';
            }
            $string .= 'app/';

            foreach ($request->medias as $med) {
                $media = $media . $string . $med . ',';
                $i++;
            }
            $media = $media . "}";
            if ($media === '{}')
                $media = null;
            else
                $media->media = $media;
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
//        $show = Show::where('owner_id',Auth::id())->where('user_id',$ink->user->id)->first();
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
