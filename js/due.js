$(function() {

	var due_vendor_url =  getURL()+'/index.php/ajaxall/';
	$('form.due_purchase_form .vendor').autocomplete({
	        source: function(request, response) {
	           $.ajax(
	                {
	                  url: due_vendor_url,
	                  type: "POST",
	                  dataType: "json",
	                  data:{vendor: request.term, action: "getVendorList"},
	                  success: function(data) 
	                  {
	                    //alert(data);
	                    response( data );
	                 }
	        });
	        },
	        minLength: 1       
	});
	
	
	var due_client_url =  getURL()+'/index.php/ajaxall/';
	$('form.due_sale_form .client').autocomplete({
	        source: function(request, response) {
	           $.ajax(
	                {
	                  url: due_client_url,
	                  type: "POST",
	                  dataType: "json",
	                  data:{client: request.term, action: "getClientList"},
	                  success: function(data) 
	                  {
	                    //alert(data);
	                    response( data );
	                 }
	        });
	        },
	        minLength: 1       
	});	
	
	$('.dueForm .cash, .dueForm .cheque').bind("click",function(){
		
		 if($('input[name=payment_type]:checked', '.dueForm').val()=="cheque"){
		 	 
		 	$('.cheque_data_area').slideDown('slow');	 
			 
		 }else{
			 
			$('.cheque_data_area').slideUp('slow');
			$.each($('.cheque_data_area').find('input'), function(){   $(this).val(''); });
			
			 
		 }
	});	
		

});