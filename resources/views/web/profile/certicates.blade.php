@extends('layouts.web.app')

@section('content')


<main>
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
                                        Certificate No. {{$virtualpaymenthistory->certificate_no}}
                                    </label>
                                    <input class="input" type="text" value=" {{$virtualpaymenthistory->quantity}}  grams gold 24K" readonly>
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
                                            <input type="text" class="input" value=" {{$virtualpaymenthistory->created_at}}" readonly>
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
                                        <img class="itemcert" src="{{ asset('web_files/images/item.png') }} " alt="">
                                    </figure>
                                    <div class="item-info">
                                        <h4>
                                          {{$virtualpaymenthistory->quantity}} gram BTC Gold 24k
                                        </h4>
                                        <span>
                                        {{$virtualpaymenthistory->price}} EGP
                                        </span>

                                    </div>
                                </div>
                                <div class="buttons">
                                    <a href="{{ route('fakka.downloadcertifcates',$virtualpaymenthistory->id) }}"  class="btn outline-btn download">
                                        <figure>
                                            <img src="{{ asset('web_files/images/download.svg') }} " alt="">
                                        </figure>
                                        Download</a>
                                    <a href="{{ route('fakka.printcertifcates',$virtualpaymenthistory->id) }}" target="_blank"  class="btn outline-btn print">
                                        <figure>
                                            <img src="{{ asset('web_files/images/printer.svg') }} " alt="">
                                        </figure>
                                        Print
                                    </a>

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
                        We will be happy
                    </h2>
                </div>
                <p>
                    To answer all your questions
                </p>
                <a href="">
                    Contact us
                </a>
            </div>
        </div>
    </main>


 
@endsection

@push('scripts')
