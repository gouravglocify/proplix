
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  		@foreach($reports as $report)
  			<h2 class="mb-1">{{ucwords(strtolower($report->title))}}</h2>
			<p>{{date('F d, Y h:i A',strtotime($report->created_at))}}</p>

			<hr>

			<table class="table table-bordered">
			  <tbody>
			    <tr>
			      <th>Selling Price</th>
			      <td>{{number_format($report->sellingprice,2)}}</td>
			   
			      <th>Product Cost</th>
			      <td>{{number_format($report->productcost,2)}}</td>
			    
			      <th>Orders</th>
			      <td>{{number_format($report->orders,2)}}</td>
			    
			      <th>ROAS</th>
			      <td>{{number_format($report->roas,2)}}</td>
		     	
			      <th>Delivery</th>
			      <td>{{number_format($report->delivery,2)}}</td>
			    </tr>
			    <tr>
			      <th>Remittance</th>
			      <td>{{number_format($report->remittance,2)}}</td>
		    	
			      <th>Ad Cost</th>
			      <td>{{number_format($report->adcost,2)}}</td>
			    
			      <th>Product</th>
			      <td>{{number_format($report->product,2)}}</td>
			    
			      <th>GST</th>
			      <td>{{number_format($report->gst,2)}}</td>
			    
			      <th>Packaging</th>
			      <td>{{number_format($report->packaging,2)}}</td>
			   	
			      
			    </tr>
			    <tr>
				  <th>Shipping</th>
			      <td>{{number_format($report->shipping,2)}}</td>

			      <th>Total Expense</th>
			      <td>{{number_format($report->totalexpense,2)}}</td>
		    	
			      <th>Sale Value</th>
			      <td>{{number_format($report->salevalue,2)}}</td>
			    
			      <th>CPP</th>
			      <td>{{number_format($report->cpp,2)}}</td>
			    
			      <th>Delivered</th>
			      <td>{{number_format($report->delivered,2)}}</td>
			    </tr>
			    <tr>
		    	  <th>Avg. Shipping Cost</th>
			      <td>{{number_format($report->shippingcost,2)}}</td>
			    
			      <th>Avg. RTO charge</th>
			      <td>{{number_format($report->rtocharge,2)}}</td>

			      <th>Weight segment (Gram)</th>
			      <td>{{number_format($report->weightsegment,2)}}</td>
			    
			      <th>GST %</th>
			      <td>{{number_format($report->gstpercentage,2)}}</td>
			    </tr>
			  </tbody>
			</table>
			<hr>
			<table class="table table-bordered">
			  <tbody>
			    <tr>
			      <th>Profit per Delivered*</th>
			      <td>{{number_format($report->profitperdelivered,2)}}</td>
			    </tr>
			    <tr>
			      <th>Total Profit*</th>
			      <td>{{number_format($report->totalprofit,2)}}</td>
			    </tr>
			  </tbody>
			</table>

			<hr/>
			<br>
			<br>

  		@endforeach
  </body>
</html>
