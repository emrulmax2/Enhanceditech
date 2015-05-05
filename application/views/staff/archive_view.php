
                <!-- Page Heading -->
  
 
            <?php echo $message; ?>  
   
               <div>

               <h4><i class="fa fa-list"></i> Archive list</h4>

               <div class="table-responsive margin-height">
                            <table class="dTable display">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>App. No</th>
                                        <th>Staff</th>
                                        <th>Archive Field</th>
                                        <th>Archive Current Value</th>
                                        <th>Archive Previous Value</th>
                                        <th  class="text-right">Changed Date</th>
                                    </tr>
                                </thead>
                                <tbody>

 				   		        <?php foreach($archivelist as $archive):?>
                                <tr>
                                    <td><?php echo $archive['id'] ?></td>
                                    <td><?php echo $this->student_data->get_reference_no_byID($archive['student_data_id']); ?></td>
                                    <td><?php echo $this->staff->get_name($archive['staff_id']); ?></td>
                                    <td><?php echo $archive['archive_field_name'] ?></td>

                                    <?php if( ($archive['archive_field_name'] == 'student_others_disabilities')) { ?>

                                        <?php 
                                        if(($archive['archive_field_value'] == "no") || ($archive['archive_field_value'] == "")) {
                                            echo "<td>".$archive['archive_field_value']."</td>";
                                        } else { ?>
                                            <?php $dis = unserialize( stripslashes_deep( $archive['archive_field_value'] ) )?>
                                            <td>
                                            <?php //var_dump($dis) ?>
                                            <?php 
                                                foreach($dis as $k=>$v) { 
                                                    $disability_show[] = $this->student_others_disabilities->get_name_by_id($v); 
                                                }
                                                echo implode(', ', $disability_show);
                                                unset($disability_show);
                                            ?>
                                            </td>
                                        <?php    
                                        }
                                        ?>

                                        <?php 
                                        if(($archive['archive_field_previous_value'] == "no") || ($archive['archive_field_previous_value'] == "")) {
                                            echo "<td>".$archive['archive_field_previous_value']."</td>";
                                        } else { ?>
                                            <?php $dis = unserialize( stripslashes_deep( $archive['archive_field_previous_value'] ) )?>
                                            <td>
                                            <?php 
                                                foreach($dis as $k=>$v) { 
                                                    $disability_old[] = $this->student_others_disabilities->get_name_by_id($v); 
                                                }
                                                echo implode(', ', $disability_old);
                                                unset($disability_old);
                                            ?>
                                            </td>
                                        <?php    
                                        }
                                        ?>
                                        

                                    <?php } elseif( $archive['archive_field_name'] == 'student_status' ) { ?>

                                        <td><?php echo $this->status->get_name_by_id( $archive['archive_field_value'] ) ?></td>
                                        <td><?php echo $this->status->get_name_by_id( $archive['archive_field_previous_value'] ) ?></td>

                                    <?php } elseif( $archive['archive_field_name'] == 'student_others_ethnicity' ) { ?>

                                        <td><?php echo $this->student_others_ethnicity->get_name_by_id( $archive['archive_field_value'] ) ?></td>
                                        <td><?php echo $this->student_others_ethnicity->get_name_by_id( $archive['archive_field_previous_value'] ) ?></td>

                                    <?php } elseif( $archive['archive_field_name'] == 'student_country_of_birth' ) { ?>

                                        <td><?php echo $this->country->get_name_by_id( $archive['archive_field_value'] ) ?></td>
                                        <td><?php echo $this->country->get_name_by_id( $archive['archive_field_previous_value'] ) ?></td>

                                    <?php } elseif( $archive['archive_field_name'] == 'student_nationality' ) { ?>

                                        <td><?php echo $this->country->get_name_by_id( $archive['archive_field_value'] ) ?></td>
                                        <td><?php echo $this->country->get_name_by_id( $archive['archive_field_previous_value'] ) ?></td>

                                    <?php } elseif( $archive['archive_field_name'] == 'student_course' ) { ?>

                                        <td><?php echo $this->course->get_name( $archive['archive_field_value'] ) ?></td>
                                        <td><?php echo $this->course->get_name( $archive['archive_field_previous_value'] ) ?></td>

                                    <?php }else { ?>

                                        <td><?php echo $archive['archive_field_value'] ?></td>
                                        <td><?php echo $archive['archive_field_previous_value'] ?></td>

                                    <?php } ?>

                                    <!-- <td><?php echo $archive['archive_field_previous_value'] ?></td> -->
                                    <td><?php echo $archive['archive_change_datetime'] ?></td>
                                </tr>

						        <?php endforeach;?>
                                    
                                </tbody>
                            </table>
                        
               </div>

            </div><!--End of row-->