@extends('layouts.web.app')

@section('content')
@include('layouts.web.banners.banner')

<main>
        <div class="own-ingots">
            <div class="container">
                <div class="subtitle">
                    <h3>
                        Owning ingots has never been easier
                    </h3>
                </div>
                <p>
                    Explaining how you can own your own ingots with installments
                </p>
                <a href="{{ route('fakka.virtualgold.index') }}" class="btn blue-btn">
                    Start Now
                </a>


            </div>
        </div>
        <div class="products">
            <div class="container">
                <div class="subtitle">
                    <h3>
                        Hot Products
                    </h3>
                </div>
            
                @if ($products->count() > 0)
            <div class="grid-container">
                @foreach ($products as $index=>$product)

                <div class="grid-item">
                    <figure>
                        <img src="{{ $product->image_path }}" style="width: 100%;height:100%" class="img-thumbnail" alt="">
                    </figure>
                    <h4>
                        {{ $product->name }}
                    </h4>
                    <span>
                        {{ $product->number_grams }}(Gram)
                    </span>
                   <!-- <button  onclick="add_tocart('{{$product->id}}')"  class="cart-btn position-absolute light-background ">
                            <figure>
                                <img src="{{ asset('web_files/images/add-to-cart (arrow).svg') }} " alt="">
                            </figure>
                                </button>-->
                                <button  onclick="add_tocart('{{$product->id}}')"  class=" position-absolute light-background ">
                            <figure>
                                <img src="{{ asset('web_files/images/add-to-cart (arrow).svg') }} " alt="">
                            </figure>
                                </button>


                </div>
                @endforeach

            </div>
            @else

            <h2>@lang('site.no_data_found')</h2>

            @endif

                <a href="{{ route('fakka.products.index') }}" class="btn outline-btn">
                    View all products

                </a>
             <!--   <button type="button" onclick="apigold()">gold</button>-->
                <a href="{{ route('fakka.home.gold_price') }}" >gold</a>
            </div>
        </div>
        <!--<div class="our-partners">
            <div class="container">
                <div class="subtitle">
                    <h3>
                        Our Partners
                    </h3>
                </div>
                <div class="grid-container">
                    <div class="grid-item">
                        <figure>
                            <img src=" {{ asset('web_files/images/odoo_logo.png') }} " alt="">
                        </figure>
                    </div>
                    <div class="grid-item">
                        <figure>
                            <img src="{{ asset('web_files/images/geotech-transperant.png') }} " alt="">
                        </figure>
                    </div>
                    <div class="grid-item">
                        <figure>
                            <img src="{{ asset('web_files/images/fakka.png') }} " alt="">
                        </figure>
                    </div>

                </div>
            </div>
        </div>-->
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
        
       
        <pre id="tab">This    text      has    lots of     spaces</pre>


    </main>



    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script>
            function add_tocart(id) {
                  
      var url = '{{URL::to("/fakka/home-to-cart")}}'  +"/"+ id; 
      var menu =$('#menu').val();
       data = {
       id:id,
           _token: "{{csrf_token()}}",
       };
       $.ajax({
          url: url, 
           type: 'get',
           dataType: 'json',
           data: data,
           success: function(response) {
             
               let text = "product will removed from cart In 2 hours !"  ;
            swal({
                
            title:text ,
            text: "  ",
            buttons: false,
            icon: "warning",
            timer: 3000
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
   /*function apigold() {
       
         /*var endpoint = 'latest'
        var access_key = 'nehw3f19o8krv6o57d3nvkrdpt82q7977r4py2e9k14s77807wcvoqiivt96';
        from = 'EUR';
        base = 'XAU';
         symbols = 'EGP';
         var gram=31.1;
        to = 'EGP';
        amount = '1';*/

            //$.ajax({

         
          /* type: 'get',
           dataType: 'html',
        //    url:'https://metals-api.com/api/'+endpoint+'?access_key='+access_key+'&base='+base+'&amount='+amount+'&symbols='+symbols,
            url:'https://www.xe.com/currencytables/?from=XAU',
           
            success: function(response) {
         
            // exchange rata data is stored in json.rates
          // alert(json.rates.EGP/gram);

            // base currency is stored in json.base
          // alert(json.base);

            // timestamp can be accessed in json.timestamp
         //   alert(json.timestamp);

            },
         //   error: function(response) {
           /* alert(response);

               
           }
            });


     /*       var settings = {
  "url": "https://www.goldapi.io/api/XAU/USD",
  "method": "GET",
  "timeout": 0,
  "headers": {
    "x-access-token": "goldapi-14nukj9ss203-io",
    "Content-Type": "application/json"
  },
};

$.ajax(settings).done(function (response) {
   
  console.log(response);
});*/




//}
</script>
@endsection

@push('scripts')