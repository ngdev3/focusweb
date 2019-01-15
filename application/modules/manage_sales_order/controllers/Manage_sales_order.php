<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage_sales_order extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("manage_sales_order_model");
        $this->load->model("salesperson/salesperson_model");
        
    }

    public function index() {
        $this->load->view('salesperson_view');
    }

    function list_items() {
        $data['client'] = $this->manage_sales_order_model->getclient();
        $data['salesperson'] = $this->manage_sales_order_model->getsalesperson();
        $data['manager'] = $this->salesperson_model->get_manager_user();
        $data['coordinator']=$this->salesperson_model->getallsalescordinator();
        $data['title'] = "List Of Order (Sales)";
        $data['page_title'] = "List Of Order (Sales)";
        $data['page'] = "list_items";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "List Of Order (Sales)" => base_url('manage_sales_order/list_items'));
        _layout($data);
    }

    function list_items_ajax() {
        $res = $this->manage_sales_order_model->list_items_ajax();

        echo json_encode($res);
    }


    function add() {
        $data['static_coordinator'] = $this->salesperson_model->static_coordinator();
        
        $data['static_salesperson'] = $this->salesperson_model->static_salesperson();
        $data['manager'] = $this->salesperson_model->get_manager_user();
        //$data['create_order'] = $this->manage_sales_order_model->add();
        $data['client']= $this->manage_sales_order_model->getclient();
        $data['product']= $this->manage_sales_order_model->getproduct();

        $data['payment_mode']= $this->manage_sales_order_model->getpayment_type();
        $ins_id = $this->manage_sales_order_model->last_id_get();
        $ins_ids = $ins_id->id + 1;
        $data['order_id'] = "OD$ins_ids";

        
        $data['page_title'] = "Create Order";
        $data['page'] = "add";
        $data['title'] = "Create Order";

        $data['breadcrumb'] = array("Home" => base_url(), "List Of Order (Sales)" => base_url('manage_sales_order/list_items'), "Create Order" => base_url('manage_sales_order/add'));

        if(IsPostBack()){
         //pr($_POST);die;
            if(!empty($_POST['product_id_arr'])){
                $this->form_validation->set_rules('product_id_arr[]', 'Product Name', "trim|required");
                $this->form_validation->set_rules('quantity_arr[]', 'Quantity', "trim|required|numeric|greater_than_equal_to[1]");
                $this->form_validation->set_rules('unit_id_arr[]', 'Unit', "trim|required");
                $this->form_validation->set_rules('price_arr[]', 'Price', "trim|required|numeric|greater_than_equal_to[1]");

            }else{
                $this->form_validation->set_rules('product_id', 'Product Name', "trim|required");
                $this->form_validation->set_rules('quantity', 'Quantity', "trim|required|numeric|greater_than_equal_to[1]");
                $this->form_validation->set_rules('unit_id', 'Unit', "trim|required");
                $this->form_validation->set_rules('price', 'Price', "trim|required|numeric|greater_than_equal_to[1]");
            }
            if(getUserInfos()->role == "0"){
         $this->form_validation->set_rules('manager_id', 'Manager name', "trim|required");
         $this->form_validation->set_rules('cordinator_id', 'Cordinator Name', "trim|required");
            }
            if(getUserInfos()->role == "1"){
         $this->form_validation->set_rules('cordinator_id', 'Cordinator Name', "trim|required");
            }
         $this->form_validation->set_rules('sales_person_id', 'Sales Person Name', "trim|required");
         $this->form_validation->set_rules('client_id', 'Client Name', "trim|required");
         $this->form_validation->set_rules('basic_amount', 'Basic Ordered Value(INR)', "trim|required|numeric|greater_than_equal_to[1]");
         $this->form_validation->set_rules('gst', 'GST(INR)', "trim|required|numeric|greater_than_equal_to[0.1]");
         $this->form_validation->set_rules('total_amount', 'Total Ordered Value(INR)', "trim|required|numeric|greater_than_equal_to[1]");
         $this->form_validation->set_rules('advance_amount', 'Advanced(INR)', "trim|required|numeric|greater_than_equal_to[1]");
         $this->form_validation->set_rules('pending_amount', 'Pending(INR)', "trim|required|numeric|greater_than_equal_to[1]");
         $this->form_validation->set_rules('payment_mode', 'Mode of Payment', "trim|required");
         $this->form_validation->set_rules('payment_description', 'Payment Description', "trim");

       
        if ($this->form_validation->run() == TRUE) {
            //echo"chusoooo";
//pr($_POST);die;
            $last_id = $this->manage_sales_order_model->add();
            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Order Created Successfully. "));
            redirect("manage_sales_order/list_items");
        }


        }
       
        _layout($data);
    }

    public function view($id) {
        $id = ID_decode($id);
        if (!empty($id)) {
            $data['res'] = $this->manage_sales_order_model->view($id);
            $data['detail'] = $this->manage_sales_order_model->detail($id);
            
            //pr($data);die;
            $data['title'] = 'View Order';
            $data['page_title'] = 'View Order';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "List Of Order (Sales)" => base_url('manage_sales_order/list_items'), "View Order" => "");
          
            $data['page'] = "view";
            _layout($data);
        }
    }
    

    function delete() {
        $id = $_POST['id'];
        $res = $this->manage_sales_order_model->delete($id);
       

            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Sales Person Deleted Successfully. "));
            echo json_encode($res);
        
    }

    
    
     /***************get  client starts 20-12-2018 *********************/
    
    
    
     public function getclient() {
        $cordinator_id = $_POST['cordinator_id'];
        $manager_id = $_POST['manager_id'];
        $sales_person_id = $_POST['sales_person_id'];
        //$subData = $this->manage_sales_order_model->getclient($manager_id,$cordinator_id,$sales_person_id);
        $subData = $this->manage_sales_order_model->getclient();
        $output = '';
        if (!empty($subData)) {
            $output .= '<option value=""> Select Client</option>';
            foreach ($subData as $type) {
                $output .= '<option value="' . $type->id . '">' . ucwords($type->fname) . ' ' . ucwords($type->lname) . '</option>';
            }
        } else {
            $output .= '<option value=""> No Client Available</option>';
        }
        echo $output;
        exit;
    }
/***************get  client ends 20-12-2018 *********************/

public function get_product_details()
{
   $product_id=$this->input->post("product_id");
   $subData = $this->manage_sales_order_model->get_product_details($product_id);
   if($subData->product_type=="3" || $subData->product_type=="4")
   {
       $output=true;
   }else{
       $output=false;
   }
   echo $output;

}
/***************get  product rate starts 04-01-2019 *********************/

public function getproduct_rate()
{
   $product_id=$this->input->post("product_id");
   $subData = $this->manage_sales_order_model->getproduct_rate($product_id);
   
   $output = '';
        if (!empty($subData->kva)) {
            $kva_val=explode(",",$subData->kva);
            $output .= '<option value=""> Select KVA</option>';
            foreach ($kva_val as $type) {
                $output .= '<option value="' . $type . '">' . ucwords($type) . '</option>';
            }
        } else {
            $output .= '<option value=""> No KVA Available</option>';
        }
       
        $subData->kva=$output;
//pr( $output);die;
   echo json_encode($subData);

}
/***************get  product rate ends 04-01-2019 *********************/



}

/* End of file salesperson.php */
/* Location: ./application/modules/salesperson/controllers/salesperson.php */