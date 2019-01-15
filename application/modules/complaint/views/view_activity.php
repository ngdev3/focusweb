<?php //pr($res); ?> 
<style>
    .input-icon p{margin: 0px;}
    .input-icon{padding: 8px 0 0 0}
    .mt-15{margin-top: 15px;}
    .form-horizontal .control-label{text-align:left!important;font-weight:600;}

    span1{
        color:red;
    }
</style>



<h1 class="page-title" style="font-weight: 500"> <?php echo $page_title; ?> 
<!-- <small>Lorem Ipsum is dummy text of the printing industry.</small> -->
</h1>
<div class="row">

    <div class="portlet light bordered">
        <div class="portlet-title">


            <div class="portlet-body form add_prodcut_form">
            <?php if($res->meeting_id){?>
                <div class="form-group col-md-6 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Meeting ID:</label>
                        <div class="col-md-3">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->meeting_id); ?></p>                          
                            </div>
                        </div>
                    </div>
            <?php  }?>
            <?php if($res->dynamic_complaint_id){?>
                <div class="form-group col-md-6 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Complaint ID:</label>
                        <div class="col-md-3">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->dynamic_complaint_id); ?></p>                          
                            </div>
                        </div>
                    </div>
            <?php  }?>
            <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Complaint Type:</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->name); ?></p>                          
                            </div>
                        </div>
                    </div>
                <?php if(@$res->dg_set_number) { ?>
					 <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">DG Set Number :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->dg_set_number; ?></p>                          
                            </div>
                        </div>
                    </div>
				    <?php } ?>
                    <?php if(@$res->kva) { ?>
					 <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">KVA :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->kva; ?></p>                          
                            </div>
                        </div>
                    </div>
				    <?php } ?>
                    <?php if(@$res->engine_alternator) { ?>
					 <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Engine/Alternator :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->engine_alternator; ?></p>                          
                            </div>
                        </div>
                    </div>
				    <?php } ?>
                   

                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Client Name:</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->client_name); ?></p>                          
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Contact Person:</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->contact_person); ?></p>                          
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Contact Number :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->contact_number); ?></p>                          
                            </div>
                        </div>
                    </div>
                    
                    
                    
                     <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Location :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->location); ?></p>                          
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Activity :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->activity); ?></p>                          
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Description :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->description); ?></p>                          
                            </div>
                        </div>
                    </div>
                    
                    <!--  <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Gender :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php if ($res->gender == 1) {
                                        echo "Male";
                                    } else if($res->gender == 2) {
                                        echo "Others";
                                    }
                                    else if($res->gender == 0) {
                                        echo "Female";
                                    }else{
                                        echo "";
                                    }
                                    ?></p>                          
                            </div>
                        </div>
                    </div>
 -->
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Service Person :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->fname); ?> <?php echo ucwords($res->lname); ?></p>                          
                            </div>
                        </div>
                    </div>
                    <?php if(getUserInfos()->role == "0"){ ?>
                    
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Branch Manager :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->m_fname); ?> <?php echo ucwords($res->m_lname); ?></p>                          
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if(getUserInfos()->role == "0" || getUserInfos()->role == "1"){ ?>
                     <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Coordinator :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->c_fname); ?> <?php echo ucwords($res->c_lname); ?></p>                          
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    
                     <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Meeting Date :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                       <?php     $newDate = date("d-m-Y", strtotime($res->meeting_date)); ?>
                                <p><?php echo $newDate; ?></p>                          
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">From :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                            <?php  $start_time = date("g:i a", strtotime($res->start_time)); 
                                   $end_time = date("g:i a", strtotime($res->end_time)); 
                            ?>
                                <p><?php echo $start_time." <span class='control-label'> To: </span> ".$end_time; ?></p>     
                                                 
                            </div>
                        </div>
                    </div>

                    <form method="post" action="#" id="edit_form">

                                        <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Service Notes :<span1>*</span1></label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                            <textarea rows="3" cols="105" class="textarea-group" placeholder="Service Notes"  name="service_notes" value=><?php  echo set_value("service_notes", @$res->service_notes);?></textarea>     
                            <div class="text-danger" class="input-error col-md-12"><?php echo form_error("service_notes"); ?></div>                    
                            </div>
                        </div>
                    </div>

                
                   

                      

                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Outcome Status : </label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <?php
                                if (@$res->outcome_status == '0') {
                                    $outcome_status = 'In Process';
                                }
                                if (@$res->outcome_status == '1') {
                                    $outcome_status = 'Won';
                                }
                                if (@$res->outcome_status == '2') {
                                    $outcome_status = 'Lost';
                                }
                                if (@$res->outcome_status == '3') {
                                    $outcome_status = 'Continue';
                                }
                                if (@$res->outcome_status == '4') {
                                    $outcome_status = 'Reshedule';
                                }
                                ?>    
                                                            
                                                            
								
							
                                
                                
                                <p><?php echo $outcome_status;?></p>    
                               
                                
                                
                                
                            </div>
                        </div>
                    </div>

                   <?php if (@$res->outcome_status == '4') { ?>
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Date & Time :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                            <p> static Date </p>
                                 </div>
                        </div>
                    </div>        
                            <?php    } ?>
                  

                  <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Status: </label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                            <select class="col-md-3" name="status" disabled class="form-control form-control-line">
                                        
                                        <option value="1"  <?php echo set_select('status', '1', @$res->status == '1' && !empty(@$res) ? TRUE : FALSE); ?>>Active</option>
                                        <option value="0"  <?php echo set_select('status', '0', @$res->status == '0' && !empty(@$res) ? TRUE : FALSE); ?>>Inactive</option>              
                                
                              </select>
                             
                            </div>
                            <br><br> <br><br>
                        </div>
                
                   
                    <div class="form-group text-center col-xs-12 mt-15">
                        <div class="col-md-12">
                        <!-- <button class="btn btn-success">Submit</button> -->
                            <a href="<?php echo base_url('complaint/list_items_activity/'.ID_encode($res->serviceperson_id)); ?>" class="btn green">Back</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->


    </div>
</div>
<!-- chart 3 -->


<script>
                 $("#edit_form").validate(
            {
                errorElement: 'span', //default input error message container
                errorClass: 'text-danger', // default input error message class
                rules:
                        {
                            service_notes:
                                    {
                                        required: true
                                    },
                           
                                            
                        },
                messages:
                        {
                            service_notes:
                                    {
                                        required: "The Service Notes field is required."
                                    },
                           			 
                           								
                            
                           
                        }
            });

</script>
