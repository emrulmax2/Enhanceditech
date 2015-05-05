
                <!-- Page Heading -->
  
          
            <?php echo $message; ?>  

            <div class="text-right">
            <?php if(!empty($priv[11]) || $this->session->userdata('label')=="admin"){ ?><button class="btn btn-md btn-warning uploadstaffdocument" data-toggle="modal" data-target="#myUploadDoc"><i class="fa fa-plus"></i> Add Document</button><?php } ?>
            </div>
   
               <div>

               <h4><i class="fa fa-list"></i> Uploaded file's list</h4>

               <div class="table-responsive margin-height">
                            <table class="dTable display">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>file</th>
                                        <th>Staff</th>
                                        <th>Reason</th>
                                        <th>Hard Copy Check</th>
                                        <th  class="text-right">Date</th>
                                    </tr>
                                </thead>
                                <tbody>

 				   		                <?php foreach($uploadlist as $upload):?>
                                <tr>
                                    <td><?php echo $upload['serial']; ?></td>
                                    <td><a target="_blank" href="<?php echo base_url().$upload['filepath']; ?>" ><?php echo $upload['filename']; ?></a></td>
                                    <td><?php echo $this->staff->get_name($upload['staff_id']); ?></td>
                                    <td><?php echo $upload['reason'] ?></td>
                                    <td><?php echo $upload['check_hard_copy_doc'] ?></td>
                                    <td><?php echo $upload['datetime'] ?></td>
                                </tr>

						                  <?php endforeach;?>
                                    
                                </tbody>
                            </table>
                        
               </div>

            </div><!--End of upload file list-->


                 <!-- Modal -->
                <div class="modal fade" id="myUploadDoc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                      <div class="form-group">
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
                       <textarea class="form-control" name="reason" cols="" rows="3"></textarea>                       <input type="hidden" name="staff_id" value="<?php echo $staff_id;?>">
                       </div>
                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <button type="button" name="uploadDoc" class="btn btn-success" id="changebuttonstate" ><i class="fa fa-upload"></i> Upload</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->     


 