<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="SIMRS" />
	<meta name="author" content="" />

	<link rel="icon" href="assets/images/favicon.ico">

	<title>SIMRS - Kasir</title>
        
        <!--File css--> 
	<link rel="stylesheet" href="<?php echo base_url()?>template/neon/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/font-icons/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/font-icons/entypo/css/entypo.css">
    
    <link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/neon-core.css">
    <link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/neon-theme.css">
    <link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/neon-forms.css">
    <link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url()?>template/neon/js/datatables/datatables.css">
    <link rel="stylesheet" href="<?php echo base_url()?>template/neon/js/select2/select2-bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url()?>template/neon/js/select2/select2.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>template/plugin/sweetalert/dist/sweetalert.css">
        
        <!--file javascript-->
    <script src="<?php echo base_url()?>template/neon/js/jQuery-2.1.4.js"></script>
        
    <!-- Bottom scripts (common) -->
    <script src="<?php echo base_url()?>template/neon/js/gsap/TweenMax.min.js"></script>
    <script src="<?php echo base_url()?>template/neon/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
    
        
        
    <script src="<?php echo base_url()?>template/neon/js/datatables/datatables.js"></script>
    <script src="<?php echo base_url()?>template/neon/js/datatables/fnReloadAjax.js"></script>
    <script src="<?php echo base_url()?>template/neon/js/select2/select2.min.js"></script>
    <script src="<?php echo base_url()?>template/neon/js/bootstrap.js"></script>
    <script src="<?php echo base_url()?>template/neon/js/joinable.js"></script>
    <script src="<?php echo base_url()?>template/neon/js/resizeable.js"></script>
    <script src="<?php echo base_url()?>template/neon/js/neon-api.js"></script>
    <!-- JavaScripts initializations and stuff -->
    <script src="<?php echo base_url()?>template/neon/js/neon-custom.js"></script>
    <!-- Demo Settings -->
    <script src="<?php echo base_url()?>template/neon/js/neon-demo.js"></script>
    <!-- print area plugin -->
    <script src="<?php echo base_url()?>template/plugin/printarea/jquery.PrintArea.js"></script>
    <script src="<?php echo base_url()?>template/neon/js/toastr.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>template/plugin/sweetalert/dist/sweetalert.min.js"></script>

        <script>
            var base_url='<?php echo base_url()?>'
        </script>
</head>
<body class="page-body" data-url="#">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <div class="sidebar-menu fixed">
        <div class="sidebar-menu-inner">
            <header class="logo-env">
                <div class="logo">
                    <a href="<?php echo base_url().''?>">
                        <img src="<?php echo base_url()?>template/neon/images/logo@2x.png" width="120" alt="" />
                    </a>
		        </div>
	           <!-- logo collapse icon -->
                <div class="sidebar-collapse">
                    <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
    			         <i class="entypo-menu"></i>
                    </a>
    		    </div>
                <div class="sidebar-mobile-menu visible-xs">
                    <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>
            </header>
            <ul id="main-menu" class="main-menu">
		        <li class="">
                    <a href="<?php echo base_url().'kasir'?>">
                        <i class="entypo-home"></i>
                        <span class="title">Home</span>
                    </a>
                </li>

                
                <li class="has-sub <?php echo $this->uri->segment(2)=='kunjungan'?'opened':''?>">
                    <a href="#">
                        <i class="entypo-monitor"></i>
                        <span class="title">Kunjungan</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo base_url().'kasir/kunjungan/igd'?>">
                                <i class="entypo-cc-nd"></i>
                                <span class="title">IGD</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'kasir/kunjungan/rajal'?>">
                                <i class="glyphicon glyphicon-cd"></i>
                                <span class="title">Rajal Jalan</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'kasir/kunjungan/ranap'?>">
                                <i class="fa fa-bed"></i>
                                <span class="title">Ranap Inap</span>
                            </a>
                        </li>                 
                    </ul>
                </li>    

                <li class="has-sub">
                    <a href="index.html">
                        <i class="entypo-docs"></i>
                        <span class="title">Billing</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo base_url().'kasir/billing/data'?>">
                                <i class="fa fa-folder"></i>
                                <span class="title">Data Billing</span>
                            </a>
                        </li>
                    </ul>
                </li>       
                
                <li class="has-sub">
                    <a href="index.html">
                        <i class="entypo-user"></i>
                        <span class="title">Akun</span>
                    </a>
                    <ul>
                        <li>
                            <a href="#">
                                <span class="title">Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'kasir/keluar'?>" )>
                                <span class="title">Keluar</span>
                            </a>
			            </li>
                    </ul>
                </li>
            </ul>
	</div>
    </div>
    <div class="main-content">
	<div class="row">
            <div class="col-md-6 col-sm-8 clearfix">
		<ul class="user-info pull-left pull-none-xsm">
                    <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo base_url()?>template/neon/images/thumb-1@2x.png" alt="" class="img-circle" width="44" />
                            <?php echo $this->session->userdata('nama_user')?>
			            </a>
                        <ul class="dropdown-menu">
                            <li class="caret"></li>
                            <li>
                                <a href="#">
                                    <i class="entypo-user"></i>
                                    Edit Profile
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url().'lab/keluar'?>" onclick="return true confirm('Keluar dari aplikasi ?'')">
                                    <i class="entypo-logout"></i>
                                    Keluar
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <hr />
        <div class="row">
            <?php echo $contents ?>
        </div>
        <footer class="main">
            &copy; <?php echo date("Y")?> <strong>SIMRS</strong> DOT
        </footer>
    </div>
</div>        
</body>
</html>