<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salespersonactivity extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("salespersonactivity_model");
        $this->load->model("salesperson/salesperson_model");
     
    }

    public function index() {
        $this->load->view('salespersonactivity_view');
    }

    function list_items() {
        
       
        $data['title'] = "Activity History (Sales)";
        $data['page_title'] = "Activity History (Sales)";
        $data['page'] = "list_items";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Activity History (Sales)" => base_url('salespersonactivity/list_items'));
        _layout($data);
    }

    function list_items_ajax() {
        $res = $this->salespersonactivity_model->list_items_ajax();
        echo json_encode($res);
    }

   
    
    
     
    

    function delete() {
        $id = $_POST['id'];
        $res = $this->salespersonactivity_model->delete($id);
        if ($res['status'] != "false") {

            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Sales Person Deleted Successfully. "));
            echo json_encode($res);
        } else {
            $this->session->set_flashdata("alert", array("c" => "d", "m" => "Sales Person Not Deleted Successfully !"));
            echo json_encode($res);
        }
    }

    function list_items_activity() {
        $id = ID_decode($this->uri->segment('3'));
        $data['res'] = $this->salespersonactivity_model->viewData($id);
        $data['manager']=getUserInfo($data['res']->manager_id);
        $data['cordinator']=getUserInfo($data['res']->cordinator_id);
      
      // pr($data);die;
        $data['title'] = "List of Activity (Sales)";
        $data['page_title'] = "List of Activity (Sales)";
        $data['page'] = "list_items_activity";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'),"Activity History (Sales) " => base_url('salespersonactivity/list_items'), "List of Activity (Sales)" => base_url('salespersonactivity/list_items_activity/'.ID_encode($id)));
        _layout($data);
    }

    function list_items_ajax_activity() {
        $res = $this->salespersonactivity_model->list_items_ajax_activity();
        echo json_encode($res);
    }

    public function delete_multiple() {
        $id = $_POST['ids'];

        $res = $this->salespersonactivity_model->delete_multiple($id);
        if ($res == "true") {
            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Sales Person Deleted Successfully. "));
            echo json_encode($res);
        } else {
            $this->session->set_flashdata("alert", array("c" => "d", "m" => "Something Went Wrong ! "));
            echo json_encode($res);
        }
    }

    public function view_activity($id) {
        $id = ID_decode($id);
      
        if (!empty($id)) {
            $data['res'] = $this->salespersonactivity_model->view($id);
            
            //pr($data);die;
      
            $data['title'] = 'View Activity (Sales)';
            $data['page_title'] = 'View Activity (Sales)';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "List of Activity (Sales)" => base_url('salespersonactivity/list_items_activity/'.ID_encode($data['res']->sales_person_id)), "View Activity (Sales)" => "");
          
            $data['page'] = "view_activity";
          
            _layout($data);
        }
    }

    function list_items_app_disapp() {
        $id = ID_decode($this->uri->segment('3'));
        $data['salesperson'] = $this->salespersonactivity_model->getsalesperson();
        $data['manager'] = $this->salesperson_model->get_manager_user();
        $data['coordinator']=$this->salesperson_model->getallsalescordinator();
        
      // pr($data);die;
        $data['title'] = "Approve/Disapprove Previous Activity (Sales)";
        $data['page_title'] = "Approve/Disapprove Previous Activity (Sales)";
        $data['page'] = "list_items_app_disapp";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'),"Approve/Disapprove Previous Activity (Sales)" => base_url('salespersonactivity/list_items_app_disapp'));
        _layout($data);
    }

//    function list_items_ajax_app_disapp() {
//        $res = $this->salespersonactivity_model->list_items_ajax_app_disapp();
//        echo json_encode($res);
//    }
//    
     function list_items_ajax_app_disapp() {
        $res = $this->salespersonactivity_model->list_items_ajax_app_disapp();
        echo json_encode($res);
    }
    

    public function view_app_disapp($id) {
        $id = ID_decode($id);
     
        if (!empty($id)) {
            $data['res'] = $this->salespersonactivity_model->view_app_disapp($id);
            $data['title'] = 'View Approve/Disapprove Activity (Sales)';
            $data['page_title'] = 'View Approve/Disapprove Activity (Sales)';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Approve/Disapprove Previous Activity (Sales)" => base_url('salespersonactivity/list_items_app_disapp'), "View Approve/Disapprove Activity (Sales)" => "");
            $data['page'] = "view_app_disapp";
          
            _layout($data);
        }
    }

    /************************************reschedule Activity Starts 26-12-2018  */

    function list_items_reschedule_activity() {
        $id = ID_decode($this->uri->segment('3'));
        $data['salesperson'] = $this->salespersonactivity_model->getsalesperson();
        $data['manager'] = $this->salesperson_model->get_manager_user();
        $data['coordinator']=$this->salesperson_model->getallsalescordinator();
        
      // pr($data);die;
        $data['title'] = "Reschedule Activity (Sales)";
        $data['page_title'] = "Reschedule Activity (Sales)";
        $data['page'] = "list_items_reschedule_activity";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'),"Reschedule Activity (Sales)" => base_url('salespersonactivity/list_items_reschedule_activity'));
        _layout($data);
    }

    function list_items_ajax_reschedule_activity() {
        $res = $this->salespersonactivity_model->list_items_ajax_reschedule_activity();
        echo json_encode($res);
    }

    public function view_reschedule_activity($id) {
        $id = ID_decode($id);
      
        if (!empty($id)) {
            $data['res'] = $this->salespersonactivity_model->view_reschedule_activity($id);
            $data['title'] = 'View Reschedule Activity (Sales)';
            $data['page_title'] = 'View Reschedule Activity (Sales)';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Reschedule Activity (Sales)" => base_url('salespersonactivity/list_items_reschedule_activity'), "View Reschedule Activity (Sales)" => "");
            $data['page'] = "view_reschedule_activity";
          
            _layout($data);
        }
    }



    /*************************************reschedule activity ends 26-12-2018 */

    public function update_disapp($id)
    {
        $id = ID_decode($id);
        //echo "disaapprove";die;
        $this->salespersonactivity_model->update_disapp($id);
        $this->list_items_app_disapp();

    }
    public function update_app($id)
    {
        $id = ID_decode($id);
       // echo "approve";die;
        $this->salespersonactivity_model->update_app($id);
        $this->list_items_app_disapp();
        
    }
   function list_items_sales_performance() {
       // echo "here" ; die;
        $id = ID_decode($this->uri->segment('3'));
        $data['res'] = $this->salespersonactivity_model->viewData($id);
        $data['manager']=getUserInfo($data['res']->manager_id);
        $data['cordinator']=getUserInfo($data['res']->cordinator_id);
      
      // pr($data);die;
        $data['title'] = "List of Sales Performance";
        $data['page_title'] = "List of Sales Performance";
        $data['page'] = "list_items_sales_performance";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'),"Sales Performance List" => base_url('salespersonactivity/list_items_sales_performance'));
        _layout($data);
    }
 
    function list_items_ajax_sales_performance() {
        $res = $this->salespersonactivity_model->list_items_ajax_sales_performance();
        echo json_encode($res);
    }


    }

/* End of file salespersonactivity.php */
/* Location: ./application/modules/salespersonactivity/controllers/salespersonactivity.php */