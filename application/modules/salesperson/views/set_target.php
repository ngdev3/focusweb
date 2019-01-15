
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
        <form role="form" id="add_form" method="post" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="row">
<?php if ( getUserInfos()->role == "0") { ?>
            <div class="portlet-body form add_prodcut_form">
                
             
                        <div class="form-group col-md-4 col-sm-12">
                        <label for="inputEmail12" class="col-md-6 control-label bold">Branch Manager :</label>
                        <div class="col-md-6">
                            <div class="input-icon" >
                                <p><?php echo  ucwords($manager->fname. ' '.$manager->lname); ?></p>                          
                            </div>
                        </div>
                    </div>
 <?php } ?>
 <?php if ( getUserInfos()->role == "0" ||  getUserInfos()->role == "1") { ?>
                            <div class="form-group col-md-4 col-sm-12">
                        <label for="inputEmail12" class="col-md-6 control-label bold">Coordinator :</label>
                        <div class="col-md-6">
                            <div class="input-icon" >
                                <p><?php echo  ucwords($cordinator->fname. ' '.$cordinator->lname); ?></p>                          
                            </div>
                        </div>
                    </div>

                     <?php } ?>
                            <div class="form-group col-md-4 col-sm-12">
                        <label for="inputEmail12" class="col-md-6 control-label bold">Sales person :</label>
                        <div class="col-md-6">
                            <div class="input-icon" >
                                <p><?php echo  ucwords($res->fname. ' '.$res->lname); ?></p>                          
                            </div>
                        </div>
                    </div>
      
                    <!-- hidden value for salesperson id -->
                    <br><br><br><br>  
                    <input type="hidden"  readonly class="form-control numOnly" id="salesperson_id" name="salesperson_id"  value="<?php echo set_value("salesperson_id", @$res->id); ?>">
                    <div class="text-danger"><?php echo form_error("salesperson_id"); ?></div>
                    <!-- hidden value for salesperson id END  -->   
                              
                            
                    <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text"  class="form-control numOnly" id="target_price" name="target_price"  value="<?php echo set_value("target_price", @$view_target->target_price); ?>">
                                    <div class="text-danger"><?php echo form_error("target_price"); ?></div>

                                    <label for="target_price">Minimum Sale (INR)<span class="red_sign">*</span></label>

                                </div>
                            </div>

                             <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text"  class="form-control numOnly" id="target_product" name="target_product"  value="<?php echo set_value("target_product", @$view_target->target_product); ?>">
                                    <div class="text-danger"><?php echo form_error("target_product"); ?></div>

                                    <label for="target_product">Minimum Sale (Products)<span class="red_sign">*</span></label>

                                </div>
                            </div>

                             <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited" name="status" id="form_control_3">
                                        <option value="">Select Status</option>
                                        <option value="1"  <?php echo set_select('status', '1', @$view_target->status == '1' && !empty(@$view_target) ? TRUE : FALSE); ?>>Active</option>
                                        <option value="0"  <?php echo set_select('status', '0', @$view_target->status == '0' && !empty(@$view_target) ? TRUE : FALSE); ?>>Inactive</option>              

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
                                <a href="<?php echo base_url("salesperson/list_items"); ?>"class="btn default">Cancel</a>
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
                                    target_price:
                                            {
                                                required: true,
                                                number:true,
                                                min:1
                                            },
                                    target_product:
                                            {
                                                required: true,
                                                number:true,
                                                min:1
                                            },
                                   
                                    status:
                                            {
                                                required: true
                                            },
                                           
                                            
                                            
                                },
                        messages:
                                {
                                    target_price:
                                            {
                                                required: "Please Enter Minimum Sale (INR) !",
                                                number: "The Minimum Sale (INR) field must contain only numbers.",
                                                min:"The Minimum Sale (INR) must contain a number greater than or equal to 1."
                                  
                                            },
                                    target_product:
                                            {
                                                required: "Please Enter Minimum Sale (Products) !",
                                                number: "The Minimum Sale (Products) field must contain only numbers.",
                                                min:"The Minimum Sale (Products) must contain a number greater than or equal to 1."
                                  
                                            },
                                    status:
                                            {
                                                required: "Please Select Status!"
                                            }
                                            
                                          
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

<script>
                $(document).on('change', '#manager_id', function() {
                   var manager_id=$("#manager_id").val();
                   
                 
                   $.ajax({
                               type :"POST",
                                url : '<?php echo base_url(); ?>salesperson/getsalescordinator',
                               data:{manager_id:manager_id},
                      success: function(data) {
                      $("#cordinator_id").html(data);
                }
            });
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
	