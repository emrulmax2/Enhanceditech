


                <!-- Page Heading -->
<div id="page-wrapper">

            <div class="container-fluid">  
            <!-- Page Heading -->

            <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>   
            <?php echo $message; ?>  

            <div>
            <div class="text-right">
            <button class="btn btn-md btn-warning uploadstaffdocument" data-toggle="modal" data-target="#myNotesDoc"><i class="fa fa-comment"></i> Add New Comments</button>
            </div>
            </div> 
               <div class="clearfix">

               <h4><i class="fa fa-comments"></i> View Comments</h4>
               <div class="divider"></div>
               <div class="margin-height">
               <?php $i = 1;  ?>

            <?php foreach($inboxlists as $list):
                    foreach($list as $inbox):
                    if($inbox["notification_type"]=="communication"){
            ?>
                      <div class="clearfix">
                       <?php if($inbox["notification_from"]=="student") {?>
                         <div class="col-sm-6 alert alert-info">
                          <p><i class="fa fa-comments-o"></i><b> 
                          <?php echo $this->student_data->get_fullname_by_ID($communicationlist[$inbox["communication_id"]]['student_data_id']); ?>
                            </b> Says : <br/>
                            <i><small><?php echo $communicationlist[$inbox["communication_id"]]["datetime"];?></small></i>
                          </p>
                           <?php echo htmlspecialchars_decode($communicationlist[$inbox["communication_id"]]['text']); ?>
                           
                           <?php 
                              $uploadlists = $this->student_upload->get_student_uploadlistByserial($communicationlist[$inbox["communication_id"]]['student_data_id'],$communicationlist[$inbox["communication_id"]]['serial']); $filecount =1;
                              
                              if(count($uploadlists)>0){
                            echo '<p class="dark"><i class="fa fa-paperclip"></i> Attachments: </p>';
                              foreach($uploadlists as $list):
                           ?>
                              
                              <p> <a href="<?php echo base_url().$list["filepath"]; ?> " target="_blank" class="dark"><i class="fa fa-file"></i> <?php if($list["filename"]!="") echo $list["filename"]; else {echo "Attached file".$filecount++; } ?>
                              </a></p> 
                              
                           <?php
                              endforeach;
                              }
                           ?>
                          </div>
                        <?php } else { ?>                              
                          <div class="col-sm-6"></div>
                        <?php } ?>
                                    
                        <?php if($inbox["notification_from"]=="staff") { ?>
                         <div class="col-sm-6 alert alert-warning">
                            <p><i class="fa fa-comment-o"></i><b> Staff: 
                             <?php echo $this->staff->get_name($communicationlist[$inbox["communication_id"]]['staff_id']); ?>
                              </b> Says, <br/>
                              <i><small><?php echo $communicationlist[$inbox["communication_id"]]["datetime"];?></small></i>
                            </p>
                            <?php echo htmlspecialchars_decode($communicationlist[$inbox["communication_id"]]['text']); ?>
                         </div>
                         <?php } else { ?>
                         <div class="col-sm-6"></div>
                         <?php } ?>
                       </div>
                        
			<?php       }
                       endforeach;
                    endforeach;
            ?>
                                    

                        
               </div>

            </div><!--End of upload file list-->


                 <!-- Modal -->
                <div class="modal fade" id="myNotesDoc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-comment"></i> Add Comment</h4>
                      </div>
                      <div class="modal-body">
                      <div class="msg"></div>

                       <div class="form-group">
                       <label for="formstatus"> Comments : </label>
                       <textarea class="form-control tinymce" name="comment" cols="" rows="15"></textarea>                       
                       <input type="hidden" name="staff_id" value="<?php echo $staff_id;?>">
                       <input type="hidden" name="ref_id" value="<?php echo $student_appid;?>">
                       </div>
                                             <div class="form-group">
                       <label for="formstatus" class="sr-only"> File name : </label>
                        <input type="hidden" class="form-control" name="filename"  />
                       </div>
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
                       
                       
                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <button type="button" name="uploadstudentstate" class="btn btn-success" id="uploadstudentstate" ><i class="fa fa-comment"></i> Add New Comment</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->     


    </div> <!-- end of #container-fluid -->
 </div> <!-- end of #page-wrapper -->
 
