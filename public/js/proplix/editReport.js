jQuery(document).ready(function(){
	var data = [];
	calculator();
	var calculate = 0;
	jQuery('#submitForm').click(function(event){
		event.preventDefault();
		if(jQuery("#reportTitle").val().trim()===''){
			swal("Alert!", "Please enter report title.", "error");
			return false;
		}
		if(jQuery("#reportTitle").val().trim().length>24){
			swal("Alert!", "Title cannot be greater than 23 characters.", "error");
			return false;
		}
		if(calculate=='0'){
			swal("Alert!", "You changed input values. Before saving you first calculate your report.", "error");
			return false;	
		}
		jQuery.ajax({
			type : 'POST',
			url : APP_URL+'/editReport',
			data : {_token:jQuery('meta[name=csrf-token]').attr("content"),data:data[data.length-1],title:jQuery("#reportTitle").val().trim(),id:jQuery("#reportId").val()},
			success : function(result){
				if(result['success']===false){
					swal("Error", result['message'], "error");
					return false;
				}				
				swal("Success!", result['message'], "success").then(function(){
					location.reload();
				});
			}
		})

	});
	jQuery('select').change(function(){
		// calculator();
	});
	jQuery('input').keyup(function(e){
		if(jQuery(this).attr("id")!=='reportTitle'){
			calculate = 0;
			if(jQuery(this).val().replace(/[^.]/g, "").length<=1){
				jQuery(this).val(jQuery(this).val().replace(/[^0-9.]/g,''));
			}
			else{
				jQuery(this).val(jQuery(this).val().slice(0,-1));
			}
			// calculator();
		}
	});

	jQuery('#calculateReport').click(function(){
		if(jQuery('#sellingPrice').val().trim()!='' && jQuery('#productCost').val().trim()!='' && jQuery('#orders').val().trim()!='' && jQuery('#roas').val().trim()!=''  && jQuery('#delivery').val().trim()!='' ){
			calculator();
			if(subscription==false){	
				jQuery.ajax({
					type : 'POST',
					url : APP_URL + "/addCalculation",
					data : {_token:jQuery('meta[name=csrf-token]').attr("content")},
					success : function(result){	
						if(result<=20){
							jQuery('#calculations').text("Free ( "+(parseInt(20)-parseInt(result))+" Calculations Left)");	
						}			
						if(result>=20){
							swal({
								title: "Limit exceed!",
								text: "You have exceeded your limit 20 Free Calculations Per Month. Please upgrade to get unlimited calculations.",
								icon: "warning",
								button: "Buy Now !"

							}).then(function(){
								window.location.href=APP_URL + "/packages";
							});
						}
						
					}
				});
			}
		}
	});	

	function calculator(){
		var  sellingPrice = jQuery("#sellingPrice").val().trim();
		var  productCost = jQuery("#productCost").val().trim();
		var  orders = jQuery("#orders").val().trim();
		var  roas = jQuery("#roas").val().trim();
		var  delivery = jQuery("#delivery").val().trim();
		var  avgShippingCost = jQuery("#avgShippingCost").val().trim();
		var  avgRtoCharge = jQuery("#avgRtoCharge").val().trim();
		var  weightSegment = jQuery("#weightSegment").val().trim();
		var  gstPercent = jQuery("#gstPercent").val().trim();
		var  cancel = jQuery("#cancel").val().trim();



		datas={'sellingPrice':sellingPrice,'productCost':productCost,'orders':orders,'roas':roas,'delivery':delivery,'avgShippingCost':avgShippingCost,'avgRtoCharge':avgRtoCharge,'weightSegment':weightSegment,'gstPercent':gstPercent,'packagingCost':packagingCost,'cancel':cancel};



		jQuery.ajax({
			type : "POST",
			url : APP_URL+"/calculations",
			data : {_token:jQuery('meta[name=csrf-token]').attr("content"),datas:datas},
			success : function(result){
				jQuery("#saleValue").text(result['saleValue'].toFixed(2));
				jQuery("#adCost").text(result['adCost'].toFixed(2));
				jQuery("#cppValue").text(result['cppValue'].toFixed(2));
				jQuery("#delivered").text(result['delivered'].toFixed(2));
				jQuery("#product").text(result['productCostValue'].toFixed(2));
				jQuery("#remittance").text(result['remittance'].toFixed(2));
				jQuery("#gst").text(result['gst'].toFixed(2));
				jQuery("#packaging").text(result['packaging'].toFixed(2));
				jQuery("#shipping").text(result['shipping'].toFixed(2));
				jQuery("#totalExpenses").text(result['totalExpenses'].toFixed(2));
				jQuery("#totalProfit").text(result['totalProfit'].toFixed(2));
				jQuery("#profitPerOrder").text(result['profitPerOrder'].toFixed(2));
				profitPerDelivery = result['profitPerDelivery'];
			   	jQuery("#profitPerDelivery").text(profitPerDelivery.toFixed(2));
				jQuery("#dispatchOrderValue").text(result['dispatchOrderValue'].toFixed(2));

			   	
	   			//SHOW POPUP ON BASE OF PROFIT PER DELIVERY

	   			if (profitPerDelivery < 10){
			        jQuery(".col").removeClass('active');
			        jQuery(".one").addClass('active');
			        var i = 1;
			        for(j=1;j<=7;j++){
			        	if(i==j){
			        		jQuery('#div_'+j).show();
			        	}
			        	else{
			        		jQuery('#div_'+j).hide();
			        	}
			        } 
		     	}
		      	else if (profitPerDelivery >= 10 && profitPerDelivery <= 40){
			      	jQuery(".col").removeClass('active');
			        jQuery(".two").addClass('active'); 
			        var i = 2;
			        for(j=1;j<=7;j++){
			        	if(i==j){
			        		jQuery('#div_'+j).show();
			        	}
			        	else{
			        		jQuery('#div_'+j).hide();
			        	}
			        } 
		      	}
		      	else if (profitPerDelivery >= 40 && profitPerDelivery <= 100){
			      	jQuery(".col").removeClass('active');
			        jQuery(".three").addClass('active');  
			        var i = 3;
			        for(j=1;j<=7;j++){
			        	if(i==j){
			        		jQuery('#div_'+j).show();
			        	}
			        	else{
			        		jQuery('#div_'+j).hide();
			        	}
			        } 
		      	}
		      	else if (profitPerDelivery >= 100 && profitPerDelivery <= 200){
			      	jQuery(".col").removeClass('active');
			        jQuery(".four").addClass('active'); 
			        var i = 4;
			        for(j=1;j<=7;j++){
			        	if(i==j){
			        		jQuery('#div_'+j).show();
			        	}
			        	else{
			        		jQuery('#div_'+j).hide();
			        	}
			        } 			        
		      	}
		      	else if (profitPerDelivery >= 200 && profitPerDelivery <= 300){
			      	jQuery(".col").removeClass('active');
			        jQuery(".five").addClass('active');  
			        var i = 5;
			        for(j=1;j<=7;j++){
			        	if(i==j){
			        		jQuery('#div_'+j).show();
			        	}
			        	else{
			        		jQuery('#div_'+j).hide();
			        	}
			        }   
		      	}
		      	else if (profitPerDelivery >= 300 && profitPerDelivery <= 500){
			      	jQuery(".col").removeClass('active');
			        jQuery(".six").addClass('active');  
			        var i = 6;
			        for(j=1;j<=7;j++){
			        	if(i==j){
			        		jQuery('#div_'+j).show();
			        	}
			        	else{
			        		jQuery('#div_'+j).hide();
			        	}
			        } 
		      	}
		      	else if (profitPerDelivery > 500){
			      	jQuery(".col").removeClass('active');
			        jQuery(".seven").addClass('active'); 
			        var i = 7;
			        for(j=1;j<=7;j++){
			        	if(i==j){
			        		jQuery('#div_'+j).show();
			        	}
			        	else{
			        		jQuery('#div_'+j).hide();
			        	}
			        } 		        
		      	}
		     	else{
			    	return false;	        
		      	}

		      	data.push({'sellingprice':sellingPrice,'productcost':productCost,'orders':orders,'cancel':cancel,'roas':roas,'delivery':delivery,'salevalue':result['saleValue'],'dispatchOrderValue':result['dispatchOrderValue'],'cpp':result['cppValue'],'delivered':result['delivered'],'profitperdelivered':result['profitPerDelivery'],'totalprofit':result['totalProfit'],'remittance':result['remittance'],'adcost':result['adCost'],'product':result['productCostValue'],'gst':result['gst'],'packaging':result['packaging'],'shipping':result['shipping'],'totalexpense':result['totalExpenses'],'shippingcost':avgShippingCost,'rtocharge':avgRtoCharge,'weightsegment':weightSegment,'gstpercentage':gstPercent,'profitPerOrder':result['profitPerOrder']});
		      	calculate ++;

			}
		});

	}
	
	jQuery(document).on('keypress',function(e) {
	    if(e.which == 13) {
	        jQuery('#calculateReport').trigger("click");
	    }
	});
});