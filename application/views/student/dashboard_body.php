<?php ?>
<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome! <small><?php echo $fullname; ?> </small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Home
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <?php if($admission_status == "new_app" || $admission_status == "no_app"): ?>
               <div class="row">
               	  <div class="col-md-12 text-right">
                    <a class="btn btn-md btn-dark"  href="<?php echo current_url(); ?>/?action=add"><i class="fa fa-plus"></i> Apply online</a>
               	  </div>	
               </div>
               <?php endif; ?>

                <div class="row">

                  <div class="col-lg-12" style="padding-top: 10px;">
                    <?php if($this->session->flashdata('message') != "") {?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                      <?php echo $this->session->flashdata('message'); ?>
                    </div>
                    <?php } ?>
                    
                  </div>
                  
                </div> 

               <div class="row">
               <div class="col-lg-12">
                    
                    <h4><i class="fa fa-mortar-board"></i> Student Application List </h4> 
                      <?php if($admission_status == "new_app" || $admission_status == "open_app"): ?>                                                                                       
	                <table class="dTable display">
	                    <thead>
	                        <tr>
	                            <th>Reference no</th>
                                <th>Application date</th>
                                <th>Email</th>       
                                <th>Application Status</th>       
	                            <th>Action</th>       
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <?php
	                           
	                            

                                
	                            foreach($user_data->result() as $user){
	             
	                                echo "<tr  class='gradeA'>";                 
	                                echo "<td>".$user->student_application_reference_no."</td>";
	                                echo "<td>".$user->student_app_submitted_datetime."</td>"; 
                                    echo "<td>".$user->student_email."</td>"; 
                                    echo "<td>".$user->student_admission_status."</td>"; 
	                                echo "<td><a href='".current_url()."/?action=edit&id=".$user->id."' class='btn btn-sm btn-primary margin-right-5'><i class='fa fa-eye'></i> View</a></td>";
	                                echo "</tr>";

	                            } 
	                                                    
	                                    
	                        ?>    
	                    </tbody>
	                </table>               
                     <?php else: ?>
                     <div class="alert alert-warning"><p><i class="fa fa-warning"></i> No student application found. Please, Apply for a <a class=""  href="<?php echo current_url(); ?>/?action=add">new application.</a></p></div>
                     <?php endif;?>
               </div>
<!-- <?php //foreach($inbox as $student_data => $lists):?>
 		<?php //foreach($lists as $inbox_row): ?>
 <pre>
 <?php //print_r($inbox_row); ?>
 
 </pre>           
		
		<?php //endforeach; ?>              
 <?php //endforeach; ?>              
 <pre>
 <?php //print_r($communication); ?>
 
 </pre>   -->        

            </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->