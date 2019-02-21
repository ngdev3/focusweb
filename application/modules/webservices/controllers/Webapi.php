<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . 'libraries/webservices/REST_Controller.php';
require APPPATH . 'libraries/webservices/Message.php';
date_default_timezone_set('Asia/Kolkata');

/**
 * Webservices Controller
 * @author		Jitendra
 * @website		http://www.tekshapers.com
 * @company    Tekshapers Inc
 * @since		Version 1.0
 */
class Webapi extends REST_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model("Webapi_model");
        $this->load->library('session');
        $this->load->library('Form_validation');
        $this->load->helper('security');
        $this->load->library('image_lib');
        define("APIKEY", "focus_Lkjhg546dfhkduhrg43567");
        header('Access-Control-Allow-Origin: *');
    }

    /* ----------------------------------------------login----------------------------------------------- */

    public function login_post() {


        $this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required');
        $this->form_validation->set_rules('login_type', 'Login Type', 'trim|xss_clean|required');
        if ($this->form_validation->run() == TRUE) {
            $apikey = $this->input->post('apikey');


            if ($apikey == APIKEY) {
                $email = $this->security->xss_clean($this->input->post('email', true));
                $password = $this->security->xss_clean($this->input->post('password', true));
                $query = $this->Webapi_model->login($email);
               
                
                if(empty($query->profile_image)){
                    $query->profile_image="default.png";
                }
                
                
                // pr($query);die;
                if (!empty($query)) {
                    $password = md5($password);
                    if ($email == $query->email) {
                        if($password == $query->password)
                        {
                            if($query->status == 'active'){
                                
                                $upd['last_login']= current_datetime();
                                $upd['login_from']= $_POST['login_type'];

                                $this->db->where('id', $query->id);
                                $this->db->update('users', $upd);


                                $success = array('ErrorCode' => 0, "message" => "Success", 'data' => $query);
                                $this->response($success, 200);
                                
                            }else if($query->status == 'inactive'){
                                
                                $success = array('ErrorCode' => 1, 'message' => 'Your Account is Inactive! Contact Admin');
                                $this->response($success, 200);
                            }else{
                                $success = array('ErrorCode' => 1, 'message' => 'Your Account is Deleted! Contact Admin');
                                $this->response($success, 200);

                            }

                        } else {
                            $error = array('ErrorCode' => 1, 'message' => 'Wrong Password');
                            $this->response($error, 200);
                        }
                    }else {
                        $error = array('ErrorCode' => 1, 'message' => 'Invalid Email id');
                        $this->response($error, 200);
                    }
                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'User does not exist!');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => validation_errors());
            $this->response($error, 200);
        }
    }

    /* -------------------------------------------------login closed------------------------------------------------- */



    /* ---------------------------------------------Changed Password------------------------------------------------- */

    public function change_pwd_post() {
        $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|callback_passwordCheck');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('id', 'ID', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $apikey = $this->input->post('apikey');
            if ($apikey == APIKEY) {
                // if(){}
                if ($this->input->post("new_password", true)) {
                    $insertData['password'] = md5($this->input->post("new_password", true));
                    $insertData['updated_date'] = current_datetime();
                    // $insertData['cpassword'] = $this->input->post("new_password", true);
                }
                $id = $this->input->post("id", true);
                // pr($id);die;
                $this->Webapi_model->change_pwd($insertData, $id);
               
                $success = array('ErrorCode' => 0, "message" => "Password Changed Successfully !", 'data' => "1");
                $this->response($success, 200);
            } else {
                $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => validation_errors());
            $this->response($error, 200);
        }
    }

    /* -------------------------------------------------Change password closed------------------------------------------------- */




    /* ----------------------------------------------------Check Old Password-------------------------------------------------------------- */

    public function passwordCheck() {
        $id = $this->input->post("id", true);
        $md5pass = md5($this->input->post('old_password'));
        $results = $this->getOldPassword($id);
        $currentPass = $results->password;
        if ($md5pass == $currentPass) {
            return true;
        } else {
            $this->form_validation->set_message('passwordCheck', 'Invalid old password, please try again');
            return false;
        }
    }

    /* -----------------------------------------closed check Old Password-------------------------------------------- */




    /* ---------------------------------------------Get Old Password------------------------------------------------ */

    public function getOldPassword($id) {
        $result = $this->db->select('password')->where('id', $id)->get('users')->row();
        return $result;
    }

    /* -------------------------------------------------Get Old Password closed------------------------------------------------- */




    /* --------------------------------------------Forget  Password------------------------------------------------- */

    public function forgot_password_post() {
        $apikey = $this->input->post('apikey');
        $email = $this->input->post('email');
        if ($apikey == APIKEY) {


            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');


            if ($this->form_validation->run() == TRUE) {

                $gotdata = $this->Webapi_model->check_email($email);
                $gotemail = $gotdata->email;

                if (!empty($gotemail)) {

                    $a = rand(111111, 999999);
                    $this->Webapi_model->update_password($a, $gotemail);
                    $success = array('ErrorCode' => 0, "message" => "New Password Sent Successfully !", 'data' => "1");
                    $this->response($success, 200);
                } else {
                    $error = array('ErrorCode' => 1, "message" => "Email does not Exist", 'data' => "0");
                    $this->response($error, 200);
                }
            } else {

                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {

            $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
            $this->response($error, 200);
        }
    }

    /* ---------------------------------------Forget Password Closed--------------------------------------------- */




    /* ------------------------------------------Registration--------------------------------------------------- */

    public function register_post() {

        $apikey = $this->input->post('apikey');
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $mobile_no = $this->input->post('mobile_no');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if (isPostBack()) {

            $this->form_validation->set_rules('fname', 'First Name', "required|alpha");
            $this->form_validation->set_rules('lname', 'Last Name', "required|alpha");
            $this->form_validation->set_rules('email', 'Email id', 'required|is_unique[users.email]|valid_email');
            $this->form_validation->set_rules('mobile_no', 'Mobile no', 'required|min_length[8]|max_length[14]|numeric');
            $this->form_validation->set_rules('password', 'Password', 'required');

            // $this->form_validation->set_rules('admission_number', 'Admission no', 'required|is_unique[users.admission_number]');
            // $this->form_validation->set_rules('aadhar_no', 'Aadhar card no', 'required|min_length[12]|max_length[12]|is_unique[users.aadhar_no]|numeric');
            // $this->form_validation->set_rules('class_id', 'Class Name', 'required');
            // $this->form_validation->set_rules('section_id', 'Section Name', 'required');
            if ($this->form_validation->run()) {
                if ($apikey == APIKEY) {
                    $user_id = $this->Webapi_model->add();
                   
                    $success = array('ErrorCode' => 0, "message" => "Registration Successfully !", 'data' => "1");
                    $this->response($success, 200);
                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    /* ------------------------------------------Registration closed------------------------------------------------ */





    /* -----------------------------------------------View Profile------------------------------------------------- */

    public function profile_view_post() {

        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');

        if (isPostBack()) {
            $this->form_validation->set_rules('id', 'ID', 'trim|required|numeric');

            if ($this->form_validation->run()) {
                if ($apikey == APIKEY) {
                    $q = $this->Webapi_model->profile_get($id);

                    if (!empty($q)) {
                        $success = array('ErrorCode' => 0, "message" => "View Profile", 'data' => $q);
                        $this->response($success, 200);
                    } else {
                        $success = array('ErrorCode' => 1, "message" => "NO Data Found !");
                        $this->response($success, 200);
                    }
                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    /* --------------------------------------------View Profile closed----------------------------------------------- */




    /* -----------------------------------------------Edit Profile--------------------------------------------------- */

    public function profile_edit_post() {

        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');

        if (isPostBack()) {
            $this->form_validation->set_rules('id', 'ID', "required|numeric");
            $this->form_validation->set_rules('fname', 'First Name', "required|alpha");
            $this->form_validation->set_rules('lname', 'Last Name', "required|alpha");
            $this->form_validation->set_rules('father_mobile', 'Father Mobile no', 'required|min_length[8]|max_length[14]|numeric');
            $this->form_validation->set_rules('mother_mobile', 'Mother Mobile no', 'required|min_length[8]|max_length[14]|numeric');
            $this->form_validation->set_rules('aadhar_no', 'Aadhar card no', 'min_length[12]|max_length[12]|is_unique[users.aadhar_no]|numeric');
            $this->form_validation->set_rules('class_id', 'Class Name', 'required');
            $this->form_validation->set_rules('section_id', 'Section Name', 'required');
            if ($this->form_validation->run()) {
                if ($apikey == APIKEY) {
                    $this->Webapi_model->edit($id);

                    $success = array('ErrorCode' => 0, "message" => "Profile Edit Successfully !", 'data' => "1");
                    $this->response($success, 200);
                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    /* ------------------------------------------------Edit Profile closed----------------------------=--------------------- */




    /* -----------------------------------------------Get Class--------------------------------------------------- */

    public function get_backgound_color_post() {
        $apikey = $this->input->post('apikey');

        if ($apikey == APIKEY) {
            $abc = $this->Webapi_model->get_color();
            $success = array('ErrorCode' => 0, "message" => "Color Data", 'data' => $abc);
            $this->response($success, 200);
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
            $this->response($error, 200);
        }
    }

    /* -----------------------------------------------Get Class Closed--------------------------------------------- */

    //*************************************************Get Class Detail ****************************//


    public function upload_picture_post() {
    // pr($_FILES); 
        // pr($_POST); 
        // pr($_GET); 
//echo "dddd";
    //   die;

        $this->load->library('image_lib');
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('type');
        $user_id = $this->input->post('user_id');
        $user_type = $this->input->post('user_type');
       
        if (isPostBack()) {
            $this->form_validation->set_rules('type', 'Type', 'trim|required');
            $this->form_validation->set_rules('apikey', 'API Key', 'trim|required');
            $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');
            $this->form_validation->set_rules('user_type', 'User Type', 'trim|required');
          
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    if (!empty($_FILES['upload_image'])) {

            
        $dataInfo = array();
        $files = $_FILES;
        $cpt = count($_FILES['upload_image']['name']);
        
        $this->db->select('*');
        $this->db->from('f_temp_image_upload');
        $this->db->where('added_by',$user_id);
        $count = $this->db->get()->num_rows();
                        $total_length =  $count + $cpt;
        if(($total_length > 10)){
            $leftimg = 10 - $count;
           
            $success = array('ErrorCode' => 1, "message" => "You can Add Max ".$leftimg .' Images');
            $this->response($success, 200);
        }

        // die;
       
        for($i=0; $i<$cpt; $i++)
        {           echo $files['upload_image']['name'][$i];
            $_FILES['upload_image']['name']= $files['upload_image']['name'][$i];
            $_FILES['upload_image']['type']= $files['upload_image']['type'][$i];
            $_FILES['upload_image']['tmp_name']= $files['upload_image']['tmp_name'][$i];
            $_FILES['upload_image']['error']= $files['upload_image']['error'][$i];
            $_FILES['upload_image']['size']= $files['upload_image']['size'][$i];    


            $imageconfig['upload_path'] = 'uploads/temp_upload_images';
            $imageconfig['allowed_types'] = 'jpg|jpeg|png|gif';
            $imageconfig['encrypt_name'] = TRUE;
            $imageconfig['file_name'] = $_FILES['upload_image']['name'];

            //Load upload library and initialize configuration

            $this->load->library('upload', $imageconfig);
            $this->upload->initialize($imageconfig);
            $this->upload->do_upload('upload_image');
            
            $file_name = $dataInfo[$i]['file_name'];
            
            $dataInfo[] = $this->upload->data();

           // echo $this->upload->display_errors();

            $dataInfos[$i]['thumbnail_name'] = $dataInfo[$i]['raw_name'] . '_thumb' . $dataInfo[$i]['file_ext']; 
            $dataInfos[$i]['created_date'] = current_datetime();
            $dataInfos[$i]['file_name'] = $dataInfo[$i]['file_name'];
            $dataInfos[$i]['file_ext'] = $dataInfo[$i]['file_ext'];;
            $dataInfos[$i]['file_size'] = $dataInfo[$i]['file_size'];;
            $dataInfos[$i]['raw_name'] = $dataInfo[$i]['raw_name'];;
            $dataInfos[$i]['image_type'] = $dataInfo[$i]['image_type'];;
            $dataInfos[$i]['added_by'] = $user_id;
        }

       
                        if ($this->upload->data()) {           
                            
                            $data = $this->Webapi_model->profilepic($dataInfos);
                           
                            if (!empty($data)) {

                                $success = array('ErrorCode' => 0, "message" => "Success", 'data' => $data);
                                $this->response($success, 200);

                            } else {

                                $success = array('ErrorCode' => 1, "message" => "NO Data Found !");
                                $this->response($success, 200);
                            }
                        } else {
                            echo $this->upload->display_errors(); 
                            echo('Image Uploading Error');
                        }
                    } else {
                        echo "Image field is required";
                    }
                } else {
                    echo "471";
            die;
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                echo "475";
            die;
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            echo "479";
            die;
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }


    public function upload_banner_image_post()
    {
        header('Access-Control-Allow-Origin: *');
       /// pr($_FILES['file']); die;
        if (isset($_FILES['file']['tmp_name']) && !empty($_FILES['file']['tmp_name']))
            {
            $res = $this->Webapi_model->upload_banner_image();
            if ($res['status'] == 'success') {
                $success = array('responseCode' => '200', 'responseStatus' => 'success', 'data' => $res);
                $this->response($success, 200);
            } else {
                $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $res['msg']);
                $this->response($error, 200);
            }
        } else
            {
            $result['msg'] = "Image File not Found";
            $result['status'] = 'error';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $result);
            $this->response($error, 200);
        }
    }

    //**************************************************Get Class Detail Ends*****************************//


    public function get_vision_pics_post()
    {   
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');

        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            $this->form_validation->set_rules('typeofgoal', 'Type Goal', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->get_upload();
                    $success = array('ErrorCode' => 0, "message" => "Get Value From !", 'data' => $getdata);
                    $this->response($success, 200);

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }


    public function delete_vision_pics_post()
    {   
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');

        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            $this->form_validation->set_rules('typeofgoal', 'Type Goal', 'required');
            $this->form_validation->set_rules('id', 'Type Goal', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->delete_upload();
                    //pr($getdata); die;
                    if($getdata ){

                        $success = array('ErrorCode' => 0, "message" => "Image Deleted Successfully !", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Wrong Image", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    /* -----------------------------------------------Get Section--------------------------------------------------- */

    public function delete_all_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');
// die;
        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            $this->form_validation->set_rules('typeofgoal', 'Type Goal', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->delete_all_upload();
                    //pr($getdata); die;
                    if($getdata ){

                        $success = array('ErrorCode' => 0, "message" => "Image Deleted Successfully !", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "No Image Found", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }


    //My Vision add temp to active table
    public function upload_vision_post() {
        //Not compleetd YEt
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');

        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            $this->form_validation->set_rules('vision_title', 'Vision Title', 'required');
            $this->form_validation->set_rules('background_id', 'Background ID', 'required');
            $this->form_validation->set_rules('textforimage', 'Text of Image', 'required');
            $this->form_validation->set_rules('goal_date', 'Goal Date', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->upload_vision();
                    // pr($getdata); die;
                    if($getdata ){

                        $success = array('ErrorCode' => 0, "message" => "Image Deleted Successfully !", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "No Image Found", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }


    public function get_self_mastery_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');

        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            $this->form_validation->set_rules('typeofgoal', 'Type Goal', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->get_self_mastery();
                  //  pr($getdata); die;
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Data Found !", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Data No Found", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }
    public function get_business_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');

        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            $this->form_validation->set_rules('typeofgoal', 'Type Goal', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->get_business();
                    //pr($getdata); die;
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Data Found !", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Data No Found", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    public function get_focus_master_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');

        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->get_master_class();
                    //pr($getdata); die;
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Data Found !", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Data No Found", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }
    public function get_coaches_center_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');

        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->f_coaches_center();
                    //pr($getdata); die;
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Data Found !", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Data No Found", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }
    
    public function get_morning_focus_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');

        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->f_morning_focus();
                  //  pr($getdata); die;
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Data Found !", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Data No Found", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }
    public function get_focus_meetings_list_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');

        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->get_focus_meetings_list();
                //    pr($getdata); die;
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Data Found !", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Data No Found", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    public function get_weekly_list_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');

        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->get_weekly_list();
                //    pr($getdata); die;
                if(count($getdata) < 0){
                    $getdata = [];
                } 
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Data Found !", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Data No Found", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    public function get_days_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');

        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->get_days();
                //    pr($getdata); die;
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Data Found !", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Data No Found", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    public function get_plans_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');

        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->get_plans();
                //    pr($getdata); die;
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Data Found !", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Data No Found", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    public function get_pay_method_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');

        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->get_pay_method();
                //    pr($getdata); die;
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Data Found !", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Data No Found", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }
    
    public function get_focus_meetings_detail_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');

        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            $this->form_validation->set_rules('meeting_id', 'Meeting ID', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->get_meeting_details();
                  // pr($getdata); die;
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Data Found !", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Data No Found", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }


    public function get_weekly_detail_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');

        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            $this->form_validation->set_rules('weekly_id', 'Weekly Focus ID', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->get_weekly_details();
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Data Found !", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Data No Found", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    public function get_goal_detail_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');

        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            $this->form_validation->set_rules('goal_id', 'Goal ID', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->get_goal_detail();
                  // pr($getdata); die;
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Data Found !", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Data No Found", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }


    public function get_goal_list_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');

        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->get_goal_list();
                  // pr($getdata); die;
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Data Found !", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Data No Found", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    public function save_my_goal_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');
       // pr($_POST); die;
        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            $this->form_validation->set_rules('goal_name', 'Goal Name', 'required');
            $this->form_validation->set_rules('target_date', 'Target Date', 'required');
            $this->form_validation->set_rules('action_step_title[]', 'Step Title', 'required');
            $this->form_validation->set_rules('action_days[]', 'Set Days', 'required');
            $this->form_validation->set_rules('action_time[]', 'Set Time', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->save_my_goal();
                    //pr($getdata); die;
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Your Goal Saved Successfully", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Your Goal Not Saved", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    public function update_my_goal_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');
       // pr($_POST); die;
        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            $this->form_validation->set_rules('goal_id', 'Goal Id', 'required');
            $this->form_validation->set_rules('goal_name', 'Goal Name', 'required');
            $this->form_validation->set_rules('target_date', 'Target Date', 'required');
            $this->form_validation->set_rules('action_step_title[]', 'Step Title', 'required');
            $this->form_validation->set_rules('action_days[]', 'Set Days', 'required');
            $this->form_validation->set_rules('action_time[]', 'Set Time', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->update_my_goal();
                    //pr($getdata); die;
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Your Goal Updated Successfully", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Your Goal Not Saved", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }


    public function save_weekly_focus_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');
       // pr($_POST); die;
        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            $this->form_validation->set_rules('action_days[]', 'Set Days', 'required');
            $this->form_validation->set_rules('weekly_focus_title', 'Add Title ', 'required');
            $this->form_validation->set_rules('set_time', 'Set Time', 'required');
            $this->form_validation->set_rules('set_reminder', 'Set Reminder', 'required');
            $this->form_validation->set_rules('set_notification', 'Set Notification', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->save_weekly_focus();
                    //pr($getdata); die;
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Your Weekly Focus Saved Successfully", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Your Goal Not Saved", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    public function save_focus_meeting_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');
       // pr($_POST); die;
        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            $this->form_validation->set_rules('action_days[]', 'Set Days', 'required');
            $this->form_validation->set_rules('meeting_name', 'Add Meeting Name ', 'required');
            $this->form_validation->set_rules('meeting_goals[]', 'Add Meeting Goals ', 'required');
            $this->form_validation->set_rules('set_date', 'Set Date', 'required');
            $this->form_validation->set_rules('set_time', 'Set Time', 'required');
            $this->form_validation->set_rules('set_reminder', 'Set Reminder', 'required');
            $this->form_validation->set_rules('set_notification', 'Set Notification', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->save_focus_meeting();
                    //pr($getdata); die;
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Your Focus Meeting Saved Successfully", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Your Goal Not Saved", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    
    public function update_focus_meeting_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');
       // pr($_POST); die;
        if (isPostBack()) {
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            $this->form_validation->set_rules('action_days[]', 'Set Days', 'required');
            $this->form_validation->set_rules('meeting_name', 'Add Meeting Name ', 'required');
            $this->form_validation->set_rules('meeting_goals[]', 'Add Meeting Goals ', 'required');
            $this->form_validation->set_rules('set_date', 'Set Date', 'required');
            $this->form_validation->set_rules('set_time', 'Set Time', 'required');
            $this->form_validation->set_rules('set_reminder', 'Set Reminder', 'required');
            $this->form_validation->set_rules('set_notification', 'Set Notification', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->update_focus_meeting();
                    //pr($getdata); die;
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Your Focus Meeting Saved Successfully", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Your Goal Not Saved", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    public function update_weekly_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');
       // pr($_POST); die;
        if (isPostBack()) {
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            $this->form_validation->set_rules('weekly_id', 'Weekly ID', 'required');
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            $this->form_validation->set_rules('action_days[]', 'Set Days', 'required');
            $this->form_validation->set_rules('weekly_focus_title', 'Add Title ', 'required');
            $this->form_validation->set_rules('set_time', 'Set Time', 'required');
            $this->form_validation->set_rules('set_reminder', 'Set Reminder', 'required');
            $this->form_validation->set_rules('set_notification', 'Set Notification', 'required');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->update_weekly_focus();
                    //pr($getdata); die;
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Your Weekly Focus Updated Successfully", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Your Goal Not Saved", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    public function check_subscription_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');
        if (isPostBack()) {
            $this->form_validation->set_rules('user_id', 'User Id', 'required');
            $this->form_validation->set_rules('apikey', 'apikey', "required");
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $getdata = $this->Webapi_model->check_subscription();
                    pr($getdata); die;
                    if($getdata){

                        $success = array('ErrorCode' => 0, "message" => "Your Weekly Focus Updated Successfully", 'data' => $getdata);
                        $this->response($success, 200);
                    }else{
                        
                        $success = array('ErrorCode' => 1, "message" => "Your Goal Not Saved", 'data' => "");
                        $this->response($success, 200);
                    }

                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    /* -----------------------------------------------Get Section Closed--------------------------------------------- */




    /* -----------------------------------------------Get Subject--------------------------------------------------- */

    public function get_subject_post() {
        $apikey = $this->input->post('apikey');

        if ($apikey == APIKEY) {
            $abc = $this->Webapi_model->subject_view();
            $success = array('ErrorCode' => 0, "message" => "Subject Data !", 'data' => $abc);
            $this->response($success, 200);
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
            $this->response($error, 200);
        }
    }

    /* -----------------------------------------------Get Subject Closed--------------------------------------------- */




    /* -----------------------------------------------Get Chapter--------------------------------------------------- */

    public function get_chapter_post() {
        $apikey = $this->input->post('apikey');

        if ($apikey == APIKEY) {
            $abc = $this->Webapi_model->chapter_view();
            $success = array('ErrorCode' => 0, "message" => "Chapter Data !", 'data' => $abc);
            $this->response($success, 200);
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
            $this->response($error, 200);
        }
    }

    /* -----------------------------------------------Get Chapter Closed--------------------------------------------- */




    /* -----------------------------------------------Get Topic--------------------------------------------------- */

    public function get_topic_post() {
        $apikey = $this->input->post('apikey');

        if ($apikey == APIKEY) {
            $abc = $this->Webapi_model->topic_view();
            $success = array('ErrorCode' => 0, "message" => "Topic Data !", 'data' => $abc);
            $this->response($success, 200);
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
            $this->response($error, 200);
        }
    }

    /* -----------------------------------------------Get Topic Closed--------------------------------------------- */






    /* --------------------------------------------Subject From id------------------------------------------------- */

    public function subject_post() {
        $apikey = $this->input->post('apikey');



        if (isPostBack()) {
            $this->form_validation->set_rules('class_id', 'Class Name', 'trim|required|numeric');
            $this->form_validation->set_rules('section_id', 'Section Name', 'trim|required|numeric');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {
                    $class_id = $this->input->post('class_id');
                    $section_id = $this->input->post('section_id');
                    $data = $this->Webapi_model->student_subject($class_id, $section_id);

                    foreach ($data as $key => $vals) {
                        $total_chapter = $this->Webapi_model->get_chapters_name($vals->subject_id, $class_id, $section_id);

                        $data[$key]->chapter = count($total_chapter) . ' Chapters';
                    }



                    if (!empty($data)) {
                        $success = array('ErrorCode' => 0, "message" => "Success", 'data' => $data);
                        $this->response($success, 200);
                    } else {
                        $success = array('ErrorCode' => 1, "message" => "No subject found for your class!");
                        $this->response($success, 200);
                    }
                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    /* -------------------------------------------------Subject Closed----------------------------------------------------- */





    /* --------------------------------------------Chapter From subject id------------------------------------------------- */

    public function chapter_post() {
        $apikey = $this->input->post('apikey');
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $subject_id = $this->input->post('subject_id');



        if (isPostBack()) {
            $this->form_validation->set_rules('class_id', 'Class ID', 'trim|required|numeric');
            $this->form_validation->set_rules('section_id', 'Section ID', 'trim|required|numeric');
            $this->form_validation->set_rules('subject_id', 'Subject ID', 'trim|required|numeric');


            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $data['chapter'] = $this->Webapi_model->getchapter($class_id, $subject_id, $section_id);



                     foreach($data['chapter'] as $key=>$chapter){
						
						 
                      $data['chapter'][$key]->topics=$this->Webapi_model->gettopic($class_id,$subject_id,$section_id,$chapter->chapter_id);
                      $data['chapter'][$key]->assignment=$this->Webapi_model->get_assessment_list($class_id,$subject_id,$section_id,$chapter->chapter_id); 
                     
                    //   for video and url //

                    //   foreach( $data['chapter'][$key]->topics as $keys=>$topics){
                    //   if( $data['chapter'][$key]->topics[$keys]->video_name!=null && $data['chapter'][$key]->topics[$keys]->video_name!="" &&$data['chapter'][$key]->topics[$keys]->video_url==null){
                    //   $data['chapter'][$key]->topics[$keys]->video_name= base_url().'uploads/profile_image/'.$topics->video_name;
                    //   $data['chapter'][$key]->topics[$keys]->video_url="no urls";

                    //   }
                    //   else if($data['chapter'][$key]->topics[$keys]->video_url!=null && $data['chapter'][$key]->topics[$keys]->video_url!="" && $data['chapter'][$key]->topics[$keys]->video_name==null && $data['chapter'][$key]->topics[$keys]->video_name==""){
                    //     $data['chapter'][$key]->topics[$keys]->video_url= $topics->video_url;
                    //     $data['chapter'][$key]->topics[$keys]->video_name="no videos";
                    // }else{
                    //   $data['chapter'][$key]->topics[$keys]->video_name="no videos";
                    //   $data['chapter'][$key]->topics[$keys]->video_url="no urls";

                    //   }
                    //   }
                //     pr($data);die;
                //    // pr($assess);die;
                //     foreach($assess as $row=>$dat)
                //     {
                //         $topic_id_arr[]=explode(",",$dat->quiz_topic);
                //     }
                //     //pr($topic_id_arr);
                //       foreach($assess as $row=>$dat)
                //       {
                //           if($dat->quiz_type=="1")
                //           {
                //             $data['chapter'][$key]->topics[$key]->quiz_type_id="1";
                //             $data['chapter'][$key]->topics[$key]->quiz_type="QUIZ";
                //           }else if($dat->quiz_type=="2")
                //           {
                //             $data['chapter'][$key]->topics[$key]->quiz_type_id="2";
                //             $data['chapter'][$key]->topics[$key]->quiz_type="ASSESSMENT";
                //           }else if($dat->quiz_type=="3"){
                //             $data['chapter'][$key]->topics[$key]->quiz_type_id="3";
                //             $data['chapter'][$key]->topics[$key]->quiz_type="TEST";
                //           }else{
                //             $data['chapter'][$key]->topics[$key]->quiz_type=" ";
                //           }
                            
                //             $data['chapter'][$key]->topics[$key]->topic_id=$dat->id;
                //             $data['chapter'][$key]->topics[$key]->topic_name=$dat->quiz_title;
                //       }

                      }
                     
                     
                    //  pr($data);
                     
                    if (!empty($data)) {
                        $success = array('ErrorCode' => 0, "message" => "Success", 'data' =>$data);
                        $this->response($success, 200);
                    } else {
                        $success = array('ErrorCode' => 1, "message" => "NO Data Found !");
                        $this->response($success, 200);
                    }
                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    /* ---------------------------------------Chapter Closed--------------------------------------------- */


    /* --------------------------------------------Topic From subject id------------------------------------------------- */

    public function topic_post() {
        $apikey = $this->input->post('apikey');
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $subject_id = $this->input->post('subject_id');
        $chapter_id = $this->input->post('chapter_id');



        if (isPostBack()) {
            $this->form_validation->set_rules('class_id', 'Class ID', 'trim|required|numeric');
            $this->form_validation->set_rules('section_id', 'Section ID', 'trim|required|numeric');
            $this->form_validation->set_rules('subject_id', 'Subject ID', 'trim|required|numeric');
            $this->form_validation->set_rules('chapter_id', 'Chapter ID', 'trim|required|numeric');


            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $data['topic'] = $this->Webapi_model->gettopic($class_id, $subject_id, $section_id, $chapter_id);

                    //  pr($data['topic']);die;
                    //  pr($data['topic']);die;

                    foreach ($data['topic'] as $topic) {
                        if ($topic->video_name != "") {
                            $topic->video_name = base_url() . 'uploads/profile_image/' . $topic->video_name;
                        } else {
                            $topic->video_name = "no videos";
                        }
                    }



                    /*  foreach( $data['topic'][$key]->topics as $keys=>$topics){
                      if( $data['topic'][$key]->topics[$keys]->video_name){
                      $data['topic'][$key]->topics[$keys]->video_name= base_url().'uploads/profile_image/'.$topics->video_name;

                      }else{
                      $data['topic'][$key]->topics[$keys]->video_name="no videos";

                      }
                      }

                      } */





                    if (!empty($data)) {
                        $success = array('ErrorCode' => 0, "message" => "Success", 'data' => $data);
                        $this->response($success, 200);
                    } else {
                        $success = array('ErrorCode' => 1, "message" => "NO Data Found !");
                        $this->response($success, 200);
                    }
                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    /* ---------------------------------------Topic Closed--------------------------------------------- */


    /* --------------------------------------------Pages From id------------------------------------------------- */

    public function page_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');



        if (isPostBack()) {
            $this->form_validation->set_rules('id', 'ID', 'trim|required|numeric');


            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    $data['chapter'] = $this->Webapi_model->getpage($id);




                    if (!empty($data)) {
                        $success = array('ErrorCode' => 0, "message" => "Success", 'data' => $data);
                        $this->response($success, 200);
                    } else {
                        $success = array('ErrorCode' => 1, "message" => "NO Data Found !");
                        $this->response($success, 200);
                    }
                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    /* ---------------------------------------Pages Closed--------------------------------------------- */

    /* --------------------------------------------Profile pic From id------------------------------------------------- */

    public function profilepic_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');
        $profile_image = $_FILES['profile_image']['name'];

        if (isPostBack()) {
            $this->form_validation->set_rules('id', 'ID', 'trim|required|numeric|callback_id_check');

            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {

                    if (!empty($profile_image)) {
                        $new_name = str_replace(" ", "_", $profile_image);

                        $imageconfig['upload_path'] = 'uploads/profile_image';
                        $imageconfig['allowed_types'] = 'jpg|jpeg|png|gif';
                        $imageconfig['file_name'] = $new_name;

                        //Load upload library and initialize configuration

                        $this->load->library('upload', $imageconfig);
                        $this->upload->initialize($imageconfig);

                        if ($this->upload->do_upload('profile_image')) {
                            $uploadData = $this->upload->data();
                            $picture = $uploadData['file_name'];

                            $data = $this->Webapi_model->profilepic($id, $new_name);


                            if (!empty($data)) {
                                $success = array('ErrorCode' => 0, "message" => "Success", 'data' => $data);
                                $this->response($success, 200);
                            } else {
                                $success = array('ErrorCode' => 1, "message" => "NO Data Found !");
                                $this->response($success, 200);
                            }
                        } else {
                            echo('Image Uploading Error');
                        }
                    } else {
                        echo "Profile Image field is required";
                    }
                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    /* ---------------------------------------Profile pic update Closed--------------------------------------------- */




    /* ---------------------------------------callback Profile pic id check --------------------------------------------- */

    function id_check($id) {
        $idData = $this->Webapi_model->idexists($id);

        if (!empty($idData)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('id_check', 'The id field must contain an Existing Value.');

            return False;
        }
    }

    /* ---------------------------------------callback Profile pic id check Closed--------------------------------------------- */

    /*     * ****************************************Student Quiz Section Starts*********************** */

    public function quiz_post() {


        $apikey = $this->input->post('apikey');
        $quiz_id = $this->input->post('quiz_id');
        /* $section_id = $this->input->post('section_id');
          $subject_id = $this->input->post('subject_id');
          $chapter_id = $this->input->post('chapter_id');
          $quiz_topic_id = $this->input->post('topic_id');
         */

        if (isPostBack()) {
            /* $this->form_validation->set_rules('class_id', 'Class ID', 'trim|required|numeric');
              $this->form_validation->set_rules('section_id', 'Section ID', 'trim|required|numeric');
              $this->form_validation->set_rules('subject_id', 'Subject ID', 'trim|required|numeric');
              $this->form_validation->set_rules('chapter_id', 'Chapter ID', 'trim|required|numeric');
              $this->form_validation->set_rules('topic_id', 'Topic ID', 'trim|required|numeric');
             */

            $this->form_validation->set_rules('quiz_id', 'Quiz ID', 'trim|required|numeric');
            if ($this->form_validation->run()) {

                if ($apikey == APIKEY) {



                    $data['quiz'] = $this->Webapi_model->getquiz($quiz_id);

                    foreach ($data['quiz'] as $key => $quiz_question) {
                        $question = $quiz_question->quiz_question;
                        if ($question) {
                            $quiz_question->quiz_questions = $this->Webapi_model->getquestions($question);
                            foreach ($quiz_question->quiz_questions as $key => $quiz_questions) {



                                if ($quiz_questions->question_type == '9' || $quiz_questions->question_type == '10') {

                                    $quiz_questions->image = base_url() . '/uploads/profile_image/' . $quiz_questions->image;
                                }

                                $quiz_questions->options = $this->Webapi_model->get_question_data($quiz_questions->id, $quiz_questions->question_type);

                                if ($quiz_questions->question_type == '10') {
                                    foreach ($quiz_questions->options['option_data'] as $kyimg => $img_options) {

                                        $quiz_questions->options['option_data'][$kyimg]->answer = base_url() . '/uploads/profile_image/' . $img_options->answer;
                                    }
                                }
                            }
                        }
                    }
                    if (!empty($data)) {
                        $success = array('ErrorCode' => 0, "message" => "Success", 'data' => $data);
                        $this->response($success, 200);
                    } else {
                        $success = array('ErrorCode' => 1, "message" => "NO Data Found !");
                        $this->response($success, 200);
                    }
                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    /**     * ***************************************Student Quiz Section Ends*********************** */
    /*     * ***********************************Studnt Quiz Submit Starts****************************** */
    public function submit_quiz_post($id = "") {
        
        
        //pr($_POST);//die;
        
      
       
        
        
    
        header('Access-Control-Allow-Origin: *');

        //if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
         $apikey = $this->input->post('apikey');
         if (isPostBack()) {
           

            if ($apikey == APIKEY) {
                
            if ($_POST) {
                
                
                $quizatt_play['quiz_id'] = $id;
                $quizatt_play['student_id'] = $_POST['student_id'];
                $quizatt_play['attempt_date'] = date('Y-m-d');

                $this->db->insert('quiz_result', $quizatt_play);
           
                $quiz_palyed_id=$this->db->insert_id();
//pr($quiz_palyed_id);die;
    



            // array_filter($_POST['answer_multiple_question']);
            // pr( array_filter($_POST['answer_multiple_question']));die;

            $quiz_type = $_POST['quiz_type'];
            $id = $_POST['quiz_id'];



            $total_right_answer = array();
            $total_wrong_answer = array();
            $total_question = array();
            $total_attempted = array();
            $total_notattempted = array();

//******************************For multiple Choice Questions Starts************************************************//
            if ($_POST['answer_multiple_question']) {

                foreach (array_filter($_POST['answer_multiple_question']) as $question => $multiple_ans) {

                    $total_question[] = $question;

                    $multiple_question = $this->Webapi_model->get_multiple_choice_answer($question, '1');

                    $wright_answer = $multiple_question['answer_data']->id;
                    $student_answer = $multiple_ans;

                    $ins_multiple_choice['quiz_id'] = $id;
                    $ins_multiple_choice['student_id'] = $_POST['student_id'];
                    $ins_multiple_choice['question_type'] = '1'; //for multiple choice question
                    $ins_multiple_choice['quiz_type'] = $quiz_type; //for Quiz
                    $ins_multiple_choice['question_id'] = $question; //for Quiz
                    $ins_multiple_choice['question_answer_id'] = $wright_answer;

                    if ($student_answer != 'not_attempted') {
                        $ins_multiple_choice['student_answer_id'] = $multiple_ans;
                        $ins_multiple_choice['is_attempted'] = '1';
                        $total_attempted[] = $question;
                    } else {

                        $ins_multiple_choice['student_answer_id'] = "";
                        $ins_multiple_choice['is_attempted'] = '0';
                        $total_notattempted[] = $question;
                    }

                    if ($wright_answer == $student_answer) {
                        $ins_multiple_choice['is_right'] = '1';
                        $total_right_answer[] = $question;
                    } else {
                        $ins_multiple_choice['is_right'] = '0';
                        $total_wrong_answer[] = $question;
                    }
                    $ins_multiple_choice['quiz_played_id'] = $quiz_palyed_id;
                    $ins_multiple_choice['created_date'] = current_datetime();
                    
                    //pr($ins_multiple_choice); //die;

                    $this->db->insert('student_quiz_history', $ins_multiple_choice);

                    //echo $this->db->last_query();die;
                }
            }


            //die;
            //******************************For multiple Choice Questions Ends************************************************//
            //******************************Odd one out of 4 multiple Choice Questions starts************************************************//

            if ($_POST['answer_multiple_oddquestion']) {

                foreach (array_filter($_POST['answer_multiple_oddquestion']) as $question_odd => $multiple_ans_odd) {
                    $total_question[] = $question_odd;
                    $multiple_question_odd = $this->Webapi_model->get_multiple_choice_answer($question_odd, '4');

                    //pr($multiple_question_odd);die;

                    $wright_answer_odd = $multiple_question_odd['answer_data']->id;
                    $student_answer_odd = $multiple_ans_odd;

                    $ins_multiple_choice_odd['quiz_id'] = $id;
                    $ins_multiple_choice_odd['student_id'] = $_POST['student_id'];
                    $ins_multiple_choice_odd['question_type'] = '4'; //for multiple choice question
                    $ins_multiple_choice_odd['quiz_type'] = $quiz_type; //for Quiz
                    $ins_multiple_choice_odd['question_id'] = $question_odd; //for Quiz
                    $ins_multiple_choice_odd['question_answer_id'] = $wright_answer_odd;

                    if ($student_answer_odd != 'not_attempted') {
                        $ins_multiple_choice_odd['student_answer_id'] = $multiple_ans_odd;
                        $ins_multiple_choice_odd['is_attempted'] = '1';
                        $total_attempted[] = $question_odd;
                    } else {

                        $ins_multiple_choice_odd['student_answer_id'] = "";
                        $ins_multiple_choice_odd['is_attempted'] = '0';
                        $total_notattempted[] = $question_odd;
                    }

                    if ($wright_answer_odd == $student_answer_odd) {
                        $ins_multiple_choice_odd['is_right'] = '1';
                        $total_right_answer[] = $question_odd;
                    } else {
                        $ins_multiple_choice_odd['is_right'] = '0';
                        $total_wrong_answer[] = $question_odd;
                    }
                    $ins_multiple_choice_odd['created_date'] = current_datetime();
                    $ins_multiple_choice_odd['quiz_played_id'] = $quiz_palyed_id;
                    //pr($ins_multiple_choice_odd); //die;

                    $this->db->insert('student_quiz_history', $ins_multiple_choice_odd);

                    //echo $this->db->last_query();die;
                }
            }

            //******************************Odd one out of 4 multiple Choice Questions ends************************************************//
            //******************************Pic Question with Text Answer Starts************************************************//

            if ($_POST['answerpic_question']) {

                foreach (array_filter($_POST['answerpic_question']) as $question_pic => $multiple_ans_pic) {
                    $total_question[] = $question_pic;
                    $multiple_question_pic = $this->Webapi_model->get_multiple_choice_answer($question_pic, '9');

                    //pr($multiple_question_pic);die;

                    $wright_answer_pic = $multiple_question_pic['answer_data']->id;
                    $student_answer_pic = $multiple_ans_pic;

                    $ins_multiple_choice_pic['quiz_id'] = $id;
                    $ins_multiple_choice_pic['student_id'] = $_POST['student_id'];
                    $ins_multiple_choice_pic['question_type'] = '9'; //for multiple choice question
                    $ins_multiple_choice_pic['quiz_type'] = $quiz_type; //for Quiz
                    $ins_multiple_choice_pic['question_id'] = $question_pic; //for Quiz
                    $ins_multiple_choice_pic['question_answer_id'] = $wright_answer_pic;

                    if ($student_answer_pic != 'not_attempted') {
                        $ins_multiple_choice_pic['student_answer_id'] = $multiple_ans_pic;
                        $ins_multiple_choice_pic['is_attempted'] = '1';
                        $total_attempted[] = $question_pic;
                    } else {

                        $ins_multiple_choice_pic['student_answer_id'] = "";
                        $ins_multiple_choice_pic['is_attempted'] = '0';
                        $total_notattempted[] = $question_pic;
                    }

                    if ($wright_answer_pic == $student_answer_pic) {
                        $ins_multiple_choice_pic['is_right'] = '1';
                        $total_right_answer[] = $question_pic;
                    } else {
                        $ins_multiple_choice_pic['is_right'] = '0';
                        $total_wrong_answer[] = $question_pic;
                    }
                    $ins_multiple_choice_pic['created_date'] = current_datetime();
                     $ins_multiple_choice_pic['quiz_played_id'] = $quiz_palyed_id;
                    //pr($ins_multiple_choice_pic); //die;

                    $this->db->insert('student_quiz_history', $ins_multiple_choice_pic);

                    //echo $this->db->last_query();die;
                }
            }

            //******************************Pic Question with Text Answer ends************************************************//
            //******************************Pic Question with Picture Answer Starts************************************************//

            if ($_POST['answerpicimg_question']) {

                foreach (array_filter($_POST['answerpicimg_question']) as $question_picimg => $multiple_ans_picimg) {
                    $total_question[] = $question_picimg;
                    $multiple_question_picimg = $this->Webapi_model->get_multiple_choice_answer($question_picimg, '10');

                    //pr($multiple_question_picimg);die;

                    $wright_answer_picimg = $multiple_question_picimg['answer_data']->id;
                    $student_answer_picimg = $multiple_ans_picimg;

                    $ins_multiple_choice_picimg['quiz_id'] = $id;
                    $ins_multiple_choice_picimg['student_id'] = $_POST['student_id'];
                    $ins_multiple_choice_picimg['question_type'] = '10'; //for multiple choice question
                    $ins_multiple_choice_picimg['quiz_type'] = $quiz_type; //for Quiz
                    $ins_multiple_choice_picimg['question_id'] = $question_picimg; //for Quiz
                    $ins_multiple_choice_picimg['question_answer_id'] = $wright_answer_picimg;

                    if ($student_answer_picimg != 'not_attempted') {
                        $ins_multiple_choice_picimg['student_answer_id'] = $multiple_ans_picimg;
                        $ins_multiple_choice_picimg['is_attempted'] = '1';
                        $total_attempted[] = $question_picimg;
                    } else {

                        $ins_multiple_choice_picimg['student_answer_id'] = "";
                        $ins_multiple_choice_picimg['is_attempted'] = '0';
                        $total_notattempted[] = $question_picimg;
                    }

                    if ($wright_answer_picimg == $student_answer_picimg) {
                        $ins_multiple_choice_picimg['is_right'] = '1';
                        $total_right_answer[] = $question_picimg;
                    } else {
                        $ins_multiple_choice_picimg['is_right'] = '0';
                        $total_wrong_answer[] = $question_picimg;
                    }
                    $ins_multiple_choice_picimg['created_date'] = current_datetime();
                     $ins_multiple_choice_picimg['quiz_played_id'] = $quiz_palyed_id;
                    //pr($ins_multiple_choice_picimg); //die;

                    $this->db->insert('student_quiz_history', $ins_multiple_choice_picimg);

                    //echo $this->db->last_query();die;
                }
            }

            //******************************Pic Question with Picture Answer ends************************************************//
            //*******************************Fill in the blanks Starts********************************************************//

            if ($_POST['fill_answer']) {

                foreach (array_filter($_POST['fill_answer']) as $question_fill => $fill_ans) {
                    $total_question[] = $question_fill;
                    $fill_question = $this->Webapi_model->get_multiple_choice_answer($question_fill, '2');



                    $wright_answer_fill = $fill_question['answer_data']->id;
                    $wright_answer_fill_text = $fill_question['answer_data']->answer;
                    $student_answer_fill = $fill_ans;
                    
                    //echo trim(strtolower($student_answer_fill));
                    //echo trim(strtolower($wright_answer_fill_text));die;

                    $ins_fill['quiz_id'] = $id;
                    $ins_fill['student_id'] = $_POST['student_id'];
                    $ins_fill['question_type'] = '2'; //for multiple choice question
                    $ins_fill['quiz_type'] = $quiz_type; //for Quiz
                    $ins_fill['question_id'] = $question_fill; //for Quiz
                    $ins_fill['question_answer_id'] = $wright_answer_fill;

                    if (trim($student_answer_fill) != '') {
                        $ins_fill['answer_text'] = $fill_ans;
                        $ins_fill['is_attempted'] = '1';
                        $total_attempted[] = $question_fill;
                    } else {
                        $total_notattempted[] = $question_fill;
                        $ins_fill['answer_text'] = "";
                        $ins_fill['is_attempted'] = '0';
                    }

                    if (trim(strtolower($wright_answer_fill_text)) == trim(strtolower($student_answer_fill))) {
                        $total_right_answer[] = $question_fill;
                        $ins_fill['is_right'] = '1';
                    } else {
                        $ins_fill['is_right'] = '0';
                        $total_wrong_answer[] = $question_fill;
                    }
                    $ins_fill['created_date'] = current_datetime();
                    $ins_fill['quiz_played_id'] = $quiz_palyed_id;

                    //pr($ins_fill); //die;

                    $this->db->insert('student_quiz_history', $ins_fill);

                    //echo $this->db->last_query();die;
                }
            }



            //*******************************Fill in the blanks Ends********************************************************//
            //*******************************Rearrange sentences********************************************************//

            if ($_POST['rqsfill_answer']) {

                foreach (array_filter($_POST['rqsfill_answer']) as $question_rqsfill => $rqsfill_ans) {
                    $total_question[] = $question_rqsfill;
                    $rqsfill_question = $this->Webapi_model->get_multiple_choice_answer($question_rqsfill, '6');



                    $wright_answer_rqsfill = $rqsfill_question['answer_data']->id;
                    $wright_answer_rqsfill_text = $rqsfill_question['answer_data']->answer;
                    $student_answer_rqsfill = $rqsfill_ans;

                    $ins_rqsfill['quiz_id'] = $id;
                    $ins_rqsfill['student_id'] = $_POST['student_id'];
                    $ins_rqsfill['question_type'] = '6'; //for multiple choice question
                    $ins_rqsfill['quiz_type'] = $quiz_type; //for Quiz
                    $ins_rqsfill['question_id'] = $question_rqsfill; //for Quiz
                    $ins_rqsfill['question_answer_id'] = $wright_answer_rqsfill;

                    if (trim($student_answer_rqsfill) != '') {
                        $ins_rqsfill['answer_text'] = $rqsfill_ans;
                        $ins_rqsfill['is_attempted'] = '1';
                        $total_attempted[] = $question_rqsfill;
                    } else {
                        $total_notattempted[] = $question_rqsfill;
                        $ins_rqsfill['answer_text'] = "";
                        $ins_rqsfill['is_attempted'] = '0';
                    }

                    if (trim(strtolower($wright_answer_rqsfill_text)) == trim(strtolower($student_answer_rqsfill))) {
                        $ins_rqsfill['is_right'] = '1';
                        $total_right_answer[] = $question_rqsfill;
                    } else {
                        $ins_rqsfill['is_right'] = '0';
                        $total_wrong_answer[] = $question_rqsfill;
                    }
                    $ins_rqsfill['created_date'] = current_datetime();
                     $ins_rqsfill['quiz_played_id'] = $quiz_palyed_id;
                    //pr($ins_rqsfill); //die;

                    $this->db->insert('student_quiz_history', $ins_rqsfill);

                    //echo $this->db->last_query();die;
                }
            }



            //*******************************Rearrange sentences********************************************************//
            //*******************************Text Question Answer********************************************************//

            if ($_POST['tqsfill_answer']) {

                foreach (array_filter($_POST['tqsfill_answer']) as $question_tqsfill => $tqsfill_ans) {
                    $total_question[] = $question_tqsfill;
                    $tqsfill_question = $this->Webapi_model->get_multiple_choice_answer($question_tqsfill, '8');



                    $wright_answer_tqsfill = $tqsfill_question['answer_data']->id;
                    $wright_answer_tqsfill_text = $tqsfill_question['answer_data']->answer;
                    $student_answer_tqsfill = $tqsfill_ans;
                    
                    //echo $student_answer_tqsfill;die;

                    $ins_tqsfill['quiz_id'] = $id;
                    $ins_tqsfill['student_id'] = $_POST['student_id'];
                    $ins_tqsfill['question_type'] = '8'; //for multiple choice question
                    $ins_tqsfill['quiz_type'] = $quiz_type; //for Quiz
                    $ins_tqsfill['question_id'] = $question_tqsfill; //for Quiz
                    $ins_tqsfill['question_answer_id'] = $wright_answer_tqsfill;

                    if (trim($student_answer_tqsfill) != '') {
                        //echo "ddd";die;
                        $ins_tqsfill['answer_text'] = $tqsfill_ans;
                        $ins_tqsfill['is_attempted'] = '1';
                        $total_attempted[] = $question_tqsfill;
                    } else {
                       // echo "dddd11";die;
                        $total_notattempted[] = $question_tqsfill;
                        $ins_tqsfill['answer_text'] = "";
                        $ins_tqsfill['is_attempted'] = '0';
                    }

                    if (trim(strtolower($wright_answer_tqsfill_text)) == trim(strtolower($student_answer_tqsfill))) {
                        $ins_tqsfill['is_right'] = '1';
                        $total_right_answer[] = $question_tqsfill;
                    } else {
                        $ins_tqsfill['is_right'] = '0';
                        $total_wrong_answer[] = $question_tqsfill;
                    }
                    $ins_tqsfill['created_date'] = current_datetime();
                      $ins_tqsfill['quiz_played_id'] = $quiz_palyed_id;
                    // pr($ins_tqsfill); //die;

                    $this->db->insert('student_quiz_history', $ins_tqsfill);

                    //echo $this->db->last_query();die;
                }
            }



            //*******************************Text Question Answer********************************************************//
            //******************************True & False Question Answer Starts******************************************//

            //pr(array_filter($_POST['true_answer']));die;
            
            if ($_POST['true_answer']) {

                foreach (array_filter($_POST['true_answer']) as $question_truefalse => $true_ans) {
                    if($true_ans=="2"){
                      $true_ans="0";  
                    }
                    
                   
                    
                    $total_question[] = $question_truefalse;
                    $truefalse_question = $this->Webapi_model->get_multiple_choice_answer($question_truefalse, '3');



                    $wright_answer_truefalse = $truefalse_question['answer_data']->answer;

                    $student_answer_truefalse = $true_ans;

                    $ins_truefalse['quiz_id'] = $id;
                    $ins_truefalse['student_id'] = $_POST['student_id'];
                    $ins_truefalse['question_type'] = '3'; //for multiple choice question
                    $ins_truefalse['quiz_type'] = $quiz_type; //for Quiz
                    $ins_truefalse['question_id'] = $question_truefalse; //for Quiz
                    $ins_truefalse['question_answer_id'] = $wright_answer_truefalse;

                    if ($student_answer_truefalse != 'not_attempted') {
                        $ins_truefalse['student_answer_id'] = $true_ans;
                        $ins_truefalse['is_attempted'] = '1';
                        $total_attempted[] = $question_truefalse;
                    } else {
                        $total_notattempted[] = $question_truefalse;
                        $ins_truefalse['student_answer_id'] = "";
                        $ins_truefalse['is_attempted'] = '0';
                    }

                    if ($wright_answer_truefalse == $student_answer_truefalse) {
                        $ins_truefalse['is_right'] = '1';
                        $total_right_answer[] = $question_truefalse;
                    } else {
                        $ins_truefalse['is_right'] = '0';
                        $total_wrong_answer[] = $question_truefalse;
                    }
                    $ins_truefalse['created_date'] = current_datetime();
                    $ins_truefalse['quiz_played_id'] = $quiz_palyed_id;
                    //pr($ins_truefalse); //die;

                    $this->db->insert('student_quiz_history', $ins_truefalse);

                    //echo $this->db->last_query();die;
                }
            }


            //**************************************Match the Column start****************************************//

            if ($_POST['match_question_option']) {
                
                //pr($_POST);die;
 //pr(array_filter($_POST['match_question_option']));

//die;
                $i = 0;
                foreach (array_filter($_POST['match_question_option']) as $match_question => $match_options) {
                    if(array_filter($match_options)){
                        
                       // pr(array_filter($match_options));//die;
                   
                    $total_question[] = $match_question;

                    //Check the option key Positions
//                    $m = 1;
//                    foreach ($match_options as $key => $myvalue) {
//
//                        $match_options_key[$key] = $m;
//                        $m++;
//                    }
                    //Check the Suffle Anwer order    
                    $match_answer_order = array_filter($_POST['match_question_answer'][$match_question]);
                    
                   // pr($match_answer_order);//die;

                    //Check the user answer order   
                    $match_question_user_answer =  array_filter($_POST['match_question_user_answer'][$match_question]);
                    $match_question_answer_position = array_filter($_POST['match_question_answer_position'][$match_question]);

                    //pr($match_question_user_answer);
                    //pr($match_question_answer_position);
                   //die;

                    $user_answer = array();
                    foreach ($match_question_user_answer as $key => $value) {
                       
                        $user_answer[$key] = "$key-$value";
                        if ($value) {
                            $attempted[] = $value;
                        }
                    }

                    //pr($match_question_user_answer);
                    //pr($match_options_key);
                    //pr($match_answer_order);
                    //echo "dddd";
                     //pr($attempted);die;
                    //pr($user_answer);

                    if ($attempted) {
                        //echo "ddd";
                        $total_attempted[] = $match_question;
                    } else {
                        //echo "ddd2";
                        $total_notattempted[] = $match_question;
                    }

                    
                      //pr($total_attempted);//die;
                      //pr($total_notattempted);die;
                    //pr($user_answer);
                    //Check the user answer is Right or wrong
                    //pr($match_question_user_answer);
                    if($match_question_user_answer){
                    foreach ($match_question_user_answer as $keya => $answers) {
                       
                        //echo $match_question_answer_position[$keya];
                        //die;
                        
                        if ($answers == $match_question_answer_position[$keya]) {

                            $is_right[$keya] = '1';

                            $is_all_right_answer[] = '1';
                        } else {

                            $is_right[$keya] = '0';
                            $is_all_right_answer[] = '0';
                        }
                    $yes_attempted='1';
                   
                    }
                    } else{
                       $is_all_right_answer[] = '0'; 
                       $yes_attempted='0';
                    }

//pr($is_all_right_answer);die;
                    foreach ($is_right as $keyright => $valueright) {
                        $user_answer_right[$keyright] = "$keyright-$valueright";
                    }
                    //pr($user_answer_right);

                    if (in_array('0', $is_all_right_answer)) {
                        //echo "wrong"; //die;
                        $total_wrong_answer[] = $match_question;
                    } else {
                        //echo "right"; //die;
                        $total_right_answer[] = $match_question;
                    }
                    
                    //pr($total_wrong_answer);die;
                    //pr($total_right_answer);die;


                    $question_order[] = array_filter($match_options);


                    $ins_match['quiz_id'] = $id;
                    $ins_match['student_id'] = $_POST['student_id'];
                    $ins_match['question_type'] = '7'; //for match Questions
                    $ins_match['quiz_type'] = $quiz_type; //for Quiz
                    $ins_match['question_id'] = $match_question; //for Quiz
                    $ins_match['question_answer_id'] = "";
                    $ins_match['student_answer_id'] = "";
                    $ins_match['is_attempted'] = $yes_attempted;

                    $ins_match['is_right'] = implode(',', $user_answer_right);


                    $ins_match['created_date'] = current_datetime();
                     $ins_match['quiz_played_id'] = $quiz_palyed_id;
                    $ins_match['match_question_option'] = implode(',', array_keys($question_order[$i]));
                    $ins_match['match_question_answer'] = implode(',', $match_answer_order);
                    $ins_match['match_question_user_answer'] = implode(',', $user_answer);

                    unset($user_answer);
                    unset($match_options_key);
                    unset($is_right);
                    unset($user_answer_right);
                    unset($attempted);
                    unset($is_all_right_answer);

                    $this->db->insert('student_quiz_history', $ins_match);
                    $i++;
                }
            }
            }



//            die;
            //**************************************Match the Column ends*****************************************//
            //Insert data in Quiz Result Table

            $quiz_details = $this->Webapi_model->quiz_details($id);
            //Calculation of Quiz Attemped Time
            $attempted_mintes=str_replace(":", " ", $_POST['minutes']);
            $quiz_time=$quiz_details->quiz_time;
            $duration=$quiz_time-$attempted_mintes;
            

            //pr($quiz_details);die;
            $total_marks = $quiz_details->point_per_question * count($total_question);
            $obtain_marks = $quiz_details->point_per_question * count($total_right_answer);

            $percent = ($obtain_marks / $total_marks) * 100;
            $percentage = number_format((float) $percent, 2, '.', '');
            $quiz_play['quiz_id'] = $id;
            $quiz_play['student_id'] = $_POST['student_id'];
            $quiz_play['total_questions'] = count($total_question);
            $quiz_play['attempt_questions'] = count($total_attempted);
            $quiz_play['notattempt_questions'] = count($total_notattempted);
            $quiz_play['right_answers'] = count($total_right_answer);
            $quiz_play['wrong_answers'] = count($total_wrong_answer)-count($total_notattempted);
            $quiz_play['total_marks'] = $total_marks;
            $quiz_play['obtain_marks'] = $obtain_marks;
            $quiz_play['marks_percentage'] = $percentage;
            $quiz_play['duration'] = $duration;
            $quiz_play['attempt_date'] = date('Y-m-d');
            //pr($quiz_play);die;
           $this->db->where('id', $quiz_palyed_id);
           $this->db->update('quiz_result', $quiz_play);
           
           //$quiz_palyed_id=$this->db->insert_id();
           
           
           if($quiz_palyed_id){
               
                    $success = array('ErrorCode' => 0, "message" => "Quiz Submitted Successfully", 'data' => $quiz_palyed_id);
                    $this->response($success, 200);
           }else{
                $error = array('ErrorCode' => 1, 'message' => 'Quiz Not Submitted');
                $this->response($error, 200);
               
           }
           
           
//            pr(count($total_right_answer));
//            pr(count($total_wrong_answer));
//            pr(count($total_question));
//             die;

           

            //********************************True & Flase Question Answer Ends ****************************************//            
        } 
                
                
                
                
                
                
            } else {
                $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }

        //pr($multiple_question);
        //pr($multiple_answer);
    }

    /* ---------------------------------------Student Quiz Subit Ends --------------------------------------------- */









    /* ---------------------------------------Notification_app Starts --------------------------------------------- */

    public function notification_app_post() {
        $apikey = $this->input->post('apikey');
        $id = $this->input->post('id');

        if (isPostBack()) {
            $this->form_validation->set_rules('id', 'ID', 'trim|required|numeric');
            if ($this->form_validation->run()) {
                if ($apikey == APIKEY) {
                    $notification_app = $this->Webapi_model->notification_app_list($id);
                       //pr($notification_app);die;
                    foreach($notification_app as $key=>$notification){
                        $notification_app[$key]->created_date= date('jS M Y h:i A',strtotime($notification->created_date));
                        
                    }
                    
                    if($notification_app){
                        $success = array('ErrorCode' => 0, "message" => "Notification List", 'data' => $notification_app);
                    }else{
                        $success = array('ErrorCode' => 1, "message" => "No notification found!", 'data' => '');
                    }
                    $this->response($success, 200);
                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    /* ---------------------------------------Notification_app Ends --------------------------------------------- */


    /*     * ********************************************Student All Test Starts******************************************* */

    public function student_all_test_post() {
        $apikey = $this->input->post('apikey');
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');


        if (isPostBack()) {
            $this->form_validation->set_rules('class_id', 'Class ID', 'trim|required|numeric');
            $this->form_validation->set_rules('section_id', 'Section ID', 'trim|required|numeric');
            if ($this->form_validation->run()) {
                if ($apikey == APIKEY) {
                    $all_test = $this->Webapi_model->student_all_test_list($class_id, $section_id);
                   //pr($all_test);die;
                     
                    if($all_test){
                       $success = array('ErrorCode' => 0, "message" => "All Test List", 'data' => $all_test);
                      $this->response($success, 200); 
                    
                    }else{
                      $success = array('ErrorCode' => 1, "message" => "No any test found!", 'data' => $all_test);
                    $this->response($success, 200);  
                    }
                    
                    
                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    /*     * ********************************************Student All Test Ends******************************************* */

    /*     * ********************************************Student Upcoming Test Starts******************************************* */

    public function student_upcoming_test_post() {
        $apikey = $this->input->post('apikey');
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $student_id = $this->input->post('student_id');



        if (isPostBack()) {
            $this->form_validation->set_rules('class_id', 'Class ID', 'trim|required|numeric');
            $this->form_validation->set_rules('section_id', 'Section ID', 'trim|required|numeric');
            $this->form_validation->set_rules('student_id', 'Student ID', 'trim|required|numeric');
            if ($this->form_validation->run()) {
                if ($apikey == APIKEY) {
                    $upcoming = $this->Webapi_model->student_upcoming_test_list($class_id, $section_id);
                    //pr($upcoming_test);die;
                    
                    $i=0;
                   
                     foreach ($upcoming as $key => $value)
                      {
                            $check_main_id[$key]=$upcoming[$key]->id;
                            $i++;
                        } 
                    $upcoming_test=$this->Webapi_model->get_upcoming_test_data($upcoming,$check_main_id,$student_id);
                 
                    //pr($upcoming_test);
                    if ($upcoming_test) {
                        $success = array('ErrorCode' => 0, "message" => "Upcoming Test List", 'data' => $upcoming_test);
                        $this->response($success, 200);
                    } else {
                        $success = array('ErrorCode' => 1, "message" => "No Upcoming Test Found!", 'data' => $upcoming_test);
                        $this->response($success, 200);
                    }
                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    /*     * ********************************************Student Upcoming Test Ends******************************************* */


    /*     * ********************************************Popular Videos Starts******************************************* */

    public function popular_videos_post() {
        $apikey = $this->input->post('apikey');
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');


        if (isPostBack()) {
            $this->form_validation->set_rules('class_id', 'Class ID', 'trim|required|numeric');
            $this->form_validation->set_rules('section_id', 'Section ID', 'trim|required|numeric');
            if ($this->form_validation->run()) {
                if ($apikey == APIKEY) {
                    $popular_videos = $this->Webapi_model->popular_videos_list($class_id, $section_id);
                  
                    foreach ($popular_videos as $key => $vals) {
                        $vid_id[]=$popular_videos[$key]->topic_id;
                    } 
                    $pop_vid_ids = $this->Webapi_model->video_pop_list($vid_id);

                 if($pop_vid_ids){// if condition starts
                  
                    foreach ($pop_vid_ids as $key => $value) {
                        $ar[$key]=$value['count'];
                    }
                    arsort($ar);
                    $i=0;
                    foreach($ar as $x => $x_value) {
                        foreach($pop_vid_ids as $key => $value){
                         if($value['count']==$x_value && $x_value!=0)
                         {
                             $main_pop_array[$i]=array('topic_id'=>$value['topic_id'],'count'=>$x_value);
                             $i++;
                            }
                        //  else{
                        //      $main_pop_array[$i]=array('topic_id'=>$value['topic_id'],'count'=>$x_value);
                        //      $i++;
                        //  }
                        }
                    
                 }//pr($main_pop_array);die;
                $vid_count=0;
                 foreach ($main_pop_array as $main => $value) {
                     foreach ($popular_videos as $key => $vals) {
                      
                   if($vals->topic_id==$value['topic_id'] && $vid_count<5)
                   {
                    if (($popular_videos[$key]->video_url == '' && $popular_videos[$key]->video_url == null && $popular_videos[$key]->video_name != null) ||($popular_videos[$key]->video_name == '' && $popular_videos[$key]->video_name == null && $popular_videos[$key]->video_url != null))
                    {
                     $vid_count++;
                       $popular_video[$main]->subject_id=$popular_videos[$key]->subject_id;
                       $popular_video[$main]->chapter_id=$popular_videos[$key]->chapter_id;
                       $popular_video[$main]->chapter_name=$popular_videos[$key]->chapter_name;
                       $popular_video[$main]->topic_id= $popular_videos[$key]->topic_id;
                       $popular_video[$main]->topic_name= $popular_videos[$key]->topic_name;
                       
                             if ($popular_videos[$key]->video_url == '' && $popular_videos[$key]->video_url == null && $popular_videos[$key]->video_name != null) {
                                 $popular_video[$main]->video_name = base_url() . "uploads/profile_image/" . $vals->video_name;
                                 $popular_video[$main]->video_url="";
                             } else if ($popular_videos[$key]->video_name == '' && $popular_videos[$key]->video_name == null && $popular_videos[$key]->video_url != null) {
                                 $popular_video[$main]->video_name ="";
                                 $popular_video[$main]->video_url = $vals->video_url;
                                
                             } else {
                                
                             }

                          }
                     }
 
                     }
                 } 
 
                   // pr($popular_videos);
             
                     if(!empty($popular_video)){
                         $success = array('ErrorCode' => 0, "message" => "Popular Videos", 'data' => $popular_video);
                     }else{
                         $success = array('ErrorCode' => 1, "message" => "No popular videos for your class!", 'data' =>'');
                     }
                    
 
//if condition ends
                 }else{
                   
                   // $popular_video=$popular_videos;
                    $vid_count_value=0;
                    foreach ($popular_videos as $key => $vals) {
                        if($vid_count_value<5)
                        {
                            if (($popular_videos[$key]->video_url == '' && $popular_videos[$key]->video_url == null && $popular_videos[$key]->video_name != null) ||($popular_videos[$key]->video_name == '' && $popular_videos[$key]->video_name == null && $popular_videos[$key]->video_url != null))

                        {

                        //$popular_videos[$key]->video_url='manish';
                       $popular_video[$key]->subject_id=$popular_videos[$key]->subject_id;
                       $popular_video[$key]->chapter_id=$popular_videos[$key]->chapter_id;
                       $popular_video[$key]->chapter_name=$popular_videos[$key]->chapter_name;
                       $popular_video[$key]->topic_id= $popular_videos[$key]->topic_id;
                       $popular_video[$key]->topic_name= $popular_videos[$key]->topic_name;

                        if ($popular_videos[$key]->video_url == '' && $popular_videos[$key]->video_url == null && $popular_videos[$key]->video_name != null) {
                            $popular_video[$key]->video_name = base_url() . "uploads/profile_image/" . $vals->video_name;
                            $popular_video[$key]->video_url="";
                        } else if ($popular_videos[$key]->video_name == '' && $popular_videos[$key]->video_name == null && $popular_videos[$key]->video_url != null) {
                            $popular_video[$key]->video_name ="";
                            $popular_video[$key]->video_url = $vals->video_url;
                        } else {
                            
                        }
                        $vid_count_value++;
                    }

                    }
                    }


                    if(!empty($popular_video)){
                        $success = array('ErrorCode' => 0, "message" => "Popular Videos", 'data' => $popular_video);
                    }else{
                        $success = array('ErrorCode' => 1, "message" => "No popular videos for your class!", 'data' =>'');
                    }
                   

                 }
                   
                    $this->response($success, 200);
                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    /*     * ********************************************Popular Videos Ends******************************************* */

    /*     * ********************************************Restult View Starts******************************************* */

    public function result_view_post() {
        $apikey = $this->input->post('apikey');
        $quiz_play_id = $this->input->post('quiz_play_id');
        //$student_id = $this->input->post('student_id');



        if (isPostBack()) {
            $this->form_validation->set_rules('quiz_play_id', 'Quiz ID', 'trim|required|numeric');
            //$this->form_validation->set_rules('student_id', 'Student ID', 'trim|required|numeric');

            if ($this->form_validation->run()) {
                if ($apikey == APIKEY) {
                    $result_view = $this->Webapi_model->result_view_list($quiz_play_id);
//                    $student_quiz_play = $this->Webapi_model->student_quiz_play($quiz_id, $student_id);
//
//
//
//                    foreach ($student_quiz_play as $key => $student_quiz) {
//                        $student_quiz_play[$key]->options = $this->Webapi_model->get_question_data_list($student_quiz->question_id, $student_quiz->question_type);
//                    }
//                    //pr($result_view); 
//                    //pr($student_quiz_play);
                    $success = array('ErrorCode' => 0, "message" => "Result View", 'data' =>$result_view);

                    $this->response($success, 200);
                } else {
                    $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                    $this->response($error, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => validation_errors());
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
            $this->response($error, 200);
        }
    }

    /*     * ********************************************Restult View Ends******************************************* */
/**********************************************Student Syllabus Starts********************************************/

public function syallabus_post() {
    $apikey = $this->input->post('apikey');
    $class_id = $this->input->post('class_id');
    $section_id = $this->input->post('section_id');
    

    if (isPostBack()) {
        $this->form_validation->set_rules('class_id', 'Class ID', 'trim|required|numeric');
        $this->form_validation->set_rules('section_id', 'Section ID', 'trim|required|numeric');
        if ($this->form_validation->run()) {
            if ($apikey == APIKEY) {
                //$syllabus_list = $this->Webapi_model->syallabus_list($class_id,$section_id);
                $class=getclass($class_id); 
                $subject = $this->Webapi_model->subject_list($class_id, $section_id);
                foreach($subject as $key=>$vals)
                {
                    $subject_array[]=$vals->subject_name;
                }
               
                foreach( $subject as $key=>$val)
                    {
                        $chapter[$key]=$this->Webapi_model->chapter_list($class_id,$section_id,$val->subject_id); 
                    }
                    $chap_count=0;
                    foreach($chapter as $key=>$chap)
                    {
                        foreach($chap as $keys=>$chap_list)
                        {
                            $chapter_list[$key][$keys]=$chap_list->chapter_name;
                            $chap_count++;
                        }
                    }
                $data['class']=$class->class_name;
                $data['section']=get_comma_separated_sectionname($section_id); 
                $data['subject']=$subject_array;
                $data['chapter']=$chapter_list;
                $data['total_chapter']=$chap_count;
                //pr($data);
               
                $success = array('ErrorCode' => 0, "message" => "Syllabus", 'data' => $data);
                $this->response($success, 200);
            } else {
                $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => validation_errors());
            $this->response($error, 200);
        }
    } else {
        $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
        $this->response($error, 200);
    }
}


/**********************************************Student Syllabus Ends********************************************/

/**********************************************Student All Attempted Test Starts********************************************/

public function student_all_attempted_test_post() {
    $apikey = $this->input->post('apikey');
    $student_id = $this->input->post('student_id');
   
    if (isPostBack()) {
        $this->form_validation->set_rules('student_id', 'Student ID', 'trim|required|numeric');
        if ($this->form_validation->run()) {
            if ($apikey == APIKEY) {
                $all_test = $this->Webapi_model->student_all_attempted_test_list($student_id);
                //pr($all_test);

                foreach($all_test as $key=>$val)
                {
              
                $subject_arr[]=$this->Webapi_model->subject_name($val->quiz_subject_id);
                $topic_arr[]=get_comma_separated_topicname($val->quiz_topic);
                $attempt_questions[]=$val->attempt_questions;
                $skipped_questions[]=$val->notattempt_questions;
                $time_taken[]=$val->duration;
                $test_date[]=$val->attempt_date;
                $got_marks[]=$val->obtain_marks;
                $tot_marks[]=$val->total_marks;
                $quiz_result_id[]=$val->id;

                /* here $data contains the all test details in array format */
                $data[$key]['Test']=$key+1;
                $data[$key]['quiz_id']=$quiz_result_id[$key];
                $data[$key]['subject']=$subject_arr[$key]->subject_name;
                $data[$key]['topic']=$topic_arr[$key];
                $data[$key]['attempt_questions']=$attempt_questions[$key];
                $data[$key]['skipped_questions']=$skipped_questions[$key];
                $data[$key]['time_taken']=$time_taken[$key];
                $data[$key]['test_date']=$test_date[$key];
                $data[$key]['got_marks']=$got_marks[$key];
                $data[$key]['tot_marks']=$tot_marks[$key];
               
                }
                //pr($data);
                
              if($all_test){
                   $success = array('ErrorCode' => 0, "message" => "All Attempted Test List", 'data' =>$data);
                $this->response($success, 200);
              }else{
                   $success = array('ErrorCode' => 1, "message" => "No any test found!", 'data' =>'');
                $this->response($success, 200);
              }
               
                
                
            } else {
                $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => validation_errors());
            $this->response($error, 200);
        }
    } else {
        $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
        $this->response($error, 200);
    }
}


/**********************************************Student All Attempted Test Ends********************************************/

/**********************************************Question Answer Result View Starts********************************************/

public function ques_ans_result_view_post() {
    $apikey = $this->input->post('apikey');
    $quiz_result_id = $this->input->post('quiz_result_id');
    //$student_id = $this->input->post('student_id');
    
    

    if (isPostBack()) {
        $this->form_validation->set_rules('quiz_result_id', 'Quiz Result ID', 'trim|required|numeric');
        //$this->form_validation->set_rules('student_id', 'Student ID', 'trim|required|numeric');
      
        if ($this->form_validation->run()) {
            if ($apikey == APIKEY) {
                $result_view = $this->Webapi_model->ques_ans_result_view_list($quiz_result_id);
                
                $quiz_id=$result_view->quiz_id;
                $student_id=$result_view->student_id;
               // pr($result_view);die;
                
                $student_quiz_play = $this->Webapi_model->ques_ans_student_quiz_play($quiz_id,$student_id,$quiz_result_id);
               

               
                foreach($student_quiz_play as $key=> $student_quiz){
                    $student_quiz_play[$key]->options=$this->Webapi_model->ques_ans_get_question_data_list($student_quiz->question_id,$student_quiz->question_type);
                }
//                //pr($result_view); 
//                $count_ques=0;
//                foreach($student_quiz_play as $key=>$ques)
//                {
//      
//                    
//                        $question_id_arr[]=$ques->question_id;
//                        $questioncontent_arr[]=$ques->questioncontent;
//                        $question_answer_id_arr[]=$ques->question_answer_id;
//                        $student_answer_id_arr[]=$ques->student_answer_id;
//                        foreach($ques->options as $option_key=> $options)
//                        {
//                            //pr($options);
//                            foreach($options as $val_option=>$option_data)
//                            {
//                                // echo $question_id_arr[$key];
//                                // pr($option_data);
//                                if($question_id_arr[$key]==$option_data->question_id)
//                                {
//                                    $questioncontent_options_id_arr[$key][$option_key][$val_option]=$option_data->id;
//                                    $questioncontent_options_arr[$key][$option_key][$val_option]=$option_data->answer;
//                                    if(!empty($option_data) &&($ques->student_answer_id==$option_data->id))
//                                    {
//                                        $student_ans_arr[$key][$option_key][$val_option]['student_correct_answer']=$option_data->answer;
//                                    }else{
//                                        $student_ans_arr[$key][$option_key][$val_option]['student_wrong_answer']=$option_data->answer;
//
//                                    }
//                                    if($ques->question_answer_id==$option_data->id)
//                                    {
//                                        if($ques->question_answer_id)
//                                        {
//                                            $correct_ans_arr[$key][$option_key]['right_answer']=$option_data->answer;
//                                        }
//                                      
//                                    }else{
//                                        $wrong_ans_arr[$key][$option_key]['wrong_answer']=$option_data->answer;
//                                        }
//                                }/* else if($question_id_arr[$key]==$ques->options[$option_key]['answer_data']->question_id)
//                                {
//                                    echo"shubam";
//                                    die;
//                                } */
//                            }
//                            
//                            
//                        }
//                }/* for answer_data */
//
//                
//                /* for answer data ends */
//                foreach ($question_id_arr as $key => $value)
//                {
//                    $data['question_list'][$key]->question=$questioncontent_arr[$key];
//                    $data['question_list'][$key]->options=$questioncontent_options_arr[$key];
//                    $data['question_list'][$key]->correct_answer= $correct_ans_arr[$key]['option_data']['right_answer'];
//                    $data['question_list'][$key]->student_answer= $student_ans_arr[$key]['option_data']['student_answer'];
//                   
//                } 
                //pr($question_id_arr);
                 //pr($correct_ans_arr);
               //pr($data);
              
               // pr($student_answer_id_arr);
               // pr($questioncontent_options_id_arr);
                //pr($questioncontent_options_arr);
                //pr($student_quiz_play);
                
                
                $data['result_view']=$result_view;
                $data['student_quiz_play']=$student_quiz_play;
                
               // pr($data['student_quiz_play']);
                
                foreach($data['student_quiz_play'] as $question=>$question_data){
                    
                    
                    if($question_data->question_type=="7"){
                        $match_question_answer=explode(',',$question_data->match_question_answer);
                        foreach($match_question_answer as $match_question_answers1){
                            $match_question_answer2=explode('_',$match_question_answers1);
                            $match_question_answersuffle[$match_question_answer2[1]]=(object)['id' => $this->match_colb($match_question_answer2[0])->col_b];
                            //pr($match_question_answer2);die;
                            
                        }
                        
                        
                      $data['student_quiz_play'][$question]->options['ans_position']=$match_question_answersuffle;
                      unset($match_question_answersuffle);
                      
                     $match_question_user_answer =$question_data->match_question_user_answer;
                     $match_question_user_answer= explode(',',$match_question_user_answer);
                     
                     
                      foreach($match_question_user_answer as $match_question_user_answer1){
                            $match_question_user_answer2=explode('-',$match_question_user_answer1);
                            $match_question_user_answersuffle[]=(object)['id' => $match_question_user_answer2[1]];
                            //pr($match_question_answer2);die;
                            
                        }
                     
                         $data['student_quiz_play'][$question]->options['user_ans']=$match_question_user_answersuffle;
                         unset($match_question_user_answersuffle);
                      //pr($match_question_user_answer);die;
                      //$data['student_quiz_play'][$question]->user_answer=$question_data->match_question_user_answer;
                      //$data['student_quiz_play'][$question]->is_user_answer_correct=$question_data->is_right;
                      
                      $is_right=explode(',',$question_data->is_right);
                      //pr($is_right);die;
                      
                      
                      
                       foreach($is_right as $is_right1){
                            $is_right2=explode('-',$is_right1);
                            $is_right2_suffle[]=(object)['id' => $is_right2[1]];
                            //pr($match_question_answer2);die;
                            
                        }
                     
                         $data['student_quiz_play'][$question]->options['user_ans_right']=$is_right2_suffle;
                         unset($is_right2_suffle);
                        
                        
                    }
                    
                    
                }
                
                
                
              //pr($data);die;
                
                $success = array('ErrorCode' => 0, "message" => "Result View", 'data' =>array($data));
                //$success = array('ErrorCode' => 0, "message" => "Result View", 'data' =>"1");
                $this->response($success, 200);
            } else {
                $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => validation_errors());
            $this->response($error, 200);
        }
    } else {
        $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
        $this->response($error, 200);
    }
}

/**********************************************Question Answer Result View Ends********************************************/

/**********************************************Specific Topic Video/URL by Topic Id Starts********************************************/


public function video_view_post() {
    $apikey = $this->input->post('apikey');
   $topic_id = $this->input->post('topic_id');



    if (isPostBack()) {
        $this->form_validation->set_rules('topic_id', 'Topic ID', 'trim|required|numeric');
        //$this->form_validation->set_rules('student_id', 'Student ID', 'trim|required|numeric');

        if ($this->form_validation->run()) {
            if ($apikey == APIKEY) {
                $topic_video_url = $this->Webapi_model->video_view_list($topic_id);
                foreach ($topic_video_url as $key => $value) {
                    if($value->video_name!="" && $value->video_name!=null && $value->video_url==null && $value->video_url=="")
                    {   $data['type']="1";
                        $data['topic_name']=$value->topic_name;
                        $data['summary']=$value->summary;
                        $data['Video']=base_url().'uploads/profile_image/'.$value->video_name;
                    }if($value->video_url!="" && $value->video_url!=null && $value->video_name==null  && $value->video_name=="")
                   {
                       $data['type']="2";
                       $data['topic_name']=$value->topic_name;
                        $data['summary']=$value->summary;
                    $data['Video']=$value->video_url;
                   }if($value->video_url=="" && $value->video_url==null && $value->video_name==null  && $value->video_name==""){
                    $data['type']="3"; 
                    $data['topic_name']=$value->topic_name;
                    $data['summary']=$value->summary; 
                    $data["Video"]=base_url().'assets/srs_admin/img/no_video.png';
                   }
                }
                if(!empty($data["Video"])){
                    $success = array('ErrorCode' => 0, "message" => "Video/URL View", 'data' =>$data);
                }else{
                    $success = array('ErrorCode' => 1, "message" => "No video found!", 'data' =>'');
                }
                $this->response($success, 200);
            } else {
                $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => validation_errors());
            $this->response($error, 200);
        }
    } else {
        $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
        $this->response($error, 200);
    }
}

/**********************************************Specific Topic Video/URL by Topic Id Ends********************************************/

/**********************************************Get Quiz ID by Class,subject,section,chapter,topic Id Starts********************************************/

public function quiz_id_post() {
    $apikey = $this->input->post('apikey');
    $class_id = $this->input->post('class_id');
    $section_id = $this->input->post('section_id');
    $subject_id = $this->input->post('subject_id');
    $chapter_id = $this->input->post('chapter_id');
    $topic_id = $this->input->post('topic_id');



    if (isPostBack()) {
        $this->form_validation->set_rules('class_id', 'Class ID', 'trim|required|numeric');
        $this->form_validation->set_rules('section_id', 'Section ID', 'trim|required|numeric');
        $this->form_validation->set_rules('subject_id', 'Subject ID', 'trim|required|numeric');
        $this->form_validation->set_rules('chapter_id', 'Chapter ID', 'trim|required|numeric');
        $this->form_validation->set_rules('topic_id', 'Topic ID', 'trim|required|numeric');
   

        if ($this->form_validation->run()) {
            if ($apikey == APIKEY) {
                $quiz_details = $this->Webapi_model->quiz_id_list($class_id,$section_id,$subject_id,$chapter_id,$topic_id);
              // pr($quiz_details);
                if(!empty($quiz_details)){
                    $success = array('ErrorCode' => 0, "message" => "QUIZ", 'data' =>$quiz_details);
                }else{
                    $success = array('ErrorCode' => 1, "message" => "No quiz found!", 'data' =>'');
                }
                $this->response($success, 200);
            } else {
                $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => validation_errors());
            $this->response($error, 200);
        }
    } else {
        $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
        $this->response($error, 200);
    }
}

/**********************************************Get Quiz ID by Class,section,chapter,topic Id Ends********************************************/

/**********************************************Attempt QUIZ Insertion in Table Starts********************************************/

public function attempt_quiz_post() {
    $apikey = $this->input->post('apikey');
    $quiz_id = $this->input->post('quiz_id');
    $student_id = $this->input->post('student_id');
   
    if (isPostBack()) {
        $this->form_validation->set_rules('quiz_id', 'Quiz ID', 'trim|required|numeric');
        $this->form_validation->set_rules('student_id', 'Student ID', 'trim|required|numeric');
        
   

        if ($this->form_validation->run()) {
            if ($apikey == APIKEY) {
                $insert_id['inserted_id'] = $this->Webapi_model->attempt_quiz_view($quiz_id,$student_id);
                if(!empty($insert_id)){
                    $success = array('ErrorCode' => 0, "message" => "Attempt Quiz", 'data' =>$insert_id);
                    $this->response($success, 200);
                }else{
                    $success = array('ErrorCode' => 1, "message" => "No quiz attepmpted!", 'data' =>'');
                    $this->response($success, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => validation_errors());
            $this->response($error, 200);
        }
    } else {
        $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
        $this->response($error, 200);
    }
}
/**********************************************Attempt QUIZ Insertion in Table Ends********************************************/
 //***************************get maching data Column Second value**********************************//

   public function match_colb($id){
        $options_data_qry = $this->db->select('col_b')->from('question_matching')->where_in('id', $id)->get();
        //echo $this->db->last_query();die;
        return $options_data_qry->row(); 
        
       
   }



   
/**********************************************Count Notifications Starts********************************************/
public function count_notification_post() {
    $apikey = $this->input->post('apikey');
    $student_id = $this->input->post('student_id');
   
  
    if (isPostBack()) {
        $this->form_validation->set_rules('student_id', 'Student ID', 'trim|required|numeric');
       
        if ($this->form_validation->run()) {
            if ($apikey == APIKEY) {
                $data= $this->Webapi_model->count_notification_view($student_id);
                
            if (!empty($data)) {
              if($data->tot>0)
              {
                $success = array('ErrorCode' => 0, "message" => "Notifications", 'data' =>$data);
              }else{
                $data->tot='0';
                $success = array('ErrorCode' => 0, "message" => "Notifications", 'data' =>$data);
              }
              $this->response($success, 200);
                
            }else{
                $success = array('ErrorCode' => 1, "message" => "No any notification found!");
                $this->response($success, 200);
            }
            } else {
                $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => validation_errors());
            $this->response($error, 200);
        }
    } else {
        $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
        $this->response($error, 200);
    }
}

/**********************************************Count Notifications Ends********************************************/

/**********************************************Update Notifications Starts********************************************/
public function update_notification_post() {
    $apikey = $this->input->post('apikey');
    $notification_id = $this->input->post('notification_id');
   
  
    if (isPostBack()) {
        $this->form_validation->set_rules('notification_id', 'Notification ID', 'trim|required|numeric');
       
        if ($this->form_validation->run()) {
            if ($apikey == APIKEY) {
                $data= $this->Webapi_model->update_notification_view($notification_id);
              
                if (!empty($data)) {
                $success = array('ErrorCode' => 0, "message" => "Notification Update", 'data' =>$data);
                $this->response($success, 200);
                }else{
                    $success = array('ErrorCode' => 1, "message" => "No notification updated!");
                    $this->response($success, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => validation_errors());
            $this->response($error, 200);
        }
    } else {
        $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
        $this->response($error, 200);
    }
}

/**********************************************Update Notifications Ends********************************************/
/**********************************************Student Logs Starts********************************************/
public function student_log_post() {
    $apikey = $this->input->post('apikey');
    $student_id = $this->input->post('student_id');
    $activity = $this->input->post('activity');
    $action = $this->input->post('action');
   
  
    if (isPostBack()) {
        $this->form_validation->set_rules('student_id', 'Student ID', 'trim|required|numeric');
        $this->form_validation->set_rules('activity', 'Activity', 'trim|required');
        $this->form_validation->set_rules('action', 'Action ', 'trim|required');
     
       
        if ($this->form_validation->run()) {
            if ($apikey == APIKEY) {
                $data= $this->Webapi_model->student_log_view();
              
                if (!empty($data)) {
                $success = array('ErrorCode' => 0, "message" => "Student Log Inserted", 'data' =>$data);
                $this->response($success, 200);
                }else{
                    $success = array('ErrorCode' => 1, "message" => "No Log Inserted!");
                    $this->response($success, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => validation_errors());
            $this->response($error, 200);
        }
    } else {
        $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
        $this->response($error, 200);
    }
}

/**********************************************Student Logs Ends********************************************/

/**********************************************Student Logs Fetch Starts********************************************/
public function student_log_fetch_post() {
    $apikey = $this->input->post('apikey');
    $student_id = $this->input->post('student_id');
  
   
  
    if (isPostBack()) {
        $this->form_validation->set_rules('student_id', 'Student ID', 'trim|required|numeric');
       
       
        if ($this->form_validation->run()) {
            if ($apikey == APIKEY) {
                $data= $this->Webapi_model->student_log_fetch_view($student_id);
                
                foreach($data as $key=>$dataval){
                        $data[$key]->created_date= date('jS M Y h:i A',strtotime($dataval->created_date));
                        
                    }
                
              
                if (!empty($data)) {
                $success = array('ErrorCode' => 0, "message" => "Student Logs", 'data' =>$data);
                $this->response($success, 200);
                }else{
                    $success = array('ErrorCode' => 1, "message" => "No Logs!");
                    $this->response($success, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => validation_errors());
            $this->response($error, 200);
        }
    } else {
        $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
        $this->response($error, 200);
    }
}

/**********************************************Student Logs Fetch Ends********************************************/


/**********************************************Video Logs Starts********************************************/
public function video_log_post() {
    $apikey = $this->input->post('apikey');
    $student_id = $this->input->post('student_id');
    $topic_id = $this->input->post('topic_id');
   
  
    if (isPostBack()) {
        $this->form_validation->set_rules('student_id', 'Student ID', 'trim|required|numeric');
        $this->form_validation->set_rules('topic_id', 'Topic ID', 'trim|required|numeric');
        
     
       
        if ($this->form_validation->run()) {
            if ($apikey == APIKEY) {
                $data= $this->Webapi_model->video_log_view($student_id,$topic_id);
              
                if (!empty($data) && $data==true) {
                $success = array('ErrorCode' => 0, "message" => "Video Log Inserted", 'data' =>$data);
                $this->response($success, 200);
                }else{
                    $success = array('ErrorCode' => 1, "message" => "No Video Log Inserted!");
                    $this->response($success, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => validation_errors());
            $this->response($error, 200);
        }
    } else {
        $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
        $this->response($error, 200);
    }
}

/**********************************************Video Logs Ends********************************************/


/**********************************************Assessment Report Starts********************************************/

public function assessment_report_post() {
    $apikey = $this->input->post('apikey');
    $student_id = $this->input->post('student_id');
   
    if (isPostBack()) {
        $this->form_validation->set_rules('student_id', 'Student ID', 'trim|required|numeric');
        if ($this->form_validation->run()) {
            if ($apikey == APIKEY) {
                $all_test = $this->Webapi_model->assessment_report_list($student_id);
                //pr($all_test);

                foreach($all_test as $key=>$val)
                {
              
                $subject_arr[]=$this->Webapi_model->subject_name($val->quiz_subject_id);
                $topic_arr[]=get_comma_separated_topicname($val->quiz_topic);
                $attempt_questions[]=$val->attempt_questions;
                $skipped_questions[]=$val->notattempt_questions;
                $time_taken[]=$val->duration;
                $test_date[]=$val->attempt_date;
                $got_marks[]=$val->obtain_marks;
                $tot_marks[]=$val->total_marks;
                $quiz_result_id[]=$val->id;

                /* here $data contains the all test details in array format */
                $data[$key]['Assessment']=$key+1;
                $data[$key]['quiz_id']=$quiz_result_id[$key];
                $data[$key]['subject']=$subject_arr[$key]->subject_name;
                $data[$key]['topic']=$topic_arr[$key];
                $data[$key]['attempt_questions']=$attempt_questions[$key];
                $data[$key]['skipped_questions']=$skipped_questions[$key];
                $data[$key]['time_taken']=$time_taken[$key];
                $data[$key]['test_date']=$test_date[$key];
                $data[$key]['got_marks']=$got_marks[$key];
                $data[$key]['tot_marks']=$tot_marks[$key];
               
                }
                //pr($data);
                
              if($all_test){
                   $success = array('ErrorCode' => 0, "message" => "All Assessment List", 'data' =>$data);
                $this->response($success, 200);
              }else{
                   $success = array('ErrorCode' => 1, "message" => "No assessment found!", 'data' =>'');
                $this->response($success, 200);
              }
               
                
                
            } else {
                $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => validation_errors());
            $this->response($error, 200);
        }
    } else {
        $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
        $this->response($error, 200);
    }
}


/**********************************************Assessment Report Ends********************************************/


/**********************************************Quiz Report Starts********************************************/

public function quiz_report_post() {
    $apikey = $this->input->post('apikey');
    $student_id = $this->input->post('student_id');
   
    if (isPostBack()) {
        $this->form_validation->set_rules('student_id', 'Student ID', 'trim|required|numeric');
        if ($this->form_validation->run()) {
            if ($apikey == APIKEY) {
                $all_test = $this->Webapi_model->quiz_report_list($student_id);
                //pr($all_test);

                foreach($all_test as $key=>$val)
                {
              
                $subject_arr[]=$this->Webapi_model->subject_name($val->quiz_subject_id);
                $topic_arr[]=get_comma_separated_topicname($val->quiz_topic);
                $attempt_questions[]=$val->attempt_questions;
                $skipped_questions[]=$val->notattempt_questions;
                $time_taken[]=$val->duration;
                $test_date[]=$val->attempt_date;
                $got_marks[]=$val->obtain_marks;
                $tot_marks[]=$val->total_marks;
                $quiz_result_id[]=$val->id;

                /* here $data contains the all test details in array format */
                $data[$key]['Quiz']=$key+1;
                $data[$key]['quiz_id']=$quiz_result_id[$key];
                $data[$key]['subject']=$subject_arr[$key]->subject_name;
                $data[$key]['topic']=$topic_arr[$key];
                $data[$key]['attempt_questions']=$attempt_questions[$key];
                $data[$key]['skipped_questions']=$skipped_questions[$key];
                $data[$key]['time_taken']=$time_taken[$key];
                $data[$key]['test_date']=$test_date[$key];
                $data[$key]['got_marks']=$got_marks[$key];
                $data[$key]['tot_marks']=$tot_marks[$key];
               
                }
                //pr($data);
                
              if($all_test){
                   $success = array('ErrorCode' => 0, "message" => "All Quiz List", 'data' =>$data);
                $this->response($success, 200);
              }else{
                   $success = array('ErrorCode' => 1, "message" => "No quiz found!", 'data' =>'');
                $this->response($success, 200);
              }
               
                
                
            } else {
                $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => validation_errors());
            $this->response($error, 200);
        }
    } else {
        $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
        $this->response($error, 200);
    }
}


/**********************************************Quiz Report Ends********************************************/


/**********************************************Topic video viewed Starts********************************************/
public function is_student_view_video_post() {
    $apikey = $this->input->post('apikey');
    $student_id = $this->input->post('student_id');
    $topic_id = $this->input->post('topic_id');
   
  
    if (isPostBack()) {
        $this->form_validation->set_rules('student_id', 'Student ID', 'trim|required|numeric');
        $this->form_validation->set_rules('topic_id', 'Topic ID', 'trim|required|numeric');
       
        if ($this->form_validation->run()) {
            if ($apikey == APIKEY) {
                $data= $this->Webapi_model->is_student_view_video_list($student_id,$topic_id);
              
                if (!empty($data)) {
                $success = array('ErrorCode' => 0, "message" => "Student viewed the video", 'data' =>"1");
                $this->response($success, 200);
                }else{
                    $success = array('ErrorCode' => 1, "message" => "Video is not viewed!", 'data' =>"0");
                    $this->response($success, 200);
                }
            } else {
                $error = array('ErrorCode' => 1, 'message' => 'Api Key does not exist');
                $this->response($error, 200);
            }
        } else {
            $error = array('ErrorCode' => 1, 'message' => validation_errors());
            $this->response($error, 200);
        }
    } else {
        $error = array('ErrorCode' => 1, 'message' => 'Use Post Method Only');
        $this->response($error, 200);
    }
}

/**********************************************Topic video viewed Ends********************************************/


    /* ------------------------------------------------- Functions Closed ----------------------------------------------- */
}
