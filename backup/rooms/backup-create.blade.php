<div class="row">
    <div class="col-lg-12">
        <div class="card card-left">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Sơ đồ ghế</h4>
            </div><!-- end card header -->
            <div class="card-body ">

                    <table class="table-none align-middle mx-auto table-bordered text-center">
                        <tbody>
                            <!-- Row A -->
                            <tr>
                                @for ($i =0 ; $i < 10 ; $i++)
                                    <td>
                                        <img src="{{ asset('svg/seat-regular.svg') }}" width="35px">
                                    </td>
                                @endfor
                                <td>
                                    <span class="btn btn-link edit-btn">
                                        <i class="fas fa-edit edit-icon"></i>
                                    </span>
                                </td>
                            </tr>
                            <!-- Row B -->
                            <tr>
                                @for ($i =0 ; $i < 10 ; $i++)
                                    <td>
                                        <img src="{{ asset('svg/seat-vip.svg') }}" width="35px">
                                    </td>
                                @endfor
                                <td>
                                    <span class="btn btn-link edit-btn">
                                        <i class="fas fa-edit edit-icon"></i>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                @for ($i =0 ; $i < 5 ; $i++)
                                    <td colspan="2">
                                        <img src="{{ asset('svg/seat-double.svg') }}" width="45px">
                                    </td>
                                @endfor
                                <td>
                                    <span class="btn btn-link edit-btn">
                                        <i class="fas fa-edit edit-icon"></i>
                                    </span>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>



                <div class="col-md-12 w-75 mx-auto content-room-seat">

                    <div class="list-seats">
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('svg/seat-regular.svg') }}" class='seat' width="40px">
                                    <span class=" fs-5 mx-2">Ghế thường</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('svg/seat-vip.svg') }}" class='seat' width="40px">
                                    <span class=" fs-5 mx-2">Ghế Vip</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="d-flex align-items-center">
                                    {{-- <div class="d-flex"> --}}
                                        <img src="{{ asset('svg/seat-double.svg') }}" class='seat' width="40px">
                                        {{-- <img src="{{ asset('svg/seat-vip.svg') }}" class='seat' width="40px">
                                        <img src="{{ asset('svg/seat-vip.svg') }}" class='seat' width="40px"> --}}
                                    {{-- </div> --}}
                                    <span class=" fs-5 mx-2 ">Ghế Đôi</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="srceen">
                        Màn Hình Chiếu
                    </div>

                    <div class="layout-seat">
                        <div class='seat seat-row text-center '>
                            @for($i = 0; $i < 14; $i++)
                                <div class="seat-item">
                                    <img src="{{ asset('svg/seat-regular.svg') }}" class='seat' width="40px">
                                    <span class="seat-label">A{{ $i+1 }}</span>
                                </div>
                            @endfor
                        </div>
                        <div class='seat seat-row text-center '>
                            @for($i = 0; $i < 16; $i++)
                                <div class="seat-item">
                                    <img src="{{ asset('svg/seat-regular.svg') }}" class='seat' width="40px">
                                    <span class="seat-label">A{{ $i+1 }}</span>
                                </div>
                            @endfor
                        </div>
                        <div class='seat seat-row text-center '>
                            @for($i = 0; $i < 17; $i++)
                                <div class="seat-item">
                                    <img src="{{ asset('svg/seat-regular.svg') }}" class='seat' width="40px">
                                    <span class="seat-label">A{{ $i+1 }}</span>
                                </div>
                            @endfor
                        </div>
                        <div class='seat seat-row text-center '>
                            @for($i = 0; $i < 18; $i++)
                                <div class="seat-item">
                                    <img src="{{ asset('svg/seat-vip.svg') }}" class='seat' width="40px">
                                    <span class="seat-label">A{{ $i+1 }}</span>
                                </div>
                            @endfor
                        </div>
                        <div class='seat seat-row text-center '>
                            @for($i = 0; $i < 18; $i++)
                                <div class="seat-item">
                                    <img src="{{ asset('svg/seat-vip.svg') }}" class='seat' width="40px">
                                    <span class="seat-label">A{{ $i+1 }}</span>
                                </div>
                            @endfor
                        </div>
                        <div class='seat seat-row text-center '>
                            @for($i = 0; $i < 18; $i++)
                                <div class="seat-item">
                                    <img src="{{ asset('svg/seat-vip.svg') }}" class='seat' width="40px">
                                    <span class="seat-label">A{{ $i+1 }}</span>
                                </div>
                            @endfor
                        </div>
                        {{-- <div class='seat seat-row text-center '>
                            @for($i = 0; $i < 18; $i++)
                                <div class="seat-item">
                                    <img src="{{ asset('svg/seat-double.svg') }}" class='seat' width="45px">
                                    <span class="seat-label">A{{ $i+1 }}</span>
                                </div>
                            @endfor
                        </div>
                        <div class='seat seat-row text-center '>
                            @for($i = 0; $i < 18; $i++)
                                <div class="seat-item">
                                    <img src="{{ asset('svg/seat-double.svg') }}" class='seat' width="45px">
                                    <span class="seat-label">A{{ $i+1 }}</span>
                                </div>
                            @endfor
                        </div> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>








code có style màu màu cho ghế đôi


<style>
    .light-orange {
        background-color: #ffd997;
        /* Màu cam nhạt */
    }

    .light-blue {
        background-color: #d0e7f9;
        /* Màu xanh da trời nhạt */
    }

    .light-pink {
        background-color: #f9d0d0;
        /* Màu hồng nhạt */
    }
</style>

<table class="table-none align-middle mx-auto text-center">
    <thead>
        <tr>
            <th></th> <!-- Ô trống góc trên bên trái -->
            @for ($col = 0; $col < App\Models\Room::MAX_COL; $col++)
                <th class="box-item">
                    {{-- thao tác 1 loạt trên 1 cột --}}
                    <input type="checkbox" name="col_checkbox_{{ $col + 1 }}" value="{{ $col + 1 }}">
                </th>
            @endfor
            <th></th> <!-- Ô trống góc trên bên trái -->
        </tr>
    </thead>
    <tbody>
        @for ($row = 0; $row < App\Models\Room::MAX_ROW; $row++)
            <tr>
                {{-- cột hàng ghế A,B,C --}}
                <td class="box-item">
                    {{ chr(65 + $row) }}
                </td>
                @for ($col = 0; $col < App\Models\Room::MAX_COL; $col++)
                    <td class="box-item border-1
                        {{ $row < App\Models\Room::ROW_SEAT_REGULAR ? 'light-orange' : ($row >= App\Models\Room::MAX_ROW - 2 ? 'light-pink' : 'light-blue') }}">
                        {{ chr(65 + $row) }}{{ $col + 1 }}
                        <input type="hidden" name="hi"
                            value="{{ $row < App\Models\Room::ROW_SEAT_REGULAR ? 'cam' : ($row >= App\Models\Room::MAX_ROW - 2 ? 'hong' : 'xanh') }}">
                    </td>
                @endfor
                <td class="box-item">
                    {{-- thao tác 1 loạt trên 1 hàng --}}
                    <input type="checkbox" name="row_checkbox_{{ $row + 1 }}" value="{{ chr(65 + $row) }}">
                </td>
            </tr>
        @endfor
    </tbody>
</table>
