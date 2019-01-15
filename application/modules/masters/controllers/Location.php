<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * AREA Controller
 *
 * @package		AREA
 * @category	AREA 
 * @author	    Devesh Ghansal
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
class Location extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("location_model");
    }

    public function index() {
        $this->load->view('location_view');
    }

    //-------------------------------------LISTING--------------------------------------------------------


    function list_items() {

        //echo phpinfo();die;

        $data['title'] = "Location List";
        $data['page_title'] = "Location List";
        $data['page'] = "location/list_items";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Location List" => base_url('masters/location/list_items'));
        _layout($data);
    }

    function list_items_ajax() {
        $res = $this->location_model->list_items_ajax();

        echo json_encode($res);
    }

    //-------------------------------------ADD--------------------------------------------------------


    function add() {


        $data['title'] = "Add Location";
        $data['page_title'] = "Add Location";
        $data['page'] = "location/add";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Location List" => base_url('masters/location/list_items'), "Add Location" => base_url('masters/location/add'));
        if (isPostback()) {
            $this->form_validation->set_rules('location_name', 'Location Name', "required|callback_unique_location");
            $this->form_validation->set_rules('description', 'Description of the Location', "required");
            $this->form_validation->set_rules('status', 'Status', 'required');



            if ($this->form_validation->run()) {


                $this->location_model->add();
                $this->session->set_flashdata("alert", array("c" => "s", "m" => "Location Added Successfully. "));
                redirect("masters/location/list_items");
            }
        }

        _layout($data);
    }

    //-------------------------------------EDIT--------------------------------------------------------


    public function edit($id) {


        $id = ID_decode($id);
        $data['res'] = $this->location_model->viewData($id);
        //pr($data['res']);die;
        if (isPostback()) {
            $this->form_validation->set_rules('location_name', 'Location Name', "required|callback_unique_location");
            $this->form_validation->set_rules('description', 'Description of the Location', "required");
            $this->form_validation->set_rules('status', 'Status', 'required');
            if ($this->form_validation->run()) {
                $this->location_model->edit($id);
                $this->session->set_flashdata("alert", array("c" => "s", "m" => "Location Updated Successfully. "));
                redirect('masters/location/list_items');
            }
        }
        $data['title'] = "Edit Location";
        $data['page_title'] = "Edit Location";
        $data['page'] = "location/add";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Location List" => base_url('masters/location/list_items'), "Edit Location" => "");

        _layout($data);
    }

    //-------------------------------------VIEW--------------------------------------------------------

    public function view($id) {
        $id = ID_decode($id);
        if (!empty($id)) {
            $data['res'] = $this->location_model->view($id);
            $data['title'] = 'View Location';
            $data['page_title'] = 'View Location';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Location List" => base_url('masters/location/list_items'), "View Location" => "");
            $location = 'user/view';
            $data['page'] = "location/view";
            _layout($data);
        }
    }

    //-------------------------------------DELETE--------------------------------------------------------

    function delete() {
        $id = $_POST['id'];
        $res = $this->location_model->delete($id);
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

        $res = $this->location_model->delete_multiple($id);
        if ($res['status'] == "true") {
            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Location Deleted Successfully. "));
            echo json_encode($res);
        } else if($res['status'] == "false" && !empty($res['loc'])){
            $loc=implode(",",$res['loc']);
            $this->session->set_flashdata("alert", array("c" => "d", "m" => "Location Already Assigned ! ".$loc));
            echo json_encode($res);
        }else{
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

}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */