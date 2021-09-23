@extends('layouts.web.app')

@section('content')


<style>
    .image-upload>input {
        visibility: hidden;
        width: 2px;
        height: 0
    }
</style>

<style>
    .tooltip {
        position: relative;
        display: inline-block;
        border-bottom: 1px dotted black;
    }

    .exclamationfirst .tooltiptext {
        display: none;
        width: 250px;
        font-size: 10px;
        background: red;
        padding: 10px;
        color: #fff;
        text-align: center;
        border-radius: 6px;

        position: absolute;
        z-index: 1;
        right: -2px;
        top: 31px;
    }

    .exclamation .tooltiptext {
        /*visibility: hidden;*/
        display: none;
        width: max-content;

        font-size: 14px;
        background: #fff;
        border: 1px solid red;
        padding: 10px;
        color: red;
        text-align: center;
        border-radius: 6px;

        position: absolute;
        z-index: 1;
        right: -2px;
        top: 31px;
    }

    .exclamation:hover .tooltiptext {
        visibility: visible;
    }
</style>
<main class="register">

    <div class=" col-12" style="max-width: 28%;margin-left: 397px;">
        <div style="display: none;">@include('partials._errors') </div>
    </div>

    <div class="container">

        <div class="register-body">


            <div class="fields">




                <form action="{{ route('fakka.client.store') }}" method="post" enctype="multipart/form-data">

                    {{csrf_field() }}
                    {{ method_field('post') }}
                    <div class="two-fields">
                        <input type="hidden" value="{{$refer_id}}" name="refer_id">
                        <div class="field " style="position: relative;">

                            <!--   <span   class="exclamationfirst" style="border: -1px solid #015CAB;
                                border-radius: 50%;
                                padding: 2px 12px;
                                font-size: 28px;
                                font-weight: 700;
                                margin-left: 12px;
                                color: #ef0808;
                                position: absolute;
                                top: 14px;
                                right: 18px;">
                        * <span id="firstnameerror"class="tooltiptext">
                        field required.

                        </span>
                    </span>-->
                            <span class="exclamation" id="exclamation" style="border: -1px solid #015CAB;
                                 border-radius: 50%;
                                padding: 2px 12px;
                                font-size: 28px;
                                font-weight: 700;
                                margin-left: 12px;
                                color: #d4d4d4;
                                position: absolute;
                                top: 14px;
                                right: 18px;">
                                * <span id="firstnameerror" class="tooltiptext">
                                    required
                                </span>
                            </span>
                            <input oninput="hidefirstnameerror()" class="input input-custom {{ $errors->has('first_name') ? 'has-error' : ''}} " type="text" name="first_name" id="first_name" placeholder="@lang('site.first_name' )" value="{{ old('first_name') }}">

                        </div>
                        <div class="field" style="position: relative;">

                            <span class="exclamation" id="lastexclamation" style="border: -1px solid #015CAB;
                                 border-radius: 50%;
                                padding: 2px 12px;
                                font-size: 28px;
                                font-weight: 700;
                                margin-left: 12px;
                                color: #d4d4d4;
                                position: absolute;
                                top: 14px;
                                right: 18px;">
                                * <span id="last_nameerror" class="tooltiptext">
                                    required
                                </span>
                            </span>

                            <input oninput="hidelast_nameerror()" class="input input-custom {{ $errors->has('last_name') ? 'has-last_nameerror' : ''}} " type="text" name="last_name" id="last_name" placeholder="@lang('site.last_name' )" value="{{ old('last_name') }}">
                        </div>


                    </div>

                    <div class="two-fields ">
                        <div class="telephone">
                            <div class="field">
                                <input class="input input-custom " style="width: 85px;" type="text" name="countarycode" required id="countarycode" placeholder="20" value="{{ old('countarycode') }}">
                            </div>

                            <div class="field" style="position: relative;">

                                <span class="exclamation" id="phoneexclamation" style="border: -1px solid #015CAB;
                                 border-radius: 50%;
                                padding: 2px 12px;
                                font-size: 28px;
                                font-weight: 700;
                                margin-left: 12px;
                                color: #d4d4d4;
                                position: absolute;
                                top: 14px;
                                right: 18px;">
                                    * <span id="phoneerror" class="tooltiptext">
                                        required ,must be number,unique didn't used before
                                    </span>
                                </span>

                                <input oninput="hidephoneerror()" class="input input-custom {{ $errors->has('phone') ? 'has-phoneerror' : ''}}" type="text" name="phone" id="phone" placeholder="@lang('site.phone' )" value="{{ old('phone') }}">
                            </div>
                        </div>
                        <div class="field">
                            <button type="button" id='verifie' onclick="checkacountexist()" class="btn btn-primary" style="padding: 0 10px;">@lang('site.sendcode' )</button>
                            <input style="display: none;" onblur="checkcode()" class="input input-custom " style="width: 85px;" type="text" name="smscode" required id="smscode" placeholder="@lang('site.smscode' )" value="{{ old('smscode') }}">
                        </div>
                    </div>

                    <div class="field" style="position: relative;">

                        <span class="exclamation" id="emailexclamation" style="border: -1px solid #015CAB;
                                 border-radius: 50%;
                                padding: 2px 12px;
                                font-size: 28px;
                                font-weight: 700;
                                margin-left: 12px;
                                color: #d4d4d4;
                                position: absolute;
                                top: 14px;
                                right: 18px;">
                            * <span id="emailerror" style="width: 423px;" class="tooltiptext">
                                required ,must use email formate A***@**.com ,,unique didn't used before
                            </span>
                        </span>
                        <input oninput="hideemailerror()" class="input input-custom {{ $errors->has('email') ? 'has-emailerror' : ''}}" type="email" name="email" id="email" placeholder="@lang('site.email' )" value="{{ old('email') }}">
                    </div>
                    <div class="field" style="position: relative;">
                        <span class="exclamation" id="addressexclamation" style="border: -1px solid #015CAB;
                                 border-radius: 50%;
                                padding: 2px 12px;
                                font-size: 28px;
                                font-weight: 700;
                                margin-left: 12px;
                                color: #d4d4d4;
                                position: absolute;
                                top: 14px;
                                right: 18px;">
                            * <span id="addresserror" class="tooltiptext">
                                required
                            </span>
                        </span>
                        <input oninput="hideaddresserrorr()" class="input input-custom {{ $errors->has('address') ? 'has-addresserror' : ''}} " type="text" name="address" id="address" placeholder="@lang('site.address' )" value="{{ old('address') }}">
                    </div>


                    <div class="field with-icon" style="position: relative;">
                        <span class="exclamation" id="nationalexclamation" style="border: -1px solid #015CAB;
                                 border-radius: 50%;
                                padding: 2px 12px;
                                font-size: 28px;
                                font-weight: 700;
                                margin-left: 12px;
                                color: #d4d4d4;
                                position: absolute;
                                top: 14px;
                                right: -12px;">
                            * <span id="national_iderror" class="tooltiptext" style="right: 140px;">
                                national id required
                            </span>
                            <span id="front_imgerror" class="tooltiptext" style="left:0;top:37px">
                                ID images are required
                            </span>


                        </span>


                        <input oninput="hidenational_iderrorr()" value="{{ old('national_id') }}" name="national_id" id="national_id" class="input input-custom  {{ $errors->has('national_id') ? 'has-national_iderror' : ''}}" type="text" placeholder="@lang('site.NationalID' )">

                        <div class="fileUpload light-background" style="position: relative;">
                            <span class="exclamation" id="frontexclamation" style="border: -1px solid #015CAB;
                                 border-radius: 50%;
                                padding: 2px 12px;
                                font-size: 28px;
                                font-weight: 700;
                                margin-left: 12px;
                                color: #d4d4d4;
                                position: absolute;
                                top: 14px;
                                right: -12px;">
                                * <span id="front_imgerror" class="tooltiptext">

                                </span>
                            </span>


                            <input onclick="hidefront_imgerror()" name="national_id_front_img" type="file" class="upload {{ $errors->has('national_id_front_img') ? 'has-front_imgerror' : ''}}" />
                            <span>
                                <img src="{{ asset('web_files/images/national-id.svg') }}  " alt="">
                            </span>
                        </div>
                        <div class="fileUpload light-background" style="position: relative;">

                            <span class="exclamation" id="backexclamation" style="border: -1px solid #015CAB;
                                 border-radius: 50%;
                                padding: 2px 12px;
                                font-size: 28px;
                                font-weight: 700;
                                margin-left: 12px;
                                color: #d4d4d4;
                                position: absolute;
                                top: 14px;
                                right: -12px;">
                                * <span id="back_imgerror" class="tooltiptext">


                                </span>
                            </span>

                            <input onclick="hideback_imgerror()" name="national_id_back_img" type="file" class="upload {{ $errors->has('national_id_back_img') ? 'has-back_imgerror' : ''}}" />
                            <span>
                                <img src="{{ asset('web_files/images/name.svg') }} " alt="">
                            </span>
                        </div>
                    </div>

                    <div class="field" style="position: relative;">
                        <span class="exclamation" id="passwordexclamation" style="border: -1px solid #015CAB;
                                 border-radius: 50%;
                                padding: 2px 12px;
                                font-size: 28px;
                                font-weight: 700;
                                margin-left: 12px;
                                color: #d4d4d4;
                                position: absolute;
                                top: 14px;
                                right: 18px;">
                            * <span id="passworderror" style="width: 423px;" class="tooltiptext">
                                Should have At least one Uppercase letter, Lower case letter, one numeric value and one special character.
                                Must be not less 8 characters long.

                            </span>
                        </span>
                        <input oninput="hidepassworderror()" class="input input-custom {{ $errors->has('password') ? 'has-passerror' : ''}}" type="password" name="password" id="password" placeholder="@lang('site.password' )">
                    </div>
                    <div class="field" style="position: relative;">

                        <span class="exclamation" id="confirmexclamation" style="border: -1px solid #015CAB;
                                 border-radius: 50%;
                                padding: 2px 12px;
                                font-size: 28px;
                                font-weight: 700;
                                margin-left: 12px;
                                color: #d4d4d4;
                                position: absolute;
                                top: 14px;
                                right: 18px;">
                            * <span id="confirmpasserror" class="tooltiptext">
                                must be same of password

                            </span>
                        </span>
                        <input oninput="hideconfirmpasserror()" class="input input-custom {{ $errors->has('password_confirmation') ? 'has-confirmpasserror' : ''}}" type="password" name="password_confirmation" id="password_confirmation" placeholder="@lang('site.password_confirmation' )">
                    </div>
            </div>
            <div class="captcha" style="position: relative;">
                {{--
                {!! NoCaptcha::renderJs() !!}

{!! NoCaptcha::display() !!}

                --}}

                <span class="exclamation" id="captchaexclamation" style="border: -1px solid #015CAB;
                                 border-radius: 50%;
                                padding: 2px 12px;
                                font-size: 28px;
                                font-weight: 700;
                                margin-left: 12px;
                                color: #d4d4d4;
                                position: absolute;
                                top: 14px;
                                right: 18px;">
                    * <span id="captchaerror" class="tooltiptext">
                        required

                    </span>
                </span>

                <input name="captcha" class="{{ $errors->has('captcha') ? 'has-captchaerror' : ''}}" id="captcha" type="hidden">

                <div class="spinner">
                    <label>
                        <input id="cc" type="checkbox" onclick="$(this).attr('disabled','disabled');$('#captcha').attr('value','1');hidecaptchaerror()">

                        <span class="check"><span>&nbsp;</span></span>
                    </label>
                </div>
                <div class="text">
                    @lang('site.notarobot' )
                </div>
                <div class="logo">
                    <img src="https://forum.nox.tv/core/index.php?media/9-recaptcha-png/" />
                    <p>reCAPTCHA</p>
                </div>
            </div>
            <div class="terms" style="position: relative;">
                <span class="exclamation" id="checkboxexclamation" style="border: -1px solid #015CAB;
                                 border-radius: 50%;
                                padding: 2px 12px;
                                font-size: 28px;
                                font-weight: 700;
                                margin-left: 12px;
                                color: #d4d4d4;
                                position: absolute;
                                top: 14px;
                                right: 18px;">
                    * <span id="checkboxerror" class="tooltiptext">
                        required

                    </span>
                </span>

                <label> @lang('site.Agreeon' )<a href="{{ route('fakka.termcondtions.index') }}">
                        @lang('site.TermsandConditions' )
                    </a>
                    <input onclick="hidecheckboxerror()" name="checkbox" class="{{ $errors->has('checkbox') ? 'has-checkboxerror' : ''}}" type="checkbox" id="checkbox">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="buttons">
                <div id="save" style="display: none;">
                    <button type="submit" class="btn blue-btn">
                        @lang('site.Register' )
                    </button>
                </div>

                <div id="check">
                    <!---->
                    <button type="button" onclick="checkprocess()" class="btn blue-btn">
                        @lang('site.Register' )
                    </button>
                </div>


                </form>


                <a href="{{ route('fakka.login') }}" class="btn outline-btn ">
                    @lang('site.Signin' )
                </a>
            </div>
        </div>
    </div>


    <div class="contact" style="margin-top: 50px;">
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
</main>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
    function checkacountexist() {
        var url = '{{URL::to("/checkacountexist")}}';
        var code = $('#countarycode').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var numbers = /^[0-9]+$/;
        if (code.match(numbers)) {

        } else {

        }


        // country_codes=['20', '966'];
        //  is_valid_number = country_codes.some(elem => code.match('^' + elem));
        /*console.log(is_valid_number );
        return;*/

        if (code != '' && phone != '' && email != '') {

            if (phone.startsWith("0") === true) {
                swal({
                    title: "error!",
                    text: "phone not start with 0 ",
                    icon: "warning",
                });



            } else {

                if (code.match(numbers)) {

                    data = {
                        code: code,
                        phone: phone,
                        email: email,
                        _token: "{{csrf_token()}}",
                    };
                    $.ajax({
                        url: url,
                        type: 'get',
                        dataType: 'html',
                        data: data,

                        success: function(response) {


                            if (response == 0) {
                                swal({
                                    title: "error!",
                                    text: "email or mobile exist before choose another phone and email ",
                                    icon: "warning",
                                });

                            }
                            if (response == 1) {

                                savesmscode();
                            }


                        },
                        error: function(response) {

                            if (response == 0) {
                                swal({
                                    title: "error!",
                                    text: "email or mobile exist before choose another phone and email ",
                                    icon: "warning",
                                });

                            }
                            if (response == 1) {

                                savesmscode();
                            }

                        }
                    });


                } else {
                    swal({
                        title: "error!",
                        text: " countary code is number",
                        icon: "warning",
                    });
                }

            }

        } else {
            swal({
                title: "error!",
                text: "make sure countary code,phone and email isn't empty ",
                icon: "warning",
            });
        }










    }

    function emptyinputs() {
        var first_name = $("#last_name").val();
        var last_name = $("#last_name").val();
        var email = $("#email").val();
        var address = $("#address").val();
        var national_id = $("#national_id").val();
        var check = $("#captcha").val();


        var decimal = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{0,9}$/;
        var passwword = $("#password").val();
        var password_confirmation = $("#password_confirmation").val();


        $('#check').hide();
        $('#save').show();

        if (first_name != '' && last_name != '' && email != '' && address != '' && national_id != '' && $('#checkbox').is(':checked') == true && check == 1) {


            if (passwword.match(decimal)) {
                if (passwword != password_confirmation) {
                    swal({
                        title: "error!",
                        text: "confirm Password must be same of password",
                        icon: "warning",
                    });
                } else {
                    $('#save').click();

                }
            } else {
                swal({
                    title: "error!",
                    text: "Password At least one Uppercase letter, Lower case letter, one numeric value and one special character Must be not less 8 characters long",


                    icon: "warning",
                });
            }


        } else {
            swal({
                title: "error!",
                text: "fill empty inputs",
                icon: "warning",
            });

            $('#check').show();
            $('#save').hide();
        }





    }

    function checkprocess() {
        if ($('#smscode').is(":hidden")) {
            swal({
                title: "error!",
                text: "make sure countary code,phone not empty then press send code ",
                icon: "warning",
            });
        } else {
            emptyinputs();
            checkacountexist();
            checkcode();

        }
    }

    function checkcode() {
        var url = '{{URL::to("/checkcode")}}';
        var code = $('#countarycode').val();
        var phone = $('#phone').val();
        var smscode = $('#smscode').val();

        if (code != '' && phone != '' && smscode != '') {

            data = {
                code: code,
                phone: phone,
                smscode: smscode,
                _token: "{{csrf_token()}}",
            };
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'html',
                data: data,

                success: function(response) {

                    if (response == 1) {
                        // emptyinputs();


                    }
                    if (response == 0) {
                        swal({
                            title: "error!",
                            text: "sms code is wrong ",
                            icon: "warning",
                        });

                    }

                },
                error: function(response) {
                    if (response == 1) {
                        //  emptyinputs();


                    }
                    if (response == 0) {
                        swal({
                            title: "error!",
                            text: "sms code is wrong ",
                            icon: "warning",
                        });

                    }

                }
            });
        } else {
            swal({
                title: "error!",
                text: "make sure countary code,phone and smscode isn't empty ",
                icon: "warning",
            });
        }








    }

    function savesmscode() {
        var url = '{{URL::to("/savesmscode")}}';
        var code = $('#countarycode').val();
        var phone = $('#phone').val();
        var recipients = code + phone;
       
        if (code != '' && phone != '') {
           

            data = {
                code: code,
                phone: phone,
                _token: "{{csrf_token()}}",
            };
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'html',
                data: data,

                success: function(response) {
                    $('#check').hide();
            $('#save').show();

                    sendverifcation(recipients, response);


                },
                error: function(response) {


                }
            });
        } else {
            $('#check').show();
            $('#save').hide();

            swal({
                title: "error!",
                text: "make sure that countary code and phone isn't empty ",
                icon: "warning",
            });
        }
    }


    function sendverifcation(recipients, code) {

        data = {
            senderName: "FakkaOrg",
            messageType: "text",
            messageText: code,
            recipients: recipients,
            _token: "{{csrf_token()}}",
        };
        $.ajax({
            url: 'https://api.cequens.com/cequens/api/v1/messaging',
            type: 'POST',
            contentType: 'application/x-www-form-urlencoded',
            headers: {
                'Authorization': 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbiI6ImNlZjcyZGI5NDMwNjQ3Nzk5ZDNjYWQ2ZTNiYzdlNTNkNGU2ODZjZmVkMWRiNjlhZGQxZjg0ZmZjZGRlOTllYmZkOTJkMTk3ZDkyYjZjNjBhNDQxMGYwNDc4NzlkMzk3YzEzNzJjNWYwZTQ4MjEwYjVlYTlmZjkxYzZkN2IzYzI2ZDBkYTY3ZjFiYzZjNGIwNDI0NzA1N2ZjZDkyNjcxYWIiLCJpYXQiOjE2MTQ2ODc0MTEsImV4cCI6MzE5MjU2NzQxMX0.5XLwAEk68weQVzDY-8cxnYuwZbDbp4GD8YgLgUBo_Es'
            },
            data: data,
            success: function(result) {
                $('#verifie').hide();
                $('#smscode').show();
                $('#check').hide();
            $('#save').show();
            },
            error: function(error) {
                $('#verifie').show();
                $('#smscode').hide();
                $('#check').show();
            $('#save').hide();
            }
        });



    }




    $(document).ready(function() {

        var first_name = $("input").hasClass("has-error");
        if (first_name == true) {
            $('#firstnameerror').show();
            document.getElementById("exclamation").style.color = "#ff0000";
        }

        var password = $("input").hasClass("has-passerror");
        if (password == true) {
            $('#passworderror').show();
            document.getElementById("passwordexclamation").style.color = "#ff0000";
        }
        var last_nameerror = $("input").hasClass("has-last_nameerror");
        if (last_nameerror == true) {
            document.getElementById("lastexclamation").style.color = "#ff0000";
            $('#last_nameerror').show();

        }
        var phoneerror = $("input").hasClass("has-phoneerror");
        if (phoneerror == true) {
            document.getElementById("phoneexclamation").style.color = "#ff0000";
            $('#phoneerror').show();
        }

        var emailerror = $("input").hasClass("has-emailerror");
        if (emailerror == true) {
            document.getElementById("emailexclamation").style.color = "#ff0000";
            $('#emailerror').show();
        }

        var addresserror = $("input").hasClass("has-addresserror");
        if (addresserror == true) {
            document.getElementById("addressexclamation").style.color = "#ff0000";
            $('#addresserror').show();
        }

        var national_iderror = $("input").hasClass("has-national_iderror");
        if (national_iderror == true) {
            document.getElementById("nationalexclamation").style.color = "#ff0000";
            $('#national_iderror').show();
        }
        var confirmpasserror = $("input").hasClass("has-confirmpasserror");
        if (confirmpasserror == true) {
            document.getElementById("confirmexclamation").style.color = "#ff0000";
            $('#confirmpasserror').show();
        }

        var captchaerror = $("input").hasClass("has-captchaerror");
        if (captchaerror == true) {
            document.getElementById("captchaexclamation").style.color = "#ff0000";
            $('#captchaerror').show();
        }

        var checkboxerror = $("input").hasClass("has-checkboxerror");
        if (checkboxerror == true) {
            document.getElementById("checkboxexclamation").style.color = "#ff0000";
            $('#checkboxerror').show();
        }

        var front_imgerror = $("input").hasClass("has-front_imgerror");
        if (front_imgerror == true) {
            document.getElementById("frontexclamation").style.color = "#ff0000";
            $('#front_imgerror').show();
        }

        var back_imgerror = $("input").hasClass("has-back_imgerror");
        if (back_imgerror == true) {
            document.getElementById("backexclamation").style.color = "#ff0000";
            $('#front_imgerror').show();
        }



    });

    function hidefirstnameerror() {
        $('#firstnameerror').hide();
    }

    function hidepassworderror() {
        $('#passworderror').hide();
    }

    function hidelast_nameerror() {
        $('#last_nameerror').hide();
    }

    function hidephoneerror() {
        $('#phoneerror').hide();
    }

    function hideemailerror() {
        $('#emailerror').hide();
    }

    function hideaddresserrorr() {
        $('#addresserror').hide();
    }

    function hidenational_iderrorr() {
        $('#national_iderror').hide();
    }

    function hideconfirmpasserror() {
        $('#confirmpasserror').hide();
    }

    function hidecaptchaerror() {
        $('#captchaerror').hide();
    }

    function hidecheckboxerror() {
        $('#checkboxerror').hide();
    }


    function hidefront_imgerror() {
        $('#front_imgerror').hide();
    }

    function hideback_imgerror() {
        $('#front_imgerror').hide();
    }
</script>



@endsection

@push('scripts')