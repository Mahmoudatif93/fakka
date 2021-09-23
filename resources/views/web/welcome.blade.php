@extends('layouts.web.app')

@section('content')
@include('layouts.web.banners.banner')

<main>
    @if(session()->get('error') !=null)
    {{ session()->get('error') }}

    @endif

    @if(session()->get('success') !=null)
    {{-- session()->get('success') --}}

    @endif
    <div class="own-ingots">
        <div class="container">
            <div class="subtitle">
                <h3>
                    @lang('site.own-ingots_h')
                </h3>
            </div>
            <p>
                @lang('site.own-ingots_p')
            </p>
            <a href="{{ route('fakka.virtualgold.index') }}" class="btn blue-btn ss">
                @lang('site.own-ingots_a')
            </a>


        </div>
    </div>
    <div class="products">
        <div class="container">
            <div class="subtitle">
                <h3>
                    @lang('site.HotProducts')
                </h3>
            </div>

            @if ($clients_payments->count() > 0)
            <div class="grid-container">
                @foreach ($clients_payments as $index=>$product)

                <div class="grid-item">
                    <a class="products-img " target="_blank" href="{{ route('fakka.productdetails',$product->Product->id) }}">
                        <figure>
                            <img src="{{ $product->Product->image_path }}" class="img-thumbnail" alt="">
                        </figure>
                    </a>
                    <div class="details">

                        <div class="gold-name">
                            <h4>
                                {{ $product->Product->name }}
                            </h4>
                            <h4>
                                @if( $product->Product->category_id ==1)
                                {{ round(
                            $product->Product->number_grams  * $egy
                                 +
                                 $product->Product->number_grams   * $product->Product->fees
                                            , 2)}} EGP

                                @else

                                {{ round(
                        $product->Product->number_grams * $egy * 0.875
                                    +
                                    $product->Product->number_grams  * $product->Product->fees
                             , 2)

                                                                }} EGP


                                @endif

                            </h4>
                            <span>
                                {{ $product->Product->number_grams }} (@lang('site.Gram'))
                            </span>





                        </div>
                        <button onclick="add_tocart('{{$product->Product->id}}')" class=" light-background ">
                            <figure>
                                <img src="{{ asset('web_files/images/add-to-cart (arrow).svg') }} " alt="">
                            </figure>
                        </button>
                    </div>
                </div>
                @endforeach

            </div>
            @else

            <h2>@lang('site.no_data_found')</h2>

            @endif

            <a href="{{ route('fakka.products.index') }}" class="btn outline-btn">
                @lang('site.Viewallproducts')

            </a>


        </div>
    </div>



    <div class="reasons">
        <div class="testimonial-area">
            <div class="container">
                <div class="title" style="font-size:34px; margin-bottom:25px">
                    <h2 style="color:#015cab">
                        Why Fakka.org ?
                    </h2>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-lg-offset-0 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                        <div class="row" style="justify-content: center;">
                            <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
                                <div class="testimonial-image-slider slider-nav text-center">
                                    <div class="sin-testiImage">
                                        <img src=" {{ asset('web_files/images/1 Real time gold price 2.jpg') }}">
                                    </div>
                                    <div class="sin-testiImage">
                                        <img src="{{ asset('web_files/images/2 Premium gold products.jpeg') }} ">
                                    </div>
                                    <div class="sin-testiImage">
                                        <img src="{{ asset('web_files/images/3 Transparency & clear 2.jpg') }} ">
                                    </div>
                                    <div class="sin-testiImage">
                                        <img src="{{ asset('web_files/images/4 E payment 1.jpg') }} ">
                                    </div>
                                    <div class="sin-testiImage">
                                        <img src="{{ asset('web_files/images/5 No storage risk.jpg') }} ">
                                    </div>
                                    <div class="sin-testiImage">
                                        <img src="{{ asset('web_files/images/6 Security.jpg') }} ">
                                    </div>
                                    <div class="sin-testiImage">
                                        <img src="{{ asset('web_files/images/7 Registered Company1.jpg') }} ">
                                    </div>
                                    <div class="sin-testiImage">
                                        <img src="{{ asset('web_files/images/8 Small quantities.jpg') }} ">
                                    </div>
                                    <div class="sin-testiImage">
                                        <img src="{{ asset('web_files/images/9 Minimum fees.jpg') }} ">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-text-slider slider-for text-center">
                            <div class="sin-testiText">
                                <h2>@lang('site.testiTexth1') </h2>
                                <p>
                                    @lang('site.testiTextp1')
                                </p>
                            </div>
                            <div class="sin-testiText">
                                <h2> @lang('site.Premiumgoldproducts')</h2>
                                <p>
                                    @lang('site.testiTextp2')
                                </p>
                            </div>
                            <div class="sin-testiText">
                                <h2>
                                    @lang('site.testiTexth3')
                                </h2>
                                <p>
                                    @lang('site.testiTextp3')
                                </p>
                            </div>
                            <div class="sin-testiText">
                                <h2>
                                    @lang('site.testiTexth4')
                                </h2>
                                <p>
                                    @lang('site.testiTextp4')
                                </p>
                            </div>
                            <div class="sin-testiText">
                                <h2>
                                    @lang('site.testiTexth5')
                                </h2>
                                <p>
                                    @lang('site.testiTextp5')
                                </p>
                            </div>
                            <div class="sin-testiText">
                                <h2>
                                    @lang('site.testiTexth6')
                                </h2>
                                <p>
                                    @lang('site.testiTextp6')
                                </p>
                            </div>
                            <div class="sin-testiText">
                                <h2>
                                    @lang('site.testiTexth7')
                                </h2>
                                <p>
                                    @lang('site.testiTextp7')
                                </p>
                            </div>
                            <div class="sin-testiText">
                                <h2>
                                    @lang('site.testiTexth8')

                                </h2>
                                <p>
                                    @lang('site.testiTextp8')
                                </p>
                            </div>

                            <div class="sin-testiText">
                                <h2>
                                    @lang('site.testiTexth9')
                                </h2>
                                <p>
                                    @lang('site.testiTextp9')
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact">
        <div class="container">
            <div class="title">
                <h2>
                    @lang('site.contacth')
                </h2>
            </div>
            <p>
                @lang('site.contactp')
            </p>
            <a href="{{ route('fakka.contactus.index') }}">
                @lang('site.Contactus')
            </a>
        </div>
    </div>



    <!-- <pre id="tab">This    text      has    lots of     spaces</pre>-->


</main>





<script src="{{ asset('web_files/js/slick.min.js') }} "></script>


<script>
    function add_tocart(id) {

        var url = '{{URL::to("/home-to-cart")}}' + "/" + id;
        var menu = $('#menu').val();
        data = {
            id: id,
            _token: "{{csrf_token()}}",
        };
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            data: data,
            success: function(response) {

                let text = "@lang('site.cartalert')";
                swal({

                        title: text,
                        text: "  ",
                        buttons: false,
                        icon: "warning",
                        timer: 1000
                    })
                    .then((willDelete) => {
                        $('body').load(menu)
                    });


            },
            error: function(response) {
                swal(response);


            }
        });
    }
</script>
<link rel="stylesheet" href="{{ asset('dashboard_files/plugins/noty/noty.css') }}">
<script src="{{ asset('dashboard_files/plugins/noty/noty.min.js') }}"></script>

<script>
    $('.delete').click(function(e) {

        var that = $(this)

        e.preventDefault();

        var n = new Noty({
            text: "@lang('site.confirm_delete')",
            type: "warning",
            killer: true,
            buttons: [
                Noty.button("@lang('site.yes')", 'btn btn-success mr-2', function() {
                    that.closest('form').submit();
                }),

                Noty.button("@lang('site.no')", 'btn btn-primary mr-2', function() {
                    n.close();
                })
            ]
        });

        n.show();

    }); //end of delete



</script>


@if(Session::get('locale') == 'ar')
<script>

$('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        draggable: false,
        fade: true,
        asNavFor: '.slider-nav',
        autoplay: true,
        autoplaySpeed: 1700,
        rtl: true,
    });
    /*------------------------------------
    	Testimonial Slick Carousel as Nav
    --------------------------------------*/
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        arrows: true,
        centerMode: true,
        focusOnSelect: true,
        centerPadding: '10px',
        rtl: true,
        responsive: [{
                breakpoint: 450,
                settings: {
                    dots: false,
                    slidesToShow: 3,
                    centerPadding: '0px',
                }
            },
            {
                breakpoint: 420,
                settings: {
                    autoplay: true,
                    dots: false,
                    slidesToShow: 1,
                    centerMode: false,
                }
            }
        ]
    });
</script>

@else
<script>

$('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        draggable: false,
        fade: true,
        asNavFor: '.slider-nav',
        autoplay: true,
        autoplaySpeed: 1700,
    });
    /*------------------------------------
    	Testimonial Slick Carousel as Nav
    --------------------------------------*/
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        arrows: true,
        centerMode: true,
        focusOnSelect: true,
        centerPadding: '10px',
        responsive: [{
                breakpoint: 450,
                settings: {
                    dots: false,
                    slidesToShow: 3,
                    centerPadding: '0px',
                }
            },
            {
                breakpoint: 420,
                settings: {
                    autoplay: true,
                    dots: false,
                    slidesToShow: 1,
                    centerMode: false,
                }
            }
        ]
    });
</script>


@endif

















<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection

@push('scripts')
