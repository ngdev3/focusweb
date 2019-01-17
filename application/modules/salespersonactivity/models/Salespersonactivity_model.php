<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salespersonactivity_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->helper('string');
    }

    function list_items_ajax() {
        $requestData = $_REQUEST;
        $columns = array(
            '',
            "pra.id",
            "pra.id",
            "pra.id",
            "pra.id",
            "pra.id",
            "pra.meeting_date",
            "pra.id"
         
        );
        if ( getUserInfos()->role == "0") {
        $sql = $this->db->select("pra.*,concat( cus.fname ,' ', cus.lname ) as sales_name,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as cordinator_name,"
                        , FALSE)
                ->from("pr_assign_lead_sales pra")
                
                ->join("users cum", "cum.id = pra.manager_id", "left")
                ->join("users cuc", "cuc.id = pra.coordinator_id", "left")
                ->join("users cus", "cus.id = pra.sales_person_id", "left")
                ->where(array("pra.is_deleted =" => "0"))
                ->group_by("pra.sales_person_id");
     
        }

        else if( getUserInfos()->role == "1") {
            $logged_in_manager_id=$_SESSION['userinfo']['id'];
        $sql = $this->db->select("pra.*,cum.manager_id,concat( cus.fname ,' ', cus.lname ) as sales_name,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as cordinator_name,"
            , FALSE)
                ->from("pr_assign_lead_sales pra")
                
                ->join("users cum", "cum.id = pra.manager_id", "left")
                ->join("users cuc", "cuc.id = pra.coordinator_id", "left")
                ->join("users cus", "cus.id = pra.sales_person_id", "left")
                ->where(array("pra.is_deleted =" => "0","pra.manager_id=" => $logged_in_manager_id))
                ->group_by("pra.sales_person_id");

            

        }
        else if( getUserInfos()->role == "3") {
            $logged_in_coor_id=$_SESSION['userinfo']['id'];
        $sql = $this->db->select("pra.*,cum.manager_id,concat( cus.fname ,' ', cus.lname ) as sales_name,concat( cum.fname ,' ', cum.lname ) as manager_name,concat( cuc.fname ,' ', cuc.lname ) as cordinator_name,"
            , FALSE)
                ->from("pr_assign_lead_sales pra")
                
                ->join("users cum", "cum.id = pra.manager_id", "left")
                ->join("users cuc", "cuc.id = pra.coordinator_id", "left")
                ->join("users cus", "cus.id = pra.sales_person_id", "left")
                ->where(array("pra.is_deleted =" => "0","pra.coordinator_id=" => $logged_in_coor_id))
                ->group_by("pra.sales_person_id");

            

        }
        else{

        }
         if (isset($_GET['meeting_date']) && $_GET['meeting_date'] != "" && $_GET['meeting_date'] != "Select Year"){
        
            @$formatedDate = date("Y-m-d", strtotime(@$_GET['meeting_date']));
            $sql->where(array("pra.meeting_date" => $formatedDate));
        } 

        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];
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
             //$nestedData[] = ++$i;
             $nestedData[] = ++$starts;
            $nestedData[] = $row->sales_name;
            if ( getUserInfos()->role == "0") {
            $nestedData[] = $row->manager_name;
            $nestedData[] = $row->cordinator_name;
            }
            if ( getUserInfos()->role == "1") {
            $nestedData[] = $row->cordinator_name;
            }
            $nestedData[] = '<a href="' . base_url() . 'salespersonactivity/list_items_activity/' . ID_encode($row->sales_person_id) . '" class="label-success label">' . get_where_count('pr_assign_lead_sales',$row->sales_person_id,'sales_person_id') . '</a>';
            $nestedData[] = $newDate;
            $nestedData[] = $outcome_status;
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
    

    function list_items_ajax_activity() {
        $requestData = $_REQUEST;

      
         $columns = array(
            '',
            "pra.activity",
            "pl.client_name",
            "pl.contact_person",
            "pl.address",
            "pra.id",
            
        
        ); 
        $id = ID_decode($this->uri->segment('3'));
        
        $sql = $this->db->select("pra.*,pl.client_name,pl.contact_person,pl.address", FALSE)
                ->from("pr_assign_lead_sales pra")
                ->join("pr_lead pl", "pl.id = pra.lead_id", "left")
                ->where(array("pra.is_deleted =" => "0","pra.sales_person_id" =>$id ));
    
 
               
               

        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];
            $sql->where("(pra.activity like '%$ser%'");
            $sql->or_where("pl.client_name like '%$ser%'");
            $sql->or_where("pl.contact_person like '%$ser%'");
            $sql->or_where("pl.address like '%$ser%'");
            $sql->or_where("DATE_FORMAT(concat(pra.meeting_date,' ',pra.start_time), '%d-%m-%Y %h:%i %p')  like '%$ser%' )");
           
        }
        
         
        
        
        $sql->order_by($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);
        $sql1 = clone $sql;
        if ($requestData['length'] != '-1') {  // for showing all records
            $query = $sql->limit($requestData['length'], $requestData['start']);
        }

        $query = $sql->get()->result();
       // pr($query);die;
        $totalData = $totalFiltered = $sql1->get()->num_rows();
        //echo $this->db->last_query();die;
        $data = array();
        $starts= $requestData['start'];
        foreach ($query as $i => $row) {
            $newDate = date("d-m-Y h:i a", strtotime($row->meeting_date." ".$row->start_time));
            //$newtime=date("g:i a", strtotime($row->start_time));
            $nestedData = array();
           
          /*   $nestedData[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="group-checkable checks_all" name="check_all[]" value="' . $row->id . '" />
                                                            <span></span>
                                                        </label>'; */
            //$nestedData[] = ++$i;
            $nestedData[] = ++$starts;
            $nestedData[] = $row->activity;
            $nestedData[] = $row->client_name;
            $nestedData[] = $row->contact_person;
            $nestedData[] = $row->address;
            $nestedData[] = $newDate;
            
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
            
            
            
            $nestedData[] = $outcome_status;
           
            
            
            
           
            //$nestedData[] = ($row->status == '1') ? '<label class="label-success label"> Active</label>' : '<label class="label-danger label"> In Active</label>';
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

  
   
    function viewData($id) {
        $res = $this->db->select("cu.*")
                ->from("users cu")
                ->where(array("cu.id" => $id))
                ->get()
                ->row();
        return $res;
    }
   
       
    function view($id) {
     
        $res =  $this->db->select("pra.*,pl.location,pl.client_name,pl.contact_person,pl.address,pl.notes,pl.contact_number,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname", FALSE)
                ->from("pr_assign_lead_sales pra")
                ->join("pr_lead pl", "pl.id = pra.lead_id", "left")
                ->join("users cu", "cu.id = pra.sales_person_id", "left")
                ->join("users cu2", "cu.manager_id = cu2.id", "left")
                ->join("users cu3", "cu.cordinator_id = cu3.id", "left")
                ->where(array("pra.is_deleted =" => "0","pra.lead_id" =>$id ))
                ->get()
                ->row();
           
        return $res;
    }

//    function list_items_ajax_app_disapp() {
//        $requestData = $_REQUEST;
//
//      
//         $columns = array(
//            '',
//           
//            "cu.fname",
//            "cu2.fname",
//            "cu3.fname",
//        /*     "ptl.name", */
//            "pals.activity",
//            "pals.meeting_date",
//            "pals.id",
//            "pals.id",
//            "pals.id"
//        ); 
//
//        $id = ID_decode($this->uri->segment('3'));
//        if(getUserInfos()->role == "0"){ 
//       $sql = $this->db->select("pals.*,ptl.name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
//                ->from("pr_assign_lead_sales pals")
//                ->join("pr_lead pl","pl.id=pals.lead_id","left")
//                ->join("pr_type_lead ptl","ptl.id = pl.type_of_lead","left")
//                ->join("users cu", "cu.id = pals.sales_person_id", "left")
//                ->join("users cu2", "cu2.id = pals.manager_id", "left")
//                ->join("users cu3", "cu3.id= pals.coordinator_id", "left")
//                ->where(array("pals.is_deleted =" => "0"));
//        }
//
//        else if ( getUserInfos()->role == "1") {
//            $logged_in_manager_id=$_SESSION['userinfo']['id'];
//            $sql = $this->db->select("pals.*,ptl.name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
//            ->from("pr_assign_lead_sales pals")
//            ->join("pr_lead pl","pl.id=pals.lead_id","left")
//            ->join("pr_type_lead ptl","ptl.id = pl.type_of_lead","left")
//            ->join("users cu", "cu.id = pals.sales_person_id", "left")
//            ->join("users cu2", "cu2.id = pals.manager_id", "left")
//            ->join("users cu3", "cu3.id= pals.coordinator_id", "left")
//            ->where(array("pals.is_deleted =" => "0","pals.manager_id=" => $logged_in_manager_id));
//
//        }
//        
//        
//            else if ( getUserInfos()->role == "3") {
//                $logged_in_coor_id=$_SESSION['userinfo']['id'];
//                $sql = $this->db->select("pals.*,ptl.name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
//                ->from("pr_assign_lead_sales pals")
//                ->join("pr_lead pl","pl.id=pals.lead_id","left")
//                ->join("pr_type_lead ptl","ptl.id = pl.type_of_lead","left")
//                ->join("users cu", "cu.id = pals.sales_person_id", "left")
//                ->join("users cu2", "cu2.id = pals.manager_id", "left")
//                ->join("users cu3", "cu3.id= pals.coordinator_id", "left")
//                ->where(array("pals.is_deleted =" => "0","pals.coordinator_id=" => $logged_in_coor_id));
//    
//            }
//            else{
//            
//        }
//
//
//                if (isset($_GET['manager_id']) && $_GET['manager_id'] != "") {
//                    $manager_id = $_GET['manager_id'];
//                    $sql->where(array("pals.manager_id" => $manager_id));
//                }
//        
//                if (isset($_GET['coordinator_id']) && $_GET['coordinator_id'] != "") {
//                    $coordinator_id = $_GET['coordinator_id'];
//                    $sql->where(array("pals.coordinator_id" => $coordinator_id));
//                }
//                
//                if (isset($_GET['salesperson_id']) && $_GET['salesperson_id'] != "") {
//                    $salesperson_id = $_GET['salesperson_id'];
//                    $sql->where(array("pals.sales_person_id" => $salesperson_id));
//                }
//               
//               
//
//         if (!empty($requestData['search']['value'])) {
//            $ser = $requestData['search']['value'];
//            $sql->where("(pals.activity like '%$ser%'");
//           /*  $sql->or_where("ptl.name like '%$ser%'"); */
//            $sql->or_where("concat(cu2.fname,' ',cu2.lname)  like '%$ser%'");
//            $sql->or_where("concat(cu3.fname,' ',cu3.lname)  like '%$ser%'");
//            $sql->or_where("concat(cu.fname,' ',cu.lname) like '%$ser%'");
//            $sql->or_where("DATE_FORMAT(pals.meeting_date, '%d-%m-%Y')  like '%$ser%' ");
//            $sql->or_where("DATE_FORMAT(pals.created_date, '%d-%m-%Y')  like '%$ser%' )");    
//        } 
//         
//         
//        
//        
//        $sql->order_by($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);
//        $sql1 = clone $sql;
//        if ($requestData['length'] != '-1') {  // for showing all records
//            $query = $sql->limit($requestData['length'], $requestData['start']);
//        }
//
//        $query = $sql->get()->result();
//   //  pr($query);die;
//        $totalData = $totalFiltered = $sql1->get()->num_rows();
//        //echo $this->db->last_query();die;
//        $data = array();
//        foreach ($query as $i => $row) {
//            $newDate = date("d-m-Y", strtotime($row->meeting_date));
//        
//            $nestedData = array();
//        
//            $nestedData[] = ++$i; 
//            $nestedData[] = $row->fname." ".$row->lname;
//            if ( getUserInfos()->role == "0") {
//            $nestedData[] = $row->m_fname." ".$row->m_lname;
//            $nestedData[] = $row->c_fname." ".$row->c_lname;
//            }
//            if ( getUserInfos()->role == "1") {
//            $nestedData[] = $row->c_fname." ".$row->c_lname;
//            }
//         /*    $nestedData[] = $row->name; */
//            $nestedData[] = $row->activity;
//            $nestedData[] = $newDate;
//            $nestedData[] = "10-01-19";
//            $nestedData[] = "Continued";
//            $nestedData[] = "12-01-19";
//            
//            //$nestedData[] = ($row->status == '1') ? '<label class="label-success label"> Active</label>' : '<label class="label-danger label"> In Active</label>';
//            $nestedData[] = $this->load->view("_action3", array("data" => $row), true);
//            $data[] = $nestedData;
//        }
//        $json_data = array(
//            "draw" => intval($requestData['draw']),
//            "recordsTotal" => intval($totalData),
//            "recordsFiltered" => intval($totalFiltered),
//            "data" => $data
//        );
//        return $json_data;
//    }
//    
    
     function list_items_ajax_app_disapp() {
        $requestData = $_REQUEST;

      
         $columns = array(
            '',
           
            "cu.fname",
            "cu2.fname",
            "cu3.fname",
        /*     "ptl.name", */
            "pals.activity",
            "pals.meeting_date",
            "pals.id",
            "pals.id",
            "pals.id"
        ); 

        $id = ID_decode($this->uri->segment('3'));
        if(getUserInfos()->role == "0"){ 
       $sql = $this->db->select("plm.*,pals.activity,pals.meeting_date as date_activity,ptl.name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
                ->from("pr_lead_meeting plm")
                ->join("pr_assign_lead_sales pals","plm.lead_id=pals.lead_id","left")
                ->join("pr_lead pl","pl.id=pals.lead_id","left")
                ->join("pr_type_lead ptl","ptl.id = pl.type_of_lead","left")
                ->join("users cu", "cu.id = pals.sales_person_id", "left")
                ->join("users cu2", "cu2.id = pals.manager_id", "left")
                ->join("users cu3", "cu3.id= pals.coordinator_id", "left")
                ->where(array("pals.is_deleted =" => "0"));
        }

        else if ( getUserInfos()->role == "1") {
            $logged_in_manager_id=$_SESSION['userinfo']['id'];
           $sql = $this->db->select("plm.*,pals.activity,pals.meeting_date as date_activity,ptl.name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
                ->from("pr_lead_meeting plm")
                ->join("pr_assign_lead_sales pals","plm.lead_id=pals.lead_id","left")
                ->join("pr_lead pl","pl.id=pals.lead_id","left")
            ->join("pr_type_lead ptl","ptl.id = pl.type_of_lead","left")
            ->join("users cu", "cu.id = pals.sales_person_id", "left")
            ->join("users cu2", "cu2.id = pals.manager_id", "left")
            ->join("users cu3", "cu3.id= pals.coordinator_id", "left")
            ->where(array("pals.is_deleted =" => "0","pals.manager_id=" => $logged_in_manager_id));

        }
        
        
            else if ( getUserInfos()->role == "3") {
                $logged_in_coor_id=$_SESSION['userinfo']['id'];
                $sql = $this->db->select("plm.*,pals.activity,pals.meeting_date as date_activity,ptl.name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
                ->from("pr_lead_meeting plm")
                ->join("pr_assign_lead_sales pals","plm.lead_id=pals.lead_id","left")
                ->join("pr_lead pl","pl.id=pals.lead_id","left")
                ->join("pr_type_lead ptl","ptl.id = pl.type_of_lead","left")
                ->join("users cu", "cu.id = pals.sales_person_id", "left")
                ->join("users cu2", "cu2.id = pals.manager_id", "left")
                ->join("users cu3", "cu3.id= pals.coordinator_id", "left")
                ->where(array("pals.is_deleted =" => "0","pals.coordinator_id=" => $logged_in_coor_id));
    
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
                
                if (isset($_GET['salesperson_id']) && $_GET['salesperson_id'] != "") {
                    $salesperson_id = $_GET['salesperson_id'];
                    $sql->where(array("pals.sales_person_id" => $salesperson_id));
                }
               
               

         if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];
            $sql->where("(pals.activity like '%$ser%'");
           /*  $sql->or_where("ptl.name like '%$ser%'"); */
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
         /*    $nestedData[] = $row->name; */
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
            ->from("users cu")
            ->where(array("cu.status"=>"1","cu.is_deleted"=>"0","cu.role=" => "5"))
             ->order_by("cu.id","DESC")
            ->get()
            ->result();
    
        }
        if ( getUserInfos()->role == "1") {
            $logged_in_manager_id=$_SESSION['userinfo']['id'];
            
        $res = $this->db->select("cu.*")
        ->from("users cu")
        ->where(array("cu.status"=>"1","cu.is_deleted"=>"0","cu.role=" => "5","cu.manager_id=" => $logged_in_manager_id))
        ->order_by("cu.id","DESC")
        ->get()
        ->result();
             
             
         }
        if ( getUserInfos()->role == "3") {
            $logged_in_coor_id=$_SESSION['userinfo']['id'];
            
        $res = $this->db->select("cu.*")
        ->from("users cu")
        ->where(array("cu.status"=>"1","cu.is_deleted"=>"0","cu.role=" => "5","cu.cordinator_id=" => $logged_in_coor_id))
        ->order_by("cu.id","DESC")
        ->get()
        ->result();
             
             
         }
            
                
        return $res;
    }
     

     function view_app_disapp($id) {
      
        $res = $this->db->select("plm.*,pals.activity,pals.meeting_date as date_activity,ptl.name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
        ->from("pr_lead_meeting plm")
        ->join("pr_assign_lead_sales pals","plm.lead_id=pals.lead_id","left")
        ->join("pr_lead pl","pl.id=pals.lead_id","left")
        ->join("pr_type_lead ptl","ptl.id = pl.type_of_lead","left")
        ->join("users cu", "cu.id = pals.sales_person_id", "left")
        ->join("users cu2", "cu2.id = pals.manager_id", "left")
        ->join("users cu3", "cu3.id= pals.coordinator_id", "left")
        ->where(array("pals.is_deleted =" => "0","plm.id" =>$id ))
        ->get()->row();  
        
        // echo $this->db->last_query();
        // pr($res); die;  
           
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
    
   $sql = $this->db->select("pals.*,ptl.name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname,pl.client_name" , FALSE)
            ->from("pr_assign_lead_sales pals")
            ->join("pr_lead pl","pl.id=pals.lead_id","left")
            ->join("pr_type_lead ptl","ptl.id = pl.type_of_lead","left")
            ->join("users cu", "cu.id = pals.sales_person_id", "left")
            ->join("users cu2", "cu2.id = pals.manager_id", "left")
            ->join("users cu3", "cu3.id= pals.coordinator_id", "left")
            ->where(array("pals.is_deleted" => "0" ,"pals.outcome_status" => "4"));

            if (isset($_GET['manager_id']) && $_GET['manager_id'] != "") {
                $manager_id = $_GET['manager_id'];
                $sql->where(array("pals.manager_id" => $manager_id));
            }
    
            if (isset($_GET['coordinator_id']) && $_GET['coordinator_id'] != "") {
                $coordinator_id = $_GET['coordinator_id'];
                $sql->where(array("pals.coordinator_id" => $coordinator_id));
            }
            
            if (isset($_GET['salesperson_id']) && $_GET['salesperson_id'] != "") {
                $salesperson_id = $_GET['salesperson_id'];
                $sql->where(array("pals.sales_person_id" => $salesperson_id));
            }
           
           

     if (!empty($requestData['search']['value'])) {
        $ser = $requestData['search']['value'];
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
        $nestedData[] = $row->m_fname." ".$row->m_lname;
        $nestedData[] = $row->c_fname." ".$row->c_lname;
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
    $res=$this->db->select("pals.*,ptl.name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname,pl.client_name" , FALSE)
    ->from("pr_assign_lead_sales pals")
    ->join("pr_lead pl","pl.id=pals.lead_id","left")
    ->join("pr_type_lead ptl","ptl.id = pl.type_of_lead","left")
    ->join("users cu", "cu.id = pals.sales_person_id", "left")
    ->join("users cu2", "cu2.id = pals.manager_id", "left")
    ->join("users cu3", "cu3.id= pals.coordinator_id", "left")
    ->where(array("pals.is_deleted =" => "0","pals.id" =>$id/* ,"pals.outcome_status" => "4" */))
    ->get()
    ->row();
       
    return $res;
}

    public function update_disapp($id)
    {
        $upd['is_approved']="2";
        $whr['id']=$id;
        $this->db->update("pr_lead_meeting",$upd,$whr);

    }
    public function update_app($id)
    {
        $upd['is_approved']="1";
        $whr['id']=$id;
        $this->db->update("pr_lead_meeting",$upd,$whr);

    }



/*************************************view of reschedule activity 26-12-2018 ends */

function list_items_ajax_sales_performance() {
    $requestData = $_REQUEST;
        $columns = array(
            '',
            "cu.id",
            "cu.fname"
        );
//pr($_SESSION);die;
//$logged_in_coor_id=$_SESSION['userinfo']['id'];

        if ( getUserInfos()->role == "0") {
        $sql = $this->db->select("cu.*,concat( cu.fname ,' ', cu.lname ) as salesperson,concat( cuc.fname ,' ', cuc.lname ) as coordinator,"
                        , FALSE)
                ->from("users cu")
                // ->join("cz_roles cr", "cr.id = cu.role", "left")
                // ->join("pr_location plc", "plc.id = cu.location_id", "left")
                ->join("users cum", "cum.id = cu.manager_id", "left")
                ->join("users cuc", "cuc.id = cu.cordinator_id", "left")
                //->join("pr_assign_lead_sales plm", "plm.sales_person_id = cu.id", "left")
               // ->join("pr_order pr","pr.salesperson_id=cu.id","left")
                ->where("(cu.role='5')")
                ->where(array("cu.is_deleted =" => "0"));
        }

        else if ( getUserInfos()->role == "1") {
            $logged_in_manager_id=$_SESSION['userinfo']['id'];
            $sql = $this->db->select("cu.*,count(plm.lead_id) as total_visit,plm.outcome_status,concat( cu.fname ,' ', cu.lname ) as salesperson,concat( cuc.fname ,' ', cuc.lname ) as coordinator,"
            , FALSE)
                ->from("users cu")
                // ->join("cz_roles cr", "cr.id = cu.role", "left")
                // ->join("pr_location plc", "plc.id = cu.location_id", "left")
                ->join("users cum", "cum.id = cu.manager_id", "left")
                ->join("users cuc", "cuc.id = cu.cordinator_id", "left")
                ->join("pr_assign_lead_sales plm", "plm.sales_person_id = cu.id", "left")
               // ->join("pr_order pr","pr.salesperson_id=cu.id","left")
                ->where("(cu.role='5')")
                ->where(array("cu.is_deleted =" => "0","cu.manager_id=" => $logged_in_manager_id));

        }
        else if ( getUserInfos()->role == "3") {
            $logged_in_coor_id=$_SESSION['userinfo']['id'];
            $sql = $this->db->select("cu.*,count(plm.lead_id) as total_visit,plm.outcome_status,concat( cu.fname ,' ', cu.lname ) as salesperson,concat( cuc.fname ,' ', cuc.lname ) as coordinator,"
            , FALSE)
                ->from("users cu")
                // ->join("cz_roles cr", "cr.id = cu.role", "left")
                // ->join("pr_location plc", "plc.id = cu.location_id", "left")
                ->join("users cum", "cum.id = cu.manager_id", "left")
                ->join("users cuc", "cuc.id = cu.cordinator_id", "left")
                ->join("pr_assign_lead_sales plm", "plm.sales_person_id = cu.id", "left")
               // ->join("pr_order pr","pr.salesperson_id=cu.id","left")
                ->where("(cu.role='5')")
                ->where(array("cu.is_deleted =" => "0","cu.cordinator_id=" => $logged_in_coor_id));

        }
        else{

        }

        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];
            $sql->where("(concat(cu.fname,' ',cu.lname) like '%$ser%'");
            $sql->or_where("concat(cuc.fname,' ',cuc.lname)  like '%$ser%')");
        }
        
       

     
        
        $sql->order_by($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);
        $sql1 = clone $sql;
        if ($requestData['length'] != '-1') {  // for showing all records
            $query = $sql->limit($requestData['length'], $requestData['start']);
        }

        $query = $sql->get()->result();
       // pr($query);die;
        $totalData = $totalFiltered = $sql1->get()->num_rows();
        //echo $this->db->last_query();die;
        $data = array();
        $total_visits=0;
        $won=0;
        $lost=0;
        $total_sale=0;
        
        $starts= $requestData['start'];
        foreach ($query as $i => $row) {
                 $res = $this->db->select("plm.outcome_status,plm.lead_id", FALSE)
                        ->from("pr_assign_lead_sales plm")
                        ->where(array("plm.is_deleted =" => "0","plm.sales_person_id"=>"$row->id"))
                        ->get()->result();
                        foreach ($res as $key => $result) {
                            if($result->lead_id){
                                ++$total_visits;
                            }
                            if($result->outcome_status=="1"){
                                ++$won;
                            }else if($result->outcome_status=="2"){
                                ++$lost;
                            }else{
            
                            }
                           
                          

                        }
                        $res = $this->db->select("pr.total_amount", FALSE)
                        ->from("pr_order pr")
                        ->where(array("pr.is_deleted =" => "0","pr.salesperson_id"=>"$row->id"))
                        ->get()->result();
                        foreach ($res as $key => $result) {
                            if($result->total_amount){
                                $total_sale+=$result->total_amount;
                            }
                           
                        }
               
                $nestedData = array();

                //$nestedData[] = ++$i;
                $nestedData[] = ++$starts;
                $nestedData[] = $row->salesperson;;
                $nestedData[] = $row->coordinator;
                $nestedData[] = $total_visits;
                $nestedData[] = $won;
                $nestedData[] = $lost;
                $nestedData[] = $total_sale;
        
                $data[] = $nestedData;
                $total_visits=0;
                $won=0;
                $lost=0;
                $total_sale=0;
            }
      
        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        return $json_data;
}
}

?>
