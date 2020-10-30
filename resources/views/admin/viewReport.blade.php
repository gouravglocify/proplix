@extends('admin.include.header')

@section('content')
	<div class="d-flex align-items-stretch">
		
		@include('admin.include.sidebar')
	

	<div id="content" class="pl-5 pr-5 pb-5">
		    <div class="main-container tabel_ft_size">

		        <div class="profit-status">
		          <div class="row all-status top_box">
		            <div class="col one @if($getReportDetails->profitperdelivered<10) active @endif" ref="one">SUICIDE! <br>less than 10</div> 
		            <div class="col two @if($getReportDetails->profitperdelivered>=10 && $getReportDetails->profitperdelivered<=40) active @endif" ref="two">NO! <br>b/w 10 & 40</div>
		            <div class="col three @if($getReportDetails->profitperdelivered>=40 && $getReportDetails->profitperdelivered<=100) active @endif" ref="three">Profit if Quantity <br>b/w 40 & 100</div>
		            <div class="col four @if($getReportDetails->profitperdelivered>=100 && $getReportDetails->profitperdelivered<=200) active @endif" ref="four">Profitable ✔ <br>b/w 100 & 200</div>
		            <div class="col five @if($getReportDetails->profitperdelivered>=200 && $getReportDetails->profitperdelivered<=300) active @endif" ref="five">Very Good✌ <br>b/w 200 & 300</div>
		            <div class="col six @if($getReportDetails->profitperdelivered>=300 && $getReportDetails->profitperdelivered<=400) active @endif" ref="six">Excellent ★ <br>b/w 300 & 500</div>
		            <div class="col seven @if($getReportDetails->profitperdelivered>=400) active @endif" ref="seven">Top of the world!⚡ <br>500+</div>
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
			                      <td><input id="sellingPrice" readonly="readonly"  value="{{$getReportDetails->sellingprice}}"></td>
			                    </tr>
			                    <tr>
			                      <td>Product Cost</td>
			                      <td><input id="productCost" readonly="readonly" value="{{$getReportDetails->productcost}}"></td>
			                    </tr>
			                    <tr>
			                      <td>Orders</td>
			                      <td><input id="orders" readonly="readonly"  value="{{$getReportDetails->orders}}"></td>
			                    </tr>
			                    <tr>
			                      <td>Cancel %</td>
			                      <td><input id="orders" readonly="readonly"  value="{{$getReportDetails->cancel}}"></td>
			                    </tr>
			                    <tr>
			                      <td>ROAS</td>
			                      <td><input id="roas" readonly="readonly" value="{{$getReportDetails->roas}}"></td>
			                    </tr>
			                    <tr>
			                      <td>Delivery %</td>
			                      <td><input id="delivery" readonly="readonly" value="{{$getReportDetails->delivery}}"></td>
			                    </tr>
			                  </tbody>
			                </table>
			            </div>
			        </div>
			        <div class="col-md-12 col-lg-5">
			            <table class="table table-bordered ">
			                <tbody>
			                    <tr>
			                      <th scope="row">Sale Value</th>
			                      <td><label id="saleValue">{{$getReportDetails->salevalue}}</label></td>
			                      <td><label>Order x Selling Price</label></td>
			                    </tr>
			                    <tr>
			                      <th scope="row">Dispatched Order Value</th>
			                      <td><label id="dispatchOrderValue">{{$getReportDetails->dispatchOrderValue}}</label></td>
			                      <td><label>Dispatched Orders X Selling Price</label></td>
			                    </tr>
			                    <tr>
			                      <th scope="row">CPP</th>
			                      <td><label id="cppValue">{{$getReportDetails->cpp}}</label></td>
			                      <td><label>Ad Cost / Orders</label></td>
			                    </tr>
			                    <tr>
			                      <th scope="row">Delivered</th>
			                      <td><label id="delivered">{{$getReportDetails->delivered}}</label></td>
			                      <td><label>Orders x Delivery %</label></td>
			                    </tr>	                   
			                </tbody>
			                <table class="table table-bordered saleValueTable">
			            	<tbody>
		            		 	<tr>
			                      <th class="text-left alert-success" colspan="2">Total Profit*</th>
			                      <td class="text-left alert-success text-right"  id="totalProfit"><label>{{$getReportDetails->totalprofit}}</label></td>
			                    </tr>
			                    <tr>
			                      <th scope="row" colspan="2">Profit per Order*</th>
			                      <td ref="bgChange" id="profitPerOrder" class="text-right">{{$getReportDetails->profitPerOrder}}</td>
			                    </tr>
			                    <tr>
			                      <th scope="row" colspan="2">Profit per Delivered*</th>
			                      <td ref="bgChange" id="profitPerDelivery" class="text-right">{{$getReportDetails->profitperdelivered}}</td>
			                    </tr>
			            	</tbody>
			            </table>
			            </table>
			            
			        </div>
			        <div class="col-md-12 col-lg-4">
			            <table class="table table-striped totalExpensesTab">
			                <tbody>
			                    <tr>
			                      <th>Remittance</th>
			                      <td id="remittance">{{$getReportDetails->remittance}}</td>
			                    </tr>
			                    <tr>
			                      <th class="text-left">Ad Cost</th>
			                      <td class="text-left" id="adCost">{{$getReportDetails->adcost}}</td>
			                    </tr>
			                    <tr>
			                      <th class="text-left">Product</th>
			                      <td class="text-left" id="product">{{$getReportDetails->product}}</td>
			                    </tr>
			                    <tr>
			                      <th class="text-left">GST</th>
			                      <td class="text-left" id="gst">{{$getReportDetails->gst}}</td>
			                    </tr>
			                    <tr>
			                      <th class="text-left">Packaging</th>
			                      <td class="text-left" id="packaging">{{$getReportDetails->packaging}}</td>
			                    </tr>
			                    <tr>
			                      <th class="text-left">Shipping</th>
			                      <td class="text-left" id="shipping">{{$getReportDetails->shipping}}</td>
			                    </tr>
			                    <tr>
			                      <th class="text-left">Total Expense</th>
			                      <td class="text-left" id="totalExpenses">{{$getReportDetails->totalexpense}}</td>
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
			                        <select class="form-control" id="gstPercent" disabled="disabled" >
			                          <option @if($getReportDetails->gstpercentage=='4.76') selected @endif value="4.76">5</option>
			                          <option @if($getReportDetails->gstpercentage=='10.71') selected @endif value="10.71">12</option>
			                          <option @if($getReportDetails->gstpercentage=='15.25') selected @endif value="15.254">18</option>
			                          <option @if($getReportDetails->gstpercentage=='21.88') selected @endif value="21.875">28</option>
			                        </select>
			                      </td>
			                    </tr>
			                    <tr>
			                      <th scope="row">Avg. Shipping Cost</th>
			                      <td><input  readonly="readonly" value="{{$getReportDetails->shippingcost}}" id="avgShippingCost" ></td>
			                    </tr>
			                    <tr>
			                      <th scope="row">Avg. RTO charge</th>
			                      <td><input readonly="readonly" value="{{$getReportDetails->rtocharge}}" id="avgRtoCharge" ></td>
			                    </tr>
			                    <tr>
			                      <th scope="row">Weight segment (Gram)</th>
			                      <td>

			                      	<select class="form-control"  id="weightSegment" disabled="disabled">
						    			@for($i=500; $i<=5000; $i= $i+500)
						    				@if($i==500)
						    					<option @if ($getReportDetails->weightsegment == $i) selected @endif value={{$i}}>{{"< ". $i .' grams'}}</option>
						    				@else
						    					<option @if ($getReportDetails->weightsegment == $i) selected @endif value={{$i}}>{{"< ". ($i/1000) .' KG'}}</option>
						    				@endif
						    			@endfor
							    	</select>
			                    </tr>
			                    
			                </tbody>
			            </table>
			        </div>
			        <div class="col-md-12 col-lg-4">
			        	<div class="allStatus">
				            <div style="display: @if($getReportDetails->profitperdelivered<10) block @else none @endif;" class="col one __top_box suicide activeDiv" ref="one"><span>SUICIDE! <span>less than 10</span> </span>
				            </div>
				            <div style="display: @if($getReportDetails->profitperdelivered>=10 && $getReportDetails->profitperdelivered<=40) block @else none @endif;" class="col two __top_box noBg activeDiv" ref="two">
				            	<span>NO! <span>b/w 10 &amp; 40</span></span></div>
				            <div style="display: @if($getReportDetails->profitperdelivered>=40 && $getReportDetails->profitperdelivered<=100) block @else none @endif;" class="col three __top_box profiQty activeDiv" ref="three">
				            	<span>Profit if Quantity <span>b/w 40 &amp; 100</span> </span>
				            </div>
				            <div style="display: @if($getReportDetails->profitperdelivered>=100 && $getReportDetails->profitperdelivered<=200) block @else none @endif;" class="col four __top_box profiTab activeDiv" ref="four">
				            	<span>Profitable ✔ <span>b/w 100 &amp; 200</span> </span>
				            </div>
				            <div style="display: @if($getReportDetails->profitperdelivered>=200 && $getReportDetails->profitperdelivered<=300) block @else none @endif;" class="col five __top_box goodTab activeDiv" ref="five">
				            	<span>Very Good✌ <span>b/w 200 &amp; 300</span> </span>
				            </div>
				            <div style="display: @if($getReportDetails->profitperdelivered>=300 && $getReportDetails->profitperdelivered<=400) block @else none @endif;" class="col six __top_box excellentTab activeDiv" ref="six">
				            	<span>Excellent ★ <span>b/w 300 &amp; 500</span> </span>
				            </div>
				            <div style="display: @if($getReportDetails->profitperdelivered>=400) block @else none @endif;" class="col seven __top_box WorldTab activeDiv" ref="seven">
				            	<span>Top of the world!⚡ <span>500+</span> </span>
				            </div>
			          	</div>
			      	</div>
			      </div>

			      <div class="row">
			        <div class="col">
			          <input class="form-control form-control-lg" id="reportTitle" placeholder="Enter Report Title..." required value="{{$getReportDetails->title}}" readonly="readonly">
			        </div>
			       
			      </div>
			     
			    </form>
	  		</div>
  	</div>
</div>

@endsection