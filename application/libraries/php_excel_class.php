<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Php_excel_class {
    
    function __construct()
    {
        $CI = & get_instance();
        log_message('Debug', 'PhpExcel class is loaded.');

        include_once APPPATH.'/third_party/php_excel_class.php';
    
    }
    function load() {
         
        return new Excel_XML();
    }
}
?>