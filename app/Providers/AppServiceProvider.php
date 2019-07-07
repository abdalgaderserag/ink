<?php

namespace App\Providers;

use App\Comment;
use App\Follow;
use App\Ink;
use App\Like;
use App\Media;
use App\Observers\CommentObserver;
use App\Observers\FollowObserver;
use App\Observers\LikeObserver;
use App\Observers\MediaObserver;
use App\Observers\UserObserver;
use App\User;
use Illuminate\Support\facades\schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        schema::defaultStringLength(191);

        Comment::observe(CommentObserver::class);
//        Follow::observe(FollowObserver::class);
//        Ink::observe(FollowObserver::class);
//        Like::observe(LikeObserver::class);
//        Media::observe(MediaObserver::class);
//        User::observe(UserObserver::class);111
    }
}
