
<!--New Form Starts-->
<h1 class="page-title" style="font-weight: 500"> <?php echo $page_title; ?> 
                            <!-- <small>Lorem Ipsum is dummy text of the printing industry.</small> -->
</h1>
<div class="row">

    <div class="portlet light bordered">
        <div class="portlet-title">


            <div class="portlet-body form add_prodcut_form">
                <form role="form" id="add_form" method="post" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control" id="employee_id" name="employee_id" readonly value="<?php if($emp_id){echo $emp_id;}else{echo set_value("employee_id", @$res->employee_id);} ?>" <?php if(@$res->id){echo "readonly";}?>>
                                    <div class="text-danger"><?php echo form_error("employee_id"); ?></div>

                                    <label for="employee_id">Employee Id</label>

                                </div>
                            </div>
                            
                            
                            
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control" id="fname" name="fname"  value="<?php echo set_value("fname", @$res->fname); ?>">
                                    <div class="text-danger"><?php echo form_error("fname"); ?></div>

                                    <label for="fname">First Name<span class="red_sign">*</span></label>

                                </div>
                            </div>
                            
                             <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control" id="lname" name="lname"  value="<?php echo set_value("lname", @$res->lname); ?>">
                                    <div class="text-danger"><?php echo form_error("lname"); ?></div>

                                    <label for="lname">Last Name<span class="red_sign">*</span></label>

                                </div>
                             </div>
                            
                            
                           
                            
               
                            
                            
                                       <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited" name="gender" id="gender">
                                        <option value="">Select Gender</option>
                                        <option value="1"  <?php echo set_select('gender', '1', @$res->gender == '1' && !empty(@$res) ? TRUE : FALSE); ?>>Male</option>
                                        <option value="0"  <?php echo set_select('gender', '0', @$res->gender == '0' && !empty(@$res) ? TRUE : FALSE); ?>>Female</option>              
                                        <option value="2"  <?php echo set_select('gender', '2', @$res->gender == '2' && !empty(@$res) ? TRUE : FALSE); ?>>Others</option> 
                                    </select>
                                    <div class="text-danger"><?php echo form_error("gender"); ?></div>

                                    <label for="gender">Gender<span class="red_sign">*</span></label>

                                </div>
                            </div>
                            
                            
                                               <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control" id="email" name="email"  value="<?php echo set_value("email", @$res->email); ?>" <?php if(@$res->id){echo "readonly";}?>>
                                    <div class="text-danger"><?php echo form_error("email"); ?></div>

                                    <label for="email">Email Id<span class="red_sign">*</span></label>

                                </div>
                            </div>
                                
                            <div class="col-md-1 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" placeholder="" name="prefilled" value="+91" readonly class="form-control form-control-line"> 
                                </div>
                              </div>
                               <div class="col-md-5 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control numOnly" id="mobile" name="mobile"  value="<?php echo set_value("mobile", @$res->mobile); ?>" <?php if(@$res->id){echo "readonly";}?>>
                                    <div class="text-danger"><?php echo form_error("mobile"); ?></div>

                                    <label for="mobile">Contact Number<span class="red_sign">*</span></label>
                                </div>
                              </div>
                            
                            
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control" id="address" name="address"  value="<?php echo set_value("address", @$res->address); ?>">
                                    <div class="text-danger"><?php echo form_error("address"); ?></div>

                                    <label for="address">Address<span class="red_sign">*</span></label>
                                </div>
                              </div>
                            
                            
  
                            
                            
                         
                            
                          
                                                      
                             <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="file" class="form-control imageOnly" id="profile_image" name="profile_image[]"  value="<?php echo set_value("profile_image", @$res->profile_image); ?>">
                                    <div class="text-danger"><?php echo form_error("address"); ?></div>

                                    <label for="profile_image" style="margin-top:-25px;">Profile Image</label>
                                </div>
                              </div>
                            
                            
                            
                            
                      
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited" name="status" id="form_control_3">
                                        <option value="">Select Status</option>
                                        <option value="1"  <?php echo set_select('status', '1', @$res->status == '1' && !empty(@$res) ? TRUE : FALSE); ?>>Active</option>
                                        <option value="0"  <?php echo set_select('status', '0', @$res->status == '0' && !empty(@$res) ? TRUE : FALSE); ?>>Inactive</option>              

                                    </select>
                                    <div class="text-danger"><?php echo form_error("status"); ?></div>

                                    <label for="form_control_3">Status<span class="red_sign">*</span></label>

                                </div>
                            </div>
                            
                            <!--view of Image in Manager Edit -->
                            <?php if(@$res->id){ ?>
                                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                 <img alt="" class="img-circle" src="<?php echo base_url(); ?>uploads/profile_image/<?php echo @$res->profile_image;?>" height="100">
                                </div>
                              </div>
                            <?php }?>
                            <!--View of Image in backendteam edit -->
                            
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12 text-center">
                            <div class="form-actions noborder">
                                <input  type="submit" class="btn blue mtr-20" value="Submit">
                                <a href="<?php echo base_url("backendteam/list_items"); ?>"class="btn default">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->


        <!--New Form Ends---->


        <script>
            $("#add_form").validate(
                    {
                        errorElement: 'span', //default input error message container
                        errorClass: 'text-danger', // default input error message class
                        rules:
                                {
                                    employee_id:
                                            {
                                                required: true
                                            },
                                    fname:
                                            {
                                                required: true
                                         },
                                         lname:
                                            {
                                                required: true
                                         },
                                         gender:
                                            {
                                                required: true
                                         },
                                        email:
                                            {
                                                required: true,
                                                email: true,
                                         },
                                          mobile:
                                            {
                                                required: true,
                                                minlength:10,
		                                maxlength:10,
                                                number:true
                                         },
                                         
                                         address:
                                            {
                                                required: true
                                         },
                                         
                                         
                                       status:
                                            {
                                                required: true
                                            },
                                            
                                            
                                            
                                },
                        messages:
                                {
                                    employee_id:
                                            {
                                                required: "Please Enter Employee Id!"
                                            },
                                    fname:
                                            {
                                                required: "Please Enter First Name!"
                                            },
                                            lname:
                                            {
                                                required: "Please Enter Last Name!"
                                            },
                                            
                                             email:
                                            {
                                                required: "Please Enter Email Id!",
                                                email: "The Email id field must contain a valid email address."
                                            },
                                             mobile:
                                            {
                                           required: "Please Enter Contact Number!",
                                           minlength: "The Contact Number field must be at least 10 characters in length.",
                                           maxlength: "The  Contact Number field cannot exceed 10 characters in length.",
                                           number: "The  Contact Number field must contain only numbers."
                                            },
                                            
                                             address:
                                            {
                                                required: "Please Enter Address!"
                                            },
                                            
                                             gender:
                                            {
                                                required: "Please Select Gender!"
                                            },
                                    status:
                                            {
                                                required: "Please Select Status!"
                                            },
                                            
                                           
                                            
                                            
                                            
                                            
                                }
                    });

        </script>
        
        
        <script>
            
            $(function(){
    $('.imageOnly').change( function(e) {
        
       // alert();
      var files = e.originalEvent.target.files;
      var selected = $(this);
      $('.invalid-format').hide();
      for (var i=0, len=files.length; i<len; i++){
        var fileNameExt = files[i].name.substr(files[i].name.lastIndexOf('.') + 1);
        //console.log(files[i].name, files[i].type, files[i].size);
        if($.inArray(fileNameExt, ['jpg','jpeg', 'gif', 'png', 'JPG', 'JPEG', 'GIF', 'PNG']) == -1) {
            $(selected).after('<span class="invalid-format" style="text-decoration:none;color:red;">Please upload image file ( jpg,jpeg, gif, png) only.<span>');
          $(selected).val('');
          }
      }
         });
  });

            </script>
<!-- validate mobile number takes only numeric values -->

<script>
    $(document).ready(function () {

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
                    } else {
//  $('#mobile_number_id').html("");
                    }
                });
    });




</script> 