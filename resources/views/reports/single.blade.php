@extends('layouts.plain')

@section('content')
	<div class="d-flex align-items-stretch">
		
		@include('user.include.sidebar')

        <!-- Page Content  -->
		<div id="content" class="p-4 p-md-5 pt-5">
			<div class="row mb-4">
				<div class="col">
					<h2 class="mb-1">{{$report->title}}</h2>
					<p>{{$report->created_at->format('d(D), M - Y')}}</p>
				</div>
				<div class="col text-right">
					<a href="{{action('ReportController@pdf', $report->id)}}" class="btn btn-outline-secondary">Print Report</a>
				</div>
			</div>
			<hr>
			<div class="row mt-5">
				<div class="col">
					<table class="table table-striped">
					  <tbody>
					    <tr>
					      <th scope="col">Selling Price</th>
					      <td>{{$report->sellingprice}}</td>
					    </tr>
					    <tr>
					      <th scope="col">Product Cost</th>
					      <td>{{$report->productcost}}</td>
					    </tr>
					    <tr>
					      <th scope="col">Orders</th>
					      <td>{{$report->orders}}</td>
					    </tr>
					    <tr>
					      <th scope="col">ROAS</th>
					      <td>{{$report->roas}}</td>
					    </tr>
					    <tr>
					      <th scope="col">Delivery</th>
					      <td>{{$report->delivery}}</td>
					    </tr>
					  </tbody>
					</table>
					<table class="table table-striped">
					  <tbody>
					    <tr>
					      <th scope="col">Sale Value</th>
					      <td>{{$report->salevalue}}</td>
					    </tr>
					    <tr>
					      <th scope="col">CPP</th>
					      <td>{{$report->cpp}}</td>
					    </tr>
					    <tr>
					      <th scope="col">Delivered</th>
					      <td>{{$report->delivered}}</td>
					    </tr>
					  </tbody>
					</table>
				</div>
				<div class="col">
					<table class="table table-striped">
					  <tbody>
					    <tr>
					      <th scope="col">Remittance</th>
					      <td>{{$report->remittance}}</td>
					    </tr>
					    <tr>
					      <th scope="col">Ad Cost</th>
					      <td>{{$report->adcost}}</td>
					    </tr>
					    <tr>
					      <th scope="col">Product</th>
					      <td>{{$report->product}}</td>
					    </tr>
					    <tr>
					      <th scope="col">GST</th>
					      <td>{{$report->gst}}</td>
					    </tr>
					    <tr>
					      <th scope="col">Packaging</th>
					      <td>{{$report->packaging}}</td>
					    </tr>
					    <tr>
					      <th scope="col">Shipping</th>
					      <td>{{$report->shipping}}</td>
					    </tr>
					    <tr>
					      <th scope="col">Total Expense</th>
					      <td>{{$report->totalexpense}}</td>
					    </tr>
					  </tbody>
					</table>
				</div>
				<div class="col">
					<table class="table table-striped">
					  <tbody>
					    <tr>
					      <th scope="col">Avg. Shipping Cost</th>
					      <td>{{$report->shippingcost}}</td>
					    </tr>
					    <tr>
					      <th scope="col">Avg. RTO charge</th>
					      <td>{{$report->rtocharge}}</td>
					    </tr>
					    <tr>
					      <th scope="col">Weight segment (Gram)</th>
					      <td>{{$report->weightsegment}}</td>
					    </tr>
					    <tr>
					      <th scope="col">GST %</th>
					      <td>{{$report->gstpercentage}}</td>
					    </tr>
					  </tbody>
					</table>
					<hr class="mt-4 mb-4">
					<table class="table table-bordered table-dark">
					  <tbody>
					    <tr>
					      <th scope="col">Profit per Delivered*</th>
					      <td>{{$report->profitperdelivered}}</td>
					    </tr>
					    <tr>
					      <th scope="col">Total Profit*</th>
					      <td>{{$report->totalprofit}}</td>
					    </tr>
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
