<?php $student_admission_status = ""; $student_application_reference_no=""; $student_app_submitted_datetime=""; ?>
<script type="text/javascript">

$(document).ready(function(){

	$(".rejected-reason-list").hide();
      
   

		
  var funding = $('select[name=student_funding_type]').val();
  if(funding == "Student Loan" ) {
  	  
      $("#fundingoption").fadeIn();
      
      $('#fundingoption3').fadeOut();
      $('input[name=student_funding_type_other]').val("");
      
  }else if(funding == "Other" ){
      
       $('#fundingoption3').fadeIn();
       $("#fundingoption").fadeOut();
       $("#fundingoption2").fadeOut(); 
       $('select[name=student_student_loan_applied_for_the_proposed_course]').val("no"); 
       $('select[name=student_already_in_receipt_of_funds]').val("no");   
  }else {
      $("#fundingoption").fadeOut();$("#fundingoption2").fadeOut();
      $('#fundingoption3').fadeOut();
      $('select[name=student_student_loan_applied_for_the_proposed_course]').val("no");
      $('input[name=student_funding_type_other]').val("");
  }



	$('.add-new-agreement').click(function(){
	
		var student_type = "<?php echo $user_data['student_type']; ?>";
		
		if(student_type==""){
			$('#warningModal .modal-body').html("Please select student type first.");
			$('#warningModal').modal('show');	
		}else{
			$('#addNewAgreement').modal('show');
		}
		
				
		
	}); 
    var count=1;    	
	$('.add-installment-row').click(function(){
        
		//var remaining_amount = parseFloat($('.remaining-amount').text());
        //var row_data = $('.installment-row-demo-area').html();
		var row_data ='<div class="installment-row"><div class="col-sm-5 no-pad-left"><input type="text" id="form-input-dt'+count+'" class="installment_date form-control date" name="installment_date[]"></div><div class="col-sm-5"><input type="text" class="amount form-control" name="amount[]"></div><div class="col-sm-2 no-pad-right text-right"><a href="#" class="btn btn-danger del-row"><i class="fa fa-times-circle"></i></a></div><p class="clearfix"></p></div>';
		$('.installment-data-area').append(row_data);
        $("#form-input-dt"+count).datepicker({ dateFormat: "dd-mm-yy" });
		del_row_function(); getDateFormat(); calculateRemaining();
		count++;
	});
	
	$('.year').change(function(){
		
		if($(this).val()>""){
			var slc_coursecode_arr = [];
<?php
			$i=0;
			foreach($agreement_data['slc_coursecode_data'] as $k=>$v){
				//echo"slc_coursecode_arr[".$i."]['year'] = '".$v['year']."';";
				//echo"slc_coursecode_arr[".$i."]['slc_code'] = '".$v['slc_code']."';";
				echo"slc_coursecode_arr.push(['".$v['year']."','".$v['slc_code']."']);";
				$i++;	
			}							
?>	
			var i;
			for (i = 0; i < slc_coursecode_arr.length; i++) {
			    if(slc_coursecode_arr[i][0]==$(this).val()) { $('.slc_code').val(slc_coursecode_arr[i][1]);  }//alert('yes!! matched.');
			}					
		}
	});
	
	
	$('.discount').bind('keyup blur',function(){
		
			var amount = 0;
			$.each($('.installment-data-area').find('.amount'),function(){
				
				amount += parseFloat($(this).val()); 
			
			});
			
			var fees = parseFloat($('.fees').val());
			var discount = parseFloat($('.discount').val());
			//alert(amount);
			if(amount=="NaN") amount = 0;
			
			var remain = fees - discount - amount;
			
			$('.remaining-amount').html(remain); 
			
			if($('.remaining-amount').html()>"") $('.remaining-amount').html($('.remaining-amount').html()); 
			else 
			$('.remaining-amount').html(fees - discount);
			
			if(remain<=0) $('.add-installment-row').hide();
			else $('.add-installment-row').show();		
		
		
	});
	
	
	$('.addAgreementBtn').click(function(){
		
		var remain = parseFloat($('.remaining-amount').html());	
		
		if(remain==0 && $('.agreement-date').val()>""){
			
			//alert(remain);
			
			var installment_date_arr = []; 
			var amount_arr = [];

			$.each($('.installment-data-area').find('.amount'),function(){
				
				amount_arr.push($(this).val()); 
			
			});
			
			$.each($('.installment-data-area').find('.installment_date'),function(){
				
				installment_date_arr.push($(this).val()); 
			
			});	
			
			var course_relation_id = $('.course_relation_id').val();					
			var slc_coursecode = $('.slc_code').val();					
			var year = $('.year').val();					
			var fees = $('.fees').val();					
			var register_id = $('.register_id').val();					
			//var register_id = $('.register_id').val();					
			var installment_number = installment_date_arr.length;					
			var discount = $('.discount').val();					
			var agreement_date = $('.agreement-date').val();					

			//alert(course_relation_id);
			
			
				url = getURL()+'/index.php/ajaxall/';
				$.ajax({
				   type: "POST",
				   data: {action: "studentManagementNewAgreement", 
				   			course_relation_id:course_relation_id, 
				   			slc_coursecode:slc_coursecode, 
				   			year:year, 
				   			fees:fees, 
				   			register_id:register_id, 
				   			installment_number:installment_number, 
				   			discount:discount, 
				   			amount_arr:amount_arr, 
				   			installment_date_arr:installment_date_arr,
				   			agreement_date:agreement_date
				   },
				   url: url,
				   success: function(msg){
				     $('#addNewAgreement .output').show();
				     $('.remaining-amount').css('border','');
				     $('#addNewAgreement .output').html(msg).fadeOut( 2000 ,function(){ window.location = '<?php echo current_url(); ?>'; });
				     
				   }
				});					
			 
		}else{
			$('#addNewAgreement .output').show();
			$('.remaining-amount').css('border','5px solid #FF9A9A');
			$('#addNewAgreement .output').html("<div class=\"alert alert-danger\"><p><span class=\"fa fa-check\"></span> Remaining amount should be zero(0).</p></div>").fadeOut(4000);	
			
			
		}
		
	});
	
	
	$('.add-new-payment').click(function(){
		
		//alert('yes');
		$('#addNewPayment').modal('show');

				
				url = getURL()+'/index.php/ajaxall/';
				$.ajax({
				   type: "POST",
				   data: {
				   	   action: "studentManagementNewPaymentGenerateInvoice"
				   },
				   url: url,
				   success: function(msg){
				     
				      $('#addNewPayment .invoice_no').val(msg);
				     
				   }
				});
		
	});
	
	$('.addPaymentBtn').click(function(){
		
		var invoice_no = $('#addNewPayment .invoice_no').val();
		var payment_mode = $('#addNewPayment .payment_mode').val();
		var payment_date = $('#addNewPayment .payment_date').val();
		var amount = $('#addNewPayment .amount').val();
		var remarks = $('#addNewPayment .remarks').val();
		var register_id = $('#addNewPayment .register_id').val();
		var agreement_id = $('#addNewPayment .agreement_id').val();
		var payment_description = $('#addNewPayment .payment_description').val();
		var active_payment = $('#addNewPayment .active_payment:checked').val();
		//alert(active_payment);
		if(invoice_no>"" && payment_mode>"" && payment_date>"" && amount>""){
			
				url = getURL()+'/index.php/ajaxall/';
				$.ajax({
				   type: "POST",
				   data: {action: "studentManagementNewPayment", 
				   			invoice_no:invoice_no, 
				   			payment_mode:payment_mode, 
				   			payment_date:payment_date, 
				   			amount:amount, 
				   			remarks:remarks,
				   			register_id:register_id,
				   			agreement_id:agreement_id,
				   			payment_description:payment_description,
				   			active_payment:active_payment
				   },
				   url: url,
				   success: function(msg){
				     
				      $('#addNewPayment .output').html(msg).fadeOut( 2000 ,function(){ window.location = '<?php echo current_url(); ?>'; });
				     
				   }
				});		
		}
		
	});
	
	$('.refund-btn').click(function(){
		
		//alert($(this).attr('money_receipt_id'));

		var money_receipt_id = $(this).attr('money_receipt_id');
		
		$('#refundPayment .refund_money_receipt_id').val(money_receipt_id);
		
		 $('#refundPayment').modal('show');
		
		
				/*url = getURL()+'/index.php/ajaxall/';
				$.ajax({
				   type: "POST",
				   data: {action: "studentManagementPaymentRefund", 
				   			money_receipt_id:money_receipt_id
				   },
				   url: url,
				   success: function(msg){
				     //$('#addNewPayment').modal('hide');
				     $('.msg').html(msg);
				     //alert(msg);
				     setTimeout(function(){ window.location = '<?php echo current_url(); ?>'; }, 2000);
				     
				   }
				});*/		
		
		
	});
	
	$('#refundPayment .refundPaymentbtn').click(function(){
		
		var money_receipt_id = $('#refundPayment .refund_money_receipt_id').val();
		var refund_date = $('#refundPayment .refund_date').val();
		var refund_reason = $('#refundPayment .refund_reason').val();
		var refund_admin_fee = $('#refundPayment .refund_admin_fee').val();
		
		if(money_receipt_id>"" && refund_date>"" && refund_reason>""){
			
				url = getURL()+'/index.php/ajaxall/';
				$.ajax({
				   type: "POST",
				   data: {action: "studentManagementPaymentRefund", 
				   			money_receipt_id:money_receipt_id,
				   			refund_date:refund_date,
				   			refund_reason:refund_reason,
				   			refund_admin_fee:refund_admin_fee
				   },
				   url: url,
				   success: function(msg){
				     
				     $('#refundPayment .output').html(msg).fadeOut( 2000 ,function(){ window.location = '<?php echo current_url(); ?>'; });
				     
				   }
				});			
			
		}
		
	});
	
	$('.edit-account-agreement').click(function(){
		
		//$('#editAgreement').modal('show');
		var agreement_id = $(this).attr("agreement_id");
		
				url = getURL()+'/index.php/ajaxall/';
				$.ajax({
				   type: "POST",
				   data: {action: "getAgreementDataForEdit", 
				   			agreement_id:agreement_id
				   },
				   url: url,
				   success: function(msg){
				     //$('#addNewPayment').modal('hide');
				     //$('#refundPayment').modal('hide');
				     $('.msg').html(msg);
				     $('#editAgreement').modal('show');
				     //alert(msg);
				     //setTimeout(function(){ window.location = '<?php //echo current_url(); ?>'; }, 2000);
				     
				   }
				});		
		
		
	});
	
	$('#editAgreement .editAgreementBtn').click(function(){
		
		var slc_coursecode = $('#editAgreement .ea_slc_coursecode').val();
		var year = $('#editAgreement .ea_year').val();
		var date = $('#editAgreement .ea_date').val();
		var discount = $('#editAgreement .ea_discount').val();
		var fees = $('#editAgreement .ea_fees').val();
		var id = $('#editAgreement .ea_id').val();

		if(date>"" && fees>"" && id>""){
			
				url = getURL()+'/index.php/ajaxall/';
				$.ajax({
				   type: "POST",
				   data: {action: "updateAgreementOfAccount", 
				   			id:id,
				   			fees:fees,
				   			discount:discount,
				   			date:date,
				   			year:year,
				   			slc_coursecode:slc_coursecode
				   },
				   url: url,
				   success: function(msg){
				     
				     $('#editAgreement .output').html(msg).fadeOut( 2000 ,function(){ window.location = '<?php echo current_url(); ?>'; });
				     
				   }
				});
			
		}
		
	});
	
	$('.edit-installment').click(function(){
		
		var agreement_id = $(this).attr('agreement_id');
		
				url = getURL()+'/index.php/ajaxall/';
				$.ajax({
				   type: "POST",
				   data: {action: "getInstallmentDataForEdit", 
				   			agreement_id:agreement_id,
				   },
				   url: url,
				   success: function(msg){
				     //$('#addNewPayment').modal('hide');
				     //$('#refundPayment').modal('hide');
				     $('#editPaymentPlan .agreement_id').val(agreement_id);
				     $('#editPaymentPlan .payment-plan-row-area').html(msg);
				     $('#editPaymentPlan').modal('show');
				     //alert(msg);
				     //setTimeout(function(){ window.location = '<?php //echo current_url(); ?>'; }, 2000);
				     
				   }
				});	
				
				//alert(agreement_id);  
				
				//$('#editPaymentPlan').modal('hide');	  
                
				//$('#editPaymentPlan2').modal('toggle');	
		
		
		
	});   
	
	$('.addNewEditPaymentRow').click(function(){
		
		$(".payment-plan-row-area").append('<div class="edit-payment-row"><div class="col-sm-5 no-pad-left"><input type="text" class="edit_payment_date form-control date" name="edit_payment_date[]"></div><div class="col-sm-5"><input type="text" class="edit_payment_amount form-control" name="edit_payment_amount[]"></div><div class="col-sm-2 no-pad-right text-right"><a href="#" class="btn btn-danger edit-payment-del-row"><i class="fa fa-times-circle"></i></a></div><p class="clearfix"></p></div>');
        $(".date").datepicker({ dateFormat: "dd-mm-yy" });
		calculateEditPaymentRemain(); removeEditPaymentRow(); calculate_edit_payment_amount_change();		
	});
	
	$('.editPaymentPlanBtn').click(function(){
		
			var remain = parseFloat($('.editPaymentPlan-remaining-amount').html());
			
			if(remain==0){
				
				var installment_date_arr = []; 
				var amount_arr = [];				

				$.each($('.payment-plan-row-area').find('.edit_payment_date'),function(){
					
					installment_date_arr.push($(this).val()); 
				
				});
				
				$.each($('.payment-plan-row-area').find('.edit_payment_amount'),function(){
					
					amount_arr.push($(this).val()); 
				
				});
				
				var agreement_id = $('#editPaymentPlan .agreement_id').val();
                //alert(agreement_id);
				
				url = getURL()+'/index.php/ajaxall/';
				$.ajax({
				   type: "POST",
				   data: {action: "studentManagementUpdateInstallment", 
				   			agreement_id:agreement_id, 
				   			installment_date_arr:installment_date_arr, 
				   			amount_arr:amount_arr
				   },
				   url: url,
				   success: function(msg){
				     //$('#editPaymentPlan').modal('hide');
				     $('#editPaymentPlan .output').show();
				     $('.editPaymentPlan-remaining-amount').css('border','');
				     $('#editPaymentPlan .output').html(msg).fadeOut( 2000 ,function(){ window.location = '<?php echo current_url(); ?>'; });
				     //alert(msg);
				     
				     
				   }
				});				
				
			}else{
				
				$('#editPaymentPlan .output').show();
				$('.editPaymentPlan-remaining-amount').css('border','5px solid #FF9A9A');
				$('#editPaymentPlan .output').html("<div class=\"alert alert-danger\"><p><span class=\"fa fa-check\"></span> Remaining amount should be zero(0).</p></div>").fadeOut(4000);				
				
			}					
		
	});	


    
});

function del_row_function(){
	$('.del-row').click(function(){
		//alert('hi');
		$(this).closest('.installment-row').remove();
		autoCalculateRemaining();
	});	
}
function getDateFormat(){
		
}

function calculateRemaining(){

	$('.installment-data-area .amount').bind('keyup blur',function(){
			
			var amount = 0;
			$.each($('.installment-data-area').find('.amount'),function(){
				
				amount += parseFloat($(this).val()); 
			
			});
			
			var fees = parseFloat($('.fees').val());
			var discount = parseFloat($('.discount').val());
			//alert(amount);
			if(amount=="NaN") amount = 0;
			
			var remain = fees - discount - amount;
			
			$('.remaining-amount').html(remain); 
			
			if($('.remaining-amount').html()>"") $('.remaining-amount').html($('.remaining-amount').html()); 
			else 
			$('.remaining-amount').html(fees - discount);
			
			if(remain<=0) $('.add-installment-row').hide();
			else $('.add-installment-row').show(); 		
		
	});	
	
}

function autoCalculateRemaining(){
	
			var amount = 0;
			$.each($('.installment-data-area').find('.amount'),function(){
				
				amount += parseFloat($(this).val()); 
			
			});
			
			var fees = parseFloat($('.fees').val());
			var discount = parseFloat($('.discount').val());
			//alert(amount);
			if(amount=="NaN") amount = 0;
			
			var remain = fees - discount - amount;
			
			$('.remaining-amount').html(remain); 
			
			if($('.remaining-amount').html()>"") $('.remaining-amount').html($('.remaining-amount').html()); 
			else 
			$('.remaining-amount').html(fees - discount);
			
			if(remain<=0) $('.add-installment-row').hide();
			else $('.add-installment-row').show();
	
}

function calculateEditPaymentRemain(){
	var total = parseFloat($('.editPaymentPlan_total_amount').val());  //alert(total);
	var t_total = 0;
	$.each($('.payment-plan-row-area .edit-payment-row').find('.edit_payment_amount'),function(){
		var edit_payment_amount = $(this).val();
		if(edit_payment_amount>"") t_total += parseFloat($(this).val());
		else t_total += 0;
		
		
	});
	//alert(t_total);
	var remain = total - t_total;
	
	$('.editPaymentPlan-remaining-amount').html(remain.toFixed(2));
	
	if(remain<=0){
		$('.addNewEditPaymentRow').hide();
	}else{
		$('.addNewEditPaymentRow').show();
	}
	
}

function removeEditPaymentRow(){
	
	$('.edit-payment-del-row').click(function(){
		
		$(this).closest('.edit-payment-row').remove();
		calculateEditPaymentRemain();
	});
}

function calculate_edit_payment_amount_change(){
	
	  $('.edit_payment_amount').bind("keyup blur",function(){
		  
		 calculateEditPaymentRemain();
		 //alert($(this).val()); 
		  
	  });
}


</script>
<!--<pre><?php //var_dump($agreement_data); ?></pre>-->

                
                <!--<div class="row">
	                
	                <div class="col-lg-12" style="padding-top: 10px;">
                    <?php if($message!="") {                
	                	 //echo $message;

                     } ?>
	                </div>
	                
                </div> -->               

                <div id="formbox" class="clearfix">
                    
                    
                    <form role="form" id="registerinfo"  class='formsreg'  method="post" action="?action=singleview&do=application&id=<?php echo $ref_id; ?>">
                    
		                <div class="col-lg-12">
			                <div class="row">
                            
				                <div class="col-sm-12 text-right">
				                	<img src="<?php echo base_url(); ?>images/loading.gif" class="loading">
                                     <!--<a href="<?php //echo base_url(); ?>index.php/print_student_app/?id=<?php //echo $user_data['id']; ?>" class="btn btn-sm btn-primary "><i class="fa fa-print"></i> Print</a>-->
                         			<?php //if(!empty($staff_privileges_student_admission['std_ad_edit_app']) || $this->session->userdata('label')=="admin"){ ?>
                         				<!--<button type="button" class="btn btn-sm btn-success register-personal-info-submit"><i class="fa fa-save"></i> Update </button>-->
                         			<?php //} ?>
					            	<?php if(!empty($priv[27]) || $this->session->userdata('label')=="admin"){ ?><button type="button" class="btn btn-sm btn-warning add-new-agreement"><i class="fa fa-plus"></i> Add New Agreement </button><?php } ?>
					            	<?php if(!empty($priv[28]) || $this->session->userdata('label')=="admin"){ ?><button type="button" class="btn btn-sm btn-info add-new-payment"><i class="fa fa-plus"></i> Add New Payment </button><?php } ?>
					            </div>	   
				             </div> 
                             <div class="msg"></div>
                             
                             <div class="divider"></div>  
				             <div class="form-group">
				               <h4><i class="fa fa-user "></i> Agreement Details </h4>
				               <p class="divider"></p>
				             </div>                             

				             
<?php
							if(!empty($prev_agreement_list) && count($prev_agreement_list)>0){
								$i=1;
								foreach($prev_agreement_list as $v){
?>								

				                      <div class="form-group clearfix">  
											<div class="panel panel-info">
												<div class="panel-heading col-sm-12 no-pad">
													<div class="col-sm-6">
														<h3 class="panel-title">Agreement <?php echo $i; ?></h3>
													</div>	
													<div class="col-sm-6 text-right">
														<?php if(!empty($priv[29]) || $this->session->userdata('label')=="admin"){ ?><button type="button" class="btn btn-sm btn-primary edit-account-agreement" agreement_id="<?php echo $v['id']; ?>">Edit</button><?php } ?>
													</div>													
													<div class="clearfix"></div>
												</div>
												<div class="clearfix"></div>
												<div class="panel-body"> 
													<table class="table table-bordered">
														<thead>
															<tr>
<?php
								if($user_data['student_type']!="overseas"){                      				
?>															
																<th>SLC COURSE CODE</th>
																<th>Year</th>
<?php
								}                      				
?>																
																<th>No Of Installment</th>
																<th>Fees</th>																
																<th>Discount</th>
																<th>Total Amount</th>
																<th>Agreement Date</th>
																<th>Agreement By</th>
															</tr>
														</thead>
														<tbody>
															<tr>
<?php
								if($user_data['student_type']!="overseas"){                      				
?>															
																<td><?php echo $v['slc_coursecode']; ?></td>
																<td><?php echo $v['year']; ?></td>
<?php
								}                      				
?>																
																<td><?php echo $v['installment_number']; ?></td>
																<td><?php echo sprintf("%0.2f",$v['fees']); ?></td>
																<td><?php echo sprintf("%0.2f",$v['discount']); ?></td>
																<td><?php echo sprintf("%0.2f",$v['total_amount']); ?></td>
																<td><?php echo date("d-m-Y",strtotime($v['date'])); ?></td>
																<td><?php echo $this->staff->get_name($v['staff_id']); ?></td>
															</tr>
														</tbody>
													</table>
													<div class="col-sm-12 due-alert-body no-pad">
														
														
													</div>
													<div class="col-sm-12 no-pad">
													
														<div class="col-sm-4 no-pad-left">
															
															<div class="panel panel-info">
																<div class="panel-heading col-sm-12 no-pad">
																	<div class="col-sm-6">
																		<h3 class="panel-title">Payment Plan</h3>
																	</div>	
																	<div class="col-sm-6 text-right">																																		
																		<?php if(!empty($priv[34]) || $this->session->userdata('label')=="admin"){ ?><button type="button" class="btn btn-sm btn-primary edit-installment" agreement_id="<?php echo $v['id']; ?>" >Edit</button><?php } ?>
																	</div>													
																	<div class="clearfix"></div>
																</div>
																<div class="clearfix"></div>
																<div class="panel-body">
																	<table class="table table-bordered">
																		<thead>
																			<tr>
																				<th>Payment Date</th>
																				<th>Amount</th>
																				<th>Paid</th>
																			</tr>
																		</thead>
																		<tbody>
<?php

													$installment_list = $this->installment->get_by_agreement_id($v['id']);
													$money_receipt_data = $this->money_receipt->get_all_by_register_id($agreement_data['register_id']);													
													$total = 0; //$total += $d['amount'];
													foreach($money_receipt_data as $m){
														//$chk_if_this_refund = $this->money_receipt->chk_if_refund($m['invoice_no'],$m['register_id']);
														if($m['payment_description']!="Refund" && $m['agreement_id']==$v['id'] && $m['active_payment']!="no") $total += $m['amount'];
													}
													
													$refund_data = $this->money_receipt->get_all_refund_by_register_id_and_agreement_id($agreement_data['register_id'],$v['id']);													
													
													$refund_amount = 0;
													if(!empty($refund_data) && $refund_data>0){
														foreach($refund_data as $c=>$d){

															$refund_amount += $d['amount'];				
															
														}
													}													
													
													$t_amount = 0; $due_remain = 0;
													foreach($installment_list as $d){
														
														echo "<tr>
																<td>".date("d-m-Y",strtotime($d['installment_date']))."</td>
																<td>".sprintf("%0.2f",$d['amount'])."</td>
																<td align='center'>";
																
																$t_amount += $d['amount'];
																//var_dump($total);
																	if( ($total - $refund_amount) >= $t_amount ){
																		echo'<i class="fa fa-check-square" style="color:green;font-size:1.2em"></i>';	
																	}else{
																		echo'<i class="fa fa-times-circle-o" style="color:red;font-size:1.2em"></i>';
																	}
																	
																	if(strtotime(date("d-m-Y")) > strtotime($d['installment_date'])){ $due_remain+=$d['amount']; }	
														   echo"</td>
															</tr>";
														
													}
													

													
													$due = $due_remain - $total + $refund_amount;
													//var_dump($total);
													if($due>0){echo'<script>$(".due-alert-body").html("<div class=\'alert alert-danger\' role=\'alert\'><i class=\'fa fa-info-circle\'></i> Due Remain - '.sprintf("%0.2f",$due).'</div>");</script>';}
																																	
?>																			
																		</tbody>
																	</table>																
																</div>																																									
															</div>																
																
																															
														</div>
														<div class="col-sm-8 no-pad-right">
															<div class="panel panel-info">
																<div class="panel-heading">
																	<h3 class="panel-title">Payments</h3>
																</div>
																<div class="panel-body">
<?php																
/*																			foreach(){
																				
																			} */
?>																
																	<table class="table table-bordered">
																		<thead>
																			<tr>
																				<th>Invoice</th>
																				<th>Date</th>
																				<th>Amount</th>																
																				<th>Method</th>
																				<th>Received By</th>
																				<th>Description</th>
																				<th>Print</th>
																			</tr>
																		</thead>
																		<tbody>

<?php
																		if(!empty($payment_data) && count($payment_data)>0){	
																			foreach($payment_data as $a=>$b){
																				//echo"alert('payment_mode: ".$b['payment_mode']."');";
																				//echo"<pre>";
																				//var_dump($b);
																				//echo"</pre>";
																				if($b['agreement_id'] == $v['id'] && $b['payment_description']!="Refund"){
																					
																					//$chk_if_this_refund = $this->money_receipt->chk_if_refund($b['invoice_no'],$b['register_id']);
																					//if(!$chk_if_this_refund){
																							if($b['payment_mode']==1) $payment_mode = "Cash";
																							if($b['payment_mode']==2) $payment_mode = "Bank Transfer";
																							if($b['payment_mode']==3) $payment_mode = "Card";
																							if($b['payment_mode']==4) $payment_mode = "Demand Draft";
																							if($b['payment_mode']==5) $payment_mode = "Cheque";
																							echo"<tr data-toggle='tooltip' data-placement='top' title='Remarks: ".tinymce_decode($b['remarks'])."'>
																							
																								<td>".$b['invoice_no']."</td>
																								<td>".date("d-m-Y",strtotime($b['payment_date']))."</td>
																								<td>".sprintf("%0.2f",$b['amount'])."</td>
																								<td>".$payment_mode."</td>
																								<td>".$this->staff->get_name($b['received_by_staff'])."</td>
																							    <td>".$b['payment_description']."</td>";
																							if(!empty($priv[34]) || $this->session->userdata('label')=="admin") 
                                                                                                echo"<td><a class='btn btn-warning btn-sm' href='".base_url()."index.php/print_money_receipt/?money_receipt_id=".$b['id']."&student_data_id=".$user_data['student_data_id']."&registration_no=".$user_data['registration_no']."'>View</a></td>";
                                                                                            else echo"<td></td>";    
																							echo"</tr>";
																					//}
																					//<td><button type='button' class='btn btn-primary btn-sm refund-btn' money_receipt_id='".$b['id']."'>Refund</button></td>
																					
																				}
																				
																			}
																		}else{
																					echo"<tr><td colspan='6'>No payment found.</td></tr>";																			
																		}	
?>

																		</tbody>
																	</table>																
																</div>																																									
															</div>														
														
														
																		<div class="panel panel-info">
																			<div class="panel-heading">
																				<h3 class="panel-title">Refund History</h3>
																			</div>
																			<div class="panel-body">																
																				<table class="table table-bordered">
																					<thead>
																						<tr>
																							<th>Invoice</th>
																							<th>Date</th>
																							<th>Method</th>
																																							
																							<th>Reason</th>
																							<th>Received By</th>
																							<th class="text-right">Amount</th>
																						</tr>
																					</thead>
																					<tbody>

<?php                                                           						$refund_data = $this->money_receipt->get_all_refund_by_register_id_and_agreement_id($agreement_data['register_id'],$v['id']);
																						//var_dump($refund_data);
																						if(!empty($refund_data) && $refund_data>0){
																							foreach($refund_data as $c=>$d){
																								
																											if($d['payment_mode']==1) $payment_mode = "Cash";
																											if($d['payment_mode']==2) $payment_mode = "Bank Transfer";
																											if($d['payment_mode']==3) $payment_mode = "Card";
																											if($d['payment_mode']==4) $payment_mode = "Demand Draft";
																											if($d['payment_mode']==5) $payment_mode = "Cheque";																								

																											echo"<tr >
																											
																												<td>".$d['invoice_no']."</td>
																												<td>".date("d-m-Y",strtotime($d['payment_date']))."</td>
																												<td>".$payment_mode."</td>
																												
																												<td>".tinymce_decode($d['remarks'])."</td>
																												<td>".$this->staff->get_name($d['received_by_staff'])."</td>
																												<td align='right'>".sprintf("%0.2f",$d['amount'])."</td>
																												</tr>";
																								
																							}
																						}else{
																							
																											echo"<tr><td colspan='5'>No refund found.</td></tr>";																				
																						}	
?>

																					</tbody>
																				</table>																
																			</div>																																									
																		</div>														
														
														
														
														
														</div> 														
 														
 														
 														
 														<div class="clearfix"></div> 														
 														
 															
														
													</div>
													
																									
												</div>
											</div>                          	  
				                      </div>
								
<?php								
									$i++;
								}
								
							}
?>


                      
                      
                      		




		           		</div>

		           		
		           		<div class="clearfix"></div>

               </form>
           
               

            </div> <!--End of #formbox-->
            

            
            
                 <!-- Modal -->
                <div class="modal fade" id="addNewAgreement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Add New Agreement</h4>
                      </div>
                      <div class="modal-body">
                            
                            <div class="row"><div class="output col-sm-12"></div></div>
                            
			                <input type="hidden" class="course_relation_id" name="course_relation_id" value="<?php echo $agreement_data['course_relation_id']; ?>" required>	                            	                            	                            	                            	                            	                            	                            	                            
			                <input type="hidden" class="register_id" name="register_id" value="<?php echo $agreement_data['register_id']; ?>">	                            	                            	                            	                            	                            	                            	                            	                            

                      		<div class="clearfix"></div>
                      		
                      		<div class="row">
                      			<div class="col-sm-12 form-group no-pad">
                      				<div class="col-sm-6 form-group">
                      					<label>Course:</label>
                      					<?php echo $agreement_data['course_name']; ?>
                      				</div>
                       				<div class="col-sm-6 form-group form-inline text-right">
                      					<label>Date:</label>
                      					<input type="text" class="agreement-date form-control date" name="agreement_date">
                      				</div>
                      				<div class="clearfix"></div>
                      			</div>	                      			
                      			
                      			
                      			<div class="clerfix"></div>
<?php
								if($user_data['student_type']!="overseas"){                      				
?>                      			                      		
                      			<div class="col-sm-3 form-group">                      			
                      				<label>Select Year:</label>
                      				<select name="year" class="form-control year" required>
                      					<option value="">Please Select</option>
<?php
	                                        var_dump($agreement_data['slc_coursecode_data']);
											foreach($agreement_data['slc_coursecode_data'] as $k=>$v){
												echo'<option value="'.$v['year'].'">'.$v['year'].'</option>';	
											}
?>
                      				</select>
                      			</div>                     			
                       			<div class="col-sm-3 form-group">
                      				<label>SLC Course Code:</label>
                      				<input type="text" class="slc_code form-control" name="slc_code">
                      			</div>
                       			<div class="col-sm-3 form-group">
                      				<label>Fees:</label>
                      				<input type="text" class="fees form-control" value="<?php echo $agreement_data['fees']; ?>" disabled>
                      				<input type="hidden" class="fees" name="fees" value="<?php echo $agreement_data['fees']; ?>">
                      			</div>
                       			<div class="col-sm-3 form-group">
                      				<label>Discount:</label>
                      				<input type="text" class="discount form-control" name="discount" value="0">
                      			</div>
<?php
								}else{                      				
?>

                       			<div class="col-sm-6 form-group">
                      				<label>Fees:</label>
                      				<input type="text" class="fees form-control" value="<?php echo $agreement_data['fees']; ?>" disabled>
                      				<input type="hidden" class="fees" name="fees" value="<?php echo $agreement_data['fees']; ?>">
                      			</div>
                       			<div class="col-sm-6 form-group">
                      				<label>Discount:</label>
                      				<input type="text" class="discount form-control" name="discount" value="0">
                      			</div>

<?php
								}                      				
?>                      			                      			                      			                      			                     			
                      			<div class="clerfix"></div>
                      			<div class="col-xs-12">
                                            <p class="divider"></p>
                                  </div>
  
					             <div class="col-sm-12">

					               	<div class="col-sm-6 no-pad">
					               		<h4><i class="fa fa-money "></i> Installment Details </h4> 
					               	</div>
					               	<div class="col-sm-6 text-right no-pad add-installment-row-btn-area">	
					               		<a href="javascript:void(0)" name="addInstallmentRowBtn" class="btn btn-warning add-installment-row"><i class="fa fa-plus-circle"></i> Add Installment</a>
					               	</div>
					               		
					               
					               
					             </div>
					             <div class="clerfix"></div>
                                 </div>
                                 <div class="row">
                                  <div class="col-xs-12">
                                            <p class="divider"></p>
                                  </div>
					             <div class="col-sm-12">

					               	<div class="col-sm-6 no-pad">
					               		<h4> Installment Date </h4> 
					               		
					               	</div>
					               	<div class="col-sm-6 no-pad">	
					               		<h4> Amount </h4>
					               	</div>
					              					               
					             </div>                      			

					             <div class="col-sm-12 installment-data-area">

	
					               		
					               		
					               		
					              					               
					             </div>                      		
                      		
                      		
                      		</div>
                      		
                      		<div class="row">
                      			<div class="col-sm-12">Remaining amount : <strong class="remaining-amount"><?php echo $agreement_data['fees']; ?></strong></div>

                      			<div class="clearfix"></div>
                      		</div>
                      		
                      		
                      		
                      		

                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <button type="button" name="addAgreementBtn" class="btn btn-success addAgreementBtn" id="addAgreementBtn" ><i class="fa fa-plus"></i> Add Agreement</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                
                
					             	<div class="installment-row-demo-area hidden">
					             		
					               	</div>
					               	
					               	
					               	
					               	
					               	
                 <!-- Modal -->
                <div class="modal fade" id="addNewPayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Add New Payment</h4>
                      </div>
                      <div class="modal-body">
                            
                            <div class="row"><div class="output col-sm-12"></div></div>
                            	                            	                            	                            	                            	                            	                            	                            

                      		<div class="clearfix"></div>
                      		<input type="hidden" class="register_id" name="register_id" value="<?php echo $agreement_data['register_id']; ?>">
                      		<div class="row">
								<div class="col-sm-12 no-pad">	
                       				<div class="col-sm-3 form-group">
                      					<label>Invoice No:</label>
                      					<input type="text" class="invoice_no form-control" readonly="" name="invoice_no">
                      				</div>
                       				<div class="col-sm-3 form-group">
                      					<label>Payment Mode:</label>
                      					<select name="payment_mode" class="form-control payment_mode">
                      						<option value="">Please Select</option>
                      						<option value="1">Cash</option>
                      						<option value="2">Bank Transfer</option>
                      						<option value="3">Card</option>
                      						<option value="4">Demand Draft</option>
                                            <option value="5">Cheque</option>
                      						                      						
                      					</select>
                      				</div>
                       				<div class="col-sm-3 form-group">
                      					<label>Payment Date:</label>
                      					<input type="text" class="payment_date form-control date" name="payment_date">
                      				</div>
                       				<div class="col-sm-3 form-group">
                      					<label>Amount:</label>
                      					<input type="text" class="amount form-control" name="amount">
                      				</div>                      				                      					                      												
								</div>
								<div class="col-sm-12 no-pad">	
                       				<div class="col-sm-12 form-group">
                      					<label>Agreement No:</label>
                      					<select name="agreement_id" class="form-control agreement_id">
                      						<option value="">Please Select</option>
<?php
	
										$agreement = $this->agreement->get_all_by_register_id($agreement_data['register_id']);
										$i=1;
										foreach($agreement as $v){
											echo "<option value='".$v['id']."'>Agreement ".$i."</option>";
											$i++;	
										}
										
										
?>
                      						
                      						
                      					</select>
                      				</div>                      				                      					                      												
								</div>
								<div class="col-sm-12 no-pad">	
                       				<div class="col-sm-12 form-group">
                      					<label>Apply to course ? </label>
										<label class="radio-inline">
										  <input type="radio" name="active_payment" class="active_payment" id="inlineRadio1" value="no"> No
										</label>
										<label class="radio-inline">
										  <input type="radio" name="active_payment" class="active_payment" id="inlineRadio2" checked="checked" value="yes"> Yes
										</label>                      					
                      				</div>                      				                      					                      												
								</div>								
								<div class="col-sm-12 no-pad">	
                       				<div class="col-sm-12 form-group">
                      					<label>Payment Description:</label>
                      					<select name="payment_description" class="form-control payment_description" required>
                      						<option value="">Please Select</option>                      						
                      						<option value="Course Fee">Course Fee</option>                      						
                      						<option value="Exam Fee">Exam Fee</option>                      						
                      						<option value="ID Card Fee">ID Card Fee</option>                      						
                      						<option value="Photocopy Card Fee">Photocopy Card Fee</option>                      						
                                              <option value="Late Fee">Late Fee</option>                                                                                            
                      						<option value="Refund">Refund</option>                      						                      						
                      					</select>
                      				</div>                      				                      					                      												
								</div>																
								<div class="col-sm-12 no-pad">	
                       				<div class="col-sm-12 form-group">
                      					<label>Remarks:</label>
                      					<textarea name="remarks" class="remarks form-control col-sm-12"></textarea>
                      				</div>                      				                      					                      												
								</div>								
                            </div>
                      		
                      		
                      		
                      		

                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <button type="button" name="addPaymentBtn" class="btn btn-success addPaymentBtn" id="addPaymentBtn" ><i class="fa fa-plus"></i> Add Payment</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->	
                
                
                
                
                 <!-- Modal -->
                <div class="modal fade" id="refundPayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Refund Payment</h4>
                      </div>
                      <div class="modal-body">
                            
                            <div class="row"><div class="output col-sm-12"></div></div>
                            	                            	                            	                            	                            	                            	                            	                            

                      		<div class="clearfix"></div>
                      		<input type="hidden" class="refund_money_receipt_id" name="refund_money_receipt_id">
                      		<div class="row">

                       				<div class="col-sm-12 form-group">
                      					<label>Administrative Charge/Fee:</label>
                      					<input type="number" class="refund_admin_fee form-control" name="refund_admin_fee" value="0.00">
                      				</div>
                       				<div class="col-sm-12 form-group">
                      					<label>Refund Date:</label>
                      					<input type="text" class="refund_date form-control date" name="refund_date">
                      				</div>
                       				<div class="col-sm-12 form-group">
                      					<label>Refund Reason:</label>
                      					<textarea class="form-control refund_reason" name="refund_reason"></textarea>
                      				</div>                      				                      					                      												
								
                            </div>
                      		
                      		
                      		
                      		

                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.gif" alt="">
                        <button type="button" name="refundPaymentbtn" class="btn btn-success refundPaymentbtn" id="refundPaymentbtn" ><i class="fa fa-plus"></i> Add Refund</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->	                				               	                             
                
                
                 <!-- Modal -->
                <div class="modal fade" id="editAgreement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Edit Agreement</h4>
                      </div>
                      <div class="modal-body">
                            
                            <div class="row"><div class="output col-sm-12"></div></div>
                            	                            	                            	                            	                            	                            	                            	                            

                      		<div class="clearfix"></div>
			                <input type="hidden" class="course_relation_id" name="course_relation_id" value="<?php echo $agreement_data['course_relation_id']; ?>">	                            	                            	                            	                            	                            	                            	                            	                            
			                <input type="hidden" class="register_id" name="register_id" value="<?php echo $agreement_data['register_id']; ?>">
			                <input type="hidden" class="ea_fees" name="ea_fees">
			                <input type="hidden" class="ea_id" name="ea_id">
                      		<div class="row">
								<div class="col-sm-12 no-pad">
<?php
								if($user_data['student_type']!="overseas"){                      				
?>									
                       				<div class="col-sm-3 form-group">
                      					<label>SLC Course Code:</label>
                      					<input type="text" class="ea_slc_coursecode form-control" name="ea_slc_coursecode">
                      				</div>
                       				<div class="col-sm-3 form-group">
                      					<label>Year:</label>
                      					<input type="text" class="ea_year form-control" name="ea_year">
                      				</div>
<?php
								}                      				
?>                      				
                       				<div class="col-sm-3 form-group">
                      					<label>Agreement Date:</label>
                      					<input type="text" class="ea_date form-control date" name="ea_date">
                      				</div>
                       				<div class="col-sm-3 form-group">
                      					<label>Discount:</label>
                      					<input type="text" class="ea_discount form-control" name="ea_discount">
                      				</div>
                                 </div>                      				                      				                      												
                            </div>	
                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <button type="button" name="editAgreementBtn" class="btn btn-success editAgreementBtn" id="editAgreementBtn" > Edit Agreement</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->	
                




                 <!-- Modal -->
                <div class="modal fade" id="editPaymentPlan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Edit Payment Plan</h4>
                      </div>
                      <div class="modal-body">
                            
                            <div class="row"><div class="output col-sm-12"></div></div>
                            	                            	                            	                            	                            	                            	                            	                            

                      		<div class="clearfix"></div>
					          <input type="hidden" class="agreement_id" name="agreement_id">	                            	                            	                            	                            	                            	                            	                            	                            
					          <input type="hidden" class="editPaymentPlan_total_amount" name="editPaymentPlan_total_amount">
                      			
                      		  <div class="row">
                      				<div class="col-sm-6">Total amount : <strong class="editPaymentPlan-show-total_amount"></strong></div>
                      				<div class="col-sm-6 text-right"><button type="button" class="addNewEditPaymentRow btn btn-sm btn-warning"><i class="fa fa-plus"></i> Add another installment</button></div>

                      				<div class="clearfix"></div>
                      		  </div>		                      
		                      
		                      <div class="row">
		                      
							      <div class="col-sm-5">
							      	<label>Installment Date</label>
							      </div>
							      <div class="col-sm-5">
							      	<label>Installment Amount</label>
							      </div>
							      <div class="col-sm-2 text-right">
							      	<label>Remove</label>
							      </div>
							      <p class="clearfix"></p>
		                      
		                      
							      <div class="col-sm-12 payment-plan-row-area"> </div>
                     				
		                       </div>
                      		
                      		   <div class="row">
                      				<div class="col-sm-12">Remaining amount : <strong class="editPaymentPlan-remaining-amount"></strong></div>

                      				<div class="clearfix"></div>
                      		   </div>                      		
                      		
                      		

                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <button type="button" name="editPaymentPlanBtn" class="btn btn-success editPaymentPlanBtn" id="editPaymentPlanBtn" > Edit Payment Plan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->	                
                
                
                
                 <!-- Modal -->
                <div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Warning!</h4>
                      </div>
                      <div class="modal-body">                      		
                      		
                      		

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> Ok</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->	                
                              