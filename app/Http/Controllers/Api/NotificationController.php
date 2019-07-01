<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Return all the notifications for the current user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Auth::user()->notifications;
        return response()->json($data,200);
    }

    /**
     * Mark all the unread notifications as read.
     *
     * @return \Illuminate\Http\Response
     */
    public function markAllAsRead()
    {
        foreach (Auth::user()->unreadNotifications as $notification){
            $notification->markAsRead();
        }
        return response()->json('OK',200);
    }

    /**
     * Mark single (selected) notification as read.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function markAsRead($id)
    {
        foreach (Auth::user()->unreadNotifications as $notification){
            if ($notification->id == $id){
                $notification->markAsRead();
            }
        }
        return response()->json($id,200);
    }

    /**
     * Delete all the read notification for the current user.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAllRead()
    {
        foreach (Auth::user()->readNotifications() as $notification){
            $notification->delete();
        }
        return response()->json('OK',200);
    }

}
