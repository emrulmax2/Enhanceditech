<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forget_password extends CI_Controller {
    
   function __construct() {
  
        parent::__construct();                     
       $this->load->model('users','usermodle', TRUE);
       $this->load->model('staff','staffmodle', TRUE);
      $this->load->model('singletone','', TRUE);

         

}

    public function index()
    {
      if($_POST)
      { 
        // get the input from form
       $email=  $this->input->post('email');  
        // input in the function
       $this->singletone->check_email($email);
     
      } 

        $this->load->view('login_header');
        $this->load->view('forget_password');
        $this->load->view('login_footer');
    
    }

}
?>