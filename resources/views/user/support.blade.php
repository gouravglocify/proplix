@extends('layouts.plain')

@section('content')
	<div class="d-flex align-items-stretch">

		@include('user.include.sidebar')
		<div id="content" class="p-4 p-md-5 pt-5 all-report-page">
			<div class="row">
				<div class="col">
					<h3 class="mb-4"><i class="fa fa-phone" aria-hidden="true"></i> Support</h3>
					
					    
				</div>
			</div>
			

			<div class="row">
				<div class="col-md-7">
					@if(Session::has('success'))
		                <div class="alert alert-success">
		                  {{ Session::get('success')}}
		                </div>
		            @endif
		            @if(Session::has('error'))
		                <div class="alert alert-danger">
		                  {{ Session::get('error')}}
		                </div>
		            @endif
				 	<form method="POST">
					 	@csrf
					 	<div class="form-group">
						  <label for="email">Name:</label>
						  <input type="text" class="form-control" id="email" placeholder="Enter name" name="name" value="{{ucwords(strtolower($userDetails->name))}}" readonly="readonly">
						</div>

						<div class="form-group">
						  <label for="email">Email:</label>
						  <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{strtolower($userDetails->email)}}" readonly="readonly">
						</div>
						
						<div class="form-group">
						  <label for="email">Enter your message:</label>
						  <textarea class="form-control" name="message" placeholder="Enter your message here"></textarea>
						</div>

						@error('message')
				            <p class='error'>{{ $message }}</p>
				        @enderror

						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>

	</div>	
@endsection
