<style>
  .mce-tinymce iframe {
    height: 400px !important;
  }
</style>
<script type="text/javascript">
$(document).ready(function(){
  $(".show_letter_data textarea").hide();
    $('.modal-dialog').css("width","770px");

    $("select[name=letter_title]").on("change", function() {

      var letter_id = $(this).val();
      //alert(letter_id);
      $.each($(".show_letter_data textarea.tinymce"), function(index, val) {
        var selected_letter_id = $(this).attr('id');

        //if(letter_id != "") {

         if("letter_"+letter_id == selected_letter_id) {
          
          $(this).prev('.mce-tinymce').siblings('.mce-tinymce').hide();
          $(this).prev('.mce-tinymce').fadeIn();


         }

        //}
      });



    });


});
</script>

                <!-- Page Heading -->
  
  
            <?php echo $message; ?>  

     <div class="col-lg-12">
            <div class="text-right">
            <button class="btn btn-md btn-success generateletter" data-toggle="modal" data-target="#myLetterDocs"><i class="fa fa-plus"></i> Generate New Letter</button>
            <button class="btn btn-md btn-warning generatemail" data-toggle="modal" data-target="#myEmailDocs"><i class="fa fa-envelope"></i> Send Email</button>
            <button class="btn btn-md btn-primary generatsms" data-toggle="modal" data-target="#mySmsDocs"><i class="fa fa-mobile"></i> Send SMS</button>
            </div>
             
               <div class="clearfix">

               <h4><i class="fa fa-file-text"></i> View Letters</h4>
               <div class="divider"></div>
               <div class="margin-height">
               <?php $i = 1;  ?>
                 <div class="Educationtable table-responsive">
                    <table id="letterissuing" class="table table-bordered">
                      <thead>
                        <tr>
                         <!--<th>#</th>-->
                         <th>Type</th>
                         <th>Subjects</th>
                         <th>Signatory</th>
                         <th>Issued By</th>
                         <th>Issued Date</th>
                         <th class="text-right">Action</th>
                        </tr>
                      </thead>
                        <tbody>               
            <?php $i=1; foreach($letterlists as $letter): ?>      
            <?php $thisLetterDetails = $this->letter_set->get_by_ID($letter["letter_id"]); ?>      
            <?php $thisSignatoryDetails = $this->signatory_set->get_by_ID($letter["signatory_id"]); ?>      
            <?php $thisStaffDetails = $this->staff->get_by_ID($letter["issued_by"]); ?>      
                                  <tr>
                                     <!--<td ><?php echo $letter["id"]; ?></td> -->
                                     <td><?php echo $thisLetterDetails["letter_type"]; ?></td>
                                     <td><?php echo $thisLetterDetails["letter_title"]; ?></td>
                                     <td>
                                     <?php if(isset($thisSignatoryDetails["name"]) || isset($thisSignatoryDetails["post"])) {?>
                                     <?php echo $thisSignatoryDetails["name"]."(".$thisSignatoryDetails["post"].")"; ?>
                                     <?php } ?>
                                     </td>
                                     <td><?php echo $thisStaffDetails["staff_name"]; ?></td>
                                     <td><?php echo tohrdate($letter["issued_date"]); ?></td>
                                     <td class="text-right">

                                        <!-- <button type="button" name="viewletter" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#letter_view_<?php echo $i; ?>"><i class="fa fa-eye"></i> View</button> -->
                                        <?php if(!empty($letter["pdf_name"])) {?>
                                        <a href="<?php echo base_url() ?>uploads/files/<?php echo $letter["pdf_name"] ?>" class="btn btn-sm btn-primary" target="_blank">View</a>
                                        <?php } ?>
                                        <button name="changedate" id="changedate" type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myChangedateDocs" data-id="<?php echo $letter["id"]; ?>" ><i class="fa fa-calendar"></i> Change Date</button>
                                     </td>
                                  </tr>           
            
            <?php $i++; endforeach; ?>
                                    
                        </tbody>
                    </table>
                 </div>
                        
               </div>
               <div class="divider"></div>
                   <div class="email-issu">
                   <h4><i class="fa fa-envelope"></i> View Emails</h4>
                   <div class="divider"></div>
                       <div class="margin-height">
                       <?php $i = 1;  ?>
                         <div class="Emailtable table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                 <!--<th>#</th>-->
                                 <th>Subjects</th>
                                 <th>Description</th>
                                 <th>Issued By</th>
                                 <th>Issued Date</th>
                                </tr>
                              </thead>
                                <tbody>               
                    <?php foreach($emaillists as $emaildata): ?>                  
                    <?php $thisStaffDetails = $this->staff->get_by_ID($emaildata["issued_by"]); ?>      
                                          <tr>
                                             <!--<td><?php echo $emaildata["id"]; ?></td>-->
                                             <td><?php echo $emaildata["subject"]; ?></td>
                                             <td><?php echo $emaildata["description"]; ?></td>
                                             <td><?php echo $thisStaffDetails["staff_name"]; ?></td>
                                             <td><?php echo tohrdate($emaildata["issued_date"]); ?></td>
                                          </tr>           
                    
                    <?php endforeach; ?>
                                            
                                </tbody>
                            </table>
                         </div>
                                
                       </div>               
                   </div>
               <div class="divider"></div>
                   <div class="email-issu">
                   <h4><i class="fa fa-mobile"></i> View SMS</h4>
                   <div class="divider"></div>
                       <div class="margin-height">
                       <?php $i = 1;  ?>
                         <div class="Emailtable table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                 <!--<th>#</th>-->
                                 <th>Phone</th>
                                 <th>Subjects</th>
                                 <th>Description</th>
                                 <th>Issued By</th>
                                 <th>Issued Date</th>
                                </tr>
                              </thead>
                                <tbody>               
                    <?php foreach($smslists as $smsdata): ?>                  
                    <?php $thisStaffDetails = $this->staff->get_by_ID($smsdata["issued_by"]); ?>      
                                          <tr>
                                             <!--<td><?php echo $smsdata["id"]; ?></td>-->
                                             <td><?php echo $smsdata["phone"]; ?></td>
                                             <td><?php echo $smsdata["subject"]; ?></td>
                                             <td><?php echo $smsdata["description"]; ?></td>
                                             <td><?php echo $thisStaffDetails["staff_name"]; ?></td>
                                             <td><?php echo tohrdatetime($smsdata["issued_date"]); ?></td>
                                          </tr>           
                    
                    <?php endforeach; ?>
                                            
                                </tbody>
                            </table>
                         </div>
                                
                       </div>               
                   </div>
            </div><!--End of upload file list-->

<?php 

$thisLetterlists = $this->letter_set->get_all();     
$thisSignatorylists = $this->signatory_set->get_all();

?>
                 <!-- Modal date change -->
                <div class="modal fade" id="myChangedateDocs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-calendar"></i> Change Issued letter date</h4>
                      </div>
                      <div class="modal-body">
                      <div class="msg"></div>
                       <div class="form-group">
                       <label for="formstatus"> Issued Date : </label>                       
                       <input class="form-control date" type="text" name="issued_date" value="">
                       <input type="hidden" name="issulid" value="" />
                       </div>

                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <button type="button" name="changedatebutton" class="btn btn-success" id="" ><i class="fa fa-send"></i> Change Issu Date</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->                     
                <!-- Modal date change-->                 
                <!-- Modal -->
                <div class="modal fade" id="myLetterDocs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-send"></i> Issu Letter <img class="loading" src="<?php echo base_url(); ?>/images/loading.gif" alt=""></h4>
                      </div>
                      <div class="modal-body">
                      <div class="msg"></div>
                       <div class="form-group">
                       <label for="formstatus"> Issued Date : </label>                       
                       <input class="form-control date" type="text" name="issued_date2" value="<?php echo date("d-m-Y");?>">
                       </div>
                       <div class="form-group">
                       <label for="formstatus"> Letter : </label>
                       <select name="letter_title" class="form-control"> 
                       <option>Please select</option>
                       <?php foreach($thisLetterlists as $letter): ?>
                        
                        <option value="<?php echo $letter["id"]; ?>"><?php echo ucfirst($letter["letter_type"])."-".ucfirst($letter["letter_title"]); ?></option>

                       <?php endforeach; ?>
                       </select>                       
                       <input type="hidden" name="staff_id" value="<?php echo $staff_id;?>">
                       </div>
                       <div class="form-group show_letter_data">
                       <?php foreach($thisLetterlists as $letter): ?>

                       <textarea class="form-control tinymce" name="letter" id="letter_<?php echo $letter["id"]; ?>" cols="30" rows="10"><?php echo $letter["description"] ?></textarea>
                       <?php endforeach; ?>
                       </div>

                       <div class="form-group">
                       <label for="formstatus"> Signatory : </label>
                       <select name="signatory_title" class="form-control"> 
                       <option>Please select</option>
                       <?php foreach($thisSignatorylists as $signatory): ?>
                       <option value="<?php echo $signatory["id"] ?>"><?php echo ucfirst($signatory["name"]); ?></option>
                       <?php endforeach; ?>
                       </select>                       
                       <input type="hidden" name="ref_id" value="<?php echo $ref_id;?>">
                       
                       </div>
                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.gif" alt="">
                        <button type="button" name="sendletter" class="btn btn-success" id="" ><i class="fa fa-send"></i> Issu New Letter</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->                     
                <!-- Modal Email-->
                <div class="modal fade" id="myEmailDocs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope"></i> Email To: <?php echo $user_data["student_email"];?></h4>
                      </div>
                      <div class="modal-body">
                      <div class="msg"></div>

                       <div class="form-group">
                       <label for="formstatus"> subject : </label>                       
                       <input class="form-control" type="text" name="subject" value="">
                       </div>
                       <div class="form-group">
                       <label for="formstatus"> Email Description : </label>
                       <textarea class="form-control tinymce" name="description" cols="" rows="15"></textarea>                       
                       <input type="hidden" name="staff_id" value="<?php echo $staff_id;?>">
                       <input type="hidden" name="ref_id" value="<?php echo $ref_id;?>">
                       <input type="hidden" name="student_email" value="<?php echo $user_data["student_email"];?>">
                       </div>
                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <button type="button" name="sendemail" class="btn btn-success" id="sendemail" ><i class="fa fa-send"></i> Send Email</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->     

                <!-- Modal Email-->
                <div class="modal fade" id="mySmsDocs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-mobile"></i> SMS To: <?php echo $user_data["student_mobile_phone"];?></h4>
                      </div>
                      <div class="modal-body">
                      <div class="msg"></div>
                       <div class="form-group">
                       <label for="formstatus"> subject : </label>                       
                       <input class="form-control" type="text" name="smssubject" value="">
                       </div>
                       <div class="form-group">
                       <label for="formstatus"> SMS Description : </label>
                       <textarea class="form-control" name="smsdescription" cols="" rows="15"></textarea>                       
                       <input type="hidden" name="staff_id" value="<?php echo $staff_id;?>">
                       <input type="hidden" name="ref_id"   value="<?php echo $ref_id;?>">
                       <input type="hidden" name="student_mobile_phone" value="<?php echo $user_data["student_mobile_phone"];?>">
                       </div>
                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <button type="button" name="sendsms" class="btn btn-success" id="sendsms" ><i class="fa fa-send"></i> Send SMS</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->     


     </div>

    <?php $i=1; foreach($letterlists as $letter): ?>  
      <!-- Modal Email-->
          <div class="modal fade" id="letter_view_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header cofirm-delete-header">
                  <?php 
                  		$letter_info = $this->letter_set->get_by_ID($letter['letter_id']);
                  		$letter_issuing_info = $this->letter_issuing->get_by_student_data_id_and_letter_id($user_data['student_data_id'],$letter['letter_id']); 
                        //var_dump($letter_issuing_info);
                  ?>                  
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <div class="col-sm-6">                  	
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-eye"></i> View Letter</h4>
                  </div>
                  <div class="col-sm-5 text-right">
                  	 <a href="javascript:void(0);" class="btn btn-success btn-sm" onclick="print_report('print_letter_<?php echo $i; ?>','<?php echo $letter_info['letter_title']; ?>');"><i class="fa fa-print"></i> Print</a>
                  </div>
                  <div class="clearfix"></div>	
                </div>
                <div class="modal-body">
                <div class="msg"></div>
                 <div class="form-group">
                 <label for="formstatus"> subject : </label>                       
                 <b><?php echo $letter_info['letter_title']; ?></b>
                 </div>
                 <div class="form-group">
                 <div class="clearfix"></div>
                 
                 <?php //var_dump(get_letter_data($letter_info['description'])); ?> 

                 <?php
                 
                     //var_dump($letter_info);
                 	$data_arr = get_letter_data($letter_info['description']);
                 	$current_data = strip_slashes($letter_info['description']);
                 	if(count($data_arr)>0){
                 		//var_dump($data_arr);
                 		//var_dump($letter_issuing_info);
                 		foreach($data_arr as $k=>$v){
							
							$table = $v[0];
							$field = $v[1];
							//echo $table." ".$field."<br>";
							if($table=="student_data"){
								
								$where_cluse = "id='".$user_data['student_data_id']."'";
							
							}else if($table=="register"){
								
								$where_cluse = "student_data_id='".$user_data['student_data_id']."'";
								
							}else if($table=="letter_issuing"){
								
								$where_cluse = "id='".$letter_issuing_info['id']."'";
							
							}else if($table=="signatory_set"){

								$where_cluse = "id='".$letter_issuing_info['signatory_id']."'";	
							
							}else if($table=="student_title"){
								
								$where_cluse = "id='".$user_data['student_title']."'";	
							
							}else if($table=="student_information"){
								
								$where_cluse = "student_data_id='".$user_data['student_data_id']."'";	
							
							}else if($table=="coursemodule"){
								
								$where_cluse = "course_id='".$user_data['student_course']."'";	
							
							}else if($table=="courselevel"){
								
								$where_cluse = "course_id='".$user_data['student_course']."'";	
							
							}else if($table=="course"){
								
								$where_cluse = "id='".$user_data['student_course']."'";	
							
							}else if($table=="semister"){
								
								$where_cluse = "id='".$user_data['student_semister']."'";	
							
							}else if($table=="settings"){
								
								$where_cluse = "ID='1'";	
							
							}else if($table=="slc_coursecode"){
								
								$c_r_id = $this->course_relation->get_ID_by_course_ID_semester_ID($user_data['student_course'],$user_data['student_semister']);
								
								$where_cluse = "course_relation_id='".$c_r_id."'";
								
							}else if($table=="awarding_body"){
								
								$c_r = $this->course_relation->get_ID_and_awarding_id_by_course_ID_semester_ID($user_data['student_course'],$user_data['student_semister']);
																
								$where_cluse = "ID='".$c_r['awarding_id']."'";								
								
							}else if($table=="student_gender"){
								
								$where_cluse = "id='".$user_data['student_gender']."'";							
									
							}else if($table=="student_nationality"){
								                    
								//// -------------- this should be [DATA=student_nationality]country_name[/DATA]
								$table = "countries";
								
								$where_cluse = "id='".$user_data['student_nationality']."'";							
									
							}else if($table=="student_country_of_birth"){
								                    
								//// -------------- this should be [DATA=student_country_of_birth]country_name[/DATA]
								$table = "countries";
								
								$where_cluse = "id='".$user_data['student_country_of_birth']."'";							
									
							}else if($table=="student_others_ethnicity"){
								                    
								//// -------------- this should be [DATA=student_others_ethnicity]name[/DATA]
								//$table = "countries";
								
								$where_cluse = "id='".$user_data['student_others_ethnicity']."'";							
									
							}else if($table=="course_relation" && $field=="fees"){
								
								    if(!empty($reg_data['student_type'])){
										
										if($reg_data['student_type']=="uk") $field=="fees_1";
										else $field=="fees_2";
										
										$c_r_id = $this->course_relation->get_ID_by_course_ID_semester_ID($user_data['student_course'],$user_data['student_semister']);
										$where_cluse = "ID='".$c_r_id."'"; 	
										
								    }else{
								    	
								    	$field=="fees_1";
										$c_r_id = $this->course_relation->get_ID_by_course_ID_semester_ID($user_data['student_course'],$user_data['student_semister']);
										$where_cluse = "ID='".$c_r_id."'";										
								    }
							}						

							////// ---------- for serialize fields
							if($table=="student_others_disabilities"){
							
								//// -------------- this should be [DATA=student_others_disabilities]name[/DATA]
								$disabilities_arr = unserialize($user_data['student_others_disabilities']);
								$disability = "";
								foreach($disabilities_arr as $k=>$v){
									$disability .= $this->student_others_disabilities->get_name_by_id($v).", ";		
								}
								
								$current_data = str_replace("[DATA=".$table."]".$field."[/DATA]",$value,$current_data);
								
							
							///--------------- non database table
							}else if($table=="today" && $field=="today"){
							
								$current_data = str_replace("[DATA=".$table."]".$field."[/DATA]",date("d-m-Y"),$current_data);										
												
							}else{
																
										 //var_dump($user_data['student_title']);
										$query = $this->db->query("SELECT ".$field." FROM ".$table." WHERE ".$where_cluse." LIMIT 1");
																			
										if($query->num_rows()>0){
											$field = trim($field);
											$value = $query->row()->$field;
											//// ----- for date type value
											if($field=="issued_date" || $field=="class_startdate" || $field=="class_enddate" || $field=="student_date_of_birth") $value = date("d/m/Y",strtotime($value));
											
											if($table=="signatory_set") $current_data = str_replace("[DATA=".$table."]".$field."[/DATA]","<img src='".base_url()."".$value."' class='img-responsive' width='200px' height='50px'>",$current_data);
											else{										
													$current_data = str_replace("[DATA=".$table."]".$field."[/DATA]",$value,$current_data);																					
											}
																		
										}/// if($query->num_rows()>0){							
								
							}//}else{												
							
							
                 		}/// foreach($data_arr as $k=>$v){
                 		
					}/// if(count($data_arr)>0){
                 	//echo str_replace("\r\n","",$current_data);
                 	echo "<div class='print_letter_".$i."'>";
                 	echo tinymce_decode($current_data);
                 	echo "</div>";
                 	//echo nl2br(stripcslashes(html_entity_decode(htmlentities($current_data, ENT_QUOTES, 'UTF-8'))));
                 
                 
                 
                  
/*                 		//echo $letter_info['description'];
                 		$num_occurance = substr_count($letter_info['description'],"@!!!");
                 		//echo"num_occurance=".$num_occurance;
                 		if($num_occurance>0){
							$current_data = $letter_info['description'];
							for($i=0;$i<$num_occurance;$i++){
								
								$convert_data = "";
								$convert_data = strstr($current_data,"@!!!");
								echo "<br>START CONVERT DATA -</br>".$convert_data."<br>END CONVERT DATA</br>";
								$exp = explode("-",$convert_data);
                                //var_dump($exp);
								if(count($exp)>0){
										
									$table = $exp[1]; $field = $exp[2];*/
										
										/*if($table=="student_data"){
											
											$where_cluse = "id='".$user_data['student_data_id']."'";
										
										}else if($table=="register"){
											
											$where_cluse = "student_data_id='".$user_data['student_data_id']."'";
											
										}
										
										$query = $this->db->query("SELECT ".$field." FROM ".$table." WHERE ".$where_cluse." LIMIT 1");
										
										if($query->num_rows()>0){
											
											$value = $query->row()->$field;
											
											$current_data = preg_replace('/'.$convert_data.'/', $value, $current_data, 1); 
											
											
										}*/
								 
/*								}
								
								
							} */
							
							//echo $current_data;
							
							
							
							
                 		//}
                 		
                 		
                 		
                 		 
                 ?>                     
                 <div class="clearfix"></div>
                 </div>
                </div>
                
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div>
          <!-- /.modal --> 
    <?php $i++; endforeach; ?>