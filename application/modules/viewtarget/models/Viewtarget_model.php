<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Viewtarget_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function list_items_ajax() {
        $requestData = $_REQUEST;

         $columns = array(
            "",
            "pst.id",
            "pst.id",
            "pst.id",
            "pst.target_price",
            "pst.target_product",
            "psvt.achieved_price",
            "psvt.achieved_product"
            
        );

        if(getUserInfos()->role == "0"){                   
            $sql = $this->db->select("pst.*,psvt.achieved_price,psvt.achieved_product,psvt.is_achieved,cu2.id as m_id,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
            ->from("pr_sales_target pst")
            ->join("users cu", "cu.id = pst.salesperson_id", "left")
            ->join("users cu2", "cu.manager_id = cu2.id", "left")
            ->join("users cu3", "cu.cordinator_id = cu3.id", "left")
            ->join("pr_sales_view_target psvt", "psvt.salesperson_id = pst.salesperson_id", "left")
            ->where(array("pst.is_deleted =" => "0"));
        
        }
        else if(getUserInfos()->role == "1"){ 
            $logged_in_manager_id=$_SESSION['userinfo']['id'];                  
            $sql = $this->db->select("pst.*,psvt.achieved_price,psvt.achieved_product,psvt.is_achieved,cu2.id as m_id,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
            ->from("pr_sales_target pst")
            ->join("users cu", "cu.id = pst.salesperson_id", "left")
            ->join("users cu2", "cu.manager_id = cu2.id", "left")
            ->join("users cu3", "cu.cordinator_id = cu3.id", "left")
            ->join("pr_sales_view_target psvt", "psvt.salesperson_id = pst.salesperson_id", "left")
            ->where(array("pst.is_deleted =" => "0","cu2.id=" => $logged_in_manager_id));
        
        }
        else if(getUserInfos()->role == "3"){ 
            $logged_in_coor_id=$_SESSION['userinfo']['id'];                  
            $sql = $this->db->select("pst.*,psvt.achieved_price,psvt.achieved_product,psvt.is_achieved,cu3.id as m_id,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
            ->from("pr_sales_target pst")
            ->join("users cu", "cu.id = pst.salesperson_id", "left")
            ->join("users cu2", "cu.manager_id = cu2.id", "left")
            ->join("users cu3", "cu.cordinator_id = cu3.id", "left")
            ->join("pr_sales_view_target psvt", "psvt.salesperson_id = pst.salesperson_id", "left")
            ->where(array("pst.is_deleted =" => "0","cu3.id=" => $logged_in_coor_id));
        
        }
        else{

        }

 if (isset($_GET['year']) && $_GET['year'] != "" && $_GET['year'] != "Select Year"){
    @$selected_year=@$_GET['year'];
     
     $sql->where(array("YEAR(psvt.created_date)" => $selected_year));
 }
 
 if (isset($_GET['month']) && $_GET['month'] != ""){
    @$selected_month=@$_GET['month'];
     
     $sql->where(array("MONTH(psvt.created_date)" => $selected_month));
 }
 
 

 
        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];
            $sql->where("(CONCAT(cu.fname,' ',cu.lname) like '%$ser%'");
            $sql->or_where("CONCAT(cu2.fname,' ',cu2.lname)like '%$ser%'");
            $sql->or_where("CONCAT(cu3.fname,' ',cu3.lname)like '%$ser%'");
            $sql->or_where("pst.target_price like '%$ser%' ");
            $sql->or_where("pst.target_product like '%$ser%' ");
            $sql->or_where("psvt.achieved_price like '%$ser%' ");
            $sql->or_where("psvt.achieved_product like '%$ser%' )");
        }


        $sql->order_by($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);
        $sql1 = clone $sql;
        if ($requestData['length'] != '-1') {  // for showing all records
            $query = $sql->limit($requestData['length'], $requestData['start']);
        }
        $query = $sql->get()->result();
       //pr($query);die;
        //echo $this->db->last_query();die;
        $totalData = $totalFiltered = $sql1->get()->num_rows();
        $data = array();
        $starts= $requestData['start'];
        foreach ($query as $i => $row) {
        
            $nestedData = array();

            //$nestedData[] = ++$i;
            $nestedData[] = ++$starts;
            $sp_full_name = ucwords($row->fname . ' ' . $row->lname);
           
            $m_full_name = ucwords($row->m_fname . ' ' . $row->m_lname);
          
            $c_full_name = ucwords($row->c_fname . ' ' . $row->c_lname);
            
            $nestedData[] = $sp_full_name;
            if ( getUserInfos()->role == "0"){ 
            $nestedData[] = $m_full_name;
            $nestedData[] = $c_full_name;
        }
        if ( getUserInfos()->role == "1"){ 
            $nestedData[] = $c_full_name;
        }
            $nestedData[] = $row->target_price;
            $nestedData[] = $row->achieved_price;
            $nestedData[] = $row->target_product;
            $nestedData[] = $row->achieved_product;
            if($row->is_achieved=="1"){
                $nestedData[] = '<label style="color:blue;">Yes</label>';
            }else{
                $nestedData[] = '<label style="color:red;">No</label>';

            }
          
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

    
}

?>
