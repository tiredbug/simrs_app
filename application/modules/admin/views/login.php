<!DOCTYPE html>
<html style="" class=" js csstransforms3d">
	<head>
		<title>Login | Administrator Rumah Sakit Umum Daerah dr. Fauziah</title>
		<link href="<?php echo base_url()?>template/assets/css/login.css" rel="stylesheet" type="text/css">
		<link href="icon.png" rel="shortcut icon" type="image/x-icon">
		<script src="<?php echo base_url()?>template/assets/js/modernizr.js" type="text/javascript" style=""></script>
		<link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/font-icons/font-awesome/css/font-awesome.min.css">
		<script src="<?php echo base_url()?>template/neon/js/jQuery-2.1.4.min.js"></script>
		<script type="text/javascript">
			var base_url='<?php echo base_url()?>';
		</script>
	</head>
	<body>
		<div class="smooth-overflow">
			<div class="main-wrap">
				<div class="center-block">
					<div class="login-block">
						<form action="<?php echo base_url().'admin/login/auth'?>" class="orb-form" id="login-form" name="login-form" method="POST">
							<header>
								<div class="image-block">
									<a href="<?php echo base_url()?>">
										<img alt="User" src="<?php echo base_url().'template/assets/img/logo.jpg'?>">
									</a>
								</div>
								Administrator
							</header>
							<fieldset>
								<section>
									<div class="row">
										<div class="col col-12">
											<label class="input"><i class="icon-append fa fa-user"></i> <input name="username" required="" type="text" placeholder="Username"></label>
										</div>
									</div>
								</section>
								<section>
									<div class="row">
										<div class="col col-12">
											<label class="input"><i class="icon-append fa fa-lock"></i> <input name="password" required="" type="password" placeholder="Password"></label>
										</div>
									</div>
								</section>
							</fieldset>
							<footer>
								<button class="btn btn-default btn-login" type="submit" name="login">Log in <i class='fa fa-power-off'></i></button>
							</footer>
						</form>
					</div>	
				</div>
			</div>
		</div>	
	</body>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#login-form").submit(function(e){
				e.preventDefault();
				var data=$(this).serialize();
				$(".btn-login").html("<i class='fa fa-spin fa-spinner'></i> Autentikasi login...").prop('disabled',true);
				$.ajax({
					type:'post',
					url:$("#login-form").attr('action'),
					data:data,
					dataType:'json',
					error:function(){
						alert('Koneksi ke server terputus, coba lagi.');
						$(".btn-login").html("Log in <i class='fa fa-power-off'></i>").prop('disabled',false);
					},
					success:function(respon)
					{
						if(respon.success)
						{
							window.location.href=base_url+'admin/home';
						}
						else
						{
							alert('Login gagal, coba lagi.')
							$(".btn-login").html("Log in <i class='fa fa-power-off'></i>").prop('disabled',false);
						}
					}
				})
			})
		})
	</script>
</html>