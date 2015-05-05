
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
                    /*echo"alert('".$v."');";
                    if($v=="no"){
						echo "$('.student_others_disabilities_on').val('no');";	
                    }*/
                   	/*$disibilities =explode(',',$v);
                   if($disibilities[0]=="no") {
                     echo "$('.student_others_disabilities_on').val('no');";  
                   } */
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
  // window.print();
    
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
    newwin.document.write('<TITLE>Print Application</TITLE>\n');
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
.print_table{width:100%;} .text-mid{ font-size: 150%; } .text-large{ font-size: 200%;} .bold{font-weight:bold;} .right{ text-align: right; width:100%;} .center{text-align: center;} .blocked_header{background-color: #ddd;padding: 8px;font-weight:bold;font-size: 130%;} .clear{clear:both;} .field_header{font-size: 110%;padding:8px;font-weight:bold;} .field_text{font-size: 110%;text-transform: capitalize;padding:8px;} .border-top{border-top: 1px solid #ddd;} .print_table tr td{width:50%;}



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
						     <td><img src="<?php echo $settings["print_logourl"]; ?>" class="com_logo"></td>
						     <td class="right"><span class="text-mid">Application Reference No. </span><span class="text-large bold"><?php echo $user_data['student_application_reference_no']; ?></span></td>
						</tr>
						
						<tr>
						     <td colspan="2" class="blocked_header center" style="background-color: #dddddd;">UK/EU Students Applcation</td>
						</tr>
						<tr>
						     <td colspan="2" style="height: 5px;">&nbsp;</td>
						</tr>						
						<tr>
						     <td colspan="2" class="blocked_header" style="background-color: #dddddd;">Personal Details</td>
						</tr>
						
						<tr>
						     <td class="field_header">Title:</td>
						     <td class="field_text"><?php echo $user_data['student_title']; ?></td>
						</tr>						
						<tr class="border-top">
						     <td class="field_header" style="border-top: 1px solid #ddd;">First Name(s):</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_first_name']; ?></td>
						</tr>						
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Surname:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_sur_name']; ?></td>
						</tr>						
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Date of birth:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_date_of_birth']; ?></td>
						</tr>						
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Gender:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $this->student_gender->get_name_by_id($user_data['student_gender']); ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Nationality:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $this->country->get_name_by_id($user_data['student_nationality']); ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Country Of Birth:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $this->country->get_name_by_id($user_data['student_country_of_birth']); ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Marital Status:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $this->student_marital_status->get_name_by_id($user_data['student_marital_status']); ?></td>
						</tr>																																				
						<tr>
						     <td colspan="2" class="blocked_header" style="background-color: #dddddd;">Contact Details</td>
						</tr>
						<tr>
						     <td class="field_header">Home Phone:</td>
						     <td class="field_text"><?php echo $user_data['student_home_phone']; ?></td>
						</tr>						
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Mobile Phone:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_mobile_phone']; ?></td>
						</tr>						
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Address 1:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_address_address_line_1']; ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Address 2:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_address_address_line_2']; ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">State/County:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_address_state_province_region']; ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Post Code:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_address_postal_zip_code']; ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">City:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_address_city']; ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Country:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_address_country']; ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">E-mail:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd; text-transform: lowercase;">&nbsp;<?php echo $user_data['student_email']; ?></td>
						</tr>
						<tr>
						     <td colspan="2" class="blocked_header" style="background-color: #dddddd;">Proposed Course</td>
						</tr>						
						<tr>
						     <td class="field_header">When would you like to start your course?</td>
						     <td class="field_text"><?php if(preg_match("/[a-zA-Z]+ \d+/", $user_data['student_semister'])==1) echo $user_data['student_semister']; else echo $this->semister->get_name($user_data['student_semister']); ?></td>
						</tr>						
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Which course do you propose to take?</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php if(preg_match("/[a-zA-Z]/", $user_data['student_course'])==1) echo $user_data['student_course']; else echo $this->course->get_name($user_data['student_course']); ?></td>
						</tr>						
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">How are you funding your education at London Churchill College?</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php if($user_data['student_funding_type']=="Other") echo $user_data['student_funding_type_other']; else echo $user_data['student_funding_type']; ?></td>
						</tr>
						<?php if($user_data['student_funding_type']=="Student Loan"){ ?>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">If your funding is through Student Finance England, please choose from the following. Have you applied for the proposed course?</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_student_loan_applied_for_the_proposed_course']; ?></td>
						</tr>
						<?php } ?>												
						<?php if($user_data['student_funding_type']=="Student Loan" && $user_data['student_student_loan_applied_for_the_proposed_course']=="yes"){ ?>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Are you already in receipt of funds?</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_already_in_receipt_of_funds']; ?></td>
						</tr>												
						<?php } ?>
						<tr>
						     <td colspan="2" class="blocked_header" style="background-color: #dddddd;">Academic Qualification</td>
						</tr>
						<?php if($user_data['student_educational_qualification_highest_academic_qualification'] != "" || $user_data['student_educational_qualification_awarding_body'] != "" || $user_data['student_educational_qualification_subjects']!="" || $user_data['student_educational_qualification_results']!="" || $user_data['student_educational_qualification_award_date']!=""){ $show_academic_qfy = 1;?>
						<tr>
						     <td class="field_header">Do you have any formal academic qualification?</td>
						     <td class="field_text">Yes</td>
						</tr>						
						<?php } ?>
						<?php if($show_academic_qfy == 1){?>
						<tr class="border-top"  style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Highest Academic Qualification:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_educational_qualification_highest_academic_qualification']; ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Awarding Body:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_educational_qualification_awarding_body']; ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Subjects:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_educational_qualification_subjects']; ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Results:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_educational_qualification_results']; ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Award Date:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_educational_qualification_award_date']; ?></td>
						</tr>																																										
						<?php } ?>
						<tr>
						     <td colspan="2" class="blocked_header" style="background-color: #dddddd;">Employment History</td>
						</tr>						
						<tr>
						     <td class="field_header">What is your current employment status?</td>
						     <td class="field_text"><?php echo $user_data['student_employment_history_current_employment_status']; ?></td>
						</tr>																		
						<?php if($user_data['student_employment_history_current_employment_status']=="Part Time" || $user_data['student_employment_history_current_employment_status']=="Fixed Term" || $user_data['student_employment_history_current_employment_status']=="Volunteer" || $user_data['student_employment_history_current_employment_status']=="Zero Hour" || $user_data['student_employment_history_current_employment_status']=="Seasonal" || $user_data['student_employment_history_current_employment_status']=="Agency or Temp"){ ?>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Company Name, Address & Phone No:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_employment_history_company']; ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Position:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_employment_history_position']; ?></td>
						</tr>	
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Start Date:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_employment_history_start_date']; ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">End Date:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_employment_history_end_date']; ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Contact Name:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_job_reference_contact_name']; ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Position:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_job_reference_position']; ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Phone:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_job_reference_phone']; ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Email:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_job_reference_email']; ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Company Name & Address:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_job_reference_company_name_address']; ?></td>
						</tr>																																																					
						<?php } ?>
						<tr>
						     <td colspan="2" class="blocked_header" style="background-color: #dddddd;">Others</td>
						</tr>						
						<tr>
						     <td class="field_header">Do you have any disabilities that require arrangements from the college or special needs that applies to you?</td>
						     <td class="field_text">
						     <?php 
		  							/*$exp = explode(",",$user_data['student_others_disabilities']);
									if(count($exp)>1){
										foreach($exp as $k=>$v){
											if($v > "") echo"$v, ";	
										}
									}else{
										echo $user_data['student_others_disabilities'];
									}*/
									if(!empty($user_data['student_others_disabilities'])){
										
										$dis_arr = array();
										$dis_arr = unserialize(stripslashes($user_data['student_others_disabilities']));
										
										if(is_array($dis_arr) && count($dis_arr)>0){
											//var_dump($dis_arr);
											//echo implode(",",$dis_arr);
											$num_dis = count($dis_arr);
											foreach($dis_arr as $v){ echo $this->student_others_disabilities->get_name_by_id($v).","; }
										}
										
										
										
									}
															     
						     ?>
						     </td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Ethnicity:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $this->student_others_ethnicity->get_name_by_id($user_data['student_others_ethnicity']); ?></td>
						</tr>												
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">How did you know about the college?</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">
						     <?php 
		  						if($user_data['student_others_marketing_info_referred_by']=="student_referred") echo"Somebody referred me.";

								else if($user_data['student_others_marketing_info_referred_by']=="student_own") echo"I came to the college on my own."; 
								
								else if($user_data['student_others_marketing_info_referred_by']=="agent_referred") echo"Agent referred."; 						     
						      ?>
						      </td>
						</tr>												
						<?php if($user_data['student_others_marketing_info_referred_by']=="student_referred"){ ?>						
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Referred Name:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_others_marketing_info_referred_name']; ?></td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Referred Phone:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php echo $user_data['student_others_marketing_info_referred_phone']; ?></td>
						</tr>																		
						<?php }else if($user_data['student_others_marketing_info_referred_by']=="agent_referred"){ ?>	
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" style="border-top: 1px solid #ddd;">Agent Name:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;">&nbsp;<?php if(!empty($user_data['agent_id'])) echo $this->agent->get_name_by_ID($user_data['agent_id']); ?></td>
						</tr>						
						<?php } ?>
						<tr class="border-top">
						     <td class="field_header" valign="top" style="border-top: 1px solid #ddd;">Declaration:</td>
						     <td class="field_text" style="border-top: 1px solid #ddd;"><img src="<?php echo base_url(); ?>images/check.jpg"> I confirm that the information in this form is Correct and Factual to the best of my knowledge. I am responsible to keep abreast of the Terms & Conditions and the College policies and agree to abide by them. I've read the College's 'Terms and Conditions' and other Legal Policies and agree to follow them during my entire course of study.</td>
						</tr>
						<tr class="border-top" style="border-top-style: solid; border-top-color: #dddddd; border-top-width: thin;">
						     <td class="field_header" valign="top" style="border-top: 1px solid #ddd;">Student's Signature: <div style="height:50px; width:250px; border:1px solid #d2d4d6;-webkit-box-shadow: 0px 2px 1px rgba(50, 50, 50, 0.75);-moz-box-shadow:0px 2px 1px rgba(50, 50, 50, 0.75); box-shadow:0px 2px 1px rgba(50, 50, 50, 0.75);"></div></td>
						     <td class="field_text bold" style="border-top: 1px solid #ddd;">Date: <div style="height:50px; width:250px; border:1px solid #d2d4d6;-webkit-box-shadow: 0px 2px 1px rgba(50, 50, 50, 0.75);-moz-box-shadow:0px 2px 1px rgba(50, 50, 50, 0.75); box-shadow:0px 2px 1px rgba(50, 50, 50, 0.75);"></div></td>
						</tr>						
																																																																																																
					</table>                    
           
               

            	</div> <!--End of #formbox-->
