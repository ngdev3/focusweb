
<style>
.form-group span{
  color:#ff0000;  
}
</style>

<div class="col-md-12 col-xs-12">
                        <div class="white-box" style="margin-top: 40px;">
                        <div class="portlet-title">
                    <div class="card-icon_headings" style="height:auto;text-align: left;">
                    <div class="caption"> <i class="fa fa-list font-red-sunglo"></i>
                      <span class="caption-subject font-red-sunglo bold uppercase mainpage-title"> 
                        <?php echo $page_title; ?> 
                      </span>
                     </div>
                   </div>
                   <br>
                            <form class="form-horizontal form-material" id="edit_form" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-12">Area Name<span>*</span></label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Area Name"  name="location_name"  value="<?php echo set_value("location_name", @$res->location_name); ?>" class="form-control form-control-line"> </div>
                                        <div class="text-danger input-error col-md-12"><?php echo form_error("location_name"); ?></div>
                                </div>
                                
                        
                                
                                <div class="form-group">
                               <label class="col-md-12">Status<span>*</span></label>
                                    
                                    <div class="col-sm-12">
                                        <select name="status" class="form-control form-control-line">
                                          <option value="">Select</option>
                                                  <option value="1"  <?php echo set_select('status', '1', @$res->status == '1' && !empty(@$res) ? TRUE : FALSE); ?>>Active</option>
                                                  <option value="0"  <?php echo set_select('status', '0', @$res->status == '0' && !empty(@$res) ? TRUE : FALSE); ?>>Inactive</option>              
                                          
                                        </select>
                                       <div class="text-danger" class="input-error col-md-12"><?php echo form_error("status"); ?></div>

                                    </div>
                                </div>
                                
                              
                                
                           
                                
                                

                            <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">Submit</button>
                                        <a href="<?php echo base_url("masters/location/list_items"); ?>"><button type="button" class="btn btn-success">Cancel</button> </a>
                                
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->



                <script>
                 $("#edit_form").validate(
            {
                errorElement: 'span', //default input error message container
                errorClass: 'text-danger', // default input error message class
                rules:
                        {
                            location_name:
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
                                        required: "The Area Name field is required."
                                    },
                           
                                    
                            status:
                                    {
                                        required: "The Status field is required."
                                    },
                          
                        }
            });

</script>
