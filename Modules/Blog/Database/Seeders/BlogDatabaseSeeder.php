<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Modules\Blog\Entities\Comment;
use Modules\Blog\Entities\Post;
use Modules\User\Entities\User;

class BlogDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //Instantiate the Faker Factory
        $faker = \Faker\Factory::create();

        //check if users exists
        $count_users = User::all()->count();
        if( !$count_users )
            User::factory(1)->create();
        $random_user = User::all()->random(1)->first();

        //create 2 comments per post
        Post::factory(2)->create();
        foreach(Post::all() as $post){ // loop through all posts
            for($i = 0; $i < 2; $i++) {
                $comment = $faker->sentence;
                // Insert random comments
                Comment::insert([
                    'post_id' => $post->id,
                    'user_id' => $random_user->id,
                    'comment' => $comment,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);
            }
        }
    }
}
