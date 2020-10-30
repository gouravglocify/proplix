@extends('layouts.plain')

@section('content')
	<div class="d-flex align-items-stretch">
		
		@include('user.include.sidebar')
        <!-- Page Content  -->
		<div id="content" class="p-4 p-md-5 pt-5 all-report-page">
			<div class="row">
				<div class="col">
					<h2 class="mb-4"><i class="fa fa-forward"></i> Search Result</h2>
				</div>
				<div class="col">
					<form class="form-inline float-right" method="GET" action="{{route('search')}}">
				      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
				      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				    </form>
				</div>
			</div>
			
			<div class="row">
				@if($reports->isEmpty())
				  	<div class="col text-center">
			    		<img src="{{asset('images/search.png')}}" height="320px">
			    		<h3>No results found</h3>
			    		<p>Try search with different keyword!</p>
		    		</div>
		    	@else
					<table class="table table-striped">
					  	<thead>
					    	<tr>
								<!-- <th scope="col"></th> -->
								<th scope="col">Sr.no</th>
								<th scope="col">Report Title</th>
								<th scope="col" class="text-center">Created On</th>
								<th scope="col" class="text-center">Orders</th>
								<th scope="col" class="text-center">Profit per Delivered*</th>
								<th scope="col" class="text-center">Total Profit*</th>
								<th scope="col">View Report</th>
					    	</tr>
					  	</thead>
			    	
					  	<tbody>
					  		@foreach($reports as $report)
							    <tr>
							      <!-- <th><input type="checkbox" name="prints[]" value="{{$report->id}}"></th> -->
							      <th>{{$report->id}}</th>
							      <th scope="row">{{$report->title}}</th>
							      <td class="text-center">{{$report->created_at->format('d(D), M-Y')}}</td>
							      <td class="text-center">{{$report->orders}}</td>
							      <td class="text-center">{{$report->profitperdelivered}}</td>
							      <td class="text-center">{{$report->totalprofit}}</td>
							      <td><a href="{{route('singleReport', $report->id)}}" class="btn btn-block btn-outline-secondary">View Report</a></td>
							    </tr>
					    	@endforeach
					  	</tbody>
					</table>
				@endif
			</div>

		</div>
	</div>
@endsection
