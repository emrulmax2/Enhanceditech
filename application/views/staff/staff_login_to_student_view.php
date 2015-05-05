
                <!-- Page Heading -->
  
  
            <?php echo $message; ?>  
 
               <div class="clearfix">

               <h4><i class="fa fa-unlock-alt"></i> Login information of student</h4>
               <div class="divider"></div>
               <div class="margin-height">
                                    
					<div class="alert alert-danger" role="alert">
					  <p><i class="fa fa-hand-o-right"></i> Before you login to student panel, please make sure to <strong>Open Different Browser</strong> and not from your current browser.</p>
					  <p><i class="fa fa-hand-o-right"></i> From different browser type this url <strong><?php echo base_url(); ?>index.php/login_to_student_panel/?enc=<?php echo $new_activate_session_id; ?></strong> and login.</p>
					  <p><i class="fa fa-hand-o-right"></i> After you log in successfully the above link will be invalid. To generate new link please reload this page.</p>
					  <p><i class="fa fa-hand-o-right"></i> Do not forget to logout from student panel.</p>
					</div>
               		
                        
               </div>

            </div><!--End of upload file list-->


    


 