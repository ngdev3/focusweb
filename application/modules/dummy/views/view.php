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
                        <label for="inputEmail12" class="col-md-3 control-label">Lead Id :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->dymic_lead_id); ?></p>                          
                            </div>
                        </div>
                    </div>
					
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Type Of Lead :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->ptype_name); ?></p>                          
                            </div>
                        </div>
                    </div>
					 <?php if(@$res->client_name) { ?>
					 <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Part N0 :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords(@$res->client_name); ?></p>                          
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
					 <?php if(@$res->location) { ?>
					 <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Location :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->location; ?></p>                          
                            </div>
                        </div>
                    </div>
					 <?php } ?>
					
						 <?php if(@$res->address) { ?>
					 <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Address :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->address; ?></p>                          
                            </div>
                        </div>
                    </div>
				    <?php } ?>
					 <?php if(@$res->contact_person) { ?>
					<div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Contant Person :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->contact_person; ?></p>                          
                            </div>
                        </div>
                    </div>
					 <?php } ?>
					
					 <?php if(@$res->contact_number	) { ?>
					<div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Contant Number:</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->contact_number	; ?></p>                          
                            </div>
                        </div>
                    </div>
					 <?php } ?>
				   <?php if(@$res->	email_id) { ?>
					<div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Email Id:</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->email_id; ?></p>                          
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
                                        echo "Active";
                                    } else {
                                        echo "Inactive";
                                    }
                                    ?></p>                          
                            </div>
                        </div>
                    </div>



                    <div class="form-group text-center col-xs-12 mt-15">
                        <div class="col-md-12">
                            <a href="<?php echo base_url("leadmanagement/list_items"); ?>"class="btn green">Back</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->


    </div>
</div>
<!-- chart 3 -->