<style type="text/css">
	.form-horizontal .checkbox{
		float: left;
		padding-top: 6px;
	}
	.form-horizontal .checkbox label{
		font-weight: bold;
	}
	.checkbox input[type="checkbox"]
	{
		margin-left: -15px;
	}
</style>
<div class="panel panel-warning konten" style="position: static; zoom: 1;">
	<div class="panel-heading">
		<div class="panel-title">
			<i class="entypo-bookmarks"></i> FORM REGISTRASI KUNJUNGAN 
		</div>
		<div class="panel-options">
			<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
	        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
	        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
	        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
		</div>
	</div>
	<div class="panel-body body-form-gue">
		<form class="form-data">
		<input type="hidden" name="no_kunjungan" id="no_kunjungan">
		<table class="table  table-hover table-form nomargin-bottom">
			<tbody>
				<tr>
    				<th class="label-tabel" style="width: 35%">Nomor Rekam Medis</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="padding:0px;padding-left: 5px;padding-top: 2px; ">
    					<div class="col-sm-3 nopadding">
    						<input type="text" class="form-control input-sm" name="nrm" id="nrm" autofocus="">
    					</div>
    				</th>
    			</tr>
    			<tr>
    				<th class="label-tabel" style="width: 35%">Nama Lengkap</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="font-weight: bold;" id="nama"></th>
    			</tr>
    			<tr>
    				<th class="label-tabel" style="width: 35%">No. Nik / Asuransi</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="font-weight: bold;" id="card"></th>
    			</tr>
    			<tr>
    				<th class="label-tabel" style="width: 35%">Alamat Lengkap</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="font-weight: bold;" id="alamat"></th>
    			</tr>
    			<tr>
    				<th class="label-tabel" style="width: 35%">Unit dan Dokter Pengirim</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="padding:0px;padding-left: 5px;padding-top: 2px; ">
    					<div class="col-sm-5 nopadding">
    						<input type="text" class="form-control input-sm" name="unit_pengirim" id="unit_pengirim">
    					</div>
    					<div class="col-sm-4 ">
    						<select class="select2" name="dokter_pengirim" id="dokter_pengirim">
    						<?php 
    						foreach ($dokter->result() as $d) {
    							# code...
    							echo"<option value='".$d->kode_dokter."'>".$d->nama_belakang.' '.$d->nama_dokter.', '.$d->gelar."</option>";
    						}
    						?>
    						</select>
    					</div>
    				</th>
    			</tr>
    			<tr>
    				<th class="label-tabel" style="width: 35%">Tgl dan Jam Periksa</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="padding:0px;padding-left: 5px;padding-top: 2px; ">
    					<div class="col-sm-5 nopadding">
    						<div class="input-group">
	                            <input type="text" class="form-control input-sm datepicker" name="tgl_kirim" id="tgl_kirim" data-format="dd-mm-yyyy" value="<?php echo date("d-m-Y")?>">
	                            <div class="input-group-addon">
	                                <a href="#"><i class="entypo-calendar"></i></a>
	                            </div>
                        	</div>
    					</div>
    					<div class="col-sm-4 ">
    						<div class="input-group">
								<input type="text" class="form-control timepicker" data-template="dropdown" data-show-seconds="true" data-default-time="<?php echo date("H:i:s")?>" data-show-meridian="false" data-minute-step="5" data-second-step="5"  name="jam_kirim" id="jam_kirim">		
								<div class="input-group-addon">
								    <a href="#"><i class="entypo-clock"></i></a>
								</div>
							</div>
    					</div>
    				</th>
    			</tr>
    			<tr>
    				<th class="label-tabel" style="width: 35%">Dokter dan Perawat P.Jawab</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="padding:0px;padding-left: 5px;padding-top: 2px; ">
    					<div class="col-sm-5 nopadding">
    						<select class="select2" name="dokter_p" id="dokter_p">
    						<?php 
    						foreach($dokter_lab->result() as $dl)
    						{
    							echo"<option value='".$dl->kode_dokter."'>".$dl->nama_lengkap."</option>";
    						}
    						?>
    						</select>
    					</div>
    					<div class="col-sm-4 ">
    						<select class="select2" name="petugas" id="petugas">
    						<?php 
    						foreach($petugas->result() as $p)
    						{
    							echo"<option value='".$p->kode_petugas."'>".$p->nama_petugas."</option>";
    						}
    						?>
    						</select>
    					</div>
    				</th>
    			</tr>
			</tbody>
		</table>
		</form>
	</div>
	<div class="panel-heading">
		<div class="panel-title">
			<i class="entypo-export"></i> LIST PEMERIKSAAN
		</div>
	</div>
	<div class="panel-body body-form-gue">
		<form class="form_orderan_lab form-horizontal">
           	<div class="col-sm-12 nopadding" style="padding-top: 2px;padding-left: 2px;margin-bottom: 0px">
            	<div class="tabs-vertical-env" style="margin-bottom: 0px;border-bottom: 1px solid #DDD">
            		<ul class="nav tabs-vertical">
                    <?php   
                    $no=1;
                    foreach ($klp_lab->result() as $klp) {
                    	# code...
                        $clas=$no==1?'active':'';
                        echo "<li class='".$clas." '>
                        		<a href='#tab-".$no."' data-toggle='tab' aria-expanded='true' style='font-weight:bold'>
                                	".$klp->klp_produk."
                                </a>
                            </li>";
                        $no++;
                    }
                    ?>
                    </ul>
                    <div class="tab-content">
                    <?php 
                    $no=1;
                    foreach($klp_lab->result() as $tb )
                    {
                        $clas=$no==1?'active':'';
                        echo"<div class='tab-pane ".$clas."' id='tab-".$no."' style=''>";
                    	    foreach($this->m_master->get_dataproduklab($tb->klp_produk)->result() as $pl)
                        	{
                        		echo"<div class='col-sm-4'>";
                        		echo"<div class='checkbox'>
										<label>
											<input type='checkbox' name='list[]' value='".$pl->kode_produk."'>".$pl->nama_produk."
										</label>
									</div>";
								echo"</div>";
                                // echo "<input type='checkbox' name='list[]' value='".$pl->kode_produk."' class='checklist'/>
                                // <label class='label-checkbox'>".$pl->nama_produk.'</label>';
                            }
                        echo"</div>";
                        $no++;
                    }
                    ?>
                    </div>
            	</div>
            </div>
        </form>
	</div>
	<div class="panel-heading">
		<div class="pull-right" style="margin:5px">
	        <button type="button" class="btn btn-danger btn-cancel">Cancel</button>
	        <button type='button' class="btn btn-success btn-register">Register</button>
	    </div>
	</div>
</div>
<script src="<?php echo base_url()?>template/neon/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url()?>template/neon/js/bootstrap-timepicker.min.js"></script>

<script type="text/javascript">
	
	$(".btn-cancel").click(function(){
		$(".form_orderan_lab").trigger('reset');
		$(".form-data").trigger('reset');
	})
	$(".btn-register").click(function(){
		$(this).html("<i class='fa fa-spinner fa-spin'></i> Proses registrasi...").addClass('disabled');
		var e=confirm("Semua data sudah benar ?");
		if(e)
		{
			loading_show();
			var form_orderan_lab=$(".form_orderan_lab").serialize();
			var form_data=$(".form-data").serialize();
			if(form_orderan_lab.length=='')
			{
				alert('Pilih minimal satu pemeriksaan.');
				loading_hide();
				$(".btn-register").html("Register").removeClass('disabled');
			}
			else
			{
				$.ajax({
					type:"POST",
					url:base_url+'lab/register_api/register',
					data:form_data+'&'+form_orderan_lab,
					dataType:'json',
					error:function()
					{
						alert('Gagal terhubung ke server.');
						loading_hide();
						$(".btn-register").html("Register").removeClass('disabled');
					},
					success:function(json)
					{
						if(json.success)
						{
							$(".form_orderan_lab").trigger('reset');
							$(".form-data").trigger('reset');
							alert("Berhasil daftar kunjungan lab.");
							$("#nrm").focus();
							$("#nama").html('')
							$("#card").html('')
							$("#alamat").html('')
							$("#no_kunjungan").val('')
						}
						else
						{
							alert(json.pesan_err)
						}
						loading_hide();
						$(".btn-register").html("Register").removeClass('disabled');
					}
				})
			}
		}
		else
		{
			$(".btn-register").html("Register").removeClass('disabled');
		}

	})
	$("#nrm").keypress(function(e){
		if(e.which=='13')
		{
			loading_show();
			var nrm=$(this).val();
			$.ajax({
				type:'post',
				url:base_url+'lab/register_api/validasi_norek',
				data:'nrm='+nrm,
				dataType:'json',
				error:function()
				{
					alert('Gagal terhubung ke server.');
					loading_hide();
				},
				success:function(json)
				{
					if(json.success)
					{
						$("#nama").html(json.data.nama)
						$("#card").html(json.data.card)
						$("#alamat").html(json.data.alamat)
						$("#no_kunjungan").val(json.data.no_kunjungan)
						$("#unit_pengirim").focus();
					}
					else
					{
						alert(json.pesan_err);
						$("#nrm").val('')
						$("#nama").html('')
						$("#card").html('')
						$("#alamat").html('')
						$("#no_kunjungan").val('')
					}
					loading_hide();
				}
			})
		}
	})
	function loading_show()
	{
		var $this=$('.panel');
		blockUI($this);
		$this.addClass('reloading')

	}
	function loading_hide()
	{
		var $this=$('.panel');
		unblockUI($this);
		$this.removeClass('reloading')

	}
</script>