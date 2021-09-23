@extends('layouts.web.app')

@section('content')

<main class="sign-in">
    <div class="container">
        <div class="sign-body">
            <div class="title">
                <h2>
                @lang('site.Signin' )
                </h2>
            </div>
            @if(session()->get('error') !=null)
            {{ session()->get('error') }}

            @endif

            @if(session()->get('success') !=null)
            {{ session()->get('success') }}

            @endif
            <form action="{{ route('fakka.postlogin') }}" method="post" enctype="multipart/form-data">

                {{csrf_field() }}
                {{ method_field('post') }}

                <div class="fields">
                    <div class="field">
                        <input class="input input-custom " type="text" name="email" id="" placeholder="Email">
                    </div>
                    <div class="field">
                        <input class="input input-custom " type="password" name="password" id="" placeholder="Password">
                    </div>
                </div>
                <div class="buttons">
                    <button type="submit" class="btn blue-btn">
                    @lang('site.Signin' )
                    </button>

                    <a href="{{ route('fakka.client.index') }}" class="btn outline-btn ">
                         @lang('site.Creataccount' )
                    </a>
                </div>
            </form>
            <a href="{{ route('fakka.resetpassword') }}">
                 @lang('site.ForgetPassword' )
            </a>
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