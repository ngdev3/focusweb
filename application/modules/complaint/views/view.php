<style>
    .input-icon p{margin: 0px;}
    .input-icon{padding: 8px 0 0 0}
    .mt-15{margin-top: 15px;}
    .form-horizontal .control-label{text-align:left!important;font-weight:600;}
</style>



<h1 class="page-title" style="font-weight: 500"> <?php echo $page_title; ?> 
<!-- <small>Lorem Ipsum is dummy text of the printing industry.</small> -->
</h1>
<div class="row">

    <div class="portlet light bordered">
        <div class="portlet-title">

       
            <div class="portlet-body form add_prodcut_form">

                <form class="form-horizontal" role="form">
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Complaint ID :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->dynamic_complaint_id); ?></p>                          
                            </div>
                        </div>
                    </div>
					
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Complaint Type:</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->complaint_types); ?></p>                          
                            </div>
                        </div>
                    </div>
					 <?php if(@$res->client_name) { ?>
					 <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Client Name :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords(@$res->client_name); ?></p>                          
                            </div>
                        </div>
                    </div>
					<?php } ?>
                    <?php if(@$res->contact_person) { ?>
					<div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Contact Person :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->contact_person; ?></p>                          
                            </div>
                        </div>
                    </div>
					 <?php } ?>
					
					 <?php if(@$res->contact_number	) { ?>
					<div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Contact Number:</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->contact_number	; ?></p>                          
                            </div>
                        </div>
                    </div>
					 <?php } ?>
                     <?php if(@$res->priority) { ?>
					<div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Priority:</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
							
							<?php if($res->priority=='1')
			{
			$priority='Low';	
			}
			if($res->priority=='2')
			{
			$priority='Medium';	
			}
			if($res->priority=='3')
			{
			$priority='High';	
			}   ?>
                                <p><?php echo @$priority; ?></p>                          
                            </div>
                        </div>
                    </div>
					<?php } ?>
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
                   
                    <?php if(@$res->performance) { ?>
					<div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Performance:</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
							
							<?php if($res->performance=='1')
			{
			$performance='Good';	
			}
			if($res->performance=='2')
			{
			$performance='Satisfactory';	
			}
			   ?>
                                <p><?php echo @$performance; ?></p>                          
                            </div>
                        </div>
                    </div>
					<?php } ?>
                    <?php if(@$res->efforts) { ?>
					<div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Efforts:</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
							
							<?php if($res->efforts=='1')
			{
			$efforts='Good';	
			}
			if($res->efforts=='2')
			{
			$efforts='To Be Improved';	
			}
			  ?>
                                <p><?php echo @$efforts; ?></p>                          
                            </div>
                        </div>
                    </div>
					<?php } ?>
					 <?php if(@$res->website) { ?>
					 <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Website :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->website; ?></p>                          
                            </div>
                        </div>
                    </div>
					 <?php } ?>
                     <?php if(@$res->branch_manager) { ?>
					 <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Branch Manager :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->branch_manager; ?></p>                          
                            </div>
                        </div>
                    </div>
					 <?php } ?>
                     <?php if(@$res->coordinator) { ?>
					 <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Coordinator :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->coordinator; ?></p>                          
                            </div>
                        </div>
                    </div>
					 <?php } ?>
                     <?php if(@$res->serviceperson) { ?>
					 <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Assigned Service Person :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->serviceperson; ?></p>                          
                            </div>
                        </div>
                    </div>
					 <?php } ?>
					 <?php if(@$res->location || @$res->address) { ?>
					 <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Location :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php if(@$res->location){ echo @$res->location;}else{ echo @$res->address;} ?></p>                          
                            </div>
                        </div>
                    </div>
					 <?php } ?>
					
				   <?php if(@$res->email_id) { ?>
					<div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Email Id:</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->email_id; ?></p>                          
                            </div>
                        </div>
                    </div>
					<?php } ?>
					
					<?php if(@$res->notes) { ?>
						<div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Notes:</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->notes; ?></p>                          
                            </div>
                        </div>
                    </div>
					<?php } ?>
					
					
					
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Status :</label>
                        <div class="col-md-9">
                            <div class="input-icon">
                                <p><?php
                                    if ($res->status == 'active') {
                                        echo "Completed";
                                    } else {
                                        echo "In Process";
                                    }
                                    ?></p>                          
                            </div>
                        </div>
                    </div>



                    <div class="form-group text-center col-xs-12 mt-15">
                        <div class="col-md-12">
                            <a href="<?php echo base_url("complaint/list_items"); ?>"class="btn green">Back</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->


    </div>
</div>
<!-- chart 3 -->