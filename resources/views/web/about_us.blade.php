@extends('layouts.web.app')

@section('content')


<main>
    <div class="about-us">
        <div class="cards reversed">
            <div class="card">
                <div class="container">
                    <div class="images-section">
                        @if(!empty($abouts->about_us_image))
                        <figure>
                            <img src="{{ asset('web_files/images/about-us.png') }}" alt="">
                        </figure>
                        @else
                        <figure>
                            <img src="{{ asset('web_files/images/about-us.png') }}" alt="">
                        </figure>
                        @endif
                    </div>
                    <div class="details">
                        <div class="title">
                            <h2>
                                @lang('site.aboutus')
                            </h2>
                        </div>
                        <p>
                            @if(!empty($abouts))
                            {{$abouts->about_us}}
                            about us
                            @else
                            @lang('site.abouttex')
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="card has-background">
                <div class="container">
                    <div class="details">
                        <div class="title">
                            <h2>
                                @lang('site.OurTeam')
                            </h2>
                        </div>
                        <p>

                            @if(!empty($abouts))
                            {{$abouts->our_team}}
                            our team
                            @else
                            @endif
                        </p>
                    </div>
                    <div class="images-section">
                        <div class="grid-container">
                            <div class="grid-item">

                                @if(!empty($abouts->our_team_image1))
                                <figure>
                                    <img style="width: 325px;height: 325px;" src="{{ asset('uploads/about_us/' . $abouts->our_team_image1) }}" alt="">
                                </figure>
                                @else

                                <figure>
                                    <img style="width: 325px;height: 325px;" class="left-cornered" src="{{ asset('web_files/images/IMG_1443.JPG') }} " alt="">
                                </figure>
                                @endif
                            </div>
                            <div class="grid-item">
                                @if(!empty($abouts->our_team_image2))
                                <figure>
                                    <img style="width: 325px;height: 325px;" src="{{ asset('uploads/about_us/' . $abouts->our_team_image2) }}" alt="">
                                </figure>
                                @else

                                <figure>
                                    <img style="width: 325px;height: 325px;" class="left-cornered" src="{{ asset('web_files/images/mr-ahmed-nasr-1-400x500.jpg') }} " alt="">
                                </figure>
                                @endif
                            </div>
                            <div class="grid-item">
                                @if(!empty($abouts->our_team_image3))
                                <figure>
                                    <img style="width: 325px;height: 325px;" src="{{ asset('uploads/about_us/' . $abouts->our_team_image3) }}" alt="">
                                </figure>
                                @else

                                <figure>
                                    <img style="width: 325px;height: 325px;" class="left-cornered" src="{{ asset('web_files/images/WhatsApp Image 2020-11-22 at 10.08.52 AM.jpeg') }} " alt="">
                                </figure>
                                @endif
                            </div>
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="partners">
            <div class="container">
                <div class="title">
                    @lang('site.Ourpartners')
                </div>
                <div class="grid-container">
                    <div class="grid-item">
                        @if(!empty($abouts->partners1))
                        <figure>
                            <img style="width: 325px;height: 325px;" src="{{ asset('uploads/about_us/' . $abouts->partners1) }}" alt="">
                        </figure>
                        @else
                        <div class="partner-logos" style="width: 325px;height: 325px; display:flex; align-items: center;justify-content: center;">
                            <figure>
                                <img class="left-cornered" src="{{ asset('web_files/images/Transglobal logo.jpg') }} " alt="">
                            </figure>
                        </div>

                        @endif
                    </div>
                    <div class="grid-item">
                        @if(!empty($abouts->partner2))
                        <figure>
                            <img style="width: 325px;height: 325px;" src="{{ asset('uploads/about_us/' . $abouts->partner2) }}" alt="">
                        </figure>
                        @else
                        <div class="partner-logos" style="width: 325px;height: 325px; display:flex; align-items: center;justify-content: center;">

                            <figure>
                                <img class="left-cornered" src="{{ asset('web_files/images/BTC-Logo.png') }} " alt="">
                            </figure>
                        </div>
                        @endif
                    </div>
                    <!-- <div class="grid-item">
                        @if(!empty($abouts->partner3))
                        <figure>
                            <img style="width: 325px;height: 325px;" src="{{ asset('uploads/about_us/' . $abouts->partner3) }}" alt="">
                        </figure>

                        @else
                        <figure>
                            <img class="left-cornered" src="{{ asset('web_files/images/BTC-Logo.png') }} " alt="">
                        </figure>
                        @endif
                    </div>
                    <div class="grid-item">
                        @if(!empty($abouts->partners4))
                        <figure>
                            <img src="{{ asset('uploads/about_us/' . $abouts->partners4) }}" alt="">
                        </figure>

                        @else
                        <figure>
                            <img class="left-cornered" src="{{ asset('web_files/images/partners4.png') }} " alt="">
                        </figure>
                        @endif
                    </div>-->
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






@endsection

@push('scripts')