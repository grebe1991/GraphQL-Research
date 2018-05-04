<?php

use App\Post;
use App\User;
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
        User::truncate();
        Post::truncate();
        factory(App\User::class, 10000)->create()->each(function ($u) {
            $u->posts()->save(factory(App\Post::class)->make());
            $u->posts()->save(factory(App\Post::class)->make());
            $u->posts()->save(factory(App\Post::class)->make());
            $u->posts()->save(factory(App\Post::class)->make());
        });

    }
}
