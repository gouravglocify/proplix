@extends('admin.include.header')

@section('content')
	<div class="d-flex align-items-stretch">
		
		@include('admin.include.sidebar')

        <div id="content" class="p-4 p-md-5 pt-5 all-report-page">
			<div class="row">
				<div class="col">
					<h3 class="mb-4"><i class="fa fa-user" aria-hidden="true"></i> Profile</h3>
					
					    
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
						  <input type="text" class="form-control" id="email" placeholder="Enter name" name="name" value="{{ucwords(strtolower($userDetails->name))}}">
						</div>
					 	@error('name')
				            <p class='error'>{{ $message }}</p>
				        @enderror

						<div class="form-group">
						  <label for="email">Email:</label>
						  <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{strtolower($userDetails->email)}}">
						</div>

						<div class="form-group">
						  <label for="email">Phone:</label>
						  <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone" value="{{$userDetails->phone}}" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" maxlength="10">
						</div>
						 @error('phone')
			                <p class='error'>{{ $message }}</p>
			            @enderror
						
						<div class="form-group">
						  <label for="email">Change Password:</label>
						  <input type="password" class="form-control" id="email" placeholder="Enter password" name="password" >
						</div>

						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>

	</div>	
@endsection
