<script type="text/javascript">
$(document).ready(function(){
  var intotal = 0;
  var cc = 0;

  $(".job_selected_show").hide();
  $(".all_jobs .radio input[type=radio]").on("click", function() {
    $("#same_day").attr('checked', false);
    $(".job_selected_show").hide();
    var job_cost = parseInt($(this).parent().find("input.job_cost").val());
    var cost = parseInt($(this).parent().find("input.cost").val());
    var working_days = $(this).parent().find("input.working_days").val();

     if(isNaN(cost)) {
      cost = 0;
    }
    cc = job_cost;


    $("#total_cost").text(job_cost);
    $("#same_day_cost").text(cost);
    intotal = job_cost + cost;
    $("#work_day").text(working_days);
    $("#working_day").val(working_days);

    $(".job_selected_show").fadeIn();

  });

  $("#same_day").on("click", function() {
   
    
    if (this.checked==true) {
      $("#total_cost").text(intotal);
    };


  });

  $("#working_day").click(function() {    
    $("#total_cost").text(cc);
  });

	$('#excuse_document .upload-file-btn').click(function(){
		
		//alert('hi');
		$('.file-list-group').html("");
    $("h5").text("Uploaded Files :");
		$.each($('#excuse_document').find('input.documentfile'),function(){
			
			var filename=$(this).val();
			var filepath = "uploads/files/"+filename;
			var url = '<?php echo base_url(); ?>'+filepath;
			$('.file-list-group').append("<a target='_blank' href='"+url+"' class='list-group-item' fn=''>"+filename+"<input type='hidden' name='filelist[]' value='"+filepath+"'></a>");
				
			
		});
		
	});	
	
});	
</script>
<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome! <small><?php echo $fullname; ?> </small>
                        </h1>
                        
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Home > Apply Job
                            </li>
                        </ol>
                        

                    </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="msg"></div>
                  </div>
                </div>
               
              <div class="row">
                 <div class="col-lg-12">
                    
                    <div class="divider"></div>  
                     <div class="form-group">
                       <h4><i class="fa fa-user "></i> Apply Job </h4>
                       <p class="divider"></p>
                     </div>

                      <div class="form-group clearfix">
                        

                        <div class="col-md-6 col-sm-6 col-xs-6">
                        <!-- <form action="" method="post">  -->
                        
                       
                          <div class="form-group all_jobs">
                          <label>Job List <small class="red-link">*</small> : </label>

                          <?php if(!empty($job_list)) {?>
                            <?php foreach($job_list as $k=>$v) {?>
                              <?php 
                              $job_available = unserialize($v['job_available']);

                              foreach ($job_available as $x => $y) {
                                if($y=="student") {

                             
                              ?>
                              <div class="radio radio-info">
                                <input id="job_id_<?php echo $v['id'] ?>" type="radio" value="<?php echo $v['id'] ?>" name="jobs"> <label for="job_id_<?php echo $v['id'] ?>"><?php echo ucwords($v['name']); ?></label> 
                                <input type="hidden" name="job_cost" class="job_cost" value="<?php echo $v['job_cost'] ?>">
                                <input type="hidden" name="cost" class="cost" value="<?php echo $v['cost'] ?>">
                                <input type="hidden" name="working_days" class="working_days" value="<?php echo $v['completion_period'] ?>">
                              </div>
                          <?php
                                }
                              }
                            } 
                          } else {
                            echo "No Job found!";
                          } 
                           ?>
                           </div>

                           
                          <div class="form-group job_selected_show">
                            <label>Service Required <small class="red-link">*</small> : </label>
                            <div class="radio  radio-info">
                              <input id="same_day" type="radio" value="yes" name="same_day"> <label for="same_day">Same Day (<?php echo $this->currency->get_currency_symbol_by_id($settings['currency_id']); ?><span id="same_day_cost">0</span>)</label> 
                            </div>
                            <div class="radio  radio-info">
                              <input id="working_day" type="radio" value="" name="same_day"> <label for="working_day"><span id="work_day"></span> Working Days</label> 
                            </div>
                          </div>
                          
                          
                          
                          <div class="clearfix"></div>
                          <!-- <button class="btn btn-md btn-warning" data-toggle="modal" data-target="#excuse_document"><i class="fa fa-plus"></i> Add Document</button> -->
                          <!-- <div class="clearfix" style="margin-bottom:10px;"></div> -->

                          <h5></h5>
            							<div class="list-group file-list-group">
            							  <!--<a href="#" class="list-group-item" fn=''>Dapibus ac facilisis in<input type="hidden" name="filelist[]" value=""></a>-->
            							</div>
                          
                          
                          <?php if(!empty($job_list)) {?>
                          <button class="btn btn-info" type="submit" name="apply_job">Apply <img class="loading" src="<?php echo base_url(); ?>/images/loading.gif" alt=""></button>
                          <?php } ?>
                          
                        <!-- </form> -->
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 job_selected_show">
                          <div class="form-group">
                            <button class="btn btn-md btn-warning" data-toggle="modal" data-target="#excuse_document"><i class="fa fa-plus"></i> Add Document</button>
                           </div>

                          <p><b>Upload File (max file size will no more than 5MB and file types are docx,doc,pdf,jpg,png)</b></p>
                          <div class="form-group">
                            <h2><small style="font-size:14px;color:black;">Total : </small><?php echo $this->currency->get_currency_symbol_by_id($settings['currency_id']); ?><span id="total_cost">0</span></h2>
                            
                          </div>
                        </div>
                        
                        <div class="col-sm-3"></div>

                        
                      </div>






                 </div>
         

              </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

         <!-- Modal -->
                <div class="modal fade" id="excuse_document" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Upload Documents</h4>
                      </div>
                      <div class="modal-body">
                      <div class="msg"></div>
                       <div class="form-group">
                      <label class="margin-top-2">Upload Document (<i class="alert-warning">file size no more than 10mb</i>) </label><br/>
                          <span class="btn btn-primary fileinput-button">
                            <i class="fa fa-plus"></i>
                            <span>Add file</span>
                            <!-- The file input field used as target for the file upload widget -->
                            <input id="fileupload" type="file" name="files[]" multiple>
                            
                            </span>
                            <br>
                            <br>
                            <!-- The global progress bar -->
                            <div id="progress" class="progress">
                                <div class="progress-bar progress-bar-success"></div>
                            </div>
                            <!-- The container for the uploaded files -->
                            <div id="files" class="files">
                            </div>
                            <!-- The container for the uploaded files -->     

                        
                        </div>
                      <!-- <div class="form-group">
                       <label for="formstatus"> File name : </label>
                        <input type="text" class="form-control" name="filename"  />
                       </div>                        
                        
                       <div class="form-group">
                       <label for="formstatus"> Check Hard copy : </label>
                       <div class="radio radio-success">
                        <input type="radio" name="check_hard_copy_doc" id="checkhardcopy1"  value="yes"><label for="checkhardcopy1"> Yes</label>
                        </div>
                        <div class="radio  radio-danger">
                        <input type="radio" name="check_hard_copy_doc"  id="checkhardcopy2"  value="no" checked ="checked" > <label for="checkhardcopy2"> No </label>
                        </div>
                        </div>
                       <div class="form-group reason">
                       <label for="formstatus"> Reason : </label>
                       <textarea class="form-control" name="reason" cols="" rows="3"></textarea>

                       </div> -->
                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <!-- <button type="button" name="uploadDoc_do_it_online" class="btn btn-success" id="changebuttonstate" ><i class="fa fa-upload"></i> Upload</button> -->
                        <button type="button" class="btn btn-info upload-file-btn" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>
                        <!--<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>-->
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->   
                
                
                
                <div class="modal fade" id="user_document" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog" style="width: 719px;">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Upload Documents</h4>
                      </div>
                      <div class="modal-body">
                        <div class="msg"></div>
                        <input type="hidden" name="job_id" >
                        <input type="hidden" name="issued_date" >
                        <input type="hidden" name="price" >
                        <input type="hidden" name="files" >
<!--- user_document_data form -->
<form name="user_document_form" >

<div ></div>

                <table class="second_step">
               
                    <tr>
                        <td>First Name</td>
                        <td>:</td>
                        <td><input type="text" name="customer_first_name" value=""  required="required"/></td>
                        <td>Address1</td>
                        <td>:</td>
                        <td><input type="text" name="customer_address1" value=""  required="required"/></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td>:</td>
                        <td><input type="text" name="customer_last_name" value=""  required="required"/></td>
                        <td>City</td>
                        <td>:</td>
                        <td><input type="text" name="customer_city" value=""  required="required"/></td>
                    </tr>
                    <tr>
                        <td>Credit card type</td>
                        <td>:</td>
                        <td>
                            <select name="customer_credit_card_type">
                                <option value="visa">Visa</option>
                                <option value="master_card">Master Card</option>
                                <option value="discocer">Discover</option>
                                <option value="visa">Visa</option>
                            </select>
                        </td>
                        
                        <td>Zip</td>
                        <td>:</td>
                        <td><input type="text" name="customer_zip" value=""  required="required"/></td>
                    </tr>
                    <tr>
                        <td>Credit Card No</td>
                        <td>:</td>
                        <td><input type="text" name="customer_credit_card_number" value=""  required="required"/></td>
                        <td>State</td>
                        <td>:</td>
                        <td ><input type="text" name="customer_state" value=""  required="required"/>( State iso code)</td>
                       
                    </tr>
                    <tr>
                        <td>Expiration Date</td>
                        <td>:</td>
                        <td>
                            <select name="cc_expiration_month" style="width: 95px;">
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">9</option>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>
                                                            </select>
                            <select name="cc_expiration_year" style="width: 95px; margin-left: 10px;">
                                                                    <option value="2012">2012</option>
                                                                    <option value="2013">2013</option>
                                                                    <option value="2014">2014</option>
                                                                    <option value="2015">2015</option>
                                                                    <option value="2016">2016</option>
                                                                    <option value="2017">2017</option>
                                                                    <option value="2018">2018</option>
                                                                    <option value="2019">2019</option>
                                                                    <option value="2020">2020</option>
                                                            </select>
                        </td>
                         <td>Country</td>
                        <td>:</td>
                        <td>
                                                         <select name="customer_country" required="required">
                                                                    <option value="GB">United Kingdom</option>
                                                                    <option value="US">United States</option>
                                                                    <option value="AF">Afghanistan</option>
                                                                    <option value="AL">Albania</option>
                                                                    <option value="DZ">Algeria</option>
                                                                    <option value="AS">American Samoa</option>
                                                                    <option value="AD">Andorra</option>
                                                                    <option value="AO">Angola</option>
                                                                    <option value="AI">Anguilla</option>
                                                                    <option value="AQ">Antarctica</option>
                                                                    <option value="AG">Antigua And Barbuda</option>
                                                                    <option value="AR">Argentina</option>
                                                                    <option value="AM">Armenia</option>
                                                                    <option value="AW">Aruba</option>
                                                                    <option value="AU">Australia</option>
                                                                    <option value="AT">Austria</option>
                                                                    <option value="AZ">Azerbaijan</option>
                                                                    <option value="BS">Bahamas</option>
                                                                    <option value="BD">Bangladesh</option>
                                                                    <option value="BB">Barbados</option>
                                                                    <option value="BY">Belarus</option>
                                                                    <option value="BE">Belgium</option>
                                                                    <option value="BZ">Belize</option>
                                                                    <option value="BJ">Benin</option>
                                                                    <option value="BM">Bermuda</option>
                                                                    <option value="BT">Bhutan</option>
                                                                    <option value="BO">Bolivia</option>
                                                                    <option value="BA">Bosnia And Herzegowina</option>
                                                                    <option value="BW">Botswana</option>
                                                                    <option value="BV">Bouvet Island</option>
                                                                    <option value="BR">Brazil</option>
                                                                    <option value="IO">British Indian Ocean Territory</option>
                                                                    <option value="BN">Brunei Darussalam</option>
                                                                    <option value="BG">Bulgaria</option>
                                                                    <option value="BF">Burkina Faso</option>
                                                                    <option value="BI">Burundi</option>
                                                                    <option value="KH">Cambodia</option>
                                                                    <option value="CM">Cameroon</option>
                                                                    <option value="CA">Canada</option>
                                                                    <option value="CV">Cape Verde</option>
                                                                    <option value="KY">Cayman Islands</option>
                                                                    <option value="CF">Central African Republic</option>
                                                                    <option value="TD">Chad</option>
                                                                    <option value="CL">Chile</option>
                                                                    <option value="CN">China</option>
                                                                    <option value="CX">Christmas Island</option>
                                                                    <option value="CC">Cocos (Keeling) Islands</option>
                                                                    <option value="CO">Colombia</option>
                                                                    <option value="KM">Comoros</option>
                                                                    <option value="CG">Congo</option>
                                                                    <option value="CD">Congo, The Democratic Republic Of The</option>
                                                                    <option value="CK">Cook Islands</option>
                                                                    <option value="CR">Costa Rica</option>
                                                                    <option value="CI">Cote D'Ivoire</option>
                                                                    <option value="HR">Croatia (Local Name: Hrvatska)</option>
                                                                    <option value="CU">Cuba</option>
                                                                    <option value="CY">Cyprus</option>
                                                                    <option value="CZ">Czech Republic</option>
                                                                    <option value="DK">Denmark</option>
                                                                    <option value="DJ">Djibouti</option>
                                                                    <option value="DM">Dominica</option>
                                                                    <option value="DO">Dominican Republic</option>
                                                                    <option value="TP">East Timor</option>
                                                                    <option value="EC">Ecuador</option>
                                                                    <option value="EG">Egypt</option>
                                                                    <option value="SV">El Salvador</option>
                                                                    <option value="GQ">Equatorial Guinea</option>
                                                                    <option value="ER">Eritrea</option>
                                                                    <option value="EE">Estonia</option>
                                                                    <option value="ET">Ethiopia</option>
                                                                    <option value="FK">Falkland Islands (Malvinas)</option>
                                                                    <option value="FO">Faroe Islands</option>
                                                                    <option value="FJ">Fiji</option>
                                                                    <option value="FI">Finland</option>
                                                                    <option value="FR">France</option>
                                                                    <option value="FX">France, Metropolitan</option>
                                                                    <option value="GF">French Guiana</option>
                                                                    <option value="PF">French Polynesia</option>
                                                                    <option value="TF">French Southern Territories</option>
                                                                    <option value="GA">Gabon</option>
                                                                    <option value="GM">Gambia</option>
                                                                    <option value="GE">Georgia</option>
                                                                    <option value="DE">Germany</option>
                                                                    <option value="GH">Ghana</option>
                                                                    <option value="GI">Gibraltar</option>
                                                                    <option value="GR">Greece</option>
                                                                    <option value="GL">Greenland</option>
                                                                    <option value="GD">Grenada</option>
                                                                    <option value="GP">Guadeloupe</option>
                                                                    <option value="GU">Guam</option>
                                                                    <option value="GT">Guatemala</option>
                                                                    <option value="GN">Guinea</option>
                                                                    <option value="GW">Guinea-Bissau</option>
                                                                    <option value="GY">Guyana</option>
                                                                    <option value="HT">Haiti</option>
                                                                    <option value="HM">Heard And Mc Donald Islands</option>
                                                                    <option value="VA">Holy See (Vatican City State)</option>
                                                                    <option value="HN">Honduras</option>
                                                                    <option value="HK">Hong Kong</option>
                                                                    <option value="HU">Hungary</option>
                                                                    <option value="IS">Iceland</option>
                                                                    <option value="IN">India</option>
                                                                    <option value="ID">Indonesia</option>
                                                                    <option value="IR">Iran (Islamic Republic Of)</option>
                                                                    <option value="IQ">Iraq</option>
                                                                    <option value="IE">Ireland</option>
                                                                    <option value="IL">Israel</option>
                                                                    <option value="IT">Italy</option>
                                                                    <option value="JM">Jamaica</option>
                                                                    <option value="JP">Japan</option>
                                                                    <option value="JO">Jordan</option>
                                                                    <option value="KZ">Kazakhstan</option>
                                                                    <option value="KE">Kenya</option>
                                                                    <option value="KI">Kiribati</option>
                                                                    <option value="KP">Korea, Democratic People's Republic Of</option>
                                                                    <option value="KR">Korea, Republic Of</option>
                                                                    <option value="KW">Kuwait</option>
                                                                    <option value="KG">Kyrgyzstan</option>
                                                                    <option value="LA">Lao People's Democratic Republic</option>
                                                                    <option value="LV">Latvia</option>
                                                                    <option value="LB">Lebanon</option>
                                                                    <option value="LS">Lesotho</option>
                                                                    <option value="LR">Liberia</option>
                                                                    <option value="LY">Libyan Arab Jamahiriya</option>
                                                                    <option value="LI">Liechtenstein</option>
                                                                    <option value="LT">Lithuania</option>
                                                                    <option value="LU">Luxembourg</option>
                                                                    <option value="MO">Macau</option>
                                                                    <option value="MK">Macedonia, Former Yugoslav Republic Of</option>
                                                                    <option value="MG">Madagascar</option>
                                                                    <option value="MW">Malawi</option>
                                                                    <option value="MY">Malaysia</option>
                                                                    <option value="MV">Maldives</option>
                                                                    <option value="ML">Mali</option>
                                                                    <option value="MT">Malta</option>
                                                                    <option value="MH">Marshall Islands</option>
                                                                    <option value="MQ">Martinique</option>
                                                                    <option value="MR">Mauritania</option>
                                                                    <option value="MU">Mauritius</option>
                                                                    <option value="YT">Mayotte</option>
                                                                    <option value="MX">Mexico</option>
                                                                    <option value="FM">Micronesia</option>
                                                                    <option value="MD">Moldova, Republic Of</option>
                                                                    <option value="MC">Monaco</option>
                                                                    <option value="MN">Mongolia</option>
                                                                    <option value="MS">Montserrat</option>
                                                                    <option value="MA">Morocco</option>
                                                                    <option value="MZ">Mozambique</option>
                                                                    <option value="MM">Myanmar</option>
                                                                    <option value="NA">Namibia</option>
                                                                    <option value="NR">Nauru</option>
                                                                    <option value="NP">Nepal</option>
                                                                    <option value="NL">Netherlands</option>
                                                                    <option value="AN">Netherlands Antilles</option>
                                                                    <option value="NC">New Caledonia</option>
                                                                    <option value="NZ">New Zealand</option>
                                                                    <option value="NI">Nicaragua</option>
                                                                    <option value="NE">Niger</option>
                                                                    <option value="NG">Nigeria</option>
                                                                    <option value="NU">Niue</option>
                                                                    <option value="NF">Norfolk Island</option>
                                                                    <option value="MP">Northern Mariana Islands</option>
                                                                    <option value="NO">Norway</option>
                                                                    <option value="OM">Oman</option>
                                                                    <option value="PK">Pakistan</option>
                                                                    <option value="PW">Palau</option>
                                                                    <option value="PA">Panama</option>
                                                                    <option value="PG">Papua New Guinea</option>
                                                                    <option value="PY">Paraguay</option>
                                                                    <option value="PE">Peru</option>
                                                                    <option value="PH">Philippines</option>
                                                                    <option value="PN">Pitcairn</option>
                                                                    <option value="PL">Poland</option>
                                                                    <option value="PT">Portugal</option>
                                                                    <option value="PR">Puerto Rico</option>
                                                                    <option value="QA">Qatar</option>
                                                                    <option value="RE">Reunion</option>
                                                                    <option value="RO">Romania</option>
                                                                    <option value="RU">Russian Federation</option>
                                                                    <option value="RW">Rwanda</option>
                                                                    <option value="KN">Saint Kitts And Nevis</option>
                                                                    <option value="LC">Saint Lucia</option>
                                                                    <option value="VC">Saint Vincent And The Grenadines</option>
                                                                    <option value="WS">Samoa</option>
                                                                    <option value="SM">San Marino</option>
                                                                    <option value="ST">Sao Tome And Principe</option>
                                                                    <option value="SA">Saudi Arabia</option>
                                                                    <option value="SN">Senegal</option>
                                                                    <option value="SC">Seychelles</option>
                                                                    <option value="SL">Sierra Leone</option>
                                                                    <option value="SG">Singapore</option>
                                                                    <option value="SK">Slovakia (Slovak Republic)</option>
                                                                    <option value="SI">Slovenia</option>
                                                                    <option value="SB">Solomon Islands</option>
                                                                    <option value="SO">Somalia</option>
                                                                    <option value="ZA">South Africa</option>
                                                                    <option value="GS">South Georgia, South Sandwich Islands</option>
                                                                    <option value="ES">Spain</option>
                                                                    <option value="LK">Sri Lanka</option>
                                                                    <option value="SH">St. Helena</option>
                                                                    <option value="PM">St. Pierre And Miquelon</option>
                                                                    <option value="SD">Sudan</option>
                                                                    <option value="SR">Suriname</option>
                                                                    <option value="SJ">Svalbard And Jan Mayen Islands</option>
                                                                    <option value="SZ">Swaziland</option>
                                                                    <option value="SE">Sweden</option>
                                                                    <option value="CH">Switzerland</option>
                                                                    <option value="SY">Syrian Arab Republic</option>
                                                                    <option value="TW">Taiwan</option>
                                                                    <option value="TJ">Tajikistan</option>
                                                                    <option value="TZ">Tanzania, United Republic Of</option>
                                                                    <option value="TH">Thailand</option>
                                                                    <option value="TG">Togo</option>
                                                                    <option value="TK">Tokelau</option>
                                                                    <option value="TO">Tonga</option>
                                                                    <option value="TT">Trinidad And Tobago</option>
                                                                    <option value="TN">Tunisia</option>
                                                                    <option value="TR">Turkey</option>
                                                                    <option value="TM">Turkmenistan</option>
                                                                    <option value="TC">Turks And Caicos Islands</option>
                                                                    <option value="TV">Tuvalu</option>
                                                                    <option value="UG">Uganda</option>
                                                                    <option value="UA">Ukraine</option>
                                                                    <option value="AE">United Arab Emirates</option>
                                                                    <option value="UM">United States Minor Outlying Islands</option>
                                                                    <option value="UY">Uruguay</option>
                                                                    <option value="UZ">Uzbekistan</option>
                                                                    <option value="VU">Vanuatu</option>
                                                                    <option value="VE">Venezuela</option>
                                                                    <option value="VN">Viet Nam</option>
                                                                    <option value="VG">Virgin Islands (British)</option>
                                                                    <option value="VI">Virgin Islands (U.S.)</option>
                                                                    <option value="WF">Wallis And Futuna Islands</option>
                                                                    <option value="EH">Western Sahara</option>
                                                                    <option value="YE">Yemen</option>
                                                                    <option value="YU">Yugoslavia</option>
                                                                    <option value="ZM">Zambia</option>
                                                                    <option value="ZW">Zimbabwe</option>
                                                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Card Varification No</td>
                        <td>:</td>
                        <td><input type="text" name="cc_cvv2_number" value=""  required="required"/></td>
                        <td>Price </td>
                        <td>:</td>
                        <td>
                            <input type="text" name="example_payment_amuont" value="25"  />
                        </td>
                    </tr>

                    
                    
                </table>
                </form>                      
<!--- end of user_document_data form -->                      
                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <!-- <button type="button" name="uploadDoc_do_it_online" class="btn btn-success" id="changebuttonstate" ><i class="fa fa-upload"></i> Upload</button> -->
                        <button type="button" class="btn btn-info upload-file-btn" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>
                        <!--<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>-->
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->                 