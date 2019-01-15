<?php // pr($view_incentive);?>
<style>
p1{
  color:blue;  
  font-weight: bold;
  text-transform:capitalize;
}
span1{
    color:red;

}

   


.input-icon p{margin: 0px;}

.mt-15{margin-top: 15px;}
.form-horizontal .control-label{text-align:left!important;font-weight:600;}
.box {
    background-color: white;
    width: 500px;
    height: 200px;
    border: 2px solid black;
    padding: 15px;
    margin: 40px;
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
                        <?php if(getUserInfos()->role == "0"){ ?>
                            
                        <div class="form-group col-md-4 col-sm-12">

                        <label for="inputEmail12" class="col-md-6 control-label bold">Branch Manager :</label>
                    
                        <div class="col-md-6">
                        <div class="input-icon" >
                      
                                <p><?php echo ucwords($manager->fname. ' '.$manager->lname); ?></p>                          
                            </div>
                        </div>
                    </div>
                        <?php } ?>
                        <?php if(getUserInfos()->role == "0" || getUserInfos()->role == "1"){ ?>
                            <div class="form-group col-md-4 col-sm-12">
                        <label for="inputEmail12" class="col-md-6 control-label bold">Coordinator :</label>
                        <div class="col-md-6">
                            <div class="input-icon" >
                                <p><?php echo ucwords($cordinator->fname. ' '.$cordinator->lname); ?></p>                          
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                            <div class="form-group col-md-4 col-sm-12">
                        <label for="inputEmail12" class="col-md-6 control-label bold">Service person :</label>
                        <div class="col-md-6">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->fname. ' '.$res->lname); ?></p>                          
                            </div>
                        </div>
                    </div>
      
                    <!-- hidden value for salesperson id -->
                    <br><br><br><br>  
                    <input type="hidden"  readonly class="form-control numOnly" id="serviceperson_id" name="serviceperson_id"  value="<?php echo set_value("serviceperson_id", @$res->id); ?>">
                    <div class="text-danger"><?php echo form_error("serviceperson_id"); ?></div>
                    <!-- hidden value for salesperson id END  -->   
                              
                   <div class="box">         
                    <div class="col-md-8 col-sm-12 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text"  class="form-control numOnly" id="sale_price" name="sale_price"  value="<?php echo set_value("sale_price", @$view_incentive->sale_price); ?>">
                                    <div class="text-danger"><?php echo form_error("sale_price"); ?></div>

                                    <label for="sale_price">Sale (INR)</label>

                                </div>
                            </div>

                             <div class="col-md-8 col-sm-12 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text"  class="form-control numOnly" id="sale_percentage" name="sale_percentage" value="<?php echo set_value("sale_percentage", @$view_incentive->sale_percentage); ?>">
                                    <div class="text-danger"><?php echo form_error("sale_percentage"); ?></div>

                                    <label for="sale_percentage">Percentage (%)</label>

                                </div>
                            </div>
</div>

	   <div class="form-group">
                        <?php  if($view_incentive){
                            foreach ($view_incentive as $key => $value) { 
                               // pr($value->sale_price);
                            ?>
							
							
							
							
							
							<div style="margin:40px;" id="remove_<?php echo $key;?>"><span><i class="fa fa-circle"></i></span>&nbsp;<label><b>Sales (INR) : </label></b>&nbsp;&nbsp;<p1><?php  echo $value->sale_price;?></p1>&nbsp;&nbsp;&nbsp;&nbsp;<label ><b>Percentage :</b></label>&nbsp;&nbsp;<p1> <?php  echo $value->sale_percentage;?> % </p1>
							<input type="hidden" name="sale_price_arr[]" value="<?php  echo $value->sale_price;?>"   />  
							<input type="hidden" name="sale_percentage_arr[]" value="<?php  echo $value->sale_percentage;?>" />&nbsp;&nbsp;
							<span1 onclick="remove_div(<?php echo $key;?>)"><i class="fa fa-trash" title="Delete order"></i></span1><hr>
                            <div class="text-danger"><?php echo form_error("sale_price_arr[]"); ?></div>

							   <div class="text-danger"><?php echo form_error("sale_percentage_arr[]"); ?></div>
							</div>
							

<!-- <div style="margin:40px;" id="remove_'+x+'"><span><i class="fa fa-circle"></i></span>&nbsp;<label><b>Sales (INR) : </label></b>
&nbsp;&nbsp;<p1>sale_price</p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Percentage :</b></label>' +'&nbsp;&nbsp;<p1>'+sale_percentage+' % </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+input_apeends+'</div>'
 -->


                        <?php }   }?>


       <div class="input_fields_wrap"></div>
    </div>
	
	    <div class="form-group">
                                    <label class="col-md-12"></label>
                                    <div class="col-md-12">
                                  <a href="javascript:void(0);" class="add_field_button btn btn-success" title="Add field" style="padding:2px 4px; margin:40px;">Add More <i class="fa fa-plus-circle"></i></a>
                               
                                  
        <?php if($chapter_val){ ?>
                                <input type="hidden"  id="input_max_val" value="<?php echo count($chapter_val)?>">
                                
                                <?php } else {?>
                              <input type="hidden"  id="input_max_val" value="1">
                                <?php }?>
                           <!--check x value-->     
     
	  </div>
         </div>  

                             <div style=" margin: 20px;" class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited" name="status" id="form_control_3">
                                        <option value="">Select Status</option>
                                        <option value="1"  <?php echo set_select('status', '1', @$view_incentive[0]->status == '1' && !empty(@$view_incentive) ? TRUE : FALSE); ?>>Active</option>
                                        <option value="0"  <?php echo set_select('status', '0', @$view_incentive[0]->status == '0' && !empty(@$view_incentive) ? TRUE : FALSE); ?>>Inactive</option>              

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
                                <a href="<?php echo base_url("serviceperson/list_items"); ?>"class="btn default">Cancel</a>
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
                                    sale_price:
                                            {
                                                //required: true,
                                                number:true,
                                                min:1
                                            },
                                    sale_percentage:
                                            {
                                                //required: true,
                                                number:true,
                                                min:0,
                                                max:100
                                            },
                                   
                                    status:
                                            {
                                                required: true
                                            },
                                           
                                            
                                            
                                },
                        messages:
                                {
                                    sale_price:
                                            {
                                               // required: "Please Enter Sale (INR) !",
                                                number: "The Sale (INR) field must contain only numbers.",
                                                min:"The Sale (INR) must contain a number greater than or equal to 1."
                                  
                                            },
                                    sale_percentage:
                                            {
                                              //  required: "Please Enter Percentage (%) !",
                                                number: "The Percentage (%) field must contain only numbers.",
                                                min:"The Percentage (%) must contain a number greater than or equal to 0.",
                                                max:"The Percentage (%) must contain a number smaller than or equal to 100."
                                  
                                            },
                                    status:
                                            {
                                                required: "Please Select Status!"
                                            }
                                            
                                          
                                }
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


<script> 
	$(document).ready(function(){
    $("#btn1").click(function(){
        $("p").append(".app");
    });
   
});
 
$(document).ready(function() {
    var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = $("#input_max_val").val();; //initlal text box count

//  
  
    $(add_button).click(function(e){ //on add input button click
   // alert("sdf");
        var sale_price = $("#sale_price").val();
          
          var sale_percentage = $("#sale_percentage").val();
        
            if(sale_price!="" && sale_percentage!=""){
                if(sale_price>=1){
                if(sale_percentage>=0 && sale_percentage<=100){
               
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
           
            y=x;
       
            x++; //text box increment
            var sale_price = $("#sale_price").val();
          
            var sale_percentage = $("#sale_percentage").val();
         
         
               var input_apeends = '<input type="hidden" name="sale_price_arr[]" value="'+sale_price+'"   />  <input type="hidden" name="sale_percentage_arr[]" value="'+sale_percentage+'"   /> <span1 onclick="remove_div('+x+')"><i class="fa fa-trash" title="Delete order"></i></span1><hr>';
               $(wrapper).append('<div style="margin:40px;" id="remove_'+x+'"><span><i class="fa fa-circle"></i></span>&nbsp;<label><b>Sales (INR) : </label></b>' +'&nbsp;&nbsp;<p1>'+sale_price+'</p1>&nbsp;&nbsp;&nbsp;&nbsp;'+'<label ><b>Percentage :</b></label>' +'&nbsp;&nbsp;<p1>'+sale_percentage+' % </p1>&nbsp;&nbsp;&nbsp;&nbsp;'+input_apeends+'</div>'); //add input box
           
             /*   var sale_price = $("#sale_price").val("");
          
          var sale_percentage = $("#sale_percentage").val("");
 */
           
      
        }
        else{
            alert("Fields can not be greater than "+max_fields);
        }
    } else{
        alert("The Percentage (%) must lies between 0 to 100.");
          
        }
     } else{
            
            alert("The Sale (INR) must contain a number greater than or equal to 1.");
        }
     }else{
            alert("Fields can not be empty");
        }
    });
  

     
    
});
function remove_div(ids){
  $("#remove_"+ids).html("");
}

</script> 
<!-- <script>

    $(.add_field_button).click(function(e){ //on add input button click
   alert("sdf");
        var sale_price = $("#sale_price").val("");
          
          var sale_percentage = $("#sale_percentage").val("");

    });

    </script>  -->