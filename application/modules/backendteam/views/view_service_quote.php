<style>
    .input-icon p{margin: 0px;}
    .input-icon{padding: 8px 0 0 0}
    .mt-15{margin-top: 15px;}
    .form-horizontal .control-label{text-align:left!important;font-weight:600;}
.upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
}

.newbtn {
 
  color: #337ab7;
  background-color: white;
  padding: 8px 20px;
  border-radius: 8px;
  font-size: 20px;
  font-weight: bold;
}

.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
}

#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #616f80;
  color: white;
}
</style>



<h1 class="page-title" style="font-weight: 500"> <?php echo $page_title; ?> 
<!-- <small>Lorem Ipsum is dummy text of the printing industry.</small> -->
</h1>
<div class="row">

    <div class="portlet light bordered">
        <div class="portlet-title">


            <div class="portlet-body form add_prodcut_form">

                <form class="form-horizontal" role="form" id="add_form" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12 col-sm-12">
                        <div class="col-md-4">
                        
                          
                                <p>Quote No :<?php echo ucwords($res->quote_no); ?></p>                          
                            
                        </div>
                     
                    </div>
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Client Name :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->client_name); ?></p>                          
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Location :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->complaint_location); ?></p>                          
                            </div>
                        </div>
                    </div>
                    
                    
                    
                     <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Client's Email Id :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->client_email); ?></p>                          
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Service Person :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->serviceperson_name); ?></p>                          
                            </div>
                        </div>
                    </div>
                    
                     <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Service Person Contact Number :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                            <p><?php echo ucwords($res->serviceperson_number); ?></p>                             
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Service Person Email ID :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                            <p><?php echo ucwords($res->serviceperson_email); ?></p>                             
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Note :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                            <p><?php echo ucwords($res->notes); ?></p>                             
                            </div>
                        </div>
                    </div>
                    
                     <!--Product List-->
                     <div class="table" id="customers">                   
                    <table class="table1 table-striped table-bordered table-hover box" >
                        <thead>
                        <th id="line"  width="5%"><center> SL.No. </center></th>
                        <th id="line"> <center>Part No. </center></th>
                        <th id="line"> <center>Part Name  </center></th>
                        <th id="line"> <center>HSN/SAC </center></th>
                        <th id="line"> <center>Unit</center></th>
                        <th id="line"> <center> <center> Qty</center></th>
                      
                        <th id="line"> <center>Quote Amount (INR) </center></th>
                        
                            <?php
                            foreach (@$product as $i => $row){
                                ?>
                         <tr>
                                
                                <td id="line"  scope="col"> <center><?php echo ++$i;  ?></center></td>
                               
                                <td id="line"  scope="col"> <center><?php echo $row->part_number; ?></center></td>
                                <td id="line"  scope="col"> <center><?php echo $row->part_name; ?></center></td>
                                <td id="line"  scope="col"> <center><?php echo $row->hsn_sac; ?></center></td>
                                
                                <td id="line"  scope="col">  <center><?php echo $row->unit_id; ?></center></td>
                                 <td id="line"  scope="col"> <center><?php echo $row->quantity; ?></center></td>
                                 <td id="line"  scope="col"> <center><?php echo $row->price; ?></center></td>
                                </tr>
                            <?php } ?>

                             
					</thead> 
                     
                    </table>
                                
                 </div>
                     
                     
                     
                     
                      <!--Product List Ends-->
                    
    
                    
                    <div class="form-body">

                       
                        <!--<div class="col-md-12 col-sm-12">
                            <label for="inputEmail12" class="col-md-4 control-label">Send Quote(INR) :</label>
                                <div class="form-group col-md-3">
                                    <input type="text" class="form-control numOnly" id="send_quote" name="send_quote"  value="<?php echo set_value("send_quote", @$res->send_quote); ?>" >
                                    <div class="text-danger" id="error_field1" ><?php echo form_error("send_quote"); ?></div>
                                </div>
                        </div>-->
                        <!-- <div class="col-md-12 col-sm-12 upload-btn-wrapper">
                            <label for="inputEmail12" class="col-md-4 control-label">Browse Specifications :<span class="red_sign">*</span></label>
                                <div class="form-group col-md-3">
				                    <i class="col-md-12 newbtn fa fa-upload" ></i>
                                    <input type="file" class="form-control  form-control-line imageOnly" id="specifications" name="specifications"  value="<?php echo set_value("specifications", @$res->specifications); ?>"  style='cursor: pointer;'>
                                    <div class="text-danger" id="error_field2" ><?php echo form_error("specifications"); ?></div>
                                </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <label for="inputEmail12" class="col-md-4 control-label">Email Id :</label>
                                <div class="form-group col-md-3">
                                    <input type="text" class="form-control add_email" id="emali_id1" name="email_id[]" lang="1" value="" >
                                    <div class="text-danger" id="error_1"><?php echo form_error("email_id[]"); ?></div>
                                    
                                </div>
                                <a href="javascript:void(0);" class="add_field_button btn btn-success" title="Add field"><i class="fa fa-plus" aria-hidden="true"></i></a>
                        </div> -->
                        <div class="input_fields_wrap"></div>
                            
                        <div class="form-group col-sm-2">
                            <div class="col-md-2">
                                  
                            </div>
                        </div>
                       
                    </div>
                   
                  
                   
      
                    <div class="form-group text-center col-xs-12 mt-15">
                        <div class="col-md-12">
                        <!-- <button type="button" id="submits" class="btn btn-success">Send</button> -->
                            <a href="<?php echo base_url("backendteam/list_items_service_quote"); ?>"class="btn green">Back</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->


    </div>
</div>
<!-- chart 3 -->

<script type="text/javascript">
$(document).ready(function() {
    var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x =1 //$("#input_max_val").val(); //initlal text box count

//    
    $(add_button).click(function(e){ //on add input button click
	
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            
        $(wrapper).append('<div class="col-md-12 col-sm-12"><div class="add_div add_div'+x+'"><label for="inputEmail12" class="col-md-4 control-label"></label><div class="form-group col-md-3"><input type="text" class="form-control add_email" id="emali_id'+x+'" name="email_id[]" lang="'+x+'" value="" ><div class="text-danger" id="error_'+x+'"><?php echo form_error("email_id[]"); ?></div></div><a href="javascript:void(0)" class="remove_field btn btn-danger" id="add_div'+x+'"><i class="fa fa-times" aria-hidden="true"></i></a></div></div>');
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

    ////////////////////////////////////

    $("#submits").click(function(){ //user click on remove text
           //alert("yvguiyvuvuitv");
		   
		    
		   
		   
	        var field1 = $("#send_quote").val(); 
            var field2 = $("#specifications").val();
		  
		  
		   //alert(field1);
           var z = false;
		   
		    if(field1==""){
				    z = true;
				   $("#error_field1").text("The Send Quote field is required.");
			   }else{
                $("#error_field1").text("");

               }
			   
			    if(field2==""){
				    z = true;
				   $("#error_field2").text("The Specifications field is required.");
			   }else{
                $("#error_field2").text("");

               }
			    
		   
                  
                   
                   
              
		  

         //summary starts
         
         var sum_array = [];
           $( ".add_email" ).each(function() {
			   
            //   alert($(this).val());
			   //alert($(this).attr('lang'));
			var id_sum= $(this).attr('lang');
			  var values_sum = $(this).val();
			
			  
			  
              if(values_sum==""){
				//     z = true;
				//    $("#error_"+id_sum).text("The Email id field is required.");
                   //alert("The Summary field is required.");
			   }
			   else{
                $("#error_"+id_sum).text("");

                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    if(!regex.test(values_sum)){
                                z = true;
                                //alert("hello");
                               
                                $("#error_"+id_sum).text("Please Enter Valid Email ID.");
                        }
                    for (i = 0; i < sum_array.length; i++) 
					   { 
                     
                        if(sum_array[i]==values_sum)
								{
								
									z = true;
                                    //alert("The Summary can not be same.");
									$("#error_"+id_sum).text("The Email ID can not be same.");
								}      
                       }
                       sum_array.push(values_sum);								
			   }
           });

         //summary ends
          
           //URL validation dated 23-10-2018
            $(".add_url2").each(function() {
                       var urls = $(this).val();
                       var idss=$(this).attr('id');
                       if(urls){
                       if(!validateURL(urls)) {
                       $(".error_"+idss).text('Invalid format.');
				 z = true;
            }else{
                
                 $(".error_"+idss).text('');
            }
        }
                    });
          //URL validation dated 23-10-2018
                            if(z==false)
									{
                                      
										//$( "#submits" ).click(function() {
										  $( "#add_form" ).submit();
										//});
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

$(function(){
    $('.imageOnly').change( function(e) {
        
       // alert();
      var files = e.originalEvent.target.files;
      var selected = $(this);
      $('.invalid-format').hide();
      for (var i=0, len=files.length; i<len; i++){
        var fileNameExt = files[i].name.substr(files[i].name.lastIndexOf('.') + 1);
        //console.log(files[i].name, files[i].type, files[i].size);
        if($.inArray(fileNameExt, ['jpg','jpeg', 'gif', 'png', 'JPG', 'JPEG', 'GIF', 'PNG','txt','doc','docx','xls','csv','TXT','DOC','DOCX','XLS','CSV']) == -1) {
            $(selected).after('<span class="invalid-format" style="text-decoration:none;color:red;">Please upload allowed type of file ( jpg, jpeg, gif, png, txt, doc, xls, csv) only.<span>');
          $(selected).val('');
          }
      }
         });
  });
</script>
	

