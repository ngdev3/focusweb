<script src="<?= base_url(); ?>assets/global/plugins/jquery.form.js"></script>

<script>

$( document ).ready(function( $ ) {
$("#upload_link").on('click', function(e){
    e.preventDefault();
    $("#upload:hidden").trigger('click');
});




$('#upload').live('change', function() {
//$("#upload_link").html('Uploading....');
$("#imageform").ajaxForm({
	target: '#upload_link',
	beforeSend: function (){ $(".profile-usertitle-job").html('Uploading....') },
	success:function(){
		window.location.reload();
	}
}).submit();



});
});



</script>
<style>
#upload_link{
    text-decoration:none;
}
#upload{
    display:none
}
</style>

<div class="row ">
    <div class="col-md-3">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar" style="width:250px;">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
				
				<form id="imageform" method="post" action="<?php echo base_url();?>users/profilepic" enctype="multipart/form-data">
				<input id="upload" type="file" name="upload"/>
				</form>
             
                   <a href="" id="upload_link">
                              
				   <img src="<?php echo base_url(); ?>uploads/profile_image/<?php echo  ($userData->profile_image !="")?$userData->profile_image:'default.png'; ?>" class="img-responsive" alt="">
				   </a>
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                       <div class="text-center">
              <h4 class="profile" style="font-weight: bold;color:#848484e6;"><?php echo ucwords($userData->fullname); ?></h4>
            </div>
                    </div>
                    <div class="profile-usertitle-job" style="text-align:center;font-weight: bold;">
                        <?php echo $userData->id != '1'?ucfirst($userData->role_name):''; ?>
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <!--							<div class="profile-userbuttons">
                                                                                <button type="button" class="btn btn-circle green-haze btn-sm">Follow</button>
                                                                                <button type="button" class="btn btn-circle btn-danger btn-sm">Message</button>
                                                                        </div>-->
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
<!--                <div class="profile-usermenu">
                    <ul class="nav">
                        <li>
                            <a href="extra_profile.html">
                                <i class="icon-home"></i>
                                Overview </a>
                        </li>
                        <li class="active">
                            <a >
                                <i class="icon-settings"></i>
                                Account Settings </a>
                        </li>
                        <li >
                            <a>
                                <i class="icon-settings"></i>
                               Other Info </a>
                        </li>
                        <li>
                            <a href="page_todo.html" target="_blank">
                                <i class="icon-check"></i>
                                Tasks </a>
                        </li>
                        <li>
                            <a href="extra_profile_help.html">
                                <i class="icon-info"></i>
                                Help </a>
                        </li>
                    </ul>
                </div>-->
                <!-- END MENU -->
            </div>
            <!-- END PORTLET MAIN -->
            <!-- PORTLET MAIN -->
            <!--						<div class="portlet light">
                                                                     STAT 
                                                                    <div class="row list-separated profile-stat">
                                                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                                                    <div class="uppercase profile-stat-title">
                                                                                             37
                                                                                    </div>
                                                                                    <div class="uppercase profile-stat-text">
                                                                                             Projects
                                                                                    </div>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                                                    <div class="uppercase profile-stat-title">
                                                                                             51
                                                                                    </div>
                                                                                    <div class="uppercase profile-stat-text">
                                                                                             Tasks
                                                                                    </div>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                                                    <div class="uppercase profile-stat-title">
                                                                                             61
                                                                                    </div>
                                                                                    <div class="uppercase profile-stat-text">
                                                                                             Uploads
                                                                                    </div>
                                                                            </div>
                                                                    </div>
                                                                     END STAT 
                                                                    <div>
                                                                            <h4 class="profile-desc-title">About Marcus Doe</h4>
                                                                            <span class="profile-desc-text"> Lorem ipsum dolor sit amet diam nonummy nibh dolore. </span>
                                                                            <div class="margin-top-20 profile-desc-link">
                                                                                    <i class="fa fa-globe"></i>
                                                                                    <a href="http://www.keenthemes.com">www.keenthemes.com</a>
                                                                            </div>
                                                                            <div class="margin-top-20 profile-desc-link">
                                                                                    <i class="fa fa-twitter"></i>
                                                                                    <a href="http://www.twitter.com/keenthemes/">@keenthemes</a>
                                                                            </div>
                                                                            <div class="margin-top-20 profile-desc-link">
                                                                                    <i class="fa fa-facebook"></i>
                                                                                    <a href="http://www.facebook.com/keenthemes/">keenthemes</a>
                                                                            </div>
                                                                    </div>
                                                            </div>-->
            <!-- END PORTLET MAIN -->
            </div>
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="col-md-9">
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                            </div>
                            <ul class="nav nav-tabs">                             
                                
                                <li class="<?php echo (@$_GET['tab'] != "change_password" || empty($_GET['tab']) )?"active":""; ?>" onclick='window.location.href="<?php echo base_url('users/profile/'.  encode($userData->id).'?tab=personal_info'); ?>"' >
                                 <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                </li>
                                <!--											<li>
                                                                                                                                <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
                                                                                                                        </li>-->
                                
                                <li class="<?php echo (@$_GET['tab'] == "change_password")?"active":""; ?>" onclick='window.location.href="<?php echo base_url('users/profile/'.  encode($userData->id).'?tab=change_password'); ?>"'>
                                    <a href="#" data-toggle="tab">Change Password</a>
                                </li>
                                <!--											<li>
                                                                                                                                <a href="#tab_1_4" data-toggle="tab">Privacy Settings</a>
                                                                                                                        </li>-->
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane <?php echo (@$_GET['tab'] != "change_password" || empty($_GET['tab']) )?"active":""; ?>" id="tab_1_1">
                                    <form role="form" action="" method="post">
                                        <div class="form-group">
                                            <label class="control-label">First Name</label>
                                            <input type="text" placeholder="First Name" class="form-control" name="fname" value="<?php echo set_value("fname",$userData->fname); ?>" />
                                             <span class="help-block text-danger"> <?php echo form_error("fname"); ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" placeholder="" class="form-control" name="lname" value="<?php echo set_value("lname",$userData->lname); ?>" />
                                              <span class="help-block text-danger"> <?php echo form_error("lname"); ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="text" placeholder="" class="form-control" name="email" value="<?php echo $userData->email; ?>" readonly="" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Mobile</label>
                                            <input type="text" placeholder="" class="form-control" name="mobile" value="<?php echo $userData->mobile; ?>" />
                                               <span class="help-block text-danger"> <?php echo form_error("mobile"); ?></span> 
                                        </div>
                                        
                                          <input type="hidden" placeholder="" class="form-control" name="role" value="<?php echo $userData->role; ?>" />
                                        
<!--                                        <div class="form-group">
                                            <label class="control-label">Role</label>
                                            <select name="role" class="select2me form-control" >
                                                <option value="">Select</option>
                                                <?php foreach (@$roles as $value) { ?>
                                                    <option value="<?php echo $value->id; ?>" <?php echo set_select("role", $value->id,$value->id==$userData->role?TRUE:FALSE); ?> ><?php echo $value->role_name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="help-block text-danger"> <?php echo form_error("role"); ?></span> 
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Status</label>
                                            <select name="status" class="select2me form-control" >
                                                <option value="">Select</option>
                                                <option value="1" <?php echo set_select('status',"1",$userData->status=="1"?TRUE:FALSE)?>>Active</option>
                                                <option value="0" <?php echo set_select('status',"0",$userData->status=="0"?TRUE:FALSE)?>>Inactive</option>
                                                
                                            </select>
                                        </div>-->
                                        <!--													<div class="form-group">
                                                                                                                                                        <label class="control-label">Interests</label>
                                                                                                                                                        <input type="text" placeholder="Design, Web etc." class="form-control"/>
                                                                                                                                                </div>
                                                                                                                                                <div class="form-group">
                                                                                                                                                        <label class="control-label">Occupation</label>
                                                                                                                                                        <input type="text" placeholder="Web Developer" class="form-control"/>
                                                                                                                                                </div>
                                                                                                                                                <div class="form-group">
                                                                                                                                                        <label class="control-label">About</label>
                                                                                                                                                        <textarea class="form-control" rows="3" placeholder="We are KeenThemes!!!"></textarea>
                                                                                                                                                </div>
                                                                                                                                                <div class="form-group">
                                                                                                                                                        <label class="control-label">Website Url</label>
                                                                                                                                                        <input type="text" placeholder="http://www.mywebsite.com" class="form-control"/>
                                                                                                                                                </div>-->
                                        <div class="margiv-top-10">
                                           
                                    <button type="submit" class="btn green"> Submit</button>
                                                <a href="<?php echo base_url("dashboard"); ?>"><button type="button" class="btn default"><i class="fa fa-ban"></i> Cancel</button> </a>
                                
                                        </div>
                                    </form>
                                </div>
                                <!-- END PERSONAL INFO TAB -->
                                <!-- CHANGE AVATAR TAB -->
                                <div class="tab-pane" id="tab_1_2">
                                    <p>
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                    </p>
                                    <form action="#" role="form">
                                        <div class="form-group">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                </div>
                                                <div>
                                                    <span class="btn default btn-file">
                                                        <span class="fileinput-new">
                                                            Select image </span>
                                                        <span class="fileinput-exists">
                                                            Change </span>
                                                        <input type="file" name="...">
                                                    </span>
                                                    <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput">
                                                        Remove </a>
                                                </div>
                                            </div>
                                            <div class="clearfix margin-top-10">
                                                <span class="label label-danger">NOTE! </span>
                                                <span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                            </div>
                                        </div>
                                        <div class="margin-top-10">
                                            <a href="javascript:;" class="btn green-haze">
                                                Submit </a>
                                            <a href="javascript:;" class="btn default">
                                                Cancel </a>
                                        </div>
                                    </form>
                                </div>
                                <!-- END CHANGE AVATAR TAB -->
                                <!-- CHANGE PASSWORD TAB -->
                                <div class="tab-pane <?php echo (@$_GET['tab'] == "change_password" && @$_GET['tab'] != "personal_info" ) ?"active":""; ?>" id="tab_1_3">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label class="control-label" >Current Password</label>
                                            <input type="password" class="form-control" name="current_password" value="<?php echo set_value("current_password"); ?>"/>
                                            <span class="help-block text-danger"> <?php echo form_error("current_password"); ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" >New Password</label>
                                            <input type="password" class="form-control" name="new_password" value="<?php echo set_value("new_password"); ?>" minlength="6"/>
                                            <span class="help-block text-danger"> <?php echo form_error("new_password"); ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" >Re-type New Password</label>
                                            <input type="password" class="form-control" name="retype_new_password" value="<?php echo set_value("retype_new_password"); ?>" minlength="6"/>
                                            <span class="help-block text-danger"> <?php echo form_error("retype_new_password"); ?></span>
                                        </div>
                                        <div class="margin-top-10">
                                            <button type="submit" class="btn green"> Submit</button>
                                            <a href="<?php echo base_url("dashboard"); ?>"><button type="button" class="btn default"><i class="fa fa-ban"></i> Cancel</button> </a>
                                        </div>
                                    </form>
                                </div>
                                <!-- END CHANGE PASSWORD TAB -->
                                <!-- PRIVACY SETTINGS TAB -->
                                <div class="tab-pane" id="tab_1_4">
                                    <form action="#">
                                        <table class="table table-light table-hover">
                                            <tr>
                                                <td>
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus..
                                                </td>
                                                <td>
                                                    <label class="uniform-inline">
                                                        <input type="radio" name="optionsRadios1" value="option1"/>
                                                        Yes </label>
                                                    <label class="uniform-inline">
                                                        <input type="radio" name="optionsRadios1" value="option2" checked/>
                                                        No </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Enim eiusmod high life accusamus terry richardson ad squid wolf moon
                                                </td>
                                                <td>
                                                    <label class="uniform-inline">
                                                        <input type="checkbox" value=""/> Yes </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Enim eiusmod high life accusamus terry richardson ad squid wolf moon
                                                </td>
                                                <td>
                                                    <label class="uniform-inline">
                                                        <input type="checkbox" value=""/> Yes </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Enim eiusmod high life accusamus terry richardson ad squid wolf moon
                                                </td>
                                                <td>
                                                    <label class="uniform-inline">
                                                        <input type="checkbox" value=""/> Yes </label>
                                                </td>
                                            </tr>
                                        </table>
                                        <!--end profile-settings-->
                                        <div class="margin-top-10">
                                            <a href="javascript:;" class="btn green-haze">
                                                Save Changes </a>
                                            <a href="javascript:;" class="btn default">
                                                Cancel </a>
                                        </div>
                                    </form>
                                </div>
                                <!-- END PRIVACY SETTINGS TAB -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>


</div>