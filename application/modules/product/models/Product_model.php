<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_model extends CI_Model {

    function __construct() {
        parent::__construct();
     
    }

    function list_items_ajax() {
        $requestData = $_REQUEST;
       
        $columns = array(
            " ",
            "pr.id",
            "ppt.name",
            "pr.product_no",
			"pr.kva",
			"pr.hp",
            "pr.price_mrp",
			"pr.price_ssp",
			"pr.price_msp",
			"pr.hsn_sac"
        );

        $sql = $this->db->select("pr.*,ppt.name as pt_name"
                        , FALSE)
                ->from("pr_product pr")
                ->join("pr_product_type ppt", "ppt.id = pr.product_type", "left")
                 ->where(array("pr.is_deleted =" => "0"));
                // ->order_by("pr.id","DESC");
               
               

        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];
            $sql->where("(pr.name like '%$ser%'");
            $sql->or_where("pr.product_no like '%$ser%' ");
			$sql->or_where("pr.kva like '%$ser%' ");
			$sql->or_where("pr.hp like '%$ser%' ");
			$sql->or_where("pr.price_mrp like '%$ser%' ");
			$sql->or_where("pr.price_ssp like '%$ser%' ");
			$sql->or_where("pr.price_msp like '%$ser%' ");
			$sql->or_where("pr.hsn_sac like '%$ser%' ");
            $sql->or_where("pr.kva like '%$ser%' )");
        }

		
		 if(isset($_GET['product_type']) && $_GET['product_type']!="")
		  {
			    $id=$_GET['product_type'];
			    $sql->where(array("pr.product_type" => $id));
				
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
            $nestedData[] = $row->product_no;
            $nestedData[] = ucwords($row->name);
            $nestedData[] = ucwords($row->pt_name);
			 $nestedData[] = $row->hsn_sac;
			 
			 if($row->kva)
			 {
				$nestedData[] = $row->kva; 
			 }
			 else
			 {
				 $nestedData[] = '--';
			 }
			 
			 if($row->hp)
			 {
				 $nestedData[] = $row->hp;
			 }
			 else
			 {
				 $nestedData[] = '--';
			 }
			 
			 
			 
			
			 $nestedData[] = $row->price_mrp;	
			 
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
		
	//pr($_POST);die;
        $ins['name'] = $product_name;
        $ins['product_type'] = $product_type;
        $ins['product_no'] = $product_no;
        $ins['price_mrp'] = $price_mrp;
        //$ins['price_mrp'] = $price;	
		// if($price)
		// {
		//   $ins['price_mrp'] = $price; 	
		// }
		// else
		// {
		//  $ins['price_mrp'] = $price_mrp;	
		// }
		 if($product_type=="1"){
            $ins['kva'] = "";
            $ins['hp'] = "";
            $ins['price_ssp'] = "";
            $ins['price_msp'] = "";
         }else  if($product_type=="2"){
            $kva_vals=implode(",",$kva);
            $ins['kva'] = $kva_vals;
            $ins['hp'] = "";
            $ins['price_ssp'] = $price_ssp;
            $ins['price_msp'] = $price_msp;
         }else  if($product_type=="3" || $product_type=="4"){
            $ins['kva'] = "";
            $ins['hp'] = $hp;
            $ins['price_ssp'] = $price_ssp;
            $ins['price_msp'] = $price_msp;
         }else{

         }
	
        // $ins['price_ssp'] = $price_ssp;
        // $ins['price_msp'] = $price_msp;
		$ins['description'] = $description;
        $ins['hsn_sac'] = $hsn_sac;
        $ins['status'] = $status;
    
        $this->db->insert("pr_product", $ins);
        $insert_id = $this->db->insert_id();
       
		
		return $insert_id;
	
        
    }
    
     function edit($id = NULL) {
        extract($_POST);
        //pr($_POST);die;
        $upd['name'] = $product_name;
        $upd['product_type'] = $product_type;
        $upd['product_no'] = $product_no;
        $upd['price_mrp'] = $price_mrp;
		// if($price)
		// {
		//   $upd['price_mrp'] = $price; 	
		// }
		// else
		// {
		//  $upd['price_mrp'] = $price_mrp;	
        // }
        if($product_type=="1"){
            $upd['kva'] = "";
            $upd['hp'] = "";
            	
        $upd['price_ssp'] ="";
        $upd['price_msp'] ="";
         }else  if($product_type=="2"){
            $kva_vals=implode(",",$kva);
            $upd['kva'] = $kva_vals;
            $upd['hp'] = "";
            	
        $upd['price_ssp'] = $price_ssp;
        $upd['price_msp'] = $price_msp;
         }else  if($product_type=="3" || $product_type=="4"){
            $upd['kva'] = "";
            $upd['hp'] = $hp;
            	
        $upd['price_ssp'] = $price_ssp;
        $upd['price_msp'] = $price_msp;
         }else{

         }
       
		 
		
        // $upd['price_ssp'] = $price_ssp;
        // $upd['price_msp'] = $price_msp;
		$upd['description'] = $description;
        $upd['hsn_sac'] = $hsn_sac;
        $upd['status'] = $status;
        $whr['id'] = $id;
        $this->db->update("pr_product", $upd, $whr);
    }
    
        function viewData($id) {
        $res = $this->db->select("pr.*,ppt.name as pt_name")
                ->from("pr_product pr")
				->join("pr_product_type ppt", "ppt.id = pr.product_type", "left")
                ->where(array("pr.id" => $id))
                ->get()
                ->row();
        return $res;
    }
	
	public function last_id_get()
	{
		$res = $this->db->select("pr.id")
                ->from("pr_product pr")
				 ->order_by("pr.id", "Desc")
				 ->limit(1)
                 ->get()
                 ->row();
          return $res;
	}
    

  
    
   
    
   
    
    
    // function delete($id){
    //     $upd['is_deleted'] = "1";
    //     $whr['id']=$id;
      
	// 	$this->db->update("pr_product", $upd, $whr);
    //    // echo $this->db->last_query();die;
    //     if ($this->db->affected_rows() > 0) {
    //         $rt["status"] = "true";
    //         $rt["msg"] = "Success";
    //     } else {
    //         $rt["status"] = "false";
    //         $rt["msg"] = "Row was not deleted";
    //     }
    //     return $rt;
    // }
    
	
    //    function delete_multiple($id){
		   
	// 	  // pr($id);
	// 	    //$ids= explode(",",$id);
			
	// 		//pr($ids);die;
			
	//      foreach($id as $vals){
	// 		// echo $vals;die;
	// 		  $upd['is_deleted'] = "1";
    //            $whr['id'] = $vals;
    //           $abc=  $this->db->update("pr_product", $upd, $whr);
	
	// 	}
           
    //     if($abc){
	// 		return true;
			
	// 	} else{
			
	// 		return false;
	// 	}
          
           
    //    }

    function delete($id) {
        //pr($id);die;
        $this->db->select('*');
        $this->db->from('pr_order_product');
        $this->db->where("(product_id= '" . $id . "')");
        $query= $this->db->get()->row();
      //  pr( $query);die;
     
        if(!empty($query)){
            $rt["status"] = "false";
            return $rt;

        }else{
            $upd['is_deleted'] = "1";
            $whr['id'] = $id;
            $this->db->update("pr_product", $upd, $whr);
            if ($this->db->affected_rows() > 0) {
                $rt["status"] = "true";
                return $rt;
               
            } else {
                $rt["status"] = "false";
                return $rt;
               
               
            }
           
        }


        
       
    }

    

       function delete_multiple($id){
           $count=0;
          // $id=explode(",",$id);
        foreach($id as $vals){
            $this->db->select('*');
            $this->db->from('pr_order_product');
            $this->db->where("(product_id= '" . $vals . "')");
            $query= $this->db->get()->row();
            if(!empty($query)){
                $count++;
                $this->db->select('*');
                $this->db->from('pr_product');
                $this->db->where("(id= '" . $vals . "')");
                $this->db->where("is_deleted","0");
                $this->db->where("status","1");
                $que= $this->db->get()->row();
                $rt["prod"][]= $que->name;
            }
            
           }

           if($count==="0"){
            foreach($id as $vals){
                $upd['is_deleted'] = "1";
                $whr['id'] = $vals;
                $this->db->update("pr_product", $upd, $whr);
            }
            $rt["status"] = "true";
            //echo "$count";die;
            return $rt; 

           }else{
            $rt["status"] = "false";
            //echo "false";die;
            return $rt; 
           }
           
       }


}

?>
