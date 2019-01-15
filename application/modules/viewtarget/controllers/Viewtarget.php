<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Viewtarget extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Viewtarget_model");
    }

    public function index() {
        //$this->load->view('users_view');
    }

    function list_items() {
        $data['page_title'] = "View Target";
        $data['title'] = "View Target";
        $data['page'] = "list_items";
        $data['breadcrumb'] = array("Dashboard" => base_url(), "View Target" => base_url('viewtarget/list_items'));
        _layout($data);
    }

    function list_items_ajax() {
        $res = $this->Viewtarget_model->list_items_ajax();
        echo json_encode($res);
    }

}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */