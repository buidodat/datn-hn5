<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Branch;
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
use App\Models\Showtime;
use App\Models\Ticket;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\SiteSetting;

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

        // 3 bản ghi slideshow
        Slideshow::insert([
            [
                'img_thumbnail' => json_encode([
                    'https://www.webstrot.com/html/moviepro/html/images/header/01.jpg',
                    'https://www.webstrot.com/html/moviepro/html/images/header/02.jpg',
                    'https://www.webstrot.com/html/moviepro/html/images/header/03.jpg'
                ]),
                'is_active' => 1,
            ]
        ]);



        //20 bản ghi movie và 40 bản ghi movie_version
        $url_youtubes = [
            'VmJ4oB3Xguo',
            'XuX2HKeMkVw',
            'SGg9DxLFCtc',
            'm6MF1MqsDhc',
            'dNwuFYhwTAk',
            '4oxoPMxBO6s',
            'b1Yqng0uSWM',
            'IK-eb2AbKQ',
            'Tx5JuN-5n8U',
            'kMjlJkmt5nk',
            'gTo9JwsmjT4',
            '4rgYUipGJNo'
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

        $ratings = ['P',  'T13', 'T16', 'T18', 'K'];
        $categories = [
            "Hành động, kịch tính",
            "Phiêu lưu, khám phá",
            "Kinh dị",
            "Khoa học viễn tưởng",
            "Tình cảm",
            "Hài hước",
            "Kịch, Hồi Hộp",
            "Hoạt hình",
            "Tâm lý",
            "Âm nhạc, phiêu lưu",
        ];
        $movieNames =  [
            "Moana 2: Hành Trình Của Moana",
            "Thợ Săn Thủ Lĩnh",
            "Nhím Sonic III",
            "Spring Garden: Ai Oán Trong Vườn Xuân",
            "Tee Yod: Quỷ Ăn Tạng II",
            "Vùng Đất Bị Nguyền Rủa",
            "Gladiator: Võ Sĩ Giác Đấu II",
            "Elli và Bí Ẩn Chiếc Tàu Ma",
            "Sắc Màu Của Hạnh Phúc",
            "OZI: Phi Vụ Rừng Xanh",
            "Tee Yod: Quỷ Ăn Tạng",
            "Venom: Kèo Cuối",
            "Ngày Xưa Có Một Chuyện Tình",
            "Cười Xuyên Biên Giới",
            "Thiên Đường Quả Báo",
            "Cu Li Không Bao Giờ Khóc",
            "RED ONE: Mật mã đỏ",
            "Vây Hãm Tại Đài Bắc",
            'Học Viện Anh Hùng',
            "Linh Miêu",
            'Công Tử Bạc Liêu',
            "CAPTAIN AMERICA: BRAVE NEW WORLD",
            "Địa Đạo: Mặt Trời Trong Bóng Tối",
            "Thám Tử Kiên: Kỳ Án Không Đầu",
            'Mufasa: Vua Sư Tử'
        ];


        for ($i = 0; $i < 25; $i++) {
            $releaseDate = fake()->dateTimeBetween(now()->subMonths(5), now()->addMonths(2));
            $endDate = fake()->dateTimeBetween($releaseDate, now()->addMonths(5));
            $rating = $ratings[array_rand($ratings)];
            $x = ($i % 21) + 1;

            $img = "images/movies/" . $x . ".png";
            $movie = DB::table('movies')->insertGetId([
                'name' => $movieNames[$i],
                'slug' => Str::slug($movieNames[$i]),
                'category' =>  $categories[array_rand($categories)],
                'img_thumbnail' => asset($img),
                'description' => Str::limit(fake()->paragraph, 250),
                'director' => fake()->name,
                'cast' => fake()->name(),
                'rating' => $rating,
                'duration' => fake()->numberBetween(60, 180),
                'release_date' => $releaseDate,
                'end_date' => $endDate,
                'trailer_url' => $url_youtubes[array_rand($url_youtubes)],
                'is_active' => true,
                'is_hot' => $booleans[rand(0, 7)],
                'is_special' => $booleans[rand(0, 7)],
                'is_publish' => true,
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
            Branch::create([
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
        SeatTemplate::create([
            'name' => 'Template Standard',
            'description' => 'Mẫu sơ đồ ghế tiêu chuẩn.',
            'matrix_id' => 1, // ID matrix ví dụ
            'seat_structure' => $this->generateSeatStructure1(), // Cấu trúc ghế
            'is_publish' => 1, // Đã publish
            'is_active' => 1, // Đã kích hoạt
        ]);
        SeatTemplate::create([
            'name' => 'Template Large',
            'description' => 'Mẫu sơ đồ ghế lớn.',
            'matrix_id' => 3, // ID matrix ví dụ
            'seat_structure' => $this->generateSeatStructure2(), // Cấu trúc ghế
            'is_publish' => 1, // Đã publish
            'is_active' => 1, // Đã kích hoạt
        ]);
        function randomSeatTemplateId()
        {
            // Tạo một số ngẫu nhiên từ 1 đến 100
            $randomNumber = rand(1, 100);

            // Xác suất 80% cho '1' và 20% cho '2'
            return ($randomNumber <= 80) ? 1 : 2;
        }

        foreach ($cinemaCount as $cinema_id) { // Duyệt qua từng rạp
            // Lấy branch_id từ cinema_id
            $branch_id = DB::table('cinemas')->where('id', $cinema_id)->value('branch_id');

            foreach ($roomsName as $room) { // Tạo phòng cho mỗi rạp
                $roomId = DB::table('rooms')->insertGetId([
                    'branch_id' => $branch_id,
                    'cinema_id' => $cinema_id,
                    'type_room_id' => fake()->numberBetween(1, 3), // Loại phòng ngẫu nhiên
                    'name' => $room, // Tên phòng
                    'seat_template_id' => randomSeatTemplateId(), // ID template ghế vừa tạo
                    'is_active' => 1,
                    'is_publish' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $seatTemplateId = DB::table('rooms')->where('id', $roomId)->value('seat_template_id');
                $seatTemplate = SeatTemplate::find($seatTemplateId);
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
                            'slug' => Showtime::generateCustomRandomString(),
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
            ['name' => 'Ghế Đôi', 'price' => 120000],
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
                'img_thumbnail' => '',
                'phone' => '0332295555',
                'email_verified_at' => '2024-11-01 19:58:51',
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
                'img_thumbnail' => '',
                'phone' => '0332293871',
                'email_verified_at' => '2024-11-01 19:58:51',
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
                'img_thumbnail' => '',
                'phone' => '0975098710',
                'email_verified_at' => '2024-11-01 19:58:51',
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
                'img_thumbnail' => '',
                'phone' => '0378633611',
                'email_verified_at' => '2024-11-01 19:58:51',
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
                'email_verified_at' => '2024-11-01 19:58:51',
                'email' => 'anpx123@gmail.com',
                'password' => Hash::make('anpx123@gmail.com'),
                'address' => 'Văn Chấn, Yên Bái.',
                'gender' => 'Nam',
                'birthday' => '2004-10-01',
                'type' => 'member',
                'cinema_id' => 1,
            ],
            [
                'name' => 'Nguyễn Viết Sơn',
                'img_thumbnail' => '',
                'phone' => '0973657594',
                'email_verified_at' => '2024-11-01 19:58:51',
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
                'img_thumbnail' => '',
                'phone' => '0965263725',
                'email_verified_at' => '2024-11-01 19:58:51',
                'email' => 'datbdph38211@fpt.edu.vn',
                'password' => Hash::make('datbdph38211@fpt.edu.vn'),
                'address' => 'Bích Hòa, Thanh Oai, Hà Nội',
                'gender' => 'Nam',
                'birthday' => '2004-10-14',
                'type' => 'admin',
                'cinema_id' => 2,
            ],
            [
                'name' => 'Nhân viên Rạp',
                'img_thumbnail' => '',
                'phone' => '0965266625',
                'email_verified_at' => '2024-11-01 19:58:51',
                'email' => 'nhanvienrapHaDong@fpt.edu.vn',
                'password' => Hash::make('nhanvienrapHaDong@fpt.edu.vn'),
                'address' => 'Bích Hòa, Thanh Oai, Hà Nội',
                'gender' => 'Nam',
                'birthday' => '2004-10-14',
                'type' => 'admin',
                'cinema_id' => 1,
            ],
            [
                'name' => 'Nhân viên Rạp',
                'img_thumbnail' => '',
                'phone' => '0965265555',
                'email_verified_at' => '2024-11-01 19:58:51',
                'email' => 'nhanvienrapMyDinh@fpt.edu.vn',
                'password' => Hash::make('nhanvienrapMyDinh@fpt.edu.vn'),
                'address' => 'Bích Hòa, Thanh Oai, Hà Nội',
                'gender' => 'Nam',
                'birthday' => '2004-10-14',
                'type' => 'admin',
                'cinema_id' => 2,
            ],
            [
                'name' => 'Bùi Phú Sơn',
                'img_thumbnail' => '',
                'phone' => '0999965555',
                'email_verified_at' => '2024-11-01 19:58:51',
                'email' => 'buiphusonph33333@fpt.edu.vn',
                'password' => Hash::make('buiphusonph33333@fpt.edu.vn'),
                'address' => 'Bích Hòa, Chương Mỹ, Hà Nội',
                'gender' => 'Nam',
                'birthday' => '2004-10-14',
                'type' => 'member',
                'cinema_id' => null,
            ],
            [
                'name' => 'Trương Đắc Đạt',
                'img_thumbnail' => 'https://scontent.fhan2-3.fna.fbcdn.net/v/t39.30808-6/440936776_1188528172581066_7999369970856372504_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=a5f93a&_nc_ohc=MBdgh5UiWusQ7kNvgGLPe8r&_nc_ht=scontent.fhan2-3.fna&_nc_gid=Aj_DJrZPHc3NaAJFFRTaj5w&oh=00_AYBSl6B6bOXFnuWr28y70nx3iTGjkHk98LldAS5jUjsJ1A&oe=670D71B1',
                'phone' => '0999999995',
                'email_verified_at' => '2024-11-01 19:58:51',
                'email' => 'truongdacdatph99999@fpt.edu.vn',
                'password' => Hash::make('truongdacdatph99999@fpt.edu.vn'),
                'address' => 'Bích Hòa, Chương Mỹ, Hà Nội',
                'gender' => 'Nam',
                'birthday' => '2004-10-14',
                'type' => 'member',
                'cinema_id' => null,
            ],
        ];

        // Chèn tất cả người dùng vào cơ sở dữ liệu
        User::insert($users);
        $dataRanks = [
            ['name' => 'Member',       'total_spent' => 0,         'ticket_percentage' => 5,     'combo_percentage' => 3,  'is_default' => 1],
            ['name' => 'Gold',         'total_spent' => 1000000,   'ticket_percentage' => 7,     'combo_percentage' => 5,  'is_default' => 0],
            ['name' => 'Platinum',     'total_spent' => 3000000,   'ticket_percentage' => 10,    'combo_percentage' => 7,  'is_default' => 0],
            ['name' => 'Diamond',      'total_spent' => 5000000,   'ticket_percentage' => 15,    'combo_percentage' => 10, 'is_default' => 0],
        ];
        foreach ($dataRanks as $rank) {
            Rank::create($rank);
        }
        // Tạo một bản ghi thành viên cho mỗi người dùng
        foreach ($users as $userData) {
            $user = User::where('email', $userData['email'])->first();
            if ($user) {
                Membership::create([
                    'user_id' => $user->id,
                    'rank_id' => 1,
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
        $userIds = User::pluck('id')->toArray(); // Lấy tất cả ID của người dùng từ bảng users

        $today = Carbon::now();

        // Xác định ngày bắt đầu là 6 tháng trước
        $startDate = Carbon::now()->subMonths(6);

        // Tổng số tháng cần phân bổ
        $totalMonths = $today->diffInMonths($startDate);

        foreach ($userIds as $userId) {
            $expiryDate = Carbon::now()->addMonth();

            for ($i = 0; $i < 2; $i++) {
                $randomMonth = rand(0, $totalMonths);  // Chọn tháng ngẫu nhiên
                $randomDay = rand(1, 28);  // Chọn ngày ngẫu nhiên trong tháng (28 để tránh vượt quá số ngày của các tháng)

                // Tạo ngày ngẫu nhiên theo tháng và năm
                $randomDate = $startDate->copy()->addMonths($randomMonth)->day($randomDay);
                $ticketId = DB::table('tickets')->insertGetId([
                    'user_id' => $userId,
                    'cinema_id' => fake()->randomElement($cinemaIds),
                    'room_id' => DB::table('rooms')->inRandomOrder()->value('id'),
                    'movie_id' => fake()->randomElement($movieIds),
                    'showtime_id' => fake()->randomElement($showtimeIds),
                    'voucher_code' => null,
                    'voucher_discount' => null,
                    'point_use' => fake()->numberBetween(0, 500),
                    'point_discount' => fake()->numberBetween(0, 100),
                    'payment_name' => fake()->randomElement(['Tiền mặt', 'Momo', 'Zalopay', 'Vnpay']),
                    'code' => fake()->regexify('[A-Za-z0-9]{10}'),
                    'total_price' => fake()->numberBetween(50, 200) * 1000,
                    'status' => Ticket::NOT_ISSUED,
                    'staff' => fake()->randomElement(['admin', 'member']),
                    'expiry' => $expiryDate,
                    'created_at' => $randomDate,  // Gán ngày ngẫu nhiên
                    'updated_at' => $randomDate,  // Gán lại ngày updated_at tương tự
                ]);

                $showtimeId = DB::table('tickets')->where('id', $ticketId)->value('showtime_id');
                $roomId = DB::table('showtimes')->where('id', $showtimeId)->value('room_id');
                $seatIds = DB::table('seats')->where('room_id', $roomId)->orderBy('id')->pluck('id')->toArray();

                $seatCount = ($i == 0) ? 3 : 1;
                $startIndex = fake()->numberBetween(0, count($seatIds) - $seatCount);
                $selectedSeats = array_slice($seatIds, $startIndex, $seatCount);
                $price = fake()->numberBetween(50, 200) * 1000;

                foreach ($selectedSeats as $seatId) {
                    DB::table('ticket_seats')->insert([
                        'ticket_id' => $ticketId,
                        'seat_id' => $seatId,
                        'price' => $price,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                $comboCount = fake()->numberBetween(1, 3);

                for ($j = 0; $j < $comboCount; $j++) {
                    DB::table('ticket_combos')->insert([
                        'ticket_id' => $ticketId,
                        'combo_id' => fake()->randomElement($comboIds),
                        'price' => fake()->numberBetween(50, 200) * 1000,
                        'quantity' => fake()->numberBetween(1, 5),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        // LỰC CMT
        // // tickets
        // $showtimeIds = DB::table('showtimes')->pluck('id')->toArray();
        // $cinemaIds = DB::table('cinemas')->pluck('id')->toArray();
        // $movieIds = DB::table('movies')->pluck('id')->toArray();
        // $comboIds = DB::table('combos')->pluck('id')->toArray();
        // $userIds = range(1, 6);

        // foreach ($userIds as $userId) {
        //     // Giới hạn trong 1 tháng
        //     $expiryDate = Carbon::now()->addMonth();

        //     for ($i = 0; $i < 2; $i++) {
        //         // Fake ticket data
        //         $ticketId = DB::table('tickets')->insertGetId([
        //             'user_id' => $userId,
        //             'cinema_id' => fake()->randomElement($cinemaIds),
        //             'room_id' => DB::table('rooms')->inRandomOrder()->value('id'),
        //             'movie_id' => fake()->randomElement($movieIds),
        //             'voucher_code' => null,
        //             'voucher_discount' => null,
        //             'payment_name' => fake()->randomElement(['Tiền mặt', 'Momo', 'Zalopay', 'Vnpay']),
        //             'code' => fake()->regexify('[A-Za-z0-9]{10}'),
        //             'total_price' => fake()->numberBetween(50, 200) * 1000,
        //             'status' => fake()->randomElement(['Chưa xuất vé']),
        //             'staff' => fake()->randomElement(['admin', 'member']),
        //             'expiry' => $expiryDate,
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ]);

        //         // Lấy showtime ngẫu nhiên
        //         $showtime_id = fake()->randomElement($showtimeIds);
        //         $room_id = DB::table('showtimes')->where('id', $showtime_id)->value('room_id');

        //         // Ghế theo phòng
        //         $seatIds = DB::table('seats')->where('room_id', $room_id)->orderBy('id')->pluck('id')->toArray();

        //         $seatCount = ($i == 0) ? 3 : 1;
        //         $startIndex = fake()->numberBetween(0, count($seatIds) - $seatCount);
        //         $selectedSeats = array_slice($seatIds, $startIndex, $seatCount);

        //         $price = fake()->numberBetween(50, 200) * 1000;

        //         foreach ($selectedSeats as $seatId) {
        //             // Fake ticket_seats data
        //             DB::table('ticket_seats')->insert([
        //                 'ticket_id' => $ticketId,
        //                 'showtime_id' => $showtime_id,
        //                 'seat_id' => $seatId,
        //                 'price' => $price,
        //                 'created_at' => now(),
        //                 'updated_at' => now(),
        //             ]);
        //         }

        //         // Fake combos cho mỗi ticket
        //         $comboCount = fake()->numberBetween(1, 3);

        //         for ($j = 0; $j < $comboCount; $j++) {
        //             DB::table('ticket_combos')->insert([
        //                 'ticket_id' => $ticketId,
        //                 'combo_id' => fake()->randomElement($comboIds),
        //                 'price' => fake()->numberBetween(50, 200) * 1000,
        //                 'quantity' => fake()->numberBetween(1, 5),
        //                 // 'status' => fake()->randomElement(['Đã lấy đồ ăn', 'Chưa lấy đồ ăn']),
        //                 'created_at' => now(),
        //                 'updated_at' => now(),
        //             ]);
        //         }
        //     }
        // }



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


        // Phân quyền : Danh sách quyền
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
            'Xem chi tiết phòng chiếu',
            'Danh sách mẫu sơ đồ ghế',
            'Thêm mẫu sơ đồ ghế',
            'Sửa mẫu sơ đồ ghế',
            'Xóa mẫu sơ đồ ghế',
            'Danh sách phim',
            'Thêm phim',
            'Sửa phim',
            'Xóa phim',
            'Xem chi tiết phim',
            'Danh sách suất chiếu',
            'Thêm suất chiếu',
            'Sửa suất chiếu',
            'Xóa suất chiếu',
            'Xem chi tiết suất chiếu',
            'Danh sách hóa đơn',
            'Quét hóa đơn',

            'Xem chi tiết hóa đơn',

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
            // 'Thêm giá',
            'Sửa giá',
            // 'Xóa giá',
            'Danh sách bài viết',
            'Thêm bài viết',
            'Sửa bài viết',
            'Xóa bài viết',
            'Xem chi tiết bài viết',
            'Danh sách slideshows',
            'Thêm slideshows',
            'Sửa slideshows',
            'Xóa slideshows',
            'Danh sách liên hệ',
            // 'Thêm liên hệ',
            'Sửa liên hệ',
            // 'Xóa liên hệ',
            'Danh sách tài khoản',
            'Thêm tài khoản',
            'Sửa tài khoản',
            'Xóa tài khoản',
            'Cấu hình website',
            'Danh sách thống kê',
            'Thẻ thành viên'

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
            Role::create(['name' => $roleName]);
        }

        // Gán tất cả quyền cho System Admin
        $adminRole = Role::findByName('System Admin');
        $adminRole->syncPermissions(Permission::all());


        $user = User::find(1);
        $user->assignRole('System Admin');


        $managerRole = Role::findByName('Quản lý cơ sở');
        $managerRole->givePermissionTo([
            'Danh sách phòng chiếu',
            'Thêm phòng chiếu',
            'Sửa phòng chiếu',
            'Xóa phòng chiếu',
            'Xem chi tiết phòng chiếu',
            'Danh sách mẫu sơ đồ ghế',
            // 'Thêm mẫu sơ đồ ghế',
            // 'Sửa mẫu sơ đồ ghế',
            // 'Xóa mẫu sơ đồ ghế',
            'Danh sách phim',
            'Xem chi tiết phim',
            'Danh sách suất chiếu',
            'Thêm suất chiếu',
            'Sửa suất chiếu',
            'Xóa suất chiếu',
            'Xem chi tiết suất chiếu',
            'Danh sách hóa đơn',
            'Quét hóa đơn',
            'Xem chi tiết hóa đơn',
            // 'Danh sách đồ ăn',
            // 'Danh sách combo',
            // 'Danh sách vouchers',
            // 'Danh sách thanh toán',
            // 'Danh sách bài viết',
            // 'Danh sách slideshows',
            // 'Danh sách liên hệ',
            // 'Sửa liên hệ',
            // 'Danh sách tài khoản',
            'Danh sách thống kê',
        ]);

        $managerRole = Role::findByName('Nhân viên');
        $managerRole->givePermissionTo([
            'Danh sách hóa đơn',
            'Quét hóa đơn',
            'Xem chi tiết hóa đơn',
        ]);


        $user = User::find(2);
        $user->assignRole('Quản lý cơ sở');
        $user = User::find(3);
        $user->assignRole('Quản lý cơ sở');
        $user = User::find(4);
        $user->assignRole('Quản lý cơ sở');

        $user = User::find(6);
        $user->assignRole('Quản lý cơ sở');
        $user = User::find(7);
        $user->assignRole('Quản lý cơ sở');
        $user = User::find(8);
        $user->assignRole('Nhân viên');


        $user = User::find(5);
        $user->assignRole('Nhân viên');


        // Cấu hình website
        SiteSetting::create([
            'website_logo' => 'theme/client/images/header/P.svg',
            'site_name' => 'Poly Cinemas',
            'brand_name' => 'Hệ thống Rạp chiếu phim toàn quốc Poly Cinemas',
            'slogan' => 'Chất lượng dịch vụ luôn là số 1',
            'phone' => '0999999999',
            'email' => 'polycinemas@poly.cenimas.vn',
            'headquarters' => 'Tòa nhà FPT Polytechnic, Phố Trịnh Văn Bô, Nam Từ Liêm, Hà Nội',
            'business_license' => 'Đây là giấy phép kinh doanh',
            'working_hours' => '7:00 - 22:00',
            'facebook_link' => 'https://facebook.com/',
            'youtube_link' => 'https://youtube.com/',
            'instagram_link' => 'https://instagram.com/',
            'privacy_policy_image' => 'theme/client/images/z6051700744901_e30e7f1c520f5521d677eed36a1e7e3c.jpg',
            'privacy_policy' => '
                <b>Chào mừng Quý khách hàng đến với Hệ thống Bán Vé Online của chuỗi Rạp Chiếu Phim POLY CINEMAS!</b>
                <p>Xin cảm ơn và chúc Quý khách hàng có những giây phút xem phim tuyệt vời tại POLY CINEMAS!</p>
                <b>Sau đây là một số lưu ý trước khi thanh toán trực tuyến:</b> <br>
                <ul>
                    <li>1. Thẻ phải được kích hoạt chức năng thanh toán trực tuyến, và có đủ
                        hạn
                        mức/ số dư để thanh toán. Quý khách cần nhập chính xác thông tin thẻ
                        (tên
                        chủ thẻ, số thẻ, ngày hết hạn, số CVC, OTP,...).</li>
                    <li>2. Vé và hàng hóa đã thanh toán thành công không thể hủy/đổi
                        trả/hoàn tiền
                        vì bất kỳ lý do gì. POLY CINEMAS chỉ thực hiện hoàn tiền trong
                        trường hợp
                        thẻ của Quý khách đã bị trừ tiền nhưng hệ thống của Beta không ghi
                        nhận việc
                        đặt vé/đơn hàng của Quý khách, và Quý khách không nhận được xác nhận
                        đặt
                        vé/đơn hàng thành công.</li>
                    <li>3. Trong vòng 30 phút kể từ khi thanh toán thành công, POLY CINEMAS
                        sẽ gửi
                        Quý khách mã xác nhận thông tin vé/đơn hàng qua email của Quý khách.
                        Nếu Quý
                        khách cần hỗ trợ hay thắc mắc, khiếu nại về xác nhận mã vé/đơn hàng
                        thì vui
                        lòng phản hồi về Fanpage Facebook POLY CINEMAS trong vòng 60 phút kể
                        từ khi
                        thanh toán vé thành công. Sau khoảng thời gian trên, POLY CINEMAS sẽ
                        không
                        chấp nhận giải quyết bất kỳ khiếu nại nào.</li>
                    <li>4. POLY CINEMAS không chịu trách nhiệm trong trường hợp thông tin
                        địa chỉ
                        email, số điện thoại Quý khách nhập không chính xác dẫn đến không
                        nhận được
                        thư xác nhận. Vui lòng kiểm tra kỹ các thông tin này trước khi thực
                        hiện
                        thanh toán. POLY CINEMAS không hỗ trợ xử lý và không chịu trách
                        nhiệm trong
                        trường hợp đã gửi thư xác nhận mã vé/đơn hàng đến địa chỉ email của
                        Quý
                        khách nhưng vì một lý do nào đó mà Quý khách không thể đến xem phim.
                    </li>
                    <li>5. Vui lòng kiểm tra thông tin xác nhận vé cẩn thận và ghi nhớ mã
                        đặt vé/đơn
                        hàng. Khi đến nhận vé/hàng hóa tại Quầy vé của POLY CINEMAS, Quý
                        khách cũng
                        cần mang theo giấy tờ tùy thân như Căn cước công dân/Chứng minh nhân
                        dân,
                        Thẻ học sinh, Thẻ sinh viên hoặc hộ chiếu.</li>
                    <li>7. Vì một số sự cố kỹ thuật bất khả kháng, suất chiếu có thể bị huỷ
                        để đảm
                        bảo an toàn tối đa cho khách hàng, POLY CINEMAS sẽ thực hiện hoàn
                        trả số
                        tiền giao dịch về tài khoản mà Quý khách đã thực hiện mua vé. Beta
                        Cinemas
                        sẽ liên hệ với Quý khách qua các thông tin liên hệ trong mục Thông
                        tin thành
                        viên để thông báo và xác nhận.</li>
                    <li>8. Nếu Khách hàng mua vé tại website, khi đến quầy tại rạp cần xuất trình hóa đơn để nhân viên đối chiếu và cung cấp cho bạn vé vào rạp xem phim !.</li>
                </ul>',

            'terms_of_service_image' => 'theme/client/images/header/P.svg',

            'terms_of_service' => 'Đây là  điều khoản Dịch vụ',
            'introduction_image' => 'theme/client/images/thumbnail-1-144816-050424-68.jpeg',
            'introduction' => '
            <p>F5 Poly Media được thành lập bởi doanh nhân F5 Poly Cinemas (F5 Poly Beta) vào cuối năm 2014 với sứ mệnh "Mang trải nghiệm điện ảnh với mức giá hợp lý cho mọi người dân Việt Nam".</p>
            <p>Với thiết kế độc đáo, trẻ trung, F5 Poly Cinemas mang đến trải nghiệm điện ảnh chất lượng với chi phí đầu tư và vận hành tối ưu - nhờ việc chọn địa điểm phù hợp, tận dụng tối đa diện tích, bố trí khoa học, nhằm duy trì giá vé xem phim trung bình chỉ từ 40,000/1 vé - phù hợp với đại đa số người dân Việt Nam.</p>
            <p>Năm 2023 đánh dấu cột mốc vàng son cho Poly Cinemas khi ghi nhận mức tăng trưởng doanh thu ấn tượng 150% so với năm 2019 - là năm đỉnh cao của ngành rạp chiếu phim trước khi đại dịch Covid-19 diễn ra. Thành tích này cho thấy sức sống mãnh liệt và khả năng phục hồi ấn tượng của chuỗi rạp.</p>
            <p>Tính đến thời điểm hiện tại, Poly Cinemas đang có 20 cụm rạp trải dài khắp cả nước, phục vụ tới 6 triệu khách hàng mỗi năm, là doanh nghiệp dẫn đầu phân khúc đại chúng của thị trường điện ảnh Việt. Poly Media cũng hoạt động tích cực trong lĩnh vực sản xuất và phát hành phim.</p>
            <p>Ngoài đa số các cụm rạp do Poly Media tự đầu tư, ¼ số cụm rạp của Poly Media còn được phát triển bằng hình thức nhượng quyền linh hoạt. Chi phí đầu tư rạp chiếu phim Poly Cinemas được tối ưu giúp nhà đầu tư dễ dàng tiếp cận và nhanh chóng hoàn vốn, mang lại hiệu quả kinh doanh cao và đảm bảo.</p>',
            'copyright' => 'Bản quyền © 2024 Poly Cinemas',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function generateSeatStructure1()
    {

        // 4 hàng đầu tiên: Ghế thường
        $structure = "[{\"coordinates_x\":\"2\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"6\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"8\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"1\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"2\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"6\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"8\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"12\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"1\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"2\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"6\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"8\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"12\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"1\",\"coordinates_y\":\"E\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"2\",\"coordinates_y\":\"E\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"E\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"E\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"E\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"6\",\"coordinates_y\":\"E\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"E\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"8\",\"coordinates_y\":\"E\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"E\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"E\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"E\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"12\",\"coordinates_y\":\"E\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"1\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"2\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"6\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"8\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"12\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"1\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"2\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"6\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"8\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"12\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"1\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"2\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"6\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"8\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"12\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"1\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"2\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"6\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"8\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"12\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"1\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"2\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"6\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"8\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"12\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"1\",\"coordinates_y\":\"L\",\"type_seat_id\":\"3\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"L\",\"type_seat_id\":\"3\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"L\",\"type_seat_id\":\"3\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"L\",\"type_seat_id\":\"3\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"L\",\"type_seat_id\":\"3\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"L\",\"type_seat_id\":\"3\"}]";
        return $structure;
    }
    private function generateSeatStructure2()
    {

        // 4 hàng đầu tiên: Ghế thường
        $structure = "[{\"coordinates_x\":\"2\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"6\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"8\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"12\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"13\",\"coordinates_y\":\"A\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"1\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"2\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"6\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"8\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"12\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"13\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"14\",\"coordinates_y\":\"B\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"1\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"2\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"6\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"8\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"12\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"13\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"14\",\"coordinates_y\":\"C\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"1\",\"coordinates_y\":\"D\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"2\",\"coordinates_y\":\"D\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"D\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"D\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"D\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"6\",\"coordinates_y\":\"D\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"D\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"8\",\"coordinates_y\":\"D\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"D\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"D\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"D\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"12\",\"coordinates_y\":\"D\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"13\",\"coordinates_y\":\"D\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"14\",\"coordinates_y\":\"D\",\"type_seat_id\":\"1\"},{\"coordinates_x\":\"1\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"2\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"6\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"8\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"12\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"13\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"14\",\"coordinates_y\":\"F\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"1\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"2\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"6\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"8\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"12\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"13\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"14\",\"coordinates_y\":\"G\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"1\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"2\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"6\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"8\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"12\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"13\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"14\",\"coordinates_y\":\"H\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"1\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"2\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"6\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"8\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"12\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"13\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"14\",\"coordinates_y\":\"I\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"1\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"2\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"6\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"8\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"12\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"13\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"14\",\"coordinates_y\":\"J\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"1\",\"coordinates_y\":\"K\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"2\",\"coordinates_y\":\"K\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"K\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"K\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"K\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"6\",\"coordinates_y\":\"K\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"K\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"8\",\"coordinates_y\":\"K\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"K\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"K\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"K\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"12\",\"coordinates_y\":\"K\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"13\",\"coordinates_y\":\"K\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"14\",\"coordinates_y\":\"K\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"1\",\"coordinates_y\":\"L\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"2\",\"coordinates_y\":\"L\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"3\",\"coordinates_y\":\"L\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"L\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"5\",\"coordinates_y\":\"L\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"6\",\"coordinates_y\":\"L\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"L\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"8\",\"coordinates_y\":\"L\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"9\",\"coordinates_y\":\"L\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"L\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"11\",\"coordinates_y\":\"L\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"12\",\"coordinates_y\":\"L\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"13\",\"coordinates_y\":\"L\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"14\",\"coordinates_y\":\"L\",\"type_seat_id\":\"2\"},{\"coordinates_x\":\"1\",\"coordinates_y\":\"N\",\"type_seat_id\":\"3\"},{\"coordinates_x\":\"4\",\"coordinates_y\":\"N\",\"type_seat_id\":\"3\"},{\"coordinates_x\":\"7\",\"coordinates_y\":\"N\",\"type_seat_id\":\"3\"},{\"coordinates_x\":\"10\",\"coordinates_y\":\"N\",\"type_seat_id\":\"3\"},{\"coordinates_x\":\"13\",\"coordinates_y\":\"N\",\"type_seat_id\":\"3\"}]";
        return $structure;
    }
}
