@extends('admin.include.header')

@section('content')
	<div class="d-flex align-items-stretch">
		
		@include('admin.include.sidebar')

        <!-- Page Content  -->
		<div id="content" class="p-4 p-md-5 pt-5 all-report-page">
			<div class="row">
				<div class="col">
					<h3 class="mb-4"><i class="fa fa-sticky-note" aria-hidden="true"></i> Coupons</h3>
					<a href="{{url('addCoupon')}}" class="btn btn-primary purchase pull-right">Add Coupon</a><br><br>
				</div>
			</div>
			
			<div class="row">
				@if(Session::has('success'))
					<div class="alert alert-success">
						{{Session::get('success')}}
					</div>
				@elseif(Session::has('error'))
					<div class="alert alert-danger">
						{{Session::get('error')}}
					</div>	
				@endif
				<table class="table table-striped dataTables">
				  <thead>
				    <tr>
				      <!-- <th scope="col"></th> -->
				      <th scope="col">S.no</th>
				      <th scope="col">Coupon Name</th>
				      <th scope="col">Coupon Applicable On</th>
				      <th scope="col">Discount Type</th>
				      <th scope="col" >Discount Value</th>
				      <th scope="col" >Duration</th>
				      <th scope="col" >Number of uses</th>
				      <th scope="col" >End Date</th>
				      <th scope="col" >Satus</th>
				      <th scope="col">Action</th>
				     
				      
				    </tr>
				  </thead>
				  <tbody>
				  	@php $i=1; @endphp
				  	@foreach($coupons as $coupon)
					    <tr>
					      <td>{{$i}}</td>
					      <td>{{strtoupper($coupon->name)}}</td>
					      <td>@if($coupon->coupon_applicable_on=='1') Monthly Plan @else Yearly Plan @endif</td>
					      <td>@if($coupon->discount_type=='1') FLAT @else PERCENTAGE @endif</td>
					      <td>{{$coupon->discount_value}}</td>
					      <td>{{$coupon->duration.' months'}}</td>
					      <td>{{$coupon->number_of_use}}</td>
					      <td>{{date('F d, Y',strtotime($coupon->end_date))}}</td>
					      <td>@if($coupon->status=='1') NOT DELETED @else DELETED @endif</td>
					      <td>
					      	<a href="{{url('editCoupon/'.base64_encode($coupon->id))}}" class="btn btn-outline-secondary">
					      		<i class="fa fa-edit"></i>
					      	</a>
					      	<a href="{{url('deleteCoupon/'.base64_encode($coupon->id))}}" class="btn btn-outline-secondary">
					      		<i class="fa fa-trash-o" aria-hidden="true"></i>
					      	</a>

					      </td>
					     

					    </tr>
					    @php $i++; @endphp
				    @endforeach
				  </tbody>
				</table>	
			</div>
		</div>
	</div>
	<form class="hidden" method="post" id="downloadReports" action="{{url('downloadMultipleReportsAdmin')}}">
		@csrf
		<input type="hidden" value="" id="ids" name="ids">
		<input type="hidden" value="" id="type" name="type">
	</form>
<script src="{{url('/js/proplix/reports.js')}}"></script>
@endsection
