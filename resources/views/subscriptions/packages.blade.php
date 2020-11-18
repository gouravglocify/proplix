@extends('layouts.plain')

@section('content')
<div class="d-flex align-items-stretch">

	@include('user.include.sidebar')

    <!-- Page Content  -->
	<div id="content" class="p-4 p-md-5 pt-5 all-report-page">
		<div class="row">
			<div class="col">
				<h3 class="mb-4"><i class="fa fa-product-hunt" aria-hidden="true"></i> Packages</h3>

			</div>
		</div>
		@if(Session::has('success'))
			<div class="alert alert-success">
				{{Session::get('success')}}
			</div>
		@elseif(Session::has('error'))
			<div class="alert alert-danger">
				{{Session::get('error')}}
			</div>
		@endif
	    <div class="container">
	      <div class="card-deck mb-3 text-center">
	        <div class="card mb-4 box-shadow">
	          <div class="card-header">
	            <h4 class="my-0 font-weight-normal">Free</h4>
	          </div>
	          <div class="card-body">
	            <h1 class="card-title pricing-card-title">₹0 <small class="text-muted">/ mo</small></h1>
	            <ul class="list-unstyled mt-3 mb-4">
	              <li>20 Calculation per Month</li>
	            </ul>
	            @if(is_null($getUserSubscription) || (!is_null($getUserSubscription) && $getUserSubscription->status!='active' ))
	            	<button type="button" class="btn btn-lg btn-block btn-outline-primary purchase">Active</button>

            	@elseif(!is_null($getUserSubscription) && !is_null($getUserSubscription->current_end))
	            	<button type="button" class="btn btn-lg btn-block btn-outline-primary purchase">Cancel Request Submitted</button>

	            @else
	            	<a  class="btn btn-lg btn-block btn-primary purchase" href="{{url('cancelSubscription/'.base64_encode($getUserSubscription->id))}}">Downgrade/Cancel</a>
	            @endif


	          </div>
	        </div>
	        <div class="card mb-4 box-shadow">
	          <div class="card-header">
	            <h4 class="my-0 font-weight-normal">Monthly</h4>
	          </div>
	          <div class="card-body">
	            <h1 class="card-title pricing-card-title">₹100 <small class="text-muted">/ mo</small></h1>
	            <ul class="list-unstyled mt-3 mb-4">
	              <li>Unlimited Calculation per Month</li>
	            </ul>
	            @if(is_null($getUserSubscription) || (!is_null($getUserSubscription) && $getUserSubscription->status!='active' && $getUserSubscription->status!='authenticated' ))
	            	<a href="{{url('buyProplix/month')}}" class="btn btn-lg btn-block btn-primary purchase" id="rzp-button1">Buy Proplix</a>

	            @else
	            	@if($getUserSubscription->plan_type==1)
	            	<button type="button" class="btn btn-lg btn-block btn-primary purchase">Active</button>
	            	@else
	            	<a  class="btn btn-lg btn-block btn-primary purchase" href="{{url('cancelSubscription/'.base64_encode($getUserSubscription->id))}}">Downgrade/Cancel</a>
	            	@endif
	            @endif
	          </div>
	        </div>
	        <div class="card mb-4 box-shadow">
	          <div class="card-header">
	            <h4 class="my-0 font-weight-normal">Yearly</h4>
	          </div>
	          <div class="card-body">
	            <h1 class="card-title pricing-card-title">₹599 <small class="text-muted">/ year</small></h1>
	            <ul class="list-unstyled mt-3 mb-4">
	              <li>Unlimited Calculation per Month</li>
	            </ul>
	            @if(is_null($getUserSubscription) || (!is_null($getUserSubscription) && $getUserSubscription->status!='active' && $getUserSubscription->status!='authenticated' ))
	            	<a href="{{url('buyProplix/year')}}" class="btn btn-lg btn-block btn-primary purchase" id="rzp-button1">Buy Proplix</a>

	            @else
	            	@if($getUserSubscription->plan_type==2)
	            	<button type="button" class="btn btn-lg btn-block btn-primary purchase">Active</button>
	            	@else
	            	<a  class="btn btn-lg btn-block btn-primary purchase" href="{{url('upgradeSubscription/'.base64_encode($getUserSubscription->id))}}">Upgrade</a>
	            	@endif
	            @endif
	          </div>
	        </div>
	      </div>
	    </div>
	</div>
</div>


@endsection
