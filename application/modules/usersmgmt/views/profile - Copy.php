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
              
            </div>
           
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
                               <!--  <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span> -->
                            </div>
                            <ul class="nav nav-tabs">                             
                                
                                
                                    <form role="form" action="" method="post" id="update_form">
                                <div class="form-group">
                                    <label class="col-md-12">First Name</label>
                                    <div class="col-md-12">
                                        <input type="text" name="fname" placeholder="First Name" value="<?php echo $userData->fname; ?>" class="form-control form-control-line"> </div>
                                        <div class="input-error col-md-12"><?php echo form_error("fname"); ?></div>
                                        </div>
                                                                              
                

                                <div class="form-group">
                                    <label class="col-md-12">Last Name</label>
                                    <div class="col-md-12">
                                        <input type="text" name="lname" placeholder="Last Name"  value="<?php echo $userData->lname; ?>" class="form-control form-control-line"> </div>
                                        <div class="input-error col-md-12"><?php echo form_error("lname"); ?></div>
                                
                                </div>

                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" name="email" readonly value="<?php echo $userData->email; ?>" class="form-control form-control-line" name="example-email" id="example-email"> </div>
                                        <div class="input-error col-md-12"><?php echo form_error("email"); ?></div>
                                
                                </div>
                               <!--  <div class="form-group">
                                    <label class="col-md-12">Password</label>
                                    <div class="col-md-12">
                                        <input type="password" value="password" class="form-control form-control-line"> </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="col-md-12">Phone No</label>
                                    <div class="col-md-12">
                                        <input type="text" name="mobile"  placeholder="Phone No" value="<?php echo $userData->mobile; ?>" class="form-control form-control-line"> </div>
                                        <div class="input-error col-md-12"><?php echo form_error("mobile"); ?></div>
                                
                                </div>
                                <!-- <div class="form-group">
                                    <label class="col-md-12">Message</label>
                                    <div class="col-md-12">
                                        <textarea rows="5" class="form-control form-control-line"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12">Select Country</label>
                                    <div class="col-sm-12">
                                        <select class="form-control form-control-line">
                                            <option>London</option>
                                            <option>India</option>
                                            <option>Usa</option>
                                            <option>Canada</option>
                                            <option>Thailand</option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">Update Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>


                <script>
                 $("#update_form").validate(
            {
                errorElement: 'span', //default input error message container
                errorClass: 'text-danger', // default input error message class
                rules:
                        {
                            fname:
                                    {
                                        required: true
                                    },
                           
                           
                            lname:
                            
                            {
                                required: true
                            },
                            email:
                                    {
                                        required: true,
                                        email: true
                                    },
                           
                            mobile:
                                    {
                                        required: true,
                                        minlength:8,
		                                maxlength:14
	 
                                    },
                                    
                        },
                messages:
                        {
                            fname:
                                    {
                                        required: "Please Enter First Name."
                                    },
                           
                                      lname:{
                                required:"Please Enter last Name."
                            }
                            ,
                            email:
                                    {
                                        required: "Please Enter email.",
                                        email: "Please enter a valid email address"
                                    },
                                    mobile:
                                    {
                                        required: "Please Enter Mobile number.",
                                        minlength: "Your phone no must be at least 8 characters long",
                                        maxlength: "Your phone no should not be more than 14 characters long"
                                    },
                        }
            });
</script>