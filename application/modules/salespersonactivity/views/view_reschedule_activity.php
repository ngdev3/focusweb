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
                    
                    
                    
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Branch Manager :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->m_fname); ?> <?php echo ucwords($res->m_lname); ?></p>                          
                            </div>
                        </div>
                    </div>
                    
                    
                     <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Coordinator :</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->c_fname); ?> <?php echo ucwords($res->c_lname); ?></p>                          
                            </div>
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
                       <?php     $newDate = date("d-m-Y", strtotime($res->meeting_date)); ?>
                                <p><?php echo $newDate; ?></p>                          
                            </div>
                        </div>
                    </div>
                   
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label">Date & Time of Activity Requested:</label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                       <?php     $newDate = date("d-m-Y g:i a"); ?>
                                <p><?php echo $newDate; ?></p>                          
                            </div>
                        </div>
                    </div>

                                       

                   

                      

                   

                  

                   
                    <div class="form-group text-center col-xs-12 mt-15">
                        <div class="col-md-12">
                     
                            <a href="<?php echo base_url('salespersonactivity/list_items_reschedule_activity/'.ID_encode($res->sales_person_id)); ?>" class="btn green">Back</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->


    </div>
</div>
<!-- chart 3 -->

