<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Movie;
use App\Models\Slideshow;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //
        for ($i=0; $i < 5 ; $i++) {
            Slideshow::create([
                'img_thumbnail'=> 'https://media.lottecinemavn.com/Media/MovieFile//MovieImg/202408/11448_105_100001.jpg'
            ]);
        }
        $img_thumbnails = [
            'https://files.betacorp.vn/media%2fimages%2f2024%2f08%2f27%2f400x633%2D13%2D093512%2D270824%2D67.jpg',
            'https://files.betacorp.vn/media%2fimages%2f2024%2f08%2f08%2fscreenshot%2D2024%2D08%2D08%2D151702%2D151742%2D080824%2D61.png',
            'https://files.betacorp.vn/media%2fimages%2f2024%2f08%2f16%2f400x633%2D5%2D161700%2D160824%2D33.jpg',
            'https://files.betacorp.vn/media%2fimages%2f2024%2f08%2f21%2fposter%2Dhellboy%2D105547%2D210824%2D98.jpg',
        ];
        $url_youtubes = [
            'VmJ4oB3Xguo',
            'XuX2HKeMkVw',
            'SGg9DxLFCtc'
        ];
        $ratings = Movie::RATINGS;
        for ($i=0; $i < 20 ; $i++) {
            $movie = DB::table('movies')->insertGetId([
                'name' => fake()->unique()->name(),
                'slug' => fake()->slug,
                'category' => fake()->word,
                'img_thumbnail' => $img_thumbnails[rand(0,3)],
                'description' => fake()->paragraph,
                'director' => fake()->name,
                'cast' => fake()->name(),
                'rating' => $ratings[rand(0,3)],
                'duration' => fake()->numberBetween(60, 180),
                'release_date' => fake()->dateTimeBetween('2024-05-05','2024-09-09'),
                'end_date' => fake()->dateTimeBetween('2024-10-10','2024-12-29'),
                'trailer_url' => $url_youtubes[rand(0,2)],
                'is_active' => true,
                'is_hot' => false
            ]);

            DB::table('movie_languages')->insert([
                'movie_id' => $movie,
                'language' => 'Vietsub'
            ]);
            DB::table('movie_languages')->insert([
                'movie_id' => $movie,
                'language' => 'Lồng tiếng'
            ]);
        }
    }
}
