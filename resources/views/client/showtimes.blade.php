@extends('client.layouts.master')

@section('title')
    Lịch chiếu
@endsection

@section('content')
    <div class="">
        <div class="container">
            <div class="date-container">
                @foreach ($days as $day)
                    <div class="date-item">
                        <span class="date">{{ $day['date'] }}</span> -
                        <span class="weekday">{{ $day['weekday'] }}</span>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="st_indx_slider_main_container float_left">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row ">
                                    <div class="col-md-4 image-movie-detail">
                                        {{-- @php
                                        $url = $movie->img_thumbnail;

                                        if (!\Str::contains($url, 'http')) {
                                            $url = Storage::url($url);
                                        }
                                    @endphp
                                    <img src="{{ $url }}"
                                         alt="" height=""> --}}
                                        <img src="https://files.betacorp.vn/media%2fimages%2f2024%2f08%2f27%2f400x633%2D13%2D093512%2D270824%2D67.jpg"
                                            alt="">
                                    </div>
                                    <div class="col-md-8 ">
                                        <div class="movie-detail-content">
                                            <div class="title-movie-detail">
                                                {{-- <h1>{{ $movie->name }}</h1> --}}
                                            </div>
                                            <div class="description">
                                                <p>
                                                    {{-- {{ $movie->description }} --}}
                                                </p>
                                            </div>
                                            <div class="details ">
                                                {{-- <ul>
                                                <li>
                                                    <strong>Phân loại:</strong> {{ $movie->rating }}
                                                </li>

                                                <li>
                                                    <strong>Đạo diễn:</strong> {{ $movie->director }}
                                                </li>
                                                <li>
                                                    <strong>Diễn viên:</strong> {{ $movie->cast }}
                                                </li>
                                                <li>
                                                    <strong>Thể loại:</strong> {{ $movie->category }}
                                                </li>
                                                <li>
                                                    <strong>Khởi chiếu:</strong> {{ $movie->release_date }}
                                                </li>
                                                <li>
                                                    <strong>Thời lượng:</strong> {{ $movie->duration }} phút
                                                </li>
                                                <li>
                                                    <strong>Ngôn ngữ:</strong> Vietsub
                                                </li>
                                            </ul> --}}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('styles')
    <style>
        .date-container {
            display: flex;
            justify-content: space-around;
            padding: 20px;
        }

        .date-item {
            text-align: center;
            padding: 10px;
        }

        .date-item .date {
            font-size: 24px;
            font-weight: bold;
            color: blue;
        }

        .date-item .weekday {
            font-size: 18px;
            color: #333;
        }
    </style>
@endsection
