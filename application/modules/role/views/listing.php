
<!DOCTYPE html >
<html>
    <head>
        <meta http-equiv="Content-Type"/>
    </head>
    <body>
        <?php //include 'header.php';?>
        <div class="clearfix">
        </div>
        <!-- BEGIN CONTAINER -->
        <div class="page-container">

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">

                <!-- BEGIN PAGE HEAD -->
                <div class="page-head">
                    <div class="container">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">

                            <h1> <?php echo $title; ?> </h1>

                        </div>
                        <!-- END PAGE TITLE -->

                    </div>
                </div>

                <div class="page-content">
                    <div class="container">

                        <ul class="page-breadcrumb breadcrumb">
                            <?php if (isset($header['bread_cum'])) { ?>
                                <?php print_r($header['bread_cum']); ?>
                            <?php } ?>
                        </ul>

                        <!-- BEGIN PAGE CONTENT INNER -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs font-blue"></i>
                                            <span class="caption-subject font-blue bold uppercase"> 
                                                List  Role
                                                <a href="<?php echo base_url('role/add'); ?>" class="pull-right btn btn-primary"> <i class="fa fa-plus"></i> Add Role </a>
                                            </span>
                                        </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="" title="">
                                            </a>
                                            <a href="javascript:;" class="reload" data-original-title="" title="">
                                            </a>
                                            <a href="javascript:;" class="remove" data-original-title="" title="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <?php if (!empty($error_msg)) { ?>
                                            <div class="alert alert-danger">
                                                <button class="close" data-dismiss="alert"></button>
                                                <span id="danger_msg"><?php echo $error_msg; ?></span>
                                            </div>
                                        <?php } ?>
                                        <div><?php echo get_flashmsg(); ?></div>
                                        <!-- BEGIN FORM-->
                                        <?php echo form_open('', 'method="post"'); ?>
                                        <div class="search-pannel">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group2 row">
                                                        <label class="control-label col-md-5" style="margin-top:8px;"> Display: </label>
                                                        <div class="col-md-7">
                                                            <select class="form-control" id="perpage" name="perpage">
                                                                <option value="10">10</option>
                                                                <option value="20">20</option>
                                                                <option value="30">30</option>
                                                                <option value="50">50</option>
                                                                <option value="100">100</option>
                                                                <option value="1">All</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-2 text-center" style="padding-top:5px;">
                                                    
                                                    <?php if(has_permission("role", "delete") || currentuserinfo()->emptype == "1" ) {  ?>
                                                        <a href="javascript:;" class="btn btn-sm delete" id="multidelete"> Delete <i class="fa fa-trash-o"></i></a>
                                                    <?php } ?>
                                                        
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm blue dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> Export <i class="fa fa-random"></i></button>
                                                        <ul class="dropdown-menu pull-right">
                                                            <!--<li onclick="window.print();">
                                                                    <a href="javascript:;">
                                                                    Print </a>
                                                            </li>-->
                                                            <!--<li onclick="save_pdf()">
                                                                    <a href="javascript:;">
                                                                    Save as PDF </a>
                                                            </li>-->
                                                            <li onclick="export_excel()">
                                                                <a href="javascript:;">
                                                                    Export to Excel </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>  
                                                <div class="col-md-2" style="padding-top:5px;">

                                                </div>
                                                <div class="col-md-2">

                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group ">
                                                        <input type="text" class="form-control" placeholder="Search" name="search" id="search">
                                                        <span class="input-group-addon" id="gridsearch">
                                                            <i class="fa fa-search"></i>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <?php if ($this->session->flashdata('success')) { ?>
                                            <div class="alert alert-success">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                                            </div>
                                        <?php } ?>
                                        <?php if ($this->session->flashdata('error')) { ?>
                                            <div class="alert alert-danger">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                                            </div>
                                        <?php } ?>

                                        <div class="table-scrollable" id="gridlisting">

                                        </div>

                                        <?php echo form_close(); ?>
                                        <!-- END FORM-->
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- END PAGE CONTENT INNER -->


                    </div>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

        <?php //include 'footer.php';?>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">VIEW STAFF</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-striped table-hover">
                                <tbody><tr>
                                        <td><strong>First Name : </strong></td>
                                        <td> Test </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Last Name : </strong></td>
                                        <td> Test </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email Id : </strong></td>
                                        <td> Test@email.com </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Address : </strong></td>
                                        <td> New Delhi</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Landmark : </strong></td>
                                        <td> Near Bridge </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Zipcode: </strong></td>
                                        <td>910002</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Mobile Number : </strong></td>
                                        <td>+91-1234567890</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Alternate Mobile Number : </strong></td>
                                        <td>+91-1234567890</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Customer Type : </strong></td>
                                        <td> Retailer </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Lead Source: </strong></td>
                                        <td> Test </td>
                                    </tr>

                                </tbody></table>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </body>
</html>
<script type="text/javascript" src="<?= base_url() ?>assets/custom/js/role.js"></script>
<script>
    $(document).ready(function() {
        gridloader('<?php echo $pageno; ?>');
        //==========Page click==========//
        $('#gridlisting').on('click','li.active',function(){
            var page = $(this).attr('p');
            gridloader(page);
        });
        //==========Close Page click==========//
        //==========Change Per Page==========//
        $('#perpage').change(function () {

            gridloader(1);
        });
        //==========Close Change Per Page==========//
        //==========On Search Load Grid============//
        $('#gridsearch').click(function(){
            gridloader(1);
        }) 
        //=========Close On Search Load Grid======//
    
    });
    function gridloader(page)
    {
        var perpage = $("#perpage").val();
        //var perpage = 2;
        var search = $("#search").val();
        var token_value=$( "input[name='"+token_name+"']" ).val();            
        $.ajax
        ({
        
            type: "POST",
            url: '<?php echo base_url(); ?>role/ajax_list_items',
            data: token_name+"="+token_value+"&page="+page+"&perpage="+perpage+"&search="+search,
            beforeSend: function(){
                $("#gridlisting").html("<img src='<?php echo base_url(); ?>assets/custom/loader_images/circleloading.GIF' style='margin-left: 35%;' border='0'/>");  
            },
            success: function(response)
            { 
                $("#gridlisting").html(response);
            }
        }); 
    }
</script>