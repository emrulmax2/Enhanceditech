
<script type="text/javascript">

$(document).ready(function(){

	$(".rejected-reason-list").hide();
      
    <?php
        if($user_data && is_array($user_data)){
            foreach($user_data as $k=>$v){
            if($k=="student_admission_status_for_staff") {
                $student_admission_status_for_staff = $v;
                 if($student_admission_status_for_staff=="Review"){
                      $student_admission_status = "Review";
                     }else if($student_admission_status_for_staff=="Processing"){
                      $student_admission_status = "Processing";
                     }else if($student_admission_status_for_staff=="Refer to academic department"){
                      $student_admission_status = "Processing";
                     }else if($student_admission_status_for_staff=="Accepted"){
                      $student_admission_status = "Accepted";
                     }else if($student_admission_status_for_staff=="Rejected for review"){
                      $student_admission_status = "Processing";
                     }else if($student_admission_status_for_staff=="Rejected"){
                      $student_admission_status = "Rejected";
                     }else if($student_admission_status_for_staff=="New"){
                      $student_admission_status = "Submitted";
                     }else if($student_admission_status_for_staff=="Discarded"){
                      $student_admission_status = "Discarded";
                     }else if($student_admission_status_for_staff=="Awaiting Documents"){
                      $student_admission_status = "Awaiting Documents";
                     }
                
                } else if($k=="student_application_reference_no") {
                   $student_application_reference_no =$v;
                } else if($k=="student_app_submitted_datetime") {
                   $student_app_submitted_datetime =$v;
                } else if($k=="student_others_disabilities") {

                }
                echo "$('input[name=$k]').val('".tinymce_decode($v)."');";    

                if($k=="student_address_address_line_1" && $v!="")
                echo "$('.address-details').fadeIn();";
                if($k=="student_educational_qualification_highest_academic_qualification" && $v!="") {
                echo "$('.qualification-details').fadeIn();"; 
                echo "$('.student_formal_education').val('yes');";
                }
                if($k=="student_funding_type" && $v="Student Loan")
                echo "$('#fundingoption').fadeIn();";
                if($k=="student_student_loan_applied_for_the_proposed_course" && $v=="yes")
                echo "$('#fundingoption2').fadeIn();";
                
                if($k=="student_employment_history_current_employment_status"  && ($v =="Part Time" || $v=="Fixed Term" || $v=="Zero Hour" || $v=="Seasonal" || $v == "Agency or Temp" || $v=="Volunteer") )
                echo "$('.employment-info').fadeIn();";
                if($k=="student_others_disabilities" && $v!="") {
                 echo "$('.disabilities-info').fadeIn();";   
                echo "$('.student_others_disabilities_on').val('yes');";
                }
                if($k=="student_others_marketing_info_referred_by" && $v=="agent_referred") {
                 echo "$('.agent-claim').fadeIn();";   
                
                }
                if($k=="student_others_marketing_info_referred_by" && $v=="student_referred") {
                 echo "$('.reffered-claim').fadeIn();";   
                
                }
                if($k=="student_admission_status_rejected_reason" && !empty($v)){
                	$student_admission_status_rejected_reason = $v;
					echo "$('.rejected-reason-list').show();";	
                }     
                
            }
            foreach($user_data as $k=>$v){
            
                if($k=="student_others_disabilities" && $v!="no") {
                $disibilites = explode(',',$v);
                $total_dis=count($disibilites);
                foreach ($disibilites as $disibility): ?>
                var i=0;
                $.each($(".disabilities-info").find('input:checkbox'),function(){
                    if($(this).val() == "<?php echo $disibility; ?>") {
                        //this.checked = true;
                        i++;
                        $(this).attr("checked",true);
                    }
                    
                });
                 if(i < <?php echo $total_dis; ?>) {
                 $('.othertext').val("<?php echo $disibility; ?>");
                 }
               <?php
                endforeach;
               
                }else
                if($k=="student_others_disabilities" && $v=="no"){
                  //echo"alert('".$v."');";
                  echo"$('select.student_others_disabilities_on').val('".$v."');";
                  echo"$('.disabilities-info').hide();";            
                }else
                if($k=="student_semister" && is_string($v)){
                	$semister_id = $this->semister->get_ID_by_name($v);
                	//$student_admission_status_rejected_reason = $v;
					echo "$('select[name=student_semister]').val(".$semister_id.");";	
                }else
                if($k=="student_course" && is_string($v)){
                	$course_id = $this->course->get_ID_by_name($v);
                	//$student_admission_status_rejected_reason = $v;
					echo "$('select[name=student_course]').val(".$course_id.");";	
                }                
                else echo "$('select[name=$k]').val('".tinymce_decode($v)."');";    


            }
        }
        
        @$show_academic_qfy=0;        
    ?>    

	print_form('div_print_table');	
    
});


function print_form(cls){


    var matchedElements = document.getElementsByClassName(cls);
    var str = '';

    for (var i = 0; i < matchedElements.length; i++) {
        var str = str + matchedElements[i].innerHTML;
    }
    var h = document.getElementsByClassName(cls).offsetHeight;
    var newwin = window.open('', 'printwin', 'left=100,top=100,width=780,height='+h);

    newwin.document.write('<HTML>\n<HEAD>\n');
    newwin.document.write('<STYLE media=\'print\'>\n');
    newwin.document.write('.print_table{ width:100%; }\n');
    newwin.document.write('.text-mid{ font-size: 100%; }\n');
    newwin.document.write('.text-large{ font-size: 110%; }\n');
    newwin.document.write('.bold{ font-weight:bold; }\n');
    newwin.document.write('.right{ text-align: right; width:100%; }\n');
    newwin.document.write('.center{ text-align: center; }\n');
    newwin.document.write('.blocked_header{ background-color: \'Gray\'; padding: 8px; font-weight:bold; font-size: 90%; }\n');
    newwin.document.write('.field_header{ font-size: 80%; padding:8px; font-weight:bold; }\n');
    newwin.document.write('.field_text{ font-size: 80%; text-transform: capitalize; padding:8px; }\n');
    newwin.document.write('.print_table tr td{width:50%;}\n');
    newwin.document.write('</STYLE>\n');
    newwin.document.write('<TITLE>Print Money Receipt</TITLE>\n');
    newwin.document.write('<script>\n');
    newwin.document.write('function chkstate(){\n');
    newwin.document.write('if(document.readyState=="complete"){\n');
    newwin.document.write('window.close();\n');//window.close()
    newwin.document.write('}\n');
    newwin.document.write('else{\n');
    newwin.document.write('setTimeout("chkstate()",2000)\n');
    newwin.document.write('}\n');
    newwin.document.write('}\n');
    newwin.document.write('function print_win(){\n');
    newwin.document.write('window.print();\n');
    newwin.document.write('chkstate();\n');
    newwin.document.write('}\n');
    newwin.document.write('<\/script>\n');
    newwin.document.write('</HEAD>\n');
    newwin.document.write('<BODY onload="print_win()">\n');
    newwin.document.write(str);
    newwin.document.write('</BODY>\n');
    newwin.document.write('</HTML>\n');
    newwin.document.close();


}

</script>

<style media='print'>
.print_table{width:100%;} .text-mid{ font-size: 200%; } .text-large{ font-size: 200%;} .bold{font-weight:bold;} .right{ text-align: right; width:100%;} .center{text-align: center;} .blocked_header{background-color: #ddd;padding: 8px;font-weight:bold;font-size: 130%;} .clear{clear:both;} .field_header{font-size: 110%;padding:8px;font-weight:bold;} .field_text{font-size: 110%;text-transform: capitalize;padding:8px;} .border-top{border-top: 1px solid #ddd;} .print_table tr td{width:50%;}



</style> 

<style>

.print_table{
	width:100%;
}
.text-mid{
	font-size: 150%; 
}
.text-large{
	font-size: 200%;
}
.bold{
	font-weight:bold;
}
.right{
	text-align: right;
	width:100%;
}
.center{
    text-align: center;
}
.blocked_header{

	background-color: #ddd;
    padding: 8px;
    font-weight:bold;
    font-size: 130%;


}
.clear{
	clear:both;
}
.field_header{
	font-size: 110%;
	padding:8px;
	font-weight:bold;
}
.field_text{
	font-size: 110%;
	text-transform: capitalize;
	padding:8px;
}
.border-top{
	border-top: 1px solid #ddd; 
}
.print_table tr td{
	width:50%;
}
.com_logo {
    padding-bottom: 5px;
    width: 280px;
}
</style>               
                <!--<div class="row">
	                
	                <div class="col-lg-12" style="padding-top: 10px;">
                    <?php if($message!="") {                
	                	 //echo $message;

                     } ?>
	                </div>
	                
                </div> -->               

                <div class="row div_print_table">
                    
					<table class="print_table" border="0">

						<tr>
						     <td valign="bottom"><img src="<?php echo $settings["print_logourl"]; ?>" class="com_logo"></td>
						     <td class="right" valign="bottom"><span class="text-mid" style="font-size: 40px; font-weight: bold; color: #999">Money Receipt</span></td>
						</tr>
						<tr>
						     <td colspan="2" style="border-top: 1px solid #ddd;">&nbsp;</td>
						</tr>						
						
						<tr>
						     <td colspan="2" class="" style="text-align: right;">
						     
						     Date: <?php echo date("F j, Y",strtotime($money_receipt_data['payment_date'])); ?>
						<br>Invoice# <?php echo $money_receipt_data['invoice_no']; ?>
						<br>Student Name: <?php echo strtoupper($this->student_title->get_name_by_id($user_data['student_title'])." ".$user_data['student_first_name']." ".$user_data['student_sur_name']); ?>
						<br>Student Mobile: <?php echo $user_data['student_mobile_phone']; ?>
						
						<?php if(!empty($user_data['student_address_address_line_1'])) echo "<br>".strtoupper($user_data['student_address_address_line_1']); ?>
						<?php if(!empty($user_data['student_address_address_line_2'])) echo "<br>".strtoupper($user_data['student_address_address_line_2']); ?>
						<?php if(!empty($user_data['student_address_state_province_region'])) echo "<br>".strtoupper($user_data['student_address_state_province_region']); ?>
						<?php if(!empty($user_data['student_address_postal_zip_code'])) echo "<br>".strtoupper($user_data['student_address_postal_zip_code']); ?>
						<?php if(!empty($user_data['student_address_city'])) echo "<br>".strtoupper($user_data['student_address_city']).", "; ?><?php if(!empty($user_data['student_address_country'])) echo " ".strtoupper($user_data['student_address_country']); ?>
						<br>Student ID: <?php echo $reg_data['registration_no']; ?>

						     
						     </td>
						</tr>
						<tr>
						     <td colspan="2" style="border-top: 1px solid #ddd;">&nbsp;</td>
						</tr>
						
						<tr>
						     <td colspan="2" style="height: 5px; padding: 10px; margin-top: 30px;">
						     
						     	<table width="100%" style="width: 100%;" cellpadding="0" cellspacing="0" border="0">
						     		<tr>
						     			<td width="10%" style="background-color: #ddd; border: 1px solid #999; padding:5px">ITEM</td><td width="30%" style="background-color: #ddd; border: 1px solid #999; border-left: none; padding:5px">DESCRIPTION</td><td width="30%" style="background-color: #ddd; border: 1px solid #999; border-left: none; padding:5px">METHOD</td><td width="30%" style="background-color: #ddd; border: 1px solid #999; border-left: none; padding:5px">TOTAL</td>
						     		</tr>
						     		<tr>
						     			<td style="border: 1px solid #999; padding:5px;border-top: none;">1</td>
						     			<td style="border: 1px solid #999; border-left: none; padding:5px; border-top: none;"><?php if(!empty($money_receipt_data['payment_description'])) echo ($money_receipt_data['payment_description']); ?></td>
						     			<td style="border: 1px solid #999; border-left: none; padding:5px; border-top: none;">
						     			<?php 
						     			if(!empty($money_receipt_data['payment_mode'])){
											if($money_receipt_data['payment_mode']==1) $payment_mode = "Cash";
											if($money_receipt_data['payment_mode']==2) $payment_mode = "Bank Transfer";
											if($money_receipt_data['payment_mode']==3) $payment_mode = "Refund";
											if($money_receipt_data['payment_mode']==4) $payment_mode = "Card";
											if($money_receipt_data['payment_mode']==5) $payment_mode = "Demand Draft";
											if($money_receipt_data['payment_mode']==6) $payment_mode = "Cheque";						     			 
						     				echo $payment_mode;
										}			 
						     			?>
						     			</td>						     			
						     			<td style="font-weight: bold; border: 1px solid #999; border-left: none; border-top: none; padding:5px"><?php if(!empty($money_receipt_data['amount'])) echo "&#163; ".($money_receipt_data['amount']); ?></td>
						     		</tr>
						     		<tr>
						     			<td colspan="3" style="padding:5px; text-align: right;">Subtotal</td>						     			
						     			<td style="font-weight: bold; border: 1px solid #999; border-top: none; padding:5px"><?php if(!empty($money_receipt_data['amount'])) echo "&#163; ".($money_receipt_data['amount']); ?></td>
						     		</tr>						     								     		
						     	</table>
						     	
						     </td>
						</tr>						
						<tr>
						     <td colspan="2" style="height:300px;">
						     
						     		<table style="width: 50%;" cellpadding="0" cellspacing="0" border="0">
						     		
						     				<tr>
						     						<td colspan="2" class="field_header" style="border: 1px solid #999; padding:5px;">UNPAID INSTALLMENTS</td>
						     				</tr>
						     				<tr>
						     						<td style="border: 1px solid #999; border-top: none; border-right: none; padding:5px;">Installment Due Date</td>
						     						<td style="border: 1px solid #999;  border-top: none; padding:5px; text-align: right;">Amount</td>
						     				</tr>
						     				
<?php
						     					
													$all_money_receipt_data = $this->money_receipt->get_all_by_register_id($reg_data['id']);													
													$total = 0; //$total += $d['amount'];
													foreach($all_money_receipt_data as $m){
														//$chk_if_this_refund = $this->money_receipt->chk_if_refund($m['invoice_no'],$m['register_id']);
														//if($m['payment_mode']!="3" && $m['agreement_id']==$agreement_data['id'] && $chk_if_this_refund==false) $total += $m['amount'];
														if($m['payment_description']!="Refund" && $m['agreement_id']==$agreement_data['id'] && $m['active_payment']!="no") $total += $m['amount'];
													}
													
													$refund_data = $this->money_receipt->get_all_refund_by_register_id_and_agreement_id($agreement_data['register_id'],$agreement_data['id']);													
													
													$refund_amount = 0;
													if(!empty($refund_data) && $refund_data>0){
														foreach($refund_data as $c=>$d){

															$refund_amount += $d['amount'];				
															
														}
													}													

                                                    //echo "<script>alert('$total');</script>";
													$t_amount = 0; $due_remain = 0;
													foreach($installment_data as $d){
																
																$t_amount += $d['amount'];
																//var_dump($total);
																	if($total - $refund_amount>=$t_amount){
	
																	}else{
																		
																		if(strtotime(date("d-m-Y")) > strtotime($d['installment_date'])) { 
																			
																			echo "<tr>";
																			echo '<td style="border: 1px solid #999; border-top: none; border-right: none; padding:5px;">'.date("d-m-Y",strtotime($d['installment_date'])).'</td>';
																			echo '<td style="border: 1px solid #999;  border-top: none; padding:5px; text-align: right;">'.'&#163; '.sprintf("%0.2f",$d['amount']).'</td>';
																			echo "</tr>";																			
																		    $due_remain += $d['amount'];
																		}

																	}																	
														
													}

													$due = $due_remain - $total + $refund_amount;

													echo "<tr>";
													echo '<td style="border: 1px solid #999; border-top: none; border-right: none; padding:5px;">Total Due:</td>';
													echo '<td style="border: 1px solid #999;  border-top: none; padding:5px; text-align: right;">'.'&#163; '.sprintf("%0.2f",$due).'</td>';
													echo "</tr>";																																     					
						     					
?>						     				
						     										     										     				
						     		
						     		</table>
						     
						     </td>
						</tr>
						
						<tr>
						
								<td valign="bottom" colspan="2" style="height:150px; text-align: center;">
								 						
								 	<?php echo $settings['company_name']; ?> <br><br>
								 	<?php echo $settings['address']; ?><br><br>					
								 	<?php echo "Phone: ".$settings['phone']; ?><?php echo ", "; ?><?php echo "Email: ".$settings['smtp_user']; ?><br>					
								 	Receiving Officer: <?php echo $this->staff->get_name($this->session->userdata('uid')); ?>					
								 						
								</td>
													
						</tr>												
						
		
																																																																																																
					</table>                    
           
               

            	</div> <!--End of #formbox-->
