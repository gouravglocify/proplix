@extends('layouts.plain')

@section('content')
<div class="d-flex align-items-stretch">
	@include('user.include.sidebar')
    <!-- Page Content  -->
	<div id="content" class="p-4 p-md-5 pt-5 all-report-page">
		<div class="row">
			<div class="col">
				<h3 class="mb-4"><i class="fa fa-product-hunt" aria-hidden="true"></i> Buy Proplix</h3>
			</div>
		</div>
	    <div class="container">
	      <div class="card-deck mb-3 text-center">
	        <div class="card mb-4 box-shadow">
		          <div class="card-header">
		            <h4 class="my-0 font-weight-normal">Apply Promocode</h4>
		          </div>
	          <div class="card-body">
            <form method="POST">
	            	@csrf
						  <div class="form-group">
						    <input type="text" class="form-control" id="promocode" aria-describedby="emailHelp" placeholder="Enter promocode here" name="promocode">
						  </div>
						  <button type="submit"  id="promoform" class="btn btn-lg btn-block btn-primary purchase">Apply Promocode !</button>
						</form>
						<form method="POST" action ="/orders">
							@csrf
							<input type="hidden" name="price" value={{$finalAmount}} id="price">
							<input type="hidden" name="type" value={{$type}} id="type">
							<br>
						  <button type="submit"  class="btn btn-lg btn-block btn-primary purchase">Buy Proplix ( {{ '₹'.$finalAmount }} )</button>
							</form>
	          </div>
        </div>
     </div>
  	</div>
	</div>
</div>
@endsection
