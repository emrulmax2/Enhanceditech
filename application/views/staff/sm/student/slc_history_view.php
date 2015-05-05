<script type="text/javascript">
$(document).ready(function(){


    
    $('.upload_coc_doc_btn').click(function(){
        
            var ref = $(this);
         $('#myUploadDoc').modal('show');
         uploadCocDocData(ref);
        
    });
//upload_coc_doc_btn_with_remove
    $('.upload_coc_doc_btn_with_remove').click(function(){
        
            var ref = $(this);
         $('#myUploadDoc').modal('show');
         uploadCocDocDataWithRemove(ref);
        
    });
        
    $(".remove-coc-upload-btn").click(function(){
        
        var ref = $(this);
        var id = $(this).attr("cocuploadid");
            //alert(id);
            url =getURL()+'/index.php/ajaxall/';

            $.post(url, {action: 'remove_coc_upload', id: id },

            function(data){
               //alert(data);

                    //$(ref).closest(".message").html("<p class='alert alert-success'>Coc upload deleted successfully.</p>");
                    $(ref).closest("div.uploadRow").fadeOut(1500);

            });        
        
    });    
    
});

function uploadCocDocData(ref){

    $('#myUploadDoc .uploadCocDoc').click(function(){
        
        //alert(ref);
        //var ref = $(this).closest('#myUploadDoc');
        //$(this).closest(".file-list-group").html("");
        $.each($('#myUploadDoc').find('input.documentfile'),function(){
            
            var filename=$(this).val();
            var filepath = "uploads/files/"+filename;
            var url = 'http://localhost/admission/'+filepath;
            //$(this).closest('.file-list-group').append("<a target='_blank' href='"+url+"' class='list-group-item list-group-item-success' fn=''>"+filename+"<input type='hidden' name='filelist[]' value='"+filepath+"' datafilename='"+filename+"'></a>");
            $(ref).closest(".modal").find('.file-list-group').append("<a target='_blank' href='"+url+"' class='list-group-item list-group-item-success' fn=''>"+filename+"<input type='hidden' name='filelist[]' value='"+filepath+"' datafilename='"+filename+"'></a>");
                
            
        });
        
        $('#myUploadDoc').modal("hide");
        
    });    
    
}
function uploadCocDocDataWithRemove(ref){

    $('#myUploadDoc .uploadCocDoc').click(function(){
        
        //alert(ref);
        //var ref = $(this).closest('#myUploadDoc');
        //$(this).closest(".file-list-group").html("");
        $.each($('#myUploadDoc').find('input.documentfile'),function(){
            
            var filename=$(this).val();
            var filepath = "uploads/files/"+filename;
            var url = 'http://localhost/admission/'+filepath;
            //$(this).closest('.file-list-group').append("<a target='_blank' href='"+url+"' class='list-group-item list-group-item-success' fn=''>"+filename+"<input type='hidden' name='filelist[]' value='"+filepath+"' datafilename='"+filename+"'></a>");
            $(ref).closest(".modal").find('.file-list-group').append("<div class='uploadRowNew'><div class='col-lg-12 no-pad'><a target='_blank' href='"+url+"' class='list-group-item list-group-item-success' fn=''>"+filename+"<input type='hidden' name='filelist[]' value='"+filepath+"' datafilename='"+filename+"'></a></div></div>");
                
/*<div class="uploadRow"><div class="col-lg-11 no-pad"><a class="list-group-item list-group-item-success" fn="" href="http://localhost/admission/uploads/files/Chrysanthemum (2).jpg" target="_blank">Chrysanthemum (2).jpg</a></div><div class="col-lg-1"><button class="btn btn-danger remove-coc-upload-btn" cocuploadid="1" type="button"></div></div>*/            
        });
        
        $('#myUploadDoc').modal("hide");
        
    });    
    
}    
</script>
                <!-- Page Heading -->
  
  
            <?php echo $message; ?>  

     <div class="col-lg-12">
            
             
               <div class="clearfix"></div>

               <h4><i class="fa fa-file-text"></i> View SLC History</h4>
               
               <div class="divider"></div>
               <div class="margin-height">
               
                <div class="Educationtable table-responsive">
                    
                    <div class="row" style="margin-bottom:10px;">
                      <div class="col-md-5">
                        <h4><i class="fa fa-file-text"></i> Registration history</h4>
                      </div>
                      <div class="col-md-7">
                        <div class="text-right">
                          
                          <?php if(!empty($priv[35]) || $this->session->userdata('label')=="admin"){ ?>
                          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_registration">
                           <i class="fa fa-plus"></i> Add Registration
                          </button>
                          <?php } ?>

                          <?php if(!empty($priv[36]) || $this->session->userdata('label')=="admin"){ ?>

                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#add_attendance">
                           <i class="fa fa-plus"></i> Add Attendance
                          </button>
                          <?php } ?>

                          <?php if(!empty($priv[37]) || $this->session->userdata('label')=="admin"){ ?>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_coc">
                           <i class="fa fa-plus"></i> Add COC
                          </button>
                          <?php } ?>

                        </div>
                      </div>
                    </div>

                    <table class="table table-bordered" style="margin-bottom:40px;">
                      <thead>
                        <tr>
                         <!--<th>#</th>-->
                         <th width="10%">Date of confirmation</th>
                         <th width="13%">Registration confirmed</th>
                         
                         <th width="12%">Academic Year</th>
                         <th width="14%">Registration Year</th>
                         <th width="30%">Note</th>
                         <th width="13%">Submitted by</th>
                         <th class="text-center">Action</th>
                        </tr>
                        
                      </thead>
                        <tbody>
                          <?php foreach($add_registration_info as $k=>$v) { ?>
                          <tr>
                             <td width="16%"><?php echo $v->confirmation_date ?></td>
                             <td width="18%"><?php echo $v->status ?></td>
                             <td><?php echo $v->academic_year ?></td>
                             <td><?php echo $v->registration_year ?></td>
                             <td><?php echo $v->note ?></td>
                              <td><?php echo $this->staff->get_name( $v->submitted_by ) ?></td>
                             <td class="text-center">
                                <?php if(!empty($priv[39]) || $this->session->userdata('label')=="admin"){ ?>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#registration_view_<?php echo $k ?>">
                                 <i class="fa fa-eye"></i> view
                                </button>
                                <?php } ?>

                             </td>
                          </tr>
                          <?php } ?>      
                        </tbody>
                    </table>

                    <h4><i class="fa fa-file-text"></i> Attendance history</h4>
                    <table class="table table-bordered" style="margin-bottom:40px;">
                      <thead>
                        <tr>
                         <!--<th>#</th>-->
                         <th width="20%">Date of confirmation</th>
                         <th width="13%">Course year</th>
                         
                         <th>Term</th>
                         <th>Code</th>
                         <th>Note</th>
                         <th>Submitted by</th>
                         <th class="text-center">Action</th>
                        </tr>
                        
                      </thead>
                        <tbody>
                          <?php foreach($attendance_history as $k=>$v) {?>
                          <tr>
                             <td width="20%"><?php echo $v->confirmation_date ?></td>
                             <td width="13%"><?php echo $v->attendance_year ?></td>
                             <td><?php echo $v->term ?></td>
                             <td><?php echo $v->code ?></td>
                             <td><?php echo $v->note ?></td>
                              <td><?php echo $this->staff->get_name( $v->submitted_by ) ?></td>
                             <td class="text-center">
                             <?php if(!empty($priv[41]) || $this->session->userdata('label')=="admin"){ ?>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#attendance_view_<?php echo $k ?>">
                                  <i class="fa fa-eye"></i> view
                                </button>
                              <?php } ?>
                             </td>
                          </tr>
                          <?php } ?>      
                        </tbody>
                    </table>

                    <h4><i class="fa fa-file-text"></i> COC history</h4>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                         <!--<th>#</th>-->
                         <th width="20%">Date of confirmation</th>
                         <th width="13%">COC type</th>
                         
                         <th>Reason</th>
                         <th>Actioned</th>
                         <th>Submitted by</th>
                         <th class="text-center">Action</th>
                        </tr>
                        
                      </thead>
                        <tbody>

                        <?php foreach($coc_history as $k=>$v) { ?>
                          
                          <tr>
                             <td width="20%"><?php echo $v->confirmation_date ?></td>
                             <td width="13%"><?php echo $v->coc_type ?></td>
                             <td><?php echo $v->reason ?></td>
                             <td><?php echo $v->actioned ?></td>
                             <td><?php echo $this->staff->get_name( $v->submitted_by ); ?></td>
                             <td class="text-center">
                             <?php if(!empty($priv[43]) || $this->session->userdata('label')=="admin"){ ?>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#coc_view_<?php echo $k ?>">
                                  <i class="fa fa-eye"></i> view
                                </button>
                              <?php } ?>
                             </td>
                          </tr>

                          <?php } ?>
                                
                        </tbody>
                    </table>
                      
                    <div class="row" style="margin-bottom:10px;">
                      <div class="col-md-12">
                        <div class="text-right">
                          
                          <?php if(!empty($priv[35]) || $this->session->userdata('label')=="admin"){ ?>
                          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_registration">
                           <i class="fa fa-plus"></i> Add Registration
                          </button>
                          <?php } ?>
                          
                          <?php if(!empty($priv[36]) || $this->session->userdata('label')=="admin"){ ?>
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#add_attendance">
                           <i class="fa fa-plus"></i> Add Attendance
                          </button>
                          <?php } ?>
                          
                          <?php if(!empty($priv[37]) || $this->session->userdata('label')=="admin"){ ?>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_coc">
                           <i class="fa fa-plus"></i> Add COC
                          </button>
                          <?php } ?>
                          
                        </div>
                      </div>
                    </div>
                      

              </div>



                        
               </div>
               <div class="divider"></div>
                  
            

     </div>

<input type="hidden" name="register_id" value="<?php echo $register_id ?>">
<input type="hidden" name="submitted_by" value="<?php echo $this->session->userdata('uid') ?>">
<input type="hidden" name="student_data_id" value="<?php echo $user_data['id'] ?>">

<div class="modal fade" id="add_registration" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Registration <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt=""></h4>
      </div>
      <div class="modal-body" style="overflow: hidden;">
      <div class="msg"></div>
          
          <div class="col-lg-12">
            <div class="panel panel-warning">
          <div class="panel-heading"> <h3 class="panel-title">Add Registration</h3> </div>
          <div class="panel-body">
          
                      <div class="form-group">
                          <label>SSN Number</label>
                          <input class="form-control" type="text" name="ssn_number" value="">
                      </div>
                      <div class="form-group">
                          <label>Date of confirmation</label>
                          <input class="form-control date" type="text" name="date_of_conf" value="">
                      </div>
                      <div class="form-group">
                          <label>Registration status</label>
                          <select name="registration_status" class="form-control">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                            <option value="RCNR">RCNR</option>
                            <option value="N/R">N/R</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Academic Year</label>
                          <select name="ac_year" class="form-control">
                            <option value="12/13">12/13</option>
                            <option value="13/14">13/14</option>
                            <option value="14/15">14/15</option>
                            <option value="15/16">15/16</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Registration Year</label>
                          <select name="reg_year" class="form-control">
                            <option value="Year 1">Year 1</option>
                            <option value="Year 2">Year 2</option>
                            <option value="Year 3">Year 3</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Note</label>
                          <textarea class="form-control" name="reg_note" id="" cols="30" rows="10" style="resize:none;"></textarea>
                      </div>
                      
                     
                      
                                      
          </div>
        </div>
      </div>
      </div>

      <div class="modal-footer">
        
          
            <button type="button" name="add_registration" class="btn btn-success" id="new_level" ><i class="fa fa-check"></i> Save changes</button>
          
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add_attendance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Attendance <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt=""></h4>
      </div>
      <div class="modal-body" style="overflow: hidden;">
      <div class="msg"></div>
          
          <div class="col-lg-12">
            <div class="panel panel-warning">
          <div class="panel-heading"> <h3 class="panel-title">Add Attendance</h3> </div>
          <div class="panel-body">
          
                      <div class="form-group">
                          <label>Date of confirmation</label>
                          <input class="form-control date" type="text" name="attendance_date_of_conf" value="">
                      </div>
                      <div class="form-group">
                          <label>Attendance year</label>
                          <select class="form-control" name="attendance_year">
                            <option value="Year 1">Year 1</option>
                            <option value="Year 2">Year 2</option>
                            <option value="Year 3">Year 3</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Attendance term</label>
                          <select class="form-control" name="attendance_term">
                            <option value="Term 1">Term 1</option>
                            <option value="Term 2">Term 2</option>
                            <option value="Term 3">Term 3</option>
                            <option value="N/R">N/R</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Attendance code</label>
                          <select class="form-control" name="attendance_code">
                            <option value="A - In Attendance">A - In Attendance</option>
                            <option value="C - Course Mismatch">C - Course Mismatch</option>
                            <option value="F - In attendance but fee dispute">F - In attendance but fee dispute</option>
                            <option value="L - In attendance, liability disputed, HEI will resolve">L - In attendance, liability disputed, HEI will resolve</option>
                            <option value="N - In attendance, liability disputed, HEI will not resolve">N - In attendance, liability disputed, HEI will not resolve</option>
                            <option value="S - Suspended">S - Suspended</option>
                            <option value="X - Not in attendance">X - Not in attendance</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Note</label>
                          <textarea class="form-control" name="attendance_note" id="" cols="30" rows="10" style="resize:none;"></textarea>
                      </div>  
                      
                     
                      
                                      
          </div>
        </div>
      </div>
      </div>

      <div class="modal-footer">
          
            <button type="button" name="add_attendance" class="btn btn-success" id="new_level" ><i class="fa fa-check"></i> Save changes</button>
          
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add_coc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add COC <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt=""></h4>
      </div>
      <div class="modal-body" style="overflow: hidden;">
      <div class="msg"></div>
          
          <div class="col-lg-12">
            <div class="panel panel-warning">
          <div class="panel-heading"> <h3 class="panel-title">Add COC</h3> </div>
          <div class="panel-body">
          
                      <div class="form-group">
                          <label>Date of confirmation</label>
                          <input class="form-control date" type="text" name="coc_date_conf" value="">
                      </div>
                      <div class="form-group">
                          <label>Type of COC</label>
                          <select class="form-control" name="coc_type">
                            <option value="Withdrawal">Withdrawal</option>
                            <option value="Suspension">Suspension</option>
                            <option value="Resumption">Resumption</option>
                            <option value="Repetition">Repetition</option>
                            <option value="Transfer">Transfer</option>
                            <option value="Fee">Fee</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Reason for COC</label>
                          <textarea class="form-control" name="coc_reason" id="" cols="30" rows="10"></textarea>
                      </div>
                      <div class="form-group">
                          <label>Actioned</label>
                          <select name="actioned" class="form-control">
                                <option value="">Please Select</option>
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                          </select>
                      </div>                      
                      <!-- <div class="form-group">
                          <label>Actioned</label>
                          <input class="form-control" type="text" name="actioned" value="">
                      </div>  -->
                      
                       <div class="form-group">
                            
                            <h4>Uploaded Documents</h4>
                            <div class="list-group file-list-group">

                            </div>                       
                       </div>
                      
                     
                      
                                      
          </div>
        </div>
      </div>
      </div>

      <div class="modal-footer">
            
            <button type="button" name="upload_coc_doc_btn" class="btn btn-info upload_coc_doc_btn" ><i class="fa fa-upload"></i> Upload Document</button>
            
            
            
            <button type="button" name="add_coc" class="btn btn-success" id="new_level" ><i class="fa fa-check"></i> Save changes</button>
            

            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>



<?php foreach($add_registration_info as $k=>$v) { ?>
  
<div class="modal fade" id="registration_view_<?php echo $k ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Registration <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt=""></h4>
      </div>
      <div class="modal-body" style="overflow: hidden;">
      <div class="msg"></div>
          
          <div class="col-lg-12">
            <div class="panel panel-warning">
          <div class="panel-heading"> <h3 class="panel-title">Add Registration</h3> </div>
          
            <div class="panel-body">
                        <input type="hidden" name="reg_id" value="<?php echo $v->id ?>">
                        <div class="form-group">
                            <label>SSN Number</label>
                            <input class="form-control" type="text" name="ssn_number" value="<?php echo $v->ssn ?>">
                        </div>
                        <div class="form-group">
                            <label>Date of confirmation</label>
                            <input class="form-control date" type="text" name="date_of_conf" value="<?php echo $v->confirmation_date ?>">
                        </div>
                        <div class="form-group">
                            <label>Registration status</label>
                            <select name="registration_status" class="form-control">
                              <option <?php echo ($v->status == "Yes") ? "selected" : "" ?> value="Yes">Yes</option>
                              <option <?php echo ($v->status == "No") ? "selected" : "" ?> value="No">No</option>
                              <option <?php echo ($v->status == "RCNR") ? "selected" : "" ?> value="RCNR">RCNR</option>
                              <option <?php echo ($v->status == "N/R") ? "selected" : "" ?> value="N/R">N/R</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Academic Year</label>
                            <select name="ac_year" class="form-control">
                              <option <?php echo ($v->academic_year == "12/13") ? "selected" : "" ?> value="12/13">12/13</option>
                              <option <?php echo ($v->academic_year == "13/14") ? "selected" : "" ?> value="13/14">13/14</option>
                              <option <?php echo ($v->academic_year == "14/15") ? "selected" : "" ?> value="14/15">14/15</option>
                              <option <?php echo ($v->academic_year == "15/16") ? "selected" : "" ?> value="15/16">15/16</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Registration Year</label>
                            <select name="reg_year" class="form-control">
                              <option <?php echo ($v->registration_year == "Year 1") ? "selected" : "" ?> value="Year 1">Year 1</option>
                              <option <?php echo ($v->registration_year == "Year 2") ? "selected" : "" ?> value="Year 2">Year 2</option>
                              <option <?php echo ($v->registration_year == "Year 3") ? "selected" : "" ?> value="Year 3">Year 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Note</label>
                            <textarea class="form-control" name="reg_note" id="" cols="30" rows="10" style="resize:none;"><?php echo $v->note ?></textarea>
                        </div>
                        
                       
                        
                                        
            </div>
          
        </div>
      </div>
      </div>

      <div class="modal-footer">
            <?php if(!empty($priv[40]) || $this->session->userdata('label')=="admin"){ ?>
            <button type="button" name="registration_update" class="btn btn-success" id="new_level" ><i class="fa fa-check"></i> Save changes</button>
            <?php } ?>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
      </div>
    </div>
      </form>
  </div>
</div>

<?php } ?>


<?php foreach($attendance_history as $k=>$v) {?>
<div class="modal fade" id="attendance_view_<?php echo $k ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form action="">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Attendance <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt=""></h4>
      </div>
      <div class="modal-body" style="overflow: hidden;">
      <div class="msg"></div>
          
          <div class="col-lg-12">
            <div class="panel panel-warning">
          <div class="panel-heading"> <h3 class="panel-title">Add Attendance</h3> </div>
          <div class="panel-body">
                      <input type="hidden" name="attendance_id" value="<?php echo $v->id ?>">
                      <div class="form-group">
                          <label>Date of confirmation</label>
                          <input class="form-control date" type="text" name="attendance_date_of_conf" value="<?php echo $v->confirmation_date ?>">
                      </div>
                      <div class="form-group">
                          <label>Attendance year</label>
                          <select class="form-control" name="attendance_year">
                            <option <?php echo ($v->attendance_year == "Year 1") ? "selected" : "" ?> value="Year 1">Year 1</option>
                            <option <?php echo ($v->attendance_year == "Year 2") ? "selected" : "" ?> value="Year 2">Year 2</option>
                            <option <?php echo ($v->attendance_year == "Year 3") ? "selected" : "" ?> value="Year 3">Year 3</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Attendance term</label>
                          <select class="form-control" name="attendance_term">
                            <option <?php echo ($v->term == "Term 1") ? "selected" : "" ?>  value="Term 1">Term 1</option>
                            <option <?php echo ($v->term == "Term 2") ? "selected" : "" ?>  value="Term 2">Term 2</option>
                            <option <?php echo ($v->term == "Term 3") ? "selected" : "" ?>  value="Term 3">Term 3</option>
                            <option <?php echo ($v->term == "N/R") ? "selected" : "" ?> value="N/R">N/R</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Attendance code</label>
                          <select class="form-control" name="attendance_code">
                            <option <?php echo ($v->code == "A - In Attendance") ? "selected" : "" ?> value="A - In Attendance">A - In Attendance</option>
                            <option <?php echo ($v->code == "C - Course Mismatch") ? "selected" : "" ?> value="C - Course Mismatch">C - Course Mismatch</option>
                            <option <?php echo ($v->code == "F - In attendance but fee dispute") ? "selected" : "" ?> value="F - In attendance but fee dispute">F - In attendance but fee dispute</option>
                            <option <?php echo ($v->code == "L - In attendance, liability disputed, HEI will resolve") ? "selected" : "" ?> value="L - In attendance, liability disputed, HEI will resolve">L - In attendance, liability disputed, HEI will resolve</option>
                            <option <?php echo ($v->code == "N - In attendance, liability disputed, HEI will not resolve") ? "selected" : "" ?> value="N - In attendance, liability disputed, HEI will not resolve">N - In attendance, liability disputed, HEI will not resolve</option>
                            <option <?php echo ($v->code == "S - Suspended") ? "selected" : "" ?> value="S - Suspended">S - Suspended</option>
                            <option <?php echo ($v->code == "X - Not in attendance") ? "selected" : "" ?> value="X - Not in attendance">X - Not in attendance</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Note</label>
                          <textarea class="form-control" name="attendance_note" id="" cols="30" rows="10" style="resize:none;"><?php echo $v->note ?></textarea>
                      </div>  
                      
                     
                      
                                      
          </div>
        </div>
      </div>
      </div>

      <div class="modal-footer">
          <?php if(!empty($priv[42]) || $this->session->userdata('label')=="admin"){ ?>
            <button type="button" name="attendance_update" class="btn btn-success" id="new_level" ><i class="fa fa-check"></i> Save changes</button>
          <?php } ?>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
      </div>
    </div>
    </form>
  </div>
</div>
<?php } ?>



<?php foreach($coc_history as $k=>$v) { ?>

<div class="modal fade" id="coc_view_<?php echo $k ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add COC <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt=""></h4>
      </div>
      <div class="modal-body" style="overflow: hidden;">
      <div class="msg"></div>
          
          <div class="col-lg-12">
            <div class="panel panel-warning">
          <div class="panel-heading"> <h3 class="panel-title">Add COC</h3> </div>
          <div class="panel-body">
                      <input type="hidden" name="coc_id" value="<?php echo $v->id ?>">
                      <div class="form-group">
                          <label>Date of confirmation</label>
                          <input class="form-control date" type="text" name="coc_date_conf" value="<?php echo $v->confirmation_date ?>">
                      </div>
                      <div class="form-group">
                          <label>Type of COC</label>
                          <select class="form-control" name="coc_type">
                            <option <?php echo ($v->coc_type == "Withdrawal") ? "selected" : "" ?> value="Withdrawal">Withdrawal</option>
                            <option <?php echo ($v->coc_type == "Suspension") ? "selected" : "" ?> value="Suspension">Suspension</option>
                            <option <?php echo ($v->coc_type == "Resumption") ? "selected" : "" ?> value="Resumption">Resumption</option>
                            <option <?php echo ($v->coc_type == "Repetition") ? "selected" : "" ?> value="Repetition">Repetition</option>
                            <option <?php echo ($v->coc_type == "Transfer") ? "selected" : "" ?> value="Transfer">Transfer</option>
                            <option <?php echo ($v->coc_type == "Fee") ? "selected" : "" ?> value="Fee">Fee</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Reason for COC</label>
                          <textarea class="form-control" name="coc_reason" id="" cols="30" rows="10" style="resize:none;"><?php echo $v->reason ?></textarea>
                      </div>
                      
                      <div class="form-group">
                          <label>Actioned</label>
                          <select name="actioned" class="form-control">
                                <option <?php echo ($v->actioned == "") ? "selected" : "" ?> value="">Please Select</option>
                              <option <?php echo ($v->actioned == "yes") ? "selected" : "" ?> value="yes">Yes</option>
                              <option <?php echo ($v->actioned == "no") ? "selected" : "" ?> value="no">No</option>
                          </select>
                      </div>                      
                      
                      <!-- <div class="form-group">
                          <label>Actioned</label>
                          <input class="form-control" type="text" name="actioned" value="">
                      </div>  -->
                      
                       <div class="form-group">
                            <div class="message"></div>
                            <h4>Uploaded Documents</h4>
                            <div class="list-group file-list-group">
<?php 
                                foreach($coc_upload as $key=>$value) {
                                
                                    if($value->coc_history_id == $v->id){
                                        
                                        echo "<div class='uploadRow'><div class='col-lg-11 no-pad'><a target='_blank' href='".base_url().$value->filepath."' class='list-group-item list-group-item-success' fn=''>".$value->filename."</a></div><div class='col-lg-1'><button type='button' class='btn btn-danger remove-coc-upload-btn' cocuploadid='".$value->id."'><i class='fa fa-times'></i></button></div></div>";
                                            
                                    }                                            
                                
                                } 
?>
                            </div>                       
                       </div>                     
                      
                                      
          </div>
        </div>
      </div>
      </div>

      <div class="modal-footer">
            <?php if(!empty($priv[45]) || $this->session->userdata('label')=="admin"){ ?>
            <button type="button" name="upload_coc_doc_btn_with_remove" class="btn btn-info upload_coc_doc_btn_with_remove" ><i class="fa fa-upload"></i> Upload Document</button>
            <?php } ?>
            <?php if(!empty($priv[44]) || $this->session->userdata('label')=="admin"){ ?>
            <button type="button" name="coc_update" class="btn btn-success" id="new_level" ><i class="fa fa-check"></i> Save changes</button>
            <?php } ?>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
      </div>
    </div>
    </form>
  </div>
</div>

<?php } ?>



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
                      <div class="alert alert-danger" role="alert"><i class="fa fa-hand-o-right"></i> Please upload <strong>ONE FILE</strong> at a time.</div>
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
                        
<!--                       <div class="form-group">
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
                       </div>-->
                       
                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <button type="button" name="uploadCocDoc" class="btn btn-success uploadCocDoc"><i class="fa fa-upload"></i> Upload</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->  