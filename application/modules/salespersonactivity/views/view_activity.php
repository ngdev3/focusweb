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
                                <p><?php if($res->location){echo ucwords($res->location);}else{echo ucwords($res->address);} ?></p>                          
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
                        <label for="inputEmail12" class="col-md-3 control-label">Sales Person :</label>
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

                    <form method="post" action="#">

                                        <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Meeting Notes :<span1>*</span1></label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                            <textarea rows="3" cols="105" class="textarea-group" placeholder="Meeting Notes"  name="meeting_notes" value=><?php  echo set_value("meeting_notes", @$res->notes);?></textarea>     
                            <div class="text-danger" class="input-error col-md-12"><?php echo form_error("meeting_notes"); ?></div>                    
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Comments :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                            <textarea rows="3" cols="105" class="textarea-group" placeholder="Comments"  name="comments" value=><?php  echo set_value("comments", @$res->comments);?></textarea>
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

                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Status: </label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                            <select class="col-md-3" name="status" disabled class="form-control form-control-line">
                                        
                                        <option value="1"  <?php echo set_select('status', '1', @$res->status == '1' && !empty(@$res) ? TRUE : FALSE); ?>>Active</option>
                                        <option value="0"  <?php echo set_select('status', '0', @$res->status == '0' && !empty(@$res) ? TRUE : FALSE); ?>>Inactive</option>              
                                
                              </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Reason :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                            <input type="text" placeholder="Reason" readonly  name="reason" value='<?php  echo set_value("reason", @$res->lost_reason);?>'>
                              </div>
                        </div>
                    </div>

                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Comment :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                            <textarea rows="3" cols="105" readonly class="textarea-group" placeholder="Comment"  name="loss_comments" value=><?php  echo set_value("loss_comments", @$res->lost_comment);?></textarea>
                              </div>
                        </div>
                    </div>

                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Lost to :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                            <input type="text" placeholder="Lost to" readonly name="lost_to" value='<?php  echo set_value("lost_to", @$res->lost_to);?>'>
                              </div>
                        </div>
                    </div>

                   
                    <div class="form-group text-center col-xs-12 mt-15">
                        <div class="col-md-12">
                        <!-- <button class="btn btn-success">Submit</button> -->
                            <a href="<?php echo base_url('salespersonactivity/list_items_activity/'.ID_encode($res->sales_person_id)); ?>" class="btn green">Back</a>
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
                            meeting_notes:
                                    {
                                        required: true
                                    },
                           
                                            
                        },
                messages:
                        {
                            meeting_notes:
                                    {
                                        required: "The Meeting Notes field is required."
                                    },
                           			 
                           								
                            
                           
                        }
            });

</script>
