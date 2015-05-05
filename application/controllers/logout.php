<?php
   class Logout extends CI_Controller {
    
     function __construct() {
  
        parent::__construct();

      $this->load->model('login','', TRUE);
      $this->load->helper('form'); 
      $this->load->library('session'); 
     }        
   public function index()
    {  
       $this->session->sess_destroy(); 
       $this->login->unset_login();
       redirect(base_url().'index.php/login_controller/?l=1'); 
    }
}
?>