
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
                                    <select class="form-control edited" name="category" id="category">
                                        <option value="">Select Category Type</option>
                                        <?php if(!empty($category)):?>
                                        <?php foreach($category as $key => $val):?>
                                        <option <?php if(@$res->category == $val->id){ echo "selected"; }?> value="<?php echo $val->id?>"> <?php echo $val->title;?></option>
                                        <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                    <!-- <?php pr($res);?> -->
                                    <div class="text-danger"><?php echo form_error("category"); ?></div>

                                    <label for="type">Category Type<span class="red_sign">*</span></label>

                                </div>
                            </div>
                            
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control" id="content_title" name="content_title"  value="<?php echo set_value("content_title", @$res->content_title)?>">
                                   
                                    <div class="text-danger"><?php echo form_error("content_title"); ?></div>

                                    <label for="content_title">Content Title<span class="red_sign">*</span></label>

                                </div>
                            </div>
                            
                             <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="url" class="form-control" id="video_url" name="video_url"  value="<?php echo set_value("video_url",@$res->video_url)?>">
                                    <div class="text-danger"><?php echo form_error("video_url"); ?></div>

                                    <label for="video_url">Video Url<span class="red_sign">*</span></label>

                                </div> -->
                             </div>
                                               <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control " id="description" name="description"  value="<?php echo set_value("description", @$res->description); ?>" >
                                    <div class="text-danger"><?php echo form_error("description"); ?></div>

                                    <label for="description">Description<span class="red_sign">*</span></label>

                                </div>
                            </div>
                                
                           
                            
                      
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited" name="status" id="form_control_3">
                                        <option value="">Select Status</option>
                                        <option value="active"  <?php echo set_select('status', 'active', @$res->status == 'active' && !empty(@$res) ? TRUE : FALSE); ?>>Active</option>
                                        <option value="inactive"  <?php echo set_select('status', 'inactive', @$res->status == 'inactive' && !empty(@$res) ? TRUE : FALSE); ?>>Inactive</option>              

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
                            <!--View of Image in admin/users edit -->
                            
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12 text-center">
                            <div class="form-actions noborder">
                                <input  type="submit" class="btn blue mtr-20" value="Submit">
                                <a href="<?php echo base_url("admin/leadershipcontent/listing"); ?>"class="btn default">Cancel</a>
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
                                   
                                    content_title:
                                            {
                                                required: true
                                         },
                                         video_url:
                                            {
                                                required: true
                                         },
                                        
                                        description:
                                            {
                                                required: true,
                                         },
                                        quotation_title:
                                            {
                                                required: true,
                                         },
                                         quotation_title:
                                            {
                                                required: true,
                                                
                                         },
                                         quotation:
                                            {
                                                required: true,
                                                
                                         },                                        
                                         
                                         
                                       category:
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
                                   
                                    content_title:
                                            {
                                                required: "Please Enter Content Title!"
                                            },
                                            video_url:
                                            {
                                                required: "Please Select To Date !"
                                            },
                                            
                                             description:
                                            {
                                                required: "Please Enter Description",
                                            },
                                            quotation_title:
                                            {
                                           required: "Please Enter Quotation Title!",
                                          
                                            },
                                            quotation:
                                            {
                                           required: "Please Enter Quotation!",
                                          
                                            },
                                            
                                            
                                    status:
                                            {
                                                required: "Please Select Status!"
                                            },
                                            
                                            
                                            
                                            category:
                                            {
                                                required: "Please Select Category!"
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