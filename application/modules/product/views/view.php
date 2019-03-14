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
                        <label for="inputEmail12" class="col-md-3 control-label">Product Name :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->name); ?></p>                          
                            </div>
                        </div>
                    </div>
					
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Select type :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->pt_name); ?></p>                          
                            </div>
                        </div>
                    </div>
					 <?php if(@$res->product_no) { ?>
					 <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Product No :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->product_no; ?></p>                          
                            </div>
                        </div>
                    </div>
					<?php } ?>
					 <?php if(@$res->price_mrp) { ?>
					 <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Price of Product (INR) :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->price_mrp; ?></p>                          
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
					
						 <?php if(@$res->hp) { ?>
					 <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">HP :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->hp; ?></p>                          
                            </div>
                        </div>
                    </div>
				    <?php } ?>
					 <?php if(@$res->price_mrp) { ?>
					<div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">MRP of the product (INR) :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->price_mrp; ?></p>                          
                            </div>
                        </div>
                    </div>
					 <?php } ?>
					
					 <?php if(@$res->price_ssp) { ?>
					<div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">SSP of the product (INR) :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->price_ssp; ?></p>                          
                            </div>
                        </div>
                    </div>
					 <?php } ?>
				   <?php if(@$res->price_msp) { ?>
					<div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">MSP of the product (INR):</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->price_msp; ?></p>                          
                            </div>
                        </div>
                    </div>
					<?php } ?>
					<?php if(@$res->hsn_sac) { ?>
					<div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">HSN/SAC:</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->hsn_sac; ?></p>                          
                            </div>
                        </div>
                    </div>
					<?php } ?>
					<?php if(@$res->description) { ?>
						<div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Description</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo @$res->description; ?></p>                          
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
                            <a href="<?php echo base_url("product/list_items"); ?>"class="btn green">Back</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->


    </div>
</div>
<!-- chart 3 -->