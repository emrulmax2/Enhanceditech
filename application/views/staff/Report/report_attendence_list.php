<!--<pre>   -->
<?php if(isset($attendance_report) && count($attendance_report)>0):?>
<!--$semister_percentage=round((($p_full+$l_full+$e_full+$le_full)/$calculate_total_attendance)*100,2);
-->	                 
<!--</pre>-->
<div class="Educationtable table-responsive">

                 <a target="_blank" href="<?php echo base_url(); ?>index.php/export_attendence_excel/" class="btn btn-warning btn-sm" >Export Excel</a>
                 <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title" id="panel-title">
                                    <?php echo $this->semister->get_name($this->attendence_report->semester_id); ?> 
                                    <span style="float:right; padding-left:10px;"> Result: <?php echo count($attendance_report); ?> </span>
                                    <span style="float:right; text-align: right;"><?php if(isset($this->attendence_report->status_id)) echo "Status: ".$this->status->get_name_by_id($this->attendence_report->status_id);?> | </span>
                                    <div class="clearfix"></div>
                                </h3>
                            </div>
                            
                            <div class="panel-body">                               
                                    <table class="table">
                                    <thead>
                                     <tr>
	                                     <th>Reg No</th>
	                                     <th>Name</th>
	                                     <th>Semester</th>
	                                     <th>Course Name</th>
	                                     <th>SSN</th>
	                                     <th>Status</th>
	                                     <th>P</th>
	                                     <th>A</th>
	                                     <th>E</th>
	                                     <th>L</th>
	                                     <th>L.E</th>
	                                     <th>(%)</th>
	                                     <th>W/O Excused(%)</th>
                                     </tr>
                                    </thead>
                                        <tbody>
                            <?php foreach($attendance_report as $register_no => $courseID): ?>

                            		<?php foreach ($courseID as $CID => $attendence_details): ?>
                                            <tr>
	                                            <td><?php echo $register_no;?></td>
	                                            <td><?php echo $this->student_data->get_fullname_by_ID($this->register->get_student_data_ID_no_by_registration($register_no));?></td>
	                                            
	                                            <td><?php echo $attendence_details["semseter"];?></td>
	                                            <td><?php echo $this->course->get_name($CID); ?></td> 
	                                            <td><?php echo $attendence_details["ssn"];?></td>
	                                            <td><?php echo $attendence_details["status"];?></td>
	                                            <td><?php echo $attendence_details["P"];?></td>
	                                            <td><?php echo $attendence_details["A"];?></td>
	                                            <td><?php echo $attendence_details["E"];?></td>
	                                            <td><?php echo $attendence_details["L"];?></td>
	                                            <td><?php echo $attendence_details["LE"];?></td>
	                                            <?php 
	                                             $C_percentage		 =	0;
	                                             $C_WO_percentage 	 =	0;
	                                             $totalclass		 =  $attendence_details["P"]+$attendence_details["A"]+$attendence_details["L"]+$attendence_details["E"]+$attendence_details["LE"];
	                                             $C_percentage		 =  round((($attendence_details["P"]+$attendence_details["E"]+$attendence_details["L"]+$attendence_details["LE"])/$totalclass)*100,2);
	                                             $C_WO_percentage	 =  round((($attendence_details["P"]+$attendence_details["LE"]+$attendence_details["L"])/$totalclass)*100,2);
	                                            ?>
	                                            <td><?php echo $C_percentage;?>%</td>
	                                            <td><?php echo $C_WO_percentage;?>%</td>
                                            </tr>
                            
                                    <?php endforeach; ?>
                                            
                            <?php endforeach; ?>
                            			</tbody>
                                    </table> 
                            </div>
                 
                 </div>
</div>

<?php else: ?>
 <h4 class="alert alert-warning"><i class="fa fa-warning"></i> No Data Found</h4>
<?php endif; ?>
                
            

    
    

            

  