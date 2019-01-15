<style>
    .input-icon p{margin: 0px;}

    .mt-15{margin-top: 15px;}
    .form-horizontal .control-label{text-align:left!important;font-weight:600;}
</style>
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


                            <div class="form-group col-md-12 col-sm-12">
                                <label for="inputEmail12" class="col-md-2 control-label bold">Meeting Id :</label>
                                <div class="col-md-6">
                                    <div class="input-icon" >
                                        <p><?php echo $dymanic_meeting_id; ?></p>      
                                        <input type="hidden" name="meeting_id" id="meeting_id" value="<?php echo $dymanic_meeting_id; ?>">       
                                    </div>
                                </div>
                            </div>  

                            <?php  if ( getUserInfos()->role == "0") {?>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited" name="manager_id" id="manager_id">
                                        <option value="">Select Manager</option>
                                        <?php foreach (@$manager as $value) { ?>
                                            <option value="<?php echo $value->id; ?>" <?php echo set_select('manager_id', $value->id, $value->id == @$res->manager_id ? TRUE : FALSE); ?> ><?php echo $value->fname . ' ' . $value->lname; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="text-danger"><?php echo form_error("manager_id"); ?></div>

                                    <label for="manager_id"> Branch Manager<span class="red_sign">*</span></label>

                                </div>
                            </div>
                                        <?php } ?>

                            <!--Coordinator ---->
                            <?php  if ( getUserInfos()->role == "0") {?>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited" name="cordinator_id" id="cordinator_id">
                                        <option value="">Select Cordinator</option>
                                        <?php foreach (@$cordinator as $value) { ?>
                                            <option value="<?php echo $value->id; ?>" <?php echo set_select('cordinator_id', $value->id, $value->id == @$res->coordinator_id ? TRUE : FALSE); ?> ><?php echo $value->fname . ' ' . $value->lname; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="text-danger"><?php echo form_error("cordinator_id"); ?></div>

                                    <label for="cordinator_id"> Cordinator<span class="red_sign">*</span></label>

                                </div>
                            </div>
                            <?php } ?>
                            <?php  if ( getUserInfos()->role == "1") {?>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited <?php if(getUserInfos()->role == "1"){echo 'demo'; }?>" name="cordinator_id" id="cordinator_id">
                                        <option value="">Select Cordinator</option>
                                        <?php foreach (@$static_coordinator as $value) { ?>
                                            <option value="<?php echo $value->id; ?>" <?php echo set_select('cordinator_id', $value->id, $value->id == @$res->coordinator_id ? TRUE : FALSE); ?> ><?php echo $value->fname . ' ' . $value->lname; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="text-danger"><?php echo form_error("cordinator_id"); ?></div>

                                    <label for="cordinator_id"> Cordinator<span class="red_sign">*</span></label>

                                </div>
                            </div>

                                <?php } ?>
                            <!--Coordinator--->



                            <!--Serviceperson Person ---->
                            <?php if(getUserInfos()->role == "0" || getUserInfos()->role == "1"){ ?>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited" name="serviceperson_id" id="serviceperson_id">
                                        <option value="">Select Serviceperson Person</option>
                                        <?php foreach (@$serviceperson as $value) { ?>
                                            <option value="<?php echo $value->id; ?>" <?php echo set_select('serviceperson_id', $value->id, $value->id == @$res->serviceperson_id ? TRUE : FALSE); ?> ><?php echo $value->fname . ' ' . $value->lname; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="text-danger"><?php echo form_error("serviceperson_id"); ?></div>

                                    <label for="serviceperson_id"> Select Serviceperson Person<span class="red_sign">*</span></label>

                                </div>
                            </div>
                            <?php } ?>
                             <?php if(getUserInfos()->role == "3"){ ?>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited" name="serviceperson_id" id="serviceperson_id">
                                        <option value="">Select Serviceperson Person</option>
                                        <?php foreach (@$static_serviceperson as $value) { ?>
                                            <option value="<?php echo $value->id; ?>" <?php echo set_select('serviceperson_id', $value->id, $value->id == @$res->serviceperson_id ? TRUE : FALSE); ?> ><?php echo $value->fname . ' ' . $value->lname; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="text-danger"><?php echo form_error("serviceperson_id"); ?></div>

                                    <label for="serviceperson_id"> Select Serviceperson Person<span class="red_sign">*</span></label>

                                </div>
                            </div>
                            <?php } ?>
                            <!--Serviceperson Person--->







                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control" id="location" name="location"  value="<?php if(@$res_lead->location){echo set_value("location", @$res_lead->location);}else{echo set_value("location", @$res_lead->address);} ?>" readonly="">
                                    <div class="text-danger"><?php echo form_error("location"); ?></div>

                                    <label for="location">Location<span class="red_sign">*</span></label>
                                </div>
                            </div>


                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control" id="activity" name="activity"  value="<?php echo set_value("activity", @$res->activity); ?>">
                                    <div class="text-danger"><?php echo form_error("activity"); ?></div>

                                    <label for="activity">Activity<span class="red_sign">*</span></label>
                                </div>
                            </div>



                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <textarea class="form-control" id="description" rows="2" name="description"><?php echo set_value("description", @$res->description); ?></textarea>
                                    <div class="text-danger"><?php echo form_error("description"); ?></div>

                                    <label for="description">Description<span class="red_sign">*</span></label>
                                </div>
                            </div>


<!--date-->
                               <div class="col-md-6 col-sm-6 col-xs-12 input-group date meeting_date " data-date="" data-date-format="dd-mm-yyyy" data-date-start-date="+0d" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="float:left;">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control cal_input"  readonly=""id="meeting_date" name="meeting_date"  value="<?php echo set_value("meeting_date", @$res->meeting_date); ?>">
                                  
                                    <span class="input-group-addon"  style="width:20px"><span class="glyphicon glyphicon-calendar"></span></span>
                                    <label for="meeting_date">Meeting Date<span class="red_sign">*</span></label>
                                    <div class="text-danger"><?php echo form_error("meeting_date"); ?></div>
                                </div>
                            </div>
                            
                            
                            <!--time-->
                            
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control timepicker timepicker-24"  readonly=""id="start_time" name="start_time"  value="<?php echo set_value("start_time", @$res->start_time); ?>">
                                    <div class="text-danger"><?php echo form_error("start_time"); ?></div>
                                    <label for="start_time">Meeting Start Time<span class="red_sign">*</span></label>
                                </div>
                            </div>

                           <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control timepicker timepicker-23"  readonly=""id="end_time" name="end_time"  value="<?php echo set_value("end_time", @$res->end_time); ?>">
                                    <div class="text-danger"><?php echo form_error("end_time"); ?></div>
                                    <label for="end_time">Meeting End Time<span class="red_sign">*</span></label>
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
                                <a href="<?php echo base_url("complaint/list_items"); ?>"class="btn default">Cancel</a>
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
                                    manager_id:
                                            {
                                                required: true
                                            },
                                    status:
                                            {
                                                required: true
                                            },
                                            serviceperson_id:
                                            {
                                                required: true
                                            },
                                            
                                    cordinator_id:
                                            {
                                                required: true
                                            },
                                            
                                            activity:
                                            {
                                                required: true
                                            },
                                             description:
                                            {
                                                required: true
                                            },
                                            meeting_date:
                                            {
                                              required: true
                                            },
                                            
                                             start_time:
                                            {
                                              required: true
                                            },
                                            end_time:
                                            {
                                              required: true
                                            },
                                            
                                            
                                            
                                },
                        messages:
                                {
                                    status:
                                            {
                                                required: "Please Select Status!"
                                            },
                                    manager_id:
                                            {
                                                required: "Please Select Manager!"
                                            },
                                    cordinator_id:
                                            {
                                                required: "Please Select Coordinator!"
                                            },
                                            
                                            serviceperson_id:
                                            {
                                                required: "Please Select Service Person!"
                                            },
                                     activity:
                                            {
                                                required: "Please Enter Activity!"
                                            },
                                            
                                            description:
                                            {
                                                required: "Please Enter Description!"
                                            },
                                            meeting_date:
                                            {
                                               required: "<br><br><span style='margin-left:-410px;'>Please Enter Metting Date!</span>"  
                                            },
                                            
                                            
                                            start_time:
                                            {
                                              required: "Please Enter Metting Start Time!"
                                            },
                                            end_time:
                                            {
                                              required: "Please Enter  Metting Ends Time!"
                                            },
                                            
                                            
                                }
                    });

        </script>



        <script>
            $(document).on('change', '#manager_id', function () {
                var manager_id = $("#manager_id").val();
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>complaint/getservicecordinator_ajax',
                    data: {manager_id: manager_id},
                    success: function (data) {
                        $("#cordinator_id").html(data);
                    }
                });
            });


            $(document).on('change', '#cordinator_id', function () {


                var manager_id = $("#manager_id").val();
                var cordinator_id = $("#cordinator_id").val();
               /*  alert(manager_id);
                alert(cordinator_id); */
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>complaint/getserviceperson',
                    data: {manager_id: manager_id, cordinator_id: cordinator_id},
                    success: function (data) {
                        $("#serviceperson_id").html(data);
                    }
                });
            });

/* 
$(document).ready(function(){
	var action="<?php echo isset($res->id) ? 'edit' : 'add';?>";
	
	if(action=='edit')
	{
		
			alert('This Activity is already Assigned,You can not edit it');
			$('input[type=text]').attr('disabled', true);
			$('select').attr('disabled',true);
			$('textarea').attr('disabled',true);
			$('input[type=checkbox]').attr('disabled', true);
			$('.btn').hide();
			$('.delete_btn').hide();
		
	}
	
	
}) */
        </script>
        <script>
                $(document).on('change', '.demo', function() {
                   var manager_id="<?php echo $_SESSION['userinfo']['id']; ?>";
                   var cordinator_id=$("#cordinator_id").val();
                 
               /*   alert(manager_id);
                  alert(cordinator_id);  */
		  
                   $.ajax({
                               type :"POST",
                                url : '<?php echo base_url(); ?>complaint/getserviceperson',
                               data:{manager_id:manager_id,cordinator_id:cordinator_id},
                      success: function(data) {
                      $("#serviceperson_id").html(data);
                }
            });
                  });            
</script>
        
        
      