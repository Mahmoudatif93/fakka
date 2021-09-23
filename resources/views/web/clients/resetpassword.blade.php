@extends('layouts.web.app')

@section('content')

<main class="sign-in">
    <div class="container">
        <div class="sign-body">
            <div class="title">
                <h2>
                @lang('site.resetpassword' )
                </h2>
            </div>
            <form action="{{ route('fakka.resetnewpassword') }}" method="post" enctype="multipart/form-data">

                {{csrf_field() }}
                {{ method_field('post') }}


                @if(session()->get('error') !=null)
                {{ session()->get('error') }}
                @endif
                @if(session()->get('status') !=null)
                {{ session()->get('status') }}

                @endif
                <div class="fields">
                    <div class="field">
                        <input class="input input-custom " type="text" name="email" id="email" placeholder=" @lang('site.email' )">
                    </div>
                </div>
                <div class="buttons reset">
                    <button type="submit" class="btn blue-btn">
                    @lang('site.reset' )
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