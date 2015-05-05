<script language="javascript" type="text/javascript">
$(document).ready(function(){
      
	$('#checkbox99999999999').click(function(){
		
		if(this.checked==true){
			$.each($('.class-plan-list-body').find('.class-plan-id'),function(){
			
				this.checked=true;	
				
			});
			
		}else{
			$.each($('.class-plan-list-body').find('.class-plan-id'),function(){
			
				this.checked=false;	
				
			});			
		}
		//alert("yes");
	});
	
	$('#checkbox99999999999, tbody.class-plan-list-body td .class-plan-id').click(function(){
		//alert('yes');
		var i =0; var this_id = 0;
		$.each($('.class-plan-list-body').find('.class-plan-id'),function(){
			
			if(this.checked==true){
			 i++;
			 this_id = $(this).val();
			}
		});
		//alert(i);
		if(i>0){
			if(i==1){
				$.each($('.btn-area').find('.add-new-class-plan-btn,.edit-class-plan-btn'),function(){ $(this).remove(); });
				<?php if(!empty($priv[6]) || $this->session->userdata('label')=="admin"){ ?>  $('.btn-area').append("<a class='btn btn-md btn-primary edit-class-plan-btn'  href='<?php echo base_url(); ?>index.php/class_plan_management/?action=add&id="+this_id+"'><i class='fa fa-plus'></i> Edit Class Plan</a>&nbsp;&nbsp;"); <?php } ?>	
			}else{
				$.each($('.btn-area').find('.add-new-class-plan-btn,.edit-class-plan-btn'),function(){ $(this).remove(); });
				//$('.btn-area').append("<a class='btn btn-md btn-primary add-new-class-plan-btn'  href='<?php echo base_url(); ?>index.php/class_plan_management/?action=add'><i class='fa fa-plus'></i> Add New Class Plan</a>&nbsp;&nbsp;");				
			}
			$('.btn-area').find('.btn-assign-student').remove(); 
			<?php if(!empty($priv[7]) || $this->session->userdata('label')=="admin"){ ?> $('.btn-area').append("<a class='btn btn-md btn-warning btn-assign-student' href='javascript:void(0)'><i class='fa fa-plus'></i> Assign Student</a>"); <?php } ?>
			assignStudentCall();	
		}else{
			$('.btn-area').find('.btn-assign-student').remove();
			$.each($('.btn-area').find('.add-new-class-plan-btn,.edit-class-plan-btn'),function(){ $(this).remove(); });
			<?php if(!empty($priv[1]) || $this->session->userdata('label')=="admin"){ ?> $('.btn-area').append("<a class='btn btn-md btn-primary add-new-class-plan-btn'  href='<?php echo base_url(); ?>index.php/class_plan_management/?action=add'><i class='fa fa-plus'></i> Add New Class Plan</a>&nbsp;&nbsp;"); <?php } ?>
		}
		
	});
	
	

	
	
	
	
	    
    
});
function recallRemove(){
    $('.remove-btn').click(function(){
            
        var id = $(this).attr('id'); //alert(id);
        $('#myModal').find('.confirm-btn').attr('onclick','RemoveFromList(\''+id+'\',\'class_plan\')');
        $('#myModal').css({'top':'30%'});
        $('#myModal').modal('hide');
        $('#myModal').modal('toggle');
        
        
    }); 

    $('#checkbox99999999999, tbody.class-plan-list-body td .class-plan-id').click(function(){
		//alert('yes');
		var i =0; var this_id = 0;
		$.each($('.class-plan-list-body').find('.class-plan-id'),function(){
			
			if(this.checked==true){
			 i++;
			 this_id = $(this).val();
			}
		});
		//alert(i);
		if(i>0){
			if(i==1){
				$.each($('.btn-area').find('.add-new-class-plan-btn,.edit-class-plan-btn'),function(){ $(this).remove(); });
				<?php if(!empty($priv[6]) || $this->session->userdata('label')=="admin"){ ?> $('.btn-area').append("<a class='btn btn-md btn-primary edit-class-plan-btn'  href='<?php echo base_url(); ?>index.php/class_plan_management/?action=add&id="+this_id+"'><i class='fa fa-plus'></i> Edit Class Plan</a>&nbsp;&nbsp;"); <?php } ?>	
			}else{
				$.each($('.btn-area').find('.add-new-class-plan-btn,.edit-class-plan-btn'),function(){ $(this).remove(); });
				//$('.btn-area').append("<a class='btn btn-md btn-primary add-new-class-plan-btn'  href='<?php echo base_url(); ?>index.php/class_plan_management/?action=add'><i class='fa fa-plus'></i> Add New Class Plan</a>&nbsp;&nbsp;");				
			}
			$('.btn-area').find('.btn-assign-student').remove();
             
			<?php if(!empty($priv[7]) || $this->session->userdata('label')=="admin"){ ?> $('.btn-area').append("<a class='btn btn-md btn-warning btn-assign-student' href='javascript:void(0)'><i class='fa fa-plus'></i> Assign Student</a>"); <?php } ?>
			
            assignStudentCall();	
		}else{
			$('.btn-area').find('.btn-assign-student').remove();
			$.each($('.btn-area').find('.add-new-class-plan-btn,.edit-class-plan-btn'),function(){ $(this).remove(); });
			<?php if(!empty($priv[1]) || $this->session->userdata('label')=="admin"){ ?> $('.btn-area').append("<a class='btn btn-md btn-primary add-new-class-plan-btn'  href='<?php echo base_url(); ?>index.php/class_plan_management/?action=add'><i class='fa fa-plus'></i> Add New Class Plan</a>&nbsp;&nbsp;"); <?php } ?>
		}
		
	});  
}



function assignStudentCall(){
	
	$('.btn-area .btn-assign-student').click(function(){
		var class_plan_id_arr = [];
		//alert('yes');
		$.each($('.class-plan-list-body').find('.class-plan-id'),function(){
			
			if(this.checked==true) class_plan_id_arr.push($(this).attr('value'));
		});		
		
			url = getURL()+'/index.php/ajaxall/';
			$.ajax({
			   type: "POST",
			   data: {class_plan_id_arr: class_plan_id_arr, action: "assignStudentClassPlanIDList" },
			   url: url,
			   success: function(msg){
			     //$('.message').html(msg);
			     //alert(msg);
			     window.location = getURL()+'/index.php/assign_student_management/';
			   }
			});		
		
	});	
	
}


</script>


                <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                <div class="row">
	                <div class="col-lg-12 btn-area text-right">
                		
<?php
if( (!empty($priv[1]) || $this->session->userdata('label')=="admin") ){

?>                		
                		<a class="btn btn-md btn-primary add-new-class-plan-btn"  href="<?php echo base_url(); ?>index.php/class_plan_management/?action=add"><i class="fa fa-plus"></i> Add New Class Plan</a>
                		
<?php
}                			
?>                		
                		
                		<!--<a class="btn btn-md btn-info" type="button"><i class="fa fa-list"></i> Back to List</a>-->
	                </div>
                </div>

                
                <div class="row">
	                
	                <div class="col-lg-12 message">                
	                	<?php echo $message; ?>
	                </div>
	                
                </div>                 
                
                <div class="row">
                                   
<?php
    if(!empty($priv[0]) || $this->session->userdata('label')=="admin"){//// ------- check list priv                   
?>               	
               
               <div class="col-lg-12">
               
               
	                <h4><i class="fa fa-list"></i> Class Plan List </h4>
	                <table class="dTable display">
	                    <thead>
	                        <tr>
	                            <th><div class='checkbox checkbox-primary'><input id='checkbox99999999999' type='checkbox' class='form-control select-all-class-plan-list'><label for='checkbox99999999999'>Class ID</label></div></th>
	                            <th>Course Name</th>
	                            <th>Module Name</th>
	                            <th>Semester Name</th>
	                            <th>Group</th>
	                            <th>Class Time</th>
	                            <th>Room Number</th>
	                            <th>Action</th>
      
	                        </tr>
	                    </thead>
	                    <tbody class="class-plan-list-body">
	                        <?php
	                           
	                            

                                
	                            foreach($class_plan_list as $k => $v){
	             
	             					$chk = $this->class_lists->checkIfClassListsExistByClassPlanID($v["id"]);
	             					$chk_assign_std = $this->student_assign_class->checkIfExistByClassPlanId($v["id"]);
	             					
	                                echo "<tr  class='gradeA'>";                 
	                                echo "<td><div class='checkbox checkbox-primary'><input name='class_id[]' id='checkbox".$v["id"]."' type='checkbox' class='form-control class-plan-id' value='".$v["id"]."'><label for='checkbox".$v["id"]."'>".$v["id"]."</label></div></div></td>";
	                                echo "<td>". $this->course->get_name($this->course_relation->get_course_id_by_id($v['course_relation_id']))."</td>";
	                                echo "<td>".$this->coursemodule->get_name_by_id($v['coursemodule_id'])."</td>";
	                                echo "<td>".$this->semester_plan->get_name_by_id($v['semester_planid'])."</td>";
	                                echo "<td>".$v["group_name"]."</td>";
	                                echo "<td>".$this->time_plan->get_viewable_from_to_date_by_id($v["time_planid"])."</td>";
	                                echo "<td>".$this->room_plan->get_name_by_id($v["room_id"])."</td>";
	                                echo "<td>";
	                                if(!$chk){
	                                	if(!empty($priv[4]) || $this->session->userdata('label')=="admin") echo "<a href='".base_url()."index.php/class_plan_management/?action=generate_days&id=".$v["id"]."' class='btn btn-sm btn-success' style='margin:4px;'><i class='fa fa-pencil-square-o'></i> Generate Days</a>";
	                                }else{
	                                	if(!empty($priv[2]) || $this->session->userdata('label')=="admin") echo "<a href='".base_url()."index.php/class_plan_management/?action=generate_days&id=".$v["id"]."' class='btn btn-sm btn-success' style='margin:4px;'><i class='fa fa-eye'></i> View Days</a>";
                                    }
                                    if($chk_assign_std){
										if(!empty($priv[3]) || $this->session->userdata('label')=="admin") echo "<a href='".base_url()."index.php/assign_student_management/?action=view_student_list&class_plan_id=".$v["id"]."' class='btn btn-sm btn-info' style='margin:4px;'><i class='fa fa-eye'></i> View Assigned Students</a>";	
                                    }
                                    if(!empty($priv[5]) || $this->session->userdata('label')=="admin") echo"<a href='javascript:void(0);' class='btn btn-sm btn-danger remove-btn' id='".$v["id"]."'><i class='fa fa-times'></i></a>";
	                                echo "</td>";	
	                                //if(empty($staff_privileges_course_management['course_mng_edit']) && $this->session->userdata('label')!="admin")
	                                //echo"<td></td>";
	                                //else
	                                //echo "<td><a href='".base_url()."index.php/semester_plan_management/?action=edit&id=".$v["id"]."' class='btn btn-sm btn-success margin-right-5'><i class='fa fa-pencil-square-o'></i></a><a href='javascript:void(0);' class='btn btn-sm btn-danger remove-btn' id='".$v["id"]."'><i class='fa fa-times'></i></a></td>";
	                                echo "</tr>";

	                            } 
	                                                    
	                                    
	                        ?>    
	                    </tbody>
	                </table>               
               
               </div>
               
<?php
    }//if(!empty($priv[0]) || $this->session->userdata('label')=="admin"){//// ------- check list priv                   
?>               

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