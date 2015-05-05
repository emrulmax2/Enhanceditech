<script type="text/javascript">

$(document).ready(function(){


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

    newwin.document.write('.print_feed_attendance table.table { border: 1px solid black; border-collapse: collapse;}\n');

    newwin.document.write('thead { display: table-header-group; }\n');

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
    // newwin.document.write('<img src="http://localhost/admission/images/logo-print2.png">');
    newwin.document.write(str);
    newwin.document.write('</BODY>\n');
    newwin.document.write('</HTML>\n');
    newwin.document.close();


}
print_form('print_feed_attendance');  
  // window.print();
    
});



</script>

<style media='print'>
.print_feed_attendance{width:100%; font-size: 40%;}
.print_feed_attendance table.table { border: 1px solid black; border-collapse: collapse;}

</style>


              
                <div class="row">
	                <div class="col-lg-12" style="margin-bottom:10px;">

                		
                			<a class="btn btn-md btn-info" href="<?php echo base_url(); ?>index.php/print_class_routine_management/?action=search"><i class="fa fa-arrow-left"></i> Back to Class Routine</a>
						
                		
							
						
	                </div>
	                
                </div>
                
                               

                <div class="row">
                    
                    
		                <div class="col-lg-12">
		                	
			                
			                	<div class="row">
			                		<div class="col-lg-7 col-md-7 col-sm-7">
			                			 <h4><i class="fa fa-file-text "></i> Assigned Students List </h4>
			                		</div>

			                		
			                	</div>
			                

	                        
	                        <div class="row">
		                        <div class="col-sm-12 print_feed_attendance">
		                        	
	                        		<div class="divheader">
	                        			<h4 style="text-align:center; font-size:20px;">Student Attendance Sheet</h4>
	                        		
		                        		<div style="float:left; width:20%;margin-bottom:10px;">
				                        	<?php if(!empty($settings['print_logourl'])) {?>
					                			<img style="width:100%;padding-right:10px;" src="<?php echo $settings['print_logourl']; ?>">
					                		<?php } ?>
		                        		</div>
		                        		<div style="float:left; width:75%;margin-bottom:10px; margin-top:10px;padding-left: 20px;">
		                        			<?php $c_s_data  = $this->course_relation->get_course_ID_semester_ID_by_ID($class_plan['course_relation_id']); ?>
		                        			<table>
										      <tbody>									      	
										        <tr>
										          <th scope="row" align="left" style='font-size:14px'>Semester</th>
										          <td style='font-size:13px'>: <?php echo $this->semister->get_name($c_s_data['semester_id']) ?></td>
										          
										        </tr>
										        <tr>
										          <th scope="row" align="left" style='font-size:14px'>Course</th>
										          <td style='font-size:13px'>: <?php echo $this->course->get_name($c_s_data['course_id']) ?></td>
										          
										        </tr>
										        <tr>
										          <th scope="row" align="left" style='font-size:14px'>Module</th>
										          <td style='font-size:13px'>: <?php echo $this->coursemodule->get_name_by_id($class_plan['coursemodule_id']) ?></td>
										        </tr>
										        

										      </tbody>
										    </table>
		                        		</div>
									</div>
										
		                        	<div style="float:left; width:100%;margin-bottom:10px;">
		                        		<table width="100%" style="padding-right:20px;padding-left:20px;">
									      
									      
									      <tbody>
									      	
									        <tr>
									          <th scope="row" align="left" style='font-size:14px'>Tutor name</th>
									          <td style='font-size:13px'>: <?php echo $this->staff->get_name($class_plan['tutor_id']) ?></td>
									          <th scope="row" align="left" style='font-size:14px'>Group</th>
										      <td style='font-size:13px'>: <?php echo $class_plan['group_name'] ?></td>
									          
									        </tr>
									        
									        <tr>
									          <th scope="row" align="left" style='font-size:14px'>Time</th>
									          <td style='font-size:13px'>: <?php echo $this->time_plan->get_viewable_from_to_date_by_id($class_plan['time_planid']) ?></td>
									          <th scope="row" align="left" style='font-size:14px'>Room</th>
									          <td style='font-size:13px'>: <?php echo $this->room_plan->get_name_by_id($class_plan['room_id']) ?></td>
									          
									        </tr>
									       
									        <tr>
									          <th scope="row" align="left" style='font-size:14px'>Date</th>
									          <td style='font-size:13px'>: <?php echo hr_date($routine_date['terms']['date_class_list']) ?></td>
									          <th scope="row" align="left" style='font-size:14px'>Total Student</th>
									          <td style='font-size:13px'>: <?php echo count($student_data_list); ?></td>
									        </tr>

									      </tbody>
									    </table>
		                        	</div>
		                        
		                        	


									
									
									<table class="table table-bordered" width="100%" border="1" style="border-collapse: collapse; margin-top:20px;text-align:center">
										<thead>
											<tr>
												<th style="text-align:left; font-size:14px">Student ID</th>
												<th style="text-align:center; font-size:14px">Name</th>
												<th style="text-align:center; font-size:14px">Attendance</th>
											</tr>
											
										</thead>
										<tbody>									
										<?php 
											$i = 1; $j = 20000; $l = 40000; $m = 6000; $n = 8000;
											$z = 0;
											
                                            // for sorting by reg no
                                            
                                            foreach($student_data_list as $k=>$v){
                                                
                                                $reg_data         = $this->register->get_by_ID($v['register_id']);
                                                $student_data_list[$k]['registration_no'] = $reg_data['registration_no']; 
                                                
                                            }
                                            
                                            	
											foreach($student_data_list as $k=>$v){
												
												$reg_data 		= $this->register->get_by_ID($v['register_id']);
												if(!empty($reg_data)) {
												$student_name 	   = $this->student_data->get_first_sur_name($reg_data['student_data_id']);
												$Attandencechecked = $this->register->check_attendence_flag($reg_data['registration_no']);
												if($Attandencechecked) {
														echo"<tr class='gradeA'>";
															echo"<td width='30%' style='font-size:12px' >".$reg_data['registration_no']."<input type='hidden' name='registration_no_".$i."' value='".$reg_data['registration_no']."'></td>";
															echo"<td width='50%'  style='font-size:12px'>".$student_name."</td>";
															echo"
															<td width='20%'  style='font-size:12px'><span style='display:inline;width:20%;padding-right:5%;'>P <img style='padding-top:2px;' src='".base_url()."images/circle.PNG' style='width:5px;height:5px' /></span> <span style='display:inline;width:20%;padding-right:5%;'>LE <img style='padding-top:2px;' src='".base_url()."images/circle.PNG' style='width:5px;height:5px' /></span> </td>
															";
															
														echo"</tr>";
												}	
													
												}

												$i++; $j++; $l++; $m++; $n++; $z++;

												//echo $z;
												}
												
											// }

											

											?>										
										</tbody>
										
									</table>										
		                        	<div style="margin-top:20px;">
		                        		<table width="100%" style="border:1px solid gray;">
											<tr style="height:50px;">
												<th>Feed By &nbsp; ..........................</th>
													
												<th>Teacher Signature &nbsp; ..........................</th>
											</tr>
											
										</table>
		                        	</div>

			                            	                            	                            	                            	                            	                            	                            	                            	                            
		                        </div><!--<div class="col-sm-12 no-pad">-->
	                            <div class="clearfix"></div>
	                        </div>
	                        
	                        <div class="clearfix reg-student-list">
	                        

            
						        <?php if(!empty($result)){ ?>
            						<?php echo $result; ?>            
						        <?php } ?>

	                        
	                        
	                        </div>
	                        
	                        <div class="clearfix"></div>
							
			                

		           		</div>

		           		
                        

            </div>
            
            
            
            
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Confirm delete</h4>
                      </div>
                      <div class="modal-body">
                        Are you sure you want to delete?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                        <a href="javascript:void(0);" type="button" class="btn btn-danger confirm-btn">Yes</a>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->              



	
	<?php
	//redirect(base_url()."index.php/print_class_routine_management/?action=search");
	?>

         