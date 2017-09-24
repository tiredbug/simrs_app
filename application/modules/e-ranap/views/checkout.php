<div class="col-sm-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title bold">
				<i class="entypo-export"></i> Checkout kunjungan ruangan
			</div>
		</div>

		<div class="panel-body">
			<div class="row">
				<div class="col-sm-7">
					<form class="form-horizontal form_checkout">
						<div class="form-group">
							<label class="control-label col-sm-3">No. MR :</label>
							<div class="col-sm-9">
								<input type="text" name="nrm" class="form-control nrm" autofocus="">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3">Nama Lengkap :</label>
							<div class="col-sm-9">
								<input type="text" name="nama" class="form-control nama">
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-sm-3">Jenis Kelamin :</label>
							<div class="col-sm-9">
								<select class="form-control jk" name="jk">
									<option value=""></option>
									<option value="Laki-Laki">Laki-laki</option>
									<option value="Perempuan">Perempuan</option>
								</select>
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-sm-3">Tgl Masuk :</label>
							<div class="col-sm-9">
								<input type="text" name="tgl_masuk" class="form-control datepicker tgl_masuk" data-format='yyyy-mm-dd'>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3">Jam Masuk :</label>
							<div class="col-sm-9">
								<input type="text" class="form-control timepicker jam_masuk" data-template="dropdown" data-show-seconds="true" data-show-meridian="false" data-minute-step="5" data-second-step="5"  id="jam_masuk" name="jam_masuk" /> 
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3">Tgl Keluar :</label>
							<div class="col-sm-9">
								<input type="text" name="tgl_keluar" class="form-control tgl_keluar datepicker" data-format='yyyy-mm-dd' value="<?php echo date("d-m-Y")?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3">Jam Keluar :</label>
							<div class="col-sm-9">
								<input type="text" class="form-control timepicker jam_keluar" data-template="dropdown" data-show-seconds="true" data-show-meridian="false" data-minute-step="5" data-second-step="5"  id="jam_keluar" name="jam_keluar" /> 
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-sm-3">Cara Keluar :</label>
							<div class="col-sm-9">
								<select class="form-control cara_keluar" name="cara_keluar">
									<option value="">-- Pilih --</option>
									<?php
									foreach ($s_k->result() as $s) {
									 	# code...
									 	echo "<option value='".$s->kode_stt."'>".$s->stt."</option>";
									 } 
									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-4 col-sm-offset-3">
								<button class="btn btn-blue btn-icon icon-right btn_checkout" type="button"><i class='fa fa-external-link'></i> Checkout</button>
							</div>
						</div>

					</form>
				</div>

				<div class="col-sm-5 hidden-sm">
					<div class="row">
						<div class="col-sm-12">
							<img src="<?php echo base_url()?>template/assets/img/checkout.png" width='100%'>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="well well-sm">
								<p><b>Note :</b></p>
								<p>Berikan informasi pasien checkout dari ruangan untuk membantu aplikasi dalam membuat laporan / sensus kunjungan ruangan.</p>
								<p>Untuk pasien yang dipindahkan ke ruangan lain, tidak perlu diberikan informasi checkout karena sistem secara otomatis melakukan checkout pasien dan mencatat informasi checkout <b>pindah ruangan.</b></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script src="<?php echo base_url()?>template/neon/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url()?>template/neon/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript">
	$(".nrm").keypress(function(e){
		if(e.which==13)
		{
			if($(this).val()=='')
			{
				$(this).focus();
				toastr.warning('Masukkan nomor rekam medis.')
			}
			else
			{
				$.ajax({
					type:'post',
					url:base_url+'e-ranap/checkout/get_i_kunjungan',
					data:'nrm='+$('.nrm').val(),
					dataType:'json',
					success:function(json)
					{
						if(json.success)
						{
							$(".nama").val(json.data.nama);
							$(".jk").val(json.data.jk);
							$(".tgl_masuk").val(json.data.tgl_masuk);
							$(".jam_masuk").val(json.data.jam_masuk);
						}
						else
						{
							$(".nrm").val('').focus();
							$(".nama").val('');
							$(".jk").val('');
							$(".tgl_masuk").val('');
							$(".jam_masuk").val('');
							toastr.error(json.pesan_err);
						}
					}
				})
			}
		}
	})
	$(".btn_checkout").click(function(){
		swal({
			title:'Checkout ?',
			text:'setelah checkout data kunjungan tidak dapat diproses lagi, lanjut ?',
			type:'warning',
			cancelButtonText:'Batal',
			showCancelButton:true,
			confirmButtonText:'Proses checkout',
			closeOnConfirm:false,
            showLoaderOnConfirm: true,
            confirmButtonColor:"#21a9e1",
		},function(){
			var $this=$(this);
			$this.prop('disabled',true);
			$.ajax({
				type:'post',
				url:base_url+'e-ranap/checkout/proses_checkout',
				data:$(".form_checkout").serialize(),
				dataType:'json',
				success:function(json)
				{
					$this.prop('disabled',false);
					if(json.success)
					{
						$(".form-group").removeClass('has-error')
	                                    .removeClass('has-success');
	                    $(".text-danger").remove();
	                    swal({
	                        title:'Berhasil',
	                        text:'perekaman informasi checkout kunjungan berhasil.',
	                        type:'success'
	                    })
	                    $('.form_checkout').trigger('reset');
					}
					else
					{
						$.each(json.message,function(i,val){
							var el=$("."+i);
	                        el.closest('div.form-group')
	                        .removeClass('has-error')
	                        .addClass(val.length > 0 ? 'has-error':'has-success')
	                        .find('.text-danger').remove();
	                        el.after(val)
						})
						swal({
							title:'Gagal',
							text:'gagal chekcout kunjungan, periksa kembali data inputan.',
							type:'error'
						})
					}
				}
			})
		})
		
	})
</script>
