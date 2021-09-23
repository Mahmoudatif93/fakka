@extends('layouts.web.app')
@section('content')

<style>
    .fileUpload>input {
        visibility: hidden;
        width: 2px;
        height: 0
    }
.fileUploadssss>input{
    visibility: hidden;
        width: 2px;
        height: 0
}
    .products-details {
        padding-top: 0;
    }

    .products-details .details {
        margin-bottom: 15px;
    }

    .products-details .details .item .certification-info {
        position: absolute;
        left: 36%;
        top: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }

    .certifications .grid-container {
        grid-gap: 10px;
        padding: 0;
    }

    .products-details .container {
        max-width: 325px;
        padding: 0;
    }

    .products-details .details .item figure {
        margin: 0;
    }

    .products-details .details .item .certification-info .certification-head {
        margin-bottom: 0;
    }

    .products-details .details .item .certification-info .certification-head label {
        font-size: 10px;
        color: #a1a1a1;
    }

    .products-details .details .item .certification-info .certification-head .input {
        color: #015CAB;
        font-size: 15px;
    }

    .products-details .details .item .certification-info .certification-body .grid-container {
        display: -ms-grid;
        display: grid;
        grid-gap: 0;
    }

    .products-details .details .item .certification-info .certification-body span,
    .products-details .details .item .certification-info .certification-body label {
        font-size: 10px;
        color: #A1A1A1;
    }

    .products-details .details .item .certification-info .certification-body .input {
        color: #015CAB;
        font-size: 15px;
    }
</style>


<main>

    <div class="background-title">
        <figure>
            <!-- <img  src="{{ asset('web_files/images/shopping-bg.svg') }} " alt="">-->
            <div style="background:linear-gradient(to right,#015CAB,#DD7F28);height: 203px;"></div>
        </figure>
        <div class="title">
            <h2>
                 @lang('site.profile')
            </h2>
        </div>
    </div>
    <div class="tabs-form">
        <div class="container">
            <button class="tablinks btn" onclick="openTabs(event, 'Tab1')" id="defaultOpen">
            @lang('site.PersonalInformation')  </button>
            <button class="tablinks btn" onclick="openTabs(event, 'Tab2')"> @lang('site.Balance')
                @if($total_point < $point_dedicated) <span class="exclamation" style="border: 1px solid #015CAB;
                    border-radius: 50%;
                    padding: 0 12px;
                    font-size: 21px;
                    font-weight: 700;
                    margin-left: 12px;
                    background: wheat;">
                    !
                    </span>
                    @endif

            </button>
            <button class="tablinks btn" onclick="openTabs(event, 'Tab3')"> @lang('site.History')  </button>

        </div>
    </div>
    <div class="container tabs-contents">
        <div id="Tab1" class="tabcontent">
            <div class="details">
                <div>
                    <h4>
                    @lang('site.PersonalInformation')  
                    </h4>
                    <div class="fields">
                        <div class="two-fields">
                            <div class="field">
                                <label for="">
                                     @lang('site.Firstname')
                                </label>
                                <input class="input input-custom " type="text" name="" id="" value="{{Auth::guard('website')->user()->first_name}}" readonly>
                            </div>
                            <div class="field">
                                <label for="">
                                      @lang('site.Lastname')
                                </label>
                                <input class="input input-custom " type="text" name="" id="" value="{{Auth::guard('website')->user()->last_name}}" readonly>
                            </div>
                        </div>
                        <div class="field">
                            <label for="">
                                  @lang('site.Emailaddress')
                            </label>
                            <input class="input input-custom " type="text" name="" id="" value="{{Auth::guard('website')->user()->email}}" readonly>
                        </div>
                        <div class="field">
                            <label for="">
                                 @lang('site.Phonenumber')
                            </label>
                            <input class="input input-custom " type="number" name="" id="" value="{{Auth::guard('website')->user()->phone}}" readonly>
                        </div>
                        <div class="field">
                            <label for="">
                                @lang('site.NationalID')
                            </label>
                            <div class="id">
                                <figure>
                                    <img src="{{ asset('uploads/clients/'.Auth::guard('website')->user()->national_id_front_img) }} " alt="">
                                </figure>
                                <figure>
                                    <img src="{{ asset('uploads/clients/'.Auth::guard('website')->user()->national_id_back_img) }} " alt="">
                                </figure>
                            </div>
                            <input class="input input-custom id-no" type="number" name="" id="" value="{{Auth::guard('website')->user()->national_id}}" readonly>
                        </div>


                <div class="address">
                <span>
                       @lang('site.refer_code')
                </span>
                <div class="content">
                    <div class="field" style="position: relative;">
                        <input style="font-size: 19px;" class="input input-custom " type="text" name="refer_id" id="refer_id" value="{{ route('fakka.client.index') }}?refer_id={{Auth::guard('website')->user()->refer_id}}" readonly>
                        <button onclick="copylink()" class="btn outline-btn">
                                @lang('site.copylink')
                        </button>
                    </div>
                </div>
            </div>

            
            
                    </div>
                </div>
                <div class="preference">
                    <h4>
                         @lang('site.Preferances')
                    </h4>


                    <div class="img-section">
                        <span>
                              @lang('site.Profileimage')
                            @include('partials._errors')
                        </span>
                        <form enctype="multipart/form-data" action="{{ route('fakka.image.ajax.store') }}" method="post" id="">
                            {{ csrf_field() }}
                            {{ method_field('post') }}
                            <input type="hidden" name="id" value="{{Auth::guard('website')->user()->id}}">
                            <div class="content">
                                <div class="profile-img ">
                                    <div class="fileUpload">
                                        <label for="file-inputs">
                                            @if(!empty(Auth::guard('website')->user()->image))
                                            <img src="{{ asset('uploads/clients/'.Auth::guard('website')->user()->image) }}" alt="" class="image--cover" style="pointer-events: none">

                                            @else
                                            <img src="{{ asset('uploads/clients/default.png') }}" alt="" class="image--cover" style="pointer-events: none" />

                                            @endif
                                        </label>
                                        <input name="image" id="file-inputs" type="file" class="upload" />
                                    </div>
                                </div>
                                <div class="changeable">
                                    <button type="submit" class="btn outline-btn">
                                          @lang('site.edit')
                                    </button>




                        </form>
                        <button type="button" onclick="delete_image('{{Auth::guard('website')->user()->id}}')" class="btn outline-red">
                              @lang('site.Remove')
                        </button>
                    </div>



                </div>


            </div>


            <div class="card">
                <span>
                      @lang('site.SavedCard')
                </span>
                <div class="content">
                    <div class="saved-cards">

                        @foreach ($ibans as $iban)
                        <div class="field">

                            <input class="input input-custom " name="" id="{{$iban->id}}" value="{{$iban->Iban_number}}" readonly>
                            <button type="button" onclick="delete_iban('{{$iban->id}}')" class="btn outline-red">
                            @lang('site.Remove')
                            </button>

                        </div>
                        @endforeach
                        <div class="buttons">
                            <button class="btn outline-btn" data-toggle="modal" data-target="addcard1_popup">
                            
                                  @lang('site.AddNewIban')
                            </button>

                            <div class="popup" id="addcard1_popup">
                                <div class="popup_main">
                                    <div class="popup_body">
                                        <div class="popup_back">
                                            <div class="popup_contain addcard-popup">
                                                <h2>
                                                @lang('site.AddNewIban')
                                                </h2>
                                                <div class="two-fields">
                                                    <div class="field">
                                                        <label for="">
                                                            Bank Name
                                                        </label>
                                                        <span class="sub-label">
                                                            Required
                                                        </span>
                                                        <input id="clientbank" class="input input-custom " type="text" placeholder=" Eg,Cib,QNB ">
                                                    </div>
                                                    <div class="field ">
                                                        <label for=" ">
                                                            Iban Number
                                                        </label>
                                                        <span class="sub-label ">
                                                            Required
                                                        </span>
                                                        <input id="iban_number" class="input input-custom " type="text " placeholder="**** **** **** **** ">
                                                    </div>
                                                </div>
                                                <!-- <div class="three-fields">
                                                            <div class="date">
                                                                <label for="">
                                                                    Expiration date
                                                                </label>
                                                                <div class="field">
                                                                    <input class="input input-custom small-field" type="number" placeholder="DD">
                                                                </div>
                                                                <div class="field">
                                                                    <input class="input input-custom small-field" type="number" placeholder="MM">
                                                                </div>
                                                                <div class="field">
                                                                    <input class="input input-custom big-field" type="number" placeholder="YYYY">
                                                                    <span class="sub-label">
                                                                        Required
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>-->
                                                <div class="buttons">


                                                    <div onclick="save_iban()" class="btn blue-btn small" data-modal-dismiss>
                                                    @lang('site.add')</div>
                                                    <div style="margin-left:10px" class="btn red-btn small" data-modal-dismiss>
                                                         @lang('site.cancel') </div>

                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="address">
                <span>
                       @lang('site.DefaultAddress')
                </span>
                <div class="content">
                    <div class="field">
                        <input class="input input-custom " type="text" name="address" id="address" value="{{Auth::guard('website')->user()->address}}">
                        <button onclick="update_address('{{Auth::guard('website')->user()->id}}')" class="btn outline-btn">
                                @lang('site.edit')
                        </button>
                    </div>
                </div>
            </div>
            <div class="address">
                <div class="img-section">
                    <span>
                    @lang('site.IdSelfieimage') 

                    </span>
                    <form enctype="multipart/form-data" action="{{ route('fakka.image.slfestore') }}" method="post" id="">
                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        <input type="hidden" name="id" value="{{Auth::guard('website')->user()->id}}">
                        <div class="content">
                            <div class="profile-img ">
                                <div class="fileUploadssss">
                                    <label for="file-inputss">
                                        @if(!empty(Auth::guard('website')->user()->id_image))
                                        <img src="{{ asset('uploads/clients/'.Auth::guard('website')->user()->id_image) }}" alt="" class="image--cover" style="pointer-events: none">

                                        @else
                                        <img src="{{ asset('uploads/clients/default.png') }}" alt="" class="image--cover" style="pointer-events: none" />

                                        @endif
                                    </label>
                                    <input name="id_image" id="file-inputss" type="file" class="" />
                                </div>
                             
                            </div>
                            <div class="changeable">
                                <button type="submit" class="btn outline-btn">
                                @lang('site.edit')
                                </button>
                    </form>
                    <button type="button" onclick="delete_selfeimage('{{Auth::guard('website')->user()->id}}')" class="btn outline-red">
                            @lang('site.Remove')
                    </button>
                </div>

            </div>





        </div>
    </div>
    <div class="reset">
        <a href="{{ route('fakka.newpassword' ,Auth::guard('website')->user()->id ) }}" class="btn blue-btn">
        @lang('site.Resetpassword') 
        </a>
    </div>
    </div>
    </div>
    </div>
    <div id="Tab2" class="tabcontent">
        <div class="details">
            <div class="cards2">
                <div class="card2">
                    <figure>
                        <img src="{{ asset('web_files/images/virtual.svg') }} " alt="">
                    </figure>
                    <div class="card-content">
                        <h5>
                             @lang('site.Virtual')  <input type="hidden" id="pricess" value="{{$egy}}">
                        </h5>
                        <span id="ss">
                            {{ $total_virtual}} <input type="hidden" id="total_gram" value=" {{ $total_virtual}} ">
                        </span>

                        gram
                    </div>
                </div>
                <div class="card2">
                    <figure>
                        <img src="{{ asset('web_files/images/physical.svg') }} " alt="">
                    </figure>
                    <div class="card-content">
                        <h5>
                             @lang('site.Physical') 
                        </h5>
                        <span>
                            {{$totalphysical + $totalcard}} gram 
                        </span>
                    </div>
                </div>
                <div class="card2">
                    <figure>
                        <img src=" {{ asset('web_files/images/wallet.svg') }} " alt="">
                    </figure>
                    <div class="card-content">
                        <h5>
                             @lang('site.Wallet') 
                        </h5>
                        <span>
                            {{ round($wallet, 2)}} EGP
                        </span>
                    </div>
                </div>
                <div class="card2">
                    <figure>
                        <img src=" {{ asset('web_files/images/points.svg') }}" alt="">
                    </figure>
                    <div class="card-content">
                        <h5>
                             @lang('site.Points') 

                            @if($total_point < $point_dedicated) <span class="exclamation" style="border: 1px solid #015CAB;
                    border-radius: 50%;
                    padding: 0 12px;
                    font-size: 21px;
                    font-weight: 700;
                    margin-left: 12px;
                    background: wheat;">
                                !
                                </span>
                                @endif
                        </h5>
                        <span id="poin">
                            {{$total_point}}
                        </span>

                    </div>
                </div>

            </div>
            <div class="vertical-tabs">
                <div id="vertical_tab_nav">
                    <div class="vertical-links">
                        <div class="selected link">
                            <a href="#">
                                   @lang('site.VirtualBalance') 
                            </a>
                        </div>
                        <div class="link">
                            <a href="#">
                                  @lang('site.PhysicalBalance') 
                            </a>
                        </div>
                        <div class="link">
                            <a href="#">
                            @lang('site.Wallet') 
                            </a>
                        </div>
                        <div class="link">

                            <a href="#">
                            @lang('site.Points') 
                                @if($total_point < $point_dedicated) <span class="exclamation" style="border: 1px solid #015CAB;
                    border-radius: 50%;
                    padding: 0 12px;
                    font-size: 21px;
                    font-weight: 700;
                    margin-left: 12px;
                    background: wheat;">
                                    !
                                    </span>
                                    @endif
                            </a>
                        </div>
                    </div>
                    <div>
                        <div class="content">
                            <div class="balance">
                                <div>
                                    <div class="goals">
                                        <h4>
                                        @lang('site.goals')  
                                        </h4>
                                        <div class="chart">
                                            <div class="product">
                                                <figure>
                                                    <img src="{{ asset('web_files/images/goal.png') }} " alt="">
                                                </figure>
                                                <div class="remains">
                                                    <span>
                                                        66 Gram gold ingot
                                                    </span>
                                                    <p>
                                                        35 gram remain to have access to this ingot
                                                    </p>
                                                </div>

                                            </div>
                                            <!-- <div class="pie-chart">
                                                        <canvas id="gramChart" width="111px" height="150px"></canvas>
                                                        <span>
                                                            66%
                                                        </span>
                                                    </div>-->

                                            <div id="pie-chart">
                                                <span>

                                                </span>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="certifications">
                                        <div class="grid-container">

                                            @foreach($virtualpaymenthistory as $virtual)
                                            <div class="grid-item">
                                                <div class="products-details">
                                                    <div class="container">
                                                        <div>

                                                            <div class="details">
                                                                <div class="item">
                                                                    <figure>
                                                                        <img src="{{ asset('web_files/images/certification.png') }} " alt="">
                                                                    </figure>
                                                                    <div class="certification-info">
                                                                        <div class="certification-head">
                                                                            <label>
                                                                                Certificate No. {{$virtual->certificate_no}}
                                                                            </label>
                                                                            <input class="input" type="text" value=" {{$virtual->quantity}}  grams gold 24K" readonly>
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
                                                                                    <input type="text" class="input" value=" {{$virtual->created_at}}" readonly>
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

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                <div class="total-balance">
                                    <h4>
                                         @lang('site.TotalBalance')
                                    </h4>
                                    <div class="balance-details">
                                        <h2>
                                            {{ $total_virtual}} Gram
                                        </h2>

                                        <button class="open_popup btn blue-btn" data-toggle="modal" data-target="redeem_gold_popup">Redeem Gold</button>
                                        <button class="btn blue-btn" data-toggle="modal" data-target="redeem_money_popup">Redeem Money</button>
                                        <div class="popup" id="redeem_gold_popup">
                                            <div class="popup_main">
                                                <div class="popup_body">
                                                    <div class="popup_back"></div>
                                                    <div class="popup_contain">
                                                        <div class="popup_close" data-modal-dismiss>x</div>
                                                        <h2>
                                                             @lang('site.Redeemvirtualgold')
                                                        </h2>
                                                        <span id='error4'></span>
                                                        <span style=" margin-left: 177px;" id='error'></span>
                                                        <div class="fields">
                                                            <div class="two-fields">
                                                                <div class="field list">
                                                                    <label for="">
                                                                         @lang('site.UniteWeight')
                                                                    </label>
                                                                    <span class="sub-label">
                                                                           @lang('site.Required')
                                                                    </span>
                                                                    <span>
                                                                        gram
                                                                    </span>
                                                                    <select id="quantity" onchange="check_quantity(this.value)" class="dropdown" name="" id="">
                                                                        <option selected readonly>
                                                                            choose
                                                                        </option>

                                                                        @foreach ($feesCaches as $category)
                                                                        <option data-id="{{$category->cache_back}}" value="{{ $category->Ingots['ingots'] }}">{{ $category->Ingots['ingots'] }}</option>

                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="field">
                                                                    <div class="quantity">
                                                                        <label>
                                                                             @lang('site.amount')
                                                                        </label>
                                                                        <span class="sub-label">
                                                                        @lang('site.Required')
                                                                        </span>
                                                                        <input oninput="checkamount()" id="amountw" class="number input" type="text" Value="0">
                                                                        <div class="buttons">
                                                                            <button class="plus btn">
                                                                                <figure>
                                                                                    <svg viewBox="0 0 10.406 5.965">
                                                                                        <use xlink:href="{{ asset('web_files/images/sprite.svg#quantity') }} ">
                                                                                        </use>
                                                                                    </svg>
                                                                                </figure>
                                                                            </button>
                                                                            <button class="minus btn">
                                                                                <figure>
                                                                                    <svg viewBox="0 0 10.406 5.965">
                                                                                        <use xlink:href="{{ asset('web_files/images/sprite.svg#quantity') }}">
                                                                                        </use>
                                                                                    </svg>
                                                                                </figure>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="field" style="display: none" id="conf_passinput">
                                                                <label>
                                                                     @lang('site.password')
                                                                </label>
                                                                <input type="password" class="input" id="passwords" placeholder="write Your password">
                                                            </div>
                                                        </div>



                                                        <div class="popup-footer" id="openpass">

                                                            <button onclick="openpassword()" class="open_popup btn blue-btn">Redeem</button>
                                                            <span>
                                                                @lang('site.Additionalfees') <span id="fees"></span>
                                                            </span>

                                                        </div>

                                                        <div class="popup-footer" id="confpassdiv" style="display: none">

                                                            <button onclick="conf_password()" class="open_popup btn blue-btn">Redeem</button>
                                                            <span>
                                                                @lang('site.Additionalfeesapplied')
                                                            </span>

                                                        </div>

                                                        <div class="popup-footer" id="wallletredeme" style="display: none">

                                                            <button onclick="checkwaletredeme()" class="open_popup btn blue-btn">Redeem</button>
                                                            <span>
                                                            @lang('site.Additionalfeesapplied')
                                                            </span>

                                                        </div>
                                                        <div class="popup-footer" id="opensave" style="display: none">
                                                            <!-- <button onclick="saveredeemgold()" class="open_popup btn blue-btn" data-toggle="modal" data-target="gold_popup">Redeem</button>-->

                                                            <button onclick="saveredeemgold()" class="open_popup btn blue-btn">Redeem</button>
                                                            <span>
                                                            @lang('site.Additionalfeesapplied')
                                                            </span>

                                                        </div>




                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="popup" id="redeem_money_popup">
                                            <div class="popup_main">
                                                <div class="popup_body">
                                                    <div class="popup_back"></div>
                                                    <div class="popup_contain">
                                                        <div class="popup_close" data-modal-dismiss>x</div>
                                                        <h2>
                                                            Redeem Money
                                                        </h2>
                                                        <span id='error2'></span>
                                                        <div class=fields>
                                                            <div class="two-fields">
                                                                <div class="field">
                                                                    <div class="quantity">
                                                                        <label>
                                                                            Amount
                                                                        </label>
                                                                        <span class="sub-label">
                                                                            Required
                                                                        </span>
                                                                        <input id="equal2" oninput="getEqual()" class="number input" type="text" Value="0">
                                                                        <div class="buttons">
                                                                            <button class="plus btn">
                                                                                <figure>
                                                                                    <svg viewBox="0 0 10.406 5.965">
                                                                                        <use xlink:href="{{ asset('web_files/images/sprite.svg#quantity') }}">
                                                                                        </use>
                                                                                    </svg>
                                                                                </figure>
                                                                            </button>
                                                                            <button class="minus btn">
                                                                                <figure>
                                                                                    <svg viewBox="0 0 10.406 5.965">
                                                                                        <use xlink:href="{{ asset('web_files/images/sprite.svg#quantity') }}">
                                                                                        </use>
                                                                                    </svg>
                                                                                </figure>
                                                                            </button>
                                                                        </div>
                                                                        <span>
                                                                            gram
                                                                        </span>

                                                                    </div>
                                                                </div>
                                                                <div class="field readonly">
                                                                    <label>
                                                                        Equal
                                                                    </label>
                                                                    <input type="text" id="Equals" class="input" value="0" readonly>
                                                                    <span>
                                                                        EGP
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="field list">
                                                                        <label for="">
                                                                            Select current IBAN
                                                                        </label>
                                                                        <select class="dropdown" name="" id="money_iban">
                                                                            <option value="">
                                                                                choose Current IBAN
                                                                            </option>

                                                                            @foreach ($ibans as $iban)
                                                                            <option value="{{ $iban->Iban_number }}">{{ $iban->Iban_number }}</option>
                                                                            @endforeach

                                                                        </select>
                                                                        <div class="addcard">
                                                                            <button class="btn blue-btn" data-toggle="modal" data-target="addcard_popup">Add New
                                                                                IBAN</button>
                                                                        </div>
                                                                    </div>-->
                                                        </div>
                                                        <div class="popup-footer">
                                                            <button onclick="saveredeemmoney()" class="btn blue-btn">Redeem</button>
                                                            <!--<button onclick="saveredeemmoney()" class="btn blue-btn" data-toggle="modal" data-target="money_popup">Redeem</button>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="popup" id="gold_popup">
                                            <div class="popup_main">
                                                <div class="popup_body">
                                                    <div class="popup_back">
                                                        <div class="popup_contain alert-popup">
                                                            <h2>
                                                                Successful
                                                            </h2>
                                                            <p>
                                                                Gold will be converted to cash 1st then the needed physical gold will be purchased, 0.5% will be deduced from wallet
                                                            </p>
                                                            <div class="btn blue-btn small" data-modal-dismiss>
                                                                Ok</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="popup" id="money_popup">
                                            <div class="popup_main">
                                                <div class="popup_body">
                                                    <div class="popup_back">
                                                        <div class="popup_contain alert-popup">
                                                            <h2>
                                                                Alert
                                                            </h2>
                                                            <p>
                                                                This action is prohibited, Please contact customer services </p>
                                                            <div class="btn blue-btn small" data-modal-dismiss>
                                                                Ok</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="popup" id="addcard_popup">
                                            <div class="popup_main">
                                                <div class="popup_body">
                                                    <div class="popup_back">
                                                        <div class="popup_contain addcard-popup">
                                                            <h2>
                                                                Add new IBAN
                                                            </h2>
                                                            <div class="two-fields">
                                                                <div class="field">
                                                                    <label for="">
                                                                        IBAN Number
                                                                    </label>
                                                                    <span class="sub-label">
                                                                        Required
                                                                    </span>
                                                                    <input id="iban_number" class="input input-custom " type="number" placeholder="your New IBAN ">
                                                                </div>
                                                                <!--  <div class="field ">
                                                                            <label for=" ">
                                                                                Card Number
                                                                            </label>
                                                                            <span class="sub-label ">
                                                                                Required
                                                                            </span>
                                                                            <input class="input input-custom " type="number " placeholder="**** **** **** **** ">
                                                                        </div>-->
                                                            </div>
                                                            <!--<div class="three-fields">
                                                                        <div class="date">
                                                                            <label for="">
                                                                                Expiration date
                                                                            </label>
                                                                            <div class="field">
                                                                                <input class="input input-custom small-field" type="number" placeholder="DD">
                                                                            </div>
                                                                            <div class="field">
                                                                                <input class="input input-custom small-field" type="number" placeholder="MM">
                                                                            </div>
                                                                            <div class="field">
                                                                                <input class="input input-custom big-field" type="number" placeholder="YYYY">
                                                                                <span class="sub-label">
                                                                                    Required
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>-->
                                                            <div onclick="save_iban()" class="btn blue-btn small" data-modal-dismiss>
                                                                Add</div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <span>
                                        @lang('site.Additionalfeesapplied')
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="balance">
                                <div>
                                    <div class="store">
                                        <div class="block-head">
                                            <h4>
                                            @lang('site.Physicalgoldinstore')

                                            </h4>
                                            <button class="btn outline-btn" data-toggle="modal" data-target="certificate_popup">   @lang('site.Certificates')</button>

                                            <div class="popup" id="certificate_popup">
                                                <div class="popup_main">
                                                    <div class="popup_body">
                                                        <div class="popup_back"></div>
                                                        <div class="popup_contain">
                                                            <div class="popup_close" data-modal-dismiss>x</div>
                                                            <h2>
                                                                  @lang('site.Certificates')
                                                            </h2>
                                                            <div class="grid-container">
                                                            @if(!empty($virtualBalanceGold))
                                                                @foreach($virtualBalanceGold as $virtualBalance)
                                                                <div class="grid-item">
                                                                    <div class="products-details">
                                                                        <div class="container">
                                                                            <div class="details">
                                                                                <div class="item">
                                                                                    <figure>
                                                                                        <img src="{{ asset('web_files/images/pysical-gold-certificate.png') }} " alt="">
                                                                                    </figure>
                                                                                    <div class="certification-info">
                                                                                        <div class="certification-head">
                                                                                            <label>
                                                                                                Certificate No. {{$virtualBalance->certificate_no}}
                                                                                            </label>
                                                                                            <input class="input" type="text" value="{{ $virtualBalance->unite_weight * $virtualBalance->amount  }} grams gold 24K" readonly>
                                                                                        </div>
                                                                                        <div class="certification-body">
                                                                                            <div class="grid-container">
                                                                                                <div class="row-1">
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
                                                                                                        <input type="number" class="input" value="{{Auth::guard('website')->user()->national_id}}" readonly>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row-2">
                                                                                                    <div class="grid-item">
                                                                                                        <label>
                                                                                                            Issuing date
                                                                                                        </label>
                                                                                                        <input type="text" class="input" value="{{$virtualBalance->created_at}}" readonly>
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
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                @endforeach
                                                                @endif

                                                                @if(!empty($shopingcartproducts))

                                                                @foreach($shopingcartproducts as $row)

                                                        
                                                                    @foreach($row->Orderdetails as $details)
                                                                @if(!empty($details->certificate_no))

                                                                <div class="grid-item">
                                                                    <div class="products-details">
                                                                        <div class="container">
                                                                            <div class="details">
                                                                                <div class="item">
                                                                                    <figure>
                                                                                        <img src="{{ asset('web_files/images/pysical-gold-certificate.png') }} " alt="">
                                                                                    </figure>
                                                                                    <div class="certification-info">
                                                                                        <div class="certification-head">
                                                                                            <label>
                                                                                                Certificate No. {{$details->certificate_no}}
                                                                                            </label>
                                                                                            <input class="input" type="text" value="{{ $details->product_weight * $details->qty  }} grams gold 24K" readonly>
                                                                                        </div>
                                                                                        <div class="certification-body">
                                                                                            <div class="grid-container">
                                                                                                <div class="row-1">
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
                                                                                                        <input type="number" class="input" value="{{Auth::guard('website')->user()->national_id}}" readonly>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row-2">
                                                                                                    <div class="grid-item">
                                                                                                        <label>
                                                                                                            Issuing date
                                                                                                        </label>
                                                                                                        <input type="text" class="input" value="{{$row->created_at}}" readonly>
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
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endforeach
                                                                
                                                                @endforeach
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="grid-container">
                                            @foreach($virtualBalanceGold as $virtual)
                                            <div class="grid-item">

                                                <figure>
                                                    <img src=" {{ asset('web_files/images/gold-coin.png') }} " alt="">
                                                </figure>

                                                <div class="details">
                                                    <h4>
                                                        {{$virtual->unite_weight *  $virtual->amount}} gram BTC Gold 24k
                                                    </h4>
                                                    <span>
                                                        {{$virtual->price}} EGP
                                                    </span>

                                                </div>
                                            </div>
                                            @endforeach

                                            @foreach($shopingcartproducts as $shopingcartproduct)
                                            @if($shopingcartproduct->type =="Sell"  )
                                               @foreach($shopingcartproduct->Orderdetails as $card)
                                                     @if($card->purchased ==0  )
                                            <div class="grid-item">

                                                <figure>
                                                    <img src=" {{ asset('web_files/images/gold-coin.png') }} " alt="">
                                                </figure>

                                                <div class="details">
                                                    <h4>
                                                    
                                                        {{$card->product_weight * $card->qty }} gram BTC Gold 24k 
                                                    </h4>
                                                    <span>
                                                        
                                                        {{ round($card->product_weight *  $shopingcartproduct->price_per_gram * $card->qty + $card->totalfees, 2)}}
                                                        EGP
                                                    </span>

                                                </div>
                                            </div>
                                                  @endif
                                               @endforeach
                                               @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="total-balance">
                                    <h4>
                                    @lang('site.TotalBalance')
                                    </h4>
                                    <div class="balance-details">
                                        <h2>
                                            {{$totalphysical + $totalcard}} Gram 
                                        </h2>
                                        <button class="btn blue-btn" data-toggle="modal" data-target="redeem_money2_popup">Redeem Money</button>
                                        <div class="popup" id="redeem_money2_popup">
                                            <div class="popup_main">
                                                <div class="popup_body">
                                                    <div class="popup_back"></div>
                                                    <div class="popup_contain">
                                                        <div class="popup_close" data-modal-dismiss>x</div>
                                                        <h2>
                                                            Redeem Money
                                                        </h2>
                                                        <div class="fields">
                                                            <div class="two-fields">


                                                                <div class="field list no-bg">
                                                                    <label for="">
                                                                        Converted Ingots
                                                                    </label>
                                                                    <span class="sub-label">
                                                                        Required
                                                                    </span>

                                                                    <select id="select-multiple" onchange="getphysicalredeemmoney()" name="vertual_ingots[]" placeholder="Select Ingots Weights" class="selectpicker select_customsss dropdown" multiple>
                                                                        @foreach($virtualBalanceGold as $virtual)
                                                                        <option style=" height: 61px;font-size: 20px" data-virtualcashs="{{$virtual->cache_back}}" data-id="{{$virtual->id}}" value="{{$virtual->unite_weight *  $virtual->amount}}">{{$virtual->unite_weight *  $virtual->amount}} gram BTC Gold 24k</option>
                                                                        @endforeach
                                                                        @foreach($shopingcartproducts as $shopingcartproduct)
                                                                        @if($shopingcartproduct->type =="Sell"  )
                                                                        @foreach($shopingcartproduct->Orderdetails as $card)
                                                                        @if($card->purchased ==0 )

                                                                        <option style="height: 62px; " data-shopingproductid="{{$card->product_id}}" data-idshoping="{{$card->id}}" value="{{$card->product_weight * $card->qty}}">{{$card->product_weight * $card->qty }} gram BTC Gold 24k</option>
                                                                        @endif
                                                                        @endforeach
                                                                        @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="field ">
                                                                    <label>
                                                                        Equal
                                                                    </label>
                                                                    <input readonly type="text" id="physicalredeemmoney" name="physicalredeemmoney" class="input" value="" readonly>
                                                                    <span>
                                                                        EGP
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="field list">


                                                            </div>
                                                        </div>
                                                        <div class="popup-footer">
                                                            <button onclick='savephysicalredeemmoney()' class="btn blue-btn">Redeem</button>

                                                            <!--  <button onclick='savephysicalredeemmoney()' class="btn blue-btn" data-toggle="modal" data-target="money2_popup">Redeem</button>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="popup" id="money2_popup">
                                            <div class="popup_main">
                                                <div class="popup_body">
                                                    <div class="popup_back">
                                                        <div class="popup_contain alert-popup">
                                                            <h2>
                                                                Alert
                                                            </h2>
                                                            <p>
                                                                This action is prohibited, Please contact customer services </p>
                                                            <div class="btn blue-btn small" data-modal-dismiss>
                                                                Ok</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="popup" id="addcard6_popup">
                                            <div class="popup_main">
                                                <div class="popup_body">
                                                    <div class="popup_back">
                                                        <div class="popup_contain addcard-popup">
                                                            <h2>
                                                                Add new card
                                                            </h2>
                                                            <div class="two-fields">
                                                                <div class="field">
                                                                    <label for="">
                                                                        Name On Card
                                                                    </label>
                                                                    <span class="sub-label">
                                                                        Required
                                                                    </span>
                                                                    <input class="input input-custom " type="text" placeholder=" Eg, Mansour ali ">
                                                                </div>
                                                                <div class="field ">
                                                                    <label for=" ">
                                                                        Card Number
                                                                    </label>
                                                                    <span class="sub-label ">
                                                                        Required
                                                                    </span>
                                                                    <input class="input input-custom " type="number " placeholder="**** **** **** **** ">
                                                                </div>
                                                            </div>
                                                            <div class="three-fields">
                                                                <div class="date">
                                                                    <label for="">
                                                                        Expiration date
                                                                    </label>
                                                                    <div class="field">
                                                                        <input class="input input-custom small-field" type="number" placeholder="DD">
                                                                    </div>
                                                                    <div class="field">
                                                                        <input class="input input-custom small-field" type="number" placeholder="MM">
                                                                    </div>
                                                                    <div class="field">
                                                                        <input class="input input-custom big-field" type="number" placeholder="YYYY">
                                                                        <span class="sub-label">
                                                                            Required
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="buttons">
                                                                <div class="btn blue-btn small">
                                                                    Add
                                                                </div>
                                                                <div class="btn red-btn small" data-modal-dismiss>
                                                                    Cancel
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn blue-btn" data-toggle="modal" data-target="shipping_popup">Shipping</button>
                                        <div class="popup" id="shipping_popup">
                                            <div class="popup_main">
                                                <div class="popup_body">
                                                    <div class="popup_back"></div>
                                                    <div class="popup_contain">
                                                        <div class="popup_close" data-modal-dismiss>x</div>
                                                        <h2>
                                                            Shipping

                                                        </h2>
                                                        <label> customer will get its products from Main Branch</label>
                                                        <div class=fields>
                                                            <div class="two-fields">


                                                                <div class="field ">
                                                                    <label>
                                                                        Converted Ingots
                                                                    </label>


                                                                    <select name="" id="shipping_ingots" class=" form-control  shipping_ingots ">
                                                                        <option value=""> choose</option>

                                                                        @foreach($virtualBalanceGold as $virtual)

                                                                        <option data-id="{{$virtual->id}}" value="{{$virtual->unite_weight *  $virtual->amount}}">{{$virtual->unite_weight *  $virtual->amount}} gram BTC Gold 24k</option>

                                                                        @endforeach
                                                                        @foreach($shopingcartproducts as $shopingcartproduct)
                                                                        @if($shopingcartproduct->type =="Sell"  )
                                                                        @foreach($shopingcartproduct->Orderdetails as $card)
                                                                                @if($card->purchased ==0  )

                                                              <option data-id="{{$card->id}}" value="{{$card->product_weight * $card->qty }}"> {{$card->product_weight * $card->qty }} gram BTC Gold 24k</option>

                                                                                @endif
                                                                        @endforeach
                                                                        @endif
                                                                        @endforeach

                                                                    </select>
                                                                    <span>

                                                                    </span>

                                                                </div>
                                                                <div class="field readonly">
                                                                    <label>
                                                                        shipping cost
                                                                    </label>
                                                                    <input type="text" id="shipping_cost" name="" class="input" value="{{$shippingcost}}" readonly>
                                                                    <span>
                                                                        EGP
                                                                    </span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="popup-footer">
                                                            <button onclick='saveshippingcost()' class="btn blue-btn">Redeem</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>










                                        <span>
                                        @lang('site.Additionalfeesapplied')
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="balance">
                                <div class="wallet-content">
                                    <h4>
                                        Add money to wallet
                                    </h4>
                                    <div class="fields">
                                        <div class="two-fields">
                                            <div class="field">
                                                <label for="">
                                                    Amount
                                                </label>
                                                <input class="input input-custom " type="text" name="waletamout" id="waletamout" value="{{round($wallet, 2)}}">
                                                <span>
                                                    EGP
                                                </span>
                                            </div>
                                            <div class="field">
                                                <label for="">
                                                    Currency
                                                </label>
                                                <input class="input input-custom " type="text" name="" id="" value="EGP" readonly>
                                            </div>
                                        </div>
                                        <!--  <div class="field list">
                                                    <label for="">
                                                        Select current card
                                                    </label>
                                                    <select class="dropdown" name="" id="">
                                                        <option value="">
                                                            2134 **** **** 1124
                                                        </option>
                                                    </select>
                                                    <button class="btn blue-btn" data-toggle="modal" data-target="addcard5_popup">Add New Card</button>
                                                </div>
                                                <div class="field">
                                                    <label for="">
                                                        Iban
                                                    </label>
                                                    <span class="sub-label">
                                                        Required
                                                    </span>
                                                    <input class="input input-custom " type="text" name="" id="walletIban" placeholder="Write Your iban">
                                                </div>-->
                                    </div>
                                </div>
                                <div class="total-balance">
                                    <h4>
                                    @lang('site.TotalBalance')
                                    </h4>
                                    <div class="balance-details">
                                        <h2>
                                            {{ round($wallet, 2)}} EGP
                                        </h2>
                                        <button class="open_popup btn blue-btn" data-toggle="modal" data-target="Withdrow_popup">Withdrow</button>
                                        <div class="popup" id="Withdrow_popup">
                                            <div class="popup_main">
                                                <div class="popup_body">
                                                    <div class="popup_back"></div>
                                                    <div class="popup_contain">
                                                        <div class="popup_close" data-modal-dismiss>x</div>
                                                        <h2>
                                                            WithDrow Money
                                                        </h2>
                                                        <span id='error3'></span>
                                                        <div class=fields>
                                                            <div class="two-fields">



                                                                <div class="field ">
                                                                    <label>
                                                                        Bank Name
                                                                    </label>
                                                                    <select onchange="getwithdrwiban()" id="bank_name" name="bank_name" class=" form-control input ">
                                                                        <option value="">Choose</option>
                                                                        @foreach ($ibans as $iban)
                                                                        <option data-id="{{$iban->id}}" value="{{ $iban->bank_name }}">{{ $iban->bank_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="field ">
                                                                    <label>
                                                                        Iban
                                                                    </label>



                                                                    <input readonly type="text" id="Iban_name" name="Iban_name" class="input" value="">
                                                                </div>
                                                                <div class="field ">
                                                                    <label>
                                                                        withdrow amount
                                                                    </label>
                                                                    <input onchange="checkwithdrowamount()" type="text" id="withdrowamount" name="withdrowamount" class="input" value="">
                                                                    <span>
                                                                        EGP
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <!--<div class="field list">
                                                                        <label for="">
                                                                            Select current card
                                                                        </label>
                                                                        <select class="dropdown" name="" id="">
                                                                            <option value="">
                                                                                2134 **** **** 1124
                                                                            </option>
                                                                        </select>
                                                                        <div class="addcard">
                                                                            <button class="btn blue-btn" data-toggle="modal" data-target="addcard6_popup">Add New
                                                                                Card</button>
                                                                        </div>
                                                                    </div>-->
                                                        </div>
                                                        <div class="popup-footer">
                                                            <button onclick='withdrowwalletmoney()' class="btn blue-btn">Redeem</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="open_popup btn blue-btn" data-toggle="modal" data-target="Addmoney_popup">Add Money</button>

                                        <div class="popup" id="Addmoney_popup">
                                            <div class="popup_main">
                                                <div class="popup_body">
                                                    <div class="popup_back"></div>
                                                    <div class="popup_contain">
                                                        <div class="popup_close" data-modal-dismiss>x</div>
                                                        <h2>
                                                            Add Money
                                                        </h2>
                                                        <span id='error5'></span>
                                                        <div class=fields>
                                                            <div class="two-fields">
                                                                <div class="field ">
                                                                    <label>
                                                                        Fakka Bank Name
                                                                    </label>
                                                                    <select onchange="getaddiban()" id="bank_name2" name="bank_name2" class=" form-control input ">
                                                                        <option value="">Choose</option>
                                                                        @foreach($banks as $bank)
                                                                        <option data-id="{{$bank->id}}" value="{{$bank->bank_name}}">{{$bank->bank_name}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="field ">
                                                                    <label>
                                                                        Fakka Iban
                                                                    </label>

                                                                    <input type="text" readonly id="Iban_name2" name="Iban_name2" class="input" value="">
                                                                </div>
                                                            </div>
                                                            <div class="two-fields">

                                                                <div class="field ">
                                                                    <label>
                                                                        amount
                                                                    </label>
                                                                    <input type="text" id="addamount" name="addamount" class="input" value="">
                                                                    <span>
                                                                        EGP
                                                                    </span>
                                                                </div>
                                                                <div class="field ">
                                                                    <label>
                                                                        transaction number
                                                                    </label>
                                                                    <input type="text" id="transaction_number" name="transaction_number" class="input" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="popup-footer">
                                                            <button onclick='savewalletmoney()' class="btn blue-btn">Redeem</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>









                                        <span>
                                        @lang('site.Additionalfeesapplied')
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="balance">
                                <div class="points">
                                    <h4>
                                        Redeem your point
                                    </h4>
                                    <div class="gifts">
                                        <div class="grid-container">
                                            @foreach($gifts as $gift)
                                            <div class="grid-item">

                                                <figure>
                                                    <img src="{{ asset('uploads/gifts/' . $gift->gift_image) }} " alt="">
                                                </figure>

                                                <div class="details">
                                                    <h4>
                                                        {{ $gift->gift_name}}
                                                    </h4>
                                                    <span>
                                                        {{ $gift->gift_points}} Points
                                                    </span>
                                                    <button onclick="redeemgift('{{ $gift->id}}' )" class="btn blue-btn">
                                                        Redeem
                                                    </button>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>


                                <div class="total-balance">
                                    <h4>
                                    @lang('site.TotalBalance')
                                    </h4>
                                    <div class="balance-details">
                                        @if($total_point < $point_dedicated) <span class="note" style="color: #EF0E2C; font-size: 20px; font-weight: 600;">
                                            Points Remaning is {{ $total_point }} less than monthly dedaction points
                                            </span>
                                            <h2>
                                                @endif
                                                {{$total_point}} Points
                                            </h2>
                                            <button class="btn blue-btn" data-toggle="modal" data-target="redeem_money3_popup">Redeem Money</button>
                                            <div class="popup" id="redeem_money3_popup">
                                                <div class="popup_main">
                                                    <div class="popup_body">
                                                        <div class="popup_back"></div>
                                                        <div class="popup_contain">
                                                            <div class="popup_close" data-modal-dismiss>x</div>
                                                            <h2>
                                                                Redeem Points

                                                            </h2>

                                                            <div class=fields>
                                                                <div class="two-fields">


                                                                    <div class="field ">
                                                                        <label>
                                                                            Points
                                                                        </label>

                                                                        <select onchange="getpricepoint(this.value)" name="" id="pointsselect" class=" form-control  shipping_ingots ">
                                                                            <option value=""> choose</option>

                                                                            @foreach($points as $point)

                                                                            <option data-id="{{$point->id}}" value="{{$point->points}}">{{$point->points}} Point</option>

                                                                            @endforeach

                                                                        </select>
                                                                        <span>

                                                                        </span>

                                                                    </div>
                                                                    <div class="field readonly">
                                                                        <label>
                                                                            points cost
                                                                        </label>
                                                                        <input type="text" id="points_added" name="" class="input" value="" readonly>
                                                                        <input type="text" id="pointvalue" name="" class="input" value="{{$point_added}}">
                                                                        <span>
                                                                            EGP
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="popup-footer">
                                                                <button onclick='redeempoints()' class="btn blue-btn">Redeem</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="popup" id="money3_popup">
                                                <div class="popup_main">
                                                    <div class="popup_body">
                                                        <div class="popup_back">
                                                            <div class="popup_contain alert-popup">
                                                                <h2>
                                                                    Alert
                                                                </h2>
                                                                <p>
                                                                    This action is prohibited, Please contact customer services </p>
                                                                <div class="btn blue-btn small" data-modal-dismiss>
                                                                    Ok</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="popup" id="addcard7_popup">
                                                <div class="popup_main">
                                                    <div class="popup_body">
                                                        <div class="popup_back">
                                                            <div class="popup_contain addcard-popup">
                                                                <h2>
                                                                    Add new card
                                                                </h2>
                                                                <div class="two-fields">
                                                                    <div class="field">
                                                                        <label for="">
                                                                            Name On Card
                                                                        </label>
                                                                        <span class="sub-label">
                                                                            Required
                                                                        </span>
                                                                        <input class="input input-custom " type="text" placeholder=" Eg, Mansour ali ">
                                                                    </div>
                                                                    <div class="field ">
                                                                        <label for=" ">
                                                                            Card Number
                                                                        </label>
                                                                        <span class="sub-label ">
                                                                            Required
                                                                        </span>
                                                                        <input class="input input-custom" type="number " placeholder="**** **** **** **** ">
                                                                    </div>
                                                                </div>
                                                                <div class="three-fields">
                                                                    <div class="date">
                                                                        <label for="">
                                                                            Expiration date
                                                                        </label>
                                                                        <div class="field">
                                                                            <input class="input input-custom small-field" type="number" placeholder="DD">
                                                                        </div>
                                                                        <div class="field">
                                                                            <input class="input input-custom small-field" type="number" placeholder="MM">
                                                                        </div>
                                                                        <div class="field">
                                                                            <input class="input input-custom big-field" type="number" placeholder="YYYY">
                                                                            <span class="sub-label">
                                                                                Required
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="buttons">
                                                                    <div class="btn blue-btn small">
                                                                        Add
                                                                    </div>
                                                                    <div class="btn red-btn small" data-modal-dismiss>
                                                                        Cancel
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span>
                                            @lang('site.Additionalfeesapplied')
                                            </span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="Tab3" class="tabcontent">
        <div class="details">
            @if(!empty($virtualpaymenthistory) || !empty($virtualBalanceGold) || !empty( $all_wallets) )
           <div class="table-container">
           <table>
                <tr class="has-background">
                    <th>Date</th>

                    <th>Product</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Receipt no.</th>
                    <th>Certificate no.</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                @foreach($virtualpaymenthistory as $row)
                <tr>

                    <td>{{$row->created_at}}</td>
                    <td id="primaryColor">{{$row->quantity}} gram BTC Gold 24k</td>
                    <td>Virtual Balance</td>
                    <td> @if($row->status == 0 && $row->deleted == 0) {{"pending"}} @elseif($row->deleted == 1 ) {{"canceled"}} @else {{"ordered"}} @endif </td>
                    <td>{{$row->recet_no}}</td>
                    <td>{{$row->certificate_no}}</td>
                    <td id="primaryColor" class="has-background">{{$row->price}} EGP</td>
                    <td class="action">
                        <figure>

                            <a target="_blank" href="{{ route('fakka.certifcates',$row->id) }}"> <img src=" {{ asset('web_files/images/view.svg') }} " alt=""></a>

                        </figure>
                        <figure>
                            <a target="_blank" href="{{ route('fakka.printcertifcates',$row->id) }}"> <img src=" {{ asset('web_files/images/printer.svg') }} " alt=""></a>
                        </figure>
                    </td>
                </tr>

                @endforeach
                @foreach($virtualBalanceGold as $row)
                <tr>

                    <td>{{$row->created_at}}</td>
                    <td id="primaryColor">{{$row->unite_weight * $row->amount }} gram BTC Gold 24k</td>
                    <td>Virtual Gold </td>
                    <td> {{"ordered"}} </td>
                    <td>{{$row->recet_no}}</td>
                    <td>{{$row->certificate_no}}</td>
                    <td id="primaryColor" class="has-background">{{$row->price}} EGP</td>
                    <td class="action">
                        <figure>

                            <a target="_blank" href="{{ route('fakka.physical_certifcates',$row->id) }}"> <img src=" {{ asset('web_files/images/view.svg') }} " alt=""></a>

                        </figure>
                        <figure>

                            <a target="_blank" href="{{ route('fakka.physical_printcertifcates',$row->id) }}"> <img src=" {{ asset('web_files/images/printer.svg') }} " alt=""></a>
                        </figure>
                    </td>
                </tr>

                @endforeach
                <!--///////////////wallets transfer /////////////-->
                @foreach($all_wallets as $row)
                <tr>
                    <td>{{$row->created_at}}</td>
                    <td id="primaryColor"></td>
                    <td>wallets Transfere </td>
                    <td> @if($row->status == 0 && $row->deleted == 0) {{"pending"}} @elseif($row->deleted == 1 ) {{"canceled"}} @else {{"ordered"}} @endif </td>
                    <td>{{$row->transaction_number}}</td>
                    <td></td>
                    <td id="primaryColor" class="has-background">{{$row->amount}} EGP</td>
                    <td class="action">
                        <figure>

                            <img style="background-color:rosybrown" src=" {{ asset('web_files/images/view.svg') }} " alt="">

                        </figure>
                        <figure>
                            <img style="background-color:rosybrown" src=" {{ asset('web_files/images/printer.svg') }} " alt="">
                        </figure>
                    </td>
                </tr>
                @endforeach



                <!--///////////////shopping cart /////////////-->
                @foreach($shopping_carts as $row)
                     @foreach($row->Orderdetails as $details)
                <tr>
                    <td>{{$row->order_date}}</td>
                    <td id="primaryColor"> {{$row->totalQty .'  gram '. $details->product_name}} </td>
                    <td>shopping carts</td>
                    <td> @if($row->status == 0 ) {{"pending"}} @elseif($row->status == 1  ) {{"ordered"}} @else {{"Rejected"}} @endif </td>
                    <td>{{$row->id}}</td>
                    <td></td>
                    <td id="primaryColor" class="has-background">{{$row->totalpayments}} EGP</td>
                    <td class="action">
                        <figure>
                            <img style="background-color:rosybrown" src=" {{ asset('web_files/images/view.svg') }} " alt="">

                        </figure>
                        <figure>
                            <img style="background-color:rosybrown" src=" {{ asset('web_files/images/printer.svg') }} " alt="">
                        </figure>
                    </td>
                </tr>
                     @endforeach
                @endforeach

            </table>
           </div>
            @else
            there is no history avaliable
            @endif

        </div>
    </div>
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

<div class="popup" id="addcard5_popup">
    <div class="popup_main">
        <div class="popup_body">
            <div class="popup_back">
                <div class="popup_contain addcard-popup">
                    <h2>
                        Add new card
                    </h2>
                    <div class="two-fields">
                        <div class="field">
                            <label for="">
                                Name On Card
                            </label>
                            <span class="sub-label">
                                Required
                            </span>
                            <input class="input input-custom " type="text" placeholder=" Eg, Mansour ali ">
                        </div>
                        <div class="field ">
                            <label for=" ">
                                Card Number
                            </label>
                            <span class="sub-label ">
                                Required
                            </span>
                            <input class="input input-custom " type="number " placeholder="**** **** **** **** ">
                        </div>
                    </div>
                    <div class="three-fields">
                        <div class="date">
                            <label for="">
                                Expiration date
                            </label>
                            <div class="field">
                                <input class="input input-custom small-field" type="number" placeholder="DD">
                            </div>
                            <div class="field">
                                <input class="input input-custom small-field" type="number" placeholder="MM">
                            </div>
                            <div class="field">
                                <input class="input input-custom big-field" type="number" placeholder="YYYY">
                                <span class="sub-label">
                                    Required
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="btn blue-btn small" data-modal-dismiss>
                        Add</div>

                </div>
            </div>
        </div>
    </div>
</div>










<div class="popup" id="viewcertificate">
    <div class="popup_main">
        <div class="popup_body">
            <div class="popup_back">
                <div class="popup_contain addcard-popup">
                    <h2>
                        View Certificates

                    </h2>

                    <div class="certifcates" id="certifcates">

                    </div>

                    <main>
                        <div class="products-details">
                            <div class="container">
                                <div>
                                    <div class="details">
                                        <div class="item">
                                            <figure>
                                                <img src=" {{ asset('web_files/images/certification.png') }} " alt="">
                                            </figure>
                                            <div class="certification-info">
                                                <div class="certification-head">
                                                    <label>
                                                        Certificate No. 168451855
                                                    </label>
                                                    <input class="input" type="text" value="50 grams gold 24K" readonly>
                                                </div>
                                                <div class="certification-body">
                                                    <div class="grid-container">
                                                        <div class="grid-item">
                                                            <label>
                                                                Customer Name
                                                            </label>
                                                            <input type="text" class="input" value="Mohamed Ali" readonly>
                                                        </div>
                                                        <div class="grid-item">
                                                            <label>
                                                                Customer ID
                                                            </label>
                                                            <input type="number" class="input" value="21354351" readonly>
                                                        </div>
                                                        <div class="grid-item">
                                                            <label>
                                                                Issuing date
                                                            </label>
                                                            <input type="text" class="input" value="Oct 24, 2020" readonly>
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
                                        <div class="right-side">
                                            <div>
                                                <h3>
                                                    Details
                                                </h3>
                                                <div class="certification">
                                                    <figure>
                                                        <img src="{{ asset('web_files/images/item.png') }} " alt="">
                                                    </figure>
                                                    <div class="item-info">
                                                        <h4>
                                                            10 gram BTC Gold 24k
                                                        </h4>
                                                        <span>
                                                            9000 EGP
                                                        </span>

                                                    </div>
                                                </div>
                                                <div class="buttons">
                                                    <button class="btn outline-btn download">
                                                        <figure>
                                                            <img src="{{ asset('web_files/images/download.svg') }} " alt="">
                                                        </figure>
                                                        Download
                                                    </button>
                                                    <button class="btn outline-btn print">
                                                        <figure>
                                                            <img src="{{ asset('web_files/images/printer.svg') }} " alt="">
                                                        </figure>
                                                        Print
                                                    </button>

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
                                <a href="">
                                @lang('site.Contactus') 
                                </a>
                            </div>
                        </div>
                    </main>

                    <div style="margin-left:10px" class="btn red-btn small" data-modal-dismiss>
                        cancel</div>
                </div>
            </div>
        </div>
    </div>
</div>
















<script>
    function update_address(id) {
        //alert(id);
        var url = '{{URL::to("/update_address")}}' + "/" + id;

        var address = $('#address').val();

        data = {
            id: id,
            address: address,
            _token: "{{csrf_token()}}",
        };
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'html',
            data: data,
            success: function(response) {
                // alert(response);
                if (response == "updated") {
                    swal("Address is Updated!", "Address is Updated!", "success");
                } else {
                    swal("Error!", "Error to Update Address!", "error");
                }

            },
            error: function(response) {
                alert(response);
                if (response == "updated") {
                    swal("Address is Updated!", "Address is Updated!", "success");
                } else {
                    swal("Error!", "Error to Update Address!", "error");
                }
            }
        });
    }


    function delete_image(id) {
        var image = $('#image').val();
        var url = '{{URL::to("/delete_image")}}' + "/" + id;
        data = {
            id: id,
            _token: "{{csrf_token()}}",
        };
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'html',
            data: data,

            success: function(response) {

                if (response == "updated") {
                    swal("image is deletet!", "image is deletet!", "success");
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 2000);
                } else {
                    swal("Error!", "Error to image image!", "error");
                }

            },
            error: function(response) {

                if (response == "updated") {

                    swal("image is deletet!", "image is deletet!", "success");
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 2000);
                } else {
                    swal("Error!", "Error to deletet image!", "error");
                }
            }
        });
    }






    function openTabs(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    document.getElementById("defaultOpen").click();

    function myFunction() {
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    // $('.select_customsss').selectpicker();

    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        //   var data = google.visualization.arrayToDataTable(analytics);
        var analytics = <?php echo $total_virtual; ?>;
        var total_percent = 100 - analytics;
        var data = new google.visualization.arrayToDataTable([
            ['Opening Move', 'Percentage', {
                role: "style"
            }],

            ["total", total_percent, "silver"],
            ["Percentage", analytics, "gold"],


        ]);
        var options = {
            fontSize: 15,

            title: '',
            backgroundColor: '',
            width: "260",
            is3D: true,
            colors: ['#0043A4', '#7EB3FF', 'red', '#f5fffa'],
            chartArea: {
                left: "15%",
                top: "18%",
                height: "100%",
                width: "100%"
            },



        };
        var chart = new google.visualization.PieChart(document.getElementById('pie-chart'));
        chart.draw(data, options);
    }
</script>


<script>
    function check_quantity(id) {
        var total_gram = $('#total_gram').val();
        var amount = $('#amountw').val();
        var pricess = $('#pricess').val();
        var quantity = $('#quantity').val();

        $('#amountw').val(0);
        document.getElementById('error').innerHTML = '';
        document.getElementById('fees').innerHTML = '';
        if (quantity > parseFloat(total_gram)) {
            //swal('your  virtual weight is not enough!');
            $('#quantity').val(0);
            $('#amountw').val(0);
            document.getElementById('error').innerHTML = 'your  virtual weight is not enough!';
            document.getElementById('error').style.backgroundColor = "#aa0000";
            document.getElementById('error').style.color = "#ffffff";
        }
        if (parseFloat(total_gram) >= quantity) {
            if (amount > parseFloat(total_gram)) {
                $('#amountw').val(0);
                document.getElementById('error').innerHTML = 'your  virtual weight is not enough!';
                document.getElementById('error').style.backgroundColor = "#aa0000";
                document.getElementById('error').style.color = "#ffffff";
            }

            // $('#amountw').val(id * pricess);

        }
    }

    function checkamount() {
        var total_gram = $('#total_gram').val();
        var amount = $('#amountw').val();
        var pricess = $('#pricess').val();
        var quantity = $('#quantity').val();

        if (quantity != 0) {
            document.getElementById('error').innerHTML = '';
            if (isNaN(amount)) {
                $('#amountw').val(0);
            } else {

                if ((amount * quantity) > parseFloat(total_gram)) {
                    $('#amountw').val(0);
                    document.getElementById('fees').innerHTML = '';
                    document.getElementById('error').innerHTML = 'your  virtual weight is not enough!';
                    document.getElementById('error').style.backgroundColor = "#aa0000";
                    document.getElementById('error').style.color = "#ffffff";
                } else {
                    var fees = document.getElementById('fees');
                    if (quantity == 10) {

                        document.getElementById('fees').innerHTML = 50 * quantity * amount;
                        fees.style.backgroundColor = "#00f5a5";
                    }
                    if (quantity == 20 || quantity == 31.5) {
                        document.getElementById('fees').innerHTML = 45 * quantity * amount;
                        fees.style.backgroundColor = "#00f5a5";
                    }
                    if (quantity == 100 || quantity == 50) {
                        document.getElementById('fees').innerHTML = 37 * quantity * amount;
                        fees.style.backgroundColor = "#00f5a5";
                    }
                }
            }
        } else {
            document.getElementById('error').innerHTML = 'please choose Unite Weight';
            $('#amountw').val(0);
            document.getElementById('error').style.backgroundColor = "#aa0000";
            document.getElementById('error').style.color = "#ffffff";
        }


    }

    function saveredeemgold() {
        var url = '{{URL::to("/saveredeemgold")}}';
        var amount = $('#amountw').val();
        var quantity = $('#quantity').val();
        var total_gram = $('#total_gram').val();

        var cachbacks = [];

        var selected = $('#quantity').find('option:selected', this);
        selected.each(function() {
            cachbacks.push($(this).data('id'));
        });

        if (amount != 0) {

            data = {
                amount: amount,
                quantity: quantity,
                total_gram: total_gram,
                cachbacks: cachbacks,
                _token: "{{csrf_token()}}",
            };
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'html',
                data: data,
                success: function(response) {
                    //swal("Gold Is Redeemed !", "Gold Is Redeemed!", "success");
                    if (response == "inserted") {
                        $('#redeem_gold_popup').hide();

                        //  alert(' this gold will be converted to cash 1st then the needed physical gold will be purchased (with indication of the fees that will be deducted from wallet)');
                        swal("this gold will be converted to cash 1st then the needed physical gold will be purchased (with indication of the fees that will be deducted from wallet!", "", "success");
                        // location.reload();

                        setTimeout(function() {
                            window.location.reload(1);
                        }, 2000);


                    }

                    if (response == "false") {

                        alert('your  virtual weight is not enough !  ')
                        $('#amountw').val(0);
                    }

                }
            });
        } else {
            alert('please write Amount');
            return;
        }
    }

    function save_iban() {
        var iban_number = $('#iban_number').val();
        var clientbank = $('#clientbank').val();
        var url = '{{URL::to("/savereclientiban")}}';
        if (iban_number != '') {
            data = {
                iban_number: iban_number,
                clientbank: clientbank,
                _token: "{{csrf_token()}}",
            };
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'html',
                data: data,
                success: function(response) {

                    if (response == "updated") {
                        swal("IBAN is Updated!", "IBAN is Updated!", "success");
                        setTimeout(function() {
                            window.location.reload(1);
                        }, 2000);

                    } else {
                        swal("Error!", "Error to Update IBAN!", "error");
                    }

                },
                error: function(response) {

                    if (response == "updated") {

                        swal("IBAN is Updated!", "IBAN is Updated!", "success");
                        setTimeout(function() {
                            window.location.reload(1);
                        }, 2000);
                    } else {
                        swal("Error!", "Error to Update IBAN!", "error");
                    }
                }
            });
        } else {
            alert('please write iban')
        }
    }
    /*   function getEqual(){
           var total_gram=  $('#total_gram').val();
           var equal2=$('#equal2').val();
           var pricess =$('#pricess').val();
           if(equal2 >  parseFloat(total_gram)){
               $('#Equals').val(0);
               alert('your  virtual weight is not enough!');
           }else{
               $('#Equals').val(pricess * equal2 );
           }
       }*/


    function getEqual() {
        var url = '{{URL::to("/checkamountredeemgold")}}';
        var total_gram = $('#total_gram').val();
        var equal2 = $('#equal2').val();
        var pricess = $('#pricess').val();


        data = {

            equal2: equal2,
            total_gram: total_gram,

            _token: "{{csrf_token()}}",
        };
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'html',
            data: data,
            success: function(response) {
                if (response == "false") {
                    document.getElementById('error2').innerHTML = 'your  virtual weight is not enough Or  some of Virtual Gold not passed 48 hours! ';
                    document.getElementById('error2').style.backgroundColor = "#aa0000";
                    document.getElementById('error2').style.color = "#ffffff";
                    $('#equal2').val(0);
                    $('#Equals').val(0);
                }



                if (response == "true") {
                    $('#Equals').val(pricess * equal2);
                    document.getElementById('error2').innerHTML = ' ';
                    document.getElementById('error2').style.backgroundColor = "";
                    document.getElementById('error2').style.color = "";
                }

            }
        });
    }


    function saveredeemmoney() {
        getEqual();
        var url = '{{URL::to("/saveredeemmoney")}}';
        var amount = $('#equal2').val();
        var equal = $('#Equals').val();
        var iban = $('#money_iban').val();
        var total_gram = $('#total_gram').val();

        data = {
            amount: amount,
            equal: equal,
            iban: iban,
            total_gram: total_gram,

            _token: "{{csrf_token()}}",
        };
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'html',
            data: data,
            success: function(response) {

                $('#redeem_money_popup').hide();
                swal("process is completed!", "your The operation is completed and money added to your wallet with Discount .005 per gram!", "success");
                setTimeout(function() {
                    window.location.reload(1);
                }, 2000);
            }
        });
    }
</script>


<script>
    function openpassword() {
        $('#conf_passinput').show();
        $('#openpass').hide();
        $('#confpassdiv').show();
    }


    function conf_password() {
        var url = '{{URL::to("/confirmpass")}}';
        var password = $('#passwords').val();

        if (password != "") {
            document.getElementById('error4').innerHTML = '';
            document.getElementById('error4').style.backgroundColor = "";
            document.getElementById('error4').style.color = "";
            data = {
                password: password,
                _token: "{{csrf_token()}}",
            };
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'html',
                data: data,
                success: function(response) {
                    if (response == 'true') {
                        document.getElementById('error4').innerHTML = '';
                        document.getElementById('error4').style.backgroundColor = "";
                        document.getElementById('error4').style.color = "";
                        checkwaletredeme();
                        $('#confpassdiv').hide();
                        $('#conf_passinput').hide();
                        $('#wallletredeme').show();
                    }
                    if (response == 'false') {
                        //  alert('password is wrong ');

                        document.getElementById('error4').innerHTML = 'password is wrong! ';
                        document.getElementById('error4').style.backgroundColor = "#aa0000";
                        document.getElementById('error4').style.color = "#ffffff";
                    }
                }
            });
        } else {
            // alert('please write Your Password');

            document.getElementById('error4').innerHTML = 'please write Your Password';
            document.getElementById('error4').style.backgroundColor = "#aa0000";
            document.getElementById('error4').style.color = "#ffffff";
        }
    }

    function checkwaletredeme() {

        var url = '{{URL::to("/checkwaletredeme")}}';
        var amount = $('#amountw').val();
        var quantity = $('#quantity').val();
        if (amount != 0) {
            document.getElementById('error4').innerHTML = ' ';
            document.getElementById('error4').style.backgroundColor = "";
            document.getElementById('error4').style.color = "";
            data = {
                amount: amount,
                quantity,
                quantity,
                _token: "{{csrf_token()}}",
            };
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'html',
                data: data,
                success: function(response) {
                    if (response == 'true') {
                        saveredeemgold();
                        $('#confpassdiv').hide();
                        $('#wallletredeme').hide();
                        $('#opensave').show();
                        document.getElementById('error4').innerHTML = ' ';
                        document.getElementById('error4').style.backgroundColor = "";
                        document.getElementById('error4').style.color = "";

                    }
                    if (response == 'false') {
                        //   alert('money is not enough in wallet ');

                        document.getElementById('error4').innerHTML = 'money is not enough in wallet! ';
                        document.getElementById('error4').style.backgroundColor = "#aa0000";
                        document.getElementById('error4').style.color = "#ffffff";
                    }
                }
            });
        } else {
            // alert('please write Your amount');
            document.getElementById('error4').innerHTML = 'please write Your amount! ';
            document.getElementById('error4').style.backgroundColor = "#aa0000";
            document.getElementById('error4').style.color = "#ffffff";
        }

    }

    /////////// start multi select///
    /*  $(document).ready(function(){
          var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
          removeItemButton: true,

          });


          });*/
    /////////////////end multi select//////////////


    function getphysicalredeemmoney() {
        var pricess = $('#pricess').val();

        var multivalues = [];

        var totalprice2 = 0;
        var multislsect = $("#select-multiple").val();

         console.log(multislsect);
         console.log(pricess);
        if (multislsect != null) {
            if (multislsect.length > 1) {

                var totalprice = 0;
                for (var i = 0; i < multislsect.length; i++) {

                    totalprice += multislsect[i] * pricess;


                }

                $('#physicalredeemmoney').val(totalprice);
            } else {
                $('#physicalredeemmoney').val(multislsect * pricess);
            }
        } else {
            $('#physicalredeemmoney').val(0);
        }
    }

    function savephysicalredeemmoney() {
        var url = '{{URL::to("/savephysicalredeemmoney")}}';
        var multislsect = $("#select-multiple").val();

        var physicalredeemmoney = $("#physicalredeemmoney").val();
        var results = [];
        var resultshopping = [];

        var shopingproductid = [];

        var virtualcashs = [];
        var selected = $('#select-multiple').find('option:selected', this);

        selected.each(function() {
            results.push($(this).data('id'));
        });



        selected.each(function() {
            resultshopping.push($(this).data('idshoping'));
        });

        selected.each(function() {
            shopingproductid.push($(this).data('shopingproductid'));
        });
        selected.each(function() {
            virtualcashs.push($(this).data('virtualcashs'));
        });



        data = {
            physicalredeemmoney: physicalredeemmoney,
            results: results,
            multislsect: multislsect,
            resultshopping: resultshopping,
            shopingproductid: shopingproductid,
            virtualcashs: virtualcashs,

            _token: "{{csrf_token()}}",
        };
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'html',
            data: data,
            success: function(response) {
               $('#redeem_money2_popup').hide();
                swal("process is completed!", "process is completed and mail sent to your inbox!", "success");
                setTimeout(function() {
                    window.location.reload(1);
                }, 2000);
            }
        });
    }
</script>




<script>
    function delete_iban(id) {

        var url = '{{URL::to("/delete_iban")}}' + "/" + id;
        data = {
            id: id,
            _token: "{{csrf_token()}}",
        };
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'html',
            data: data,
            success: function(response) {
                if (response == "updated") {
                    swal("Iban is deletet!", "Iban is deletet!", "success");
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 2000);
                } else {
                    swal("Error!", "Error to Iban !", "error");
                }
            },
            error: function(response) {
                if (response == "updated") {
                    swal("Iban is deletet!", "Iban is deletet!", "success");
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 2000);
                } else {
                    swal("Error!", "Error to deletet Iban!", "error");
                }
            }
        });
    }

    function savewalletmoney() {
        var bank_name = $('#bank_name2').val();
        var iban = $('#Iban_name2').val();
        var amount = $('#addamount').val();
        var transaction_number = $('#transaction_number').val();

        var bank_nameid = document.getElementById("bank_name2");
        var ibanid = document.getElementById("Iban_name2");
        var amountid = document.getElementById("addamount");
        var transaction_numberid = document.getElementById("transaction_number");
        var url = '{{URL::to("/savewalletmoney")}}';

        if (bank_name != '' && iban != '' && amount != '' && transaction_number != '') {
            document.getElementById('error5').innerHTML = ' ';
            document.getElementById('error5').style.backgroundColor = "";
            document.getElementById('error5').style.color = "";
            data = {
                bank_name: bank_name,
                iban: iban,
                amount: amount,
                transaction_number: transaction_number,
                _token: "{{csrf_token()}}",
            };
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'html',
                data: data,
                success: function(response) {
                    if (response == "inserted") {

                        $('#Addmoney_popup').hide();

                        swal("Witting for Admin ,confirmation and mail sent", "", "success");
                        setTimeout(function() {
                            window.location.reload(1);
                        }, 2000);


                    } else {
                        swal("Error!", "Error to transfer please check your bank !", "error");
                    }
                },
                error: function(response) {
                    if (response == "inserted") {
                        $('#Addmoney_popup').hide();
                        swal("Witting for Admin , confirmation and mail sent", "", "success");
                        setTimeout(function() {
                            window.location.reload(1);
                        }, 2000);
                    } else {
                        swal("Error!", "Error to transfer please check your bank !", "error");
                    }
                }
            });
        } else {
            if (bank_name == '') {

                bank_nameid.style.backgroundColor = "#BC0022";

            } else {
                bank_nameid.style.backgroundColor = "";
            }
            if (iban == '') {
                ibanid.style.backgroundColor = "#BC0022";
            } else {
                ibanid.style.backgroundColor = "";
            }
            if (amount == '') {
                amountid.style.backgroundColor = "#BC0022";
            } else {
                amountid.style.backgroundColor = "";
            }

            if (transaction_number == '') {
                transaction_numberid.style.backgroundColor = "#BC0022";
            } else {
                transaction_numberid.style.backgroundColor = "";
            }
            // alert('complete all of red boxs ');

            document.getElementById('error5').innerHTML = 'complete all of red boxs !';
            document.getElementById('error5').style.backgroundColor = "#aa0000";
            document.getElementById('error5').style.color = "#ffffff";
        }
    }










    function checkwithdrowamount() {
        var url = '{{URL::to("/checkwithdrowamount")}}';
        var withdrowamount = $('#withdrowamount').val();
        if (withdrowamount != 0) {
            data = {
                withdrowamount: withdrowamount,
                _token: "{{csrf_token()}}",
            };

            $.ajax({
                url: url,
                type: 'get',
                dataType: 'html',
                data: data,
                success: function(response) {
                    if (response == "false") {

                        document.getElementById('error3').innerHTML = 'your  Wallet Amount is not enough!';
                        document.getElementById('error3').style.backgroundColor = "#aa0000";
                        document.getElementById('error3').style.color = "#ffffff";
                        $('#withdrowamount').val(0);

                    }
                    if (response == "true") {
                        document.getElementById('error3').innerHTML = ' ';
                        document.getElementById('error3').style.backgroundColor = "";
                        document.getElementById('error3').style.color = "";
                    }

                }
            });
        } else {
            document.getElementById('error3').innerHTML = 'Write Amount More 0 !';
            document.getElementById('error3').style.backgroundColor = "#aa0000";
            document.getElementById('error3').style.color = "#ffffff";
        }
    }

    function withdrowwalletmoney() {
        checkwithdrowamount();
        var bank_name = $('#bank_name').val();
        var iban = $('#Iban_name').val();
        var amount = $('#withdrowamount').val();


        var bank_nameid = document.getElementById("bank_name");
        var ibanid = document.getElementById("Iban_name");
        var amountid = document.getElementById("withdrowamount");

        var url = '{{URL::to("/withdrowwalletmoney")}}';

        if (bank_name != '' && iban != '' && amount != '' && amount != 0) {
            data = {
                bank_name: bank_name,
                iban: iban,
                amount: amount,
                _token: "{{csrf_token()}}",
            };
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'html',
                data: data,
                success: function(response) {
                    if (response == "inserted") {

                        $('#Withdrow_popup').hide();

                        swal("Witting for Admin ,confirmation and mail sent", "", "success");
                        setTimeout(function() {
                            window.location.reload(1);
                        }, 2000);


                    } else {
                        swal("Error!", "Error to withdrow please check your bank !", "error");
                    }
                },
                error: function(response) {
                    if (response == "inserted") {
                        $('#Withdrow_popup').hide();
                        swal("Witting for Admin,  confirmation and mail sent", "", "success");
                        setTimeout(function() {
                            window.location.reload(1);
                        }, 2000);
                    } else {
                        swal("Error!", "Error to withdrow  please check your bank !", "error");
                    }
                }
            });
        } else {
            if (bank_name == '') {

                bank_nameid.style.backgroundColor = "#BC0022";

            } else {
                bank_nameid.style.backgroundColor = "";
            }
            if (iban == '') {
                ibanid.style.backgroundColor = "#BC0022";
            } else {
                ibanid.style.backgroundColor = "";
            }
            if (amount == '' || amount == 0) {
                amountid.style.backgroundColor = "#BC0022";
            } else {
                amountid.style.backgroundColor = "";
            }

            document.getElementById('error3').innerHTML = 'complete all of red boxs!';
            document.getElementById('error3').style.backgroundColor = "#aa0000";
            document.getElementById('error3').style.color = "#ffffff";
        }
    }


    function saveshippingcost() {

        var amount = $('#shipping_ingots').val();
        var shipping_cost = $('#shipping_cost').val();

        var shipping_costid = document.getElementById("shipping_cost");
        var amountid = document.getElementById("shipping_ingots");
        var url = '{{URL::to("/saveshippingcost")}}';


        var results = [];
        var selected = $('#shipping_ingots').find('option:selected', this);
        selected.each(function() {
            results.push($(this).data('id'));
        });

        console.log(results);
        if (shipping_cost != '' && amount != '') {
            data = {
                shipping_cost: shipping_cost,
                results: results,
                amount: amount,
                _token: "{{csrf_token()}}",
            };
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'html',
                data: data,
                success: function(response) {
                    if (response == "inserted") {

                        $('#shipping_popup').hide();

                        swal("Witting for Admin ,confirmation and mail sent", "", "success");
                        setTimeout(function() {
                            window.location.reload(1);
                        }, 2000);


                    } else {
                        swal("Error!", "Error to shipping please try again!", "error");
                    }
                },
                error: function(response) {
                    if (response == "inserted") {
                        $('#shipping_popup').hide();
                        swal("Witting for Admin,  confirmation and mail sent", "", "success");
                        setTimeout(function() {
                            window.location.reload(1);
                        }, 2000);
                    } else {
                        swal("Error!", "Error to shipping please try again!", "error");
                    }
                }
            });
        } else {
            if (shipping_cost == '') {

                shipping_costid.style.backgroundColor = "#BC0022";

            } else {
                shipping_costid.style.backgroundColor = "";
            }

            if (amount == '') {
                amountid.style.backgroundColor = "#BC0022";
            } else {
                amountid.style.backgroundColor = "";
            }

            alert('complete all of red boxs ');

        }
    }


    function viewcertificate(id) {


        $('#certifcates').html(id);
        /*   data = {
               id: id,
               _token: "{{csrf_token()}}",
           };
           $.ajax({
               url: '{{URL::to("fakka/postdate") }}',
               type: 'get',
               dataType: 'html',
               data: data,
               success: function(response) {
                   $('#products').html(response);
               },
               error: function(response) {
                  // alert(response);
               }
           });*/
    }





    function getaddiban() {
        var url = '{{URL::to("/getaddiban")}}';
        var results = [];
        var selected = $('#bank_name2').find('option:selected', this);
        selected.each(function() {
            results.push($(this).data('id'));
        });

        data = {
            results: results,
            _token: "{{csrf_token()}}",
        };
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'html',
            data: data,
            success: function(response) {

                if (response != "false") {
                    var JSONObject = JSON.parse(response);
                    $('#Iban_name2').val(JSONObject.iban);

                } else {
                    swal("Error!", "there is no iban for this bank!", "error");
                }


            }
        });
    }

    function getwithdrwiban() {
        var url = '{{URL::to("/getwithdrwiban")}}';
        var results = [];
        var selected = $('#bank_name').find('option:selected', this);
        selected.each(function() {
            results.push($(this).data('id'));
        });
        data = {
            results: results,
            _token: "{{csrf_token()}}",
        };
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'html',
            data: data,
            success: function(response) {

                if (response != "false") {
                    var JSONObject = JSON.parse(response);
                    $('#Iban_name').val(JSONObject.Iban_number);

                } else {
                    swal("Error!", "there is no iban for this bank!", "error");
                }


            }
        });
    }


    function getpricepoint(point) {


        var pointvalue = $('#pointvalue').val();
        var result = point * pointvalue;
        $('#points_added').val(result);
    }


    function redeempoints() {
        var url = '{{URL::to("/redeempoints")}}';
        var pointsselect = $('#pointsselect').val();
        var points_added = $('#points_added').val();
        var pointsselectid = document.getElementById("pointsselect");

        var results = [];
        var selected = $('#pointsselect').find('option:selected', this);
        selected.each(function() {
            results.push($(this).data('id'));
        });

        if (pointsselect != '') {

            pointsselectid.style.backgroundColor = "";
            data = {
                points_added: points_added,
                results: results,
                _token: "{{csrf_token()}}",
            };
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'html',
                data: data,
                success: function(response) {
                    $('#redeem_money3_popup').hide();
                    swal("money added to your wallet", "", "success");
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 2000);


                }
            });
        } else {
            pointsselectid.style.backgroundColor = "#BC0022";
        }

    }



    function redeemgift(id) {
        totalpoints = document.getElementById('poin').innerHTML;
        var url = '{{URL::to("/redeemgift")}}';
        if (totalpoints != 0) {
            data = {
                totalpoints: totalpoints,
                id: id,
                _token: "{{csrf_token()}}",
            };
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'html',
                data: data,
                success: function(response) {
                    if (response == "true") {
                        swal("Admin will contact to you with your gift", "", "success");
                        setTimeout(function() {
                            window.location.reload(1);
                        }, 2000);
                    }
                    if (response == "false") {
                        swal("your total point less than gift points", "", "success");

                    }

                }
            });
        } else {
            swal("you have no points", "", "success");
        }


    }

    function delete_selfeimage(id) {
       
        var url = '{{URL::to("/delete_selfeimage")}}' + "/" + id;
        data = {
            id: id,
            _token: "{{csrf_token()}}",
        };
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'html',
            data: data,

            success: function(response) {

                if (response == "updated") {
                    swal("Selfe Id image is deletet!", "Selfe Id image is deletet!", "success");
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 2000);
                } else {
                    swal("Error!", "Error to delete Selfe Id image!", "error");
                }

            },
            error: function(response) {

                if (response == "updated") {

                    swal("Selfe Id image is deletet!", "Selfe Id image is deletet!", "success");
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 2000);
                } else {
                    swal("Error!", "Error to deletet Selfe Id image!", "error");
                }
            }
        });
    }
    
</script>


<script>
function copylink() {
  var copyText = document.getElementById("refer_id");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
 // alert("Copied the text: " + copyText.value);
}
</script>




@endsection
<script src=" {{ asset('web_files/js/jquery-1.11.0.min.js') }}"></script>
<!--<script src=" {{ asset('web_files/js/gram-chart.js') }}"></script>-->
@push('scripts')