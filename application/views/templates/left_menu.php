<?php
$controllers_name=$this->router->fetch_class();
$method_name=$this->router->fetch_method();
// pr($controllers_name); die;


$uri1 = @uri_segment(1);
$uri2 = @uri_segment(2);
$uri3 = @uri_segment(3);



?>
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                   <div class="page-sidebar navbar-collapse collapse">
                           <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                     <p  class="text text-warning text-responsive text-center">
                    
                          <?php
                           if(getUserInfos()->user_type == "1")
                           {
                               echo "Super Admin";
                           }
                         
                           ?>
                           </p> 


                            
<!-----------------------------------------------Super Admin Start------------------------------------------------------------>                
                                            
 
                            <?php if ( getUserInfos()->user_type == "1") { ?>
                              
                            <li class="nav-item start <?php if($controllers_name=="dashboard"){echo "active open";} ?>">
                                <a href="<?php echo base_url("dashboard"); ?>" class="nav-link nav-toggle">
                                    <i class="icon-home"></i>
                                    <span class="title">Dashboard</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            <li class="nav-item  <?php if($uri1=="admin" &&  $uri2=="users") {echo "active open";} ?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-puzzle"></i>
                                    <span class="title">User Management</span>
                                    <span class="arrow <?php if($uri2=="users" && $uri3 =="listing"){echo "open";} ?>"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  <?php if($uri2=="users" && $uri3=="listing"){echo "active text text-danger";} ?>">
                                        <a href="<?php echo base_url("admin/users/listing"); ?>" class="nav-link ">
                                            <span class="title ">End User</span>
                                        </a>
                                    </li>
                                   
                                </ul>
                            </li>
                            <li class="nav-item  <?php if($uri1 == "admin"  && $uri2 == "colors"){ echo "active";} ?>">
                            <a href="<?php echo base_url("admin/colors/listing"); ?>" class="nav-link ">
                            <i class="icon-puzzle"></i>
                                <span class="title">Manage Color Scheme</span>
                            </a>
                           </li>
                           
                            <li class="nav-item  <?php if($uri1=="admin" && ($uri2 =="morning" || $uri2 =="coaches" || $uri2 =="masterclass")) {echo "active open";} ?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-puzzle"></i>
                                    <span class="title">Masters Membership</span>
                                    <span class="arrow <?php if(($controllers_name=="backendteam" && $method_name!="list_items_sales_quote" && $method_name!="view_sales_quote"  && $method_name!="list_items_service_quote" && $method_name!="view_service_quote") || $controllers_name=="manager" || $controllers_name=="cordinator" || $controllers_name=="salesperson" || $controllers_name=="serviceperson"){echo "open";} ?>"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="<?php echo base_url("admin/morning/listing"); ?>" class="nav-link ">
                                            <span class="title <?php if($uri1=="admin" && ($uri2=="morning" && $uri3=="listing")){echo "active text text-danger";} ?>">Morning Focus</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="<?php echo base_url("admin/coaches/listing"); ?>" class="nav-link ">
                                            <span class="title <?php if($uri1=="admin" && ($uri2=="coaches" && $uri3=="listing")){echo "text text-danger";} ?>">Coaches center</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="<?php echo base_url("admin/masterclass/listing"); ?>" class="nav-link ">
                                            <span class="title <?php if($uri1=="admin" && ($uri2=="masterclass" && $uri3=="listing")){echo "text text-danger";} ?>">Focus Master class</span>
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item  ">
                                        <a href="<?php echo base_url("admin/education/listing"); ?>" class="nav-link ">
                                            <span class="title <?php if($uri1=="admin" && ($uri2=="education" && $uri3=="listing")){echo "text text-danger";} ?>">Focus Education</span>
                                        </a>
                                    </li> -->
                                                                     
                                </ul>
                            </li>
                           
                            <!-- <li class="nav-item open"> -->
                            <li class="nav-item  <?php if($uri1=="admin" && ($uri2 =="mastercontent" || $uri2 =="mastervideo" || $uri2 =="leadershipcontent" || $uri2 =="leadershipvideo")) {echo "active open";} ?>">
                                
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-puzzle"></i>
                                    <span class="title">Focus Retreats</span>
                                    <span class="arrow"></span>
                                </a>

                                <ul class="sub-menu">
                                    <li class="nav-item <?php if(($uri1=="admin" && ($uri2 =="mastercontent" || $uri2 =="mastervideo"))){echo "active open";} ?>">
                                      
                                            <a href="javascript:;" class="nav-link nav-toggle">
                                                <i class="icon-puzzle"></i>
                                                <span class="title">Self Mastery</span>
                                                <span class="arrow "></span>
                                            </a>
                                                <ul class="sub-menu">
                                                    <li class="nav-item ">
                                                        <a href="<?php echo base_url("admin/mastercontent/listing"); ?>" class="nav-link ">
                                                            <span class="title <?php if($uri1=="admin" && ($uri2=="mastercontent")){echo "text text-danger";} ?>">Content</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item  ">
                                                        <a href="<?php echo base_url("admin/mastervideo/listing"); ?>" class="nav-link ">
                                                            <span class="title <?php if($uri1=="admin" && ($uri2=="mastervideo")){echo "text text-danger";} ?>">Videos</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                     
                            </li>
                            <li class="nav-item <?php if(($uri1=="admin" && ($uri2 =="leadershipcontent" || $uri2 =="leadershipvideo" ))){echo "active open";} ?>">
                                            <a href="javascript:;" class="nav-link nav-toggle">
                                                <i class="icon-puzzle"></i>
                                                <span class="title">Business Leadership</span>
                                                <span class="arrow "></span>
                                            </a>
                                        <ul class="sub-menu">
                                            <li class="nav-item">
                                                <a href="<?php echo base_url("admin/leadershipcontent/listing"); ?>" class="nav-link ">
                                                    <span class="title <?php if($uri1=="admin" && ($uri2=="leadershipcontent")){echo "text text-danger";} ?>">Content</span>
                                                </a>
                                            </li>
                                            <li class="nav-item  ">
                                                <a href="<?php echo base_url("admin/leadershipvideo/listing"); ?>" class="nav-link ">
                                                    <span class="title <?php if($uri1=="admin" && ($uri2=="leadershipvideo")){echo "text text-danger";} ?>">Video</span>
                                                </a>
                                            </li>
                                        
                                                                            
                                        </ul>
                            </li>
                        
                                                                     
                                </ul>
                            </li>

                            <li class="nav-item  <?php if($uri1=="admin" &&  $uri2=="cms") {echo "active open";} ?>">
                                <a href="<?php echo base_url("admin/cms"); ?>" class="nav-link nav-toggle">
                                    <i class="icon-puzzle"></i>
                                    <span class="title">CMS</span>
                                </a>
                                
                            </li>
                           
                        </ul>
                       
                   

<!-----------------------------------------------Super Admin End------------------------------------------------------------>                
                                            
  
<!-----------------------------------------------Branch Manager Start------------------------------------------------------------>                
                                            
                                           
                                            <?php } if ( getUserInfos()->role == "1" || getUserInfos()->role == "7") { 

                                                    $logged_in_manager_id=getUserInfos()->id;
                                                    ?>

 <li class="nav-item start <?php if($controllers_name=="dashboard"){echo "active open";} ?>">
                                <a href="<?php echo base_url("dashboard"); ?>" class="nav-link nav-toggle">
                                    <i class="icon-home"></i>
                                    <span class="title">Dashboard</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            <li class="nav-item  <?php if($controllers_name=="backendteam" || $controllers_name=="manager" || $controllers_name=="cordinator" || $controllers_name=="salesperson" || $controllers_name=="serviceperson"){echo "active open";} ?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-puzzle"></i>
                                    <span class="title">Manage Users</span>
                                    <span class="arrow <?php if($controllers_name=="backendteam" || $controllers_name=="manager" || $controllers_name=="cordinator" || $controllers_name=="salesperson" || $controllers_name=="serviceperson"){echo "open";} ?>"></span>
                                </a>
                                <ul class="sub-menu">
                                <li class="nav-item  ">
                                        <a href="<?php echo base_url("cordinator/redirect_cordinator/".ID_encode($logged_in_manager_id)); ?>" class="nav-link ">
                                            <span class="title <?php if($method_name=="redirect_cordinator" || $method_name=="redirect_salesperson" || $method_name=="redirect_serviceperson" ){echo "text text-danger";} ?>">Redirected Coordinator</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="<?php echo base_url("backendteam/list_items"); ?>" class="nav-link ">
                                            <span class="title <?php if($controllers_name=="backendteam" && ($method_name=="list_items" || $method_name=="edit" || $method_name=="view" || $method_name=="add")){echo "text text-danger";} ?>">Backend Team</span>
                                        </a>
                                    </li>

                                    <li class="nav-item  ">
                                        <a href="<?php echo base_url("cordinator/list_items"); ?>" class="nav-link ">
                                            <span class="title <?php if($controllers_name=="cordinator" && ($method_name=="list_items" || $method_name=="edit" || $method_name=="view"  || $method_name=="add")){echo "text text-danger";} ?>">Coordinator</span>
                                        </a>
                                    </li>
                                 
                                    <li class="nav-item  ">
                                        <a href="<?php echo base_url("salesperson/list_items"); ?>" class="nav-link ">
                                            <span class="title <?php if($controllers_name=="salesperson" && ($method_name=="list_items" || $method_name=="edit" || $method_name=="view" || $method_name=="target"  || $method_name=="add")){echo "text text-danger";} ?>">Sales Person</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="<?php echo base_url("serviceperson/list_items"); ?>" class="nav-link ">
                                         <span class="title <?php if($controllers_name=="serviceperson" && ($method_name=="list_items" || $method_name=="edit" || $method_name=="view" || $method_name=="set_incentive"  || $method_name=="add")){echo "text text-danger";} ?>">Service Person</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item  <?php if($controllers_name=="viewtarget"  && $method_name=="list_items"){echo "active";} ?>">
                                        <a href="<?php echo base_url("viewtarget/list_items"); ?>" class="nav-link ">
                                        <i class="icon-puzzle"></i>
                                            <span class="title">View Target</span>
                                        </a>
                                    </li>

                            <!--  <li class="nav-item  <?php if($controllers_name=="dummy"  && $method_name=="list_items"){echo "active";} ?>">
                             <a href="<?php echo base_url("dummy/list_items"); ?>" class="nav-link ">
                             <i class="icon-puzzle"></i>
                                 <span class="title">Dummy</span>
                             </a>
                            </li> -->
                            <li class="nav-item  <?php if($controllers_name=="backendteam" && ($method_name=="list_items_sales_quote" || $method_name=="view_sales_quote")){echo "active";} ?>">
                                <a href="<?php echo base_url("backendteam/list_items_sales_quote"); ?>" class="nav-link nav-toggle">
                                    <i class="icon-settings"></i>
                                    <span class="title">Manage Sales Quote</span>
                                </a>
                            </li>
							<li class="nav-item  <?php if($controllers_name=="backendteam" && ($method_name=="list_items_service_quote" || $method_name=="view_service_quote")){echo "active";} ?>">
                                <a href="<?php echo base_url("backendteam/list_items_service_quote"); ?>" class="nav-link nav-toggle">
                                    <i class="icon-bulb"></i>
                                    <span class="title">Manage Service Quote</span>
                                </a>
                            </li>
							<li class="nav-item <?php if($controllers_name=="leadmanagement"  && ($method_name=="list_items" || $method_name=="add" || $method_name=="edit" || $method_name=="view" || $method_name=="assign_activity")){echo "active";} ?>">
                                <a href="<?php echo base_url("leadmanagement/list_items"); ?>" class="nav-link nav-toggle">
                                    <i class="icon-briefcase"></i>
                                    <span class="title">Manage Lead</span>
                                </a>
                            </li>
							<!-- <li class="nav-item <?php if($controllers_name=="salespersonactivity"  && ($method_name=="list_items_activity" || $method_name=="view_activity")){echo "active";} ?>">
                                <a href="<?php echo base_url("salespersonactivity/list_items_activity"); ?>" class="nav-link nav-toggle">
                                    <i class="icon-wallet"></i>
                                    <span class="title">Manage Sales Activity</span>
                                </a>
                            </li> -->
						 <li class="nav-item <?php if($controllers_name=="manage_sales_order" && ($method_name=="list_items" || $method_name=="view" || $method_name=="add")){echo "active open";} ?>">
                                <a href="<?php echo base_url("manage_sales_order/list_items"); ?>" class="nav-link nav-toggle">
                                    <i class="icon-bar-chart"></i>
                                    <span class="title">Manage Sales Order</span>
                                </a>
                            </li>
                           
							<li class="nav-item <?php if($controllers_name=="salespersonactivity"  && ($method_name=="list_items" || $method_name=="list_items_activity"  || $method_name=="view_activity")){echo "active";} ?>">
                                <a href="<?php echo base_url("salespersonactivity/list_items"); ?>" class="nav-link nav-toggle">
                                    <i class="icon-wallet"></i>
                                    <span class="title">Sales Activity History</span>
                                </a>
                            </li>
							<li class="nav-item <?php if($controllers_name=="salespersonactivity"  && ($method_name=="list_items_sales_performance")){echo "active";} ?>">
                                <a href="<?php echo base_url("salespersonactivity/list_items_sales_performance"); ?>" class="nav-link nav-toggle">
                                    <i class="icon-wallet"></i>
                                    <span class="title">Sales Person Performance</span>
                                </a>
                            </li>
                            <li class="nav-item <?php if($controllers_name=="salespersonactivity"  && ($method_name=="list_items_app_disapp"  || $method_name=="view_app_disapp")){echo "active";} ?>">
                                <a href="<?php echo base_url("salespersonactivity/list_items_app_disapp"); ?>" class="nav-link nav-toggle">
                                <i class="icon-paper-plane"></i>
                                    <span class="title">Sales Request to Mark Previous Activity</span>
                                </a>
                            </li>
                            <li class="nav-item <?php if($controllers_name=="salespersonactivity"  && ($method_name=="list_items_reschedule_activity"  || $method_name=="view_reschedule_activity")){echo "active";} ?>">
                                <a href="<?php echo base_url("salespersonactivity/list_items_reschedule_activity"); ?>" class="nav-link nav-toggle">
                                <i class="icon-paper-plane"></i>
                                    <span class="title">List of Reschedule Activity</span>
                                </a>
                            </li>
                            <li class="nav-item <?php if($controllers_name=="complaint"  && ($method_name=="list_items" || $method_name=="add" || $method_name=="view")){echo "active";} ?>">
                                <a href="<?php echo base_url("complaint/list_items"); ?>" class="nav-link nav-toggle">
                                <i class="icon-docs"></i>
                                    <span class="title">Manage Complaint</span>
                                </a>
                            </li>
                         
							
							
                           <!--  <li class="nav-item <?php if($controllers_name=="complaint"  && ($method_name=="list_items_activity"  || $method_name=="view_activity" )){echo "active";} ?>">
                                <a href="<?php echo base_url("complaint/list_items_activity"); ?>" class="nav-link nav-toggle">
                                <i class="icon-docs"></i>
                                    <span class="title">Manage Service Activity</span>
                                </a>
                            </li> -->
							
                            <li class="nav-item <?php if($controllers_name=="manage_service_order" && ($method_name=="list_items" || $method_name=="view" || $method_name=="add")){echo "active open";} ?>">
                                <a href="<?php echo base_url("manage_service_order/list_items"); ?>" class="nav-link nav-toggle">
                                    <i class="icon-bar-chart"></i>
                                    <span class="title">Manage Service Order</span>
                                </a>
                            </li>
                            <li class="nav-item <?php if($controllers_name=="complaint"  && ($method_name=="list_items_activity_history" ||$method_name=="list_items_activity"  || $method_name=="view_activity")){echo "active";} ?>">
                                <a href="<?php echo base_url("complaint/list_items_activity_history"); ?>" class="nav-link nav-toggle">
                                <i class="icon-docs"></i>
                                    <span class="title">Service Activity History</span>
                                </a>
                            </li>
                            <li class="nav-item <?php if($controllers_name=="complaint"  && ($method_name=="list_items_app_disapp"  || $method_name=="view_app_disapp")){echo "active";} ?>">
                                <a href="<?php echo base_url("complaint/list_items_app_disapp"); ?>" class="nav-link nav-toggle">
                                    <i class="icon-folder"></i>
                                    <span class="title">Service Request to Mark Previous Activity</span>
                                </a>
                            </li>
                            <li class="nav-item <?php if($controllers_name=="complaint"  && ( $method_name=="view_reschedule_activity" || $method_name=="list_items_reschedule_activity")){echo "active";} ?>">
                                <a href="<?php echo base_url("complaint/list_items_reschedule_activity"); ?>" class="nav-link nav-toggle">
                                    <i class="icon-graph"></i><i class="icon-folder"></i>
                                    <span class="title">Service Rescheduled Activity</span>
                                </a>
                            </li>
                            
                        </ul>
                       
                   


               
 
<!-----------------------------------------------Branch Manager End------------------------------------------------------------>                
   

<!-----------------------------------------------Back-end Team start------------------------------------------------------------>                



  <?php } ?>               
                   
<!-----------------------------------------------Service Coordinator End------------------------------------------------------------>                


                            </div>
                  
                  </div>
                              

 
