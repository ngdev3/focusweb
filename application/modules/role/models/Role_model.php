<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * CodeIgniter Role Model 
 *
 * @package		 Role
 * @subpackage	         Models
 * @category	         Account
 * @author		Manish Kumar
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
class Role_model extends CI_Model {    

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
    
    
    function list_items_ajax(){
        $requestData = $_REQUEST;
        $columns = array(
            "cr.id",
            "cr.role_name",            
            "cr.status",
        );
        
        $sql = $this->db->select("cr.*"                                   
                        , FALSE)
                ->from("cz_roles cr");
         $sql->where('cr.is_deleted','0'); 

        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];
            $sql->where("(cr.role_name like '%$ser%'");          
            $sql->or_where("cr.status like '%$ser%' )");           
        }

//        if (isset($_GET['warehouse']) && $_GET['warehouse'] > 0 ) {
//            $sql->or_where(array("ip.warehouse" => $_GET["warehouse"]));
//        }
//        if (isset($_GET['category']) && $_GET['category'] > 0) {
//            $sql->where(array("ip.category" => $_GET["category"]));
//        }
//        if (isset($_GET['sub_category']) && $_GET['sub_category'] > 0) {
//            $sql->where(array("ip.sub_category" => $_GET["sub_category"]));
//        }
//        if (isset($_GET['color1']) && $_GET['color1'] > 0) {
//            $sql->where(array("ip.color1" => $_GET["color1"]));
//        }
//        if (isset($_GET['color2']) && $_GET['color2'] > 0) {
//            $sql->where(array("ip.color2" => $_GET["color2"]));
//        }
//        if (isset($_GET['stone_material']) && $_GET['stone_material'] > 0) {
//            $sql->where(array("ip.stone_material" => $_GET["stone_material"]));
//        }
//        if (isset($_GET['metal_material']) && $_GET['metal_material'] > 0) {
//            $sql->where(array("ip.metal_material" => $_GET["metal_material"]));
//        }
//        if (isset($_GET['start_date']) && !empty($_GET['start_date'])) {
//            $start_date = $_GET['start_date'];
//            $end_date = $_GET['end_date'];
//            $sql->where("ip.created BETWEEN '$start_date' AND '$end_date 23:59:59'");
//        }
//        $sql->group_by($columns[$requestData['order'][0]['column']] . ' ' . $requestData['order'][0]['dir'] . " with ROLLUP");
        $sql->order_by($columns[$requestData['order'][0]['column']] ,$requestData['order'][0]['dir']);
        
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
            $role_name = ucwords($row->role_name);
            $nestedData[] = $role_name;        
            $nestedData[] = ($row->status == '1') ? '<label class="label-success label"> Active</label>' : '<label class="label-danger label"> In Active</label>';
            $nestedData[] =  $this->load->view("_action", array("data" => $row), true);        
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


    function get_roles() {
        $this->db->select("*", false);
        $this->db->where("emptype", '2');
        $this->db->where("is_deleted", '0');
        $query = $this->db->get($this->user_table);
        $result = $query->result_array();
        return $result;
    }

    function add() {
        $ins['role_name'] = $this->input->post('role_name', true);
        $ins['created_date'] = date("Y-m-d H:i:s");
        $ins['status'] = $this->input->post('status', true);
        $this->db->insert("cz_roles", $ins);
        $id = $this->db->insert_id();
        return $id;
    }

    /**
     * Get Users By Id
     *
     * This function Get All Groups
     * 
     * @access	public
     * @return	Object 
     */
    function get_user_by_id($user_id) {
//        echo $user_id; die;
        $this->db->select("*", false);
        $this->db->where("id", $user_id);
        $query = $this->db->get($this->user_table);
        $result = $query->row_array();
//        pr($result); die;
        return $result;
    }

    function edit1($id) {
        // print_r($_POST);die;       
        $data['role_name'] = $this->input->post('role_name', true);
        $data['status'] = $this->input->post('status', true);
        $data['modified_date'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        $result['valid'] = $this->db->update($this->user_table, $data);
        //echo $this->db->last_query();die;
        return $result;
    }

    function delete_user($id) {
        $data = array(
            'is_deleted' => 1,
        );
        $this->db->where('id', $id);
        $this->db->update('cz_roles', $data);
//        //echo $this->db->last_query();die;
        $res = $this->db->affected_rows();
//        return $res;
    }

    public function ajax_list_items($search = '', $per_page = 10, $start = 0) {
        $this->db->select('mt.*', false);
        $this->db->from('cz_roles as mt');
        if ($search != '') {
            $this->db->where("(mt.role_name LIKE '%$search%')");
            //$this->db->like('mt.role_name',$search);
            //$this->db->or_like('mt.email',$search);
        }
        $this->db->where("is_deleted", '0');
        $this->db->order_by('mt.id', 'DESC');
        $this->db->limit($per_page, $start);

        $data['result'] = $this->db->get()->result_array();

        //  echo $this->db->last_query();

        $this->db->select("COUNT(mt.id) AS count");
        $this->db->from('cz_roles as mt');
        if ($search != '') {
            $this->db->where("(mt.role_name LIKE '%$search%' )");
            //$this->db->like('mt.role_name',$search);
            //$this->db->or_like('mt.email',$search);
        }
        $this->db->where("is_deleted", '0');
        $data['count'] = $this->db->count_all_results();
//        pr($data); die;
        return $data;
    }

    function getAllModules() {
        $res = $this->db->select("*")
                ->from("cz_permissions")
//                ->group_by("module")
                ->get()
                ->result();
//       pr($res); die;
//        echo $this->db->last_query() ; die;
        return $res;
    }

    function getUserData($user_id, $type = NULL) {
        if ($type == 'user') {
            $data = $this->db->select("ru.*,rr.role_name, rr.permission_ids as role_permissions")
                            ->from("users ru")
                            ->where(array("ru.id" => $user_id))
                            ->join("cz_roles rr", "rr.id = ru.role", "left")
                            ->get()->row();
        } else if ($type == 'role') {
            $data = $this->db->select("rr.*, rr.permission_ids as role_permissions")
                            ->from("cz_roles rr")
                            ->where(array("rr.id" => $user_id))
                            ->get()->row();
        }
//        echo $this->db->last_query(); die;
        return $data;
    }

    function assign_permission($data) {
        $type = $this->uri->segment('4');
        $role_permissions = $data['role_permissions'];
        $all_role_permissions = $data['all_role_permissions'];


        $arr[] = @$_POST['view'];
        $arr[] = @$_POST['add'];
        $arr[] = @$_POST['edit'];
        $arr[] = @$_POST['delete'];

        $result = array();
//        pr($_POST); 
//        pr($arr); die;
        $up_arr=array();
        $rp_arr=array();

        foreach ($arr as $sub) {
            if (!empty($sub)) {
                foreach ($sub as $k => $v) {
                    $up_arr[$k][] = $v; // user permission array
                    if (array_key_exists($k, @$role_permissions)) {
                        $rp_arr[$k] = $role_permissions[$k];  // role permission array
                    }
                }
            }
        }


//        
//        pr($up_arr); 
//        pr($rp_arr); die;
//        pr($up_arr); 
//        pr($up_arr + $rp_arr);
//        die;
        $up_arr_keys = array_keys($up_arr);
//        pr($up_arr_keys); die;

//        pr($all_role_permissions); die; 

        $user_removed_permission_from_roles = array_diff($all_role_permissions, $up_arr_keys);

     // pr($user_removed_permission_from_roles); die;
       // $user_removed_permission_from_roles1 = array_fill_keys($user_removed_permission_from_roles, array("1", "2", "3", "4", "5", "6", "7", "8"));
        $user_removed_permission_from_roles1 = array_fill_keys($user_removed_permission_from_roles, array("1", "2", "3", "4"));

        if ($type == 'user') {
            $rp_up_arr = array();
            @$uremoved_permission = array();
            @$rp_up_arr = $rp_arr + $up_arr;
            foreach ($rp_up_arr as $key => $value) {
                if (array_key_exists($key, $up_arr) && array_key_exists($key, $rp_arr)) {
                    $arr1 = $up_arr[$key];
                    $arr2 = $rp_arr[$key];

                    if (!empty(array_diff($arr2, $arr1))) {
                        $uremoved_permission[$key] = array_values(array_values(array_diff($arr2, $arr1)));
                    }
                    if (!empty(array_diff($arr1, $arr2))) {
                        $uextra_permission[$key] = array_values(array_diff($arr1, $arr2));
                    }
//                pr($uremoved_permission); die;
//                pr($uextra_permission); die;                
                } else {
                    $uextra_permission[$key] = $value;
                }
            }
            @$merged_uremoved_permission = $uremoved_permission + $user_removed_permission_from_roles1;
        }
//        pr($uextra_permission);     
//        pr($uremoved_permission); 
//        pr($user_removed_permission_from_roles1); 
//        pr(json_encode($uextra_permission));
//        pr(json_encode($uremoved_permission)); 
//         pr($merged_uremoved_permission); die;

        $whr["id"] = base64_decode($this->uri->segment('3'));
        if ($type == 'user') {
            $upd["user_extra_permission"] = json_encode($uextra_permission);
            $upd["user_removed_permission"] = json_encode($merged_uremoved_permission);
            $this->db->update("users", $upd, $whr);
        } else if ($type == 'role') {
            $upd["permission_ids"] = json_encode($up_arr);
            $this->db->update("cz_roles", $upd, $whr);
        }
//        echo $this->db->last_query(); die;
        $this->session->set_flashdata("alert", array("c" => "s", "m" => "Permission has been assigned"));
        redirect(current_url());
    }

    function get_all_roles() {
        $data = $this->db->get("cz_roles")->result_array();
        $arr = array_column($data, "id");
        return $arr;
    }
    
     /* Role Module Edit and Delete Made by Manish and Previous Module function name as
     *  edit as edit1
     * delete as delete 1
     *  START */
    
        function viewData($id) {
        $res = $this->db->select("cr.*")
                ->from("cz_roles cr")
                ->where(array("cr.id" => $id))
                ->get()
                ->row();
        return $res;
    }
    
    
     function edit($id) {
         //print_r($_POST);die;       
        $data['role_name'] = $this->input->post('role_name', true);
        $data['status'] = $this->input->post('status', true);
        $data['modified_date'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        $result['valid'] = $this->db->update('cz_roles', $data);
        //echo $this->db->last_query();die;
        return $result;
    }
    
    function delete($id){
        //$upd['is_deleted'] = "1";
        $whr['id']=$id;
        $this->db->delete("cz_roles",$whr);
        //echo $this->db->last_query();die;
        if ($this->db->affected_rows() > 0) {
            $rt["status"] = "true";
        } else {
            $rt["status"] = "false";
        }
        return $rt;
    }
     /* ENDS of Edit and Delete Roles*/

}

//=========End Class==============//