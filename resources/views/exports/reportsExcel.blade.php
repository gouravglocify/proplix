<table  style="font-size: 11px; border: 2px solid black;" >
    <thead >
    <tr class="head">
        <th>S. NO</th>
        <th>Title</th>
        <th>Selling Price</th>
        <th>Product Cost</th>
        <th>Orders</th>
        <th>Cancel %</th>
        <th>ROAS</th>
        <th>Delivery</th>
        <th>Sale Value</th>
        <th>Dispatched Order Value</th>
        <th>CPP</th>
        <th>Delivered</th>
        <th>Profit Per Delivery</th>
        <th>Total Profit</th>
        <th>Remittance</th>
        <th>Ad Cost</th>
        <th>Product</th>
        <th>GST</th>
        <th>Packaging</th>
        <th>Shipping</th>
        <th>Total Expense</th>
        <th>Shipping Cost</th>
        <th>RTO Charge</th>
        <th>Weight Segment</th>
        <th>GST Percentage</th>
        <th>Created Date</th>
    </tr>
    </thead>
    <tbody>
    @php $i=1; @endphp
    @foreach($reports as $report)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ ucwords(strtolower($report->title)) }}</td>
            <td>{{ $report->sellingprice }}</td>
            <td>{{ $report->productcost }}</td>
            <td>{{ $report->orders }}</td>
            <td>{{ $report->cancel }}</td>
            <td>{{ $report->roas }}</td>
            <td>{{ $report->delivery }}</td>
            <td>{{ $report->salevalue }}</td>
            <td>{{ $report->dispatchOrderValue }}</td>
            <td>{{ $report->cpp }}</td>
            <td>{{ $report->delivered }}</td>
            <td>{{ $report->profitperdelivered }}</td>
            <td>{{ $report->totalprofit }}</td>
            <td>{{ $report->remittance }}</td>
            <td>{{ $report->adcost }}</td>
            <td>{{ $report->product }}</td>
            <td>{{ $report->gst }}</td>
            <td>{{ $report->packaging }}</td>
            <td>{{ $report->shipping }}</td>
            <td>{{ $report->totalexpense }}</td>
            <td>{{ $report->shippingcost }}</td>
            <td>{{ $report->rtocharge }}</td>
            <td>{{ $report->weightsegment }}</td>
            <td>{{ $report->gstpercentage }}</td>
            <td>{{ date('F d, Y h:i A',strtotime($report->created_at)) }}</td>
        </tr>
    @php $i++; @endphp    
    @endforeach
    </tbody>
</table>