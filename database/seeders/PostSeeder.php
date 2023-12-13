<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Media;
use App\Models\Post;
use Faker\Factory as Faker;
use File;

class PostSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('en_US');
        $path = storage_path('app/public/post-photos');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        // Get existing users
        $users = User::all();

        // Create posts for each user
        foreach ($users as $user) {
            // Create some posts with media and some without
            $postsWithMedia = $faker->numberBetween(1, 2);
            $totalPosts = $faker->numberBetween(1, 5);

            for ($i = 0; $i < $totalPosts; $i++) {
                $post = Post::factory()->create([
                    'user_id' => $user->id,
                    'title' => $faker->sentence,
                    'body' => $faker->paragraph,
                    'location' => $faker->optional()->city,
                    // Add other attributes and their respective Faker methods
                ]);

                // Add media to some posts
                if ($postsWithMedia > 0) {
                    Media::factory()->create(['post_id' => $post->id]);
                    $postsWithMedia--;
                }
            }
        }

        $this->call(LikeSeeder::class);
        $this->call(CommentSeeder::class);
    }
}



