<div class="banner" >
    <div class="slider" >
        <div class="slick-side">
            <div class="bg">
                <figure>
                    <img src="{{ asset('web_files/images/cover1.png') }} " alt="">
                </figure>
            </div>
            <div class="container">
                <div class="title">
                    <h2>
                    @lang('site.Goldingots')
                    </h2>
                </div>
                <p>
                @lang('site.ingotsinfo1')
                </p>

                <div class="ratio">
                    <div>
                        <span>
                             gm (24K) = <lablel id="gold">{{round( $egy , 2)}} EGP</lablel>
                        </span>

                    </div>
                    <div>
                        <span>
                            gm (24K) = <lablel id="gold_us">{{round($us, 2)}} USD</lablel>
                        </span>
                    </div>
                    <div>
                        <span>
                        ounce (24K) = <lablel id="ouncegold_us">{{round( $us* 31.1, 2)}} USD</lablel>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="slick-side">
            <div class="bg">
                <figure>
                    <img src="{{ asset('web_files/images/cover2.png') }} " alt="">
                </figure>
            </div>
            <div class="container">
                <div class="title">
                    <h2>
                    @lang('site.Goldcoins')
                    </h2>
                </div>
                <p>
                @lang('site.coinsinfo1')
                </p>

                <div class="ratio">
                    <div>
                        <span>
                            1 gm (24K) = <lablel id="aaagold2">{{round( $egy , 2)}} EGP</lablel>
                        </span>

                    </div>
                    <div>
                        <span>
                            1 gm (24K) = <lablel id="gold_us2">{{round( $us, 2)}}  USD</lablel>
                        </span>
                    </div>
                    <div>
                        <span>
                        ounce (24K) = <lablel id="ouncegold_us2">{{round( $us * 31.1, 2)}} USD</lablel>



                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function cold_update() {
        var url = '{{URL::to("/gold_price")}}';

        data = {

            _token: "{{csrf_token()}}",
        };
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            data: data,
            success: function(response) {
                //alert();
                document.getElementById('gold').innerHTML = parseFloat(response).toFixed(2) + ' ' + 'EGP';
                document.getElementById('aaagold2').innerHTML = parseFloat(response).toFixed(2) + ' ' + 'EGP';
            },
            error: function(response) {
                //alert('there is an error to network');
            }
        });
    }
    //setInterval(cold_update, 5000);

    function cold_us_update() {
        var url = '{{URL::to("/gold_us_price")}}';

        data = {

            _token: "{{csrf_token()}}",
        };
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            data: data,
            success: function(response) {

                document.getElementById('gold_us').innerHTML = parseFloat(response).toFixed(2) + ' ' + 'USD';
                document.getElementById('gold_us2').innerHTML = parseFloat(response).toFixed(2) + ' ' + 'USD';

                document.getElementById('ouncegold_us').innerHTML = (parseFloat(response).toFixed(2) * 31.1).toFixed(2)  + ' ' + 'USD';
                document.getElementById('ouncegold_us2').innerHTML = (parseFloat(response).toFixed(2) * 31.1).toFixed(2) + ' ' + 'USD';
            },
            error: function(response) {
                //alert('there is an error to network');
            }
        });
    }

 //   setInterval(cold_us_update, 6000);
</script>

