
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />

	<link rel="icon" href="assets/images/favicon.ico">

	<title>SIMRS - DR FAUZIAH KAB. BIREUEN</title>

	<link rel="stylesheet" href="<?php echo base_url().'template/neon'?>/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="<?php echo base_url().'template/neon'?>/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="<?php echo base_url().'template/neon'?>/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url().'template/neon'?>/css/neon-core.css">
	<link rel="stylesheet" href="<?php echo base_url().'template/neon'?>/css/neon-theme.css">
	<link rel="stylesheet" href="<?php echo base_url().'template/neon'?>/css/neon-forms.css">
	<link rel="stylesheet" href="<?php echo base_url().'template/neon'?>/css/custom.css">
	<link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/font-icons/font-awesome/css/font-awesome.min.css">

	<script src="<?php echo base_url().'template/neon'?>/js/jquery-1.11.3.min.js"></script>

	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>
<body class="page-body">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
	

	<div class="main-content">
				
		<div class="container">
		
		<h3>DASHBOARD MODUL SIMRS DR FAUZIAH KABUPATEN BIREUEN</h3>
		
		</div>

		<div class="container">
		<div class="row">
			<div class="col-sm-3">
			
				<div class="tile-title tile-primary">
					
					<div class="icon">
						<i class="glyphicon glyphicon-pencil"></i>
					</div>
					<a href="<?php echo base_url()?>pendaftaran" title='Klik disini untuk buka module pendaftaran.'>
						<div class="title">
							<h3>PENDAFTARAN</h3>
							<p>module pendaftaran semua jenis kunjungan pasien...</p>
						</div>
					</a>
				</div>
				
			</div>
			
			<div class="col-sm-3">
			
				<div class="tile-title tile-red">
					
					<div class="icon">
						<i class="glyphicon glyphicon-cd"></i>
					</div>
					<a href="<?php echo base_url()?>rajal" title="Klik disini untuk buka module pelayanan rawat jalan.">
						<div class="title">
							<h3>PELAYANAN RAWAT JALAN</h3>
							<p>catat setiap proses pada pelayanan poliklinik rawat jalan...</p>
						</div>
					</a>
				</div>
				
			</div>
			
			<div class="col-sm-3">
			
				<div class="tile-title tile-blue">
					
					<div class="icon">
						<i class="glyphicon glyphicon-glass"></i>
					</div>
					<a href="<?php echo base_url()?>e-lab" title="Klik disini untuk buka module instalasi laboraturium.">
						<div class="title">
							<h3>INSTALASI LABORATURIUM</h3>
							<p>catat pemeriksaan laboraturium pasien, orderan pemeriksaan dari instalasi lain...</p>
						</div>
					</a>
				</div>
				
			</div>
			
			<div class="col-sm-3">
			
				<div class="tile-title tile-aqua">
					
					<div class="icon">
						<i class="glyphicon glyphicon-object-align-bottom"></i>
					</div>
					<a href="<?php echo base_url()?>gudangobat" title="Klik disini untuk membuka modul gudang farmasi.">
						<div class="title">
							<h3>GUDANG FARMASI</h3>
							<p>kelola barang farmasi masuk, keluar dan return & kontrol stok, expired day...</p>
						</div>
					</a>
				</div>
				
			</div>
		</div>
		
		<br />
		
		<div class="row">
			<div class="col-sm-3">
			
				<div class="tile-title tile-purple">
					
					<div class="icon">
						<i class="glyphicon glyphicon-random"></i>
					</div>
					<a href="<?php echo base_url()?>e-depo" title="Klik disini untuk membuka modul gudang farmasi.">
						<div class="title">
							<h3>DEPO FARMASI</h3>
							<p>Pencatatan pendistribusian barang instalasi farmasi untuk pasien...</p>
						</div>
					</a>
				</div>
				
			</div>

			<div class="col-sm-3">
			
				<div class="tile-title tile-cyan">
					
					<div class="icon">
						<i class="glyphicon glyphicon-object-align-vertical"></i>
					</div>
					<a href="<?php echo base_url()?>kasirrajal" title="Klik disini untuk membuka modul kasir rawat jalan.">
						<div class="title">
							<h3>KASIR RAJAL</h3>
							<p>checkout kunjungan rawat jalan, buat billing dan keterangan rawat jalan...</p>
						</div>
					</a>
				</div>
				
			</div>


			<div class="col-sm-3">
			
				<div class="tile-title tile-orange">
					
					<div class="icon">
						<i class="entypo-cc-nd"></i>
					</div>
					<a href="<?php echo base_url()?>igd" title="Klik disini untuk membuka modul igd.">
						<div class="title">
							<h3>IGD</h3>
							<p>Modul instalasi gawat darurat.<br/>kelola data pasien dan kunjungan</p>
						</div>
					</a>
				</div>
				
			</div>


			<div class="col-sm-3">
			
				<div class="tile-title tile-primary">
					
					<div class="icon">
						<i class="fa fa-bed"></i>
					</div>
					<a href="<?php echo base_url()?>coranap" title="Klik disini untuk membuka modul central opname rawat inap.">
						<div class="title">
							<h3>CO - RANAP</h3>
							<p>Modul central opname rawat inap.<br/>kelola pasien rawat inap</p>
						</div>
					</a>
				</div>
				
			</div>


		</div>
		
		<footer class="main">
			
			&copy; <?php echo date("Y")?> <strong>RSUD DR FAUZIAH BIREUEN</strong> Create By <a href="#" >Munazar</a>
		
		</footer>
	</div>

		
	<div id="chat" class="fixed" data-current-user="Art Ramadani" data-order-by-status="1" data-max-chat-history="25">
	
		<div class="chat-inner">
	
	
			<h2 class="chat-header">
				<a href="#" class="chat-close"><i class="entypo-cancel"></i></a>
	
				<i class="entypo-users"></i>
				Chat
				<span class="badge badge-success is-hidden">0</span>
			</h2>
	
	
		</div>
	
		<!-- conversation template -->
		<div class="chat-conversation">
	
			<div class="conversation-header">
				<a href="#" class="conversation-close"><i class="entypo-cancel"></i></a>
	
				<span class="user-status"></span>
				<span class="display-name"></span>
				<small></small>
			</div>
	
			<ul class="conversation-body">
			</ul>
	
			<div class="chat-textarea">
				<textarea class="form-control autogrow" placeholder="Type your message"></textarea>
			</div>
	
		</div>
	
	</div>
	
	
	
	
	<!-- Chat Histories -->
	<ul class="chat-history" id="sample_history_2">
		<li class="opponent unread">
			<span class="user">Daniel A. Pena</span>
			<p>I am going out.</p>
			<span class="time">08:21</span>
		</li>
	
		<li class="opponent unread">
			<span class="user">Daniel A. Pena</span>
			<p>Call me when you see this message.</p>
			<span class="time">08:27</span>
		</li>
	</ul>

	
</div>





	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="assets/js/jvectormap/jquery-jvectormap-1.2.2.css">

	<!-- Bottom scripts (common) -->
	<script src="assets/js/gsap/TweenMax.min.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>


	<!-- Imported scripts on this page -->
	<script src="assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
	<script src="assets/js/neon-chat.js"></script>


	<!-- JavaScripts initializations and stuff -->
	<script src="assets/js/neon-custom.js"></script>


	<!-- Demo Settings -->
	<script src="assets/js/neon-demo.js"></script>

</body>
</html>