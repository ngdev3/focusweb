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
        $content = array(
            "en" => 'English kkljljlkjlkjljljljlkjlkjlkjMessage',
        );
 
        $fields = array(
            'app_id' => $appID,
            'included_segments' => array(
                'All',
            ),
            'data' => array(
                "foo" => "bar",
            ),
            'big_picture'=>'https://onesignal.com/images/notification_logo.png',
            'contents' => $content,
            'buttons' =>  array(array( /* Buttons */
                /* Choose any unique identifier for your button. The ID of the clicked button 			 is passed to you so you can identify which button is clicked */
                id =>'like-button',
                /* The text the button should display. Supports emojis. */
                text => 'Like',
                /* A valid publicly reachable URL to an icon. Keep this small because it's 				 downloaded on each notification display. */
                icon => 'http://i.imgur.com/N8SN8ZS.png',
                /* The URL to open when this action button is clicked. See the sections below 			 for special URLs that prevent opening any window. */
                app_url => 'https://google.com'
            ),array( /* Buttons */
                /* Choose any unique identifier for your button. The ID of the clicked button 			 is passed to you so you can identify which button is clicked */
                id =>'like-button-2',
                /* The text the button should display. Supports emojis. */
                text => 'Like',
                /* A valid publicly reachable URL to an icon. Keep this small because it's 				 downloaded on each notification display. */
                icon => 'http://i.imgur.com/N8SN8ZS.png',
                /* The URL to open when this action button is clicked. See the sections below 			 for special URLs that prevent opening any window. */
                app_url => 'https://google.com'
            ))
            // 'buttons' => ,
        );

        $fields = json_encode($fields);
        // print("\nJSON sent:\n");
        // print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic NzA3NGEyMWItZDgzNS00ZWUxLWEzMTktYmEyMDYwZDM5Mzc0',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);
        //print($response);
        return $response;

       

    }

    


    function hitotcheck(Type $var = null)
    {
        # code...
        $response = $this->sendMessage();
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
