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
                 <!--    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Type of Service :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->name); ?></p>                          
                            </div>
                        </div>
                    </div> -->

                      <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Activity :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->activity); ?></p>                          
                            </div>
                        </div>
                    </div>
                   
                     <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Date of Activity :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                       <?php      $date_activity = date("d-m-Y", strtotime($res->date_activity)); ?>
                                <p><?php echo $date_activity; ?></p>                          
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
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Date of Activity Marked:</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                       <?php     $date_marked = date("d-m-Y", strtotime($res->created_date)); ?>
                                <p><?php echo $date_marked; ?></p>                          
                            </div>
                        </div>
                    </div>
                    <?php if($res->outcome_status=="3" || $res->outcome_status=="4"){ ?>
                        <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Reason Title:</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo $res->reason_title; ?></p>                          
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Reason Description:</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                            <p><?php echo $res->reason_description; ?></p>                             
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Continue/Reschedule Date:</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                       <?php     $date_continue = date("d-m-Y", strtotime($res->meeting_date)); ?>
                                <p><?php echo $date_continue; ?></p>                          
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                                       

                   

                      

                   

                  

                   
                    <div class="form-group text-center col-xs-12 mt-15">
                        <div class="col-md-12">
                     
                            <a href="<?php echo base_url('salespersonactivity/list_items_app_disapp/'.ID_encode($res->sales_person_id)); ?>" class="btn green">Back</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->


    </div>
</div>
<!-- chart 3 -->

