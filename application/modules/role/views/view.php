
<!DOCTYPE html >
<html>
    <head>
        <meta http-equiv="Content-Type"/>
    </head>
    <body>

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
                                            <span class="caption-subject font-blue bold uppercase"> View Role </span>
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
                                    <div class="portlet-body form row">
                                        <!-- BEGIN FORM-->
                                        <div class="col-md-12">
                                            <div class="table-scrollable no_border margin_top_bottom">
                                                <table class="table" >
                                                    <tr>
                                                        <td width="11%"><strong>Role Name  </strong></td>
                                                        <td width="5%" align="center"> <strong>:</strong></td>
                                                        <td> <?php echo @$customer['role_name']; ?> </td>
                                                    </tr>

                                                    <tr>
                                                        <td><strong>Status </strong></td>
                                                        <td align="center"> <strong>:</strong></td>
                                                        <td> <?php if (@$customer['status'] == 1) {
                                echo 'Active';
                            } else {
                                echo 'Inactive';
                            } ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Created Date</strong></td>
                                                        <td align="center"> <strong>:</strong></td>
                                                        <td> <?php echo $customer['created_date']; ?> </td>
                                                    </tr>
                                                </table>
                                            </div>

                                            <hr />
                                            <div class="col-md-12 text-center">
                                                <a href="<?php echo base_url(); ?>role/list_items"><button type="button" class="btn gray "> <i class="fa fa-arrow-circle-o-left"></i> Back  </button></a>
                                            </div>
                                        </div>	
                                        <!-- END FORM-->
                                        <div class="clearfix"></div>
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




    </body>
</html>