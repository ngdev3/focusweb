<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function list_items_ajax() {
        $requestData = $_REQUEST;
        $columns = array(
            "",
            "sp.page_name",
            "sp.title"
        );

        
         $sql = $this->db->select("sp.*", FALSE)->from("sr_pages sp");
    
          

        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];
            $sql->where("(sp.page_name like '%$ser%'");
            $sql->or_where("sp.title like '%$ser%' )");
           
        }


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
           // $full_name = ucwords($row->fname . ' ' . $row->lname);
            $nestedData[] = ucwords($row->page_name);
            $nestedData[] = ucwords($row->title);
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
        extract($_FILES);
        $image=$_FILES['image']['name'];
        $ins['page_name'] = $page_name;
        $ins['image'] = $image;
        $ins['title'] = $title;
        $ins['description'] = $description;
        $ins['metatitle'] = $metatitle;
        $ins['metakeyword'] = $metakeyword;
        $ins['metadescription'] = $metadescription;
        $ins['status'] = $status;
        
        $ins['created_date'] = current_datetime();
        $ins['added_by'] = currUserId();
        

        //$ins['status'] = $status;
        //pr($ins);die;
        $this->db->insert("sr_pages", $ins);
        
        //Sending Mail to user
        /*         $subject = "Registration";
		$body = $this->load->view("email_template/admin/registration",array("data"=>$ins),true);
                //pr($body);die;
                sendMail($ins['email'],$subject,$body);
                 //Sending Mail to user
            */      
        
        
    }
    
     function edit($id = NULL) {
        extract($_POST);
        extract($_FILES);

        if($_FILES['image']['name']!=''){

            $image=$_FILES['image']['name'];
       
            $ins['page_name'] = $page_name;
            $ins['image'] = $image;
            $ins['title'] = $title;
            $ins['description'] = $description;
            $ins['metatitle'] = $metatitle;
            $ins['metakeyword'] = $metakeyword;
            $ins['metadescription'] = $metadescription;
            $ins['status'] = $status;
         
            $ins['updated_date'] = current_datetime();
            $whr['id'] = $id;

        }else{

            $ins['page_name'] = $page_name;
            $ins['title'] = $title;
            $ins['description'] = $description;
            $ins['metatitle'] = $metatitle;
            $ins['metakeyword'] = $metakeyword;
            $ins['metadescription'] = $metadescription;
            $ins['status'] = $status;
        
            $ins['updated_date'] = current_datetime();
            $whr['id'] = $id;




        }
        $image=$_FILES['image']['name'];
       
        
        $this->db->update("sr_pages", $ins, $whr);
    }
    
        function viewData($id) {
        $res = $this->db->select("sp.*")
                ->from("sr_pages sp")
                ->where(array("sp.id" => $id))
                ->get()
                ->row();
        return $res;
    }
    function view($id) {

        $res = $this->db->select("sp.*")
                ->from("sr_pages sp")
                ->where(array("sp.id" => $id))
                ->get()
                ->row();
        return $res;
        
    }

    

    
    
  
    

}

?>
