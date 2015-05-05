<script language="javascript" type="text/javascript">
$(document).ready(function(){
      
    
    
});
function recallRemove(){
    $('.remove-btn').click(function(){
            
        var id = $(this).attr('id'); //alert(id);
        $('#myModal').find('.confirm-btn').attr('onclick','RemoveFromList(\''+id+'\',\'paddy\')');     // delete paddylists
        $('#myModal').css({'top':'30%'});
        $('#myModal').modal('toggle');
        
        
    });   
}
</script>
        <div id="page-wrapper">

            <div class="container-fluid">

            <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                <div class="row">
	                <div class="col-lg-12">
                		<a class="btn btn-md btn-primary"  href="<?php echo current_url(); ?>/?action=add"><i class="fa fa-plus"></i> Add User</a>
                		<!--<a class="btn btn-md btn-info" type="button"><i class="fa fa-list"></i> Back to List</a>-->
	                </div>
                </div>

                <div class="row">
                    

               
               
               	
               
               <div class="col-lg-12">
               
               
	                <h4><i class="fa fa-list"></i> Users List </h4>
	                <table class="dTable display">
	                    <thead>
	                        <tr>
	                            <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>       
                                <th>Usertype</th>       
	                            <th>Action</th>       
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <?php
	                           
	                            

                                
	                            foreach($user_data->result() as $user){
	             
	                                echo "<tr  class='gradeA'>";                 
	                                echo "<td>".$user->ID."</td>";
	                                echo "<td>".$user->username."</td>"; 
                                    echo "<td>".$user->email."</td>"; 
	                                echo "<td>".$user->usertype."</td>"; 
	                                echo "<td><a href='".current_url()."/?action=edit&id=".$user->ID."' class='btn btn-sm btn-success margin-right-5'><i class='fa fa-pencil-square-o'></i></a><a href='javascript:void(0);' class='btn btn-sm btn-danger remove-btn' id='".$user->ID."'><i class='fa fa-times'></i></a></td>";
	                                echo "</tr>";

	                            } 
	                                                    
	                                    
	                        ?>    
	                    </tbody>
	                </table>               
               
               </div>
               
               

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

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