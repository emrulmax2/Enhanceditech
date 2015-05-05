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
            $(".show-sms-email").html("<a href='?send_sms=1' class='btn btn-primary btn-assign-student'>Send SMS</a><a href='?send_email=1' class='btn btn-success btn-assign-student'>Send Email</a><a href='?send_both=1' class='btn btn-info btn-assign-student'>Send Email AND SMS</a>");
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
            $(".show-sms-email").html("<a href='?send_sms=1' class='btn btn-primary btn-assign-student'>Send SMS</a><a href='?send_email=1' class='btn btn-success btn-assign-student'>Send Email</a><a href='?send_both=1' class='btn btn-info btn-assign-student'>Send Email AND SMS</a>");
            studentListToSendSmsEmail();
        } else {
            $(".show-sms-email").html("");
        }

    });



function studentListToSendSmsEmail(){
    
    $('.btn-assign-student').click(function(e){
        e.preventDefault();
        href = $(this).attr('href');
        var base_url = '<?php echo base_url(); ?>';
        var student_list = [];
        var start_end_date = [];
        var absence_type = "4_days";
        var notify_type = $(this).text();
        //alert(notify_type); return false;
        //alert('yes');
        $.each($('.class-plan-list-body').find('.class-plan-id'),function(){
            
            if(this.checked==true) {
                student_list.push($(this).attr('value'));
                start_end_date.push($(this).parents(".parent_of_class_plan").siblings('.lowest_highest_date').html());
            }
            
        });   
        
            url = base_url+'/index.php/ajaxall/';
            $.ajax({
               type: "POST",
               data: { notify_type:notify_type, student_list: student_list, start_end_date:start_end_date, absence_type:absence_type,  action: "studentListForSendingSMS" },
               url: url,
               success: function(msg){
                 //$('.message').html(msg);
                 //alert(msg);
                 
                 //alert(href);
                 window.location = href;
               }
            });     
        
    }); 
    
}


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
                    <!-- <div class="message"></div> -->
                    <div class="col-lg-12">
                    <?php if(!empty($msg)) {?>
                        <div class="message">
                            <p class="alert alert-success"><?php echo $msg ?></p>
                        </div>
                    <?php } ?>
                    </div>

                    <div class="col-lg-12 text-right">
                        <a href="<?php echo base_url() ?>absent_by_four_days/?action=archive" class="btn btn-warning">View Archive</a>
                        <span class="show-sms-email">
                            
                        </span>
                    </div>
                    <div class="clearfix"></div>
                    <p class="devider"></p>
                    
                    <!--StartPanel for 10 Continuous Absence -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-red">

                            <div class="panel-heading"> <i class="fa fa-exclamation-triangle"></i> Alert For 4 Continuous Absence </div>

                            <div class="panel-body">
                                <?php if(!empty($four_days_absent_list)) { ?>
                                <table class="table absent_list_dashboard">
                                    <tr>
                                        <th width="10%"><div class='checkbox checkbox-primary'><input id='checkbox99999999999' type='checkbox' class='form-control select-all-class-plan-list'><label for='checkbox99999999999'><b>Id</b></label></div></th>
                                        <th width="20%">Date</th>
                                        <th width="15%">Name</th>
                                        <th width="10%">Student ID</th>
                                        <th width="20%">Course</th>
                                        <th width="25%">Module</th>
                                        <th>Email</th>
                                        <th>SMS</th>
                                    </tr>
                                    <tbody class="class-plan-list-body">
                                    <?php
                                    
                                    
                                    ?>

                                    <?php foreach ($four_days_absent_list as $k => $v) { ?>
                                    
                                    <?php
                                    $i = 1;
                                    foreach ($v as $key => $value) {
                                        
                                    
                                     $course_module = $this->class_plan->get_coursemodule_id_by_id($value['class_plan_id']);
                                     if($i==1) {
                                        $lowest_date = strtotime($value['attendance_date']);
                                        $heigest_date = strtotime($value['attendance_date']);  
                                     }
                                     

                                     if( strtotime($value['attendance_date']) <= $lowest_date) {
                                        $lowest_date = strtotime($value['attendance_date']);
                                     } elseif(strtotime($value['attendance_date']) > $heigest_date) {
                                        $heigest_date = strtotime($value['attendance_date']);
                                     }

                                     $student_id = $this->register->get_student_data_ID_no_by_id($k);
                                     if(!empty($student_id)) {
                                     $student_info = $this->student_data->get_all_by_ID($student_id);
                                     if($i==4) {
                                    $module = $this->coursemodule->get_name_by_id( $course_module);
                                    
                                    $absence_type = "4_days";
                                    $lower = date("d/m/Y",$lowest_date);
                                    $higher = date("d/m/Y",$heigest_date);
                                    // echo "<pre>";
                                    // var_dump($student_id);
                                    // var_dump($lower);
                                    // var_dump($higher);
                                    // var_dump($absence_type);
                                    // echo "</pre>";
                                    $absent_sms_email = $this->attendance_notify->get_sms_email_by_student_data_id_start_date_end_date_absence_type_without_archive($student_id,$lower,$higher,$absence_type );
                                    //var_dump($absent_sms_email->email_sent);
                                    if(empty($absent_sms_email)) {
                                    if(!empty($student_info['student_first_name'])) {
                                    ?>
                                        <tr>
                                            <td width="10%" class="parent_of_class_plan"><div class='checkbox checkbox-primary'><input name='class_id[]' id='checkbox_<?php echo $student_id ?>' type='checkbox' class='form-control class-plan-id' value='<?php echo $student_id ?>'><label for='checkbox_<?php echo $student_id ?>'><?php echo $student_id ?></label></div></td>
                                            
                                            <td width="20%" class="lowest_highest_date"><?php if(!empty($student_info['student_first_name'])) echo $lower ." to ". $higher ?></td>
                                            <td width="15%"><?php echo (!empty($student_info['student_first_name'])) ? $student_info['student_first_name']." ".$student_info['student_sur_name'] : ""; ?></td>
                                            <td width="15%" style="text-transform: uppercase;"><?php echo $this->register->get_registration_no_by_ID($k); ?></td>
                                            <td width="25%"><?php echo (!empty($student_info['student_course'])) ? $this->course->get_name( $student_info['student_course'] ) : "" ; ?></td>
                                            <td width="25%"><?php echo $module ; ?></td>
                                            <td><div class='checkbox checkbox-primary'><input disabled <?php echo ( !empty($absent_sms_email->email_sent) && ($absent_sms_email->email_sent == 1)) ? "checked" : "" ; ?> id='email_<?php echo $student_id ?>' type='checkbox' class='form-control' value='<?php echo $student_id ?>'><label for='email_<?php echo $student_id ?>'></label></div></td>
                                            <td><div class='checkbox checkbox-primary'><input disabled <?php echo ( !empty($absent_sms_email->sms_sent) && ($absent_sms_email->sms_sent == 1)) ? "checked" : "" ; ?> id='sms_<?php echo $student_id ?>' type='checkbox' class='form-control' value='<?php echo $student_id ?>'><label for='sms_<?php echo $student_id ?>'></label></div></td>
                                        </tr>
                                    
                                    <?php } } } $i++; } } } ?>


                                    </tbody>


                                </table>
                                <?php } else { ?>
                                <p>No student found!</p>
                                <?php } ?>
                            
                            </div>

                            

                        </div>
                    </div>
                     <!--End of Panel for 10 Continuous Absence -->

                     
                </div>
                

