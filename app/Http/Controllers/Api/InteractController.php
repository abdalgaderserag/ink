<?php

namespace App\Http\Controllers\Api;

use App\Like;
use App\Share;
use App\Traites\LikeNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InteractController extends Controller
{
    use LikeNotification;

    public function like(Request $request)
    {
        if ($request->type == 'ink') {
            $like = Like::where('ink_id', $request->ink_id)->where('user_id', Auth::id())->first();
            if (empty($like)) {
                $like = new Like();
                $like->user_id = Auth::id();
                $like->ink_id = $request->ink_id;
                $like->save();
                $this->notifyInkLiked($request->ink_id);
                return response(['like' => $like, 'type' => true], 200);
            } else {
                $like->delete();
                $like = Like::where('ink_id', $request->ink_id);
                $this->notifyInkDisliked($request->ink_id);
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
