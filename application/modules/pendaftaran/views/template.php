<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="SIMRS" />
	<meta name="author" content="" />

	<link rel="icon" href="assets/images/favicon.ico">

	<title>SIMRS</title>
        
        <!--File css--> 
	<link rel="stylesheet" href="<?php echo base_url()?>template/neon/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/font-icons/font-awesome/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/neon-core.css">
	<link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/neon-theme.css">
	<link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/neon-forms.css">
	<link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url()?>template/neon/js/datatables/datatables.css">
    <link rel="stylesheet" href="<?php echo base_url()?>template/neon/js/select2/select2-bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url()?>template/neon/js/select2/select2.css">
    <!-- sweet alert plugin css file -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>template/plugin/sweetalert/dist/sweetalert.css">
    <!-- end -->


    <!--file javascript-->
	<script src="<?php echo base_url()?>template/neon/js/jQuery-2.1.4.min.js"></script>
        
	<!-- Bottom scripts (common) -->
	<script src="<?php echo base_url()?>template/neon/js/gsap/TweenMax.min.js"></script>
	<script src="<?php echo base_url()?>template/neon/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	
        
        
    <script src="<?php echo base_url()?>template/neon/js/datatables/datatables.js"></script>
    <script src="<?php echo base_url()?>template/neon/js/select2/select2.min.js"></script>
    <script src="<?php echo base_url()?>template/neon/js/bootstrap.js"></script>
	<script src="<?php echo base_url()?>template/neon/js/joinable.js"></script>
	<script src="<?php echo base_url()?>template/neon/js/resizeable.js"></script>
    <script src="<?php echo base_url()?>template/neon/js/neon-api.js"></script>

	<!-- JavaScripts initializations and stuff -->
	<script src="<?php echo base_url()?>template/neon/js/neon-custom.js"></script>
	<!-- Demo Settings -->
	<script src="<?php echo base_url()?>template/neon/js/neon-demo.js"></script>
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
                    <a href="<?php echo base_url().'pendaftaran'?>">
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
                    <a href="<?php echo base_url().'pendaftaran'?>">
                        <i class="entypo-home"></i>
                        <span class="title">Home</span>
                    </a>
                </li>
                <li class="has-sub">
                    <a href="">
                        <i class="entypo-users"></i>
                        <span class="title">Pasien</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo base_url().'pendaftaran/pasien/register'?>">
                                <span class="title">Pasien Baru</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'pendaftaran/pasien/database'?>">
                                <span class="title">Database Pasien</span>
                            </a>
			             </li>
                    </ul>
                </li>
                
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-monitor"></i>
                        <span class="title">Pendaftaran</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo base_url().'pendaftaran/register/rajal'?>">
                                <span class="title">Rawat Jalan</span>
                            </a>
                        </li>
                      <!--   <li>
                            <a href="<?php echo base_url().'pendaftaran/register/igd'?>">
                                <span class="title">IGD</span>
                            </a>
			            </li> -->
                        <!-- <li>
                            <a href="<?php echo base_url().'pendaftaran/register/laboraturium'?>">
                                <span class="title">Laboraturium</span>
                            </a>
			            </li> -->
                        
                        
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="index.html">
                        <i class="entypo-folder"></i>
                        <span class="title">Informasi Kunjungan</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo base_url().'pendaftaran/informasi/rajal'?>">
                                <span class="title">Rawat Jalan</span>
                            </a>
                        </li>

                        <!-- <li>
                            <a href="<?php echo base_url().'pendaftaran/informasi/laboraturium'?>">
                                <span class="title">Laboraturium</span>
                            </a>
                        </li> -->
                        
                    </ul>
                </li>

                <li class="has-sub">
                    <a href="index.html">
                        <i class="entypo-clock"></i>
                        <span class="title">Jadwal Dokter</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo base_url().'pendaftaran/jadwaldokter/rajal'?>">
                                <span class="title">Rawat Jalan</span>
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
                            <a href="#modal-profile" data-toggle="modal" >
                                <span class="title">Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'pendaftaran/Keluar'?>" )>
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
                            <?php echo $this->session->userdata('nama')?>
			            </a>
                        <ul class="dropdown-menu">
                            <li class="caret"></li>
                            <li>
                                <a href="#modal-profile" data-toggle="modal" >
                                    <i class="entypo-user"></i>
                                    Edit Profile
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url().'pendaftaran/Keluar'?>" onclick="return true confirm('Keluar dari aplikasi ?'')">
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
            &copy; <?php echo date("Y")?> <strong>SIMRS</strong> Desaind by <a href="https://www.facebook.com/munazarsaifannur" target="_blank">BRAIND</a>
        </footer>
    </div>
</div>        
</body>


<!-- modal ganti manage profile  -->
<div class="modal invert fade in" id="modal-profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <H4 class="modal-title bold">
                    
                </H4>
            </div>
            <div class="modal-body">
            <form class="form-horizontal form-profile">

                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                        <img src="<?php echo base_url()?>template/assets/img/header-setting-password.png" width="100%">
                        <h4 class="title bold text-center"><i class="entypo-tools"></i> EDIT PROFILE</h4>
                        <hr>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label col-sm-3 bold">Username :</label>
                            <div class="col-sm-9">
                                <input type="text" name="username" class="form-control" value="<?php echo $this->session->userdata('username')?>" disabled=''>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3 bold">Nama Lengkap :</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" class="form-control" placeholder="Ketikkan nama lengkap..." value="<?php echo $this->session->userdata('nama')?>">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-sm-3 bold">Password Lama :</label>
                            <div class="col-sm-9">
                                <input type="password" name="passl" class="form-control" placeholder="Ketikkan password lama...">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3 bold">Password Baru :</label>
                            <div class="col-sm-9">
                                <input type="password" name="passb" class="form-control" placeholder="Ketikkan password baru...">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3 bold">Ulangi Password :</label>
                            <div class="col-sm-9">
                                <input type="password" name="passbr" class="form-control" placeholder="Ulangi password baru...">
                            </div>
                        </div>
                        <hr>

                    </div>
                </div>
                
            </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">Batal</button>
                <button class="btn btn-success updatep">Simpan profile</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal  -->

<script type="text/javascript">
    $(".updatep").click(function()
    {
        var $this=$(this);
        $this.html("<i class='fa fa-spin fa-spinner'></i> Menyimpan perubahan....").prop("disabled",true);

        disabled_form();

        var data=$(".form-profile").serialize();
        $.ajax({
            type:"POST",
            url:base_url+'pendaftaran/home/update_profile',
            data:data,
            dataType:'json',
            error:function()
            {
                toastr.error("Gagal terhubung ke server.");
                enabled_form();
                $this.html("Simpan profile").prop("disabled",false);
            },
            success:function(json)
            {
                if(json.success)
                {
                    toastr.info("Profile berhasil diperbaharui. silahkan logout dan login kembali untuk melihat perubahan.");
                    enabled_form();
                    $this.html("Simpan profile").prop("disabled",false);
                    $("#modal-profile").modal("hide");
                }
                else
                {
                    toastr.error(json.pesan_err)
                    enabled_form();
                    $this.html("Simpan profile").prop("disabled",false);
                }
            }
        })
    })

    function disabled_form()
    {
        var $this=$(".modal-body")
        blockUI($this);
        $this.addClass('reloading')
    }

    function enabled_form()
    {
        var $this=$(".modal-body")
        unblockUI($this);
        $this.removeClass('reloading')
    }
</script>
</html>