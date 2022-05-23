<?php

use App\Model\Post;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;
use App\Model\Category;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 30; $i++) {
            $newPost = new Post();
            $newPost->user_id = User::inRandomOrder()->first()->id;
            $newPost->category_id = Category::inRandomOrder()->first()->id;
            $newPost->title = $faker->sentence(3, true);
            $newPost->content = $faker->paragraph(5,true);
            $newPost->slug = Str::slug($newPost->title . '-' . $i);
            $newPost->save();
        }
    }
}
