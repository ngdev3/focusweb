<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * API helper
 * @package		Api Helper
 * @subpackage          Helpers
 * @auothor	   	Ankit Rajput
 * @website		http://www.tekshapers.com
 * @company             Tekshapers Inc 
 * @since		Version 1.0
*/


/**
 * call_api
 * this function called api functions 
 * @param mix array $postData
 * @param string $route
 * 
 * @return
*/
if (!function_exists('call_api')) {
    function call_api($postData, $route) 
    {  
        $CI         =   &get_instance();    // create instance of CI
        $authKey    =   $CI->config->item('auth_key');   // GET auth key value from config file
        $api_url    =   $CI->config->item('api_url');  // GET API URL value from config file
        if(@currentuserinfo()->token !=  '')
        {
            $token  =   @currentuserinfo()->token;
        }else{
            $token  =   md5(uniqid() . microtime() . rand());
        }
        
        $postData['authkey']    =   $authKey;
        $postData['token']      =   $token;
        $postData['route']      =   $route;
        /*set current langaue*/
        if($CI->session->userdata('site_language'))
        {
            $postData['language']   =   $CI->session->userdata('site_language');
        }else if(@currentuserinfo()->language){
            $postData['language']    =   @currentuserinfo()->language? @currentuserinfo()->language : 'french';
        }else{
            $postData['language']   =   'french';
        } 
     
        
        /*for college selection*/
        if(@$CI->session->userdata['college_id'] != ''){
            $postData['site_id'] =  $CI->session->userdata['college_id'];
        }
        /*For user login*/
        
        if((int)@currentuserinfo()->site_id !== 0){
            $postData['site_id']    =   currentuserinfo()->site_id;
            $postData['user_id']    =   currentuserinfo()->id;
        }else{
            if(@currentuserinfo()->id    !=  '')
            {
                $postData['user_id']    =   currentuserinfo()->id;
            }else{
                $postData['user_id']    =   '';
            }
        }
        /*Set instance name in data*/
        //echo $CI->session->userdata('instance_name');die;
        if(@$CI->session->userdata('instance_name')    !=  '')
        {
            $postData['instance_name'] =  @$CI->session->userdata['instance_name'];
        }else{
			$postData['instance_name'] =  '';
		}
        $url=$api_url. $route;  // initialize URL for Api
        /*for single Image*/
        if (!empty($_FILES['userfile']['name'])) {
            $tmpfile                =   $_FILES['userfile']['tmp_name'];
            $filename               =   basename($_FILES['userfile']['name']);
            $postData['userfile']   =   curl_file_create($tmpfile, $_FILES['userfile']['type'], $filename);
        }
        
        /*for single vedeo*/
        if (!empty($_FILES['vedeofile']['name'])) {
            $tmpfile                =   $_FILES['vedeofile']['tmp_name'];
            $filename               =   basename($_FILES['vedeofile']['name']);
            $postData['vedeofile']  =   curl_file_create($tmpfile, $_FILES['vedeofile']['type'], $filename);
        }
        /*For multiple Image*/
        $count  =   0;
        if (!empty($_FILES['file']['name'])){
            $count  =   count($_FILES['file']['name']);
            if (!empty($_FILES['file'])){
                for($i = 0; $i < $count; $i++){
                    if(!empty($_FILES['file']['tmp_name'][$i])){
                        $tmpfile                =   $_FILES['file']['tmp_name'][$i];
                        $filename               =   basename($_FILES['file']['name'][$i]);
                        $postData["file$i"]     =   curl_file_create($tmpfile, $_FILES['file']['type'][$i], $filename);
                    }
                }
            }
        }
        $postData['total_image']    =   $count;
      
        $ch         =   curl_init();  // create a new cURL resource

        $headers    =   array("Content-Type:multipart/form-data");
        // set URL and other appropriate options
        curl_setopt_array($ch, array(    //Set multiple options for a cURL transfer
            CURLOPT_HTTPHEADER      =>  $headers,
            CURLOPT_HEADER          =>  0,
            CURLOPT_URL             =>  $url,
            CURLOPT_RETURNTRANSFER  =>  true,
            CURLOPT_POST            =>  true,
            CURLOPT_POSTFIELDS      =>  $postData,
            CURLOPT_TIMEOUT         =>  500,
            CURLOPT_FOLLOWLOCATION  =>  true));

        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);   // grab URL and pass it to the browser
        
        if (curl_errno($ch)){
            echo 'error:' . curl_error($ch);
        }
        curl_close($ch);    // close cURL resource, and free up system resources
        return $output;
    }
}

/**
 * call_api
 * this function called api functions 
 * @param mix array $postData
 * @param string $route
 * 
 * @return
*/
if (!function_exists('call_webservice')) {
    function call_webservice($postData,$route) 
    {  
        $CI                     =   &get_instance();    // create instance of CI
        $authKey                =   $CI->config->item('auth_key');   // GET auth key value from config file
        $api_url                =   $CI->config->item('api_url');  // GET API URL value from config file
        $postData['authkey']    =   $authKey;
        /*Assigning header values*/
        $postData['auth_key']   =   $_SERVER['HTTP_X_SECRET'];
        $postData['site_id']    =   @$_SERVER['HTTP_X_INSTANCE_ID'];
        $postData['language']   =   $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        
        /*End of assigning header values*/
        $postData['route']      =   $route;
       
        $url=$api_url. $route;  // initialize URL for Api
        /*for single Image*/
        if (!empty($_FILES['userfile']['name'])) {
            $tmpfile                =   $_FILES['userfile']['tmp_name'];
            $filename               =   basename($_FILES['userfile']['name']);
            $postData['userfile']   =   curl_file_create($tmpfile, $_FILES['userfile']['type'], $filename);
        }
        
        /*for single vedeo*/
        if (!empty($_FILES['vedeofile']['name'])) {
            $tmpfile                =   $_FILES['vedeofile']['tmp_name'];
            $filename               =   basename($_FILES['vedeofile']['name']);
            $postData['vedeofile']  =   curl_file_create($tmpfile, $_FILES['vedeofile']['type'], $filename);
        }
        /*For multiple Image*/
        $count  =   0;
        if (!empty($_FILES['file']['name'])){
            $count  =   count($_FILES['file']['name']);
            if (!empty($_FILES['file'])){
                for($i = 0; $i < $count; $i++){
                    if(!empty($_FILES['file']['tmp_name'][$i])){
                        $tmpfile                =   $_FILES['file']['tmp_name'][$i];
                        $filename               =   basename($_FILES['file']['name'][$i]);
                        $postData["file$i"]     =   curl_file_create($tmpfile, $_FILES['file']['type'][$i], $filename);
                    }
                }
            }
        }
        $postData['total_image']    =   $count;
      
        $ch         =   curl_init();  // create a new cURL resource

        $headers    =   array("Content-Type:multipart/form-data");
        // set URL and other appropriate options
        curl_setopt_array($ch, array(    //Set multiple options for a cURL transfer
            CURLOPT_HTTPHEADER      =>  $headers,
            CURLOPT_HEADER          =>  0,
            CURLOPT_URL             =>  $url,
            CURLOPT_RETURNTRANSFER  =>  true,
            CURLOPT_POST            =>  true,
            CURLOPT_POSTFIELDS      =>  $postData,
            CURLOPT_TIMEOUT         =>  500,
            CURLOPT_FOLLOWLOCATION  =>  true));

        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);   // grab URL and pass it to the browser
        
        if (curl_errno($ch)){
            echo 'error:' . curl_error($ch);
        }
        curl_close($ch);    // close cURL resource, and free up system resources
        return $output;
    }
}

