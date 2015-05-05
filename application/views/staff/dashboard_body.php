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

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <a href="<?php echo base_url(); ?>index.php/student_admission_management">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $todays_studentdata_entry; ?></div>
                                        <div>Applications</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $todays_notes_entry; ?></div>
                                        <div>Staff Notes</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $todays_archive_entry; ?></div>
                                        <div>Archive</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $todays_communication_entry; ?></div>
                                        <div>Communications</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    
                   

                    

                     

                     <!--Start Panel for Less Than 80 % Attendance -->
                    <!--<div class="col-lg-12 ol-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-pink">

                            <div class="panel-heading"> <i class="fa fa-exclamation-triangle"></i> Payment Due </div>

                            <div class="panel-body">

                            	<?php if(!empty($due_html)) echo $due_html;  ?>
                                
                           	
                            	
                            </div>



                        </div>
                    </div>-->
                     <!--End of Panel for Less Than 80 % Attendance -->
                </div>
                <!-- /.row -->

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

