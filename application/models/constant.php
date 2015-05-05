<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class constant extends CI_Model {

    
    
    function __construct() {
  
        parent::__construct();
        $baseurl=$this->config->item('base_url');
        defined('JS_DIR_URL')? null : define('JS_DIR_URL', $baseurl.'js/');
        defined('CSS_DIR_URL')? null : define('CSS_DIR_URL', $baseurl.'css/');

        defined('OBJECT')? null :define( 'OBJECT', 'OBJECT', true );
        defined('OBJECT_K')? null :define( 'OBJECT_K', 'OBJECT_K' );
        defined('ARRAY_A')? null :define( 'ARRAY_A', 'ARRAY_A' );
        defined('ARRAY_N')? null :define( 'ARRAY_N', 'ARRAY_N' );
        
    } 
}
  
?>
