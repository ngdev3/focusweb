<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model("auth_model");

    }

    public function sendMessage($appID)
    {

    //    echo $appID; die;

        $content = array(
            "en" => random_string('alnum', 16),
        );

        $fields = array(
            'app_id' => "ddeebac2-bdd8-4e81-8f3d-75f6e45f0e1b",
            'include_player_ids' => array($appID),
            'contents' => "kjfdhgkjdhfkghkjdhfkjghkjdfg",
            'data' => array(
                "foo" => "bar",
            ),
            'big_picture' => 'https://onesignal.com/images/hero.png',
            'small_icon' => 'https://onesignal.com/images/hero.png',
            'contents' => $content,
            'buttons' => array(array( /* Buttons */
                /* Choose any unique identifier for your button. The ID of the clicked button              is passed to you so you can identify which button is clicked */
                id => 'like-button',
                /* The text the button should display. Supports emojis. */
                text => 'Like',
                /* A valid publicly reachable URL to an icon. Keep this small because it's                  downloaded on each notification display. */
                icon => 'https://onesignal.com/images/hero.png',
                /* The URL to open when this action button is clicked. See the sections below              for special URLs that prevent opening any window. */
                app_url => 'https://google.com',
            ), array( /* Buttons */
                /* Choose any unique identifier for your button. The ID of the clicked button              is passed to you so you can identify which button is clicked */
                id => 'like-button-2',
                /* The text the button should display. Supports emojis. */
                text => 'Like',
                /* A valid publicly reachable URL to an icon. Keep this small because it's                  downloaded on each notification display. */
                icon => 'https://onesignal.com/images/hero.png',
                /* The URL to open when this action button is clicked. See the sections below              for special URLs that prevent opening any window. */
                app_url => 'https://google.com',
            )),
            // 'buttons' => ,
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic OGIwMGJhYzctNmNjMy00ZmE4LTgyMGQtM2ZlZjY0YTU0ZDEx',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);
        print($response);
        return $response;

    }

    public function hitotcheck($appID = null)
    {
        # code...
        $response = $this->sendMessage($appID);
        $return["allresponses"] = $response;
        $return = json_encode($return);

        $data = json_decode($response, true);
        echo "<pre>";
        print_r($data);
        $id = $data['id'];
        print_r($id);
        print("\n\nJSON received:\n");
        print($return);
        print("\n");
        echo "</pre>";
    }

    public function utcToGMT($string){
            $chkdtarr=explode("GMT",$string);
            $newdt= strtotime($chkdtarr[0]);
            $converted_date = date("Y-m-d",$newdt);
            return $converted_date;
    }
    public function globalTestHit()
    {
        $this->db->select('*');
        $this->db->from('f_focus_meeting');
        $this->db->where('status', 'active');
        $getdb = $this->db->get();
        //  pr($getdb->result());
        $fetch = $getdb->result();
        foreach ($fetch as $key => $val) {
          // pr($val->set_date);
            $today = date("Y-m-d");
            $todayDay = date("l");
            // $CurrenttodayDay = date("D");
            $date = $val->set_date;
            $converted_date = $this->utcToGMT($val->set_date);
         //   echo $converted_date;
          //  echo "<br>";
            $getdata = explode(", ", $val->days);
            foreach ($getdata as $nkey => $nval) {
             //   echo "<br>";
             $this->db->select('*');
             $this->db->from('users');
             $this->db->where('id', $val->added_by);
             $tokens =  $this->db->get()->row()->login_token;

                $this->db->select('*');
                $this->db->from('f_days');
                $this->db->where('id', $nval);
                $fname =  strtolower($this->db->get()->row()->full_name);
              
                // echo $todayDay;
                $tomorrow_timestamp = strtotime('next ' .$fname, strtotime($converted_date));
                $getlast_day = date("Y-m-d",$tomorrow_timestamp);
                // $CurrenttodayDay = date("Y-m-d");
                $CurrenttodayDay = date("Y-m-d",strtotime("2019-04-16"));
                // echo $CurrenttodayDay; die;
             // echo strtolower($getlast_day)."-------".strtolower($CurrenttodayDay)." ---- ".$nval;
            //    echo ($getlast_day == $CurrenttodayDay);
              $date = new DateTime("now");
 
              $curr_date = $date->format('Y-m-d');

                if ($getlast_day == $CurrenttodayDay) {
                $this->db->select('*');
                $this->db->from('f_notification');
                $this->db->where('user_id', $val->added_by);
                $this->db->where('contentid', $val->id);
                // $this->db->where('DATE(notification_date)', $curr_date);
                $contentid =  $this->db->get()->result();
                pr($contentid);
            //    echo $val->id; 
               echo "<br>";
               die;
                if($contentid !== $val->id){
                    echo "Sending Notification To User Ids:- ". $val->added_by." Its Token is ".$tokens;
                    $data['title'] = 'ououououo';
                    $data['status'] = 'done';
                    $data['user_id'] = $val->added_by;
                    $data['notification_date'] = $getlast_day;
                    $data['typeofcontent'] = 'focus_meeting';
                    $data['contentid'] = $val->id;
                    $data['notification_datetime'] = $CurrenttodayDay;
                    $this->hitotcheck($tokens);
                    $this->db->insert('f_notification',$data);
                }
                    

                }else{
                    echo "<br>";
             //       echo $val->id;
                    echo "<br>";
                }
            }
           
            pr($getdata); //fetching Days from App
        }
    }

    public function index()
    {

        $this->login();
    }

    public function login()
    {
        if ($this->form_validation->run('auth/login') == true) {
            redirect("dashboard");
        }
        $this->load->view('login');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->unset_userdata('userinfo');
        redirect();
    }

    public function permission_denied()
    {
        $data['title'] = 'Access Denied';
        $data['page_title'] = 'Access Denied';
        $data['page'] = 'access_denied';
        $data['subTitle'] = 'Access Denied';
        $data['breadcrumb'] = array("Home" => base_url());
        $views = 'access_denied';
//        pr($data); die;
        _layout($data);
    }

    public function forget_password()
    {
        if ($this->form_validation->run("auth/forget_password") == true) {
            //echo"jk";die;
            $this->auth_model->forget_password();
            $this->session->set_flashdata("alert", array("c" => "s", "m" => "Password Send Successfully. "));
            redirect('auth/forget_password');
        }
        $this->load->view("forget_password");
    }

}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */
