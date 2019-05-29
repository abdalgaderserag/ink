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
        $check = '';
        if ($request->ink_id)
            $check = Like::all()->where('user_id', Auth::id())->where('ink_id', $request->ink_id);
        if ($request->comment_id)
            $check = Like::all()->where('user_id', Auth::id())->where('ink_id', $request->comment_id);
        if (!empty($check)) {
            return response("false");
            $check->delete();
            return response("false");
        } else {
            $like = new Like();
            $like->user_id = Auth::id();
            if (!empty($request->ink_id))
                $like->ink_id = $request->ink_id;
            if (!empty($request->comment_id))
                $like->comment_id = $request->comment_id;
            $like->save();
            return response("true");
        }
    }

    public function likeCheck(Request $request)
    {
        $check = '';
        if ($request->ink_id)
            $check = Like::all()->where('user_id', Auth::id())->where('ink_id', $request->ink_id);
        if ($request->comment_id)
            $check = Like::all()->where('user_id', Auth::id())->where('ink_id', $request->comment_id);
        if (empty($check))
            return response("true");
        return response("false");
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
        return true;
    }
}
