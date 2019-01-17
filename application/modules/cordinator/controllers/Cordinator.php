<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cordinator extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("cordinator_model");
    }

    public function index() {
        $this->load->view('cordinator_view');
    }

    function list_items() {
        $data['title'] = "Coordinator List";
        $data['page_title'] = "Coordinator List";
        $data['page'] = "list_items";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Coordinator List" => base_url('cordinator/list_items'));
        _layout($data);
    }

    function list_items_ajax() {
        $res = $this->cordinator_model->list_items_ajax();

        echo json_encode($res);
    }

    function add() {
        $data['manager'] = $this->cordinator_model->get_manager_user();
        $data['coordinator'] = $this->cordinator_model->get_coordinator_user();
        $ins_id = $this->cordinator_model->last_id_get();
        $ins_ids = $ins_id->id + 1;
        $data['emp_id'] = "emp$ins_ids";
        //pr($data);die;
      
        
        $data['page_title'] = "Add Coordinator";
        $data['page'] = "add";
        $data['title'] = "Add Coordinator";

        $data['breadcrumb'] = array("Home" => base_url(), "Coordinator" => base_url('cordinator/list_items'), "Add Coordinator" => base_url('cordinator/add'));

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
        $this->form_validation->set_rules('role', 'Coordinator', 'trim|required');
        
        //pr($_FILES);die;
        if ($this->form_validation->run() == TRUE) {
            $last_id = $this->cordinator_model->add();
            /* ****************Insert profile Pic ********************* */
            if (isset($_FILES['profile_image'])) {
                $this->upload_portfolio_image($_FILES['profile_image'], $last_id);
            }
            /* * ***********************Insert profile Pic ********************** */

            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Sales Coordinator Added Successfully. "));
            redirect("cordinator/list_items?role=" . $_POST['role']);
        }
        _layout($data);
    }

    public function edit() {
        $id = ID_decode($this->uri->segment('3'));
        $data['res'] = $this->cordinator_model->viewData($id);

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
        $this->form_validation->set_rules('role', 'Coordinator', 'trim|required');



        if ($this->form_validation->run() == TRUE) {
            $this->cordinator_model->edit($id);

            /*             * **********************Insert profile Pic ********************* */
            if (isset($_FILES['profile_image'])) {
                $this->upload_portfolio_image($_FILES['profile_image'], $id);
            }
            /*             * ***********************Insert profile Pic ********************** */



            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Sales Coordinator Updated Successfully. "));
            redirect('cordinator/list_items');
        }
        $data['manager'] = $this->cordinator_model->get_manager_user();
        $data['coordinator'] = $this->cordinator_model->get_coordinator_user();
        

        $data['title'] = "Edit Coordinator";
        $data['page_title'] = "Edit Coordinator";
        $data['page'] = "add";
        $data['breadcrumb'] = array("Home" => base_url(), "Coordinator" => base_url('cordinator/list_items'), "Edit Coordinator" => "");
        _layout($data);
    }
    
    
    
    
    
        public function view($id) {
        $id = ID_decode($id);
        if (!empty($id)) {
            $data['res'] = $this->cordinator_model->view($id);
            
            //pr($data);die;
            $data['title'] = 'View Coordinator';
            $data['page_title'] = 'View Coordinator';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Coordinator List" => base_url('cordinator/list_items'), "View Coordinator" => "");
          
            $data['page'] = "view";
            _layout($data);
        }
    }
    

    function delete() {
        $id = $_POST['id'];
        $res = $this->cordinator_model->delete($id);
        if ($res['status'] != "false") {

            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Coordinator Deleted Successfully. "));
            echo json_encode($res);
        } else {
            $this->session->set_flashdata("alert", array("c" => "d", "m" => "Coordinator Not Deleted Successfully !"));
            echo json_encode($res);
        }
    }

    public function delete_multiple() {
        $id = $_POST['ids'];

        $res = $this->cordinator_model->delete_multiple($id);
        if ($res == "true") {
            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Coordinator Deleted Successfully. "));
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
            $this->cordinator_model->save_image($portfolioimage, $user_id);
        }
    }
    
    
        
    /***************************Cordinator Redirected List****************************/
       public function redirect_cordinator($id = "") {
        $data['ids'] = ID_decode($id);
        $page = 'rediect_cordinator';
        $data['page'] = $page;
        
        $data['title'] = "Redirected Coordinator List";
        $data['page_title'] = "Redirected Coordinator List";
        if(getUserInfos()->role == "0"){
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Manager" => base_url('manager/list_items'), "Redirected Coordinator List" =>"");
        }
        if(getUserInfos()->role == "1"){

        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Redirected Coordinator List" =>"");
    
        }


        
        _layout($data);
    }
    public function redirect_cordinator_ajax($ids = "") {
        $ids = ID_decode($ids);

        $res = $this->cordinator_model->redirect_cordinator_ajax($ids);
        echo json_encode($res);
    }
        
    


}

/* End of file cordinator.php */
/* Location: ./application/modules/cordinator/controllers/cordinator.php */