<?php

namespace Modules\Blog\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Blog\Entities\Post;
use Modules\User\Entities\User;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //generate fake title and content
        $title = $this->faker->sentence;
        $content = collect($this->faker->paragraphs(rand(5, 15)))
            ->map(function($item){
                return "<p>$item</p>";
            })->toArray();

        $content = implode($content);

        //check if users exists
        $count_users = User::all()->count();
        if( !$count_users )
            User::factory(1)->create();
        $random_user = User::all()->random(1)->first();

        return [
            'user_id' => $random_user->id,
            'title' => $title,
            'content' => $content
        ];
    }
}
