@extends('layouts.plain')

@section('content')
<div class="d-flex align-items-stretch">
	@include('user.include.sidebar')

	<div id="content" class="p-4 p-md-5 pt-5">
		<h2 class="mb-4">ProPlix - Dashboard</h2>
		<div class="row">
			<div class="col-12">
				<div class="card weather-card">
					<div class="card-body pb-3">

						<div class="d-flex justify-content-between">
							<div>
								<h4 class="card-title font-weight-bold">Thank you! Your Package will be delivered soon!</h4>
							<h2>Order Id : {{$order->order_id}}</h2>
							<h2>Amount paid : {{$order->price}}</h2>
							<h2>Order status : {{$order->status}}</h2>
							<h2>Transaction ID : {{$order->transaction_id}}</h2>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
