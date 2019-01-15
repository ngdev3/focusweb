<?php

function pr($data = NULL) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function prd($data = NULL) {
    echo "<pre>";
    print_r($data);
    die;
}

function is_logged_in() {
    $CI = &get_instance();
    if (empty($CI->session->userdata('userinfo'))) {
        return false;
    }
    return true;
}

if (!function_exists('_invoicelayout')) {

    function _invoicelayout($data = null) {
        $CI = &get_instance();
        $res = $CI->session->userdata('userinfo');
        $data['userRes'] = getUserInfo($res['id']);
        $CI->load->view($data['page'], $data);
    }

}


if (!function_exists('_layout')) {

    function _layout($data = null) {
        $CI = &get_instance();
        $res = $CI->session->userdata('userinfo');
        // getUserInfo(($res->id));die;
        $data['userRes'] = getUserInfo($res->id);
        $CI->load->view('templates/layout', $data);
    }

}
if (!function_exists('getUserInfo')) {

    function getUserInfo($id = null) {
        $CI = &get_instance();
        $res = $CI->db->select("cu.*, CONCAT(fname,' ',lname) as fullname ", false)
                ->from("cz_users cu")
                ->where(array("id" => $id))
                ->get()
                ->row();
        //echo $CI->db->last_query();die;
        // pr($res);//die;
        return $res;
    }

}

if (!function_exists('getUserInfos')) {

    function getUserInfos($id = null) {
        $CI = &get_instance();
        $res = $CI->db->select("cu.*, CONCAT(fname,' ',lname) as fullname ", false)
                ->from("cz_users cu")
                ->where(array("id" => currUserId()))
                ->get()
                ->row();
        // echo $CI->db->last_query();//die;
       

        if($res->role =='7'){
            $res->role ='1';

        }
        //pr($res);//die;
        return $res;
    }

}


if (!function_exists('isPostBack')) {

    function isPostBack() {
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
            return true;
        else
            return false;
    }

}
/* user left menu hide show permission
  if (!function_exists('get_module_permission')) {

  function get_module_permission($control, $action = NULL) {

  $user_permission = getUserPermissions1();
  $module_id = getrec_arr('cz_permissions', 'id', array("controller" => $control));
  //pr($module_id['0']);echo $module_id['0']->id;die;
  if (array_key_exists(@$module_id['0']->id, $user_permission)) {
  if (!empty($action)) {
  if (!array_key_exists($action, $user_permission[$module_id['0']->id])) {
  return false;
  }
  }
  return true;
  }
  return false;
  }

  }

  function getUserPermissions1($id = "") {
  // echo "hello";die;
  $CI = & get_instance();
  $userData = getUserInfos(currUserId());
  //pr($userData12);die;
  $r1 = explode(',', $userData->role);
  //$r2 = array($userData->role);
  $user_extra_permission = $userData->user_extra_permission!=""?json_decode($userData->user_extra_permission):array();
  $user_removed_permission = $userData->user_removed_permission!=""?json_decode($userData->user_removed_permission):array();
  // pr($user_extra_permission);
  // pr($user_removed_permission);
  //$allowed_per=array_replace_recursive((array)$user_removed_permission, (array)$user_extra_permission);
  //pr($allowed_per);die;

  $role_ids = $r1;

  //    $result = $CI->db->select("cr.*")
  //            ->from("cz_roles cr")
  //            ->where(array("cr.status" => "1"))
  //            //->where_in("cr.id", $role_ids)
  //            ->where_in("cr.id", $role_ids)
  //            ->get()
  //            ->row();
  //
  $result = $CI->db->select("u.*,iur.role_name, iur.permission_ids as role_permissions")
  ->from("cz_users u")
  ->where(array("u.id" => currUserId()))
  ->join("cz_roles iur", "iur.id = u.role", "left")
  ->get()->row();

  //pr($result);die;
  //echo $CI->db->last_query();die;
  @$role_permission=$result->role_permissions!=""?json_decode($result->role_permissions):array();
  //pr($role_permission);

  $user_extra_permission = $result->user_extra_permission!=""?json_decode($result->user_extra_permission):array();
  //pr(@$user_extra_permission);

  $user_removed_permission = $result->user_removed_permission!=""?json_decode($result->user_removed_permission):array();
  //pr(@$user_removed_permission);  //die;
  $allowed_per=@array_replace_recursive((array)$role_permission, (array)$user_extra_permission);
  //pr($allowed_per); //die;

  $ass_permisison = arrayRecursiveDiff($allowed_per, (array)$user_removed_permission);

  //pr($ass_permisison);die;
  return $ass_permisison;

  //$tmpA = array();
  //pr($result);die;
  //    foreach ($result as $key => $value) {
  //        $per = !empty($value->permission_ids) ? json_decode($value->permission_ids, true) : array();
  //        // pr($per);
  //        $tmpA = array_replace_recursive($tmpA, $per);
  //        //$tmpA= $per;
  //    }
  //    //pr($tmpA); //die;
  //    return $tmpA;
  }

  function arrayRecursiveDiff($aArray1, $aArray2) {
  $aReturn = array();

  foreach ($aArray1 as $mKey => $mValue) {
  if (array_key_exists($mKey, $aArray2)) {
  if (is_array($mValue)) {
  $aRecursiveDiff = arrayRecursiveDiff($mValue, $aArray2[$mKey]);
  if (count($aRecursiveDiff)) { $aReturn[$mKey] = $aRecursiveDiff; }
  } else {
  if ($mValue != $aArray2[$mKey]) {
  $aReturn[$mKey] = $mValue;
  }
  }
  } else {
  $aReturn[$mKey] = $mValue;
  }
  }
  return $aReturn;
  }

 */

function getUserPermissions() {
    $CI = &get_instance();
    $result = $CI->db->select("cu.id as id, 
            cu.user_extra_permission, 
            cu.user_removed_permission,  
            cr.role_name, 
            cr.permission_ids as role_permissions
            ")
            ->from("cz_users cu")
            ->join("cz_roles cr", "cr.id = cu.role", "left")
            ->where(array("cu.id" => currUserId()))
            ->get()
            ->row();

//    echo $CI->db->last_query(); die;
    return $result;
}

function has_permission($controller, $action) {
    $CI = &get_instance();
    $data = $CI->db->select("*")
            ->from("cz_permissions")
            ->where(array("controller" => $controller, "status" => '1'))
            ->get()
            ->row();
    $perm_id = @$data->id;
    $data = getUserPermissions();

    $role_permissions = (array) json_decode($data->role_permissions, true);
    $user_extra_permission = (array) json_decode(@$data->user_extra_permission, true);
    $user_removed_permission = (array) json_decode(@$data->user_removed_permission, true);
    $totalPermission = $role_permissions + $user_extra_permission;
    $perA = array();
    //pr($perA);die;
    foreach ($totalPermission as $k => $v) {
        if (array_key_exists($k, $role_permissions)) {
            $uep = empty($user_extra_permission[$k]) ? array() : $user_extra_permission[$k];
            $rp = empty($role_permissions[$k]) ? array() : $role_permissions[$k];
            $result1 = array_merge($uep, $rp);
            if (array_key_exists($k, $user_removed_permission)) {
                $result1 = array_values(array_diff($result1, $user_removed_permission[$k]));
            }
            $perA[$k] = $result1;
        }

        if (!array_key_exists($k, $role_permissions)) {
            $perA[$k] = $user_extra_permission[$k];
        }
    }
    //pr($perA);//die;
    $perKeys_new = $perA;
    $perM = array();
    if (!empty($perKeys_new)) {
        if (array_key_exists($perm_id, $perKeys_new)) {
            $per_user_action_ids = $perKeys_new[$perm_id];
            switch ($action) {
                case "list_items": $per_action_ids = "1";
                    break;
                case "add": $per_action_ids = "2";
                    break;
                case "edit": $per_action_ids = "3";
                    break;
                case "delete": $per_action_ids = "4";
                    break;
                default : $per_action_ids = "";
                    break;
            }
            if (!in_array($per_action_ids, $per_user_action_ids)) {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
    return true;
}

if (!function_exists('currUserId')) {

    function currUserId() {
        $CI = &get_instance();
        return $CI->session->userdata["userinfo"]['id'];
    }

}

function getDataByTable($table) {
    $CI = &get_instance();
    $res = $CI->db->select("*")
                    ->from($table)
                    ->where(array("status" => "1"))
                    ->get()->result();
    return $res;
}

function encode($data) {
    $res = base64_encode($data);
    return $res;
}

function decode($data) {
    $res = base64_decode($data);
    return $res;
}

function current_datetime() {
    $res = date('Y-m-d h:i:s');
    return $res;
}

function get_where($table, $where = NULL, $order = NULL, $column = NULL) {
    $CI = &get_instance();
    $CI->db->select("*")->from($table);
    if (!empty($where)) {
        $CI->db->where($where);
    }
    if (!empty($order) && !empty($column)) {
        $CI->db->order_by($column, $order);
    }
    $res = $CI->db->get()->result();
    return $res;
}

if (!function_exists('ID_encode')) {

    function ID_encode($id) {
        $encode_id = '';
        if ($id) {
            $encode_id = rand(1111, 9999) . (($id + 19)) . rand(1111, 9999);
        } else {
            $encode_id = '';
        }
//        echo $encode_id; die;
        return $encode_id;
    }

}
/* End of function */

/**
 * Id_decode
 *
 * This function to decode ID by a custom number
 * @param string
 * 	
 */
if (!function_exists('ID_decode')) {

    function ID_decode($encoded_id) {
        $id = '';
        if ($encoded_id) {
            $id = substr($encoded_id, 4, strlen($encoded_id) - 8);
            $id = $id - 19;
        } else {
            $id = '';
        }
        return $id;
    }

}

function getcountry($whr = null) {
    $CI = &get_instance();
    $CI->db->select('id,country_name,country_code');
    if (!$whr) {
        $CI->db->where("status", '1');
    }

    if ($whr) {
        $CI->db->where("id", $whr);
    }

    $coun_res = $CI->db->get("cz_countries")->result();
    //pr($coun_res);die;
    return $coun_res;
}

function getcolumn_name($table = null, $column_name = "", $whr = null) {
    $CI = &get_instance();
    $select = ($column_name != "") ? $column_name : '*';
    $CI->db->select($select);
    if ($whr != '') {
        $CI->db->where("id", $whr);
        $CI->db->where(array('id !=' => '0'));
        $CI->db->where(array('id !=' => ''));
    }


    $column_name = $CI->db->get($table)->result();
    //echo $CI->db->last_query();die;
    // pr($column_name);die;
    return $column_name;
}

function getrec_arr($table = null, $column_name = "", $whr = array()) {
    $CI = &get_instance();
    $select = ($column_name != "") ? $column_name : '*';
    $CI->db->select($select);
    if (!empty($whr)) {
        $CI->db->where($whr);
    }


    $column_name = $CI->db->get($table)->result();

    // pr($column_name);die;
    return $column_name;
}

// ------------------------------------------------------------------------
/**
 * array_to_csv
 *
 * function array_to_csv
 * 
 * @access	public
 */
function array_to_csv($array, $download = "") {
    if ($download != "") {
        header('Content-Type: application/csv');
        header('Content-Disposition: attachement; filename="' . $download . '"');
    }
    ob_start();
    $f = fopen('php://output', 'w') or show_error("Can't open php://output");
    $n = 0;
    foreach ($array as $line) {
        $n++;
        if (!fputcsv($f, $line)) {
            show_error("Can't write line $n: $line");
        }
    }
    fclose($f) or show_error("Can't close php://output");
    $str = ob_get_contents();
    ob_end_clean();
    if ($download == "") {
        return $str;
    } else {
        echo $str;
    }
}

// ------------------------------------------------------------------------
/**
 * csv_to_array
 *
 * function csv_to_array
 * 
 * @access	public
 */
function csv_to_array($filename = '', $delimiter = ',') {

    if (!file_exists($filename) || !is_readable($filename))
        return false;
    $header = null;
    $data = array();
    $i = 0;
    if (($handle = fopen($filename, 'r')) !== false) {
        while (($row = fgetcsv($handle, '', $delimiter)) !== false) {

            ++$i;
            /* if($i==1 || $i==2 ||$i==3 || $i==4||$i==5){  //code used for ignoringthe top lines of
              continue;
              } */
            if (!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    unlink($filename);
    return $data;
}

function sendMail($to = "", $subject = "", $body = "", $attach = false) {
    $CI = &get_instance();
    $CI->email->initialize();
    if ($attach != '') {
        $CI->email->attach($attach, $disposition = 'attachment', 'invoice.pdf', 'application/pdf');
    }

    $CI->email->set_newline("\r\n");
    $CI->email->from('tekshapers.testing@gmail.com', 'Pioneer');
    $CI->email->to($to);
    $CI->email->subject($subject);
    $CI->email->message($body);



    if ($CI->email->send()) {

        $rt['status'] = "true";
        //$CI->email->clear(TRUE); 
    } else {


        $rt['status'] = "false";
        $rt['msg'] = "Mail not sent";
    }
    return $rt;
}

function activity_logs($module = "", $action = "", $description = "") {
    $CI = &get_instance();
    $data = array(
        'module' => $module,
        'action' => $action,
        'description' => $description,
        'added_date' => date('Y-m-d h:i:s'),
        'added_by' => currUserId(),
    );
    return $CI->db->insert('cz_logs', $data);
}
function activity_logs_app($module = "", $action = "", $description = "" , $id = "") {
    $CI = &get_instance();
    $data = array(
        'module' => $module,
        'action' => $action,
        'description' => $description,
        'added_date' => date('Y-m-d h:i:s'),
        'added_by' => $id,
    );
    return $CI->db->insert('cz_logs', $data);
}

function get_rfq_completed($rfq_id = "") {
    $CI = &get_instance();
    $res = $CI->db->select("csm.*")
            ->from("cz_survey_manager csm")
            ->where("csm.rfq_id", $rfq_id)
            ->where("csm.completed", '1')
            ->get()
            ->result();
    return $res;
}

function get_rfq_status($rfq_id = "") {
    $CI = &get_instance();
    $res = $CI->db->select("cn.status")
            ->from("cz_nomination cn")
            ->where("cn.rfq_id", $rfq_id)
            ->get()
            ->result();
    //pr($res);die;
    //echo $CI->db->last_query();die;
// pr(C);die;
    foreach ($res as $row) {
        if (in_array($row->status, array('1', '2', '4'))) {
            return false;
            exit;
        }
    }
    return true;
}

function check_rfq($rfq_id = "") {
    $CI = &get_instance();
    $res = $CI->db->select("csm.rfq_id")
            ->from("cz_survey_manager csm")
            ->where("csm.rfq_id", $rfq_id)
            ->get()
            ->row();
    //pr($res);die;
    //echo $CI->db->last_query();die; 
    if (!empty($res)) {

        return FALSE;
    }
    return TRUE;
}



function check_lead_assigned($lead_id = "") {
    $CI = &get_instance();
    $res = $CI->db->select("pl.lead_id")
            ->from("pr_assign_lead_sales pl")
            ->where("pl.lead_id", $lead_id)
            ->get()
            ->row();
    //pr($res);die;
    //echo $CI->db->last_query();die; 
    if (!empty($res)) {

        return FALSE;
    }
    return TRUE;
}
// check complaint assigned or not 02-01-2019
function check_complaint_assigned($complaint_id = "") {
    $CI = &get_instance();
    $res = $CI->db->select("pl.complaint_id")
            ->from("pr_complaint_assign pl")
            ->where("pl.complaint_id", $complaint_id)
            ->get()
            ->row();
    //pr($res);die;
    //echo $CI->db->last_query();die; 
    if (!empty($res)) {

        return FALSE;
    }
    return TRUE;
}




/*********************************Get total Cordinator********************/


function get_total_cordinator($id) {
    if (!empty($id)) {
        $CI = &get_instance();
        $result = $CI->db->select('count(id) as total_cordinator, ');
        $CI->db->where('manager_id', $id);
        $CI->db->where('status', "1");
        $CI->db->where('is_deleted', "0");
         $CI->db->where("(role='3' OR role='4')");
        $result = $CI->db->get("cz_users")->row();
        
       // echo $CI->db->last_query();die;
        //pr($result);die;
        return $result->total_cordinator;
    }
}
function get_total_salesPerson($id) {
    if (!empty($id)) {
        $CI = &get_instance();
        $result = $CI->db->select('count(id) as total_salesperson');
        $CI->db->where('cordinator_id', $id);
        $CI->db->where('status', "1");
        $CI->db->where('is_deleted', "0");
        $CI->db->where('role', "5");
         //$CI->db->where("(role='3' OR role='4')");
        $result = $CI->db->get("cz_users")->row();
        
       // echo $CI->db->last_query();die;
        //pr($result);die;
        return $result->total_salesperson;
    }
}

function get_total_servicePerson($id) {
    if (!empty($id)) {
        $CI = &get_instance();
        $result = $CI->db->select('count(id) as total_serviceperson');
        $CI->db->where('cordinator_id', $id);
        $CI->db->where('status', "1");
        $CI->db->where('is_deleted', "0");
        $CI->db->where('role', "6");
         //$CI->db->where("(role='3' OR role='4')");
        $result = $CI->db->get("cz_users")->row();
        
       // echo $CI->db->last_query();die;
       //pr($result);die;
        return $result->total_serviceperson;
    }
}    


function get_where_count($table, $where=NULL ,$column=NULL) {
    $CI = &get_instance();
    $CI->db->select("*")->from($table);
    if (!empty($where)) {

        $CI->db->where($column,$where);
        $CI->db->where("is_deleted=","0");

    }
   
    $res = $CI->db->get()->result();
    return count($res);
}

function is_send_quote($table, $id) {
    if($table=="pr_sales_quote_details")
    {
        $check_id="sales_quote_id";
        $get_name="q.id";
    }
    if($table=="pr_service_quote_details")
    {
        $check_id="service_quote_id";
        $get_name="q.id";
    }
    $CI = &get_instance();
    $CI->db->select("$get_name");
  
    $CI->db->from("$table q");
    $CI->db->where("FIND_IN_SET( '$id' ,q.$check_id) ");
    $CI->db->where("q.status", '1');
    $CI->db->where("q.is_deleted", '0');  
    $class_name = $CI->db->get()->result();
    //pr($class_name);
   
    if(!empty($class_name))
    {
        return true;
    }else{
        return false;
    }
   
}

?>