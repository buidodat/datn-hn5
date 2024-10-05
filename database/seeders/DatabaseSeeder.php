<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Combo;
use App\Models\ComboFood;
use App\Models\Food;
use App\Models\Movie;
use App\Models\Slideshow;
use App\Models\TypeRoom;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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

        //20 bản ghi movie và 40 bản ghi movie_version
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
            false,
            false,
            false,
            false,
            false,
        ];

        $ratings = array_column(Movie::VERSIONS, 'name');


        for ($i = 0; $i < 35; $i++) {
            $releaseDate = fake()->dateTimeBetween(now()->subMonths(5), now()->addMonths(2));
            $endDate = fake()->dateTimeBetween($releaseDate, now()->addMonths(5));
            $movie = DB::table('movies')->insertGetId([
                'name' => $name = fake()->unique()->name(),
                'slug' => Str::slug($name),
                'category' => fake()->word,
                'img_thumbnail' => $img_thumbnails[rand(0, 3)],
                'description' => Str::limit(fake()->paragraph, 250),
                'director' => fake()->name,
                'cast' => fake()->name(),
                'rating' => $ratings[rand(0, 2)],
                'duration' => fake()->numberBetween(60, 180),
                'release_date' => $releaseDate,
                'end_date' => $endDate,
                'trailer_url' => $url_youtubes[rand(0, 2)],
                'is_active' => rand(true, false),
                'is_hot' => $booleans[rand(0, 7)],
                'is_special' => $booleans[rand(0, 7)],
                'surcharge' => [10000, 20000][array_rand([10000, 20000])],

            ]);
            DB::table('movie_versions')->insert([
                'movie_id' => $movie,
                'name' => 'Vietsub'
            ]);
            DB::table('movie_versions')->insert([
                'movie_id' => $movie,
                'name' => 'Lồng Tiếng'
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
                'name' => $branch,
                'slug' => Str::slug($branch)
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
                'surcharge' => [10000, 20000][array_rand([10000, 20000])],
                'slug' => Str::slug($cinema),
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


        // Duyệt qua các rạp và tạo phòng cho mỗi rạp
        $cinemaCount = [1, 2];
        $roomsName = ['Poly Cinemas 01', 'Poly Cinemas 02', 'Poly Cinemas 03', 'Poly Cinemas 04'];

        foreach ($cinemaCount as $cinema_id) { // Duyệt qua từng rạp
            // Lấy branch_id từ cinema_id
            $branch_id = DB::table('cinemas')->where('id', $cinema_id)->value('branch_id');

            foreach ($roomsName as $room) { // Tạo phòng cho mỗi rạp
                DB::table('rooms')->insert([
                    'branch_id' => $branch_id, // Thêm branch_id vào đây
                    'cinema_id' => $cinema_id,
                    'type_room_id' => fake()->numberBetween(1, 3), // Loại phòng ngẫu nhiên
                    'name' => $room, // Tên phòng
                    'matrix_id' => 1, // Sức chứa ngẫu nhiên
                    'is_active' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }


        // Fake data Suất chiếu
        // branch , cinema , phòng, ngày, giờ
        // Duyệt qua tất cả các phòng và tạo lịch chiếu cho mỗi phòng

        $roomCount = [1, 2, 3, 4];
        foreach ($roomCount as $room_id) {
            for ($i = 0; $i < 10; $i++) { // Tạo 10 lịch chiếu cho mỗi phòng
                // Giả lập start_time
                $start_time = fake()->dateTimeBetween('now', '+1 week');

                // Lấy movie_version_id ngẫu nhiên và truy vấn lấy duration của phim, movie_id
                $movie_version_id = fake()->numberBetween(1, 40);
                $movie = DB::table('movies')
                    ->join('movie_versions', 'movies.id', '=', 'movie_versions.movie_id')
                    ->where('movie_versions.id', $movie_version_id)
                    ->select('movies.id as movie_id', 'movies.duration')
                    ->first();

                // Lấy cinema_id từ room
                $cinema = DB::table('rooms')
                    ->where('id', $room_id)
                    ->select('cinema_id')
                    ->first();

                // Lấy type_room dựa trên room_id
                $type_room = DB::table('type_rooms')
                    ->join('rooms', 'type_rooms.id', '=', 'rooms.type_room_id')
                    ->where('rooms.id', $room_id)
                    ->select('type_rooms.name')
                    ->first();

                // Lấy thông tin movie_version
                $movie_version = DB::table('movie_versions')
                    ->where('id', $movie_version_id)
                    ->select('name')
                    ->first();

                // Tạo format kết hợp giữa type_room và movie_version
                $format = $type_room->name . ' ' . $movie_version->name;

                if ($movie && $cinema) {
                    $duration = $movie->duration; // Thời lượng phim (phút)
                    $end_time = (clone $start_time)->modify("+{$duration} minutes")->modify('+15 minutes'); // Cộng thêm thời lượng phim và 15 phút vệ sinh

                    // Kiểm tra trùng thời gian với các suất chiếu khác trong cùng phòng
                    $existingShowtime = DB::table('showtimes')
                        ->where('room_id', $room_id)
                        ->where(function ($query) use ($start_time, $end_time) {
                            // Kiểm tra xem start_time hoặc end_time có nằm trong khoảng thời gian của suất chiếu nào không
                            $query->whereBetween('start_time', [$start_time->format('Y-m-d H:i'), $end_time->format('Y-m-d H:i')])
                                ->orWhereBetween('end_time', [$start_time->format('Y-m-d H:i'), $end_time->format('Y-m-d H:i')])
                                ->orWhere(function ($query) use ($start_time, $end_time) {
                                    // Kiểm tra nếu suất chiếu khác bao trùm toàn bộ khoảng thời gian
                                    $query->where('start_time', '<=', $start_time->format('Y-m-d H:i'))
                                        ->where('end_time', '>=', $end_time->format('Y-m-d H:i'));
                                });
                        })
                        ->exists();

                    if (!$existingShowtime) {
                        // Không có suất chiếu trùng, thêm mới suất chiếu
                        DB::table('showtimes')->insert([
                            'cinema_id' => $cinema->cinema_id,  // Lưu cinema_id
                            'room_id' => $room_id,
                            'format' => $format, // Format kết hợp type_room và movie_version
                            'movie_version_id' => $movie_version_id,
                            'movie_id' => $movie->movie_id,
                            'date' => $start_time->format('Y-m-d'),
                            'start_time' => $start_time->format('Y-m-d H:i'),
                            'end_time' => $end_time->format('Y-m-d H:i'),
                            'is_active' => 1,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    } else {
                        // Nếu có trùng thời gian, bỏ qua và tiếp tục vòng lặp
                        continue;
                    }
                }
            }
        }


        //3 bản ghi loại ghế
        $typeSeats = [
            ['name' => 'Ghế Thường', 'price' => 50000],
            ['name' => 'Ghế Vip', 'price' => 75000],
            ['name' => 'Ghế Đôi', 'price' => 110000],
        ];
        DB::table('type_seats')->insert($typeSeats);

        // Lấy số lượng rạp và phòng đã có
        $roomCount = DB::table('rooms')->count();

        // Tạo dữ liệu cho bảng seats
        for ($room_id = 1; $room_id <= $roomCount; $room_id++) {
            for ($y = 'A'; $y <= 'J'; $y++) { // Tạo 10 cột ghế (trục y)
                for ($x = 1; $x <= 10; $x++) { // Tạo 10 hàng ghế (trục x)
                    // for ($y = 'A'; $y <= 'J'; $y++) { // Tạo 10 cột ghế (trục y)

                    // Xác định loại ghế dựa trên hàng (y)
                    if (in_array($y, ['A', 'B', 'C', 'D', 'E'])) {
                        $type_seat_id = 1; // Ghế thường
                    } else {
                        $type_seat_id = 2; // Ghế VIP
                    }

                    DB::table('seats')->insert([
                        'room_id' => $room_id,
                        'type_seat_id' => $type_seat_id,
                        'coordinates_x' => $x,
                        'coordinates_y' => $y,
                        'name' => $y . $x,
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        // Lấy số lượng ghế và suất chiếu
        // $seatCount = DB::table('seats')->count();
        // $showtimeCount = DB::table('showtimes')->count();

        // for ($showtime_id = 1; $showtime_id <= $showtimeCount; $showtime_id++) {
        //     for ($seat_id = 1; $seat_id <= $seatCount; $seat_id++) {

        //         // Lấy thông tin ghế (type_seat_id và giá)
        //         $seat = DB::table('seats')
        //             ->join('type_seats', 'seats.type_seat_id', '=', 'type_seats.id')
        //             ->where('seats.id', $seat_id)
        //             ->select('type_seats.price as seat_price')
        //             ->first();

        //         // Lấy thông tin phòng (type_room_id và giá)
        //         $room = DB::table('rooms')
        //             ->join('type_rooms', 'rooms.type_room_id', '=', 'type_rooms.id')
        //             ->where('rooms.id', $room_id)
        //             ->select('type_rooms.surcharge as room_surcharge')
        //             ->first();

        //         // Lấy thông tin phim từ suất chiếu (movie_id và giá)
        //         $showtime = DB::table('showtimes')
        //             ->join('movies', 'showtimes.movie_id', '=', 'movies.id')
        //             ->where('showtimes.id', $showtime_id)
        //             ->select('movies.price as movie_price')
        //             ->first();

        //         // Lấy giá rạp
        //         $cinema = DB::table('showtimes')
        //             ->join('cinemas', 'showtimes.cinema_id', '=', 'cinemas.id')
        //             ->where('showtimes.id', $showtime_id)
        //             ->select('cinemas.price as cinema_price')
        //             ->first();

        //         // Tính tổng giá
        //         $totalPrice = $seat->seat_price + $room->room_surcharge + $showtime->movie_price + $cinema->cinema_price;

        //         // Thêm vào bảng seat_showtimes
        //         DB::table('seat_showtimes')->insert([
        //             'seat_id' => $seat_id,
        //             'showtime_id' => $showtime_id,
        //             'status' => 'available',
        //             'price' => $totalPrice,  // Giá tổng được tính ở trên
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ]);
        //     }
        // }
        $seatCount = DB::table('seats')->count();
        $showtimeCount = DB::table('showtimes')->count();

        for ($showtime_id = 1; $showtime_id <= $showtimeCount; $showtime_id++) {
            for ($seat_id = 1; $seat_id <= $seatCount; $seat_id++) {

                // Lấy thông tin ghế (type_seat_id và giá)
                $seat = DB::table('seats')
                    ->join('type_seats', 'seats.type_seat_id', '=', 'type_seats.id')
                    ->where('seats.id', $seat_id)
                    ->select('type_seats.price as seat_price', 'seats.room_id') // Lấy thêm room_id
                    ->first();

                if (!$seat) {
                    Log::warning("Seat not found for seat_id: $seat_id");
                    continue;  // Nếu không tìm thấy ghế, bỏ qua
                }

                // Sử dụng $seat->room_id để lấy thông tin phòng
                $room = DB::table('rooms')
                    ->join('type_rooms', 'rooms.type_room_id', '=', 'type_rooms.id')
                    ->where('rooms.id', $seat->room_id) // Sử dụng room_id từ ghế
                    ->select('type_rooms.surcharge as room_surcharge')
                    ->first();

                // Lấy thông tin phim từ suất chiếu (movie_id và giá)
                $showtime = DB::table('showtimes')
                    ->join('movies', 'showtimes.movie_id', '=', 'movies.id')
                    ->where('showtimes.id', $showtime_id)
                    ->select('movies.surcharge as movie_surcharge')
                    ->first();

                // Lấy giá rạp
                $cinema = DB::table('showtimes')
                    ->join('cinemas', 'showtimes.cinema_id', '=', 'cinemas.id')
                    ->where('showtimes.id', $showtime_id)
                    ->select('cinemas.surcharge as cinema_surcharge')
                    ->first();

                // Kiểm tra nếu bất kỳ giá trị nào là null
                if ($seat && $room && $showtime && $cinema) {
                    // Tính tổng giá
                    $totalPrice = $seat->seat_price + $room->room_surcharge + $showtime->movie_surcharge + $cinema->cinema_surcharge;

                    // Thêm vào bảng seat_showtimes
                    DB::table('seat_showtimes')->insert([
                        'seat_id' => $seat_id,
                        'showtime_id' => $showtime_id,
                        'status' => 'available',
                        'price' => $totalPrice,  // Giá tổng được tính ở trên
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    // Xử lý trường hợp không tìm thấy giá trị
                    Log::warning("Missing data for seat_id: $seat_id, showtime_id: $showtime_id");
                }
            }
        }


        //tạo 5 bản ghỉ user type admin
        $users = [
            [
                'name' => 'Trương Công Lực',
                'img_thumbnail' => 'https://scontent.fhan15-2.fna.fbcdn.net/v/t1.6435-9/120126178_348109963289562_6937582485606445898_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeHid5NvhW-nESNEUj9ywLECXaEHST7cvOBdoQdJPty84IP_DVL80XXFk3A34r6MY74TmbUrOl9cT3z_tkk8yBpH&_nc_ohc=DaV5AI-jumsQ7kNvgEJyVwd&_nc_ht=scontent.fhan15-2.fna&_nc_gid=Ab13vfocbX2Kak6-8LFNd4V&oh=00_AYAJfw8Mmq-xdk03sYw9OuLasodK7x2LrDtLynf23sQb3Q&oe=670D372A',
                'phone' => '0332293871',
                'email' => 'luctcph37171@fpt.edu.vn',
                'password' => Hash::make('luctcph37171@fpt.edu.vn'),
                'address' => ' Bích Hòa, Thanh Oai, Hà Nội',
                'gender' => 'Nữ',
                'birthday' => '2004-02-07',
                'type' => 'admin'
            ],
            [
                'name' => 'Hà Đắc Hiếu',
                'img_thumbnail' => '',
                'phone' => '0975098710',
                'email' => 'hieuhdph36384@fpt.edu.vn',
                'password' => Hash::make('hieuhdph36384@fpt.edu.vn'),
                'address' => 'Núi Trầm, Chương Mỹ, Hà Nội.',
                'gender' => 'Nam',
                'birthday' => '2004-08-08',
                'type' => 'admin'
            ],
            [
                'name' => 'Đặng Phú An',
                'img_thumbnail' => 'https://scontent.fhan15-2.fna.fbcdn.net/v/t39.30808-6/306327985_2574238996060074_6867027671439425864_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeG0pP-FGDHy0-uXweXmmsnNIMvtdjEJEpwgy-12MQkSnFPNmEsEvjbTG8ZosZJ4De8rsIMwzOpo8C5PJFBbfOTI&_nc_ohc=O_-7MtjY0RoQ7kNvgHCkypx&_nc_ht=scontent.fhan15-2.fna&oh=00_AYDA4gmkPPxZSCLKPoL2oXl6VM-acUxCebUpqQ0317MFAA&oe=66EB71AD',
                'phone' => '0378633611',
                'email' => 'andpph31859@fpt.edu.vn',
                'password' => Hash::make('andpph31859@fpt.edu.vn'),
                'address' => 'Văn Chấn, Yên Bái.',
                'gender' => 'Nam',
                'birthday' => '2004-06-06',
                'type' => 'admin'
            ],
            [
                'name' => 'An Dang Phu',
                'img_thumbnail' => 'https://scontent.fhan15-2.fna.fbcdn.net/v/t39.30808-6/306327985_2574238996060074_6867027671439425864_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeG0pP-FGDHy0-uXweXmmsnNIMvtdjEJEpwgy-12MQkSnFPNmEsEvjbTG8ZosZJ4De8rsIMwzOpo8C5PJFBbfOTI&_nc_ohc=O_-7MtjY0RoQ7kNvgHCkypx&_nc_ht=scontent.fhan15-2.fna&oh=00_AYDA4gmkPPxZSCLKPoL2oXl6VM-acUxCebUpqQ0317MFAA&oe=66EB71AD',
                'phone' => '0378633611',
                'email' => 'anpx123@gmail.com',
                'password' => Hash::make('anpx123@gmail.com'),
                'address' => 'Văn Chấn, Yên Bái.',
                'gender' => 'Nam',
                'birthday' => '2004-01-01',
                'type' => 'member'
            ],
            [
                'name' => 'Nguyễn Viết Sơn',
                'img_thumbnail' => 'https://scontent.fhan15-1.fna.fbcdn.net/v/t39.30808-6/283601921_1482562385498894_735717922201179640_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeEAlF7r3-iAR0crNJPRswHcnbI8umQnb6Wdsjy6ZCdvpQQy4yt-mXX6TisDxnCSzyG28t67CzUVAEm42R6E2k98&_nc_ohc=Qk1YWJ8PlQcQ7kNvgE2_TiU&_nc_ht=scontent.fhan15-1.fna&_nc_gid=AgWwivNA4s8Jztj4i--qQgS&oh=00_AYCadDBYztZNGM_JXjY2K59iDYOUgjjeoZI9RZ-DtOtepw&oe=66F34611',
                'phone' => '0973657594',
                'email' => 'sonnvph33874@fpt.edu.vn',
                'password' => Hash::make('sonnvph33874@fpt.edu.vn'),
                'address' => 'Núi Trầm, Chương Mỹ, Hà Nội.',
                'gender' => 'Nam',
                'birthday' => '2004-11-11',
                'type' => 'admin'
            ],
            [
                'name' => 'Bùi Đỗ Đạt',
                'img_thumbnail' => 'https://scontent.fhan5-9.fna.fbcdn.net/v/t39.30808-1/452225598_1222108569223026_3034596182689563543_n.jpg?stp=dst-jpg_s160x160&_nc_cat=109&ccb=1-7&_nc_sid=0ecb9b&_nc_eui2=AeFkL2tp4r6CfMw41hxWmmvvQn_xOwpIMg9Cf_E7CkgyD3A0v4tp7jH4tumA_mY16BYIweBTwInZHv3-ewc-Xuv1&_nc_ohc=Rb2AkaAICU4Q7kNvgGTw_W7&_nc_ht=scontent.fhan5-9.fna&_nc_gid=A11gFe0tM_BGiNtmQW9hKts&oh=00_AYCktrv7R8SZSaW_GopvP8L4DYcUTPaGcRQR2rGAN_UClg&oe=66EB6EDF',
                'phone' => '0965263725',
                'email' => 'datbdph38211@fpt.edu.vn',
                'password' => Hash::make('datbdph38211@fpt.edu.vn'),
                'address' => ' Bích Hòa, Thanh Oai, Hà Nội',
                'gender' => 'Nam',
                'birthday' => '2004-10-14',
                'type' => 'admin'
            ],
        ];
        User::insert($users);


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

        for ($i = 0; $i < 10; $i++) {
            DB::table('vouchers')->insert([
                'code' => strtoupper(Str::random(6)),
                'title' => fake()->sentence(5),
                'description' => fake()->text(255),
                'start_date_time' => Carbon::now()->subDays(rand(0, 30)),
                'end_date_time' => Carbon::now()->addDays(rand(30, 60)),
                'discount' => fake()->numberBetween(1000, 100000),
                'quantity' => fake()->numberBetween(1, 100),
                'limit' => fake()->numberBetween(1, 5),
                'is_active' => true,

            ]);
        }

        //tickets
        $showtimeIds = DB::table('showtimes')->pluck('id')->toArray();
        $movieIds = DB::table('movies')->pluck('id')->toArray();
        $paymentIds = DB::table('payments')->pluck('id')->toArray();
        $userIds = range(1, 6);

        foreach ($userIds as $userId) {
            //fake giới hạn trong 1 tháng
            $expiryDate = Carbon::now()->addMonth();

            for ($i = 0; $i < 2; $i++) {
                $ticketId = DB::table('tickets')->insertGetId([
                    'user_id' => $userId,
                    'payment_method' => fake()->randomElement(['Tiền mặt', 'Momo', 'Zalopay', 'Vnpay']),
                    'voucher_id' => null,
                    'voucher_code' => null,
                    'voucher_discount' => null,
                    'code' => fake()->regexify('[A-Za-z0-9]{10}'),
                    'total_price' => fake()->numberBetween(50, 200) * 1000,
                    'status' => fake()->randomElement(['Chờ xác nhận', 'Hoàn thành', 'Hủy']),
                    'expiry' => $expiryDate,
                    'staff' => fake()->randomElement(['admin', 'member']),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // Lấy showtime ngẫu nhiên
                $showtime_id = fake()->randomElement($showtimeIds);

                // phòng theo suaats chiếu
                $room_id = DB::table('showtimes')->where('id', $showtime_id)->value('room_id');

                // ghế theo phòng
                $seatIds = DB::table('seats')->where('room_id', $room_id)->orderBy('id')->pluck('id')->toArray();

                $seatCount = ($i == 0) ? 3 : 1;

                // Sắp xếp ghế liên tục cạnh nhau
                $startIndex = fake()->numberBetween(0, count($seatIds) - $seatCount);
                $selectedSeats = array_slice($seatIds, $startIndex, $seatCount);

                $price = fake()->numberBetween(50, 200) * 1000;

                foreach ($selectedSeats as $seatId) {
                    DB::table('ticket_seats')->insert([
                        'ticket_id' => $ticketId,
                        'showtime_id' => $showtime_id,
                        'seat_id' => $seatId,
                        'room_id' => $room_id,
                        'movie_id' => fake()->randomElement($movieIds),
                        'price' => $price,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

    }
}
