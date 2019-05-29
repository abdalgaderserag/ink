<?php

namespace App\Http\Resources\Ink;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FollowerToUser extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $i = 0;
        $send = array();
        foreach ($this->collection as $comment) {
            $send[$i] = [
                'id' => $comment->id,
            ];
            $i++;
        }
        return $send;
    }
}
