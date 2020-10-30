jQuery(document).ready(function(){
	jQuery('.selectAll').change(function(){
		if(jQuery(this).prop('checked')===true){
			jQuery(".checkbox").prop("checked",true);
		}
		else{
			jQuery(".checkbox").prop("checked",false);
		}
	});

	jQuery('.downloadAllReports').click(function(){
		var data = [];
		jQuery('.checkbox').each(function () {
			if(jQuery(this).prop("checked")===true){	
		    	data.push(jQuery(this).val());
			}
		});
		if(data.length>0){
			jQuery('#ids').val(data);
			jQuery('#type').val(jQuery(this).attr("id"));
			jQuery("#downloadReports").submit();
		}
	});
})