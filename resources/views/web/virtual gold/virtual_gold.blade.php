@extends('layouts.web.app')

@section('content')
<style>
 .details .item .certification-info {
    position: absolute;
    left: 38%;
    top: 93%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    max-width: 800px;
}
    

     .grid-container {
        grid-gap: 10px;
        padding: 0;
    }


  .details .item figure {
        margin: 0;
    }

 .details .item .certification-info .certification-head {
        margin-bottom: 30px;
    }

 .details .item .certification-info .certification-head label {
        font-size:21px;
        color: #a1a1a1;
    }

.details .item .certification-info .certification-head .input {
        color: #015CAB;
        font-size: 58px;
    }

  .details .item .certification-info .certification-body .grid-container {
        display: -ms-grid;
        display: grid;
        grid-gap: 0;
    }  .details .item .certification-info .certification-body .grid-container .grid-item{
        margin-bottom: 15px;
    }

 .details .item .certification-info .certification-body span,
 .details .item .certification-info .certification-body label {
        font-size:21px;
        color: #A1A1A1;
    }

.details .item .certification-info .certification-body .input {
        color: #015CAB;
        font-size: 27px;
    }
</style>
<main>
    <div class="background-title">
        <figure>
            <img src="{{ asset('web_files/images/virtual-gold.png') }} " alt="">
        </figure>
        <div class="title">
            <h2>
                @lang('site.VirtualGold')
            </h2>
        </div>
    </div>
    <div class="page-heading">
        <div class="container">
            <div class="steps wizard-steps">
                <div class="step">
                    <p>
                        <span>
                            1
                        </span> @lang('site.PurchaseDetails')
                    </p>
                </div>
                <div class="step">
                    <p>
                        <span>
                            2
                        </span> @lang('site.PaymentOptions')
                    </p>
                </div>
                <div class="step">
                    <p>
                        <span>
                            3
                        </span> @lang('site.CertificatePreview')
                    </p>
                </div>
                <span class="progress"></span>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="virtual-gold">
            <div id="cardBody" class="card-body wizard-body">
                <div class="tabs">
                    <div id="first" class="tab">
                        <div class="details">
                            <div class="gold-details">
                                <h4>
                                    @lang('site.CertificatePreview')
                                </h4>
                                <div class="fields">
                                    <div class="field two-fields">
                                        <p>
                                            <span>
                                                Currency
                                            </span> EGP
                                        </p>
                                        <p>
                                            <span>
                                                Karat
                                            </span> 24K
                                        </p>
                                    </div>
                                    <div class="field">
                                        <label for="">
                                            Money
                                        </label>
                                        <span class="sub-label">
                                            Required
                                        </span>
                                        <span>
                                            EGP
                                        </span>
                                        <input class="input input-custom " oninput="getgram(this.value);this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" name="price" id="price" placeholder="Cost in Egyptian Pound">
                                    </div>
                                    <div class="field">
                                        <label for="">
                                            Quantity
                                        </label>
                                        <span class="sub-label">
                                            Required
                                        </span>
                                        <span>
                                            gm
                                        </span>
                                        <input class="input input-custom " oninput="getprice(this.value);this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" name="quantity" id="quantity" placeholder="Desired quantity in grams (you can add fractions)">
                                    </div>

                                </div>
                            </div>
                            <div class="personal-details">
                                <h4>
                                    @lang('site.PersonalDetails')
                                </h4>
                                <div class="fields">
                                    <div class="field">
                                        <label for="">
                                            Name
                                        </label>
                                        <input class="input input-custom " type="text" name="fullname" id="fullname" value="{{Auth::guard('website')->user()->first_name .' '. Auth::guard('website')->user()->last_name  }}" readonly>
                                    </div>
                                    <div class="field">
                                        <label for="">
                                            Phone Number
                                        </label>
                                        <input class="input input-custom " type="text" name="Phone" id="Phone" value="{{Auth::guard('website')->user()->phone  }}" readonly>
                                    </div>
                                    <div class="field">
                                        <label for="">
                                            Email address
                                        </label>
                                        <input class="input input-custom " type="text" name="email" id="email" value="{{Auth::guard('website')->user()->email  }}" readonly>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="buttons"id="savevirtual">
                                <button  onclick="Virtualdetails()"class="btn blue-btn ">

                                Confirm
                                <span>
                                    ->
                                </span>
                            </button>
                            </div>-->
                        <div class="buttons">
                            <button id="confirmv" onclick="Virtualdetails()" class="btn blue-btn ">

                                Confirm
                                <span>
                                    ->
                                </span>
                            </button>
                        </div>
                    </div>
                    <div id="second" class="tab">
                        <div>
                            <div class="accordions">
                                <h4>
                                    Payment Method
                                </h4>
                                <div class="accordion">
                                    <div class="accordion-section">
                                        <div class="title active">
                                            <h3>
                                                Wallet
                                            </h3>
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
                                                        <input class="input input-custom " type="number" name="walletamount" id="walletamount" value="{{$wallet}}" readonly>
                                                        <span>
                                                            EGP
                                                        </span>
                                                    </div>
                                                    <div class="field">
                                                        <label for="">
                                                            Remain
                                                        </label>
                                                        <span class="sub-label">
                                                            Will Be Available
                                                        </span>
                                                        <input class="input input-custom " type="number" name="walletremain" id="walletremain" value="" readonly>
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
                                                    <input class="input input-custom " type="password" name="" id="PassCode" placeholder="Enter security code">
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


                                    <div class="accordion-section" style="display: none">
                                        <div class="title">
                                            <h3>
                                                Bank Transfere <input type="hidden" name="" id="payment_method" value="Bank Transfere">
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
                                                        <input class="input input-custom " type="number" name="iban" id="iban" value="">
                                                        <span>

                                                        </span>
                                                    </div>
                                                    <div class="field">
                                                        <label for="">
                                                            Total Price
                                                        </label>
                                                        <span class="sub-label">
                                                            Will Be Available
                                                        </span>
                                                        <input type="hidden" id="vertial_id">
                                                        <input class="input input-custom " type="number" name="" id="totprice" readonly>
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
                            <div class="order">
                                <h4>
                                    Order Overview
                                </h4>
                                <div class="order-details">
                                    <h4>
                                        Virtual Gold
                                        <span id="Productprice">

                                        </span>
                                    </h4>
                                    <ul>
                                        <li>
                                            <p>
                                                Karat :
                                            </p>
                                            <span>
                                                24 k
                                            </span>
                                        </li>
                                        <li>
                                            <p>
                                                Product weight :
                                            </p>

                                            <span id="Productweight">

                                            </span>
                                        </li>
                                        <li>
                                            <p>
                                                Price per gram :
                                                <span>
                                                  {{round( $egy, 2)}} EGP <input type="hidden" id="pricepergram" value="{{$egy}}" >
                                                </span>
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                Tax & fees :
                                                <span>
                                                {{round( ($egy*.005), 2)}} EGP
                                                </span>
                                            </p>
                                        </li>
                                        <!-- <li>
                                                <p>
                                                    Unit price :
                                                    <span>
                                                        9020
                                                    </span>
                                                </p>
                                            </li>-->
                                    </ul>

                                </div>
                            </div>
                        </div>
                        <div class="buttons">
                            <button onclick="checkpass()" class="btn blue-btn ">
                                Pay Now
                                <span>
                                    ->
                                </span>
                            </button>
                        </div>
                    </div>
                    <div id="third" class="tab">
                        <div class="details">
                        <h1 style="padding: 259px;font-size: 21px;">@lang('site.approvecertifcate') </h1>
                            <div class="item" style="display: none;">
                                <figure>
                                    <img src="{{ asset('web_files/images/certification.png') }} " alt="">
                                </figure>
                                <div class="certification-info">
                                    <div class="certification-head">
                                        <label id="certificationno">
                                            
                                        </label>
                                        <input class="input" type="text" value=" {{--$virtual->quantity--}}  grams gold 24K" readonly>
                                    </div>
                                    <div class="certification-body">
                                        <div class="grid-container">
                                            <div class="grid-item">
                                                <label>
                                                    Customer Name
                                                </label>
                                                <input type="text" class="input" value="{{Auth::guard('website')->user()->first_name . ' ' . Auth::guard('website')->user()->last_name }}" readonly>
                                            </div>
                                            <div class="grid-item">
                                                <label>
                                                    Customer ID
                                                </label>
                                                <input type="number" class="input" value="{{Auth::guard('website')->user()->national_id  }}" readonly>
                                            </div>
                                            <div class="grid-item">
                                                <label>
                                                    Issuing date
                                                </label>
                                                <input type="text" class="input" id="dateissue" value=" " readonly>
                                            </div>

                                            <div class="grid-item">
                                                <span>
                                                    Manager signature
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout">
                                <h4>
                                    Details
                                </h4>
                                <div class="check-details">
                                    <ul>
                                        <li>
                                            <p>
                                                items
                                            </p>
                                            <span>
                                                1
                                            </span>
                                        </li>
                                        <li>
                                            <p>
                                                Cost
                                            </p>
                                            <span id="cost">

                                            </span>
                                        </li>
                                        <li>
                                            <p>
                                                Taxes & Fees
                                            </p>
                                            <span>
                                            {{round( ($egy*.005), 2)}} EGP
                                            </span>
                                        </li>
                                        <li class="total">
                                            <p>
                                                Total
                                            </p>
                                            <span id="total">

                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="buttons">
                                    <a href="{{ route('fakka.profile.index') }}" class="btn blue-btn balance">
                                        Go to balance
                                    </a>
                                </div>
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
</main>

<script>
    function getprice(n) {
        var price = '<?= $egy ?>';
        quantity = $('#price').val(price * n);
    }

    function getgram(n) {

        var price = '<?= $egy ?>';
        grams = $('#quantity').val(n / price);
    }



    function nextss(n) {
        const steps = $('.wizard-steps .step');
        const progress = $('.wizard-steps .progress');
        const bodySections = $('.wizard-body .tab');
        if (n > steps.length - 1) {
            return
        }
        $(steps).removeClass('active');
        $(steps[n]).addClass('active');
        $(steps[n]).prevAll().addClass('active');
        $(bodySections).slideUp();
        $(bodySections[n]).slideDown();
        $(progress).css({
            width: (100 / 3) * (n + 1) + '%',
        });
    }

    function Virtualdetails() {
        
        var quantity = $('#quantity').val();
        var pricepergram=$('#pricepergram').val(); 
        var price = $('#price').val();
        var fullname = $('#fullname').val();
        var Phone = $('#Phone').val();
        var email = $('#email').val();
        var vertial_id = $('#vertial_id');

        var fullnameid = document.getElementById("fullname");
        var priceid = document.getElementById("price");
        var Phoneid = document.getElementById("Phone");
        var emailid = document.getElementById("email");
        var confirmv = document.getElementById("confirmv");
        var walletamount = $('#walletamount').val();
   
        if (quantity < .2) {

            swal('minimum quantity is 0.2 gram');

        } else {
            if (fullname != '' && price != '' && Phone != '' && email != '') {
                if (parseFloat(price) < parseFloat(walletamount)) {

                data = {
                    quantity: quantity,
                    price: price,
                    fullname: fullname,
                    Phone: Phone,
                    email: email,
                    pricepergram:pricepergram,
                    _token: "{{csrf_token()}}",
                };
                $.ajax({
                    url: '{{URL::to("/Virtualdetails") }}',
                    type: 'get',
                    dataType: 'html',
                    data: data,
                    success: function(response) {
                        vertial_id.val(response);
                        getVirtualdetails();
                        nextss(1);
                    },
                    error: function(response) {
                        // alert(response);
                    }
                });
                }else{
                    swal('your money in wallet is not enough !');
                }
            
            } else {
                if (fullname == '') {
                    fullnameid.style.backgroundColor = "#BC0022";

                }
                if (price == '') {
                    priceid.style.backgroundColor = "#BC0022";
                }
                if (Phone == '') {
                    Phoneid.style.backgroundColor = "#BC0022";
                }
                if (email == '') {
                    emailid.style.backgroundColor = "#BC0022";
                }

                swal('please complete red boxs !');
            }
        }
    }




    function getVirtualdetails() {

        var id = $('#vertial_id').val();
        var totprice = $('#totprice');
        var Productprice = $('#totprice');
        var walletamount = $('#walletamount').val();
        var walletremain = $('#walletremain');


        var url = '{{URL::to("/getVirtualdetails")}}';

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
                totprice.val(response['total_price']);
                if (walletamount - response['total_price'] > 0) {
                    walletremain.val(walletamount - response['total_price']);
                } else {
                    walletremain.val(0);
                }

                document.getElementById("Productweight").innerText += response['total_grams'] + ' ' + 'gm';
                document.getElementById("Productprice").innerText += parseFloat(response['total_price']).toFixed(2)  + ' ' + 'EGP';

               // document.getElementById("certificationno").innerText += 'Certificate No. ' + response['certificate_no'] ;
                
                $('#dateissue').val(response['created_at'].substring(0,10));

                //console.log(response);

            },
            error: function(response) {
                console.log(response);
            }
        });
    }


    function paynow() {

        var iban = $('#PassCode').val();
        var id = $('#vertial_id').val();
        var Productprice = $('#Productprice').val();
        var ibanid = document.getElementById("PassCode");
        var walletamount = $('#walletamount').val();
        var totprice = $('#totprice').val();
        var quantity = $('#quantity').val();
        //  alert(totprice);
        // alert(walletamount);
        if (parseFloat(totprice) < parseFloat(walletamount)) {
            //return
            if (id != '' && iban != '') {
                data = {
                    iban: iban,
                    quantity:quantity,
                    totprice:totprice,

                    id: id,
                    _token: "{{csrf_token()}}",
                };
                $.ajax({
                    url: '{{URL::to("/Virtualpaynow") }}',
                    type: 'get',
                    dataType: 'html',
                    data: data,
                    success: function(response) {
                        swal('process completed and Mail Sent To Your Email With Recet No. !');
                       // document.getElementById("total").innerText += response + ' ' + 'EGP';
                       // document.getElementById("cost").innerText += response + ' ' + 'EGP';
                       document.getElementById("cost").innerText += totprice + ' ' + 'EGP';
                       document.getElementById("total").innerText += totprice + ' ' + 'EGP';
                        nextss(2);
                    },
                    error: function(response) {
                        // alert(response);
                    }
                });
            } else {
                if (iban == '') {
                    ibanid.style.backgroundColor = "#BC0022";
                }
                swal('please complete red boxs !');
            }
        } else {
            swal('your money in wallet is not enough !');
        }

    }

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
                        paynow();
                    }
                    if (response == 0) {
                        swal('wrong password. !');
                    }
                },
                error: function(response) {
                    // alert(response);
                }
            });
        } else {



            swal('please complete red boxs !');
        }

    }
</script>
@endsection

@push('scripts')