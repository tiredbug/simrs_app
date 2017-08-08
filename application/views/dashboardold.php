<!DOCTYPE html>
<html>
<head>
	<title>PORTAL SIMRS DR FAUZIAH BIREUEN</title>


	<link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/dashboard.css">

	<!-- javascript -->
	<script src="<?php echo base_url()?>template/neon/js/jQuery-2.1.4.min.js"></script>
	<script src="<?php echo base_url()?>template/plugin/backstretch/jquery.backstretch.min.js"></script>

	<style type="text/css">
		
	</style>
</head>
<body>
	<div class="container dashboard">
		<div class="list-box col-sm-12">
			<div class="col-sm-3 item">
				<a href="<?php echo base_url().'pendaftaran'?>">
					<img src="template/assets/img/iconpendaftaran.png"/>
					<h3 class="title">PENDAFTARAN</h3>
					<span class="deskripsi">
						
					</span>
				</a>
			</div>
			
			<div class="col-sm-3 item">
				<a href="<?php echo base_url().'rajal'?>">
					<img src="template/assets/img/iconrajal.png"/>
					<h3 class="title">PELAYANAN POLIKLINIK</h3>
					<span class="deskripsi">
					
					</span>
				</a>
			</div>
			
			<div class="col-sm-3 item">
				<a href="<?php echo base_url().'lab'?>">				
					<img src="template/assets/img/lab.png"/>
					<h3 class="title">LABORATURIUM</h3>
					<span class="deskripsi">
						
					</span>
				</a>
			</div>
			
			<div class="col-sm-3 item">
				<a href="<?php echo base_url().'kasirrajal'?>">
					<img src="template/assets/img/kasir.png"/>
					<h3 class="title">KASIR RAWAT JALAN</h3>
					<span class="deskripsi">
					</span>
				</a>
			</div>
			
		</div>

	</div>
	<script type="text/javascript">
		$.backstretch([
        "template/assets/img/1.png",
        "template/assets/img/2.jpg",
        "template/assets/img/3.png",
        "template/assets/img/4.png",
        ], {
          fade: 5000,
          duration: 3000
    }
    )

	</script>
</body>
</html>