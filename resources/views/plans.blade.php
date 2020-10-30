@extends('layouts.authLayout')

@section('content')
<div class="home-page">
    <!--================Home Banner Area =================-->
    <section class="container-login100 planContainer" style="background-image: url('{{asset('images/home-banner.jpg')}}');background-size: cover">
      <div class="subsciptionPlan">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="planTitle">
                <h1>Choose Your Best Plan</h1>
              </div>
            </div>
            <div class="col-md-4 col-lg-4">
               <div class="card mb-4 box-shadow">
                <div class="card-header">
                  <h4 class="my-0">Free</h4>
                </div>
                  <div class="card-body">
                    <h1 class="card-title pricing-card-title">₹0 <small class="text-muted">/ mo</small></h1>
                    <ul class="list-unstyled mt-3 mb-4 planList">
                      <li>20 Calculation per Month</li>
                    </ul>
                    <div class="planBtn">
                     <a href="{{url('register')}}" class="btn btn-lg btn-block btn-primary purchase buyPlanBtn" id="rzp-button1">Buy Proplix</a>
                   </div>
                  </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
              <div class="card mb-4 box-shadow">
                <div class="card-header">
                  <h4 class="my-0">Monthly</h4>
                </div>
                <div class="card-body">
                  <h1 class="card-title pricing-card-title">₹100 <small class="text-muted">/ mo</small></h1>
                  <ul class="list-unstyled mt-3 mb-4 planList">
                    <li>Unlimited Calculation per Month</li>
                  </ul>
                  <div class="planBtn">
                    <a href="{{url('register')}}" class="btn btn-lg btn-block btn-primary purchase buyPlanBtn" id="rzp-button1">Buy Proplix</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-lg-4">
              <div class="card mb-4 box-shadow">
                <div class="card-header">
                  <h4 class="my-0">Yearly</h4>
                </div>
                <div class="card-body">
                  <h1 class="card-title pricing-card-title">₹599 <small class="text-muted">/ year</small></h1>
                  <ul class="list-unstyled mt-3 mb-4 planList">
                    <li>Unlimited Calculation per Month</li>
                  </ul>
                   <div class="planBtn">
                     <a href="{{url('register')}}" class="btn btn-lg btn-block btn-primary purchase buyPlanBtn" id="rzp-button1">Buy Proplix</a>
                   </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </section>

  </div>



@endsection
