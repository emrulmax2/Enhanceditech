<script language="javascript" type="text/javascript">
$(document).ready(function(){
      
    
    
});
function recallRemove(){
    $('.remove-btn').click(function(){
            
        var id = $(this).attr('id'); //alert(id);
        $('#myModal').find('.confirm-btn').attr('onclick','RemoveFromList(\''+id+'\',\'time_plan\')');
        $('#myModal').css({'top':'30%'});
        $('#myModal').modal('hide');
        $('#myModal').modal('toggle');
        
        
    });   
}
</script>


                <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                <div class="row">
	                <div class="col-lg-12">
                		
<?php
if(!empty($priv[1]) || $this->session->userdata('label')=="admin"){
?>                		
                		<a class="btn btn-md btn-primary"  href="<?php echo base_url(); ?>index.php/time_plan_management/?action=add"><i class="fa fa-plus"></i> Add New Time Plan</a>
<?php
}                			
?>                		
                		
                		<!--<a class="btn btn-md btn-info" type="button"><i class="fa fa-list"></i> Back to List</a>-->
	                </div>
                </div>

                <div class="row">
                    
<!--                    <form role="form">
                    
		                <div class="col-lg-12">

		                        <div class="form-group">
		                            <label>Company Name</label>
		                            <input class="form-control" type="text" name="company_name">
		                        </div>

		                        <div class="form-group">
		                            <label>Address</label>
		                            <input class="form-control" type="text" name="address">
		                        </div>	
		                        
		                        <div class="form-group">
		                            <label>Contact Person</label>
		                            <input class="form-control" type="text" name="contact_person">
		                        </div>	
		                        
		                        <div class="form-group">
		                            <label>Phone</label>
		                            <input class="form-control" type="text" name="phone">
		                        </div>		                        		                        	                        

		                        <div class="form-group">
		                            <label>Bank Name</label>
		                            <input class="form-control" type="text" name="bank_name">
		                        </div>	
		                        
		                        <div class="form-group">
		                            <label>Branch Name</label>
		                            <input class="form-control" type="text" name="branch_name">
		                        </div>
		                        
		                        <div class="form-group">
		                            <label>Account Number</label>
		                            <input class="form-control" type="text" name="account_number">
		                        </div>		                        		                        
		                    
		           		</div>

		            
		            
		                <div class="col-lg-6">



		                    
		           		</div>
		           		
		           		<div class="clearfix"></div>
		           		
		           		<div class="col-lg-12">
		           		
		           			<button type="submit" class="btn btn-default btn-success col-xs-5">Submit</button>
		           			<div class="col-xs-2"></div>
			                <button type="reset" class="btn btn-default btn-danger col-xs-5">Cancel</button>
			                		            
                        </div>
               </form> -->
               
               
<?php
    if(!empty($priv[0]) || $this->session->userdata('label')=="admin"){//// ------- check list priv                   
?>              	
               
               <div class="col-lg-12">
               
               
	                <h4><i class="fa fa-list"></i> Time Plan List </h4>
	                <table class="dTable display">
	                    <thead>
	                        <tr>
	                            <th>Start Time</th>
	                            <th>End Time</th>
	                            <th>Action</th>      
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <?php
	                           
	                            

                                
	                            foreach($time_plan_list as $k => $v){
	             
	                                echo "<tr  class='gradeA'>";                 
	                                echo "<td>".date("g:i:s a",strtotime(tinymce_decode($v["start_time"])))."</td>";
	                                echo "<td>".date("g:i:s a",strtotime(tinymce_decode($v["end_time"])))."</td>";
	                                //if(empty($staff_privileges_course_management['course_mng_edit']) && $this->session->userdata('label')!="admin")
	                                //echo"<td></td>";
	                                //else
	                                echo "<td>";
                                    if(!empty($priv[2]) || $this->session->userdata('label')=="admin") echo"<a href='".base_url()."index.php/time_plan_management/?action=edit&id=".$v["id"]."' class='btn btn-sm btn-success margin-right-5'><i class='fa fa-pencil-square-o'></i></a>";
                                    if(!empty($priv[3]) || $this->session->userdata('label')=="admin") echo"<a href='javascript:void(0);' class='btn btn-sm btn-danger remove-btn' id='".$v["id"]."'><i class='fa fa-times'></i></a>";
                                    echo"</td>";
	                                echo "</tr>";

	                            } 
	                                                    
	                                    
	                        ?>    
	                    </tbody>
	                </table>               
               
               </div>
               
<?php
    }                   
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