

<div class="tab-pane" id="tab_2">
    <div class="portlet light">

        <div class="portlet-title">
            <div class="caption"> <i class="fa fa-list font-red-sunglo"></i>
                <span class="caption-subject font-red-sunglo bold uppercase"> <?php echo $page_title; ?> </span>
            </div>
        </div>


        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="" class="form-horizontal" method="post">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">First Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="First Name" value="<?php echo set_value("fname",@$res->fname); ?>" name="fname">
                                <span class="help-block text-danger"> <?php echo form_error("fname"); ?></span> </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Last Name</label>
                            <div class="col-md-9">
                                  <input type="text" class="form-control" placeholder="Last Name" value="<?php echo set_value("lname",@$res->lname); ?>" name="lname">
                                <span class="help-block text-danger"> <?php echo form_error("lname"); ?></span>
<!--                                <span class="help-block"> This field has error. </span> </div>-->
                            </div>
                        </div>
                        <!--/span--> 
                    </div>          
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo set_value("email",@$res->email); ?>">
                                <span class="help-block text-danger"> <?php echo form_error("email"); ?></span> </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Mobile</label>
                            <div class="col-md-9">
                                  <input type="text" class="form-control" placeholder="Mobile" name="mobile" value="<?php echo set_value("mobile",@$res->mobile); ?>">                               
                                    <span class="help-block text-danger"> <?php echo form_error("mobile"); ?></span> </div>
                            </div>
                        </div>
                        <!--/span--> 
                    </div>  
                                <?php if(empty(@$res)) { ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo set_value("password"); ?>" minlength="6">
                                <span class="help-block text-danger"> <?php echo form_error("password"); ?></span> </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Confirm Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword" value="<?php echo set_value("cpassword"); ?>" minlength="6">
                                <span class="help-block text-danger"> <?php echo form_error("cpassword"); ?></span> </div>
                        </div>
                    </div>          
                </div>
                
                                <?php }?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Role</label>
                            <div class="col-md-9">
                                 <select name="role" class="select2me form-control" >
                                  <option value="">Select</option>
                                  <?php foreach(@$roles as $value){ ?>
                                  <option value="<?php echo $value->id; ?>" <?php echo set_select('role', $value->id, $value->id == @$res->role ? TRUE : FALSE); ?> ><?php echo $value->role_name; ?></option>
                                  <?php } ?>
                                </select>
                                <span class="help-block text-danger"> <?php echo form_error("role"); ?></span> </div>
                        </div>
                    </div>
                    <?php //pr($res->assign_company);?>
                   
                    
                    </div>
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Status</label>
                            <div class="col-md-9">
                               <select name="status" class="select2me form-control" >
                                                <option value="">Select</option>
                                                  <option value="1"  <?php echo set_select('status', '1', @$res->status == '1' && !empty(@$res) ? TRUE : FALSE); ?>>Active</option>
                                                  <option value="0"  <?php echo set_select('status', '0', @$res->status == '0' && !empty(@$res) ? TRUE : FALSE); ?>>Inactive</option>                                  
                                  </select>
                                <span class="help-block text-danger"> <?php echo form_error("role"); ?></span> </div>
                         </div>
                    </div>
                    <!--/span-->
<!--                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Confirm Password</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Confirm Password" name="cpassword">
                                <span class="help-block text-danger"> <?php echo form_error("cpassword"); ?></span> </div>
                        </div>
                    </div>          -->
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="text-center">
                                    <button type="submit" class="btn green"> Submit</button>
                                    <button type="button" class="btn default cancel">Cancel</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
            <!-- END FORM--> 
        </div>


    </div>
</div>

    <script>
        $('#role_form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                role_name: {
                    required: true,
                    alpha : true
                    //maxlength: 20,
                }           		
            },

            messages: { // custom messages for radio buttons and checkboxes
                role_name: {
                    required: "Please Enter Role name .",
                    alpha: "Accept Character Only ."
                    //maxlength: "Please Enter more than 20 character. ",
                }          
		
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   

            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            }

        });
        $(document).ready(function(){
            jQuery.validator.addMethod("noSpace", function(value, element) { 
                return value.indexOf(" ") < 0 && value != ""; 
            }, "No space please and don't leave it empty");

            jQuery.validator.addMethod("alpha", function(value, element) {
                return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
            });
        });

        $('#addScnt').click(function(){
	
            add_content='<div class="test"><textarea class="form-control pull-left " placeholder="Address" name="address[]" id="address"></textarea><a class="del_more btn btn-danger pull-left"> <i class="fa fa-trash" aria-hidden="true"></i> delete</a></div>';
            $('#p_scents').append(add_content);
        }); 
        $(document).on('click', '.del_more',function() {  // for deleting new records
            $(this).parent().remove();
        });

    </script>
    
    