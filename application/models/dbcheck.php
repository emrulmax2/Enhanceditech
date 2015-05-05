<?php
//include_once APPPATH.'/third_party/mpdf/mpdf.php';
class Dbcheck extends CI_Model {

  // private $token_system; 
 private $first_time;   
    function __construct() {
  
        parent::__construct();
        $this->load->database();
        $this->load->model('fixidb','tables', TRUE);
        $this->db_table_create(); 
        $this->first_time =0;

}

private function db_table_create(){
 
    $tablename="";
    $this->db->db_select();

//---------------------------------------
// CREATE register TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->register}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->register){
       
    $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->register}` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `student_data_id` int(11) NOT NULL,
          `registration_no` varchar(100) NOT NULL,
          `registrtation_date` date NOT NULL,
          `class_startdate` date NOT NULL,
          `class_enddate` date NOT NULL,
          `student_type` enum('overseas','uk','') DEFAULT '',
          `mode` enum('full_time','part_time','') DEFAULT '',
          `ssn` varchar(100) NOT NULL,
          `student_photo` text NOT NULL,
          `proof_type` enum('passport','birth','driving','') DEFAULT '',
          `proof_id` varchar(100) NOT NULL,
          `proof_expiredate` date NOT NULL,
          `kin_name` varchar(100) NOT NULL,
          `kin_address` text NOT NULL,
          `kin_phone` varchar(100) NOT NULL,
          `kin_email` varchar(255) NOT NULL,
          `kin_relation` varchar(150) NOT NULL,
          `last_updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          `student_other_qualification` text NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;");
   }



//---------------------------------------
// CREATE email_issuing TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->email_issuing}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->email_issuing){
       
    $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->email_issuing}` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `student_data_id` int(11) NOT NULL,
          `subject` varchar(250) NOT NULL,
          `description` text NOT NULL,
          `issued_by` int(11) NOT NULL,
          `issued_date` date NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;");
   }



//---------------------------------------
// CREATE letter_issuing TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->letter_issuing}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->letter_issuing){
       
    $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->letter_issuing}` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `student_data_id` int(11) NOT NULL,
          `letter_id` int(11) NOT NULL,
          `signatory_id` int(11) NOT NULL,
          `issued_by` int(11) NOT NULL,
          `issued_date` date NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;");
   }


//---------------------------------------
// CREATE letter_set TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->letter_set}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->letter_set){
       
    $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->letter_set}` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `letter_type` varchar(250) NOT NULL,
          `letter_title` varchar(250) NOT NULL,
          `description` text NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;");
   }



//---------------------------------------
// CREATE signatory_set TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->signatory_set}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->signatory_set){
       
    $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->signatory_set}` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(150) NOT NULL,
          `post` varchar(150) NOT NULL,
          `sign_url` varchar(250) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;");
   }



//---------------------------------------
// CREATE sms_issuing TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->sms_issuing}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->sms_issuing){
       
    $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->sms_issuing}` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `student_data_id` int(11) NOT NULL,
          `phone` varchar(100) NOT NULL,
          `subject` varchar(250) NOT NULL,
          `description` text NOT NULL,
          `issued_by` int(11) NOT NULL,
          `issued_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;");
   }




//---------------------------------------
// CREATE modules TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->modules}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->modules){
       
    $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->modules}` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(150) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;");
   }



//---------------------------------------
// CREATE course_modules_relation TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->course_modules_relation}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->course_modules_relation){
       
    $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->course_modules_relation}` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `course_id` int(11) NOT NULL,
          `modules_id` int(11) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;");
   }


//---------------------------------------
// CREATE module_relation TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->module_relation}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->module_relation){
       
    $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->module_relation}` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `course_relation_id` int(11) NOT NULL,
          `course_modules_relation_id` int(11) NOT NULL,
          `group_id` int(11) NOT NULL,
          `class_days` varchar(100) NOT NULL,
          `time_start` varchar(10) NOT NULL,
          `time_end` varchar(10) NOT NULL,
          `teaching_week_from` date NOT NULL,
          `teaching_week_to` date NOT NULL,
          `revision_week_from` date NOT NULL,
          `revision_week_to` date NOT NULL,
          `submission_date` date NOT NULL,
          `module_tutor` varchar(100) NOT NULL,
          `room_no` varchar(100) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
   }


//---------------------------------------
// CREATE student_others_disabilities TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->student_others_disabilities}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->student_others_disabilities){
       
    $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->student_others_disabilities}` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(15) NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;");
   }

//---------------------------------------
// CREATE student_title TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->student_title}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->student_title){
       
    $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->student_title}` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(15) NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;");
   }

//---------------------------------------
// CREATE student_others_ethnicity TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->student_others_ethnicity}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->student_others_ethnicity){
       
    $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->student_others_ethnicity}` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;");
   }

//---------------------------------------
// CREATE student_marital_status TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->student_marital_status}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->student_marital_status){
       
    $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->student_marital_status}` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(50) NOT NULL,
       PRIMARY KEY (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;");
   }

//---------------------------------------
// CREATE student_gender TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->student_gender}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->student_gender){
       
    $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->student_gender}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;");
   }

//---------------------------------------
// CREATE agent TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->agent}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->agent){
       
    $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->agent}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agent_name` varchar(200) NOT NULL,
  `agent_nick_name` varchar(100) NOT NULL,
  `email_address` varchar(150) NOT NULL,
  `agent_mobile_number` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `agent_status` enum('active','inactive') NOT NULL,
  `last_login_datetime` varchar(50) NOT NULL,
  `last_login_ip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;");
   }

//---------------------------------------
// CREATE currency TABLE
//---------------------------------------
define('DIR_FS_CSV_PATH',APPPATH.'third_party/csv/');
//var_dump(DIR_FS_CSV_PATH);
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->currency}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->currency) {
       
    $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->currency}` (
	  id int(8) NOT NULL AUTO_INCREMENT,
	  currency_name varchar(100) NOT NULL,
	  currency_code varchar(10) NOT NULL,
	  currency_symbol varchar(10) NOT NULL,
	  symbol_position TINYINT(1) NOT NULL,
	  PRIMARY KEY currency_id (currency_id));");
	  
	$currency_file = DIR_FS_CSV_PATH."currency.csv";
	$currency_handel = fopen($currency_file, 'r');
	$theData = fgets($currency_handel);
	$i = 0;
	while (!feof($currency_handel)) { 
		
		$currency_data[] = fgets($currency_handel, 1024); 
		$currency_array = explode(",",$currency_data[$i]);
		$insert_currency = 'Insert into `'.$this->tables->currency.'` values("'.trim($currency_array[0]).'","'.trim($currency_array[1]).'","'.trim($currency_array[2]).'","'.trim($currency_array[3]).'","'.trim($currency_array[4]).'")';
		$this->db->query($insert_currency);
		$i++;
	}	 
	fclose($currency_handel);	  
	  

}
//---------------------------------------
// CREATE countries TABLE
//---------------------------------------

 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->countries}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->countries) {
       
    $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->countries}` (
		country_id int(8) NOT NULL AUTO_INCREMENT,
		country_name varchar(255) NOT NULL,
		iso_code_2 char(2) NOT NULL,
		iso_code_3 char(3) NOT NULL,
		PRIMARY KEY (country_id))");
	  
	$country_file = DIR_FS_CSV_PATH."country.csv";
	$country_handel = fopen($country_file, 'r');
	$theData = fgets($country_handel);
	$i = 0;
	while (!feof($country_handel)) { 
		$country_data[] = fgets($country_handel, 1024); 
		$country_array = explode(",",$country_data[$i]);
		$insert_country = 'Insert into `'.$this->tables->countries.'` values ("'.trim($country_array[0]).'","'.trim($country_array[1]).'","'.trim($country_array[2]).'","'.trim($country_array[3]).'")';
		$this->db->query($insert_country);
		$i++;
	}	 
	fclose($country_handel);	  
	  

}
//---------------------------------------
// CREATE zones TABLE
//---------------------------------------

 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->zones}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->zones) {
       
    $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->zones}` (
	  zones_id int(8) NOT NULL AUTO_INCREMENT,
	  country_id int(8) NOT NULL,
	  zone_code varchar(100) NOT NULL,
	  zone_name varchar(255) NOT NULL,
	  PRIMARY KEY zones_id (zones_id));");
	  
	$zones_file = DIR_FS_CSV_PATH."zones.csv";
	$zones_handel = fopen($zones_file, 'r');
	$theData = fgets($zones_handel);
	$i = 0;
	while (!feof($zones_handel)) { 
		$zones_data[] = fgets($zones_handel, 1024); 
		$zones_array = explode(",",$zones_data[$i]);
		$insert_zones = 'Insert into `'.$this->tables->zones.'` values("'.trim($zones_array[0]).'","'.trim($zones_array[1]).'","'.trim($zones_array[2]).'","'.trim($zones_array[3]).'")';
		$this->db->query($insert_zones);
		$i++;
	}	 
	fclose($zones_handel);  
	  

}
   
//---------------------------------------
// CREATE archive TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->archive}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->archive){
       
	$this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->archive}` (

	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `student_data_id` int(11) NOT NULL,
	  `staff_id` int(11) NOT NULL,
	  `archive_field_name` varchar(100) NOT NULL,
	  `archive_field_value` text NOT NULL,
	  `archive_field_previous_value` text NOT NULL,
	  `archive_change_datetime` varchar(50) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=366 ;");
   }   

   
  

   
   //---------------------------------------
// CREATE awarding_body TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->awarding_body}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->awarding_body){
       
		    $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->awarding_body}` (
			  `ID` int(11) NOT NULL AUTO_INCREMENT,
			  `name` varchar(250) NOT NULL,
			  PRIMARY KEY (`ID`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
   } 
   
   
   
//---------------------------------------
// CREATE communication TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->communication}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->communication){
       
       $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->communication}` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `student_data_id` int(11) NOT NULL,
		  `staff_id` varchar(15) NOT NULL,
		  `text` text NOT NULL,
		  `serial` int(11) NOT NULL,
		  `datetime` varchar(50) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=733 ;");

   }   


//---------------------------------------
// CREATE course TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->course}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->course){
       
       $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->course}` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `course_name` varchar(500) NOT NULL,
		  `semister` varchar(500) NOT NULL,
		  `course_status` enum('active','inactive') NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;" );
       
     
   } 
  
//---------------------------------------
// CREATE course_relation TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->course_relation}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->course_relation){
       
       $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->course_relation}` (
		  `ID` int(11) NOT NULL,
		  `course_id` int(11) NOT NULL,
		  `semester_id` int(11) NOT NULL,
		  `awarding_id` int(11) NOT NULL,
		  `duration` int(11) NOT NULL,
		  `degree_offered` text NOT NULL,
		  `pre_qualification` varchar(255) NOT NULL,
		  `available` set('overseas','uk','both') NOT NULL,
		  `admission_startdate_1` date NOT NULL,
		  `admission_enddate_1` date NOT NULL,
		  `fees_1` float NOT NULL,
		  `reg_fees_1` float NOT NULL,
		  `class_startdate_1` date NOT NULL,
		  `class_enddate_1` date NOT NULL,
		  `last_joiningdate_1` date NOT NULL,
		  `admission_startdate_2` date NOT NULL,
		  `admission_enddate_2` date NOT NULL,
		  `fees_2` float NOT NULL,
		  `reg_fees_2` float NOT NULL,
		  `class_startdate_2` date NOT NULL,
		  `class_enddate_2` date NOT NULL,
		  `last_joiningdate_2` date NOT NULL,
		  PRIMARY KEY (`ID`),
		  KEY `course_id` (`course_id`),
		  KEY `semester_id` (`semester_id`),
		  KEY `awarding_id` (`awarding_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

$this->first_time =2;

       
   }   
//---------------------------------------
// CREATE inbox TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->inbox}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->inbox){
       
       $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->inbox}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `communication_id` int(11) NOT NULL,
  `student_data_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `notification_type` enum('communication','review','exam') NOT NULL,
  `notification_from` enum('staff','student') NOT NULL,
  `notification_to` enum('staff','student') NOT NULL,
  `notification_to_staff_id` int(11) NOT NULL,
  `notification_checked` enum('yes','no') NOT NULL,
  `dt` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1046 ;");       

       
   }   

//---------------------------------------
// CREATE notes TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->notes}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->notes){
       
       $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->notes}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_data_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `datetime` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=777 ;");       

       
   }   

//---------------------------------------
// CREATE semister TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->semister}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->semister){
       
       $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->semister}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `semister_name` varchar(100) NOT NULL,
  `semister_status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;");       

       
   }   


//---------------------------------------
// CREATE settings TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->settings}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->settings){
       
       $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->settings}` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `college_terms` varchar(250) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;");       

      $this->db->query("INSERT INTO `{$this->tables->settings}` (`ID`, `company_name`, `address`, `phone`, `start_date`, `end_date`) VALUES
(1, 'London Churchill College', '116 CAVELL STREET,LONDON, E1 2JA, United Kingdom. ', '+44 (0) 2073771077', '2014-01-01', '2014-12-31','http://');");
 
   }   
   
//---------------------------------------
// CREATE staff TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->staff}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->staff){
       
       $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->staff}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_name` varchar(200) NOT NULL,
  `staff_nick_name` varchar(100) NOT NULL,
  `staff_type` enum('staff','admin') NOT NULL,
  `password` varchar(100) NOT NULL,
  `staff_status` enum('active','inactive') NOT NULL,
  `staff_email` varchar(150) NOT NULL,
  `staff_privileges_student_admission` varchar(500) NOT NULL,
  `staff_privileges_staff_management` varchar(500) NOT NULL,
  `staff_privileges_agent_management` varchar(500) NOT NULL,
  `staff_privileges_semister_management` varchar(500) NOT NULL,
  `staff_privileges_course_management` varchar(500) NOT NULL,
  `staff_privileges_report_management` varchar(500) NOT NULL,
  `staff_privileges_inbox_management` varchar(500) NOT NULL,
  `staff_privileges_exam_management` varchar(500) NOT NULL,
  `last_login_datetime` varchar(50) NOT NULL,
  `last_login_ip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;");       

       
   }   
   
//---------------------------------------
// CREATE staff_upload TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->staff_upload}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->staff_upload){
       
       $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->staff_upload}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filepath` varchar(500) NOT NULL,
  `filename` varchar(300) NOT NULL,
  `serial` int(11) NOT NULL,
  `student_data_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `datetime` varchar(100) NOT NULL,
  `check_hard_copy_doc` enum('yes','no') NOT NULL,
  `reason` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=729 ;");       

       
   }   
//---------------------------------------
// CREATE student_data TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->student_data}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->student_data){
       
       $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->student_data}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_application_reference_no` varchar(50) NOT NULL,
  `student_title` varchar(10) NOT NULL,
  `student_first_name` varchar(100) NOT NULL,
  `student_sur_name` varchar(100) NOT NULL,
  `student_date_of_birth` varchar(100) NOT NULL,
  `student_gender` enum('male','female') NOT NULL DEFAULT 'male',
  `student_nationality` varchar(100) NOT NULL,
  `student_country_of_birth` varchar(100) NOT NULL,
  `student_marital_status` enum('n/a','Single','Married','Divorced','Separated') NOT NULL DEFAULT 'n/a',
  `student_home_phone` varchar(20) NOT NULL,
  `student_mobile_phone` varchar(20) NOT NULL,
  `student_email` varchar(150) NOT NULL,
  `student_address_company_name` varchar(200) NOT NULL,
  `student_address_address_line_1` varchar(200) NOT NULL,
  `student_address_address_line_2` varchar(200) NOT NULL,
  `student_address_city` varchar(100) NOT NULL,
  `student_address_state_province_region` varchar(100) NOT NULL,
  `student_address_postal_zip_code` varchar(100) NOT NULL,
  `student_address_country` varchar(100) NOT NULL,
  `student_semister` varchar(100) NOT NULL,
  `student_course` varchar(500) NOT NULL,
  `student_funding_type` enum('n/a','Private','Funding Body','Sponsor','Student Loan','Other') NOT NULL,
  `student_funding_type_other` varchar(100) NOT NULL,
  `student_student_loan_applied_for_the_proposed_course` enum('yes','no','n/a') NOT NULL DEFAULT 'n/a',
  `student_already_in_receipt_of_funds` enum('yes','no','n/a') NOT NULL DEFAULT 'n/a',
  `student_educational_qualification_highest_academic_qualification` varchar(200) NOT NULL,
  `student_educational_qualification_awarding_body` varchar(200) NOT NULL,
  `student_educational_qualification_subjects` tinytext NOT NULL,
  `student_educational_qualification_results` varchar(100) NOT NULL,
  `student_educational_qualification_award_date` varchar(50) NOT NULL,
  `student_employment_history_current_employment_status` enum('n/a','Part Time','Fixed Term','Contractor','Consultant','Office Holder','Volunteer','Unemployed','Zero Hour','Seasonal','Agency or Temp') NOT NULL,
  `student_employment_history_company` tinytext NOT NULL,
  `student_employment_history_position` varchar(100) NOT NULL,
  `student_employment_history_end_date` varchar(50) NOT NULL,
  `student_employment_history_start_date` varchar(50) NOT NULL,
  `student_job_reference_contact_name` varchar(200) NOT NULL,
  `student_job_reference_position` varchar(200) NOT NULL,
  `student_job_reference_phone` varchar(50) NOT NULL,
  `student_job_reference_email` varchar(150) NOT NULL,
  `student_job_reference_company_name_address` tinytext NOT NULL,
  `student_others_disabilities` tinytext,
  `student_others_ethnicity` varchar(300) NOT NULL,
  `student_others_marketing_info_referred_by` enum('n/a','student_own','student_referred','agent_referred') NOT NULL DEFAULT 'n/a',
  `student_others_marketing_info_referred_name` varchar(200) NOT NULL,
  `student_others_marketing_info_referred_phone` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `student_admission_status` enum('none','Submitted','Review','Awaiting Documents','Processing','Accepted','Rejected','Discarded') NOT NULL DEFAULT 'none',
  `student_admission_status_for_staff` enum('none','New','Review','Awaiting Documents','Processing','Refer to academic department','Accepted','Rejected for review','Rejected','Discarded') NOT NULL DEFAULT 'none',
  `student_admission_status_review_staff_id` int(11) NOT NULL,
  `student_admission_status_rejected_reason` varchar(500) NOT NULL,
  `last_login_datetime` varchar(50) NOT NULL,
  `last_login_ip` varchar(50) NOT NULL,
  `student_app_submitted_datetime` varchar(50) NOT NULL,
  `student_app_submitted_ip` varchar(50) NOT NULL,
  `student_status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `agent_id` int(11) NOT NULL,
  `activate_session_id` varchar(100) NOT NULL,
  `send_exam` enum('no','yes') NOT NULL DEFAULT 'no',
  `exam_paper_sets_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=540 ;");       

       
   }   
//---------------------------------------
// CREATE student_upload TABLE
//---------------------------------------
 $get_table=$this->db->query("SHOW TABLES LIKE \"{$this->tables->student_upload}\"");    
 foreach($get_table->last_row() as $tablename);
    if($tablename != $this->tables->student_upload){
       
       $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->tables->student_upload}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filepath` varchar(300) NOT NULL,
  `serial` varchar(100) NOT NULL,
  `student_data_id` int(11) NOT NULL,
  `communication_serial` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;");       

       
   }   
//---------------------------------------
// CREATE foreign keys 
//---------------------------------------
 $get_table2=$this->db->query("SHOW TABLES LIKE \"{$this->tables->course_relation}\"");    
 $get_table3=$this->db->query("SHOW TABLES LIKE \"{$this->tables->course}\"");    
 $get_table4=$this->db->query("SHOW TABLES LIKE \"{$this->tables->semister}\"");    
 $get_table5=$this->db->query("SHOW TABLES LIKE \"{$this->tables->awarding_body}\"");  
 
 
 
   
 foreach($get_table2->last_row() as $tablename2);
 foreach($get_table3->last_row() as $tablename3);
 foreach($get_table4->last_row() as $tablename4);
 foreach($get_table5->last_row() as $tablename5);
    if( $tablename2 == $this->tables->course_relation && $tablename3 == $this->tables->course && $tablename4 == $this->tables->semister && $tablename5 == $this->tables->awarding_body && $this->first_time){
       
   
  $this->db->query("ALTER TABLE `course_relation`  ADD CONSTRAINT `course_relation_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`), ADD CONSTRAINT `course_relation_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semister` (`id`),  ADD CONSTRAINT `course_relation_ibfk_3` FOREIGN KEY (`awarding_id`) REFERENCES `awarding_body` (`ID`);");	   

       
   }   




















    
   } //end of db_table_create



}
?>