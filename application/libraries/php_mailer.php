<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Php_mailer {
    
    function __construct()
    {
        $CI = & get_instance();
        log_message('Debug', 'Phpmailer class is loaded.');

        include_once APPPATH.'/third_party/PHPMailer/PHPMailerAutoload.php';
            
    }
    function load() {
         
        return new PHPMailer();
    }
}
?>