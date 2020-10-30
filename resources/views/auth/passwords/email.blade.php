@extends('layouts.authLayout')

@section('content')
<div class="container-login100" style="background-image: url('{{asset('images/home-banner.jpg')}}');background-size: cover">
    <div class="wrap-login100 p-l-55 pr-55 p-t-80 p-b-30">

        <form class="login100-form validate-form" action="" method="POST">
            @csrf
            <span class="login100-form-title p-b-37 mb-5">
                Forgot Password
            </span>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or email">
               <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
               <span class="focus-input100"></span>
            </div>
            @error('name')
                <p class='error'>{{ $message }}</p>
            @enderror

            <div class="container-login100-form-btn mb-4">
                <button class="login100-form-btn" type="submit">
                   {{ __('Send Password Reset Link') }}
                </button>
            </div>

            
        </form>

        
    </div>
</div>



@endsection
