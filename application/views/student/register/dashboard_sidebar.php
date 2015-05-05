            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse ">
                
                
                <ul id="emulated"   class="nav navbar-nav side-nav">
                 
                    <li class="<?php if($this->router->class == "student_dashboard") echo "active"; ?>">
                        <a href="<?php echo base_url(); ?>index.php/student_dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    
                    <li class="<?php if($this->router->class == "semister_calendar") echo "active"; ?>">
                        <a href="<?php echo base_url(); ?>index.php/semister_calendar"><i class="fa fa-calendar"></i> Semister Calendar</a>
                    </li>
                    

                    <li>                    
                     <a href="javascript:void(0);" data-toggle="collapse" data-target="#attendance_excuse"><i class="fa fa-user"></i> Do It Online <i class="fa fa-fw fa-caret-down"></i></a>
                         <ul id="attendance_excuse" class="collapse">

                            <li class="<?php if($this->router->class == "do_it_online") echo "active"; ?>">
                                <a href="<?php echo base_url(); ?>index.php/do_it_online"><i class="fa fa-user "></i> Attendance Excuse</a>
                            </li>
                                                                             
                        </ul>
                    </li>
                    <li>                    
                     <a href="javascript:void(0);" data-toggle="collapse" data-target="#job_section"><i class="fa fa-briefcase"></i> Jobs <i class="fa fa-fw fa-caret-down"></i></a>
                         <ul id="job_section" class="collapse">

                            <li class="<?php if(($this->router->class == "apply_job") && ($this->input->get('action') == "") ) echo "active"; ?>">
                                <a href="<?php echo base_url(); ?>index.php/apply_job"><i class="fa fa-list "></i> Job List</a>
                            </li>
                            <li class="<?php if(($this->router->class == "apply_job") && ($this->input->get('action') == "applied") ) echo "active"; ?>">
                                <a href="<?php echo base_url(); ?>index.php/apply_job?action=applied"><i class="fa fa-check"></i> Job Applied</a>
                            </li>
                                                                             
                        </ul>
                    </li>
                </ul>
              
            </div>
            <!-- /.navbar-collapse -->
        </nav>