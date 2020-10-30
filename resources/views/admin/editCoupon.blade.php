@extends('admin.include.header')

@section('content')
	<div class="d-flex align-items-stretch">
		
		@include('admin.include.sidebar')

    <!-- Page Content  -->
	<div id="content" class="p-4 p-md-5 pt-5 all-report-page">
		<div class="row">
			<div class="col">
				<h3 class="mb-4"><i class="fa fa-sticky-note" aria-hidden="true"></i> Add Coupon Code</h3>
			
			</div>
		</div>
		
	    <div class="container">
	      <div class="card-deck mb-3 text-center">
	      	
	        <div class="card mb-4 box-shadow">
	          <div class="card-header">
	            <h4 class="my-0 font-weight-normal">Add Coupon Code</h4>
	          </div>
	          <div class="card-body">
	          	@if(Session::has('success'))
					<div class="alert alert-success">
						{{Session::get('success')}}
					</div>
				@elseif(Session::has('error'))
					<div class="alert alert-danger">
						{{Session::get('error')}}
					</div>	
				@endif
	            <form method="POST" class="coupon">
	            	@csrf
				  <div class="form-group">
			    	<label>Enter Coupon Name</label>
				    <input type="text" class="form-control"  placeholder="Enter coupon name" name="name" value="{{strtoupper($getCouponDetails->name)}}" onkeyup="this.value=this.value.replace(/[^a-zA-Z0-9]/g,'');" >
				    @error('name')
		                <p class='error'>{{ $message }}</p>
		            @enderror
				  </div>

				  <div class="form-group">
			    	<label>Enter Coupon Description</label>
				    <textarea type="text" class="form-control"  placeholder="Enter coupon description" name="description">{{$getCouponDetails->description}}</textarea>
				    @error('description')
		                <p class='error'>{{ $message }}</p>
		            @enderror
				  </div>


				  <div class="form-group">
			    	<label>Select Discount Type</label>
			    	<select class="form-control" name="discount_type">
			    		<option value="">Select Discount Type</option>
			    		<option @if($getCouponDetails->discount_type=='1') selected @endif value="1">FLAT</option>
			    		<option @if($getCouponDetails->discount_type=='2') selected @endif value="2">PERCENTAGE</option>
					</select>				    		
				    
				    @error('discount_type')
		                <p class='error'>{{ $message }}</p>
		            @enderror
				  </div>

				  <div class="form-group">
			    	<label>Enter Discount Value</label>
				    <input type="text" class="form-control"  placeholder="Enter discount value" name="discount_value" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'');" value="{{$getCouponDetails->discount_value}}">
				    @error('discount_value')
		                <p class='error'>{{ $message }}</p>
		            @enderror
				  </div>

				  <div class="form-group">
			    	<label>Select Coupon Applicable On</label>
			    	<select class="form-control" name="coupon_applicable_on">
			    		<option value="">Select Coupon Applicable On</option>			    		
	    				<option @if($getCouponDetails->coupon_applicable_on=='1') selected @endif value="1">Monthly Plan</option>    				
    					<option @if($getCouponDetails->coupon_applicable_on=='2') selected @endif value="2">Yearly Plan</option>   				
					</select>				    		
				    @error('coupon_applicable_on')
		                <p class='error'>{{ $message }}</p>
		            @enderror
				  </div>

				  <div class="form-group">
			    	<label>Select Coupon Duration</label>
			    	<select class="form-control" name="duration">
			    		<option value="">Select Coupon Duration</option>
			    		@for($i=1; $i<=13; $i++)
			    			@if($i==13)
		    					<option @if($getCouponDetails->duration==$i) selected @endif value="{{$i}}">{{'Lifetime'}}</option>
		    				@else
			    				<option @if($getCouponDetails->duration==$i) selected @endif value="{{$i}}">{{$i}}</option>
		    				@endif
			    		@endfor
					</select>				    		
				    
				    @error('duration')
		                <p class='error'>{{ $message }}</p>
		            @enderror
				  </div>



				  <div class="form-group">
			    	<label>Enter number of use</label>
				    <input type="text" class="form-control"  placeholder="Enter number of use" name="number_of_use" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'');" value="{{$getCouponDetails->number_of_use}}">
				    @error('number_of_use')
		                <p class='error'>{{ $message }}</p>
		            @enderror
				  </div>


				  <div class="form-group">
			    	<label>Select Coupon Expiry Date</label>
				    <input type="text" class="form-control"  placeholder="Select coupon expiry date" id="end_date" name="end_date" value="{{date('m/d/Y',strtotime($getCouponDetails->end_date))}}">
				    @error('end_date')
		                <p class='error'>{{ $message }}</p>
		            @enderror
				  </div>

				  <button type="submit" class="btn btn-lg btn-block btn-primary purchase">Update Coupon !</button>
				  
				</form>	            
	          </div>

	        </div>
	       	        
	      </div>	      
	    </div>
	</div>
</div>




    	
@endsection
