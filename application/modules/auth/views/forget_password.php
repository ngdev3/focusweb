<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 4.0.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
     <base href="<?php echo base_url();?>/">
<meta charset="utf-8"/>
<title> -:: Pioneer ::-</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?= base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url(); ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?= base_url(); ?>assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url(); ?>assets/admin/pages/css/login3.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?= base_url(); ?>assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?= base_url(); ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url(); ?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url(); ?>assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?= base_url(); ?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<script src="<?= base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<!-- END THEME STYLES -->
<style>
p
{
    color: red !important;
}

b, strong {
    font-weight: 500;
	color:green;
}

html
{
	height: 100vh;
}
	.limiter {
    width: 100%;
    margin: 0 auto;
}
.container-login100 {
    width: 100%;
    max-height: 100vh;
    
    justify-content: center;
    align-items: center;
    padding: 15px;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    position: relative;
    z-index: 1;
    overflow: hidden;
    background:-webkit-linear-gradient(top, #fbfbfb42, #3d5ff394);
    background: -o-linear-gradient(top, #fbfbfb42, #3d5ff394);
    background: -moz-linear-gradient(top, #fbfbfb42, #3d5ff394);
    background: linear-gradient(top, #fbfbfb42, #3d5ff394);
}
.login
{
	 margin: 6% auto;
    vertical-align: middle;
    overflow: hidden;
    width: 386px;
    background:-webkit-linear-gradient(top, #fbfbfb42, #3d5ff394);
    background: -o-linear-gradient(top, #fbfbfb42, #3d5ff394);
    background: -moz-linear-gradient(top, #fbfbfb42, #3d5ff394);
    background: linear-gradient(top, #fbfbfb42, #3d5ff394);
    box-shadow: 0 11px 21px rgba(0, 0, 0, 0.34), 0 15px 57px rgba(0, 0, 0, 0.65)
}
.login .copyright
{
	background-color: transparent !important;
	   
}
.green-layout
{
	background-color: transparent !important;
}
.green-layout2 {
    margin-top: 10px;
    margin-bottom: 36px;
}

.login .content {
    background-color: #9a9a9a47 !important;
    border:0px !important;
        color: #fff;
    }
    .login .content .form-actions {
    background-color: transparent;
    border-bottom: 0px !important;
}
.forget-password a {
    color: #fff;
}
.login .content h3
{
	color: #fff;
	text-align: center;
	font-weight: 600 !important;
	
}


.login .logo {
    margin: 15px auto 15px auto;
    }
.login .content  {
    color: #fff;
    text-align: left;
}
button#back-btn {
    color: #fff;
    background-color:#44b6ae;
}
i.m-icon-swapleft {
    color: #fff;
   
}
</style>
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="container-login100" >
	<div class="login">
<!-- BEGIN LOGO -->
<!-- BEGIN LOGO -->
<div class="container-fluid green-layout green-layout2">
<div class="row">
    
            <div class="col-md-12">
        <div class="logo text-center">
    <a href="javascript:void(0)">
	<img src="<?= base_url(); ?>assets/images/pioneerlogo.png" width="200"alt=""/>
	</a>
</div>
    </div>
   
    
</div>


    
    
</div>
<!-- <div class="container-fluid green-layout">
    <div class="text-center login-font">SRS <span>International</span> School</div>
</div> -->
  
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="container-fluid green-layout">
<div class="content">
    <?php
 $alc = $this->session->flashdata('alert');
 $this->session->set_flashdata('alert',NULL);
 
if(isset($alc)){
 	if(@$alc['c']=='d'){$aClass = 'alert-danger'; $cap = "Error";}
 	elseif(@$alc['c']=='w'){$aClass = 'alert-warninlert-dangerg'; $cap = "Warning";}
 	elseif(@$alc['c']=='n'){$aClass = 'alert-info'; $cap = "Notice";}
 	elseif(@$alc['c']=='s'){$aClass = 'alert-success'; $cap = "Success";}
?>
<div class="row" style="margin-top:10px;">
  <div class="col-lg-12">
        <div class="alert <?php echo @ $aClass;?> fade in" style="margin-bottom:0px!important;">
            <a href="javascript:void(0)" class="pkAlertClose close">&times;</a>
            <strong><?php echo $cap;?>!</strong> <?php echo @ $alc['m'];?>
        </div>  
    </div>
</div>
 
<script>
function func(el){
    el.fadeOut(1500,function(){el.remove();});
}
$(document).ready(function(){
    setTimeout(function(){ func($(".pkAlertClose").closest(".row"));},4000);
    $(".pkAlertClose").click(function(){ func($(this).closest(".row")); });
});
</script>
<script>
$(document).ready(function(){
    $(".pkAlertClose").click(function(){
         $(".alert").hide();
    });
});
</script>
<!-- <script>

setTimeout(explode, 12000);
$(".pkAlertClose").click(function(){
    $(".alert").removeClass("fade in");
    $(".alert").addClass("fade out");
});
function explode(){
  
    $(".alert").removeClass("fade in");
    $(".alert").addClass("fade out");
}
</script> -->


<?php } ?>
 <!-- 
<script>

setTimeout(explode, 12000);
$(".pkAlertClose").click(function(){
    $(".alert").removeClass("fade in");
    $(".alert").addClass("fade out");
});
function explode(){
  
    $(".alert").removeClass("fade in");
    $(".alert").addClass("fade out");
}
</script> -->
	<!-- BEGIN LOGIN FORM -->
       	<!-- END LOGIN FORM -->
	<!-- BEGIN FORGOT PASSWORD FORM -->

	<form class="login-form"  action="<?php echo base_url('auth/forget_password'); ?>" method="post">
		<h3>Forgot your Password ?</h3><br>
		<span>
			 Enter your Email Id below to reset your password.
             </span>
		<div style= "margin-top:15px;" class="form-group">
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email id" name="email"/>
			</div>
                    			<!-- 	<span class="text-danger"> <b><?php// echo strip_tags(form_error("email")); ?></b></span> -->
                                    <span id= "error" class="help-block text-danger" ><?php echo form_error("email"); ?></span>

		</div>
		<div class="form-actions">
                    <a href="<?php echo base_url();?>"><button type="button" id="back-btn" class="btn">
                            <i class="m-icon-swapleft m-icon-white"></i> Back </button></a>
			<button type="submit" class="btn green-haze pull-right">
			Submit <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>
	
	<!-- END FORGOT PASSWORD FORM -->
	<!-- BEGIN REGISTRATION FORM -->
	<!-- END REGISTRATION FORM -->
</div>
</div>


</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
   <!--   Copyright@2018  SRS <span>International</span> School<br> All Rights Reserved.  -->

</div>

<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?= base_url(); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?= base_url(); ?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->

<script src="<?= base_url(); ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?= base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?= base_url(); ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/admin/pages/scripts/login.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
  Metronic.init(); // init metronic core components
  Layout.init(); // init current layout
  Login.init();
  Demo.init();
});
</script>
<!-- END JAVASCRIPTS -->

</body>
<!-- END BODY -->
</html>
