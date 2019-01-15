<div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav in" id="side-menu">
                    <li class="active" style="padding: 70px 0 10px 0px;">
                        <a href="<?php echo base_url("dashboard"); ?>" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a>
                    </li>
                    <li>
                        <a href="#" class="waves-effect"><i class="fa fa-user fa-fw" aria-hidden="true"></i><span class="hide-menu">Masters<span class="fa arrow"></span></span></a>
						<ul class="nav nav-second-level collapse" aria-expanded="false">
                           
                                                    
                           <li> <a href="<?php echo base_url("masters/subject/list_items"); ?>"><i class="fa-fw sub-head">></i><span class="hide-menu">Subject</span></a> </li>
                            
                            
                            
                            <li><a href="<?php echo base_url("masters/sections/list_items"); ?>"><i class="fa-fw sub-head">></i><span class="hide-menu">Sections</span></a></li>
                            
                            <?php if (has_permission("schoolclass", 'list_items') || getUserInfos()->id == "1") { ?>
                            <li><a href="<?php echo base_url("masters/schoolclass/list_items"); ?>"><i class="fa-fw sub-head">></i><span class="hide-menu">Class</span></a></li>
                            <?php }?>
                            
                            <li><a href="javascript:void(0);"><i class="fa-fw sub-head">></i><span class="hide-menu">Chapters</span></a></li>
                            <li><a href="javascript:void(0);"><i class="fa-fw sub-head">></i><span class="hide-menu">Topics</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="waves-effect"><i class="fa fa-users fa-fw" aria-hidden="true"></i><span class="hide-menu">Question Sets</span></a>
                    </li>
                    <li>
                        <a href="#" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i><span class="hide-menu">Assessment</span></a>
                    </li>
                    <li>
                        <a href="#" class="waves-effect"><i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i><span class="hide-menu">Video & Quizzes</span></a>
                    </li>
                    <li>
                        <a href="#" class="waves-effect"><i class="fa fa-users fa-fw" aria-hidden="true"></i><span class="hide-menu">Manage Users<span class="fa arrow"></span></span></a>
						<ul class="nav nav-second-level collapse" aria-expanded="false">
                            <li> <a href="javascript:void(0);"><i class="fa-fw sub-head">></i><span class="hide-menu">Students</span></a></li>
                            <li> <a href="javascript:void(0);"><i class="fa-fw sub-head">></i><span class="hide-menu">Teachers</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="waves-effect"><i class="fa fa-certificate fa-fw" aria-hidden="true"></i><span class="hide-menu">Manage Badges/Certifications<span class="fa arrow"></span></span></a>
						<ul class="nav nav-second-level collapse" aria-expanded="false">
                            <li> <a href="javascript:void(0);"><i class="fa-fw sub-head">></i><span class="hide-menu">Generate Certificate</span></a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="#" class="waves-effect"><i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i><span class="hide-menu">Student Reports</span></a>
                    </li>
                    <li class="">
                        <a href="#" class="waves-effect"><i class="fa fa-bell fa-fw" aria-hidden="true"></i><span class="hide-menu">Notification Management</span></a>
                    </li>
                    <li class="">
                        <a href="#" class="waves-effect"><i class="fa fa-bar-chart fa-fw" aria-hidden="true"></i><span class="hide-menu">Manage CMS</span></a>
                    </li>
					
                </ul>
            </div>
            
        </div>
       