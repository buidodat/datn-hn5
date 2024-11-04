<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Combo;
use App\Models\ComboFood;
use App\Models\Food;
use App\Models\Membership;
use App\Models\Movie;
use App\Models\SeatTemplate;
use App\Models\Slideshow;
use App\Models\TypeRoom;
use App\Models\User;
use App\Models\Post;
use App\Models\Rank;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
                'name' => 'Phụ Đề'
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
            ['name' => 'IMAX', 'surcharge' => 50000]
        ];
        DB::table('type_rooms')->insert($typeRooms);


        // Duyệt qua các rạp và tạo phòng cho mỗi rạp
        $cinemaCount = [1, 2];
        $roomsName = ['P201', 'L202', 'P303', 'P404'];

        // Tạo template ghế
        $seatTemplate = SeatTemplate::create([
            'name' => 'Template standard',
            'description' => 'Mẫu sơ đồ ghế tiêu chuẩn gồm 4 hàng ghế thường , 6 hàng ghế vip, 2 hàng ghế đôi',
            'matrix_id' => 1, // ID matrix ví dụ
            'seat_structure' => json_encode($this->generateSeatStructure()), // Cấu trúc ghế
            'is_publish' => 1, // Đã publish
            'is_active' => 1, // Đang hoạt động
        ]);

        foreach ($cinemaCount as $cinema_id) { // Duyệt qua từng rạp
            // Lấy branch_id từ cinema_id
            $branch_id = DB::table('cinemas')->where('id', $cinema_id)->value('branch_id');

            foreach ($roomsName as $room) { // Tạo phòng cho mỗi rạp
                $roomId = DB::table('rooms')->insertGetId([
                    'branch_id' => $branch_id,
                    'cinema_id' => $cinema_id,
                    'type_room_id' => fake()->numberBetween(1, 3), // Loại phòng ngẫu nhiên
                    'name' => $room, // Tên phòng
                    'seat_template_id' => $seatTemplate->id, // ID template ghế vừa tạo
                    'is_active' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Lấy cấu trúc ghế từ seat_template
                $seatStructure = json_decode($seatTemplate->seat_structure, true);

                $dataSeats = []; // Mảng lưu trữ ghế
                foreach ($seatStructure as $seat) {
                    $name = $seat['coordinates_y'] . $seat['coordinates_x'];

                    // Nếu là ghế đôi thì thêm tên ghế thứ hai
                    if ($seat['type_seat_id'] == 3) {
                        $name .= ' ' . $seat['coordinates_y'] . ($seat['coordinates_x'] + 1);
                    }

                    $dataSeats[] = [
                        'coordinates_x' => $seat['coordinates_x'],
                        'coordinates_y' => $seat['coordinates_y'],
                        'name' => $name,
                        'type_seat_id' => $seat['type_seat_id'],
                        'room_id' => $roomId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                // Chèn tất cả ghế vào bảng seats
                DB::table('seats')->insert($dataSeats);
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
        // for ($room_id = 1; $room_id <= $roomCount; $room_id++) {
        //     for ($y = 'A'; $y <= 'J'; $y++) { // Tạo 10 cột ghế (trục y)
        //         for ($x = 1; $x <= 10; $x++) { // Tạo 10 hàng ghế (trục x)
        //             // for ($y = 'A'; $y <= 'J'; $y++) { // Tạo 10 cột ghế (trục y)

        //             // Xác định loại ghế dựa trên hàng (y)
        //             if (in_array($y, ['A', 'B', 'C', 'D', 'E'])) {
        //                 $type_seat_id = 1; // Ghế thường
        //             } else {
        //                 $type_seat_id = 2; // Ghế VIP
        //             }

        //             DB::table('seats')->insert([
        //                 'room_id' => $room_id,
        //                 'type_seat_id' => $type_seat_id,
        //                 'coordinates_x' => $x,
        //                 'coordinates_y' => $y,
        //                 'name' => $y . $x,
        //                 'is_active' => 1,
        //                 'created_at' => now(),
        //                 'updated_at' => now(),
        //             ]);
        //         }
        //     }
        // }

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
        // $seatCount = DB::table('seats')->count();
        // $showtimeCount = DB::table('showtimes')->count();

        // for ($showtime_id = 1; $showtime_id <= $showtimeCount; $showtime_id++) {
        //     for ($seat_id = 1; $seat_id <= $seatCount; $seat_id++) {

        //         // Lấy thông tin ghế (type_seat_id và giá)
        //         $seat = DB::table('seats')
        //             ->join('type_seats', 'seats.type_seat_id', '=', 'type_seats.id')
        //             ->where('seats.id', $seat_id)
        //             ->select('type_seats.price as seat_price', 'seats.room_id') // Lấy thêm room_id
        //             ->first();

        //         if (!$seat) {
        //             Log::warning("Seat not found for seat_id: $seat_id");
        //             continue;  // Nếu không tìm thấy ghế, bỏ qua
        //         }

        //         // Sử dụng $seat->room_id để lấy thông tin phòng
        //         $room = DB::table('rooms')
        //             ->join('type_rooms', 'rooms.type_room_id', '=', 'type_rooms.id')
        //             ->where('rooms.id', $seat->room_id) // Sử dụng room_id từ ghế
        //             ->select('type_rooms.surcharge as room_surcharge')
        //             ->first();

        //         // Lấy thông tin phim từ suất chiếu (movie_id và giá)
        //         $showtime = DB::table('showtimes')
        //             ->join('movies', 'showtimes.movie_id', '=', 'movies.id')
        //             ->where('showtimes.id', $showtime_id)
        //             ->select('movies.surcharge as movie_surcharge')
        //             ->first();

        //         // Lấy giá rạp
        //         $cinema = DB::table('showtimes')
        //             ->join('cinemas', 'showtimes.cinema_id', '=', 'cinemas.id')
        //             ->where('showtimes.id', $showtime_id)
        //             ->select('cinemas.surcharge as cinema_surcharge')
        //             ->first();

        //         // Kiểm tra nếu bất kỳ giá trị nào là null
        //         if ($seat && $room && $showtime && $cinema) {
        //             // Tính tổng giá
        //             $totalPrice = $seat->seat_price + $room->room_surcharge + $showtime->movie_surcharge + $cinema->cinema_surcharge;

        //             // Thêm vào bảng seat_showtimes
        //             DB::table('seat_showtimes')->insert([
        //                 'seat_id' => $seat_id,
        //                 'showtime_id' => $showtime_id,
        //                 'status' => 'available',
        //                 'price' => $totalPrice,  // Giá tổng được tính ở trên
        //                 'created_at' => now(),
        //                 'updated_at' => now(),
        //             ]);
        //         } else {
        //             // Xử lý trường hợp không tìm thấy giá trị
        //             Log::warning("Missing data for seat_id: $seat_id, showtime_id: $showtime_id");
        //         }
        //     }
        // }

        $showtimes = DB::table('showtimes')
            ->join('movies', 'showtimes.movie_id', '=', 'movies.id')
            ->join('cinemas', 'showtimes.cinema_id', '=', 'cinemas.id')
            ->join('rooms', 'showtimes.room_id', '=', 'rooms.id')
            ->join('type_rooms', 'rooms.type_room_id', '=', 'type_rooms.id')
            ->select(
                'showtimes.id as showtime_id',
                'rooms.id as room_id',
                'movies.surcharge as movie_surcharge',
                'cinemas.surcharge as cinema_surcharge',
                'type_rooms.surcharge as room_surcharge'
            )
            ->get();

        // Lấy tất cả ghế và nhóm theo room_id để dễ truy xuất
        $seats = DB::table('seats')
            ->join('type_seats', 'seats.type_seat_id', '=', 'type_seats.id')
            ->select(
                'seats.id as seat_id',
                'seats.room_id',
                'type_seats.price as seat_price'
            )
            ->get()
            ->groupBy('room_id'); // Nhóm ghế theo room_id

        // Duyệt qua từng suất chiếu và thêm ghế của phòng tương ứng
        foreach ($showtimes as $showtime) {
            $roomSeats = $seats->get($showtime->room_id); // Lấy ghế thuộc phòng

            if (!$roomSeats) {
                Log::warning("No seats found for room_id: {$showtime->room_id}");
                continue; // Bỏ qua nếu không có ghế cho phòng này
            }
            foreach ($roomSeats as $seat) {
                // Tính tổng giá cho từng ghế
                $totalPrice = $seat->seat_price
                    + $showtime->room_surcharge
                    + $showtime->movie_surcharge
                    + $showtime->cinema_surcharge;

                // Thêm vào bảng seat_showtimes
                DB::table('seat_showtimes')->insert([
                    'seat_id' => $seat->seat_id,
                    'showtime_id' => $showtime->showtime_id,
                    'status' => 'available',
                    'price' => $totalPrice,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }


        //tạo 5 bản ghỉ user type admin
        $users = [
            [
                'name' => 'System Admin',
                'img_thumbnail' => 'https://scontent.fhan15-2.fna.fbcdn.net/v/t1.6435-9/120126178_348109963289562_6937582485606445898_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeHid5NvhW-nESNEUj9ywLECXaEHST7cvOBdoQdJPty84IP_DVL80XXFk3A34r6MY74TmbUrOl9cT3z_tkk8yBpH&_nc_ohc=DaV5AI-jumsQ7kNvgEJyVwd&_nc_ht=scontent.fhan15-2.fna&_nc_gid=Ab13vfocbX2Kak6-8LFNd4V&oh=00_AYAJfw8Mmq-xdk03sYw9OuLasodK7x2LrDtLynf23sQb3Q&oe=670D372A',
                'phone' => '0332295555',
                'email' => 'admin@fpt.edu.vn',
                'password' => Hash::make('admin@fpt.edu.vn'),
                'address' => 'Bích Hòa, Thanh Oai, Hà Nội',
                'gender' => 'Nam',
                'birthday' => '2004-02-07',
                'type' => 'admin',
                'cinema_id' => null,
            ],
            [
                'name' => 'Trương Công Lực',
                'img_thumbnail' => 'https://scontent.fhan15-2.fna.fbcdn.net/v/t1.6435-9/120126178_348109963289562_6937582485606445898_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeHid5NvhW-nESNEUj9ywLECXaEHST7cvOBdoQdJPty84IP_DVL80XXFk3A34r6MY74TmbUrOl9cT3z_tkk8yBpH&_nc_ohc=DaV5AI-jumsQ7kNvgEJyVwd&_nc_ht=scontent.fhan15-2.fna&_nc_gid=Ab13vfocbX2Kak6-8LFNd4V&oh=00_AYAJfw8Mmq-xdk03sYw9OuLasodK7x2LrDtLynf23sQb3Q&oe=670D372A',
                'phone' => '0332293871',
                'email' => 'luctcph37171@fpt.edu.vn',
                'password' => Hash::make('luctcph37171@fpt.edu.vn'),
                'address' => 'Bích Hòa, Thanh Oai, Hà Nội',
                'gender' => 'Nữ',
                'birthday' => '2004-02-07',
                'type' => 'admin',
                'cinema_id' => 1,
            ],
            [
                'name' => 'Hà Đắc Hiếu',
                'img_thumbnail' => 'theme/admin/assets/images/users/user-dummy-img.jpg',
                'phone' => '0975098710',
                'email' => 'hieuhdph36384@fpt.edu.vn',
                'password' => Hash::make('hieuhdph36384@fpt.edu.vn'),
                'address' => 'Núi Trầm, Chương Mỹ, Hà Nội.',
                'gender' => 'Nam',
                'birthday' => '2004-08-08',
                'type' => 'admin',
                'cinema_id' => 2,
            ],
            [
                'name' => 'Đặng Phú An',
                'img_thumbnail' => 'https://scontent.fhan2-5.fna.fbcdn.net/v/t39.30808-6/306327985_2574238996060074_6867027671439425864_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=YRrqayQEKLgQ7kNvgEDcnj8&_nc_ht=scontent.fhan2-5.fna&_nc_gid=Ao0SmZtyeZSItEd293QviMy&oh=00_AYB3v2346IuyWcD4IuDiv2JwLbS9HP5CEH737vmguoTskg&oe=670D806D',
                'phone' => '0378633611',
                'email' => 'andpph31859@fpt.edu.vn',
                'password' => Hash::make('andpph31859@fpt.edu.vn'),
                'address' => 'Văn Chấn, Yên Bái.',
                'gender' => 'Nam',
                'birthday' => '2004-06-06',
                'type' => 'admin',
                'cinema_id' => 3,
            ],
            [
                'name' => 'An Dang Phu',
                'img_thumbnail' => '',
                'phone' => '0378633611',
                'email' => 'anpx123@gmail.com',
                'password' => Hash::make('anpx123@gmail.com'),
                'address' => 'Văn Chấn, Yên Bái.',
                'gender' => 'Nam',
                'birthday' => '2004-10-01',
                'type' => 'admin',
                'cinema_id' => 1,
            ],
            [
                'name' => 'Nguyễn Viết Sơn',
                'img_thumbnail' => 'https://scontent.fhan2-5.fna.fbcdn.net/v/t39.30808-6/283601921_1482562385498894_735717922201179640_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=a5f93a&_nc_ohc=Ac_8W5oiz3UQ7kNvgE477pl&_nc_ht=scontent.fhan2-5.fna&_nc_gid=Ajp6VrKXh1BJ4nvrLvN-bbm&oh=00_AYCMP6yTzIhdGeGsW8knCmMkdI3IBd1wi_dlZwVKIfdn6w&oe=670D6BD1',
                'phone' => '0973657594',
                'email' => 'sonnvph33874@fpt.edu.vn',
                'password' => Hash::make('sonnvph33874@fpt.edu.vn'),
                'address' => 'Núi Trầm, Chương Mỹ, Hà Nội.',
                'gender' => 'Nam',
                'birthday' => '2004-11-11',
                'type' => 'admin',
                'cinema_id' => 3,
            ],
            [
                'name' => 'Bùi Đỗ Đạt',
                'img_thumbnail' => 'https://scontent.fhan2-3.fna.fbcdn.net/v/t39.30808-6/440936776_1188528172581066_7999369970856372504_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=a5f93a&_nc_ohc=MBdgh5UiWusQ7kNvgGLPe8r&_nc_ht=scontent.fhan2-3.fna&_nc_gid=Aj_DJrZPHc3NaAJFFRTaj5w&oh=00_AYBSl6B6bOXFnuWr28y70nx3iTGjkHk98LldAS5jUjsJ1A&oe=670D71B1',
                'phone' => '0965263725',
                'email' => 'datbdph38211@fpt.edu.vn',
                'password' => Hash::make('datbdph38211@fpt.edu.vn'),
                'address' => 'Bích Hòa, Thanh Oai, Hà Nội',
                'gender' => 'Nam',
                'birthday' => '2004-10-14',
                'type' => 'admin',
                'cinema_id' => 2,
            ],
        ];

        // Chèn tất cả người dùng vào cơ sở dữ liệu
        User::insert($users);
        $dataRanks = [
            ['name'=>'Nhựa',        'total_spent'=>0,         'ticket_percentage'=>5,     'combo_percentage'=>3 , 'is_default'=>1],
            ['name'=>'Vàng',        'total_spent'=>2000000,   'ticket_percentage'=>7,     'combo_percentage'=>5, 'is_default'=>0],
            ['name'=>'Cao thủ',     'total_spent'=>5000000,   'ticket_percentage'=>10,    'combo_percentage'=>7, 'is_default'=>0],
            ['name'=>'Chiến tướng', 'total_spent'=>10000000,  'ticket_percentage'=>15,    'combo_percentage'=>10, 'is_default'=>0],
        ];
        Rank::insert($dataRanks);
        // Tạo một bản ghi thành viên cho mỗi người dùng
        foreach ($users as $userData) {
            $user = User::where('email', $userData['email'])->first();
            if ($user) {
                Membership::create([
                    'user_id' => $user->id,
                    'rank_id' =>1,
                    'code' => Membership::codeMembership(),
                ]);
            }
        }



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
        $userIds = range(1, 6);
        for ($i = 0; $i < 2; $i++) {
            $voucherId  = DB::table('vouchers')->insertGetId([
                'code' => strtoupper(Str::random(10)),
                'title' => fake()->sentence(3),
                'description' => fake()->text(50),
                'start_date_time' => Carbon::now()->subDays(rand(0, 30)),
                'end_date_time' => Carbon::now()->addDays(rand(30, 60)),
                'discount' => fake()->numberBetween(1000, 100000),
                'quantity' => fake()->numberBetween(1, 100),
                'limit' => fake()->numberBetween(1, 5),
                'is_active' => 1,
                'is_publish' => 1,
                'type' => 1,
            ]);
            foreach ($userIds as $userId) {
                DB::table('user_vouchers')->insert([
                    'user_id' => $userId,
                    'voucher_id' => $voucherId,
                    'usage_count' => 0,
                ]);
            }
        }

        // tickets
        $showtimeIds = DB::table('showtimes')->pluck('id')->toArray();
        $cinemaIds = DB::table('cinemas')->pluck('id')->toArray();
        $movieIds = DB::table('movies')->pluck('id')->toArray();
        $comboIds = DB::table('combos')->pluck('id')->toArray();
        $userIds = range(1, 6);

        foreach ($userIds as $userId) {
            // Giới hạn trong 1 tháng
            $expiryDate = Carbon::now()->addMonth();

            for ($i = 0; $i < 2; $i++) {
                // Fake ticket data
                $ticketId = DB::table('tickets')->insertGetId([
                    'user_id' => $userId,
                    'cinema_id' => fake()->randomElement($cinemaIds),
                    'room_id' => DB::table('rooms')->inRandomOrder()->value('id'),
                    'movie_id' => fake()->randomElement($movieIds),
                    'voucher_code' => null,
                    'voucher_discount' => null,
                    'payment_name' => fake()->randomElement(['Tiền mặt', 'Momo', 'Zalopay', 'Vnpay']),
                    'code' => fake()->regexify('[A-Za-z0-9]{10}'),
                    'total_price' => fake()->numberBetween(50, 200) * 1000,
                    'status' => fake()->randomElement(['Chưa suất vé', 'Đã suất vé']),
                    'staff' => fake()->randomElement(['admin', 'member']),
                    'expiry' => $expiryDate,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Lấy showtime ngẫu nhiên
                $showtime_id = fake()->randomElement($showtimeIds);
                $room_id = DB::table('showtimes')->where('id', $showtime_id)->value('room_id');

                // Ghế theo phòng
                $seatIds = DB::table('seats')->where('room_id', $room_id)->orderBy('id')->pluck('id')->toArray();

                $seatCount = ($i == 0) ? 3 : 1;
                $startIndex = fake()->numberBetween(0, count($seatIds) - $seatCount);
                $selectedSeats = array_slice($seatIds, $startIndex, $seatCount);

                $price = fake()->numberBetween(50, 200) * 1000;

                foreach ($selectedSeats as $seatId) {
                    // Fake ticket_seats data
                    DB::table('ticket_seats')->insert([
                        'ticket_id' => $ticketId,
                        'showtime_id' => $showtime_id,
                        'seat_id' => $seatId,
                        'price' => $price,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                // Fake combos cho mỗi ticket
                $comboCount = fake()->numberBetween(1, 3);

                for ($j = 0; $j < $comboCount; $j++) {
                    DB::table('ticket_combos')->insert([
                        'ticket_id' => $ticketId,
                        'combo_id' => fake()->randomElement($comboIds),
                        'price' => fake()->numberBetween(50, 200) * 1000,
                        'quantity' => fake()->numberBetween(1, 5),
                        'status' => fake()->randomElement(['Đã lấy đồ ăn', 'Chưa lấy đồ ăn']),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }



        // Tạo 10 bài viết
        for ($i = 1; $i <= 10; $i++) {
            Post::create([
                'user_id' => random_int(1, 5),
                'title' => 'Bài viết số ' . $i,
                'slug' => 'bai-viet-so-' . $i,
                'img_post' => 'https://www.webstrot.com/html/moviepro/html/images/header/01.jpg',
                'description' => 'Đây là phần mô tả cho bài viết số ' . $i . '. Đây là đoạn văn ngắn mô tả nội dung của bài viết.',
                'content' => '
                    <h2>Giới thiệu về bài viết số ' . $i . '</h2>
                    <p>Đây là phần mở đầu cho bài viết số ' . $i . '. Nội dung bài viết này sẽ tập trung vào việc cung cấp thông tin chi tiết về một chủ đề nhất định. Các thông tin sẽ được trình bày rõ ràng và dễ hiểu.</p>

                    <h3>Phần 1: Tổng quan về nội dung</h3>
                    <p>Bài viết này sẽ đi sâu vào chi tiết của chủ đề được chọn. Mỗi phần của bài viết đều có mục đích riêng, giúp người đọc nắm bắt thông tin một cách dễ dàng hơn.</p>
                    <img src="https://iguov8nhvyobj.vcdn.cloud/media/catalog/product/cache/1/image/c5f0a1eff4c394a251036189ccddaacd/3/5/350x495-mada.jpg" alt="Image 1 for Post ' . $i . '" style="width: 100%; max-width: 400px; height: auto;">

                    <p>Tiếp theo là một số giải thích và minh họa thêm để tăng sự hấp dẫn cho bài viết. Các hình ảnh và nội dung được bố trí hợp lý để không gây nhàm chán.</p>
                    <img src="https://iguov8nhvyobj.vcdn.cloud/media/catalog/product/cache/1/image/c5f0a1eff4c394a251036189ccddaacd/3/5/350x495-kumanthong.jpg" alt="Image 2 for Post ' . $i . '" style="width: 100%; max-width: 400px; height: auto;">

                    <h3>Phần 2: Chi tiết chủ đề</h3>
                    <p>Chủ đề chính của bài viết sẽ được bàn luận sâu hơn trong phần này. Người viết sẽ cố gắng làm rõ các khía cạnh quan trọng của chủ đề. Bên cạnh đó, một số hình ảnh sẽ giúp minh họa rõ hơn cho các nội dung được đề cập.</p>
                    <p>Mỗi phần của bài viết đều có thể đi kèm với nhiều đoạn văn bản dài để cung cấp đầy đủ thông tin cho người đọc.</p>
                    <img src="https://www.webstrot.com/html/moviepro/html/images/header/03.jpg" alt="Image 3 for Post ' . $i . '" style="width: 100%; max-width: 400px; height: auto;">

                    <p>Bài viết số ' . $i . ' còn bao gồm các đoạn văn chi tiết về các chủ đề liên quan, mỗi đoạn văn sẽ giúp bổ sung thêm thông tin. Người đọc có thể dễ dàng theo dõi mạch nội dung nhờ cách trình bày rõ ràng, mạch lạc.</p>
                    <img src="https://www.webstrot.com/html/moviepro/html/images/header/02.jpg" alt="Image 1 for Post ' . $i . '" style="width: 100%; max-width: 400px; height: auto;">

                    <h3>Phần 3: Phân tích và đánh giá</h3>
                    <p>Phần này sẽ đi sâu hơn vào việc phân tích chủ đề đã được trình bày ở phần trước. Một số phân tích chuyên sâu sẽ được đưa ra để giúp người đọc hiểu rõ hơn về các khía cạnh của vấn đề.</p>
                    <p>Ngoài ra, người viết sẽ cố gắng cung cấp thêm các ví dụ thực tiễn để minh họa cho các ý tưởng được nêu ra.</p>
                    <img src="' . asset('theme/client/images/Fpoly_Cinemas.jpg') . '" alt="Image 5 for Post ' . $i . '" style="width: 100%; max-width: 400px; height: auto;">

                    <h3>Kết luận</h3>
                    <p>Cái này xem hay nè:)) .Đi xem đánh giá ở lotte 9.4/10.0 . Lúc nào rảnh đi xem tiếp cho đỡ sợ:)) .Phần kết luận của bài viết số ' . $i . ' sẽ tóm tắt các ý chính đã được thảo luận. Đây là nơi mà người viết có thể nhấn mạnh những điểm quan trọng và đưa ra kết luận cuối cùng. Để hoàn tất bài viết, thêm một hình ảnh minh họa cuối cùng sẽ giúp kết thúc nội dung một cách hợp lý.</p>
                    <img src="https://iguov8nhvyobj.vcdn.cloud/media/catalog/product/cache/1/thumbnail/240x388/c88460ec71d04fa96e628a21494d2fd3/r/s/rsz_ty2-main-poster-printing.jpg" alt="Final Image for Post ' . $i . '" style="width: 100%; max-width: 400px; height: auto;">
                ',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }



        // $permissions = [
        //     ['name' => 'Danh sách chi nhánh', 'slug' => 'branch.list', 'guard_name' => 'web'],
        //     ['name' => 'Thêm chi nhánh', 'slug' => 'branch.add', 'guard_name' => 'web'],
        //     ['name' => 'Sửa chi nhánh', 'slug' => 'branch.edit', 'guard_name' => 'web'],
        //     ['name' => 'Xóa chi nhánh', 'slug' => 'branch.delete', 'guard_name' => 'web'],

        //     ['name' => 'Danh sách rạp', 'slug' => 'cinema.list', 'guard_name' => 'web'],
        //     ['name' => 'Thêm rạp', 'slug' => 'cinema.add', 'guard_name' => 'web'],
        //     ['name' => 'Sửa rạp', 'slug' => 'cinema.edit', 'guard_name' => 'web'],
        //     ['name' => 'Xóa rạp', 'slug' => 'cinema.delete', 'guard_name' => 'web'],

        //     ['name' => 'Danh sách phòng chiếu', 'slug' => 'room.list', 'guard_name' => 'web'],
        //     ['name' => 'Thêm phòng chiếu', 'slug' => 'room.add', 'guard_name' => 'web'],
        //     ['name' => 'Sửa phòng chiếu', 'slug' => 'room.edit', 'guard_name' => 'web'],
        //     ['name' => 'Xóa phòng chiếu', 'slug' => 'room.delete', 'guard_name' => 'web'],

        //     ['name' => 'Danh sách phim', 'slug' => 'movie.list', 'guard_name' => 'web'],
        //     ['name' => 'Thêm phim', 'slug' => 'movie.add', 'guard_name' => 'web'],
        //     ['name' => 'Sửa phim', 'slug' => 'movie.edit', 'guard_name' => 'web'],
        //     ['name' => 'Xóa phim', 'slug' => 'movie.delete', 'guard_name' => 'web'],

        //     ['name' => 'Danh sách suất chiếu', 'slug' => 'showtime.list', 'guard_name' => 'web'],
        //     ['name' => 'Thêm suất chiếu', 'slug' => 'showtime.add', 'guard_name' => 'web'],
        //     ['name' => 'Sửa suất chiếu', 'slug' => 'showtime.edit', 'guard_name' => 'web'],
        //     ['name' => 'Xóa suất chiếu', 'slug' => 'showtime.delete', 'guard_name' => 'web'],
        // ];
        $permissions = [
            'Danh sách chi nhánh',
            'Thêm chi nhánh',
            'Sửa chi nhánh',
            'Xóa chi nhánh',
            'Danh sách rạp',
            'Thêm rạp',
            'Sửa rạp',
            'Xóa rạp',
            'Danh sách phòng chiếu',
            'Thêm phòng chiếu',
            'Sửa phòng chiếu',
            'Xóa phòng chiếu',
            'Danh sách mẫu sơ đồ ghế',
            'Thêm mẫu sơ đồ ghế',
            'Sửa mẫu sơ đồ ghế',
            'Xóa mẫu sơ đồ ghế',
            'Danh sách phim',
            'Thêm phim',
            'Sửa phim',
            'Xóa phim',
            'Danh sách suất chiếu',
            'Thêm suất chiếu',
            'Sửa suất chiếu',
            'Xóa suất chiếu',
            'Danh sách hóa đơn',
            'Thêm hóa đơn',
            'Sửa hóa đơn',
            'Xóa hóa đơn',
            'Danh sách đặt vé',
            'Thêm đặt vé',
            'Sửa đặt vé',
            'Xóa đặt vé',
            'Danh sách đồ ăn',
            'Thêm đồ ăn',
            'Sửa đồ ăn',
            'Xóa đồ ăn',
            'Danh sách combo',
            'Thêm combo',
            'Sửa combo',
            'Xóa combo',
            'Danh sách vouchers',
            'Thêm vouchers',
            'Sửa vouchers',
            'Xóa vouchers',
            'Danh sách thanh toán',
            'Thêm thanh toán',
            'Sửa thanh toán',
            'Xóa thanh toán',
            'Danh sách giá',
            'Thêm giá',
            'Sửa giá',
            'Xóa giá',
            'Danh sách bài viết',
            'Thêm bài viết',
            'Sửa bài viết',
            'Xóa bài viết',
            'Danh sách slideshows',
            'Thêm slideshows',
            'Sửa slideshows',
            'Xóa slideshows',
            'Danh sách liên hệ',
            'Thêm liên hệ',
            'Sửa liên hệ',
            'Xóa liên hệ',
            'Danh sách tài khoản',
            'Thêm tài khoản',
            'Sửa tài khoản',
            'Xóa tài khoản',
            'Danh sách thống kê',
            // 'Thêm thống kê',
            // 'Sửa thống kê',
            // 'Xóa thống kê',
        ];

        // Tạo các quyền từ danh sách
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Tạo các vai trò
        $roles = [
            'System Admin',
            'Quản lý cơ sở',
            'Nhân viên'
        ];

        foreach ($roles as $roleName) {
            Role::create(['name' => $roleName, 'guard_name' => 'web']);
        }

        // Gán tất cả quyền cho System Admin
        $adminRole = Role::findByName('System Admin', 'web');
        $adminRole->givePermissionTo(Permission::where('guard_name', 'web')->get()); // Gán tất cả quyền cho System Admin

 
        $user = User::find(1);
        if ($user) {
            $user->assignRole('System Admin');
        }

        $managerRole = Role::findByName('Quản lý cơ sở', 'web');
        $managerRole->givePermissionTo(['Danh sách chi nhánh', 'Thêm chi nhánh', 'Sửa chi nhánh', 'Xóa chi nhánh', 'Danh sách rạp', 'Thêm rạp']);


        $user = User::find(2);
        if ($user) {
            $user->assignRole('Quản lý cơ sở');
        }

        
        $user = User::find(6);
        if ($user) {
            $user->assignRole('Nhân viên');
        }
    }

    private function generateSeatStructure()
    {
        $structure = [];

        // 4 hàng đầu tiên: Ghế thường
        for ($y = 1; $y <= 4; $y++) {  // Hàng từ 1 đến 4
            for ($x = 1; $x <= 12; $x++) {  // Cột từ 1 đến 12
                $structure[] = [
                    'coordinates_x' => $x, // Cột
                    'coordinates_y' => chr(64 + $y), // Hàng: A, B, C, D
                    'type_seat_id' => 1, // Ghế thường
                ];
            }
        }

        // 7 hàng tiếp theo: Ghế VIP
        for ($y = 5; $y <= 11; $y++) {  // Hàng từ 5 đến 11
            for ($x = 1; $x <= 12; $x++) {  // Cột từ 1 đến 12
                $structure[] = [
                    'coordinates_x' => $x, // Cột
                    'coordinates_y' => chr(64 + $y), // Hàng: E, F, G, H, I, J, K
                    'type_seat_id' => 2, // Ghế VIP
                ];
            }
        }

        // Hàng cuối cùng: Ghế đôi
        for ($y = 12; $y <= 12; $y++) {  // Hàng 12
            for ($x = 1; $x <= 12; $x++) {  // Cột từ 1 đến 12
                if ($x % 2 == 0) {
                    continue; // Chỉ giữ ghế lẻ (L1, L3, L5,...)
                }
                $structure[] = [
                    'coordinates_x' => $x, // Cột
                    'coordinates_y' => 'L', // Hàng: L1, L3,...
                    'type_seat_id' => 3, // Ghế đôi
                ];
            }
        }

        return $structure;
    }
}
