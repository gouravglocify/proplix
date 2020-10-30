@extends('layouts.authLayout')

@section('content')
<div class="container-login100" style="background-image: url('{{asset('images/home-banner.jpg')}}');background-size: cover">
    <div class="wrap-login100 p-l-55 pr-55 p-t-80 p-b-30">

        <form class="login100-form validate-form" action="{{ url('login') }}" method="POST">
            @csrf
            <span class="login100-form-title p-b-37 mb-5">
                Sign In
            </span>
            @if(Session::has('error'))
                <div class="alert alert-danger">
                  {{ Session::get('error')}}
                </div>
            @endif
            <div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or email">
                <input class="input100 @error('email') is-invalid @enderror" type="text" name="email" placeholder="Enter Your Email" required value="{{ old('email') }}" autocomplete="email" autofocus>
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-25" data-validate = "Enter password">
                <input class="input100 @error('password') is-invalid @enderror" type="password" name="password" required placeholder="Enter Password" autocomplete="current-password">
                <span class="focus-input100"></span>
            </div>
            
            

            

            <div class="container-login100-form-btn mb-4">
                <button class="login100-form-btn" type="submit">
                    Sign In
                </button>
            </div>
            <a href="{{ url('forgotPassword') }}" class="pull-right need-help" style="color:#2755bf"> Forgot Password ? </a>

            
        </form>

        
    </div>
</div>
@endsection
