<style>
  .mce-tinymce iframe {
    height: 400px !important;
  }
</style>
<script type="text/javascript">
$(document).ready(function(){
  $(".show_letter_data textarea").hide();
    $('.modal-dialog').css("width","770px");

    $("select[name=letter_title]").on("change", function() {

      var letter_id = $(this).val();
      //alert(letter_id);
      $.each($(".show_letter_data textarea.tinymce"), function(index, val) {
        var selected_letter_id = $(this).attr('id');

        //if(letter_id != "") {

         if("letter_"+letter_id == selected_letter_id) {
          
          $(this).prev('.mce-tinymce').siblings('.mce-tinymce').hide();
          $(this).prev('.mce-tinymce').fadeIn();


         }

        //}
      });



    });

    function recallRemove(){
      $('.remove-btn').click(function(){
              
          var id = $(this).attr('id'); //alert(id);
          $('#myModal').find('.confirm-btn').attr('onclick','RemoveFromLetterlist(\''+id+'\',\'letter_issuing\')');
          $('#myModal').css({'top':'30%'});
          $('#myModal').modal('hide');
          $('#myModal').modal('toggle');
          
          
      });   
  }
  recallRemove();


});
</script>

                <!-- Page Heading -->
  
  
            <?php echo $message; ?>  

     <div class="col-lg-12">
            <div class="text-right">

            <?php if(!empty($priv[23]) || $this->session->userdata('label')=="admin"){ ?>
            <button class="btn btn-md btn-success generateletter" data-toggle="modal" data-target="#myLetterDocs"><i class="fa fa-plus"></i> Generate New Letter</button>
            <?php } ?>
            
            <?php if(!empty($priv[24]) || $this->session->userdata('label')=="admin"){ ?>
            <button class="btn btn-md btn-warning generatemail" data-toggle="modal" data-target="#myEmailDocs"><i class="fa fa-envelope"></i> Send Email</button>
            <?php } ?>
            
            <?php if(!empty($priv[25]) || $this->session->userdata('label')=="admin"){ ?>
            <button class="btn btn-md btn-primary generatsms" data-toggle="modal" data-target="#mySmsDocs"><i class="fa fa-mobile"></i> Send SMS</button>
            <?php } ?>

            </div>
             
               <div class="clearfix">

               <h4><i class="fa fa-file-text"></i> View Letters</h4>
               <div class="divider"></div>
               <div class="margin-height">
               <?php $i = 1;  ?>
                 <div class="Educationtable table-responsive">
                    <table id="letterissuing" class="table table-bordered">
                      <thead>
                        <tr>
                         <!--<th>#</th>-->
                         <th>Pin</th>
                         <th>Type</th>
                         <th>Subjects</th>
                         <th>Signatory</th>
                         <th>Issued By</th>
                         <th>Issued Date</th>
                         <th class="text-right">Action</th>
                        </tr>
                      </thead>
                        <tbody>               
            <?php $i=1; foreach($letterlists as $letter): ?>      
            <?php $thisLetterDetails = $this->letter_set->get_by_ID($letter["letter_id"]); ?>      
            <?php $thisSignatoryDetails = $this->signatory_set->get_by_ID($letter["signatory_id"]); ?>      
            <?php $thisStaffDetails = $this->staff->get_by_ID($letter["issued_by"]); ?>      
                                  <tr>
                                     <!--<td ><?php echo $letter["id"]; ?></td> -->
                                     <td><?php echo (!empty($letter["pin"])) ? $letter["pin"] : "" ; ?></td>
                                     <td><?php echo $thisLetterDetails["letter_type"]; ?></td>
                                     <td><?php echo $thisLetterDetails["letter_title"]; ?></td>
                                     <td>
                                     <?php if(isset($thisSignatoryDetails["name"]) || isset($thisSignatoryDetails["post"])) {?>
                                     <?php echo $thisSignatoryDetails["name"]."(".$thisSignatoryDetails["post"].")"; ?>
                                     <?php } ?>
                                     </td>
                                     <td><?php echo $thisStaffDetails["staff_name"]; ?></td>
                                     <td><?php echo tohrdate($letter["issued_date"]); ?></td>
                                     <td class="text-center">

                                        <?php if(!empty($letter["pdf_name"])) {?>
                                        <a style="margin-bottom:5px;width:109px;" href="<?php echo base_url() ?>uploads/files/<?php echo $letter["pdf_name"] ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-eye"></i> View</a>
                                        <?php } ?>
                                        
                                        <?php if(!empty($priv[26]) || $this->session->userdata('label')=="admin"){ ?>
                                          <a href='javascript:void(0);' class='btn btn-sm btn-danger remove-btn' id="<?php echo $letter["id"]; ?>"><i class='fa fa-times'></i></a>
                                        <?php } ?>

                                        <!-- <button name="changedate" id="changedate" type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myChangedateDocs" data-id="<?php echo $letter["id"]; ?>" ><i class="fa fa-calendar"></i> Change Date</button> -->
                                     </td>
                                  </tr>           
            
            <?php $i++; endforeach; ?>
                                    
                        </tbody>
                    </table>
                 </div>
                        
               </div>
               <div class="divider"></div>
                   <div class="email-issu">
                   <h4><i class="fa fa-envelope"></i> View Emails</h4>
                   <div class="divider"></div>
                       <div class="margin-height">
                       <?php $i = 1;  ?>
                         <div class="Emailtable table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                 <!--<th>#</th>-->
                                 <th>Subjects</th>
                                 <th>From</th>
                                 <th>Issued By</th>
                                 <th>Issued Date</th>
                                 <th class="text-center">Action</th>
                                </tr>
                              </thead>
                                <tbody>               
                                  <?php foreach($emaillists as $emaildata): ?>                  
                                  <?php $thisStaffDetails = $this->staff->get_by_ID($emaildata["issued_by"]); ?>      
                                      <tr>
                                         <!--<td><?php echo $emaildata["id"]; ?></td>-->
                                         <td><?php echo $emaildata["subject"]; ?></td>
                                         <td><?php echo $settings['smtp_user']; ?></td>
                                         <td><?php echo $thisStaffDetails["staff_name"]; ?></td>
                                         <td><?php echo tohrdate($emaildata["issued_date"]); ?></td>
                                         <td class="text-center">
                                         
                                          <button style="width:100px;" type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#view_email_<?php echo $emaildata["id"] ?>" data-id="9"><i class="fa fa-eye"></i> View</button>

                                         </td>
                                      </tr>           
                    
                                  <?php endforeach; ?>
                                            
                                </tbody>
                            </table>
                         </div>
                                
                       </div>               
                   </div>
               <div class="divider"></div>
                   <div class="email-issu">
                   <h4><i class="fa fa-mobile"></i> View SMS</h4>
                   <div class="divider"></div>
                       <div class="margin-height">
                       <?php $i = 1;  ?>
                         <div class="Emailtable table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                 <!--<th>#</th>-->
                                 <th>Phone</th>
                                 <th>Subjects</th>
                                 <th>Issued By</th>
                                 <th>Issued Date</th>
                                 <th class="text-center">Action</th>
                                </tr>
                              </thead>
                                <tbody>               
                    <?php foreach($smslists as $smsdata): ?>                  
                    <?php $thisStaffDetails = $this->staff->get_by_ID($smsdata["issued_by"]); ?>      
                                          <tr>
                                             <!--<td><?php echo $smsdata["id"]; ?></td>-->
                                             <td><?php echo $smsdata["phone"]; ?></td>
                                             <td><?php echo $smsdata["subject"]; ?></td>
                                             <td><?php echo $thisStaffDetails["staff_name"]; ?></td>
                                             <td><?php echo tohrdatetime($smsdata["issued_date"]); ?></td>
                                             <td class="text-center">
                                               <button style="width:100px;" type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#view_sms_<?php echo $smsdata["id"] ?>" data-id="9"><i class="fa fa-eye"></i> View</button>
                                             </td>
                                          </tr>           
                    
                    <?php endforeach; ?>
                                            
                                </tbody>
                            </table>
                         </div>
                                
                       </div>               
                   </div>
            </div><!--End of upload file list-->

<?php 

$thisLetterlists = $this->letter_set->get_all_by_status();     
$thisSignatorylists = $this->signatory_set->get_all();

?>
                 <!-- Modal date change -->
                <div class="modal fade" id="myChangedateDocs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-calendar"></i> Change Issued letter date</h4>
                      </div>
                      <div class="modal-body">
                      <div class="msg"></div>
                       <div class="form-group">
                       <label for="formstatus"> Issued Date : </label>                       
                       <input class="form-control date" type="text" name="issued_date" value="">
                       <input type="hidden" name="issulid" value="" />
                       </div>

                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <button type="button" name="changedatebutton" class="btn btn-success" id="" ><i class="fa fa-send"></i> Change Issue Date</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->                     
                <!-- Modal date change-->                 
                <!-- Modal -->
                <div class="modal fade" id="myLetterDocs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-send"></i> Issue Letter <img class="loading" src="<?php echo base_url(); ?>/images/loading.gif" alt=""></h4>
                      </div>
                      <div class="modal-body">
                      <div class="msg"></div>
                       <div class="form-group">
                       <label for="formstatus"> Issued Date : </label>                       
                       <input class="form-control date" type="text" name="issued_date2" value="<?php echo date("d-m-Y");?>">
                       </div>
                       <div class="form-group">
                       <label for="formstatus"> Letter : </label>
                       <select name="letter_title" class="form-control"> 
                       <option>Please select</option>
                       <?php foreach($thisLetterlists as $letter): ?>
                        
                        <option value="<?php echo $letter["id"]; ?>"><?php echo ucfirst($letter["letter_type"])."-".ucfirst($letter["letter_title"]); ?></option>

                       <?php endforeach; ?>
                       </select>                       
                       <input type="hidden" name="staff_id" value="<?php echo $staff_id;?>">
                       </div>
                       <div class="form-group show_letter_data">
                       <?php foreach($thisLetterlists as $letter): ?>

                       <textarea class="form-control tinymce" name="letter" id="letter_<?php echo $letter["id"]; ?>" cols="30" rows="10"><?php echo $letter["description"] ?></textarea>
                       <?php endforeach; ?>
                       </div>

                       <div class="form-group">
                       <label for="formstatus"> Signatory : </label>
                       <select name="signatory_title" class="form-control"> 
                       <option>Please select</option>
                       <?php foreach($thisSignatorylists as $signatory): ?>
                       <option value="<?php echo $signatory["id"] ?>"><?php echo ucfirst($signatory["name"]); ?></option>
                       <?php endforeach; ?>
                       </select>                       
                       <input type="hidden" name="ref_id" value="<?php echo $ref_id;?>">
                       
                       </div>
                      </div>
                      <div class="modal-footer">

                        <div class="checkbox checkbox-primary" style="display: inline-block;margin-right: 15px;">
                          <input name="send_email" id="send_email" type="checkbox" class="form-control" value="1"><label for="send_email">Send Email </label>
                        </div>

                        <img class="loading" src="<?php echo base_url(); ?>/images/loading.gif" alt="">
                        <button type="button" name="sendletter" class="btn btn-success" id="" ><i class="fa fa-send"></i> Issu New Letter</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->                     
                <!-- Modal Email-->
                <div class="modal fade" id="myEmailDocs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope"></i> Email To: <?php echo $user_data["student_email"];?></h4>
                      </div>
                      <div class="modal-body">
                      <div class="msg"></div>

                       <div class="form-group">
                       <label for="formstatus"> subject : </label>                       
                       <input class="form-control" type="text" name="subject" value="">
                       </div>
                       <div class="form-group">
                       <label for="formstatus"> Email Description : </label>
                       <textarea class="form-control tinymce" name="description" cols="" rows="15"></textarea>                       
                       <input type="hidden" name="staff_id" value="<?php echo $staff_id;?>">
                       <input type="hidden" name="ref_id" value="<?php echo $ref_id;?>">
                       <input type="hidden" name="student_email" value="<?php echo $user_data["student_email"];?>">
                       </div>
                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <button type="button" name="sendemail" class="btn btn-success" id="sendemail" ><i class="fa fa-send"></i> Send Email</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->     

                <!-- Modal Email-->
                <div class="modal fade" id="mySmsDocs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-mobile"></i> SMS To: <?php echo $user_data["student_mobile_phone"];?></h4>
                      </div>
                      <div class="modal-body">
                      <div class="msg"></div>
                       <div class="form-group">
                       <label for="formstatus"> subject : </label>                       
                       <input class="form-control" type="text" name="smssubject" value="">
                       </div>
                       <div class="form-group">
                       <label for="formstatus"> SMS Description : </label>
                       <textarea class="form-control" name="smsdescription" cols="" rows="15"></textarea>                       
                       <input type="hidden" name="staff_id" value="<?php echo $staff_id;?>">
                       <input type="hidden" name="ref_id"   value="<?php echo $ref_id;?>">
                       <input type="hidden" name="student_mobile_phone" value="<?php echo $user_data["student_mobile_phone"];?>">
                       </div>
                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <button type="button" name="sendsms" class="btn btn-success" id="sendsms" ><i class="fa fa-send"></i> Send SMS</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->     


     </div>

<?php foreach($emaillists as $emaildata): ?>                  
<?php $thisStaffDetails = $this->staff->get_by_ID($emaildata["issued_by"]); ?>

<!-- Modal Email-->
<div class="modal fade" id="view_email_<?php echo $emaildata["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header cofirm-delete-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-mobile"></i> Email Subject: <?php echo $emaildata["subject"];?></h4>
      </div>
      <div class="modal-body">
        <table>
          <tr>
            <td width="150px;"><b>Issued Date</b></td>
            <td width="30px;">:</td>
            <td><?php echo tohrdate($emaildata["issued_date"]); ?></td>
          </tr>
          <tr>
            <td width="150px;"><b>Issued By</b></td>
            <td width="30px;">:</td>
            <td><?php echo $thisStaffDetails["staff_name"]; ?></td>
          </tr>
          <tr>
            <td valign="top" width="150px;"><b>Email Description</b></td>
            <td valign="top" width="30px;">:</td>
            <td><?php echo $emaildata["description"];?> </td>
          </tr>
        </table>
        
       
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- /.modal --> 


<?php endforeach; ?>

<?php foreach($smslists as $smsdata): ?>                  
<?php $thisStaffDetails = $this->staff->get_by_ID($smsdata["issued_by"]); ?>
<!-- Modal Email-->
<div class="modal fade" id="view_sms_<?php echo $smsdata["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header cofirm-delete-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-mobile"></i> SMS Subject: <?php echo $smsdata["subject"];?></h4>
      </div>
      <div class="modal-body">
        <table>
          <tr>
            <td width="150px;"><b>Phone</b></td>
            <td width="30px;">:</td>
            <td><?php echo $smsdata["phone"]; ?></td>
          </tr>
          <tr>
            <td width="150px;"><b>Issued Date</b></td>
            <td width="30px;">:</td>
            <td><?php echo tohrdatetime($smsdata["issued_date"]); ?></td>
          </tr>
          <tr>
            <td width="150px;"><b>Issued By</b></td>
            <td width="30px;">:</td>
            <td><?php echo $thisStaffDetails["staff_name"]; ?></td>
          </tr>
          <tr>
            <td valign="top" width="150px;"><b>SMS Description</b></td>
            <td valign="top" width="30px;">:</td>
            <td><?php echo $smsdata["description"];?> </td>
          </tr>
        </table>
        
       
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endforeach; ?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header cofirm-delete-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div class="msg"></div>
        <h4 class="modal-title" id="myModalLabel">Confirm delete</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete?
      </div>
      <div class="modal-footer">
        <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
        <a href="javascript:void(0);" type="button" class="btn btn-danger confirm-btn">Yes</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->