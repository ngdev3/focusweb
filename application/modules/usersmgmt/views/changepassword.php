<style>
    
    .form-material .form-group {
    overflow: hidden;
    height: auto;
}
.user-bg .overlay-box {
    background: #959fab;;
    opacity: .9;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 100%;
    text-align: center;
}
    .user-bg .overlay-box .user-content {
    padding: 15px;
    margin-top: 30px;
}
.white-box {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
}
.user-bg {
    margin: -25px;
    height: 230px;
    overflow: hidden;
    position: relative;
}
.thumb-lg {
    height: 88px;
    width: 88px;
}
.text-white {
    color: #fff;
}

h4 {
    line-height: 22px;
    font-size: 18px;
}

.form-group span.text-danger {
    color: #ff0000;
    position: relative;
}
.text-danger p {
    margin: 0;
    position: relative;
}
    </style>


    </style>
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
.text-danger{
    color:red;
}
</style>

<div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">


<!-- SIDEBAR USERPIC -->
<div class="profile-userpic">
				
				<form id="imageform" method="post" action="<?php echo base_url();?>users/profilepic" enctype="multipart/form-data">
				<input id="upload" type="file" name="upload"/>
				</form>
             
                  
                </div>
                <!-- END SIDEBAR USERPIC -->


                            <div class="user-bg"> 
                                <div class="overlay-box">
                                    <div class="user-content">

                                       <a href="" id="upload_link">
                              
                              <img src="<?php echo base_url(); ?>uploads/profile_image/<?php echo  ($userData->profile_image !="")?$userData->profile_image:'default.png'; ?>" class=" thumb-lg img-circle" alt="">
                              </a>


                                       
                                       
                                       
                                       
                                        <h4 class="text-white"><?php echo $userData->fname." ".$userData->lname; ?></h4>
                                        <h5 class="text-white"><?php echo $userData->email; ?></h5> </div>
                                </div>
                            </div>
                              <?php if($userData->role=="1"){ ?>
                            <div class="user-btm-box">
                                <div class="col-md-4 col-sm-4 text-center">
                                    <p class="text-purple"><i class="ti-facebook"></i></p>
                                    <h1><?php echo $userData->admission_number; ?></h1> </div>
                               
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <form class="form-horizontal form-material" id="password_form" method="post">
                                <div class="form-group form-md-line-input form-md-floating-label">

                                    <label class="col-md-12"><b>Current Password</b><span class="red_sign">*</span></label>
                                    <div class="col-md-12">
                                    
                                        <input type="password" placeholder="Current Password"  name="current_password" value="<?php echo set_value("current_password"); ?>"class="form-control form-control-line">
                                        <div class="text-danger" class="input-error col-md-12"><?php echo form_error("current_password"); ?></div>
                                </div>
                                </div>
                                <div class="form-group form-md-line-input form-md-floating-label">
                                <label class="col-md-12"><b>New Password</b><span class="red_sign">*</span></label>
                                 
                                    <div class="col-md-12">
                                         <input type="password" placeholder="New Password" name="new_password" value="<?php echo set_value("new_password"); ?>" minlength="6" class="form-control form-control-line">
                                        <div class="text-danger" class="input-error col-md-12"><?php echo form_error("new_password"); ?></div>
                                </div>
                                </div>
                                <div class="form-group form-md-line-input form-md-floating-label">
                                <label class="col-md-12"><b>Confirm Password</b><span class="red_sign">*</span></label>
                                  
                                    <div class="col-md-12">
                                         <input type="password" placeholder="Confirm Password" name="retype_new_password" value="<?php echo set_value("retype_new_password"); ?>" minlength="6" class="form-control form-control-line" name="example-email" id="example-email"> 
                                        <div class="text-danger" class="input-error col-md-12"><?php echo form_error("retype_new_password"); ?></div>
                                        </div>
                                </div>
                               <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">Update</button>
                                        <a href="<?php echo base_url("users/profile"); ?>"><button type="button" class="btn btn-success"> Back</button> </a>
                                
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->



                  <script>
                 $("#password_form").validate(
            {
                errorElement: 'span', //default input error message container
                errorClass: 'text-danger', // default input error message class
                rules:
                        {
                            current_password:
                                    {
                                        required: true
                                    },
                           
                           
                            new_password:
                                    {
                                        required: true,
                                        minlength:6,
                                        maxlength:10

                                    },
                            retype_new_password:
                                    {
                                        required: true,
                                        minlength:6,
                                        maxlength:10

                                    },
                            
                                    
                        },
                messages:
                        {
                            current_password:
                                    {
                                        required: "The Current Password field is required."
                                    },
                           
                                    new_password:
                                    {
                                        required: "The New Password field is required.",
                                        minlength: "Your New Password must be at least 6 characters long",
                                        maxlength: "Your New Password must not exceed 10 characters length"
                                        
                                    },
                                    retype_new_password:
                                    {
                                        required: "The Confirm Password field is required.",
                                        minlength: "Your Confirm Password must be at least 6 characters long",
                                        maxlength: "Your Confirm Password must not exceed 10 characters length"
                                        
                                        
                                    },
                        }
            });

            $(".btn-success").click(function(){

                   $(".text-danger").html("");
            });
</script>