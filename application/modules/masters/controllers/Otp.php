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
class Otp extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Otp_model");
    }

    public function index() {
        $this->load->view('otp_view');
    }

    //-------------------------------------LISTING--------------------------------------------------------


    function list_items() {

        //echo phpinfo();die;

        $data['title'] = "OTP List";
        $data['page_title'] = "OTP List";
        $data['page'] = "otp/list_items";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "OTP List" => base_url('masters/otp/list_items'));
        _layout($data);
    }

    function list_items_ajax() {
        $res = $this->Otp_model->list_items_ajax();

        echo json_encode($res);
    }

    //-------------------------------------ADD--------------------------------------------------------


    function add() {


        $data['title'] = "Add OTP";
        $data['page_title'] = "Add OTP";
        $data['page'] = "otp/add";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "OTP List" => base_url('masters/otp/list_items'), "Add OTP" => base_url('masters/otp/add'));
        if (isPostback()) {
            $this->form_validation->set_rules('otp', 'OTP', "required|callback_unique_otp|numeric|exact_length[4]");
            $this->form_validation->set_rules('status', 'Status', 'required');



            if ($this->form_validation->run()) {


                $this->Otp_model->add();
                $this->session->set_flashdata("alert", array("c" => "s", "m" => "OTP Added Successfully. "));
                redirect("masters/otp/list_items");
            }
        }

        _layout($data);
    }

    //-------------------------------------EDIT--------------------------------------------------------


    public function edit($id) {


        $id = ID_decode($id);
        $data['res'] = $this->Otp_model->viewData($id);
        //pr($data['res']);die;
        if (isPostback()) {
            $this->form_validation->set_rules('otp', 'OTP', "required|callback_unique_otp|numeric|exact_length[4]");
            $this->form_validation->set_rules('status', 'Status', 'required');

            if ($this->form_validation->run()) {
                $this->Otp_model->edit($id);
                $this->session->set_flashdata("alert", array("c" => "s", "m" => "OTP Updated Successfully. "));
                redirect('masters/otp/list_items');
            }
        }
        $data['title'] = "Edit OTP";
        $data['page_title'] = "Edit OTP";
        $data['page'] = "otp/edit";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "OTP List" => base_url('masters/otp/list_items'), "Edit OTP" => "");

        _layout($data);
    }

    //-------------------------------------VIEW--------------------------------------------------------

    public function view($id) {
        $id = ID_decode($id);
        if (!empty($id)) {
            $data['res'] = $this->Otp_model->view($id);
            $data['title'] = 'View OTP';
            $data['page_title'] = 'View OTP';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "OTP List" => base_url('masters/otp/list_items'), "View OTP" => "");
            $location = 'otp/view';
            $data['page'] = "otp/view";
            _layout($data);
        }
    }

    //-------------------------------------DELETE--------------------------------------------------------

    function delete() {
        $id = $_POST['id'];
      
        $res = $this->Otp_model->delete($id);
        if ($res['status'] != "false") {

            $this->session->set_flashdata("alert", array("c" => "s", "m" => "OTP Deleted Successfully. "));
            echo json_encode($res);
        } else {
            $this->session->set_flashdata("alert", array("c" => "d", "m" => "OTP Already Assigned !"));
            echo json_encode($res);
        }
    }

    //-------------------------------------MULTIPLE DELETE--------------------------------------------------------

    public function delete_multiple() {
        $id = $_POST['ids'];
        //pr($id);die;
        $res = $this->Otp_model->delete_multiple($id);
        if ($res == "true") {
            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Un-Used OTP Deleted Successfully. "));
            echo json_encode($res);
        } else {
            $this->session->set_flashdata("alert", array("c" => "d", "m" => "Something Went Wrong ! "));
            echo json_encode($res);
        }
    }

    public function unique_otp() {
        $otp = $this->input->post('otp');
        $id = ID_decode($this->uri->segment('4'));
        // pr($id);die;
        if ($url_check = $this->unique_edit_otp($otp, $id)) {
            return TRUE;
        }
        $this->form_validation->set_message('unique_otp', 'This OTP is already registered');
        return FALSE;
    }

    function unique_edit_otp($otp, $id = null) {
        if ($id != '') {
            $this->db->where("id !=", $id);
        }
        $this->db->select("otp");
        $this->db->where("otp", $otp);
        $this->db->where('is_deleted', '0');
        $query = $this->db->get('pr_otp')->num_rows();
        
       // echo $this->db->last_query();die;
        if ($query > 0) {
            return 0;
        } else {
            return 1;
        }
    }

}

/* End of file users.php */
/* OTP: ./application/modules/users/controllers/users.php */