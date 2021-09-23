@extends('layouts.web.app')

@section('content')


<main class="sign-in">
    <div class="container">
        <div class="sign-body">
            <div class="title">
                <h2>
                    New password
                </h2>
            </div>
            @include('partials._errors')

            @if(session()->get('error') !=null)
            {{ session()->get('error') }}
            @endif

            <form action="{{ route('fakka.updatenewpass') }}" method="post" enctype="multipart/form-data">

                {{csrf_field() }}
                {{ method_field('post') }}



                <div class="fields">
                    <div class="field">
                        <input class="input input-custom " type="password" name="password" id="password" placeholder="New password">
                        <input class="input input-custom " type="hidden" name="email" id="email" value=" {{$email}}" placeholder="email">

                    </div>
                    <div class="field">
                        <input class="input input-custom " type="password" name="password_confirmation" id="password" placeholder="Confirm new password">
                    </div>
                </div>
                <div class="buttons password">
                    <button type="submit" class="btn blue-btn">
                        Save and continue
                    </button>

                </div>
            </form>

        </div>
    </div>
    <div class="contact" style="margin-top: 50px;">
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
</main>



@endsection

@push('scripts')