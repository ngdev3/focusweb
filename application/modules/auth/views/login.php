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
<title> -:: Pioneer | Admin login ::-</title>
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
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>

<!--remember me section -->
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script>
            $(function() {

                if (localStorage.chkbx && localStorage.chkbx != '') {
                    $('#remember_me').attr('checked', 'checked');
                    $('#username').val(localStorage.usrname);
                    $('#pass').val(localStorage.pass);
                } else {
                    $('#remember_me').removeAttr('checked');
                    $('#username').val('');
                    $('#pass').val('');
                }

                $('#remember_me').click(function() {

                    if ($('#remember_me').is(':checked')) {
                        // save username and password
                        localStorage.usrname = $('#username').val();
                        localStorage.pass = $('#pass').val();
                        localStorage.chkbx = $('#remember_me').val();
                    } else {
                        localStorage.usrname = '';
                        localStorage.pass = '';
                        localStorage.chkbx = '';
                    }
                });
            });

        </script>
        

<!--remember me section ends-->
<style type="text/css">
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
    margin-bottom: 15px;
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
</style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- <div class="limiter">
    <div class="container-login100" style="background-image: url('<?= base_url(); ?><?= base_url(); ?>assets/srs_admin/img/login_bg.jpg');"> -->
    
<body class=" container-login100">
	<div class="login">

<!-- BEGIN LOGO -->
<div class="container-fluid green-layout green-layout2">
<div class="row">
    
        <div class="col-md-12">
        <div class="logo text-center">
    <a href="javascript:void(0)">
	<img src="<?= base_url(); ?>assets/images/pioneerlogo.png" width="200"alt="" />
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
    <div>
        <?php echo $this->session->flashdata("flash_message"); ?>
    </div>
	<!-- BEGIN LOGIN FORM -->
        <form class="login-form" action="<?php echo base_url('auth/login'); ?>" method="post">
		<h3 class="form-title">Login to your account</h3>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter any username and password. </span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
                                <input class="form-control placeholder-no-fix logininput" type="text" value="<?php echo set_value("username"); ?>" autocomplete="off" placeholder="Email Id" name="username" id='username'/>
			</div>
			                                <span class="help-block text-danger" > <?php echo form_error("username"); ?></span>

		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix logininput" value="<?php echo set_value("password"); ?>" type="password" autocomplete="off" placeholder="Password" name="password" id="pass"/>
			</div>
			                                <span class="help-block text-danger" > <?php echo form_error("password"); ?></span>

		</div>
		<div class="form-actions">
			<label class="checkbox">
			<input type="checkbox" name="remember"  value="remember-me" id="remember_me"/> Remember me </label>
			<button type="submit" class="btn green-haze pull-right" id="loginButton">
			Login <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
		<div class="forget-password" style="margin-top:-25px;">
			<h4><a href="<?php echo base_url('auth/forget_password');?>" id="forget-password"> Forgot your password ? </a></h4>
			
		</div>
		
	</form>
	<!-- END LOGIN FORM -->
	<!-- BEGIN FORGOT PASSWORD FORM -->
	<!--<form class="forget-form" action="<?php echo base_url('auth/forget_password'); ?>" method="post">
		<h3>Forget Password d?</h3>
		<p>
			 Enter your e-mail address below to reset your password.
		</p>
		<div class="form-group">
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
			</div>
		</div>
		<div class="form-actions">
			<button type="button" id="back-btn" class="btn">
			<i class="m-icon-swapleft"></i> Back </button>
			<button type="submit" class="btn green-haze pull-right">
			Submit <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>-->
	<!-- END FORGOT PASSWORD FORM -->
	<!-- BEGIN REGISTRATION FORM -->
<!--	<form class="register-form hide" action="index.html" method="post">
		<h3>Sign Up</h3>
		<p>
                    Enter your personal details below:
		</p>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Full Name</label>
			<div class="input-icon">
				<i class="fa fa-font"></i>
				<input class="form-control placeholder-no-fix" type="text" placeholder="Full Name" name="fullname"/>
			</div>
		</div>
		<div class="form-group">
			ie8, ie9 does not support html5 placeholder, so we just show field title for that
			<label class="control-label visible-ie8 visible-ie9">Email</label>
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Address</label>
			<div class="input-icon">
				<i class="fa fa-check"></i>
				<input class="form-control placeholder-no-fix" type="text" placeholder="Address" name="address"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">City/Town</label>
			<div class="input-icon">
				<i class="fa fa-location-arrow"></i>
				<input class="form-control placeholder-no-fix" type="text" placeholder="City/Town" name="city"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Country</label>
			<select name="country" id="select2_sample4" class="select2 form-control">
				<option value=""></option>
				<option value="AF">Afghanistan</option>
				<option value="AL">Albania</option>
				<option value="DZ">Algeria</option>
				<option value="AS">American Samoa</option>
				<option value="AD">Andorra</option>
				<option value="AO">Angola</option>
				<option value="AI">Anguilla</option>
				<option value="AR">Argentina</option>
				<option value="AM">Armenia</option>
				<option value="AW">Aruba</option>
				<option value="AU">Australia</option>
				<option value="AT">Austria</option>
				<option value="AZ">Azerbaijan</option>
				<option value="BS">Bahamas</option>
				<option value="BH">Bahrain</option>
				<option value="BD">Bangladesh</option>
				<option value="BB">Barbados</option>
				<option value="BY">Belarus</option>
				<option value="BE">Belgium</option>
				<option value="BZ">Belize</option>
				<option value="BJ">Benin</option>
				<option value="BM">Bermuda</option>
				<option value="BT">Bhutan</option>
				<option value="BO">Bolivia</option>
				<option value="BA">Bosnia and Herzegowina</option>
				<option value="BW">Botswana</option>
				<option value="BV">Bouvet Island</option>
				<option value="BR">Brazil</option>
				<option value="IO">British Indian Ocean Territory</option>
				<option value="BN">Brunei Darussalam</option>
				<option value="BG">Bulgaria</option>
				<option value="BF">Burkina Faso</option>
				<option value="BI">Burundi</option>
				<option value="KH">Cambodia</option>
				<option value="CM">Cameroon</option>
				<option value="CA">Canada</option>
				<option value="CV">Cape Verde</option>
				<option value="KY">Cayman Islands</option>
				<option value="CF">Central African Republic</option>
				<option value="TD">Chad</option>
				<option value="CL">Chile</option>
				<option value="CN">China</option>
				<option value="CX">Christmas Island</option>
				<option value="CC">Cocos (Keeling) Islands</option>
				<option value="CO">Colombia</option>
				<option value="KM">Comoros</option>
				<option value="CG">Congo</option>
				<option value="CD">Congo, the Democratic Republic of the</option>
				<option value="CK">Cook Islands</option>
				<option value="CR">Costa Rica</option>
				<option value="CI">Cote d'Ivoire</option>
				<option value="HR">Croatia (Hrvatska)</option>
				<option value="CU">Cuba</option>
				<option value="CY">Cyprus</option>
				<option value="CZ">Czech Republic</option>
				<option value="DK">Denmark</option>
				<option value="DJ">Djibouti</option>
				<option value="DM">Dominica</option>
				<option value="DO">Dominican Republic</option>
				<option value="EC">Ecuador</option>
				<option value="EG">Egypt</option>
				<option value="SV">El Salvador</option>
				<option value="GQ">Equatorial Guinea</option>
				<option value="ER">Eritrea</option>
				<option value="EE">Estonia</option>
				<option value="ET">Ethiopia</option>
				<option value="FK">Falkland Islands (Malvinas)</option>
				<option value="FO">Faroe Islands</option>
				<option value="FJ">Fiji</option>
				<option value="FI">Finland</option>
				<option value="FR">France</option>
				<option value="GF">French Guiana</option>
				<option value="PF">French Polynesia</option>
				<option value="TF">French Southern Territories</option>
				<option value="GA">Gabon</option>
				<option value="GM">Gambia</option>
				<option value="GE">Georgia</option>
				<option value="DE">Germany</option>
				<option value="GH">Ghana</option>
				<option value="GI">Gibraltar</option>
				<option value="GR">Greece</option>
				<option value="GL">Greenland</option>
				<option value="GD">Grenada</option>
				<option value="GP">Guadeloupe</option>
				<option value="GU">Guam</option>
				<option value="GT">Guatemala</option>
				<option value="GN">Guinea</option>
				<option value="GW">Guinea-Bissau</option>
				<option value="GY">Guyana</option>
				<option value="HT">Haiti</option>
				<option value="HM">Heard and Mc Donald Islands</option>
				<option value="VA">Holy See (Vatican City State)</option>
				<option value="HN">Honduras</option>
				<option value="HK">Hong Kong</option>
				<option value="HU">Hungary</option>
				<option value="IS">Iceland</option>
				<option value="IN">India</option>
				<option value="ID">Indonesia</option>
				<option value="IR">Iran (Islamic Republic of)</option>
				<option value="IQ">Iraq</option>
				<option value="IE">Ireland</option>
				<option value="IL">Israel</option>
				<option value="IT">Italy</option>
				<option value="JM">Jamaica</option>
				<option value="JP">Japan</option>
				<option value="JO">Jordan</option>
				<option value="KZ">Kazakhstan</option>
				<option value="KE">Kenya</option>
				<option value="KI">Kiribati</option>
				<option value="KP">Korea, Democratic People's Republic of</option>
				<option value="KR">Korea, Republic of</option>
				<option value="KW">Kuwait</option>
				<option value="KG">Kyrgyzstan</option>
				<option value="LA">Lao People's Democratic Republic</option>
				<option value="LV">Latvia</option>
				<option value="LB">Lebanon</option>
				<option value="LS">Lesotho</option>
				<option value="LR">Liberia</option>
				<option value="LY">Libyan Arab Jamahiriya</option>
				<option value="LI">Liechtenstein</option>
				<option value="LT">Lithuania</option>
				<option value="LU">Luxembourg</option>
				<option value="MO">Macau</option>
				<option value="MK">Macedonia, The Former Yugoslav Republic of</option>
				<option value="MG">Madagascar</option>
				<option value="MW">Malawi</option>
				<option value="MY">Malaysia</option>
				<option value="MV">Maldives</option>
				<option value="ML">Mali</option>
				<option value="MT">Malta</option>
				<option value="MH">Marshall Islands</option>
				<option value="MQ">Martinique</option>
				<option value="MR">Mauritania</option>
				<option value="MU">Mauritius</option>
				<option value="YT">Mayotte</option>
				<option value="MX">Mexico</option>
				<option value="FM">Micronesia, Federated States of</option>
				<option value="MD">Moldova, Republic of</option>
				<option value="MC">Monaco</option>
				<option value="MN">Mongolia</option>
				<option value="MS">Montserrat</option>
				<option value="MA">Morocco</option>
				<option value="MZ">Mozambique</option>
				<option value="MM">Myanmar</option>
				<option value="NA">Namibia</option>
				<option value="NR">Nauru</option>
				<option value="NP">Nepal</option>
				<option value="NL">Netherlands</option>
				<option value="AN">Netherlands Antilles</option>
				<option value="NC">New Caledonia</option>
				<option value="NZ">New Zealand</option>
				<option value="NI">Nicaragua</option>
				<option value="NE">Niger</option>
				<option value="NG">Nigeria</option>
				<option value="NU">Niue</option>
				<option value="NF">Norfolk Island</option>
				<option value="MP">Northern Mariana Islands</option>
				<option value="NO">Norway</option>
				<option value="OM">Oman</option>
				<option value="PK">Pakistan</option>
				<option value="PW">Palau</option>
				<option value="PA">Panama</option>
				<option value="PG">Papua New Guinea</option>
				<option value="PY">Paraguay</option>
				<option value="PE">Peru</option>
				<option value="PH">Philippines</option>
				<option value="PN">Pitcairn</option>
				<option value="PL">Poland</option>
				<option value="PT">Portugal</option>
				<option value="PR">Puerto Rico</option>
				<option value="QA">Qatar</option>
				<option value="RE">Reunion</option>
				<option value="RO">Romania</option>
				<option value="RU">Russian Federation</option>
				<option value="RW">Rwanda</option>
				<option value="KN">Saint Kitts and Nevis</option>
				<option value="LC">Saint LUCIA</option>
				<option value="VC">Saint Vincent and the Grenadines</option>
				<option value="WS">Samoa</option>
				<option value="SM">San Marino</option>
				<option value="ST">Sao Tome and Principe</option>
				<option value="SA">Saudi Arabia</option>
				<option value="SN">Senegal</option>
				<option value="SC">Seychelles</option>
				<option value="SL">Sierra Leone</option>
				<option value="SG">Singapore</option>
				<option value="SK">Slovakia (Slovak Republic)</option>
				<option value="SI">Slovenia</option>
				<option value="SB">Solomon Islands</option>
				<option value="SO">Somalia</option>
				<option value="ZA">South Africa</option>
				<option value="GS">South Georgia and the South Sandwich Islands</option>
				<option value="ES">Spain</option>
				<option value="LK">Sri Lanka</option>
				<option value="SH">St. Helena</option>
				<option value="PM">St. Pierre and Miquelon</option>
				<option value="SD">Sudan</option>
				<option value="SR">Suriname</option>
				<option value="SJ">Svalbard and Jan Mayen Islands</option>
				<option value="SZ">Swaziland</option>
				<option value="SE">Sweden</option>
				<option value="CH">Switzerland</option>
				<option value="SY">Syrian Arab Republic</option>
				<option value="TW">Taiwan, Province of China</option>
				<option value="TJ">Tajikistan</option>
				<option value="TZ">Tanzania, United Republic of</option>
				<option value="TH">Thailand</option>
				<option value="TG">Togo</option>
				<option value="TK">Tokelau</option>
				<option value="TO">Tonga</option>
				<option value="TT">Trinidad and Tobago</option>
				<option value="TN">Tunisia</option>
				<option value="TR">Turkey</option>
				<option value="TM">Turkmenistan</option>
				<option value="TC">Turks and Caicos Islands</option>
				<option value="TV">Tuvalu</option>
				<option value="UG">Uganda</option>
				<option value="UA">Ukraine</option>
				<option value="AE">United Arab Emirates</option>
				<option value="GB">United Kingdom</option>
				<option value="US">United States</option>
				<option value="UM">United States Minor Outlying Islands</option>
				<option value="UY">Uruguay</option>
				<option value="UZ">Uzbekistan</option>
				<option value="VU">Vanuatu</option>
				<option value="VE">Venezuela</option>
				<option value="VN">Viet Nam</option>
				<option value="VG">Virgin Islands (British)</option>
				<option value="VI">Virgin Islands (U.S.)</option>
				<option value="WF">Wallis and Futuna Islands</option>
				<option value="EH">Western Sahara</option>
				<option value="YE">Yemen</option>
				<option value="ZM">Zambia</option>
				<option value="ZW">Zimbabwe</option>
			</select>
		</div>
		<p>
			 Enter your account details below:
		</p>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
			<div class="controls">
				<div class="input-icon">
					<i class="fa fa-check"></i>
					<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword"/>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>
			<input type="checkbox" name="tnc"/> I agree to the <a href="javascript:;">
			Terms of Service </a>
			and <a href="javascript:;">
			Privacy Policy </a>
			</label>
			<div id="register_tnc_error">
			</div>
		</div>
		<div class="form-actions">
			<button id="register-back-btn" type="button" class="btn">
			<i class="m-icon-swapleft"></i> Back </button>
			<button type="submit" id="register-submit-btn" class="btn green-haze pull-right">
			Sign Up <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>-->
	<!-- END REGISTRATION FORM -->
</div></div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->

<div class="copyright">
     <!--Copyright@2016  AVA Marine &amp; Petro Inspect Group<br> All Rights Reserved.-->
</div>

<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?= base_url(); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?= base_url(); ?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?= base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
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
$('.logininput').keypress(function (e) {
           
            if (e.which == 13) {
             
              
                document.getElementById('loginButton').click();
           
                 return false;    //<---- Add this line
            }
        });

</script>
<style>
.text-danger{
    color: red;
}
.login .content p {
    color: red;
}
.logo.pull-right.logoright {
    padding-top: 4px;
}
</style>
<!-- END JAVASCRIPTS -->
</div>
</body>
<!-- END BODY -->
</html>