<div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav in" id="side-menu">
                    <li class="active" style="padding: 70px 0 10px 0px;">
                        <a href="<?php echo base_url("dashboard"); ?>" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i><span class="hide-menu">Dashboard Teacher</span></a>
                    </li>
                    
                   

                    <li>
                        <a href="#" class="waves-effect"><i class="fa fa-graduation-cap fa-fw" aria-hidden="true"></i><span class="hide-menu">Manage Students<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level collapse" aria-expanded="false">
                            <li> <a href="javascript:void(0);"><i class="fa fa-building-o fa-fw sub-head"></i><span class="hide-menu">Class 5<sup>th</sup></span></a></li>
                            <li> <a href="javascript:void(0);"><i class="fa fa-building-o fa-fw sub-head"></i><span class="hide-menu">Class 6<sup>th</sup></span></a></li>
                            <li> <a href="javascript:void(0);"><i class="fa fa-building-o fa-fw sub-head"></i><span class="hide-menu">Class 7<sup>th</sup></span></a></li>
                        </ul>
                    </li>
                     <?php if (has_permission("questions", 'list_items') || getUserInfos()->id == "1") { ?>

                    <li>
                        <a href="<?php echo base_url("questions/list_items"); ?>" class="waves-effect"><i class="fa fa-paperclip fa-fw" aria-hidden="true"></i><span class="hide-menu">Question Sets</span></a>
                    </li>
                     <?php }?>
                  <!--  <li>
                        <a href="#" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i><span class="hide-menu">Assessment</span></a>
                    </li>-->
                     <?php if (has_permission("quizzes", 'list_items') || getUserInfos()->id == "1") { ?>
                    <li>
                        <a href="<?php echo base_url("quizzes/list_items"); ?>" class="waves-effect"><i class="fa fa-file-video-o fa-fw" aria-hidden="true"></i><span class="hide-menu">Quizzes</span></a>
                    </li>
                     <?php }?>
                    
                    <li class="">
                        <a href="#" class="waves-effect"><i class="fa fa-bar-chart fa-fw" aria-hidden="true"></i><span class="hide-menu">Student Reports</span></a>
                    </li>

                   <!-- <li class="">
                        <a href="<?php echo base_url("pages/list_items"); ?>" class="waves-effect"><i class="fa fa-cogs fa-fw" aria-hidden="true"></i><span class="hide-menu">Manage CMS</span></a>
                    </li>-->
                    
                </ul>
            </div>
            
        </div>
       