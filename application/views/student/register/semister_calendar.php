

                <!-- Page Heading -->
                <!-- <div class="row"> -->
                    <div class="col-lg-10">
                        
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa <?php echo $faicon; ?>"></i> <?php echo $breadcrumbtitle; ?>
                            </li>
                        </ol>
                        

                    </div>
                <!-- </div> -->
                <!-- <div class="row"> -->
                  <div class="col-lg-10">
                    <?php 
                    if(!empty($msg)) {
                      echo $msg;
                    } 

                    ?>
                  </div>
                <!-- </div> -->
               
              <!-- <div class="row"> -->
                 <div class="col-lg-10 content-area">
                    
                    <div class="divider"></div>  
                     <div class="form-group">
                       <h4><i class="fa fa-calendar "></i><?php echo $bodytitle; ?> </h4>
                       <p class="divider"></p>
                     </div>
<!--calender start -->         
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

            <!-- </div> -->
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

