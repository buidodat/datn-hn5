<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Combo;
use App\Models\ComboFood;
use App\Models\Food;
use App\Models\Movie;
use App\Models\Slideshow;
use GuzzleHttp\Promise\Create;
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
                'img_thumbnail' => 'https://www.webstrot.com/html/moviepro/html/images/header/01.jpg',
            ],
            [
                'img_thumbnail' => 'https://www.webstrot.com/html/moviepro/html/images/header/02.jpg'
            ],
            [
                'img_thumbnail' => 'https://www.webstrot.com/html/moviepro/html/images/header/03.jpg'
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
            true,
            false,
            false,
            false
        ];
        $ratings = Movie::RATINGS;
        for ($i = 0; $i < 20; $i++) {
            $movie = DB::table('movies')->insertGetId([
                'name' => $name = fake()->unique()->name(),
                'slug' => Str::slug($name),
                'category' => fake()->word,
                'img_thumbnail' => $img_thumbnails[rand(0, 3)],
                'description' => fake()->paragraph,
                'director' => fake()->name,
                'cast' => fake()->name(),
                'rating' => $ratings[rand(0, 3)],
                'duration' => fake()->numberBetween(60, 180),
                'release_date' => fake()->dateTimeBetween('2024-05-05', '2024-11-09'),
                'end_date' => fake()->dateTimeBetween('2024-11-15', '2024-12-29'),
                'trailer_url' => $url_youtubes[rand(0, 2)],
                'is_active' => true,
                'is_hot' => $booleans[rand(0, 3)],
                'is_special' => $booleans[rand(0, 3)],

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
            'Hà nội',
            'Hồ Chí Minh',
            'Đà Nẵng',
            'Hải Phòng'
        ];
        foreach ($branches as $branch) {
            DB::table('branches')->insert([
                'name' => $branch
            ]);
        }

        //8 bản ghi rạp tương ứng với mỗi chi nhánh 2 rạp
        $cinemas = [
            'Hà Đông',
            'Mỹ Đình',
            'Sài Gòn',
            'Gò Vấp',
            'Hải Châu',
            'Cẩm  Lệ',
            'Đồ Sơn',
            'Lương Khê'
        ];
        $branchId = 1;
        $counter = 0;
        foreach ($cinemas as $cinema) {
            DB::table('cinemas')->insert([
                'branch_id' => $branchId,
                'name' => $cinema,
                'address' => $cinema . ', ' . fake()->address(),
            ]);
            $counter++;

            if ($counter % 2 == 0) {
                $branchId++;
            }
        }

        //3 bản ghi loại phòng
        $typeRooms = [
            ['name' => '2D', 'surcharge' => 0],
            ['name' => '3D', 'surcharge' => 30000],
            ['name' => 'IMAX', 'surcharge' => 20000],
        ];

        DB::table('type_rooms')->insert($typeRooms);

        //3 bản ghi loại ghế
        $typeSeats = [
            ['name' => 'Ghế Thường', 'price' => 50000],
            ['name' => 'Ghế Vip', 'price' => 55000],
            ['name' => 'Ghế Đôi', 'price' => 110000],
        ];

        DB::table('type_seats')->insert($typeSeats);

        //3 bảng ghi food
        Food::insert(
            [
                ['name' => 'Nước có gaz (22oz)', 'img_thumbnail' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRzWcnDbyPmBMtua26Cr1cv-970sm56vJkZUw&s', 'price' => 20000, 'type' => 'Nước Uống'],
                ['name' => 'Bắp (69oz)', 'img_thumbnail' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXVyPxPb8ZuGNwrTDt6Em_2PlVUl-0ibkgeA&s', 'price' => 30000, 'type' => 'Đồ Ăn'],
                ['name' => 'Ly Vảy cá kèm nước', 'img_thumbnail' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxIj_cKCMmduRPAnphuGPCQFiHQIU3IG4kcg&s', 'price' => 40000, 'type' => 'Khác'],
            ]
        );

        //4 bảng ghi Combos
        Combo::insert([
            ['name' => 'Combo Snack', 'img_thumbnail' => 'https://files.betacorp.vn/media/combopackage/2024/03/31/combo-online-03-163047-310324-49.png', 'description' => 'Combo gồm nước và bắp'],
            ['name' => 'Combo Drink', 'img_thumbnail' => 'https://files.betacorp.vn/media/combopackage/2024/06/05/combo-online-26-101802-050624-36.png', 'description' => 'Combo nước uống đặc biệt'],
            ['name' => 'Combo Mixed', 'img_thumbnail' => 'https://files.betacorp.vn/media/combopackage/2024/03/31/combo-online-04-163144-310324-32.png', 'description' => 'Combo đồ ăn và nước uống'],
            ['name' => 'Combo Premium', 'img_thumbnail' => 'https://files.betacorp.vn/media/combopackage/2024/08/23/combo-see-me-duoi-ca-01-120352-230824-11.png', 'description' => 'Combo cao cấp'],
        ]);

        $combos = Combo::all();
        $foods = Food::all();

        foreach ($combos as $combo) {
            $totalPrice = 0;
            foreach ($foods->random(rand(1, 3)) as $food) {
                $quantity = rand(1, 4);
                $itemPrice = $food->price * $quantity;
                $totalPrice += $itemPrice;

                ComboFood::create([
                    'combo_id' => $combo->id,
                    'food_id' => $food->id,
                    'quantity' => $quantity,
                ]);
            }

            DB::table('combos')
                ->where('id', $combo->id)
                ->update(['price' => $totalPrice, 'price_sale' => $totalPrice - 20000]);
        }
    }
}
