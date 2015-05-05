<script language="javascript" type="text/javascript">
$(document).ready(function(){
      
    
    
});
function recallRemove(){
    $('.remove-btn').click(function(){
            
        var id = $(this).attr('id'); //alert(id);
        $('#myModal').find('.confirm-btn').attr('onclick','RemoveFromList(\''+id+'\',\'student_gender\')');
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
                		<a class="btn btn-md btn-primary"  href="<?php echo base_url(); ?>index.php/gender_management/?action=add"><i class="fa fa-plus"></i> Add New Gender</a>
<?php
}                			
?>                		
                		
                		<!--<a class="btn btn-md btn-info" type="button"><i class="fa fa-list"></i> Back to List</a>-->
	                </div>
                </div>

                <div class="row">
                    
               	
               
               <div class="col-lg-12">
               
<?php
	if(!empty($priv[0]) || $this->session->userdata('label')=="admin"){//// ------- check list priv               	
?>                
	                <h4><i class="fa fa-list"></i> Gender List </h4>
	                <table class="dTable display">
	                    <thead>
	                        <tr>
	                            <th>Gender Name</th>
	                            <th>Action</th>      
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <?php
	                           
	                            

                                
	                            foreach($gender_list as $k => $v){
	             
	                                echo "<tr  class='gradeA'>";                 
	                                echo "<td>".$v["name"]."</td>";
	                                //if(empty($staff_privileges_course_management['course_mng_edit']) && $this->session->userdata('label')!="admin")
	                                //echo"<td></td>";
	                                //else
	                                echo "<td>";
	                                if(!empty($priv[2]) || $this->session->userdata('label')=="admin")
	                                echo "<a href='".base_url()."index.php/gender_management/?action=edit&id=".$v["id"]."' class='btn btn-sm btn-success margin-right-5'><i class='fa fa-pencil-square-o'></i></a>";
	                                if(!empty($priv[3]) || $this->session->userdata('label')=="admin")
	                                echo "<a href='javascript:void(0);' class='btn btn-sm btn-danger remove-btn' id='".$v["id"]."'><i class='fa fa-times'></i></a></td>";
	                                echo "</tr>";

	                            } 
	                                                    
	                                    
	                        ?>    
	                    </tbody>
	                </table>               
<?php
	}//// ------- check list priv               	
?>               
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