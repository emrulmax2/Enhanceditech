<style>
	.student_ids {
		text-transform: uppercase;
	}
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

$(document).ready(function(){
      
	$('#checkbox99999999999').click(function(){
		
		if(this.checked==true){
			$.each($('.class-plan-list-body').find('.class-plan-id'),function(){
			
				this.checked=true;	
				
			});
			$('.vew-feed-attendance').html('<?php if( ( !empty($priv[1]) || $this->session->userdata('label')=="admin" ) ){ ?><button style="margin:3px;" class="btn btn-md btn-warning generateletter" data-toggle="modal" data-target="#send_email_student"><i class="fa fa-envelope"></i> Send Email</button><?php } if( ( !empty($priv[2]) || $this->session->userdata('label')=="admin" ) ){ ?><button style="margin:3px;" class="btn btn-md btn-primary generateletter" data-toggle="modal" data-target="#send_sms_student"><i class="fa fa-mobile"></i> Send SMS</button><?php } if( ( !empty($priv[3]) || $this->session->userdata('label')=="admin" ) ){ ?><button style="margin:3px;" class="btn btn-md btn-success generateletter" data-toggle="modal" data-target="#send_letter_student"><i class="fa fa-plus"></i> Generate New Letter</button><?php } ?>');
			
		}else{
			$.each($('.class-plan-list-body').find('.class-plan-id'),function(){
			
				this.checked=false;	
				
			});
			$('.vew-feed-attendance').html('');
		}
		//alert("yes");
	});
	
	$('tbody.class-plan-list-body td .class-plan-id').click(function(){
		//alert('yes');
		var i =0;
		//var id = [];
		$.each($('.class-plan-list-body').find('.class-plan-id'),function(){
			
			if(this.checked==true) {
				//id.push($(this).val());
				i++;
			} 
		});
		if(i>0){ 
			$('.vew-feed-attendance').html('<?php if( ( !empty($priv[1]) || $this->session->userdata('label')=="admin" ) ){ ?><button style="margin:3px;" class="btn btn-md btn-warning generateletter" data-toggle="modal" data-target="#send_email_student"><i class="fa fa-envelope"></i> Send Email</button><?php } if( ( !empty($priv[2]) || $this->session->userdata('label')=="admin" ) ){ ?><button style="margin:3px;" class="btn btn-md btn-primary generateletter" data-toggle="modal" data-target="#send_sms_student"><i class="fa fa-mobile"></i> Send SMS</button><?php } if( ( !empty($priv[3]) || $this->session->userdata('label')=="admin" ) ){ ?><button style="margin:3px;" class="btn btn-md btn-success generateletter" data-toggle="modal" data-target="#send_letter_student"><i class="fa fa-plus"></i> Generate New Letter</button><?php } ?>');
			
		}else{
			$('.vew-feed-attendance').html("");
		}
		
	});
	
    
});



</script>



                <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                <div class="row">
	                <div class="col-lg-12">
<?php
//if(!empty($staff_privileges_letter_management['letter_mng_add']) || $this->session->userdata('label')=="admin"){	                	
?>	                
                		
<?php
//}	                	
?>                		
                		<!--<a class="btn btn-md btn-info" href="<?php //echo base_url(); ?>index.php/print_class_routine_management/?action=search"><i class="fa fa-list"></i> Back to List</a>-->
	                </div>
	                
                </div>
                
                <div class="row">
	                
	                <div class="col-lg-12 message">                
	                	<?php echo $message; ?>
	                	<?php if($this->session->flashdata('message')) {
	                		echo $this->session->flashdata('message');
	                	}
	                	?>
	                </div>
	                
                </div>                

                <div class="row">
                    
                    
                    <form class="search_student_form" role="form" method="post" action="<?php echo base_url(); ?>index.php/send_letter/?action=search">


							
							














                    
		                <div class="col-lg-12">
			                <div class="panel panel-info">
								<div class="panel-heading">
				                	<div class="row">
				                		<div class="col-lg-7 col-md-7 col-sm-7">
				                			 <h4><i class="fa fa-envelope"></i> Send Letter To Student </h4>
				                		</div>
				                		<div class="col-lg-5 col-md-5 col-sm-5">
                                        
<?php
                                            if( ( !empty($priv[0]) || $this->session->userdata('label')=="admin" ) ){                                            
?>                                        
											    <div class="text-right btn-area">
					                			    <button type="submit" class="btn btn-default btn-success">Search</button>
											    </div>
<?php
                                            }
?>
				                		</div>
				                		
				                	</div>
			                	</div>
			                	<div class="panel-body">

			                        <div class="row">
			                        <!-- <div class="mes"></div> -->
					                        <div class="form-group">
		                        				<div class="col-sm-3">

						                            <label>Semester</label>
													<select class="form-control" name="semester_id" required>
													  <option value="">Please Select</option>
														<?php
														foreach($semester_list as $k=>$v){											  	
														?>											  
													  		<option value="<?php echo $v['id']; ?>"><?php echo $v['semister_name']; ?></option>
														<?php
														}
														?>												  
													</select>
					                            </div>
		                        				<div class="col-sm-3">
						                            <label>Select Course</label>
						                            <select class="form-control course_id_list" name="course_id" required>

		                            	
						                            </select>
					                            </div>
					                            
		                        				<div class="col-sm-3">
						                            <label>Select Modules</label>
						                            <select class="form-control coursemodule_id" name="coursemodule_list">

		                            	
						                            </select>
					                            </div>
					                            <div class="col-sm-3">
					                            	<label>Select Group</label>
					                            	<select class="form-control group_list" name="group" id="">
					                            		
					                            	</select>
					                            </div>
		                        				
					                            <div class="clearfix"></div>	                            	                            	                            
					                        </div>
					                        
					                        <div class="group_area col-sm-12">
					                        
					                        
					                        
					                        </div><!--<div class="group_area col-sm-12">-->
					                        
					                        	                                
	                        	                        
		                		    </div>
	                		    </div>
			                	
			              </div>  

		           		</div>

		           		
		           		<div class="clearfix"></div>
		           		
		           		<div class="col-lg-12">
		           		
		           			<!-- <button type="submit" class="btn btn-default btn-success col-xs-5">Submit</button>
		           			<div class="col-xs-2"></div>
			                <button type="reset" class="btn btn-default btn-danger col-xs-5">Cancel</button> -->
			                
			                <input name="ref" type="hidden" value="<?php echo $ref; ?>">		            
			                <input name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
			                		            
                        </div>
               </form>
               
               
               

            </div>
			<div class="row">
				<div class="col-lg-6">
					<div class="text-left">
						<?php //echo $print_btn; ?>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="text-right vew-feed-attendance" style="height:36px;"></div>
					
				</div>
				
	            
			</div>
			<?php if($this->input->get('action') && $this->input->get('action') == "search") {?>
            <div class="col-lg-12">

            	<h4><i class="fa fa-list"></i> Search Result </h4>
	                <table class="dTable display">
	                    <thead>
	                        <tr>
	                            <th><div class='checkbox checkbox-primary'><input id='checkbox99999999999' type='checkbox' class='form-control select-all-class-plan-list'><label for='checkbox99999999999'>Student ID</label></div></th>
	                            <th>Name</th>
      
	                        </tr>
	                    </thead>
	                    <tbody class="class-plan-list-body">
	                        <?php
	                           
	                            

                                
	                            foreach($clean_student_list as $k => $v){

	             					$others = array();

	             					$student_info = $this->register->get_by_ID($v);

	             					if(!empty($student_info)) {

	             						$others = $this->student_data->get_student_email_phone_first_last_name_by_ID($student_info['student_data_id']);

		                                echo "<tr  class='gradeA'>";                 
		                                echo "<td><div class='checkbox checkbox-primary'><input name='student_data_id[]' id='checkbox".$student_info['student_data_id']."' type='checkbox' class='form-control class-plan-id' value='".$student_info['student_data_id']."'><label class='student_ids' for='checkbox".$student_info['student_data_id']."'>".$student_info['registration_no']."</label></div></div></td>";
		                                ?>

			                            <td><?php echo $others->student_first_name." ".$others->student_sur_name; ?></td>

		                                <?php
		                                echo "</tr>";
		                            }

	                            } 
	                                                    
	                                    
	                        ?>    
	                    </tbody>
	                </table> 
            </div>
			<?php } ?>
            
<?php 

$thisLetterlists = $this->letter_set->get_all();     
$thisSignatorylists = $this->signatory_set->get_all();

?>            
            
				<div class="modal fade" id="send_letter_student" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-send"></i> Issue Letter <img class="loading" src="<?php echo base_url(); ?>/images/loading.gif" alt=""></h4>
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
                       
                       
                       </div>
                      </div>
                      <div class="modal-footer">
                      
                      <div class="checkbox checkbox-primary" style="display: inline-block;margin-right: 15px;">
                          <input name="send_email" id="send_email" type="checkbox" class="form-control" value="1"><label for="send_email">Send Email </label>
                       </div>

                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.gif" alt="">
                        <button type="button" name="sendletterToSelectedStudent" class="btn btn-success" id="" ><i class="fa fa-send"></i> Issue New Letter</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->             
                
				<!-- Modal Email-->
                <div class="modal fade" id="send_email_student" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope"></i> Email To Selected Student</h4>
                      </div>
                      <div class="modal-body">
                      <div class="msg"></div>

                       <div class="form-group">
                       <label for="formstatus"> Subject : </label>                       
                       <input class="form-control" type="text" name="emailSubject" value="">
                       </div>
                       <div class="form-group">
                       <label for="formstatus"> Email Description : </label>
                       <textarea class="form-control tinymce" name="emailDescription" cols="" rows="15"></textarea>                       
                       
                       
                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.gif" alt="">
                        <button type="button" name="sendEmailToSelectedStudent" class="btn btn-success" id="sendemail" ><i class="fa fa-send"></i> Send Email</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div>
                </div>
                <!-- /.modal -->     

                <div class="modal fade" id="send_sms_student" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-mobile"></i> SMS To Selected Student</h4>
                      </div>
                      <div class="modal-body">
	                      <div class="msg"></div>

	                       <div class="form-group">
	                       <label for="formstatus"> Subject : </label>                       
	                       <input class="form-control" type="text" name="smsSubject" value="">
	                       </div>
	                       <div class="form-group">
	                       <label for="formstatus"> SMS Description : </label>
	                       <textarea class="form-control" name="smsDescription" cols="" rows="15"></textarea>
	                       
	                      </div>
	                      <div class="modal-footer">
	                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.gif" alt="">
	                        <button type="button" name="sendSMSToSelectedStudent" class="btn btn-success" id="sendemail" ><i class="fa fa-mobile"></i> Send SMS</button>
	                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
	                      </div>
                      </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                  </div>
                </div>              