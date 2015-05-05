<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*  compare with default and new merge arguments
*/
if ( ! function_exists('fixi_parse_args'))
{
    
function fixi_parse_args( $args, $defaults = '' ) {
    if ( is_object( $args ) )
        $r = get_object_vars( $args );
    elseif ( is_array( $args ) )
          $r =& $args; 
    else
        fix_parse_str($args, $r );
    if ( is_array( $defaults ) )
        return array_merge( $defaults, $r );
    return $r;
}

}
if ( ! function_exists('mysql_prep'))
{
	/**
	* prevent mysql injection
	* 
	* @param mixed $value
	*/
	function mysql_prep( $value ) 
	{
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
		if( $new_enough_php ) 
		{ // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysql_real_escape_string( $value );
		} 
		else 
		{ // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
	 return $value;
	}

}
if ( ! function_exists('utf8replacer'))
{
	
	function utf8replacer($captures) {
	  if ($captures[1] != "") {
	 // Valid byte sequence. Return unmodified.
	 return $captures[1];
	  }
	  elseif ($captures[2] != "") {
	 // Invalid byte of the form 10xxxxxx.
	 // Encode as 11000010 10xxxxxx.
	 return "\xC2".$captures[2];
	  }
	  else {
	 // Invalid byte of the form 11xxxxxx.
	 // Encode as 11000011 10xxxxxx.
	 return "\xC3".chr(ord($captures[3])-64);
	  }
	}
}
if ( ! function_exists('removeAndReturnInvalidUtf8String'))
{
	
	function removeAndReturnInvalidUtf8String($text){
/*	
$regex = <<<'END'
/
  (
 (?: [\x00-\x7F]               # single-byte sequences   0xxxxxxx
 |   [\xC0-\xDF][\x80-\xBF]    # double-byte sequences   110xxxxx 10xxxxxx
 |   [\xE0-\xEF][\x80-\xBF]{2} # triple-byte sequences   1110xxxx 10xxxxxx * 2
 |   [\xF0-\xF7][\x80-\xBF]{3} # quadruple-byte sequence 11110xxx 10xxxxxx * 3 
 ){1,100}                      # ...one or more times
  )
| ( [\x80-\xBF] )                 # invalid byte in range 10000000 - 10111111
| ( [\xC0-\xFF] )                 # invalid byte in range 11000000 - 11111111
/x
END;
$output = preg_replace_callback($regex, "utf8replacer", $text);
return $output;
*/ 
}
}
if(!function_exists('primary_nav')){
    /**
    * admin top menu
    * 
    * @param mixed $ulclass add class in ul
    * @param array $arg are list of menu with label,link,image source
    * ex. 
    *    $args=array(
    *           'name'=>array(
    *                           Label,
    *                           link address,
    *                           image source link
    *                        )
    *          )
    */
function primary_nav($args=array(),$menudactivation=1, $Mobile_MENU="MENU",$class=array()){
    $defaultclass = array("nav"=>"","ul" =>"");
    $defaultclass=fixi_parse_args($class,$defaultclass);
    $defaults=array(array('Dashboard','cbs_administration','glyphicon-dashboard'),array('Users','view_staff','glyphicon-user'),array('Department','view_department','glyphicon-map-marker'),array('Counter','view_counter','glyphicon-info-sign'),array('Reports','adminresult_reports','glyphicon-th-list') );
    $menudactivation = $menudactivation -1;
 $defaults=array_replace($args,$defaults);
/* echo "<pre>";
 var_dump($defaults);
 echo "</pre>"; */
 $MENU = $Mobile_MENU;
$html= '<nav class="navbar navbar-inverse nav-low '.$defaultclass["nav"].'" role="navigation">
      <div class="container">
        <div class="navbar-header">
         <a class="navbar-brand visible-xs ">'.$MENU.'</a>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav '.$defaultclass["ul"].'">';
          
foreach ($defaults as $index => $label){
$html.='<li class="';
if($menudactivation==$index) $html.="active";
$html.='"><a href="'.base_url().'index.php/'.$label[1].'/"><span class="glyphicon '.$label[2].'"></span> '.$label[0].'</a></li>';

}
$html.=   '</ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>';
  return $html;  
    }

}

if(!function_exists('head_metadata')){
    /**
    * html head
    * 
    * 
    */
    function head_metadata(){
        
    $html5='<meta charset="utf-8">';
    return $html5;
    
    }
    

}
if(!function_exists('fixi_title')){
    /**
    * html head
    * 
    * 
    */
    function fixi_title($title='Welcome'){
        
    $html5='<title>';
    $html5.=$title;
    $html5.='</title>';
    return $html5;
    
    }
    

}

if(!function_exists('fixi_style')){
    
    /**
    * style files
    * 
    * @param $files array of style list; Default empty array
    * @return $html5 return $html varibale without echo   
    */
    
    function fixi_style($files=array()){
        $html5='<link href="'.base_url().'css/bootstrap.css" rel="stylesheet" type="text/css" />';        
        $html5.='<link href="'.base_url().'css/jquery-ui-1.10.0.custom.css" rel="stylesheet" type="text/css" />';


        if(!empty($files)){
 
        foreach ($files as $file){    
     
         $html5.='<link href="'.base_url().'css/'.$file.'.css" rel="stylesheet" type="text/css" />';
            
        }
     
       }
         
    return $html5;
    
    }
    

}


if(!function_exists('fixi_script')){
    
    /**
    * script including files
    * 
    * @param $files array of script list; Default empty array
    * @return $html5 return $html varibale without echo   
    */

    function fixi_script($files=array()){
            
$html5='<script type="text/javascript" src="'.base_url().'js/jquery-1.11.0.js"></script>

 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->    

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="'.base_url().'js/jquery-ui-1.10.0.custom.min.js"></script>'; 
     
 
if(!empty($files)){
 
     foreach ($files as $file){
     
      $html5.='<script type="text/javascript" src="'.base_url().'js/'.$file.'.js"></script>'; 
      
     }
     
}
    return $html5;
    
    }
    

}


if(!function_exists('fixi_head')){

    /**
    * fixi head
    * 
    * 
    */

    function fixi_head($lang="en"){
    global $settings;   
    $html5='<!DOCTYPE html>
    <html lang="'.$lang.'">
    <head>';
    $html5.=head_metadata();
    ///////////////////////////----------------
    //$sn = explode(".",$_SERVER['SERVER_NAME']);
    ///////////////////////////----------------
    //$html5.=fixi_title("Welcome to ".strtoupper($sn[0])."");
    $html5.=fixi_title("Welcome to LCC");
    
    $html5.=fixi_style(array("sb-admin","plugins/morris","datatables","font-awesome","tabelizer.min","jquery.fileupload","build","jquery.timepicker","kalendar","custom"));
    
    $html5.=fixi_script(array("load-image.all.min","canvas-to-blob.min","bootstrap.min","datatables","nod","jquery.tabelizer.min","jquery.mousewheel.min","jquery.iframe-transport","jquery.fileupload","jquery.fileupload-process","jquery.fileupload-image","jquery.fileupload-audio","jquery.fileupload-validate","plugins/tinymce/jquery.tinymce.min","plugins/tinymce/tinymce.min","jquery.timepicker","kalendar","custom","due"));
    
    $html5.='</head>';

    return $html5;

    }
    

}
if(!function_exists('the_fixi_head')){
    /**
    * @since 1.0
    * @see fixi_head();
    * 
    */
function the_fixi_head(){
    echo fixi_head();
}
}
if(!function_exists('set_fixi_notification')){

    /**
    * Insert notification information
    * @param $message notification
    * 
    */

    function set_fixi_notification($message="",$class="info"){
    //<!-- Note -->   
    
$html5='<div class="alert alert-'.$class.' alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> '.$message.' </div>';
    
    return $html5;

    }
    

}

if(!function_exists('hr_date')){
/**
* insert mysql datetime and
*     
* @param mixed $date
* @return mixed date day-month-year
*/
    function hr_date($date){
        
        $time=strtotime($date);
       return date('j-M-Y',$time); 
    }
}
if(!function_exists('hr_time')){
/**
* insert mysql datetime and
*     
* @param mixed $date
*/
    function hr_time($time){
        
        $time=strtotime($time);
       return date('h:iA',$time); 
    }
}

if(!function_exists('dateDiff')){
/**
* Get the date difference
* 

* @param mixed $beginDate Start date input here 
* @param mixed $endDate   End date input here
* @param mixed $dformat   Format set here. ex: / , -  .Default value is "-"
* @return int date diference number for error return -99
*/
function dateDiff($beginDate,$endDate,$dformat="-")
{
  if($endDate!="" && $beginDate!=""){  
    $date_parts1=explode($dformat, $beginDate);
    $date_parts2=explode($dformat, $endDate);
    $start_date=gregoriantojd($date_parts1[1], $date_parts1[2],$date_parts1[0]);
    $end_date=gregoriantojd($date_parts2[1], $date_parts2[2],$date_parts2[0]);
return $end_date - $start_date;
  }
  return -99;
}
}

/**
* change password part-par
*/

function changePassWordinputHtml($uid, $lebel){
   
  $html="
   <!--change password modal here-->

                    <!-- Modal -->
                   <form role='form' id='changePass'>
                    <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                      <div class='modal-dialog'>
                        <div class='modal-content'>
                          <div class='modal-header change_password_modal_header'>
                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                            <h4 class='modal-title' id='myModalLabel'>Change Password  </h4>
                          </div>
                          
                          <input type='hidden' name='uid' id='sid' value='$uid' />
                          <input type='hidden' name='lebel' id='lebel' value='$lebel' />
                          
                          <div class='modal-body'>
                              <div class='form-group'>
                              <div class='msg'></div>
                              
                              </div>
                               
                              
                              <div class='form-group'>
                                <label for='exampleInputPassword1'> Old Password</label>
                                <input type='password' class='form-control' id='oldPassword' placeholder='Password'>
                              </div>
                              <div class='form-group'>
                                <label for='exampleInputPassword1'>New Password</label>
                                <input type='password' class='form-control' id='NewPassword' placeholder='Password'>
                              </div>
                              <div class='form-group'>
                                <label for='exampleInputPassword1'>Repeat New Password</label>
                                <input type='password' class='form-control' id='ReNewPassword' placeholder='Password'>
                              </div>


                          </div>
                          <div class='modal-footer'>
                          <img class='loading_valid' src='".base_url()."/images/loading.gif'  style='display:none;' />
                            <button type='button' class='btn welcome-btn-logout' data-dismiss='modal'>Close</button>
                            <button type='submit' class='btn btn-danger'>Save changes</button>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                   </form>

               <!--change password modal end here-->";
               
               return $html;
}                                          

function get_random_password($chars_min=6, $chars_max=8, $use_upper_case=false, $include_numbers=false, $include_special_chars=false)
    {
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if($include_numbers) {
            $selection .= "1234567890";
        }
        if($include_special_chars) {
            $selection .= "!@\"#$%&[]{}?|";
        }
                                
        $password = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];            
            $password .=  $current_letter;
        }                
        
        return $password;
    }

  
  
  function send_sms_txt($selectednums,$sMessage){
        
	 // Configuration variables
	$info = "1";
	$test = "0";
	 
	// Data for text message
	$uname = 'sakib@esoftarena.co.uk';
	$pword = 'churchill1';

	$from = "London Churchill College";

	$message = urlencode($sMessage);
	 
	// Prepare data for POST request
	$data = "uname=".$uname."&pword=".$pword."&message=".$message
	."&from=". $from."&selectednums=".$selectednums."&info=".$info."&test=".$test;
	 
	// Send the POST request with cURL
	$ch = curl_init('https://www.txtlocal.com/sendsmspost.php'); //note https for SSL
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); //This is the result from Textlocal
	curl_close($ch);
	//- See more at: http://www.textlocal.com/simple-developer-sms-api#sthash.k3QQETki.dpuf
    //print_r("sms_send");

	}

    if(!function_exists('waiting_time')) {
        /**
        * waitng time human readable view
        * 
        * @param mixed $seconds
        * @return mixed $waiting time string 
        */
        function waiting_time ($seconds) {
                                           // waiting time code start
                                $hours = floor($seconds/3600);
                                $min = ($seconds/60)%60;
                                $sec = $seconds%60;
                                
                                $waiting_time_hours = $hours;
                                $waiting_time_hours = $hours*1;
                                $waiting_time_min = $min;
                                if($waiting_time_hours > 1) $hours=' hours '; 
                                else if($waiting_time_hours == 1) $hours=' hour '; 
                                else {$waiting_time_hours="";$hours="";}
                                
                                $waiting_time = $waiting_time_hours.$hours.$waiting_time_min. " min"; 
                                // waiting time code end
        return $waiting_time;
        }
         
    }
    
/*function Addinputhtml( $lebel="counter" ) {
 
 if($lebel == "counter")   
  $html="
   <!--change counter modal here-->

                    <!-- Modal -->
                   <form role='form' id='addinputhtml_counter'>
                    <div class='modal fade' id='myCounter' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                      <div class='modal-dialog'>
                        <div class='modal-content'>
                          <div class='modal-header addinputhtml_counter_header'>
                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                            <h4 class='modal-title' id='myModalLabel'><span class='glyphicon glyphicon-plus'></span> Add Counter  </h4>
                          </div>
                          
                          <input type='hidden' name='counterIDname' id='counterhiddenID' value='' /> 
                          
                          <div class='modal-body'>
                              <div class='form-group'>
                              <div class='msg'></div>
                              
                              </div>
                               
                              
                              <div class='form-group'>
                                <label for='exampleInputPassword1'> Counter Name :</label>
                                <input type='text' class='form-control' id='counter' placeholder='Enter a counter name'>
                              </div>

                          </div>
                          <div class='modal-footer'>
                          <img class='loading_valid' src='".base_url()."/images/loading.gif'  style='display:none;' />
                            <button type='button' class='btn counter-btn-close' data-dismiss='modal'>Close</button>
                            <button type='submit' class='btn btn-success'><span class='glyphicon glyphicon-save'></span> Save </button>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                   </form>

               <!--change password modal end here-->";
  else if($lebel == "department")
  $html="
   <!--Add department modal here-->

                    <!-- Modal -->
                   <form role='form' id='addinputhtml_department'>
                    <div class='modal fade' id='myDepartment' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                      <div class='modal-dialog'>
                        <div class='modal-content'>
                          <div class='modal-header addinputhtml_department_header'>
                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                            <h4 class='modal-title' id='myModalLabel'><span class='glyphicon glyphicon-plus'></span> Add Department  </h4>
                          </div>
                          
                          <div class='modal-body'>
                              <div class='form-group'>
                              <div class='msg'></div>
                              
                              </div>
                               
                              
                              <div class='form-group'>
                                <label for='exampleInputPassword1'> Depatment Name :</label>
                                <input type='text' class='form-control' id='department' placeholder='Enter a depatment name'>
                              </div>

                          </div>
                          <div class='modal-footer'>
                          <img class='loading_valid' src='".base_url()."/images/loading.gif'  style='display:none;' />
                            <button type='button' class='btn department-btn-close' data-dismiss='modal'>Close</button>
                            <button type='submit' class='btn btn-success'><span class='glyphicon glyphicon-save'></span> Save </button>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                   </form>

               <!--change password modal end here-->";
                 
               return $html;
}    
function updateInputHtml( $lebel="counter" ) {
 
 if($lebel == "counter")   
  $html="
   <!--Update counter modal here-->

                    <!-- Modal -->
                   <form role='form' id='updateinputhtml_counter'>
                    <div class='modal fade' id='myupdateCounter' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                      <div class='modal-dialog'>
                        <div class='modal-content'>
                          <div class='modal-header updateinputhtml_counter_header'>
                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                            <h4 class='modal-title' id='myModalLabel'><span class='glyphicon glyphicon-saved'></span> Update Counter  </h4>
                          </div>
                          
                          <input type='hidden' name='counterIDname' id='counterhiddenID' value='' /> 
                          
                          <div class='modal-body'>
                              <div class='form-group'>
                              <div class='msg'></div>
                              
                              </div>
                               
                              
                              <div class='form-group'>
                                <label for='exampleInputPassword1'> Counter Name :</label>
                                <input type='text' class='form-control' id='counter2' placeholder='Enter a counter name'>
                              </div>

                          </div>
                          <div class='modal-footer'>
                          <img class='loading_valid' src='".base_url()."/images/loading.gif'  style='display:none;' />
                            <button type='button' class='btn counter-btn-close' data-dismiss='modal'>Close</button>
                            <button type='submit' class='btn btn-warning'><span class='glyphicon glyphicon-save'></span> Update </button>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                   </form>

               <!--change password modal end here-->";
  else if($lebel == "department")
  $html="
   <!--Update department modal here-->

                    <!-- Modal -->
                   <form role='form' id='updateinputhtml_department'>
                    <div class='modal fade' id='myupdateDepartment' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                      <div class='modal-dialog'>
                        <div class='modal-content'>
                          <div class='modal-header updateinputhtml_counter_header'>
                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                            <h4 class='modal-title' id='myModalLabel'><span class='glyphicon glyphicon-saved'></span> Update Department  </h4>
                          </div>
                         
                          <div class='modal-body'>
                              <div class='form-group'>
                              <div class='msg'></div>
                              
                              </div>
                               
                              
                              <div class='form-group'>
                                <label for='exampleInputPassword1'> Depatment Name :</label>
                                <input type='text' class='form-control' id='department2' placeholder='Enter a depatment name'>
                              </div>

                          </div>
                          <div class='modal-footer'>
                          <img class='loading_valid' src='".base_url()."/images/loading.gif'  style='display:none;' />
                            <button type='button' class='btn department-btn-close' data-dismiss='modal'>Close</button>
                            <button type='submit' class='btn btn-warning'><span class='glyphicon glyphicon-save'></span> Update </button>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                   </form>

               <!--change password modal end here-->";
                 
               return $html;
}*/

/**
* function tinymce_encode($data)
* tiny mce encoding before inset into db
* @param mixed $data
*/

function tinymce_encode($data){
    
        $data = htmlspecialchars($data);
        $data = mysql_real_escape_string($data);
        return $data;    
}

/**
* function tinymce_decode($data)
* tiny mce decoding after fetching from db
* @param mixed $data
*/
function tinymce_decode($data){
    
        $data = htmlspecialchars_decode($data);
        return $data;    
}

function the_page_heading($title="Management",$breadcrumbtitle="client",$faicon="fa-users"){
?>
                    <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <i class="fa fa-fw <?php echo $faicon; ?>"></i> <?php echo $title; ?>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa <?php echo $faicon; ?>"></i> <?php echo $breadcrumbtitle; ?>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
<?php
}

function asMoney($value, $precision=2, $suffix='.',$ext='', $html_curr ='&#2547;') {
  return $html_curr.' '. number_format($value, $precision,$suffix,$ext);
}

function getRealIp() {
       if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  //check ip from share internet
         $ip=$_SERVER['HTTP_CLIENT_IP'];
       } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  //to check ip is pass from proxy
         $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
       } else {
           
         $ip=$_SERVER['REMOTE_ADDR'];
       
       }
       return $ip;
    }
    
function tohrdatetime($date) {
    //January 9, 2014 - 6:20 pm
       return date("F j, Y g:i a",strtotime($date));
}
function tohrdate($date) {
	//January 9, 2014 - 6:20 pm
	   return date("F j, Y",strtotime($date));
}

function current_url()
{
    $CI =& get_instance();

    $url = $CI->config->site_url($CI->uri->uri_string());
    return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
}


function makeHtmlEmail($to,$sub,$mess,$from )
{
//$headers  = "MIME-Version: 1.0\r\n"; 
//$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
//$headers .= "From: $from\r\n"; 
//mail($to, $sub, $mess, $headers);

//require 'PHPMailer/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
//$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "noreply@londonchurchillcollege.co.uk";
//Password to use for SMTP authentication
$mail->Password = "churchill1";
//Set who the message is to be sent from
$mail->setFrom('noreply@londonchurchillcollege.co.uk', 'London Churchill College');
//Set an alternative reply-to address
//$mail->addReplyTo('noreply@londonchurchillcollege.co.uk', 'First Last');
//Set who the message is to be sent to
$mail->addAddress($to);
//Set the subject line
$mail->Subject = $sub;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($mess);

$mail->send();


}


function makeHtmlEmailExtend($to,$sub,$mess,$from,$user,$pass,$host,$port,$encrypt,$authen,$com)
{


//require 'PHPMailer/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = $host;
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = intval($port);
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = $encrypt;
//Whether to use SMTP authentication
if($authen=="true") $mail->SMTPAuth = true; else $mail->SMTPAuth = false;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = $user;
//Password to use for SMTP authentication
$mail->Password = $pass;
//Set who the message is to be sent from
$mail->setFrom($user, $com);
//Set an alternative reply-to address
//$mail->addReplyTo('noreply@londonchurchillcollege.co.uk', 'First Last');
//Set who the message is to be sent to
$mail->addAddress($to);
//Set the subject line
$mail->Subject = $sub;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($mess);

$mail->send();


}





function makeRandom() { 
$salt = "abchef012ghjkmnpqrstuvwxyz345ABCDEFGHIJKLMN678OPQRSTUVWXYZ9"; 
srand((double)microtime()*1000000); 
$i = 0;
$pass=""; 
while ($i <= 9) { 
    $num = rand() % 33; 
    $tmp = substr($salt, $num, 1); 
    $pass = $pass . $tmp; 
    $i++; 
} 
return $pass; 
}

/**
* function return dates of the session dates
* 
* @param mixed $fromdate
* @param mixed $todate
* @param array $days
* @param mixed $t_f  teaching from date
* @param mixed $t_t  teaching to date
* @param mixed $r_f  revision from date
* @param mixed $r_t  revision to date
* @param mixed $s    submission date
* 
*/
function GetDatesOfRangefull($fromdate,$todate,$days,$t_f,$t_t,$r_f,$r_t,$s)
{

    $days_arr   = array('','Mon','Tue','Wed','Thu','Fri');
    $dates      = array();
    
    foreach($days as $v){
        
        $day            = $days_arr[$v];       
        $from_dt        = strtotime($fromdate); 
        $to_dt          = strtotime($todate); 
        $revise_from    = strtotime($r_f); 
        $revise_to      = strtotime($r_t); 
        $teach_from     = strtotime($t_f); 
        $teach_to       = strtotime($t_t); 
        $submit_dt      = strtotime($s);         
        
        for( $current_dt= $from_dt;$current_dt <= $to_dt; $current_dt+= 86400 ){
            
           $today = date('D',$current_dt);
           
           if($day == $today){

                    $date    = date('Y-m-d',$current_dt);
               if( ($current_dt >= $revise_from) && ($current_dt <= $revise_to) ) 
                    $dates[] = $date."|Revision"; 
               else if( ( $current_dt >= $teach_from ) && ( $current_dt <= $teach_to ) ) 
                    $dates[] = $date."|Teaching";
           } else {
                $date    = date('Y-m-d',$current_dt);
               if($current_dt == $submit_dt) 
                $dates[] = $date."|Submit";
           }    
        }

    }
    return $dates;
     
}
/**
* function return dates of the session dates
* 
* 
* @param mixed $fromdate
* @param mixed $todate
* @param array $days  array(1,2...)
*/
function GetDatesOfRange($fromdate,$todate,$days=array())
{

    $days_arr   = array('','Mon','Tue','Wed','Thu','Fri');
    $dates      = array();
    
    foreach($days as $v){
        
        $day    =  $days_arr[$v];
        $f      = strtotime($fromdate); $t = strtotime($todate);
        
        for($i=$f;$i<=$t;$i+=86400){
            
                $t_day  = date('D',$i);
           if($day == $t_day){
                $date    = date('Y-m-d',$i);
                $dates[] = $date;
           }
        }
    }
    return $dates;
     
}

function check_empty_value($value)
{
  if(isset($value)) {
    return (!empty($value)) ? $value : "";
  }
}


/**
* get table name and field name from html table
* [DATA=table-name]table-field-name[/DATA]
* 
* @param mixed $html
* @return array $lists matches list return otherwise False return.
* 
*/
function get_letter_data($html) {

  preg_match_all('/\[DATA=(.*?)\](.*?)\[\/DATA\]/', $html, $matches, PREG_SET_ORDER);

  $lists =array();
  $i=0;
  foreach ($matches as $val) {
      
      if(!isset($lists[$i])) {
      $lists[$i] =array();
      $lists[$i]=array_merge($lists[$i],array($val[1],$val[2]));
      } else
      $lists[$i]=array_merge($lists[$i],array($val[1],$val[2]));
    $i++;  
  }
  if(count($lists) > 0)
  return $lists; 
  else
  return false;

}  

?>