<?php            
$access =  $staff_access['staff_privileges']; 
//var_dump($access);     
?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse ">
                
                
                <ul id="emulated"   class="nav navbar-nav side-nav">
                 
                    <li class="<?php if($this->router->class == "user_dashboard") echo "active"; ?>">
                        <a href="<?php echo base_url(); ?>index.php/user_dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                     <a href="javascript:;" data-toggle="collapse" data-target="#management"><i class="fa fa-fw fa-bank"></i> Management <i class="fa fa-fw fa-caret-down"></i></a>
                     <ul id="management" class="collapse">      
                    <li class="<?php if($this->router->class == "vendor_management") echo "active"; ?>">
                        <a href="<?php echo base_url(); ?>index.php/vendor_management"><i class="fa fa-fw fa-dashboard"></i> Vendor</a>
                    </li>
                    <li class="<?php if($this->router->class == "client_management") echo "active"; ?>">
                        <a href="<?php echo base_url(); ?>index.php/client_management"><i class="fa fa-fw fa-dashboard"></i> Client</a>
                    </li>
                    <li class="<?php if($this->router->class == "paddy_management") echo "active"; ?>">
                        <a href="<?php echo base_url(); ?>index.php/paddy_management"><i class="fa fa-fw fa-tree"></i> Paddy</a>
                    </li>
                    <li class="<?php if($this->router->class == "employee_management") echo "active"; ?>">
                        <a href="<?php echo base_url(); ?>index.php/employee_management"><i class="fa fa-fw fa-user"></i> Employee</a>
                    </li>                    <li class="<?php if($this->router->class == "user_management") echo "active"; ?>">
                        <a href="<?php echo base_url(); ?>index.php/user_management"><i class="fa fa-fw fa-users"></i> Users Management</a>
                    </li>
                    </ul>
                    </li>
                    <li class="<?php if($this->router->class == "purchase_management") echo "active"; ?>">
                        <a href="<?php echo base_url(); ?>index.php/purchase_management"><i class="fa fa-fw fa-truck"></i> Purchase management</a>
                    </li>                    
                    <li class="<?php if($this->router->class == "sale_management") echo "active"; ?>">
                        <a href="<?php echo base_url(); ?>index.php/sale_management"><i class="fa fa-fw fa-money"></i> Sale management</a>
                    </li> 
                    <li class="<?php if($this->router->class == "production_management") echo "active"; ?>">
                        <a href="<?php echo base_url(); ?>index.php/production_management"><i class="fa fa-fw fa-cogs"></i> Production management</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#due"><i class="fa fa-fw fa-bank"></i> Due Management <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="due" class="collapse">
                            <li class="<?php if($this->router->class == "purchase_due_management") echo "active"; ?>">
                                <a href="<?php echo base_url(); ?>index.php/purchase_due_management">Purchase Due Management</a>
                            </li>
                            <li class="<?php if($this->router->class == "sale_due_management") echo "active"; ?>">
                                <a href="<?php echo base_url(); ?>index.php/sale_due_management">Sale Due Management</a>
                            </li>
                            
      
                     </ul>     
                    </li>                                                                                                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo1"><i class="fa fa-fw fa-bank"></i> Accounting <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo1" class="collapse">
                            <li class="<?php if($this->router->class == "accounts_manage") echo "active"; ?>">
                                <a href="<?php echo base_url(); ?>index.php/accounts_manage">Chart of Accounts</a>
                            </li>
                            <li class="<?php if($this->router->class == "accounts_journal") echo "active"; ?>">
                                <a href="<?php echo base_url(); ?>index.php/accounts_journal">Transaction Entry</a>
                            </li>
                            
      
                     </ul>     
                    </li>        
                    <li>
                     <a href="javascript:;" data-toggle="collapse" data-target="#statement"><i class="fa fa-fw fa-file-text"></i> Financial Reports <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="statement" class="collapse">
                         
                            <li class="<?php if($this->router->class == "reports_transaction") echo "active"; ?>">
                                <a href="<?php echo base_url(); ?>index.php/reports_transaction"> Transaction Reports</a>
                            </li>
                            <li class="<?php if($this->router->class == "reports_ledger") echo "active"; ?>"><a href="<?php echo base_url(); ?>index.php/reports_ledger">Ledger reports</a></li>                       
                    		<li class="<?php if($this->router->class == "reports_incomestatement") echo "active"; ?>"><a href="<?php echo base_url(); ?>index.php/reports_incomestatement">Income statement reports</a></li>
                    		<li class="<?php if($this->router->class == "reports_equity") echo "active"; ?>"><a href="<?php echo base_url(); ?>index.php/reports_equity">Owners Equity reports</a></li>
                    		<li class="<?php if($this->router->class == "reports_balancesheet") echo "active"; ?>"><a href="<?php echo base_url(); ?>index.php/reports_balancesheet">Balance Sheet reports</a></li>

                    </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo2"><i class="fa fa-fw fa-file-text"></i> Reports <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo2" class="collapse">
                            <li class="<?php if($this->router->class == "report_purchase") echo "active"; ?>">
                                <a href="<?php echo base_url(); ?>index.php/report_purchase"><i class="fa fa-cog "></i> Purchase Report</a>
                            </li>
                            <li class="<?php if($this->router->class == "report_sale") echo "active"; ?>">
                                <a href="<?php echo base_url(); ?>index.php/report_sale"><i class="fa fa-cog "></i> Sale Report</a>
                            </li>
                            <li class="<?php if($this->router->class == "report_production") echo "active"; ?>">
                                <a href="<?php echo base_url(); ?>index.php/report_production"><i class="fa fa-cog "></i> Production Report</a>
                            </li>
                            <li class="<?php if($this->router->class == "report_inventory") echo "active"; ?>">
                                <a href="<?php echo base_url(); ?>index.php/report_inventory"><i class="fa fa-cog "></i> Inventory Report</a>
                            </li>                                                        
                        </ul>
                    </li>                    

                    

                </ul>
              
            </div>
            <!-- /.navbar-collapse -->
        </nav>