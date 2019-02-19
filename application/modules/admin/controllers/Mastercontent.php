<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mastercontent extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("mastercontent_model");
    }

    public function index() {
        $this->listing();
    }

    function listing() {
        // die;
        $data['title'] = "Self Mastery Content Listing";
        $data['page_title'] = "Self Mastery Content Listing";
        $data['page'] = "mastercontent/list_items";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Self Mastery Content Listing" => base_url('admin/mastercontent/listing'));
        _layout($data);
    }

    function list_items_ajax() {
        $res = $this->mastercontent_model->list_items_ajax();
        echo json_encode($res);
    }
    

    function add() {
    //  pr($_POST); die;

        $data['page_title'] = "Add Self Mastery Content";
        $data['page'] = "mastercontent/add";
        $data['title'] = "Add Self Mastery Content";
        $data['category'] = $this->mastercontent_model->category();
        $data['breadcrumb'] = array("Dashboard" => base_url(), "Self Mastery Content Listing" => base_url('admin/mastercontent/listing'), "Add Self Mastery Content" => base_url('admin/mastercontent/add'));

        $this->form_validation->set_rules('category', 'Category', "trim|required");
        $this->form_validation->set_rules('content_title', 'Content Title', "trim|required");
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        if ($this->form_validation->run() == TRUE) {

            $last_id = $this->mastercontent_model->add();
            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Self Mastery Content Added Successfully. "));
            redirect("admin/mastercontent/listing");
        }
        _layout($data);
    }

    public function edit() {
        $id = ID_decode($this->uri->segment('4'));
        $data['res'] = $this->mastercontent_model->viewData($id);
        $data['category'] = $this->mastercontent_model->category();
        $this->form_validation->set_rules('category', 'Category', "trim|required");
        $this->form_validation->set_rules('content_title', 'Video Ttle', "trim|required");
        // $this->form_validation->set_rules('video_url', 'Video Url', "trim|required");
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $this->mastercontent_model->edit($id);

            /*             * **********************Insert profile Pic ********************* */
            if (isset($_FILES['profile_image'])) {
                $this->upload_portfolio_image($_FILES['profile_image'], $id);
            }
            /*             * ***********************Insert profile Pic ********************** */



            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Self Mastery Content Updated Successfully. "));
            redirect('admin/mastercontent/listing');
        }
   //     $data['roles'] = $this->mastercontent_model->get_backendteam();
      //  $data['location'] = get_where("pr_location", array("status" => "1", "is_deleted" => "0"));

        $data['title'] = "Edit Self Mastery Content";
        $data['page_title'] = "Edit Self Mastery Content";
        $data['page'] = "mastercontent/add";
        $data['breadcrumb'] = array("Dashboard" => base_url(), "Self Mastery Content Listing" => base_url('admin/mastercontent/listing'), "Edit Self Mastery Content" => "");
        _layout($data);
    }
    
    
    
    
    
        public function view($id) {
        $id = ID_decode($id);
        if (!empty($id)) {
            $data['res'] = $this->mastercontent_model->view($id);
            
            //pr($data);die;
            $data['title'] = 'View Self Mastery Content';
            $data['page_title'] = 'View Self Mastery Content';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Self Mastery Content Listing" => base_url('admin/mastercontent/list_items'), "View Self Mastery Content" => "");
          
            $data['page'] = "mastercontent/view";
            _layout($data);
        }
    }
    

    function delete() {
        $id = $_POST['id'];
        $res = $this->mastercontent_model->delete($id);
        if ($res['status'] != "false") {

            $this->session->set_flashdata("alert", array("c" => "s", "m" => "User Deleted Successfully. "));
            echo json_encode($res);
        } else {
            $this->session->set_flashdata("alert", array("c" => "d", "m" => "User Not Deleted Successfully !"));
            echo json_encode($res);
        }
    }
    function becomecoach() {
        $id = $_POST['id'];
        $res = $this->mastercontent_model->assign_coach($id);
        if ($res['status'] != "false") {

            $this->session->set_flashdata("alert", array("c" => "s", "m" => "User Converted Successfully. "));
            echo json_encode($res);
        } else {
            $this->session->set_flashdata("alert", array("c" => "d", "m" => "User Not Converted Successfully !"));
            echo json_encode($res);
        }
    }
    function becomeuser() {
        $id = $_POST['id'];
        $res = $this->mastercontent_model->assign_user($id);
        if ($res['status'] != "false") {

            $this->session->set_flashdata("alert", array("c" => "s", "m" => "User Converted Successfully. "));
            echo json_encode($res);
        } else {
            $this->session->set_flashdata("alert", array("c" => "d", "m" => "User Not Converted Successfully !"));
            echo json_encode($res);
        }
    }

    public function delete_multiple() {
        $id = $_POST['ids'];

        $res = $this->mastercontent_model->delete_multiple($id);
        if ($res == "true") {
            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Self Mastery Content Deleted Successfully. "));
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
            $this->mastercontent_model->save_image($portfolioimage, $user_id);
        }
    }

    function list_items_sales_quote() {
        $data['client'] = $this->manage_sales_order_model->getclient();
        $data['salesperson'] = $this->manage_sales_order_model->getsalesperson();
        $data['quote_age'] = $this->mastercontent_model->get_quote_age();

        $data['title'] = "Recieved Sales Quote";
        $data['page_title'] = "Recieved Sales Quote";
        $data['page'] = "list_items_sales_quote";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Recieved Sales Quote" => base_url('admin/mastercontent/list_items_sales_quote'));
        _layout($data);
    }

    function list_items_sales_quote_ajax() {
        $res = $this->mastercontent_model->list_items_sales_quote_ajax();

        echo json_encode($res);
    }
    
    public function view_sales_quote($id) {
        $id = ID_decode($id);
       
        if (!empty($id)) {
            $data['res'] = $this->mastercontent_model->view_sales_quote($id);
            $data['res']->rate=$this->mastercontent_model->getsales_quote_rate($id);
           // pr($data);
            $data['title'] = 'View Sales Quote';
            $data['page_title'] = 'View Sales Quote';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Recieved Sales Quote" => base_url('admin/mastercontent/list_items_sales_quote'), "View Sales Quote" => "");
          
            $data['page'] = "view_sales_quote";
            _layout($data);
        }
    }
    public function revised_sales_quote($id) {
        $id = ID_decode($id);
       
        if (!empty($id)) {
            $data['res'] = $this->mastercontent_model->view_sales_quote($id);
            $data['res']->rate=$this->mastercontent_model->getsales_quote_rate($id);
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
                  
                    $last_id = $this->mastercontent_model->sales_quote_details($id);
                   
                    if (isset($_FILES['specifications'])) {
                        $this->upload_specifications($_FILES['specifications']);
                    }
                  
                   //echo "done";die;
                    $this->session->set_flashdata("alert", array("c" => "s", "m" => "Sales Quote Details Added Successfully. "));
                    redirect("admin/mastercontent/list_items_sales_quote");
                }




            }

            $data['title'] = 'Send Sales Quote';
            $data['page_title'] = 'Send Sales Quote';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Recieved Sales Quote" => base_url('admin/mastercontent/list_items_sales_quote'), "Send Sales Quote" => "");
          
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
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Recieved Service Quote" => base_url('admin/mastercontent/list_items_service_quote'));
        _layout($data);
    }

    function list_items_service_quote_ajax() {
        $res = $this->mastercontent_model->list_items_service_quote_ajax();

        echo json_encode($res);
    }
    
    
    
     public function view_service_quote($id) {
        $id = ID_decode($id);
        
       
       
        if (!empty($id)) {
            $data['res'] = $this->mastercontent_model->view_service_quote($id);
            $data['product']=$this->mastercontent_model->view_service_quote_product($id);
            
            //pr($data);die;
            

            $data['title'] = 'View Service Quote';
            $data['page_title'] = 'View Service Quote';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Recieved Service Quote" => base_url('admin/mastercontent/list_items_service_quote'), "View Service Quote" => "");
          
            $data['page'] = "view_service_quote";
            _layout($data);
        }
    }
    public function send_service_quote($id) {
        $id = ID_decode($id);
        
       
       
        if (!empty($id)) {
            $data['res'] = $this->mastercontent_model->view_service_quote($id);
            $data['product']=$this->mastercontent_model->view_service_quote_product($id);
            
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
                    $last_id = $this->mastercontent_model->service_quote_details($id);
                    if (isset($_FILES['specifications'])) {
                        $this->upload_specifications($_FILES['specifications']);
                    }
                   //echo "done";die;
                    $this->session->set_flashdata("alert", array("c" => "s", "m" => "Service Quote Details Added Successfully. "));
                    redirect("admin/mastercontent/list_items_service_quote");
                }




            }

            $data['title'] = 'Send Service Quote';
            $data['page_title'] = 'Send Service Quote';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Recieved Service Quote" => base_url('admin/mastercontent/list_items_service_quote'), "Send Service Quote" => "");
          
            $data['page'] = "send_service_quote";
            _layout($data);
        }
    }

    

}

/* End of file backendteam.php */
/* Location: ./application/modules/backendteam/controllers/backendteam.php */