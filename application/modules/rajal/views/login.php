<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="SIMRS" />
	<meta name="author" content="" />

	<link rel="icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/login.css">
    <link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/font-icons/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>template/neon/css/font-icons/entypo/css/entypo.css">

	<title>Login - Rawat Jalan</title>
    
</head>
<body>
    <div class="container">
        <div class="panel">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-4 logo-rs">
                        <a href="<?php echo base_url()?>">
                            <img class="" src="<?php echo base_url()?>template/neon/images/logo-jadi.jpg"/>
                        </a>
                    </div>
                    <div class="col-sm-8 keterangan">
                        <span class="app">
                            SIMRS - Pelayanan Rawat Jalan
                        </span>
                        <br>
                        <span class="namars">
                            <?php echo $nama_rs['value_profile']?>
                        </span>
                        <br>
                        <span class="alamatrs">
                            Alamat : <?php echo $alamat_rs['value_profile']?>
                        </span>
                        <br>
                        <span class="alamatrs">
                            Tlf : <?php echo $tlf_rs['value_profile']?>, Fax : <?php echo $fax_rs['value_profile']?>
                        </span>
                        
                        <hr/>
                        <span class="pt">
                            Distr license valid to <?php echo date("Y")?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <form action="" method="post" class="form-login">
                    <div class="form-group">
                        <label class="control-label col-sm-12">Username</label>
                        <div class="col-sm-12">
                            <input type="username" name="username" class="form-control" placeholder="Ketikkan username..."/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-12">Password</label>
                        <div class="col-sm-12">
                            <input type="password" name="password" class="form-control" placeholder="Ketikkan password..."/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" name="login" class="col-sm-2 pull-right btn btn-block btn-login">Sign In <i class="entypo-login"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-footer">
                <img src="<?php echo base_url()?>template/neon/images/login.jpg"/>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url()?>template/neon/js/jQuery-2.1.4.min.js"></script>
    <script>
        $('.form-login').submit(function(e){
            e.preventDefault();
            loading();
            var form_data=$(".form-login").serialize();
            $.ajax({
                type:"POST",
                url:'<?php echo base_url()?>rajal/login/login_auth',
                data:form_data,
                dataType:"JSON",
                error:function(xhr, desc, err)
                {
                    alert('Gagal autentication login ke server');
                    no_loading()
                },
                success:function(json)
                {
                    if(json.success)
                    {
                        window.location.href='<?php echo base_url().'rajal/home'?>';
                    }
                    else
                    {
                        alert(json.pesan_err)
                        no_loading()
                    }
                }
            })
        })
        function loading()
        {
            $(".btn-login").html("<i class='fa fa-spinner fa-spin'></i> <b>Proses login...</b>");
        }

        function no_loading()
        {
            $(".btn-login").html("Sign In <i class='entypo-login'></i>");
        }
    </script>
</body>
</html>