
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
                                                        <input type="text" class="form-control numOnly" id="form_control_1" name="otp"  value="<?php echo set_value("otp", @$res->otp); ?>">
                                                          <div class="text-danger"><?php echo form_error("otp"); ?></div>

                                                        <label for="form_control_1">OTP<span class="red_sign">*</span></label>
<!--                                                        <span class="help-block">Your Product Name goes here...</span>-->
                                                        
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
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xs-12 col-sm-12 text-center">
                                                    <div class="form-actions noborder">
                                                        <input  type="submit" class="btn blue mtr-20" value="Submit">
                                                        <a href="<?php echo base_url("masters/otp/list_items"); ?>"class="btn default">Cancel</a>
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
                            otp:
                                    {
                                        required: true,
                                        number:true,
                                        minlength:4,
                                        maxlength:4
                                    },
                           
                           
                           
                            status:
                            
                                    {
                                        required: true
                                    },
                            
                                            
                        },
                messages:
                        {
                            otp:
                                    {
                                        required: "Please Enter OTP!",
                                        minlength: "The OTP field must be exactly 4 characters in length.",
                                        maxlength: "The OTP field must be exactly 4 characters in length.",
                                        number:"The OTP field must contain only numbers."
                                      
                                    },
                                    
                            status:
                                    {
                                        required: "Please Select Status!"
                                    },
                          
                        }
            });

</script>

<!-- validate mobile number takes only numeric values -->

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
	