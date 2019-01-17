<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salesperson_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->helper('string');
    }

    function list_items_ajax() {
        $requestData = $_REQUEST;
        $columns = array(
            '',
            "cu.id",
            "cu.fname",
            "cu.email",
            "cr.role_name"
        );
//pr($_SESSION);die;
//$logged_in_coor_id=$_SESSION['userinfo']['id'];

        if ( getUserInfos()->role == "0") {
        $sql = $this->db->select("cu.*,plc.location_name as location_name,cr.role_name,concat( cu.fname ,' ', cu.lname ) as user_name,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as cordinator_name,"
                        , FALSE)
                ->from("users cu")
                ->join("cz_roles cr", "cr.id = cu.role", "left")
                ->join("pr_location plc", "plc.id = cu.location_id", "left")
                ->join("users cum", "cum.id = cu.manager_id", "left")
                ->join("users cuc", "cuc.id = cu.cordinator_id", "left")
                ->where("(cu.role='5')")
                ->where(array("cu.is_deleted =" => "0"));
        }

        else if ( getUserInfos()->role == "1") {
            $logged_in_manager_id=$_SESSION['userinfo']['id'];
            $sql = $this->db->select("cu.*,plc.location_name as location_name,cr.role_name,concat( cu.fname ,' ', cu.lname ) as user_name,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as cordinator_name,"
            , FALSE)
                ->from("users cu")
                ->join("cz_roles cr", "cr.id = cu.role", "left")
                ->join("pr_location plc", "plc.id = cu.location_id", "left")
                ->join("users cum", "cum.id = cu.manager_id", "left")
                ->join("users cuc", "cuc.id = cu.cordinator_id", "left")
                ->where("(cu.role='5')")
                ->where(array("cu.is_deleted =" => "0","cu.manager_id=" => $logged_in_manager_id));

        }
        else if ( getUserInfos()->role == "3") {
            $logged_in_coor_id=$_SESSION['userinfo']['id'];
            $sql = $this->db->select("cu.*,plc.location_name as location_name,cr.role_name,concat( cu.fname ,' ', cu.lname ) as user_name,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as cordinator_name,"
            , FALSE)
                ->from("users cu")
                ->join("cz_roles cr", "cr.id = cu.role", "left")
                ->join("pr_location plc", "plc.id = cu.location_id", "left")
                ->join("users cum", "cum.id = cu.manager_id", "left")
                ->join("users cuc", "cuc.id = cu.cordinator_id", "left")
                ->where("(cu.role='5')")
                ->where(array("cu.is_deleted =" => "0","cu.cordinator_id=" => $logged_in_coor_id));

        }
        else{

        }

        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];
            $sql->where("(concat(cu.fname,' ',cu.lname) like '%$ser%'");
            
            $sql->or_where("cr.role_name like '%$ser%'");
            $sql->or_where("plc.location_name like '%$ser%'");
            $sql->or_where("cu.mobile like '%$ser%'");
            $sql->or_where("concat(cum.fname,' ',cum.lname)  like '%$ser%'");
            $sql->or_where("concat(cuc.fname,' ',cuc.lname)  like '%$ser%'");
            $sql->or_where("cu.email like '%$ser%' )");
        }
        
          if (isset($_GET['manager_id']) && $_GET['manager_id'] != "") {
            $manager_id = $_GET['manager_id'];
            $sql->where(array("cu.manager_id" => $manager_id));
        }

        if (isset($_GET['coordinator_id']) && $_GET['coordinator_id'] != "") {
            $coordinator_id = $_GET['coordinator_id'];
            $sql->where(array("cu.cordinator_id" => $coordinator_id));
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
        foreach ($query as $i => $row) {
            $nestedData = array();
            //$nestedData[] = ++$i;
            $nestedData[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="group-checkable checks_all" name="check_all[]" value="' . $row->id . '" />
                                                            <span></span>
                                                        </label>';
            $full_name = ucwords($row->user_name);
            $nestedData[] = $full_name;
            $nestedData[] = $row->mobile;
            //$nestedData[] = $row->location_name;
           
            $nestedData[] = $row->email;
            if(getUserInfos()->role == "1"){
             $nestedData[] = $row->cordinator_name;
            }
             if ( getUserInfos()->role == "0") {
           
            $nestedData[] = $row->cordinator_name;
            $nestedData[] = $row->manager_name;
             }
            $nestedData[] = ($row->status == '1') ? '<label class="label-success label"> Active</label>' : '<label class="label-danger label"> In Active</label>';
            $nestedData[] = $this->load->view("_action", array("data" => $row), true);
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
        $ins['fname'] = $fname;
        $ins['lname'] = $lname;
        $ins['email'] = $email;
        $ins['mobile'] = $mobile;
        $ins['address'] = $address;
        $ins['employee_id'] = $employee_id;
        $ins['gender'] = $gender;
        if(getUserInfos()->role == "0"){
            $ins['manager_id'] = $manager_id;
            $ins['cordinator_id'] = $cordinator_id;
            }
        if(getUserInfos()->role == "1"){
            $logged_in_manager_id=$_SESSION['userinfo']['id'];
            $ins['manager_id'] = $logged_in_manager_id;
            $ins['cordinator_id'] = $cordinator_id;
         
        }
        if(getUserInfos()->role == "3"){
            $logged_in_coor_id=$_SESSION['userinfo']['id'];

        $ins['cordinator_id'] = $logged_in_coor_id;
        $res = $this->db->select("cu.*")
                ->from("users cu")
                ->where(array("cu.id" => $logged_in_coor_id))
                ->get()
                ->row();
               
        $ins['manager_id'] = $res->manager_id;
        }
       
        $ins['role'] = "5";
        $ins['status'] = $status;
        $password = random_string('alnum', 7);
        $ins['password'] = md5($password);
        $ins['cpassword'] = $password;
        $ins['created_date'] = current_datetime();



       // pr($ins);die;
        $this->db->insert("users", $ins);

        //Sending Mail to user
        $subject = "Registration";
        $body = $this->load->view("email_template/admin/registration", array("data" => $ins), true);
        //pr($body);die;
        sendMail($ins['email'], $subject, $body);
        //Sending Mail to user
        
        return $this->db->insert_id();
    }

    function edit($id = NULL) {
        extract($_POST);
        $upd['fname'] = $fname;
        $upd['lname'] = $lname;
        //$upd['email'] = $email;
        //$upd['mobile'] = $mobile;
        $upd['address'] = $address;
        //$upd['employee_id'] = $employee_id;
        $upd['gender'] = $gender;
        if(getUserInfos()->role == "0"){
            $upd['manager_id'] = $manager_id;
            $upd['cordinator_id'] = $cordinator_id;
            }
        if(getUserInfos()->role == "1"){
            $logged_in_manager_id=$_SESSION['userinfo']['id'];
            $upd['manager_id'] = $logged_in_manager_id;
            $upd['cordinator_id'] = $cordinator_id;
         
        }
        if(getUserInfos()->role == "3"){
            $logged_in_coor_id=$_SESSION['userinfo']['id'];

        $upd['cordinator_id'] = $logged_in_coor_id;
        $res = $this->db->select("cu.*")
                ->from("users cu")
                ->where(array("cu.id" => $logged_in_coor_id))
                ->get()
                ->row();
               
        $upd['manager_id'] = $res->manager_id;
        }
       
      
        //$upd['role'] = $role;
        $upd['status'] = $status;
       
        $upd['updated_date'] = current_datetime();
        $whr['id'] = $id;
        
      /*   pr($upd);
        pr($whr);die; */
        $this->db->update("users", $upd, $whr);
    }

    function viewData($id) {
        $res = $this->db->select("cu.*")
                ->from("users cu")
                ->where(array("cu.id" => $id))
                ->get()
                ->row();
        return $res;
    }
    
    
   function view($id) {
        $res = $this->db->select("cu.*,plc.location_name as location_name,cum.fname as manager_fname,cum.lname as manager_lname,cuc.fname as co_fname,cuc.lname as co_lname")
                ->from("users cu")
                
                ->join("pr_location plc", "plc.id = cu.location_id", "left")
                ->join("users cum", "cum.id = cu.manager_id", "left")
                ->join("users cuc", "cuc.id = cu.cordinator_id", "left")
               
                ->where(array("cu.id" => $id))
                ->get()
                ->row();
        return $res;
    }
    
    
    

    function get_manager_user() {
        $res = $this->db->select("cu.id,cu.fname,cu.lname")
                ->from("users cu")
                ->where("(cu.role='1' OR cu.role='7')")
                 ->where("(cu.status='1' )")
                 ->where("(cu.is_deleted='0')")
                 ->order_by("cu.id","DESC")
                ->get()
                ->result();
        return $res;
    }
    
    
     function getsalesperson($manager_id,$coordinator_id) {
         
         //echo $coordinator_id;die;
        $res = $this->db->select("cu.*")
                ->from("users cu")
                ->where(array("cu.manager_id" => $manager_id,"cu.cordinator_id" => $coordinator_id,"cu.role"=>"5","cu.status"=>"1","cu.is_deleted"=>"0"))
                 ->order_by("cu.id","DESC")
                ->get()
                ->result();
        //echo $this->db->last_query();die;
        return $res;
    }
    
    
    
    function getsalescordinator($id) {
        $res = $this->db->select("cu.*")
                ->from("users cu")
                ->where(array("cu.manager_id" => $id,"cu.role"=>"3","cu.status"=>"1","cu.is_deleted"=>"0"))
                 ->order_by("cu.id","DESC")
                ->get()
                ->result();
        return $res;
    }

    function static_coordinator() {
        $logged_in_manager_id=$_SESSION['userinfo']['id'];
        $res = $this->db->select("cu.*")
                ->from("users cu")
                ->where(array("cu.manager_id" => $id,"cu.role"=>"3","cu.status"=>"1","cu.is_deleted"=>"0","cu.manager_id" =>$logged_in_manager_id ))
                 ->order_by("cu.id","DESC")
                ->get()
                ->result();
        return $res;
    }

    function static_salesperson() {
        $logged_in_coor_id=$_SESSION['userinfo']['id'];
        //echo $coordinator_id;die;
       $res = $this->db->select("cu.*")
               ->from("users cu")
               ->where(array("cu.cordinator_id" => $logged_in_coor_id,"cu.role"=>"5","cu.status"=>"1","cu.is_deleted"=>"0"))
                ->order_by("cu.id","DESC")
               ->get()
               ->result();
              // pr($res);die;
       //echo $this->db->last_query();die;
       return $res;
   }
   
   
    
    function getallsalescordinator($id) {
        if ( getUserInfos()->role == "0") {


        $res = $this->db->select("cu.*")
                ->from("users cu")
                ->where(array("cu.role"=>"3","cu.status"=>"1","cu.is_deleted"=>"0"))
              
                 ->order_by("cu.id","DESC")
                ->get()
                ->result();
        }

        if ( getUserInfos()->role == "1") {
            $logged_in_manager_id=$_SESSION['userinfo']['id'];
            $res = $this->db->select("cu.*")
            ->from("users cu")
            ->where(array("cu.role"=>"3","cu.status"=>"1","cu.is_deleted"=>"0","cu.manager_id=" => $logged_in_manager_id))
            
             ->order_by("cu.id","DESC")
            ->get()
            ->result();
                }

                
        return $res;
    }

	
    function delete($id) {
        $upd['is_deleted'] = "1";
        $whr['id'] = $id;
        $this->db->update("users", $upd, $whr);
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

    function delete_multiple($id) {

        foreach ($id as $vals) {
            $upd['is_deleted'] = "1";
            $whr['id'] = $vals;
            $abc = $this->db->update("users", $upd, $whr);
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
            $abc = $this->db->update("users", $upd, $whr);
            //echo $this->db->last_query();die;
        }

        return true;
    }
    
    
    
     function redirect_salesperson_ajax($id) {
        $requestData = $_REQUEST;
        $columns = array(
            '',
            "cu.id",
            "cu.fname",
            "cu.email",
            "cr.role_name"
        );

        $sql = $this->db->select("cu.*,plc.location_name as location_name,cr.role_name,concat( cu.fname ,' ', cu.lname ) as user_name,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as cordinator_name,"
                        , FALSE)
                ->from("users cu")
                ->join("cz_roles cr", "cr.id = cu.role", "left")
                ->join("pr_location plc", "plc.id = cu.location_id", "left")
                 ->join("users cum", "cum.id = cu.manager_id", "left")
                ->join("users cuc", "cuc.id = cu.cordinator_id", "left")
                //->where(array("cu.role =" => "1"))
                ->where("(cu.role='5')")
                 ->where("(cu.cordinator_id=$id)")

                //->or_where(array("cu.role =" => "7"))
                ->where(array("cu.is_deleted =" => "0"));

        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];
            $sql->where("(concat(cu.fname,' ',cu.lname) like '%$ser%'");
            
            $sql->or_where("cr.role_name like '%$ser%'");
            $sql->or_where("plc.location_name like '%$ser%'");
            $sql->or_where("cu.mobile like '%$ser%'");
            $sql->or_where("concat(cum.fname,' ',cum.lname)  like '%$ser%'");
            $sql->or_where("concat(cuc.fname,' ',cuc.lname)  like '%$ser%'");
            $sql->or_where("cu.email like '%$ser%' )");
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
        foreach ($query as $i => $row) {
            $nestedData = array();
            $nestedData[] = ++$i;
//            $nestedData[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
//                                                            <input type="checkbox" class="group-checkable checks_all" name="check_all[]" value="' . $row->id . '" />
//                                                            <span></span>
//                                                        </label>';
            $full_name = ucwords($row->user_name);
            $nestedData[] = $full_name;
            $nestedData[] = $row->mobile;
            //$nestedData[] = $row->location_name;
           
            $nestedData[] = $row->email;
             $nestedData[] = $row->address;
            
//            $nestedData[] = $row->manager_name;
//           
//            $nestedData[] = ($row->status == '1') ? '<label class="label-success label"> Active</label>' : '<label class="label-danger label"> In Active</label>';
//            $nestedData[] = $this->load->view("_action", array("data" => $row), true);
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


    function target($id) {
        extract($_POST);
        $res = $this->db->select("pst.*")
        ->from("pr_sales_target pst")
        ->where(array("pst.salesperson_id" => $id))
        ->get()
        ->row();
        //pr($res);die;
        $ins['salesperson_id'] = $salesperson_id;
        $ins['target_price'] = $target_price;
        $ins['target_product'] = $target_product;
        $ins['status'] = $status;
        $ins['created_date'] = current_datetime();
        $ins['added_by'] = currUserId();
        $whr['salesperson_id']=$id;
       //pr($ins);pr($whr);die;
       //pr($res);die;
       
        if(!empty($res)){

            $this->db->update("pr_sales_target", $ins,$whr);
            return "update";
        }else{
            $this->db->insert("pr_sales_target", $ins);
            return "add";
    
        }

      
    }
    function view_target($id) {
        $res = $this->db->select("pst.*")
                ->from("pr_sales_target pst")
                ->where(array("pst.salesperson_id" => $id))
                ->get()
                ->row();
        return $res;
    }
    public function last_id_get() {
        $res = $this->db->select("pr.id")
                ->from("users pr")
                ->order_by("pr.id", "Desc")
                ->limit(1)
                ->get()
                ->row();
        return $res;
    }



}

?>
