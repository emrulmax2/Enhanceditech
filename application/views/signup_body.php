<script type="text/javascript">
$(document).ready(function(){
    var metrics = [
    [ '#repassword', 'same-as:#password', 'Your password and retype password do not match.' ],
    [ 'input[name=student_email]', 'email', 'Must be a valid email.' ]
    ];
  var nod_options = {
    
      'groupSelector' : '.form-group',
      'groupClass' : 'has-error',
      'disableSubmitBtn' : false
  };    
    $( "#userform" ).nod( metrics , nod_options );


});
</script>
<div class="row">
        <div class="img-left">
        <img src="<?php echo $settings["logo_url"];?>">
        </div><div class="company-info">
        <h2> <?php echo $settings["company_name"];?></h2>
        <p><i class="fa fa-envelope"></i> <?php echo nl2br($settings["address"]); ?></p>
        <p><i class="fa fa-phone"></i> <?php echo $settings["phone"]; ?></p>
        </div>
    </div>
<div id="page-wrapper">

            <div class="container-fluid">

            <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                <div class="row">
                    <div class="col-lg-12">
                        
                    </div>
                    
                </div>
                
                <div class="row">
                    
                    <div class="col-lg-12" style="padding-top: 10px;">
                    <?php if($message!="") {                
                         echo $message;

                     } ?>
                    </div>
                    
                </div>                

                <div class="row">
                    
                    
                    <form role="form" id="userform" method="post">
                    
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a class="" href="<?php echo base_url(); ?>"><i class="fa fa-arrow-left"></i> Back to login</a>
                                </div>
                                <div class="col-sm-6 text-right">
                                     <!--<button type="submit" class="btn btn-md btn-success "><i class="fa fa-check"></i> Save Application</button>
                                        <button type="reset" class="btn btn-md btn-danger "><i class="fa fa-refresh"></i> Reset</button>-->
                                        <input type="submit" class="btn btn-lg btn-success " value="Create Account">
                                 </div>       
                             </div> 
                             <div class="divider"></div>  
                             <div class="form-group">
                               <h4><i class="fa fa-user "></i> Personal Details </h4>
                               <p class="divider"></p>
                             </div>    

                                <div class="form-group clearfix"> 
                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
                                    <label>Title <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-3 no-pad-right">
                                     <select name="student_title"  class="form-control" required>
                                        <option value="">Please select</option>
<?php
										foreach($title_list as $k=>$v){
											echo "<option value='".$v['id']."'>".$v['name']."</option>";	
										}	
?>
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    
                                    <div class="col-sm-2 no-pad-left col-md-offset-1">
                                        <label>First Name <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-4 ">
                                         <input type="text" class="form-control" name="student_first_name" value="" placeholder="Applicant first name" required />
                                    </div>
                                    
                                </div>  <div class="form-group clearfix">
                                    
                                    <div class="col-sm-2 no-pad-left col-md-offset-1">
                                        <label>Last Name <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-4 ">
                                         <input type="text" class="form-control" name="student_sur_name" value="" placeholder="Applicant Last name" required />
                                    </div>
                                    
                                </div>  
                                <div class="form-group clearfix">
                                    
                                    <div class="col-sm-2 no-pad-left col-md-offset-1">
                                        <label>Email <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-4 ">
                                         <input type="text" class="form-control" name="student_email" value="" placeholder="Enter email address" required />
                                    </div>
                                    
                                </div>                                
     
                                <div class="form-group clearfix"> 
                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
                                    <label>Gender <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-3 no-pad-right">
                                     <select name="student_gender"  class="form-control" required>
                                        <option value="">Please select</option>
<?php
										foreach($gender_list as $k=>$v){
											echo "<option value='".$v['id']."'>".$v['name']."</option>";	
										}	
?>
                                    </select>
                                    </div>
                                </div>                                    


                                
                                <div class="form-group">
                                       <p class="divider"></p>
                                       <h4><i class="fa fa-lock "></i> Password </h4>
                                       <p class="divider"></p>
                                 </div>
                                 
                                 
                                 <div class="form-group clearfix">
                                     <div class="col-sm-2 no-pad-left col-md-offset-1">
                                        <label>Password<small class="red-link">*</small></label>
                                     </div>
                                     <div class="col-sm-4 no-pad-right">
                                        <input id="password" class="form-control password" type="password" name="password" placeholder="Enter Password" required>
                                    </div>
                                    </div>
                                    <div class="form-group clearfix">
                                     <div class="col-sm-2 no-pad-left col-md-offset-1">
                                    <label >Repassword<small class="red-link">*</small></label>
                                    </div>
                                     <div class="col-sm-4 no-pad-right">
                                    <input id="repassword" type="password" class="form-control repassword" name="repassword" placeholder="Re type Password" required><label class="retypepassword"></label>
                                    </div>
                                </div>
                           </div>

                           
                           <div class="clearfix"></div>
                           <div class="divider"></div>
                           
                                <div class="col-sm-12 text-right">
                                        <input type="submit" class="btn btn-lg btn-success " value="Create Account">
                                 </div>
                                 
                           <div class="clearfix"></div>                                 
                           <div class="divider"></div>
               </form>
               
                 <div class="row">

                    
                </div>              
               

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>