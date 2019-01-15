
<!DOCTYPE html >
<html>
    <head>
        <meta http-equiv="Content-Type"/>
    </head>
    <body>
        <?php //include 'header.php';?>
        <div class="clearfix">
        </div>
        <!-- BEGIN CONTAINER -->
        <div class="page-container">

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">

                <!-- BEGIN PAGE HEAD -->
                <div class="page-head">
                    <div class="container">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">

                            <h1> Role Form </h1>

                        </div>
                        <!-- END PAGE TITLE -->

                    </div>
                </div>

                <div class="page-content">
                    <div class="container">

                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <a href="index.php">Home</a><i class="fa fa-circle"></i>
                            </li>
                            <li class="active">
                                Edit Role
                            </li>
                        </ul>

                        <!-- BEGIN PAGE CONTENT INNER -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs font-blue"></i>
                                            <span class="caption-subject font-blue bold uppercase"> Edit Role</span>
                                        </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="" title="">
                                            </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
                                            </a>
                                            <a href="javascript:;" class="reload" data-original-title="" title="">
                                            </a>
                                            <a href="javascript:;" class="remove" data-original-title="" title="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <!-- BEGIN FORM-->
                                        <?php // pr($update); die; ?>
                                        <?php echo form_open('', array('class' => 'form-horizontal form-bordered', 'role' => 'form', 'id' => 'role_form')); ?>
                                        <div class="form-body">

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Role Name <em style="color:red">*</em></label>
                                                <div class="col-md-4">
                                                    <input class="form-control" placeholder="Role Name" type="text" name="role_name" id="role_name" value="<?php echo set_value('role_name',$update['role_name']); ?>"/>
                                                    <?php echo form_error('role_name', '<div style="color:#a94442;">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Status </label>
                                                <div class="col-md-4">
                                                    <select name="status"class="bs-select form-control">
                                                        <option value="1" <?= (@$update['status'] == 1) ? "selected='selected'" : "" ?> > Active </option>
                                                        <option value="0" <?= (@$update['status'] == 0) ? "selected='selected'" : "" ?> > Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn blue"><i class="fa fa-check"></i> Submit</button>
                                                    <a href="<?php echo base_url(); ?>role/list_items/"><button type="button" class="btn red"> <i class="fa fa-times"></i> Cancel</button></a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
                                        <!-- END FORM-->
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- END PAGE CONTENT INNER -->


                    </div>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

        <?php //include 'footer.php';?>


    </body>
</html>


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
	
        add_content='<div class="test"><textarea class="form-control pull-left " placeholder="Editress" name="address[]" id="address"></textarea><a class="del_more btn btn-danger pull-left"> <i class="fa fa-trash" aria-hidden="true"></i> delete</a></div>';
        $('#p_scents').append(add_content);
    }); 
    $(document).on('click', '.del_more',function() {  // for deleting new records
        $(this).parent().remove();
    });

</script>