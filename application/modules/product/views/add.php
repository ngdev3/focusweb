

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
                                                        <input type="text" class="form-control " id="prod_name"  name="product_name"  value="<?php echo set_value("name", @$res->name); ?>">
                                                         
                        <span for="" class="text-danger" id="prod_name_error" <?php echo form_error("product_name"); ?>></span>
                                                        <label for="prod_name">Product Name<span class="red_sign">*</span></label>
<!--                                                        <span class="help-block">Your Product Name goes here...</span>-->
                                                        
                                                    </div>
                                                    </div>
													
													<div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                       <select name="product_type" class="form-control edited" id="product_type">
														<option value="">Select</option>
																		 <?php foreach(@$product_type as $value){ ?>
															  <option value="<?php echo $value->id; ?>" <?php echo set_select('product_type', $value->id, $value->id == @$res->product_type ? TRUE : FALSE); ?> ><?php echo ucwords($value->name); ?></option>
															 <?php } ?>
																</select>
                                                        
						 <span for="" class="text-danger" id="product_type_error" <?php echo form_error("product_type"); ?>></span>								 
														 
                                                        <label for="product_type">Select type of Product<span class="red_sign">*</span></label>
<!--                                                        <span class="help-block">Your Product Name goes here...</span>-->
                                                        
                                                    </div>
                                                    </div>
													
												
                                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
														<?php if($product_no){ ?>
													    <input type="text" readonly class="form-control" id="product_no" name="product_no"  value="<?php echo set_value("product_no", @$product_no); ?>">
															
															
														<?php } else { ?>
                                                        <input type="text" readonly class="form-control" id="product_no" name="product_no"  value="<?php echo set_value("product_no", @$res->product_no); ?>">
														<?php } ?>
                                                         
														  
					<span for="" class="text-danger" id="product_no_error" <?php echo form_error("product_no"); ?>></span>									  

                                                        <label for="product_no">Product No<span class="red_sign">*</span></label>
<!--                                                        <span class="help-block">Your Product Name goes here...</span>-->
                                                        
                                                    </div>
                                                    </div>												
											<!-- 		
                                                <div id="spare_part">
											    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input type="text" class="form-control numOnly" id="price" name="price"   value="<?php echo set_value("price", @$res->price_mrp); ?>">
                                                          
					<span for="price" class="text-danger" id="price_error" <?php echo form_error("price_mrp"); ?>></span>									  

                                                        <label for="price">Price of Product (INR)<span class="red_sign">*</span></label>

                                                        
                                                    </div>
                                                    </div>
													</div> -->
													
													
												<!-- add more kva starts -->	
                                                   
												<div id="gen" >
												<?php if($kva_val){ ?>
                                    				<?php foreach($kva_val as $key=> $kva){ ?>
													<div id="kva_gen" class="add_div<?php echo $key; ?>">
														<div class="col-md-5 col-sm-6 col-xs-12">
															<div class="form-group form-md-line-input form-md-floating-label">
																<input type="text" class="form-control numOnly add_kva" id="kva<?php echo $key; ?>" name="kva[]"   lang="<?php echo $key; ?>" value="<?php echo $kva; ?>">
																	<span for="kva" class="text-danger" id="kva_error<?php echo $key; ?>" <?php echo form_error("kva[".$key."]");?>> </span>								  
																<label for="kva">KVA<span class="red_sign">*</span></label>
															</div>
														</div>
														<?php if($key=='0'){?>
														<div class="col-md-1 col-sm-6 col-xs-12">
														<a href="javascript:void(0);" class="add_field_button btn btn-success" title="Add field" style="padding:2px 4px;"><i class="fa fa-plus"></i></a>
														</div>	
													 <?php } ?>
													</div>
													
													<?php if($key!='0'){?>
														<div class="col-md-1 col-sm-6 col-xs-12 add_div<?php echo $key; ?>">
                                                		<a href="javascript:void(0)" class="remove_field btn btn-danger" id="add_div<?php echo $key; ?>" style="padding:2px 4px;"><i class="fa fa-remove"></i></a>   
														</div>	
													 <?php } ?>

														<?php }}else if(!empty($res->kva)){  
														
																
																$kva_val=explode(",",$res->kva);
																?>
													<?php foreach($kva_val as $key=> $kva){ ?>
													<div id="kva_gen" class="add_div<?php echo $key; ?>">
														<div class="col-md-5 col-sm-6 col-xs-12">
															<div class="form-group form-md-line-input form-md-floating-label">
																<input type="text" class="form-control numOnly add_kva" id="kva<?php echo $key; ?>" name="kva[]"   lang="<?php echo $key; ?>" value="<?php echo $kva; ?>">
																	<span for="kva" class="text-danger" id="kva_error<?php echo $key; ?>" <?php echo form_error("kva[".$key."]");?>> </span>								  
																<label for="kva">KVA<span class="red_sign">*</span></label>
															</div>
														</div>
														<?php if($key=='0'){?>
														<div class="col-md-1 col-sm-6 col-xs-12">
														<a href="javascript:void(0);" class="add_field_button btn btn-success" title="Add field" style="padding:2px 4px;"><i class="fa fa-plus"></i></a>
														</div>	
													 <?php } ?>
													</div>
													
													<?php if($key!='0'){?>
														<div class="col-md-1 col-sm-6 col-xs-12 add_div<?php echo $key; ?>">
                                                		<a href="javascript:void(0)" class="remove_field btn btn-danger" id="add_div<?php echo $key; ?>" style="padding:2px 4px;"><i class="fa fa-remove"></i></a>   
														</div>	
													 <?php } ?>

														<?php }}else{ ?>
														
													<div id="kva_gen" >
														<div class="col-md-5 col-sm-6 col-xs-12">
															<div class="form-group form-md-line-input form-md-floating-label">
																<input type="text" class="form-control numOnly add_kva"  name="kva[]"   lang="1" id="kva0" value="<?php echo set_value("kva", @$res->kva); ?>">
																	<span for="kva" class="text-danger" id="kva_error1" <?php echo form_error("kva[]"); ?>></span>								  
																<label for="kva">KVA<span class="red_sign">*</span></label>
															</div>
														</div>
														<div class="col-md-1 col-sm-6 col-xs-12">
															<a href="javascript:void(0);" class="add_field_button btn btn-success" title="Add field" style="padding:2px 4px;"><i class="fa fa-plus"></i></a>
														</div>
													</div>
														
														<?php } ?>
														<div class="input_fields_wrap numOnly"></div>
														                 
														<!--check x value-->
														<?php if($kva_val){ ?>
														<input type="hidden"  id="input_max_val" value="<?php echo count($kva_val)?>">
														
														<?php } else {?>
															<input type="hidden"  id="input_max_val" value="1">
														<?php }?>
														<!--check x value--> 
													


													<!--- add more kva ends -->
												
													 <div id="hp_c" >
														<div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input type="text" class="form-control numOnly" id="hp" name="hp"   value="<?php echo set_value("hp", @$res->hp); ?>">
                                                         
					<span for="hp" class="text-danger" id="hp_error" <?php echo form_error("hp"); ?>></span>											  

                                                        <label for="hp">HP<span class="red_sign">*</span></label>

                                                        
                                                    </div>
                                                    </div>
												   </div>
												   </div>
												   
												 <div id="gcr_product"> 
												  <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input type="text" class="form-control greater numOnly" id="price_mrp" name="price_mrp"   value="<?php echo set_value("price_mrp", @$res->price_mrp); ?>">
                                                         
         													<span for="price_mrp" class="text-danger" id="price_mrp_error" <?php echo form_error("price_mrp"); ?>></span>
                                                        <label for="price_mrp">MRP of the product (INR)<span class="red_sign">*</span></label>

                                                        
                                                    </div>
                                                    </div> 
													
													  <div class="col-md-6 col-sm-6 col-xs-12" id="ssp">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input type="text" class="form-control greater numOnly" id="price_ssp" name="price_ssp"  value="<?php echo set_value("price_ssp", @$res->price_ssp); ?>">
                                                          
				    <span for="price_ssp" class="text-danger" id="price_ssp_error" <?php echo form_error("price_ssp"); ?>></span>										  

                                                        <label for="price_ssp">SSP of the product (INR)<span class="red_sign">*</span></label>

                                                        
                                                    </div>
                                                    </div> 
													
													<div class="col-md-6 col-sm-6 col-xs-12" id="msp">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input type="text" class="form-control greater numOnly" id="price_msp" name="price_msp"   value="<?php echo set_value("price_msp", @$res->price_msp); ?>">
                                                          
														  
			  <span for="price_msp" class="text-danger" id="price_msp_error" <?php echo form_error("price_msp"); ?>></span>											  

                                                        <label for="price_msp">MSP of the product (INR)<span class="red_sign">*</span></label>

                                                        
                                                    </div>
                                                    </div> 
													</div>
													
													<div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input type="text" class="form-control" id="hsn_sac" name="hsn_sac"   value="<?php echo set_value("hsn_sac", @$res->hsn_sac); ?>">

														  
					  <span for="hsn_sac" class="text-danger" id="hsn_sac_error" <?php echo form_error("hsn_sac"); ?>></span>									  

                                                        <label for="hsn_sac">HSN/SAC<span class="red_sign">*</span></label>

                                                        
                                                    </div>
                                                    </div>
													
													
													<div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                            <textarea class="form-control" id="description" rows="2" name="description"><?php echo set_value("description", @$res->description); ?></textarea>
                                                         
			 <span for="description" class="text-danger" id="description_error" <?php echo form_error("description"); ?>></span>											 

                                                            <label for="description">Description<span class="red_sign">*</span></label>
                                                        </div>
                                                    </div>
												   
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                            <select class="form-control edited" name="status" id="status">
                                                                <option value="">Select Status</option>
                                                                <option value="1"  <?php echo set_select('status', '1', @$res->status == '1' && !empty(@$res) ? TRUE : FALSE); ?>>Active</option>
                                                                <option value="0"  <?php echo set_select('status', '0', @$res->status == '0' && !empty(@$res) ? TRUE : FALSE); ?>>Inactive</option>              
                                          
                                                            </select>
                                                        
														
					<span for="status" class="text-danger" id="status_error" <?php echo form_error("status"); ?>></span>									

                                                            <label for="status">Status<span class="red_sign">*</span></label>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xs-12 col-sm-12 text-center">
                                                    <div class="form-actions noborder">
                                                        <input  type="button" id="submits" class="btn blue mtr-20" value="Submit">
                                                        <a href="<?php echo base_url("product/list_items"); ?>"class="btn default">Cancel</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

<script>   
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
	   
	
</script>
<script> 
$(document).ready(function() {
   
   $(".numOnly").keydown(function (e) {
   //$('#mobile_number_id').html('');

       // Allow: backspace, delete, tab, escape, enter and .
       if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
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
$("#submits").click(function(){ 
			z = false;
			
			var prod_name = $.trim($("#prod_name").val()); 
			var product_type = $("#product_type").val(); 
			//var price = $.trim($("#price").val()); 
			var hsn_sac = $.trim($("#hsn_sac").val()); 
			var description = $.trim($("#description").val()); 
			var kva = $.trim($("#kva0").val()); 
			var hp = $.trim($("#hp").val()); 
			var price_mrp = $.trim($("#price_mrp").val()); 
			var price_ssp = $.trim($("#price_ssp").val()); 
			var price_msp = $.trim($("#price_msp").val()); 
			var status = $("#status").val(); 

  			if(prod_name==""){
	
				    z = true;
				   $("#prod_name_error").text("The Product Name field is required.");
			   }  else{
                  $("#prod_name_error").text("");

               }
			if(product_type==""){
				  
				  z = true;
				 $("#product_type_error").text("Please Select type of Product.");
			 }else{
			  $("#product_type_error").text("");

			 }
			   
		
             if(hsn_sac==""){
		
				    z = true;
				   $("#hsn_sac_error").text("The Hsn/Sac field is required.");
			   }else{
                $("#hsn_sac_error").text("");

               }

            if(description==""){
				
				    z = true;
				   $("#description_error").text("The Description field is required.");
			   }else{
                $("#description_error").text("");

               }
			   
			    if(price_mrp==""){
			
				    z = true;
				   $("#price_mrp_error").text("The MRP of product field is required.");
			   }else{
                $("#price_mrp_error").text("");

               }			   
		
               
              
		if(status==""){
				    z = true;
				   $("#status_error").text("Please select Status.");
			   }else{
                $("#status_error").text("");

               }
			   if(product_type=='1'){
				if(kva=="" || kva!=""){
						$("#kva_error").text("");
						
			        }
					if(hp=="" || hp!=""){
						$("#hp_error").text("");
					
			        }
					if(price_msp=="" || price_msp!=""){
						$("#price_msp_error").text("");
						
			        }
					if(price_ssp=="" || price_ssp!=""){
						$("#price_ssp_error").text("");
						
			        }


			   }
			   if(product_type=='2'){
				    //KVA starts
         
				var kva_array = [];
				$( ".add_kva" ).each(function() {
					
					//   alert($(this).val());
					//alert($(this).attr('lang'));
					var id_kva= $(this).attr('lang');
					var values_kva = $(this).val();
					
					
					
					if(values_kva==""){
							z = true;
						$("#kva_error"+id_kva).text("The KVA field is required.");
						//alert("The Summary field is required.");
					}
					else{
						$("#kva_error"+id_kva).text("");
						
							for (i = 0; i < kva_array.length; i++) 
							{ 
							
								if(kva_array[i]==values_kva)
										{
										
											z = true;
											//alert("The Summary can not be same.");
											$("#kva_error"+id_kva).text("The KVA can not be same.");
										}      
							}
							kva_array.push(values_kva);								
					}
				});

				//KVA ends
							// if(kva==""){
							// 	z = true;
							// 	$("#kva_error").text("The Kva field is required.");
							// 	}else{
							// 	$("#kva_error").text("");
							// }
							if(hp=="" || hp!=""){
								$("#hp_error").text("");
							}
							if(price_ssp==""){
				  
									z = true;
									$("#price_ssp_error").text("The SSP of product field is required.");
								}else{
								$("#price_ssp_error").text("");

								}			   
						
						if(price_msp==""){
						
									z = true;
									$("#price_msp_error").text("The MSP of product field is required.");
								}else{
								$("#price_msp_error").text("");

								}
			   }
			   if(product_type=='3' || product_type=='4'){
					if(kva=="" || kva!=""){
								$("#kva_error").text("");
							}
							if(hp==""){
								z = true;
								$("#hp_error").text("The Hp field is required.");
							}else{
								$("#hp_error").text("");

							}
							if(price_ssp==""){
				  
									z = true;
									$("#price_ssp_error").text("The SSP of product field is required.");
								}else{
								$("#price_ssp_error").text("");

								}			   
						
						if(price_msp==""){
						
									z = true;
									$("#price_msp_error").text("The MSP of product field is required.");
								}else{
								$("#price_msp_error").text("");

								}

			   }
			  
			   if(product_type!="1"){
				if(price_mrp!="" && price_ssp!=""){
					var diff=price_mrp-price_ssp;
					//alert(diff);
					if(diff<"0"){
						z = true;
						alert("Price MRP can not less than Price SSP.");
						$("#price_ssp").val(""); 
					}
				}
				if(price_msp!="" && price_ssp!=""){
					var diff=price_ssp-price_msp;
					//alert(diff);
					if(diff<"0"){
						z = true;
						alert("Price SSP can not less than Price MSP.");
						$("#price_msp").val(""); 
					}
				}  
			   }
			   
						
						
						
						if(z==false){
							
						$("#add_form").submit();
										
						}
});

</script>

<script>
$(document).ready(function(){
	var kva = $.trim($("#kva0").val()); 
	var hp = $.trim($("#hp").val()); 
	var price_msp = $.trim($("#price_msp").val()); 
	var price_ssp = $.trim($("#price_ssp").val()); 
	
	$("#kva_gen").hide();
    $("#hp_c").hide();
	$("#msp").hide();
	$("#ssp").hide();
	if(hp!=""){
		$("#hp_c").show();
	}
	if(kva!=""){
		$("#kva_gen").show();
	}
	if(price_msp!=""){
		$("#msp").show();
	}
	if(price_ssp!=""){
		$("#ssp").show();
	}
	 

$("#product_type").on("change",function(){ 
				
			 var optionSelected = $("option:selected", this);
             var valueSelected = this.value;
			 
			 if(valueSelected=='1')
			 {
				 
			    //  $("#gcr_product").hide();
			     $("#gen").hide();
			     $("#kva_gen").hide();
                 $("#hp_c").hide(); 
				 $("#msp").hide();
				 $("#ssp").hide();
                //  $("#spare_part").show();
                 			 
			
			
				 
			 }
			 
			if(valueSelected=='2')
			 {
				 			
				$("#gen").show(); 
				$("#kva_gen").show(); 
				$("#hp_c").hide(); 
				$("#msp").show();
				 $("#ssp").show();
				// $("#gcr_product").show();
				
				// $("#spare_part").hide();
				
			 }
			 
			  if(valueSelected=='3' || valueSelected=='4')
			 {
				  
				$("#gen").show(); 
				$("#kva_gen").hide(); 
				$("#hp_c").show(); 
				$("#msp").show();
				 $("#ssp").show();
				// $("#gcr_product").show();
				// $("#spare_part").hide();
			 }
 
		});
	// $(".greater").on("change",function(){ 
	// 	var price_mrp = $.trim($("#price_mrp").val()); 
	// 	var price_ssp = $.trim($("#price_ssp").val()); 
	// 	var price_msp = $.trim($("#price_msp").val()); 

	// 	if(price_mrp!="" && price_ssp!=""){
	// 		var diff=price_mrp-price_ssp;
	// 		//alert(diff);
	// 		if(diff<"0"){
	// 			alert("Price MRP can not less than Price SSP.");
	// 			$("#price_ssp").val(""); 
	// 		}
	// 	}
	// 	if(price_msp!="" && price_ssp!=""){
	// 		var diff=price_ssp-price_msp;
	// 		//alert(diff);
	// 		if(diff<"0"){
	// 			alert("Price SSP can not less than Price MSP.");
	// 			$("#price_msp").val(""); 
	// 		}
	// 	}


	// 	});
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = $("#input_max_val").val();; //initlal text box count

//    
    $(add_button).click(function(e){ //on add input button click
	
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
        $(wrapper).append('<div id="kva_gen" class="add_div'+x+'"><div class="col-md-5 col-sm-6 col-xs-12"><div class="form-group form-md-line-input form-md-floating-label"><input type="text" class="form-control numOnly add_kva" id="kva'+x+'" name="kva[]"   lang="'+x+'" value=""><span for="kva" class="text-danger" id="kva_error'+x+'" <?php echo form_error("kva[]"); ?>></span><label for="kva">KVA<span class="red_sign">*</span></label></div></div><div class="col-md-1 col-sm-6 col-xs-12"><a href="javascript:void(0)" class="remove_field btn btn-danger" id="add_div'+x+'" style="padding:2px 4px;"><i class="fa fa-remove"></i></a></div></div>');
      }
        else{
            alert("Fields can not be greater than "+max_fields);
        }
		
	
    });
    
    $(".remove_field").click(function(){ //user click on remove text
           
        //alert();
        var ids =this.id ;
           
         
          $("."+ids).remove();
          //x--;
        // e.preventDefault(); $(this).parent('div').remove(); x--;
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
           var ids =this.id ;
           
         
          $("."+ids).remove();
          //x--;
        // e.preventDefault(); $(this).parent('div').remove(); x--;
    })

     
    
});

</script>
    
    