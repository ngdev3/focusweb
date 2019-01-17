<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Leadmanagement_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function list_items_ajax() {
        $requestData = $_REQUEST;
        $columns = array(
            " ",
            "pr.id",
            "pr.id",
            "pr.client_name",
            "pr.contact_person",
            "pr.contact_number",
            "pr.priority",
            "cum.fname",
            "cuc.fname",
            "cus.fname"
        );
        

if(getUserInfos()->role == "0"){
         $sql = $this->db->select("pr.*,pra.outcome_status,ppl.name as ptype_name,concat( cus.fname ,' ', cus.lname ) as sales_name,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as cordinator_name"
        , FALSE)
            ->from("pr_lead pr")
            ->join("pr_type_lead ppl", "ppl.id = pr.type_of_lead", "left")
            ->join("pr_assign_lead_sales pra", "pra.lead_id = pr.id", "left")
            ->join("users cum", "cum.id = pra.manager_id", "left")
            ->join("users cuc", "cuc.id = pra.coordinator_id", "left")

            ->join("users cus", "cus.id = pra.sales_person_id", "left")

            ->where("pr.is_deleted", "0"); 
           /*  ->get()->result();
            pr($sql);die; */
}
       else if(getUserInfos()->role == "1"){
          
            $logged_in_manager_id=$_SESSION['userinfo']['id'];
            $query1 = $this->db->query("select lead_id from pr_assign_lead_sales");
            $query1_result = $query1->result();
            $room_id= array();
            foreach($query1_result as $row){
               $room_id[] = $row->lead_id;
             }
            
       
            $this->db->select("id");
            $this->db->from('pr_lead');
            $this->db->where_not_in('id', $room_id);
            $query = $this->db->get();
        
            $sql2=$query->result();
            $l_id= array();
            foreach($sql2 as $row){
                $l_id[] = $row->id;
              }if(empty($l_id)){
                $l_id=null;  
              }
         
          $sql = $this->db->select("pr.*,pra.outcome_status,ppl.name as ptype_name,concat( cus.fname ,' ', cus.lname ) as sales_name,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as cordinator_name"
                        , FALSE)
                ->from("pr_lead pr")
                ->join("pr_type_lead ppl", "ppl.id = pr.type_of_lead", "left")
                ->join("pr_assign_lead_sales pra", "pra.lead_id = pr.id", "left")
                 ->join("users cum", "cum.id = pra.manager_id", "left")
                ->join("users cuc", "cuc.id = pra.coordinator_id", "left")
                
                 ->join("users cus", "cus.id = pra.sales_person_id", "left")
               
                 ->where_in('pr.id', $l_id)
                 ->or_where_in('pra.manager_id', $logged_in_manager_id)
                 ->where_in("pr.is_deleted", "0");
              
              
            }
            else if(getUserInfos()->role == "3"){
          
                $logged_in_coor_id=$_SESSION['userinfo']['id'];
                $query1 = $this->db->query("select lead_id from pr_assign_lead_sales");
                $query1_result = $query1->result();
                $room_id= array();
                foreach($query1_result as $row){
                   $room_id[] = $row->lead_id;
                 }
                
           
                $this->db->select("id");
                $this->db->from('pr_lead');
                $this->db->where_not_in('id', $room_id);
                $query = $this->db->get();
            
                $sql2=$query->result();
                $l_id= array();
                foreach($sql2 as $row){
                    $l_id[] = $row->id;
                  }
             
            $sql = $this->db->select("pr.*,pra.outcome_status,ppl.name as ptype_name,concat( cus.fname ,' ', cus.lname ) as sales_name,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as cordinator_name"
                            , FALSE)
                    ->from("pr_lead pr")
                    ->join("pr_type_lead ppl", "ppl.id = pr.type_of_lead", "left")
                    ->join("pr_assign_lead_sales pra", "pra.lead_id = pr.id", "left")
                     ->join("users cum", "cum.id = pra.manager_id", "left")
                    ->join("users cuc", "cuc.id = pra.coordinator_id", "left")
                    
                     ->join("users cus", "cus.id = pra.sales_person_id", "left")
                   
                     ->where_in('pr.id', $l_id)
                     ->or_where_in('pra.coordinator_id', $logged_in_coor_id)
                     ->where_in("pr.is_deleted", "0");
                  
                  
                } 
            else{

            }
       
         

        if (isset($_GET['manager_id']) && $_GET['manager_id'] != "") {
            $manager_id = $_GET['manager_id'];
            $sql->where(array("pra.manager_id" => $manager_id));
        }

        if (isset($_GET['coordinator_id']) && $_GET['coordinator_id'] != "") {
            $coordinator_id = $_GET['coordinator_id'];
            $sql->where(array("pra.coordinator_id" => $coordinator_id));
        }
        
        if (isset($_GET['salesperson_id']) && $_GET['salesperson_id'] != "") {
            $salesperson_id = $_GET['salesperson_id'];
            $sql->where(array("pra.sales_person_id" => $salesperson_id));
        }
        if (isset($_GET['outcome_status']) && $_GET['outcome_status'] != "") {
            $outcome_status = $_GET['outcome_status'];
            $sql->where(array("pra.outcome_status" => $outcome_status));
        }
       

        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];
            $sql->where("(pr.client_name like '%$ser%'");
            $sql->where("pr.contact_person like '%$ser%'");
            $sql->where("pr.contact_number like '%$ser%'");
            $sql->or_where("concat(cum.fname,' ',cum.lname)  like '%$ser%'");
            $sql->or_where("concat(cuc.fname,' ',cuc.lname)  like '%$ser%'");
            $sql->or_where("concat(cus.fname,' ',cus.lname)  like '%$ser%'");
  
            $sql->or_where("pr.website like '%$ser%' )");
        }


        $sql->order_by($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $sql1 = clone $sql;
        if ($requestData['length'] != '-1') {  // for showing all records
            $query = $sql->limit($requestData['length'], $requestData['start']);
        }
        $query = $sql->get()->result();
    //   pr($query);die;
        $totalData = $totalFiltered = $sql1->get()->num_rows();
        $data = array();
        $starts= $requestData['start'];
        foreach ($query as $i => $row) {
        
            $nestedData = array();

           
            if ($row->priority == '1') {
                $priority = 'Low';
            }
            if ($row->priority == '2') {
                $priority = 'Medium';
            }
            if ($row->priority == '3') {
                $priority = 'High';
            }
            
            
            
             if ($row->outcome_status == '0') {
                $outcome_status = '<label class="label-success label"> In Process</label>';
            }
             elseif ($row->outcome_status == '1') {
                $outcome_status = '<label class="label-success label"> Won</label>';
            }
            elseif ($row->outcome_status == '2') {
                $outcome_status = '<label class="label-danger label"> Lost</label>';
            }
            elseif ($row->outcome_status == '3') {
                $outcome_status = '<label class="label-success label"> Continue</label>Continue';
            }
            elseif ($row->outcome_status == '4') {
                $outcome_status = '<label class="label-warning label"> Reshedule</label>';
            }else{
                $outcome_status='<label class="label-danger label"> Lead Not Assign</label>';
            }


            
            
         


          
            $nestedData[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="group-checkable checks_all" name="check_all[]" value="' . $row->id . '" />
                                                            <span></span>
                                                        </label>';
            //$nestedData[] = ++$i;
            $nestedData[] = ++$starts;
            // $full_name = ucwords($row->fname . ' ' . $row->lname);
            $nestedData[] = $row->dymic_lead_id;
            $nestedData[] = ucwords($row->client_name);
            $nestedData[] = ucwords($row->contact_person);
            $nestedData[] = ucwords($row->contact_number);
            $nestedData[] = $priority;
            if (getUserInfos()->role == "0"){ 
            $nestedData[] = ucwords($row->manager_name);
            $nestedData[] = ucwords($row->cordinator_name);
            }
            if (getUserInfos()->role == "1"){ 
            $nestedData[] = ucwords($row->cordinator_name);
            }
            $nestedData[] = ucwords($row->sales_name);

            
            
                    
            $nestedData[] =$outcome_status ;
            //$nestedData[] = ($row->status == '1') ? '<label class="label-success label"> Active</label>' : '<label class="label-danger label"> In Active</label>';
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

        $ins['type_of_lead'] = $type_of_lead;

        $ins['dymic_lead_id'] = $dymic_lead_id;
        $ins['client_name'] = $client_name;
        $ins['website'] = $website;
        $ins['location'] = $location;
        $ins['address'] = $address;
        $ins['contact_person'] = $contact_person;
        $ins['contact_number'] = $contact_number;
        $ins['email_id'] = $email_id;
        $ins['priority'] = $priority;
        $ins['notes'] = $notes;
        $ins['status'] = $status;
        $ins['created_date'] = current_datetime();
        $ins['added_by'] = currUserId();

        $this->db->insert("pr_lead", $ins);
    }

    public function last_id_get() {
        $res = $this->db->select("pr.id")
                ->from("pr_lead pr")
                ->order_by("pr.id", "Desc")
                ->limit(1)
                ->get()
                ->row();
        return $res;
    }

    function edit($id) {
        extract($_POST);
        $upd['type_of_lead'] = $type_of_lead;

        $upd['client_name'] = $client_name;
        $upd['website'] = $website;
        $upd['location'] = $location;
        $upd['address'] = $address;
        $upd['contact_person'] = $contact_person;
        $upd['contact_number'] = $contact_number;
        $upd['email_id'] = $email_id;
        $upd['priority'] = $priority;
        $upd['notes'] = $notes;
        $upd['status'] = $status;
        $upd['updated_date'] = current_datetime();

        $whr['id'] = $id;
        $this->db->update("pr_lead", $upd, $whr);
    }

    function viewData($id) {

        $res = $this->db->select("pr.*")
                ->from("pr_lead pr")
                ->where(array("pr.id" => $id))
                ->get()
                ->row();
        return $res;
    }

    function view($id) {

               $res = $this->db->select("pr.*,pra.lost_reason,pra.lost_comment,pra.lost_to,pra.manager_id,pra.coordinator_id,pra.sales_person_id,pra.outcome_status,pra.created_date as assigned_activity_date,ppl.name as ptype_name,concat( cus.fname ,' ', cus.lname ) as sales_name,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as cordinator_name")
                ->from("pr_lead pr")
                 ->join("pr_type_lead ppl", "ppl.id = pr.type_of_lead", "left")
                 ->join("pr_assign_lead_sales pra", "pra.lead_id = pr.id", "left")
                 ->join("users cum", "cum.id = pra.manager_id", "left")
                 ->join("users cuc", "cuc.id = pra.coordinator_id", "left")
                
                 ->join("users cus", "cus.id = pra.sales_person_id", "left")
                
                
                ->where(array("pr.id" => $id))
                ->get()
                ->row();
        return $res;
    }
    
    
    function view_meeting($id) {

        $res = $this->db->select("prl.*,concat( cus.fname ,' ', cus.lname ) as sales_name,cus.profile_image as sales_image")
                ->from("pr_lead_meeting prl")
                
                ->join("users cus", "cus.id = prl.sales_person_id", "left")                
                ->where(array("prl.lead_id" => $id))
                 ->where(array("prl.is_approved" => 1))
                ->get()
                ->result();
        return $res;
    }

    
    
    

    function delete($id) {
        $upd['is_deleted'] = "1";
        $whr['id'] = $id;
        $this->db->update("pr_lead", $upd, $whr);
        if ($this->db->affected_rows() > 0) {
            $rt["status"] = "true";
        } else {
            $rt["status"] = "false";
        }
        return $rt;
    }

    function delete_multiple($id) {

        // pr($id);
        //$ids= explode(",",$id);
        //pr($ids);die;

        foreach ($id as $vals) {
            // echo $vals;die;
            $upd['is_deleted'] = "1";
            $whr['id'] = $vals;
            $abc = $this->db->update("pr_lead", $upd, $whr);
        }

        if ($abc) {
            return true;
        } else {

            return false;
        }
    }

    function assign_activity_add($id) {
        extract($_POST);
        $ins['lead_id'] = $id;
        if(getUserInfos()->role == "0"){
            $ins['manager_id'] = $manager_id;
            $ins['coordinator_id'] = $cordinator_id;
           
            }
        if(getUserInfos()->role == "1"){
            $logged_in_manager_id=$_SESSION['userinfo']['id'];
            $ins['manager_id'] = $logged_in_manager_id;
            $ins['coordinator_id'] = $cordinator_id;
        }
        if(getUserInfos()->role == "3"){
            $logged_in_coor_id=$_SESSION['userinfo']['id'];
    
        $ins['coordinator_id'] = $logged_in_coor_id;
        $res = $this->db->select("cu.*")
                ->from("users cu")
                ->where(array("cu.id" => $logged_in_coor_id))
                ->get()
                ->row();
               
        $ins['manager_id'] = $res->manager_id;
        }
       
        $ins['sales_person_id'] = $salesperson_id;
        $ins['activity'] = $activity;
        $ins['description'] = $description;
        $ins['meeting_date'] = date('Y-m-d', strtotime($meeting_date));
        ;
        $ins['start_time'] = date('H:i:s', strtotime($start_time));
        $ins['end_time'] = date('H:i:s', strtotime($end_time));
        $ins['status'] = $status;
        $ins['created_date'] = current_datetime();
        $ins['added_by'] = currUserId();
        //pr($ins);die;
        $this->db->insert("pr_assign_lead_sales", $ins);
        
       //Insert Data in meeting table 
        $metting_ins['lead_id'] = $id;
        $metting_ins['sales_person_id'] = $salesperson_id;
        $metting_ins['meeting_date'] = date('Y-m-d', strtotime($meeting_date));
        $metting_ins['start_time'] = date('H:i:s', strtotime($start_time));
        $metting_ins['status'] = $status;
        $metting_ins['created_date'] = current_datetime();
        $metting_ins['added_by'] = currUserId();
        $metting_ins['is_approved']='1';
        $this->db->insert("pr_lead_meeting", $metting_ins);
       
        
        
        
    }

    function assign_activity_edit($id) {
        extract($_POST);
        // $ins['lead_id']=$id;
        if(getUserInfos()->role == "0"){
            $upd['manager_id'] = $manager_id;
           
            }
        if(getUserInfos()->role == "1"){
            $logged_in_manager_id=$_SESSION['userinfo']['id'];
            $upd['manager_id'] = $logged_in_manager_id;
         
        }
        $upd['coordinator_id'] = $cordinator_id;
        $upd['sales_person_id'] = $salesperson_id;
        $upd['activity'] = $activity;
        $upd['description'] = $description;
        $upd['meeting_date'] = date('Y-m-d', strtotime($meeting_date));
        ;
        $upd['start_time'] = date('H:i:s', strtotime($start_time));
        $upd['end_time'] = date('H:i:s', strtotime($end_time));
        $upd['status'] = $status;
        $upd['updated_date'] = current_datetime();
        $whr['lead_id'] = $id;
        $this->db->update("pr_assign_lead_sales", $upd, $whr);

        //pr($ins);die;
    }

    function viewActivity($id) {

        $res = $this->db->select("pr.*")
                ->from("pr_assign_lead_sales pr")
                ->where(array("pr.lead_id" => $id))
                ->get()
                ->row();
        return $res;
    }
    
    
     function change_employee() {
         //Insert record in meeting table for lead
        $metting_ins['lead_id'] = $_POST['lead_id'];
        $metting_ins['sales_person_id'] = $_POST['sales_person_id'];
        $metting_ins['created_date'] = current_datetime();
        $metting_ins['added_by'] = currUserId();
        $metting_ins['emp_add_type']='1';
        $metting_ins['is_approved']='1';
        
       // pr($meeting_ins);die;
        
        $this->db->insert("pr_lead_meeting", $metting_ins);
        //Chnage Employee and assigned to new employee 
        $upd['sales_person_id'] = $_POST['sales_person_id'];
        $upd['outcome_status'] = "0";
        $whr['lead_id'] = $_POST['lead_id'];
        $this->db->update("pr_assign_lead_sales", $upd, $whr);
        if ($this->db->affected_rows() > 0) {
            $rt["status"] = "true";
        } else {
            $rt["status"] = "false";
        }
        return $rt;
    }

    public function export() {

        
if(getUserInfos()->role == "0"){
         $sql = $this->db->select("pr.*,concat(cz.fname,' ',cz.lname) as added_by,pra.outcome_status,ppl.name as ptype_name,concat( cus.fname ,' ', cus.lname ) as sales_name,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as cordinator_name"
        , FALSE)
            ->from("pr_lead pr")
            ->join("pr_type_lead ppl", "ppl.id = pr.type_of_lead", "left")
            ->join("pr_assign_lead_sales pra", "pra.lead_id = pr.id", "left")
            ->join("users cum", "cum.id = pra.manager_id", "left")
            ->join("users cuc", "cuc.id = pra.coordinator_id", "left")
            ->join("users cz","cz.id=pr.added_by","left")
            ->join("users cus", "cus.id = pra.sales_person_id", "left")

            ->where("pr.is_deleted", "0"); 
           /*  ->get()->result();
            pr($sql);die; */
}
       else if(getUserInfos()->role == "1"){
          
            $logged_in_manager_id=$_SESSION['userinfo']['id'];
            $query1 = $this->db->query("select lead_id from pr_assign_lead_sales");
            $query1_result = $query1->result();
            $room_id= array();
            foreach($query1_result as $row){
               $room_id[] = $row->lead_id;
             }
            
       
            $this->db->select("id");
            $this->db->from('pr_lead');
            $this->db->where_not_in('id', $room_id);
            $query = $this->db->get();
        
            $sql2=$query->result();
            $l_id= array();
            foreach($sql2 as $row){
                $l_id[] = $row->id;
              }
         
          $sql = $this->db->select("pr.*,concat(cz.fname,' ',cz.lname) as added_by,pra.outcome_status,ppl.name as ptype_name,concat( cus.fname ,' ', cus.lname ) as sales_name,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as cordinator_name"
                        , FALSE)
                ->from("pr_lead pr")
                ->join("pr_type_lead ppl", "ppl.id = pr.type_of_lead", "left")
                ->join("pr_assign_lead_sales pra", "pra.lead_id = pr.id", "left")
                 ->join("users cum", "cum.id = pra.manager_id", "left")
                ->join("users cuc", "cuc.id = pra.coordinator_id", "left")
                 ->join("users cz","cz.id=pr.added_by","left")
                 ->join("users cus", "cus.id = pra.sales_person_id", "left")
               
                 ->where_in('pr.id', $l_id)
                 ->or_where_in('pra.manager_id', $logged_in_manager_id)
                 ->where_in("pr.is_deleted", "0");
              
              
            }
            else if(getUserInfos()->role == "3"){
          
                $logged_in_coor_id=$_SESSION['userinfo']['id'];
                $query1 = $this->db->query("select lead_id from pr_assign_lead_sales");
                $query1_result = $query1->result();
                $room_id= array();
                foreach($query1_result as $row){
                   $room_id[] = $row->lead_id;
                 }
                
           
                $this->db->select("id");
                $this->db->from('pr_lead');
                $this->db->where_not_in('id', $room_id);
                $query = $this->db->get();
            
                $sql2=$query->result();
                $l_id= array();
                foreach($sql2 as $row){
                    $l_id[] = $row->id;
                  }
             
            $sql = $this->db->select("pr.*,concat(cz.fname,' ',cz.lname) as added_by,pra.outcome_status,ppl.name as ptype_name,concat( cus.fname ,' ', cus.lname ) as sales_name,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as cordinator_name"
                            , FALSE)
                    ->from("pr_lead pr")
                    ->join("pr_type_lead ppl", "ppl.id = pr.type_of_lead", "left")
                    ->join("pr_assign_lead_sales pra", "pra.lead_id = pr.id", "left")
                     ->join("users cum", "cum.id = pra.manager_id", "left")
                    ->join("users cuc", "cuc.id = pra.coordinator_id", "left")
                     ->join("users cz","cz.id=pr.added_by","left")
                     ->join("users cus", "cus.id = pra.sales_person_id", "left")
                   
                     ->where_in('pr.id', $l_id)
                     ->or_where_in('pra.coordinator_id', $logged_in_coor_id)
                     ->where_in("pr.is_deleted", "0");
                  
                  
                } 
            else{

            }
       
         

        if (isset($_GET['manager_id']) && $_GET['manager_id'] != "") {
            $manager_id = $_GET['manager_id'];
            $sql->where(array("pra.manager_id" => $manager_id));
        }

        if (isset($_GET['coordinator_id']) && $_GET['coordinator_id'] != "") {
            $coordinator_id = $_GET['coordinator_id'];
            $sql->where(array("pra.coordinator_id" => $coordinator_id));
        }
        
        if (isset($_GET['salesperson_id']) && $_GET['salesperson_id'] != "") {
            $salesperson_id = $_GET['salesperson_id'];
            $sql->where(array("pra.sales_person_id" => $salesperson_id));
        }
        if (isset($_GET['priority']) && $_GET['priority'] != "") {
            $priority = $_GET['priority'];
            $sql->where(array("pr.priority" => $priority));
        }
        if (isset($_GET['outcome_status']) && $_GET['outcome_status'] != "") {
            $outcome_status = $_GET['outcome_status'];
            $sql->where(array("pra.outcome_status" => $outcome_status));
        }


        $sql->order_by("pr.id", "DESC");
        $query = $sql->get()->result();
// pr($query);
//         echo $this->db->last_query();die;
        return $query;
    }

}

?>
