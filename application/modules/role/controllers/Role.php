<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Role extends MY_Controller {

    function __construct() {
        parent::__construct();
//        checkSuperAdmin();
        $this->form_validation->set_error_delimiters('<span style="color:red; font-size:14px;">', '</span>');
        $this->load->model('Role_model'); 
    }

    public function index() {
        redirect(base_url('list_items'));
    }

    public function list_items() {
            $data['page_title'] = "Role List";
            $data['page'] = "list_items";
            $data['breadcrumb'] = array("Dashboard"=>  base_url('dashboard/'), "Role List"=>  base_url('role/list_items'));
            _layout($data);
    }

    public function list_items_ajax() {
            $res = $this->Role_model->list_items_ajax();
            echo json_encode($res);    
    }    

    // ------------------------------------------------------------------------
    /**
     * Add
     *
     * function add new User
     * 
     * @access	public
     */
    public function add() {
        
        if ($this->form_validation->run("role/add") == TRUE) {          
            $id = $this->Role_model->add();
            if ($id) {
             $this->session->set_flashdata("alert",array("c"=>"s","m"=>"Role Added Successfully. "));
                redirect('role/list_items');
            } 
        }
        $data['title'] = "Add Role";
        $data['page_title'] = "Add Role";
        $data['page'] = "add";
        $data['breadcrumb'] = array("Dashboard"=>  base_url("dashboard/"),"Role List"=>  base_url('role/list_items'), "Add Role"=>  base_url('role/add'));
        _layout($data);
    }
    
    
        public function edit($id="") {
		//pr($_POST);
        $id = ID_decode($this->uri->segment('3'));
        //print_r($id);die;
        $data['res'] = $this->Role_model->viewData($id);
        //print_r($data['res']);die;
        if ($this->form_validation->run("role/edit") == TRUE) {
            $this->Role_model->edit($id);
            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Role Updated Successfully. "));
            redirect('role/list_items');
        }
        $data['title'] = "Edit Role";
        $data['page_title'] = "Edit Role";
        $data['page'] = "role/add";
        $data['breadcrumb'] = array("Dashboard"=>  base_url("dashboard/"),"Role List"=>  base_url('role/list_items'), "Edit Role"=> "");
        _layout($data);
    }
    
    
       
    function delete(){
        $id= $_POST['id'];
        $res = $this->Role_model->delete($id);
        //pr($res);die;
        echo json_encode($res);
    }
    
    

    public function edit1($id) {
        
        if (empty($id)) { 
            redirect('role/list_items/');
        } else { 
            if (isPostBack()) {     
                $result = $this->Role_model->edit(base64_decode($id));                
                if ($result['valid']) {

                     $this->session->set_flashdata("alert",array("c"=>"s","m"=>"Role Updated Successfully. "));
                    redirect('role/list_items/');
                } else {
                    $errormsg = 'Profile could not be updated, Please try again later';
                    $data['error_msg'] = $errormsg;
                }
            }

            $views = 'edit';
            $data['title'] = "Edit Role";
            $data['id'] = base64_decode($id);
            $data['update'] = $this->Role_model->get_user_by_id(base64_decode($id));
            $this->breadcrumbcomponent->add('Home <li><i class="fa fa-circle"></i></li>', base_url() . "dashboard");
            $this->breadcrumbcomponent->add('Role <li><i class="fa fa-circle"></i></li>', base_url() . "role/list_items/");
            $this->breadcrumbcomponent->add('Edit', base_url());
            $data['header']['bread_cum'] = $this->breadcrumbcomponent->output();
            admin_layout($views, $data);
        }
    }

    public function checkEmail() {

        $email = $_GET['email'];
        if (!empty($email)) {
            $this->db->where('email', $email);
            $result = $this->db->get('rw_roles')->row_array();
            if (count($result) > 0) {
                echo "false";
            } else {
                echo "true";
            }
        }
    }

    public function checkPhone() {

        $mobile = $_GET['mobile'];
        if (!empty($mobile)) {
            $this->db->where('contact_no', $mobile);
            $result = $this->db->get('rw_roles')->row_array();
            if (count($result) > 0) {
                echo "false";
            } else {
                echo "true";
            }
        }
    }

    public function checkEditEmail() {

        $email = $_GET['email'];
        $id = $_GET['id'];
        if (!empty($email)) {
            $this->db->where('email', $email);
            $this->db->where('id !=', $id);
            $result = $this->db->get('rw_roles')->row_array();
            if (count($result) > 0) {
                echo "false";
            } else {
                echo "true";
            }
        }
    }

    public function checkEditPhone() {

        $mobile = $_GET['mobile'];
        $id = $_GET['id'];
        if (!empty($mobile)) {
            $this->db->where('contact_no', $mobile);
            $this->db->where('id !=', $id);
            $result = $this->db->get('rw_roles')->row_array();
            if (count($result) > 0) {
                echo "false";
            } else {
                echo "true";
            }
        }
    }

    public function view($id) {
        if (empty($id)) {
            redirect('customer/list_items/');
        } else {

            $views = 'view';
            $data['title'] = "View Role";
            $data['id'] = base64_decode($id);
            $data['customer'] = $this->Role_model->get_user_by_id(base64_decode($id));
            $this->breadcrumbcomponent->add('Home <li><i class="fa fa-circle"></i></li>', base_url() . "dashboard");
            $this->breadcrumbcomponent->add('Role <li><i class="fa fa-circle"></i></li>', base_url() . "role/list_items/");
            $this->breadcrumbcomponent->add('View Role', base_url());
            $data['header']['bread_cum'] = $this->breadcrumbcomponent->output();
            admin_layout($views, $data);
        }
    }

    /*    public function delete($id)
      {
      if(empty($id))
      {
      redirect('customer/list_items/');

      }else{

      $res = $this->Role_model->delete_user(base64_decode($id));
      //echo $res;die;
      if ($res>0) {

      $this->session->set_flashdata("success", " Role deleted successfully .");
      redirect('role/list_items/');
      } else
      {

      $this->session->set_flashdata("error", "Role could not be updated, Please try again latter .");
      redirect('role/list_items/');

      }
      }
      } */

    /**
     * export()
     *
     * This function export Customer Level against id
     * 
     * @access	public
     * @return	boolean data
     */
    public function export() {
        $items = $this->input->get_post('items', TRUE);

        $data1 = array();
        if ($items) {
            if ($items == 'ALL') {
                $query = $this->db->select("role_name,(CASE when status = 1 then 'Active' else 'Inactive' end) AS status,created_date")->get_where('rw_roles', array('is_deleted' => '0'));
                if ($query->num_rows()) {
                    $data1 = $query->result_array();
                }
            } else {
                $items = trim($items, ",");
                $items = isset($items) && !empty($items) ? explode(',', $items) : '';
                $this->db->where_in('id', $items);
                   $query = $this->db->select("role_name,(CASE when status = 1 then 'Active' else 'Inactive' end) AS status,created_date")->get_where('rw_roles', array('is_deleted' => '0'));
                if ($query->num_rows()) {
                    $data1 = $query->result_array();
                }
            }
        }
        $data2 = array(
            '0' => array(
                'role_name' => "Role Name",                                
                'status' => "status",
                'created_date' => "Created Date",
            ),
        );
        $data = array_merge($data2, $data1);

        $filename = "role " . date('Ymd') . ".xls";
        array_to_excel($data, $filename);
    }

    public function delete1() {

        if ($this->input->is_ajax_request()) {
            $ids = $this->input->post('id', true);
            $ids_arr = isset($ids) && !empty($ids) ? explode(',', $ids) : array();
//            pr($ids_arr); die;
            if (isset($ids_arr) && !empty($ids_arr)) {
                $this->db->where_in('id', $ids_arr);
                $conditions = array('id !=' => '');
                $updata = array('is_deleted' => 1);
                $qry = $this->common_mod->update('rw_roles', $conditions, $updata);
                echo $this->db->last_query(); die;
                if ($qry) {
                    clearPostData();
                    set_flashmsg('success', 'Role deleted Successfully');
                    echo true;
                } else {
                    set_flashmsg('error', 'Sorry Role does not deleted Successfully');
                    echo false;
                }
            }
        } else {
            set_flashmsg('error', 'cross site attack');
            echo false;
        }
    }

    function getLatLong() {
        $views = 'getlatlong';
        admin_layout($views);
    }

    /**
     * downloadpdf()
     *
     * This function download PDF customer detail Level against id
     * 
     * @access	public
     * @return	boolean data
     */
    
    function assign_permission(){

        $data['title'] = "Assign Permission";
        $data['page_title'] = "Assign Permission";
        $data['page'] = "assign_permission";
        $data['breadcrumb'] = array("Dashboard"=>  base_url("dashboard/"),"Role List"=>  base_url('role/list_items'), "Assign Permission"=> "");
        $user_id = base64_decode($this->uri->segment(3));
        //pr($user_id);die;
        $type   =   '';        
        $data['modules'] = $this->Role_model->getAllModules();  
        if($this->uri->segment('4')  ==  'role'){
            $type   =   'role';
            
        }else if($this->uri->segment('4')  ==  'user'){
            $type   =   'user';
        }          
        $result = $data['userData'] = $this->Role_model->getUserData($user_id,$type);  
        
//        pr($result); die;
        $per = array();        
        $perR = json_decode(@$result->permission_ids,true);              
        $role_permissions = $per['role_permissions'] = empty(json_decode($result->role_permissions,true))?array():json_decode($result->role_permissions,true);
        $per["all_role_permissions"] = $this->Role_model->get_all_roles();
        $user_extra_permission   = $per['user_extra_permission'] = empty(json_decode(@$result->user_extra_permission,true))?array():json_decode($result->user_extra_permission,true);        
        $user_removed_permission = $per['user_removed_permission'] = empty(json_decode(@$result->user_removed_permission,true))?array():json_decode($result->user_removed_permission,true);                
// 
//        pr($per); die;  
        $totalPermission =  $role_permissions+$user_extra_permission;
//        pr($totalPermission); die;
        $perA = array();
        foreach($totalPermission as $k => $v) {            
            if(array_key_exists($k, $role_permissions) ){
                $uep = empty($user_extra_permission[$k])?array():$user_extra_permission[$k];
                $rp = empty($role_permissions[$k])?array():$role_permissions[$k];
                $result1  =  array_merge($uep,$rp);
//                pr($result); die;
                if(array_key_exists($k, $user_removed_permission)){
                    $result1 = array_values(array_diff($result1,$user_removed_permission[$k]));               
                }
                $perA[$k] = $result1; 
//                pr($perA); die;
            }
            
            if(!array_key_exists($k, $role_permissions)){
                $perA[$k] = $user_extra_permission[$k];                        
            }
        }
             
//        pr($perA); die;
        $data['permAssigned'] = ($type=="role")?$perR:$perA;    
        if(isPostBack()){             
            $this->Role_model->assign_permission($per);
        }
        _layout($data);
    }
   
}
