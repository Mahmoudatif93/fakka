<!DOCTYPE html>
<html lang="en" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>fakka.org</title>
    <link rel="icon" href="{!! asset('web_files/images/fakka.png') !!}" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preconnec    t" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <link rel="stylesheet" href="{{ asset('web_files/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('web_files/css/arabic rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('web_files/scss/custom.css') }}">

    <link rel="stylesheet" href="{{ asset('web_files/css/slick.css') }} ">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-1PEBCRJLJW"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-1PEBCRJLJW');
</script>
    <style>
        .navbar-nav {
            margin-left: auto;
        }

        .nav-link {
            color: #80ADD5;
            font-size: 20px;
            transition: .3s;
            margin-left: 31px;
        }

        .nav-link:hover {
            color: #015CAB;
        }

        ul.navbar-nav {
            align-items: baseline;
        }

        a#menu {
            display: flex;
            align-items: flex-start;
        }

        .cart {
            position: relative;
            margin-left: 30px;
        }

        .cart a {
            display: flex;
            color: #015CAB;
            font-size: 20px;
        }

        .cart a figure {
            margin-right: 17px;
            margin-bottom: 0;
        }

        .cart a figure svg {
            width: 22px;
            fill: #015CAB;
        }


        span.count {
            position: absolute;
            top: -7px;
            right: 50px;
            font-size: 14px;
            background: #015CAB;
            border-radius: 50%;
            width: 19px;
            height: 19px;
            color: white;
            align-items: center;
            display: flex;
            justify-content: center;
        }


        li.menu-area {
            position: relative;
        }

        .menu {
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        /* .dropdown-menu {
            opacity: 0;
            position: absolute;
            margin-top: 20px;
            right: -7px;
            background: #f5f5f5;
            width: 350px;
            border-radius: 8px;
            transition: 0.5s all ease;
            padding: 18px 10px;
            padding-right: 18px;
        }

        .dropdown-menu .details a {
            display: block;
        }
*/
        .item {
            align-items: center;
        }

        .item-details {
            display: flex;
        }

        .info {
            text-align: left;
            margin-top: 10px;
        }

        .info h4 {
            font-weight: 600;
            font-size: 20px;
        }

        .info p {
            padding-top: 5px;
            font-size: 20px;
        }


        .total {
            display: flex;
            align-items: center;
            border-top: 1px solid #80add5;
            padding-top: 15px;
            margin-top: 15px;
        }

        .price {
            display: flex;
            align-items: center;
            font-size: 20px;
        }

        .price span {
            color: #80add5;
        }

        .price p {
            color: #015CAB;
            padding-left: 10px;
            font-weight: 600;
        }


        .view-btn {
            background: #015CAB;
            padding: 15px;
            width: 100px;
            margin-left: auto;
            border-radius: 5px;
        }

        .view-btn a {
            color: white;
        }


        .show-dropdown-menu {
            opacity: 1;
            transition: 0.5s all ease;
        }


        .navbar-dark .navbar-toggler {
            background-color: #015CAB;
            margin-left: auto;
            margin-right: 15px;
        }


        .navbar-collapse .navbar-nav .nav-item {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="topbar">
        <div class="container">
            <div class="social">
                <a href="https://www.facebook.com/Fakkadotorg/">
                    <figure>
                        <svg viewBox="0 0 23.469 23.469">
                            <use xlink:href="{{ asset('web_files/images/sprite.svg#fb') }}"></use>
                        </svg>
                    </figure>
                </a>
                <a href="https://www.linkedin.com/company/fakkaorg/">
                    <figure>
                        <svg viewBox="0 0 23.075 23.075">
                            <use xlink:href="{{ asset('web_files/images/sprite.svg#linkedin') }}"></use>
                        </svg>
                    </figure>
                </a>
                <a href="https://www.instagram.com/fakkadotorg/">
                    <figure>
                        <svg viewBox="0 0 23.1 23.1">
                            <use xlink:href="{{ asset('web_files/images/sprite.svg#insta') }}"></use>
                        </svg>
                    </figure>
                </a>
                <a href="https://www.youtube.com/channel/UC6ripzcXn1xj7ItFReNG7xw">
                    <figure>
                        <svg viewBox="0 0 32.999 23">
                            <use xlink:href="{{ asset('web_files/images/sprite.svg#youtube') }} "></use>
                        </svg>
                    </figure>
                </a>
            </div>
            <div class="right-side">
                <div class="language">
                    <select onchange="location = this.value;" name="" id="" class="dropdown">

                        <option value="" selected disabled hidden>
                            @if(Session::get('locale') == 'ar'){{ 'العربية'}}
                            @else
                            {{'English'}}
                            @endif

                        </option>

                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                        <option value="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">

                                {{ $properties['native'] }}
                            </a>
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="login" style="margin:-10px">
                    @if(Auth::guard('website')->check() !=1)
                    <a href="{{ route('fakka.client.index') }}">
                        @lang('site.register')
                    </a>
                    /
                    <a href="{{ route('fakka.login') }}">
                        @lang('site.Login')
                    </a>

                    @else
                    <select onchange="location = this.value;" name="" id="" class="dropdown show">

                        <option value="" selected disabled hidden> {{Auth::guard('website')->user()->first_name}}</option>


                        <option value="{{ route('fakka.profile.index') }}">
                            <a href="{{ route('fakka.profile.index') }}" class="btn btn-default btn-flat">@lang('site.profile')</a>
                        </option>
                        <option value="{{ route('fakka.logout2') }}">
                            <a href="{{ route('fakka.logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">@lang('site.logout')</a>
                            <form id="logout-form" action="{{ route('fakka.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </option>
                    </select>
                    @endif
                </div>


                <div style="padding-left: 25px;font-size: 20px;font-weight: 700;">
                    <!--  <h1>  @if(Auth::guard('website')->check() ==1) {{Auth::guard('website')->user()->first_name}}</h1>@endif-->
                </div>
            </div>
        </div>
    </div>
    <header>
        <div class="container" style="display:block;">
            <nav class="navbar navbar-expand-md navbar-dark" style="margin-left:0;">
            <a href="{{ route('fakka.index') }}">
                    <figure>
                        <img style="width: 150px;" src="{{ asset('web_files/images/logo.png') }}" alt="">
                    </figure>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ route('fakka.index') }}">
                                @lang('site.home')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('fakka.products.index') }}">
                                @lang('site.OurProducts')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('fakka.about_us') }}">
                                @lang('site.AboutUs')
                            </a>
                        </li>
                        <!--  <li class="nav-item">
                            <a class="nav-link" href="#">Blog</a>
                        </li>-->
                        <li class="nav-item">
                            <a href="{{ route('fakka.contactus.index') }}">
                                @lang('site.ContactUs')
                            </a>
                        </li>


                        <li class="menu-area cart">
                            <a class="menu" id="menu" onclick="showDropdownMenu()">
                                <figure>
                                    <svg viewBox="0 0 22.5 20.622">
                                        <use xlink:href="{{ asset('web_files/images/sprite.svg#add-to-cart') }} "></use>
                                    </svg>
                                </figure>
                                <h5 style="color: #3f77ab;"> @lang('site.Cart')</h5>
                                <span class="badge">{{Session::has('cart') ? Session::get('cart')->totalQty : ''}}</span>
                            </a>



                            <div class="dropdown-menu" id="dropdown-menu">
                                <div class="menu-info">
                                    @if(Session::has('cart') || count($anotherproducts)!=0 )


                                    <div class="details">
                                        @if(!empty(Session::get('cart')))
                                        <?php $oldCart = Session::get('cart')->items;
                                        $totalPrice = Session::get('cart')->totalPrice;
                                        $total_price = 0;
                                        $total_price2 = 0;

                                        ?>
                                        <div>

                                            <div class="shopping-cart">
                                                <div class="cart-items">
                                                    <div class="items">
                                                        @foreach( $oldCart as $product)
                                                        <?php $total_price += $product['item']['number_grams']  * $egy * $product['qty']; ?>
                                                        <div class="item">
                                                            <div class="item-details">
                                                                <figure>
                                                                    <img style="width: 40px;height: 40px;" src="{{ asset('uploads/product_images/'.$product['item']['image']) }}" alt="">
                                                                </figure>
                                                                <div class="info">
                                                                    <h4>
                                                                        {{ $product['item']->name }} Qty:{{ $product['qty'] }}
                                                                    </h4>
                                                                    <p>
                                                                        @if( $product['item']->category_id ==1)

                                                                        {{ round(
                                                                    $product['item']['number_grams']  * $egy * $product['qty']
                                                                            +
                                                                            $product['item']['number_grams']  * $product['item']['fees']  * $product['qty']
                                                                    , 2)}} EGP
                                                                        @else

                                                                        {{ round(
                                                                    $product['item']['number_grams']  * $egy * 0.875 * $product['qty']
                                                                            +
                                                                            $product['item']['number_grams']  * $product['item']['fees']  * $product['qty']
                                                                    , 2)

                                                                }}


                                                                        EGP
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        @endif

                                        <div>
                                            @if(!empty($anotherproducts))
                                            <div class="shopping-cart">
                                                <div class="cart-items">
                                                    <div class="items">
                                                        @foreach( $anotherproducts as $anotherproduct)
                                                        <?php $total_price = 0;

                                                        $total_price2 += $anotherproduct['product']['number_grams'] * $egy * $anotherproduct['qty']; ?>
                                                        <div class="item">
                                                            <div class="item-details">
                                                                <figure>
                                                                    <img style="width: 40px;height: 40px;" src="{{ asset('uploads/product_images/'.$anotherproduct['product']['image']) }}" alt="">
                                                                </figure>
                                                                <div class="info">
                                                                    <h4>
                                                                        {{ $anotherproduct['ProductTranslation']['name'] }} Qty: {{ $anotherproduct['qty'] }}
                                                                    </h4>
                                                                    <p>
                                                                        @if( $anotherproduct['product']['category_id'] ==1)


                                                                        {{ round(
                                                                $anotherproduct['product']['number_grams'] * $egy * $anotherproduct['qty']
                                                                +
                                                                $anotherproduct['product']['fees'] * $anotherproduct['product']['number_grams'] * $anotherproduct['qty']
                                                                    , 2)

                                                                }}


                                                                        EGP

                                                                        @else


                                                                        {{ round(
                                                                $anotherproduct['product']['number_grams'] * $egy * 0.875 * $anotherproduct['qty']
                                                                +
                                                                $anotherproduct['product']['fees'] * $anotherproduct['product']['number_grams'] * $anotherproduct['qty']
                                                                    , 2)

                                                                }}


                                                                        EGP
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                        </div>


                                        <div class="total">
                                            <!-- <div class="price">
                                            <span>
                                                Total :
                                            </span>
                                            <p>
                                            EGP

                                            </p>
                                        </div>-->
                                            <div class="view-btn text-center">
                                                <a href=" {{ route('fakka.product.shoppingCart') }} ">
                                                    View
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <h4>
                                    There is No Products
                                </h4>
                                @endif
                            </div>

                        </li>
                    </ul>
                </div>


            </nav>

        </div>
    </header>
