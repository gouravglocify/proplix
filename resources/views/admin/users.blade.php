@extends('admin.include.header')

@section('content')
	<div class="d-flex align-items-stretch">
		
		@include('admin.include.sidebar')

        <!-- Page Content  -->
		<div id="content" class="p-4 p-md-5 pt-5 all-report-page">
			<div class="row">
				<div class="col">
					<h3 class="mb-4"><i class="fa fa-users" aria-hidden="true"></i> Users</h3>
				</div>
			</div>
		 	@if(Session::has('error'))
                <div class="alert alert-danger">
                  {{ Session::get('error')}}
                </div>
            @endif
         	@if(Session::has('success'))
                <div class="alert alert-success">
                  {{ Session::get('success')}}
                </div>
            @endif
			<div class="row">
				<table class="table table-striped dataTables">
				  <thead>
				    <tr>
				      <!-- <th scope="col"></th> -->
				      <th scope="col"> S.no</th>
				      <th scope="col">Name</th>
				      <th scope="col">Email</th>
				      <th scope="col" >Since</th>
				      <th scope="col" >Number of Reports</th>
				      <th scope="col" >Number of Calculations</th>
				      <th scope="col" >Account Status</th>
				      
				    </tr>
				  </thead>
				  <tbody>
				  	@php $i=1; @endphp
				  	@foreach($users as $user)
				  		@php
				  			$userReports = $user->report;
				  			$userCalculations = $user->calculation;
				  		@endphp
					    <tr>
					     
					      <td >{{$i}}</td>
					      <td >{{ucwords(strtolower($user->name))}}</td>
					      <td >{{strtolower($user->email)}}</td>
					      <td >{{date('F d, Y',strtotime($user->created_at))}}</td>
					      <td >{{count($userReports)}}</td>
					      <td >{{count($userCalculations)}}</td>
					      <td >@if($user->login_status=='1') <button  class="btn btn-success">Active </button> <a href="{{url('changeUserLoginStatus/'.$user->id)}}" class="btn btn-primary"> Cancel </a> @else <button  class="btn btn-default">Cancelled </button> @endif</td>
					    </tr>
					    @php $i++; @endphp
				    @endforeach
				  </tbody>
				</table>	
			</div>
		</div>
	</div>
	
@endsection
