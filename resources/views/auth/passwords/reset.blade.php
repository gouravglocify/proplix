@extends('layouts.authLayout')

@section('content')
<div class="container-login100" style="background-image: url('{{asset('images/home-banner.jpg')}}');background-size: cover">
    <div class="wrap-login100 p-l-55 pr-55 p-t-80 p-b-30">

        <form class="login100-form validate-form" action="" method="POST">
            @csrf
            <span class="login100-form-title p-b-37 mb-5">
                {{ __('Reset Password') }}
            </span>
            
            <div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or email">
               <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ strtolower($getDetails->email) }}" required autocomplete="email" autofocus readonly="readonly">
               <span class="focus-input100"></span>
               
            </div>

            <div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or email">
               <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
               <span class="focus-input100"></span>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or email">
               <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
               <span class="focus-input100"></span>
            </div>

            <div class="container-login100-form-btn mb-4">
                <button class="login100-form-btn" type="submit">
                   {{ __('Reset Password') }}
                </button>
            </div>
        </form>

        
    </div>
</div>

@endsection
