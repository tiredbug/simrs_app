
<link rel="stylesheet" href="<?php echo base_url()?>template/plugin/tabmodal/bootstrap-tab-modal.css">
<script src='<?php echo base_url()?>template/plugin/tabmodal/bootstrap-tab-modal.js' type='text/javascript' charset='utf-8'></script>
<div class="panel panel-primary konten">
	<div class="panel-heading">
		<h4 class="panel-title bold">
			<i class="entypo-users"></i> REGISTER KUNJUNGAN
		</h4>
	</div>


	<!-- panel body  -->
	<div class="panel-body">
	<form class="form-horizontal form-data">
		<div class="row">
			<input type="hidden" name="stt" id="stt" value=''>
			<input type="hidden" name="no_kunjungan" id='no_kunjungan' value=''>
			<div class="col-sm-7">
				<div class="form-group">
					<label class="control-label col-sm-3">Asal Pasien :</label>
					<div class="col-sm-9">

						<input tabindex="7" class="" type="radio"  name="asal" value='langsung' checked="">
						<label for="asal">Langsung</label>

						<input tabindex="8" class="" type="radio"  name="asal" value="igd">
						<label for="asal-1">IGD</label>

						<input tabindex="9" class="" type="radio"  name="asal" value="rajal">
						<label for="asal-1">Rawat Jalan</label>

						<input tabindex="10" class="" type="radio"  name="asal" value="inap">
						<label for="asal-1">Rawat Inap</label>

					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">No. Medrec :</label>
					<div class="col-sm-9">
						<input type="text" name="norek" class="form-control norek" autofocus="" id="norek">

					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">Tgl Permintaan :</label>
					<div class="col-sm-9">
						<div class="input-group">
                            <input type="text" class="form-control datepicker" name="tgl_permintaan" id="tgl_permintaan" data-format="dd-mm-yyyy" value='<?php echo date("d-m-Y")?>'>
                            <div class="input-group-addon">
                                <a href="#"><i class="entypo-calendar"></i></a>
                            </div>
                        </div>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">Jam :</label>
					<div class="col-sm-9">
						<div class="input-group">
                            <input type="text" class="form-control timepicker" data-template="dropdown" data-show-seconds="true" data-default-time="<?php echo date("H:i:s")?>" data-show-meridian="false" data-minute-step="5" data-second-step="5"  id="jam_daftar" name="jam_daftar" />      
                                <div class="input-group-addon">
                                    <a href="#"><i class="entypo-clock"></i></a>
                                </div>
                        </div>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">Unit Pelayanan :</label>
					<div class="col-sm-9">
						<select name="unit" class="unit form-control select2" id="unit">
							<option value=''>-- Pilih --</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">Dokter Pengirim :</label>
					<div class="col-sm-9">
						<select name="dokter" class="dokter form-control select2" id="dokter">
							<option value=''>-- Pilih --</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">Dokter Radiologi :</label>
					<div class="col-sm-9">
						<select name="dokterp" class="dokterp form-control" id="dokterp">
							<option value=''>-- Pilih --</option>
							<?php 
							foreach ($dokter->result() as $d) {
								# code...
								echo "<option value='".$d->kode."'>".$d->dokter."</option>";
							}
							?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">Petugas Register :</label>
					<div class="col-sm-9">
						<input type="text" name="petugas" class="form-control" id='petuga' value="<?php echo $this->session->userdata('nama_lengkap')?>" disabled=''>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">Pemeriksaan :</label>
					<div class="col-sm-9">
						<div class="scroll item-c">
							<button class="btn btn-sm btn-primary margin-bottom btn-browse" id="btn_modal" type="button"> Browse...</button>
							<ul class="list-produk">
								
							</ul>
						</div>
					</div>
				</div>

				<div class="form-group">
					<p class="col-sm-3 col-sm-offset-3">
						<button class="btn btn-success btn-register" type="button" disabled="">Register pemeriksaan</button>
					</p>
				</div>
			</div>

			<div class="col-sm-5">
                <div class="profile">
	                <div class="col-sm-3 col-sm-offset-4">
	                    <img src="<?php echo base_url() ?>template/neon/images/avatar5.png" alt="" class="img-circle" width="100">
	                </div>
	                <div class="row col-sm-12">
	                    <h6 class="bold"><i class='entypo-user'></i> BIODATA PASIEN</h6>
	                </div>
	                
	                <table class="table table-condesed">
	                    <tr>
	                        <th width="120">Nama Lengkap</th> 
	                        <th>:</th>
	                        <th class="nama"></th>
	                    </tr>

	                    <tr>
	                        <th>Nomor NIK</th> 
	                        <th>:</th>
	                        <th class="nik"></th>
	                    </tr>

	                    <tr>
	                        <th>Nomor Asuransi</th> 
	                        <th>:</th>
	                        <th class="as"></th>
	                    </tr>

	                    <tr>
	                        <th>Pembayaran</th> 
	                        <th>:</th>
	                        <th class="cb"></th>
	                    </tr>

	                    <tr>
	                        <th>Jenis Kelamin</th> 
	                        <th>:</th>
	                        <th class="jkel"></th>
	                    </tr>

	                    <tr>
	                        <th>Alamat</th> 
	                        <th>:</th>
	                        <th class="alamat"></th>
	                    </tr>

	                </table>
                </div>
            </div>

		</div>
	</form>
	</div>
	<!-- end panel body -->
</div>


<!-- modal produk lab -->
<div class="modal fade"  role='dialog' id="modal_radiologi">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				
			</div>

			<div class="modal-footer">
				<button class="btn btn-primary" data-dismiss='modal'>Tutup form</button>
			</div>
		</div>
	</div>
</div>

<!-- end modal -->

<script src="<?php echo base_url()?>template/neon/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url()?>template/neon/js/bootstrap-timepicker.min.js"></script>


<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		
		
	});

	$('input[name=asal]').change(function(){
		$(".unit")
		.find('option')
		.remove()
		.end()
		.append('<option value="">-- Pilih --</option>')

		$(".dokter")
		.find('option')
		.remove()
		.end()
		.append('<option value="">-- Pilih --</option>')
		$("#stt").val('')
		$(".norek").val('').focus()

	})

	$("#btn_modal").click(function(){
		if($("#stt").val()=='')
		{
			toastr.warning("Cari pasien terlebih dahulu.");
		}
		else
		{
			$('#modal_radiologi').modal('show');
		}
	})


	function loading(ket)
	{
		var $this=$('.panel');
		if(ket=='show')
		{
			blockUI($this);
			$this.addClass('reloading');
		}
		else
		{
			unblockUI($this);
			$this.removeClass('reloading');
		}
	}


	$(".norek").keypress(function(e)
	{

		var $this=$(this);
		if(e.which==13)
		{
			var asal = $('input[name=asal]:checked', '.form-data').val()
			var data=$(".form-data").serialize();
			loading('show');
			$.ajax({
				type:"POST",
				url:base_url+'radiologi/kunjungan_api/get_informasi_kunjungan',
				data:data,
				dataType:'json',
				error:function()
				{
					toastr.error('Gagal terhubung ke server.');
					loading('hide')
				},
				success:function(json)
				{
					if(json.success)
					{
						$("#stt").val('ok');
						$("#no_kunjungan").val(json.data.nomor_kunjungan)
						$(".nik").html(json.data.nomor_nik);
						$(".nama").html(json.data.nama_lengkap);
						$(".as").html(json.data.nomor_asuransi);
						$(".cb").html(json.data.nama_carabayar);
						$(".jkel").html(json.data.jenis_kelamin);
						$(".alamat").html(json.data.alamat_ktp+'<br/>Provinsi '+json.data.nama_provinsi+'<br/>Kabupaten '+json.data.nama_kota+'<br/>Kecamatan '+json.data.nama_kecamatan);
						// enable tombol register
						$(".btn-register").prop("disabled",false) 
						// end
						if(asal=='langsung')
						{
							$(".unit")
							.find('option')
							.remove()
							.end()
							.append('<option value="langsung">Langsung</option>')
							$(".dokter")
							.find('option')
							.remove()
							.end()
							.append('<option value="langsung">Langsung</option>')
							
						}

						if(asal=='igd')
						{
							$(".unit")
							.find('option')
							.remove()
							.end()
							.append('<option value="igd">igd</option>')
							$(".dokter")
							.find('option')
							.remove()
							.end()
							.append("<option value='"+json.dokter_igd['kode']+"'>"+json.dokter_igd['dokter']+"</option>")
							
						}

						if(asal=='rajal')
						{
							$(".unit")
							.find('option')
							.remove()
							.end()
							.append('<option value="">-- Pilih --</option>')
							$.each(json.data.unit,function(i,v){
								$(".unit").append("<option value="+v.id+">Poliklinik "+v.unit+"</option>")
							})


							$(".dokter")
							.find('option')
							.remove()
							.end()
							.append('<option value="">-- Pilih --</option>')
							$.each(json.data.dokter,function(i,v){
								$(".dokter").append("<option value="+v.kode+">"+v.dokter+"</option>")
							})
						}

						if(asal=='inap')
						{
							$(".unit")
							.find('option')
							.remove()
							.end()
							.append('<option value="">-- Pilih --</option>')
							$.each(json.data.unit,function(i,v){
								$(".unit").append("<option value="+v.id+">"+v.unit+"</option>")
							})


							$(".dokter")
							.find('option')
							.remove()
							.end()
							.append('<option value="">-- Pilih --</option>')
							$.each(json.data.dokter,function(i,v){
								$(".dokter").append("<option value="+v.kode+">"+v.dokter+"</option>")
							})
						}


						loading('hide');
					}
					else
					{
						// disabled tomobol register 
						$(".btn-register").prop("disabled",true)
						// end 
						$("#no_kunjungan").val('')
						$("#stt").val('');
						$(".nik").html('');
						$(".nama").html('');
						$(".as").html('');
						$(".cb").html('');
						$(".jkel").html('');
						$(".alamat").html('');
						toastr.error(json.pesan_err)
						$this.val('').focus();

						if(asal=='rajal')
						{
							$(".unit")
							.find('option')
							.remove()
							.end()
							.append('<option value="">-- Pilih --</option>')
						}
						loading('hide');
					}
				}
			})
		}
	})

	$(".btn-register").click(function(){
		var data=$(".form-data").serialize();
		loading('show');
		var $this=$(this);
		$this.html("<i class='fa fa-spin fa-spinner'></i> Menyimpan permintaan...");
		$.ajax({
			type:'POST',
			url:base_url+'radiologi/kunjungan_api/register_kunjungan',
			data:data,
			dataType:'json',
			error:function()
			{
				loading('hide');
				$this.html("Register pemeriksaan");
				toastr.error("Gagal terhubung ke server.");
			},
			success:function(json)
			{
				if(json.success)
				{	
					$(".form-group").removeClass('has-error')
									.removeClass('has-success')
					$('.text-danger').remove();
					swal("Berhasil","Kunjungan berhasil diregistrasi, silahkan lakukan pemeriksaan.",'success');
					$(".form-data").trigger('reset');
					$(".list-produk li").remove();
					$("#stt").val('')
				}
				else
				{
					$.each(json.message,function(i, val){
						var elemen=$("#"+i);
						elemen.closest('div.form-group')
						.removeClass('has-error')
						.addClass(val.length > 0 ?'has-error':'has-success')
						.find('.text-danger').remove();
						elemen.after(val)
					})
					if(json.pesan!='')
					{
						toastr.error(json.pesan)
					}
				}

				loading('hide');
				$this.html("Register pemeriksaan");
			}
		})
	})


	
	$("#modal_radiologi").on('show.bs.modal',function(){
		$(".modal-body").html('')
		loading_modal('show')
		var norek=$(".norek").val();
		$.ajax({
			type:"POST",
			url:base_url+'radiologi/kunjungan_api/get_produk_radiologi_html',
			data:'norek='+norek,
			error:function(){
				toastr.error('Gagal terhubung ke server.')
				loading_modal('hide');
			},
			success:function(html)
			{
				$(".modal-body").append(html)
				loading_modal('hide');
			}
		})
	})

	function loading_modal(ket)
	{
		var $this=$(".tab-content");
		if(ket=='show')
		{
			$this.addClass('reloading')
			blockUI($this);
		}
		else
		{
			$this.removeClass('reloading')
			unblockUI($this);
		}
	}

	
</script>
