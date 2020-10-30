@extends('admin.include.header')

@section('content')
	<div class="d-flex align-items-stretch">
		
		@include('admin.include.sidebar')

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
					      	<h2 class="card-title font-weight-bold">Total Users:</h2>
						    <h1>- {{count($users)}}</h1>
					      </div>
					    </div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
