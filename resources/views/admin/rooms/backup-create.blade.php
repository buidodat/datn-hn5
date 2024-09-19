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
