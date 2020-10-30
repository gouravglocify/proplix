@extends('layouts.app')

@section('content')
  <div class="home-page">
    <!--================Home Banner Area =================-->
    <section class="home_banner_area" style="background: url('{{asset('images/home-banner.jpg')}}') no-repeat center center;
  background-size: cover;">
      <div class="banner_inner">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="home_left_img">
                <img class="img-fluid" src="{{asset('images/home-left.png')}}">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="banner_content">
                <h2>
                  Profit Margin <br>Calculator
                </h2>
                <p>
                  This easy calculator will help you determine selling prices for your products in order to save money and increase profits
                </p>
                <div class="d-flex align-items-center">
                  @if(is_null($userDetails))
                  <a  class="btn btn-light btn-lg mr-3" href="{{url('register')}}">Sign Up</a>
                  @else
                  <button type="button" class="btn btn-light btn-lg mr-3">Getting Started</button>
                  @endif
                  <a href="{{url('plans')}}" class="btn btn-outline-light btn-lg ">Buy ProPlix</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
@endsection
