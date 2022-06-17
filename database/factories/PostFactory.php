<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'post_id'=>
                $this->rand(0,count(Post::all()))
                ,
            'user_id'=>$this->faker->numberBetween($min = 1, $max = count(User::all())),
            'content'=>$this->faker->text,
            'has_img'=>$this->faker->boolean($chanceOfGettingTrue = 20),
            'created_at'=>$this->faker->unixtime()
        ];
    }

    public function rand($min,$max){
        $random_number = rand($min,$max);
        if($random_number <= 10 && !Post::find($random_number)){
            return null;
        }
        return $random_number;
    }
}
