<style>
    .form-group span.text-danger {
    color: #ff0000;
    position: relative;
}
.text-danger p {
    margin: 0;
    position: relative;
}
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
                              
                              <img src="<?php echo base_url(); ?>uploads/profile_image/<?php echo  ($userData->profile_image !="" || $userData->profile_image !=null)?$userData->profile_image:'default.png'; ?>" class=" thumb-lg img-circle" alt="">
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
                            <form class="form-horizontal form-material" id="update_form" method="post">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <label class="col-md-12">First Name<span class="red_sign">*</span></label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="First Name"  name="fname" value="<?php echo $userData->fname; ?>"class="form-control form-control-line"> </div>
                                        <div  class="text-danger" class="input-error col-md-12"><?php echo form_error("fname"); ?></div>
                                </div>
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <label class="col-md-12">Last Name<span class="red_sign">*</span></label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Last Name" name="lname" value="<?php echo $userData->lname; ?>"class="form-control form-control-line"> </div>
                                        <div  class="text-danger" class="input-error col-md-12"><?php echo form_error("lname"); ?></div>
                                </div>
                                
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <label for="example-email" class="col-md-12">Email<span class="red_sign">*</span></label>
                                    <div class="col-md-12">
                                        <input type="email" placeholder="Email" name="email" value="<?php echo $userData->email; ?>" readonly class="form-control form-control-line" name="example-email" id="example-email"> </div>
                                        <div  class="text-danger" class="input-error col-md-12"><?php echo form_error("email"); ?></div>
                               
                                </div>
                               <!--  <div class="form-group">
                                    <label class="col-md-12">Password<span class="red_sign">*</span></label>
                                    <div class="col-md-12">
                                        <input type="password" value="password" class="form-control form-control-line"> </div>
                                </div> -->
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <label class="col-md-12">Mobile Number<span class="red_sign">*</span></label>
                                    <div class="col-md-1">
                                        <input type="text" placeholder="" name="prefilled" value="+91" readonly class="form-control form-control-line">
                                    </div>
                                    <div class="col-md-11">
                                        <input type="text" placeholder="Mobile Number" name="mobile" value="<?php echo $userData->mobile_no; ?>" class="form-control numOnly form-control-line"> </div>
                                        <div  class="text-danger" class="input-error col-md-12"><?php echo form_error("mobile"); ?></div>
                               
                                </div>
                                
                                 <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">Update Profile</button>
                                        <a href="<?php echo base_url("dashboard"); ?>"><button type="button" class="btn btn-success">Back</button> </a>
                                
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->



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
                                        number:true,
                                        minlength:10,
		                                maxlength:10
                                       
	 
                                    },
                                    
                        },
                messages:
                        {
                            fname:
                                    {
                                        required: "The First Name field is required."
                                    },
                           
                                      lname:{
                                required:"The Last Name field is required."
                            }
                            ,
                            email:
                                    {
                                        required: "The Email field is required.",
                                        email: "Please enter a valid Email address"
                                    },
                                    mobile:
                                    {
                                        required: "The Mobile Number field is required.",
                                        number: "The Mobile Number field must contain only numbers.",
                                        minlength: "The Mobile Number field must be at least 10 characters in length.",
                                        maxlength: "The Mobile Number field cannot exceed 10 characters in length."
                                    },
                        }
            });
</script>


<script> 
$(document).ready(function() {
   
   $(".numOnly").keydown(function (e) {
   //$('#mobile_number_id').html('');

       // Allow: backspace, delete, tab, escape, enter and .
       if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
            // Allow: Ctrl+A, Command+A
           (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right, down, up
           (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
       }
       // Ensure that it is a number and stop the keypress
       if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
    // $('#mobile_number_id').html('');
           e.preventDefault();
       }
   else{
   //  $('#mobile_number_id').html("");
   }
   });
});



</script> 
	