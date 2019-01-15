<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

        public function __construct() {
            parent::__construct();
//            pr($this->load);
           $this->load->model("Dashboard_model");
        }
        
	public function index()
	{                    
            if(!is_logged_in()){                
                $this->load->view('auth/login');                
            }else{  
                
            //RFQ TOTAL
            $res=$this->session->userdata('userinfo');
            
            //For Super Admin
            
            $data['page_title'] = "Dashboard";
	    $data['title'] = "Dashboard";
            $data['page'] = "dashboard";
            $data['breadcrumb'] = array( "Dashboard"=>  base_url());
           
        
            _layout($data);
            }
	}
              
}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */
