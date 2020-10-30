@extends('layouts.plain')

@section('content')
	<div class="d-flex align-items-stretch">
		
		@include('user.include.sidebar')

        <!-- Page Content  -->
		<div id="content" class="p-4 p-md-5 pt-5">
			<h2 class="mb-4">ProPlix - Dashboard</h2>



			
			<div class="row">
				<div class="col-6">
					<div class="card weather-card">
					  <div class="card-body pb-3">

					    <div class="d-flex justify-content-between">
					      <img src="{{asset('images/reoprts.svg')}}" style="width: 50%">
					      <div>
					      	<h2 class="card-title font-weight-bold">Total Reports:</h2>
						    <h1>- {{count($reports)}}</h1>
					      </div>
					    </div>
					  </div>
					</div>
				</div>
				<div class="col-6">
					<div class="card bg-light weather-card">
					  <div class="card-body pb-3">
					    <h4 class="card-title font-weight-bold">Set Default values
					    </h4>

						<form action="{{url('addUserDefaultValues')}}" method="POST" id="defaultValues">
							@csrf
						    <div class="">
								<div class="form-group row">
								    <label for="staticEmail" class="col-6 col-form-label">Avg. Shipping Cost</label>
								    <div class="col-6">
								      <input type="text" class="form-control" name="average_shipping_cost" 
								      @if(!is_null($getDefaultValues) && !is_null($getDefaultValues->average_shipping_cost) )value="{{$getDefaultValues->average_shipping_cost}}" @else value="100" @endif >
								    </div>
								    @error('average_shipping_cost')
								    <span style="color:red">{{$message}}</span>
								    @enderror
								</div>
						    </div>
						    <div class="">
								<div class="form-group row">
								    <label for="staticEmail" class="col-6 col-form-label">Avg. RTO charge</label>
								    <div class="col-6">
								      <input type="text" class="form-control" name="average_rto_charge" @if(!is_null($getDefaultValues) && !is_null($getDefaultValues->average_rto_charge) )value="{{$getDefaultValues->average_rto_charge}}" @else value="100"  @endif >
								    </div>
								    @error('average_rto_charge')
								    <span style="color:red">{{$message}}</span>
								    @enderror
								</div>
						    </div>
						    <div class="">
								<div class="form-group row">
								    <label for="staticEmail" class="col-6 col-form-label">Weight segment (Gram)</label>
								    <div class="col-6">

								    	<select class="form-control" name="weight_segment">
							    			@for($i=500; $i<=5000; $i= $i+500)
							    				@if($i==500)
							    				
							    				<option @if(!is_null($getDefaultValues) && !is_null($getDefaultValues->weight_segment) && ($getDefaultValues->weight_segment == $i)) selected @endif value={{$i}}>{{"< ". $i .' gram'}}</option>

							    				@else
							    				<option @if(!is_null($getDefaultValues) && !is_null($getDefaultValues->weight_segment) && ($getDefaultValues->weight_segment == $i)) selected @endif value={{$i}}>{{ ($i/1000) .' KG'}}</option>
							    				@endif


							    			@endfor
								    	</select>

								    </div>
								    @error('weight_segment')
								    <span style="color:red">{{$message}}</span>
								    @enderror
								</div>
						    </div>

						    <div class="">
								<div class="form-group row">
								    <label for="staticEmail" class="col-6 col-form-label">Packaging Cost</label>
								    <div class="col-6">
								      <input type="text" class="form-control" name="packaging_cost" @if(!is_null($getDefaultValues) && !is_null($getDefaultValues->packaging_cost) )value="{{$getDefaultValues->packaging_cost}}" @else value="100"  @endif >
								    </div>
								    @error('packaging_cost')
								    <span style="color:red">{{$message}}</span>
								    @enderror
								</div>
						    </div>


						    <button type="submit" class="btn btn-primary mb-2" >Save Settings</button>
					    </form>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
