<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        factory(App\User::class, 5)->create()->each(function ($u) {
            $fo = factory(App\Follow::class)->make();
            $fo->follower_id = 1;
            $fo->followed_slug = $u->slug;
            $fo->save();
            $i = factory(App\Ink::class)->make();
            $i->user_slug = $u->slug;
            $i->save();
            $sh = factory(App\Share::class)->make();
            $sh->user_id = $u->id;
            if ($i->id != 5)
                $sh->ink_id = $i->id + 1;
            else
                $sh->ink_id = 1;
            $sh->save();
            for ($t = 0; $t < random_int(0, 26); $t++) {
                $l = factory(App\Like::class)->make();
                $l->ink_id = $i->id;
                $l->save();
            }
            $me = factory(App\Media::class)->make();
            $me->ink_id = $i->id;
            $me->save();
            for ($t = 0; $t < random_int(0, 5); $t++) {
                $c = factory(\App\Comment::class)->make();
                $c->ink_id = $i->id;
                $c->user_id = $u->id;
                $c->save();
                $me = factory(App\Media::class)->make();
                $me->comment_id = $c->id;
                $me->save();
            }
        });
    }
}
