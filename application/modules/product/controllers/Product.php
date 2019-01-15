<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Product_model");
    }

    public function index() {
        $this->load->view('product_view');
    }

    function list_items() {
        $data['product_type'] = get_where("pr_product_type", array("status" => "1"));
        $data['title'] = "Product List";

        $data['page_title'] = "Product List";
        $data['page'] = "list_items";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Product List" => base_url('product/list_items'));
        _layout($data);
    }

    function list_items_ajax() {
        $res = $this->Product_model->list_items_ajax();

        echo json_encode($res);
    }

    function add() {
        $data['kva_val'] = array();
        $kva = $this->input->post('kva');
        $data['product_type'] = get_where("pr_product_type", array("status" => "1"));
        //$data['products'] = get_where("pr_product",array("status"=>"1")); 
        $data['title'] = "Add Product";
        $data['page_title'] = "Add Product";
        $data['page'] = "add";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Product List" => base_url('product/list_items'), "Add Product" => base_url('product/add'));


        if (isPostback()) {
            // echo "<pre>";print_r($_POST);die;
            $this->form_validation->set_rules('product_name', 'Product Name', "required");
            $this->form_validation->set_rules('product_type', 'Please select Product', "required");


            $this->form_validation->set_rules('hsn_sac', 'Hsn/Sac', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('price_mrp', 'MRP of product', 'required');
            if($_POST['product_type']=="2"){
                foreach ($kva as $ind => $val) {
                    $this->form_validation->set_rules("kva[" . $ind . "]", 'KVA', 'required|numeric');
                }
                $this->form_validation->set_rules('price_ssp', 'SSP of product', 'required');
                $this->form_validation->set_rules('price_msp', 'MSP of product', 'required');
            }
            if($_POST['product_type']=="3" || $_POST['product_type']=="4"){
                $this->form_validation->set_rules('hp', 'Hp', 'required');
                $this->form_validation->set_rules('price_ssp', 'SSP of product', 'required');
                $this->form_validation->set_rules('price_msp', 'MSP of product', 'required');
            }
           
            /* $this->form_validation->set_rules('kva', 'The kva', 'required');
              $this->form_validation->set_rules('hp', 'The Hp field is required', 'required');
              $this->form_validation->set_rules('price_mrp', 'The MRP of product field is required', 'required');
              $this->form_validation->set_rules('price_ssp', 'The SSP of product field is required', 'required');
              $this->form_validation->set_rules('price_msp', 'The MSP of product field is required', 'required'); */

            $this->form_validation->set_rules('status', 'Status', 'required');



            if ($this->form_validation->run()) {


                $this->Product_model->add();
                $this->session->set_flashdata("alert", array("c" => "s", "m" => "Product Added Successfully. "));
                redirect("product/list_items");
            }
        }

        $ins_id = $this->Product_model->last_id_get();
        $ins_ids = $ins_id->id + 1;
        $data['product_no'] = "PDR0$ins_ids";

        for ($i = 0; $i < count($kva); $i++) {
            form_error("kva[" . $i . "]");
        }
        $data['kva_val'] = $kva;
        // pr($data['kva_val']);
        // pr($_POST);die;
        _layout($data);
    }

    public function edit() {
        $data['kva_val'] = array();
        $kva = $this->input->post('kva');
     
        $id = ID_decode($this->uri->segment('3'));
        $data['res'] = $this->Product_model->viewData($id);
        $data['product_type'] = get_where("pr_product_type", array("status" => "1"));

        if (isPostback()) {

            $this->form_validation->set_rules('product_name', 'Product Name', "required");
            $this->form_validation->set_rules('product_type', 'Please select Product', "required");


            $this->form_validation->set_rules('hsn_sac', 'Hsn/Sac', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('price_mrp', 'MRP of product', 'required');
            if($_POST['product_type']=="2"){
                foreach ($kva as $ind => $val) {
                    $this->form_validation->set_rules("kva[" . $ind . "]", 'KVA', 'required|numeric');
                }
                $this->form_validation->set_rules('price_ssp', 'SSP of product', 'required');
                $this->form_validation->set_rules('price_msp', 'MSP of product', 'required');
            }
            if($_POST['product_type']=="3" || $_POST['product_type']=="4"){
                $this->form_validation->set_rules('hp', 'Hp', 'required');
                $this->form_validation->set_rules('price_ssp', 'SSP of product', 'required');
                $this->form_validation->set_rules('price_msp', 'MSP of product', 'required');
            }

            $this->form_validation->set_rules('status', 'Status', 'required');



            if ($this->form_validation->run()) {
                // pr($_POST);die;
                // echo "shubham";die;
                $this->Product_model->edit($id);
                $this->session->set_flashdata("alert", array("c" => "s", "m" => "Product Updated Successfully. "));
                redirect("product/list_items");
            }
        }


        for ($i = 0; $i < count($kva); $i++) {
            form_error("kva[" . $i . "]");
        }
        $data['kva_val'] = $kva;
        $data['title'] = "Edit Product";
        $data['page_title'] = "Edit Product";
        $data['page'] = "add";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Product List" => base_url('product/list_items'), "Edit Product"=>"");
        //pr($data);
        _layout($data);
    }

    public function view($id) {
        $id = ID_decode($this->uri->segment('3'));
        if (!empty($id)) {
            $data['res'] = $this->Product_model->viewData($id);
            $data['title'] = 'View Product';
            $data['page_title'] = 'View Product';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Product List" => base_url('product/list_items'), "View Product" => "");

            $data['page'] = "view";
            _layout($data);
        }
    }

    function delete() {
        $id = $_POST['id'];
        //pr($id);die;
        $res = $this->Product_model->delete($id);
        if ($res['status'] != "false") {

            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Product Deleted Successfully. "));
            echo json_encode($res);
        } else {
            $this->session->set_flashdata("alert", array("c" => "d", "m" => "Product Already Assigned !"));
            echo json_encode($res);
        }
    }

    //-------------------------------------MULTIPLE DELETE--------------------------------------------------------

    public function delete_multiple() {
        $id = $_POST['ids'];

        $res = $this->Product_model->delete_multiple($id);
        if ($res['status'] != "false") {
            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Product Deleted Successfully. "));
            echo json_encode($res);
        } else if($res['status'] != "true" && !empty($res['prod'])){
            $prod=implode(",",$res['prod']);
            $this->session->set_flashdata("alert", array("c" => "d", "m" => "Product Already Assigned ! ".$prod));
            echo json_encode($res);
        }else{
            $this->session->set_flashdata("alert", array("c" => "d", "m" => "Something Went Wrong ! "));
            echo json_encode($res);
        }
    }

}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */