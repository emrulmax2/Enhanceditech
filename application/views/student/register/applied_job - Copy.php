<script type="text/javascript">
$(document).ready(function(){
  


	$('#excuse_document .upload-file-btn').click(function(){
		
		//alert('hi');
		$('.file-list-group').html("");
    $("h5").text("Uploaded Files :");
		$.each($('#excuse_document').find('input.documentfile'),function(){
			
			var filename=$(this).val();
			var filepath = "uploads/files/"+filename;
			var url = '<?php echo base_url(); ?>'+filepath;
			$('.file-list-group').append("<a target='_blank' href='"+url+"' class='list-group-item' fn=''>"+filename+"<input type='hidden' name='filelist[]' value='"+filepath+"'></a>");
				
			
		});
		
	});	
	
});	
</script>
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
                                <i class="fa fa-dashboard"></i> Home > Job Application List
                            </li>
                        </ol>
                        

                    </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="msg"></div>
                  </div>
                </div>
               
              <div class="row">
                 <div class="col-lg-12">
                    
                    <div class="divider"></div>  
                     <div class="form-group">
                       <h4><i class="fa fa-user "></i> Job Application List</h4>
                       <p class="divider"></p>
                     </div>

                      <div class="form-group clearfix">
                        

                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <table class="dTable display">

                            <thead>
                                <tr>
                                    <th>Job Name</th>
                                    <th>Issued date</th>
                                    <th>Due date</th>
                                    <th>File</th>      
                                    <th>Status</th>      
                                    <th>Department</th>      
                                    <th>Completed date</th>      
                                </tr>
                            </thead>

                            <tbody>
                              <?php foreach($job_assign_data as $k=>$v) {?>

                                <tr>
                                  
                                  <td><?php echo ucfirst($this->jobs->get_name_by_id( $v['jobs_id'] )); ?></td>
                                  <td><?php echo $v['issued_date']; ?></td>
                                  <td><?php echo $v['due_date']; ?></td>
                                  <td>
                                  <?php
                                  $doc = array();
                                  if(!empty($v['documents'])) {
                                    $doc = unserialize($v['documents']);
                                  }
                                  //var_dump($doc);
                                  if(!empty($doc)) {
                                    foreach ($doc as $x => $y) {
                                      echo "<a href='$y'>View</a>";
                                    }
                                  } else {
                                    echo "No document.";
                                  } 
                                  ?>
                                  </td>
                                  <?php if($v['status']=="done") {?>
                                    <td style="background:#dff0d8;" >
                                  <?php }elseif($v['status']=="decline") {?>
                                    <td style="background:#fcf8e3;" >
                                  <?php } elseif($v['status']=="pending") {?>
                                    <td style="background:#f2dede;" >
                                  <?php } ?>
                                  
                                  <?php 
                                  
                                    if($v['status']=="decline"){echo ucfirst($v['status']."<br>Reason: ".$v['declined_reason']);
                                    }else echo ucfirst($v['status']);
                                  
                                  ?>
                                  </td>
                                  <td>
                                  <?php 
                                  //echo $v['job_department_id'];
                                  $dept = explode(",", $v['job_department_id']);

                                  foreach ($dept as $key => $value) { 
                                    echo $this->job_department->get_name_by_id($value).", ";
                                   } 
                                   ?>
                                  </td>
                                  <td><?php echo date("Y-m-d", strtotime($v['modified_date'])); ?></td>
                                </tr>


                              <?php } ?>

                            </tbody>

                          </table>
                        </div>

                        
                      </div>






                 </div>
         

              </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

         <!-- Modal -->
                <div class="modal fade" id="excuse_document" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Upload Documents</h4>
                      </div>
                      <div class="modal-body">
                      <div class="msg"></div>
                       <div class="form-group">
                      <label class="margin-top-2">Upload Document (<i class="alert-warning">file size no more than 10mb</i>) </label><br/>
                          <span class="btn btn-primary fileinput-button">
                            <i class="fa fa-plus"></i>
                            <span>Add file</span>
                            <!-- The file input field used as target for the file upload widget -->
                            <input id="fileupload" type="file" name="files[]" multiple>
                            
                            </span>
                            <br>
                            <br>
                            <!-- The global progress bar -->
                            <div id="progress" class="progress">
                                <div class="progress-bar progress-bar-success"></div>
                            </div>
                            <!-- The container for the uploaded files -->
                            <div id="files" class="files">
                            </div>
                            <!-- The container for the uploaded files -->     

                        
                        </div>
                      <!-- <div class="form-group">
                       <label for="formstatus"> File name : </label>
                        <input type="text" class="form-control" name="filename"  />
                       </div>                        
                        
                       <div class="form-group">
                       <label for="formstatus"> Check Hard copy : </label>
                       <div class="radio radio-success">
                        <input type="radio" name="check_hard_copy_doc" id="checkhardcopy1"  value="yes"><label for="checkhardcopy1"> Yes</label>
                        </div>
                        <div class="radio  radio-danger">
                        <input type="radio" name="check_hard_copy_doc"  id="checkhardcopy2"  value="no" checked ="checked" > <label for="checkhardcopy2"> No </label>
                        </div>
                        </div>
                       <div class="form-group reason">
                       <label for="formstatus"> Reason : </label>
                       <textarea class="form-control" name="reason" cols="" rows="3"></textarea>

                       </div> -->
                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <!-- <button type="button" name="uploadDoc_do_it_online" class="btn btn-success" id="changebuttonstate" ><i class="fa fa-upload"></i> Upload</button> -->
                        <button type="button" class="btn btn-info upload-file-btn" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>
                        <!--<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>-->
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->   