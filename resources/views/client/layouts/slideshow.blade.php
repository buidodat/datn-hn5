<div class="prs_main_slider_wrapper">
    <div id="rev_slider_41_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="food-carousel26"
        data-source="gallery" style="margin:0px auto;padding:0px;margin-top:0px;margin-bottom:0px;">
        <div class="prs_slider_overlay"></div>
        <!-- START REVOLUTION SLIDER 5.4.1 fullwidth mode -->
        <div id="rev_slider_41_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.1">
            <ul>
                @foreach($slideShow as $index => $slide)
                    <!-- SLIDE -->
                    @if(!empty($slide->img_thumbnail))
                        @if(is_array($slide->img_thumbnail))
                            <!-- Nếu img_thumbnail là mảng ảnh fake (JSON giải mã) -->
                            @foreach($slide->img_thumbnail as $image)
                                @php
                                    $image = Storage::url($image);
                                @endphp
                                <li data-index="{{ $slide->id }}" data-transition="fade" data-slotamount="7" data-hideafterloop="0"
                                    data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300"
                                    data-rotate="0" data-saveperformance="off" data-title="" data-param1=""
                                    data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7=""
                                    data-param8="" data-param9="" data-param10="" data-description="{{ $slide->description }}">

                                    <!-- MAIN IMAGE -->
                                    <img src="{{ $image }}" alt="" data-bgposition="center center" data-bgfit="contain"
                                         data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                </li>
                            @endforeach
                        @endif
                    @else
                        <li>Không có ảnh!</li>
                    @endif
                @endforeach

            </ul>
            <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
        </div>
    </div>
    <!-- END REVOLUTION SLIDER -->
</div>
