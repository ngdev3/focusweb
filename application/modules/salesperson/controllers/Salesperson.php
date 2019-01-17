<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salesperson extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("salesperson_model");
    }

    public function index() {
        $this->load->view('salesperson_view');
    }

    function list_items() {
        
        $data['manager'] = $this->salesperson_model->get_manager_user();
        $data['coordinator']=$this->salesperson_model->getallsalescordinator();
        $data['title'] = "Sales Person List";
        $data['page_title'] = "Sales Person List";
        $data['page'] = "list_items";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Sales Person List" => base_url('salesperson/list_items'));
        _layout($data);
    }

    function list_items_ajax() {
        $res = $this->salesperson_model->list_items_ajax();

        echo json_encode($res);
    }

    function add() {
        $data['manager'] = $this->salesperson_model->get_manager_user();
        $data['static_coordinator'] = $this->salesperson_model->static_coordinator();
        
        $ins_id = $this->salesperson_model->last_id_get();
        $ins_ids = $ins_id->id + 1;
        $data['emp_id'] = "emp$ins_ids";
        
        $data['page_title'] = "Add Sales Person";
        $data['page'] = "add";
        $data['title'] = "Add Sales Person";

        $data['breadcrumb'] = array("Home" => base_url(), "Sales Person" => base_url('salesperson/list_items'), "Add Sales Person" => base_url('salesperson/add'));

        $this->form_validation->set_rules('employee_id', 'First Name', "trim|required|alpha_numeric");
        $this->form_validation->set_rules('fname', 'First Name', "trim|required|alpha");
        $this->form_validation->set_rules('lname', 'Last Name', "trim|required|alpha");
        $this->form_validation->set_rules('email', 'Email Id', 'trim|required|is_unique[users.email]|valid_email');
        $this->form_validation->set_rules("mobile", "Contact Number", "trim|required|min_length[10]|max_length[15]|numeric");
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        if(getUserInfos()->role == "0"){
        $this->form_validation->set_rules('manager_id', 'Manager', 'trim|required');
        }
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        if(getUserInfos()->role == "0"||getUserInfos()->role == "1"){
         $this->form_validation->set_rules('cordinator_id', 'Cordinator', 'trim|required');
        }
        //pr($_FILES);die;
        if ($this->form_validation->run() == TRUE) {
            $last_id = $this->salesperson_model->add();
            /* ****************Insert profile Pic ********************* */
            if (isset($_FILES['profile_image'])) {
                $this->upload_portfolio_image($_FILES['profile_image'], $last_id);
            }
            /* * ***********************Insert profile Pic ********************** */

            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Sales Person Added Successfully. "));
            redirect("salesperson/list_items?role=" . $_POST['role']);
        }
        _layout($data);
    }

    public function edit() {
        $id = ID_decode($this->uri->segment('3'));
        $data['res'] = $this->salesperson_model->viewData($id);

        $this->form_validation->set_rules('employee_id', 'First Name', "trim|required|alpha_numeric");
        $this->form_validation->set_rules('fname', 'First Name', "trim|required|alpha");
        $this->form_validation->set_rules('lname', 'Last Name', "trim|required|alpha");
        // $this->form_validation->set_rules('email','Email Id','trim|required|is_unique[users.email]|valid_email');
        // $this->form_validation->set_rules("mobile","Contact Number","trim|required|min_length[10]|max_length[15]|numeric");
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        if(getUserInfos()->role == "0"){
            $this->form_validation->set_rules('manager_id', 'Manager', 'trim|required');
            }
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            if(getUserInfos()->role == "0"||getUserInfos()->role == "1"){
             $this->form_validation->set_rules('cordinator_id', 'Cordinator', 'trim|required');
            }


        if ($this->form_validation->run() == TRUE) {
            $this->salesperson_model->edit($id);

            /*             * **********************Insert profile Pic ********************* */
            if (isset($_FILES['profile_image'])) {
                $this->upload_portfolio_image($_FILES['profile_image'], $id);
            }
            /*             * ***********************Insert profile Pic ********************** */



            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Sales Person Updated Successfully. "));
            redirect('salesperson/list_items');
        }
        $data['manager'] = $this->salesperson_model->get_manager_user();
        $data['static_coordinator'] = $this->salesperson_model->static_coordinator();
       
        $data['cordinator']  = $this->salesperson_model->getsalescordinator($data['res']->manager_id);
        $data['title'] = "Edit Sales Person";
        $data['page_title'] = "Edit Sales Person";
        $data['page'] = "add";
        $data['breadcrumb'] = array("Home" => base_url(), "Sales Person" => base_url('salesperson/list_items'), "Edit Sales Person" => "");
        _layout($data);
    }
    
    
    
	 public function target() {
        $id = ID_decode($this->uri->segment('3'));
        $data['res'] = $this->salesperson_model->viewData($id);
		
$data['manager']=getUserInfo($data['res']->manager_id);
$data['cordinator']=getUserInfo($data['res']->cordinator_id);
$data['view_target'] = $this->salesperson_model->view_target($id);
if(isPostBack()){
    
        $this->form_validation->set_rules('target_price', 'Target Price (INR)', "trim|required|numeric|greater_than_equal_to[1]");
        $this->form_validation->set_rules('target_product', 'Target Product', "trim|required|numeric|greater_than_equal_to[1]");
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
      



        if ($this->form_validation->run() == TRUE) {
        
            $result=$this->salesperson_model->target($id);
          //  pr($result);die;
            if($result=="update"){
                $this->session->set_flashdata("alert", array("c" => "s", "m" => "Target of Sales Person Updated Successfully. "));
          
            }else{
                $this->session->set_flashdata("alert", array("c" => "s", "m" => "Target of Sales Person Added Successfully. "));
         
            }
            

              redirect('salesperson/list_items');
        }
    }
        $data['title'] = "Set Target";
        $data['page_title'] = "Set Target";
        $data['page'] = "set_target";
        $data['breadcrumb'] = array("Home" => base_url(), "Sales Person" => base_url('salesperson/list_items'), "Set Target" => "");
        _layout($data);
    }
	
	
    
    
        public function view($id) {
        $id = ID_decode($id);
        if (!empty($id)) {
            $data['res'] = $this->salesperson_model->view($id);
            
            //pr($data);die;
            $data['title'] = 'View Sales Person';
            $data['page_title'] = 'View Sales Person';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Sales Person List" => base_url('salesperson/list_items'), "View Sales Person" => "");
          
            $data['page'] = "view";
            _layout($data);
        }
    }
    

    function delete() {
        $id = $_POST['id'];
        $res = $this->salesperson_model->delete($id);
        if ($res['status'] != "false") {

            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Sales Person Deleted Successfully. "));
            echo json_encode($res);
        } else {
            $this->session->set_flashdata("alert", array("c" => "d", "m" => "Sales Person Not Deleted Successfully !"));
            echo json_encode($res);
        }
    }

    public function delete_multiple() {
        $id = $_POST['ids'];

        $res = $this->salesperson_model->delete_multiple($id);
        if ($res == "true") {
            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Sales Person Deleted Successfully. "));
            echo json_encode($res);
        } else {
            $this->session->set_flashdata("alert", array("c" => "d", "m" => "Something Went Wrong ! "));
            echo json_encode($res);
        }
    }

    //*******************************Insert or update Profile Pic of Users*********//

    function upload_portfolio_image($files, $user_id) {
        $portfoliofilesCount = isset($files) && !empty($files) ? count($files['name']) : 0;
        $portfolio_images = $_FILES['profile_image'];

        //pr($_FILES['profile_image']);die;

        $portfoliofolderName = './uploads/profile_image/';


        for ($i = 0; $i < $portfoliofilesCount; $i++) {
            if (isset($portfolio_images['name'][$i]) && !empty($portfolio_images['name'][$i])) {
                $config['upload_path'] = $portfoliofolderName;
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['remove_spaces'] = true;
                $_FILES['profile_image']['name'] = $portfolio_images['name'][$i];
                $_FILES['profile_image']['type'] = $portfolio_images['type'][$i];
                $_FILES['profile_image']['tmp_name'] = $portfolio_images['tmp_name'][$i];
                $_FILES['profile_image']['error'] = $portfolio_images['error'][$i];
                $_FILES['profile_image']['size'] = $portfolio_images['name'][$i];

                $new_name = str_shuffle('qwedsghkirsr' . time());
                $config['file_name'] = $new_name;

                //print_r($new_name);die;
                $this->load->library('upload');
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('profile_image')) {
                    $data['status'] = 'error';
                    $data['message'] = $this->upload->display_errors();
                    echo json_encode($data);
                    exit;
                } else {
                    $upload_data = $this->upload->data();
                    $portfolioimage[$i] = $upload_data['file_name'];
                    $error = 0;
                }
                //==========Create Thumbnal 827X551===========//
                $folderName3 = './uploads/profile_image/';
                if (!is_dir($folderName3)) {
                    mkdir($folderName3, 0777, true);
                }
                $this->load->library('image_lib');
                $config3['source_image'] = "./uploads/profile_image/" . $upload_data['file_name'];
                $config3['maintain_ratio'] = false;
                $config3['overwrite'] = false;
                $config3['new_image'] = "./uploads/profile_image/" . $upload_data['file_name'];
                $config3['width'] = 500;
                $config3['height'] = 500;
                $this->image_lib->initialize($config3);
                $this->image_lib->resize();
                //==========Create Thumbnal 827X551===========//
                // Crop Image
                //==========Create Thumbnal 202X151===========//
                // $new_height1 = '214';
                //$new_width1 = $width / ($height / $new_height1);
                $folderName1 = './uploads/profile_image/medium/';
                if (!is_dir($folderName1)) {
                    mkdir($folderName1, 0777, true);
                }
                $this->load->library('image_lib'); //load library
                $config1['source_image'] = "./uploads/profile_image/" . $upload_data['file_name'];
                $config1['maintain_ratio'] = false;
                $config1['overwrite'] = false;
                //$config1['create_thumb']	=   true;
                $config1['new_image'] = "./uploads/profile_image/medium/" . $upload_data['file_name'];
                $config1['width'] = '375';
                $config1['height'] = '220';
                $this->image_lib->initialize($config1);
                $this->image_lib->resize();
                //==========Create Thumbnal 202X137===========//	
                // ENd here
                // Crop Image
                //==========Create Thumbnal 202X151===========//
                //$new_height1 = '480';
                //$new_width1 = $width / ($height / $new_height1);
                $folderName1 = './uploads/profile_image/small/';
                if (!is_dir($folderName1)) {
                    mkdir($folderName1, 0777, true);
                }
                $this->load->library('image_lib'); //load library
                $config2['source_image'] = "./uploads/profile_image/" . $upload_data['file_name'];
                $config2['maintain_ratio'] = false;
                $config2['overwrite'] = false;
                //$config1['create_thumb']	=   true;
                $config2['new_image'] = "./uploads/profile_image/small/" . $upload_data['file_name'];
                $config2['width'] = '289';
                $config2['height'] = '189';
                $this->image_lib->initialize($config2);
                $this->image_lib->resize();
                //==========Create Thumbnal 202X137===========//	
                // ENd here
            }
        }
        if (isset($portfolioimage) && !empty($portfolioimage)) {
            $this->salesperson_model->save_image($portfolioimage, $user_id);
        }
    }
    
   /***************get Sales Person *********************/
    
    
    
        public function getsalescordinator() {
       // $class_id = $_POST['class_id'];
        $manager_id = $_POST['manager_id'];
        $subData = $this->salesperson_model->getsalescordinator($manager_id);
        $output = '';
        if (!empty($subData)) {
            $output .= '<option value=""> Select Coordinator</option>';
            foreach ($subData as $type) {
                $output .= '<option value="' . $type->id . '">' . ucwords($type->fname) . ' ' . ucwords($type->lname) . '</option>';
            }
        } else {
            $output .= '<option value=""> No Coordinator Available</option>';
        }
        echo $output;
        exit;
    }

    
    
     /***************get Sales Person *********************/
    
    
    
        public function getsalesperson() {
        $cordinator_id = $_POST['cordinator_id'];
        $manager_id = $_POST['manager_id'];
        $subData = $this->salesperson_model->getsalesperson($manager_id,$cordinator_id);
        $output = '';
        if (!empty($subData)) {
            $output .= '<option value=""> Select Sales Person</option>';
            foreach ($subData as $type) {
                $output .= '<option value="' . $type->id . '">' . ucwords($type->fname) . ' ' . ucwords($type->lname) . '</option>';
            }
        } else {
            $output .= '<option value=""> No Sales Person Available</option>';
        }
        echo $output;
        exit;
    }
    
    
    
    
    /****************************Get Redirect Sales Person******************************/
    
    
        public function redirect_salesperson($id = "") {
        $data['ids'] = ID_decode($id);
        $data['coordinator']=getUserInfo(ID_decode($id));
        $data['manager']=getUserInfo($data['coordinator']->manager_id);
        $page = 'rediect_salesperson';
        $data['page'] = $page;
        
        $data['title'] = "Redirected Sales Person List";
        $data['page_title'] = "Redirected Sales Person List";
        if(getUserInfos()->role == "0"){
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Manager" => base_url('manager/list_items'), "Redirected Coordinator List" =>base_url('cordinator/redirect_cordinator/'.ID_encode($data['coordinator']->manager_id)), "Redirected Sales Person List" =>"");
        }
        if(getUserInfos()->role == "1"){

       $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Redirected Coordinator List" =>base_url('cordinator/redirect_cordinator/'.ID_encode($data['coordinator']->manager_id)), "Redirected Sales Person List" =>"");
      
        }
        
        _layout($data);
    }
    public function redirect_salesperson_ajax($ids = "") {
        $ids = ID_decode($ids);

        $res = $this->salesperson_model->redirect_salesperson_ajax($ids);
        echo json_encode($res);
    }

    
    
    
   /****************************Get Redirect Sales Person******************************/ 
}

/* End of file salesperson.php */
/* Location: ./application/modules/salesperson/controllers/salesperson.php */