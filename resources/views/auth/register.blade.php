@extends('layouts.authLayout')


<style>
@media only screen and (min-width:100px) and (max-width:767px) {
.login100-form-title.mb-5 {margin-bottom: 30px !important;padding-top: 40px;}
.main-navbar {top: 0px !important;}
.container-login100 {min-height: 100% !important;}
}
</style>

@section('content')
<div class="container-login100" style="background-image: url('{{asset('images/home-banner.jpg')}}');background-size: cover">
    <div class="wrap-login100 p-l-55 pr-55 p-t-80 p-b-30">

        <form class="login100-form validate-form" action="{{ url('register') }}" method="POST">
            @csrf
            <span class="login100-form-title p-b-37 mb-5">
                Sign Up
            </span>
            @if(Session::has('success'))
                <div class="alert alert-success">
                  {{ Session::get('success')}}
                </div>
            @endif
            <div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or name">
                <input class="input100 @error('name') is-invalid @enderror" type="text" name="name" placeholder="Enter your name" required  value="{{ old('name') }}" autocomplete="name" autofocus>
                <span class="focus-input100"></span>
                
            </div>
            @error('name')
                <p class='error'>{{ $message }}</p>
            @enderror

            <div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or email">
                <input class="input100 @error('email') is-invalid @enderror" type="text" name="email" placeholder="Enter your email" required value="{{ old('email') }}" autocomplete="email" autofocus>
                <span class="focus-input100"></span>
            </div>
            @error('email')
                <p class='error'>{{ $message }}</p>
            @enderror

            <div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or phone">
                <input class="input100 @error('phone') is-invalid @enderror" type="text" name="phone" placeholder="Enter your phone number" required value="{{ old('phone') }}" autocomplete="email" autofocus onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" maxlength="10">
                <span class="focus-input100"></span>
            </div>
            @error('phone')
                <p class='error'>{{ $message }}</p>
            @enderror

            <div class="wrap-input100 validate-input m-b-25" data-validate = "Enter password">
                <input class="input100 @error('password') is-invalid @enderror" type="password" name="password" required placeholder="Enter Password" autocomplete="current-password">
                <span class="focus-input100"></span>
            </div>
            
            @error('password')
                <p class='error'>{{ $message }}</p>
            @enderror

            <div class="container-login100-form-btn mb-4">
                <button class="login100-form-btn" type="submit">
                    Sign Up
                </button>
            </div>

            
        </form>

        
    </div>
</div>
@endsection
