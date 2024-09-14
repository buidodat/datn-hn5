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

        //3 bản ghi slideshow

            Slideshow::insert([
                [
                    'img_thumbnail'=> 'https://www.webstrot.com/html/moviepro/html/images/header/01.jpg',
                ],[
                    'img_thumbnail'=> 'https://www.webstrot.com/html/moviepro/html/images/header/02.jpg'
                ]
                ,[
                    'img_thumbnail'=> 'https://www.webstrot.com/html/moviepro/html/images/header/03.jpg'
                ]
            ]);

        //20 bản ghi movie và 40 bản ghi movie_language
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
        $booleans = [
            true,false,false,false
        ];
        $ratings = Movie::RATINGS;
        for ($i=0; $i < 20 ; $i++) {
            $movie = DB::table('movies')->insertGetId([
                'name' => $name = fake()->unique()->name(),
                'slug' => Str::slug($name),
                'category' => fake()->word,
                'img_thumbnail' => $img_thumbnails[rand(0,3)],
                'description' => fake()->paragraph,
                'director' => fake()->name,
                'cast' => fake()->name(),
                'rating' => $ratings[rand(0,3)],
                'duration' => fake()->numberBetween(60, 180),
                'release_date' => fake()->dateTimeBetween('2024-05-05','2024-11-09'),
                'end_date' => fake()->dateTimeBetween('2024-11-15','2024-12-29'),
                'trailer_url' => $url_youtubes[rand(0,2)],
                'is_active' => true,
                'is_hot' => $booleans[rand(0,3)],
                'is_special' => $booleans[rand(0,3)],

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

        //4 bản ghi chi nhánh
        $branches = [
           'Hà nội','Hồ Chí Minh','Đà Nẵng','Hải Phòng'
        ];
        foreach ($branches as $branch) {
            DB::table('branches')->insert([
                'name'=>$branch
            ]);
        }

        //8 bản ghi rạp tương ứng với mỗi chi nhánh 2 rạp
        $cinemas = [
            'Hà Đông','Mỹ Đình', 'Sài Gòn', 'Gò Vấp', 'Hải Châu','Cẩm  Lệ','Đồ Sơn','Lương Khê'
        ];
        $branchId = 1;
        $counter = 0;
        foreach ($cinemas as $cinema) {
            DB::table('cinemas')->insert([
                'branch_id' => $branchId,
                'name'=>$cinema,
                'address'=> $cinema . ', ' . fake()->address(),
            ]);
            $counter++;

            if ($counter % 2 == 0) {
                $branchId++;
            }
        }

        //3 bản ghi loại phòng
        $typeRooms = [
            ['name'=>'2D','surcharge'=> 0],
            ['name'=>'3D','surcharge'=> 30000],
            ['name'=>'IMAX','surcharge'=> 20000],
        ];

        DB::table('type_rooms')->insert($typeRooms);

         //3 bản ghi loại ghế
         $typeSeats = [
            ['name'=>'Ghế Thường','price'=> 50000],
            ['name'=>'Ghế Vip','price'=> 55000],
            ['name'=>'Ghế Đôi','price'=> 110000],
        ];

        DB::table('type_seats')->insert($typeSeats);




    }
}
