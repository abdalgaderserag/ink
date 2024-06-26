<?php

namespace App\Http\Controllers\Api;

use App\Follow;
use App\Http\Controllers\Controller;
use App\Notifications\NewFollower;
use App\Observers\FollowObserver;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{

    public function __construct()
    {
        Follow::observe(FollowObserver::class);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $follow = Follow::where('follower_id', $request->id)->where('followed_slug', Auth::user()->slug)->first();
        $user = User::find($request->id);
        if (empty($follow)) {
            $follow = new Follow();
            $follow->follower_id = $request->id;
            $follow->followed_slug = Auth::user()->slug;
            $follow->save();
            $user->notify(new NewFollower(Auth::user()->slug));
            return response(1, 200);
        } else {
            $follow->delete();
            $note = $user->notifications->where('type', 'App\Notifications\NewFollower')->where('notifiable_id', $user->id)->first();
            $note->delete();
            return response(0, 200);
        }
    }
}
