<?php

namespace App\Http\Controllers\Api;

use App\Follow;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $follow = Follow::where('follower_id', $request->id)->where('followed_slug', Auth::user()->slug)->first();
        if (empty($follow)) {
            $follow = new Follow();
            $follow->follower_id = $request->id;
            $follow->followed_slug = Auth::user()->slug;
            $follow->save();
            return response(true, 200);
        } else {
            $follow->delete();
            return response(false, 200);
        }
    }
}
