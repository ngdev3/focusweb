<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function start() {
        echo "dashboard model";
        die;
    }

    function get_total_users() {

        $this->db->select('id');
        $this->db->from('users u');
        $num_results['all_user'] = $this->db->count_all_results();

        $this->db->select('*');
        $this->db->where('user_type','3');
        $this->db->from('users u');
        $num_results['all_coaches'] = $this->db->count_all_results();

        
        $this->db->select('*');
        $this->db->where('is_member','1');
        $this->db->from('users u');

        $num_results['total_paid_member'] = $this->db->count_all_results();
        
        $this->db->select('*');
        $this->db->from('f_queries');
        $num_results['total_queries'] = $this->db->count_all_results();
// pr($num_results['total_queries']); die;
        return $num_results;
    }

    function get_total_nomination() {

        $this->db->select('cn.id');
        $this->db->from('cz_nomination cn');
        if (currUserId() != '1') {
            $this->db->where(array("cn.is_deleted" => "0", "cn.status!=" => "1", "cn.attending_surveyor_id" => currUserId()));
        } else {
            $this->db->where(array("cn.is_deleted" => "0"));
        }
        $num_results = $this->db->count_all_results();
        return $num_results;
    }

    function get_total_invoice() {
        $this->db->select('cainv.id');
        $this->db->from('cz_account_invoice cainv');

        $this->db->where(array("cainv.is_deleted" => "0"));
        //echo $this->db->last_query();die;
        $num_results = $this->db->count_all_results();
        return $num_results;
    }

    //Dated 7/2/2017
    function get_total_unpaid_invoice() {
        $this->db->select('cac.id');
        $this->db->from('cz_accounts cac');

        $this->db->where(array("cac.status" => "unpaid"));
       
        $num_results = $this->db->count_all_results();
         //echo $this->db->last_query();die;
        return $num_results;
    }
     function get_total_overdue_invoice() {
        $this->db->select('cac.id');
        $this->db->from('cz_accounts cac');

        $this->db->where(array("cac.status" => "overdue"));
       
        $num_results = $this->db->count_all_results();
         //echo $this->db->last_query();die;
        return $num_results;
    }
    function get_total_paid_invoice() {
        $this->db->select('cac.id');
        $this->db->from('cz_accounts cac');

        $this->db->where(array("cac.status" => "paid"));
       
        $num_results = $this->db->count_all_results();
         //echo $this->db->last_query();die;
        return $num_results;
    }
    
    function get_total_earning_invoice() {

        $this->db->select('SUM(cac.net_earning) AS amount', FALSE);
        $this->db->where(array("cac.status" => "paid"));
        $this->db->or_where(array("cac.status" => "overdue"));
        $this->db->or_where(array("cac.status" => "unpaid"));
        $qwer = $this->db->get('cz_accounts cac')->result();
        return $qwer[0];
       // echo $this->db->last_query();die;
    }
    
    function get_total_open_job() {
        $this->db->select('csm.id');
        $this->db->from('cz_survey_manager csm');
        $this->db->where(array("csm.completed" => "0","csm.is_deleted" => "0"));
        $num_results = $this->db->count_all_results();
        //echo $this->db->last_query();die;
        return $num_results;
    }
    
    

}

?>
