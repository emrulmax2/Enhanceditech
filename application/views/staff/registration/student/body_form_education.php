<?php $student_admission_status = ""; $student_application_reference_no=""; $student_app_submitted_datetime=""; ?>

<?php 
$id                  =   $_GET["id"];
$has_data = 0;
$reg_data =array();
$registerdata    =array();
$registerdata=$this->register->get_by_student_ID($id);


// var_dump($registerdata); die();
if($_POST) {
    
    $user_data = array();

    $has_other_qualification = $this->input->post('has_other_qualification');

    if($has_other_qualification == "yes")
    {
        $education_array =array();
        
        $qualification_array =   $this->input->post("user_data");
        //$education_array["student_other_qualification"] =   $this->input->post("student_other_qualification");
       // $education_array["staff_id"] =  $this->session->userdata("uid");
        
         
        if(count($registerdata)>0) {

            //$education_array["student_other_qualification"]= serialize($education_array["student_other_qualification"]);
            //$registerdata = array_merge($registerdata,$education_array);
            $qualification_array['id'] = $id;
            //$this->register->update($registerdata);
            $this->student_data->update_app($qualification_array);
            
            $std_data                = $this->student_data->get_studentdata_for_edit($id);

            foreach($std_data as $k=>$v){
            $user_data[$k] = addslashes(tinymce_decode($v));                
            }            
            
            $args = array();
            foreach ($_POST as $k => $v) {
                if ($k == "hesa_provider_name" || $k == "hesa_qual_type" || $k == "hesa_qual_sub" || $k == "hesa_qual_sit" || $k=="hesa_qualent3_id") {
                    
                    $args[$k] = $v;
                }
            }
            $args['student_data_id'] = $id;
            //var_dump($args); die();
            $this->hesa_student_information->update_by_student_data_id($args);

            $sms = "<div class=\"alert alert-success\"><p><span class=\"glyphicon glyphicon-ok\"></span> Application Updated Successfully.</p></div>";
        } else {
/*            $education_array["student_data_id"]                 = $id;
            $education_array["student_other_qualification"]     = serialize($education_array["student_other_qualification"]);
            $this->register->add($education_array);*/
            $qualification_array['id'] = $id;
            $this->student_data->update_app($qualification_array);
            
            $std_data                = $this->student_data->get_studentdata_for_edit($id);

            foreach($std_data as $k=>$v){
            $user_data[$k] = addslashes(tinymce_decode($v));                
            }            
             
            $sms = "<div class=\"alert alert-success\"><p><span class=\"glyphicon glyphicon-ok\"></span> Application Updated Successfully.</p></div>";  
        }
    } 
    else
    {
            $qualification_array = array();
            $qualification_array['id'] = $id;
            $qualification_array['student_educational_qualification_award_date'] = "";
            $qualification_array['student_educational_qualification_results'] = "";
            $qualification_array['student_educational_qualification_subjects'] = "";
            $qualification_array['student_educational_qualification_awarding_body'] = "";
            $qualification_array['student_educational_qualification_highest_academic_qualification'] = "";
            //$this->register->update($registerdata);
            $this->student_data->update_app($qualification_array);
        //if(count($registerdata)>0) {
/*            $education_array["student_other_qualification"]= " ";
            $registerdata = array_merge($registerdata,$education_array);
            
            $this->register->update($registerdata);*/
            
            $std_data                = $this->student_data->get_studentdata_for_edit($id);

            foreach($std_data as $k=>$v){
            $user_data[$k] = addslashes(tinymce_decode($v));                
            }            
            
            $sms = "<div class=\"alert alert-success\"><p><span class=\"glyphicon glyphicon-ok\"></span> Application Updated Successfully.</p></div>";
        //}

             
    }
    
    
    
}

if(count($registerdata)>0) { $student_hesa_info = $this->hesa_student_information->get_by_student_data_id_and_register_id($id, $registerdata['id']); }



/*if(count($registerdata)>0) {
    if($registerdata["student_other_qualification"] != "")
    {
        $reg_data =unserialize($registerdata["student_other_qualification"]);
        if($reg_data) 
        {
            $has_data = 1;
        }        
    }
}*/

if(!empty($user_data["student_educational_qualification_highest_academic_qualification"]) || !empty($user_data["student_educational_qualification_awarding_body"]) || !empty($user_data["student_educational_qualification_subjects"]) || !empty($user_data["student_educational_qualification_results"]) )
{
    $has_data = 1;        
}





?>


                <script>alert("<?php var_dump($user_data);  ?>");</script>
                <div class="row">
	                
	                <div class="col-lg-12" style="padding-top: 10px;">
                    <?php if(isset($sms)) {                
	                	 echo $sms;

                     } ?>
	                </div>
	                
                </div>            

                <div id="formbox" class="clearfix">
                    
                    
                    <form role="form" id="educationform"  method="post" action="?action=singleview&do=education&id=<?php echo $ref_id; ?>">
                    
		                <div class="col-lg-12">
			                <div class="row">
                            
				                <div class="col-sm-12 text-right">
                                     <!--<a href="<?php echo base_url(); ?>index.php/print_student_app/?id=<?php echo $user_data['id']; ?>" class="btn btn-sm btn-primary "><i class="fa fa-print"></i> Print</a>-->
                         			<?php if(!empty($priv[11]) || $this->session->userdata('label')=="admin"){ ?><button type="submit" class="btn btn-sm btn-success "><i class="fa fa-save"></i> Update </button><?php } ?>
					             </div>	   
				             </div> 

                             <div class="divider"></div>  
                                 <div class="education-qulification"> 
                                 <div class="form-group">
                                       <h4><i class="fa fa-mortar-board "></i> Education Qualification </h4>
                                       <p class="divider"></p>
                                 </div>
                                 <div class="Educationtable table-responsive">
                                  <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                        <th>Highest Academic Qualification</th>
                                        <th>Awarding Body</th>
                                        <th>Subjects</th>
                                        <th>Results/Grade</th>
                                        <th>Provider Name</th>
                                        <th>Qualification Type</th>
                                        <th>HESA Qualification Subject </th>
                                        <th>Exam sitting</th>
                                        <th>Highest Qualification on Entry (QUALENT3)</th>
                                        <th>Date Of Award</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  
                                     
                                     <?php if(count($reg_data)>0) { ?>
                                     
                                     <tr>
<!--                                         <td><?php //echo $reg_data[0]; ?></td>
                                         <td><?php //echo $reg_data[1]; ?></td>
                                         <td><?php //echo $reg_data[2]; ?></td>
                                         <td><?php //echo $reg_data[3]; ?></td>-->
                                         <td><?php echo $user_data["student_educational_qualification_highest_academic_qualification"]; ?></td>
                                         <td><?php echo $user_data["student_educational_qualification_awarding_body"]; ?></td>
                                         <td><?php echo $user_data["student_educational_qualification_subjects"]; ?></td>
                                         <td><?php echo $user_data["student_educational_qualification_results"]; ?></td>                                         
                                         <td><?php echo !empty($student_hesa_info['hesa_provider_name']) ? $this->hesa_previnst->get_name_by_id($student_hesa_info['hesa_provider_name']) : ""; ?></td>
                                         <td><?php echo !empty($student_hesa_info['hesa_qual_type']) ? $this->hesa_qualtype->get_name_by_id($student_hesa_info['hesa_qual_type']): ""; ?></td>
                                         <td><?php echo !empty($student_hesa_info['hesa_qual_sub']) ? $this->hesa_qualsbj->get_name_by_id($student_hesa_info['hesa_qual_sub']): ""; ?></td>
                                         <td><?php echo !empty($student_hesa_info['hesa_qual_sit']) ? $this->hesa_qualsit->get_name_by_id($student_hesa_info['hesa_qual_sit']) : ""; ?></td>
                                         <td><?php echo !empty($student_hesa_info['hesa_qualent3_id']) ? $this->hesa_qualent3->get_name_by_id($student_hesa_info['hesa_qualent3_id']) : ""; ?></td>
                                         <!--<td><?php //echo $reg_data[4]; ?></td>-->
                                         <td><?php echo $user_data["student_educational_qualification_award_date"]; ?></td>
                                     </tr>
                                     <?php } else { ?>

                                     <tr>
                                         <td><?php echo $user_data["student_educational_qualification_highest_academic_qualification"]; ?></td>
                                         <td><?php echo $user_data["student_educational_qualification_awarding_body"]; ?></td>
                                         <td><?php echo $user_data["student_educational_qualification_subjects"]; ?></td>
                                         <td><?php echo $user_data["student_educational_qualification_results"]; ?></td>
                                         <td><?php echo !empty($student_hesa_info['hesa_provider_name']) ? $this->hesa_previnst->get_name_by_id($student_hesa_info['hesa_provider_name']) : ""; ?></td>
                                         <td><?php echo !empty($student_hesa_info['hesa_qual_type']) ? $this->hesa_qualtype->get_name_by_id($student_hesa_info['hesa_qual_type']): ""; ?></td>
                                         <td><?php echo !empty($student_hesa_info['hesa_qual_sub']) ? $this->hesa_qualsbj->get_name_by_id($student_hesa_info['hesa_qual_sub']): ""; ?></td>
                                         <td><?php echo !empty($student_hesa_info['hesa_qual_sit']) ? $this->hesa_qualsit->get_name_by_id($student_hesa_info['hesa_qual_sit']) : ""; ?></td>
                                         <td><?php echo !empty($student_hesa_info['hesa_qualent3_id']) ? $this->hesa_qualent3->get_name_by_id($student_hesa_info['hesa_qualent3_id']) : ""; ?></td>
                                         <td><?php echo $user_data["student_educational_qualification_award_date"]; ?></td>
                                     </tr>
                                     <?php } ?>
                                  </tbody>
                                  </table>
                                 </div>
                                 <div class="form-group clearfix">
                                    <div class="col-sm-3 ">
                                     <label>Any Other qualification? <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-9">
                                     <select name="has_other_qualification"  class="form-control student_formal_education" required>
                                        <option value="">Please select</option>
                                        <option value="yes" <?php echo ($has_data == 1) ? "selected" : "";?>>Yes</option>
                                        <option value="no" <?php echo ($has_data == 0) ? "selected" : "";?>>No</option>
                                     </select>
                                    </div>
                                 </div> 
                                    <div class="qualification-details" <?php if($has_data == 1) echo "style=\"display:block\""; ?> >
                                     <div class="form-group clearfix">
                                       <div class="col-sm-3 ">
                                        <label>Other Academic Qualification : </label>
                                        
                                         <!--<input type="text" class="form-control" name="student_other_qualification[]" value="<?php //if($has_data) { echo $reg_data[0];  }?>" placeholder="" />-->
                                         <input type="text" class="form-control" name="user_data[student_educational_qualification_highest_academic_qualification]" value="<?php echo $user_data["student_educational_qualification_highest_academic_qualification"]; ?>" placeholder="" />
                                        </div>
                                       <div class="col-sm-3 ">
                                        <label>Awarding Body : </label>
                                        
                                         <!--<input type="text" class="form-control" name="student_other_qualification[]" value="<?php //if($has_data) { echo $reg_data[1];  }?>" placeholder="" />-->
                                         <input type="text" class="form-control" name="user_data[student_educational_qualification_awarding_body]" value="<?php echo $user_data["student_educational_qualification_awarding_body"]; ?>" placeholder="" />
                                        </div>
                                       <div class="col-sm-3">
                                        <label>Subjects : </label>
                                        
                                         <!--<input type="text" class="form-control" name="student_other_qualification[]" value="<?php //if($has_data) { echo $reg_data[2];  }?>" placeholder="" />-->
                                         <input type="text" class="form-control" name="user_data[student_educational_qualification_subjects]" value="<?php echo $user_data["student_educational_qualification_subjects"]; ?>" placeholder="" />
                                        </div>

                                       <div class="col-sm-3">
                                        <label>Results : </label>
                                        
                                         <!--<input type="text" class="form-control" name="student_other_qualification[]" value="<?php //if($has_data) { echo $reg_data[3];  }?>" placeholder="" />-->
                                         <input type="text" class="form-control" name="user_data[student_educational_qualification_results]" value="<?php echo $user_data["student_educational_qualification_results"]; ?>" placeholder="" />
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-sm-3">
                                        <label>Date Of Award : </label>
                                        
                                        <!--<input type="text" class="form-control  employment-date" name="student_other_qualification[]" value="<?php //if($has_data) { echo $reg_data[4];  }?>" placeholder="" />-->
                                        <input type="text" class="form-control  employment-date" name="user_data[student_educational_qualification_award_date]" value="<?php echo $user_data["student_educational_qualification_award_date"]; ?>" placeholder="" />
                                        </div>
                                         <div class="col-sm-3">
                                        <label>Provider Name : </label>
                                        <select class="form-control" name="hesa_provider_name" id="">
                                            <option value="">Please select</option>
                                            <?php if(!empty($hesa_previnst_list)) { ?>
                                                <?php foreach($hesa_previnst_list as $k=>$v) {?>
                                                    <option <?php if( !empty($student_hesa_info['hesa_provider_name']) && $student_hesa_info['hesa_provider_name'] == $v['id']) { echo "selected"; } ?> value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        
                                        </div>
                                         <div class="col-sm-3">
                                        <label>Qualification type : </label>
                                        
                                        <select class="form-control" name="hesa_qual_type" id="">
                                            <option value="">Please select</option>
                                            <?php if(!empty($hesa_qualtype_list)) { ?>
                                                <?php foreach($hesa_qualtype_list as $k=>$v) {?>
                                                    <option <?php if( !empty($student_hesa_info['hesa_qual_type']) && $student_hesa_info['hesa_qual_type'] == $v['id']) { echo "selected"; } ?> value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        </div>
                                         <div class="col-sm-3">
                                        <label>HESA Qualification Subject : </label>
                                        
                                        <select class="form-control" name="hesa_qual_sub" id="">
                                            <option value="">Please select</option>
                                            <?php if(!empty($hesa_qualsbj_list)) { ?>
                                                <?php foreach($hesa_qualsbj_list as $k=>$v) {?>
                                                    <option <?php if( !empty($student_hesa_info['hesa_qual_sub']) && $student_hesa_info['hesa_qual_sub'] == $v['id']) { echo "selected"; } ?> value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        </div>
                                        <div class="clearfix"></div>
                                         <div class="col-sm-3">
                                        <label>Exam sitting : </label>
                                        
                                        <select class="form-control" name="hesa_qual_sit" id="">
                                            <option value="">Please select</option>
                                            <?php if(!empty($hesa_qualsit_list)) { ?>
                                                <?php foreach($hesa_qualsit_list as $k=>$v) {?>
                                                    <option <?php if( !empty($student_hesa_info['hesa_qual_sit']) && $student_hesa_info['hesa_qual_sit'] == $v['id']) { echo "selected"; } ?> value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        </div>
                                        <div class="col-sm-9">
                                        <label> Highest Qualification on Entry (QUALENT3): </label>
                                        
                                        <select class="form-control" name="hesa_qualent3_id" id="">
                                            <option value="">Please select</option>
                                            <?php if(!empty($hesa_qualent3_list)) { ?>
                                                <?php foreach($hesa_qualent3_list as $k=>$v) {?>
                                                    <option <?php if( !empty($student_hesa_info['hesa_qualent3_id']) && $student_hesa_info['hesa_qualent3_id'] == $v['id']) { echo "selected"; } ?> value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>                                        
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>                                
                                    </div><!--End of .qualification-details-->
                                 </div> <!--End of education qualification-->    
                                 <div class="employment-history"> 
                                 <div class="form-group">
                                     <p class="divider"></p>
                                       <h4><i class="fa fa-briefcase "></i> Employment History </h4>
                                       <p class="divider"></p>
                                 </div>
                                 <div class="Employmenttable table-responsive">
                                  <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                    <th>Employment type</th>
                                    <th>Company Name, Address & Phone No</th>
                                    <th>Position</th>
                                    <th>Employment time</th>
                                    <th>Reference</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  
                                     <tr>
                                     <td><?php if($user_data["student_employment_history_current_employment_status"]!=""){ echo $user_data["student_employment_history_current_employment_status"]; } ?></td>
                                     <td><?php if($user_data["student_employment_history_company"]!=""){ echo $user_data["student_employment_history_company"]; } ?></td>
                                     <td><?php if($user_data["student_employment_history_position"]!=""){ echo $user_data["student_employment_history_position"]; } ?></td>
                                     <td><?php if($user_data["student_employment_history_start_date"]!=""){ echo "From".$user_data["student_employment_history_start_date"]."to".$user_data["student_employment_history_end_date"]; } ?></td>
                                     <td><?php if($user_data["student_job_reference_contact_name"]!=""){ echo $user_data["student_job_reference_contact_name"]."<br />".$user_data["student_job_reference_position"]."<br />".$user_data["student_job_reference_phone"]."<br />".$user_data["student_job_reference_email"]; } ?></td>
                                     </tr>
                                  </tbody>
                                  </table>
                                 </div>
                                 
                                 <?php if(0) { ?>
                                 <div class="form-group clearfix">
                                    <div class="col-sm-3  ">
                                     <label>What is your current employment status? <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-3">
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
                                    <div class="clearfix"></div>
                                    <div class="form-group clearfix">
                                       <div class="col-sm-3">
                                        <label>Company Name, Address & Phone No : </label>
                                        </div>
                                        <div class="col-sm-3">
                                         <input type="text" class="form-control" name="student_employment_history_company" value="" placeholder="Company Name, Address & Phone No" />
                                        </div>
                                       <div class="col-sm-3">
                                        <label>Position : </label>
                                        </div>
                                        <div class="col-sm-3">
                                         <input type="text" class="form-control" name="student_employment_history_position" value="" placeholder="Position" />
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                       <div class="col-sm-3">
                                        <label>Start Date : </label>
                                        </div>
                                        <div class="col-sm-3">
                                         <input type="text" class="form-control employment-date" name="student_employment_history_start_date" value="" placeholder="mm/yyyy" />
                                        </div>
                                       <div class="col-sm-3">
                                        <label>End Date : </label>
                                        </div>
                                        <div class="col-sm-3">
                                         <input type="text" class="form-control employment-date" name="student_employment_history_end_date" value="" placeholder="mm/yyyy" />
                                        </div>
                                    </div> 
                                    <div class="form-group clearfix">
                                        <label><b>Reference :</b> </label>
                                    </div>
                                    <div class="form-group clearfix">
                                       <div class="col-sm-3">
                                        <label>Contact Name : </label>
                                        </div>
                                        <div class="col-sm-3">
                                         <input type="text" class="form-control" name="student_job_reference_contact_name" value="" placeholder="Contact Name" />
                                        </div>

                                       <div class="col-sm-3">
                                        <label>Position : </label>
                                        </div>
                                        <div class="col-sm-3">
                                         <input type="text" class="form-control" name="student_job_reference_position" value="" placeholder="Position" />
                                        </div>
                                       </div>
                                       <div class="form-group clearfix">
                                       <div class="col-sm-3">
                                        <label>Phone : </label>
                                        </div>
                                        <div class="col-sm-3">
                                         <input type="text" class="form-control " name="student_job_reference_phone" value="" placeholder="Phone" />
                                        </div>
                                       <div class="col-sm-3">
                                        <label>Email : </label>
                                        </div>
                                        <div class="col-sm-3">
                                         <input type="text" class="form-control " name="student_job_reference_email" value="" placeholder="Email" />
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                       <div class="col-sm-3">
                                        <label>Company Name & Address : </label>
                                        </div>
                                        <div class="col-sm-3">
                                         <input type="text" class="form-control " name="student_job_reference_company_name_address" value="" placeholder="Company Name & Address" />
                                        </div>
                                    </div>
                                    </div> <!--End of .employment-info-->
                                 <?php  } ?>  
                                 </div> <!--End of .employment-history-->            
		           		</div>

		           		
		           		<div class="clearfix"></div>
		           		<div class="col-lg-12">
		           		    <p class="divider"></p>
		           			<div class="col-sm-4">
                				
	                		</div>
			                <div  class="col-sm-8 no-pad text-right">
                                     <!--<a href="<?php //echo base_url(); ?>index.php/print_student_app/?id=<?php //echo $user_data['id']; ?>" class="btn btn-sm btn-primary "><i class="fa fa-print"></i> Print</a>-->
                                     <?php if(!empty($priv[11]) || $this->session->userdata('label')=="admin"){ ?><button type="submit" class="btn btn-sm btn-success "><i class="fa fa-save"></i> Update </button><?php } ?>
					        </div>	 
			                <input name="ref" type="hidden" value="<?php echo $ref; ?>">		            
			                <input name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
			            </div>    		            
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
                            <option <?php if($student_admission_status_for_staff=="Accepted") echo "selected=selected "?> value="Accepted">Accepted</option>
                            <option <?php if($student_admission_status_for_staff=="Offer placed") echo "selected=selected "?> value="Offer placed">Offer placed</option>
                            <option <?php if($student_admission_status_for_staff=="Offer accepted") echo "selected=selected "?> value="Offer accepted">Offer accepted</option>
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
