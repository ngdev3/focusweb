<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->model("Users_model");
        }
        
	public function index(){           
            $this->load->view('users_view');
	}
        
        function list_items(){            
            $data['page_title'] = "Users List";
            $data['page'] = "list_items";
            $data['breadcrumb'] = array( "Users List"=>  base_url('users/list_items'));
            _layout($data);
        }
        
        function list_items_ajax(){                       
                $res = $this->Users_model->list_items_ajax();
 
                echo json_encode($res);                                 
        }
        
        /*  function profile(){
            
            $user_id = (@$this->uri->segment('3'))?decode($this->uri->segment('3')):currUserId(); 
            //pr($user_id);die;
             if(@$_GET['tab'] == "change_password"){
                $this->change_password();
            }elseif(@$_GET['tab'] == "change_password" || empty($_GET['tab']))
            { 
            if($this->form_validation->run("users/profile") == TRUE){
                //pr($user_id);die;
                $this->Users_model->update_profile($user_id);   
                 $this->session->set_flashdata("alert",array("c"=>"s","m"=>"Profile Updated Successfully. "));
                redirect(current_url());
               //redirect("users/list_items");
            }            
            }   
            $data['roles'] = get_where("cz_roles",array("status"=>"1"));              
            $data['userData'] = $this->Users_model->profile($user_id);            
            $data['page_title'] = (@$this->uri->segment('3'))?"User Profile":"My Profile";
            $data['page'] = "profile";
            $data['breadcrumb'] = array("Home"=>  base_url(), "My Profile"=>  base_url('users/profile/'.  encode($user_id))); 
          //pr($data);die;

            _layout($data);
        }  
 */
        public function profile() {
            $user_id = (@$this->uri->segment('3'))?decode($this->uri->segment('3')):currUserId(); 
            if($this->form_validation->run("users/profile") == TRUE) {
                $this->Users_model->update_profile($user_id);   
                $this->session->set_flashdata("alert", array("c" => "s", "m" => "Profile Updated Successfully. "));
                redirect('users/profile');
            }
           // echo $user_id;die;
            // $data['roles'] = get_where("cz_roles",array("status"=>"1"));              
            $data['userData'] = $this->Users_model->profile($user_id);            
            $data['title'] = "Update Profile";
            $data['page_title'] = "Update Profile";
            $data['page'] = "profile";
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "My Profile"=>  base_url('users/profile/'.  encode($user_id))); 
            //pr($data['roles']);
           // pr($data['userData']);die;
            _layout($data);
        }

        public function changepassword() {
            $user_id = (@$this->uri->segment('3'))?decode($this->uri->segment('3')):currUserId(); 
            if($this->form_validation->run("users/change_password") == TRUE){
                $user_id = currUserId(); 
               $this->Users_model->change_password($user_id);   
               $this->session->set_flashdata("alert",array("c"=>"s","m"=>"Password has been changed successfully. "));
               redirect(base_url("users/profile"));
           } 
            
           // echo $user_id;die;
            $data['roles'] = get_where("cz_roles",array("status"=>"1"));              
            $data['userData'] = $this->Users_model->profile($user_id);            
            $data['title'] = "Change Password";
            $data['page_title'] = "Change Password";
            $data['page'] = "changepassword";
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "My Profile"=>  base_url('users/profile/'.  encode($user_id)),"Change Password" => ""); 
            
            
            _layout($data);
        }
        
        
         function profilepic() {

        $config['upload_path'] = './uploads/profile_image/';
        $config['allowed_types'] = 'gif|jpg|png';
        // $config['max_size']      = 100; 
        $ext = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);
        $file_name = date('Ymd-his') . "." . $ext;
        $config['file_name'] = $file_name;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('upload')) {

            $this->session->set_flashdata("alert", array("c" => "s", "m" => $this->upload->display_errors()));
        } else {
            $img_del = get_where('users', array('id' => currUserId()))['0']->profile_image;

            unlink('./uploads/profile_image/' . $img_del . '');
            $sucess = array('upload_data' => $this->upload->data());
            $upd['profile_image'] = $this->upload->data()['file_name'];
            $whr['id'] = currUserId();
            $this->db->update("users", $upd, $whr);

            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Profile Updated Successfully. "));
        }
    }
        
        function change_password(){
              if($this->form_validation->run("users/change_password") == TRUE){
                 $user_id = currUserId(); 
                $this->Users_model->change_password($user_id);   
                $this->session->set_flashdata("alert",array("c"=>"s","m"=>"Password has been changed successfully. "));
                redirect(base_url("users/profile?tab=change_password"));
            }   
        }
        
        function add(){            
            $data['roles'] = get_where("cz_roles",array("status"=>"1")); 
            //$data['survey_company'] = get_where('cz_survey_company', array("status" => '1', "is_deleted" => '0'), $order = 'company_name');
            $data['page_title'] = "Add User";
            $data['page'] = "add";
            $data['breadcrumb'] = array("Home"=>  base_url(),"Users"=>  base_url('users/list_items'), "Add User"=>  base_url('users/add'));            
            if($this->form_validation->run("users/add") == TRUE){
                //pr($_POST);die;
                $this->Users_model->add();
                $this->session->set_flashdata("alert",array("c"=>"s","m"=>"User Added Successfully. "));
                redirect("users/list_items?role=".$_POST['role']);
            }            
            _layout($data);
        }
        
        public function edit() {
        $id = ID_decode($this->uri->segment('3'));
        $data['res'] = $this->Users_model->viewData($id);
        //pr($data['res']);die;
        if ($this->form_validation->run("users/edit") == TRUE) {
            $this->Users_model->edit($id);
            $this->session->set_flashdata("alert", array("c" => "s", "m" => "User Updated Successfully. "));
            redirect('users/list_items');
        }
        $data['roles'] = get_where("cz_roles", array("status" => "1", "is_deleted" => "0"));
        //$data['survey_company'] = get_where('cz_survey_company', array("status" => '1', "is_deleted" => '0'), $order = 'company_name');

        $data['title'] = "Edit User";
        $data['page_title'] = "Edit User";
        $data['page'] = "add";
        $data['breadcrumb'] = array("Home" => base_url(), "Users" => base_url('users/list_items'));
        _layout($data);
    }

    function delete() {
        $id = $_POST['id'];
        //pr($id);die;
        $res = $this->Users_model->delete($id);
        echo json_encode($res);
    }

}
        
        


/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */