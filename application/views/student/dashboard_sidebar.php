            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse ">
                
                
                <ul id="emulated"   class="nav navbar-nav side-nav">
                 
                    <li class="<?php if($this->router->class == "user_dashboard") echo "active"; ?>">
                        <a href="<?php echo base_url(); ?>index.php/user_dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                   <!--  <li class="<?php if($this->router->class == "do_it_online") echo "active"; ?>">
                        <a href="<?php echo base_url(); ?>index.php/do_it_online"><i class="fa fa-fw fa-dashboard"></i> Do It Online</a>
                    </li> -->
                </ul>
              
            </div>
            <!-- /.navbar-collapse -->
        </nav>