
<?php //pr($breadcrumb);die; ?>



<!DOCTYPE html >
<html>
    <head>
        <title><?php echo "Home :: ".@$title; ?></title>
        <meta http-equiv="Content-Type"/>
    </head>
    <body>
        <?php echo $this->load->view('templates/header.php'); ?>
        <!--For Super Admin-->
        <?php  $res = $this->session->userdata('userinfo');?>
       
        <?php echo $this->load->view('templates/left_menu.php'); ?>
       
     
  
		 
		
		   <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN THEME PANEL -->
                        
                        <!-- BEGIN PAGE BAR -->
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                
                                     <?php 
                        $numItems = count($breadcrumb);
                        
                         $i=1;
                        foreach($breadcrumb as $key => $value){
                          ?>
                            <li  class="<?php if($i == $numItems) {echo 'active';}?>"><a href="<?php echo $value; ?>"><?php echo $key; ?></a> <?php if($i !== $numItems) { ?><i class="fa fa-circle"></i><?php } ?></li>
                              

                            <?php $i++; } ?>
                                
                                
                                
                                
                             
                            </ul>
                           <!-- <div class="page-toolbar">
                                <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                                    <i class="icon-calendar"></i>&nbsp;
                                    <span class="thin uppercase hidden-xs"></span>&nbsp;
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>-->
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> 
                            <!--<small>statistics, charts, recent events and reports</small>-->
                        </h1>
		  <?php $this->load->view("templates/_alert");?>
        <?php echo $this->load->view($page); ?>  
		 </div>
		  </div>
		   </div>
        <?php echo $this->load->view('templates/footer.php'); ?>
        </div>