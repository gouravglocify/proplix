@extends('admin.include.header')

@section('content')
	<div class="d-flex align-items-stretch">
		
		@include('admin.include.sidebar')

        <!-- Page Content  -->
		<div id="content" class="p-4 p-md-5 pt-5 all-report-page">
			<div class="row">
				<div class="col">
					<h3 class="mb-4"><i class="fa fa-product-hunt" aria-hidden="true"></i> User's Memberships</h3>
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
				      <th scope="col">User Id</th>
				      <th scope="col">User's Name</th>
				      <th scope="col">Subscription Id</th>
				      <th scope="col">Plan Id</th>
				      <th scope="col" >Customer Id</th>
				      <th scope="col" >Subscription Status</th>
				      <th scope="col" >Start Date</th>
				      <th scope="col" >End Date</th>
				      <th scope="col" >Cancellation Date</th>
				      
				    </tr>
				  </thead>
				  <tbody>
				  	@php $i=1; @endphp
				  	@foreach($userSubscriptions as $userSubscription)
					    <tr>
					     @php $userDetails = $userSubscription->getUserDetails; @endphp	
					      <td >{{$i}}</td>
					      <td >{{$userSubscription->user_id}}</td>
					      <td >{{ucwords(strtolower($userDetails->name))}}</td>
					      <td >{{$userSubscription->subscription_id}}</td>
					      <td >{{$userSubscription->plan_id}}</td>
					      <td >{{$userSubscription->customer_id}}</td>
					      <td >   @if(is_null($userSubscription->current_end)) <button  class="btn btn-success">{{strtoupper($userSubscription->status)}} </button>  <a href="{{url('cancelUserSubscription/'.$userSubscription->user_id.'/'.$userSubscription->subscription_id)}}" class="btn btn-primary"> Cancel </a> @else <button  class="btn btn-default">{{strtoupper($userSubscription->status)}} </button>  @endif</td>
					      <td >{{date('F d, Y h:i A',strtotime($userSubscription->start_at))}}</td>
					      <td >{{date('F d, Y h:i A',strtotime($userSubscription->end_at))}}</td>
					      <td >@if(is_null($userSubscription->current_end)) Not Cancelled. @else {{date('F d, Y h:i A',strtotime($userSubscription->current_end))}} @endif</td>
					      
					    </tr>
					    @php $i++; @endphp
				    @endforeach
				  </tbody>
				</table>	
			</div>
		</div>
	</div>
	
@endsection
