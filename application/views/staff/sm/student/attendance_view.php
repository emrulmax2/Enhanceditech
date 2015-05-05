
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
               <h4><i class="fa fa-file-text"></i> View Current Attendance</h4>
               
               <div class="divider"></div>
               
               <div class="margin-height">
               <?php $i = 1;  ?>
                 <div class="Educationtable table-responsive">
                 <?php 
                 
                 $module_parchetage = array();
                 $t_present = array();
                 $t_absent = array();
                 /*echo "<pre>";
                 //var_dump($module_set);
                 echo "</pre>";*/
                 // Start current attandence       
                 foreach ($module_set as $semesterID => $attandance_list):
                      $calculate_total_attendance = 0;
                     //$calculate_total_attendance = count($attandance_list);
                     $p_full = $l_full = $e_full = $le_full = $A_full =0;
	                 foreach($attandance_list as $module_ID => $attendance_byModule):
	                 $p = $l = $e = $le = $a = 0;
	                  foreach ($attendance_byModule as $attendance): 
	                     
		                 $p_attandence = ($attendance["attendance_type"] == "P") ? ++$p : $p;
		                 $l_attandence = ($attendance["attendance_type"] == "L") ? ++$l : $l;
		                 $e_attandence = ($attendance["attendance_type"] == "E") ? ++$e : $e;
		                 $le_attandence = ($attendance["attendance_type"] == "L.E") ? ++$le : $le;
		                 $a_attandence = ($attendance["attendance_type"] == "A") ? ++$a : $a;
	                  endforeach;
	                  $module_total_attendance = $p_attandence+$l_attandence+$e_attandence+$le_attandence + $a_attandence;
	                  $module_parchetage[$module_ID] =round((($p_attandence+$l_attandence+$e_attandence+$le_attandence)/$module_total_attendance)*100,2);
	                  
	                  $p_full  	+= $p;
	                  $l_full  	+= $l;
	                  $e_full  	+= $e;
	                  $le_full 	+= $le;
	                  $A_full 	+= $a;
	                  $calculate_total_attendance += $module_total_attendance;
	                  $p = $l = $e = $le = $a = 0;
	                 endforeach;
	                 $semister_percentage=round((($p_full+$l_full+$e_full+$le_full)/$calculate_total_attendance)*100,2);
	                 //echo $p_attandence;
	                 
                 ?>
                 
                 <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title" id="panel-title">
                                    <?php echo $this->semister->get_name($semesterID); ?> | <?php echo $semister_percentage; ?>%
                                </h3>
                            </div>
                            
                            <div class="panel-body">                               
                                    <table class="table">
                                        <tbody>
                            <?php foreach($attandance_list as $module_ID => $attendance): ?>


                            

                                            <tr>
                                                <td><button modtableclass="mod-table-<?php echo $module_ID;?>" class="btn btn-success btn-xs mod-btn" type="button"><i class="fa fa-plus"></i></button> <?php echo $this->coursemodule->get_name_by_id($module_ID); ?></td>
                                                <td><?php echo $module_parchetage[$module_ID];?>%</td>

                                                
                                            </tr>
                                            <tr>
                                                <td colspan="2">   <div class="mod-table-<?php echo $module_ID;?> mod-table" style="display: block;">
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
                                                    <?php $T_P = $T_A = $T_E = $T_L = 0; ?>
                                                    <?php foreach($attendance as $attendance_details): ?>
                                                    <?php
                                                       $T_P = ($attendance_details["attendance_type"] == "P") ? ++$T_P : $T_P;
                                                       $T_A = ($attendance_details["attendance_type"] == "A") ? ++$T_A : $T_A;
                                                       $T_E = ($attendance_details["attendance_type"] == "E") ? ++$T_E : $T_E;
                                                       $T_L = ($attendance_details["attendance_type"] == "L.E" || 
                                                       			$attendance_details["attendance_type"] == "L")? ++$T_L : $T_L;
                                                    
                                                    ?>
                                                    <tr>
                                                      <td><?php echo hr_date($attendance_details["attendance_date"]);?></td>
                                                      <td><?php echo ($attendance_details["attendance_type"] == "P") ? "P" : "";?></td>
                                                      <td><?php echo ($attendance_details["attendance_type"] == "A") ? "A" : "";?></td>
                                                      <td><?php echo ($attendance_details["attendance_type"] == "E") ? "E" : "";?></td>
                                                      <td><?php echo ($attendance_details["attendance_type"] == "L" ) ? "L" : "";?>
                                                          <?php echo ($attendance_details["attendance_type"] == "L.E")? "LE" : "";?></td>
                                                      </tr>
                                                    
                                                    <?php endforeach; ?>
                                                     <tr>
                                                		<td>Total</td>
                                                		<td><?php echo $T_P;?></td>
                                                		<td><?php echo $T_A;?></td>
                                                		<td><?php echo $T_E;?></td>
                                                		<td><?php echo $T_L;?></td>
                                           			 </tr>
                                                    </tbody>
                                                </table>
                                                </div>
                                                </td>
                                            </tr>
                            
                            <?php endforeach; ?>
                            			</tbody>
                                    </table> 
                            </div>
                 
                 </div>
                 <?php
                 endforeach;
                 // End current attandence
                  
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
                              $data_array = array(); $hh=0;
                              foreach($archive_list as $x=>$y){
                                  
                                  if($y['asid']==$m['semister_id'] && $y['moduleid']==$m['coursemodule_id']){
                                      
                                       $data_array[$hh]['attendancedate'] = date("d-m-Y",strtotime($y['attendancedate']));
                                       $data_array[$hh]['status'] = $y['status'];
                                      
/*                                         echo'<tr>';            
                                         echo'<td>'.date("d-m-Y",strtotime($y['attendancedate'])).'</td>';
                                         if($y['status']=="P") echo'<td>P</td>'; else echo'<td></td>';
                                         if($y['status']=="A") echo'<td>A</td>'; else echo'<td></td>';
                                         if($y['status']=="E") echo'<td>E</td>'; else echo'<td></td>';
                                         if($y['status']=="L") echo'<td>L</td>'; else echo'<td></td>';
                                         
                                         echo'</tr>';*/            
                                    
                                        $hh++;
                                        
                                        
                                        
                                  }
                              }
                              usort($data_array, 'sortByattendancedate');
                              foreach($data_array as $a=>$b){
                                  
                                         echo'<tr>';            
                                         echo'<td>'.$b['attendancedate'].'</td>';
                                         if($b['status']=="P") echo'<td>P</td>'; else echo'<td></td>';
                                         if($b['status']=="A") echo'<td>A</td>'; else echo'<td></td>';
                                         if($b['status']=="E") echo'<td>E</td>'; else echo'<td></td>';
                                         if($b['status']=="L") echo'<td>L</td>'; else echo'<td></td>';
                                         
                                         echo'</tr>';
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