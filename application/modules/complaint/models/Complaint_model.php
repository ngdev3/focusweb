<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Complaint_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function list_items_ajax() {
        $requestData = $_REQUEST;
        $columns = array(
            " ",
            "pr.id",
            "pr.complaint_type",
            "pr.client_name",
            "pr.contact_person",
            "pr.contact_number",
            "pr.priority",
            "pr.id",
            "pr.id",
            
        );
        if ( getUserInfos()->role == "0") {

        $sql = $this->db->select("pr.*,pca.outcome_status,ptc.name as complaint_types,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as coordinator_name,concat( cus.fname ,' ', cus.lname ) as serviceperson_name,pca.complaint_id as copm_id", FALSE)
                ->from("pr_complaint pr")
                ->join("pr_complaint_assign pca","pca.complaint_id=pr.id","left") 
                ->join("pr_type_complaint ptc","ptc.id=pr.complaint_type","left") 
                ->join("cz_users cum", "cum.id = pca.manager_id", "left")
                ->join("cz_users cuc", "cuc.id = pca.coordinator_id", "left")
                ->join("cz_users cus", "cus.id = pca.serviceperson_id", "left")
                ->where(array("pr.is_deleted =" => "0"/* ,"pr.status="=>"1" */));

            }else if ( getUserInfos()->role == "1") {
                $logged_in_manager_id=$_SESSION['userinfo']['id'];
                $query1 = $this->db->query("select complaint_id from pr_complaint_assign");
                $query1_result = $query1->result();
                $room_id= array();
                foreach($query1_result as $row){
                   $room_id[] = $row->complaint_id;
                 }
               //  pr($room_id);die;
                
           
                $this->db->select("id");
                $this->db->from('pr_complaint');
                $this->db->where_not_in('id', $room_id);
                $query = $this->db->get();
            
                $sql2=$query->result();
               // pr($sql2);die;
                $l_id= array();
                foreach($sql2 as $row){
                    $l_id[] = $row->id;
                  }if(empty($l_id)){
                    $l_id=null;  
                  }
                $sql = $this->db->select("pr.*,pca.outcome_status,ptc.name as complaint_types,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as coordinator_name,concat( cus.fname ,' ', cus.lname ) as serviceperson_name,pca.complaint_id as copm_id", FALSE)
                ->from("pr_complaint pr")
                ->join("pr_complaint_assign pca","pca.complaint_id=pr.id","left") 
                ->join("pr_type_complaint ptc","ptc.id=pr.complaint_type","left") 
                ->join("cz_users cum", "cum.id = pca.manager_id", "left")
                ->join("cz_users cuc", "cuc.id = pca.coordinator_id", "left")
                ->join("cz_users cus", "cus.id = pca.serviceperson_id", "left")
              //  ->where(array("pr.is_deleted =" => "0","pca.manager_id=" => $logged_in_manager_id/* ,"pr.status="=>"1" */));
             
              ->where_in('pr.id', $l_id)
                 ->or_where_in('pca.manager_id', $logged_in_manager_id)
                 ->where_in("pr.is_deleted", "0");
            }else{

            }

         if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];

            $ser=str_replace("'",",","$ser");

            $sql->where("(pca.complaint_id like '%$ser%'");
            $sql->or_where("pr.contact_person like '%$ser%'");
            $sql->or_where("pr.contact_number like '%$ser%'");
            $sql->or_where("pr.client_name like '%$ser%'");
            $sql->or_where("concat(cum.fname,' ',cum.lname)  like '%$ser%'");
            $sql->or_where("concat(cuc.fname,' ',cuc.lname)  like '%$ser%'");
            $sql->or_where("concat(cus.fname,' ',cus.lname)  like '%$ser%'");
  
            $sql->or_where("ptc.name like '%$ser%' )");
        } 
        if (isset($_GET['manager_id']) && $_GET['manager_id'] != "") {
            $manager_id = $_GET['manager_id'];
            $sql->where(array("pca.manager_id" => $manager_id));
        }

        if (isset($_GET['coordinator_id']) && $_GET['coordinator_id'] != "") {
            $coordinator_id = $_GET['coordinator_id'];
            $sql->where(array("pca.coordinator_id" => $coordinator_id));
        }
        
        if (isset($_GET['serviceperson_id']) && $_GET['serviceperson_id'] != "") {
            $serviceperson_id = $_GET['serviceperson_id'];
            $sql->where(array("pca.serviceperson_id" => $serviceperson_id));
        }
        if (isset($_GET['priority']) && $_GET['priority'] != "") {
            $priority = $_GET['priority'];
            $sql->where(array("pr.priority" => $priority));
        }

       


        $sql->order_by($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $sql1 = clone $sql;
        if ($requestData['length'] != '-1') {  // for showing all records
            $query = $sql->limit($requestData['length'], $requestData['start']);
        }
        $query = $sql->get()->result();
        //pr($query);die;
        $totalData = $totalFiltered = $sql1->get()->num_rows();
        $data = array();
        $starts= $requestData['start'];
        foreach ($query as $i => $row) {
        
            $nestedData = array();

            //$nestedData[] = ++$i;
            $nestedData[] = ++$starts;
            if ($row->priority == '1') {
                $priority = 'Low';
            }else if ($row->priority == '2') {
                $priority = 'Medium';
            }else{
                $priority = 'High';
            }

            if ( getUserInfos()->role == "0")
            {

                if(!empty($row->manager_name)){
                    $manager_name=$row->manager_name;
                }else{
                    $manager_name="-";
                }
            }
            if(!empty($row->coordinator_name)){
                $coordinator_name=$row->coordinator_name;
            }else{
                $coordinator_name="-";
            }
            if(!empty($row->serviceperson_name)){
                $serviceperson_name=$row->serviceperson_name;
            }else{
                $serviceperson_name="-";
            }
            
            if ($row->outcome_status == '0') {
                $outcome_status = '<label style="color:green;"> In<br>Process</label>';
            }
             elseif ($row->outcome_status == '1') {
                $outcome_status = '<label style="color:blue;"">Won</label>';
            }
            elseif ($row->outcome_status == '2') {
                $outcome_status = '<labelstyle="color:red;""> Lost</label>';
            }
            elseif ($row->outcome_status == '3') {
                $outcome_status = '<label style="color:orange;"">Continue</label>Continue';
            }
            elseif ($row->outcome_status == '4') {
                $outcome_status = '<label style="color:yellow;"">Reshedule</label>';
            }else{
                $outcome_status='<label style="color:red;"">Complaint<br>Not<br>Assign</label>';
            }
            
            


           
            /*  $nestedData[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="group-checkable checks_all" name="check_all[]" value="' . $row->id . '" />
                                                            <span></span>
                                                        </label>';   */
           
            // $full_name = ucwords($row->fname . ' ' . $row->lname);
            $nestedData[] = $row->dynamic_complaint_id;
            $nestedData[] = ucwords($row->complaint_types);
            $nestedData[] = ucwords($row->client_name);
            $nestedData[] = ucwords($row->contact_person);
            $nestedData[] = ucwords($row->contact_number);
            $nestedData[] = $priority;
            if ( getUserInfos()->role == "0")
            {

                $nestedData[] = $manager_name;
            }
           
            $nestedData[] =$coordinator_name;
            $nestedData[] =  $serviceperson_name;
            $nestedData[] =$outcome_status ;
            //$nestedData[] = ($row->status == '1') ? 'Completed' : 'In-Process';
            $nestedData[] = $this->load->view("_action", array("data" => $row), true);
            $data[] = $nestedData;
          //  pr($row);
        }
       // pr($row);
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
        //pr($_POST);die;

        //$ins['type_of_lead'] = $type_of_lead;

        $ins['dynamic_complaint_id'] = $dymic_complaint_id;
        $ins['client_name'] = $client_name;
        $ins['website'] = $website;
        $ins['location'] = $location;
        $ins['address'] = $address;
        $ins['contact_person'] = $contact_person;
        $ins['contact_number'] = $contact_number;
        $ins['email_id'] = $email_id;
        $ins['priority'] = $priority;
        $ins['complaint_type'] = $complaint_type;
        $ins['complaint'] = $nature_work;
        $ins['dg_set_number'] = $dg_set_no;
        $ins['kva'] = $kva;
        $ins['engine_alternator'] = $eng_alt;
        $ins['performance'] = $performance;
        $ins['efforts'] = $efforts;
        $ins['status'] = $status;
        $ins['is_deleted'] = "0";
        $ins['created_date'] = current_datetime();
        $ins['added_by'] = currUserId();

        $this->db->insert("pr_complaint", $ins);
    }

     function edit($id) {
        extract($_POST);
        
        //pr($_POST);die;
        $upd['dynamic_complaint_id'] = $dymic_complaint_id;
        $upd['client_name'] = $client_name;
        $upd['website'] = $website;
        $upd['location'] = $location;
        $upd['address'] = $address;
        $upd['contact_person'] = $contact_person;
        $upd['contact_number'] = $contact_number;
        $upd['email_id'] = $email_id;
        $upd['priority'] = $priority;
        $upd['complaint_type'] = $complaint_type;
        $upd['complaint'] = $nature_work;
        $upd['dg_set_number'] = $dg_set_no;
        $upd['kva'] = $kva;
        $upd['engine_alternator'] = $eng_alt;
        $upd['performance'] = $performance;
        $upd['efforts'] = $efforts;
        $upd['status'] = $status;
        $upd['updated_date'] = current_datetime();
        $upd['updated_by'] = currUserId();
        
        $whr['id'] = $id;
        $this->db->update("pr_complaint", $upd, $whr);
    } 

    function viewData($id) {

        $res = $this->db->select("pr.*")
                ->from("pr_complaint pr")
                ->where(array("pr.id" => $id))
                ->get()
                ->row();
        return $res;
    } 
    function viewData_2($id) {
        $res = $this->db->select("cu.*")
                ->from("cz_users cu")
                ->where(array("cu.id" => $id))
                ->get()
                ->row();
        return $res;
    }

    function view($id) {

        $res = $this->db->select("pr.*,ptc.name as complaint_types,pra.manager_id,pra.coordinator_id,pra.serviceperson_id,pra.outcome_status,pra.created_date as assigned_activity_date,,concat( cus.fname ,' ', cus.lname ) as service_name,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as cordinator_name")
                ->from("pr_complaint pr")
                ->join("pr_type_complaint ptc", "ptc.id = pr.complaint_type", "left")
                
                 ->join("pr_complaint_assign pra", "pra.complaint_id = pr.id", "left")
                 ->join("cz_users cum", "cum.id = pra.manager_id", "left")
                 ->join("cz_users cuc", "cuc.id = pra.coordinator_id", "left")
                
                 ->join("cz_users cus", "cus.id = pra.serviceperson_id", "left")
   
                ->where(array("pr.id" => $id,"pr.is_deleted"=>"0"))
                ->order_by("pr.id","desc")
                ->get()
                ->row();

            //pr($res);die;    
        return $res;
    }
    
    
    function view_meeting($id) {

        $res = $this->db->select("prl.*,concat( cus.fname ,' ', cus.lname ) as service_name,cus.profile_image as service_image")
                ->from("pr_complaint_meeting prl")
                
                ->join("cz_users cus", "cus.id = prl.service_person_id", "left")                
                ->where(array("prl.complaint_id" => $id))
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
        //pr($_POST);die;
        //here complaint id($id) is main id of pr_complaint table
        $ins['complaint_id'] = $id;
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
                ->from("cz_users cu")
                ->where(array("cu.id" => $logged_in_coor_id))
                ->get()
                ->row();
               
        $ins['manager_id'] = $res->manager_id;
        }
        $ins['meeting_id'] = $meeting_id;
        // $ins['manager_id'] = $manager_id;
        // $ins['coordinator_id'] = $cordinator_id;
        $ins['serviceperson_id'] = $serviceperson_id;
        $ins['activity'] = $activity;
        $ins['location'] = $location;
        $ins['description'] = $description;
        $ins['meeting_date'] = date('Y-m-d', strtotime($meeting_date));
        $ins['start_time'] = date('H:i:s', strtotime($start_time));
        $ins['end_time'] = date('H:i:s', strtotime($end_time));
        $ins['status'] = $status;
        $ins['created_date'] = current_datetime();
        $ins['added_by'] = currUserId();
        //pr($ins);die;
        $this->db->insert("pr_complaint_assign", $ins);
        
        
        
        //Insert Data in meeting table 
        $metting_ins['complaint_id'] = $id;
        $metting_ins['service_person_id'] = $serviceperson_id;
        $metting_ins['meeting_date'] = date('Y-m-d', strtotime($meeting_date));
        $metting_ins['start_time'] = date('H:i:s', strtotime($start_time));
        $metting_ins['status'] = $status;
        $metting_ins['created_date'] = current_datetime();
        $metting_ins['added_by'] = currUserId();
        $metting_ins['is_approved']='1';
        
       // pr($metting_ins);die;
        $this->db->insert("pr_complaint_meeting", $metting_ins);
        
        
        
        
        
    }

     function assign_activity_edit($id) {
        extract($_POST);
    //  echo "shubham edit";
    //  pr($_POST);die;
        $upd['complaint_id'] = $id;
       // $upd['meeting_id'] = $meeting_id;
       if(getUserInfos()->role == "0"){
        $upd['manager_id'] = $manager_id;
       
        }
        if(getUserInfos()->role == "1"){
            $logged_in_manager_id=$_SESSION['userinfo']['id'];
            $upd['manager_id'] = $logged_in_manager_id;
        
        }
        //$upd['manager_id'] = $manager_id;
        $upd['coordinator_id'] = $cordinator_id;
        $upd['serviceperson_id'] = $serviceperson_id;
        $upd['activity'] = $activity;
        $upd['location'] = $location;
        $upd['description'] = $description;
        $upd['meeting_date'] = date('Y-m-d', strtotime($meeting_date));
        $upd['start_time'] = date('H:i:s', strtotime($start_time));
        $upd['end_time'] = date('H:i:s', strtotime($end_time));
        $upd['status'] = $status;
        $upd['updated_by'] = currUserId();
        $upd['updated_date'] = current_datetime();
        $whr['complaint_id'] = $id;
        $this->db->update("pr_complaint_assign", $upd, $whr);

        //pr($ins);die;
    } 

    function viewActivity($id) {

        $res = $this->db->select("pr.*")
                ->from("pr_complaint_assign pr")
                ->where(array("pr.complaint_id" => $id))
                ->get()
                ->row();
        return $res;
    }

    public function getallserviceperson()
    {
      
        if ( getUserInfos()->role == "0") {


            $res = $this->db->select("cu.*")
                    ->from("cz_users cu")
                    ->where(array("cu.role"=>"6","cu.status"=>"1","cu.is_deleted"=>"0"))
                  
                     ->order_by("cu.id","DESC")
                    ->get()
                    ->result();
            }
        
            if ( getUserInfos()->role == "1") {
                $logged_in_manager_id=$_SESSION['userinfo']['id'];
                $res = $this->db->select("cu.*")
                ->from("cz_users cu")
                ->where(array("cu.role"=>"6","cu.status"=>"1","cu.is_deleted"=>"0","cu.manager_id=" => $logged_in_manager_id))
                
                 ->order_by("cu.id","DESC")
                ->get()
                ->result();
                    }
                    return $res;
    }

    function getserviceperson($manager_id,$coordinator_id) {
         
      
       $res = $this->db->select("cu.*")
               ->from("cz_users cu")
               ->where(array("cu.manager_id" => $manager_id,"cu.cordinator_id" => $coordinator_id,"cu.role"=>"6","cu.status"=>"1","cu.is_deleted"=>"0"))
                ->order_by("cu.id","DESC")
               ->get()
               ->result();
       //echo $this->db->last_query();
       return $res;
   }


   function getservicecordinator($id) {
    $res = $this->db->select("cu.*")
            ->from("cz_users cu")
            ->where(array("cu.manager_id" => $id,"cu.role"=>"4","cu.status"=>"1","cu.is_deleted"=>"0"))
             ->order_by("cu.id","DESC")
            ->get()
            ->result();
    return $res;
}


   function getallservicecordinator() {
    if ( getUserInfos()->role == "0") {


    $res = $this->db->select("cu.*")
            ->from("cz_users cu")
            ->where(array("cu.role"=>"4","cu.status"=>"1","cu.is_deleted"=>"0"))
          
             ->order_by("cu.id","DESC")
            ->get()
            ->result();
    }

    if ( getUserInfos()->role == "1") {
        $logged_in_manager_id=$_SESSION['userinfo']['id'];
        $res = $this->db->select("cu.*")
        ->from("cz_users cu")
        ->where(array("cu.role"=>"4","cu.status"=>"1","cu.is_deleted"=>"0","cu.manager_id=" => $logged_in_manager_id))
        
         ->order_by("cu.id","DESC")
        ->get()
        ->result();
            }

            
    return $res;
}

   /*************************list items assign activity 27-12-2018 starts*/

   function list_items_activity_ajax() {
    $requestData = $_REQUEST;
    $columns = array(
        " ",
        "pr.manager_id",
        "pr.coordinator_id",
        "pr.serviceperson_id",
        "pr.activity",
        "cr.client_name",
        "cr.contact_person",
        "pr.location",   
        "pr.id"
        
        
    );
    $id = ID_decode($this->uri->segment('3'));

    $sql = $this->db->select("pr.*,cr.client_name,cr.contact_person,cr.contact_number,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as coordinator_name,concat( cus.fname ,' ', cus.lname ) as serviceperson_name", FALSE)
            ->from("pr_complaint_assign pr")
            ->join("pr_complaint cr", "cr.id = pr.complaint_id", "left")
            ->join("cz_users cum", "cum.id = pr.manager_id", "left")
            ->join("cz_users cuc", "cuc.id = pr.coordinator_id", "left")
            ->join("cz_users cus", "cus.id = pr.serviceperson_id", "left")
            ->where(array("pr.is_deleted =" => "0"/* ,"pr.status="=>"1" */,"pr.serviceperson_id"=>$id));



     if (!empty($requestData['search']['value'])) {
        $ser = $requestData['search']['value'];

        $ser=str_replace("'",",","$ser");

        $sql->where("(cr.client_name like '%$ser%'");
        $sql->or_where("cr.contact_person like '%$ser%'");
        $sql->or_where("concat(cum.fname,' ',cum.lname)  like '%$ser%'");
        $sql->or_where("concat(cuc.fname,' ',cuc.lname)  like '%$ser%'");
        $sql->or_where("concat(cus.fname,' ',cus.lname)  like '%$ser%'");
        $sql->or_where("pr.location  like '%$ser%'");
        $sql->or_where("DATE_FORMAT(concat(pr.meeting_date,' ',pr.start_time), '%d-%m-%Y %H:%i:%s')  like '%$ser%'");
    
        $sql->or_where("pr.activity like '%$ser%' )");
    } 

    $sql->order_by($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

    $sql1 = clone $sql;
    if ($requestData['length'] != '-1') {  // for showing all records
        $query = $sql->limit($requestData['length'], $requestData['start']);
    }
    $query = $sql->get()->result();
    $totalData = $totalFiltered = $sql1->get()->num_rows();
    $data = array();
    $starts= $requestData['start'];
    foreach ($query as $i => $row) {
    
        $nestedData = array();

        //$nestedData[] = ++$i;
        $nestedData[] = ++$starts;
        
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
                $outcome_status='';
            }

        
        
        
        
        
        /*  $nestedData[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="group-checkable checks_all" name="check_all[]" value="' . $row->id . '" />
                                                        <span></span>
                                                    </label>';   */
        
        // $nestedData[] =  ucwords($row->manager_name);
        // $nestedData[] =  ucwords($row->coordinator_name);
        // $nestedData[] =  ucwords($row->serviceperson_name);
        $nestedData[] = ucwords($row->activity);
        $nestedData[] = ucwords($row->client_name);
        $nestedData[] = ucwords($row->contact_person);
        $nestedData[] = ucwords($row->location);
        $nestedData[] =date("d-m-Y H:i:s",strtotime($row->meeting_date." ".$row->start_time));
        $nestedData[] =$outcome_status;

       // $nestedData[] = ($row->status == '1') ? '<label class="label-success label"> Completed</label>' : '<label class="label-danger label"> In Process</label>';
        $nestedData[] = $this->load->view("_action1", array("data" => $row), true);
        $data[] = $nestedData;
      //  pr($row);
    }
   // pr($row);
    $json_data = array(
        "draw" => intval($requestData['draw']),
        "recordsTotal" => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data" => $data
    );
    return $json_data;
}
/*************************list items assign activity 27-12-2018 ends*/

public function getall_activity()
{
    $sql = $this->db->select("pr.*,cr.client_name,cr.contact_person,cr.contact_number,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as coordinator_name,concat( cus.fname ,' ', cus.lname ) as serviceperson_name", FALSE)
            ->from("pr_complaint_assign pr")
            ->join("pr_complaint cr", "cr.id = pr.complaint_id", "left")
            ->join("cz_users cum", "cum.id = pr.manager_id", "left")
            ->join("cz_users cuc", "cuc.id = pr.coordinator_id", "left")
            ->join("cz_users cus", "cus.id = pr.serviceperson_id", "left")
            ->where(array("pr.is_deleted =" => "0","pr.status="=>"1"));
            $query = $sql->get()->result();
            return $query;
}
function list_items_activity_history_ajax() {
    $requestData = $_REQUEST;
    $columns = array(
        '',
        "pra.id",
        "pra.id",
        "pra.id",
        "pra.id",
        "pra.meeting_date",
        "pra.id"
     
    );
    if ( getUserInfos()->role == "0") {
    $sql = $this->db->select("pra.*,concat( cus.fname ,' ', cus.lname ) as serviceperson_name,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as cordinator_name,"
                    , FALSE)
            ->from("pr_complaint_assign pra")
            
             ->join("cz_users cum", "cum.id = pra.manager_id", "left")
            ->join("cz_users cuc", "cuc.id = pra.coordinator_id", "left")
            ->join("cz_users cus", "cus.id = pra.serviceperson_id", "left")
            ->where(array("pra.is_deleted =" => "0"))
            ->group_by("pra.serviceperson_id");
    }  else if( getUserInfos()->role == "1") {
        $logged_in_manager_id=$_SESSION['userinfo']['id'];
         $sql = $this->db->select("pra.*,concat( cus.fname ,' ', cus.lname ) as serviceperson_name,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as cordinator_name,"
                    , FALSE)
            ->from("pr_complaint_assign pra")
            
             ->join("cz_users cum", "cum.id = pra.manager_id", "left")
            ->join("cz_users cuc", "cuc.id = pra.coordinator_id", "left")
            ->join("cz_users cus", "cus.id = pra.serviceperson_id", "left")
            ->where(array("pra.is_deleted =" => "0","pra.manager_id=" => $logged_in_manager_id))
            ->group_by("pra.serviceperson_id");
    } else if( getUserInfos()->role == "4") {
        $logged_in_coor_id=$_SESSION['userinfo']['id'];
         $sql = $this->db->select("pra.*,concat( cus.fname ,' ', cus.lname ) as serviceperson_name,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as cordinator_name,"
                    , FALSE)
            ->from("pr_complaint_assign pra")
            
             ->join("cz_users cum", "cum.id = pra.manager_id", "left")
            ->join("cz_users cuc", "cuc.id = pra.coordinator_id", "left")
            ->join("cz_users cus", "cus.id = pra.serviceperson_id", "left")
            ->where(array("pra.is_deleted =" => "0","pra.coordinator_id=" => $logged_in_coor_id))
            ->group_by("pra.serviceperson_id");

    }else{

    }

     if (isset($_GET['meeting_date']) && $_GET['meeting_date'] != "" && $_GET['meeting_date'] != "Select Year"){
    
        @$formatedDate = date("Y-m-d", strtotime(@$_GET['meeting_date']));
        $sql->where(array("pra.meeting_date" => $formatedDate));
    } 

    if (!empty($requestData['search']['value'])) {
        $ser = $requestData['search']['value'];

        $ser=str_replace("'",",","$ser");

        $sql->where("(concat(cus.fname,' ',cus.lname) like '%$ser%'");
        $sql->or_where("concat(cum.fname,' ',cum.lname)  like '%$ser%'");
        $sql->or_where("DATE_FORMAT(concat(pra.meeting_date), '%d-%m-%Y')  like '%$ser%' ");
       
        $sql->or_where("concat(cuc.fname,' ',cuc.lname)  like '%$ser%' )");
      
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
                $outcome_status='';
            }

        
       
        $newDate = date("d-m-Y", strtotime($row->meeting_date));
       
        $nestedData[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="group-checkable checks_all" name="check_all[]" value="' . $row->id . '" />
                                                        <span></span>
                                                    </label>';
        $nestedData[] = ++$starts;
        $nestedData[] = $row->serviceperson_name;
        // $nestedData[] = $row->manager_name;
        // $nestedData[] = $row->cordinator_name;
        if ( getUserInfos()->role == "0") {
            $nestedData[] = $row->manager_name;
            $nestedData[] = $row->cordinator_name;
            }
            if ( getUserInfos()->role == "1") {
            $nestedData[] = $row->cordinator_name;
            }
        $nestedData[] = '<a href="' . base_url() . 'complaint/list_items_activity/' . ID_encode($row->serviceperson_id) . '" class="label-success label">' . get_where_count('pr_complaint_assign',$row->serviceperson_id,'serviceperson_id') . '</a>';
        $nestedData[] = $newDate;
        
        
        $nestedData[] = $outcome_status;
        
        //$nestedData[] = ($row->status == '1') ? '<label class="label-success label"> Completed</label>' : '<label class="label-danger label">Running</label>';
        $nestedData[] = $this->load->view("_action2", array("data" => $row), true);
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


function list_items_ajax_app_disapp() {
    $requestData = $_REQUEST;

  
     $columns = array(
        '',
        "cu.fname",
        "cu2.fname",
        "cu3.fname",
         "ptl.name",
        "pals.activity",
        "pals.meeting_date",
        "pals.id",
        "pals.id",
        "pals.id"
    ); 

    $id = ID_decode($this->uri->segment('3'));
    if(getUserInfos()->role == "0"){ 
        $sql = $this->db->select("plm.*,pals.activity,pals.meeting_date as date_activity,ptl.name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
        ->from("pr_complaint_meeting plm")
        ->join("pr_complaint_assign pals","plm.complaint_id=pals.complaint_id","left")
        ->join("pr_complaint pl","pl.id=pals.complaint_id","left")
        ->join("pr_type_complaint ptl","ptl.id = pl.complaint_type","left")
        ->join("cz_users cu", "cu.id = pals.serviceperson_id", "left")
        ->join("cz_users cu2", "cu2.id = pals.manager_id", "left")
        ->join("cz_users cu3", "cu3.id= pals.coordinator_id", "left")
        ->where(array("pals.is_deleted =" => "0"));
    }

    else if ( getUserInfos()->role == "1") {
        $logged_in_manager_id=$_SESSION['userinfo']['id'];
        $sql = $this->db->select("pals.*,ptl.name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
        ->from("pr_complaint_meeting plm")
        ->join("pr_complaint_assign pals","plm.complaint_id=pals.complaint_id","left")
        ->join("pr_complaint pl","pl.id=pals.complaint_id","left")
        ->join("pr_type_complaint ptl","ptl.id = pl.complaint_type","left")
        ->join("cz_users cu", "cu.id = pals.serviceperson_id", "left")
        ->join("cz_users cu2", "cu2.id = pals.manager_id", "left")
        ->join("cz_users cu3", "cu3.id= pals.coordinator_id", "left")
        ->where(array("pals.is_deleted =" => "0","pals.manager_id=" => $logged_in_manager_id));

    }
    
    
        else if ( getUserInfos()->role == "4") {
            $logged_in_coor_id=$_SESSION['userinfo']['id'];
            $sql = $this->db->select("pals.*,ptl.name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
            ->from("pr_complaint_meeting plm")
            ->join("pr_complaint_assign pals","plm.complaint_id=pals.complaint_id","left")
            ->join("pr_complaint pl","pl.id=pals.complaint_id","left")
            ->join("pr_type_complaint ptl","ptl.id = pl.complaint_type","left")
            ->join("cz_users cu", "cu.id = pals.serviceperson_id", "left")
            ->join("cz_users cu2", "cu2.id = pals.manager_id", "left")
            ->join("cz_users cu3", "cu3.id= pals.coordinator_id", "left")
            ->where(array("pals.is_deleted =" => "0","pals.manager_id=" => $logged_in_coor_id));

        }
        else{
        
    }


            if (isset($_GET['manager_id']) && $_GET['manager_id'] != "") {
                $manager_id = $_GET['manager_id'];
                $sql->where(array("pals.manager_id" => $manager_id));
            }
    
            if (isset($_GET['coordinator_id']) && $_GET['coordinator_id'] != "") {
                $coordinator_id = $_GET['coordinator_id'];
                $sql->where(array("pals.coordinator_id" => $coordinator_id));
            }
            
            if (isset($_GET['serviceperson_id']) && $_GET['serviceperson_id'] != "") {
                $serviceperson_id = $_GET['serviceperson_id'];
                $sql->where(array("pals.serviceperson_id" => $serviceperson_id));
            }
           
           

     if (!empty($requestData['search']['value'])) {
        $ser = $requestData['search']['value'];

        $ser=str_replace("'",",","$ser");

        $sql->where("(pals.activity like '%$ser%'");
        $sql->or_where("ptl.name like '%$ser%'");
        $sql->or_where("concat(cu2.fname,' ',cu2.lname)  like '%$ser%'");
        $sql->or_where("concat(cu3.fname,' ',cu3.lname)  like '%$ser%'");
        $sql->or_where("concat(cu.fname,' ',cu.lname) like '%$ser%'");
        $sql->or_where("DATE_FORMAT(pals.meeting_date, '%d-%m-%Y')  like '%$ser%' ");
        $sql->or_where("DATE_FORMAT(pals.created_date, '%d-%m-%Y')  like '%$ser%' )");    
    } 
     
     
    
    
    $sql->order_by($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);
    $sql1 = clone $sql;
    if ($requestData['length'] != '-1') {  // for showing all records
        $query = $sql->limit($requestData['length'], $requestData['start']);
    }

    $query = $sql->get()->result();
//  pr($query);die;
    $totalData = $totalFiltered = $sql1->get()->num_rows();
    //echo $this->db->last_query();die;
    $data = array();
    $starts= $requestData['start'];
        foreach ($query as $i => $row) {
        
            $nestedData = array();

            //$nestedData[] = ++$i;
            $nestedData[] = ++$starts;
        $date_continue = date("d-m-Y", strtotime($row->meeting_date));
        $date_marked = date("d-m-Y", strtotime($row->created_date));
        $date_activity = date("d-m-Y", strtotime($row->date_activity));

        if($row->outcome_status=="0"){
            $continue_reschedule_date="-";
            $outcome_status="In Process";
        }else if($row->outcome_status=="1"){
            $continue_reschedule_date="-";
            $outcome_status="Won";

        }else if($row->outcome_status=="2"){
            $continue_reschedule_date="-";
            $outcome_status="Lost";
        }else if($row->outcome_status=="3"){
            $continue_reschedule_date=$date_continue;
            $outcome_status="Continue";
        }else if($row->outcome_status=="4"){
            $continue_reschedule_date=$date_continue;
            $outcome_status="Reschedule";
        }else{
            $continue_reschedule_date="-";
            $outcome_status="-";
        }
    
       
        $nestedData[] = $row->fname." ".$row->lname;
        if ( getUserInfos()->role == "0") {
        $nestedData[] = $row->m_fname." ".$row->m_lname;
        $nestedData[] = $row->c_fname." ".$row->c_lname;
        }
        if ( getUserInfos()->role == "1") {
        $nestedData[] = $row->c_fname." ".$row->c_lname;
        }
        $nestedData[] = $row->name;
        $nestedData[] = $row->activity;
        $nestedData[] =$date_activity;
        $nestedData[] = $date_marked;
        $nestedData[] =  $outcome_status;
        $nestedData[] =$continue_reschedule_date;
        
        //$nestedData[] = ($row->status == '1') ? '<label class="label-success label"> Active</label>' : '<label class="label-danger label"> In Active</label>';
        $nestedData[] = $this->load->view("_action3", array("data" => $row), true);
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
function getsalesperson() {
    if ( getUserInfos()->role == "0") {

        $res = $this->db->select("cu.*")
        ->from("cz_users cu")
        ->where(array("cu.status"=>"1","cu.is_deleted"=>"0","cu.role=" => "5"))
         ->order_by("cu.id","DESC")
        ->get()
        ->result();

    }
    if ( getUserInfos()->role == "1") {
        $logged_in_manager_id=$_SESSION['userinfo']['id'];
        
    $res = $this->db->select("cu.*")
    ->from("cz_users cu")
    ->where(array("cu.status"=>"1","cu.is_deleted"=>"0","cu.role=" => "5","cu.manager_id=" => $logged_in_manager_id))
    ->order_by("cu.id","DESC")
    ->get()
    ->result();
         
         
     }
    if ( getUserInfos()->role == "3") {
        $logged_in_coor_id=$_SESSION['userinfo']['id'];
        
    $res = $this->db->select("cu.*")
    ->from("cz_users cu")
    ->where(array("cu.status"=>"1","cu.is_deleted"=>"0","cu.role=" => "5","cu.cordinator_id=" => $logged_in_coor_id))
    ->order_by("cu.id","DESC")
    ->get()
    ->result();
         
         
     }
        
            
    return $res;
}
 

 function view_app_disapp($id) {
    $logged_in_manager_id=$_SESSION['userinfo']['id'];
    $res = $this->db->select("plm.*,pals.activity,pals.meeting_date as date_activity,ptl.name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
        ->from("pr_complaint_meeting plm")
        ->join("pr_complaint_assign pals","plm.complaint_id=pals.complaint_id","left")
        ->join("pr_complaint pl","pl.id=pals.complaint_id","left")
        ->join("pr_type_complaint ptl","ptl.id = pl.complaint_type","left")
        ->join("cz_users cu", "cu.id = pals.serviceperson_id", "left")
        ->join("cz_users cu2", "cu2.id = pals.manager_id", "left")
        ->join("cz_users cu3", "cu3.id= pals.coordinator_id", "left")
        ->where(array("pals.is_deleted =" => "0","pals.id" =>$id ))
        ->get()
        ->row();
       
    return $res;
}
function view_activity($id) {
    $logged_in_manager_id=$_SESSION['userinfo']['id'];
    $res = $this->db->select("pals.*,pl.dynamic_complaint_id,pl.complaint_type,pl.kva,pl.dg_set_number,pl.engine_alternator,pl.contact_person,pl.contact_number,pl.client_name,ptl.name,cu.fname, cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
    ->from("pr_complaint_assign pals")
    ->join("pr_complaint pl","pl.id=pals.complaint_id","left")
    ->join("pr_type_complaint ptl","ptl.id = pl.complaint_type","left")
    ->join("cz_users cu", "cu.id = pals.serviceperson_id", "left")
    ->join("cz_users cu2", "cu2.id = pals.manager_id", "left")
    ->join("cz_users cu3", "cu3.id= pals.coordinator_id", "left")
   
    ->where(array("pals.is_deleted =" => "0","pals.complaint_id" =>$id ))
    ->get()
    ->row();
   //  pr($res);die;  
    return $res;
}

/************************************list of reschedule activity 26-12-2018 starts */

function list_items_ajax_reschedule_activity() {
    $requestData = $_REQUEST;

  
     $columns = array(
        '',
       
        "cu.fname",
        "cu2.fname",
        "cu3.fname",
        "pl.client_name",
        "pals.activity",
        "pals.meeting_date",
        "pals.id"
    ); 

    $id = ID_decode($this->uri->segment('3'));
    
    $id = ID_decode($this->uri->segment('3'));
    if(getUserInfos()->role == "0"){ 
   $sql = $this->db->select("pals.*,pl.client_name,ptl.name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
            ->from("pr_complaint_assign pals")
            ->join("pr_complaint pl","pl.id=pals.complaint_id","left")
            ->join("pr_type_complaint ptl","ptl.id = pl.complaint_type","left")
            ->join("cz_users cu", "cu.id = pals.serviceperson_id", "left")
            ->join("cz_users cu2", "cu2.id = pals.manager_id", "left")
            ->join("cz_users cu3", "cu3.id= pals.coordinator_id", "left")
            ->where(array("pals.is_deleted =" => "0" ,"pals.outcome_status" => "4"));
    }

    else if ( getUserInfos()->role == "1") {
        $logged_in_manager_id=$_SESSION['userinfo']['id'];
        $sql = $this->db->select("pals.*,pl.client_name,ptl.name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
        ->from("pr_complaint_assign pals")
        ->join("pr_complaint pl","pl.id=pals.complaint_id","left")
        ->join("pr_type_complaint ptl","ptl.id = pl.complaint_type","left")
        ->join("cz_users cu", "cu.id = pals.serviceperson_id", "left")
        ->join("cz_users cu2", "cu2.id = pals.manager_id", "left")
        ->join("cz_users cu3", "cu3.id= pals.coordinator_id", "left")
        ->where(array("pals.is_deleted =" => "0" ,"pals.outcome_status" => "4","pals.manager_id=" => $logged_in_manager_id));

    }
    
    
        else if ( getUserInfos()->role == "4") {
            $logged_in_coor_id=$_SESSION['userinfo']['id'];
            $sql = $this->db->select("pals.*,pl.client_name,ptl.name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
            ->from("pr_complaint_assign pals")
            ->join("pr_complaint pl","pl.id=pals.complaint_id","left")
            ->join("pr_type_complaint ptl","ptl.id = pl.complaint_type","left")
            ->join("cz_users cu", "cu.id = pals.serviceperson_id", "left")
            ->join("cz_users cu2", "cu2.id = pals.manager_id", "left")
            ->join("cz_users cu3", "cu3.id= pals.coordinator_id", "left")
            ->where(array("pals.is_deleted =" => "0" ,"pals.outcome_status" => "4","pals.manager_id=" => $logged_in_coor_id));

        }
        else{
        
    }

            if (isset($_GET['manager_id']) && $_GET['manager_id'] != "") {
                $manager_id = $_GET['manager_id'];
                $sql->where(array("pals.manager_id" => $manager_id));
            }
    
            if (isset($_GET['coordinator_id']) && $_GET['coordinator_id'] != "") {
                $coordinator_id = $_GET['coordinator_id'];
                $sql->where(array("pals.coordinator_id" => $coordinator_id));
            }
            
            if (isset($_GET['serviceperson_id']) && $_GET['serviceperson_id'] != "") {
                $serviceperson_id = $_GET['serviceperson_id'];
                $sql->where(array("pals.serviceperson_id" => $serviceperson_id));
            }
           
           

     if (!empty($requestData['search']['value'])) {
        $ser = $requestData['search']['value'];

        $ser=str_replace("'",",","$ser");

        $sql->where("(pals.activity like '%$ser%'");
       /*  $sql->or_where("ptl.name like '%$ser%'"); */
        $sql->or_where("concat(cu2.fname,' ',cu2.lname)  like '%$ser%'");
        $sql->or_where("concat(cu3.fname,' ',cu3.lname)  like '%$ser%'");
        $sql->or_where("concat(cu.fname,' ',cu.lname) like '%$ser%'");
        $sql->or_where("pl.client_name like '%$ser%'");
        $sql->or_where("DATE_FORMAT(pals.meeting_date, '%d-%m-%Y')  like '%$ser%') ");
       
    } 
     
     
    
    
    $sql->order_by($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);
    $sql1 = clone $sql;
    if ($requestData['length'] != '-1') {  // for showing all records
        $query = $sql->limit($requestData['length'], $requestData['start']);
    }

    $query = $sql->get()->result();
//  pr($query);die;
    $totalData = $totalFiltered = $sql1->get()->num_rows();
    //echo $this->db->last_query();die;
    $data = array();
    $starts= $requestData['start'];
    foreach ($query as $i => $row) {
    
        $nestedData = array();

        //$nestedData[] = ++$i;
        $nestedData[] = ++$starts;
        $newDate = date("d-m-Y", strtotime($row->meeting_date));
    
        
        $nestedData[] = $row->fname." ".$row->lname;
        if ( getUserInfos()->role == "0") {
            $nestedData[] = $row->m_fname." ".$row->m_lname;
            $nestedData[] = $row->c_fname." ".$row->c_lname;
        }else if ( getUserInfos()->role == "1") {
            $nestedData[] = $row->c_fname." ".$row->c_lname;
        }else if ( getUserInfos()->role == "4") {
            $nestedData[] = $row->m_fname." ".$row->m_lname;
        }else{

        }
       
        
        $nestedData[] = $row->client_name; 
        $nestedData[] = $row->activity;
        $nestedData[] = $newDate;   
        $nestedData[] =date("d-m-Y g:i a");
        
        //$nestedData[] = ($row->status == '1') ? '<label class="label-success label"> Active</label>' : '<label class="label-danger label"> In Active</label>';
        $nestedData[] = $this->load->view("_action4", array("data" => $row), true);
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
    
    
/************************************list of reschedule activity 26-12-2018 ends  */

/*************************************view of reschedule activity 26-12-2018 starts */

function view_reschedule_activity($id) {
    $res = $this->db->select("pals.*,pl.client_name,ptl.name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
            ->from("pr_complaint_assign pals")
            ->join("pr_complaint pl","pl.id=pals.complaint_id","left")
            ->join("pr_type_complaint ptl","ptl.id = pl.complaint_type","left")
            ->join("cz_users cu", "cu.id = pals.serviceperson_id", "left")
            ->join("cz_users cu2", "cu2.id = pals.manager_id", "left")
            ->join("cz_users cu3", "cu3.id= pals.coordinator_id", "left")
            
            ->where(array("pals.is_deleted =" => "0","pals.id" =>$id/* ,"pals.outcome_status" => "4" */))
            ->get()
            ->row();
            
    return $res;
}


/*************************************view of reschedule activity 26-12-2018 ends */
public function last_id_get() {
    $res = $this->db->select("pr.id")
            ->from("pr_complaint pr")
            ->order_by("pr.id", "Desc")
            ->limit(1)
            ->get()
            ->row();
    return $res;
}
public function last_id_assign_activity() {
    $res = $this->db->select("pr.id")
            ->from("pr_complaint_assign pr")
            ->order_by("pr.id", "Desc")
            ->limit(1)
            ->get()
            ->row();
    return $res;
}

 function change_employee() {
     
     //pr($_POST);
         //Insert record in meeting table for lead
        $metting_ins['complaint_id'] = $_POST['complaint_id'];
        $metting_ins['service_person_id'] = $_POST['service_person_id'];
        $metting_ins['created_date'] = current_datetime();
        $metting_ins['added_by'] = currUserId();
        $metting_ins['emp_add_type']='1';
        $metting_ins['is_approved']='1';
        
       // pr($meeting_ins);die;
        
        $this->db->insert("pr_complaint_meeting", $metting_ins);
        //Chnage Employee and assigned to new employee 
        $upd['serviceperson_id'] = $_POST['service_person_id'];
        $upd['outcome_status'] = "0";
        
        
        //pr($upd);die;
        $whr['complaint_id'] = $_POST['complaint_id'];
        $this->db->update("pr_complaint_assign", $upd, $whr);
        if ($this->db->affected_rows() > 0) {
            $rt["status"] = "true";
        } else {
            $rt["status"] = "false";
        }
        return $rt;
    }




    public function update_disapp($id)
    {
        $upd['is_approved']="2";
        $whr['id']=$id;
        $this->db->update("pr_complaint_meeting",$upd,$whr);

    }
    public function update_app($id)
    {
        $upd['is_approved']="1";
        $whr['id']=$id;
        $this->db->update("pr_complaint_meeting",$upd,$whr);

    }
    function static_coordinator() {
        $logged_in_manager_id=$_SESSION['userinfo']['id'];
        $res = $this->db->select("cu.*")
                ->from("cz_users cu")
                ->where(array("cu.manager_id" => $id,"cu.role"=>"4","cu.status"=>"1","cu.is_deleted"=>"0","cu.manager_id" =>$logged_in_manager_id ))
                 ->order_by("cu.id","DESC")
                ->get()
                ->result();
        return $res;
    }

    function static_serviceperson() {
        $logged_in_coor_id=$_SESSION['userinfo']['id'];
        //echo $coordinator_id;die;
       $res = $this->db->select("cu.*")
               ->from("cz_users cu")
               ->where(array("cu.cordinator_id" => $logged_in_coor_id,"cu.role"=>"6","cu.status"=>"1","cu.is_deleted"=>"0"))
                ->order_by("cu.id","DESC")
               ->get()
               ->result();
              // pr($res);die;
       //echo $this->db->last_query();die;
       return $res;
   }



}

?>
