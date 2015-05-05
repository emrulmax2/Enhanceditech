
                <!-- Page Heading -->
  
  
            <?php echo $message; ?> 
            
             

            <div>
            <div class="text-right">
            <?php if(!empty($priv[15]) || $this->session->userdata('label')=="admin"){ ?><button class="btn btn-md btn-warning uploadstaffdocument" data-toggle="modal" data-target="#myNotesDoc"><i class="fa fa-comment"></i> Send Message</button><?php } ?>
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
                       </div>
                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <button type="button" name="commentbuttonstate" class="btn btn-success" id="changebuttonstate" ><i class="fa fa-comment"></i> Add New Comment</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->     


 