<script type="text/javascript">
$(function() {

    // Area Chart
    /*Morris.Bar({
        element: 'morris-area-chart',
        data: [
        <?php foreach ($statements as $statement): ?>
        {
            period: '<?php echo $statement["date"];?>',
            income: <?php if(isset($statement["revenue"])) echo $statement["revenue"]; else  echo "null"; ?>,
            expense:<?php if(isset($statement["expense"]))  echo $statement["expense"]; else echo "null"; ?>,

        },
        <?php endforeach; ?>
        {
            period: '<?php echo date('Y-m-d');?>',
            income: null,
            expense: null,

        }
        ],
        xkey: 'period',
        ykeys: ['income', 'expense',],
        labels: ['Revenue', 'Expense'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });*/
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

              
<?php
    if(!empty($priv[0]) || $this->session->userdata('label')=="admin"){
?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <!--Start Panel for 4 Continuous Absence -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-red">

                                    <div class="panel-heading"> <i class="fa fa-exclamation-triangle"></i> Alert For 4 Continuous Absence </div>

                                    <div class="panel-body">
                                        <?php if(!empty($four_days_absent_list)) { ?>
                                        <table class="table absent_list_dashboard">
                                            <tr>
                                                <th width="3%">No.</th>
                                                <th width="30%">Name</th>
                                                <th width="20%">Student ID</th>
                                                <th width="47%">Course</th>
                                            </tr>
                                            <?php
                                            
                                            $i = 1; 
                                            ?>
                                            <?php foreach ($four_days_absent_list as $k => $v) { ?>
                                            <?php
                                                $lower = "";
                                                $higher = "";
                                                $z = 1;
                                                   foreach ($v as $key => $value) {
                                                       if($z==1) {
                                                            $lowest_date = strtotime($value['attendance_date']);
                                                            $heigest_date = strtotime($value['attendance_date']);  
                                                         }
                                                         

                                                         if( strtotime($value['attendance_date']) <= $lowest_date) {
                                                            $lowest_date = strtotime($value['attendance_date']);
                                                         } elseif(strtotime($value['attendance_date']) > $heigest_date) {
                                                            $heigest_date = strtotime($value['attendance_date']);
                                                         }
                                                         $lower = date("d/m/Y",$lowest_date);
                                                         $higher = date("d/m/Y",$heigest_date);
                                                         $z++;
                                                   }
                                                    
                                                   
                                                ?>

                                            <?php if($i<6) {?>
                                            <?php
                                             $student_id = $this->register->get_student_data_ID_no_by_id($k);
                                             if(!empty($student_id) || $student_id != NULL) {
                                             $student_info = $this->student_data->get_all_by_ID($student_id);

                                             $absent_sms_email = $this->attendance_notify->get_sms_email_by_student_data_id_start_date_end_date_absence_type($student_id,$lower,$higher, "4_days",1 );
                                             //var_dump($absent_sms_email);
                                             if(empty($absent_sms_email)) {

                                            ?>
                                                <tr>
                                                    <td width="3%"><?php echo $i ?>.</td>
                                                    <td width="30%"><?php echo $student_info['student_first_name']." ".$student_info['student_sur_name'] ?></td>
                                                    <td width="20%" style="text-transform: uppercase;"><?php echo $this->register->get_registration_no_by_ID($k); ?></td>
                                                    <td width="47%"><?php echo $this->course->get_name( $student_info['student_course'] ); ?></td>
                                                </tr>

                                            <?php } } } ?>
                                            <?php $i++; } ?>
                                        </table>
                                        <?php } else { ?>
                                        <p>No student found!</p>
                                        <?php } ?>
                                    
                                    </div>

                                    <div class="panel-footer">
                                        <div class="text-right">
                                            <a href="<?php echo base_url() ?>index.php/absent_by_four_days">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                             <!--End of Panel for 4 Continuous Absence -->

                            <!--Start Panel for 7 Continuous Absence -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-primary">

                                    <div class="panel-heading"> <i class="fa fa-exclamation-triangle"></i> Alert For 7 Continuous Absence </div>

                                    <div class="panel-body">
                                        <?php if(!empty($seven_days_absent_list)) { ?>
                                        <table class="table absent_list_dashboard">
                                            <tr>
                                                <th width="3%">No.</th>
                                                <th width="30%">Name</th>
                                                <th width="20%">Student ID</th>
                                                <th width="47%">Course</th>
                                            </tr>
                                            <?php
                                            
                                            $i = 1; 
                                            ?>
                                            <?php foreach ($seven_days_absent_list as $k => $v) { ?>

                                            <?php
                                                $lower = "";
                                                $higher = "";
                                                $z = 1;
                                                   foreach ($v as $key => $value) {
                                                       if($z==1) {
                                                            $lowest_date = strtotime($value['attendance_date']);
                                                            $heigest_date = strtotime($value['attendance_date']);  
                                                         }
                                                         

                                                         if( strtotime($value['attendance_date']) <= $lowest_date) {
                                                            $lowest_date = strtotime($value['attendance_date']);
                                                         } elseif(strtotime($value['attendance_date']) > $heigest_date) {
                                                            $heigest_date = strtotime($value['attendance_date']);
                                                         }
                                                         $lower = date("d/m/Y",$lowest_date);
                                                         $higher = date("d/m/Y",$heigest_date);
                                                         $z++;
                                                   }
                                                    
                                                   
                                                ?>


                                            <?php if($i<6) {?>
                                            <?php
                                             $student_id = $this->register->get_student_data_ID_no_by_id($k);
                                             if(!empty($student_id) || $student_id != NULL) {
                                             $student_info = $this->student_data->get_all_by_ID($student_id);
                                            $absent_sms_email = $this->attendance_notify->get_sms_email_by_student_data_id_start_date_end_date_absence_type($student_id,$lower,$higher, "7_days",1 );
                                             if(empty($absent_sms_email)) {
                                            ?>
                                                <tr>
                                                    <td width="3%"><?php echo $i ?>.</td>
                                                    <td width="30%"><?php echo $student_info['student_first_name']." ".$student_info['student_sur_name'] ?></td>
                                                    <td width="20%" style="text-transform: uppercase;"><?php echo $this->register->get_registration_no_by_ID($k); ?></td>
                                                    <td width="47%"><?php echo $this->course->get_name( $student_info['student_course'] ); ?></td>
                                                </tr>
                                            <?php } } } ?>
                                            <?php $i++; } ?>
                                        </table>
                                        <?php } else { ?>
                                        <p>No student found!</p>
                                        <?php } ?>
                                    
                                    </div>

                                    <div class="panel-footer">
                                        <div class="text-right">
                                            <a href="<?php echo base_url() ?>index.php/absent_by_seven_days">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                             <!--End of Panel for 7 Continuous Absence -->      
                        </div>
                    </div>
                    <div class="col-lg-6">
                     <!--StartPanel for 10 Continuous Absence -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad-left no-pad-right">
                        <div class="panel panel-green">

                            <div class="panel-heading"> <i class="fa fa-exclamation-triangle"></i> Alert For 10 Continuous Absence </div>

                            <div class="panel-body">
                                <?php if(!empty($ten_days_absent_list)) { ?>
                                <table class="table absent_list_dashboard">
                                    <tr>
                                        <th width="3%">No.</th>
                                        <th width="30%">Name</th>
                                        <th width="20%">Student ID</th>
                                        <th width="47%">Course</th>
                                    </tr>
                                    <?php
                                    
                                    $i = 1; 
                                    ?>
                                    <?php foreach ($ten_days_absent_list as $k => $v) { ?>
                                    <?php
                                    $lower = "";
                                    $higher = "";
                                    $z = 1;
                                       foreach ($v as $key => $value) {
                                           if($z==1) {
                                                $lowest_date = strtotime($value['attendance_date']);
                                                $heigest_date = strtotime($value['attendance_date']);  
                                             }
                                             

                                             if( strtotime($value['attendance_date']) <= $lowest_date) {
                                                $lowest_date = strtotime($value['attendance_date']);
                                             } elseif(strtotime($value['attendance_date']) > $heigest_date) {
                                                $heigest_date = strtotime($value['attendance_date']);
                                             }
                                             $lower = date("d/m/Y",$lowest_date);
                                             $higher = date("d/m/Y",$heigest_date);
                                             $z++;
                                       }
                                        
                                       
                                    ?>

                                    <?php if($i<6) {?>
                                    <?php
                                     $student_id = $this->register->get_student_data_ID_no_by_id($k);
                                     if(!empty($student_id) || $student_id != NULL) {
                                     $student_info = $this->student_data->get_all_by_ID($student_id);
                                     $absent_sms_email = $this->attendance_notify->get_sms_email_by_student_data_id_start_date_end_date_absence_type($student_id,$lower,$higher, "10_days",1 );
                                             if(empty($absent_sms_email)) {
                                    ?>
                                        <tr>
                                            <td width="3%"><?php echo $i ?>.</td>
                                            <td width="30%"><?php echo $student_info['student_first_name']." ".$student_info['student_sur_name'] ?></td>
                                            <td width="20%" style="text-transform: uppercase;"><?php echo $this->register->get_registration_no_by_ID($k); ?></td>
                                            <td width="47%"><?php echo $this->course->get_name( $student_info['student_course'] ); ?></td>
                                        </tr>
                                    <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="4"></td>
                                        </tr>
                                        <?php
                                    }
                                     } ?>
                                    
                                    <?php $i++; } ?>
                                </table>
                                <?php } else { ?>
                                <p>No student found!</p>
                                <?php } ?>
                            
                            </div>

                            <div class="panel-footer">
                                <div class="text-right">
                                    <a href="<?php echo base_url() ?>index.php/absent_by_ten_days">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                     <!--End of Panel for 10 Continuous Absence -->

                     <!--Start Panel for Less Than 80 % Attendance -->
                    <div class="col-lg-12 ol-md-12 col-sm-12 col-xs-12 no-pad-left no-pad-right">
                        <div class="panel panel-yellow">

                            <div class="panel-heading"> <i class="fa fa-exclamation-triangle"></i> Alert For Less Than 80 % Attendance </div>

                            <div class="panel-body">
                                <?php if(!empty($all_student))  {?>
                                <table class="table absent_list_dashboard">
                                    <tr>
                                        <th width="20%">Name</th>
                                        <th width="25%">Student ID</th>
                                        <th width="35%">Course</th>
                                        <th width="10%">Percentage</th>
                                    </tr>
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
                                                
                                               
                                                // echo "<pre>";
                                                // var_dump($student_id);
                                                // var_dump($lower);
                                                // var_dump($higher);
                                                // var_dump($absence_type);
                                                // echo "</pre>";
                                                $absent_sms_email = $this->attendance_notify->get_sms_email_by_student_data_id_absence_type_without_archive($student_id,$absence_type );

                                                if(empty($absent_sms_email)) {

                                                $present = count($total_present);

                                                if($present != 0) {
                                                    $calculate_persentage = ($present / $total_class ) * 100;
                                                  
                                                    $clc = number_format( $calculate_persentage,2) ."% <br/>";
                                                } elseif($present == 0) {
                                                    $clc =  "0.00% <br/>";
                                                }
                                                    if($calculate_persentage<80) {
                                                    ?>
                                                    
                                                    <tr>
                                                        <td width="20%"><?php echo $student_info['student_first_name']." ".$student_info['student_sur_name'] ?></td>
                                                        <td width="25%" style="text-transform: uppercase;"><?php echo $this->register->get_registration_no_by_ID($value['id']); ?></td>
                                                        <td width="35%"><?php echo $this->course->get_name( $student_info['student_course'] ); ?></td>

                                                        <td width="10%"><?php echo $clc ?></td>
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
                                </table>
                                <?php } ?>
                            </div>

                            <div class="panel-footer">
                                <div class="text-right">
                                    <a href="<?php echo base_url() ?>index.php/less_attendance">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                     <!--End of Panel for Less Than 80 % Attendance -->   
                    </div>
                   

                    
                    
                </div>
                <!-- /.row -->
                
<?php
    }///if(!empty($priv[0]) || $this->session->userdata('label')=="admin"){                    
?>                

             <!--   <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Income And expense for the month of <?php echo date("M-d");?></h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-area-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>   -->
                <!-- /.row -->

               <!-- <div class="row" style="display: none;">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Order Date</th>
                                                <th>Order Time</th>
                                                <th>Amount (USD)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>3326</td>
                                                <td>10/21/2013</td>
                                                <td>3:29 PM</td>
                                                <td>$321.33</td>
                                            </tr>
                                            <tr>
                                                <td>3325</td>
                                                <td>10/21/2013</td>
                                                <td>3:20 PM</td>
                                                <td>$234.34</td>
                                            </tr>
                                            <tr>
                                                <td>3324</td>
                                                <td>10/21/2013</td>
                                                <td>3:03 PM</td>
                                                <td>$724.17</td>
                                            </tr>
                                            <tr>
                                                <td>3323</td>
                                                <td>10/21/2013</td>
                                                <td>3:00 PM</td>
                                                <td>$23.71</td>
                                            </tr>
                                            <tr>
                                                <td>3322</td>
                                                <td>10/21/2013</td>
                                                <td>2:49 PM</td>
                                                <td>$8345.23</td>
                                            </tr>
                                            <tr>
                                                <td>3321</td>
                                                <td>10/21/2013</td>
                                                <td>2:23 PM</td>
                                                <td>$245.12</td>
                                            </tr>
                                            <tr>
                                                <td>3320</td>
                                                <td>10/21/2013</td>
                                                <td>2:15 PM</td>
                                                <td>$5663.54</td>
                                            </tr>
                                            <tr>
                                                <td>3319</td>
                                                <td>10/21/2013</td>
                                                <td>2:13 PM</td>
                                                <td>$943.45</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>     -->
                <!-- /.row -->

