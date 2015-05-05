<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class pdf {
   	public $param; 
    function __construct()
    {                              
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');

        include_once APPPATH.'/third_party/mpdf/mpdf.php';
        
    }
    function load() {
	   if ($this->param == NULL)
        {
            $this->param = '"en-GB-x","A4","11","",5,5,5,5,25,5';         
        }
         
        return new mPDF($this->param);
    }
}
?>
