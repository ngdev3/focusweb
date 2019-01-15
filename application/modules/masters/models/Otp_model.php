<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Otp_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function list_items_ajax() {
        $requestData = $_REQUEST;
        $columns = array(
            " ",
            "po.id",
            "po.id",
            "po.otp",
            "po.status"
        );

        
         $sql = $this->db->select('po.*', FALSE)->from("pr_otp po");
    
          
         $sql-> where(array("po.is_deleted !=" => "1"));
        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];
            $sql->where("(po.otp like '%$ser%'");
            $sql->or_where("po.status like '%$ser%' )");
           
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
            $nestedData[] = ($row->otp);
           /*  if($row->is_used=="1"){
                $nestedData[] = '<label style="color:blue;">Yes</label>';
            }else{
                $nestedData[] = '<label style="color:red;">No</label>';

            } */
            $nestedData[] = ($row->status == '1') ? '<label class="label-success label"> Active</label>' : '<label class="label-danger label"> In Active</label>';
           $nestedData[] = $this->load->view("otp/_action",array("data" => $row), true);
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
        //pr($_POST);die;
        $ins['otp'] = $otp;
        $ins['is_used'] = '0';
        $ins['status'] = $status;
        $ins['created_date'] = current_datetime();
        $ins['added_by'] = currUserId();
        
        //pr($ins);die;
        $this->db->insert("pr_otp", $ins);
        
      
    }
    
     function edit($id ) {
        extract($_POST);
       // pr($_POST);die;
        $ins['otp'] = $otp;
        $ins['updated_date'] = current_datetime();
        $ins['status'] = $status;
        $whr['id'] = $id;
       // pr($ins);
     //   pr($whr);die;
        $this->db->update("pr_otp", $ins, $whr);
    }
    
        function viewData($id) {
          
        $res = $this->db->select("po.*")
                ->from("pr_otp po")
                ->where(array("po.id" => $id))
                ->get()
                ->row();
        return $res;
    }
    function view($id) {

        $res = $this->db->select("po.*")
                ->from("pr_otp po")
                ->where(array("po.id" => $id))
                ->get()
                ->row();
        return $res;
    }

    function delete($id) {
        
        $this->db->select('*');

        $this->db->where("(id= '" . $id . "')");
        $hai=$this->db->from('pr_otp');
        $this->db->where("is_deleted","0");
        $query= $this->db->get()->row();
        $used=$query->is_used;
       
        if($used=="1"){
            $rt["status"] = "false";
            return $rt;

        }else{
            $upd['is_deleted'] = "1";
            $whr['id'] = $id;
            $this->db->update("pr_otp", $upd, $whr);
            if ($this->db->affected_rows() > 0) {
                $rt["status"] = "true";
            } else {
                $rt["status"] = "false";
            }
            return $rt;
        }


        
       
    }

    

       function delete_multiple($id){
		   
		  // pr($id);
		    //$ids= explode(",",$id);
			
			//pr($ids);die;
			
	     foreach($id as $vals){
			// echo $vals;die;
			  $upd['is_deleted'] = "1";
               $whr['id'] = $vals;
               $whr['is_used'] = "0";

              $abc=  $this->db->update("pr_otp", $upd, $whr);
	
		}
           
        if($abc){
			return true;
			
		} else{
			
			return false;
		}
          
           
       }

    
    
  
    

}

?>
