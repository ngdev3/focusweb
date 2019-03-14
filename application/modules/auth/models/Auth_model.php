<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Auth_model extends CI_Model {    
    
    function __construct() {
        parent::__construct();
        $this->load->helper('string');

    }
     
   function forget_password() 
	{
		$data['email'] = $_POST['email'];
                
                $password=random_string('alnum', 7);
                
		$data['password'] =  md5($password);
		$whr['email'] = $_POST['email'];
		$this->db->update("users", $data, $whr);
		$data['cpassword'] =  $password;
                //echo $this->db->last_query();die;
		$subject = "Forgot Password";
		$body = $this->load->view("email_template/admin/forget_password",array("data"=>$data),true);
		sendMail($_POST['email'],$subject,$body);
    }

}

?>