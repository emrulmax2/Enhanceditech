<style>
    .show-sms-email {
        height: 40px;
    }
    .show-sms-email a {
        margin-right: 5px;
    }
</style>
<script type="text/javascript">
$(function() {
    //$(".show-sms-email").
    $('#checkbox99999999999').click(function(){
        
        if(this.checked==true){
            $.each($('.class-plan-list-body').find('.class-plan-id'),function(){
            
                this.checked=true;  
                
            });
            $(".show-sms-email").html("<a href='?send_sms=1' class='btn btn-primary btn-assign-student'>Send SMS</a><a href='?send_email=1' class='btn btn-success btn-assign-student'>Send Email</a>");
            studentListToSendSmsEmail();
            
        }else{
            $.each($('.class-plan-list-body').find('.class-plan-id'),function(){
            
                this.checked=false; 
                
            });
            $(".show-sms-email").html("");        
        }
        
    });

    $('.class-plan-list-body .class-plan-id').on("click", function() {

        var i =0; 
        $.each($('.class-plan-list-body').find('.class-plan-id'),function(){
            
            if(this.checked==true){
             i++;
             
            }
        });
        
        if(i>0){
            $(".show-sms-email").html("<a href='?send_sms=1' class='btn btn-primary btn-assign-student'>Send SMS</a><a href='?send_email=1' class='btn btn-success btn-assign-student'>Send Email</a>");
            studentListToSendSmsEmail();
        } else {
            $(".show-sms-email").html("");
        }

    });



function studentListToSendSmsEmail(){
    
    $('.btn-assign-student').click(function(e){
        e.preventDefault();
        href = $(this).attr('href');
        var student_list = [];
        var absence_type = "less_80";
        var notify_type = $(this).text();
        //alert('yes');
        $.each($('.class-plan-list-body').find('.class-plan-id'),function(){
            
            if(this.checked==true) student_list.push($(this).attr('value'));
        });
        //alert(student_list); return false;   
        
            url = getURL()+'/index.php/ajaxall/';
            $.ajax({
               type: "POST",
               data: {student_list: student_list, absence_type:absence_type, notify_type:notify_type, action: "studentListForSendingSMS" },
               url: url,
               success: function(msg){
                 // $('.message').html(msg);
                 //alert(msg);
                 
                 //alert(href);
                 window.location = href;
               }
            });     
        
    }); 
    
}
studentListToSendSmsEmail();

});
</script>
<?php 
    $todays_entry                 =   $summary_data["todays_communication"]; 
    $todays_communication_entry   =   $summary_data["todays_communication"];  
    $todays_archive_entry         =   $summary_data["todays_archive"]; 
    $todays_studentdata_entry     =   $summary_data["todays_studentdata"];
    $todays_notes_entry           =   $summary_data["todays_notes"]; 
?>


                <!-- Page Heading -->
                                
                <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                <!-- /.row -->

            

                <div class="row">
                    <div class="message"></div>
                    <div class="col-lg-12">
                    <?php if(!empty($msg)) {?>
                        <div class="message">
                            <p class="alert alert-success"><?php echo $msg ?></p>
                        </div>
                    <?php } ?>
                    </div>
                    <div class="col-lg-6">
                        <a href="<?php echo base_url() ?>less_attendance" class="btn btn-warning"><i class="fa fa-arrow-circle-left"></i> Back To List</a>
                    </div>
                    <div class="col-lg-6 text-right">
                        
                        <span class="show-sms-email">
                            
                        </span>
                    </div>
                    <div class="clearfix"></div>
                    <p class="devider"></p>
                    
                    <!--StartPanel for 10 Continuous Absence -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-red">

                            <div class="panel-heading"> <i class="fa fa-exclamation-triangle"></i> Alert For Less Than 80 % Attendance </div>

                             <div class="panel-body">

                                <table class="table absent_list_dashboard">
                                    <tr>
                                        <th width="25%"><div class='checkbox checkbox-primary'><input id='checkbox99999999999' type='checkbox' class='form-control select-all-class-plan-list'><label for='checkbox99999999999'>Student ID</label></div></th>
                                        <th width="20%">Name</th>
                                        
                                        <th width="35%">Course</th>
                                        <th width="10%">Persentage</th>
                                        <th>Email</th>
                                        <th>SMS</th>
                                    </tr>
                                    <tbody class="class-plan-list-body">
                                <?php 

                                $calculate_persentage  = 0;
                                $k = 1;
                                foreach ($all_student as $key => $value) {
                                    //var_dump($value);
                                     
                                    $attendance_info = array();

                                    $attendance_info[] = $this->attendance->get_attendance_list_by_register_id($value['id']);
                                    //var_dump($attendance_info);

                                    if(!empty($attendance_info)) {

                                        
                                        foreach($attendance_info as $m=>$n) {

                                            if($n!=NULL) {

                                                if($k<6) {

                                                
                                                

                                                $total_class = count($n);
                                                $total_present = array();
                                                $total_absent  = array();
                                                $present = "";

                                                if(!empty($n) || $n != NULL) {
                                                    foreach ($n as $c => $d) {
                                                       
                                                        
                                                        if($d['attendance_type'] == "P") {
                                                          $total_present[] = "p";
                                                        }

                                                        if($d['attendance_type'] == "A") {
                                                          $total_absent[] = "A";
                                                        }
                                                        
                                                    }
                                                
                                                }

                                                $student_id = $this->register->get_student_data_ID_no_by_id($value['id']);
                                                $student_info = $this->student_data->get_all_by_ID($student_id);

                                                $absence_type = "less_80";
                                                $archive      = 1;
                                               
                                                // echo "<pre>";
                                                // var_dump($student_id);
                                                // var_dump($lower);
                                                // var_dump($higher);
                                                // var_dump($absence_type);
                                                // echo "</pre>";
                                                $absent_sms_email = $this->attendance_notify->get_sms_email_by_student_data_id_absence_type($student_id,$absence_type, $archive );
                                                if(!empty($absent_sms_email)) {
                                                $present = count($total_present);

                                                if($present != 0) {
                                                    $calculate_persentage = ($present / $total_class ) * 100;
                                                  
                                                    $clc =  number_format( $calculate_persentage,2) ."% <br/>";
                                                } elseif($present == 0) {
                                                    $clc = "0.00% <br/>";
                                                }
                                                    if(($calculate_persentage <80) && (!empty($student_info['student_first_name'])) ) {
                                                    ?>
                                                    
                                                    <tr>
                                                        <td width="25%" style="text-transform: uppercase;">
                                                        <div class='checkbox checkbox-primary'><input name='class_id[]' id='checkbox_<?php echo $student_id ?>' type='checkbox' class='form-control class-plan-id' value='<?php echo $student_id ?>'><label for='checkbox_<?php echo $student_id ?>'><?php echo $this->register->get_registration_no_by_ID($value['id']); ?></label></div>

                                                        
                                                        </td>
                                                        <td width="20%"><?php echo $student_info['student_first_name']." ".$student_info['student_sur_name'] ?></td>
                                                        <td width="35%"><?php echo $this->course->get_name( $student_info['student_course'] ); ?></td>

                                                        <td width="10%"><?php echo $clc; ?></td>
                                                        <td><div class='checkbox checkbox-primary'><input disabled <?php echo ( !empty($absent_sms_email->email_sent) && ($absent_sms_email->email_sent == 1)) ? "checked" : "" ; ?> id='email_<?php echo $student_id ?>' type='checkbox' class='form-control' value='<?php echo $student_id ?>'><label for='email_<?php echo $student_id ?>'></label></div></td>
                                                        <td><div class='checkbox checkbox-primary'><input disabled <?php echo ( !empty($absent_sms_email->sms_sent) && ($absent_sms_email->sms_sent == 1)) ? "checked" : "" ; ?> id='sms_<?php echo $student_id ?>' type='checkbox' class='form-control' value='<?php echo $student_id ?>'><label for='sms_<?php echo $student_id ?>'></label></div></td>
                                                    </tr>

                                                    <?php
                                                    }
                                                }
                                                
                                            }
                                            $k++;

                                            }
                                        }
                                    }
                                  
                                }

                                ?>
                                </tbody>
                                </table>
                            
                            </div>
                    </div>
                     <!--End of Panel for 10 Continuous Absence -->

                     
                </div>
                

