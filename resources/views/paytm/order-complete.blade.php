@extends('layouts.plain')

@section('content')
<div class="d-flex align-items-stretch">
	@include('user.include.sidebar')
<div class="d-flex align-items-stretch">
    <div class="container">
        <h1>Thank you!! Your Package will be delivered soon</h1>
    <p>Order Id : {{$order->order_id}}</p>
    <p>Amount paid : {{$order->price}}</p>
    <p>Order status : {{$order->status}}</p>
    <p>Transaction ID : {{$order->transaction_id}}</p>
    </div>
</div>
</div>
@endsection
