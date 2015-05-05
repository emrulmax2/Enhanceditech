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
    
     initializePanelColapsible();

  });
  
function initializePanelColapsible(){
    
    $.each($('.panel-colapsible'),function(){

        var head = $(this).html();
        $(this).html('<div class="col-xs-6">'+head+'</div><div class="col-xs-6 text-right"><a href="javascript:void(0);" class="panel-colapsible-toggle"><i class="fa fa-chevron-up"></i></a></div><div class="clearfix"></div>');
                
    });
    
    $('.panel-colapsible-toggle').click(function(){        
        $(this).closest('.panel').find('.panel-body').slideToggle(function(){
            
            if($(this).is(":hidden")==true){
                //alert("yes");
                $(this).closest('.panel').find('.panel-colapsible-toggle').html('<i class="fa fa-chevron-down"></i>');
            }else{
                $(this).closest('.panel').find('.panel-colapsible-toggle').html('<i class="fa fa-chevron-up"></i>');
            }
        });
        
    });    
    
}  
</script>
                <!-- Page Heading -->
  
  
            <?php echo $message; ?>  
            <div class="col-sm-12 message"></div>
            
            <div>

            </div> 
               <div class="clearfix">

               <h4><i class="fa fa-list"></i> Hesa Information</h4>
               <?php 
                if (!empty($hesa_msg)) {
                    echo $hesa_msg;
                }

             ?>

               <div class="table-responsive margin-height">

               <form action="<?php echo current_url(); ?>" method="post">
                
                <input type="hidden" name="hesa_student_information_id" value="<?php echo !empty($hesa_student_information_data['id']) ? $hesa_student_information_data['id'] : "" ;?>">
                    
                <div class="clearfix no-pad text-right">
                <?php if(!empty($priv[33]) || $this->session->userdata('label')=="admin"){ ?>    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-upload"></i> Update</button> <?php } ?>
                </div>
                            <table class="table table-bordered margin-height">
                                <thead>
                                    <tr>
                                        <th colspan="2"><i class="fa fa-binoculars"></i> Instance</th>
                                    </tr>
                                    <tr>
                                        <th>Field Name</th>
                                        
                                        <th>Value</th>
                                    </tr>                                    
                                </thead>
                                <tbody> 
                                <?php
                                    
                                    if( !isset($hesa_instance) ){
                                        
                                        echo "<div style='margin-top:20px;' class='alert alert-danger' role='alert'>
  <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
  
  No Instance Found!
</div>";
                                    } 
                                ?>

                                    <tr>
                                        <td>Student instance identifier (NUMHUS)</td>
                                        <td><input class="form-control" type="number" name="hesa_numhus" id="" value="<?php echo !empty($hesa_student_information_data['hesa_numhus']) ? $hesa_student_information_data['hesa_numhus'] : 0 ;?>">   </td>
                                        
                                    </tr>
                                    <tr>
                                        <td>COURSEID</td>
                                        <td>
                                            <select name="student_course"  class="form-control" disabled>
                                                <option value="0">Please select</option>
                                                    <?php $courselist=$this->course->get_actual_all();?>
                                                    <?php foreach ($courselist as $course): ?>
                                                <option  value="<?php echo $course['id']; ?>"><?php echo "Course: ".$course['course_code']." - ". $course['course_name']; ?></option>
                                                    <?php endforeach;?>
                                            </select>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td>OWNINST</td>
                                        <td>
                                        <input class="form-control" type="number" name="hesa_owninst" id="" value="<?php echo !empty($hesa_student_information_data['hesa_owninst']) ? $hesa_student_information_data['hesa_owninst'] : "" ;?>">
                                            
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td>COMDATE</td>
                                        <td>
                                            <input name="hesa_comdate" type="text" class="form-control date" value="<?php echo !empty($hesa_student_information_data['hesa_comdate']) ? date("d-m-Y",strtotime($hesa_student_information_data['hesa_comdate'])) : "" ;?>">
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td>ENDDATE</td>
                                        <td>
                                            <input name="hesa_enddate" type="text" class="form-control date" value="<?php echo !empty($hesa_student_information_data['hesa_enddate']) ? date("d-m-Y",strtotime($hesa_student_information_data['hesa_enddate'])) : "" ;?>">
                                        </td>
                                        
                                    </tr>
                                   <tr>
                                        <td>Location identifier (LOCATION)</td>
                                        
                                        <td colspan="2"><?php if(!empty($user_data['campus_info_id']) && $user_data['campus_info_id']>0) echo $this->campus_info->get_name_by_id($user_data['campus_info_id']); else echo"Not found."; ?></td>
                                    </tr>
                                   
                                    <tr>
                                        <td>RSNEND</td>
                                        <td>
                                        <select class="form-control" name="hesa_rsnend_id" id="">
                                        <option value="">Please select</option>
                                            <?php if(!empty($hesa_rsnend_list)) {?>
                                                <?php foreach($hesa_rsnend_list as $k=>$v) {?>
                                                        <option <?php if($hesa_student_information_data['hesa_rsnend_id'] == $v['id']) { echo "selected"; } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>                    
                                                <?php } ?>
                
                                            <?php } ?>
                                            
                                        </select>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td>SPLENGTH</td>
                                        <td>
                                        <?php
                                            echo !empty($course_rel_data['duration']) ? $course_rel_data['duration'] : "";
                                             ?>
                                             
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td>UNITLGTH</td>
                                        <td>
                                            <?php 

                                                echo !empty($hesa_course_relation_unitlgth['hesa_unitlgth_id']) ? $this->hesa_unitlgth->get_name_by_id($hesa_course_relation_unitlgth['hesa_unitlgth_id']) : "Not Found." ;
                                             ?>
                                        </td>
                                        
                                    </tr>                                                                                                       
                                    <tr>
                                        <td>HEAPES population (HEAPESPOP)</td>
                                        
                                        <td colspan="2"><?php if(!empty($hesa_student_information_data['hesa_heapespop_id']) && $hesa_student_information_data['hesa_heapespop_id']>0) echo $this->hesa_heapespop->get_name_by_id($hesa_student_information_data['hesa_heapespop_id']); else echo"Not found."; ?></td>
                                    </tr>

                                </tbody>
<!--                                <thead>
                                    <tr>
                                        <th colspan="3"><i class="fa fa-binoculars"></i> Instance period</th>
                                    </tr>
                                    <tr>
                                        <th>Field Name</th>
                                        <th>Table Name</th>
                                        <th>Expected Value</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Disabled Student Allowance (DISALL) </td>
                                        <td></td>
                                        <td><?php if(!empty($user_data['disabilities_allowance'])) echo strtoupper($user_data['disabilities_allowance']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Exchange programmes (EXCHIND) </td>
                                        <td></td>
                                        <td><?php if(!empty($hesa_student_information_data['hesa_exchind_id']) && $hesa_student_information_data['hesa_exchind_id']>0) echo $this->hesa_exchind->get_name_by_id($hesa_student_information_data['hesa_exchind_id']); else echo"Not found."; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Location of study (LOCSDY) </td>
                                        <td></td>
                                        <td><?php if(!empty($hesa_student_information_data['hesa_locsdy_id']) && $hesa_student_information_data['hesa_locsdy_id']>0) echo $this->hesa_locsdy->get_name_by_id($hesa_student_information_data['hesa_locsdy_id']); else echo"Not found."; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Student support eligibility (SSELIG) </td>
                                        <td></td>
                                        <td><?php if(!empty($hesa_student_information_data['hesa_sselig_id']) && $hesa_student_information_data['hesa_sselig_id']>0) echo $this->hesa_sselig->get_name_by_id($hesa_student_information_data['hesa_sselig_id']); else echo"Not found."; ?></td>
                                    </tr>                                                                                                            
                                </tbody> 
                                <thead>
                                    <tr>
                                        <th colspan="3"><i class="fa fa-binoculars"></i> Qualifications awarded</th>
                                    </tr>
                                    <tr>
                                        <th>Field Name</th>
                                        <th>Table Name</th>
                                        <th>Expected Value</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Classification (CLASS)  </td>
                                        <td></td>
                                        <td><?php if(!empty($hesa_student_information_data['hesa_qual_id']) && $hesa_student_information_data['hesa_qual_id']>0) echo $this->hesa_qual->get_name_by_id($hesa_student_information_data['hesa_qual_id']); else echo"Not found."; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Qualification awarded (QUAL) </td>
                                        <td></td>
                                        <td><?php if(!empty($hesa_student_information_data['hesa_class_id']) && $hesa_student_information_data['hesa_class_id']>0) echo $this->hesa_class->get_name_by_id($hesa_student_information_data['hesa_class_id']); else echo"Not found."; ?></td>
                                    </tr>                                                                                                            
                                </tbody>
                                <thead>
                                    <tr>
                                        <th colspan="3"><i class="fa fa-binoculars"></i> Student equality</th>
                                    </tr>
                                    <tr>
                                        <th>Field Name</th>
                                        <th>Table Name</th>
                                        <th>Expected Value</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Disable student allowance  (DISABLE)   </td>
                                        <td></td>
                                        <td><?php if(!empty($hesa_student_information_data['hesa_disall_id']) && $hesa_student_information_data['hesa_disall_id']>0) echo $this->hesa_disall->get_name_by_id($hesa_student_information_data['hesa_disall_id']); else echo"Not found."; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Gender identity (GENDERID)  </td>
                                        <td></td>
                                        <td><?php if(!empty($hesa_student_information_data['hesa_genderid_id']) && $hesa_student_information_data['hesa_genderid_id']>0) echo $this->hesa_genderid->get_name_by_id($hesa_student_information_data['hesa_genderid_id']); else echo"Not found."; ?></td>
                                    </tr> 
                                    <tr>
                                        <td>Religion or belief (RELBLF)   </td>
                                        <td></td>
                                        <td><?php if(!empty($hesa_student_information_data['hesa_relblf_id']) && $hesa_student_information_data['hesa_relblf_id']>0) echo $this->hesa_relblf->get_name_by_id($hesa_student_information_data['hesa_relblf_id']); else echo"Not found."; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Sexual orientation (SEXORT)  </td>
                                        <td></td>
                                        <td><?php if(!empty($hesa_student_information_data['hesa_sexort_id']) && $hesa_student_information_data['hesa_sexort_id']>0) echo $this->hesa_sexort->get_name_by_id($hesa_student_information_data['hesa_sexort_id']); else echo"Not found."; ?></td>
                                    </tr>                                                                                                                                                                                   
                                </tbody>-->
                                
                                
                                <thead>
                                
                                    <tr>
                                        <th colspan="2"><i class="fa fa-binoculars"></i> Instance periods </th>
                                    </tr>                                
                                
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2">
<!-- START INSTANCE PERIODS -->
<?php
if(!empty($hesa_instance) && count($hesa_instance)>0){

for($i=1; $i<=count($hesa_instance); $i++){
    $hesa_course_relation_instance_info = $this->hesa_course_relation_instance->get_by_ID($hesa_instance[$i]['hesa_course_relation_instance_id']);  
?>
 
                                       
                                            <div class="panel panel-danger">
                                              <!-- Default panel contents -->
                                              <div class="panel-heading">
                                                <h3 class="panel-title panel-colapsible">Instance Period: <strong><?php echo date("d-m-Y",strtotime($hesa_course_relation_instance_info['start_date']))."</strong> to <strong>".date("d-m-Y",strtotime($hesa_course_relation_instance_info['end_date'])); ?></strong> <input type="hidden" name="hesa_stuload_student_info_id[]" value="<?php echo !empty($hesa_instance[$i]['id']) ? $hesa_instance[$i]['id'] : ""; ?>"></h3>
                                              </div>
                                              <div class="panel-body">
                                                  <!-- Table -->
                                                  <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td><label>DISALL</label></td>
                                                                <td colspan="2">
                                                                    <select class="form-control" name="hesa_disall_id[]" id="">
                                                                    <option value="">N/A</option>
<?php
foreach($hesa_disall_list as $k=>$v){                                     //$hesa_instance
?>     

                                                                    <option <?php if($hesa_instance[$i]['hesa_disall_id'] == $v['id']) { echo "selected"; } ?> value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>   
<?php    
}                                                                   
?>                                                                
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>EXCHIND</label></td>
                                                                <td colspan="2">
                                                                    <select class="form-control" name="hesa_exchind_id[]" id="">
                                                                    <option value="">Please select</option>
<?php
foreach($hesa_exchind_list as $k=>$v){
?>
                                                                    <option <?php if($hesa_instance[$i]['hesa_exchind_id'] == $v['id']) { echo "selected"; } ?> value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>    
<?php    
}                                                                    
?>                                                                
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>GROSSFEE</label></td>
                                                                <td colspan="2">
                                                                    <input class="form-control" type="number" name="hesa_grossfee[]" id="" value="<?php echo !empty($hesa_instance[$i]['hesa_grossfee']) ? $hesa_instance[$i]['hesa_grossfee'] : 0; ?>">   <?php //echo !empty($course_rel_data['duration']) ? $course_rel_data['duration'] : ""; ?>                                                               
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>LOCSDY</label></td>
                                                                <td colspan="2">
                                                                    <select class="form-control" name="hesa_locsdy_id[]" id="">
                                                                    <option value="">Please select</option>
<?php
foreach($hesa_locsdy_list as $k=>$v){
?>
                                                                    <option <?php if($hesa_instance[$i]['hesa_locsdy_id'] == $v['id']) { echo "selected"; } ?> value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>    
<?php    
}                                                                   
?>                                                                
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>MODE</label></td>
                                                                <td colspan="2">
                                                                    <select class="form-control" name="hesa_mode_id[]" id="">
                                                                    <option value="">Please select</option>
<?php
foreach($hesa_mode_list as $k=>$v){
?>
                                                                    <option <?php if($hesa_instance[$i]['hesa_mode_id'] == $v['id']) { echo "selected"; } ?> value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>    
<?php    
}                                                                   
?>                                                                
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>MSTUFEE</label></td>
                                                                <td colspan="2">
                                                                    <select class="form-control" name="hesa_mstufee_id[]" id="">
                                                                    <option value="">Please select</option>
<?php
foreach($hesa_mstufee_list as $k=>$v){
?>
                                                                    <option <?php if($hesa_instance[$i]['hesa_mstufee_id'] == $v['id']) { echo "selected"; } ?> value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>     
<?php    
}                                                                    
?>                                                                
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>NETFEE</label></td>
                                                                <td colspan="2">
                                                                    <input class="form-control" type="number" name="hesa_netfee[]" id="" value="<?php echo !empty($hesa_instance[$i]['hesa_netfee']) ? $hesa_instance[$i]['hesa_netfee'] : 0; ?>">                                                               
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>NOTACT</label></td>
                                                                <td colspan="2">
                                                                    <select class="form-control" name="hesa_notact_id[]" id="">
                                                                    <option value="">Please select</option>
<?php
foreach($hesa_notact_list as $k=>$v){
?>
                                                                    <option <?php if($hesa_instance[$i]['hesa_notact_id'] == $v['id']) { echo "selected"; } ?> value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>    
<?php    
}                                                                    
?>                                                                
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>PERIODSTART</label></td>
                                                                <td colspan="2">
                                                                    <?php echo date("d-m-Y",strtotime($hesa_course_relation_instance_info['start_date'])); ?>                                                               
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>PERIODEND</label></td>
                                                                <td colspan="2">
                                                                    <?php echo date("d-m-Y",strtotime($hesa_course_relation_instance_info['end_date'])); ?>                                                               
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>PRIPROV</label></td>
                                                                <td colspan="2">
                                                                    <select class="form-control" name="hesa_priprov_id[]" id="">
                                                                    <option value="">Please select</option>
<?php
foreach($hesa_priprov_list as $k=>$v){
?>
                                                                    <option <?php if($hesa_instance[$i]['hesa_priprov_id'] == $v['id']) { echo "selected"; } ?> value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>    
<?php    
}                                                                    
?>                                                                
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>SSELIG</label></td>
                                                                <td colspan="2">
                                                                    <select class="form-control" name="hesa_sselig_id[]" id="">
                                                                    <option value="">Please select</option>
<?php
foreach($hesa_sselig_list as $k=>$v){
?>
                                                                    <option <?php if($hesa_instance[$i]['hesa_sselig_id'] == $v['id']) { echo "selected"; } ?> value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>    
<?php    
}                                                                    
?>                                                                
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>STULOAD</label></td>
                                                                <td colspan="2">
                                                                    <input class="form-control" type="text" name="student_load[]" id="" value="<?php echo !empty($hesa_instance[$i]['student_load']) ? $hesa_instance[$i]['student_load'] : 0; ?>">                                                               
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>YEARPRG</label></td>
                                                                <td colspan="2">
                                                                    <input class="form-control" type="text" name="hesa_yearprg[]" id="" value="<?php echo !empty($hesa_instance[$i]['hesa_yearprg']) ? $hesa_instance[$i]['hesa_yearprg'] : 0; ?>">                                                               
                                                                </td>
                                                            </tr> 
                                                            <tr>
                                                                <td><label>YEARSTU</label></td>
                                                                <td colspan="2">
                                                                    <input class="form-control" type="text" name="hesa_yearstu[]" id="" value="<?php echo !empty($hesa_instance[$i]['hesa_yearstu']) ? $hesa_instance[$i]['hesa_yearstu'] : 0; ?>">                                                               
                                                                </td>
                                                            </tr>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
                                                        </tbody>
                                                  </table>
                                              </div>
                                            </div>


<?php
}// for
}// if(!empty($hesa_instance) && count($hesa_instance)>0){                                                
?>                                            
<!-- END OF INSTANCE PERIODS -->                                                                                    
                                        </td>
                                    </tr>
                                </tbody>
                                                                                                                                                                
                            </table>
                            <div class="clearfix no-pad text-right">
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-upload"></i> Update</button>
                            </div>                            
</form>                       
               </div>

            </div><!--End of upload file list-->

