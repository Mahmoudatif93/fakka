<div class="grid-container">


    @if ($products->count() > 0)
    @foreach ($products as $index=>$product)
    <div class="grid-item">

        <a  class="products-img " target="_blank" href="{{ route('fakka.productdetails',$product->id) }}">
            <figure>
                <img src="{{ $product->image_path }}" alt="">
            </figure>

        </a>




        <div class="details">
        <div class="gold-name">
            <h4>
                {{ $product->name }}
            </h4>
            <h4>
                                @if( $product->category_id ==1)
                                {{ round(
                            $product->number_grams  * $egy
                                 +
                                 $product->number_grams   * $product->fees
                                            , 2)}} EGP

                                @else

                                {{ round(
                        $product->number_grams * $egy * 0.875
                                    +
                                    $product->number_grams  * $product->fees
                             , 2)

                                                                }} EGP


                                @endif

                            </h4>
            <span>
                {{ $product->number_grams }}(Gram)
            </span>
        </div>

        <button onclick="add_tocart('{{$product->id}}')" class="  light-background ">
            <figure>
                <img src="{{ asset('web_files/images/add-to-cart (arrow).svg') }} " alt="">
            </figure>
        </button>
        </div>


    </div>
    @endforeach
    @else

    <h2>@lang('site.no_data_found')</h2>

    @endif

</div>
