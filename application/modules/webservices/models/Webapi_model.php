<?php

class Webapi_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /* ---------------------------------------------- login --------------------------------------------------- */

    public function login($email) {
        $this->db->select("cu.*");
        $this->db->from("cz_users cu");
        $this->db->where('cu.status', '1');
        $this->db->where('cu.is_deleted', '0');
        $this->db->where_in("role", ['1', '2','0']);
        $this->db->where('cu.email', $email);
        $res = $this->db->get()->row();


        return $res;
    }

    /* ---------------------------------------------- login closed --------------------------------------------------- */



    /* ------------------------------------------- Change Password ----------------------------------------------- */

    public function change_pwd($data, $id = '') {
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->update('cz_users', $data);
        }
    }

    /* ------------------------------------------- Change Password closed ------------------------------------------- */

//---------------------------------- checking email existence in database -------------------------------------//



    public function check_email($email) {

        $this->db->where("email", $email);
        $this->db->where('cu.status', '1');
        $this->db->where('cu.is_deleted', '0');
        $this->db->where_in("role", ['0','1', '2']);
        $this->db->from("cz_users cu");
        $res = $this->db->get()->row();
        return $res;
    }

    /* ------------------------------------ checking email existence closed ---------------------------------------- */

//----------------------------------Updating password and sending mail----------------------------------------//




    public function update_password($a, $gotemail) {
        $gotpassword = array("password" => md5($a),
            "cpassword" => $a
        );
        if ($a && $gotemail) {
            $this->db->where('email', $gotemail);
            $this->db->update('cz_users', $gotpassword);
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

        extract($_POST);
        $ins['fname'] = $fname;
        $ins['lname'] = $lname;
        if ($_POST['image']) {
            $ins['image'] = $image;
        }

        $ins['father_mobile'] = $father_mobile;
        $ins['mother_mobile'] = $mother_mobile;
        $ins['email'] = $email;
        $ins['admission_number'] = $admission_number;
        $ins['aadhar_no'] = $aadhar_no;
        $ins['class_id'] = $class_id;
        $ins['section_id'] = $section_id;
        $ins['role'] = "1";
        $ins['created_date'] = current_datetime();
        $ins['added_by'] = currUserId();
        $ins['cpassword'] = rand('111111', '999999');
        $ins['password'] = md5($ins['cpassword']);

        $this->db->insert("cz_users", $ins);
        $insert_id = $this->db->insert_id();
        $subject = "Registration";
        $body = $this->load->view("email_template/admin/registration", array("data" => $ins), true);
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
        $this->db->from('cz_users cu');

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
        $this->db->update("cz_users", $ins, $whr);
    }

    /* ---------------------------------------Edit User Profile Closed---------------------------------------------- */




    /* -----------------------------------------------Get Class--------------------------------------------------- */

    public function class_view() {
        $this->db->where('sc.status', '1');
        $this->db->where('sc.is_deleted', '0');

        $query = $this->db->get('sr_class sc')->result();
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
//        $this->db->from("cz_users cu");
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

    public function profilepic($id, $new_name) {

        extract($_POST);

        $image = $new_name;
        $ins['profile_image'] = $image;
        $ins['updated_date'] = current_datetime();
        $whr['id'] = $id;
        $prof = $this->db->update("cz_users", $ins, $whr);
        return $prof;
    }

    /* ---------------------------------------Edit User Profile Closed---------------------------------------------- */

    public function idexists($id) {

        $this->db->select('*');
        $this->db->where("(id = '" . $id . "')");
        $hai = $this->db->from('cz_users');
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
        ->join("cz_users sd", "s.notify_userid = sd.id", "left")
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
    $this->db->join('cz_users u', 'u.id=qr.student_id','left');
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
    $this->db->join('cz_users u', 'u.id=qr.student_id','left');
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