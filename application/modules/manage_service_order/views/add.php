<style>
p1{
  color:blue;  
  font-weight: bold;
  text-transform:capitalize;
}
span1{
    color:red;

}


.box {
    background-color: white;
    width: 50%;
    height: 600px;
    border: 2px solid black;
    padding: 15px;
    margin-top: 270px;
    margin-left: 25%;
}
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

                         <?php  if ( getUserInfos()->role == "0") {?>

                           
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited get_serviceperson_id get_client" name="manager_id" id="manager_id">
                                        <option value="">Select Manager</option>
                                  <?php foreach(@$manager as $value){ ?>
                                  <option value="<?php echo $value->id; ?>" <?php echo set_select('manager_id', $value->id, $value->id == @$res->manager_id ? TRUE : FALSE); ?> ><?php echo $value->fname.' '.$value->lname; ?></option>
                                  <?php } ?>
                                    </select>
                                    <div class="text-danger error_manager_id"><?php echo form_error("manager_id"); ?></div>

                                    <label for="manager_id">Select Branch Manager<span class="red_sign">*</span></label>

                                </div>
                            </div>
                         <?php   } ?>

                           
                            
                             <!--Coordinator ---->
                             <?php if(getUserInfos()->role == "0"){ ?>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited get_serviceperson_id get_client" name="cordinator_id" id="cordinator_id">
                                        <option value="">Select Coordinator</option>
                                  <?php foreach(@$cordinator as $value){ ?>
                                  <option value="<?php echo $value->id; ?>" <?php echo set_select('cordinator_id', $value->id, $value->id == @$res->cordinator_id ? TRUE : FALSE); ?> ><?php echo $value->fname.' '.$value->lname; ?></option>
                                  <?php } ?>
                                    </select>
                                    <div class="text-danger error_cordinator_id"><?php echo form_error("cordinator_id"); ?></div>

                                    <label for="cordinator_id">Select Coordinator<span class="red_sign">*</span></label>

                                </div>
                            </div>
                            <?php } ?>
                         
                          
                             
                                  <?php if(getUserInfos()->role == "1"){ ?>
                             <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited <?php if(getUserInfos()->role == "1"){echo 'demo'; }?>" name="cordinator_id" id="cordinator_id">
                                        <option value="">Select Coordinator</option>
                                  <?php foreach(@$static_coordinator as $value){ ?>
                                  <option value="<?php echo $value->id; ?>" <?php echo set_select('cordinator_id', $value->id, $value->id == @$res->cordinator_id ? TRUE : FALSE); ?> ><?php echo $value->fname.' '.$value->lname; ?></option>
                                  <?php } ?>
                                    </select>
                                    <div class="text-danger error_cordinator_id"><?php echo form_error("cordinator_id"); ?></div>

                                    <label for="cordinator_id">Select Coordinator<span class="red_sign">*</span></label>

                                </div>
                            </div>
                            <?php } ?>
                            <!--Coordinator--->
                            
                            
               

                              <!--Service Person ---->
                              <?php if(getUserInfos()->role == "0" || getUserInfos()->role == "1"){ ?>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited get_client" name="serviceperson_id"  id="serviceperson_id">
                                        <option value="">Select Service Person</option>
                                  <?php foreach(@$serviceperson as $value){ ?>
                                  <option value="<?php echo $value->id; ?>" <?php echo set_select('serviceperson_id', $value->id, $value->id == @$res->serviceperson_id ? TRUE : FALSE); ?> ><?php echo $value->fname.' '.$value->lname; ?></option>
                                  <?php } ?>
                                    </select>
                                    <div class="text-danger error_serviceperson_id"><?php echo form_error("serviceperson_id"); ?></div>

                                    <label for="serviceperson_id">Select Service Person<span class="red_sign">*</span></label>

                                </div>
                            </div>
                            <?php } ?>


                                <?php if(getUserInfos()->role == "3"){ ?>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited get_client" name="serviceperson_id"  id="serviceperson_id">
                                        <option value="">Select Service Person</option>
                                  <?php foreach(@$static_serviceperson as $value){ ?>
                                  <option value="<?php echo $value->id; ?>" <?php echo set_select('serviceperson_id', $value->id, $value->id == @$res->serviceperson_id ? TRUE : FALSE); ?> ><?php echo $value->fname.' '.$value->lname; ?></option>
                                  <?php } ?>
                                    </select>
                                    <div class="text-danger error_serviceperson_id"><?php echo form_error("serviceperson_id"); ?></div>

                                    <label for="serviceperson_id">Select Service Person<span class="red_sign">*</span></label>

                                </div>
                            </div>
                            <?php } ?>

                            <!--Service Person--->

                             <!--Client ---->
                            
                             <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited" name="client_id"  id="client_id">
                                        <option value="">Select Client</option>
                                 <?php foreach(@$client as $value){ ?>
                                  <option value="<?php echo $value->id; ?>" <?php echo set_select('client_name', $value->client_name, $value->client_name == @$res->client_name ? TRUE : FALSE); ?> ><?php echo $value->client_name; ?></option>
                                  <?php } ?>
                                    </select>
                                    <div class="text-danger error_client_id"><?php echo form_error("client_id"); ?></div>

                                    <label for="client_id">Select Client<span class="red_sign">*</span></label>

                                </div>
                            </div>
                       
                            <!--Client--->

                             <!--Order ID ---->
                             <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control" readonly id="order_id" name="order_id"  value="<?php if($order_id){echo $order_id;}else{echo set_value("order_id", @$res->order_id);} ?>">
                                    <div class="text-danger error_order_id"><?php echo form_error("order_id"); ?></div>

                                    <label for="order_id">Order ID</label>
                                </div>
                              </div>
                            <!--Order ID--->

                             <!--Add More--->

                    <div class="box">
                       <!--Select Product ---->
                            
                       <div class="col-md-offset-1 col-md-10">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited get_product_details get_product_rate" name="product_id"  id="product_id">
                                <option value="">Select Product</option>
                                  <?php foreach(@$product as $value){ ?>
                                  <option value="<?php echo $value->id; ?>"  ><?php echo $value->name; ?></option>
                                  
                                  <?php } ?>
                                    </select>
                                    <div class="text-danger error_product_id"><?php echo form_error("product_id"); ?></div>

                                    <label for="product_id">Select Product</label>

                                </div>
                            </div>
                       
                            <!--Select Product--->
                            <!--  Capacity(KVA) 
                            
                       <div class="col-md-offset-1 col-md-10" id="kva_id">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="text" class="form-control numOnly" id="kva" name="kva"  value="<?php echo set_value("kva", @$res->kva); ?>">
                                    <div class="text-danger"><?php echo form_error("kva"); ?></div>

                                    <label for="kva">Capacity(KVA)</label>

                            </div>
                        </div>
                       
                           Capacity(KVA)

                            Capacity(HP) 
                            
                       <div class="col-md-offset-1 col-md-10" id="hp_id">
                       <center id="or_id"><h4>OR</h4></center>
                                <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="text" class="form-control numOnly" id="hp" name="hp"  value="<?php echo set_value("hp", @$res->hp); ?>">
                                    <div class="text-danger"><?php echo form_error("hp"); ?></div>

                                    <label for="hp">Capacity(HP)</label>

                                </div>
                            </div>
                       
                           Capacity(HP) -->

                             <!--Quantity ---->
                            
                       <div class="col-md-offset-1 col-md-10">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="text" class="form-control numOnly" id="quantity" name="quantity"  value="<?php echo set_value("quantity", @$res->quantity); ?>">
                                    <div class="text-danger error_quantity"><?php echo form_error("quantity"); ?></div>

                                    <label for="quantity">Quantity</label>

                                </div>
                            </div>
                       
                            <!--Quantity--->

                             <!--Choose Unit ---->
                            
                       <div class="col-md-offset-1 col-md-10">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited" name="unit_id"  id="unit_id">
                                        <option value="">Choose Unit</option>
                                 <!--  <?php foreach(@$unit as $value){ ?>
                                  <option value="<?php echo $value->unit_id; ?>" <?php echo set_select('unit_id', $value->unit_id, $value->unit_id == @$res->unit_id ? TRUE : FALSE); ?> ><?php echo $value->client_name; ?></option>
                                  <?php } ?> -->
                                  <option value="nos">Nos</option>
                                  <option value="kgs">Kgs</option>
                                  <option value="lumpsum">Lumpsum</option>
                                    </select>
                                    <div class="text-danger error_unit_id"><?php echo form_error("unit_id"); ?></div>

                                    <label for="unit_id">Choose Unit</label>

                                </div>
                            </div>
                       
                            <!--Choose Unit--->

                             <!--Price(INR) ---->
                            
                       <div class="col-md-offset-1 col-md-10">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="text" class="form-control numOnly" id="price" readonly name="price"  value="<?php echo set_value("price", @$res->price); ?>">
                                    <div class="text-danger error_price"><?php echo form_error("price"); ?></div>

                                    <label for="price">Price(INR)</label>

                                </div>
                            </div>
                       
                            <!--Price(INR)--->

                             <!--Add Button--->
                        <div class="form-group">
                           
                            <center>
                                <div class="col-md-12">
                                    <a href="javascript:void(0);" class="add_field_button btn btn-success" title="Add field" style="margin-top:40px;">Add</a>
                                    <div class="text-danger error_total"><?php echo form_error("total"); ?></div>
                   
                                            
                                    <?php if($chapter_val){ ?>
                                        <input type="hidden"  id="input_max_val" value="<?php echo count($chapter_val)?>">
                                            
                                    <?php } else {?>
                                    <input type="hidden"  id="input_max_val" value="1">
                                            <?php }?>    
                
                                </div>
                                </center>
                        </div>  

                            <!--Add Button--->

                            
                      
                    </div>  
                    
                    <div class="input_fields_wrap"></div>
                    </div>
	
                        
                                        <!--Add More--->
                                         <!--Total--->
                                <div class="col-md-offset-4 col-md-4 col-sm-6 col-xs-12 total_class">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control numOnly" readonly id="total" name="total"  value="0">
                                  

                                    <label for="total"><b style="font-size:15px;">Total</b></label>
                                </div>
                              </div>

                                        <!--Total--->

                             <!--Basic Ordered Value--->
                            
                               <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control numOnly" readonly id="basic_amount" name="basic_amount"  value="<?php echo set_value("basic_amount", @$res->basic_amount); ?>">
                                    <div class="text-danger error_basic_amount"><?php echo form_error("basic_amount"); ?></div>

                                    <label for="basic_amount">Basic Ordered Value(INR)<span class="red_sign">*</span></label>
                                </div>
                              </div>

                               <!--Basic Ordered Value--->

                                <!--GST--->
                            
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control numOnly" id="gst" name="gst"  value="<?php echo set_value("gst", @$res->gst); ?>">
                                    <div class="text-danger error_gst"><?php echo form_error("gst"); ?></div>

                                    <label for="gst">GST(INR)<span class="red_sign">*</span></label>
                                </div>
                              </div>
                              
                               <!--GST--->

                                <!--Total Ordered Value--->
                            
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control get_pending numOnly" readonly id="total_amount" name="total_amount"  value="<?php echo set_value("total_amount", @$res->total_amount); ?>">
                                    <div class="text-danger error_total_amount"><?php echo form_error("total_amount"); ?></div>

                                    <label for="total_amount">Total Ordered Value(INR)<span class="red_sign">*</span></label>
                                </div>
                              </div>
                              
                               <!--Total Ordered Value--->

                                <!--Advanced--->
                            
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control get_pending numOnly" id="advance_amount" name="advance_amount"  value="<?php echo set_value("advance_amount", @$res->advance_amount); ?>">
                                    <div class="text-danger error_advance_amount"><?php echo form_error("advance_amount"); ?></div>

                                    <label for="advance_amount">Advanced(INR)<span class="red_sign">*</span></label>
                                </div>
                              </div>
                              
                               <!--Advanced--->

                                <!--Pending--->
                            
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" readonly class="form-control numOnly" id="pending_amount" name="pending_amount"  value="<?php echo set_value("pending_amount", @$res->pending_amount); ?>">
                                    <div class="text-danger error_pending_amount"><?php echo form_error("pending_amount"); ?></div>

                                    <label for="pending_amount">Pending(INR)<span class="red_sign">*</span></label>
                                </div>
                              </div>
                              
                               <!--Pending--->

                                 <!--Mode of Payment--->

                             <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">

                                <select class="form-control" name="payment_mode"  id="payment_mode">
                                <option value="">Select Payment Mode</option>
                                 <?php foreach(@$payment_mode as $value){ ?>
                                  <option value="<?php echo $value->id; ?>" <?php echo set_select('payment_mode', $value->id, $value->id == @$res->payment_mode ? TRUE : FALSE); ?> ><?php echo $value->name; ?></option>
                                  <?php } ?>
                                    </select>
                                    <div class="text-danger error_payment_mode"><?php echo form_error("payment_mode"); ?></div>

                                    <label for="payment_mode" style="margin-top:-20px;">Mode of Payment<span class="red_sign">*</span></label>
                                </div>
                              </div>
                            <!--Mode of Payment--->

                                 <!--Term of Payment--->

                             <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control" id="payment_term" name="payment_term"  value="<?php echo set_value("payment_term", @$res->payment_term); ?>">
                                    <div class="text-danger error_payment_term"><?php echo form_error("payment_term"); ?></div>

                                    <label for="payment_term">Term of Payment</label>
                                </div>
                              </div>
                            <!--Term of Payment--->

                               <!--Payment Description--->

                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <textarea rows="5" class="form-control" id="payment_description" name="payment_description"  value="<?php echo set_value("payment_description", @$res->payment_description); ?>"><?php echo set_value("payment_description"); ?></textarea>
                                    <div class="text-danger error_payment_description"><?php echo form_error("payment_description"); ?></div>

                                    <label for="payment_description">Payment Description</label>
                                </div>
                              </div>
                            <!--Payment Description--->

                           
                            
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12 text-center">
                            <div class="form-actions noborder">
                            <button  type="button" class="btn blue mtr-20" id="submitss" value="Submit">Submit</button>
                                <a href="<?php echo base_url("manage_service_order/list_items"); ?>"class="btn default">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->


        <!--New Form Ends---->


        <!-- <script>
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
                                            cordinator_id:
                                            {
                                                required: true
                                            },
                                            serviceperson_id:
                                            {
                                                required: true
                                            },
                                            client_id:
                                            {
                                                required: true
                                            },
                                            product_id:
                                            {
                                                required: true
                                            },
                                           
                                            quantity:
                                            {
                                                required: true,
                                                number:true,
                                                min:1
                                                
                                            },
                                            unit_id:
                                            {
                                                required: true
                                            },
                                            price:
                                            {
                                                required: true,
                                                number:true,
                                                min:1
                                                
                                            },
                                            basic_amount:
                                            {
                                                required: true,
                                                number:true,
                                                min:1
                                               
                                            },
                                            gst:
                                            {
                                                required: true,
                                                number:true,
                                                min:1
                                                
                                            },
                                            total_amount:
                                            {
                                                required: true,
                                                number:true,
                                                min:1
                                                
                                            },
                                            pending_amount:
                                            {
                                                required: true,
                                                number:true,
                                                min:1
                                                
                                            },
                                            advance_amount:
                                            {
                                                required: true,
                                                number:true,
                                                min:1
                                                
                                            },
                                            payment_mode:
                                            {
                                                required: true
                                            },
                                            
                                            
                                },
                        messages:
                                {
                                    manager_id:
                                            {
                                                required: "Please Select Manager!"
                                            },
                                            cordinator_id:
                                            {
                                                required: "Please Select Cordinator!"
                                            },
                                            serviceperson_id:
                                            {
                                                required: "Please Select Service Person!"
                                            },
                                            client_id:
                                            {
                                                required: "Please Select Client!"
                                            },
                                            product_id:
                                            {
                                                required: "Please Select Product!"
                                            },
                                           
                                            quantity:
                                            {
                                                required: "Please Enter Quantity!",
                                                min:"The Quantity field must contain a number greater than or equal to 1.",
                                                number:"The Quantity field must contain only numbers."
                                            },
                                            unit_id:
                                            {
                                                required: "Please Select Unit!"
                                            },
                                            price:
                                            {
                                                required: "Please Enter Price(INR)!",
                                                min:"The Price(INR) field must contain a number greater than or equal to 1.",
                                                number:"The Price(INR) field must contain only numbers."
                                            },
                                            basic_amount:
                                            {
                                                required: "Please Enter Basic Ordered Value(INR)!",
                                                number:"The Basic Ordered Value(INR) field must contain only numbers.",
                                                min:"The Basic Ordered Value(INR) field must contain a number greater than or equal to 1."
                                               
                                            },
                                            gst:
                                            {
                                                required: "Please Enter GST(INR)!",
                                                min:"The GST(INR) field must contain a number greater than or equal to 1.",
                                                number:"The GST(INR) field must contain only numbers."
                                            },
                                            total_amount:
                                            {
                                                required: "Please Enter Total Ordered Value(INR)!",
                                                min:"The Total Ordered Value(INR) field must contain a number greater than or equal to 1.",
                                                number:"The Total Ordered Value(INR) field must contain only numbers."
                                            },
                                            pending_amount:
                                            {
                                                required: "Please Enter Pending(INR)!",
                                                min:"The Pending(INR) field must contain a number greater than or equal to 1.",
                                                number:"The Pending(INR) field must contain only numbers."
                                            },
                                            advance_amount:
                                            {
                                                required: "Please Enter Advance(INR)!",
                                                min:"The Advance(INR) field must contain a number greater than or equal to 1.",
                                                number:"The Advance(INR) field must contain only numbers."
                                            },
                                            payment_mode:
                                            {
                                                required: "Please Select Mode of Payment!"
                                            },
                                            
                                            
                                            
                                }
                    });

        </script> -->
        
        
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
                                url : '<?php echo base_url(); ?>manage_service_order/getservicecordinator',
                               data:{manager_id:manager_id},
                      success: function(data) {
                      $("#cordinator_id").html(data);
                }
            });
                  });
                  
                  
                  
               
                
</script>
<script>
                $(document).on('change', '.get_serviceperson_id', function() {
                   var manager_id=$("#manager_id").val();
                   var cordinator_id=$("#cordinator_id").val();
                 
                /*   alert(manager_id);
                  alert(cordinator_id); */
		  
                   $.ajax({
                               type :"POST",
                                url : '<?php echo base_url(); ?>manage_service_order/getserviceperson',
                               data:{manager_id:manager_id,cordinator_id:cordinator_id},
                      success: function(data) {
                      $("#serviceperson_id").html(data);
                }
            });
                  });            
</script>
<script>
                $(document).on('change', '.demo', function() {
                   var manager_id="<?php echo $_SESSION['userinfo']['id']; ?>";
                   var cordinator_id=$("#cordinator_id").val();
                 
                /*   alert(manager_id);
                  alert(cordinator_id); */
		  
                   $.ajax({
                               type :"POST",
                                url : '<?php echo base_url(); ?>manage_service_order/getserviceperson',
                               data:{manager_id:manager_id,cordinator_id:cordinator_id},
                      success: function(data) {
                      $("#serviceperson_id").html(data);
                }
            });
                  });            
</script>

<script>
                $(document).on('change', '.get_pending', function() {
                   var total_amount=$("#total_amount").val();
                   var advance_amount=$("#advance_amount").val();
                   
                if(total_amount!="" && advance_amount!=""){
                    var pending = total_amount - advance_amount;
                    if(pending>=0){
                        
                        $("#pending_amount").val(pending);

                    }else{

                        alert("Advanced (INR) should be less than or equal to Total Ordered Value (INR)");
                        $("#pending_amount").val("");

                    }
                    

                }else{
                   
                }
                 
                 
                /*   alert(manager_id);
                  alert(cordinator_id); */
		  
                  /*  $.ajax({
                               type :"POST",
                                url : '<?php echo base_url(); ?>salesperson/getsalesperson',
                               data:{manager_id:manager_id,cordinator_id:cordinator_id},
                      success: function(data) {
                      $("#serviceperson_id").html(data);
                }
            }); */
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


<script> 
/*	$(document).ready(function(){
                            $("#kva_id").hide();
                            $("#or_id").hide();
                            $("#hp_id").hide();

    $("#btn1").click(function(){
        $("p").append(".app");
    });

     $("#product_id").click(function(){
        var type= $("#product_id").val();
        if(type=="3" || type=="4"){
            $("#kva_id").hide();
            $("#or_id").hide();
            $("#hp_id").show();
        }else{
            $("#kva_id").show();
            $("#or_id").hide();
            $("#hp_id").hide();
        }
    }); 

   
});*/
 
$(document).ready(function() {
    var g_total=0;
    var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = $("#input_max_val").val();; //initlal text box count

//  
  
    $(add_button).click(function(e){ //on add input button click
   // alert("sdf");
        var product_id = $("#product_id").val();
        var product_id_name = $("#product_id option:selected" ).text();

        //  var kva = $("#kva").val();
        // var hp = $("#hp").val(); 
        var quantity = $("#quantity").val();
        var unit_id = $("#unit_id").val();
        var price = $("#price").val();
        var total =price*quantity;
        
 

          
         
        
             if((product_id!="" && quantity!="" && unit_id!="" && price!="")){
                if(quantity>=1 && price>=1 ){
                    var a = parseFloat(total, 2);
                    g_total=g_total+ a;
                    var round = g_total.toFixed();
                    $("#total").val(round);
                    $("#basic_amount").val(round);
                        
            
               
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
           
           
       
            x++; //text box increment
            
            var input_apeends = '<input type="hidden" name="product_id_arr[]" value="'+product_id+'"   /><input type="hidden" name="quantity_arr[]" value="'+quantity+'"   /><input type="hidden" name="unit_id_arr[]" value="'+unit_id+'"   /><input type="hidden" name="price_arr[]" value="'+price+'"   /> <input type="hidden" id="total_'+x+'" name="total_arr[]" value="'+total+'"   /> <span1 onclick="remove_div('+x+')"><i class="fa fa-trash" title="Delete order"></i></span1><hr>';
             
            $(wrapper).append('<div style="margin:80px;" id="remove_'+x+'"><span><i class="fa fa-circle"></i></span>&nbsp;<label><b>Product: </label></b>' +'&nbsp;&nbsp;<p1>'+product_id_name+'</p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Qty :</b></label>' +'&nbsp;&nbsp;<p1>'+quantity+'  </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Unit:</b></label>' +'&nbsp;&nbsp;<p1>'+unit_id+' </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Price(INR) :</b></label>' +'&nbsp;&nbsp;<p1>'+price+'  </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Total(INR) :</b></label>' +'&nbsp;&nbsp;<p1>'+total+'  </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+input_apeends+'</div>'); //add input box
                            $("#product_id").val(""); 
                            $("#quantity").val("");
                            $("#unit_id").val("");
                            $("#price").val("");
                
            //    $.ajax({
            //         type :"POST",
            //         url : '<?php echo base_url(); ?>manage_sales_order/get_product_details',
            //         data:{product_id:product_id},
            //         success: function(data) {
            //             if(data==true){
            //                 var input_apeends = '<input type="hidden" name="product_id_arr[]" value="'+product_id+'"   /> <input type="hidden" name="kva_arr[]" value=""   /><input type="hidden" name="hp_arr[]" value="'+hp+'"   /><input type="hidden" name="quantity_arr[]" value="'+quantity+'"   /><input type="hidden" name="unit_id_arr[]" value="'+unit_id+'"   /><input type="hidden" name="price_arr[]" value="'+price+'"   />  <span1 onclick="remove_div('+x+')"><i class="fa fa-trash" title="Delete order"></i></span1><hr>';
             
            //                 $(wrapper).append('<div style="margin:80px;" id="remove_'+x+'"><span><i class="fa fa-circle"></i></span>&nbsp;<label><b>Product: </label></b>' +'&nbsp;&nbsp;<p1>'+product_id_name+'</p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Capacity (HP) :</b></label>' +'&nbsp;&nbsp;<p1>'+hp+'  </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Qty :</b></label>' +'&nbsp;&nbsp;<p1>'+quantity+'  </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Unit:</b></label>' +'&nbsp;&nbsp;<p1>'+unit_id+' </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Price(INR) :</b></label>' +'&nbsp;&nbsp;<p1>'+price+'  </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+input_apeends+'</div>'); //add input box
            //                 }else{
            //                     var input_apeends = '<input type="hidden" name="product_id_arr[]" value="'+product_id+'"   /> <input type="hidden" name="kva_arr[]" value="'+kva+'"   /><input type="hidden" name="hp_arr[]" value=""   /><input type="hidden" name="quantity_arr[]" value="'+quantity+'"   /><input type="hidden" name="unit_id_arr[]" value="'+unit_id+'"   /><input type="hidden" name="price_arr[]" value="'+price+'"   />  <span1 onclick="remove_div('+x+')"><i class="fa fa-trash" title="Delete order"></i></span1><hr>';
             
            //                     $(wrapper).append('<div style="margin:80px;" id="remove_'+x+'"><span><i class="fa fa-circle"></i></span>&nbsp;<label><b>Product: </label></b>' +'&nbsp;&nbsp;<p1>'+product_id_name+'</p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Capacity (KVA) :</b></label>' +'&nbsp;&nbsp;<p1>'+kva+' </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Qty :</b></label>' +'&nbsp;&nbsp;<p1>'+quantity+'  </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Unit:</b></label>' +'&nbsp;&nbsp;<p1>'+unit_id+' </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Price(INR) :</b></label>' +'&nbsp;&nbsp;<p1>'+price+'  </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+input_apeends+'</div>'); //add input box
            //                 }
                     
            //             }
            //         });
               
            //    if(kva=="" && hp!=""){
            //     $(wrapper).append('<div style="margin:80px;" id="remove_'+x+'"><span><i class="fa fa-circle"></i></span>&nbsp;<label><b>Product: </label></b>' +'&nbsp;&nbsp;<p1>'+product_id_name+'</p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Capacity (HP) :</b></label>' +'&nbsp;&nbsp;<p1>'+hp+'  </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Qty :</b></label>' +'&nbsp;&nbsp;<p1>'+quantity+'  </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Unit:</b></label>' +'&nbsp;&nbsp;<p1>'+unit_id+' </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Price(INR) :</b></label>' +'&nbsp;&nbsp;<p1>'+price+'  </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+input_apeends+'</div>'); //add input box

            //    }else{
            //     $(wrapper).append('<div style="margin:80px;" id="remove_'+x+'"><span><i class="fa fa-circle"></i></span>&nbsp;<label><b>Product: </label></b>' +'&nbsp;&nbsp;<p1>'+product_id_name+'</p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Capacity (KVA) :</b></label>' +'&nbsp;&nbsp;<p1>'+kva+' </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Qty :</b></label>' +'&nbsp;&nbsp;<p1>'+quantity+'  </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Unit:</b></label>' +'&nbsp;&nbsp;<p1>'+unit_id+' </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Price(INR) :</b></label>' +'&nbsp;&nbsp;<p1>'+price+'  </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+input_apeends+'</div>'); //add input box
            //    }
             
             
              
           
             /*   var sale_price = $("#sale_price").val("");
          
          var sale_percentage = $("#sale_percentage").val("");
 */
           
      
         }
        else{
            alert("Fields can not be greater than "+max_fields);
        }
   
     } else{
            
            alert("The Quantity or Price (INR) must contain a number greater than or equal to 1.");
        } 
     }else{
            alert("Fields can not be empty");
        }
    });
  

     
    
});
function remove_div(ids){
  
    var grand= $("#basic_amount").val();      
        var at = $("#total_"+ids).val();
        var a = parseFloat(at, 2); 
        var b = parseFloat(grand, 2); 
        var diff=b-a;
       if(diff>=1){
            $("#basic_amount").val(diff); 
            $("#pending_amount").val(""); 
            $("#gst").val(""); 
            $("#total_amount").val("");  
       }else{
            $("#basic_amount").val("");
            $("#pending_amount").val(""); 
            $("#gst").val(""); 
            $("#total_amount").val("");  
       }
            
       
            $("#remove_"+ids).html("");
}

</script> 


<!-- <script>
                $(document).on('change', '.get_product_details', function() {
                   var product_id=$("#product_id").val();

		  
                   $.ajax({
                               type :"POST",
                                url : '<?php echo base_url(); ?>manage_sales_order/get_product_details',
                               data:{product_id:product_id},
                      success: function(data) {
                          if(data==true){
                            $("#kva_id").hide();
                            $("#or_id").hide();
                            $("#hp_id").show();

                          }else{
                            $("#kva_id").show();
                            $("#or_id").hide();
                            $("#hp_id").hide();
                          }
                     
                             }
            });
                  });            
</script>  -->

 <script>
                $(document).on('change', '.get_client', function() {
                   var manager_id=$("#manager_id").val();
                   var cordinator_id=$("#cordinator_id").val();
                   var serviceperson_id=$("#serviceperson_id").val();
                 
                  /* alert("hi"+manager_id);
                  alert("hi"+cordinator_id); 
                  alert("hi"+serviceperson_id);*/
		  
                   $.ajax({
                            type :"POST",
                            url : '<?php echo base_url(); ?>manage_service_order/getclientperson',
                            data:{manager_id:manager_id,cordinator_id:cordinator_id,serviceperson_id:serviceperson_id},
                            success: function(data) {
                              //  alert(data);
                            $("#client_id").html(data);
                }
            });
                  });            
</script>


<!---------------------------------- get product rate  starts 04-01-2019------------------------------->
<script>
               
                $(document).on('change', '.get_product_rate', function() {
                
                    
                   var product_id=$("#product_id").val();
                   
                 
                  
		  
                   $.ajax({
                               type :"POST",
                               dataType :"json",
                                url : '<?php echo base_url(); ?>manage_sales_order/getproduct_rate',
                               data:{product_id:product_id},
                      success: function(data) {
                          //alert(data.price_mrp);
                      $("#price").val(data.price_mrp);
                     
                }
            });
                  });
                  
                  
                  
               
                
</script>
<script>
       var tot=$("#total").val();
                    if(tot!=0){
                        $(".total_class").show();
                    }else{
                        $(".total_class").hide();
                    }          
$("#submitss").click(function(){ //user click on remove text
//alert("ayaaa");
                var field1 = $("#manager_id").val(); 
                var field2 = $("#cordinator_id").val();
                var field3 = $("#serviceperson_id").val(); 
                var field4 = $("#client_id").val();  
                var field5 = $("#product_id").val();
                var field6 = $("#quantity").val(); 
                var field7 = $("#unit_id").val();
                var field8 = $("#price").val(); 
                var field9 = $("#basic_amount").val();  
                var field10 = $("#gst").val();
                var field11= $("#total_amount").val();
                var field12= $("#pending_amount").val(); 
                var field13= $("#advance_amount").val();  
                var field14 = $("#payment_mode").val();
                var field15 = $("#total").val();
                if($("#total").val()!=0){
                   // $(".total_class").show();
                }
               
               

                                           
                                           
                                           /*  quantity:
                                            {
                                                required: "",
                                                min:"The Quantity field must contain a number greater than or equal to 1.",
                                                number:"The Quantity field must contain only numbers."
                                            },
                                           
                                            price:
                                            {
                                                required: "",
                                                min:"The Price(INR) field must contain a number greater than or equal to 1.",
                                                number:"The Price(INR) field must contain only numbers."
                                            },
                                            basic_amount:
                                            {
                                               
                                                number:"The Basic Ordered Value(INR) field must contain only numbers.",
                                                min:"The Basic Ordered Value(INR) field must contain a number greater than or equal to 1."
                                               
                                            },
                                            gst:
                                            {
                                                required: "",
                                                min:"The GST(INR) field must contain a number greater than or equal to 1.",
                                                number:"The GST(INR) field must contain only numbers."
                                            },
                                            total_amount:
                                            {
                                                required: "",
                                                min:"The Total Ordered Value(INR) field must contain a number greater than or equal to 1.",
                                                number:"The Total Ordered Value(INR) field must contain only numbers."
                                            },
                                            pending_amount:
                                            {
                                                required: "",
                                                min:"The Pending(INR) field must contain a number greater than or equal to 1.",
                                                number:"The Pending(INR) field must contain only numbers."
                                            },
                                            advance_amount:
                                            {
                                                required: "",
                                                min:"The Advance(INR) field must contain a number greater than or equal to 1.",
                                                number:"The Advance(INR) field must contain only numbers."
                                            }, */
                                           
                                                
               // alert(field1);        
		  
		   //alert(field1);
           var z = false;
		   
		    if(field1==""){
				    z = true;
				   $(".error_manager_id").text("Please Select Manager!");
			   }else{
                $(".error_manager_id").text("");

               }
               if(field2==""){
				    z = true;
				   $(".error_cordinator_id").text("Please Select Cordinator!");
			   }else{
                $(".error_cordinator_id").text("");

               }
               if(field3==""){
				    z = true;
				   $(".error_serviceperson_id").text("Please Select Service Person!");
			   }else{
                $(".error_serviceperson_id").text("");

               }
               if(field4==""){
				    z = true;
				   $(".error_client_id").text("Please Select Client!");
			   }else{
                $(".error_client_id").text("");

               }
              /*  if(field5==""){
				    z = true;
				   $(".error_product_id").text("Please Select Product!");
			   }else{
                $(".error_product_id").text("");

               }
               if(field6==""){
				    z = true;
				   $(".error_quantity").text("Please Enter Quantity!");
			   }else{
                $(".error_quantity").text("");

               }
               if(field7==""){
				    z = true;
				   $(".error_unit_id").text("Please Select Unit!");
			   }else{
                $(".error_unit_id").text("");

               }
               if(field8==""){
				    z = true;
				   $(".error_price").text("Please Enter Price(INR)!");
			   }else{
                $(".error_price").text("");

               }
 */               if(field9==""){
				    z = true;
				   $(".error_basic_amount").text("Please Enter Basic Ordered Value(INR)!");
			   }else{
                $(".error_basic_amount").text("");

               }
               if(field10==""){
				    z = true;
				   $(".error_gst").text("Please Enter GST(INR)!");
			   }else if(field10<="0"){
                $(".error_gst").text("The GST(INR) field must contain a number greater than  0.");
               }else{
                $(".error_gst").text("");

               }
               if(field11==""){
				    z = true;
				   $(".error_total_amount").text("Please Enter Total Ordered Value(INR)!");
			   }else{
                $(".error_total_amount").text("");

               }
               if(field12==""){
				    z = true;
				   $(".error_pending_amount").text("Please Enter Pending(INR)!");
			   }else{
                $(".error_pending_amount").text("");

               }
               if(field13==""){
				    z = true;
				   $(".error_advance_amount").text("Please Enter Advance(INR)!");
			   }else if(field13<="0"){
                $(".error_advance_amount").text("The Advance(INR) field must contain a number greater than  0.");
               }else{
                $(".error_advance_amount").text("");

               }
               if(field14==""){
				    z = true;
				   $(".error_payment_mode").text("Please Select Mode of Payment!");
			   }else{
                $(".error_payment_mode").text("");

               }
               if(field15=="" || field15=="0"){
                z = true;
                alert("Click on add to Add your Order.");
				   $(".error_total").text("Click on add to Add your Order.");
			   }else{
                $(".error_total").text("");

               }

			   
			    
                  
                   
                   
              
		
                            if(z==false)
									{
                                      
										//$( "#submits" ).click(function() {
										  $( "#add_form" ).submit();
										//});
									}
		   
		   
		 
           
       });  
                
</script>
<script>
               
               $(document).on('change', '#gst', function() {
               
                var cal_gst=0;
                var gst=$("#gst").val();
                var basic_amount=$("#basic_amount").val();
                
                  if(basic_amount=="" || basic_amount=="0"){
                      alert("Please Add the Product first !"); 
                      $("#gst").val("");
                  }else{
                        
                      var gst = parseFloat(gst, 2);
                      if(gst=="" || gst=="0"){
                        cal_gst=0;  
                        basic_amount = parseFloat(basic_amount,2);
                        var total_amount=(basic_amount); 
                      }else{
                        cal_gst=(basic_amount)*gst/100;
                        basic_amount = parseFloat(basic_amount,2);
                        cal_gst = parseFloat(cal_gst,2);
                        round = cal_gst.toFixed();
                        cal_gst = parseFloat(round,2);
                        var total_amount=(basic_amount+cal_gst);
                      }
                       
                      if(cal_gst!="" ||cal_gst=="0"){
                        $("#total_amount").val(total_amount);
                      }else{
                        $("#total_amount").val("");
                      }
                  }
                  
                
                 
         
                  $.ajax({
                              type :"POST",
                              dataType :"json",
                               url : '<?php echo base_url(); ?>manage_sales_order/getproduct_rate',
                              data:{product_id:product_id},
                     success: function(data) {
                         //alert(data.price_mrp);
                     $("#price").val(data.price_mrp);
                     $("#kva").val(data.kva);
                     $("#hp").val(data.hp);
                     
               }
           });
                 });
                 
                 
                 
              
               
</script>

<!---------------------------------- get product rate  starts 04-01-2019------------------------------->