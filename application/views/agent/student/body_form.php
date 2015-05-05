<?php $student_admission_status = ""; $student_application_reference_no=""; $student_app_submitted_datetime=""; ?>
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
                
                

                if($k=="student_address_address_line_1" && $v!="")
                echo "$('.address-details').fadeIn();";
                if($k=="student_educational_qualification_highest_academic_qualification" && $v!="") {
                echo "$('.qualification-details').fadeIn();"; 
                echo "$('.student_formal_education').val('yes');";
                
                }
                if($k=="student_funding_type" && $v=="Student Loan")
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
                if($k=="student_marital_status"){
					echo "$('input:radio[value=$v]').attr('checked',true);";
                }
                
                if($k!="student_course" && $k!="student_semister" && $k!="student_marital_status")   echo "$('input[name=$k]').val('".tinymce_decode($v)."');";
                
                
                
                
                
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
                if($k=="student_semister" && preg_match("/[a-zA-Z]+ \d+/", $v)==1){

                	$semister_id = $this->semister->get_ID_by_name($v);
                	//$student_admission_status_rejected_reason = $v;
					echo "$('select[name=student_semister]').val('".$semister_id."');";	
				}else
                if($k=="student_semister" && preg_match("/[a-zA-Z]+ \d+/", $v)==0){
                
                	echo "$('select[name=student_semister]').val('".$v."');";                
                	
                }else
                if($k=="student_course" && preg_match("/[a-zA-Z]/", $v)==1){
                	//echo"alert('".preg_match("/[a-zA-Z]/", $v)."');";
                	$course_id = $this->course->get_ID_by_name($v);
                	//$student_admission_status_rejected_reason = $v;
					echo "$('select[name=student_course]').val('".$course_id."');";	
                
                }else
                if($k=="student_course" && preg_match("/[a-zA-Z]/", $v)==0){

					echo "$('select[name=student_course]').val('".$v."');";	
                
                }                
                else echo "$('select[name=$k]').val('".$v."');";    


            }
        }        
    ?>    

		

    
});
</script>


                
                <!--<div class="row">
	                
	                <div class="col-lg-12" style="padding-top: 10px;">
                    <?php if($message!="") {                
	                	 //echo $message;

                     } ?>
	                </div>
	                
                </div> -->               

                <div id="formbox" class="row">
                    
                    
                    <form role="form"  method="post" action="?action=singleview&do=application&id=<?php echo $ref_id; ?>">
                    
		                <div class="col-lg-12">
			                <div class="row">
                            
				                <div class="col-sm-12 text-right">
                                     <button type="button" name="changestatusbutton" class="btn btn-md btn-warning changestatusbutton"><i class="fa fa-check"></i> Change status</button>

                         			<button type="submit" class="btn btn-md btn-success "><i class="fa fa-save"></i> Update </button>
					             </div>	   
				             </div> 
                             <!--Start admission status information -->
                             <div class="divider"></div>  
                             <div class="form-group">
                               <h4><i class="fa fa-eye "></i> Admission Details </h4>
                               <p class="divider"></p>
                             </div> 
                             <div class="form-group clearfix">
                                <div class="col-sm-2 no-pad-left col-md-offset-1">
                                        <label>Apllicatin No : </label>
                                </div>
                                    <div class="col-sm-4 ">
                                        <?php echo $student_application_reference_no;?>
                                    </div>
                             </div>				             
                             <div class="form-group clearfix">
                                <div class="col-sm-2 no-pad-left col-md-offset-1">
                                        <label>Admission Status : </label>
                                </div>
                                <div class="col-sm-4 ">
                                        <?php echo $student_admission_status;?>
                                </div>
                             </div>
                             <?php if(!empty($student_admission_status_rejected_reason)){   ?>
                             <div class="form-group clearfix">
                                <div class="col-sm-2 no-pad-left col-md-offset-1">
                                        <label>Rejected Reason : </label>
                                </div>
                                <div class="col-sm-4 " style="color:#f00;font-weight:bold;">
                                        <?php echo $student_admission_status_rejected_reason;?>
                                </div>
                             </div>                             
                             <?php } ?>
                             <div class="form-group clearfix">
                                <div class="col-sm-2 no-pad-left col-md-offset-1">
                                        <label>Submission date : </label>
                                </div>
                                <div class="col-sm-4 ">
                                        <?php echo $student_app_submitted_datetime;?>
                                </div>
                             </div>
                             <!--end admission status information-->
                             <div class="divider"></div>  
				             <div class="form-group">
				               <h4><i class="fa fa-user "></i> Personal Details </h4>
				               <p class="divider"></p>
				             </div>    
		                        <div class="form-group clearfix">
		                            
		                            <div class="col-sm-2 no-pad-left col-md-offset-1">
		                            	<label>Name : </label>
		                        	</div>
		                        	<div class="col-sm-4 ">
		                        		<?php echo $fullname;?>
		                        	</div>
		                        	
		                        </div>
                                <div class="form-group clearfix">
                                    
                                    <div class="col-sm-2 no-pad-left col-md-offset-1">
                                        <label>Email : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                    <input type="text" name="student_email" class="form-control" readonly="readonly" />
                                    </div>
                                    
                                </div>
                                <div class="form-group clearfix">  
                                    <div class="col-sm-2 no-pad-left col-md-offset-1">
                                    <label>Date Of Birth : </label>
                                    </div> 

                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control birth-date" name="student_date_of_birth" value="" placeholder="dd/mm/yyyy" />
	                                </div>
                                </div>      
                                <div class="form-group clearfix"> 
                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
                                    <label>Gender <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                     <select name="student_gender"  class="form-control" required>
                                    	<option value="">Please select</option>
                                    	<option value="male">Male</option>
                                    	<option value="female">Female</option>
                                    </select>
                                    </div>
                                </div>    		                        
                                <div class="form-group clearfix">  
                                	<div class="col-sm-2 no-pad-left col-md-offset-1">
		                            <label>Nationality <small class="red-link">*</small> : </label>
		                            </div>
		                            <div class="col-sm-4 no-pad-right">
		                            <select name="student_nationality"  class="form-control" required>
		                           <!--This part will came from database--> 
								   	<option selected="" value="">Please Select</option><option value="UNITED KINGDOM">UNITED KINGDOM</option><option value="AFGHANISTAN">AFGHANISTAN</option><option value="ALBANIA">ALBANIA</option><option value="ALGERIA">ALGERIA</option><option value="ANDORRA">ANDORRA</option><option value="ANGOLA">ANGOLA</option><option value="ANGUILLA">ANGUILLA</option><option value="ANTIGUA AND BARBUDA">ANTIGUA AND BARBUDA</option><option value="ARGENTINA">ARGENTINA</option><option value="ARMENIA">ARMENIA</option><option value="AUSTRALIA">AUSTRALIA</option><option value="AUSTRIA">AUSTRIA</option><option value="AZERBAIJAN">AZERBAIJAN</option><option value="BAHAMAS">BAHAMAS</option><option value="BAHRAIN">BAHRAIN</option><option value="BANGLADESH">BANGLADESH</option><option value="BARBADOS">BARBADOS</option><option value="BELARUS">BELARUS</option><option value="BELGIUM">BELGIUM</option><option value="BELIZE">BELIZE</option><option value="BENIN">BENIN</option><option value="BERMUDA">BERMUDA</option><option value="BHUTAN">BHUTAN</option><option value="BOLIVIA">BOLIVIA</option><option value="BOSNIA AND HERZEGOVINA">BOSNIA AND HERZEGOVINA</option><option value="BOTSWANA">BOTSWANA</option><option value="BRAZIL">BRAZIL</option><option value="BRITISH INDIAN OCEAN TERRITORY">BRITISH INDIAN OCEAN TERRITORY</option><option value="BRITISH VIRGIN ISLANDS">BRITISH VIRGIN ISLANDS</option><option value="BRUNEI DARUSSALAM">BRUNEI DARUSSALAM</option><option value="BULGARIA">BULGARIA</option><option value="BURKINA FASO">BURKINA FASO</option><option value="BURUNDI">BURUNDI</option><option value="CAMBODIA">CAMBODIA</option><option value="CAMEROON">CAMEROON</option><option value="CANADA">CANADA</option><option value="CAPE VERDE">CAPE VERDE</option><option value="CAYMAN ISLANDS">CAYMAN ISLANDS</option><option value="CENTRAL AFRICAN REPUBLIC">CENTRAL AFRICAN REPUBLIC</option><option value="CHAD">CHAD</option><option value="CHILE">CHILE</option><option value="CHINA">CHINA</option><option value="COLOMBIA">COLOMBIA</option><option value="COMOROS">COMOROS</option><option value="CONGO">CONGO</option><option value="CONGO">CONGO</option><option value=" DEMOCRATIC REPLUBLIC OF"> DEMOCRATIC REPLUBLIC OF</option><option value="COSTA RICA">COSTA RICA</option><option ivoire'="" value="CÔTE D">CÔTE D'IVOIRE</option><option value="CROATIA">CROATIA</option><option value="CUBA">CUBA</option><option value="CYPRUS">CYPRUS</option><option value="CZECH REPUBLIC">CZECH REPUBLIC</option><option value="DENMARK">DENMARK</option><option value="DJIBOUTI">DJIBOUTI</option><option value="DOMINICA">DOMINICA</option><option value="DOMINICAN REPUBLIC">DOMINICAN REPUBLIC</option><option value="ECUADOR">ECUADOR</option><option value="EGYPT">EGYPT</option><option value="EL SALVADOR">EL SALVADOR</option><option value="EQUATORIAL GUINEA">EQUATORIAL GUINEA</option><option value="ERITREA">ERITREA</option><option value="ESTONIA">ESTONIA</option><option value="ETHIOPIA">ETHIOPIA</option><option value="FALKLAND ISLANDS">FALKLAND ISLANDS</option><option value="FIJI">FIJI</option><option value="FINLAND">FINLAND</option><option value="FRANCE">FRANCE</option><option value="GABON">GABON</option><option value="GAMBIA">GAMBIA</option><option value="GEORGIA">GEORGIA</option><option value="GERMANY">GERMANY</option><option value="GHANA">GHANA</option><option value="GIBRALTAR">GIBRALTAR</option><option value="GREECE">GREECE</option><option value="GRENADA">GRENADA</option><option value="GUATEMALA">GUATEMALA</option><option value="GUINEA">GUINEA</option><option value="GUINEA-BISSAU">GUINEA-BISSAU</option><option value="GUYANA">GUYANA</option><option value="HAITI">HAITI</option><option value="HONDURAS">HONDURAS</option><option value="HONG KONG (SPECIAL ADMINISTRATIVE REGION OF CHINA)">HONG KONG (SPECIAL ADMINISTRATIVE REGION OF CHINA)</option><option value="HUNGARY">HUNGARY</option><option value="ICELAND">ICELAND</option><option value="INDIA">INDIA</option><option value="INDONESIA">INDONESIA</option><option value="IRAN">IRAN</option><option value="IRAQ">IRAQ</option><option value="IRELAND">IRELAND</option><option value="ISRAEL">ISRAEL</option><option value="ITALY">ITALY</option><option value="JAMAICA">JAMAICA</option><option value="JAPAN">JAPAN</option><option value="JORDAN">JORDAN</option><option value="KAZAKHSTAN">KAZAKHSTAN</option><option value="KENYA">KENYA</option><option value="KIRIBATI">KIRIBATI</option><option value="KOREA">KOREA</option><option of'="" republic="" democratic="" s="" value=" PEOPLE"> PEOPLE'S DEMOCRATIC REPUBLIC OF</option><option value="KOREA">KOREA</option><option value=" REPUBLIC OF"> REPUBLIC OF</option><option value="KOSOVO">KOSOVO</option><option value="KUWAIT">KUWAIT</option><option value="KYRGYZSTAN">KYRGYZSTAN</option><option value="LAOS">LAOS</option><option republic'="" democratic="" s="" value=" THE LAO PEOPLE"> THE LAO PEOPLE'S DEMOCRATIC REPUBLIC</option><option value="LATVIA">LATVIA</option><option value="LEBANON">LEBANON</option><option value="LESOTHO">LESOTHO</option><option value="LIBERIA">LIBERIA</option><option value="LIBYA">LIBYA</option><option value="LIECHTENSTEIN">LIECHTENSTEIN</option><option value="LITHUANIA">LITHUANIA</option><option value="LUXEMBOURG">LUXEMBOURG</option><option value="MACAO (SPECIAL ADMINISTRATIVE REGION OF CHINA)">MACAO (SPECIAL ADMINISTRATIVE REGION OF CHINA)</option><option value="MACEDONIA">MACEDONIA</option><option value=" FORMER YUGOSLAV REP. OF"> FORMER YUGOSLAV REP. OF</option><option value="MADAGASCAR">MADAGASCAR</option><option value="MALAWI">MALAWI</option><option value="MALAYSIA">MALAYSIA</option><option value="MALDIVES">MALDIVES</option><option value="MALI">MALI</option><option value="MALTA">MALTA</option><option value="MARSHALL ISLANDS">MARSHALL ISLANDS</option><option value="MAURITANIA">MAURITANIA</option><option value="MAURITIUS">MAURITIUS</option><option value="MEXICO">MEXICO</option><option value="MICRONESIA">MICRONESIA</option><option value=" FED.STATES OF"> FED.STATES OF</option><option value="MOLDOVA">MOLDOVA</option><option value=" REPUBLIC OF"> REPUBLIC OF</option><option value="MONACO">MONACO</option><option value="MONGOLIA">MONGOLIA</option><option value="MONTENEGRO">MONTENEGRO</option><option value="MONTSERRAT">MONTSERRAT</option><option value="MOROCCO">MOROCCO</option><option value="MOZAMBIQUE">MOZAMBIQUE</option><option value="BURMA (UNION OF MYANMAR)">BURMA (UNION OF MYANMAR)</option><option value="NAMIBIA">NAMIBIA</option><option value="NAURU">NAURU</option><option value="NEPAL">NEPAL</option><option value="NETHERLANDS">NETHERLANDS</option><option value="NEW ZEALAND">NEW ZEALAND</option><option value="NICARAGUA">NICARAGUA</option><option value="NIGER">NIGER</option><option value="NIGERIA">NIGERIA</option><option value="NORWAY">NORWAY</option><option value="OMAN">OMAN</option><option value="PAKISTAN">PAKISTAN</option><option value="PALAU">PALAU</option><option value="PALESTINIAN TERRITORY">PALESTINIAN TERRITORY</option><option value=" OCC"> OCC</option><option value="PANAMA">PANAMA</option><option value="PAPUA NEW GUINEA">PAPUA NEW GUINEA</option><option value="PARAGUAY">PARAGUAY</option><option value="PERU">PERU</option><option value="PHILIPPINES">PHILIPPINES</option><option value="PITCAIRN">PITCAIRN</option><option value="POLAND">POLAND</option><option value="PORTUGAL">PORTUGAL</option><option value="PUERTO RICO">PUERTO RICO</option><option value="QATAR">QATAR</option><option value="ROMANIA">ROMANIA</option><option value="RUSSIAN FEDERATION">RUSSIAN FEDERATION</option><option value="RWANDA">RWANDA</option><option value="SAINT HELENA">SAINT HELENA</option><option value="SAINT KITTS AND NEVIS">SAINT KITTS AND NEVIS</option><option value="SAINT LUCIA">SAINT LUCIA</option><option value="ST VINCENT &amp; THE GRENADINES">ST VINCENT &amp; THE GRENADINES</option><option value="SAMOA">SAMOA</option><option value="SAO TOME AND PRINCIPE">SAO TOME AND PRINCIPE</option><option value="SAUDI ARABIA">SAUDI ARABIA</option><option value="SENEGAL">SENEGAL</option><option value="SERBIA">SERBIA</option><option value="SEYCHELLES">SEYCHELLES</option><option value="SIERRA LEONE">SIERRA LEONE</option><option value="SINGAPORE">SINGAPORE</option><option value="SLOVAKIA">SLOVAKIA</option><option value="SLOVENIA">SLOVENIA</option><option value="SOLOMON ISLANDS">SOLOMON ISLANDS</option><option value="SOMALIA">SOMALIA</option><option value="SOUTH AFRICA">SOUTH AFRICA</option><option value="STH GEORGIA &amp; SANDWICH ISL.">STH GEORGIA &amp; SANDWICH ISL.</option><option value="SPAIN">SPAIN</option><option value="SRI LANKA">SRI LANKA</option><option value="STATELESS REFUGEE OTHER">STATELESS REFUGEE OTHER</option><option value="STATELESS EXC HK/PALESTINE">STATELESS EXC HK/PALESTINE</option><option value=" 1954 CONV"> 1954 CONV</option><option value="STATELESS REFUGEE 1951 CONV">STATELESS REFUGEE 1951 CONV</option><option value="SUDAN">SUDAN</option><option value="SURINAME">SURINAME</option><option value="SWAZILAND">SWAZILAND</option><option value="SWEDEN">SWEDEN</option><option value="SWITZERLAND">SWITZERLAND</option><option value="SYRIA">SYRIA</option><option value="TAIWAN">TAIWAN</option><option value="TAJIKISTAN">TAJIKISTAN</option><option value="TANZANIA">TANZANIA</option><option value=" UNITED REPUBLIC OF"> UNITED REPUBLIC OF</option><option value="THAILAND">THAILAND</option><option value="TIMOR-LESTE">TIMOR-LESTE</option><option value="TOGO">TOGO</option><option value="TONGA">TONGA</option><option value="TRINIDAD AND TOBAGO">TRINIDAD AND TOBAGO</option><option value="TRISTAN DA CUNHA">TRISTAN DA CUNHA</option><option value="TUNISIA">TUNISIA</option><option value="TURKEY">TURKEY</option><option value="TURKMENISTAN">TURKMENISTAN</option><option value="TURKS AND CAICOS ISLANDS">TURKS AND CAICOS ISLANDS</option><option value="TURKISH/REP OF NRTH CYPRUS">TURKISH/REP OF NRTH CYPRUS</option><option value="UGANDA">UGANDA</option><option value="UKRAINE">UKRAINE</option><option value="UNION OF SOVIET SOCIALIST REPUBLICS (USSR)(UNTIL 1991)">UNION OF SOVIET SOCIALIST REPUBLICS (USSR)(UNTIL 1991)</option><option value="UNITED ARAB EMIRATES">UNITED ARAB EMIRATES</option><option value="UNITED STATES">UNITED STATES</option><option value="US MINOR OUTLYING ISLANDS">US MINOR OUTLYING ISLANDS</option><option value="URUGUAY">URUGUAY</option><option value="UZBEKISTAN">UZBEKISTAN</option><option value="VANUATU">VANUATU</option><option value="VATICAN CITY">VATICAN CITY</option><option value="VENEZUELA">VENEZUELA</option><option value="VIETNAM">VIETNAM</option><option value="YEMEN">YEMEN</option><option value="ZAMBIA">ZAMBIA</option><option value="ZIMBABWE">ZIMBABWE</option>   
		                           <!--End of this nationality part--> 
		                            </select>
		                            </div>
		                        </div><!-- end of Nationality selection -->	
                                <div class="form-group clearfix"> 
                                	<div class="col-sm-2 no-pad-left col-md-offset-1">
                                     <label>Country of Birth <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
		                            <select name="student_country_of_birth"  class="form-control" required>
                                     <!--This part will came from database--> 
								   	 <option selected="" value="">Please Select</option><option value="UNITED KINGDOM">UNITED KINGDOM</option><option value="AFGHANISTAN">AFGHANISTAN</option><option value="ALBANIA">ALBANIA</option><option value="ALGERIA">ALGERIA</option><option value="ANDORRA">ANDORRA</option><option value="ANGOLA">ANGOLA</option><option value="ANGUILLA">ANGUILLA</option><option value="ANTIGUA AND BARBUDA">ANTIGUA AND BARBUDA</option><option value="ARGENTINA">ARGENTINA</option><option value="ARMENIA">ARMENIA</option><option value="AUSTRALIA">AUSTRALIA</option><option value="AUSTRIA">AUSTRIA</option><option value="AZERBAIJAN">AZERBAIJAN</option><option value="BAHAMAS">BAHAMAS</option><option value="BAHRAIN">BAHRAIN</option><option value="BANGLADESH">BANGLADESH</option><option value="BARBADOS">BARBADOS</option><option value="BELARUS">BELARUS</option><option value="BELGIUM">BELGIUM</option><option value="BELIZE">BELIZE</option><option value="BENIN">BENIN</option><option value="BERMUDA">BERMUDA</option><option value="BHUTAN">BHUTAN</option><option value="BOLIVIA">BOLIVIA</option><option value="BOSNIA AND HERZEGOVINA">BOSNIA AND HERZEGOVINA</option><option value="BOTSWANA">BOTSWANA</option><option value="BRAZIL">BRAZIL</option><option value="BRITISH INDIAN OCEAN TERRITORY">BRITISH INDIAN OCEAN TERRITORY</option><option value="BRITISH VIRGIN ISLANDS">BRITISH VIRGIN ISLANDS</option><option value="BRUNEI DARUSSALAM">BRUNEI DARUSSALAM</option><option value="BULGARIA">BULGARIA</option><option value="BURKINA FASO">BURKINA FASO</option><option value="BURUNDI">BURUNDI</option><option value="CAMBODIA">CAMBODIA</option><option value="CAMEROON">CAMEROON</option><option value="CANADA">CANADA</option><option value="CAPE VERDE">CAPE VERDE</option><option value="CAYMAN ISLANDS">CAYMAN ISLANDS</option><option value="CENTRAL AFRICAN REPUBLIC">CENTRAL AFRICAN REPUBLIC</option><option value="CHAD">CHAD</option><option value="CHILE">CHILE</option><option value="CHINA">CHINA</option><option value="COLOMBIA">COLOMBIA</option><option value="COMOROS">COMOROS</option><option value="CONGO">CONGO</option><option value="CONGO">CONGO</option><option value=" DEMOCRATIC REPLUBLIC OF"> DEMOCRATIC REPLUBLIC OF</option><option value="COSTA RICA">COSTA RICA</option><option ivoire'="" value="CÔTE D">CÔTE D'IVOIRE</option><option value="CROATIA">CROATIA</option><option value="CUBA">CUBA</option><option value="CYPRUS">CYPRUS</option><option value="CZECH REPUBLIC">CZECH REPUBLIC</option><option value="DENMARK">DENMARK</option><option value="DJIBOUTI">DJIBOUTI</option><option value="DOMINICA">DOMINICA</option><option value="DOMINICAN REPUBLIC">DOMINICAN REPUBLIC</option><option value="ECUADOR">ECUADOR</option><option value="EGYPT">EGYPT</option><option value="EL SALVADOR">EL SALVADOR</option><option value="EQUATORIAL GUINEA">EQUATORIAL GUINEA</option><option value="ERITREA">ERITREA</option><option value="ESTONIA">ESTONIA</option><option value="ETHIOPIA">ETHIOPIA</option><option value="FALKLAND ISLANDS">FALKLAND ISLANDS</option><option value="FIJI">FIJI</option><option value="FINLAND">FINLAND</option><option value="FRANCE">FRANCE</option><option value="GABON">GABON</option><option value="GAMBIA">GAMBIA</option><option value="GEORGIA">GEORGIA</option><option value="GERMANY">GERMANY</option><option value="GHANA">GHANA</option><option value="GIBRALTAR">GIBRALTAR</option><option value="GREECE">GREECE</option><option value="GRENADA">GRENADA</option><option value="GUATEMALA">GUATEMALA</option><option value="GUINEA">GUINEA</option><option value="GUINEA-BISSAU">GUINEA-BISSAU</option><option value="GUYANA">GUYANA</option><option value="HAITI">HAITI</option><option value="HONDURAS">HONDURAS</option><option value="HONG KONG (SPECIAL ADMINISTRATIVE REGION OF CHINA)">HONG KONG (SPECIAL ADMINISTRATIVE REGION OF CHINA)</option><option value="HUNGARY">HUNGARY</option><option value="ICELAND">ICELAND</option><option value="INDIA">INDIA</option><option value="INDONESIA">INDONESIA</option><option value="IRAN">IRAN</option><option value="IRAQ">IRAQ</option><option value="IRELAND">IRELAND</option><option value="ISRAEL">ISRAEL</option><option value="ITALY">ITALY</option><option value="JAMAICA">JAMAICA</option><option value="JAPAN">JAPAN</option><option value="JORDAN">JORDAN</option><option value="KAZAKHSTAN">KAZAKHSTAN</option><option value="KENYA">KENYA</option><option value="KIRIBATI">KIRIBATI</option><option value="KOREA">KOREA</option><option of'="" republic="" democratic="" s="" value=" PEOPLE"> PEOPLE'S DEMOCRATIC REPUBLIC OF</option><option value="KOREA">KOREA</option><option value=" REPUBLIC OF"> REPUBLIC OF</option><option value="KOSOVO">KOSOVO</option><option value="KUWAIT">KUWAIT</option><option value="KYRGYZSTAN">KYRGYZSTAN</option><option value="LAOS">LAOS</option><option republic'="" democratic="" s="" value=" THE LAO PEOPLE"> THE LAO PEOPLE'S DEMOCRATIC REPUBLIC</option><option value="LATVIA">LATVIA</option><option value="LEBANON">LEBANON</option><option value="LESOTHO">LESOTHO</option><option value="LIBERIA">LIBERIA</option><option value="LIBYA">LIBYA</option><option value="LIECHTENSTEIN">LIECHTENSTEIN</option><option value="LITHUANIA">LITHUANIA</option><option value="LUXEMBOURG">LUXEMBOURG</option><option value="MACAO (SPECIAL ADMINISTRATIVE REGION OF CHINA)">MACAO (SPECIAL ADMINISTRATIVE REGION OF CHINA)</option><option value="MACEDONIA">MACEDONIA</option><option value=" FORMER YUGOSLAV REP. OF"> FORMER YUGOSLAV REP. OF</option><option value="MADAGASCAR">MADAGASCAR</option><option value="MALAWI">MALAWI</option><option value="MALAYSIA">MALAYSIA</option><option value="MALDIVES">MALDIVES</option><option value="MALI">MALI</option><option value="MALTA">MALTA</option><option value="MARSHALL ISLANDS">MARSHALL ISLANDS</option><option value="MAURITANIA">MAURITANIA</option><option value="MAURITIUS">MAURITIUS</option><option value="MEXICO">MEXICO</option><option value="MICRONESIA">MICRONESIA</option><option value=" FED.STATES OF"> FED.STATES OF</option><option value="MOLDOVA">MOLDOVA</option><option value=" REPUBLIC OF"> REPUBLIC OF</option><option value="MONACO">MONACO</option><option value="MONGOLIA">MONGOLIA</option><option value="MONTENEGRO">MONTENEGRO</option><option value="MONTSERRAT">MONTSERRAT</option><option value="MOROCCO">MOROCCO</option><option value="MOZAMBIQUE">MOZAMBIQUE</option><option value="BURMA (UNION OF MYANMAR)">BURMA (UNION OF MYANMAR)</option><option value="NAMIBIA">NAMIBIA</option><option value="NAURU">NAURU</option><option value="NEPAL">NEPAL</option><option value="NETHERLANDS">NETHERLANDS</option><option value="NEW ZEALAND">NEW ZEALAND</option><option value="NICARAGUA">NICARAGUA</option><option value="NIGER">NIGER</option><option value="NIGERIA">NIGERIA</option><option value="NORWAY">NORWAY</option><option value="OMAN">OMAN</option><option value="PAKISTAN">PAKISTAN</option><option value="PALAU">PALAU</option><option value="PALESTINIAN TERRITORY">PALESTINIAN TERRITORY</option><option value=" OCC"> OCC</option><option value="PANAMA">PANAMA</option><option value="PAPUA NEW GUINEA">PAPUA NEW GUINEA</option><option value="PARAGUAY">PARAGUAY</option><option value="PERU">PERU</option><option value="PHILIPPINES">PHILIPPINES</option><option value="PITCAIRN">PITCAIRN</option><option value="POLAND">POLAND</option><option value="PORTUGAL">PORTUGAL</option><option value="PUERTO RICO">PUERTO RICO</option><option value="QATAR">QATAR</option><option value="ROMANIA">ROMANIA</option><option value="RUSSIAN FEDERATION">RUSSIAN FEDERATION</option><option value="RWANDA">RWANDA</option><option value="SAINT HELENA">SAINT HELENA</option><option value="SAINT KITTS AND NEVIS">SAINT KITTS AND NEVIS</option><option value="SAINT LUCIA">SAINT LUCIA</option><option value="ST VINCENT &amp; THE GRENADINES">ST VINCENT &amp; THE GRENADINES</option><option value="SAMOA">SAMOA</option><option value="SAO TOME AND PRINCIPE">SAO TOME AND PRINCIPE</option><option value="SAUDI ARABIA">SAUDI ARABIA</option><option value="SENEGAL">SENEGAL</option><option value="SERBIA">SERBIA</option><option value="SEYCHELLES">SEYCHELLES</option><option value="SIERRA LEONE">SIERRA LEONE</option><option value="SINGAPORE">SINGAPORE</option><option value="SLOVAKIA">SLOVAKIA</option><option value="SLOVENIA">SLOVENIA</option><option value="SOLOMON ISLANDS">SOLOMON ISLANDS</option><option value="SOMALIA">SOMALIA</option><option value="SOUTH AFRICA">SOUTH AFRICA</option><option value="STH GEORGIA &amp; SANDWICH ISL.">STH GEORGIA &amp; SANDWICH ISL.</option><option value="SPAIN">SPAIN</option><option value="SRI LANKA">SRI LANKA</option><option value="STATELESS REFUGEE OTHER">STATELESS REFUGEE OTHER</option><option value="STATELESS EXC HK/PALESTINE">STATELESS EXC HK/PALESTINE</option><option value=" 1954 CONV"> 1954 CONV</option><option value="STATELESS REFUGEE 1951 CONV">STATELESS REFUGEE 1951 CONV</option><option value="SUDAN">SUDAN</option><option value="SURINAME">SURINAME</option><option value="SWAZILAND">SWAZILAND</option><option value="SWEDEN">SWEDEN</option><option value="SWITZERLAND">SWITZERLAND</option><option value="SYRIA">SYRIA</option><option value="TAIWAN">TAIWAN</option><option value="TAJIKISTAN">TAJIKISTAN</option><option value="TANZANIA">TANZANIA</option><option value=" UNITED REPUBLIC OF"> UNITED REPUBLIC OF</option><option value="THAILAND">THAILAND</option><option value="TIMOR-LESTE">TIMOR-LESTE</option><option value="TOGO">TOGO</option><option value="TONGA">TONGA</option><option value="TRINIDAD AND TOBAGO">TRINIDAD AND TOBAGO</option><option value="TRISTAN DA CUNHA">TRISTAN DA CUNHA</option><option value="TUNISIA">TUNISIA</option><option value="TURKEY">TURKEY</option><option value="TURKMENISTAN">TURKMENISTAN</option><option value="TURKS AND CAICOS ISLANDS">TURKS AND CAICOS ISLANDS</option><option value="TURKISH/REP OF NRTH CYPRUS">TURKISH/REP OF NRTH CYPRUS</option><option value="UGANDA">UGANDA</option><option value="UKRAINE">UKRAINE</option><option value="UNION OF SOVIET SOCIALIST REPUBLICS (USSR)(UNTIL 1991)">UNION OF SOVIET SOCIALIST REPUBLICS (USSR)(UNTIL 1991)</option><option value="UNITED ARAB EMIRATES">UNITED ARAB EMIRATES</option><option value="UNITED STATES">UNITED STATES</option><option value="US MINOR OUTLYING ISLANDS">US MINOR OUTLYING ISLANDS</option><option value="URUGUAY">URUGUAY</option><option value="UZBEKISTAN">UZBEKISTAN</option><option value="VANUATU">VANUATU</option><option value="VATICAN CITY">VATICAN CITY</option><option value="VENEZUELA">VENEZUELA</option><option value="VIETNAM">VIETNAM</option><option value="YEMEN">YEMEN</option><option value="ZAMBIA">ZAMBIA</option><option value="ZIMBABWE">ZIMBABWE</option>   
		                             <!--End of this nationality part--> 
		                            </select><!-- end of country selection -->
		                            </div>
                                </div>	
                                <div class="form-group clearfix"> 
                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
                                    <label>Marital Status <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-5 no-pad-right">
                                           <div class="radio  radio-success  radio-inline">
                                         <input id="RadioGroup1_0" type="radio" required checked="checked"  value="Single" name="student_marital_status"> <label for="RadioGroup1_0"> Single </label> 
                                        </div>
                                        <div class="radio  radio-danger  radio-inline">
                                        <input id="RadioGroup1_1" type="radio" required  value="Married" name="student_marital_status">  <label for="RadioGroup1_1"> Married  </label>
                                        </div>
                                        <div class="radio  radio-warning  radio-inline">
                                        <input id="RadioGroup1_2" type="radio" required  value="Divorced" name="student_marital_status"><label for="RadioGroup1_2"> Divorced  </label>
                                        </div>
                                        <div class="radio  radio-info  radio-inline">
                                        <input id="RadioGroup1_3" type="radio" required  value="Separated" name="student_marital_status"><label for="RadioGroup1_3">  Separated </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
				               		<p class="divider"></p>
				               		<h4><i class="fa fa-envelope "></i> Contact Details </h4>
				               		<p class="divider"></p>
				             	</div>
				             	<div class="form-group clearfix">
                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
                                    <label>Home Phone : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                     <input type="text" class="form-control" name="student_home_phone" value="" placeholder="home phone ex. +440121212..." />
                                    </div>
                                </div>  
                                <div class="form-group clearfix">
                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
                                    <label>Mobile Phone <small class="red-link">*</small> : </label>  
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                     <input type="text" class="form-control" name="student_mobile_phone" required value="" placeholder="mobile phone  ex. +440777..." />
                                    </div>
                                </div> 
<!--                                <div class="form-group clearfix">
                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
                                    <label>Address <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-2  no-pad-right">
                                      <input type="button" class="form-control btn btn-info" name="manaul_poscode" value="Enter Manualy" />
                                  
                                    </div><div class="col-sm-2 no-pad-right">
                                       <input type="button" class="form-control btn btn-warning" name="temp_post_code" value="Find postcode" />
                                  
                                    </div>
                                </div>-->
                                <div class="address-details">
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
	                                    <label>Address 1 <small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                      <input type="text" class="form-control" required name="student_address_address_line_1" value="" placeholder="Address 1" />
	                                    </div>
	                                </div> 
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
	                                    <label>Address 2 : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                      <input type="text" class="form-control" name="student_address_address_line_2" value="" placeholder="Address 2" />
	                                    </div>
	                                </div>  
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
	                                    <label>State/County : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                      <input type="text" class="form-control" name="student_address_state_province_region" value="" placeholder="State or County " />
	                                    </div>
	                                </div>  
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
	                                    <label>Postal code <small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                      <input type="text" class="form-control" required name="student_address_postal_zip_code" value="" placeholder="post code" />
	                                    </div>
	                                </div>  
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
	                                    <label>City <small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                      <input type="text" class="form-control" required name="student_address_city" value="" placeholder="City" />
	                                    </div>
	                                </div>  
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
	                                    <label>Country <small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                      <input type="text" class="form-control" required name="student_address_country" value="" placeholder="Country" />
	                                    </div>
	                                </div> 
                                </div> 
                                <div class="course-info">   
                                <div class="form-group">
                                	<p class="divider"></p>
				               		<h4><i class="fa fa-book "></i> Proposed Course </h4>
				               		<p class="divider"></p>
				             	</div>
				             	<div class="msg"></div>

				             	<div class="form-group clearfix">
                                
	                                   <div class="col-sm-4 col-xs-3 no-pad col-md-offset-1">
	                                    <label>Semester<small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-4  col-xs-7 no-pad-right">   
	                                     <select name="student_semister"  class="form-control" required>
                                    	<option value="">Please select</option>
                                    	<?php foreach ($semesterlist as $semester_id => $name): ?>
                                    	<option  value="<?php echo $semester_id; ?>"><?php echo $name; ?></option>
                                    	<?php endforeach;?>
                                    	</select>       
	                                    </div>
	                                    <div class="col-sm-1   col-xs-1">
	                                    	<img class="loading" src="<?php echo base_url();?>images/loading.png" alt="">
	                                    </div>
	                                </div>
	                               <div class="course-box">
                                           <div class="form-group clearfix">
                                        
                                               <div class="col-sm-4 col-xs-3 no-pad col-md-offset-1">
                                                <label>Course <small class="red-link">*</small> : </label>
                                                </div>
                                                <div class="col-sm-4  col-xs-7 no-pad-right">   
                                                 <select name="student_course"  class="form-control" required>
                                                <option value="">Please select</option>
                                                <?php $courselist=$this->course->get_all();?>
                                                <?php foreach ($courselist as $course): ?>
                                                <option  value="<?php echo $course['id']; ?>"><?php echo $course['course_name']; ?></option>
                                                <?php endforeach;?>
                                                </select>       
                                                </div>
                                                <div class="col-sm-1   col-xs-1">
                                                    <img class="loading" src="<?php echo base_url();?>images/loading.png" alt="">
                                                </div>
                                            </div>
	                               </div> <!--end of course box ajax wrapper-->
                                 <div class="form-group clearfix">
                                   <div class="col-sm-4 no-pad col-md-offset-1">
                                    <label>How are you funding your education at London Churchill College? <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                     <select name="student_funding_type"  class="form-control" >
                                          <option value="n/a">Please select</option>
                                          <option value="Private">Independently/Private</option>
                                          <option value="Funding Body">Funding Body</option>
                                          <option value="Sponsor">Sponsor</option>
                                          <option value="Student Loan">Student Loan</option>
                                          <option value="Other">Other</option>  
                
                                    </select>
                                    </div>
                                </div> 
                                <div id="fundingoption">
                                <div class="form-group clearfix">
                                   <div class="col-sm-4 no-pad col-md-offset-1">
                                    <label>If your funding is through Student Finance England, please choose from the following. Have you applied for the proposed course? <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                     <select name="student_student_loan_applied_for_the_proposed_course"  class="form-control" >
                                          <option value="n/a">Please select</option>
                                          <option value="no">No</option>
                                          <option value="yes">Yes</option>
                                    </select>
                                    </div>
                                </div>  
                                </div>
                                <div id="fundingoption2">
                                <div class="form-group clearfix">
                                   <div class="col-sm-4 no-pad col-md-offset-1">
                                    <label>Are you already in receipt of funds? <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                     <select name="student_already_in_receipt_of_funds"  class="form-control" >
                                          <option value="no">No</option>
                                          <option value="yes">Yes</option>
                                    </select>
                                    </div>
                                </div>
                                </div>
                                <div id="fundingoption3">
                                <div class="form-group clearfix">
                                   <div class="col-sm-4 no-pad col-md-offset-1">
                                    <label>Please type other fundings <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                     <input type="text" name="student_funding_type_other"  class="form-control" >
                                    </div>
                                </div>
                                </div>                                     
				             	</div>
				             	 <!--this part came from the database -->
				             	<div class="education-qulification"> 
				             	<div class="form-group">
				             		<p class="divider"></p>
				               		<h4><i class="fa fa-mortar-board "></i> Education Qualification </h4>
				               		<p class="divider"></p>
				             	</div>
				             	
				             	<div class="form-group clearfix">
                                   <div class="col-sm-4 no-pad col-md-offset-1">
                                    <label>Do you have any formal academic qualification? <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                     <select name=""  class="form-control student_formal_education" required>
                                    	<option value="">Please select</option>
                                    	<option value="yes">Yes</option>
                                    	<option value="no">No</option>
                                    </select>
                                    </div>
                                </div> 
	                                <div class="qualification-details">
				             		<div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Highest Academic Qualification : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control" name="student_educational_qualification_highest_academic_qualification" value="" placeholder="Qualification" />
	                                    </div>
	                                </div> 
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad  col-md-offset-1">
	                                    <label>Awarding Body : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control" name="student_educational_qualification_awarding_body" value="" placeholder="Awarding Body" />
	                                    </div>
	                                </div> 
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad  col-md-offset-1">
	                                    <label>Subjects : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control" name="student_educational_qualification_subjects" value="" placeholder="subjects" />
	                                    </div>
	                                </div> 
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad  col-md-offset-1">
	                                    <label>Results : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control" name="student_educational_qualification_results" value="" placeholder="results" />
	                                    </div>
	                                </div> 
	                                <div class="form-group clearfix">
	                                    <div class="col-sm-4 no-pad  col-md-offset-1">
	                                    <label>Date Of Award : </label>
	                                    </div> 
	                                    
	                                    <div class="col-sm-4 no-pad-right">
                                        <input type="text" class="form-control  employment-date" name="student_educational_qualification_award_date" value="" placeholder="mm/yyyy" />
	                                    </div>
	                                    
	                                </div>                                
	                                </div><!--End of .qualification-details-->
				             	</div> <!--End of education qualification-->    
				             	<div class="employment-history"> 
				             	<div class="form-group">
				             		<p class="divider"></p>
				               		<h4><i class="fa fa-briefcase "></i> Employment History </h4>
				               		<p class="divider"></p>
				             	</div>
				             	<div class="form-group clearfix">
                                    <div class="col-sm-4 no-pad col-md-offset-1 ">
                                     <label>What is your current employment status? <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                     <select name="student_employment_history_current_employment_status"  class="form-control" required>
                                    	<option value="n/a">Please select</option>
                                    	<option value="Part Time">Part Time</option>
										<option value="Fixed Term">Fixed Term</option>
										<option value="Contractor">Contractor</option>
										<option value="Zero Hour">Zero Hour</option>
										<option value="Seasonal">Seasonal</option>
										<option value="Agency or Temp">Agency or Temp</option>
										<option value="Consultant">Consultant</option>
										<option value="Office Holder">Office Holder</option>
										<option value="Volunteer">Volunteer</option>
										<option value="Unemployed">Unemployed</option>
                                    </select>
                                    </div>
                                </div>
	                                <div class="employment-info">
	                                <div class="col-md-offset-1"><p style="color: #4d4d4d;"> <small class="red-link">*</small> If you have been employed in any way, in the past one year, please fill the field below.</p></div>
	                                <div class="clearfix"></div>
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Company Name, Address & Phone No : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control" name="student_employment_history_company" value="" placeholder="Company Name, Address & Phone No" />
	                                    </div>
	                                </div>
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Position : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control" name="student_employment_history_position" value="" placeholder="Position" />
	                                    </div>
	                                </div>
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Start Date : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control employment-date" name="student_employment_history_start_date" value="" placeholder="mm/yyyy" />
	                                    </div>
	                                </div>            
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>End Date : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control employment-date" name="student_employment_history_end_date" value="" placeholder="mm/yyyy" />
	                                    </div>
	                                </div> 
	                                <div class="form-group clearfix">
	                                    <label>Reference : </label>
	                                </div>
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Contact Name : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control" name="student_job_reference_contact_name" value="" placeholder="Contact Name" />
	                                    </div>
	                                </div>
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Position : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control" name="student_job_reference_position" value="" placeholder="Position" />
	                                    </div>
	                                </div>
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Phone : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control " name="student_job_reference_phone" value="" placeholder="Phone" />
	                                    </div>
	                                </div>
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Email : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control " name="student_job_reference_email" value="" placeholder="Email" />
	                                    </div>
	                                </div>
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Company Name & Address : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control " name="student_job_reference_company_name_address" value="" placeholder="Company Name & Address" />
	                                    </div>
	                                </div>
	                                </div> <!--End of .employment-info-->  
				             	</div> <!--End of .employment-history-->  
				             	<div class="others"> 
				             	<div class="form-group">
				             	    <p class="divider"></p>
				               		<h4><i class="fa fa-cubes "></i> Others </h4>
				               		<p class="divider"></p>
				             	</div>
				             	<div class="form-group clearfix">
                                   <div class="col-sm-4 no-pad  col-md-offset-1">
                                    <label>Do you have any disabilities that require arrangements from the college or special needs that applies to you? <small class="red-link">*</small> </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                     <select  class="form-control student_others_disabilities_on" required>
                                    	<option value="">Please select</option>
                                    	<option value="yes">Yes</option>
										<option value="no">No</option>
                                    </select>
                                    </div>
                                </div>
				             	 <div class="disabilities-info"> 
	                                <div class="form-group clearfix">
	                                    
	                                    <div class="col-sm-5">
	                                    </div>

	                                    <div class="col-sm-6">
                                            <div class="row">
		                                    <div class="col-sm-6">
                                            <div class="checkbox checkbox-primary">
                                            <input type="checkbox" id="disicheckbox1" value="blind or partially sighted" name="student_others_disabilities[]">
											 <label for="disicheckbox1">Blind/partially sighted</label>  
											</div>
                                            <div class="checkbox checkbox-primary">
                                            <input type="checkbox" id="disicheckbox2" value="mobility issues" name="student_others_disabilities[]">
                                             <label for="disicheckbox2">Mobility Issues</label>
                                             </div> 
                                            <div class="checkbox checkbox-primary">
                                            <input type="checkbox" id="disicheckbox3" value="ADD or ADHD" name="student_others_disabilities[]">
                                             <label for="disicheckbox3">ADD/ADHD</label>
                                             </div> 
                                             
                                            <div class="checkbox checkbox-primary">
                                            <input type="checkbox" id="disicheckbox4" value="asthma" name="student_others_disabilities[]">
                                             <label for="disicheckbox4">Asthma</label>
                                             </div> 
                                             
                                            <div class="checkbox checkbox-primary">
                                            <input type="checkbox" id="disicheckbox5" value="Dyslexia" name="student_others_disabilities[]">
                                             <label for="disicheckbox5">Dyslexia</label>
                                             </div> 
                                             </div>
                                             <div class="col-sm-6">
                                            <div class="checkbox checkbox-primary">
                                            <input type="checkbox" id="disicheckbox6" value="Epilepsy" name="student_others_disabilities[]">
                                             <label for="disicheckbox6">Epilepsy</label>
                                             </div> 
                                            
                                            <div class="checkbox checkbox-primary">
                                            <input type="checkbox" id="disicheckbox7" value="Epilepsy" name="student_others_disabilities[]">
                                             <label for="disicheckbox7">Epilepsy</label>
                                             </div> 
                                            
                                            <div class="checkbox checkbox-primary">
                                            <input type="checkbox" id="disicheckbox8" value="Deaf or hearing impairment" name="student_others_disabilities[]">
                                             <label for="disicheckbox8">Deaf/hearing impairment</label>
                                             </div> 
                                            
                                            <div class="checkbox checkbox-primary">
											<input type="checkbox" id="disicheckbox9" value="Mental health difficulties" name="student_others_disabilities[]">
											 <label for="disicheckbox9">Mental Health Difficulties</label>
                                             </div> 
											</div>
                                            </div>
											
	                                    </div>

	                                </div>
	                                <div class="form-group clearfix">
	                                    <div class="col-sm-5">
		                                    <label class="sr-only">Other : </label>
		                                    </div>
	                                    <div class="col-sm-3 ">
											<input type="text" class="form-control othertext" name="student_others_disabilities[]" placeholder="Others disabilities">
	                                    </div>
	                                </div>
	                             </div> <!--End of .disabilities-info-->  
	                             <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad  col-md-offset-1">
	                                    <label>Ethnicity <small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                    <select name="student_others_ethnicity"  class="form-control" required>
                                    	<option value="">Please select</option>
                                    	
											<option value="White British">White British</option>
											<option value="White (other)">White (other)</option>
											<option value="Indian">Indian</option>
											<option value="Pakistani">Pakistani</option>
											<option value="Bangladeshi">Bangladeshi</option>
											<option value="White Irish">White Irish</option>
											<option value="Mixed Race">Mixed Race</option>
											<option value="Black Caribbean">Black Caribbean</option>
											<option value="Black African">Black African</option>
											<option value="Chinese">Chinese</option>
											<option value="Other Asian (Non-Chinese)">Other Asian (Non-Chinese)</option>
											<option value="Black Others">Black Others</option>
											<option value="Other">Other</option>
                                    	</select>
                                    	</div>
	                             </div>
	                             <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad  col-md-offset-1">
	                                    <label>How did you know about the college? <small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                    <select name="student_others_marketing_info_referred_by"  class="form-control" required>
                                    	<option value="n/a">Please select</option>
                                    	<option value="student_own">I came to the college on my own.</option>
										<option value="student_referred">Somebody referred me.</option>
										<option value="agent_referred">From agent.</option>
                                    	</select>
                                    	</div>
	                             </div>
	                             <div class="reffered-claim">
	                             <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Name : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right ">
	                                    <input type="text" class="form-control " name="student_others_marketing_info_referred_name" value="" placeholder=" Name " />
	                                    </div>
	                             </div>
	                             <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Phone no : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                    <input type="text" class="form-control " name="student_others_marketing_info_referred_phone" value="" placeholder=" Phone no " />
	                                    </div>
	                             </div>
	                             </div>
	                             <div class="agent-claim">
	                             <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Agent name : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                    <select name="agent_id"  class="form-control" >
                                    	<option value="">Please select</option>
                                    	
											<?php foreach($agent_list as $agent): ?>
											<option value="<?php echo $agent["id"]; ?>"><?php echo $agent["agent_name"];?></option>
										    <?php endforeach;?>
                                    	</select>
                                    	</div>
	                             </div>
	                             
	                             </div>
	                             <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Declaration <small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-7 no-pad-right">
                                         <div class="checkbox text-justify checkbox-success"><input id="checkbox1d" type="checkbox" checked="checked" required name="declaration"><label for="checkbox1d"> I confirm that the information in this form is Correct and Factual to the best of my knowledge. I am responsible to keep abreast of the <a href="<?php echo $settings["college_terms"];?>" target="_blank"> Terms & Conditions </a> and the College policies and agree to abide by them. I've read the College's <a href="<?php echo $settings["college_terms"];?>" target="_blank"> Terms and Conditions</a> and other Legal Policies and agree to follow them during my entire course of study.</label>
                                         </div>          
                                    	</div>
	                             </div>
	                             
				             	</div> <!--End of .others-->                   
		           		</div>

		           		
		           		<div class="clearfix"></div>
		           		
		           		    <p class="divider"></p>
		           			<div class="col-sm-4">
                				
	                		</div>
			                <div  class="col-sm-8 text-right">
                                     <?php //if(!empty($staff_privileges_student_admission['std_ad_status'])){ ?><button type="button" name="changestatusbutton" class="btn btn-md btn-warning changestatusbutton"><i class="fa fa-check"></i> Change status</button><?php //} ?>

                                     <?php //if(!empty($staff_privileges_student_admission['std_ad_edit_app'])){ ?><button type="submit" class="btn btn-md btn-success "><i class="fa fa-save"></i> Update </button><?php //} ?>
					        </div>	 
			                <input name="ref" type="hidden" value="<?php echo $ref; ?>">		            
			                <input name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
			                		            
                        <div class="clearfix"></div>
               </form>
           
               

            </div> <!--End of #formbox-->
            
                <!-- Modal -->
                <div class="modal fade" id="myApplicationStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Change Application Status</h4>
                      </div>
                      <div class="modal-body">
                      <div class="msg"></div>
                       <div class="form-group statuschangeslabel">
                       <label for="formstatus "> Change aplication current status : <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt=""></label>
                        <select id="changestatus" class="formstatus form-control" >
                            <option <?php if($student_admission_status_for_staff=="New") echo "selected=selected "?> value="New">New</option>
                            <option <?php if($student_admission_status_for_staff=="Review") echo "selected=selected "?> value="Review">Review</option>
                            <option <?php if($student_admission_status_for_staff=="Awaiting Documents") echo "selected=selected "?> value="Awaiting Documents">Awaiting Documents</option>
                            <option <?php if($student_admission_status_for_staff=="Processing") echo "selected=selected "?> value="Processing">Processing</option>
                            <option <?php if($student_admission_status_for_staff=="Refer to academic department") echo "selected=selected "?> value="Refer to academic department">Refer to academic department</option>
                            <option <?php if($student_admission_status_for_staff=="Accepted") echo "selected=selected "?> value="Accepted">Accepted</option>
                            <option <?php if($student_admission_status_for_staff=="Rejected for review") echo "selected=selected "?> value="Rejected for review">Rejected for review</option>
                            <option <?php if($student_admission_status_for_staff=="Rejected") echo "selected=selected "?> value="Rejected">Rejected</option>
                            <option <?php if($student_admission_status_for_staff=="Discarded") echo "selected=selected "?> value="Discarded">Discarded</option>
                        </select>
                        </div>
                        <div class="form-group stafflist">
                       <label for="formstatus"> Staff name : <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt=""></label>
                        <select id="staffview" name="student_admission_status_review_staff_id" class="formstatus form-control" >
                            <option value="">Please select a staff</option>
                        </select>
                        </div>
                        <div class="form-group rejected-reason-list">
                       <label for="reasonList"> Rejected Reason : <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt=""></label>
                        <select id="reasonList" name="student_admission_status_rejected_reason" class="reasonList form-control" >
                            <option value="">Please select a reason</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Failed Interview") echo "selected=selected "?> value="Failed Interview">Failed Interview</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Shortage of Document") echo "selected=selected "?> value="Shortage of Document">Shortage of Document</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Wrong Information") echo "selected=selected "?>  value="Wrong Information">Wrong Information</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Lack of Qualification") echo "selected=selected "?>  value="Lack of Qualification">Lack of Qualification</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Unavailable for Communication") echo "selected=selected "?>  value="Unavailable for Communication">Unavailable for Communication</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Failure in English Test") echo "selected=selected "?>  value="Failure in English Test">Failure in English Test</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Previous Bad Records") echo "selected=selected "?>  value="Previous Bad Records">Previous Bad Records</option>                            
                        </select>
                        </div>                        
                      </div>
                      <div class="modal-footer">
                        <button type="button" name="changebuttonstate" class="btn btn-success" id="changebuttonstate" ><i class="fa fa-check"></i> Change</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->     
