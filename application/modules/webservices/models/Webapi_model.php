<?php

class Webapi_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /* ---------------------------------------------- login --------------------------------------------------- */

    public function login($email) {
        $this->db->select("cu.*");
        $this->db->from("users cu");
        $this->db->where('cu.email', $email);
        $res = $this->db->get()->row();


        return $res;
    }

    /* ---------------------------------------------- login closed --------------------------------------------------- */



    /* ------------------------------------------- Change Password ----------------------------------------------- */

    public function change_pwd($data, $id = '') {
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->update('users', $data);
        }
    }

    /* ------------------------------------------- Change Password closed ------------------------------------------- */

//---------------------------------- checking email existence in database -------------------------------------//



    public function check_email($email) {

        $this->db->where("email", $email);
        $this->db->from("users cu");
        $res = $this->db->get()->row();
        return $res;
    }

    /* ------------------------------------ checking email existence closed ---------------------------------------- */

//----------------------------------Updating password and sending mail----------------------------------------//




    public function update_password($a, $gotemail) {
        $gotpassword = array("password" => md5($a),
            
        );
        if ($a && $gotemail) {
            $this->db->where('email', $gotemail);
            $this->db->update('users', $gotpassword);
            //Sending Mail to user

            $subject = 'Forgot Password';
            $email_data['cpassword'] = $a;
            $email_data['email'] = $gotemail;
            $body = $this->load->view("email_template/admin/forget_password_apikey", array("data" => $email_data), true);

            sendMail($gotemail, $subject, $body);
        }
    }

//------------------------------Updating password and sending mail Closed---------------------------------//



    /* -------------------------------------Registration---------------------------------------------------- */




    function add() {
        // pr($_POST); die;
        extract($_POST);
        $ins['fname'] = $fname;
        $ins['lname'] = $lname;
        $ins['email'] = $email;
        $ins['mobile_no'] = $mobile_number;
        $ins['user_type'] = '2';
        $ins['login_token'] = $device_token;
        // $ins['login_from'] = $device_type;
        $ins['added_date'] = current_datetime();
        $ins['password'] = md5($password);
        $ins['status'] = 'active';
        $this->db->insert("users", $ins);
        $insert_id = $this->db->insert_id();
        
        
        $mail['email'] = $email;
        $mail['cpassword'] = $password;
        $subject = "Registration";
        $body = $this->load->view("email_template/admin/registration", array("data" => $mail), true);
        sendMail($ins['email'], $subject, $body);
        //Sending Mail to user
        return $insert_id;
    }

    /* --------------------------------------Registration Closed--------------------------------------------- */



    /* ----------------------------------User Profile View------------------------------------------------- */

    function profile_get($id) {
        $this->db->select('cu.*,sc.class_name,ss.section_name');
        $this->db->join("sr_class sc", "cu.class_id=sc.id", 'left');
        $this->db->join("sr_section ss", "cu.section_id=ss.id", 'left');
        $this->db->where('cu.id', $id);
        $this->db->from('users cu');

        $query = $this->db->get()->result();
        return $query;
    }

    /* -------------------------------User Profile View Closed--------------------------------------------- */



    /* -------------------------------Edit User Profile---------------------------------------------------- */

    public function edit($id) {

        extract($_POST);
        $ins['fname'] = $fname;
        $ins['lname'] = $lname;
        if ($_POST['image']) {
            $ins['image'] = $image;
        }

        $ins['father_mobile'] = $father_mobile;
        $ins['mother_mobile'] = $mother_mobile;
        $ins['class_id'] = $class_id;
        $ins['section_id'] = $section_id;
        $ins['updated_date'] = current_datetime();
        $whr['id'] = $id;
        $this->db->update("users", $ins, $whr);
    }

    /* ---------------------------------------Edit User Profile Closed---------------------------------------------- */




    /* -----------------------------------------------Get Class--------------------------------------------------- */

    public function get_color() {
        $this->db->where('sc.status', 'active');
        $query = $this->db->get('f_color_schemes sc')->result();
        return $query;
    }

    /* -----------------------------------------------Get Class Closed--------------------------------------------- */

    
    /* -----------------------------------------------Get Class--------------------------------------------------- */

    public function class_details($id) {
        //$this->db->where('sc.status', '1');
        //$this->db->where('sc.is_deleted', '0');
        $this->db->where('sc.id', $id);

        $query = $this->db->select('sc.class_name')->get('sr_class sc')->row();
        return $query;
    }

    /* -----------------------------------------------Get Class Closed--------------------------------------------- */

    
    
    
    
    /* -----------------------------------------------Get Section--------------------------------------------------- */

    public function section_view() {
        $this->db->where('ss.status', '1');
        $this->db->where('ss.is_deleted', '0');

        $query = $this->db->get('sr_section ss')->result();
        return $query;
    }

    /* -----------------------------------------------Get Section Closed--------------------------------------------- */

    /* -----------------------------------------------Get Subject--------------------------------------------------- */

    public function subject_view() {

        $this->db->select("sb.*");
        $this->db->where('sb.status', '1');
        $this->db->where('sb.is_deleted', '0');

        $this->db->from("sr_subject sb");

        $query = $this->db->get()->result();
        return $query;
    }

    /* -----------------------------------------------Get Subject Closed--------------------------------------------- */

    /* -----------------------------------------------Get Chapter--------------------------------------------------- */

    public function chapter_view() {

        $this->db->select("sb.*,sc.class_name,ssc.section_name,sbb.subject_name,sss.chapter_name");
        $this->db->where('sb.status', '1');
        $this->db->where('sb.is_deleted', '0');
        $this->db->join("sr_class sc", "sb.class_id=sc.id", "left");
        $this->db->join("sr_section ssc", "sb.section_id=ssc.id", "left");
        $this->db->join("sr_subject sbb", "sb.subject_id=sbb.id", "left");
        $this->db->join("sr_chapter_detail sss", "sb.id=sss.chapter_id", "left");

        $this->db->from("sr_chapter sb");

        $query = $this->db->get()->result();
        return $query;
    }

    /* -----------------------------------------------Get Chapter Closed--------------------------------------------- */



    /* -----------------------------------------------Get Topic--------------------------------------------------- */

    public function topic_view() {

        $this->db->select("sb.*,sc.class_name,ssc.section_name,sbb.subject_name,sss.chapter_name,sst.topic_name,sst.video_name");
        $this->db->where('sb.status', '1');
        $this->db->where('sb.is_deleted', '0');
        $this->db->join("sr_class sc", "sb.class_id=sc.id", "left");
        $this->db->join("sr_section ssc", "sb.section_id=ssc.id", "left");
        $this->db->join("sr_subject sbb", "sb.subject_id=sbb.id", "left");

        $this->db->join("sr_chapter_detail sss", "sb.id=sss.chapter_id", "left");
        $this->db->join("sr_topic_detail sst", "sb.id=sst.topic_id", "left");


        $this->db->from("sr_topic sb");

        $query = $this->db->get()->result();
        return $query;
    }

    /* -----------------------------------------------Get Topic Closed--------------------------------------------- */

    /* --------------------------------------------Get Subject From id------------------------------------------------- */

//    public function getdata($id) {
//        $this->db->select('cu.id,cu.fname,ss.subject_name,ss.id as subject_id');
//        $this->db->where("cu.id", $id);
//        $this->db->where('cu.status', '1');
//        $this->db->where('cu.is_deleted', '0');
//        $this->db->where_in("role", ['1', '2']);
//        $this->db->from("users cu");
//        $this->db->join("sr_subject ss", 'cu.class_id=ss.class_id');
//        $res = $this->db->get()->result();
//
//        return $res;
//    }
    
    
     public function student_subject($class_id, $section_id) {
        $this->db->select('cp.*,s.subject_name');
  
        $this->db->where("cp.class_id", $class_id);
        $this->db->where('cp.status','1');
        $this->db->where('cp.is_deleted', '0');
        $this->db->group_by('cp.subject_id');
        $this->db->where("FIND_IN_SET( '$section_id' , cp.section_id) ");
        $this->db->join("sr_subject s", "cp.subject_id = s.id", "left");
        $this->db->from("sr_chapter cp");
        $res = $this->db->get()->result();
        
        //echo $this->db->last_query();die;
        return $res;
    }

    /* ---------------------------------------Get Subject From id Closed--------------------------------------------- */



    /* --------------------------------------------Get Chapter From subject id------------------------------------------------- */

    public function getchapter($class_id, $subject_id, $section_id) {
        $this->db->select('sc.subject_id,sc.class_id,sc.section_id,scd.chapter_name,scd.chapter_id');
        $this->db->where("sc.class_id", $class_id);
        $this->db->where("sc.subject_id", $subject_id);
        //$this->db->where("sc.section_id",$section_id);
        $this->db->where('sc.status', '1');
        $this->db->where('sc.is_deleted', '0');
        $this->db->where("FIND_IN_SET( '$section_id' , sc.section_id) ");


        $this->db->from("sr_chapter sc");
        $this->db->join("sr_chapter_detail scd", 'sc.id=scd.chapter_id');
        $res = $this->db->get()->result();
        //echo $this->db->last_query();die;
        
        return $res;
    }

    public function get_assessment_list($class_id,$subject_id,$section_id,$chapter_id)
    {
       
        $this->db->select('qm.id,qm.quiz_title,qm.quiz_type,qm.quiz_topic');
        $this->db->where("qm.quiz_class_id", $class_id);
        $this->db->where("qm.quiz_subject_id", $subject_id);
        
        $this->db->where('qm.is_deleted', '0');
        $this->db->where('qm.quiz_type', '2');
        $this->db->where("FIND_IN_SET( '$section_id' , qm.quiz_section_id) ");
        $this->db->where("FIND_IN_SET( '$chapter_id' , qm.quiz_chapter_id) ");
        $this->db->from("quiz_master qm");
        $res = $this->db->get()->result();
        //echo $this->db->last_query();die;
        
        return $res;
    }

    
    
    public function get_chapters_name($subject_id,$class_id,$section_id)
{
 
 
    $sql = $this->db->select("s.*,sd.chapter_name", FALSE);
    $sql=$this->db->from('sr_chapter s');
    $sql->join("sr_chapter_detail sd", "s.id = sd.chapter_id", "left");
    $sql->join("sr_subject f", "s.subject_id = f.id", "left");
    $sql->where("s.class_id", $class_id);
    $sql->where("s.subject_id",$subject_id);
    $sql->where("s.is_deleted=", "0");
    $sql->where("s.status=", "1");
    $sql->where("FIND_IN_SET( '$section_id' , s.section_id)"); 
    
    $result = $sql->get()->result();
    //pr($result);
 //echo $this->db->last_query();die;
    return $result;

}
    /* ---------------------------------------Get Chapter From subject id Closed--------------------------------------------- */

    /* --------------------------------------------Get Topics From Chapters id------------------------------------------------- */



    /* public function get_topics($class_id,$subject_id,$chapter_id)
      {
      $this->db->select('st.chapter_id,st.class_id,st.subject_id,std.video_name,std.topic_name,std.topic_id');
      $this->db->where("st.class_id",$class_id);
      $this->db->where("st.subject_id",$subject_id);
      $this->db->where("st.chapter_id",$chapter_id);

      $this->db->from("sr_topic st");
      $this->db->join("sr_topic_detail std",'st.id=std.topic_id');
      $res = $this->db->get()->result();
      return $res;


      } */



    /* --------------------------------------Get Topics From Chapters id--------------------------------------------- */


    /* --------------------------------------------Get Topic From chapter id------------------------------------------------- */

    public function gettopic($class_id, $subject_id, $section_id, $chapter_id) {
		
		//echo $chapter_id;die;
		
		
        //$this->db->select('std.topic_name,std.topic_id,std.video_name,std.video_url');
        $this->db->select('std.topic_name,std.topic_id');
        $this->db->where("st.class_id", $class_id);
        $this->db->where("st.subject_id", $subject_id);
        $this->db->where("st.chapter_id", $chapter_id);
        $this->db->where('st.status', '1');
        $this->db->where('st.is_deleted', '0');
        $this->db->where("FIND_IN_SET( '$section_id' , st.section_id) ");


        $this->db->from("sr_topic st");
        $this->db->join("sr_topic_detail std", 'st.id=std.topic_id');
        $res = $this->db->get()->result();
		//echo $this->db->last_query();die;
		
        return $res;
    }

    /* ---------------------------------------Get Topic From chapter id Closed--------------------------------------------- */



    /* --------------------------------------------Get Page from id------------------------------------------------- */

    public function getpage($id) {
        $this->db->select('*');
        $this->db->where("sp.id", $id);
        $this->db->where('sp.status', '1');
        $this->db->where('sp.is_deleted', '0');
        $this->db->from("sr_pages sp");

        $res = $this->db->get()->result();
        return $res;
    }

    /* ---------------------------------------Get Page from id Closed--------------------------------------------- */


    /* -------------------------------Edit User Profile---------------------------------------------------- */

    public function profilepic($dataInfo) {
        extract($_POST); 
        $this->db->select('*');
        $this->db->from('f_temp_image_upload');
        $this->db->where('added_by',$user_id);
        $count = $this->db->get()->num_rows();
        if($count < 11){
            echo "dddd";
            pr($dataInfo);
            die;
            $prof = $this->db->insert_batch("f_temp_image_upload", $dataInfo);
            return $prof;
        }else{
            return 0;
        }
    }

    public function upload_banner_image()
    {
        $this->db->where('added_by',$_POST['user_id']);
        $this->db->where('uuid',$_POST['uuid']);
        $this->db->where('created_date',current_date());
        $req = $this->db->get('f_temp_image_upload')->num_rows();
            if($req <= 9){

                $this->load->library('upload');
                $asd = $_FILES['file'];
                $path = $_FILES['file']['name'];
                $name = md5(time());
                $file_name = $_FILES['file']['name'];
                $_FILES['file']['name'] = $file_name;
                $imageconfig['upload_path'] = 'uploads/temp_upload_images';
                $imageconfig['allowed_types'] = 'jpg|jpeg|png|gif';
                $imageconfig['encrypt_name'] = TRUE;
                $this->upload->initialize($imageconfig);
                if (!$this->upload->do_upload('file')) {
                    $result['msg'] = $this->upload->display_errors();
                    $result['status'] = 'error';
                } else {
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];
                $data = $this->upload->data();
                $full_name = $file_name;
                $upd['file_name'] = $full_name;
                $upd['added_by'] = $_POST['user_id'];
                $upd['uuid'] = $_POST['uuid'];
                $upd['status'] = 'active';
                $upd['created_date'] = current_datetime();
                $this->db->insert('f_temp_image_upload',$upd);
                $result['result'] = $file_name;
                $result['status'] = 'success';
                $result['row'] = $req + 1;
                $result['msg'] = 'File Uploaded Successfully';
            }
            
            }else{
                $result['result'] = $file_name;
                $result['status'] = 'error';
                $result['msg'] = 'Already 10 Images Uploaded';
            }
        return $result;

    }

    public function upload_profile()
    {

        $this->load->library('upload');

        $asd = $_FILES['file'];
        $path = $_FILES['file']['name'];
        $name = md5(time());
        $file_name = $_FILES['file']['name'];
        $_FILES['file']['name'] = $file_name;

        $imageconfig['upload_path'] = 'uploads/profile_image';
        $imageconfig['allowed_types'] = 'jpg|jpeg|png|gif';
        $imageconfig['encrypt_name'] = TRUE;

        $this->upload->initialize($imageconfig);

        if (!$this->upload->do_upload('file')) {
            $result['msg'] = $this->upload->display_errors();
            $result['status'] = 'error';
        } else {
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            $upd['profile_image'] = $file_name . $data['file_ext'];

            $this->db->where('id',$_POST['user_id']);
            $this->db->update('users',$upd);

            $result['result'] = base_url('uploads/profile_image/'.$file_name . $data['file_ext']);
            $result['status'] = 'success';
            $result['msg'] = 'File Uploaded Successfully';

        }
        return $result;
    }

    
    public function category($type)
    {
        $res = $this->db->select("*")
                 ->where("status",'active')
                 ->where("type",$type)
                ->from("f_coach_category")
                ->get();
               // pr($res);die;
        return $res->result();
    }

    public function cms_profile()
    { 
         extract($_POST); 
        $res = $this->db->select("*")
                 ->where("status",'active')
                 ->where("cms_id",$cms_id)
                ->from("f_cms")
                ->get();
               // pr($res);die;
        return $res->row();
    }


    public function get_self_mastery($dataInfo) {
        extract($_POST); 

        if($typeofgoal == 'content'){
            $type = 1;
            $this->db->select('ss.*, cc.title as cc_title, cc.id as cc_id');
            $this->db->from('f_self_mastery ss');
            $this->db->join('f_coach_category as cc','cc.id = ss.category','left');
            $this->db->where('ss.status','active');
            $this->db->where('ss.type',$type);
            $this->db->where('ss.added_by','1');
            $count = $this->db->get()->result();
            foreach($count as $key => $val){
                if($val->cc_id == 1){
                    $data['first'][] = $val;
                }else if($val->cc_id == 2){
                    $data['second'][] = $val;
                }else if($val->cc_id == 3){
                    $data['third'][] = $val;
                }else if($val->cc_id == 4){
                    $data['fourth'][] = $val;
                }
    
                
            }
            $data['cat'] = $this->category('1');
        }else if($typeofgoal == 'video'){
            $type = 2;
            $this->db->select('ss.*');
            $this->db->from('f_self_mastery ss');
            $this->db->where('ss.status','active');
            $this->db->where('ss.type',$type);
            $this->db->where('ss.added_by','1');
            $data = $this->db->get()->result();

        }else{
            return;
        }
       
       // pr($count ); die;
        return $data;
        
    }
    public function get_business($dataInfo) {
        extract($_POST); 

        if($typeofgoal == 'content'){
            $type = 1;
            $this->db->select('fl.*, cc.title as cc_title, cc.id as cc_id');
            $this->db->from('f_leadership fl');
            $this->db->join('f_coach_category as cc','cc.id = fl.category','left');
            $this->db->where('fl.type',$type);
            $this->db->where('fl.status','active');
            $this->db->where('fl.added_by','1');
            $count = $this->db->get()->result();
            foreach($count as $key => $val){
                if($val->cc_id == 5){
                    $data['first'][] = $val;
                }else if($val->cc_id == 6){
                    $data['second'][] = $val;
                }else if($val->cc_id == 7){
                    $data['third'][] = $val;
                }else if($val->cc_id == 8){
                    $data['fourth'][] = $val;
                }
    
                
            }
            $data['cat'] = $this->category('2');
        }else if($typeofgoal == 'video'){
            $type = 2;
            $this->db->select('fl.*');
            $this->db->from('f_leadership fl');
            $this->db->where('fl.type',$type);
            $this->db->where('fl.status','active');
            $this->db->where('fl.added_by','1');
            $data = $this->db->get()->result();
            
        }else{
            return;
        }

       
    //    pr($count ); die;
        return $data;
        
    }

    public function get_master_class($dataInfo) {
        extract($_POST); 

       
        $this->db->select('*');
        $this->db->from('f_master_class');
        $this->db->where('status','active');
        $this->db->where('added_by','1');
        $count = $this->db->get()->result();
        return $count;
        
    }
    public function f_coaches_center($dataInfo) {
        extract($_POST); 

       
        $this->db->select('*');
        $this->db->from('f_coaches_center');
        $this->db->where('status','active');
        $this->db->where('added_by','1');
        $count = $this->db->get()->result();
        return $count;
        
    }

    public function f_morning_focus($dataInfo) {
        extract($_POST); 

       
        $this->db->select('*');
        $this->db->from('f_morning_focus');
        $this->db->where('status','active');
        $this->db->where('added_by','1');
        $count = $this->db->get()->result_array();
        // $count[] ='ff';
        return $count;
        
    }
        public function get_focus_meetings_list($dataInfo) {
            extract($_POST); 
            $this->db->select('*');
            $this->db->from('f_focus_meeting');
            $this->db->where('status','active');
            $this->db->where('added_by',$user_id);
            $count = $this->db->get()->result_array();
            // $count[] ='ff';
            return $count;
            
        }
        public function get_weekly_list($dataInfo) {
            extract($_POST); 
            $this->db->select('wf.*');
            $this->db->from('f_weekly_focus wf');
            $this->db->where('wf.status','active');
            $this->db->where('wf.added_by',$user_id);
            $count = $this->db->get()->result();
            foreach($count as $count_key => $count_val){
                $goal_days = explode(', ',$count_val->days);
                $count[$count_key]->days = $goal_days;
                for($i =0; $i < count($count[$count_key]->days) ; $i++){
                    $this->db->select('fmg.*');
                    $this->db->where('fmg.id',$count[$count_key]->days[$i]);
                    $this->db->from('f_days fmg');
                    $count[$count_key]->days[$i] = $this->db->get()->row();
                }
            }
            $data['focus_data'] = $count;
            return $data;
        }

         function get_vision_list($dataInfo) {
            extract($_POST); 
            $this->db->select('wf.*');
            $this->db->from('f_my_vision wf');
            $this->db->where('wf.status','active');
            $this->db->where('wf.added_by',$user_id);
            $count = $this->db->get()->result();
            // foreach($count as $count_key => $count_val){
            //     $goal_days = explode(', ',$count_val->days);
            //     $count[$count_key]->days = $goal_days;
            //     for($i =0; $i < count($count[$count_key]->days) ; $i++){
            //         $this->db->select('fmg.*');
            //         $this->db->where('fmg.id',$count[$count_key]->days[$i]);
            //         $this->db->from('f_days fmg');
            //         $count[$count_key]->days[$i] = $this->db->get()->row();
            //     }
            // }
            $data['focus_data'] = $count;
            return $data;
        }

    public function get_days($dataInfo) {
        extract($_POST); 
        $this->db->select('*');
        $this->db->from('f_days');
        $count = $this->db->get()->result_array();
        // $count[] ='ff';
        return $count;
        
    }

    public function get_plans($dataInfo) {
        extract($_POST); 
        $this->db->select('*');
        $this->db->from('f_plans');
        $count = $this->db->get()->result_array();
        return $count;
        
    }

    public function get_pay_method($dataInfo) {
        extract($_POST); 
        $this->db->select('*');
        $this->db->from('f_plans_method');
        $count = $this->db->get()->result_array();
        return $count;
        
    }

    public function get_meeting_details($dataInfo) {
        extract($_POST);
       
        $this->db->select('ffm.*');

        // $this->db->join('f_focus_meeting_goals as fmg','ffm.id = fmg.focus_meeting_id','left');
        $this->db->where('ffm.id',$meeting_id);
        $this->db->where('ffm.added_by',$user_id);
        $this->db->from('f_focus_meeting ffm');
        $count = $this->db->get()->row();
       // echo $count->meeting_goals; die;
        $goalid = explode(', ',$count->meeting_goals);
        $goal_days = explode(', ',$count->days);
        $totaldays = $this->db->get('f_days')->result();
        foreach($goal_days as $key => $val){
            $this->db->select('fmg.*');
            $this->db->where('fmg.id',$val);
            $this->db->from('f_days fmg');
            $goal_dayss[] = $this->db->get()->row();
       

        }
        foreach($goalid as $key => $val){
            $this->db->select('fmg.*');
            $this->db->where('fmg.id',$val);
            $this->db->from('f_focus_meeting_goals fmg');
            $goals[] = $this->db->get()->row();
        }
// die;
        $data['focus_data'] = $count;
        $data['goal_name'] = $goals;
        $data['goal_days'] = $goal_dayss;
        return $data;
        
    }

    public function get_weekly_details($dataInfo) {
        extract($_POST);
       
        $this->db->select('ffm.*');

        // $this->db->join('f_focus_meeting_goals as fmg','ffm.id = fmg.focus_meeting_id','left');
        $this->db->where('ffm.id',$weekly_id);
        $this->db->where('ffm.added_by',$user_id);
        $this->db->from('f_weekly_focus ffm');
        $count = $this->db->get()->row();
        $goal_days = explode(', ',$count->days);
       // pr($count); die;

        foreach($goal_days as $key => $val){
            $this->db->select('fmg.*');
            $this->db->where('fmg.id',$val);
            $this->db->from('f_days fmg');
            $goal_dayss[] = $this->db->get()->row();
        }
       
        $data['focus_data'] = $count;
        $data['goal_days'] = $goal_dayss;

    //    pr($data); die;
        return $data;
        
    }

    public function get_goal_detail($dataInfo) {
        extract($_POST);
       
        $this->db->select('ffm.*');
        $this->db->where('ffm.id',$goal_id);
        $this->db->where('ffm.added_by',$user_id);
        $this->db->from('f_my_goal ffm');
        $count = $this->db->get()->row();
        $goalid = explode(', ',$count->goal_steps);

        foreach($goalid as $key => $val){
            $this->db->select('fmg.title, fmg.selected_day, fmg.set_time');
            $this->db->where('fmg.id',$val);
            $this->db->from('f_my_goal_steps fmg');
            $cde = $this->db->get()->row();
            $active_record[]['set']  =  $cde;
            $goal_dayss[] =  $cde;
        }


        foreach($goal_dayss as $key => $val){
            $selected_day[] = explode(', ',$val->selected_day);
        }
        for($i=0; $i< count($selected_day); $i++){
            
            for($j=0; $j<count($selected_day[$i]);$j++){
                $this->db->select('fmg.id, fmg.short_name');
                $this->db->where('fmg.id',$selected_day[$i][$j]);
                $this->db->from('f_days fmg');
                $abc[$i][$j]= $this->db->get()->row();
            }
       }
        foreach($selected_day as $key => $val){
            //  pr($val); 
            //  $this->db->select('fmg.*');
            //  $this->db->where('fmg.id',$val);
            //  $this->db->from('f_days fmg');
            //  $goal_daysss[] = $this->db->get()->row();
           
        }
        
    //    die;
        $data['goal_data'] = $count;
        $data['goal_action_step'] = $goal_dayss;
        $data['goal_days'] = $abc;
        // $data['active_record'] = $active_record[]$abc;
        return $data;
        
    }

    
    public function get_goal_list($dataInfo) {
        extract($_POST);
       
        $this->db->select('ffm.*');
        $this->db->where('ffm.added_by',$user_id);
        $this->db->from('f_my_goal ffm');
        $data = $this->db->get()->result();
      
        return $data;
        
    }


    public function save_my_goal($dataInfo) {
        extract($_POST); 
        //pr($_POST); die;

        $data['target_date'] = $target_date;
        $data['added_by'] = $user_id;
        $data['goal_name'] = $goal_name;
        $data['created_date'] = current_datetime();
        $this->db->insert('f_my_goal',$data);
        $goalId = $this->db->insert_id();

        $goalIdlog;
        for($i = 0; $i < count($action_step_title); $i++){

            $insertstep['title'] = $action_step_title[$i];
            $insertstep['selected_day'] = implode(", ",$action_days[$i]);
            $insertstep['set_time'] = $action_time[$i];
            $insertstep['goal_id'] = $goalId;
            $insertstep['created_date'] = current_datetime();
            $this->db->insert('f_my_goal_steps',$insertstep);
            $goalIdlog[] = $this->db->insert_id();
        }
        $getid['goal_steps'] = implode(", ",$goalIdlog);
        $this->db->where('id', $goalId);
        $this->db->update('f_my_goal', $getid);
        $quiz_result_id=    $this->db->affected_rows();
        return $quiz_result_id;
        
    }
    public function update_my_goal($dataInfo) {
        extract($_POST); 
        //pr($_POST); die;

        $data['target_date'] = $target_date;
        $data['goal_name'] = $goal_name;
        $data['updated_date'] = current_datetime();
        // $data['added_by'] = $user_id;
        $this->db->where('id', $goal_id);
        $this->db->where('added_by', $user_id);
        $this->db->update('f_my_goal',$data);
        $goalId = $this->db->affected_rows();

        $goalIdlog;
        
        $this->db->where('id', $goal_id);
        $totaldays = $this->db->get('f_my_goal')->row();
        $getid = explode(", ",$totaldays->goal_steps);
        for($i = 0; $i < count($getid); $i++){
          // pr($getid);
            $insertstep['title'] = $action_step_title[$i];
            $insertstep['selected_day'] = implode(", ",$action_days[$i]);
            $insertstep['set_time'] = $action_time[$i];
            $insertstep['goal_id'] = $goalId;
            $insertstep['updated_date'] = current_datetime();
            // pr($insertstep); die;
             $this->db->where('id', $getid[$i]);
            $this->db->update('f_my_goal_steps',$insertstep);
            $goalIdlog[] = $this->db->affected_rows();
        }
        
        return $goalIdlog;
        
    }
    public function save_weekly_focus($dataInfo) {
        extract($_POST); 
        
        $data['days'] = implode(", ",$action_days);
        $data['weekly_title'] = $weekly_focus_title;
        $data['set_time'] = $set_time;
        $data['set_reminder'] = $set_reminder;
        $data['set_notification'] = $set_notification;
        $data['status'] = 'active';
        $data['added_by'] = $user_id;
        $data['created_date'] = current_datetime();
        
        $this->db->insert('f_weekly_focus',$data);
        $goalId = $this->db->insert_id();
        return $goalId;
        
    }
    
    public function save_focus_meeting($dataInfo) {
        extract($_POST); 
       // pr($meeting_goals); 

        $data['days'] = implode(", ",$action_days);
        $data['meeting_name'] = $meeting_name;
        $data['set_time'] = $set_time;
        $data['set_reminder'] = $set_reminder;
        $data['set_notification'] = $set_notification;
        $data['set_date'] = $set_date;
        $data['added_by'] = $user_id;
        $data['created_date'] = current_datetime();
        $this->db->insert('f_focus_meeting',$data);
        $goalId = $this->db->insert_id();

        $goalIdlog;
        for($i = 0; $i < count($meeting_goals); $i++){
          //  pr();
            $insertstep['action_step'] = $meeting_goals[$i]['campuses'];
            $insertstep['added_by'] = $user_id;
            $insertstep['created_date'] = current_datetime();
            $insertstep['focus_meeting_id'] = $goalId;
            $this->db->insert('f_focus_meeting_goals',$insertstep);
            $goalIdlog[] = $this->db->insert_id();
        }
        $getid['meeting_goals'] = implode(", ",$goalIdlog);
        $this->db->where('id', $goalId);
        $this->db->update('f_focus_meeting', $getid);
        $quiz_result_id=    $this->db->affected_rows();
        return $quiz_result_id;
        
    }




    public function update_focus_meeting($dataInfo) {
        extract($_POST); 
       // pr($meeting_goals); 

        $data['days'] = implode(", ",$action_days);
        $data['meeting_name'] = $meeting_name;
        $data['set_time'] = $set_time;
        $data['set_reminder'] = $set_reminder;
        $data['set_notification'] = $set_notification;
        $data['set_date'] = $set_date;
        $data['added_by'] = $user_id;
        $data['created_date'] = current_datetime();
        $this->db->where('id', $meeting);
        $this->db->update('f_focus_meeting',$data);
        $goalId = $this->db->affected_rows();
        $goalIdlog;

        $this->db->where('id', $meeting);
        $totaldays = $this->db->get('f_focus_meeting')->row();
        $getid = explode(", ",$totaldays->meeting_goals);
       // pr($getid); die;

        for($i = 0; $i < count($getid); $i++){
          
            $insertstep['action_step'] = $meeting_goals[$i]['campuses'];
            $insertstep['updated_date'] = current_datetime();
            // pr($meeting_goals[$i]); die;
            $this->db->where('id', $getid[$i]);
            $this->db->update('f_focus_meeting_goals',$insertstep);
            $goalIdlog = $this->db->affected_rows();
        }
      
        return $goalIdlog;
        
    }

    public function update_weekly_focus($dataInfo) {
        extract($_POST); 
       // pr($meeting_goals); 

       $data['days'] = implode(", ",$action_days);
       $data['weekly_title'] = $weekly_focus_title;
       $data['set_time'] = $set_time;
       $data['set_reminder'] = $set_reminder;
       $data['set_notification'] = $set_notification;
       $data['status'] = 'active';
       $data['updated_date'] = current_datetime();

        $this->db->where('added_by', $user_id);
        $this->db->where('id', $weekly_id);
        $this->db->update('f_weekly_focus',$data);

        $goalId = $this->db->affected_rows();
        return $goalId;
        
    }

    public function check_subscription(Type $var = null)
    {
        # code...
        extract($_POST);   
        $this->db->select('*');     
        $this->db->from('users');     
        $this->db->where('id',$user_id);     
        $query = $this->db->get();    
        // pr($query->row()->is_member); die;  
        if($query->num_rows() > 0){

            if($query->row()->is_member == '1'){
                $data['status'] = 'active';
                $data['subscription'] = 'active';
                $data['user_result'] = $query->row();
            }

            if($query->row()->status != 'active'){
                $data['status'] = 'inactive';
                $data['user_result'] = $query->row();
            }
        }

        return $data;

    }

    //my vision 
    public function upload_vision($dataInfo) {
        extract($_POST);
       
        $data['vision_title'] = $vision_title;
        $data['background_id'] = $background_id;
        $data['goal_date'] = $goal_date;
        $data['added_by'] = $user_id;
        $this->db->insert('f_my_vision', $data);
        $lastid = $this->db->insert_id();
      //  die;

                $this->db->where('uuid',$uuid);
                $this->db->where('created_date',current_date());
                $this->db->where('added_by',$user_id);
       $rq =    $this->db->get('f_temp_image_upload');
       $result = $rq->result();
       $temp_folder = 'uploads/temp_upload_images';
       $folder = 'uploads/upload_images';
       foreach($result as $key => $val){
           chmod($temp_folder, 0755);
           chmod($folder, 0755);
           copy('uploads/temp_upload_images/'.$val->file_name,'uploads/upload_images/'.$val->file_name);
           unlink("uploads/temp_upload_images/".$val->file_name);
       }

    
        foreach($result as $key => $val){
        //    pr($val);
            $datas['file_name'] = $val->file_name;
            $datas['added_by'] = $user_id;
            $datas['vision_id'] = $lastid;
            $datas['status'] = 'active';
            $datas['created_date'] = $val->created_date;
            $this->db->insert('f_vision_image_upload', $datas);
            $imagelastid[] = $this->db->insert_id();
        }
       // die;
        $lastdata = implode(',',$imagelastid);

        $ins['image_id'] = $lastdata;
        $ins['updated_date'] = current_datetime();
        $whr['id'] = $lastid;
        $this->db->update("f_my_vision", $ins, $whr);
        $prof = $this->db->affected_rows();

        $sql = 'DELETE FROM f_temp_image_upload WHERE added_by ='.$user_id;
        $query = $this->db->query($sql);
        $quiz_result_id = $this->db->affected_rows();
        return $quiz_result_id;

    }

    function delete_vision_pics_temp(){
        
        $this->db->where('id',$_POST['id']);
        $result =   $this->db->get('f_temp_image_upload')->row();
        
        $this->db->where('id', $_POST['id']);
        $this->db->delete('f_temp_image_upload');

        if(unlink("uploads/temp_upload_images/".$result->file_name)){
            return true;
        }else{
            return false;
            
        }
    }

    function delete_old_pics(){
        
        $this->db->where('id',$_POST['id']);
        $this->db->where('added_by',$_POST['id']);
        $this->db->where('uuid',$_POST['uuid']);
        $result =   $this->db->get('f_temp_image_upload')->row();
        
        $this->db->where('id', $_POST['id']);
        $this->db->delete('f_temp_image_upload');

        if(unlink("uploads/temp_upload_images/".$result->file_name)){
            return true;
        }else{
            return false;
            
        }
    }

    function get_background(){
        
        $this->db->where('id',$_POST['background']);
        $result =   $this->db->get('f_color_schemes')->row();
        if($result){
            return  $result;
        }else{
            return false;
            
        }
    }

    public function get_upload($dataInfo) {

        // pr(current_datetime()); 
        // die;
        extract($_POST); 
        $this->db->select('*');
        
        $this->db->from('f_temp_image_upload');
        $this->db->where('DATE(created_date)', current_date());
        $this->db->where('uuid',$uuid);
        $this->db->where('added_by',$user_id);
        $prof = $this->db->get()->result();
        // pr($this->db->last_query()); die;
        return $prof;
    }
    public function delete_upload($dataInfo) {

              extract($_POST); 
        $this->db->select('*');
        if($typeofgoal == 'vision'){
          
            $this->db->from('f_temp_image_upload');
            $this->db->where('added_by',$user_id);
            $this->db->where('id',$id);
            $res = $this->db->get()->row();
            // pr($res);die;
            if(!empty($res)){
                $oldPicture = 'uploads/temp_upload_images/'.$res->file_name;
                if (file_exists($oldPicture)) {
    
                    var_dump($oldPicture);
                    
                    // last resort setting
                    // chmod($oldPicture, 0777);
                    chmod($oldPicture, 0644);
                        unlink($oldPicture);
                        $prof = 'Deleted old image';
                    } 
                    else {
                        $prof  = 'Image file does not exist';
                    }
            }
            $this->db->from('f_temp_image_upload');
            $this->db->where('added_by',$user_id);
            $this->db->where('id',$id);
           $this->db->delete();
           $prof = $this->db->affected_rows();
          // pr($prof); die;
            
        }else{
            
            $this->db->from('f_temp_image_upload');
            $this->db->where('added_by',$user_id);
            $this->db->where('id',$id);
        }

        return $prof;
    }
    public function delete_all_upload($dataInfo) {

        extract($_POST); 
        $this->db->select('*');
        if($typeofgoal == 'vision'){
          
            $this->db->from('f_temp_image_upload');
            $this->db->where('added_by',$user_id);
            $res = $this->db->get();
            $result = $res->result();
            // pr($result);die;
            if(!empty($res->num_rows())){
                foreach($result as $key => $val){
                    
                    $oldPicture = 'uploads/temp_upload_images/'.$val->file_name;
                    if (file_exists($oldPicture)) {
    
                        var_dump($oldPicture);
                        
                        // last resort setting
                        // chmod($oldPicture, 0777);
                        chmod($oldPicture, 0644);
                            unlink($oldPicture);
                            $prof = 'Deleted old image';
                        } 
                        else {
                            $prof  = 'Image file does not exist';
                        }

                }              
               
            }
            $this->db->from('f_temp_image_upload');
            $this->db->where('added_by',$user_id);
           $this->db->delete();
           $prof = $this->db->affected_rows();
        }else{
            
            $this->db->from('f_temp_image_upload');
            $this->db->where('added_by',$user_id);
            $this->db->where('id',$id);
        }

        return $prof;
    }

    public function upload_pic($new_name) {

        extract($_POST);

        $image = $new_name;
        $ins['profile_image'] = $image;
        $ins['updated_date'] = current_datetime();
        $whr['id'] = $id;
        $prof = $this->db->update("users", $ins, $whr);
        return $prof;
    }

    /* ---------------------------------------Edit User Profile Closed---------------------------------------------- */

    public function idexists($id) {

        $this->db->select('*');
        $this->db->where("(id = '" . $id . "')");
        $hai = $this->db->from('users');
        $query = $this->db->get()->result();
        return $query;
    }

    /* --------------------------------------------Get Quiz------------------------------------------------- */

   public function getquiz($quiz_id) {
        $this->db->select('qm.*');
        // $this->db->where("qm.quiz_class_id", $class_id);
        // $this->db->where("qm.quiz_subject_id", $subject_id);
        // $this->db->where("qm.quiz_chapter_id", $chapter_id);
        // $this->db->where("qm.quiz_topic", $quiz_topic_id);
        $this->db->where("qm.id", $quiz_id);
        //$this->db->where('qm.status','1');
        $this->db->where('qm.is_deleted', '0');
        //$this->db->where("FIND_IN_SET( '$section_id' , qm.quiz_section_id) ");
        $this->db->from("quiz_master qm");
        $res = $this->db->get()->result();
        return $res;
    }

    /* ---------------------------------------Get Quiz--------------------------------------------- */

    /* ---------------------------------------Get Questions Of Quiz--------------------------------------------- */

    public function getquestions($question_id) {
        $query = "SELECT * FROM (`questions`) WHERE `id` IN ($question_id)";
        $data = $this->db->query($query)->result();

        return $data;
    }

//*****************************************************Get Questions Option and Answers Data**********************//
    public function get_question_data($question_ids, $question_type) {
        $data = array();


        if ($question_type == '1') {//======================for multiple data ======================
            $options_data_qry = $this->db->select('*')->from('question_multiple_choice')->where_in('question_id', $question_ids)->get();
            $data['option_data'] = $options_data_qry->result();
        }
        if ($question_type == '4') {//======================for multiple data ======================
            $options_data_qry = $this->db->select('*')->from('question_multiple_choice')->where_in('question_id', $question_ids)->get();
            $data['option_data'] = $options_data_qry->result();
        }

        //======================Q&A,Fill in the blanks ======================
        if ($question_type == '2') {
            $options_data_qry = $this->db->select('*')->from('question_shortanswers')->where_in('question_id', $question_ids)->get();
            $data['answer_data'] = $options_data_qry->result();
        }

        if ($question_type == '6') {
            $options_data_qry = $this->db->select('*')->from('question_shortanswers')->where_in('question_id', $question_ids)->get();
            $data['answer_data'] = $options_data_qry->result();
        }

        if ($question_type == '8') {
            $options_data_qry = $this->db->select('*')->from('question_shortanswers')->where_in('question_id', $question_ids)->get();
            $data['answer_data'] = $options_data_qry->result();
        }

        //======================for true false data ======================
        if ($question_type == '3') {
            $options_data_qry = $this->db->select('*')->from('question_trueflse')->where_in('question_id', $question_ids)->get();
            $data['truefalse_data'] = $options_data_qry->result();
        }
        //======================for matching data ======================
        if ($question_type == '7') {
            $options_data_qry = $this->db->select('*')->from('question_matching')->where_in('question_id', $question_ids)->get();
            $data['matching_data'] = $options_data_qry->result();
            
            $options_data_qry = $this->db->select('id,question_id,col_a')->from('question_matching')->where_in('question_id', $question_ids)->get();
            $data['matching_data_column'] = $options_data_qry->result();
            $options_data_qry = $this->db->select('id,question_id,col_b')->from('question_matching')->where_in('question_id', $question_ids)->order_by('rand()')->get();
            $data['matching_data_answer'] = $options_data_qry->result();
            
            
            
            
            
        }
        //======================for arrange data ======================
        if ($question_type == '5') {
            $options_data_qry = $this->db->select('*')->from('question_rearrange_dialogue')->where_in('question_id', $question_ids)->get();
            $data['arrange_data'] = $options_data_qry->result();
        }

        //======================For Picture based Question =============================//

        if ($question_type == '9') {//======================for multiple data ======================
            $options_data_qry = $this->db->select('*')->from('question_multiple_choice')->where_in('question_id', $question_ids)->get();
            $data['option_data'] = $options_data_qry->result();
        }
        if ($question_type == '10') {//======================for multiple data ======================
            $options_data_qry = $this->db->select('*')->from('question_multiple_choice')->where_in('question_id', $question_ids)->get();
            $data['option_data'] = $options_data_qry->result();
        }


        return $data;
    }
/* ---------------------------------------Notification_app_list Starts --------------------------------------------- */
    public function notification_app_list($id)
    {
        $sql = $this->db->select("s.*,sd.fname,sd.lname", FALSE)
        ->from('notification_app s')
        ->join("users sd", "s.notify_userid = sd.id", "left")
        ->where(array("s.notify_userid=" => $id))
         ->where(array("s.is_view=" => 0));
        $query = $this->db->get()->result();
        return $query;
    
    }

 /* ---------------------------------------Notification_app_list Ends --------------------------------------------- */

/**********************************************Student All Test Starts********************************************/
    public function student_all_test_list($class_id,$section_id)
    {
        
        $sql = $this->db->select("s.*,sd.chapter_name,c.class_name,f.subject_name", FALSE);
        $sql=$this->db->from('quiz_master s');
        $sql->join("sr_chapter_detail sd", "s.quiz_chapter_id = sd.chapter_id", "left");
        $sql->join("sr_class c", "s.quiz_class_id = c.id", "left");
        $sql->join("sr_subject f", "s.quiz_subject_id = f.id", "left");
        $sql->where("FIND_IN_SET( '$section_id' , s.quiz_section_id) ");
        $sql->where(array("s.is_deleted !=" => "1", 's.quiz_class_id' => $class_id, 's.quiz_type' => '3'));
        $query = $sql->get()->result();
        return $query;
    }


/**********************************************Student All Test Ends********************************************/


/**********************************************Student Upcoming Test Starts********************************************/
public function student_upcoming_test_list($class_id,$section_id)
{
    
    //$sql = $this->db->select("s.*,sd.chapter_name,c.class_name,f.subject_name", FALSE);
    $sql = $this->db->select("s.id,s.quiz_subject_id,s.instruction,s.quiz_topic,s.quiz_chapter_id,s.quiz_time,s.start_date,s.end_date,td.topic_name,sd.chapter_name,f.subject_name", FALSE);
    $sql=$this->db->from('quiz_master s');
    $sql->join("sr_chapter_detail sd", "s.quiz_chapter_id = sd.chapter_id", "left");
    $sql->join("sr_topic_detail td", "s.quiz_topic = td.topic_id", "left");
    //$sql->join("sr_class c", "s.quiz_class_id = c.id", "left");
    $sql->join("sr_subject f", "s.quiz_subject_id = f.id", "left");
    $sql->where("FIND_IN_SET( '$section_id' , s.quiz_section_id) ");
    $sql->where(array("s.is_deleted !=" => "1", 's.quiz_class_id' => $class_id, 's.quiz_type' => '3','s.start_date>='=>date('y-m-d'),'s.end_date>='=>date('y-m-d'),'s.start_date<='=>'s.end_date'));
    $sql=$this->db->group_by('s.id');
    $query = $sql->get()->result();
    return $query;
}
public function get_upcoming_test_data($upcoming,$check_main_id,$student_id)
{
    $i=0;
    foreach ($check_main_id as $key => $value) {  
        $sql=$this->db->select('*')
        ->from('quiz_result')
        ->where('quiz_id',$value)
        ->where('student_id',$student_id)
        ->get()->result();
        if($sql){
            //nothing 
         }else{
            $upcoming[$key]->chapter_name=get_comma_separated_chaptername($upcoming[$key]->quiz_chapter_id);
            $upcoming[$key]->topic_name=get_comma_separated_topicname($upcoming[$key]->quiz_topic);
            $data[$i]=$upcoming[$key];
            $i++; 
         }
    }
    return $data;
}


/**********************************************Student Upcoming Test Ends********************************************/

/**********************************************Popular Videos Starts********************************************/

public function popular_videos_list($class_id,$section_id)
{
    $sql = $this->db->select("s.subject_id,cd.chapter_id,cd.chapter_name,td.topic_id,td.topic_name,td.video_url,td.video_name", FALSE);
    //$sql=$this->db->from('quiz_master s');
    //$sql->join("sr_topic_detail td", "s.quiz_topic = td.topic_id", "left");
    $sql=$this->db->from('sr_topic s');
    $sql=$this->db->order_by('s.id', 'DESC');
    $sql->join("sr_topic_detail td", "s.id = td.topic_id", "left");
    $sql->join("sr_chapter_detail cd", "s.chapter_id = cd.chapter_id", "left");
    $sql->where("FIND_IN_SET( '$section_id' , s.section_id) ");
    $sql->where(array("s.is_deleted !=" => "1", 's.class_id' => $class_id));
    $query = $sql->get()->result();
    //echo $this->db->last_query();die;
   // pr($query);
    foreach ($query as $key => $value) {
     // pr($value); 
     if(($value->video_url==null || $value->video_url=="") && ($value->video_name==null || $value->video_name=="")){


     }else{
        $data[$key]->subject_id=$value->subject_id;   
        $data[$key]->chapter_id=$value->chapter_id;   
        $data[$key]->chapter_name=$value->chapter_name;   
        $data[$key]->topic_id=$value->topic_id;   
        $data[$key]->topic_name=$value->topic_name;   
        $data[$key]->video_url=$value->video_url;   
        $data[$key]->video_name=$value->video_name;   
        
     }

    }
    return $data;
}

public function video_pop_list($vid_id)
{
    foreach ($vid_id as $key => $value) {
        
      $sql=$this->db->select('count(topic_id) as tot')
      ->from('video_log')
      ->where('topic_id',$value)
      ->get()->row();
      
      if($sql->tot!=0){
          $count[$key]=array('topic_id'=>$value,'count'=>$sql->tot);
      }
    }
   
    if($count){
        return $count;
    }else{
        return false;
    }
   
    
      
}

/**********************************************Popular Videos Ends********************************************/

/**********************************************Restult View Starts********************************************/

public function result_view_list($quiz_play_id)
{
   
    $this->db->select('qr.*,u.fname,u.lname,qm.quiz_title,qm.quiz_time');
    $this->db->from('quiz_result qr');
    $this->db->order_by('qr.id', 'DESC');
    $this->db->join('users u', 'u.id=qr.student_id','left');
    $this->db->join('quiz_master qm', 'qm.id=qr.quiz_id','left');
    $this->db->where(array('qr.id' => $quiz_play_id));
    $qry = $this->db->get();
    
   //echo $this->db->last_query();die;
    return $qry->row();
}

public function student_quiz_play($quiz_id,$student_id)
{
    $this->db->select('qr.*,q.questioncontent');
        $this->db->from('student_quiz_history qr');
        $this->db->order_by('qr.id', 'ASC');
        $this->db->join('questions q', 'q.id=qr.question_id','left');
        $this->db->where(array('qr.quiz_id' => $quiz_id, 'qr.student_id' => $student_id));
        $qry = $this->db->get();
        //echo $this->db->last_query();die;
       
        return $qry->result();
}
public function get_question_data_list($question_ids,$question_type)
{
    $data = array();
     
            
    if ($question_type=='1') {//======================for multiple data ======================
        
        
        $options_data_qry = $this->db->select('*')->from('question_multiple_choice')->where_in('question_id', $question_ids)->get();
        $data['option_data'] = $options_data_qry->result();
       
        
    }
     if ($question_type=='4') {//======================for multiple data ======================
        
        
        $options_data_qry = $this->db->select('*')->from('question_multiple_choice')->where_in('question_id', $question_ids)->get();
        $data['option_data'] = $options_data_qry->result();
    }
    
    if ($question_type=='9') {//======================for multiple data ======================
        
        
        $options_data_qry = $this->db->select('*')->from('question_multiple_choice')->where_in('question_id', $question_ids)->get();
        $data['option_data'] = $options_data_qry->result();
    }
    
      if ($question_type=='10') {//======================for multiple data ======================
        
        
        $options_data_qry = $this->db->select('*')->from('question_multiple_choice')->where_in('question_id', $question_ids)->get();
        $data['option_data'] = $options_data_qry->result();
    }
    
    //if ($question_type == '2' || $question_type == '6' || $question_type == '8') {//======================for multiple data ======================
     if ($question_type=='2') {  
    $options_data_qry = $this->db->select('*')->from('question_shortanswers')->where_in('question_id', $question_ids)->get();
        $data['answer_data'] = $options_data_qry->result();
    }
    
     if ($question_type=='6') {
    $options_data_qry = $this->db->select('*')->from('question_shortanswers')->where_in('question_id', $question_ids)->get();
        $data['answer_data'] = $options_data_qry->result();
    }
    
      if ($question_type=='8') {
    $options_data_qry = $this->db->select('*')->from('question_shortanswers')->where_in('question_id', $question_ids)->get();
        $data['answer_data'] = $options_data_qry->result();
    }
    
   // if ($question_type == '3') {//======================for true false data ======================
        if ($question_type=='3') { 
    $options_data_qry = $this->db->select('*')->from('question_trueflse')->where_in('question_id', $question_ids)->get();
        $data['truefalse_data'] = $options_data_qry->result();
    }
     if ($question_type=='7') { 
    //if ($question_type == '7') {//======================for matching data ======================
        $options_data_qry = $this->db->select('*')->from('question_matching')->where_in('question_id', $question_ids)->get();
        $data['matching_data'] = $options_data_qry->result();
    }
    //if ($question_type == '5') {//======================for arrange data ======================
        if ($question_type=='5') {
    $options_data_qry = $this->db->select('*')->from('question_rearrange_dialogue')->where_in('question_id', $question_ids)->get();
        $data['arrange_data'] = $options_data_qry->result();
    }
//echo $this->db->last_query();die;

return $data;
}

/**********************************************Restult View Ends********************************************/

/**********************************************Student Syllabus Starts********************************************/

public function subject_list($class_id,$section_id)
{
    $this->db->select('cp.subject_id,s.subject_name');
  
    $this->db->where("cp.class_id", $class_id);
    $this->db->where('cp.status','1');
    $this->db->where('cp.is_deleted', '0');
    $this->db->group_by('cp.subject_id');
    $this->db->where("FIND_IN_SET( '$section_id' , cp.section_id) ");
    $this->db->join("sr_subject s", "cp.subject_id = s.id", "left");
    $this->db->from("sr_chapter cp");
    $res = $this->db->get()->result();
    
    //echo $this->db->last_query();die;
    return $res;
}

public function chapter_list($class_id,$section_id,$subject_id)
{
   
 
    $sql = $this->db->select("sd.chapter_name", FALSE);
    $sql=$this->db->from('sr_chapter s');
    $sql->join("sr_chapter_detail sd", "s.id = sd.chapter_id", "left");
    $sql->where("s.class_id", $class_id);
    $sql->where("s.subject_id",$subject_id);
    $sql->where("s.is_deleted=", "0");
    $sql->where("s.status=", "1");
    $sql->where("FIND_IN_SET( '$section_id' , s.section_id)"); 

    
    
    $result = $sql->get()->result();
    //pr($result);
    /* echo $this->db->last_query();
    
   die; */
    return $result;

}

/**********************************************Student Syllabus Ends********************************************/

//Get Quiz Details

    public function quiz_details($id) {

        $quiz_details = $this->db->select('*')->from('quiz_master')->where('id', $id)->get();
        return $quiz_details->row();
    }


//*********************************get_multiple_choice Questions answer**********//

    public function get_multiple_choice_answer($question_ids, $question_type) {
        $data = array();


        if ($question_type == '1') {//======================for multiple data ======================
            $options_data_qry = $this->db->select('*')->from('question_multiple_choice')->where_in('question_id', $question_ids)->where('is_answer', '1')->get();
            $data['answer_data'] = $options_data_qry->row();

            //echo $this->db->last_query();die;
        }
        if ($question_type == '4') {//======================for multiple data ======================
            $options_data_qry = $this->db->select('*')->from('question_multiple_choice')->where_in('question_id', $question_ids)->where('is_answer', '1')->get();
            $data['answer_data'] = $options_data_qry->row();
        }



        //======================for true false data ======================
        //======================For Picture based Question =============================//

        if ($question_type == '9') {//======================for multiple data ======================
            $options_data_qry = $this->db->select('*')->from('question_multiple_choice')->where_in('question_id', $question_ids)->where('is_answer', '1')->get();
            $data['answer_data'] = $options_data_qry->row();
        }
        if ($question_type == '10') {//======================for multiple data ======================
            $options_data_qry = $this->db->select('*')->from('question_multiple_choice')->where_in('question_id', $question_ids)->where('is_answer', '1')->get();
            $data['answer_data'] = $options_data_qry->row();
        }


        if ($question_type == '2') {
            $options_data_qry = $this->db->select('*')->from('question_shortanswers')->where_in('question_id', $question_ids)->get();
            $data['answer_data'] = $options_data_qry->row();
        }

        if ($question_type == '6') {
            $options_data_qry = $this->db->select('*')->from('question_shortanswers')->where_in('question_id', $question_ids)->get();
            $data['answer_data'] = $options_data_qry->row();
        }

        if ($question_type == '8') {
            $options_data_qry = $this->db->select('*')->from('question_shortanswers')->where_in('question_id', $question_ids)->get();
            $data['answer_data'] = $options_data_qry->row();
        }



        if ($question_type == '3') {
            $options_data_qry = $this->db->select('*')->from('question_trueflse')->where_in('question_id', $question_ids)->get();
            $data['answer_data'] = $options_data_qry->row();
        }


        return $data;
    }


/**********************************************Student All Attempted Test Starts********************************************/
public function student_all_attempted_test_list($student_id)
{
    
    $sql = $this->db->select("qs.*,qm.quiz_topic,qm.quiz_chapter_id,qm.quiz_subject_id,qm.quiz_section_id,qm.quiz_class_id", FALSE);
    $sql=$this->db->from('quiz_result qs');
    $sql=$this->db->where('qm.quiz_type','3');
    $sql=$this->db->where('qs.student_id',$student_id);
    $sql=$this->db->order_by('qs.id', 'DESC');
    $sql->join("quiz_master qm", "qs.quiz_id = qm.id", "left");
    $query = $sql->get()->result();
    //echo $this->db->last_query();die;
    return $query;
}
public function subject_name($subject_id)
{
    $sql=$this->db->select("sb.subject_name");
    $sql=$this->db->from("sr_subject sb");
    $sql=$this->db->where("id",$subject_id);
    $query = $sql->get()->row();
    return $query;
}

/**********************************************Student All Attempted Test Ends********************************************/

/**********************************************Question Answer Result View Starts********************************************/

public function ques_ans_result_view_list($quiz_result_id)
{
   
    $this->db->select('qr.*,u.fname,u.lname,qm.quiz_title,qm.quiz_time');
    $this->db->from('quiz_result qr');
    $this->db->order_by('qr.id', 'DESC');
    $this->db->join('users u', 'u.id=qr.student_id','left');
    $this->db->join('quiz_master qm', 'qm.id=qr.quiz_id','left');
    //$this->db->where(array('qr.quiz_id' => $quiz_id, 'qr.student_id' => $student_id));
    
    $this->db->where(array('qr.id' => $quiz_result_id));
    $qry = $this->db->get();
    
   //echo $this->db->last_query();die;
    return $qry->row();
}

public function ques_ans_student_quiz_play($quiz_id,$student_id,$quiz_result_id)
{
    $this->db->select('qr.*,q.questioncontent,q.image');
        $this->db->from('student_quiz_history qr');
        $this->db->order_by('qr.id', 'ASC');
        $this->db->join('questions q', 'q.id=qr.question_id','left');
        $this->db->where(array('qr.quiz_id' => $quiz_id, 'qr.student_id' => $student_id, 'qr.quiz_played_id' => $quiz_result_id));
        $qry = $this->db->get();
        //echo $this->db->last_query();die;
       
        return $qry->result();
}
public function ques_ans_get_question_data_list($question_ids,$question_type)
{
    $data = array();
     
            
    if ($question_type=='1') {//======================for multiple data ======================
        
        
        $options_data_qry = $this->db->select('*')->from('question_multiple_choice')->where_in('question_id', $question_ids)->get();
        $data['option_data'] = $options_data_qry->result();
       
        
    }
     if ($question_type=='4') {//======================for multiple data ======================
        
        
        $options_data_qry = $this->db->select('*')->from('question_multiple_choice')->where_in('question_id', $question_ids)->get();
        $data['option_data'] = $options_data_qry->result();
    }
    
    if ($question_type=='9') {//======================for multiple data ======================
        
        
        $options_data_qry = $this->db->select('*')->from('question_multiple_choice')->where_in('question_id', $question_ids)->get();
        $data['option_data'] = $options_data_qry->result();
    }
    
      if ($question_type=='10') {//======================for multiple data ======================
        
        
        $options_data_qry = $this->db->select('*')->from('question_multiple_choice')->where_in('question_id', $question_ids)->get();
        $data['option_data'] = $options_data_qry->result();
    }
    
    //if ($question_type == '2' || $question_type == '6' || $question_type == '8') {//======================for multiple data ======================
     if ($question_type=='2') {  
    $options_data_qry = $this->db->select('*')->from('question_shortanswers')->where_in('question_id', $question_ids)->get();
        $data['answer_data'] = $options_data_qry->result();
    }
    
     if ($question_type=='6') {
    $options_data_qry = $this->db->select('*')->from('question_shortanswers')->where_in('question_id', $question_ids)->get();
        $data['answer_data'] = $options_data_qry->result();
    }
    
      if ($question_type=='8') {
    $options_data_qry = $this->db->select('*')->from('question_shortanswers')->where_in('question_id', $question_ids)->get();
        $data['answer_data'] = $options_data_qry->result();
    }
    
   // if ($question_type == '3') {//======================for true false data ======================
        if ($question_type=='3') { 
    $options_data_qry = $this->db->select('*')->from('question_trueflse')->where_in('question_id', $question_ids)->get();
        $data['truefalse_data'] = $options_data_qry->result();
    }
     if ($question_type=='7') { 
    //if ($question_type == '7') {//======================for matching data ======================
        $options_data_qry = $this->db->select('*')->from('question_matching')->where_in('question_id', $question_ids)->get();
        $data['matching_data'] = $options_data_qry->result();
    }
    //if ($question_type == '5') {//======================for arrange data ======================
        if ($question_type=='5') {
    $options_data_qry = $this->db->select('*')->from('question_rearrange_dialogue')->where_in('question_id', $question_ids)->get();
        $data['arrange_data'] = $options_data_qry->result();
    }
//echo $this->db->last_query();die;

return $data;
}

/**********************************************Question Answer Result View Ends********************************************/


/**********************************************Specific Topic Video/URL by Topic Id Starts********************************************/


public function video_view_list($topic_id) {
    $this->db->select('std.video_url,std.video_name,std.topic_name,std.summary');
    $this->db->from('sr_topic_detail std');
    $this->db->where(array('std.topic_id' => $topic_id, 'std.is_deleted' =>"0",'status'=>'1'));
    $qry = $this->db->get();
    //echo $this->db->last_query();die;
   
    return $qry->result();
    
}

/**********************************************Specific Topic Video/URL by Topic Id Ends********************************************/
/**********************************************Get Quiz ID by Class,section,subject,chapter,topic Id Starts********************************************/
public function quiz_id_list($class_id,$section_id,$subject_id,$chapter_id,$topic_id)
{
   
    $this->db->select('qm.id,qm.quiz_title');
    $this->db->where("qm.quiz_class_id", $class_id);
    $this->db->where("qm.quiz_subject_id", $subject_id);
    $this->db->where('qm.is_deleted', '0');
    $this->db->where('qm.quiz_type', '1');
    $this->db->where("FIND_IN_SET( '$section_id' , qm.quiz_section_id) ");
    $this->db->where("FIND_IN_SET( '$chapter_id' , qm.quiz_chapter_id) ");
    $this->db->where("FIND_IN_SET( '$topic_id' , qm.quiz_topic) ");
    $this->db->order_by('qm.id', 'DESC');
    $this->db->limit('1');
    $this->db->from("quiz_master qm");
    $res = $this->db->get()->result();
    //echo $this->db->last_query();die;
    
    return $res;
}


/**********************************************Get Quiz ID by Class,section,subject,chapter,topic Id Starts********************************************/
/**********************************************Attempt QUIZ Insertion in Table Starts********************************************/

public function attempt_quiz_view($quiz_id,$student_id) {

    $ins['student_id']=$student_id;
    $ins['quiz_id']=$quiz_id;
    $ins['created_date'] = current_datetime();
    $this->db->insert('attempt_quiz', $ins);
    $insert_id = $this->db->insert_id();
    if($insert_id)
    {
        return $insert_id;
    }else{
        return false;
    }
  

    
}
/**********************************************Attempt QUIZ Insertion in Table Ends********************************************/
 


/**********************************************Count Notifications Starts********************************************/

public function count_notification_view($student_id) {

    $sql=$this->db->select('count(id) as tot')
    ->from('notification_app')
    ->where('is_view','0')
    ->where('notify_userid',$student_id)
    ->get()->row();
    return $sql;

    
}

/**********************************************Count Notifications Ends********************************************/

/**********************************************Update Notifications Starts********************************************/

public function update_notification_view($notification_id) {
    
    $this->db->where('id',$notification_id);
    $data=array('is_view'=>'1');
    $sql=$this->db->update('notification_app', $data);
    return $sql;

    
}

/**********************************************Update Notifications Ends********************************************/

    /* -------------------------------------Students Logs Inserted---------------------------------------------------- */




    function student_log_view() {

        extract($_POST);
        $ins['student_id'] = $student_id;
        $ins['activity'] = $activity;
        $ins['created_date'] = current_datetime();
        $ins['action'] = $action;
       
        $this->db->insert("student_log", $ins);
        return true;
        //$insert_id = $this->db->insert_id();
        
        //return $insert_id;
    }

    /* --------------------------------------Students Logs Inserted Closed--------------------------------------------- */

     /* -------------------------------------Students Logs Fetched Inserted---------------------------------------------------- */




     function student_log_fetch_view($student_id) {

        $sql=$this->db->select('*')
        ->from('student_log')
        ->where('student_id',$student_id)
        ->order_by('id', 'DESC')
        ->get()->result();
        return $sql;

    }

    /* --------------------------------------Students Logs Fetched Inserted Closed--------------------------------------------- */

    /**********************************************Video Logs Starts********************************************/
public function video_log_view($student_id,$topic_id)
{
    $ins['student_id'] = $student_id;
    $ins['topic_id'] = $topic_id;
    $ins['created_date'] = current_datetime();
    $sql=$this->db->insert("video_log", $ins);
    if($sql)
    {
        return true;
    }else{
        return false;
    }
   
}

    /**********************************************Video Logs Starts********************************************/




/**********************************************Assessment Report Starts********************************************/
public function assessment_report_list($student_id)
{
    
    $sql = $this->db->select("qs.*,qm.quiz_topic,qm.quiz_chapter_id,qm.quiz_subject_id,qm.quiz_section_id,qm.quiz_class_id", FALSE);
    $sql=$this->db->from('quiz_result qs');
    $sql=$this->db->where('qm.quiz_type','2');
    $sql=$this->db->where('qs.student_id',$student_id);
    $sql=$this->db->order_by('qs.id', 'DESC');
    $sql->join("quiz_master qm", "qs.quiz_id = qm.id", "left");
    $query = $sql->get()->result();
    //echo $this->db->last_query();die;
    return $query;
}


/**********************************************Assessment Report Test Ends********************************************/


/**********************************************Quiz Report Starts********************************************/
public function quiz_report_list($student_id)
{
    
    $sql = $this->db->select("qs.*,qm.quiz_topic,qm.quiz_chapter_id,qm.quiz_subject_id,qm.quiz_section_id,qm.quiz_class_id", FALSE);
    $sql=$this->db->from('quiz_result qs');
    $sql=$this->db->where('qm.quiz_type','1');
    $sql=$this->db->where('qs.student_id',$student_id);
    $sql=$this->db->order_by('qs.id', 'DESC');
    $sql->join("quiz_master qm", "qs.quiz_id = qm.id", "left");
    $query = $sql->get()->result();
    //echo $this->db->last_query();die;
    return $query;
}


/**********************************************Quiz Report Test Ends********************************************/

public function is_student_view_video_list($student_id,$topic_id)
{
    $sql=$this->db->select('*')
    ->from("video_log")
    ->where(array('student_id'=>$student_id,'topic_id'=>$topic_id))
    ->get()->result();
    if($sql)
    {
        return true;
    }
}

/* ------------------------------------------- Functions Closed ----------------------------------------------- */
}

//====Close Class==//
?>