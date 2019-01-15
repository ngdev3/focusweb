<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Leadmanagement Controller
 *
 * @package		Dummy
 * @category	Dummy 
 * @author	    DEVESH
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
class Dummy extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Dummy_model");
       
    }

   

    function list_items() {



        $data['title'] = "Lead List";
        $data['page_title'] = "I am Dummy";
        $data['page'] = "list_items";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Dummy" => base_url('dummy/list_items'));
        _layout($data);
    }

   

}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */