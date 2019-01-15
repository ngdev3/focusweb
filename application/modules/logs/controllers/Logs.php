<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logs extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Logs_model");
    }

    public function index() {
        //$this->load->view('users_view');
    }

    function list_items() {
        $data['page_title'] = "Notification List";
        $data['title'] = "Notification List";
        $data['page'] = "list_items";
        $data['breadcrumb'] = array("Dashboard" => base_url(), "Notification List" => base_url('logs/list_items'));
        _layout($data);
    }

    function list_items_ajax() {
        $res = $this->Logs_model->list_items_ajax();
        echo json_encode($res);
    }

}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */