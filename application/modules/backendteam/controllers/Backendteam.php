<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Backendteam extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("backendteam_model");
        $this->load->model("manage_sales_order/manage_sales_order_model");
         $this->load->model("manage_service_order/manage_service_order_model");
    }

    public function index() {
        $this->load->view('backendteam_view');
    }

    function list_items() {
        $data['title'] = "Backend Team List";
        $data['page_title'] = "Backend Team List";
        $data['page'] = "list_items";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Backend Team List" => base_url('backendteam/list_items'));
        _layout($data);
    }

    function list_items_ajax() {
        $res = $this->backendteam_model->list_items_ajax();

        echo json_encode($res);
    }
    

    function add() {
        $data['roles'] = $this->backendteam_model->get_backendteam();
        $ins_id = $this->backendteam_model->last_id_get();
        $ins_ids = $ins_id->id + 1;
        $data['emp_id'] = "emp$ins_ids";

        $data['location'] = get_where("pr_location", array("status" => "1", "is_deleted" => "0"));
        $data['page_title'] = "Add Backend Team";
        $data['page'] = "add";
        $data['title'] = "Add Backend Team";

        $data['breadcrumb'] = array("Home" => base_url(), "Backend Team" => base_url('backendteam/list_items'), "Add Backend Team" => base_url('backendteam/add'));

        $this->form_validation->set_rules('employee_id', 'First Name', "trim|required|alpha_numeric");
        $this->form_validation->set_rules('fname', 'First Name', "trim|required|alpha");
        $this->form_validation->set_rules('lname', 'Last Name', "trim|required|alpha");
        $this->form_validation->set_rules('email', 'Email Id', 'trim|required|is_unique[cz_users.email]|valid_email');
        $this->form_validation->set_rules("mobile", "Contact Number", "trim|required|min_length[10]|max_length[15]|numeric");
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
       // $this->form_validation->set_rules('role', 'Backendteam', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        //$this->form_validation->set_rules('location_id', 'Location', 'trim|required');
        //pr($_FILES);die;
        if ($this->form_validation->run() == TRUE) {
            $last_id = $this->backendteam_model->add();
            /* ****************Insert profile Pic ********************* */
            if (isset($_FILES['profile_image'])) {
                $this->upload_portfolio_image($_FILES['profile_image'], $last_id);
            }
            /* * ***********************Insert profile Pic ********************** */

            $this->session->set_flashdata("alert", array("c" => "s", "m" => "User Added Successfully. "));
            redirect("backendteam/list_items?role=" . $_POST['role']);
        }
        _layout($data);
    }

    public function edit() {
        $id = ID_decode($this->uri->segment('3'));
        $data['res'] = $this->backendteam_model->viewData($id);

        $this->form_validation->set_rules('employee_id', 'First Name', "trim|required|alpha_numeric");
        $this->form_validation->set_rules('fname', 'First Name', "trim|required|alpha");
        $this->form_validation->set_rules('lname', 'Last Name', "trim|required|alpha");
        // $this->form_validation->set_rules('email','Email Id','trim|required|is_unique[cz_users.email]|valid_email');
        // $this->form_validation->set_rules("mobile","Contact Number","trim|required|min_length[10]|max_length[15]|numeric");
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
       // $this->form_validation->set_rules('role', 'Backendteam', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        //$this->form_validation->set_rules('location_id', 'Location', 'trim|required');



        if ($this->form_validation->run() == TRUE) {
            $this->backendteam_model->edit($id);

            /*             * **********************Insert profile Pic ********************* */
            if (isset($_FILES['profile_image'])) {
                $this->upload_portfolio_image($_FILES['profile_image'], $id);
            }
            /*             * ***********************Insert profile Pic ********************** */



            $this->session->set_flashdata("alert", array("c" => "s", "m" => "User Updated Successfully. "));
            redirect('backendteam/list_items');
        }
        $data['roles'] = $this->backendteam_model->get_backendteam();
        $data['location'] = get_where("pr_location", array("status" => "1", "is_deleted" => "0"));

        $data['title'] = "Edit Backend Team";
        $data['page_title'] = "Edit Backend Team";
        $data['page'] = "add";
        $data['breadcrumb'] = array("Home" => base_url(), "Backend Team" => base_url('backendteam/list_items'), "Edit Backend Team" => "");
        _layout($data);
    }
    
    
    
    
    
        public function view($id) {
        $id = ID_decode($id);
        if (!empty($id)) {
            $data['res'] = $this->backendteam_model->view($id);
            
            //pr($data);die;
            $data['title'] = 'View Backend Team';
            $data['page_title'] = 'View Backend Team';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Backend Team List" => base_url('backendteam/list_items'), "View Backend Team" => "");
          
            $data['page'] = "view";
            _layout($data);
        }
    }
    

    function delete() {
        $id = $_POST['id'];
        $res = $this->backendteam_model->delete($id);
        if ($res['status'] != "false") {

            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Backendteam Deleted Successfully. "));
            echo json_encode($res);
        } else {
            $this->session->set_flashdata("alert", array("c" => "d", "m" => "Backendteam Not Deleted Successfully !"));
            echo json_encode($res);
        }
    }

    public function delete_multiple() {
        $id = $_POST['ids'];

        $res = $this->backendteam_model->delete_multiple($id);
        if ($res == "true") {
            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Backendteam Deleted Successfully. "));
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
            $this->backendteam_model->save_image($portfolioimage, $user_id);
        }
    }

    function list_items_sales_quote() {
        $data['client'] = $this->manage_sales_order_model->getclient();
        $data['salesperson'] = $this->manage_sales_order_model->getsalesperson();
        $data['quote_age'] = $this->backendteam_model->get_quote_age();

        $data['title'] = "Recieved Sales Quote";
        $data['page_title'] = "Recieved Sales Quote";
        $data['page'] = "list_items_sales_quote";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Recieved Sales Quote" => base_url('backendteam/list_items_sales_quote'));
        _layout($data);
    }

    function list_items_sales_quote_ajax() {
        $res = $this->backendteam_model->list_items_sales_quote_ajax();

        echo json_encode($res);
    }
    
    public function view_sales_quote($id) {
        $id = ID_decode($id);
       
        if (!empty($id)) {
            $data['res'] = $this->backendteam_model->view_sales_quote($id);
            $data['res']->rate=$this->backendteam_model->getsales_quote_rate($id);
           // pr($data);
            $data['title'] = 'View Sales Quote';
            $data['page_title'] = 'View Sales Quote';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Recieved Sales Quote" => base_url('backendteam/list_items_sales_quote'), "View Sales Quote" => "");
          
            $data['page'] = "view_sales_quote";
            _layout($data);
        }
    }
    public function revised_sales_quote($id) {
        $id = ID_decode($id);
       
        if (!empty($id)) {
            $data['res'] = $this->backendteam_model->view_sales_quote($id);
            $data['res']->rate=$this->backendteam_model->getsales_quote_rate($id);
            //pr($data);die;
            if(isPostBack()){
                $data['email_id'] = array();
                $email_id = $this->input->post('email_id');

                $this->form_validation->set_rules('send_quote', 'Quote', "trim|required|numeric");
                //$this->form_validation->set_rules('specifications', 'Specification', "required");
                foreach ($email_id as $ind => $val) {
                   
                   // $this->form_validation->set_rules("email_id[" . $ind . "]", 'Email ID', 'required');
                }
                // for ($i = 0; $i < count($email_id); $i++) {
                //     form_error("email_id[" . $i . "]");
                // }
                $data['email_val'] = $email_id;
                if($this->form_validation->run() == TRUE) {
                  
                    $last_id = $this->backendteam_model->sales_quote_details($id);
                   
                    if (isset($_FILES['specifications'])) {
                        $this->upload_specifications($_FILES['specifications']);
                    }
                  
                   //echo "done";die;
                    $this->session->set_flashdata("alert", array("c" => "s", "m" => "Sales Quote Details Added Successfully. "));
                    redirect("backendteam/list_items_sales_quote");
                }




            }

            $data['title'] = 'Send Sales Quote';
            $data['page_title'] = 'Send Sales Quote';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Recieved Sales Quote" => base_url('backendteam/list_items_sales_quote'), "Send Sales Quote" => "");
          
            $data['page'] = "send_sales_quote";
            _layout($data);
        }
    }



    function upload_specifications($files) {
        $portfoliofilesCount = isset($files) && !empty($files) ? count($files['name']) : 0;
        $portfolio_images = $_FILES['specifications'];

        //pr($_FILES['profile_image']);die;

        $portfoliofolderName = './uploads/profile_image/';


        for ($i = 0; $i < $portfoliofilesCount; $i++) {
            if (isset($portfolio_images['name'][$i]) && !empty($portfolio_images['name'][$i])) {
                $config['upload_path'] = $portfoliofolderName;
                $config['allowed_types'] = 'gif|jpg|jpeg|png|txt|xls|csv|doc|docx';
                $config['remove_spaces'] = true;
                $_FILES['profile_image']['name'] = $portfolio_images['name'][$i];
                $_FILES['profile_image']['type'] = $portfolio_images['type'][$i];
                $_FILES['profile_image']['tmp_name'] = $portfolio_images['tmp_name'][$i];
                $_FILES['profile_image']['error'] = $portfolio_images['error'][$i];
                $_FILES['profile_image']['size'] = $portfolio_images['name'][$i];

               // $new_name = str_shuffle('qwedsghkirsr' . time());
                $new_name =$_FILES['specifications']['name'];
                $config['file_name'] = $new_name;

                //print_r($new_name);die;
                $this->load->library('upload');
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('specifications')) {
                    $data['status'] = 'error';
                    $data['message'] = $this->upload->display_errors();
                    echo json_encode($data);
                    exit;
                } else {
                    $upload_data = $this->upload->data();
                    $portfolioimage[$i] = $upload_data['file_name'];
                    $error = 0;
                }
            }
        }
    }
    
    
    
    //Manage Service Quotes
    
    
    function list_items_service_quote() {
        $data['client'] = $this->manage_service_order_model->getclient();
        $data['serviceperson'] = $this->manage_service_order_model->getservice_person();
        
        //pr($data);die;
        $data['title'] = "Recieved Service Quote";
        $data['page_title'] = "Recieved Service Quote";
        $data['page'] = "list_items_service_quote";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Recieved Service Quote" => base_url('backendteam/list_items_service_quote'));
        _layout($data);
    }

    function list_items_service_quote_ajax() {
        $res = $this->backendteam_model->list_items_service_quote_ajax();

        echo json_encode($res);
    }
    
    
    
     public function view_service_quote($id) {
        $id = ID_decode($id);
        
       
       
        if (!empty($id)) {
            $data['res'] = $this->backendteam_model->view_service_quote($id);
            $data['product']=$this->backendteam_model->view_service_quote_product($id);
            
            //pr($data);die;
            

            $data['title'] = 'View Service Quote';
            $data['page_title'] = 'View Service Quote';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Recieved Service Quote" => base_url('backendteam/list_items_service_quote'), "View Service Quote" => "");
          
            $data['page'] = "view_service_quote";
            _layout($data);
        }
    }
    public function send_service_quote($id) {
        $id = ID_decode($id);
        
       
       
        if (!empty($id)) {
            $data['res'] = $this->backendteam_model->view_service_quote($id);
            $data['product']=$this->backendteam_model->view_service_quote_product($id);
            
            //pr($data);die;
            if(isPostBack()){
                $data['email_id'] = array();
                $email_id = $this->input->post('email_id');

                //$this->form_validation->set_rules('send_quote', 'Quote', "trim|required|numeric");
                //$this->form_validation->set_rules('specifications', 'Specification', "required");
                //foreach ($email_id as $ind => $val) {
                   
                   // $this->form_validation->set_rules("email_id[" . $ind . "]", 'Email ID', 'required');
                //}
                // for ($i = 0; $i < count($email_id); $i++) {
                //     form_error("email_id[" . $i . "]");
                // }
                $data['email_val'] = $email_id;
                //pr($_FILES);die;
                //pr($data['email_val']);die;
                if($_FILES) {
                    $last_id = $this->backendteam_model->service_quote_details($id);
                    if (isset($_FILES['specifications'])) {
                        $this->upload_specifications($_FILES['specifications']);
                    }
                   //echo "done";die;
                    $this->session->set_flashdata("alert", array("c" => "s", "m" => "Service Quote Details Added Successfully. "));
                    redirect("backendteam/list_items_service_quote");
                }




            }

            $data['title'] = 'Send Service Quote';
            $data['page_title'] = 'Send Service Quote';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Recieved Service Quote" => base_url('backendteam/list_items_service_quote'), "Send Service Quote" => "");
          
            $data['page'] = "send_service_quote";
            _layout($data);
        }
    }

    

}

/* End of file backendteam.php */
/* Location: ./application/modules/backendteam/controllers/backendteam.php */