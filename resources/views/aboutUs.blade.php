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
                <h1>About Us</h1>
              </div>
            </div>
            <div class="col-md-12">
               <div class="proPlixContent">
                <p>Welcome to Proplix!</p>
                <p>Proplix is a problem solving tool, basically an Indian eCommerce Profit calculator which provides quick profit/loss analysis to Indian ecom entrepreneurs about the product or services they have been selling/promoting.</p>
                <h2>What do we do?</h2>
                <h3>COMPLEX CALCULATION ON A CLICK!</h3>
                <p>It has always been really a task to calculate profitability for Indian eCommerce players as it depends on many little factors and even a small mistake in calculation can lend them to a huge loss which they could have avoided if they knew that a product they have been selling is making a loss instead of profit! Proplix is developed by Millions Kart Private Limited and Millions Kart is a tech based ecommerce company, throughout our journey we felt this complex and confusing calculation pain every day many times so we developed Proplix so that people can know the best possible figures without messing with traditional calculators on a click. </p>
                <h3>How does Proplix work?</h3>
                <p> One just needs to ENTER basic figures in Proplix and hit the Calculation button and it will show what exactly we’re making or losing after selling the stuff we’ve been selling.</p>
               </div>
            </div>
        </div>
      </div>
    </section>

  </div>


      
@endsection