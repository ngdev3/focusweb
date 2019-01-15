<?php
$this->lang->load('leftnav', get_language());
$new_refer_students=_get_all_new_refer_student();
?>
<!DOCTYPE html>
	<html lang="en" class="no-js">
	<!-- BEGIN HEAD -->
	<head>
		<meta charset="utf-8"/>
		<!--<title><?= (isset($title) && !empty($title)) ? $title : "Learning Track" ?></title>-->
		<title>Learning Track</title>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1" name="viewport"/>
		<meta content="" name="description"/>
		<meta content="" name="author"/>
		<!-- BEGIN GLOBAL MANDATORY STYLES -->
		<link rel="shortcut icon" type="image/png" href="<?= base_url() ?>assets/images/favicon.png"/>
		<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<link href="<?=SITE_PATH?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?=SITE_PATH?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?=SITE_PATH?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
		<!-- END GLOBAL MANDATORY STYLES -->
		<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
		<link href="<?=SITE_PATH?>global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
		<link href="<?=SITE_PATH?>global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?=SITE_PATH?>global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
		<link href="<?=SITE_PATH?>global/plugins/morris/morris.css" rel="stylesheet" type="text/css"/>
		<link href="<?=SITE_PATH?>global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
		<!-- END PAGE LEVEL PLUGIN STYLES -->
		<!-- BEGIN PAGE STYLES -->
		<link href="<?=SITE_PATH?>admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
		<link href="<?=SITE_PATH?>admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>
		<!-- END PAGE STYLES -->
		<!-- BEGIN THEME STYLES -->
		<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
		<link href="<?=SITE_PATH?>global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
		<link href="<?=SITE_PATH?>global/css/plugins.css" rel="stylesheet" type="text/css"/>
		<link href="<?=SITE_PATH?>admin/layout4/css/layout.css" rel="stylesheet" type="text/css"/>
		<link href="<?=SITE_PATH?>admin/layout4/css/themes/light.css" rel="stylesheet" type="text/css" id="style_color"/>
		<link href="<?=SITE_PATH?>admin/layout4/css/custom.css" rel="stylesheet" type="text/css"/>
		<link href="<?=SITE_PATH?>css/style.css" rel="stylesheet" type="text/css"/>
		<link href="<?=SITE_PATH?>css/style.min.css" rel="stylesheet" type="text/css">
		<!-- END THEME STYLES -->
		<link rel="shortcut icon" href="favicon.ico"/>
		<!--<style>
			input:required:focus {
			  border: 1px solid red;
			  outline: none;
			}
			textarea:required:focus {
			  border: 1px solid red;
			  outline: none;
			}	
			select:required:focus {
			  border: 1px solid red;
			  outline: none;
			}	
		</style>-->
		<script>
			var csrf_name="<?=$this->security->get_csrf_token_name()?>";
			var csrf_token="<?=$this->security->get_csrf_hash()?>";
		</script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
		<script type='text/javascript'>
			(function (d, t) {
			  var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
			  bh.type = 'text/javascript';
			  bh.src = '//www.bugherd.com/sidebarv2.js?apikey=v6ifj1vxzqy8adukrpi3dq';
			  s.parentNode.insertBefore(bh, s);
			  })(document, 'script');
		</script>
		<script type="text/javascript" src="<?=SITE_PATH?>global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
	</head>
	<!-- END HEAD -->
	<!-- BEGIN BODY -->
	<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
		<!--Loader Image with processing-->
		<script src="<?= base_url() ?>assets/loader/js/jquery.classyloader.min.js"></script>
		<script>
			$(document).on('click','.loader-hit',function() {
				$('.loader').ClassyLoader({
					percentage: 100,
					speed: 180,
					fontSize: '50px',
					diameter: 80,
					lineColor: '#006666',
					remainingLineColor: '#00cc99',
					fontColor:'#006666',
					lineWidth: 10
				});
			});
		</script>
		<div class="loader-hit"></div>
		<div class="processing-overlay hide"><canvas class="loader"></canvas></div>
		<!--End Loader Image with processing-->
		<!-- BEGIN HEADER -->
		<div class="page-header navbar navbar-fixed-top">
			<!-- BEGIN HEADER INNER -->
			<div class="page-header-inner">
				<!-- BEGIN LOGO -->
				<div class="page-logo">
					<div class="menu-toggler sidebar-toggler">
					</div>
					<?php 
					if(currentuserinfo()->user_type==0)
					{ 
						$url=base_url()."dashboard";
					}
					else
					{
						$url=base_url()."dashboard/student_dashboard";
					} ?>
					<a href="<?= $url ?>" class="set_logo">
						<img src="<?php echo base_url(); ?>assets/images/logo.png"></img>
					</a>
				</div>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>
				<!-- END RESPONSIVE MENU TOGGLER -->
				<!-- END PAGE ACTIONS -->
				<!-- BEGIN PAGE TOP -->
				<div class="page-top">
					<!-- BEGIN TOP NAVIGATION MENU -->
					<div class="top-menu">

						 <div class="dropdown notification-divs">
						  <button class="btn  " type="button" data-toggle="dropdown"style="background:transparent"><i class="fa fa-bell-o" aria-hidden="true"></i>
						  <span class="notification-no"> <?php echo $new_refer_students; ?></span></button>
						  <ul class="dropdown-menu">
							<li><a href="<?php echo base_url(); ?>refer_friends"><?php echo $new_refer_students; ?> New Refer Students</a></li>
						  </ul>
						</div>
						
						
						<ul class="nav navbar-nav pull-right">
							
							<li class="separator hide"></li>
							<!-- BEGIN NOTIFICATION DROPDOWN -->
							
							<!-- BEGIN USER LOGIN DROPDOWN -->
							<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
						
							<li class="dropdown dropdown-user dropdown-dark">
								<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									<?php
									$profile_img='';
									if((int)currentuserinfo()->user_type !== 0)
									{
										$sess_id=$this->session->userdata['userinfo']->id;
										$sess_user_type=$this->session->userdata['userinfo']->user_type; ?>
										<img id="pimdid" alt="" class="img-circle" src="<?php echo crm_profile_image($sess_id,$sess_user_type); ?>"/>
										<span class="username username-hide-on-mobile"><?=ucfirst(currentuserinfo()->first_name)?>&nbsp;<?=ucfirst(currentuserinfo()->last_name)?> </span>
									<?php } 
									else 
									{ ?>
										<img alt="" class="img-circle" src="<?=base_url()?>assets/admin/layout4/img/avatar3.jpg" />
										<span class="username username-hide-on-mobile"><?=ucfirst(currentuserinfo()->user_name)?> </span>
									<?php } ?>
								</a>
								<?php
								$demo_type=$this->session->userdata('demo_type');
								?>
								<ul class="dropdown-menu dropdown-menu-default">
									<?php 
									if(isset($demo_type) && empty($demo_type))
									{ ?>
										<li>
											<?php
											if((int)currentuserinfo()->user_type === 0)
											{
												echo '<a href="'.base_url().'admin/change_pwd"><i class="icon-user"></i>'.lang('change_password').'</a>';
											}
											else
											{
												echo '<a href="'.base_url().'user/profile_account"><i class="icon-user"></i>'.lang('my_profile').'</a>';
											} ?>
										</li>
									<?php } ?>
									<li>
										<a href="<?=base_url()?>auth/logout">
										<i class="icon-key"></i> <?=lang('log_out')?> </a>
									</li>
								</ul>
							</li>
							<!-- END USER LOGIN DROPDOWN -->						
						</ul>
					</div>
					<!-- END TOP NAVIGATION MENU -->
				</div>
				<!-- END PAGE TOP -->
			</div>
			<!-- END HEADER INNER -->
		</div>
		<!-- END HEADER -->
		<div class="clearfix"></div>
		<!-- BEGIN CONTAINER -->
		<div class="page-container">
			<!-- BEGIN SIDEBAR -->
			<?php echo $this->load->view('elements/left_menu'); ?>
			<!-- END SIDEBAR -->
			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="clearfix"></div>
					<?php echo $this->load->view($page);?>
				</div>
			</div>
			<!-- END CONTENT -->
		</div>
		<!-- END CONTAINER -->
		<!-- BEGIN FOOTER -->
		<style>
			.footer {position:fixed;z-index: 3; float:left; bottom: 0; width: 100%; background-color: #f58f38; padding:20px; color:#fff; }
		.nav-footer ul{margin:0; padding:0;} 
		.nav-footer li{display: block; float:left; list-style:none;} 
		.nav-footer li > a{padding:0px 15px; color:#fff;display: block; float:left; list-style:none;} 
		.nav-footer li > a:hover{color:#ff6600;} 
		.social-bg{position:absolute; right:0; top:-25px}
		.social-bg ul{margin:0 15px 0 0; padding:0}
		.social-bg ul li { float: left; padding:8px 0; background: #c6c6c6; margin: 0 5px; min-width: 48px; list-style: none; text-align: center; font-size: 25px; }
		.color-fb a{color:#627aad;}
		.color-in a{color:#03679b;}
		.color-ti a{color:#5ea9dd;}
		.color-gg a{color:#dc483b;}

		</style>
		<footer class="footer">
			<div class="nav-footer">
				<ul>
					<li>© <?= date('Y')?> Learning Track All Rights Reserved </li>
				</ul>
			</div>
		  <style>
			  .aftr_login_footer_color{color:#ffffff;}
		  </style>
		</footer>
		<!-- END FOOTER -->
		<script src="<?=SITE_PATH?>global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
		<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
		<script src="<?=SITE_PATH?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
		<!-- END CORE PLUGINS -->
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<script type="text/javascript" src="<?=SITE_PATH?>global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="<?=SITE_PATH?>global/plugins/jquery-validation/js/additional-methods.min.js"></script>
		<script type="text/javascript" src="<?=SITE_PATH?>global/plugins/select2/select2.min.js"></script>
		
		<script src="<?=SITE_PATH?>global/scripts/metronic.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>global/plugins/fullcalendar/lang-all.js"></script>
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="<?=SITE_PATH?>admin/layout4/scripts/layout.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>admin/layout2/scripts/quick-sidebar.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>admin/layout4/scripts/demo.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>admin/pages/scripts/index3.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>admin/pages/scripts/tasks.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>admin/pages/scripts/form-validation.js"></script>
		<script src="<?=SITE_PATH?>validation_functions.js"></script>
		<script src="<?= base_url() ?>assets/jquery-alert-dialogs/js/jquery.alerts.js"></script>
		<link rel="stylesheet" href="<?= base_url() ?>assets/jquery-alert-dialogs/css/jquery.alerts.css">
		<!-- END PAGE LEVEL SCRIPTS -->
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<script src="<?=SITE_PATH?>global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
		<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
		<script src="<?=SITE_PATH?>global/plugins/morris/morris.min.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>global/plugins/morris/raphael-min.js" type="text/javascript"></script>
		<script src="<?=SITE_PATH?>global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
		<!-- END PAGE LEVEL PLUGINS -->
		<!-- for data grid -->
		<script type="text/javascript" src="<?=SITE_PATH?>global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="<?=SITE_PATH?>global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script>
		jQuery(document).ready(function() {  
		   
		  Metronic.init(); // init metronic core componets
		   Layout.init(); // init layout
		  Demo.init(); // init demo features
		   
		   QuickSidebar.init(); // init quick sidebar
		   FormValidation.init();
		   Index.initCalendar(); // init index page's custom scripts
		   <?php if((int)currentuserinfo()->user_type === 1){ ?>
		   Index.init(); // init index page
		   <?php } ?>   
		   Tasks.initDashboardWidget(); // init tash dashboard widget 
		   
		   
		   
			
			
		});
		</script>
		<!-- END JAVASCRIPTS -->
		
		
		
	</body>
	<!-- END BODY -->
</html>
<?php 
if($this->uri->segment(1) === 'questions' && $this->uri->segment(2) === 'add')
{ ?>
	<script>
		$(function(){
			$(".add_more").trigger('click');
		});
	</script>
<?php } ?>


<script>
 // TOGGLE SECTIONS
// querySelector, jQuery style


// Define tabs, write down them classes
var tabs = [
  '.tabbed-section__selector-tab-1',
  '.tabbed-section__selector-tab-2',
  '.tabbed-section__selector-tab-3'
];

// Create the toggle function
var toggleTab = function(element) {
  var parent = element.parentNode;
  
  // Do things on click
  /* $(element)[0].addEventListener('click', function(){
    // Remove the active class on all tabs.
    // climbing up the DOM tree with `parentNode` and target 
    // the children ( the tabs ) with childNodes
    this.parentNode.childNodes[1].classList.remove('active');
    this.parentNode.childNodes[3].classList.remove('active');
    this.parentNode.childNodes[5].classList.remove('active');

    // Then, give `this` (the clicked tab), the active class
    this.classList.add('active');
    
    // Check if the clicked tab contains the class of the 1 or 2
    if(this.classList.contains('tabbed-section__selector-tab-1')) {
      // and change the classes, show the first content panel
      $('.tabbed-section-1')[0].classList.remove('hidden');
      $('.tabbed-section-1')[0].classList.add('visible');
      
      // Hide the second
      $('.tabbed-section-2')[0].classList.remove('visible');
      $('.tabbed-section-2')[0].classList.add('hidden');
       $('.tabbed-section-3')[0].classList.remove('visible');
      $('.tabbed-section-3')[0].classList.add('hidden');
    }

    if(this.classList.contains('tabbed-section__selector-tab-2')) {
      // and change the classes, show the second content panel
      $('.tabbed-section-2')[0].classList.remove('hidden');
      $('.tabbed-section-2')[0].classList.add('visible');
      // Hide the first
      $('.tabbed-section-1')[0].classList.remove('visible');
      $('.tabbed-section-1')[0].classList.add('hidden');
      $('.tabbed-section-3')[0].classList.remove('visible');
      $('.tabbed-section-3')[0].classList.add('hidden');
    }
    
    if(this.classList.contains('tabbed-section__selector-tab-3')) {
      // and change the classes, show the second content panel
      $('.tabbed-section-3')[0].classList.remove('hidden');
      $('.tabbed-section-3')[0].classList.add('visible');
      // Hide the first
      $('.tabbed-section-1')[0].classList.remove('visible');
      $('.tabbed-section-1')[0].classList.add('hidden');
      $('.tabbed-section-2')[0].classList.remove('visible');
      $('.tabbed-section-2')[0].classList.add('hidden');
    }
  }); */
};

// Then finally, iterates through all tabs, to activate the 
// tabs system.
for (var i = tabs.length - 1; i >= 0; i--) {
  toggleTab(tabs[i])
}
 </script>
 
 
 