@extends('client.layouts.master')

@section('title')
    Choose Seat
@endsection

@section('content')
    <div class="st_dtts_wrapper float_left">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="st_dtts_left_main_wrapper float_left">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="st_dtts_ineer_box float_left">
                                    <ul>
                                        <li><span class="dtts1">Date</span> <span class="dtts2">19-Dec-2018</span>
                                        </li>
                                        <li><span class="dtts1">Time</span> <span class="dtts2">10:00PM</span>
                                        </li>
                                        <li><span class="dtts1">Theater</span> <span class="dtts2">Ariesplex SL
                                                Cinemas</span>
                                        </li>
                                        <li><span class="dtts1">Seat</span> <span class="dtts2">PLATINUM - PB7, PB8 (2
                                                Tickets) </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="st_cherity_section float_left">
                                    <div class="st_cherity_img float_left">
                                        <img src="images/content/cc1.jpg" alt="img">
                                    </div>
                                    <div class="st_cherity_img_cont float_left">
                                        <div class="box">
                                            <p class="cc_pc_color1">
                                                <input type="checkbox" id="c201" name="cb">
                                                <label for="c201"><span>ADD Rs. 2</span> to your transaction as a
                                                    donation. (Uncheck if you do not wish to donate)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="st_cherity_btn float_left">
                                    <h3>SELECT TICKET TYPE</h3>
                                    <ul>
                                        <li><a href="#"><i class="flaticon-tickets"></i> &nbsp;M-Ticket</a>
                                        </li>
                                        <li><a href="#"><i class="flaticon-tickets"></i> &nbsp;Box office Pickup </a>
                                        </li>
                                        <li><a href="confirmation_screen.html">Proceed to Pay </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="st_dtts_bs_wrapper float_left">
                                <div class="st_dtts_bs_heading float_left">
                                    <p>Booking summary</p>
                                </div>
                                <div class="st_dtts_sb_ul float_left">
                                    <ul>
                                        <li>Platinum - PB7, PB8
                                            <br>( 2 Tickets ) AUDI-5 <span>Rs . 790.00</span>
                                        </li>
                                        <li>Internet handling fees <span>Rs.70.80</span>
                                        </li>
                                    </ul>
                                    <p>Booking Fees <span>Rs.60.00</span>
                                    </p>
                                    <p>Integrated GST (IGST) @ 18% <span>Rs.60.00</span>
                                    </p>
                                </div>
                                <div class="st_dtts_sb_h2 float_left">
                                    <h3>Sub total <span>Rs.860.80</span></h3>
                                    <h4>Current State is <span>Kerala</span></h4>
                                    <h5>Payable Amount <span>Rs.860.80</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
