<?php $sub_name = get_subjects(); 


$uri_string = uri_string();
$matchsyllabus = preg_match("/syllabus\/view/", $uri_string);
$matchlistchapter = preg_match("/syllabus\/student_chapter_name/", $uri_string);
$matchlisttopic = preg_match("/syllabus\/student_topic_name/", $uri_string);

$chap_id=ID_decode($this->uri->segment(3));


?>

<div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav in" id="side-menu">
                    <li class="active" style="padding: 70px 0 10px 0px;">
                        <a href="<?php echo base_url("dashboard"); ?>" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i><span class="hide-menu">Dashboard Student</span></a>
                    </li>
                    
                    
                    
                    <li <?php if ($matchsyllabus>0) {echo 'class="active"'; } ?>>
                        <a href="<?php echo base_url("syllabus/view"); ?>" class="waves-effect"><i class="fa fa fa-book fa-fw" aria-hidden="true"></i><span class="hide-menu">My Syllabus</span></a>
                    </li>
                    <!-- Subjects --> 
                    <!--<li <?php if ($matchlistchapter > 0 || $matchlisttopic > 0) {echo 'class="active"'; } ?>>
                        <a href="#" class="waves-effect"><i class="fa fa-subscript fa-fw" aria-hidden="true"></i><span class="hide-menu">Subjects<span class="fa arrow"></span></span></a>
						<ul class="nav nav-second-level collapse" aria-expanded="false">
                        <?php foreach($sub_name as $name) { ?>-->
                        <!--- here $name->id is chapter id and $name->subject_id is subject id -->
                            <!---<li <?php if (($matchlistchapter > 0 || $matchlisttopic > 0) && $chap_id==$name->id) {echo 'style="font-weight: bold;"'; } ?>> <a href="<?php echo base_url("syllabus/student_chapter_name/").ID_encode($name->id)."/".ID_encode($name->subject_id); ?>"><i class="fa fa-sticky-note"></i><span class="hide-menu"><?php echo $name->subject_name; ?></span></a></li>
                         <?php  } ?> 
                   
                        </ul>
                    </li>-->
                    <li <?php if ($matchlistchapter > 0 || $matchlisttopic > 0) {echo 'class="active"'; } ?>>
                        <a href="#" class="waves-effect"><span class="hide-menu">Subjects<span class="fa arrow"></span></span></a>
						<ul class="nav nav-second-level collapse" aria-expanded="false">
                        <?php foreach($sub_name as $name) { ?>
                        <!--- here $name->id is chapter id and $name->subject_id is subject id -->
                            <!--<li <?php //if (($matchlistchapter > 0 || $matchlisttopic > 0) && $chap_id==$name->id) {echo 'style="font-weight: bold;"'; } ?>> <a href="<?php echo base_url("syllabus/student_chapter_name/").ID_encode($name->id)."/".ID_encode($name->subject_id); ?>"><i class="fa fa-sticky-note"></i><span class="hide-menu"><?php echo $name->subject_name; ?></span></a></li>-->
                         <?php  } ?> 
						 
						 <li><a href="#"><img src="<?php echo base_url();?>/assets/srs_admin/img/drop-icon-math.png">&nbsp;&nbsp;Mathematices</a></li>
						 <li><a href="#"><img src="<?php echo base_url();?>/assets/srs_admin/img/drop-icon-evs.png">&nbsp;&nbsp;EVS</a></li>
						 <li><a href="#"><img src="<?php echo base_url();?>/assets/srs_admin/img/drop-icon-chemistry.png">&nbsp;&nbsp;Chemistry</a></li>
						 <li><a href="#"><img src="<?php echo base_url();?>/assets/srs_admin/img/drop-icon-english.png">&nbsp;&nbsp;English</a></li>
                   
                        </ul>
                    </li>

                    <!-- ! Subjects -->
                     <!--  Test -->
                       <li>
                        <a href="#" class="waves-effect"><span class="hide-menu">Tests<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level collapse" aria-expanded="false">
                            <li> <a href="javascript:void(0);"><img src="<?php echo base_url();?>/assets/srs_admin/img/test-all.png">&nbsp;&nbsp;<span class="hide-menu">All Tests</span></a></li>
                            <li> <a href="javascript:void(0);"><img src="<?php echo base_url();?>/assets/srs_admin/img/test-all.png">&nbsp;&nbsp;<span class="hide-menu">Upcoming Tests</span></a></li>
                        </ul>
                    </li>
                     <!-- ! Tests -->   

                    <li class="">
                        <a href="<?php echo base_url("notifications_app/list_items");s ?>" class="waves-effect"><span class="hide-menu">Notifications</span></a>
                    </li>
					<li class="">
                        <a href="<?php echo base_url("notifications_app/list_items");s ?>" class="waves-effect"><span class="hide-menu">Manage CMS</span></a>
                    </li>
					<li class="">
                        <a href="<?php echo base_url("notifications_app/list_items");s ?>" class="waves-effect"><span class="hide-menu">Leader Board</span></a>
                    </li>
					<li class="">
                        <a href="<?php echo base_url("notifications_app/list_items");s ?>" class="waves-effect"><span class="hide-menu">Badges and Certificate</span></a>
                    </li>
                   
                   <!-- <li class="">
                        <a href="<?php echo base_url("pages/list_items"); ?>" class="waves-effect"><i class="fa fa-cog fa-fw" aria-hidden="true"></i><span class="hide-menu">Manage CMS</span></a>
                    </li>-->
                     <!-- <?php if (has_permission("pages", 'list_items') || getUserInfos()->id == "1") { ?>
                    <li class="">
                        <a href="<?php echo base_url("pages/list_items"); ?>" class="waves-effect"><i class="fa fa-bar-chart fa-fw" aria-hidden="true"></i><span class="hide-menu">Manage CMS</span></a>
                    </li>
                     <?php }?> -->
                     
                </ul>
            </div>
            
        </div>
       