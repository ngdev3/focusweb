
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
                                    <input type="text" class="form-control" id="colorname" name="colorname"  value="<?php echo set_value("colorname", @$res->colorname); ?>">

                                    <div class="text-danger"><?php echo form_error("colorname"); ?></div>

                                    <label for="colorname">Color Scheme Name<span class="red_sign">*</span></label>

                                </div>
                            </div>

                             <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="color" class="form-control" id="background_name" name="background_name"  value="<?php echo set_value("background_name", @$res->background_name); ?>">
                                    <div class="text-danger"><?php echo form_error("background_name"); ?></div>

                                    <label for="background_name">Background Color<span class="red_sign">*</span></label>

                                </div>
                             </div>
                                               <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="color" class="form-control" id="font_color" name="font_color"  value="<?php echo set_value("font_color", @$res->font_color); ?>" >
                                    <div class="text-danger"><?php echo form_error("font_color"); ?></div>

                                    <label for="font_color">Font Color<span class="red_sign">*</span></label>

                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="color" class="form-control" id="button_color" name="button_color"  value="<?php echo set_value("button_color", @$res->button_color); ?>" >
                                    <div class="text-danger"><?php echo form_error("button_color"); ?></div>

                                    <label for="button_color">Button Color<span class="red_sign">*</span></label>

                                </div>
                            </div>

                            <!-- <div class="col-md-1 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" placeholder="" name="prefilled" value="+91" readonly class="form-control form-control-line">
                                </div>
                              </div>
                               <div class="col-md-5 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control numOnly" id="mobile" name="mobile"  value="<?php echo set_value("mobile", @$res->mobile); ?>">
                                    <div class="text-danger"><?php echo form_error("mobile"); ?></div>

                                    <label for="mobile">Contact Number<span class="red_sign">*</span></label>
                                </div>
                              </div> -->











                             <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="file" class="form-control imageOnly" id="profile_image" name="profile_image[]"  value="<?php echo set_value("profile_image", @$res->profile_image); ?>">
                                    <div class="text-danger"><?php echo form_error("address"); ?></div>

                                    <label for="profile_image" style="margin-top:-25px;">Profile Image</label>
                                </div>
                              </div>

                             -->



                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited" name="status" id="form_control_3">
                                        <option value="">Select Status</option>
                                        <option value="active"  <?php echo set_select('status', 'active', @$res->status == 'active' && !empty(@$res) ? true : false); ?>>Active</option>
                                        <option value="inactive"  <?php echo set_select('status', 'inactive', @$res->status == 'inactive' && !empty(@$res) ? true : false); ?>>Inactive</option>

                                    </select>
                                    <div class="text-danger"><?php echo form_error("status"); ?></div>

                                    <label for="form_control_3">Status<span class="red_sign">*</span></label>

                                </div>
                            </div>

                            <!--view of Image in Manager Edit -->
                            <?php if (@$res->id) {?>
                                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                 <img alt="" class="img-circle" src="<?php echo base_url(); ?>uploads/profile_image/<?php echo @$res->profile_image; ?>" height="100">
                                </div>
                              </div>
                            <?php }?>
                            <!--View of Image in admin/users edit -->


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12 text-center">
                            <div class="form-actions noborder">
                                <input  type="submit" class="btn blue mtr-20" value="Submit">
                                <a href="<?php echo base_url("admin/colors/listing"); ?>"class="btn default">Cancel</a>
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

                                    colorname:
                                            {
                                                required: true
                                         },
                                         background_name:
                                            {
                                                required: true
                                         },

                                        font_color:
                                            {
                                                required: true,
                                         },
                                        button_color:
                                            {
                                                required: true,
                                         },
                                          mobile:
                                            {
                                                required: true,
                                                minlength:10,
		                                maxlength:10,
                                                number:true
                                         },



                                       status:
                                            {
                                                required: true
                                            },



                                },
                        messages:
                                {

                                    colorname:
                                            {
                                                required: "Please Enter Color Scheme Name!"
                                            },
                                            background_name:
                                            {
                                                required: "Please Enter Background Color!"
                                            },

                                             font_color:
                                            {
                                                required: "Please Enter Font Color",
                                            },
                                             mobile:
                                            {
                                           required: "Please Enter Contact Number!",
                                           minlength: "The Contact Number field must be at least 10 characters in length.",
                                           maxlength: "The  Contact Number field cannot exceed 10 characters in length.",
                                           number: "The  Contact Number field must contain only numbers."
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