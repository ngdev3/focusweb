<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage_sales_order_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->helper('string');
    }

    function list_items_ajax() {
        $requestData = $_REQUEST;
         $columns = array(
            '',
            "po.created_date",
            "po.dynamic_order_id",
            "pl.client_name",
            "cu2.fname",
            "cu3.fname",
            "cu.fname",
            "po.id",
            "po.basic_amount",
            "po.gst",
            "po.total_amount",
            "po.advance_amount",
            "po.pending_amount"
        ); 
        if(getUserInfos()->role == "0"){ 
        $sql = $this->db->select("po.*,pl.address,pl.client_name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
                ->from("pr_order po")
                ->join("cz_users cu", "cu.id = po.salesperson_id", "left")
                ->join("cz_users cu2", "cu2.id = po.manager_id", "left")
                ->join("cz_users cu3", "cu3.id= po.coordinator_id", "left")
                ->join("pr_lead pl", "pl.id = po.client_id", "left")
                ->where(array("po.is_deleted =" => "0",'po.salesperson_id!=' => ""));
        }
        else if ( getUserInfos()->role == "1") {
            $logged_in_manager_id=$_SESSION['userinfo']['id'];
            $sql = $this->db->select("po.*,pl.address,pl.client_name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
                ->from("pr_order po")
                ->join("cz_users cu", "cu.id = po.salesperson_id", "left")
                ->join("cz_users cu2", "cu2.id = po.manager_id", "left")
                ->join("cz_users cu3", "cu3.id= po.coordinator_id", "left")
                ->join("pr_lead pl", "pl.id = po.client_id", "left")            
                ->where(array("po.is_deleted =" => "0","po.manager_id=" => $logged_in_manager_id,'po.salesperson_id!=' => ""));

        }
    
    else if ( getUserInfos()->role == "3") {
        $logged_in_coor_id=$_SESSION['userinfo']['id'];
        $sql = $this->db->select("po.*,pl.address,pl.client_name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
            ->from("pr_order po")
            ->join("cz_users cu", "cu.id = po.salesperson_id", "left")
            ->join("cz_users cu2", "cu2.id = po.manager_id", "left")
            ->join("cz_users cu3", "cu3.id= po.coordinator_id", "left")
            ->join("pr_lead pl", "pl.id = po.client_id", "left")            
            ->where(array("po.is_deleted =" => "0","po.coordinator_id=" => $logged_in_coor_id,'po.salesperson_id!=' => ""));

    }
        else{

        }


        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];
         
            $sql->where("(DATE_FORMAT(po.created_date, '%d-%m-%Y %H:%i:%s')  like '%$ser%' ");
          
            $sql->or_where("po.dynamic_order_id like '%$ser%'");
            $sql->or_where("pl.client_name like '%$ser%'");
            $sql->or_where("concat(cu2.fname,' ',cu2.lname)  like '%$ser%'");
            $sql->or_where("concat(cu3.fname,' ',cu3.lname)  like '%$ser%'");
            $sql->or_where("concat(cu.fname,' ',cu.lname) like '%$ser%'");
            $sql->or_where("po.basic_amount like '%$ser%'");
            $sql->or_where("pl.address like '%$ser%'");
            $sql->or_where("po.gst like '%$ser%'");
            $sql->or_where("po.total_amount like '%$ser%'");
            $sql->or_where("po.advance_amount like '%$ser%'");
            $sql->or_where("po.pending_amount like '%$ser%' )");
        } 
        
          if (isset($_GET['manager_id']) && $_GET['manager_id'] != "") {
            $manager_id = $_GET['manager_id'];
            $sql->where(array("cu.manager_id" => $manager_id));
        }

        if (isset($_GET['coordinator_id']) && $_GET['coordinator_id'] != "") {
            $coordinator_id = $_GET['coordinator_id'];
            $sql->where(array("cu.cordinator_id" => $coordinator_id));
        }
        if (isset($_GET['client_id']) && $_GET['client_id'] != "") {
            $client_id = $_GET['client_id'];
            $sql->where(array("po.client_id" => $client_id));
        }
        if (isset($_GET['salesperson_id']) && $_GET['salesperson_id'] != "") {
            $salesperson_id = $_GET['salesperson_id'];
$sql->where(array("po.salesperson_id" => $salesperson_id));
        }
        
        $sql->order_by($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);
        $sql1 = clone $sql;
        if ($requestData['length'] != '-1') {  // for showing all records
            $query = $sql->limit($requestData['length'], $requestData['start']);
        }

        $query = $sql->get()->result();
        //pr($query);die;
        $totalData = $totalFiltered = $sql1->get()->num_rows();
        //echo $this->db->last_query();die;
        $data = array();
        $starts= $requestData['start'];
        foreach ($query as $i => $row) {
        
            $nestedData = array();

            //$nestedData[] = ++$i;
            $nestedData[] = ++$starts;
            @$newDate = date("d-m-Y h:i:s", strtotime($row->created_date)); 
            //@$newtime = date("h:i", strtotime($res->created_date)); 
                                                 
            $nestedData[] = $newDate;
            $nestedData[] = $row->dynamic_order_id;
            $nestedData[] = $row->client_name;
            if(getUserInfos()->role == "0"){
            $nestedData[] = $row->m_fname." ".$row->m_lname;
            $nestedData[] = $row->c_fname." ".$row->c_lname;
            }
            if(getUserInfos()->role == "1"){
            $nestedData[] = $row->c_fname." ".$row->c_lname;
            }
            $nestedData[] = $row->fname." ".$row->lname;
            
            $nestedData[] = $row->address;
            $nestedData[] = $row->basic_amount;
            $nestedData[] = $row->gst;
            $nestedData[] = $row->total_amount;
            $nestedData[] = $row->advance_amount;
            $nestedData[] = $row->pending_amount;
           
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
        
       // pr($_POST);die;
       if(getUserInfos()->role == "0"){
        $ins2['manager_id'] = $manager_id;
        $ins2['coordinator_id'] = $cordinator_id;
        }
    if(getUserInfos()->role == "1"){
        $logged_in_manager_id=$_SESSION['userinfo']['id'];
        $ins2['manager_id'] = $logged_in_manager_id;
        $ins2['coordinator_id'] = $cordinator_id;
     
    }
    if(getUserInfos()->role == "3"){
        $logged_in_coor_id=$_SESSION['userinfo']['id'];

    $ins2['coordinator_id'] = $logged_in_coor_id;
    $res = $this->db->select("cu.*")
            ->from("cz_users cu")
            ->where(array("cu.id" => $logged_in_coor_id))
            ->get()
            ->row();
           
    $ins2['manager_id'] = $res->manager_id;
    }
   
        $ins2['dynamic_order_id']=$order_id;
        $ins2['salesperson_id']=$sales_person_id;
        $ins2['gst']=$gst;
        $ins2['client_id']=$client_id;
        $ins2['basic_amount']=$basic_amount;
        $ins2['advance_amount']=$advance_amount;
        $ins2['pending_amount']=$pending_amount;
        $ins2['total_amount']=$total_amount;
        $ins2['payment_mode']=$payment_mode;
        $ins2['payment_description']=$payment_description;
        $ins2['payment_term']=$payment_term;
        $ins2['order_type']="1";
        $ins2['is_deleted'] ="0";
        $ins2['status'] ="1";
        $ins2['created_date'] = current_datetime();
        $ins2['added_by'] = currUserId();


        $this->db->insert('pr_order',$ins2);
        $inserted_id= $this->db->insert_id();

        if(!empty($product_id_arr)){
            foreach ($product_id_arr as $key => $value) {
                $ins['order_id']=$inserted_id;
                $ins['product_id']=$product_id_arr[$key];

                $sql=$this->db->select("product_type")
                ->where(array("status"=>"1","is_deleted"=>"0","id"=>$product_id_arr[$key]))
                ->from("pr_product")
                ->get()->row();
                $ins['product_type_id']=$sql->product_type;
                
                
                 if($kva_arr[$key]=="undefined") {
                    $ins['kva']="";
                }else{
                    $ins['kva']=$kva_arr[$key]; 
                }
                if($hp_arr[$key]=="undefined" ){
                $ins['hp']="";
                } else{
                    $ins['hp']=$hp_arr[$key];
                }
               
               
                $ins['quantity']=$quantity_arr[$key];
                $ins['unit_id']=$unit_id_arr[$key];
                $ins['price']=$price_arr[$key];
                $ins['total']=$total_arr[$key];
                $this->db->insert('pr_order_product',$ins);


            }
            
        }if(empty($product_id_arr)){
           // echo "shubham";die;
            $ins['order_id']=$inserted_id;
            $ins['product_id']=$product_id;
          //  $ins['product_type_id']=$product_type_id[$key];
          $sql=$this->db->select("product_type")
          ->where(array("status"=>"1","is_deleted"=>"0","id"=>$product_id))
          ->from("pr_product")
          ->get()->row();
          $ins['product_type_id']=$sql->product_type;
          if($ins['product_type_id']=="2" ||$ins['product_type_id']=="1") { 
            $ins['kva']=$kva;
            $ins['hp']="";
        }
        if($ins['product_type_id']=="3" ||$ins['product_type_id']=="4"){
        $ins['kva']="";
        $ins['hp']=$hp; 
         
        } 
            $ins['quantity']=$quantity;
            $ins['unit_id']=$unit_id;
            $ins['price']=$price;
           // pr($ins);die;
            $this->db->insert('pr_order_product',$ins);
        }
    }

    
   function view($id) {
    $sql = $this->db->select("po.*,pl.location,pl.client_name,cu.fname,cu.lname,cu2.fname as m_fname,cu2.lname as m_lname,cu3.fname as c_fname,cu3.lname as c_lname" , FALSE)
    ->from("pr_order po")
    ->join("cz_users cu", "cu.id = po.salesperson_id", "left")
    ->join("cz_users cu2", "cu2.id = po.manager_id", "left")
    ->join("cz_users cu3", "cu3.id= po.coordinator_id", "left")
    ->join("pr_lead pl", "pl.id = po.client_id", "left")
    ->where(array("po.is_deleted =" => "0","po.id" => $id)) 
    ->get()
    ->row();
    return $sql;
    }
    function detail($id) {
        $sql = $this->db->select("pop.*,pp.name,po.gst,po.total_amount" , FALSE)
        ->from("pr_order_product pop")
        ->join("pr_product pp", "pp.id = pop.product_id", "left")
        ->join("pr_order po", "pop.order_id = po.id", "left")
        
        ->where(array("pop.order_id=" => $id)) 
        ->get()
        ->result();
        return $sql;
        }
    /* function delete($id) {
        $upd['is_deleted'] = "1";
        $whr['id'] = $id;
        $this->db->update("cz_users", $upd, $whr);
        //echo $this->db->last_query();die;
        
        return $rt;
    }
 */
   /*  function delete_multiple($id) {

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
    } */
    function getclient() {
         
        //echo $coordinator_id;die;
       $res = $this->db->select("cu.*")
               ->from("pr_lead cu")
               ->where(array("cu.status"=>"1","cu.is_deleted"=>"0"))
                ->order_by("cu.id","DESC")
               ->get()
               ->result();
       //echo $this->db->last_query();die;
       return $res;
   }
   function getproduct() {
         
    //echo $coordinator_id;die;
   $res = $this->db->select("cu.*")
           ->from("pr_product cu")
           ->where(array("cu.status"=>"1","cu.is_deleted"=>"0","cu.product_type!="=>"1"))
            ->order_by("cu.id","DESC")
           ->get()
           ->result();
           //pr($res);die;
   //echo $this->db->last_query();die;
   return $res;
}
//  Get salesperson for filter start 


 function getsalesperson() {
    if ( getUserInfos()->role == "0" || getUserInfos()->role == "2") {

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
 //  Get salesperson for filter ends


 public function get_product_details($product_id)
 {
     $sql=$this->db->select("product_type")
     ->where(array("status"=>"1","is_deleted"=>"0","id"=>$product_id))
     ->from("pr_product")
     ->get()->row();
    // pr($sql);
     return $sql;
 }
 public function last_id_get() {
    $res = $this->db->select("pr.id")
            ->from("pr_order pr")
            ->order_by("pr.id", "Desc")
            ->limit(1)
            ->get()
            ->row();
    return $res;
}

function getpayment_type() {
         
    //echo $coordinator_id;die;
   $res = $this->db->select("cu.*")
           ->from("pr_payment_mode cu")
           ->where(array("cu.status"=>"1","cu.is_deleted"=>"0"))
            ->order_by("cu.id","DESC")
           ->get()
           ->result();
   //echo $this->db->last_query();die;
   return $res;
}

function getproduct_rate($product_id) {
         
    //echo $coordinator_id;die;
   $res = $this->db->select("cu.price_mrp,cu.hp,cu.kva")
           ->from("pr_product cu")
           ->where(array("cu.status"=>"1","cu.is_deleted"=>"0","cu.id"=>$product_id))
           ->get()
           ->row();
           //pr($res);
  // echo $this->db->last_query();die;
   return $res;
}

 
 

}

?>
