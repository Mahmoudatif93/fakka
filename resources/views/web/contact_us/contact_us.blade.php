@extends('layouts.web.app')

@section('content')

<main class="contact-us">
    <div class="container">
        <div class="contact-body">
            <div class="title">
                <h2>
                    @lang('site.Contactus')
                </h2>
            </div>
            @include('partials._errors')
            @if(session()->get('success') !=null)
            {{ session()->get('success') }}
            @endif
            <form action="{{ route('fakka.contactus.store') }}" method="post" enctype="multipart/form-data">

                {{csrf_field() }}
                {{ method_field('post') }}
                <div class="fields">
                    <div class="field">
                        <input class="input input-custom " type="text" name="name" id="" placeholder="Name">
                    </div>
                    <div class="field">
                        <input class="input input-custom " type="email" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="field">
                        <input class="input input-custom " type="number" name="phone" id="" placeholder="Phone number">
                    </div>
                    <div class="field">
                        <input class="input input-custom " type="text" name="subject" id="subject" placeholder="Subject">
                    </div>
                    <div class="field big">
                        
                        <textarea id="message" name="message" class="input input-custom "  rows="4" cols="50"></textarea>
                    </div>
                </div>
                <div type="submit" class="buttons">
                    <button class="btn blue-btn">
                        @lang('site.Send')
                    </button>
                </div>

            </form>

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



@endsection

@push('scripts')