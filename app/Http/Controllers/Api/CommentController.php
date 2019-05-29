<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $comment = new Comment();
        $comment->ink_id = $request->ink_id;
        $comment->media()->text = $request->text;
        $comment->save();
        return response()->json($comment, 200);
    }

//
//    public function storeReply(Request $request)
//    {
//        //
//        $comment = new Comment();
//        $comment->comment_id = $request->comment_id;
//        $comment->media()->text = $request->text;
//        $comment->save();
//        return response()->json($comment);
//    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
        return response()->json($comment->replies()->get(), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
        $comment->media()->text = $request->text;
        $comment->save();
        return response()->json($comment, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
        $comment->delete();
        return response()->json($comment, 200);
    }
}
