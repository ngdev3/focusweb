<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//error_reporting(0);
class My_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->controller_name = $this->router->fetch_class();
        $this->allow_method_name = $this->router->fetch_method();
        $this->method_name = 'list_items';
        
        $allowed_methods = array(
            "profile",
            "invoice"            
        );

        if (!$this->input->is_ajax_request()) {
            $data = getUserPermissions();
//            pr($data); die;
            if ($data->id != "1" && $this->controller_name != "dashboard" && !in_array($this->allow_method_name,$allowed_methods)) {
                if(is_logged_in()){
                $res = has_permission($this->controller_name,$this->method_name);
                if(!$res){
                    redirect("auth/permission_denied");
                }
                }else{
                    redirect(base_url());
                }
            }
        }
    }

  
}

?>
