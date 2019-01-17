<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$fvalid[] = array("field"=>"username","label"=>"Email Id","rules"=>"required|doLoginemail");
$fvalid[] = array("field"=>"password","label"=>"Password","rules"=>"required|doLogin");
$config['auth/login'] = $fvalid;
unset($fvalid);


$fvalid[] = array("field"=>"fname","label"=>"First Name","rules"=>"required|alpha");
$fvalid[] = array("field"=>"lname","label"=>"Last Name","rules"=>"required|alpha");
$fvalid[] = array("field"=>"email","label"=>"Email","rules"=>"required|valid_email|is_unique[users.email]");
$fvalid[] = array("field"=>"mobile","label"=>"Mobile","rules"=>"required|numeric");
$fvalid[] = array("field"=>"password","label"=>"Password","rules"=>"required");
$fvalid[] = array("field"=>"cpassword","label"=>"Confirm Password","rules"=>"trim|required|matches[password]","errors"=>array('matches'=>'Passwords do not match'));
$fvalid[] = array("field"=>"role","label"=>"Role","rules"=>"required");
$config['users/add'] = $fvalid;
unset($fvalid);


$fvalid[] = array("field"=>"fname","label"=>"First Name","rules"=>"required|alpha");
$fvalid[] = array("field"=>"lname","label"=>"Last Name","rules"=>"required|alpha");
$fvalid[] = array("field"=>"email","label"=>"Email","rules"=>"required|valid_email|is_unique_edit[users.email]");
$fvalid[] = array("field"=>"mobile","label"=>"Mobile","rules"=>"required|numeric");
$fvalid[] = array("field"=>"role","label"=>"Role","rules"=>"required");
$config['users/edit'] = $fvalid;
unset($fvalid);


$fvalid[] = array("field"=>"fname","label"=>"First Name","rules"=>"required|alpha");
$fvalid[] = array("field"=>"lname","label"=>"Last Name","rules"=>"required|alpha");
//$fvalid[] = array("field"=>"email","label"=>"Email","rules"=>"required|valid_email|is_unique[users.email]");
$fvalid[] = array("field"=>"mobile","label"=>"Phone No","rules"=>"required|numeric");
//$fvalid[] = array("field"=>"password","label"=>"Password","rules"=>"required");
//$fvalid[] = array("field"=>"cpassword","label"=>"Confirm Password","rules"=>"trim|required|matches[password]","errors"=>array('matches'=>'Passwords do not match'));
//$fvalid[] = array("field"=>"role","label"=>"Role","rules"=>"required");
$config['users/profile'] = $fvalid;
unset($fvalid);

$fvalid[] = array("field"=>"email","label"=>"Email Id","rules"=>"trim|required|mail_exist");
$config['auth/forget_password'] = $fvalid;
unset($fvalid);

$fvalid[] = array("field"=>"current_password","label"=>"Current Password","rules"=>"trim|required|checkCurrentPassword");
$fvalid[] = array("field"=>"new_password","label"=>"New Password","rules"=>"trim|required");
$fvalid[] = array("field"=>"retype_new_password","label"=>"Confirm Password","rules"=>"trim|required|matches[new_password]");
$config['users/change_password'] = $fvalid;
unset($fvalid);


/*-----------Class ADD ---------------------*/
$fvalid[] = array("field"=>"class_name","label"=>"Class Name","rules"=>"trim|required|is_unique[sr_class.class_name]");
$fvalid[] = array("field"=>"status","label"=>"Status","rules"=>"trim|required");
$config['schoolclass/add'] = $fvalid;
unset($fvalid);
/*-----------Class Edit ---------------------*/
$fvalid[] = array("field"=>"class_name","label"=>"Class Name","rules"=>"trim|required|is_unique_edit[sr_class.class_name]");
$fvalid[] = array("field"=>"status","label"=>"Status","rules"=>"trim|required");
$config['schoolclass/edit'] = $fvalid;
unset($fvalid);

/*-----------Subject ADD ---------------------*/
$fvalid[] = array("field"=>"subject_name","label"=>"Subject Name","rules"=>"trim|required|is_unique[sr_subject.subject_name]");
$fvalid[] = array("field"=>"status","label"=>"Status","rules"=>"trim|required");
$config['subject/add'] = $fvalid;
unset($fvalid);


/*-----------Subject Edit ---------------------*/
$fvalid[] = array("field"=>"subject_name","label"=>"Subject Name","rules"=>"trim|required|is_unique_edit[sr_subject.subject_name]");
$fvalid[] = array("field"=>"status","label"=>"Status","rules"=>"trim|required");
$config['subject/edit'] = $fvalid;
unset($fvalid);



/*-----------section ADD ---------------------*/
$fvalid[] = array("field"=>"section_name","label"=>"Section Name","rules"=>"trim|required|is_unique[sr_section.section_name]");
$fvalid[] = array("field"=>"status","label"=>"Status","rules"=>"trim|required");
$config['sections/add'] = $fvalid;
unset($fvalid);
/*-----------section Edit ---------------------*/
$fvalid[] = array("field"=>"section_name","label"=>"Section Name","rules"=>"trim|required|is_unique_edit[sr_section.section_name]");
$fvalid[] = array("field"=>"status","label"=>"Status","rules"=>"trim|required");
$config['sections/edit'] = $fvalid;
unset($fvalid);





