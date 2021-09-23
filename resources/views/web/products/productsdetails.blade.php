@extends('layouts.web.app')

@section('content')

<main>
    <div class="products-details">
        <div class="container">
            <div>
                <div class="heading">
                    <div>
                        <span>
                            {{ $product->name }}
                        </span>
                        <h2>
                            {{ $product->number_grams }} @lang('site.gramBTCGold24k')
                        </h2>
                    </div>
                    <div class="right-side">
                        <div>
                            <h2 id="totalpriceall">




                                @if( $product->category_id ==1)

                                {{ round(
                                                                     $product->number_grams  * $egy
                                                                             +
                                                                             $product->number_grams * $product->fees
                                                                     , 2)}} EGP
                                @else

                                {{ round(
                                                                    $product->number_grams  * $egy * 0.875
                                                                    +
                                                                             $product->number_grams * $product->fees

                                                                     , 2)

                                                                 }}

                                EGP
                                @endif

                            </h2>
                        </div>
                        <div class="quantity">
                            <div class="quantity-control" data-quantity="">

                                <input style="font-size: 27px;text-align: center;" class="input" type="number" id="quantity" name="quantity" value="1" min="1" max="5">

                            </div>
                        </div>






                        <div>
                            <button onclick="add_towithquntitycart('{{$product->id}}')" class="btn blue-btn">
                                Add to cart
                            </button>
                        </div>
                    </div>
                </div>
                <div class="details">
                    <div class="item">

                        <div class="products-img">

                            <figure>
                                <img src="{{ $product->image_path }}" alt="">
                            </figure>
                        </div>
                        <div class="product-info">
                            <div class="describe">
                                <h3>
                                    @lang('site.Description')
                                </h3>
                                <p>
                                    {!! $product->description !!}
                                </p>
                            </div>
                            <div class="grid">
                                <h3>
                                    @lang('site.Details')
                                </h3>
                                <div class="grid-container">
                                    <div class="grid-item">
                                        <p>
                                            Karat: <span>
                                                {{ $product->karat }} k
                                            </span>
                                        </p>
                                    </div>
                                    <div class="grid-item">
                                        <p>
                                            Height: <span>
                                                {{ $product->height }} cm
                                            </span>
                                        </p>
                                    </div>
                                    <div class="grid-item">
                                        <p>
                                            fees: <span>
                                                {{ $product->fees }} EGP
                                            </span>
                                        </p>
                                    </div>
                                    <div class="grid-item">
                                        <p>
                                            Weight: <span>
                                                {{ $product->weight }} gm
                                            </span>
                                        </p>
                                    </div>
                                    <div class="grid-item">
                                        <p>
                                            Width: <span>
                                                {{ $product->width }} cm
                                            </span>
                                        </p>
                                    </div>
                                    <div class="grid-item">
                                        <p>
                                            Design: <span>
                                                {{ $product->design }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="grid-item">
                                        <p>
                                            Depth: <span>
                                                {{ $product->depth }} mm
                                            </span>
                                        </p>
                                    </div>
                                    <div class="grid-item">
                                        <p>
                                            Manufacturer: <span>
                                                {{ $product->manufacturer }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right-side">
                        <div class="info">
                            <p>
                                @lang('site.Grams')
                                <span>
                                    {{ $product->number_grams }} gram
                                </span>
                            </p>
                            <p>
                                @lang('site.Total')
                                <span>

                                    @if( $product->category_id ==1)

                                    {{ round(
                                     $product->number_grams  * $egy
                                             +
                                             $product->number_grams * $product->fees
                                     , 2)}} EGP
                                    @else

                                    {{ round(
                                    $product->number_grams  * $egy * 0.875
                                    +
                                             $product->number_grams * $product->fees

                                     , 2)

                                 }}

                                    EGP
                                    @endif
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="products">
                <div class="container">
                    <h3>
                        See also
                    </h3>
                    <div class="grid-container">

                        @foreach($related_products as $row)
                        <div class="grid-item">
                            <a class="products-img" href="{{ route('fakka.productdetails',$product->id) }}">
                                <figure>
                                    <img src="{{ $product->image_path }}" alt="">
                                </figure>

                            </a>
                            <div class="details">
                                <div class="gold-name">

                                    <h4>
                                        {{ $product->number_grams }} @lang('site.gramBTCGold24k')
                                    </h4>
                                    <span>

                                        @if( $product->category_id ==1)

                                        {{ round(
                                     $product->number_grams  * $egy
                                             +
                                             $product->number_grams * $product->fees
                                     , 2)}} EGP
                                        @else

                                        {{ round(
                                    $product->number_grams  * $egy * 0.875
                                    +
                                             $product->number_grams * $product->fees

                                     , 2)

                                 }}

                                        EGP
                                        @endif




                                        EGP
                                    </span>
                                </div>
                                <button onclick="add_tocart('{{$row->id}}')" class="cart-btn  light-background ">
                                    <figure class="">
                                        <img src="{{ asset('web_files/images/add-to-cart (arrow).svg') }} " alt="">
                                    </figure>
                                </button>
                            </div>
                        </div>
                        @endforeach



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
            <a href="">
                @lang('site.Contactus')
            </a>
        </div>
    </div>
</main>

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
                        timer: 2000
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

    function add_towithquntitycart(id) {



        var quantity = $('#quantity').val();

        var url = '{{URL::to("/getAddToCartdetails")}}' + "/" + id;
        var menu = $('#menu').val();
        data = {
            id: id,
            quantity: quantity,
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
                        timer: 2000
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

    /*function totalpriceall(){
        var quantity = $('#quantity').val();
        alert(quantity);
  var totalpriceall= document.getElementById('totalpriceall').innerHTML;
  document.getElementById('totalpriceall').innerHTML = parseFloat(totalpriceall) * quantity;
    }*/
</script>
@endsection

@push('scripts')
