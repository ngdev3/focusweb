<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cordinator_model extends CI_Model {

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
      // pr($_SESSION);die;
       if ( getUserInfos()->role == "0") {
        $sql = $this->db->select("cu.*,plc.location_name as location_name,cr.role_name,concat( cu.fname ,' ', cu.lname ) as user_name,concat( cum.fname ,' ', cum.lname ) as manager_name,"
                        , FALSE)
                ->from("cz_users cu")
                ->join("cz_roles cr", "cr.id = cu.role", "left")
                ->join("pr_location plc", "plc.id = cu.location_id", "left")
                ->join("cz_users cum", "cum.id = cu.manager_id", "left")
                ->where("(cu.role='3' OR cu.role='4')")
                ->where(array("cu.is_deleted =" => "0"));

            } 
               
               else if ( getUserInfos()->role == "1") {
                    $logged_in_manager_id=$_SESSION['userinfo']['id'];
                    $sql = $this->db->select("cu.*,plc.location_name as location_name,cr.role_name,concat( cu.fname ,' ', cu.lname ) as user_name,concat( cum.fname ,' ', cum.lname ) as manager_name,"
                    , FALSE)
            ->from("cz_users cu")
            ->join("cz_roles cr", "cr.id = cu.role", "left")
            ->join("pr_location plc", "plc.id = cu.location_id", "left")
            ->join("cz_users cum", "cum.id = cu.manager_id", "left")
       
            ->where("(cu.role='3' OR cu.role='4')")

            ->where(array("cu.is_deleted =" => "0","cu.manager_id=" => $logged_in_manager_id));

        
        }  else{


        }
            

                

              
        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];
            $sql->where("(concat(cu.fname,' ',cu.lname) like '%$ser%'");
            
            $sql->or_where("cr.role_name like '%$ser%'");
            $sql->or_where("plc.location_name like '%$ser%'");
             $sql->or_where("cu.mobile like '%$ser%'");
            $sql->or_where("concat(cum.fname,' ',cum.lname)  like '%$ser%'");
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
        $starts= $requestData['start'];
        foreach ($query as $i => $row) {
        
            $nestedData = array();

            //$nestedData[] = ++$i;
         
            $nestedData[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="group-checkable checks_all" name="check_all[]" value="' . $row->id . '" />
                                                            <span></span>
                                                        </label>';
            $nestedData[] = ++$starts;
            $full_name = ucwords($row->user_name);
            $nestedData[] = $full_name;
            $nestedData[] = $row->mobile;
            //$nestedData[] = $row->location_name;
           
            $nestedData[] = $row->email;
            if ( getUserInfos()->role == "0"){
            $nestedData[] = $row->manager_name;
            }
            $nestedData[] = $row->role_name;
           
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
        
        //pr($_POST);die;
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
           
            }
        if(getUserInfos()->role == "1"){
            $logged_in_manager_id=$_SESSION['userinfo']['id'];
            $ins['manager_id'] = $logged_in_manager_id;
         
        }
      
        $ins['role'] = $role;
        $ins['status'] = $status;
        $password = random_string('alnum', 7);
        $ins['password'] = md5($password);
        $ins['cpassword'] = $password;
        $ins['created_date'] = current_datetime();



        //pr($ins);die;
        $this->db->insert("cz_users", $ins);

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
           
            }
        if(getUserInfos()->role == "1"){
            $logged_in_manager_id=$_SESSION['userinfo']['id'];
            $upd['manager_id'] = $logged_in_manager_id;
         
        }
        $upd['role'] = $role;
        $upd['status'] = $status;
       
        $upd['updated_date'] = current_datetime();
        $whr['id'] = $id;
        $this->db->update("cz_users", $upd, $whr);
    }

    function viewData($id) {
        $res = $this->db->select("cu.*")
                ->from("cz_users cu")
                ->where(array("cu.id" => $id))
                ->get()
                ->row();
        return $res;
    }
    
    
    function view($id) {
        $res = $this->db->select("cu.*,cr.role_name,plc.location_name as location_name,cum.fname as manager_fname,cum.lname as manager_lname")
                ->from("cz_users cu")
                
                ->join("pr_location plc", "plc.id = cu.location_id", "left")
                ->join("cz_users cum", "cum.id = cu.manager_id", "left")
                ->join("cz_roles cr", "cr.id = cu.role", "left")
                ->where(array("cu.id" => $id))
                ->get()
                ->row();
        return $res;
    }
    
    
    

    function get_manager_user() {
        $res = $this->db->select("cu.id,cu.fname,cu.lname")
                ->from("cz_users cu")
                ->where("(cu.role='1' OR cu.role='7')")
                 ->where("(cu.status='1' )")
                 ->where("(cu.is_deleted='0')")
                ->get()
                ->result();
        return $res;
    }
    
    
     function get_coordinator_user() {
         $res = $this->db->select("cr.*")
                ->from("cz_roles cr")
                ->where("(cr.id='3' OR cr.id='4')")
                ->get()
                ->result();
        return $res;
    }
    

    function delete($id) {
        $upd['is_deleted'] = "1";
        $whr['id'] = $id;
        $this->db->update("cz_users", $upd, $whr);
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
            $abc = $this->db->update("cz_users", $upd, $whr);
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
            $abc = $this->db->update("cz_users", $upd, $whr);
            //echo $this->db->last_query();die;
        }

        return true;
    }
    
    //***********Redirect List of Coordinator*************************//
    
    
    function redirect_cordinator_ajax($manager_id) {
        
       // pr($manager_id);die;
        $requestData = $_REQUEST;
        $columns = array(
            '',
            "cu.id",
            "cu.fname",
            "cu.email",
            "cr.role_name"
        );


       
        $sql = $this->db->select("cu.*,plc.location_name as location_name,cr.role_name,concat( cu.fname ,' ', cu.lname ) as user_name,concat( cum.fname ,' ', cum.lname ) as manager_name,"
                        , FALSE)
                ->from("cz_users cu")
                ->join("cz_roles cr", "cr.id = cu.role", "left")
                ->join("pr_location plc", "plc.id = cu.location_id", "left")
                 ->join("cz_users cum", "cum.id = cu.manager_id", "left")
                //->where(array("cu.role =" => "1"))
                //->where("(cu.role='3')")
                
                 ->where("(cu.role='3' OR cu.role='4')")

                //->or_where(array("cu.role =" => "7"))
                ->where(array("cu.is_deleted =" => "0","cu.manager_id"=>$manager_id));
        



        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];
            $sql->where("(concat(cu.fname,' ',cu.lname) like '%$ser%'");
            
            $sql->or_where("cr.role_name like '%$ser%'");
            $sql->or_where("plc.location_name like '%$ser%'");
            $sql->or_where("cu.mobile like '%$ser%'");
            
            $sql->or_where("concat(cum.fname,' ',cum.lname)  like '%$ser%'");
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
        $starts= $requestData['start'];
        foreach ($query as $i => $row) {
        
            $nestedData = array();

            //$nestedData[] = ++$i;
            $nestedData[] = ++$starts;
//            $nestedData[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
//                                                            <input type="checkbox" class="group-checkable checks_all" name="check_all[]" value="' . $row->id . '" />
//                                                            <span></span>
//                                                        </label>';
            $full_name = ucwords($row->user_name);
            $nestedData[] = $full_name;
            $nestedData[] = $row->mobile;
            //$nestedData[] = $row->location_name;
           
            if ( getUserInfos()->role == "0") { 
            $nestedData[] = $row->manager_name;
            }
            $nestedData[] = $row->email;
            $nestedData[] = $row->role_name;
            $nestedData[] = '<a href="' . base_url() . 'salesperson/redirect_salesperson/' . ID_encode($row->id) . '" class="label-success label" >'. get_total_salesPerson($row->id) .'</a>';
            $nestedData[] = '<a href="' . base_url() . 'serviceperson/redirect_serviceperson/' . ID_encode($row->id) . '" class="label-success label" >'. get_total_servicePerson($row->id) .'</a>';
           
            //$nestedData[] = ($row->status == '1') ? '<label class="label-success label"> Active</label>' : '<label class="label-danger label"> In Active</label>';
            //$nestedData[] = $this->load->view("_action", array("data" => $row), true);
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

    public function last_id_get() {
        $res = $this->db->select("pr.id")
                ->from("cz_users pr")
                ->order_by("pr.id", "Desc")
                ->limit(1)
                ->get()
                ->row();
        return $res;
    }


}

?>
