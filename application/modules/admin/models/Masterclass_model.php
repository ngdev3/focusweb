<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Masterclass_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->helper('string');
    }

    function list_items_ajax() {
        // die;
        $requestData = $_REQUEST;
        $columns = array(
            '',
            "cu.id",
            "cu.title",
            "cu.url",
            "cu.description",
            "cu.set_time",
            
        );

        $sql = $this->db->select("cu.*", FALSE)
                ->from("f_master_class cu");

        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];

            $ser=str_replace("'",",","$ser");
          
            $sql->or_where("cu.id like '%$ser%'");
            $sql->or_where("cu.title like '%$ser%'");
            $sql->or_where("cu.url like '%$ser%'");
            $sql->or_where("cu.description like '%$ser%'");
            $sql->or_where("cu.status like '%$ser%'");
        }
        $sql->order_by($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);
        $sql1 = clone $sql;
        if ($requestData['length'] != '-1') {  // for showing all records
            $query = $sql->limit($requestData['length'], $requestData['start']);
        }

        $query = $sql->get()->result();
        $totalData = $totalFiltered = $sql1->get()->num_rows();
        //echo $this->db->last_query();die;
        $data = array();
        $starts= $requestData['start'];
        foreach ($query as $i => $row) {
        
            $nestedData = array();
            $nestedData[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
            <input type="checkbox" class="group-checkable checks_all" name="check_all[]" value="' . $row->id . '" />
            <span></span>
            </label>';
            //$nestedData[] = ++$i;
            $nestedData[] = ++$starts;
            
            $full_name = ucwords($row->from_date);
            $nestedData[] =  substr(ucwords($row->title),0,30).'...';
            $nestedData[] =  substr(($row->url),0,30).'...';
            $nestedData[] =  substr(ucwords($row->description),0,30).'...';



            if($row->status == 'active'){

                $nestedData[] = '<label class="label-success label"> Active</label>' ;
            }else if($row->status == 'inactive'){
                $nestedData[] = '<label class="label-danger label"> In active</label>';
            }else{
                
                $nestedData[] = '<label class="label-danger label">Delete</label>';
            }
           
            $nestedData[] = $this->load->view("coaches/_action", array("data" => $row), true);
            $data[] = $nestedData;
        }
        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        return $json_data;
    }

    function add() {
        extract($_POST);
 
        $ins['title'] = $video_title;
        $ins['url'] = $video_url;
        $ins['description'] = $description;
        $ins['status'] = $status;
        $ins['added_by'] = getUserInfos()->id;
        $ins['created_date'] = current_datetime();
        // pr($ins); 
        
        // die;
        $this->db->insert("f_master_class", $ins);
        return $this->db->insert_id();
    }

    function edit($id = NULL) {
        extract($_POST);

        $ins['title'] = $video_title;
        $ins['url'] = $video_url;
        $ins['description'] = $description;
        $ins['status'] = $status;
        $ins['added_by'] = getUserInfos()->id;
        $ins['updated_date'] = current_datetime();
        $whr['id'] = $id;
        $this->db->update("f_master_class", $ins, $whr);
    }

    function viewData($id) {
        $res = $this->db->select("
        cu.*, 
        cu.title as video_title, 
        cu.url as video_url,
        ")
                ->from("f_master_class cu")
                ->where(array("cu.id" => $id))
                ->get()
                ->row();
        return $res;
    }

    function view($id) {
        $res = $this->db->select("cu.*")
                ->from("f_master_class cu")
                ->where(array("cu.id" => $id))
                ->get()
                ->row();
        return $res;
    }

    function get_backendteam() {
        $res = $this->db->select("cr.*")
                ->from("cz_roles cr")
                ->where("(cr.id='1' OR cr.id='7')")
                ->get()
                ->result();
        return $res;
    }

    function delete($id) {
        $upd['is_deleted'] = "1";
        $whr['id'] = $id;
        $this->db->update("f_master_class", $upd, $whr);
        //echo $this->db->last_query();die;
        if ($this->db->affected_rows() > 0) {
            $rt["status"] = "true";
            $rt["msg"] = "Success";
        } else {
            $rt["status"] = "false";
            $rt["msg"] = "Row was not deleted";
        }
        return $rt;
    }
    function assign_coach($id) {
        $upd['is_coach'] = "1";
        $upd['user_type'] = "3";
        $whr['id'] = $id;
        $this->db->update("f_master_class", $upd, $whr);
        
        $updlog['whois'] = $id;
        $updlog['became'] = "is_coach";
        $updlog['converted_by'] = getUserInfos()->id;
        $updlog['created_date'] =current_datetime();;
        $this->db->insert("f_coach_conversion_log", $updlog);

        if ($this->db->affected_rows() > 0) {
            $rt["status"] = "true";
            $rt["msg"] = "Success";
        } else {
            $rt["status"] = "false";
            $rt["msg"] = "Row was not converted";
        }
        return $rt;
    }
    function assign_user($id) {
        $upd['is_coach'] = "0";
        $upd['user_type'] = "2";
        $whr['id'] = $id;
        $this->db->update("f_master_class", $upd, $whr);
        
        $updlog['whois'] = $id;
        $updlog['became'] = "is_user";
        $updlog['converted_by'] = getUserInfos()->id;
        $updlog['created_date'] =current_datetime();;
        $this->db->insert("f_coach_conversion_log", $updlog);

        if ($this->db->affected_rows() > 0) {
            $rt["status"] = "true";
            $rt["msg"] = "Success";
        } else {
            $rt["status"] = "false";
            $rt["msg"] = "Row was not deleted";
        }
        return $rt;
    }

    function delete_multiple($id) {

        foreach ($id as $vals) {
            $upd['status'] = "delete";
            $whr['id'] = $vals;
            $abc = $this->db->update("f_master_class", $upd, $whr);
        }
        if ($abc) {
            return true;
        } else {

            return false;
        }
    }

    function save_image($images, $user_id) {
        for ($i = 0; $i < count($images); $i++) {
            $upd['profile_image'] = $images[$i];
            $whr['id'] = $user_id;
            $abc = $this->db->update("f_master_class", $upd, $whr);
            //echo $this->db->last_query();die;
        }

        return true;
    }

    /*     * **************************Recieved Sales Quote List starts 03-01-2019 */

    function list_items_sales_quote_ajax() {
        $requestData = $_REQUEST;
        $columns = array(
            '',
            "psq.created_date",
            "psq.quote_no",
            "pl.id",
            "cu.id",
            "pl.location",
            "pr.id",
            "psq.kva",
            "psq.quantity",
            "psq.quote_age",
            "psq.requested_amount",
            "psq.quoted_amount"
        );

        $sql = $this->db->select("psq.*,concat(cu.fname,' ',cu.lname) as salesperson_name,pl.client_name,pl.location as lead_location,pr.name as product_name"
                        , FALSE)
                ->from("pr_sales_quote psq")
                ->join("f_master_class cu", "cu.id = psq.sales_person_id", "left")
                ->join("pr_lead pl", "pl.id = psq.lead_id", "left")
                ->join("pr_product pr", "pr.id = psq.product_id", "left")
                ->where(array("psq.is_deleted =" => "0", "psq.status =" => "1"));

        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];

            $ser=str_replace("'",",","$ser");

            $sql->where("(concat(cu.fname,' ',cu.lname) like '%$ser%'");
            $sql->or_where("DATE_FORMAT(psq.created_date, '%d-%m-%y %h:%i %p')  like '%$ser%'");
            $sql->or_where("psq.quote_no  like '%$ser%' ");
            $sql->or_where("psq.kva  like '%$ser%' ");
            $sql->or_where("psq.quantity  like '%$ser%' ");
            $sql->or_where("psq.quote_age  like '%$ser%' ");
            $sql->or_where("psq.requested_amount  like '%$ser%' ");
            $sql->or_where("psq.quoted_amount  like '%$ser%' ");
            $sql->or_where("pl.location  like '%$ser%' ");
            $sql->or_where("pl.client_name  like '%$ser%' ");
            $sql->or_where("pr.name  like '%$ser%' )");
        }

        if (isset($_GET['client_id']) && $_GET['client_id'] != "") {
            $client_id = $_GET['client_id'];
            $sql->where(array("psq.lead_id" => $client_id));
        }
        if (isset($_GET['salesperson_id']) && $_GET['salesperson_id'] != "") {
            $salesperson_id = $_GET['salesperson_id'];
            $sql->where(array("psq.sales_person_id" => $salesperson_id));
        }
        if (isset($_GET['quote_age']) && $_GET['quote_age'] != "") {
            $quote_age = $_GET['quote_age'];
            $sql->where(array("psq.quote_age" => $quote_age));
        }

        $sql->order_by($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);
        $sql1 = clone $sql;
        if ($requestData['length'] != '-1') {  // for showing all records
            $query = $sql->limit($requestData['length'], $requestData['start']);
        }

        $query = $sql->get()->result();
        $totalData = $totalFiltered = $sql1->get()->num_rows();
        //echo $this->db->last_query();die;
        $data = array();
        $starts= $requestData['start'];
        foreach ($query as $i => $row) {
        
            $nestedData = array();

            //$nestedData[] = ++$i;
            $nestedData[] = ++$starts;
            /* $nestedData[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
              <input type="checkbox" class="group-checkable checks_all" name="check_all[]" value="' . $row->id . '" />
              <span></span>
              </label>'; */
            $newdate = date("d-m-y h:i a", strtotime($row->created_date));
            $nestedData[] = $newdate;
            $nestedData[] = $row->quote_no;
            $nestedData[] = $row->client_name;
            $nestedData[] = $row->salesperson_name;
            $nestedData[] = $row->lead_location;
            $nestedData[] = $row->product_name;
            $nestedData[] = $row->kva;
            $nestedData[] = $row->quantity;
            $nestedData[] = $row->quote_age;
            $nestedData[] = $row->requested_amount;
            $nestedData[] = $row->quoted_amount;

            $nestedData[] = ($row->status == '1') ? '<label class="label-success label"> Active</label>' : '<label class="label-danger label"> In Active</label>';
            $nestedData[] = $this->load->view("_action1", array("data" => $row), true);
            $data[] = $nestedData;
        }
        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        return $json_data;
    }

    /*     * **************************Recieved Sales Quote List ends 03-01-2019 */

    public function view_sales_quote($id) {
        //echo "shubhammmm $id";die;
        $sql = $this->db->select("psq.*,concat(cu.fname,' ',cu.lname) as salesperson_name,cu.email as salesperson_email,cu.mobile as salesperson_number,pl.client_name,pl.location as lead_location,pl.email_id as client_email,pr.name as product_name"
                        , FALSE)
                ->from("pr_sales_quote psq")
                ->join("f_master_class cu", "cu.id = psq.sales_person_id", "left")
                ->join("pr_lead pl", "pl.id = psq.lead_id", "left")
                ->join("pr_product pr", "pr.id = psq.product_id", "left")
                ->where(array("psq.is_deleted =" => "0", "psq.status =" => "1", "psq.id =" => $id));
        $query = $sql->get()->row();
        //echo $this->db->last_query();
        // pr($query);die;
        return $query;
    }

    public function sales_quote_details($id) {
        // pr($_POST);
        // pr($_FILES);die;
        $dat = $this->view_sales_quote($id);
        //pr($dat);
        $data['quote_no'] = $dat->quote_no;
        $data['quote_age'] = $dat->quote_age;
        $data['created_date'] = $dat->created_date;
        $data['location'] = $dat->lead_location;
        $data['client_name'] = $dat->client_name;
        $data['client_email'] = $dat->client_email;
        $data['salesperson_name'] = $dat->salesperson_name;
        $data['salesperson_email'] = $dat->salesperson_email;
        $data['salesperson_number'] = $dat->salesperson_number;
        $data['requested_amount'] = $dat->requested_amount;
        $data['product_name'] = $dat->product_name;
        $data['kva'] = $dat->kva;
        $data['quantity'] = $dat->quantity;


        //echo "shubha data";die;
        extract($_POST);

        $data['sale_quote_rate'] = $send_quote;
        $data['specifications'] =  $_FILES['specifications']['name'];

        $subject = "Sales Quote Details";
        $body = $this->load->view("email_template/admin/registration", array("data" => $data), true);

        foreach ($email_id as $key => $value) {
            $ins['sales_quote_id'] = $id;
            $ins['sale_quote_rate'] = $send_quote;
            $ins['email'] = $value;
            $ins['specifications'] = $_FILES['specifications']['name'];
            $ins['is_deleted'] = "0";
            $ins['status'] = "1";
            $ins['created_date'] = current_datetime();
            $ins['added_by'] = currUserId();
            $this->db->insert("pr_sales_quote_details", $ins);

            //Sending Mail to user
            sendMail($ins['email'], $subject, $body);
            //Sending Mail to user
        }
        $ins['email']=$data['client_email'];
        sendMail($ins['email'], $subject, $body);

        $ins['email']=$data['salesperson_email'];
        sendMail($ins['email'], $subject, $body);
        





    }

    public function get_quote_age() {
        $sql = $this->db->select("*")
                        ->from("pr_quote_age")
                        ->where(array("status" => "1", "is_deleted" => "0"))
                        ->get()->result();
        return $sql;
    }

//Manage Service Quotes

    function list_items_service_quote_ajax() {
        $requestData = $_REQUEST;
        $columns = array(
            '',
            "psq.created_date",
            "psq.quote_no",
            "psq.complaint_id",
           "psq.service_person_id",
            "pl.location",
          
            "psq.quantity",
     
            "psq.quoted_amount"
        );

        $sql = $this->db->select("psq.*,concat(cu.fname,' ',cu.lname) as serviceperson_name,pl.client_name,pl.location as complaint_location", FALSE)
                ->from("pr_service_quote psq")
                ->join("f_master_class cu", "cu.id = psq.service_person_id", "left")
                ->join("pr_complaint pl", "pl.id = psq.complaint_id", "left")
                ->where(array("psq.is_deleted =" => "0", "psq.status =" => "1"));
        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];

            $ser=str_replace("'",",","$ser");

            $sql->where("(concat(cu.fname,' ',cu.lname) like '%$ser%'");
            $sql->or_where("DATE_FORMAT(psq.created_date, '%d-%m-%Y %h:%i %p')  like '%$ser%'");
            $sql->or_where("psq.quote_no  like '%$ser%' ");

            $sql->or_where("psq.quoted_amount  like '%$ser%' ");
            $sql->or_where("pl.location  like '%$ser%' ");

            $sql->or_where("pl.client_name  like '%$ser%' )");
        }

        if (isset($_GET['client_id']) && $_GET['client_id'] != "") {
            $client_id = $_GET['client_id'];
            $sql->where(array("psq.complaint_id" => $client_id));
        }
        if (isset($_GET['serviceperson_id']) && $_GET['serviceperson_id'] != "") {
            $salesperson_id = $_GET['serviceperson_id'];
            $sql->where(array("psq.service_person_id" => $salesperson_id));
        }


        $sql->order_by($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);
        $sql1 = clone $sql;
        if ($requestData['length'] != '-1') {  // for showing all records
            $query = $sql->limit($requestData['length'], $requestData['start']);
        }

        $query = $sql->get()->result();
        $totalData = $totalFiltered = $sql1->get()->num_rows();
        //echo $this->db->last_query();die;
        $data = array();
        $starts= $requestData['start'];
        foreach ($query as $i => $row) {
        
            $nestedData = array();

            //$nestedData[] = ++$i;
            $nestedData[] = ++$starts;
            /* $nestedData[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
              <input type="checkbox" class="group-checkable checks_all" name="check_all[]" value="' . $row->id . '" />
              <span></span>
              </label>'; */
            $newdate = date("d-m-Y h:iA", strtotime($row->created_date));
            $nestedData[] = $newdate;
            $nestedData[] = $row->quote_no;
            $nestedData[] = $row->client_name;
            $nestedData[] = $row->serviceperson_name;
            $nestedData[] = $row->complaint_location;
            $nestedData[] = $row->quoted_amount;
            //$nestedData[] = ($row->status == '1') ? '<label class="label-success label"> Active</label>' : '<label class="label-danger label"> In Active</label>';
            $nestedData[] = $this->load->view("_action_qoute_service", array("data" => $row), true);
            $data[] = $nestedData;
        }
        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        return $json_data;
    }
    
    public function view_service_quote($id) {
        $sql = $this->db->select("psq.*,concat(cu.fname,' ',cu.lname) as serviceperson_name,cu.email as serviceperson_email,cu.mobile as serviceperson_number,pl.client_name,pl.location as complaint_location,pl.email_id as client_email" , FALSE)
                ->from("pr_service_quote psq")
                ->join("f_master_class cu", "cu.id = psq.service_person_id", "left")
                ->join("pr_complaint pl", "pl.id = psq.complaint_id", "left")
                
                ->where(array("psq.is_deleted =" => "0", "psq.status =" => "1", "psq.id =" => $id));
                 $query = $sql->get()->row();
       // echo $this->db->last_query();
        // pr($query);die;
        return $query;
    }
    
    public function view_service_quote_product($id) {
        $sql = $this->db->select("psq.*,pl.name as part_name" , FALSE)
                ->from("pr_service_quote_product psq")
                
                ->join("pr_product pl", "pl.id = psq.product_id", "left")
                
                ->where(array("psq.service_quote_id =" => $id));
                 $query = $sql->get()->result();
                  //echo $this->db->last_query();
        // pr($query);die;
        return $query;
    }
    
    
    
    
    
    
      public function service_quote_details($id) {
        // pr($_POST);
        // pr($_FILES);die;
        $dat = $this->view_service_quote($id);
        //pr($dat);die;
        $data['quote_no'] = $dat->quote_no;
       
        $data['created_date'] = $dat->created_date;
        $data['location'] = $dat->complaint_location;
        $data['client_name'] = $dat->client_name;
        $data['client_email'] = $dat->client_email;
        $data['serviceperson_name'] = $dat->serviceperson_name;
        $data['serviceperson_email'] = $dat->serviceperson_email;
        $data['serviceperson_number'] = $dat->serviceperson_number;
        $data['quoted_amount'] = $dat->quoted_amount;
        extract($_POST);
        //pr($email_id);die;
      
        $data['specifications'] =  $_FILES['specifications']['name'];

        $subject = "Service Quote Details";
        $body = $this->load->view("email_template/admin/registration", array("data" => $data), true);

        foreach ($email_id as $key => $value) {
            $ins['service_quote_id'] = $id;
            $ins['email'] = $value;
            $ins['specifications'] = $_FILES['specifications']['name'];
            $ins['is_deleted'] = "0";
            $ins['status'] = "1";
            $ins['created_date'] = current_datetime();
            $ins['added_by'] = currUserId();
            $this->db->insert("pr_service_quote_details", $ins);
            //$data['sale_quote_rate'] = $ins['sale_quote_rate'];
            $data['specifications'] = $ins['specifications'];
            //Sending Mail to user
           
            //pr($body);die;
            sendMail($ins['email'], $subject, $body);
            //Sending Mail to user
        }
        $ins['email']=$data['client_email'];
        sendMail($ins['email'], $subject, $body);

        $ins['email']=$data['serviceperson_email'];
        sendMail($ins['email'], $subject, $body);
    }

    public function last_id_get() {
        $res = $this->db->select("pr.id")
                ->from("f_master_class pr")
                ->order_by("pr.id", "Desc")
                ->limit(1)
                ->get()
                ->row();
        return $res;
    }
    public function getsales_quote_rate($id)
    {
        $res = $this->db->select("pr.quoted_amount")
                ->from("pr_sales_quote pr")
                ->where("id",$id)
                ->get()
                ->row();
               // pr($res);die;
        return $res->quoted_amount;
    }
    public function getservice_quote_rate($id)
    {
        $res = $this->db->select("pr.quoted_amount")
                ->from("pr_service_quote pr")
                ->where("id",$id)
                ->get()
                ->row();
               // pr($res);die;
        return $res->quoted_amount;
    }

    

}

?>
