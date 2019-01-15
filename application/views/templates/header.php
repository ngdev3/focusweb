<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Pioneer | Admin Dashboard</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?= base_url(); ?>assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?= base_url(); ?>assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?= base_url(); ?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?= base_url(); ?>assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link href="<?= base_url(); ?>assets/layouts/layout/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

        <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" media="screen">      <!-- END THEME LAYOUT SCRIPTS -->
        <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">        
        <link rel="shortcut icon" href="favicon.ico" />
        <!-- ********** GOOGLE CHARTS ***********  -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


        <!-- ********** ! GOOGLE CHARTS ***********  -->
        <style>
            .btn-group{margin-left: 10px !important;}
            /*Added for datable starts*/


            div.dataTables_filter input[type="search"],div.dataTables_length select{font-size: 14px;
                                                                                    font-weight: normal;
                                                                                    color: #333;
                                                                                    background-color: #fff;
                                                                                    border: 1px solid #e5e5e5;
                                                                                    box-shadow: none;
                                                                                    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                                                                                    -webkit-border-radius: 4px;
                                                                                    -moz-border-radius: 4px;
                                                                                    -ms-border-radius: 4px;
                                                                                    -o-border-radius: 4px;
                                                                                    border-radius: 4px;
                                                                                    height: 34px;
                                                                                    padding: 6px 12px;
                                                                                    font-size: 14px;
                                                                                    line-height: 1.42857143;
            }

            .table-hover>tbody>tr:hover { background-color: #0f39e021 !important;}
            .table-striped>tbody>tr:nth-of-type(odd) {background-color:#fff !important;}
            .sample_country tr th { background-color: #fff; color: #6b6b6b; }
            .input-small,.input-medium {  margin: 0 auto;}
            .sample_country tr { background-color: #fff; color: #6b6b6b; }

            .dataTables_filter label{
                float: right;
                width: auto;
                display: inline-flex;
            }
            .dataTables_filter,.dataTables_paginate{text-align:right; margin-bottom: 10px; overflow: hidden;}
            .dataTables_filter label{
                float: right;
                width: auto;
                display: flex;
                align-items: center;
            }
            .dataTables_filter label input{
                margin-left: 5px;
            }

            .dataTables_length label{
                float: left;
                width: auto;
                display: flex;
                align-items: center;
            }
            .dataTables_length label select{
                margin-right: 5px;
            }
            .portlet-title .actions{text-align: right; margin-bottom: 10px;}
            .dataTables .table>thead>tr>th {
                padding: 10px 8px;
            }
            .dataTables_processing {
                position: fixed;
                top: 40%;
                left: 50%;
                min-width: 125px;
                margin-left: 0;
                padding: 7px;
                text-align: center;
                color: #333;
                font-size: 13px;
                border: 1px solid #ddd;
                background-color: #eee;
                vertical-align: middle;
                -webkit-box-shadow: 0 1px 8px rgba(0, 0, 0, 0.1);
                -moz-box-shadow: 0 1px 8px rgba(0, 0, 0, 0.1);
                box-shadow: 0 1px 8px rgba(0, 0, 0, 0.1);
            }
            .mainpage-title{
                display: inline-block;
                margin-left: 5px;
                font-weight: 500;
                font-size: 16px;
                text-transform: uppercase;
                color: #337eb9;
            }


            div.dataTables_filter input[type="search"]{
                border-radius: 25px!important;
            }
            /*Added for datatable ends*/

        </style>
        <!-- Core files -->





        <script src="<?= base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script> 
        <!--Ajax jquery validation Files-->
        <script src="<?= base_url(); ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script> 
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"
        type="text/javascript"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/additional-methods.min.js"
        type="text/javascript"></script>
        <!--Ajax Jquery Validation Files-->


    </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="<?php echo base_url(); ?>">
                            <img src="<?= base_url(); ?>assets/images/logo.png" alt="logo" class="logo-default" /> </a>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
                            <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                            <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-bell"></i>
                                    <span class="badge badge-default"> 7 </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>
                                            <span class="bold">12 pending</span> notifications</h3>
                                        <a href="javascript:;">view all</a>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">just now</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-success">
                                                            <i class="fa fa-plus"></i>
                                                        </span> New user registered. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">3 mins</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Server #12 overloaded. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">10 mins</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> Server #2 not responding. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">14 hrs</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </span> Application error. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">2 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Database overloaded 68%. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">3 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> A user IP blocked. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">4 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> Storage Server #4 not responding dfdfdfd. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">5 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </span> System Error. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">9 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Storage server failed. </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- END NOTIFICATION DROPDOWN -->

                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="<?= base_url(); ?>uploads/profile_image/<?= ($userRes->profile_image != "") ? $userRes->profile_image : 'default.png'; ?>" />
                                    <span class="username username-hide-on-mobile"> <?php echo ucwords($userRes->fullname); ?> </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a style="color:darkgreen;" href="<?php echo base_url('users/profile'); ?>">
                                            <i style="color:darkgreen;" class="icon-user"></i> My Profile </a>
                                    </li>

                                    <li>
                                        <a style="color:darkblue;" href="<?php echo base_url('users/changepassword'); ?>">
                                            <i style="color:darkblue;" class="icon-key"></i> Change Password </a>
                                    </li>
                                    <!--<li>
                                        <a href="app_calendar.html">
                                            <i class="icon-calendar"></i> My Calendar </a>
                                    </li>
                                    <li>
                                        <a href="app_inbox.html">
                                            <i class="icon-envelope-open"></i> My Inbox
                                            <span class="badge badge-danger"> 3 </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="app_todo.html">
                                            <i class="icon-rocket"></i> My Tasks
                                            <span class="badge badge-success"> 7 </span>
                                        </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="page_user_lock_1.html">
                                            <i class="icon-lock"></i> Lock Screen </a>
                                    </li>-->
                                    <li>
                                        <a style="color:red;"  href="<?php echo base_url() ?>auth/logout">
                                            <i style="color:red;" class="fa fa-power-off"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <!--<li class="dropdown dropdown-quick-sidebar-toggler">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <i class="icon-logout"></i>
                                </a>
                            </li>-->
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
