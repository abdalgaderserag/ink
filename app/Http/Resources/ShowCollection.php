<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

class ShowCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $index = 0;
        $inks = array();
        foreach ($this->collection as $show) {
            foreach ($show->user->ink as $ink) {
                $inks[$index] = $ink;
                $index++;
            }
        }

        foreach (Auth::user()->ink as $ink) {
            $inks[$index] = $ink;
            $index++;
        }
        $inks = collect($inks);
        return $inks;
    }
}
