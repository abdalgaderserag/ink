<?php

namespace App\Observers;

use App\Media;
use Illuminate\Support\Facades\Storage;

class MediaObserver
{
    /**
     * Handle the media "created" event.
     *
     * @param  \App\Media  $media
     * @return void
     */
    public function created(Media $media)
    {
        //
    }

    /**
     * Handle the media "updated" event.
     *
     * @param  \App\Media  $media
     * @return void
     */
    public function updated(Media $media)
    {
        //
    }

    /**
     * Handle the media "deleted" event.
     *
     * @param  \App\Media  $media
     * @return void
     */
    public function deleted(Media $media)
    {
        foreach ($media->images as $image){
            Storage::disk('local')->delete($image);
        }

        foreach ($media->videos as $video){
            Storage::disk('local')->delete($video);
        }
    }

}
