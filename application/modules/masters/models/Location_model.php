<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Location_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function list_items_ajax() {
        $requestData = $_REQUEST;
        $columns = array(
            " ",
            "ca.id",
            "ca.id",
            "ca.location_name",
            "ca.status"
        );

        
         $sql = $this->db->select('ca.*', FALSE)->from("pr_location ca");
    
          
         $sql-> where(array("ca.is_deleted !=" => "1"));
        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];
            $sql->where("(ca.location_name like '%$ser%'");
            $sql->or_where("ca.status like '%$ser%' )");
           
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

           
            $nestedData[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="group-checkable checks_all" name="check_all[]" value="'.$row->id.'" />
                                                            <span></span>
                                                        </label>';
           //$nestedData[] = ++$i;
           $nestedData[] = ++$starts;
           // $full_name = ucwords($row->fname . ' ' . $row->lname);
            $nestedData[] = ucwords($row->location_name);
            $nestedData[] = ($row->status == '1') ? '<label class="label-success label"> Active</label>' : '<label class="label-danger label"> In Active</label>';
           $nestedData[] = $this->load->view("location/_action",array("data" => $row), true);
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
        $ins['location_name'] = $location_name;
        $ins['description'] = $description;
        $ins['status'] = $status;
        $ins['created_date'] = current_datetime();
        $ins['added_by'] = currUserId();
        

        //$ins['status'] = $status;
        //pr($ins);die;
        $this->db->insert("pr_location", $ins);
        
        //Sending Mail to user
        /*         $subject = "Registration";
		$body = $this->load->view("email_template/admin/registration",array("data"=>$ins),true);
                //pr($body);die;
                sendMail($ins['email'],$subject,$body);
                 //Sending Mail to user
            */      
        
        
    }
    
     function edit($id ) {
        extract($_POST);
       

        $ins['location_name'] = $location_name;
        $ins['description'] = $description;
        $ins['status'] = $status;
        $ins['updated_date'] = current_datetime();
       
        

        $whr['id'] = $id;




        
       
        
        $this->db->update("pr_location", $ins, $whr);
    }
    
        function viewData($id) {
          
        $res = $this->db->select("ca.*")
                ->from("pr_location ca")
                ->where(array("ca.id" => $id))
                ->get()
                ->row();
        return $res;
    }
    function view($id) {

        $res = $this->db->select("ca.*")
                ->from("pr_location ca")
                ->where(array("ca.id" => $id))
                ->get()
                ->row();
        return $res;
    }

    function delete($id) {
       // pr($id);die;
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where("(location_id= '" . $id . "')");
        $this->db->where("is_deleted","0");
        $query= $this->db->get()->row();
      //  pr( $query);die;
     
        if(!empty($query)){
            $rt["status"] = "false";
            return $rt;

        }else{
            $upd['is_deleted'] = "1";
            $whr['id'] = $id;
            $this->db->update("pr_location", $upd, $whr);
            if ($this->db->affected_rows() > 0) {
                $rt["status"] = "true";
            } else {
                $rt["status"] = "false";
               
            }
            return $rt;
        }


        
       
    }

    

       function delete_multiple($id){
           $count=0;
        foreach($id as $vals){
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where("(location_id= '" . $vals . "')");
            $this->db->where("is_deleted","0");
            $query= $this->db->get()->row();
            if(!empty($query)){
                $count++;
                $this->db->select('*');
                $this->db->from('pr_location');
                $this->db->where("(id= '" . $vals . "')");
                $this->db->where("is_deleted","0");
                $this->db->where("status","1");
                $que= $this->db->get()->row();
                $rt["loc"][]= $que->location_name;
            }
            
           }

           if($count=="0"){
            foreach($id as $vals){
                $upd['is_deleted'] = "1";
                $whr['id'] = $vals;
                $this->db->update("pr_location", $upd, $whr);
            }
            $rt["status"] = "true";
            return $rt; 

           }else{
            $rt["status"] = "false";
            return $rt; 
           }
           
       }

    
    
  
    

}

?>
