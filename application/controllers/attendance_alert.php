<?php
  
class Attendance_alert extends CI_Controller {   
    
   function __construct() {
  
        parent::__construct();

     
      $this->load->model('login','', TRUE);     
  
      $this->load->helper('functions');      
      $this->load->helper('form');      
      $this->load->library('session');        
      $this->load->model('dashboard');          
      $this->load->model('lcc_inbox');          
      $this->load->model('lcc_communication');          
      $this->load->model('student_data');          
      $this->load->model('attendance');          
      $this->load->model('register');          
      $this->load->model('student_data');          
      $this->load->model('course');
      $this->load->model('attendance_notify');
      //---------------------------------------- 1s          
      $this->load->model('agreement');          
      $this->load->model('money_receipt');          
      $this->load->model('register');          
      $this->load->model('student_data');
      $this->load->model('installment');
      $this->load->model('login');
      //---------------------------------------- end 1s          
}

public function index(){

    $data                       =   array(); 
    $menuleft                   =   array();
    $data["statements"]         =   array();
    $varsessioncheck_id         =   $this->session->userdata('uid');

    $label                      =   $this->session->userdata('label');        
    $data["fullname"]           =   $this->session->userdata('fullname');  
    $data['message']            =   "";
    $data['bodytitle']          =   "Attendance Alert";
    $data['breadcrumbtitle']    =   "Attendance > Attendance Alert";
    $data['faicon']             =   "fa-exclamation-triangle";


    //////////////////////////////////////////////////////        
    /// get staff access
    if($this->session->userdata('label')=="staff"){
              $staff_access = $this->login->getStaffAccess($this->session->userdata('uid'));                  
              if(!empty($staff_access['staff_privileges']['attendance_alert_management']) && count($staff_access['staff_privileges']['attendance_alert_management'])>0) $priv = $data['priv'] = $staff_access['staff_privileges']['attendance_alert_management'];                
              else{ $priv[0] = ""; }
    }        
    /////////////////////////////////////////////////////    
    // alert count part
    $data["alert_count"]                =   0;
    $data["inbox_alert_count"]          =   0;  
    $data["alert_count"]          = $this->lcc_inbox->get_alert_of_staff($varsessioncheck_id);  
    $data["inbox_alert_count"]    = $this->lcc_inbox->get_communication_alert_of_staff($varsessioncheck_id);  
    // alert count part end
    
      $data["summary_data"] = $this->dashboard->get_all_todays_count();
      $i                = 0;     

                
    if(!empty($varsessioncheck_id) && $label=="admin" || $label=="staff"){

        $absent_list = $this->attendance->get_attendance_by_attendance_type("A");
        //$absent_list = array_unique($absent_list);
        $clean_absent_list = array();
        if(isset($absent_list) && count($absent_list)>0)
        foreach ($absent_list as $key => $value) {
          // $clean_absent_list[] = $value['class_plan_id']."_".$value['register_id']; 
          $clean_absent_list[] = $value['register_id']; 
        }
        $clean_absent_list = array_unique($clean_absent_list);

        $absent_list_by_four_days = array();
        $absent_list_by_seven_days = array();
        $absent_list_by_ten_days = array();
        
        foreach ($clean_absent_list as $k => $v) {

          $absent_list_by_ten_days[$v]    = $this->attendance->get_absent_list_by_register_id($v, $limit = 10);



          $l = 0;
          foreach ($absent_list_by_ten_days[$v] as $xx => $yy) {
            if($l<7) {
              $absent_list_by_seven_days[$v][] = $yy;
            }
            if($l<4) {
              $absent_list_by_four_days[$v][] = $yy;
            }

          $l++;
          }
          

          //Get 10 absent days list.
          $ten = count($absent_list_by_ten_days[$v]);
          
          foreach ($absent_list_by_ten_days[$v] as $x => $y) {
            
            if($ten == 10) {

              if($y['attendance_type'] == "P") {
                unset($absent_list_by_ten_days[$v]);
              }
              
            } else {
              unset($absent_list_by_ten_days[$v]);
            }
            
         
          }


          //Get 7 absent days list.
          $seven = count($absent_list_by_seven_days[$v]);
          foreach ($absent_list_by_seven_days[$v] as $x => $y) {
            if($seven == 7) {

              if($y['attendance_type'] == "P") {
                unset($absent_list_by_seven_days[$v]);
              }
              
            } else {
              unset($absent_list_by_seven_days[$v]);
            }
            
          }


          //Get 4 absent days list.
          $four = count($absent_list_by_four_days[$v]);
          foreach ($absent_list_by_four_days[$v] as $x => $y) {
            if( $four == 4) {

              if($y['attendance_type'] == "P") {
                unset($absent_list_by_four_days[$v]);
              }

            } else {
                unset($absent_list_by_four_days[$v]);              
            }
            
          }


        }


        foreach ($absent_list_by_ten_days as $key => $value) {
          foreach ($absent_list_by_seven_days as $key7 => $value7) {
            if($key7 == $key) {
              
              unset($absent_list_by_seven_days[$key7]);
            }
            
          }
          foreach ($absent_list_by_four_days as $key4 => $value4) {
            if($key4 == $key) {
              
              unset($absent_list_by_four_days[$key4]);
            }
          }
        }

        foreach ($absent_list_by_seven_days as $key => $value) {
          foreach ($absent_list_by_four_days as $key4 => $value4) {
            if($key4 == $key) {
              
              unset($absent_list_by_four_days[$key4]);
            }
          }
        }


        $data['four_days_absent_list']    = $absent_list_by_four_days; 
        $data['seven_days_absent_list']   = $absent_list_by_seven_days; 
        $data['ten_days_absent_list']     = $absent_list_by_ten_days;


        $data['all_student'] = $this->register->get_all_ID();
        // var_dump($all_student); die();
        

        //var_dump($calculate_persentage); die();
       



//-------------------------------------------------------------------------------- 1s

	$today = time();
	//var_dump($today);
	
	$agreement_list = $this->agreement->get_all();
  $due_html = "<table class=\"table\">";
  $due_html .= "<tr>";
  $due_html .= "<th>Student ID</th>";
  $due_html .= "<th>SLC Course Code</th>";
  $due_html .= "<th>Year</th>";
  $due_html .= "<th>Due</th>";
  $due_html .= "<th>Due Date</th>";
	$due_html .= "</tr>";
	foreach($agreement_list as $v){
		
		$installment_list = $this->installment->get_by_agreement_id($v['id']);
		
		$money_receipt_data = $this->money_receipt->get_all_by_register_id_and_agreement_id($v['register_id'],$v['id']);
		
		$register_data = $this->register->get_by_ID($v['register_id']);
		if(!empty($register_data['student_data_id']))
    {
		  $student_data = $this->student_data->get_all_by_ID($register_data['student_data_id']);
      
    }
		
		$total = 0;
		
		foreach($money_receipt_data as $m){
			$chk_if_this_refund = $this->money_receipt->chk_if_refund($m['invoice_no'],$m['register_id']);
			if($m['payment_description']!="Refund" && $m['agreement_id']==$v['id'] && $m['active_payment']!="no") $total += $m['amount'];
		}
		
		$refund_data = $this->money_receipt->get_all_refund_by_register_id_and_agreement_id($v['register_id'],$v['id']);															
		$refund_amount = 0;
		if(!empty($refund_data) && $refund_data>0){
			foreach($refund_data as $c=>$d){

				$refund_amount += $d['amount'];				
				
			}
		}		
		
		//$t_amount = 0; 
		$due_remain = 0;
		
		foreach($installment_list as $d){
			//$t_amount += $d['amount'];
			if($today > strtotime($d['installment_date'])){ $due_remain+=$d['amount']; }	
		}
		
		//$due = $due_remain - $total;
		$due = $due_remain - $total + $refund_amount;
		//var_dump($due);
		//$due_html = "";
		if($due>0){
			$t_amount = 0;
			foreach($installment_list as $d){
				$t_amount += $d['amount'];
				if($today > strtotime($d['installment_date'])){ 
					if($total<$t_amount){ $last_installment_due_date = date("d-m-Y",strtotime($d['installment_date']));  } 
				}
			}
			if(!empty($register_data))
      {
  			$due_html .= "

              <tr>
                <td>".strtoupper($register_data['registration_no'])."</td>
                <td>".$v['slc_coursecode']."</td>
                <td>".$v['year']."</td>
                <td>".sprintf("%0.2f",$due)."</td>
                <td>".$last_installment_due_date."</td>

              </tr>
  				  

  				  	
  			";			
        
      }
		}
		
		
	}// foreach($agreement_list as $v){
	$due_html .= "</table>";
	//var_dump($due_html);
    $data['due_html'] = $due_html;


//-------------------------------------------------------------------------------- end 1s

        $data['staff_access'] = $this->login->getStaffAccess($this->session->userdata('uid'));




            
        $dasboard_data=array();    
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/attendance_alert_body');
        $this->load->view('staff/dashboard_footer');   
        
    } else if(!empty($varsessioncheck_id) && ( $label == "admin"  || $label == "staff" )) {
        redirect('/admin_dashboard/'); 
	}else if(!empty($varsessioncheck_id) && $label=="student" ){
	    redirect('/user_dashboard/');
	}else if(!empty($varsessioncheck_id) && $label=="registered" ){
	    redirect('/student_dashboard/');  
    }else{
        redirect('/logout/'); 
    }
    
    
       
} // end of index
   
}  
  
?>