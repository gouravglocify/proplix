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
                <h1>Refund Policy</h1>
              </div>
            </div>
            <div class="col-md-12">
               <div class="proPlixContent">
                <p>Welcome to Proplix!</p>
                <p>We're so convinced you'll absolutely love our services, that we're willing to offer a 14 day risk-free money back guarantee. If you are not satisfied with the service for any reason you can get a refund within 14 days of making a purchase. Please keep in mind that even though we offer a full money back guarantee, we will issue a refund only for the unused portion of the service.</p>

                <p>Contacting us</p>

                <p>If you would like to contact us concerning any matter relating to this Refund Policy, you may do so via the contact form.</p>
               </div>
            </div>
        </div>
      </div>
    </section>

  </div>


      
@endsection