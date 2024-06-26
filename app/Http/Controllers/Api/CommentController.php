<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Media;
use App\Http\Controllers\Controller;
use App\Notifications\CommentLiked;
use App\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  CommentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $comment = new Comment();
        if (empty($request->comment_id)) {
            $comment->ink_id = $request->ink_id;
        } else {
            $comment->comment_id = $request->comment_id;
        }
        $comment->user_id = Auth::id();
        $comment->save();
        $media = new Media();
        $media->text = $request->text;
        $media->comment_id = $comment->id;
        $media->save();
        $re = Comment::with('user', 'replies.media', 'replies.like', 'replies.user', 'media', 'like')->find($comment->id);

        return response()->json($re, 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return response()->json($comment->replies('media')->get(), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CommentRequest $request
     * @param  Media $media
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, Media $media)
    {
        $media->text = $request->text;
        $media->save();
        return response()->json($media, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @throws
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json($comment, 200);
    }
}
