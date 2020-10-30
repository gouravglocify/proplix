@extends('layouts.authLayout')

@section('content')
<div class="container-login100" style="background-image: url('{{asset('images/home-banner.jpg')}}');background-size: cover">
    <div class="wrap-login100 p-l-55 pr-55 p-t-80 p-b-30">

        <form class="login100-form validate-form"  method="POST">
            @csrf
            <span class="login100-form-title p-b-37 mb-5">
                Contact Us
            </span>
            @if(Session::has('success'))
                <div class="alert alert-success">
                  {{ Session::get('success')}}
                </div>
            @endif
            <div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or name">
                <input class="input100 @error('name') is-invalid @enderror" type="text" name="name" placeholder="Enter your name" required  @if(!is_null($userDetails)) value="{{ucwords(strtolower($userDetails->name))}}" @else value="{{ old('name') }}" @endif autocomplete="name" autofocus>
                <span class="focus-input100"></span>
                
            </div>
            @error('name')
                <p class='error'>{{ $message }}</p>
            @enderror

            <div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or email">
                <input class="input100 @error('email') is-invalid @enderror" type="text" name="email" placeholder="Enter your email" required @if(!is_null($userDetails)) value="{{strtolower($userDetails->email)}}" @else value="{{ old('email') }}" @endif autocomplete="email" autofocus>
                <span class="focus-input100"></span>
            </div>
            @error('email')
                <p class='error'>{{ $message }}</p>
            @enderror

            

            <div class="wrap-input100 validate-input m-b-25" data-validate = "Enter message">
                <textarea class="input100 @error('message') is-invalid @enderror" name="message" required placeholder="Enter Message"></textarea>
                <span class="focus-input100"></span>
            </div>
            
            @error('message')
                <p class='error'>{{ $message }}</p>
            @enderror

            <div class="container-login100-form-btn mb-4">
                <button class="login100-form-btn" type="submit">
                    Contact Us
                </button>
            </div>

            
        </form>

        
    </div>
</div>

      
@endsection