
<script type="text/javascript">

$(document).ready(function(){
    
    
        var certificate_requested = $("input:radio[name=certificate_requested]:checked").val();
        var certificate_received = $("input:radio[name=certificate_received]:checked").val();  
        var certificate_release = $("input:radio[name=certificate_release]:checked").val();
        var date_of_certificate_request = $(".date_of_certificate_request").val();
        var certificate_request_by = $(".certificate_request_by").val();
        var date_of_certificate_received = $(".date_of_certificate_received").val();
        var date_of_certificate_release = $(".date_of_certificate_release").val();
        var certificate_release_by = $(".certificate_release_by").val();    
    
        if(certificate_requested=="yes"){
            $('.certificate_requested_info_area').show();   
        }else{
            $('.certificate_requested_info_area').hide();    
        }
        if(certificate_received=="yes"){
            $('.certificate_received_info_area').show();
        }else{
            $('.certificate_received_info_area').hide();    
        }    
        if(certificate_release=="yes"){
            $('.certificate_release_info_area').show();
        }else{
            $('.certificate_release_info_area').hide();    
        }    

<?php 
    if(!empty($priv[32]) || $this->session->userdata('label')=="admin"){//////--------- chk priv 
?>    
    
    $('select[name=hesa_class_id]').change(function(){
        
        //alert($(this).val());
            var hesa_class_id = $(this).val();
        
            url = getURL()+'/index.php/ajaxall/';
            $.ajax({
               type: "POST",
               data: {hesa_student_information_id: '<?php if(!empty($hesa_student_information_data)) echo $hesa_student_information_data['id']; ?>', student_data_id: '<?php echo $user_data['student_data_id']; ?>', hesa_class_id: hesa_class_id, action: "updateHesaStudentInformation" },
               url: url,
               success: function(msg){
                   //alert(msg);
                   $('.message').html(msg).fadeOut( 3000 ,function(){ window.location = '<?php echo current_url(); ?>'; });

               }
            });        
        
    });
    
    $('input:radio[name=certificate_requested], input:radio[name=certificate_received], input:radio[name=certificate_release], .date_of_certificate_request, .certificate_request_by, .date_of_certificate_received, .date_of_certificate_release, .certificate_release_by').change(function(){
        
        var certificate_requested = $("input:radio[name=certificate_requested]:checked").val();
        var certificate_received = $("input:radio[name=certificate_received]:checked").val();  
        var certificate_release = $("input:radio[name=certificate_release]:checked").val();
        var date_of_certificate_request = $(".date_of_certificate_request").val();
        var certificate_request_by = $(".certificate_request_by").val();
        var date_of_certificate_received = $(".date_of_certificate_received").val();
        var date_of_certificate_release = $(".date_of_certificate_release").val();
        var certificate_release_by = $(".certificate_release_by").val();
        
        if(certificate_requested=="no"){
          date_of_certificate_request = null;
          certificate_request_by = null;  
        }
        if(certificate_received=="no"){
          date_of_certificate_received = null;  
        }
        if(certificate_release=="no"){
          date_of_certificate_release = null;
          certificate_release_by = null;  
        }
        
            url = getURL()+'/index.php/ajaxall/';
            $.ajax({
               type: "POST",
               data: {action: "updateCertificateStudentInformation", id:<?php echo $student_information->id; ?>, certificate_requested:certificate_requested, certificate_received:certificate_received, certificate_release:certificate_release, date_of_certificate_request:date_of_certificate_request, certificate_request_by:certificate_request_by, date_of_certificate_received:date_of_certificate_received, date_of_certificate_release:date_of_certificate_release, certificate_release_by:certificate_release_by   },
               url: url,
               success: function(msg){
                   //alert(msg);
                   $('.message').html(msg).fadeOut( 3000 ,function(){ window.location = '<?php echo current_url(); ?>'; });
                   //$('.message').html(msg);

               }
            });                        
        
        //alert(certificate_requested); 
        
    });
    
    $('.moduleAttempt').click(function(){
        $(".loading").fadeIn(); 
        $('.modal-body').html("");
        var student_id = $(this).data('student');
        var module_id = $(this).data('module');  
              //alert(module_id);
            url = getURL()+'/index.php/ajaxall/';
            $.ajax({
               type: "POST",
               data: {action: "getAttemptresult", id: student_id, coursemodule_id: module_id },
               url: url,
               success: function(msg){
                   //alert(msg);
                   //$('.message').html(msg).fadeOut( 3000 ,function(){ window.location = '<?php echo current_url(); ?>'; });
                   $('.modal-body').html(msg);
                   $(".loading").fadeOut(); 

               }
            });                        
        
        //alert(certificate_requested); 
        
    });    

<?php
    }///if(!empty($priv[33]) || $this->session->userdata('label')=="admin"){//////--------- chk priv        
?>    

<?php
  if(!empty($hesa_student_information_data)){
      foreach($hesa_student_information_data as $k=>$v){
        if($k=="hesa_class_id") echo"$('select[name=$k]').val('$v')";    
      }
  }

?>    
    
    
    
});

    
</script>    
                <!-- Page Heading -->
  
  
            <?php echo $message; ?>  
  
     <div class="col-sm-12 message">
     
     </div>
     <div class="col-lg-12">
            
             
               <div class="clearfix">

               <h4><i class="fa fa-file-text"></i> View Result</h4>
               
               <div class="divider"></div>
               <div class="margin-height">
               <?php $i = 1;  ?>
                 <div class="Educationtable table-responsive">
                    <?php foreach($course_level_list as $k=>$v) { ?>
                    <?php 
                    $module_list = array();
                    $module_list[] = $this->coursemodule->get_by_course_level_id($v['id'], $v['course_id']);
                    if(!empty($module_list[0])) {

                     ?>
                    <h4><?php echo $v['name']; ?></h4>
                    <table id="letterissuing" class="table table-bordered">
                      <thead>
                        <tr>
                         <!--<th>#</th>-->
                         <th width="15%">Module Name</th>
                         <th width="13%">Awarding body</th>
                         <th>Module No.</th>
                         <th>No of Attempt</th>
                         <th>Exam Date</th>
                         <th>Percentage</th>
                         <th>Grade</th>
                         <th>Marks</th>
                         <th>PaperID</th>
                         <th>Feedback</th>
                         <th class="text-center">Status</th>
                        </tr>
                        <?php  ?>
                      </thead>
                        <tbody>
                          <?php 
                          
                          foreach($module_list[0] as $x=>$y) {

                          $class_plan_id = $this->class_plan->get_by_course_relation_id_and_coursemodule_id($course_relation_id_awarding_id['ID'], $y['id']);
                          

                          if(!empty($class_plan_id)) {

                            
                            $register_id = $this->register->get_id_by_student_data_ID($this->input->get('id'));

                            foreach($class_plan_id as $c=>$l) {

                              $result_info = $this->examresult->get_examresult_list_by_register_id_and_class_plan_id($register_id ,$l['id']);
                             
                                if( !empty($result_info) || ($result_info != NULL) ) {

                              
                                  ?>
                                  <tr>
                                     <td width="15%"><?php echo $y['modulename']; ?></td>
                                     <td width="13%"><?php echo $this->awarding_body->get_name( $course_relation_id_awarding_id['awarding_id'] ); ?></td>
                                     <td><?php echo $this->coursemodule->get_module_code_by_id($y['id']); ?></td>
                                     <td><?php echo count($result_info); ?></td>
                                     <td><?php echo $this->class_plan->get_submission_date_by_id( $l['id'] ); ?></td>
                                     <td><?php echo ($result_info[0]['percentage']) ? $result_info[0]['percentage']."%" : "0%"; ?></td>
                                     <td><?php echo $result_info[0]['grade'] ?></td>
                                     <td><?php echo $result_info[0]['marks'] ?></td>
                                     <td><?php echo $result_info[0]['PaperID'] ?></td>
<?php
									if(!empty($result_info[0]['feedback_link'])) echo "<td><a href='".base_url().$result_info[0]['feedback_link']."' class='btn btn-info btn-success'><i class='fa fa-download'></i></a></td>";
									else echo "<td><a href='#' class='btn btn-info btn-warning'><i class='fa fa-exclamation-triangle'></i></a></td>";                                      	
?>                                     
                                     <!--<td><button class="btn btn-info">Feedback</button></td>-->
                                     <td class="text-center">
                                        <?php 

                                        echo ($result_info[0]['grade'] == "F") ? "Fail" : "Pass" ;

                                         ?>
                                     </td>
                                  </tr>
                                  
                                  <?php

                                } 
                              } 
                            } 
                          }
                        } 
                        ?>
                        </tbody>
                      </table>
                      <?php } ?>
                      

                 </div>



                        
               </div>
               <div class="divider"></div>
               <div class="margin-height">
                    <div class="col-sm-2"><label>Overall Result:</label></div>
                    <div class="col-sm-10">
                        <select name="hesa_class_id" class="form-control" required>
                            <option value="">Please Select</option>
<?php
                                foreach($hesa_class_list as $k=>$v){
                                    echo '<option value="'.$v['id'].'">'.$v['name'].'</option>';     
                                }                                       
?>                                   
                        </select>                        
                    </div>
                    <div class="clearfix"></div>
                    
               </div>
               <div class="divider"></div>
               <div class="margin-height">
                    <div class="col-sm-5"><label>Certificate Requested from Awarding body?</label></div>
                    <div class="col-sm-7">
                        <?php $i=0; ?> 
                        <div class="radio radio-primary" style="margin: 0px;">
                            <input name="certificate_requested" id="<?php $i++; echo"radio".$i; ?>" type="radio" value="yes" <?php if(!empty($student_information->certificate_requested) && $student_information->certificate_requested=="yes") echo "checked='checked'"; ?> class="certificate_requested form-control"><label for="<?php echo"radio".$i; ?>" style="margin-right: 5%">Yes</label>                              
                            <input name="certificate_requested" id="<?php $i++; echo"radio".$i; ?>" type="radio" value="no" <?php if(!empty($student_information->certificate_requested) && $student_information->certificate_requested=="no") echo "checked='checked'"; ?> class="certificate_requested form-control"><label for="<?php echo"radio".$i; ?>">No</label>                              
                        </div>                       
                    </div>
                    <div class="clearfix"></div>                              
               </div>
               <div class="margin-height certificate_requested_info_area">
                    <div class="col-sm-2"><label>Date of request</label></div>
                    <div class="col-sm-4">
                            <input name="date_of_certificate_request" class="date_of_certificate_request form-control date" <?php if(!empty($student_information->date_of_certificate_request) && $student_information->date_of_certificate_request!="0000-00-00") echo "value='".date("d-m-Y",strtotime($student_information->date_of_certificate_request))."'"; ?>>   
                    </div>
                    <div class="col-sm-2"><label>Requested by</label></div>
                    <div class="col-sm-4">
                            <input name="certificate_request_by" class="certificate_request_by form-control" <?php if(!empty($student_information->certificate_request_by)) echo "value='".$student_information->certificate_request_by."'"; ?>>  
                    </div>                    
                    <div class="clearfix"></div>                              
               </div>               
               <div class="divider"></div>
               <div class="margin-height">
                    <div class="col-sm-5"><label>Certificate Received</label></div>
                    <div class="col-sm-7"> 
                        <div class="radio radio-primary" style="margin: 0px;">
                            <input name="certificate_received" id="<?php $i++; echo"radio".$i; ?>" type="radio" value="yes" <?php if(!empty($student_information->certificate_received) && $student_information->certificate_received=="yes") echo "checked='checked'"; ?> class="certificate_received form-control"><label for="<?php echo"radio".$i; ?>" style="margin-right: 5%">Yes</label>                              
                            <input name="certificate_received" id="<?php $i++; echo"radio".$i; ?>" type="radio" value="no" <?php if(!empty($student_information->certificate_received) && $student_information->certificate_received=="no") echo "checked='checked'"; ?> class="certificate_received form-control"><label for="<?php echo"radio".$i; ?>">No</label>                              
                        </div>                       
                    </div>
                    <div class="clearfix"></div>                              
               </div>
               <div class="margin-height certificate_received_info_area">
                    <div class="col-sm-2"><label>Date of received</label></div>
                    <div class="col-sm-4">
                            <input name="date_of_certificate_received" class="date_of_certificate_received form-control date" <?php if(!empty($student_information->date_of_certificate_received) && $student_information->date_of_certificate_received!="0000-00-00") echo "value='".date("d-m-Y",strtotime($student_information->date_of_certificate_received))."'"; ?>>   
                    </div>                    
                    <div class="clearfix"></div>                              
               </div>
               <div class="divider"></div> 
               <div class="margin-height">
                    <div class="col-sm-5"><label>Certificate Release to Student? </label></div>
                    <div class="col-sm-7"> 
                        <div class="radio radio-primary" style="margin: 0px;">
                            <input name="certificate_release" id="<?php $i++; echo"radio".$i; ?>" type="radio" value="yes" <?php if(!empty($student_information->certificate_release) && $student_information->certificate_release=="yes") echo "checked='checked'"; ?> class="certificate_release form-control"><label for="<?php echo"radio".$i; ?>" style="margin-right: 5%">Yes</label>                              
                            <input name="certificate_release" id="<?php $i++; echo"radio".$i; ?>" type="radio" value="no" <?php if(!empty($student_information->certificate_release) && $student_information->certificate_release=="no") echo "checked='checked'"; ?> class="certificate_release form-control"><label for="<?php echo"radio".$i; ?>">No</label>                              
                        </div>                       
                    </div>
                    <div class="clearfix"></div>                              
               </div>
               <div class="margin-height certificate_release_info_area">
                    <div class="col-sm-2"><label>Date of release</label></div>
                    <div class="col-sm-4">
                            <input name="date_of_certificate_release" class="date_of_certificate_release form-control date" <?php if(!empty($student_information->date_of_certificate_release) && $student_information->date_of_certificate_release!="0000-00-00") echo "value='".date("d-m-Y",strtotime($student_information->date_of_certificate_release))."'"; ?>>   
                    </div>
                    <div class="col-sm-2"><label>Release by</label></div>
                    <div class="col-sm-4">
                            <input name="certificate_release_by" class="certificate_release_by form-control" <?php if(!empty($student_information->certificate_release_by)) echo "value='".$student_information->certificate_release_by."'"; ?>>  
                    </div>                                         
                    <div class="clearfix"></div>                              
               </div>               
               
               
               
                             
                  
            </div><!--End of upload file list-->

            <div class="prev_result">
              <div class="divider"></div>
              <h4><i class="fa fa-file-text"></i> Previous Result</h4>
              <div class="divider"></div>
              <table class="table table-hover">
                <thead>
                  <th>Module</th>
                  <th>Attempt</th>
                  <th>Paper ID</th>
                  <th>Module No</th>   
                  <th>Exam Date</th>
                  <th>Grade</th>
                  <th>Status</th>
                </thead>
                <tbody>
                  <?php if(!empty($prev_result)) {?>
                 
                 <?php
                 $check_multi = array();
                 foreach($prev_result as $k=>$v) {
                  $val = $v['coursemodule_id'];
                  if(!empty($val)) {
                    if(in_array($val, $check_multi)) {
                      continue;
                    } else {
                      $check_multi[] = $val;
                    }
                  }


                $awarding_body 	= $this->awarding_body->get_name($v['awarding_body_id']);

                  ?>
                  
                  <tr>

                    <?php $cm = $this->coursemodule->get_name_by_id($v['coursemodule_id']); ?>
                                <td><?php echo $cm; ?></td>

                    <?php $attempt = $this->exam_result_prev->get_total_attempt($v['student_data_id'], $v['course_id'], $v['semester_id'], $v['coursemodule_id']); ?>
                    <td><?php if($attempt > 1) { ?><a class="moduleAttempt" style="cursor:pointer" data-toggle="modal" data-target='#myModal_prev_result' data-module="<?php echo $v['coursemodule_id']; ?>" data-student="<?php echo $v['student_data_id']?>"  > <?php echo $attempt ?> </a> <?php } else {?> <?php echo $attempt; } ?></td>
                    <td><?php echo ($v['paperID']>0) ? $v['paperID'] : ""; ?></td>
                    <td><?php echo !empty($v['module_no']) ? $v['module_no'] : ""; ?></td> 
                    <td><?php echo !empty($v['exam_date']) ? $v['exam_date'] : ""; ?></td>
                    <td><?php echo !empty($v['grade']) ? $v['grade'] : ""; ?></td>
                    <td><?php echo !empty($v['status']) ? $v['status'] : ""; ?></td>
                  </tr>
                 
                  <?php } } ?>
                </tbody>
              </table>
            </div>

     </div>


     <!-- Modal -->
        
                <div class="modal fade" id="myModal_prev_result" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Student Attempt <img class="loading" src=" <?php echo base_url(); ?>/images/loading.gif" style="display:none;" /></h4>
                      </div>
                      <div class="modal-body">

                      </div>
                      <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                        <a href="javascript:void(0);" type="button" class="btn btn-danger confirm-btn">Yes</a> -->
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div>
        

                <!-- /.modal --> 