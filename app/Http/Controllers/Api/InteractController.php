<?php

namespace App\Http\Controllers\Api;

use App\Like;
use App\Share;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InteractController extends Controller
{
    public function like(Request $request)
    {
        if ($request->type == 'ink') {
            $like = Like::where('ink_id', $request->ink_id)->where('user_id', Auth::id())->first();
            if (empty($like)) {
                $like = new Like();
                $like->user_id = Auth::id();
                $like->ink_id = $request->ink_id;
                $like->save();
                return response(['like' => $like, 'type' => true], 200);
            } else {
                $like->delete();
                $like = Like::where('ink_id', $request->ink_id);
                return response(['like' => $like->get(), 'type' => false], 200);
            }
        } else {
            $like = Like::where('comment_id', $request->comment_id)->where('user_id', Auth::id())->first();
            if (empty($like)) {
                $like = new Like();
                $like->user_id = Auth::id();
                $like->comment_id = $request->comment_id;
                $like->save();
                return response(['like' => $like, 'type' => true], 200);
            } else {
                $like->delete();
                if ($request->type == 'reply')
                    $like = Like::where('comment_id', $request->comment_id);
                $like = Like::where('comment_id', $request->comment_id);
                return response(['like' => $like->get(), 'type' => false], 200);
            }
        }
    }



    public function share(Request $request)
    {
        $share = new Share();
        $share->user_id = Auth::id();
        if (!empty($request->ink_id))
            $share->ink_id = $request->ink_id;
        else
            $share->comment_id = $request->comment_id;
        $share->save();
        return response()->json("true", 200);
    }
}
