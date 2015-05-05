<style>
  #morris-bar-chart svg text {
    /*display: none;*/
  }


</style>
<script>
  
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();

      $("#morris-bar-chart text[text-anchor=\"middle\"] tspan:first-child").html("Some text and markup");
    })
 $(function() {

    //Bar Chart
    Morris.Bar({
        element: 'morris-bar-chart',
        data: [
         <?php foreach($course_level_list as $k=>$v) { 

         
          $module_list = array();
          $module_list[] = $this->coursemodule->get_by_course_level_id($v['id'], $v['course_id']);
           
          if(!empty($module_list[0])) {
            
           
              foreach($module_list[0] as $x=>$y) {


              $class_plan_id = $this->class_plan->get_by_course_relation_id_and_coursemodule_id($course_relation_id, $y['id']);

              if(!empty($class_plan_id)) {
             
                
                $register_id = $this->register->get_id_by_student_data_ID($student_info['id']);

                foreach($class_plan_id as $c=>$l) {
                  
                  $time_plan = $this->time_plan->get_viewable_from_to_date_by_id($l['time_planid']);
                  $attendance_info = $this->attendance->get_attendance_list_by_register_id_and_class_plan_id($register_id ,$l['id']);

                    //var_dump($attendance_info);
                  
                    $total_present = array();
                    $total_absent  = array();
                    $calculate_persentage = 0;
                    if( !empty($attendance_info) || ($attendance_info != NULL) ) {

                      $total_class = count($attendance_info);
                      foreach($attendance_info as $m=>$n) {
                        
                        if($n['attendance_type'] == "P") {
                          $total_present[] = "p";
                        }

                        
                        $present = count($total_present);
                        if($present != 0) {
                          $calculate_persentage = ($present / $total_class ) * 100;
                        }
                      }


                    } 
                  } 
                  ?>
        {
            device: "<?php echo $y['modulename']; ?>",
            geekbench: "<?php echo number_format( $calculate_persentage,0) ; ?>"
        },
         <?php 
              }
                                 
                } 
                                 
                            }

                     

                          } 
                          ?>

        
        ],
        xkey: 'device',
        ykeys: ['geekbench'],
        labels: ['Attendance (%)'],
        barRatio: 1,
        xLabelAngle: 45,
        hideHover: 'auto',
        resize: true
    });


});
 
</script>
<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Student Dashboard</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Home
                            </li>
                        </ol>
                    </div>
                </div>
               
                <div class="row">

                  <div class="col-md-12 col-sm-12">
                     <div class="row">
                       <div class="col-md-4 col-sm-6 col-xs-6 student-picture">
                       <?php
                        $student_pic =  $this->register->get_student_photo_no_by_registration($student_id);
                        if($student_pic) { 
                        ?>
                         <img src="<?php echo base_url().$student_pic ?>" alt="" class="img-thumbnail">
                         <?php } else { ?>
                         <img src="<?php echo base_url()."images/user_avatar_default.png" ?>" alt="" class="img-thumbnail">
                         <?php } ?>

                       </div>
                       <div class="col-md-4 col-sm-6 col-xs-6 no-pad-left student-other-info">
                          <p class="student-name"><?php echo $fullname; ?></p>
                          <p><b><i class="fa fa-map-marker"></i> Address </b> <br /><?php echo $student_info['student_address_address_line_1']; ?>, <?php echo $student_info['student_address_address_line_2']; ?>, <?php echo $student_info['student_address_city']; ?> , <?php echo $student_info['student_address_postal_zip_code']; ?>  <br /> <?php echo $student_info['student_address_country']; ?> </p>
                          
                          <b data-toggle="tooltip" data-placement="top" id="student-phone" title="<?php echo $student_info['student_mobile_phone']; ?>"><i class="fa fa-phone"></i> </b>
                          <b data-toggle="tooltip" data-placement="top" id="student-email" title="<?php echo $student_info['student_email']; ?>"><i class="fa fa-envelope-o"></i> </b>
                          
                       </div>
                       
                      <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="student-id">
                          
                          <div class="panel panel-primary">
                            <div class="panel-heading">
                              <h3 class="panel-title">STUDENT ID</h3>
                            </div>
                            <div class="panel-body idtext">
                              <h3><?php echo strtoupper($student_id); ?></h3>
                            </div>
                          </div>

                          <div class="panel panel-info">
                            <div class="panel-heading">
                              <h3 class="panel-title">STATUS</h3>
                            </div>
                            <div class="panel-body">
                              <h3><?php //var_dump($student_info);//
                              echo strtoupper($student_info['student_admission_status_for_staff']); ?></h3>
                            </div>
                          </div>                          


                        </div>
                      </div>

                     </div>   
                  </div>


                </div>

                <div class="row">

                  <div class="col-md-8">
                    <div class="row">
                      <div class="col-md-12 class_list">
                      <?php 
                        if(!empty($list_of_todays_class)) 
                        {
                          foreach ($list_of_todays_class as $x => $y) {
                            if(empty($y))
                            {
                                array_shift($list_of_todays_class);
                            }
                            
                          }
                          
                        }

                           
                      ?>

                        <div class="panel panel-red">
                          <div class="panel-heading" style="overflow:hidden">
                            <h4 class="student-class-title"><i class="fa fa-university"></i> Today's Class List </h4> <h4 class="student-class-title text-right"><span >Total Class : <?php echo (!empty($list_of_todays_class)) ? count($list_of_todays_class) : "0" ?></span></h4>
                          </div>
                        <!-- <p class="divider"></p> -->
                        <div class="panel-body">
                        <table width="100%" class="table">
                            <thead>
                              <tr>
                                
                                <th>Module Name</th>
                                <th class="text-right">Time</th>
                              </tr>
                            </thead>
                            <tbody>
                            
                              <?php if(!empty($list_of_todays_class)) { ?>

                              <?php foreach($list_of_todays_class as $k=>$v) { ?>
                                  <?php if(!empty($v)) {?>
                              <tr>
                                <td><?php echo $this->coursemodule->get_name_by_id( $v['coursemodule_id'] ); ?></td>
                                <td class="text-right"><?php echo $this->time_plan->get_viewable_from_to_date_by_id( $v['time_planid']); ?></td>
                              </tr>
                              <?php } ?>
                              <?php } ?>
                              <?php } else { ?>
                              <tr>
                                <td>You have no class today.</td>
                              </tr>
                              <?php } ?>

                              
                              
                            </tbody>
                          </table>
                          </div>
                          </div>
                      

                     </div>
                     <div class="col-md-12 class_list" style="margin-top:25px;">

                        

                        

                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <h4><i class="fa fa-fw fa-check-square-o"></i> Attendance Info Graph</h4>
                            </div>
                            <div class="panel-body">
                                <div id="morris-bar-chart"></div>
                                <div class="text-right">
                                    <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>

                        <p class="divider"></p>
                    
                     </div>


                      
                    </div>
                  </div>
                  <div class="col-md-4 class_list">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="current-course">
                          <h4><i class="fa fa-fw fa-book"></i> Current Course</h4>
                          <p class="divider"></p>
                          <p class="text-right"> <b> <?php echo $this->course->get_name( $student_info['student_course'] ); ?></b></p>
                        </div>  

                        <div class="module-exame-result">
                          <h4 id="exame-result-list"><i class="fa fa-graduation-cap"></i> Module Exam Result</h4>
                          <p class="divider"></p>
                          <?php foreach($course_level_list as $k=>$v) { ?>
                          <?php 
                          $module_list = array();
                          $module_list[] = $this->coursemodule->get_by_course_level_id($v['id'], $v['course_id']);
                          if(!empty($module_list[0])) {
                            $module_id = array();
                            foreach($module_list[0] as $x=>$y) {

                          $class_plan_id = $this->class_plan->get_by_course_relation_id_and_coursemodule_id($course_relation_id, $y['id']);


                            if(!empty($class_plan_id)) {

                              
                              $register_id = $this->register->get_id_by_student_data_ID($student_info['id']);
                              
                              foreach($class_plan_id as $c=>$l) {

                                

                                $result_info = $this->examresult->get_examresult_list_by_register_id_and_class_plan_id($register_id ,$l['id']);

                             
                                if( !empty($result_info) || ($result_info != NULL) ) {
                                  $module_id[] = $this->class_plan->get_coursemodule_id_by_id($l['id']);
                                }
                              }
                            }
                          }
                          if(!empty($module_id)) {
                                //var_dump($module_id);

                           ?>
                          <!-- <h5> <b>Level : </b> <?php echo $v['name']; ?></h5> -->
                          <table width="100%" id="student_exm_result">
                            <thead>
                              <tr>
                                <th>Module Name</th>
                                <th>Grade</th>
                                <th>Percentage</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php 
                          
                          foreach($module_id as $x=>$y) {

                          $class_plan_id = $this->class_plan->get_by_course_relation_id_and_coursemodule_id($course_relation_id, $y);


                          if(!empty($class_plan_id)) {

                            
                            $register_id = $this->register->get_id_by_student_data_ID($student_info['id']);

                            foreach($class_plan_id as $c=>$l) {


                              $result_info = $this->examresult->get_examresult_list_by_register_id_and_class_plan_id($register_id ,$l['id']);

                             
                                if( !empty($result_info) || ($result_info != NULL) ) {

                                  if($result_info[0]['grade'] == "F") {

                             
                                  ?>

                              <tr style="color:red;">
                                <td><?php echo $this->coursemodule->get_name_by_id($y); ?></td>
                                <td> <p style="border:1px solid red; padding:3px; text-align:center;margin-right:5px;"> <?php echo $result_info[0]['grade'] ?></p></td>
                                <td> <p style="border:1px solid red; padding:3px; text-align:center;margin-right:5px;"><?php echo $result_info[0]['percentage'] ?>%</p> </td>
                              <?php } else { ?>
                              <tr style="color:green;">
                                <td><?php echo $this->coursemodule->get_name_by_id($y); ?></td>
                                <td> <p style="border:1px solid green; padding:3px; text-align:center;margin-right:5px;"> <?php echo $result_info[0]['grade'] ?></p></td>
                                <td> <p style="border:1px solid green; padding:3px; text-align:center;margin-right:5px;"><?php echo $result_info[0]['percentage'] ?>%</p> </td>
                              <?php }?>

                              </tr>
                              <?php

                                } 
                              } 
                            }
                          }
                         
                        ?>
                              
                            </tbody>
                          </table>
                          <?php } } }?>    
                          
                        </div>

                               
                              
                      </div>
                      
                    </div>
                  </div>
                  <div class="col-md-4" style="margin-top:25px;">
                    <!--calender start --> 
                    <h4><i class="fa fa-calendar"></i> Class Calendar</h4>
                    <p class="divider"></p>        
                    <main>
                    <?php 
                             $pre = "";
                    ?>
                        <div class="kalendar"></div>

                    </main>
                
                  <script>
                  $(document).ready(function() {
                      $('.kalendar').kalendar({ 
                          events: [            
                  <?php  if(count($class_list_dates)>0){ ?>
                  <?php foreach( $class_list_dates as $key => $days_lists ):?>
                  <?php   
                            foreach ($days_lists as $days_list):
                                       
                                  $timeplan=$this->time_plan->get_by_ID($days_list["time_planid"]);
                                  //var_dump($timeplan);
                                  $dat = date("Ymd",strtotime($days_list["date"]));
                                  $module_tutor = $this->staff->get_name(($days_list["tutor_id"]));
                                  $room_no = $this->room_plan->get_name_by_id(($days_list["room_id"]));
                                  $pre = $days_list["type"]; 
                  ?>
                                {
                                  title:"<?php echo $this->coursemodule->get_name_by_id($days_list["coursemodule_id"]); ?>",
                                  url: "",
                                  start: {
                                      date: "<?php echo $dat; ?>",
                                      time: "<?php echo hr_time($timeplan['start_time']); ?>"
                                  },
                                  end: {
                                      date: "<?php echo $dat; ?>",
                                      time: "<?php echo hr_time($timeplan['end_time']); ?>"
                                  },
                                  location: "<?php if(!empty($pre)) echo $pre." day<br />"."Section: {$days_list["group_name"]}<br />Tutor: {$module_tutor}<br />Room: {$room_no}";  
                                                  else echo "Section: {$days_list["group_name"]}<br />Tutor: {$module_tutor}<br />Room: {$room_no}";
                                              ?>",
                                  color:"<?php if($pre == "Revision") echo "blue";  else if($pre == "Teaching") echo "yellow"; else if($pre == "Submit") echo "green"; else echo "red"; ?>"
                              },
                   <?php     endforeach; ?>
                   <?php endforeach; ?>
                   <?php }?>

            {
                title:"New Year Eve",
                start: {
                    date: "<?php echo date("Y");?>1231",
                    time: "11.00"
                },
                end: {
                    date: "<?php echo date("Y");?>1231",
                    time: "11.59"
                },
                location: "Earth",
                color: "green"

            }
        ],
        color: '#efefef',
        firstDayOfWeek: "Monday",
        eventcolors: {
            yellow: {
                background: "#FC0",
                text: "#000",
                link: "#000"
            },
            blue: {
                background: "#6180FC",
                text: "#FFF",
                link: "#FFF"
            },
            green: {
                background: "#16a085",
                text: "#FFF",
                link: "#FFF"
            },
            red: {
                background: "#CE070F",
                text: "#FFF",
                link: "#FFF"
            }
        }
    });

});
</script>    
<!--calender end-->
                  </div>





                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->