@extends('layouts.web.app')

@section('content')


<main>
    <div class="shopping-cart">
        <div class="background-title" style="background:linear-gradient(to right,#015CAB,#DD7F28);height: 203px;">
            <figure>
              <!--  <img src="{{ asset('web_files/images/shopping-bg.svg') }} " alt="">-->
                <div ></div>
            </figure>
            <div class="title">
                <h2>
                @lang('site.Shoppingcart')
                </h2>
            </div>
        </div>

        @if( Session::has('cart') || count($anotherproducts) !=0 )
<?php $totalqty=0; ?>
<?php  $total_price=0; $total_price2=0; ?>
        <div class="container">
            <div class="cart-items">
                <h4>
                       @lang('site.products')
                </h4>


                <div class="items">
                    @if( !empty($products)  )
                    @foreach($products as $product)
                    @if( $product['item']->category_id ==1)
                    <?php   $total_price += $product['item']['number_grams']  * $egy* $product['qty']
                                            +
                                            $product['item']['number_grams']  * $product['item']['fees']  * $product['qty']
                    ;
                    
                    $priceswithoutfees += $product['item']['number_grams']  * $egy* $product['qty'] ;
                                        
                    $fees +=$product['item']['number_grams']  * $product['item']['fees']  * $product['qty'];

                    
                    ?>
                    @else
                    <?php   $total_price += $product['item']['number_grams']  * $egy *  0.875 * $product['qty']
                                            +
                                            $product['item']['number_grams']  * $product['item']['fees']  * $product['qty']
                    ;
                             $priceswithoutfees += $product['item']['number_grams']  * $egy *  0.875 * $product['qty'];
                    
                             $fees +=  $product['item']['number_grams']  * $product['item']['fees']  * $product['qty'];
                    ?>
                    @endif


                    <div class="item">
                        <div class="item-details">
                            <figure>
                                <img src="{{ asset('uploads/product_images/'.$product['item']['image']) }}" alt="">
                            </figure>
                            <div class="info">
                                <h4>

                                    {{ $product['item']->name }}
                                </h4>
                                <div class="grid-container">
                                    <div class="grid-item">
                                        <p>
                                            Category: <span>
                                                @if($product['item']['category_id']==2)
                                                Ingots
                                                @else
                                                Coins
                                                @endif

                                            </span>
                                        </p>
                                    </div>
                                    <div class="grid-item">
                                        <p>
                                            Price per gram: <span>

                                            @if($product['item']['category_id']==2)
                                         {{ round(0.875 * $egy , 2)}}
                                                @else
                                             {{ round($egy , 2)}}
                                                @endif
                                            </span>
                                        </p>
                                    </div>
                                    <div class="grid-item">
                                        <p>
                                            Product weight: <span>
                                                {{ $product['item']['weight'] }} gm
                                            </span>
                                        </p>
                                    </div>
                                    <div class="grid-item">
                                        <p>
                                            Tax & fees: <span>
                                                {{ $product['item']['fees'] }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="grid-item">
                                        <p>
                                            Karat: <span>
                                                {{ $product['item']['karat'] }} k
                                            </span>
                                        </p>
                                    </div>
                                    <div class="grid-item">
                                        <p>
                                            Unit price: <span>
                                            @if($product['item']['category_id']==2)
                                      {{ round((0.875 * ($egy +$product['item']['fees']) * $product['item']['fees']), 2)}}
                                                @else
                                          {{ round(($egy + $product['item']['fees']) * $product['item']['fees'], 2)}}
                                                @endif
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="quantity">
                            <div class="quantity-control" data-quantity="">
                                <!-- <a href="{{route('fakka.product.reduceByOne',['id'=>$product['item']['id']])}}" class="quantity-btn" data-quantity-minus=""><svg viewBox="0 0 409.6 409.6">
                                            <g>
                                                <g>
                                                    <path
                                                        d="M392.533,187.733H17.067C7.641,187.733,0,195.374,0,204.8s7.641,17.067,17.067,17.067h375.467 c9.426,0,17.067-7.641,17.067-17.067S401.959,187.733,392.533,187.733z" />
                                                </g>
                                            </g>
                                        </svg></a>-->

                                <button onclick="reduceByOne('{{$product['item']['id']}}')" class="quantity-btn" data-quantity-minus=""><svg viewBox="0 0 409.6 409.6">
                                        <g>
                                            <g>
                                                <path d="M392.533,187.733H17.067C7.641,187.733,0,195.374,0,204.8s7.641,17.067,17.067,17.067h375.467 c9.426,0,17.067-7.641,17.067-17.067S401.959,187.733,392.533,187.733z" />
                                            </g>
                                        </g>
                                    </svg></button>

                                <input type="number" class="quantity-input" data-quantity-target="" value="{{ $product['qty'] }}" step="1" min="1" max="" name="quantity">
                                <button onclick="addByOne('{{$product['item']['id']}}')" class="quantity-btn" data-quantity-plus=""><svg viewBox="0 0 426.66667 426.66667">
                                        <path d="m405.332031 192h-170.664062v-170.667969c0-11.773437-9.558594-21.332031-21.335938-21.332031-11.773437 0-21.332031 9.558594-21.332031 21.332031v170.667969h-170.667969c-11.773437 0-21.332031 9.558594-21.332031 21.332031 0 11.777344 9.558594 21.335938 21.332031 21.335938h170.667969v170.664062c0 11.777344 9.558594 21.335938 21.332031 21.335938 11.777344 0 21.335938-9.558594 21.335938-21.335938v-170.664062h170.664062c11.777344 0 21.335938-9.558594 21.335938-21.335938 0-11.773437-9.558594-21.332031-21.335938-21.332031zm0 0" />
                                    </svg>
                                </button>
                            </div>
                            <h4>



                             @if( $product['item']['category_id']==1 )


                               {{ round(
                                $product['item']['number_grams']  * $egy * $product['qty']

                                    +
                                    $product['item']['number_grams']  * $product['item']['fees']  * $product['qty']


                                   , 2)}}
                               @else

                               {{ round(
                                $product['item']['number_grams']  * $egy * 0.875 * $product['qty']

                                    +
                                    $product['item']['number_grams']  * $product['item']['fees']  * $product['qty']
                                   , 2)}}
                               @endif


                            </h4>
                            <!--<a href="{{route('fakka.product.remove',['id'=>$product['item']['id']])}}" class="btn red-btn">
                                    Remove
                                </a>-->


                            <button onclick="remove('{{$product['item']['id']}}')" class="btn red-btn">
                                Remove
                            </button>
                        </div>
                    </div>
                    @endforeach
                    @else

                    @foreach($anotherproducts as $anotherproduct)
                    <?php $totalq+=$anotherproduct['qty'] ?>
                    @if( $anotherproduct['product']['category_id'] ==1 )
                    <?php   $total_price2 += $anotherproduct['product']['number_grams'] * $egy * $anotherproduct['qty']
                                            +
                                            $anotherproduct['product']['number_grams'] * $anotherproduct['product']['fees']  * $anotherproduct['qty']
                        ;
                        $priceswithoutfees2 += $anotherproduct['product']['number_grams'] * $egy * $anotherproduct['qty'];
                        $fees2 +=$anotherproduct['product']['number_grams'] * $anotherproduct['product']['fees']  * $anotherproduct['qty'];
                                         
                        
                        ?>
                        @else
                        <?php   $total_price2 += $anotherproduct['product']['number_grams'] * $egy * 0.875 * $anotherproduct['qty']
                                            +
                                            $anotherproduct['product']['number_grams'] * $anotherproduct['product']['fees']  * $anotherproduct['qty']
                        ;
                        $priceswithoutfees2 += $anotherproduct['product']['number_grams'] * $egy * 0.875 * $anotherproduct['qty'];
                        $fees2 +=$anotherproduct['product']['number_grams'] * $anotherproduct['product']['fees']  * $anotherproduct['qty'];
                        ?>
                        @endif
                    <div class="item">
                        <div class="item-details">
                            <figure>
                                <img src="{{asset('uploads/product_images/'.$anotherproduct['product']['image']) }}" alt="">
                            </figure>
                            <div class="info">
                                <h4>
                                    {{ $anotherproduct['ProductTranslation']['name'] }}

                                </h4>
                                <div class="grid-container">
                                    <div class="grid-item">
                                        <p>
                                            Category: <span>
                                                {{$anotherproduct['category']->name}}

                                            </span>
                                        </p>
                                    </div>
                                    <div class="grid-item">
                                        <p>
                                            Price per gram: <span>
                                            @if( $anotherproduct['product']['category_id'] ==1 )
                                       {{ round($egy, 2)}}
                                            @else
                                           {{ round(0.875 * $egy, 2)}}
                                            @endif
                                            </span>
                                        </p>
                                    </div>
                                    <div class="grid-item">
                                        <p>
                                            Product weight: <span>
                                                {{ $anotherproduct['product']['weight'] }} gm
                                            </span>
                                        </p>
                                    </div>
                                    <div class="grid-item">
                                        <p>
                                            Tax & fees: <span>
                                                {{ $anotherproduct['product']['fees'] }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="grid-item">
                                        <p>
                                            Karat: <span>
                                                {{ $anotherproduct['product']['karat'] }} k
                                            </span>
                                        </p>
                                    </div>
                                    <div class="grid-item">
                                        <p>
                                            Unit price: <span>
                                            @if( $anotherproduct['product']['category_id'] ==1 )
                                         {{ round(($egy + $anotherproduct['product']['fees']) * $anotherproduct['product']['number_grams'] , 2)}}
                                         
                                            @else
                                       {{ round((0.875 * ($egy +$anotherproduct['product']['fees']) * $anotherproduct['product']['number_grams']) , 2)}}
                                            @endif
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="quantity">
                            <div class="quantity-control" data-quantity="">


                                <button  onclick="removeOne('{{$anotherproduct['id']}}')"  class="quantity-btn" data-quantity-minus=""><svg viewBox="0 0 409.6 409.6">
                                        <g>
                                            <g>
                                                <path d="M392.533,187.733H17.067C7.641,187.733,0,195.374,0,204.8s7.641,17.067,17.067,17.067h375.467 c9.426,0,17.067-7.641,17.067-17.067S401.959,187.733,392.533,187.733z" />
                                            </g>
                                        </g>
                                    </svg></button>

                                <input type="number" class="quantity-input" data-quantity-target="" value="{{ $anotherproduct['qty'] }}" step="1" min="1" max="" name="quantity">
                                <button  onclick="addOne('{{$anotherproduct['id']}}')" class="quantity-btn" data-quantity-plus=""><svg viewBox="0 0 426.66667 426.66667">
                                        <path d="m405.332031 192h-170.664062v-170.667969c0-11.773437-9.558594-21.332031-21.335938-21.332031-11.773437 0-21.332031 9.558594-21.332031 21.332031v170.667969h-170.667969c-11.773437 0-21.332031 9.558594-21.332031 21.332031 0 11.777344 9.558594 21.335938 21.332031 21.335938h170.667969v170.664062c0 11.777344 9.558594 21.335938 21.332031 21.335938 11.777344 0 21.335938-9.558594 21.335938-21.335938v-170.664062h170.664062c11.777344 0 21.335938-9.558594 21.335938-21.335938 0-11.773437-9.558594-21.332031-21.335938-21.332031zm0 0" />
                                    </svg>
                                </button>
                            </div>
                            <h4>
                            @if( $anotherproduct['product']['category_id'] ==1 )


                                {{ round(
                                    $anotherproduct['product']['number_grams'] * $egy * $anotherproduct['qty']
                                    +
                                    $anotherproduct['product']['number_grams'] * $anotherproduct['product']['fees'] * $anotherproduct['qty']


                                    , 2)}}
                                @else

                                {{ round(
                                    $anotherproduct['product']['number_grams'] * $egy * 0.875 * $anotherproduct['qty']
                                    +
                                    $anotherproduct['product']['number_grams'] * $anotherproduct['product']['fees'] * $anotherproduct['qty']
                                    , 2)}}
                                @endif
                            </h4>



                            <button   onclick="removeall('{{$anotherproduct['id']}}')" class="btn red-btn">
                                Remove
                            </button>
                        </div>
                    </div>


                    @endforeach


                    @endif
                </div>



            </div>
            <div class="checkout">
                <h4>
                      @lang('site.Total')
                </h4>
                <div class="check-details">
                    <ul>
                        <li>
                            <p>
                                  @lang('site.items')
                            </p>
                            <span>

                                {{$totalQty + $totalq}}
                            </span>
                        </li>
                      
                        <li class="total shopping">
                            <p>
                            @lang('site.Total')
                            </p>
                            <span>
                        {{ round($total_price + $total_price2 , 2)}}
                            </span>
                        </li>
                    </ul>
                    <a style="color:antiquewhite" href="{{ route('fakka.confirm_payment.index') }} " class="btn blue-btn">
                         @lang('site.Checkout')

                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="container">
            <div class="cart-items">
                <h4>
                    There is No Products
                </h4>
            </div>
        </div>

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
    function addByOne(id) {
        //  alert(id);
        var url = '{{URL::to("/add")}}' + "/" + id;
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





    function reduceByOne(id) {
        //  alert(id);
        var url = '{{URL::to("/reduce")}}' + "/" + id;
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


    function remove(id) {
        //  alert(id);
        var url = '{{URL::to("/remove")}}' + "/" + id;
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

    /** add, reduce and delete in database when make login */
    function addOne(id) {

   var url = '{{URL::to("/addsave")}}' + "/" + id;
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


function removeOne(id) {

   var url = '{{URL::to("/removeonesave")}}' + "/" + id;
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
</script>


@endsection

@push('scripts')
