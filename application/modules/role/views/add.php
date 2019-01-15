<style>
.form-group span{
  color:#ff0000;  
}


 
                          
                              
</style>
<!-- .row -->
<div class="row">
        <div class="col-md-12 white-box" style="margin-top:40px;">
          <div class="portlet light">
          



                 <div class="portlet-title">
                    <div class="card-icon_headings" style="height:auto; text-align:left;">
                    <div class="caption"> <i class="fa fa-list font-red-sunglo"></i>
                      <span class="caption-subject font-red-sunglo bold uppercase mainpage-title"> 
                        <?php echo $page_title; ?> 
                      </span>
                     </div>
                   </div>
                       
                            <form class="form-horizontal form-material" id="role_form" method="post">
                            <div class="form-group col-sm-6 col-xs-12">
                                    <label class="col-md-12">Role Name<span>*</span></label>
                                    <div class="col-md-12">
                                    <input type="text" class="form-control" placeholder="Role Name" value="<?php echo set_value("role_name",@$res->role_name); ?>"name="role_name"> </div>
                                
                                        <div class="input-error col-md-12 text-danger"><?php echo form_error("role_name"); ?></div>
                                
                                </div>
                    
                              
                                <div class="form-group col-sm-6 col-xs-12">
                                    <label class="col-sm-12">Status<span>*</span></label>
                                    <div class="col-sm-12">
                                        <select name="status" class="form-control form-control-line">
                                                <option value="">Select</option>
                                                  <option value="1"  <?php echo set_select('status', '1', @$res->status == '1' && !empty(@$res) ? TRUE : FALSE); ?>>Active</option>
                                                  <option value="0"  <?php echo set_select('status', '0', @$res->status == '0' && !empty(@$res) ? TRUE : FALSE); ?>>Inactive</option>              
                                          
                                        </select>
                                        </div>    <div class="input-error col-md-12"><?php echo form_error("status"); ?></div>

                                    
                                </div>
                                <div class="form-group col-xs-12 text-center">
                                    <div class="col-sm-12">
                                    <button class="btn btn-success">ADD</button>
                              <button type="button" class="btn btn-success cancel">Cancel</button>
                                    </div>
                                    

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

<script>
    $('#role_form').validate({
         errorElement: 'span', //default input error message container
         errorClass: 'text-danger', // default input error message class
        rules: {
            role_name: {
                required: true,
                
                //maxlength: 20,
            },
            status: {
                required: true,
                
                //maxlength: 20,
            }     
            
        },

        messages: { // custom messages for radio buttons and checkboxes
            role_name: {
                required: "The Role name field is required.",
                
                //maxlength: "Please Enter more than 20 character. ",
            },
            status: {
                required: "The Status field is required.",
                
                //maxlength: "Please Enter more than 20 character. ",
            }  
		
        },


    });
    $(".btn-success").click(function(){

$(".text-danger").html("");
});
</script>
  