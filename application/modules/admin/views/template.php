<!DOCTYPE html>

<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Administrator | Dashboard</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="<?php echo base_url()?>template/metro/assets/global/css/font-google.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>template/metro/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>template/metro/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>template/metro/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>template/metro/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>template/metro/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>template/metro/assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>template/metro/assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>template/metro/assets/global/plugins/select2/select2.css"/>
<link href="<?php echo base_url()?>template/metro/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url()?>template/metro/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>template/metro/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>template/metro/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>template/metro/assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url()?>template/metro/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<script type="text/javascript">
	var base_url='<?php echo base_url();?>';
</script>



<script src="<?php echo base_url()?>template/metro/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>template/metro/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url()?>template/metro/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>template/metro/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>template/metro/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>template/metro/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>template/metro/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>template/metro/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>template/metro/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>template/metro/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script type="text/javascript" src="<?php echo base_url()?>template/metro/assets/global/plugins/select2/select2.min.js"></script>
<script src="<?php echo base_url()?>template/metro/assets/global/plugins/datatables/media/js/jquery.dataTables.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url()?>template/metro/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>



<script src="<?php echo base_url()?>template/metro/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>template/metro/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout

});
</script>
<!-- END JAVASCRIPTS -->


</head>

<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="<?php echo base_url()?>">
			<img src="<?php echo base_url()?>template/metro/assets/admin/layout/img/logo.png" alt="logo" class="logo-default" title='halaman administrator'/>
			</a>
			<div class="menu-toggler sidebar-toggler">
			</div>
		</div>
		
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				
				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<img alt="" class="img-circle" src="<?php echo base_url()?>template/metro/assets/admin/pages/media/profile/user.png"/>
					<span class="username username-hide-on-mobile">
					<?php echo $_SESSION['nama']?> </span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
							<a href="#">
							<i class="icon-user"></i> My Profile </a>
						</li>
						<li>
							<a href="#">
							<i class="icon-calendar"></i> My Calendar </a>
						</li>
						<li>
							<a href="#">
							<i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">
							3 </span>
							</a>
						</li>
						<li>
							<a href="#">
							<i class="icon-rocket"></i> My Tasks <span class="badge badge-success">
							7 </span>
							</a>
						</li>
						<li class="divider">
						</li>
						<li>
							<a href="#">
							<i class="icon-lock"></i> Lock Screen </a>
						</li>
						<li>
							<a href="<?php echo base_url().'admin/keluar'?>">
							<i class="icon-key"></i> Log Out </a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
				<!-- BEGIN QUICK SIDEBAR TOGGLER -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				
				<!-- END QUICK SIDEBAR TOGGLER -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hide">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
				<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
					<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
					<form class="sidebar-search sidebar-search-bordered" action="extra_search.html" method="POST">
						<a href="javascript:;" class="remove">
						<i class="icon-close"></i>
						</a>
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search...">
							<span class="input-group-btn">
							<button class="btn submit"><i class="icon-magnifier"></i></button>
							</span>
						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				<li class="heading">
					<h3 class="uppercase">PANEL MENU</h3>
				</li>
				<li class="start <?php echo $this->uri->segment(2)=='home'?'active open':''?> <?php echo $this->uri->segment(2)==''?'active open':''?>">
					<a href="<?php echo base_url().'admin'?>">
					<i class="icon-home"></i>
					<span class="title">Beranda</span>
					<span class="selected"></span>
					</a>
					
				</li>
				<li class="<?php echo $this->uri->segment(2)=='datamaster'?'active open':''?> <?php echo $this->uri->segment(2)=='tarif'?'active':''?>">
					<a href="javascript:;">
					<i class="icon-layers"></i>
					<span class="title">Data Master</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php echo $this->uri->segment(3)=='ruanganinap'?'active':''?> <?php echo $this->uri->segment(3)=='kamar'?'active':''?><?php echo $this->uri->segment(3)=='bed'?'active':''?>">
							<a href="<?php echo base_url()?>admin/datamaster/ruanganinap">
							<i class="icon-list"></i>
							Ruang Rawat Inap
							</a>
						</li>

						<li class="">
							<a href="#">
							<i class="icon-direction"></i>
							Poliklinik
							</a>
						</li>

						<li class="">
							<a href="#">
							<i class="icon-users"></i>
							Dokter
							</a>
						</li>

						<li class="<?php echo $this->uri->segment(2)=='tarif'?'active':''?>">
							<a href="#">
							<i class="icon-badge"></i>
							Tarif Pelayanan
							<span class="arrow "></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="javascript:;">
									<i class="icon-trophy"></i> 
										IGD
									</a>
								</li>

								<li>
									<a href="javascript:;">
									<i class="icon-trophy"></i> 
										Poliklinik
									</a>
								</li>

								<li>
									<a href="javascript:;">
									<i class="icon-trophy"></i> 
										Laboraturium
									</a>
								</li>

								<li class="<?php echo $this->uri->segment(3)=='radiologi'?'active':''?>">
									<a href="<?php echo base_url().'admin/tarif/radiologi'?>">
									<i class="icon-trophy"></i> 
										Radiologi
									</a>
								</li>

								<li>
									<a href="javascript:;">
									<i class="icon-trophy"></i> 
										Operasi
									</a>
								</li>

								<li>
									<a href="javascript:;">
									<i class="icon-trophy"></i> 
										Biaya Automatis
									</a>
								</li>

							</ul>

						</li>
						
					</ul>
				</li>

				<li class="<?php echo $this->uri->segment(2)=='manageuser'?'active open':''?>">
					<a href="javascript:;">
					<i class="icon-puzzle"></i>
					<span class="title">Manage users</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php echo $this->uri->segment(3)=='corajal'?'active':''?> <?php echo $this->uri->segment(5)=='corajal'?'active':''?>">
							<a href="<?php echo base_url()?>admin/manageuser/corajal">
							<i class="icon-users"></i>
							Co Rajal
							</a>
						</li>
						<li class="<?php echo $this->uri->segment(3)=='poliklinik'?'active':''?>">
							<a href="<?php echo base_url()?>admin/manageuser/poliklinik">
							<i class="icon-users"></i>
							Poliklinik</a>
						</li>
						<li class="<?php echo $this->uri->segment(3)=='laboraturium'?'active':''?>">
							<a href="<?php echo base_url()?>admin/manageuser/laboraturium">
							<i class="icon-users"></i>
							Laboraturium</a>
						</li>
						<li class="<?php echo $this->uri->segment(3)=='gudangfarmasi'?'active':''?>">
							<a href="<?php echo base_url()?>admin/manageuser/gudangfarmasi">
							<i class="icon-users"></i>
							Gudang Farmasi
							</a>
						</li>
						<li>
							<a href="<?php echo base_url()?>admin/manageuser/depofarmasi">
							<i class="icon-users"></i>
							Depo Farmasi</a>
						</li>
					</ul>
				</li>

			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<?php echo $contents ?>
		</div>
	</div>
	<!-- END CONTENT -->
	<!-- BEGIN QUICK SIDEBAR -->
	<a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-close"></i></a>
	<div class="page-quick-sidebar-wrapper">
		<div class="page-quick-sidebar">
			<div class="nav-justified">
				<ul class="nav nav-tabs nav-justified">
					<li class="active">
						<a href="#quick_sidebar_tab_1" data-toggle="tab">
						Users <span class="badge badge-danger">2</span>
						</a>
					</li>
					<li>
						<a href="#quick_sidebar_tab_2" data-toggle="tab">
						Alerts <span class="badge badge-success">7</span>
						</a>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						More<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu pull-right" role="menu">
							<li>
								<a href="#quick_sidebar_tab_3" data-toggle="tab">
								<i class="icon-bell"></i> Alerts </a>
							</li>
							<li>
								<a href="#quick_sidebar_tab_3" data-toggle="tab">
								<i class="icon-info"></i> Notifications </a>
							</li>
							<li>
								<a href="#quick_sidebar_tab_3" data-toggle="tab">
								<i class="icon-speech"></i> Activities </a>
							</li>
							<li class="divider">
							</li>
							<li>
								<a href="#quick_sidebar_tab_3" data-toggle="tab">
								<i class="icon-settings"></i> Settings </a>
							</li>
						</ul>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active page-quick-sidebar-chat" id="quick_sidebar_tab_1">
						<div class="page-quick-sidebar-chat-users" data-rail-color="#ddd" data-wrapper-class="page-quick-sidebar-list">
							<h3 class="list-heading">Staff</h3>
							<ul class="media-list list-items">
								<li class="media">
									<div class="media-status">
										<span class="badge badge-success">8</span>
									</div>
									<img class="media-object" src="assets/admin/layout/img/avatar3.jpg" alt="...">
									<div class="media-body">
										<h4 class="media-heading">Bob Nilson</h4>
										<div class="media-heading-sub">
											 Project Manager
										</div>
									</div>
								</li>
								<li class="media">
									<img class="media-object" src="assets/admin/layout/img/avatar1.jpg" alt="...">
									<div class="media-body">
										<h4 class="media-heading">Nick Larson</h4>
										<div class="media-heading-sub">
											 Art Director
										</div>
									</div>
								</li>
								<li class="media">
									<div class="media-status">
										<span class="badge badge-danger">3</span>
									</div>
									<img class="media-object" src="assets/admin/layout/img/avatar4.jpg" alt="...">
									<div class="media-body">
										<h4 class="media-heading">Deon Hubert</h4>
										<div class="media-heading-sub">
											 CTO
										</div>
									</div>
								</li>
								<li class="media">
									<img class="media-object" src="assets/admin/layout/img/avatar2.jpg" alt="...">
									<div class="media-body">
										<h4 class="media-heading">Ella Wong</h4>
										<div class="media-heading-sub">
											 CEO
										</div>
									</div>
								</li>
							</ul>
							<h3 class="list-heading">Customers</h3>
							<ul class="media-list list-items">
								<li class="media">
									<div class="media-status">
										<span class="badge badge-warning">2</span>
									</div>
									<img class="media-object" src="assets/admin/layout/img/avatar6.jpg" alt="...">
									<div class="media-body">
										<h4 class="media-heading">Lara Kunis</h4>
										<div class="media-heading-sub">
											 CEO, Loop Inc
										</div>
										<div class="media-heading-small">
											 Last seen 03:10 AM
										</div>
									</div>
								</li>
								<li class="media">
									<div class="media-status">
										<span class="label label-sm label-success">new</span>
									</div>
									<img class="media-object" src="assets/admin/layout/img/avatar7.jpg" alt="...">
									<div class="media-body">
										<h4 class="media-heading">Ernie Kyllonen</h4>
										<div class="media-heading-sub">
											 Project Manager,<br>
											 SmartBizz PTL
										</div>
									</div>
								</li>
								<li class="media">
									<img class="media-object" src="assets/admin/layout/img/avatar8.jpg" alt="...">
									<div class="media-body">
										<h4 class="media-heading">Lisa Stone</h4>
										<div class="media-heading-sub">
											 CTO, Keort Inc
										</div>
										<div class="media-heading-small">
											 Last seen 13:10 PM
										</div>
									</div>
								</li>
								<li class="media">
									<div class="media-status">
										<span class="badge badge-success">7</span>
									</div>
									<img class="media-object" src="assets/admin/layout/img/avatar9.jpg" alt="...">
									<div class="media-body">
										<h4 class="media-heading">Deon Portalatin</h4>
										<div class="media-heading-sub">
											 CFO, H&D LTD
										</div>
									</div>
								</li>
								<li class="media">
									<img class="media-object" src="assets/admin/layout/img/avatar10.jpg" alt="...">
									<div class="media-body">
										<h4 class="media-heading">Irina Savikova</h4>
										<div class="media-heading-sub">
											 CEO, Tizda Motors Inc
										</div>
									</div>
								</li>
								<li class="media">
									<div class="media-status">
										<span class="badge badge-danger">4</span>
									</div>
									<img class="media-object" src="assets/admin/layout/img/avatar11.jpg" alt="...">
									<div class="media-body">
										<h4 class="media-heading">Maria Gomez</h4>
										<div class="media-heading-sub">
											 Manager, Infomatic Inc
										</div>
										<div class="media-heading-small">
											 Last seen 03:10 AM
										</div>
									</div>
								</li>
							</ul>
						</div>
						<div class="page-quick-sidebar-item">
							<div class="page-quick-sidebar-chat-user">
								<div class="page-quick-sidebar-nav">
									<a href="javascript:;" class="page-quick-sidebar-back-to-list"><i class="icon-arrow-left"></i>Back</a>
								</div>
								<div class="page-quick-sidebar-chat-user-messages">
									<div class="post out">
										<img class="avatar" alt="" src="assets/admin/layout/img/avatar3.jpg"/>
										<div class="message">
											<span class="arrow"></span>
											<a href="javascript:;" class="name">Bob Nilson</a>
											<span class="datetime">20:15</span>
											<span class="body">
											When could you send me the report ? </span>
										</div>
									</div>
									<div class="post in">
										<img class="avatar" alt="" src="assets/admin/layout/img/avatar2.jpg"/>
										<div class="message">
											<span class="arrow"></span>
											<a href="javascript:;" class="name">Ella Wong</a>
											<span class="datetime">20:15</span>
											<span class="body">
											Its almost done. I will be sending it shortly </span>
										</div>
									</div>
									<div class="post out">
										<img class="avatar" alt="" src="assets/admin/layout/img/avatar3.jpg"/>
										<div class="message">
											<span class="arrow"></span>
											<a href="javascript:;" class="name">Bob Nilson</a>
											<span class="datetime">20:15</span>
											<span class="body">
											Alright. Thanks! :) </span>
										</div>
									</div>
									<div class="post in">
										<img class="avatar" alt="" src="assets/admin/layout/img/avatar2.jpg"/>
										<div class="message">
											<span class="arrow"></span>
											<a href="javascript:;" class="name">Ella Wong</a>
											<span class="datetime">20:16</span>
											<span class="body">
											You are most welcome. Sorry for the delay. </span>
										</div>
									</div>
									<div class="post out">
										<img class="avatar" alt="" src="assets/admin/layout/img/avatar3.jpg"/>
										<div class="message">
											<span class="arrow"></span>
											<a href="javascript:;" class="name">Bob Nilson</a>
											<span class="datetime">20:17</span>
											<span class="body">
											No probs. Just take your time :) </span>
										</div>
									</div>
									<div class="post in">
										<img class="avatar" alt="" src="assets/admin/layout/img/avatar2.jpg"/>
										<div class="message">
											<span class="arrow"></span>
											<a href="javascript:;" class="name">Ella Wong</a>
											<span class="datetime">20:40</span>
											<span class="body">
											Alright. I just emailed it to you. </span>
										</div>
									</div>
									<div class="post out">
										<img class="avatar" alt="" src="assets/admin/layout/img/avatar3.jpg"/>
										<div class="message">
											<span class="arrow"></span>
											<a href="javascript:;" class="name">Bob Nilson</a>
											<span class="datetime">20:17</span>
											<span class="body">
											Great! Thanks. Will check it right away. </span>
										</div>
									</div>
									<div class="post in">
										<img class="avatar" alt="" src="assets/admin/layout/img/avatar2.jpg"/>
										<div class="message">
											<span class="arrow"></span>
											<a href="javascript:;" class="name">Ella Wong</a>
											<span class="datetime">20:40</span>
											<span class="body">
											Please let me know if you have any comment. </span>
										</div>
									</div>
									<div class="post out">
										<img class="avatar" alt="" src="assets/admin/layout/img/avatar3.jpg"/>
										<div class="message">
											<span class="arrow"></span>
											<a href="javascript:;" class="name">Bob Nilson</a>
											<span class="datetime">20:17</span>
											<span class="body">
											Sure. I will check and buzz you if anything needs to be corrected. </span>
										</div>
									</div>
								</div>
								<div class="page-quick-sidebar-chat-user-form">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Type a message here...">
										<div class="input-group-btn">
											<button type="button" class="btn blue"><i class="icon-paper-clip"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane page-quick-sidebar-alerts" id="quick_sidebar_tab_2">
						<div class="page-quick-sidebar-alerts-list">
							<h3 class="list-heading">General</h3>
							<ul class="feeds list-items">
								<li>
									<div class="col1">
										<div class="cont">
											<div class="cont-col1">
												<div class="label label-sm label-info">
													<i class="fa fa-check"></i>
												</div>
											</div>
											<div class="cont-col2">
												<div class="desc">
													 You have 4 pending tasks. <span class="label label-sm label-warning ">
													Take action <i class="fa fa-share"></i>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col2">
										<div class="date">
											 Just now
										</div>
									</div>
								</li>
								<li>
									<a href="javascript:;">
									<div class="col1">
										<div class="cont">
											<div class="cont-col1">
												<div class="label label-sm label-success">
													<i class="fa fa-bar-chart-o"></i>
												</div>
											</div>
											<div class="cont-col2">
												<div class="desc">
													 Finance Report for year 2013 has been released.
												</div>
											</div>
										</div>
									</div>
									<div class="col2">
										<div class="date">
											 20 mins
										</div>
									</div>
									</a>
								</li>
								<li>
									<div class="col1">
										<div class="cont">
											<div class="cont-col1">
												<div class="label label-sm label-danger">
													<i class="fa fa-user"></i>
												</div>
											</div>
											<div class="cont-col2">
												<div class="desc">
													 You have 5 pending membership that requires a quick review.
												</div>
											</div>
										</div>
									</div>
									<div class="col2">
										<div class="date">
											 24 mins
										</div>
									</div>
								</li>
								<li>
									<div class="col1">
										<div class="cont">
											<div class="cont-col1">
												<div class="label label-sm label-info">
													<i class="fa fa-shopping-cart"></i>
												</div>
											</div>
											<div class="cont-col2">
												<div class="desc">
													 New order received with <span class="label label-sm label-success">
													Reference Number: DR23923 </span>
												</div>
											</div>
										</div>
									</div>
									<div class="col2">
										<div class="date">
											 30 mins
										</div>
									</div>
								</li>
								<li>
									<div class="col1">
										<div class="cont">
											<div class="cont-col1">
												<div class="label label-sm label-success">
													<i class="fa fa-user"></i>
												</div>
											</div>
											<div class="cont-col2">
												<div class="desc">
													 You have 5 pending membership that requires a quick review.
												</div>
											</div>
										</div>
									</div>
									<div class="col2">
										<div class="date">
											 24 mins
										</div>
									</div>
								</li>
								<li>
									<div class="col1">
										<div class="cont">
											<div class="cont-col1">
												<div class="label label-sm label-info">
													<i class="fa fa-bell-o"></i>
												</div>
											</div>
											<div class="cont-col2">
												<div class="desc">
													 Web server hardware needs to be upgraded. <span class="label label-sm label-warning">
													Overdue </span>
												</div>
											</div>
										</div>
									</div>
									<div class="col2">
										<div class="date">
											 2 hours
										</div>
									</div>
								</li>
								<li>
									<a href="javascript:;">
									<div class="col1">
										<div class="cont">
											<div class="cont-col1">
												<div class="label label-sm label-default">
													<i class="fa fa-briefcase"></i>
												</div>
											</div>
											<div class="cont-col2">
												<div class="desc">
													 IPO Report for year 2013 has been released.
												</div>
											</div>
										</div>
									</div>
									<div class="col2">
										<div class="date">
											 20 mins
										</div>
									</div>
									</a>
								</li>
							</ul>
							<h3 class="list-heading">System</h3>
							<ul class="feeds list-items">
								<li>
									<div class="col1">
										<div class="cont">
											<div class="cont-col1">
												<div class="label label-sm label-info">
													<i class="fa fa-check"></i>
												</div>
											</div>
											<div class="cont-col2">
												<div class="desc">
													 You have 4 pending tasks. <span class="label label-sm label-warning ">
													Take action <i class="fa fa-share"></i>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col2">
										<div class="date">
											 Just now
										</div>
									</div>
								</li>
								<li>
									<a href="javascript:;">
									<div class="col1">
										<div class="cont">
											<div class="cont-col1">
												<div class="label label-sm label-danger">
													<i class="fa fa-bar-chart-o"></i>
												</div>
											</div>
											<div class="cont-col2">
												<div class="desc">
													 Finance Report for year 2013 has been released.
												</div>
											</div>
										</div>
									</div>
									<div class="col2">
										<div class="date">
											 20 mins
										</div>
									</div>
									</a>
								</li>
								<li>
									<div class="col1">
										<div class="cont">
											<div class="cont-col1">
												<div class="label label-sm label-default">
													<i class="fa fa-user"></i>
												</div>
											</div>
											<div class="cont-col2">
												<div class="desc">
													 You have 5 pending membership that requires a quick review.
												</div>
											</div>
										</div>
									</div>
									<div class="col2">
										<div class="date">
											 24 mins
										</div>
									</div>
								</li>
								<li>
									<div class="col1">
										<div class="cont">
											<div class="cont-col1">
												<div class="label label-sm label-info">
													<i class="fa fa-shopping-cart"></i>
												</div>
											</div>
											<div class="cont-col2">
												<div class="desc">
													 New order received with <span class="label label-sm label-success">
													Reference Number: DR23923 </span>
												</div>
											</div>
										</div>
									</div>
									<div class="col2">
										<div class="date">
											 30 mins
										</div>
									</div>
								</li>
								<li>
									<div class="col1">
										<div class="cont">
											<div class="cont-col1">
												<div class="label label-sm label-success">
													<i class="fa fa-user"></i>
												</div>
											</div>
											<div class="cont-col2">
												<div class="desc">
													 You have 5 pending membership that requires a quick review.
												</div>
											</div>
										</div>
									</div>
									<div class="col2">
										<div class="date">
											 24 mins
										</div>
									</div>
								</li>
								<li>
									<div class="col1">
										<div class="cont">
											<div class="cont-col1">
												<div class="label label-sm label-warning">
													<i class="fa fa-bell-o"></i>
												</div>
											</div>
											<div class="cont-col2">
												<div class="desc">
													 Web server hardware needs to be upgraded. <span class="label label-sm label-default ">
													Overdue </span>
												</div>
											</div>
										</div>
									</div>
									<div class="col2">
										<div class="date">
											 2 hours
										</div>
									</div>
								</li>
								<li>
									<a href="javascript:;">
									<div class="col1">
										<div class="cont">
											<div class="cont-col1">
												<div class="label label-sm label-info">
													<i class="fa fa-briefcase"></i>
												</div>
											</div>
											<div class="cont-col2">
												<div class="desc">
													 IPO Report for year 2013 has been released.
												</div>
											</div>
										</div>
									</div>
									<div class="col2">
										<div class="date">
											 20 mins
										</div>
									</div>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="tab-pane page-quick-sidebar-settings" id="quick_sidebar_tab_3">
						<div class="page-quick-sidebar-settings-list">
							<h3 class="list-heading">General Settings</h3>
							<ul class="list-items borderless">
								<li>
									 Enable Notifications <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="success" data-on-text="ON" data-off-color="default" data-off-text="OFF">
								</li>
								<li>
									 Allow Tracking <input type="checkbox" class="make-switch" data-size="small" data-on-color="info" data-on-text="ON" data-off-color="default" data-off-text="OFF">
								</li>
								<li>
									 Log Errors <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="danger" data-on-text="ON" data-off-color="default" data-off-text="OFF">
								</li>
								<li>
									 Auto Sumbit Issues <input type="checkbox" class="make-switch" data-size="small" data-on-color="warning" data-on-text="ON" data-off-color="default" data-off-text="OFF">
								</li>
								<li>
									 Enable SMS Alerts <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="success" data-on-text="ON" data-off-color="default" data-off-text="OFF">
								</li>
							</ul>
							<h3 class="list-heading">System Settings</h3>
							<ul class="list-items borderless">
								<li>
									 Security Level
									<select class="form-control input-inline input-sm input-small">
										<option value="1">Normal</option>
										<option value="2" selected>Medium</option>
										<option value="e">High</option>
									</select>
								</li>
								<li>
									 Failed Email Attempts <input class="form-control input-inline input-sm input-small" value="5"/>
								</li>
								<li>
									 Secondary SMTP Port <input class="form-control input-inline input-sm input-small" value="3560"/>
								</li>
								<li>
									 Notify On System Error <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="danger" data-on-text="ON" data-off-color="default" data-off-text="OFF">
								</li>
								<li>
									 Notify On SMTP Error <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="warning" data-on-text="ON" data-off-color="default" data-off-text="OFF">
								</li>
							</ul>
							<div class="inner-content">
								<button class="btn btn-success"><i class="icon-settings"></i> Save Changes</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="page-footer">
	<div class="page-footer-inner">
		 2017 &copy; SIMRS.Dot
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>

</body>
</html>