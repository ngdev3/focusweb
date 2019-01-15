<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manager extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("manager_model");
    }

    public function index() {
        $this->load->view('manager_view');
    }

    function list_items() {
        $data['title'] = "Sub-Admin (Branch Manager) List";
        $data['page_title'] = "Sub-Admin (Branch Manager) List";
        $data['page'] = "list_items";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Sub-Admin (Branch Manager) List" => base_url('manager/list_items'));
        _layout($data);
    }

    function list_items_ajax() {
        $res = $this->manager_model->list_items_ajax();

        echo json_encode($res);
    }

    function add() {
        $data['roles'] = $this->manager_model->get_manager();
        $ins_id = $this->manager_model->last_id_get();
        $ins_ids = $ins_id->id + 1;
        $data['emp_id'] = "emp$ins_ids";
        $data['location'] = get_where("pr_location", array("status" => "1", "is_deleted" => "0"));
        $data['page_title'] = "Add Sub-Admin (Branch Manager)";
        $data['page'] = "add";
        $data['title'] = "Add Sub-Admin (Branch Manager)";

        $data['breadcrumb'] = array("Home" => base_url(), "Sub-Admin (Branch Manager)" => base_url('manager/list_items'), "Add Sub-Admin (Branch Manager)" => base_url('manager/add'));

        $this->form_validation->set_rules('employee_id', 'First Name', "trim|required|alpha_numeric");
        $this->form_validation->set_rules('fname', 'First Name', "trim|required|alpha");
        $this->form_validation->set_rules('lname', 'Last Name', "trim|required|alpha");
        $this->form_validation->set_rules('email', 'Email Id', 'trim|required|is_unique[cz_users.email]|valid_email');
        $this->form_validation->set_rules("mobile", "Contact Number", "trim|required|min_length[10]|max_length[15]|numeric");
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('role', 'Manager', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('location_id', 'Location', 'trim|required');
        //pr($_FILES);die;
        if ($this->form_validation->run() == TRUE) {
            $last_id = $this->manager_model->add();
            /* ****************Insert profile Pic ********************* */
            if (isset($_FILES['profile_image'])) {
                $this->upload_portfolio_image($_FILES['profile_image'], $last_id);
            }
            /* * ***********************Insert profile Pic ********************** */

            $this->session->set_flashdata("alert", array("c" => "s", "m" => "User Added Successfully. "));
            redirect("manager/list_items?role=" . $_POST['role']);
        }
        _layout($data);
    }

    public function edit() {
        $id = ID_decode($this->uri->segment('3'));
        $data['res'] = $this->manager_model->viewData($id);

        $this->form_validation->set_rules('employee_id', 'First Name', "trim|required|alpha_numeric");
        $this->form_validation->set_rules('fname', 'First Name', "trim|required|alpha");
        $this->form_validation->set_rules('lname', 'Last Name', "trim|required|alpha");
        // $this->form_validation->set_rules('email','Email Id','trim|required|is_unique[cz_users.email]|valid_email');
        // $this->form_validation->set_rules("mobile","Contact Number","trim|required|min_length[10]|max_length[15]|numeric");
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('role', 'Manager', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('location_id', 'Location', 'trim|required');



        if ($this->form_validation->run() == TRUE) {
            $this->manager_model->edit($id);

            /*             * **********************Insert profile Pic ********************* */
            if (isset($_FILES['profile_image'])) {
                $this->upload_portfolio_image($_FILES['profile_image'], $id);
            }
            /*             * ***********************Insert profile Pic ********************** */



            $this->session->set_flashdata("alert", array("c" => "s", "m" => "User Updated Successfully. "));
            redirect('manager/list_items');
        }
        $data['roles'] = $this->manager_model->get_manager();
        $data['location'] = get_where("pr_location", array("status" => "1", "is_deleted" => "0"));

        $data['title'] = "Edit Sub-Admin (Branch Manager)";
        $data['page_title'] = "Edit Sub-Admin (Branch Manager)";
        $data['page'] = "add";
        $data['breadcrumb'] = array("Home" => base_url(), "Sub-Admin (Branch Manager)" => base_url('manager/list_items'), "Edit Sub-Admin (Branch Manager)" => "");
        _layout($data);
    }
    
    
    
    
    
        public function view($id) {
        $id = ID_decode($id);
        if (!empty($id)) {
            $data['res'] = $this->manager_model->view($id);
            
            //pr($data);die;
            $data['title'] = 'View Sub-Admin (Branch Manager)';
            $data['page_title'] = 'View Sub-Admin (Branch Manager)';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Sub-Admin (Branch Manager) List" => base_url('manager/list_items'), "View Sub-Admin (Branch Manager)" => "");
          
            $data['page'] = "view";
            _layout($data);
        }
    }
    

    function delete() {
        $id = $_POST['id'];
        $res = $this->manager_model->delete($id);
        if ($res['status'] != "false") {

            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Manager Deleted Successfully. "));
            echo json_encode($res);
        } else {
            $this->session->set_flashdata("alert", array("c" => "d", "m" => "Manager Not Deleted Successfully !"));
            echo json_encode($res);
        }
    }

    public function delete_multiple() {
        $id = $_POST['ids'];

        $res = $this->manager_model->delete_multiple($id);
        if ($res == "true") {
            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Manager Deleted Successfully. "));
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
            $this->manager_model->save_image($portfolioimage, $user_id);
        }
    }

}

/* End of file manager.php */
/* Location: ./application/modules/manager/controllers/manager.php */