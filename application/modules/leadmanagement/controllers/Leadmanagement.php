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
class Leadmanagement extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Leadmanagement_model");
        $this->load->model("salesperson/salesperson_model");
        $this->load->model("salespersonactivity/salespersonactivity_model");
    }

    public function index() {
        //$this->load->view('lead_view');
    }

    //-------------------------------------LISTING--------------------------------------------------------


    function list_items() {
        $data['salesperson'] = $this->salespersonactivity_model->getsalesperson();
        $data['manager'] = $this->salesperson_model->get_manager_user();
        $data['coordinator']=$this->salesperson_model->getallsalescordinator();


        $data['title'] = "Lead List";
        $data['page_title'] = "Lead List";
        $data['page'] = "list_items";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "List Lead" => base_url('leadmanagement/list_items'));
        _layout($data);
    }

    function list_items_ajax() {
        $res = $this->Leadmanagement_model->list_items_ajax();

        echo json_encode($res);
    }

    //-------------------------------------ADD--------------------------------------------------------


    function add() {

        $data['type_of_lead'] = get_where("pr_type_lead", array("status" => "1"));
        $data['title'] = "Add Lead";
        $data['page_title'] = "Add Lead";
        $data['page'] = "add";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "List Lead" => base_url('leadmanagement/list_items'), "Add Lead" => base_url('leadmanagement/add'));
        if (isPostback()) {
            $this->form_validation->set_rules('type_of_lead', 'Please Select one type of lead!', "required");
            $this->form_validation->set_rules('client_name', 'Client Name cannot be blank!', "required");
            $this->form_validation->set_rules('website', 'Please Enter Website', "required");
            if(empty($_POST['location']) && empty($_POST['address'])){
                $this->form_validation->set_rules('location', 'Please Enter Location or Address', "required");
                $this->form_validation->set_rules('address', 'Please Enter Address or Location', "required");
            }
            $this->form_validation->set_rules('contact_person', 'Please Enter Contact Person', "required");

            $this->form_validation->set_rules('priority', 'Please Select Priority', "required");
            $this->form_validation->set_rules('notes', 'Please Enter Notes', "required");
            $this->form_validation->set_rules('email_id', 'Email id', 'required|valid_email|regex_match[/^[a-zA-z0-9@._]+$/]');
            $this->form_validation->set_rules('contact_number', 'Contact Number cannot be blank', 'min_length[10]|max_length[15]|numeric|required');
            $this->form_validation->set_rules('status', 'Status', 'required');



            if ($this->form_validation->run()) {


                $this->Leadmanagement_model->add();
                $this->session->set_flashdata("alert", array("c" => "s", "m" => "Lead Added Successfully. "));
                redirect("leadmanagement/list_items");
            }
        }
        $ins_id = $this->Leadmanagement_model->last_id_get();
        $ins_ids = $ins_id->id + 1;
        $data['dymic_lead_id'] = "OD$ins_ids";

        _layout($data);
    }

    //-------------------------------------EDIT--------------------------------------------------------


    public function edit($id) {


        $id = ID_decode($id);
        $data['type_of_lead'] = get_where("pr_type_lead", array("status" => "1"));
        $data['res'] = $this->Leadmanagement_model->viewData($id);
        //pr($data['res']);die;
        if (isPostback()) {
            $this->form_validation->set_rules('type_of_lead', 'Please Select one type of lead!', "required");
            $this->form_validation->set_rules('client_name', 'Client Name cannot be blank!', "required");
            $this->form_validation->set_rules('website', 'Please Enter Website', "required");
            if(empty($_POST['location']) && empty($_POST['address'])){
                $this->form_validation->set_rules('location', 'Please Enter Location or Address', "required");
                $this->form_validation->set_rules('address', 'Please Enter Address or Location', "required");
            }
            $this->form_validation->set_rules('contact_person', 'Please Enter Contact Person', "required");

            $this->form_validation->set_rules('priority', 'Please Select Priority', "required");
            $this->form_validation->set_rules('notes', 'Please Enter Notes', "required");
            $this->form_validation->set_rules('email_id', 'Email id', 'required|valid_email|regex_match[/^[a-zA-z0-9@._]+$/]');
            $this->form_validation->set_rules('contact_number', 'Contact Number cannot be blank', 'min_length[10]|max_length[15]|numeric|required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            if ($this->form_validation->run()) {
                $this->Leadmanagement_model->edit($id);
                $this->session->set_flashdata("alert", array("c" => "s", "m" => "Lead Updated Successfully. "));
                redirect('leadmanagement/list_items');
            }
        }
        $data['title'] = "Edit Lead";
        $data['page_title'] = "Edit Lead";
        $data['page'] = "add";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Lead List" => base_url('leadmanagement/list_items'), "Edit Lead" => "");

        _layout($data);
    }

    //-------------------------------------VIEW--------------------------------------------------------

    public function view($id) {
        $id = ID_decode($id);
        if (!empty($id)) {
            $data['res'] = $this->Leadmanagement_model->view($id);
            $data['meeting']=$this->Leadmanagement_model->view_meeting($id);
            $data['salesperson'] = $this->salesperson_model->getsalesperson(@$data['res']->manager_id, $data['res']->coordinator_id);            
            
            //pr($data);die;
            $data['title'] = 'View Lead';
            $data['page_title'] = 'View Lead';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Lead List" => base_url('leadmanagement/list_items'), "View Lead" => "");
            $location = 'view';
            $data['page'] = "view_lead";
            //$data['page'] = "view";
            _layout($data);
        }
    }

    //-------------------------------------DELETE--------------------------------------------------------

    function delete() {
        $id = $_POST['id'];
        $res = $this->Leadmanagement_model->delete($id);
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

        $res = $this->Leadmanagement_model->delete_multiple($id);
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
        $data['res_lead'] = $this->Leadmanagement_model->viewData($id);
        $data['manager'] = $this->salesperson_model->get_manager_user();
        $data['title'] = "Assign Activity";
        $data['page_title'] = "Assign Activity";
        $data['page'] = "assign_activity";
        $data['static_coordinator'] = $this->salesperson_model->static_coordinator();
        $data['static_salesperson'] = $this->salesperson_model->static_salesperson();
       // pr($data['static_salesperson']);die;
        
        $data['res'] = $this->Leadmanagement_model->viewActivity($id);
        $data['cordinator'] = $this->salesperson_model->getsalescordinator(@$data['res']->manager_id);
        $data['salesperson'] = $this->salesperson_model->getsalesperson(@$data['res']->manager_id, $data['res']->coordinator_id);


        //pr($data);die;
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "List Lead" => base_url('leadmanagement/list_items'), "Assign Activity" => "");
        if (isPostback()) {
            if(getUserInfos()->role == "0"){
            $this->form_validation->set_rules('manager_id', 'Manager', 'trim|required');
            $this->form_validation->set_rules('cordinator_id', 'Cordinator', 'trim|required');
            }
            if(getUserInfos()->role == "1"){
                $this->form_validation->set_rules('cordinator_id', 'Cordinator', 'trim|required');
                }
            $this->form_validation->set_rules('salesperson_id', 'Salesperson', 'trim|required');
          
            $this->form_validation->set_rules('location', 'Location', 'trim|required');
            $this->form_validation->set_rules('activity', 'Activity', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
            $this->form_validation->set_rules('meeting_date', 'Meeting Date', 'trim|required');
            $this->form_validation->set_rules('start_time', 'Meeting Start Time', 'trim|required');
            $this->form_validation->set_rules('end_time', 'Meeting End Time', 'trim|required|callback_checktime');
            $this->form_validation->set_rules('status', 'Status', 'required');
            if ($this->form_validation->run()) {
                if (empty($data['res'])) {
                    $this->Leadmanagement_model->assign_activity_add($id);
                    $this->session->set_flashdata("alert", array("c" => "s", "m" => "Lead Assigned Successfully. "));
                } else {
                    $this->Leadmanagement_model->assign_activity_edit($id);
                    $this->session->set_flashdata("alert", array("c" => "s", "m" => "Lead Assigned Updated Successfully. "));
                }
                redirect("leadmanagement/list_items");
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
public function change_employee(){
 
        $res = $this->Leadmanagement_model->change_employee($_POST);
        if ($res['status'] != "false") {

            $this->session->set_flashdata("alert", array("c" => "s", "m" => "New Sales Person Assigned Successfully. "));
            echo json_encode($res);
        } else {
            $this->session->set_flashdata("alert", array("c" => "d", "m" => "New Sales Person Can not Assigned!"));
            echo json_encode($res);
        }
    
    
    
}
 function export() { 
            $data['exportdata'] = array();
            $export = $this->Leadmanagement_model->export();
            
            //pr($export);die;
            $data['tabl_header'] = array(
                '0' => array('dymic_lead_id' => 'Lead ID',
                    'type_of_lead' => 'Type of Lead',
                    'client_name' => 'Client Name',
                    'contact_person' => 'Contact Person',
                    'contact_number' => 'Contact',
                    'location' => 'Location',
                    'address' => 'Address',
                    'email_id   ' => 'Email ID',
                    'priority' => 'Priority',
                    'notes  ' => 'Notes',
                    'manager_name' => 'Manager',
                    'cordinator_name' => 'Coordinator',
                    'sales_name' => 'Sales Person',
                    'website' => 'Website',
                    'outcome_status'=>'Outcome Status',
                    'added_by' => 'Added By',
                    'created_date' => 'Date',
                    'status' => 'Status'
                ),
            );
            $datahead = $data['tabl_header'];
            foreach ($export as $export_data) {
                if ($export_data->priority == '1') {
                    $priority = 'Low';
                }
                if ($export_data->priority == '2') {
                    $priority = 'Medium';
                }
                if ($export_data->priority == '3') {
                    $priority = 'High';
                }
                if ($export_data->outcome_status == '0') {
                    $outcome_status = ' In Process';
                }
                 elseif ($export_data->outcome_status == '1') {
                    $outcome_status = ' Won';
                }
                elseif ($export_data->outcome_status == '2') {
                    $outcome_status = ' Lost';
                }
                elseif ($export_data->outcome_status == '3') {
                    $outcome_status = ' Continue';
                }
                elseif ($export_data->outcome_status == '4') {
                    $outcome_status = 'Reshedule';
                }else{
                    $outcome_status='Lead Not Assign';
                }

                

                $data['exportdata'][] = array(
                    'dymic_lead_id' => $export_data->dymic_lead_id,
                    'type_of_lead' => $export_data->ptype_name,
                    'client_name' => $export_data->client_name,
                    'contact_person' => $export_data->contact_person,
                    'contact_number' => $export_data->contact_number,
                    'location' => $export_data->location,
                    'address' => $export_data->address,
                    'email_id' => $export_data->email_id,
                    'priority' => $priority,
                    'notes' => $export_data->notes,
                    'manager_name' => ($export_data->manager_name) ?$export_data->manager_name:'-',
                    'cordinator_name' => ($export_data->cordinator_name) ?$export_data->cordinator_name:'-',
                    'sales_name' =>($export_data->sales_name) ?$export_data->sales_name:'-',
                    'website' => $export_data->website,
                    'outcome_status' => $outcome_status,
                    'added_by' => $export_data->added_by,
                    'created_date' => date(' jS M Y h:i A', strtotime(ucwords($export_data->created_date))),
                    'status' => ($export_data->status == '1') ?'Active':'Inactive',
                );
            }
            $dataresult = $data['exportdata'];
            $datas = array_merge($datahead, $dataresult);
            array_to_csv($datas, 'Lead Management List.csv');
        
    }   

}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */