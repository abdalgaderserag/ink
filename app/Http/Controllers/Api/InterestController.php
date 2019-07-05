<?php

namespace App\Http\Controllers\Api;

use App\Show;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InterestController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $id = $request->id;
        $show = Show::where('owner_id', Auth::id())->where('user_slug', $request->user_slug)->first();
        if ($id === 1 or $id === 2 or $id === 3) {
            if (empty($show)) {
                $show = new  Show();
                $show->owner_id = Auth::id();
                $show->user_slug = $request->user_slug;
                if ($id === 1)
                    $show->see_first = '1';
                $show->save();
            } else if ($id === 1) {
                $show->see_first = '1';
                $show->save();
            } else if ($id === 3) {
                $show->delete();
            }
        }
        return response()->json($show, 200);
//        return response()->json('returned with status' . $request->id, 200);
    }
}
