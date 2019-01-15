<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
		
		
        parent::__construct();
       $this->load->model("auth_model");  
	   
    } 

    function index() {
		
        $this->login();
    }

    public function login() {
        if ($this->form_validation->run('auth/login') == TRUE) {            
            redirect("dashboard");                                    
        }
        $this->load->view('login');
    }

    public function logout() {
        $this->session->sess_destroy();
        $this->session->unset_userdata('userinfo');
        redirect();
    }          
    
    function permission_denied() {
        $data['title'] = 'Access Denied';
        $data['page_title'] = 'Access Denied';
        $data['page'] = 'access_denied';
        $data['subTitle'] = 'Access Denied';
        $data['breadcrumb'] = array("Home"=>  base_url());
        $views = 'access_denied';
//        pr($data); die;
      _layout($data);
    }
    
    function forget_password(){
        if($this->form_validation->run("auth/forget_password") == TRUE){
            //echo"jk";die;
            $this->auth_model->forget_password();
            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Password Send Successfully. "));
            redirect('auth/forget_password');  
        }  
        $this->load->view("forget_password");
    }
    
    
}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */