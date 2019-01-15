<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function list_items_ajax() {
        $requestData = $_REQUEST;
        $columns = array(
            "cu.id",
            "cu.fname",
            "cu.email",
            "cr.role_name"
        );

        $sql = $this->db->select("cu.*,cr.role_name"
                        , FALSE)
                ->from("cz_users cu")
                ->join("cz_roles cr", "cr.id = cu.role", "left")
                ->where(array("cu.role !=" => "0"));
                if(isset($_GET['role'])){
                $sql->where(array("cu.role" => @$_GET['role']));
                }

        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];
            $sql->where("(cu.fname like '%$ser%'");
            $sql->or_where("cu.lname like '%$ser%' ");
            $sql->or_where("cu.email like '%$ser%' )");
        }

//        if (isset($_GET['warehouse']) && $_GET['warehouse'] > 0 ) {
//            $sql->or_where(array("ip.warehouse" => $_GET["warehouse"]));
//        }
//        if (isset($_GET['category']) && $_GET['category'] > 0) {
//            $sql->where(array("ip.category" => $_GET["category"]));
//        }
//        if (isset($_GET['sub_category']) && $_GET['sub_category'] > 0) {
//            $sql->where(array("ip.sub_category" => $_GET["sub_category"]));
//        }
//        if (isset($_GET['color1']) && $_GET['color1'] > 0) {
//            $sql->where(array("ip.color1" => $_GET["color1"]));
//        }
//        if (isset($_GET['color2']) && $_GET['color2'] > 0) {
//            $sql->where(array("ip.color2" => $_GET["color2"]));
//        }
//        if (isset($_GET['stone_material']) && $_GET['stone_material'] > 0) {
//            $sql->where(array("ip.stone_material" => $_GET["stone_material"]));
//        }
//        if (isset($_GET['metal_material']) && $_GET['metal_material'] > 0) {
//            $sql->where(array("ip.metal_material" => $_GET["metal_material"]));
//        }
//        if (isset($_GET['start_date']) && !empty($_GET['start_date'])) {
//            $start_date = $_GET['start_date'];
//            $end_date = $_GET['end_date'];
//            $sql->where("ip.created BETWEEN '$start_date' AND '$end_date 23:59:59'");
//        }
//        $sql->group_by($columns[$requestData['order'][0]['column']] . ' ' . $requestData['order'][0]['dir'] . " with ROLLUP");
        $sql->order_by($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $sql1 = clone $sql;
        if ($requestData['length'] != '-1') {  // for showing all records
            $query = $sql->limit($requestData['length'], $requestData['start']);
        }
        $query = $sql->get()->result();
        $totalData = $totalFiltered = $sql1->get()->num_rows();
        $data = array();
        foreach ($query as $i => $row) {
            $nestedData = array();

            $nestedData[] = ++$i;
            $full_name = ucwords($row->fname . ' ' . $row->lname);
            $nestedData[] = $full_name;
            $nestedData[] = $row->email;
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
        extract($_POST);
        $ins['fname'] = $fname;
        $ins['lname'] = $lname;
        $ins['email'] = $email;
        $ins['mobile'] = $mobile;
        $ins['password'] = md5($password);
        $ins['cpassword'] = $password;
        $ins['role'] = $role;
        $ins['status'] = $status;
        //pr($ins);die;
        $this->db->insert("cz_users", $ins);
        
        //Sending Mail to user
                $subject = "Registration";
		$body = $this->load->view("email_template/admin/registration",array("data"=>$ins),true);
                //pr($body);die;
                sendMail($ins['email'],$subject,$body);
                 //Sending Mail to user
        
        
    }
    
     function edit($id = NULL) {
        extract($_POST);
        $upd['fname'] = $fname;
        $upd['lname'] = $lname;
        $upd['email'] = $email;
        $upd['mobile'] = $mobile;
        $upd['role'] = $role;
        $upd['status'] = $status;
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
    

    function profile($user_id) {
        $res = $this->db->select("cu.*, CONCAT(fname,' ',lname) as fullname, cr.role_name,pl.location_name")
                        ->from("cz_users cu")
                        ->join("cz_roles cr","cr.id = cu.role","left")
                        ->join("pr_location pl","pl.id = cu.location_id","left")
                        ->where(array("cu.id" => $user_id))
                        ->get()->row();
//        echo $this->db->last_query(); 
        return $res;
    }
    
    function update_profile($user_id){
		
		
        extract($_POST);
        $upd['fname'] = $fname;
        $upd['lname'] = $lname;
        $upd['email'] = $email;
        $upd['mobile'] = $mobile;      
        $upd['role'] = $role;
        //$upd['status'] = $status;
        
        $whr['id'] = $user_id;       
        $this->db->update("cz_users", $upd,$whr);
//      echo $this->db->last_query(); die;
    }
    
    function change_password($user_id){
        $upd['cpassword'] = $_POST['new_password'];
        $upd['password'] = md5($_POST['new_password']);        
        $whr['id'] = $user_id; 
        
        $this->db->update("cz_users",$upd, $whr);
    }
    
    
    function delete($id){
       // $upd['is_delete'] = "1";
        $whr['id']=$id;
        $this->db->delete("cz_users",$whr);
       // echo $this->db->last_query();die;
        if ($this->db->affected_rows() > 0) {
            $rt["status"] = "true";
            $rt["msg"] = "Success";
        } else {
            $rt["status"] = "false";
            $rt["msg"] = "Row was not deleted";
        }
        return $rt;
    }
    

}

?>
