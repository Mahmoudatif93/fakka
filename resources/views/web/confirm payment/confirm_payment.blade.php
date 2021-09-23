@extends('layouts.web.app')

@section('content')

@foreach($anotherproducts as $product)
<?php $total_price2 += $product['product']['number_grams'] * $egy * $product['qty']
    +
    $product['product']['number_grams'] * $product['product']['fees'] * $product['qty'];

?>
@endforeach

<main>
    <div class="confirm-payment">
        <div class="background-title">
            <figure>
                <!-- <img src="{{ asset('web_files/images/shopping-bg.svg') }} " alt="">-->

                <div style="background:linear-gradient(to right,#015CAB,#DD7F28);height: 203px;"></div>
            </figure>
            <div class="title">
                <h2>
                    @lang('site.ConfirmPayment')
                </h2>
            </div>
        </div>
        @include('partials._errors')
        @if(!empty($wallets))
        @if($total_price2 < $wallets->amount)
            <form action="{{ route('fakka.confirm_payment.store') }}" method="post" enctype="multipart/form-data">

                {{csrf_field() }}
                {{ method_field('post') }}
                @else
                @endif
                @endif        
                <div class="container">
                    <div>
                        <div class="payment-tabs">
                            <h4>
                                @lang('site.PaymentMethod')
                            </h4>
                            <div class="payment_methods">
                                <div class="field">
                                    <label>
                                        <input type="radio" name="delivery_type" value="keep_in_store" checked />
                                        <span> @lang('site.KeepinStore') </span>
                                    </label>
                                </div>
                                <div class="field">
                                    <label>
                                        <input type="radio" name="delivery_type" value="ship" />
                                        <span> @lang('site.Ship')</span>
                                        <input type="text" class="">
                                    </label>

                                </div>
                                <div class="field">
                                    <label>
                                        <input type="radio" name="delivery_type" value="pick_up" />
                                        <span> @lang('site.PickUp')</span>
                                    </label>
                                </div>
                            </div>
                            <div id="deliver_by_shipping" class="ship">
                                <label for="">
                                    Shipping Address
                                </label>
                                <input class="input input-custom" name="shipping_address" type="text" placeholder="Your available address">
                                <button class="btn outline-btn">
                                    Edit
                                </button>
                            </div>
                        </div>
                        <div class="accordions">
                            <h4>
                                @lang('site.PaymentMethod')
                            </h4>
                            <div class="accordion">
                                <div class="accordion-section">
                                    <div class="title active">
                                        <h3>
                                            Wallet
                                        </h3>
                                    </div>
                                    <div class="add">
                                        <a target="_blank" href="{{ route('fakka.profile.index') }}" class="btn outline-btn">
                                            Add to Wallet
                                        </a>
                                    </div>
                                    <div class="content">
                                        <div class="fields">
                                            <div class="two-fields">
                                                <div class="field">
                                                    <label for="">
                                                        Balance
                                                    </label>
                                                    <span class="sub-label">
                                                        Available
                                                    </span>
                                                    @if(!empty($wallets))
                                                    <input class="input input-custom " type="number" name="" id="" value="{{$wallets->amount}}" readonly>
                                                    @else
                                                    <input class="input input-custom " type="number" name="" id="" value="0" readonly>
                                                    @endif
                                                    <span>
                                                        EGP
                                                    </span>
                                                </div>
                                                <div class="field">
                                                    <label for="">
                                                        Remain
                                                    </label>
                                                   <!-- <span class="sub-label">
                                                        Will Be Available
                                                    </span>-->
                                                    @if(!empty($wallets))
                                                    @if($total_price2 < $wallets->amount)
                                                        <input class="input input-custom " type="number" name="" id="" value="{{$wallets->amount - $total_price2}}" readonly>
                                                        @else
                                                        <input class="input input-custom " type="number" name="" id="" value="0" readonly>
                                                        @endif
                                                        
                                                        @else
                                                        <input class="input input-custom " type="number" name="" id="" value="0" readonly>
                                                        @endif
                                                        <span>
                                                            EGP
                                                        </span>


                                                </div>
                                            </div>
                                            <div class="field">
                                                <label for="">
                                                    @lang('site.password')
                                                </label>
                                                <span class="sub-label">
                                                    Required
                                                </span>
                                                <input class="input input-custom " type="hidden" name="email" id="email" value="{{Auth::guard('website')->user()->email  }}">
                                                <input class="input input-custom " type="password" name="iban" id="PassCode" placeholder="Enter security code">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-section" style="display: none;">
                                    <div class="title">
                                        <h3>
                                            Mastercard
                                        </h3>
                                    </div>
                                    <div class="content">
                                        <div class="fields">
                                            <div class="field list">
                                                <label for="">
                                                    Select current card
                                                </label>
                                                <select class="dropdown" name="" id="">
                                                    <option value="">
                                                        2134 **** **** 1124
                                                    </option>
                                                </select>
                                                <button class="btn outline-btn">
                                                    Add new card
                                                </button>
                                            </div>
                                            <div class="field">
                                                <label for="">
                                                    CVV
                                                </label>
                                                <span class="sub-label">
                                                    Required
                                                </span>
                                                <input class="input input-custom " type="password" name="" id="" placeholder="***">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-section" style="display: none;">
                                    <div class="title">
                                        <h3>
                                            Visa
                                        </h3>
                                    </div>
                                    <div class="content">
                                    </div>
                                </div>
                                <div class="accordion-section" style="display: none;">
                                    <div class="title">
                                        <h3>
                                            Bank Transfere
                                        </h3>
                                    </div>
                                    <div class="content">

                                        <div class="fields">
                                            <div class="two-fields">
                                                <div class="field">
                                                    <label for="">
                                                        IBAN
                                                    </label>
                                                    <span class="sub-label">
                                                        Required
                                                    </span>
                                                    <input class="input input-custom " type="text" name="" id="" placeholder="Please write your Iban">
                                                </div>


                                                <div class="field">
                                                    <label for="">
                                                        Total Price
                                                    </label>

                                                    <input class="input input-custom" name="total_price" id="" value="{{$total_price2}}" readonly>
                                                    <span>
                                                        EGP
                                                    </span>
                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="buttons">
                        @if(!empty($wallets))
                            @if($total_price2 < $wallets->amount)
                                <button onclick="checkpass()" type="button" class="btn blue-btn">
                                    Confirm
                                </button>
                                <button style="display: none;" id="submitconfirm" type="submit" class="btn blue-btn">
                                    Confirm
                                </button>
                                @else
                                <button onclick="swal('your money in wallet is not enough')" class="btn blue-btn">
                                    Confirm
                                </button>
                                @endif
                                @else
                                <button onclick="swal('your money in wallet is not enough')" class="btn blue-btn">
                                    Confirm
                                </button>
                                @endif

                        </div>
                    </div>

                    <div class="right-side">
                        <div class="checkout">
                            <h4>
                                Total
                            </h4>
                            <div class="details">
                                <ul>
                                    <li>
                                        <p>
                                            @lang('site.items')
                                        </p>
                                        <span>
                                            {{$totalQty}} <input type="hidden" name="totalQty" value="   {{$totalQty}} ">
                                        </span>
                                    </li>
                                    <li>
                                        <p>
                                            @lang('site.Cost')
                                        </p>
                                        <span>
                                            {{ round($total_price2, 2)}} EGP
                                        </span>
                                    </li>
                                   <!-- <li>
                                        <p>
                                            @lang('site.Shipping')
                                        </p>
                                        <span>
                                            0EGP
                                        </span>
                                    </li>-->
                                    <li class="total">
                                        <p>
                                            @lang('site.Total')
                                        </p>
                                        <span>
                                            {{ round($total_price2, 2)}} EGP
                                        </span>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <div class="shopping-cart">
                            <div class="cart-items">
                                <h4>
                                    Order Overview
                                </h4>

                                <div class="items">
                                    @foreach($anotherproducts as $product)
                                    <?php $total_price2 += $product['product']['number_grams'] * $egy * $product['qty']
                                        +
                                        $product['product']['number_grams'] * $product['product']['fees'] * $product['qty']; 
                                        $totalgrams +=$product['product']['number_grams'] * $product['qty'];
                                        $allfees +=$product['product']['number_grams'] * $product['product']['fees'] * $product['qty'];
                                        $allweight +=$product['product']['weight'];
                                        
                                        ?>
                                        <input type="hidden" value="{{ $totalgrams}}" name="totalgrams">
                                        <input type="hidden" value="{{ $allfees}}" name="allfees">
                                        <input type="hidden" value="{{ $allweight}}" name="allweight">
                                        <input type="hidden" value="{{ $product['product']['number_grams'] * $egy    }}" name="unit_price[]">
                                        <input type="hidden" value="{{ $product['product']['number_grams'] * $egy * $product['qty'] +  $product['product']['number_grams'] * $product['product']['fees'] * $product['qty'] }}" name="product_price[]">

                                    <div class="item">
                                        <input type="hidden" name="totalfees[]" value="{{ $product['product']['number_grams'] * $product['product']['fees'] * $product['qty']}}">
                                        <div class="item-details">
                                            <figure>
                                                <img src="{{asset('uploads/product_images/'.$product['product']['image']) }}" alt="">
                                            </figure>
                                            <div class="info">
                                                <h4>
                                                    {{ $product['ProductTranslation']['name'] }} <input type="hidden" name="product_name[]" value="{{ $product['ProductTranslation']['name'] }}">
                                                </h4>
                                                <div class="grid-container">
                                                    <div class="grid-item">
                                                        <p>
                                                            Category: <span>

                                                                {{ $product['category']->name}} <input type="hidden" name="category_name[]" value="{{ $product['category']->name }}">
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <div class="grid-item">
                                                        <p>
                                                            Price per gram: <span>
                                                                {{ round($egy, 2)}} <input type="hidden" name="price_per_gram" value="{{ $egy }}">
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <div class="grid-item">
                                                        <p>
                                                            Product weight: <span><input type="hidden" name="product_id[]" value="{{ $product['id'] }}"> <input type="hidden" name="ingot_id[]" value="{{ $product['product_id'] }}">
                                                                {{ $product['product']['weight'] }} gm <input type="hidden" name="product_weight[]" value="{{ $product['product']['weight']  }}">
                                                            </span>
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="quantity">
                                            <div class="quantity-control" data-quantity="">
                                                <span>
                                                    {{ $product['qty'] }} <input type="hidden" name="product_qty[]" value="{{ $product['qty'] }} ">
                                                </span>
                                            </div>
                                            <h4>

                                                {{ round(
                                            $product['product']['number_grams'] * $egy * $product['qty']
                                            , 2)}}
                                            </h4>
                                            <button onclick="removeall('{{$product['id']}}')" class="btn red-btn">
                                                Remove
                                            </button>

                                        </div>

                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(!empty($wallets))
                @if($total_price2 < $wallets->amount)
            </form>
            @else
            @endif
            @else
            @endif
    </div>

    <div class="contact">
        <div class="container">
            <div class="title">
                <h2>
                    We will be happy
                </h2>
            </div>
            <p>
                To answer all your questions
            </p>
            <a href="{{ route('fakka.contactus.index') }}">
                Contact us
            </a>
        </div>
    </div>
</main>

<script>
    function removeall(id) {

        var url = '{{URL::to("/removeallsave")}}' + "/" + id;
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
                $('body').load(menu)
            },
            error: function(response) {
                $('body').load(menu)
            }
        });
    }
    /* end*/


    function checkpass() {

        var password = $('#PassCode').val();
        var client_email = $('#email').val();
        var passwordid = document.getElementById("PassCode");

        if (passwordid != '') {

            data = {
                password: password,
                client_email: client_email,
                _token: "{{csrf_token()}}",
            };
            $.ajax({
                url: '{{URL::to("/checkpassword") }}',
                type: 'get',
                dataType: 'html',
                data: data,
                success: function(response) {
                    if (response == 1) {
                        //  paynow(); 
                        document.getElementById("submitconfirm").click();
                    }
                    if (response == 0) {
                        swal('wrong password. !');
                    }
                },
                error: function(response) {
                    alert(response);
                }
            });
        } else {



            swal('please complete red boxs !');
        }

    }
</script>

@endsection

@push('scripts')