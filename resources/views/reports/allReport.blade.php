@extends('layouts.plain')

@section('content')
	<div class="d-flex align-items-stretch">
		
		@include('user.include.sidebar')

        <!-- Page Content  -->
		<div id="content" class="p-4 p-md-5 pt-5 all-report-page">
			<div class="row">
				<div class="col">
					<h3 class="mb-4"><i class="fa fa-sticky-note" aria-hidden="true"></i> Reports</h3>
					<button class="btn btn-primary downloadAllReports " id="pdf">(PDF)</button>
					<button class="btn btn-primary pull-right downloadAllReports " id="excel">(EXCEL)</button>
					<br>
					<br>
				</div>
			</div>
			
			<div class="row">
				<table class="table table-striped dataTables">
				  <thead>
				    <tr>
				      <!-- <th scope="col"></th> -->
				      <th scope="col"> <input type="checkbox" class="selectAll"> S.no</th>
				      <th scope="col">Report Title</th>
				      <th scope="col" >Created On</th>
				      <th scope="col" >Orders</th>
				      <th scope="col" >Profit per Delivered*</th>
				      <th scope="col" >Total Profit*</th>
				      <th scope="col">View Report</th>
				      <th scope="col">Download</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@php $i=1; @endphp
				  	@foreach($reports as $report)
					    <tr>
					      <!-- <th><input type="checkbox" name="prints[]" value="{{$report->id}}"></th> -->
					      <td> <input type="checkbox" class="checkbox" value={{base64_encode($report->id)}}> {{$i}}  </td>
					      <td scope="row">{{ucwords(strtolower($report->title))}}</td>
					      <td >{{date('F d, Y h:i A',strtotime($report->created_at))}}</td>
					      <td >{{$report->orders}}</td>
					      <td >{{$report->profitperdelivered}}</td>
					      <td >{{$report->totalprofit}}</td>
					      <td><a href="{{url('viewReport/'.base64_encode($report->id) )}}" class="btn btn-block btn-outline-secondary">View Report</a></td>
					      <td >
					      	<a href="{{url('downloadReport/pdf/'.base64_encode($report->id))}}" class="btn btn-outline-secondary">
					      		<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
					      	</a>

					      	<a href="{{url('downloadReport/excel/'.base64_encode($report->id))}}" class="btn btn-outline-secondary">
					      		<i class="fa fa-file-excel-o" aria-hidden="true"></i>
					      	</a>

					      </td>
					      <td >
					      	<a href="{{url('viewReport/'.base64_encode($report->id))}}" class="btn btn-outline-secondary">
					      		<i class="fa fa-edit"></i>
					      	</a>
					      	<a href="{{url('deleteReport/'.base64_encode($report->id))}}" class="btn btn-outline-secondary">
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
	<form class="hidden" method="post" id="downloadReports" action="{{url('downloadMultipleReports')}}">
		@csrf
		<input type="hidden" value="" id="ids" name="ids">
		<input type="hidden" value="" id="type" name="type">
	</form>
<script src="{{url('/js/proplix/reports.js')}}"></script>
@endsection
