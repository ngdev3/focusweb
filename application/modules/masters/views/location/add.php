
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
                                                        <input type="text" class="form-control" id="form_control_1" name="location_name"  value="<?php echo set_value("location_name", @$res->location_name); ?>">
                                                          <div class="text-danger"><?php echo form_error("location_name"); ?></div>

                                                        <label for="form_control_1">Location Name<span class="red_sign">*</span></label>
<!--                                                        <span class="help-block">Your Product Name goes here...</span>-->
                                                        
                                                    </div>
                                                    </div>
                                               
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                            <textarea class="form-control" id="form_control_2" rows="2" name="description"><?php echo set_value("description", @$res->description); ?></textarea>
                                                         <div class="text-danger"><?php echo form_error("description"); ?></div>

                                                            <label for="form_control_2">Description of the Location<span class="red_sign">*</span></label>
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
                                                        <a href="<?php echo base_url("masters/location/list_items"); ?>"class="btn default">Cancel</a>
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
                            location_name:
                                    {
                                        required: true
                                    },
                           
                           description:
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
                            location_name:
                                    {
                                        required: "Please Enter Location Name!"
                                    },
                                    description:
                                    {
                                        required: "Please Enter Description of the Location!"
                                    },
                           
                                    
                            status:
                                    {
                                        required: "Please Select Status!"
                                    },
                          
                        }
            });

</script>
