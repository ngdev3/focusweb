<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logs_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function list_items_ajax() {
        $requestData = $_REQUEST;

        $columns = array(
            "",
            "clg.id",
            "clg.description",
        );

        $sql = $this->db->select("clg.*,
                cu.fname,cu.lname" , FALSE)
                ->from("cz_logs clg")
                
                ->join("cz_users cu", "cu.id = clg.user_id", "left");
                

        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];
            $sql->where("CONCAT(cu.fname,' ',cu.lname) like '%$ser%'");
            $sql->or_where("(clg.module like '%$ser%'");
            $sql->or_where("clg.ip_address like '%$ser%' ");
            $sql->or_where("clg.description like '%$ser%' ");
            $sql->or_where("clg.action like '%$ser%' )");
        }


        $sql->order_by($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);
        $sql1 = clone $sql;
        if ($requestData['length'] != '-1') {  // for showing all records
            $query = $sql->limit($requestData['length'], $requestData['start']);
        }
        $query = $sql->get()->result();
        //echo $this->db->last_query();die;
        $totalData = $totalFiltered = $sql1->get()->num_rows();
        $data = array();
        foreach ($query as $i => $row) {
            $nestedData = array();
            $full_name = ucwords($row->fname . ' ' . $row->lname);
            $nestedData[] = ++$i;
            $nestedData[] = $full_name;
            //$nestedData[] = $row->module;
            //$nestedData[] = $row->action;
           
            $nestedData[] = $row->description;
             $nestedData[] = date('d-m-Y h:i A', strtotime($row->added_date));
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
