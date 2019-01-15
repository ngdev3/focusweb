
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
														<?php if($dymic_lead_id){ ?>
													    <input type="text" readonly class="form-control" id="dymic_lead_id" name="dymic_lead_id"  value="<?php echo set_value("dymic_lead_id", @$dymic_lead_id); ?>">
															
															
														<?php } else { ?>
                                                        <input type="text" readonly class="form-control" id="dymic_lead_id" name="product_no"  value="<?php echo set_value("dymic_lead_id", @$res->dymic_lead_id); ?>">
														<?php } ?>
                                                         
														  
					          <span for="" class="text-danger" id="dymic_lead_id" <?php echo form_error("dymic_lead_id"); ?>></span>									  

                                                        <label for="product_no">Lead Id</label>
<!--                                                        <span class="help-block">Your Product Name goes here...</span>-->
                                                        
                                                    </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                         <select name="type_of_lead" class="form-control edited" id="type_of_lead">
														<option value="">Select</option>
												 <?php foreach(@$type_of_lead as $value){ ?>
												 <option value="<?php echo $value->id; ?>" <?php echo set_select('type_of_lead', $value->id, $value->id == @$res->type_of_lead ? TRUE : FALSE); ?> ><?php echo ucwords($value->name); ?></option>
															 <?php } ?>
																</select>
                                                          <div class="text-danger"><?php echo form_error("type_of_lead"); ?></div>

                                                        <label for="type_of_lead">Type Of Lead<span class="red_sign">*</span></label>
<!--                                                        <span class="help-block">Your Product Name goes here...</span>-->
                                                        
                                                    </div>
                                                    </div>
                                               
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                   
															<input type="text" class="form-control txtOnly" id="client_name" name="client_name" value="<?php echo set_value("client_name", @$res->client_name); ?>">
                                                         <div class="text-danger"><?php echo form_error("client_name"); ?></div>

                                                            <label for="form_control_2">Client Name<span class="red_sign">*</span></label>
                                                        </div>
                                                    </div>
													
												
                                         <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                   
															<input type="text" class="form-control" id="website" name="website"  value="<?php echo set_value("website", @$res->website); ?>">
                                                         <div class="text-danger"><?php echo form_error("website"); ?></div>

                                                            <label for="website">Website<span class="red_sign">*</span></label>
                                                        </div>
                                                    </div>

                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                   
															<input type="text" class="form-control" id="location" name="location" value="<?php echo set_value("location", @$res->location); ?>">
                                                         <div class="text-danger"><?php echo form_error("location"); ?></div>

                                                            <label for="location" style="margin-top:-17px;">Location<span class="red_sign">*</span></label>
                                                        </div>
                                                    </div>

												<div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                   
															<input type="text" class="form-control" id="address_id" name="address" value="<?php echo set_value("address", @$res->address); ?>">
                                                         <div class="text-danger"><?php echo form_error("address"); ?></div>

                                                            <label for="address_id">Address<span class="red_sign">*</span></label>
                                                        </div>
                                                    </div>	
													
													<div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                   
															<input type="text" class="form-control txtOnly" id="contact_person" name="contact_person" value="<?php echo set_value("contact_person", @$res->contact_person); ?>">
                                                         <div class="text-danger"><?php echo form_error("contact_person"); ?></div>

                                                            <label for="contact_person">Contact Person<span class="red_sign">*</span></label>
                                                        </div>
                                                    </div>
													
													
												<div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                   
															<input type="text" class="form-control numOnly" id="contact_number" name="contact_number" value="<?php echo set_value("contact_number", @$res->contact_number); ?>">
                                                         <div class="text-danger"><?php echo form_error("contact_number"); ?></div>

                                                            <label for="contact_number">Contact Number<span class="red_sign">*</span></label>
                                                        </div>
                                                    </div>

                                                 <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                   
															<input type="text" class="form-control" id="email_id" name="email_id" value="<?php echo set_value("email_id", @$res->email_id); ?>">
                                                         <div class="text-danger"><?php echo form_error("email_id"); ?></div>

                                                            <label for="email_id">Email Id<span class="red_sign">*</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                         <select name="priority" class="form-control edited" id="priority">
														<option value="">Select</option>
														<option value="1" <?php echo set_select('priority', '1', @$res->priority == '1' && !empty(@$res) ? TRUE : FALSE); ?>>Low </option>
														<option value="2" <?php echo set_select('priority', '2', @$res->priority == '2' && !empty(@$res) ? TRUE : FALSE); ?>>Medium	</option>
														<option value="3" <?php echo set_select('priority', '3', @$res->priority == '3' && !empty(@$res) ? TRUE : FALSE); ?>>High</option>
												
												 
															
															</select>
                                                          <div class="text-danger"><?php echo form_error("priority"); ?></div>

                                                        <label for="priority">Priority<span class="red_sign">*</span></label>
<!--                                                        <span class="help-block">Your Product Name goes here...</span>-->
                                                        
                                                    </div>
                                                    </div>	

                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                            <textarea class="form-control" id="form_control_2" rows="2" name="notes"><?php echo set_value("notes", @$res->notes); ?></textarea>
                                                         <div class="text-danger"><?php echo form_error("notes"); ?></div>

                                                            <label for="form_control_2">Add Notes<span class="red_sign">*</span></label>
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
                                                        <input  type="submit" id="btn" class="btn blue mtr-20" value="Submit">
                                                        <a href="<?php echo base_url("leadmanagement/list_items"); ?>"class="btn default">Cancel</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- END SAMPLE FORM PORTLET-->


<!--New Form Ends---->
<div id="map" style='display:none;' ></div>

                <script>
				
				
			   function validate() {
				  
				var url = document.getElementById("website").value;
				var pattern = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
				if (pattern.test(url)) {
					//alert("Url is valid");
					return true;
				} 
					alert("Url is not valid!");
					return false;
 
              }
				
				 $( document ).ready(function() {
                $( ".txtOnly" ).keypress(function(e) {
                    var key = e.keyCode;
                    if (key >= 48 && key <= 57) {
                        e.preventDefault();
                    }
                });
            });
				
				
                 $("#add_form").validate(
            {
                errorElement: 'span', //default input error message container
                errorClass: 'text-danger', // default input error message class
                rules:
                        {
                            type_of_lead:
                                    {
                                        required: true
                                    },
                           
                           client_name:
                                    {
                                        required: true
                                    },
							
                             website:
                                    {
                                        required: true,
										url:true
                                    },	
								/*  location:
                                    {
                                        required: true
                                    },	
										
								 address:
                                    {
                                        required: true
                                    }, */
                            location:{ 
                                        required: function(element) {
                                        return (jQuery.isEmptyObject($("#address_id").val()));
                                        }
                                    },
                            address:{
                                        required: function(element) {
                                        return (jQuery.isEmptyObject($("#location").val()));
                                        }
                                    },

								 contact_person:
                                    {
                                        required: true
                                    },	
									contact_number:
                                    {
                                        required: true,
										  minlength:10,
		                                maxlength:15,
                                        number:true
                                    },
								email_id:
                                    {
                                        required: true,
										 email: true
                                    },	
								priority:
                                    {
                                        required: true
                                    },
                                  notes:
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
                              type_of_lead:
                                    {
                                        required: "Please Select one type of lead!"
                                    },
                                    client_name:
                                    {
                                        required: "Client Name cannot be blank!"
                                    },
									website:
                                    {
                                        required: "Please Enter Website",
										 required: "Please Enter vaild Website"
                                    },
									
									location:
                                    {
                                        required: "Please Enter Location if Address is empty"
                                    },
									
									address:
                                    {
                                        required: "Please Enter address if location is empty"
                                    },
									
									contact_person:
                                    {
                                        required: "Please Enter Contact Person"
                                    },
									
									contact_number:
                                    {
                                        required: "Contact Number cannot be blank",
										minlength: "The Phone Number field must be at least 10 characters in length.",
                                        maxlength: "The Phone Number field cannot exceed 15 characters in length.",
                                        number: "The Phone Number field must contain only numbers."
                                    },
									
									email_id:
                                    {
                                        required: "Please Enter Email Id",
										email: "The Email id field must contain a valid email address."
                                    },
									priority:
                                    {
                                        required: "Please Select Priority"
                                    },
							        notes:
                                    {
                                        required: "Please Enter Notes"
                                    },
					
                            status:
                                    {
                                        required: "Please Select Status!"
                                    },
                          
                        }
            });

</script>


 <script>
     

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('location');
		
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);
		

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            //window.alert("No details available for input: '" + place.name + "'");
            //return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        /*function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
            .addEventListener('click', function() {
              console.log('Checkbox clicked! New state=' + this.checked);
              autocomplete.setOptions({strictBounds: this.checked});
            });*/
      }

    </script>

 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBl0Vh5wVmOzr8tI9loqAZqJTBRMKI0aUs&libraries=places&callback=initMap"
        async defer></script>


        
<!-- validate mobile number takes only numeric values -->

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
	