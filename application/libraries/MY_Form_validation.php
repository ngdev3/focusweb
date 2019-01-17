<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    public $CI;
    public $cvErrors;

    function __construct($rules = array()) {
        parent::__construct($rules);
        $this->CI = & get_instance();
    }

    function cvErrors() {
        return $this->CI->form_validation->_error_array;
    }

    function doLoginemail() {
        $res = $this->CI->db->select("*")
                        ->from("users")
          //              ->where(array("email" => $_POST['username']))
                        ->where(array("email" => $_POST['username']))
                        ->get()->row();
//         echo $this->CI->db->last_query(); die;
        if (empty($res)) {
            $this->CI->form_validation->set_message('doLoginemail', "The Email Id is InCorrect.");
            return FALSE;
        }
       
        return true;
    }

    function doLogin() {
        $res = $this->CI->db->select("*")
                        ->from("users")
                        ->where(array("email" => $_POST['username'],"password" => md5($_POST['password'])))
                        ->get()->row();
                      
        if (empty($res)) {

            $this->CI->form_validation->set_message('doLogin', "The Password is Incorrect.");
            return FALSE;
        }else if($res->user_type !== "1"){

            $this->CI->form_validation->set_message('doLogin', "You are not authorized to login");
            return FALSE;
        }
        else if($res->status == "delete")
        {
            $this->CI->form_validation->set_message('doLogin', "The Account does not exist.");
            return FALSE;
        }else if($res->status == "inactive")
        {
            $this->CI->form_validation->set_message('doLogin', "The Account is Inactive.");
            return FALSE;
        }else{

        $this->CI->session->set_userdata("userinfo", $res);
        return true;
        }
    }

    function mail_exist() {
        $res = $this->CI->db->select("*")
                        ->from("users")
                        ->where(array("email" => $_POST['email']))
                        ->get()->row();
        if (empty($res)) {
            $this->CI->form_validation->set_message('mail_exist', "The Email Id does not Exist.");
            return FALSE;
        }
    }

    function checkCurrentPassword() {
        $res = $this->CI->db->select("*")
                        ->from("users")
                        ->where(array("cpassword" => $_POST['current_password'], "id" => currUserId()))
                        ->get()->row();
//         echo $this->CI->db->last_query(); die;
        if (empty($res)) {
            $this->CI->form_validation->set_message('checkCurrentPassword', "The Current Password is wrong.");
            return FALSE;
        }
        return TRUE;
    }

    public function is_unique_edit($str, $field) {
       // $id = ID_decode($this->CI->uri->segment('4'));
        $id_val = @end($this->CI->uri->segment_array());
        $id = ID_decode($id_val);
        sscanf($field, '%[^.].%[^.]', $table, $field);
        $res = $this->CI->db->limit(1)->get_where($table, array($field => $str))->row();    
        if ($res->id != $id && !empty($res)) {
            $this->CI->form_validation->set_message('is_unique_edit', "The %s field must contain a unique value.");
            return FALSE;
        }
        return TRUE;
		//echo $this->CI->db->last_query(); die;
    }		

}