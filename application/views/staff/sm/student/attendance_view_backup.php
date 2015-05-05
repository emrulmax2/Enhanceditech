
                <!-- Page Heading -->

<script>

$(document).ready(function(){
    
    $(".mod-table").hide();
    
    $(".mod-btn").click(function(){
       
       var tableClass = $(this).attr("modtableclass");
        
        $("."+tableClass).slideToggle("slow");
        
    });
    
    
    
    $('select.attendance_indicator').change(function(){
        
        //alert($(this).val());
            var attendance_indicator = $(this).val();
        
            url = getURL()+'/index.php/ajaxall/';
            $.ajax({
               type: "POST",
               data: {attendance_indicator: attendance_indicator, register_id: '<?php echo $this->register->get_id_by_student_data_ID($this->input->get('id')); ?>', action: "updaterAttendanceIndicatorOfRegister" },
               url: url,
               success: function(msg){
                   //alert(msg);
                   $('.message').html(msg).fadeOut( 3000 ,function(){ window.location = '<?php echo current_url(); ?>'; });

               }
            });        
        
    });    
    
    
});    


</script>

  
  
            <?php echo $message; ?>
            
            <div class="col-sm-12 message"></div>  

     <div class="col-lg-12">
            
             
               <div class="clearfix">
               <div class="text-right form-inline">
                   
                   <div class="form-group"> 
                    <label>View Attandance Indicator</label>
                    <select class="attendance_indicator form-control">
                        <option <?php if(empty($user_data['attendance_indicator']) || $user_data['attendance_indicator']=="") echo "selected='selected'"; ?>value="">Please Select</option>
                        <option <?php if($user_data['attendance_indicator']=="yes") echo "selected='selected'"; ?> value="yes">Yes</option>
                        <option <?php if($user_data['attendance_indicator']=="no") echo "selected='selected'"; ?> value="no">No</option>
                    </select> 
                  </div>
               </div>
               
               <div class="divider"></div>
               <h4><i class="fa fa-file-text"></i> View Attendance</h4>
               
               <div class="divider"></div>
               <div id="attendance-box" class="alert alert-red-box text-center">Over All Attendance is <b>0%</b></div>
               <div class="margin-height">
               <?php $i = 1;  ?>
                 <div class="Educationtable table-responsive">
                 <?php 
                 $calculate_total_attendance = array();
                 $t_present = array();
                 $t_absent = array();
                 
                 ?>
                    <?php foreach($course_level_list as $k=>$v) { ?>
                    <?php 
                    $module_list = array();
                    $module_list[] = $this->coursemodule->get_by_course_level_id($v['id'], $v['course_id']);
                    if(!empty($module_list[0])) {

                      // var_dump($module_list[0]);

                     ?>
                    <h4><?php echo $v['name']; ?></h4>
                    <table id="letterissuing" class="table table-bordered">
                      <thead>
                        <tr>
                         <th width="45%">Module Name</th>
                         <th>Total Present</th>
                         <th>Total Absent</th>
                         <th>Attendnace Percentage</th>
                         <th class="text-center">Action</th>
                        </tr>
                        <?php  ?>
                      </thead>
                        <tbody>
                          <?php 
                          
                          foreach($module_list[0] as $x=>$y) {

                          $class_plan_id = $this->class_plan->get_by_course_relation_id_and_coursemodule_id($course_relation_id, $y['id']);
                          

                          if(!empty($class_plan_id)) {

                            
                            $register_id = $this->register->get_id_by_student_data_ID($this->input->get('id'));
                            
                            
                            foreach($class_plan_id as $c=>$l) {
                              
                              $time_plan = $this->time_plan->get_viewable_from_to_date_by_id($l['time_planid']);
                              $attendance_info = $this->attendance->get_attendance_list_by_register_id_and_class_plan_id($register_id ,$l['id']);


                                
                                $total_present = array();
                                $total_absent  = array();
                                $calculate_persentage = 0;
                                if( !empty($attendance_info) || ($attendance_info != NULL) ) {
                                  $total_class = count($attendance_info);
                                  
                                  foreach($attendance_info as $m=>$n) {

                                   
                                    
                                    if($n['attendance_type'] == "P") {
                                      $total_present[] = "p";
                                    }

                                    if($n['attendance_type'] == "A") {
                                      $total_absent[] = "A";
                                    }
                                    $present = count($total_present);
                                    if($present != 0) {
                                      $calculate_persentage = ($present / $total_class ) * 100;
                                    }
                                  
                                  }


                                }
                             
                            }

                              $calculate_total_attendance[] =  $calculate_persentage;
                              
                              $total_preselt_calc = count($total_present);
                              $total_absent_calc = count($total_absent);

                              $t_present[] = $total_preselt_calc;
                              $t_absent[] = $total_absent_calc;
                              
                              if($total_preselt_calc>0 && $total_absent_calc >0) {
                              ?>
                                <tr>
                                   <td width="45%"><?php echo $y['modulename']; ?></td>
                                   <td><?php echo $total_preselt_calc; ?></td>
                                   <td><?php echo $total_absent_calc; ?></td>
                                   <td><?php echo number_format( $calculate_persentage,2) ."%"; ?></td>
                                   <td class="text-center">
                                      <?php if(!empty($priv[31]) || $this->session->userdata('label')=="admin"){ ?><button data-toggle="modal" data-target="#view_attendance_<?php echo $y['id'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View</button><?php } ?>
                                   </td>
                                </tr>












                                

                  <!-- Modal -->
                  <div class="modal fade" id="view_attendance_<?php echo $y['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">

                    
                    
                      <div class="modal-content">
                        <div class="modal-header cofirm-delete-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-list"></i> Attendance List</h4>
                        </div>
                        <div class="modal-body">
                        <?php if(!empty($attendance_info)) { ?>
                        <div class="panel panel-info" >
                          <div class="panel-heading" style="overflow: hidden;">
                            <h3 class="panel-title attendance_title">Date</h3> <h3 class="panel-title attendance_title">Time</h3> <h3 class="panel-title attendance_title">Attendance Type</h3>
                          </div>
                        <?php foreach($attendance_info as $o=>$p) { ?>

                        
                          <div class="panel-body attendance">
                            <div class="attendance_info">
                              <p><?php echo $p['attendance_date'] ?></p>
                            </div>
                            <div class="attendance_info">
                              <p><?php echo $time_plan; ?></p>
                            </div>
                            <div class="attendance_info">
                              <p>
                              <?php 
                                if( $p['attendance_type'] == "P") {
                                  echo "Present";
                                } elseif($p['attendance_type'] == "A") {
                                  echo "Absent";
                                } elseif($p['attendance_type'] == "L") {
                                  echo "Late";
                                } elseif($p['attendance_type'] == "L.E") {
                                  echo "Left Early";
                                } elseif($p['attendance_type'] == "E") {
                                  echo "Execused";
                                }
                              ?>
                              </p>
                            </div>
                          </div>
                        
                        


                        <?php } ?>
                        </div>
                        <?php } else { ?>
                        <p>Sorry! Nothing found.</p>
                        <?php } ?>
                        </div>
                        
                      </div><!-- /.modal-content -->
                      
                      
                      <?php } ?>
                    </div><!-- /.modal-dialog -->
                  </div><!-- /.modal --> 

                                

                           <?php } } } ?>
                        </tbody>
                      </table>
                      <?php } ?>
                      <?php 
                      // var_dump($total_class_passed);
                      $total = 0;
                      $total_present = 0;
                      $total_absent = 0;
                      
                      //var_dump($t_present);
                      foreach ($t_present as $key => $value) {
                        $total_present = $total_present + $value; 
                      }
                      foreach ($t_absent as $key => $value) {
                        $total_absent = $total_absent + $value; 
                      }

                      $total_class_passed = $total_present + $total_absent; 
                      //var_dump($total_class_passed);
                      if($total_class_passed > 0) {
                        $total = ($total_present / $total_class_passed) *100;
                      } else {
                        $total = 0;
                      }
                      //$total = 60;
                      ?>
                      <script type="text/javascript">
                      jQuery(document).ready(function($) {
                        var total = <?php echo number_format($total,0); ?>;
                        // var total = 59;
                        if( (total > 59) && (total < 80) ) {
                          $('#attendance-box')
                                          .removeClass('alert-red-box')
                                          .addClass('alert-yellow-box')
                                          .find('b').text(total+"%");
                          
                        } else if(total > 79) {
                          $('#attendance-box')
                                          .removeClass('alert-red-box')
                                          .addClass('alert-green-box')
                                          .find('b').text(total+"%");
                        } else {
                          $('#attendance-box')
                                          .find('b').text(total+"%");
                        }
                      });
                      </script>

                 </div>



                        
               </div>
               <div class="divider"></div>
               <h4><i class="fa fa-history"></i> Attendance History</h4>
               
               <div class="divider"></div>

<?php 

//$this->register->get_id_by_student_data_ID($this->input->get('id'));
                
                $archive_list = $this->attendancearchive->get_all_by_student_data_id($this->input->get('id'));
                //var_dump($archive_list);
                
                $semester_list = array();
                $i = 0;
                foreach($archive_list as $k=>$v){
                   $found = 0; 
                   //if(!in_array($v['semesterid'],$semester_attandanced_list)) $semester_attandanced_list[$i]['semesterid'] = $v['semesterid'];
                   if(!empty($semester_list)){
                        foreach($semester_list as $l=>$m){
                            if($m['semister_id']==$v['asid']) $found = 1;    
                        }
                        if($found==0){
                            $semester_list[]['semister_id'] = $v['asid']; 
                            $i++; 
                        }    
                   }else{
                        $semester_list[]['semister_id'] = $v['asid'];
                        $i++;    
                   }
                       
                }

                
                foreach($semester_list as $k=>$v){
                    
                         $e = 0;
                        $p = 0;
                        $a = 0;
                        $lt = 0;
                        $total_class = 0;                    
                    
                    foreach($archive_list as $l=>$m){
                      
                        if($m['asid']==$v['semister_id']){
                            
                            if($m['status']=="P") $p++; 
                            if($m['status']=="E") $e++; 
                            if($m['status']=="A") $a++; 
                            if($m['status']=="L") $lt++;                             
                            
                        }  
                        
                    }
                    
                    $total_class = $e + $p + $a + $lt;
                   
                   $pre_lt = $lt; 
                   for($j=0;$j<$pre_lt;$j++){
                            
                            if($pre_lt>=8){
                               $a++;
                               $pre_lt = $pre_lt - 8;         
                            }    
                            
                    }                    
                    
                    $percent = (($p + $e + $lt)/$total_class)*100;
                    
                    $semester_list[$k]['E'] = $e;    
                    $semester_list[$k]['P'] = $p;    
                    $semester_list[$k]['A'] = $a;    
                    $semester_list[$k]['L'] = $lt;    
                    $semester_list[$k]['total_class'] = $total_class;    
                    $semester_list[$k]['Percent'] = sprintf("%0.2f",$percent);                     
                    $semester_list[$k]['semester_name'] = $this->academicsession->get_name_by_ID($v['semister_id']);                     
                        
                    
                }
                
                //echo"<pre>";
                //var_dump($semester_list);
                //echo"</pre>";
                
                $semester_module_list = array();  $i = 0; $test_counting = 0;
                foreach($semester_list as $k=>$v){
                    
                    foreach($archive_list as $l=>$m){
                        $found=0;
                        if($m['asid']==$v['semister_id']){
                          
                           //if($m['asid']==27) var_dump($m['moduleid']);
                            
                           if(!empty($semester_module_list)){
                                foreach($semester_module_list as $x=>$y){
                                    if($y['coursemodule_id']==$m['moduleid'] && $y['semister_id']==$m['asid']) $found=1; 
                                }
                                if($found==0){
                                    $semester_module_list[$i]['semister_id'] = $v['semister_id'];
                                    $semester_module_list[$i]['coursemodule_id'] = $m['moduleid'];
                                    $i++;    
                                }   
                           }else{
                                $semester_module_list[$i]['semister_id'] = $v['semister_id'];
                                $semester_module_list[$i]['coursemodule_id'] = $m['moduleid'];
                                $i++;                               
                           } 
                            
                        }    
                    }
                    
                   //var_dump($semester_module_list); 
        
                }
/*                 echo"<pre>";
                 var_dump($semester_module_list);
                 echo"</pre>";*/
                //var_dump($test_counting);
                
                foreach($semester_module_list as $k=>$v){
 
                         $e = 0;
                        $p = 0;
                        $a = 0;
                        $lt = 0;
                        $total_class = 0;
                
                    foreach($archive_list as $l=>$m){
                        
                        if($m['moduleid'] == $v['coursemodule_id'] && $m['asid']==$v['semister_id']){
                            
                            //$total_class++;
                            
                            if($m['status']=="P") $p++; 
                            if($m['status']=="E") $e++; 
                            if($m['status']=="A") $a++; 
                            if($m['status']=="L") $lt++; 
                            //if($m['status']=="L") $l++;                             
                               
                        }
                        
                    }
                    
                    $total_class = $e + $p + $a + $lt;

                
                   $pre_lt = $lt; 
                   for($j=0;$j<$pre_lt;$j++){
                            
                            if($pre_lt>=8){
                               $a++;
                               $pre_lt = $pre_lt - 8;         
                            }    
                            
                    }
                    // Percentage = ((present + excuse +late)/total class)*100
                    $percent = (($p + $e + $lt)/$total_class)*100;
                    
                    $semester_module_list[$k]['E'] = $e;    
                    $semester_module_list[$k]['P'] = $p;    
                    $semester_module_list[$k]['A'] = $a;    
                    $semester_module_list[$k]['L'] = $lt;    
                    $semester_module_list[$k]['total_class'] = $total_class;    
                    $semester_module_list[$k]['Percent'] =  sprintf("%0.2f",$percent);     
                    $semester_module_list[$k]['module_name'] = $this->coursemodule->get_name_by_id($v['coursemodule_id']);    
                    
                }

                /*echo"<pre>";
                var_dump($semester_module_list);
                echo"</pre>";*/                
              
                            
                foreach($semester_list as $k=>$v){
                

                    echo'                    
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 id="panel-title" class="panel-title">
                                    '.$v['semester_name'].' | '.$v['Percent'].' %
                                </h3>
                            </div>
                            
                            <div class="panel-body">';                    
                     
                     if(!empty($semester_module_list)){
                    
                            echo'
                                    <table class="table">
                                        <tbody>

                            ';
                     $modno=1;
                     foreach($semester_module_list as $l=>$m){
                     
                        if($m['semister_id']==$v['semister_id']){
                            echo'

                                            <tr>
                                                <td><button type="button" class="btn btn-warning btn-xs mod-btn" modtableclass="mod-table-'.$modno.'"><i class="fa fa-plus"></i></button> '.$m['module_name'].'</td>
                                                <td>'.$m['Percent'].' %</td>

                                                
                                            </tr>
                                            <tr>
                                                <td colspan="2">';
 
                                        echo'   <div class="mod-table-'.$modno.' mod-table">
                                                <table class="table table-bordered ">
                                                    <thead>
                                                    <tr>
                                                      <th>Date</th>
                                                      <th>Present</th>
                                                      <th>Absent</th>
                                                      <th>Excused</th>
                                                      <th>Late</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                        ';

                              foreach($archive_list as $x=>$y){
                                  
                                  if($y['asid']==$m['semister_id'] && $y['moduleid']==$m['coursemodule_id']){
                                      
                                         echo'<tr>';            
                                         echo'<td>'.date("d-m-Y",strtotime($y['attendancedate'])).'</td>';
                                         if($y['status']=="P") echo'<td>P</td>'; else echo'<td></td>';
                                         if($y['status']=="A") echo'<td>A</td>'; else echo'<td></td>';
                                         if($y['status']=="E") echo'<td>E</td>'; else echo'<td></td>';
                                         if($y['status']=="L") echo'<td>L</td>'; else echo'<td></td>';
                                         
                                         echo'</tr>';            
                                    
                                      
                                  }
                              }
                                        echo'
                                           <tr>
                                                <td>Total</td>
                                                <td>'.$m['P'].'</td>
                                                <td>'.$m['A'].'</td>
                                                <td>'.$m['E'].'</td>
                                                <td>'.$m['L'].'</td>
                                           </tr>
                                        ';
                                        
                                        echo'            
                                                        
                                                    </tbody>
                                                </table>
                                                </div>
                                        ';                                                                       
                                                                     
                            echo'
                                                </td>
                                            </tr>

                            ';
                            
                        }    
                        $modno++; 
                     }

                            echo'

                                        </tbody>
                                    </table>
                            ';                     
                     
                     }
                               
                    
 
                   echo'                            
                            </div>
                         </div>   
                         <div class="clearfix"></div>                            
                    '; 
 

 
                                 
    
                    
                }
               
              
              
                                

?>








                  
            </div><!--End of upload file list-->

     </div>