@extends('layouts.plain')

@section('content')
	<div class="d-flex align-items-stretch">

		@include('user.include.sidebar')

        <div id="content" class="pl-5 pr-5 pb-5">
		    <div class="main-container tabel_ft_size">

		        <div class="profit-status">
		          <div class="all-status top_box">
		            <div class="col one __top_box" ref="one">
		            	<span>SUICIDE! <span>less than 10</span> </span>
		            </div>
		            <div class="col two __top_box" ref="two">
		            	<span>NO! <span>b/w 10 & 40</span></div>
		            <div class="col three __top_box" ref="three">
		            	<span>Profit if Quantity <span>b/w 40 & 100</span> </span>
		            </div>
		            <div class="col four __top_box" ref="four">
		            	<span>Profitable ✔ <span>b/w 100 & 200</span> </span>
		            </div>
		            <div class="col five __top_box" ref="five">
		            	<span>Very Good✌ <span>b/w 200 & 300</span> </span>
		            </div>
		            <div class="col six __top_box" ref="six">
		            	<span>Excellent ★ <span>b/w 300 & 500</span> </span>
		            </div>
		            <div class="col seven __top_box" ref="seven">
		            	<span>Top of the world!⚡ <span>500+</span> </span>
		            </div>
		          </div>
		        </div>
	    <!-- form data -->
			    <form  class="form-div" >

			      <div class="row calculator">
			        <div class="col-md-12 col-lg-3">
			            <div class="card">
			                <table class="table questionTab">
			                  <thead>
			                    <tr>
			                      <th scope="col">Question?</th>
			                      <th scope="col">MKC</th>
			                    </tr>
			                  </thead>
			                  <tbody>
			                    <tr>
			                      <td>Selling Price</td>
			                      <td><input id="sellingPrice" ></td>
			                    </tr>
			                    <tr>
			                      <td>Product Cost</td>
			                      <td><input id="productCost"></td>
			                    </tr>
			                    <tr>
			                      <td>Orders</td>
			                      <td><input id="orders" ></td>
			                    </tr>
			                    <tr>
			                      <td>Cancel %</td>
			                      <td><input id="cancel"></td>
			                    </tr>
			                    <tr>
			                      <td>ROAS</td>
			                      <td><input id="roas"></td>
			                    </tr>
			                    <tr>
			                      <td>Delivery %</td>
			                      <td><input id="delivery"></td>
			                    </tr>
			                  </tbody>
			                </table>
			            </div>
			        </div>
			        <div class="col-md-12 col-lg-5">
			            <table class="table table-bordered saleValueTable">
			                <tbody>
			                    <tr>
			                      <th scope="row">Sale Value</th>
			                      <td><label id="saleValue">0</label></td>
			                      <td><label>Order x Selling Price</label></td>
			                    </tr>
			                    <tr>
			                      <th scope="row">Dispatched Order Value</th>
			                      <td><label id="dispatchOrderValue">0</label></td>
			                      <td><label>Dispatched Orders X Selling Price</label></td>
			                    </tr>
			                    <tr>
			                      <th scope="row">CPP</th>
			                      <td><label id="cppValue">0</label></td>
			                      <td><label>Ad Cost / Orders</label></td>
			                    </tr>
			                    <tr>
			                      <th scope="row">Delivered</th>
			                      <td><label id="delivered">0</label></td>
			                      <td><label>Orders x Delivery %</label></td>
			                    </tr>
			                </tbody>
			            </table>
			            <table class="table table-bordered saleValueTable">
			            	<tbody>
			            		<tr>
			                      <th class="text-left alert-success" colspan="2">Total Profit*</th>
			                      <td class="text-left alert-success text-right" id="totalProfit" ><label>0</label></td>
			                    </tr>
			                    <tr>
			                      <th scope="row" colspan="2">Profit per Order*</th>
			                      <td ref="bgChange" id="profitPerOrder" class="text-right" >0</td>
			                    </tr>
			                    <tr>
			                      <th scope="row" colspan="2" >Profit per Delivered*</th>
			                      <td ref="bgChange" id="profitPerDelivery" class="text-right" >0</td>
			                    </tr>
			            	</tbody>
			            </table>
			            
			        </div>
			        <div class="col-md-12 col-lg-4">
			            <table class="table table-striped totalExpensesTab">
			                <tbody>
			                    <tr>
			                      <th>Remittance</th>
			                      <td id="remittance">0</td>
			                    </tr>
			                    <tr>
			                      <th class="text-left">Ad Cost</th>
			                      <td class="text-left" id="adCost">0</td>
			                    </tr>
			                    <tr>
			                      <th class="text-left">Product</th>
			                      <td class="text-left" id="product">0</td>
			                    </tr>
			                    <tr>
			                      <th class="text-left">GST</th>
			                      <td class="text-left" id="gst">0</td>
			                    </tr>
			                    <tr>
			                      <th class="text-left">Packaging</th>
			                      <td class="text-left" id="packaging">0</td>
			                    </tr>
			                    <tr>
			                      <th class="text-left">Shipping</th>
			                      <td class="text-left" id="shipping">0</td>
			                    </tr>
			                    <tr>
			                      <th class="text-left">Total Expense</th>
			                      <td class="text-left" id="totalExpenses">0</td>
			                    </tr>
			                </tbody>
			            </table>
			        </div>
			      </div>

			      <div class="row">
			        <div class="col-md-12 col-lg-8">
			          <table class="table table-bordered">
			                <tbody>
			                	<tr>
			                      <th scope="row">GST %</th>
			                      <td>
			                        <select class="form-control" id="gstPercent" >
			                          <option value="4.76">5</option>
			                          <option value="10.71">12</option>
			                          <option value="15.254">18</option>
			                          <option value="21.875">28</option>
			                        </select>
			                      </td>
			                    </tr>
			                    <tr>
			                      <th scope="row">Avg. Shipping Cost</th>
			                      <td><input  @if(!is_null($getDefaultValues) && !is_null($getDefaultValues->average_shipping_cost)) value="{{$getDefaultValues->average_shipping_cost}}" @else value="100" @endif id="avgShippingCost" ></td>
			                    </tr>
			                    <tr>
			                      <th scope="row">Avg. RTO charge</th>
			                      <td><input @if(!is_null($getDefaultValues) && !is_null($getDefaultValues->average_rto_charge)) value="{{$getDefaultValues->average_rto_charge}}" @else value="100"  @endif id="avgRtoCharge" ></td>
			                    </tr>
			                    <tr>
			                      <th scope="row">Weight segment (Gram)</th>
			                      <td>

			                      	<select class="form-control"  id="weightSegment">
						    			@for($i=500; $i<=5000; $i= $i+500)
						    				@if($i==500)
						    					<option @if(!is_null($getDefaultValues) && !is_null($getDefaultValues->weight_segment) && ($getDefaultValues->weight_segment == $i)) selected @endif value={{$i}}>{{"< ". $i .' grams'}}</option>
					    					@else
						    					<option @if(!is_null($getDefaultValues) && !is_null($getDefaultValues->weight_segment) && ($getDefaultValues->weight_segment == $i)) selected @endif value={{$i}}>{{ ($i/1000) .' KG'}}</option>
						    				@endif
						    			@endfor
							    	</select>
			                    </tr>
			                    
			                </tbody>
			            </table>
			        </div>
			        <div class="col-md-12 col-lg-4">
			        	<div class="allStatus">
				            <div style="display: none;" class="col one __top_box suicide activeDiv" id="div_1"><span>SUICIDE! <span>less than 10</span> </span>
				            </div>
				            <div style="display: none;" class="col two __top_box noBg activeDiv" id="div_2">
				            	<span>NO! <span>b/w 10 &amp; 40</span></span></div>
				            <div style="display: none;" class="col three __top_box profiQty activeDiv" id="div_3">
				            	<span>Profit if Quantity <span>b/w 40 &amp; 100</span> </span>
				            </div>
				            <div style="display: none;" class="col four __top_box profiTab activeDiv" id="div_4">
				            	<span>Profitable ✔ <span>b/w 100 &amp; 200</span> </span>
				            </div>
				            <div style="display: none;" class="col five __top_box goodTab activeDiv" id="div_5">
				            	<span>Very Good✌ <span>b/w 200 &amp; 300</span> </span>
				            </div>
				            <div style="display: none;" class="col six __top_box excellentTab activeDiv" id="div_6">
				            	<span>Excellent ★ <span>b/w 300 &amp; 500</span> </span>
				            </div>
				            <div style="display: none;" class="col seven __top_box WorldTab activeDiv" id="div_7">
				            	<span>Top of the world!⚡ <span>500+</span> </span>
				            </div>
				          </div>
					      </div>
					  </div>

			      <div class="row">
			        <div class="col">
			          <input class="form-control form-control-lg" id="reportTitle" placeholder="Enter Report Title..." required>
			        </div>
			        <div class="col">
			          <button class="btn btn-outline-secondary btn-block btn-lg" type="button" id='submitForm'>
			            <i class="fa fa-floppy-o mr-3"></i>Save Report
			          </button>
			        </div>

			        @if(is_null($getUserSubscription) && (is_null($getCaluationshit) ||  count($getCaluationshit)<20))
			        	<div class="col">
				          <button type="button" class="btn btn-outline-secondary btn-block btn-lg" id='calculateReport'>
				            <i class="fa fa-calculator" aria-hidden="true"></i>  Calculate Report
				          </button>
				        </div>
			        @elseif(!is_null($getUserSubscription) && $getUserSubscription->status!='active' )
			        	<div class="col">
				          <button type="button" class="btn btn-outline-secondary btn-block btn-lg" id='calculateReport'>
				            <i class="fa fa-calculator" aria-hidden="true"></i>  Calculate Report
				          </button>
				        </div>
			        @elseif(!is_null($getUserSubscription) && $getUserSubscription->status=='active' )
			        	<div class="col">
				          <button type="button" class="btn btn-outline-secondary btn-block btn-lg" id='calculateReport'>
				            <i class="fa fa-calculator" aria-hidden="true"></i>  Calculate Report
				          </button>
				        </div>
			        @else
			        	<div class="col">
				          <a href="{{url('packages')}}" class="btn btn-outline-secondary btn-block btn-lg" >
				            <i class="fa fa-product-hunt" aria-hidden="true"></i>  Buy Proplix
				          </a>
				        </div>
			        @endif

			      </div>
			    </form>
	  		</div>
  	</div>
</div>
<script type="text/javascript">
	var packagingCost = 100;
	@if(!is_null($getDefaultValues) && !is_null($getDefaultValues->packaging_cost))
		var packagingCost = "{{$getDefaultValues->packaging_cost}}"
	@endif
	var subscription = false;
	@if(!is_null($getUserSubscription) && $getUserSubscription->status=='active')
	var subscription = true;
	@endif
</script>
<script src="{{asset('/js/proplix/calculator.js')}}"></script>
@endsection
