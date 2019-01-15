<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Leadmanagement Controller
 *
 * @package		Leadmanagement
 * @category	Leadmanagement 
 * @author	    Sandeep
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
class Complaint extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Complaint_model");
        $this->load->model("salesperson/salesperson_model");
       // $this->load->model("salespersonactivity/salespersonactivity_model");
    
    }

    public function index() {
        //$this->load->view('lead_view');
        $this->list_items();
    }

    //-------------------------------------LISTING--------------------------------------------------------


    function list_items() {

       // $data['salesperson'] = $this->salespersonactivity_model->getsalesperson();
        $data['manager'] = $this->salesperson_model->get_manager_user();
        $data['coordinator']=$this->Complaint_model->getallservicecordinator();
        $data['serviceperson']=$this->Complaint_model->getallserviceperson();

        $data['title'] = "Complaint List";
        $data['page_title'] = "Complaint List";
        $data['page'] = "list_items";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "List Complaint" => base_url('complaint/list_items'));
        _layout($data);
    }

    function list_items_ajax() {
        $res = $this->Complaint_model->list_items_ajax();

        echo json_encode($res);
    }
    
    
    //-------------------------------------ADD--------------------------------------------------------


    function add() {

        $data['complaint_type'] = get_where("pr_type_complaint", array("status" => "1"));
        $data['title'] = "Add Complaint";
        $data['page_title'] = "Add Complaint";
        $data['page'] = "add";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "List Complaint" => base_url('complaint/list_items'), "Add Complaint" => base_url('complaint/add'));
        if (isPostback()) {
          //  $this->form_validation->set_rules('type_of_lead', 'Please Select one type of lead!', "required");
            $this->form_validation->set_rules('client_name', 'Client Name cannot be blank!', "required");
            //$this->form_validation->set_rules('website', 'Please Enter Website', "required");
            if(empty($_POST['location']) && empty($_POST['address'])){
                $this->form_validation->set_rules('location', 'Please Enter Location or Address', "required");
                $this->form_validation->set_rules('address', 'Please Enter Address or Location', "required");
            }
            $this->form_validation->set_rules('contact_person', 'Please Enter Contact Person', "required");
            $this->form_validation->set_rules('contact_number', 'Contact Number cannot be blank', 'min_length[10]|max_length[10]|numeric|required');
            $this->form_validation->set_rules('email_id', 'Email id', 'required|valid_email|regex_match[/^[a-zA-z0-9@._]+$/]');  
            $this->form_validation->set_rules('priority', 'Please Select Priority', "required");
            $this->form_validation->set_rules('complaint_type', 'Please Select Complaint Type', "required|numeric");
            $this->form_validation->set_rules('dg_set_no', 'Please Enter DG Set Number', "required");
            $this->form_validation->set_rules('kva', 'Please KVA', "required");
            $this->form_validation->set_rules('eng_alt', 'Please Enter Engine/Alternator', "required");
            $this->form_validation->set_rules('performance', 'Please Select Performance', "required");
            $this->form_validation->set_rules('efforts', 'Please Select Efforts', "required");
            $this->form_validation->set_rules('status', 'Status', 'required');



            if ($this->form_validation->run()) {

               // pr($_POST);die;
                $this->Complaint_model->add();
                $this->session->set_flashdata("alert", array("c" => "s", "m" => "Complaint Added Successfully. "));
                redirect("complaint/list_items");
            }
        }
       
        $ins_id = $this->Complaint_model->last_id_get();
        $ins_ids = $ins_id->id + 1;
        $data['res']->dynamic_complaint_id= "comp$ins_ids";
        //$data['dymic_complaint_id'] = "comp$ins_ids";

        _layout($data);
    }

    //-------------------------------------EDIT--------------------------------------------------------


    public function edit($id) {


        $id = ID_decode($id);
        $data['complaint_type'] = get_where("pr_type_complaint", array("status" => "1"));
        $data['title'] = "Edit Complaint";
        $data['page_title'] = "Edit Complaint";
        $data['page'] = "add";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "List Complaint" => base_url('complaint/list_items'), "Edit Complaint" => "");
       
        $data['res'] = $this->Complaint_model->viewData($id);
        //pr($data['res']);
        if (isPostback()) {
            //  $this->form_validation->set_rules('type_of_lead', 'Please Select one type of lead!', "required");
              $this->form_validation->set_rules('client_name', 'Client Name cannot be blank!', "required");
              //$this->form_validation->set_rules('website', 'Please Enter Website', "required");
              if(empty($_POST['location']) && empty($_POST['address'])){
                  $this->form_validation->set_rules('location', 'Please Enter Location or Address', "required");
                  $this->form_validation->set_rules('address', 'Please Enter Address or Location', "required");
              }
              $this->form_validation->set_rules('contact_person', 'Please Enter Contact Person', "required");
              $this->form_validation->set_rules('contact_number', 'Contact Number cannot be blank', 'min_length[10]|max_length[10]|numeric|required');
              $this->form_validation->set_rules('email_id', 'Email id', 'required|valid_email|regex_match[/^[a-zA-z0-9@._]+$/]');  
              $this->form_validation->set_rules('priority', 'Please Select Priority', "required");
              $this->form_validation->set_rules('complaint_type', 'Please Select Complaint Type', "required|numeric");
              $this->form_validation->set_rules('dg_set_no', 'Please Enter DG Set Number', "required");
              $this->form_validation->set_rules('kva', 'Please KVA', "required");
              $this->form_validation->set_rules('eng_alt', 'Please Enter Engine/Alternator', "required");
              $this->form_validation->set_rules('performance', 'Please Select Performance', "required");
              $this->form_validation->set_rules('efforts', 'Please Select Efforts', "required");
              $this->form_validation->set_rules('status', 'Status', 'required');
  
  
  
              if ($this->form_validation->run()) {
  
                 // pr($_POST);die;
                  $this->Complaint_model->edit($id);
                  $this->session->set_flashdata("alert", array("c" => "s", "m" => "Complaint Updated Successfully. "));
                  redirect("complaint/list_items");
              }
          }
         // pr($data);die;
        _layout($data);
    }

    //-------------------------------------VIEW--------------------------------------------------------

    public function view($id) {
        
        $id = ID_decode($id);
        if (!empty($id)) {
            $data['res'] = $this->Complaint_model->view($id);
            
            $data['meeting']=$this->Complaint_model->view_meeting($id);
            $data['serviceperson'] = $this->Complaint_model->getserviceperson(@$data['res']->manager_id, $data['res']->coordinator_id);
            $data['title'] = 'View Complaint';
            $data['page_title'] = 'View Complaint';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Complaint List" => base_url('complaint/list_items'), "View Complaint" => "");
            $location = 'view';
            $data['page'] = "view_complaint";
            //$data['page'] = "view";
            //pr($data);die;
            _layout($data);
        }
    }

    //-------------------------------------DELETE--------------------------------------------------------

    function delete() {
        $id = $_POST['id'];
        $res = $this->Complaint_model->delete($id);
        if ($res['status'] != "false") {

            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Location Deleted Successfully. "));
            echo json_encode($res);
        } else {
            $this->session->set_flashdata("alert", array("c" => "d", "m" => "Location Already Assigned !"));
            echo json_encode($res);
        }
    }

    //-------------------------------------MULTIPLE DELETE--------------------------------------------------------

    public function delete_multiple() {
        $id = $_POST['ids'];

        $res = $this->Complaint_model->delete_multiple($id);
        if ($res == "true") {
            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Location Deleted Successfully. "));
            echo json_encode($res);
        } else {
            $this->session->set_flashdata("alert", array("c" => "d", "m" => "Something Went Wrong ! "));
            echo json_encode($res);
        }
    }

    public function unique_location() {
        $location = $this->input->post('location_name');
        $id = ID_decode($this->uri->segment('4'));
        // pr($id);die;
        if ($url_check = $this->unique_edit_location($location, $id)) {
            return TRUE;
        }
        $this->form_validation->set_message('unique_location', 'This Location is already registered');
        return FALSE;
    }

    function unique_edit_location($location, $id = null) {
        if ($id != '') {
            $this->db->where("id !=", $id);
        }
        $this->db->select("location_name");
        $this->db->where("location_name", $location);
        $this->db->where('is_deleted', '0');
        $query = $this->db->get('pr_location')->num_rows();

        // echo $this->db->last_query();die;
        if ($query > 0) {
            return 0;
        } else {
            return 1;
        }
    }

    ///Assign Activity 

    function assign_activity($id) {

        $id = ID_decode($id);
        $ins_id = $this->Complaint_model->last_id_assign_activity();
        $data['res'] = $this->Complaint_model->viewActivity($id);
        $data['static_coordinator'] = $this->Complaint_model->static_coordinator();
        $data['static_serviceperson'] = $this->Complaint_model->static_serviceperson();
        $ins_ids = $ins_id->id + 1;
        if(check_complaint_assigned($id)){
            $data['dymanic_meeting_id'] ="mtng".$ins_ids;
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "List Activity" => base_url('complaint/list_items'), "Assign Activity" => "");
            $data['title'] = "Assign Activity";
            $data['page_title'] = "Assign Activity(Complaint)";
        }else{
            $data['dymanic_meeting_id'] =$data['res']->meeting_id;
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "List Activity" => base_url('complaint/list_items'), "Edit Activity" => "");
            $data['title'] = "Edit Activity";
            $data['page_title'] = "Edit Activity(Complaint)";
        }
        
        $data['res_lead'] = $this->Complaint_model->viewData($id);
        $data['manager'] = $this->salesperson_model->get_manager_user();
      
        $data['page'] = "assign_activity";

       
        //pr($data['res']);
        $data['cordinator'] = $this->Complaint_model->getservicecordinator(@$data['res']->manager_id);
        $data['serviceperson'] = $this->Complaint_model->getserviceperson(@$data['res']->manager_id, $data['res']->coordinator_id);


        //pr($data);die;
       
        if (isPostback()) {
    //pr($_POST);die;
        if(getUserInfos()->role == "0"){
            $this->form_validation->set_rules('manager_id', 'Manager name', "trim|required");
            $this->form_validation->set_rules('cordinator_id', 'Cordinator Name', "trim|required");
            }
            if(getUserInfos()->role == "1"){
            $this->form_validation->set_rules('cordinator_id', 'Cordinator Name', "trim|required");
            }
            // $this->form_validation->set_rules('manager_id', 'Manager', 'trim|required');
            // $this->form_validation->set_rules('serviceperson_id', 'Service Person', 'trim|required');
            $this->form_validation->set_rules('cordinator_id', 'Cordinator', 'trim|required');
            $this->form_validation->set_rules('location', 'Location', 'trim|required');
            $this->form_validation->set_rules('activity', 'Activity', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
            $this->form_validation->set_rules('meeting_date', 'Meeting Date', 'trim|required');
            $this->form_validation->set_rules('start_time', 'Meeting Start Time', 'trim|required');
            $this->form_validation->set_rules('end_time', 'Meeting End Time', 'trim|required|callback_checktime');
            $this->form_validation->set_rules('status', 'Status', 'required');
            if ($this->form_validation->run()) {

                // $this->Complaint_model->assign_activity_add($id);
                // $this->session->set_flashdata("alert", array("c" => "s", "m" => "Complaint Assigned Successfully. "));

                 if (empty($data['res'])) {
                    $this->Complaint_model->assign_activity_add($id);
                    $this->session->set_flashdata("alert", array("c" => "s", "m" => "Complaint Assigned Successfully. "));
                } else {
                    $this->Complaint_model->assign_activity_edit($id);
                    $this->session->set_flashdata("alert", array("c" => "s", "m" => "Complaint Assigned Updated Successfully. "));
                } 
                redirect("complaint/list_items");
            }
     
    }
        _layout($data);
    }

    public function checktime($var)
    {
        $start_time=@$this->input->post('start_time', true);
        $end_time=@$this->input->post('end_time', true);
       
        $Start = date("Y-m-d H:i:s", strtotime($start_time));
        $End = date("Y-m-d H:i:s", strtotime($end_time));
   
    
        $diff = strtotime($End) - strtotime($Start);
        $diff_in_min = ($diff *60)/ 3600;
   
       
            if($diff_in_min<=0)
            {
                $this->form_validation->set_message('checktime', 'End time should be greater than Start time.');
                return False;
            }else{
                return True;
            }

}
     /***************get Service Person starts 27-12-2018 *********************/
    
    
    
     public function getserviceperson() {
        $coordinator_id = $_POST['cordinator_id'];
        $manager_id = $_POST['manager_id'];
       /*  echo "coordinator ".$coordinator_id;
        echo "manager ".$manager_id;die; */
        $subData =$this->Complaint_model->getserviceperson($manager_id, $coordinator_id);
        $output = '';
        if (!empty($subData)) {
            $output .= '<option value=""> Select Service Person</option>';
            foreach ($subData as $type) {
                $output .= '<option value="' . $type->id . '">' . ucwords($type->fname) . ' ' . ucwords($type->lname) . '</option>';
            }
        } else {
            $output .= '<option value=""> No Service Person Available</option>';
        }
        echo $output;
        exit;
    }
         /***************get Service Person ends 27-12-2018 *********************/

    function list_items_activity() {
        $id = ID_decode($this->uri->segment('3'));
        $data['result'] = $this->Complaint_model->getall_activity();
       // pr($data);die;
        $data['manager'] = $this->salesperson_model->get_manager_user();
        $data['coordinator']=$this->Complaint_model->getallservicecordinator();
        $data['serviceperson']=$this->Complaint_model->getallserviceperson();
        $data['res'] = $this->Complaint_model->viewData_2($id);
        $data['manager']=getUserInfo($data['res']->manager_id);
        $data['cordinator']=getUserInfo($data['res']->cordinator_id);
        $data['title'] = "List of Activity (Complaint)";
        $data['page_title'] = "List of Activity (Complaint)";
        $data['page'] = "list_items_activity";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Activity History (Complaint)" => base_url('complaint/list_items_activity_history'), "List of Activity (Complaint)" => "");
        _layout($data);
        
    }

         function list_items_activity_ajax() {
            $res = $this->Complaint_model->list_items_activity_ajax();
    
            echo json_encode($res);
        } 
        public function view_activity($id) {
            $id = ID_decode($id);
          
            if (!empty($id)) {
                $data['res'] = $this->Complaint_model->view_activity($id);
          
                $data['title'] = 'View Activity
                 (Complaint)';
                $data['page_title'] = 'View Activity (Complaint)';
                $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "List of Activity (Complaint)" => base_url('complaint/list_items_activity/'.ID_encode($data['res']->serviceperson_id)), "View Activity (Complaint)" => "");
              
                $data['page'] = "view_activity";
              
                _layout($data);
            }
        }
        function list_items_activity_history() {
        
       
            $data['title'] = "Activity History (Complaint)";
            $data['page_title'] = "Activity History (Complaint)";
            $data['page'] = "list_items_activity_history";
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Activity History (Complaint)" => base_url('complaint/list_items_activity_history'));
            _layout($data);
        }
    
        function list_items_activity_history_ajax() {
            $res = $this->Complaint_model->list_items_activity_history_ajax();
            echo json_encode($res);
        }

        function list_items_app_disapp() {
            $id = ID_decode($this->uri->segment('3'));
            $data['serviceperson'] = $this->Complaint_model->getallserviceperson();
            $data['manager'] = $this->salesperson_model->get_manager_user();
            $data['coordinator']=$this->Complaint_model->getallservicecordinator();
            
          // pr($data);die;
            $data['title'] = "Approve/Disapprove Previous Activity (Complaint)";
            $data['page_title'] = "Approve/Disapprove Previous Activity (Complaint)";
            $data['page'] = "list_items_app_disapp";
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'),"Approve/Disapprove Previous Activity (Complaint)" => base_url('complaint/list_items_app_disapp'));
            _layout($data);
        }
    
        function list_items_ajax_app_disapp() {
            $res = $this->Complaint_model->list_items_ajax_app_disapp();
            echo json_encode($res);
        }
    
        public function view_app_disapp($id) {
            $id = ID_decode($id);
          
            if (!empty($id)) {
                $data['res'] = $this->Complaint_model->view_app_disapp($id);
                $data['title'] = 'View Approve/Disapprove Activity (Complaint)';
                $data['page_title'] = 'View Approve/Disapprove Activity (Complaint)';
                $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Approve/Disapprove Previous Activity (Complaint)" => base_url('complaint/list_items_app_disapp'), "View Approve/Disapprove Activity (Complaint)" => "");
                $data['page'] = "view_app_disapp";
              
                _layout($data);
            }
        }


        public function getservicecordinator_ajax() {
            $manager_id = $_POST['manager_id'];
           /*  echo "coordinator ".$coordinator_id;
            echo "manager ".$manager_id;die; */
            $subData =$this->Complaint_model->getservicecordinator($manager_id);
            $output = '';
            if (!empty($subData)) {
                $output .= '<option value=""> Select Coordinator Person</option>';
                foreach ($subData as $type) {
                    $output .= '<option value="' . $type->id . '">' . ucwords($type->fname) . ' ' . ucwords($type->lname) . '</option>';
                }
            } else {
                $output .= '<option value=""> No Coordinator Person Available</option>';
            }
            echo $output;
            exit;
        }


        
    /************************************reschedule Activity Starts 26-12-2018  */

    function list_items_reschedule_activity() {
        $id = ID_decode($this->uri->segment('3'));
        $data['serviceperson'] = $this->Complaint_model->getallserviceperson();
        $data['manager'] = $this->salesperson_model->get_manager_user();
        $data['coordinator']=$this->Complaint_model->getallservicecordinator();
        
      // pr($data);die;
        $data['title'] = "Reschedule Activity (Complaint)";
        $data['page_title'] = "Reschedule Activity (Complaint)";
        $data['page'] = "list_items_reschedule_activity";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'),"Reschedule Activity (Complaint)" => base_url('complaint/list_items_reschedule_activity'));
        _layout($data);
    }

    function list_items_ajax_reschedule_activity() {
        $res = $this->Complaint_model->list_items_ajax_reschedule_activity();
        echo json_encode($res);
    }

    public function view_reschedule_activity($id) {
        $id = ID_decode($id);
      
        if (!empty($id)) {
            $data['res'] = $this->Complaint_model->view_reschedule_activity($id);
            $data['title'] = 'View Reschedule Activity (Complaint)';
            $data['page_title'] = 'View Reschedule Activity (Complaint)';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Reschedule Activity (Complaint)" => base_url('complaint/list_items_reschedule_activity'), "View Reschedule Activity (Complaint)" => "");
            $data['page'] = "view_reschedule_activity";
          
            _layout($data);
        }
    }

   public function change_employee(){
 //pr($_POST);die;
        $res = $this->Complaint_model->change_employee($_POST);
        if ($res['status'] != "false") {

            $this->session->set_flashdata("alert", array("c" => "s", "m" => "New Sales Person Assigned Successfully. "));
            echo json_encode($res);
        } else {
            $this->session->set_flashdata("alert", array("c" => "d", "m" => "New Sales Person Can not Assigned!"));
            echo json_encode($res);
        }
    
    
    
} 
public function update_disapp($id)
{
    $id = ID_decode($id);
    //echo "disaapprove";die;
    $this->Complaint_model->update_disapp($id);
    $this->list_items_app_disapp();

}
public function update_app($id)
{
    $id = ID_decode($id);
   // echo "approve";die;
    $this->Complaint_model->update_app($id);
    $this->list_items_app_disapp();
    
}
    

}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */