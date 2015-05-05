<script>
  $(document).ready(function() {
    $("#follow-up-area").hide();
    $(".follow-up-open").on('click', function() {
        if (this.checked) {
          $(this).attr('checked', 'checked');
          $("#follow-up-area").fadeIn();
          //$("#follow-up-area").find('input').attr('required', 'required');
        }else {
          $(this).attr('checked', false);
          $("#follow-up-area").fadeOut();
          //$("#follow-up-area").find('input').attr('required', false);
        }
    });
    
    $(".delete-note").click(function(){
        
        //alert($(this).attr("id"));
        var id = $(this).attr("id");
        
        var url = getURL()+'/index.php/ajaxall/';
        var data="";

          $.post(url, {action: 'deleteFromNote', id: id  },

            function(msg){ 

                
                    
                    $(".message").html("<div class=\"alert alert-success\" role=\"alert\"><i class=\"fa fa-check\"></i> Note has been successfully deleted.</div>").fadeOut(3000, function(){ window.location='<?php echo current_url(); ?>';  });

            });            
        
        
    });
    
    

  });
</script>
                <!-- Page Heading -->
            <!--<pre>-->
            <?php //var_dump($priv); ?>
            <!--</pre>-->
            <?php echo $message; ?>  
            <div class="col-sm-12 message"></div>
            
            <div>
            <div class="text-right">
            <?php if( $this->session->userdata('label')=="admin" || ($this->router->class == "student_management" && !empty($priv[20]) && $this->session->userdata('label')=="staff" ) || ($this->router->class == "registration_management" && !empty($priv[17]) && $this->session->userdata('label')=="staff") || ($this->router->class == "student_admission_management" && !empty($priv[12]) && $this->session->userdata('label')=="staff")  ){ ?>
              <button class="btn btn-md btn-warning uploadstaffdocument" data-toggle="modal" data-target="#myNotesDoc"><i class="fa fa-plus"></i> Add Notes</button>
            <?php } ?>

            </div>
            </div> 
               <div class="clearfix">

               <h4><i class="fa fa-list"></i> Notes list</h4>

               <div class="table-responsive margin-height">
               <?php $i = 1;?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th >Serial</th>
                                        <th >From</th>
                                        <th >Note </th>
                                    </tr>
                                </thead>
                                <tbody>
             <?php if(!empty($noteslist)) {?>
 				   		<?php foreach($noteslist as $note):?>
                <?php if($note["follow_up"] == "no" ) {?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td style="width: 40%;">Note is given by <b><?php echo $this->staff->get_name($note['staff_id']); ?>:</b><br /> <small><?php echo $note["datetime"];?></small> </td>
                                    <td  style="width: 60%;"><div class="col-xs-11"><?php echo $note['text']; ?></div><div class="col-xs-1 text-right no-pad-right">
                                    
                                    <?php if( $this->session->userdata('label')=="admin" || ($this->router->class == "student_management" && !empty($priv[21]) && $this->session->userdata('label')=="staff" ) || ($this->router->class == "registration_management" && !empty($priv[18]) && $this->session->userdata('label')=="staff") || ($this->router->class == "student_admission_management" && !empty($priv[13]) && $this->session->userdata('label')=="staff")   ){ ?>
                                    <button class="btn btn-danger btn-xs delete-note" type="button" id="<?php echo $note["id"]; ?>"><i class="fa fa-times"></i></button>
                                    <?php } ?>

                                    </div><div class="clearfix"></div></td>
                                </tr>
                <?php } elseif($note["follow_up"] == "yes") {?>
                  <tr>
                    <td colspan="3">

                      <div class="panel panel-info">
                        <div class="panel-heading">
                          <i class="fa fa-sitemap"></i> Follow Up By: <b><?php echo ucfirst($this->staff->get_name($note['follow_up_staff_id'])); ?> </b>
                        </div>
                        <div class="panel-body">

                          <div class="col-md-3">
                            <p><b>Start Date :</b> <?php echo date("M d, Y", strtotime($note["follow_up_start_date"]));  ?></p>
                          </div>
                          <div class="col-md-3">
                            <p><b>End Date:</b> <?php echo date("M d, Y", strtotime($note["follow_up_end_date"]));  ?></p>
                          </div>
                          <div class="col-md-6">
                            <p>Assigned By: <b> <?php echo ucfirst($this->staff->get_name($note['staff_id'])); ?></b></p>
                          </div>
                          
                          <div class="col-md-12">
                            <p><b>Reason :</b> <?php echo tinymce_decode($note["text"]); ?></p>
                          </div>
                          
                          
                          
                        </div>
                      </div>

                    </td>
                  </tr>
                <?php } ?>
						<?php endforeach;?>
            <?php } else {?>
              <tr>
                <td colspan="3">No Notes Found!</td>
              </tr>
            <?php } ?>                        
                                </tbody>
                            </table>
                       
               </div>

            </div><!--End of upload file list-->


                 <!-- Modal -->
                <div class="modal fade" id="myNotesDoc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Add Notes</h4>
                      </div>
                      <div class="modal-body">
                      <div class="msg"></div>

                       <div class="form-group">
                       <label for="formstatus"> Notes : </label>
                       <textarea class="form-control" name="notes" cols="" rows="3"></textarea>
                       <input type="hidden" name="staff_id" value="<?php echo $staff_id;?>">
                       </div>

                       <div class="form-group">
                         <div class="checkbox checkbox-primary">

                         <?php if( $this->session->userdata('label')=="admin" || ($this->router->class == "student_management" && !empty($priv[22]) && $this->session->userdata('label')=="staff" ) || ($this->router->class == "registration_management" && !empty($priv[19]) && $this->session->userdata('label')=="staff")  || ($this->router->class == "student_admission_management" && !empty($priv[14]) && $this->session->userdata('label')=="staff")  ){ ?>

                           <input id="follow_up" type="checkbox" class="follow-up-open form-control">
                           <label for="follow_up"> Follow Up?  </label>

                          <?php } ?>
                                                      
                          </div>
                       </div>
                        
                       <div id="follow-up-area">
                            <div class="col-md-6">
                              <div class="form-group">
                             
                                <label for="start_date"> Start Date  </label>                                    
                                 <input type="text" name="follow_up_start_date" class="form-control date" id="start_date">
                                                            
                                
                             </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                                              
                                 <label for="end_date"> End Date  </label>
                                 <input type="text" name="follow_up_end_date" class="form-control date" id="end_date">
                                                            
                                
                             </div>
                            </div>
                           
                           
                          <div class="col-md-12">
                           <div class="form-group">
                                                               
                               <label for="staff_list"> Select Staff  </label>
                               <select name="follow_up_staff_id" class="form-control">
                                  <option value="">Please Select</option>
                                  <?php if(!empty($staff_list)) {?>
                                    <?php foreach($staff_list as $k=>$v) {?>
                                      <option value="<?php echo $v['id'] ?>"><?php echo $v['staff_name'] ?></option>
                                    <?php } ?>
                                  <?php } ?>

                               </select>
                                                          
                             
                           </div>
                           </div>
                      </div>

                      </div>
                      <div class="clearfix"></div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <button type="button" name="notesbuttonstate" class="btn btn-success" id="changebuttonstate" ><i class="fa fa-save"></i> Add Notes</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->     


 