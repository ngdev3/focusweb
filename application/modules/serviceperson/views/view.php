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
                        <label for="inputEmail12" class="col-md-3 control-label">Employee Id :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->employee_id); ?></p>                          
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">First Name :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->fname); ?></p>                          
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Last Name :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->lname); ?></p>                          
                            </div>
                        </div>
                    </div>
                    
                    
                    
                     <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Email Id :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->email); ?></p>                          
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Contact No :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords("+91 ".$res->mobile); ?></p>                          
                            </div>
                        </div>
                    </div>
                    
                     <div class="form-group col-md-12 col-sm-12">
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
                    
                    <?php if(getUserInfos()->role == "0"){ ?>
                    
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Manager:</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->manager_fname); ?> <?php echo ucwords($res->manager_lname); ?></p>                          
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if(getUserInfos()->role == "0" || getUserInfos()->role == "1"){ ?>
                     <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Coordinator:</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->co_fname); ?> <?php echo ucwords($res->co_lname); ?></p>                          
                            </div>
                        </div>
                    </div>
                    
                    <?php } ?>
                     <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Address :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->address); ?></p>                          
                            </div>
                        </div>
                    </div>
                    
                    
                     <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Profile Picture :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><img alt="" class="img-circle" src="<?php echo $res->profile_image?base_url().'uploads/profile_image/'.@$res->profile_image:base_url().'uploads/profile_image/default.png';?>" height="80"></p>                          
                            </div>
                        </div>
                    </div>
                    
                    
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
                            <a href="<?php echo base_url("serviceperson/list_items"); ?>"class="btn green">Back</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->


    </div>
</div>
<!-- chart 3 -->