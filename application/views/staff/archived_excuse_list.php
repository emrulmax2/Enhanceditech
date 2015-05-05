<script language="javascript" type="text/javascript">
</script>


                <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                <div class="row">
	                <div class="col-lg-6 btn-area">
		                <a href="<?php echo base_url() ?>index.php/attendance_excuse" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i> Back to list</a>
		            </div>
	                <div class="col-lg-6 btn-area text-right">
	                <!-- <a href="?action=archived" class="btn btn-primary">View Archived</a> -->
                	
<?php
//if(!empty($staff_privileges_course_management['course_mng_add']) || $this->session->userdata('label')=="admin"){

?>                		
                		<!-- <a class="btn btn-md btn-primary add-new-class-plan-btn"  href="<?php echo base_url(); ?>index.php/class_plan_management/?action=add"><i class="fa fa-plus"></i> Add New Class Plan</a> -->
                		
<?php
//}                			
?>                		
                		
                		<!--<a class="btn btn-md btn-info" type="button"><i class="fa fa-list"></i> Back to List</a>-->
	                </div>
                </div>

                                 
                
                <div class="row">
                                   
               	
               
               <div class="col-lg-12">
               
               
	                <h4><i class="fa fa-list"></i> Attendance Excuse List </h4>
	                
	                <table class="dTable display">
	                    <thead>
	                        <tr>
	                            <th><label for='checkbox99999999999'>Student ID</label></th>
	                            <th>Name</th>
	                            <th>Dates</th>
	                            <th>Reason</th>
	                            <th>Docs</th>
	                            <th>Status</th>
	                            <th>Remarks</th>
	                            <th>Action</th>
      
	                        </tr>
	                    </thead>
	                    


	                    <tbody class="class-plan-list-body">
	                        <?php
	                           
	                            

                                $i=1;
	                            foreach($archived_excuse_list as $k => $v){
	             
	                                echo "<tr  class='gradeA'>";                 
	                                echo "<td><label for='checkbox".$v["id"]."'>".$this->register->get_registration_no_by_ID($v['register_id'])."</label></td>";
	                                echo "<td>".$this->student_data->get_fullname_by_ID($this->register->get_student_data_ID_no_by_id($v['register_id']))."</td>";
	                                echo "<td>";
	                                $date_list = unserialize($v['day_id']);
	                                if(!empty($date_list)) {
		                                foreach ($date_list as $key => $value) {
		                                	//var_dump($value);
		                                	$clean_date = explode("_", $value);
		                                	echo $this->class_lists->get_date_by_id($clean_date[0]) ."<br /> ";
		                                }
		                            }
	                                echo "</td>";
	                                echo "<td>".substr($v['reason'], 0,25)."...</td>";
	                                echo "<td>";

	                                $doc_list = unserialize($v['doc']);
	                                if(!empty($doc_list)) {
		                                foreach ($doc_list as $key => $value) {
		                                	$doc = explode("/", $value);
		                                	echo "<a href='".base_url().$value."'>".$doc[2]."</a> <br />";
		                                }
		                            }
	                                echo "</td>";
	                                echo "<td>";
	                                if($v["status"] == 0) { echo "Pending";} elseif($v["status"] == 1) { echo "Reviewed &amp; Rejected"; } elseif($v["status"] == 2) {echo "Reviewed &amp; Approved";}
	                                echo "</td>";
	                                 echo "<td>".substr($v['remarks'], 0,25)."</td>";
	                                echo "<td><button data-toggle='modal' data-target='#view_excuse_".$v['register_id']."_".$i."' class='btn btn-sm btn-primary'><i class='fa fa-eye'></i> View</button></td>";
	                                	
	                                
	                                echo "</tr>";

	                                ?>
	                                

	                                <?php
	                                $i++;
	                            } 
	                                                    
	                                    
	                        ?>    
	                    </tbody>
	                    
	                </table>
	                
               		
               </div>
               
               

            </div>

    							<?php 
    							$i=1;
	                            foreach($archived_excuse_list as $k => $v){ 
	                            ?>
    								<!-- Modal -->
					                  <div class="modal fade" id="view_excuse_<?php echo $v['register_id']."_".$i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					                    <div class="modal-dialog">

					                    
					                    
					                      <div class="modal-content">
					                        <div class="modal-header cofirm-delete-header">
					                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-eye"></i> Attendance Excuse View</h4>
					                        </div>


						                    <div class="modal-body">

					                        	<form method="post" action="">

						                        	<div class="msg"></div>

							                        <div class="panel panel-info" >

							                          	<div class="panel-heading" style="overflow: hidden;">
								                          	<div class="text-center">
								                            	<h3 class="panel-title">Student Excuse Information</h3>
								                          		
								                          	</div>

							                          	</div>
							                        

							                        

								                        <div class="panel-body attendance">
								                        	<input type="hidden" name="excuse_id" value="<?php echo $v['id']?>" />
								                        	<input type="hidden" name="register_id" value="<?php echo $v['register_id']?>" />
								                            <div class="excuse_info">
								                              <p>Student ID</p>
								                            </div>
								                            <div class="excuse_info">
								                              <p><?php echo $this->register->get_registration_no_by_ID($v['register_id']); ?></p>
								                            </div>
								                            <div class="excuse_info">
								                              <p>Name</p>
								                            </div>
								                            <div class="excuse_info">
								                              <p><?php echo $this->student_data->get_fullname_by_ID($this->register->get_student_data_ID_no_by_id($v['register_id'])); ?></p>
								                            </div>
								                            <div class="excuse_info">
								                              <p>Dates</p>
								                            </div>
								                            <div class="excuse_info">
								                              <p>
								                              <?php
								                              	$date_list = unserialize($v['day_id']);
				                                				$day_id_class_plan_id = array();
								                                if(!empty($date_list)) {
																	$module_with_date = array();
									                                foreach ($date_list as $key => $value) {
									                                	$clean_date = explode("_", $value);
									                                	//var_dump($clean_date); die();
									                                	$module_with_date[$clean_date[1]][] = $clean_date[0]."_".$clean_date[2];
									                                }
									                                foreach ($module_with_date as $x => $y) {
									                                	
									                                	echo $this->coursemodule->get_name_by_ID($x) ."<br />";

									                                	foreach ($y as $m => $n) {
									                                		$day_id_class_plan_id[] = $n;
									                                		$clean_n = explode("_", $n);	
									                                		echo $this->class_lists->get_date_by_id($clean_n[0])." ( ". $this->time_plan->get_viewable_from_to_date_by_id( $this->class_lists->get_time_plan_id_by_date_and_class_plan_id($this->class_lists->get_date_by_id($clean_n[0]),$clean_n[1]) ) ." ) <br /> ";
									                                	}
									                                }
									                            }
									                            $clean_day_id_class_plan_id = implode(":", $day_id_class_plan_id);
									                            //var_dump($clean_day_id_class_plan_id);
								                               ?>
								                               <input type="hidden" name="clean_day_id_class_plan_id" value="<?php echo $clean_day_id_class_plan_id?>" />
								                               </p>
								                            </div>
								                            <div class="excuse_info">
								                              <p>Reason</p>
								                            </div>
								                            <div class="excuse_info">
								                              <p><?php echo $v['reason']; ?></p>
								                            </div>
								                             <div class="excuse_info">
								                              <p>Documents</p>
								                            </div>
								                            <div class="excuse_info">
								                              <p>
								                              <?php 
								                              	$doc_list = unserialize($v['doc']);
				                                				if(!empty($doc_list)) {
									                                foreach ($doc_list as $key => $value) {
									                                	$doc = explode("/", $value);
									                                	echo "<a href='".base_url().$value."'>".$doc[2]."</a> <br />";
									                                }
									                            } else {
									                            	echo "No documents submitted!";
									                            }
								                               ?>
								                              </p>
								                            </div>

								                            <div class="excuse_info">
								                              <p>Action</p>
								                            </div>
								                            <div class="excuse_info">
								                              <p>
								                              	<select class="form-control" name="status">
								                              		<option <?php echo ($v['status'] == 0) ? "selected" : "" ; ?> value='0'>Pending</option>
								                              		<option <?php echo ($v['status'] == 1) ? "selected" : "" ; ?> value='1'>Reviewed &amp; Rejected</option>
								                              		<option <?php echo ($v['status'] == 2) ? "selected" : "" ; ?> value='2'>Reviewed &amp; Approved</option>
								                              	</select>
								                              </p>
								                            </div>
								                            <div class="excuse_info">
								                              <p>Remarks</p>
								                            </div>
								                            <div class="excuse_info">
								                              <p>
								                              	<textarea class="form-control" style="resize:none;" name="remarks" cols="30" rows="10"><?php echo $v['remarks'] ?></textarea>
								                              </p>
								                            </div>
								                            <div class="excuse_info">
								                              <p></p>
								                            </div>
								                            <div class="excuse_info">

								                              <p>
								                              	<button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>

								                              	<button type="submit" name="excuse_update" class="btn btn-primary">Take Action</button>

								                              	<img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">

								                              </p>
								                            </div>
								                            
								                        </div>
							                        
							                        </div>
						                        
					                    		</form>
						                    </div>


					                        
					                      </div><!-- /.modal-content -->
					                      
					                      
					                    </div><!-- /.modal-dialog -->
					                  </div><!-- /.modal -->

					                <?php $i++; } ?> 
                   