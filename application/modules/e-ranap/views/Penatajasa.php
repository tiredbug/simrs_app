<div class="col-sm-6">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title bold">
				<i class="entypo-info"></i> Informasi pasien
			</div>
		</div>

		<div class="panel-body">
			<form class="form-horizontal form-data-1">
				<input type="hidden" value='' name="i_norek" id='i_norek'>
				<input type="hidden" value='' name="i_nokunjungan" id='i_nokunjungan'>
				<input type="hidden" value='' name="i_id" id='i_id'>
				<div class="form-group">
					<label class="col-sm-3 control-label">No Medrec :</label>
					<div class="col-sm-9">
						<input type="text" name="norek" class="form-control norek" autofocus="">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">No Kunjungan :</label>
					<div class="col-sm-9">
						<input type="text" name="nokunjungan" class="form-control nokunjungan">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Nama :</label>
					<div class="col-sm-9">
						<input type="text" name="nama" class="form-control nama">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Jenis Kelamin :</label>
					<div class="col-sm-9">
						<input type="text" name="jk" class="form-control jk">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Alamat :</label>
					<div class="col-sm-9">
						<input type="text" name="alamat"  class="form-control alamat">
					</div>
				</div>

			</form>
		</div>
	</div>
</div>


<div class="col-sm-6">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title bold">
				<i class="entypo-info"></i> Informasi pelayanan
			</div>
		</div>

		<div class="panel-body">
			<form class="form-horizontal form-data-2">
				<div class="form-group">
					<label class="col-sm-3 control-label">Cara Bayar :</label>
					<div class="col-sm-9">
						<select name="cb" class="form-control cb">
							<option value="">-- Pilih--</option>
						</select>
					</div>
					
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Kelompok :</label>
					<div class="col-sm-9">
						<select name="klp" class="form-control klp">
							<option value="">-- Pilih--</option>
						</select>
					</div>
					
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Ruang / Kelas :</label>
					<div class="col-sm-5">
						<select name="ruang" class="form-control ruang">
							<option value="">-- Pilih--</option>
						</select>
					</div>
					<div class="col-sm-4">
						<select name="kelas" class="form-control kelas">
							<option value="">-- Pilih--</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Kamar / Bed :</label>
					<div class="col-sm-5">
						<select name="kamar" class="form-control kamar">
							<option value="">-- Pilih--</option>
						</select>
					</div>
					<div class="col-sm-4">
						<select name="bed" class="form-control bed">
							<option value="">-- Pilih--</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-9 col-sm-offset-3">
						<button type="button" class="btn btn-default btn-simpan-perubahan">Simpan perubahan</button>
						<button type="button" class="btn btn-default btn-pindah-ruangan">Pindah ruangan</button>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>

<div class="col-sm-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title bold">
				<i class='fa fa-balance-scale'></i> Penata jasa pelayanan
			</div> 
		</div>
		<div class="panel-body">
			<div class="row">
				<form class="form-horizontal">
				<div class="col-sm-7">
					
						<div class="form-group">
							<label class="control-label col-sm-3 bold">Kode : </label>
							<div class="col-sm-9">
								<input type="text" name="kode" class="form-control" placeholder="Kode tindakan...">
							</div>
							
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3 bold">Nama tindakan : </label>
							<div class="col-sm-9">
								<input type="text" name="tindakan" class="form-control" placeholder="Nama tindakan...">
							</div>
							
						</div>
					
				</div>
				<div class="col-sm-5">
					<div class="form-group">
						<label class="control-label col-sm-3 bold">Tarif : </label>
						<div class="col-sm-9">
							<input type="text" name="kode" class="form-control" placeholder="Rp...">
						</div>
							
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3 bold">qty : </label>
						<div class="col-sm-9">
							<input type="text" name="qty" class="form-control" placeholder="qty">
						</div>
							
					</div>

				</div>
				</form>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th></th>
								<th>KODE</th>
								<th>TINDAKAN</th>
								<th>DOK</th>
								<th>@</th>
								<th>TARIF</th>
								<th>TOTAL</th>
							</tr>
						</thead>
					</table>
					<div class="well well-sm">
		                <div class="row">
		                	<div class="col-sm-9">
		                		<h3 class="bold">Sub total <div class="pull-right">:</div></h3><br>
		                	</div>
		                	<div class="col-sm-3">
		                		<h3 class="bold total">Rp. 0,00</h3>
		                	</div>
		                </div>
		            </div>
		        </div>
			</div>
		</div>
	</div>


</div>

<script type="text/javascript">
	$(document).ready(function(){

	})

	$(".norek").keypress(function(e){
		if(e.which==13)
		{
			var norek=$(this).val()
			if(norek=='')
			{
				toastr.warning('Masukkan Nomor rekam medis dulu.');
			}
			else
			{
				$.ajax({
					type:'post',
					url:base_url+'e-ranap/penatajasa_api/get_info_kunjungan',
					data:'norek='+norek,
					dataType:'json',
					error:function()
					{
						swal({
							title:'Koneksi terputus',
							text:'gagal terhubung ke server mengambil informasi tindakan, periksa jaringan anda dan coba kembali.',
							imageUrl:base_url+'template/assets/img/diskonek.png',
						})
					},
					success:function(json)
					{
						if(json.success)
						{
							$("#i_norek").val(json.i_p.norek)
							$("#i_nokunjungan").val(json.i_p.no_kunjungan)
							$("#i_id").val(json.i_p.id)
							$(".nokunjungan").val(json.i_p.no_kunjungan).prop("disabled",true);
							$(".nama").val(json.i_p.nama).prop("disabled",true);
							$(".jk").val(json.i_p.jk).prop('disabled',true);
							$(".alamat").val(json.i_p.alamat).prop('disabled',true)			

							// append carabaray
							$(".cb").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							$.each(json.i_cb,function(index, data){
								$(".cb").append("<option value='"+data.id_carabayar+"'>"+data.nama_carabayar+"</option>")
							})

							$(".cb").val(json.i_p.cb)
							// end

							// append kelompok peserta
							$(".klp").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							$.each(json.i_klp, function(i,d){
								$(".klp").append("<option value='"+d.id_kelompok+"'>"+d.nama_kelompok+"</option>")
							})
							$(".klp").val(json.i_p.klp)
							// end

							// append ruangan
							$(".ruang").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							$.each(json.i_r,function(i,d){
								$(".ruang").append("<option value='"+d.id_ruangan+"'>"+d.nama_ruangan+"</option>")
							})
							$(".ruang").val(json.i_p.ruang)
							// end


							// append kelas
							$(".kelas").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							$.each(json.i_kls,function(i,d){
								$(".kelas").append("<option value='"+d.id_kelasperawatan+"'>"+d.nama_kelasperawatan+"</option>")
							})
							$(".kelas").val(json.i_p.kelas)
							// end


							// append kamar
							$(".kamar").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							$.each(json.i_kmr,function(i,d){
								$(".kamar").append("<option value='"+d.id_kamar+"'>"+d.nama_kamar+"</option>")
							})
							$(".kamar").val(json.i_p.kamar);
							// end

							// append bed
							$(".bed").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							$.each(json.i_bed,function(i,d){
								$(".bed").append("<option value='"+d.id_bed+"'>"+d.nomor_bed+"</option>")
							})
							$(".bed").val(json.i_p.bed)
							// end

										
						}
						else
						{
							swal("Tidak ditemukan",'data kunjungan tidak ditemukan pada ruangan ini.',"error");
							$("#i_norek").val('')
							$("#i_nokunjungan").val('')
							$("#i_id").val('')
							$(".nokunjungan").val('').prop("disabled",false);
							$(".nama").val('').prop("disabled",false);
							$(".jk").val('').prop('disabled',false);
							$(".alamat").val('').prop('disabled',false)			

							// append carabaray
							$(".cb").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							// end

							// append kelompok peserta
							$(".klp").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							// end

							// append ruangan
							$(".ruang").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							// end


							// append kelas
							$(".kelas").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							// end


							// append kamar
							$(".kamar").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							// end

							// append bed
							$(".bed").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							// end
						}
					}
				})
			}
		}


	})

	$(".btn-simpan-perubahan").click(function(){
		var $this=$(this);
		if($("#i_nokunjungan").val()=='' && $("#i_norek").val()=='')
		{
			toastr.warning("Cari kunjungan terlebih dahulu.")
		}
		else
		{
			$this.html("<i class='fa fa-spin fa-spinner'></i> Menyimpan perubahan...").prop('disabled',true);
			$(".btn-pindah-ruangan").prop('disabled',true);
			$.ajax({
				type:'post',
				url:base_url+'e-ranap/penatajasa_api/pindah_ruangan',
				data:$(".form-data-1").serialize()+'&'+$('.form-data-2').serialize(),
				dataType:'json',
				success:function(json)
				{
					if(json.success)
					{
						alert('berhasil pindah ruangan');
						$(".btn-pindah-ruangan").prop('disabled',false);
						$this.html("Simpan perubahan").prop('disabled',false);
						window.location.href=base_url+'e-ranap/penatajasa'
					}
					else
					{
						// alert('Gagal pindah ruangan, coba lagi.');
						// $(".btn-pindah-ruangan").prop('disabled',false);
						// $this.html("Simpan perubahan").prop('disabled',false);
						$.each(json,function(i, val){
							var el=#("."+i);
							el.closest('div.form-group')
							.removeClass('has-error')
							.
						})
					}
				}
			})
		}
	})

	$(".btn-pindah-ruangan").click(function(){
		var $this=$(this);
		if($("#i_nokunjungan").val()=='' && $("#i_norek").val()=='')
		{
			toastr.warning("Cari kunjungan terlebih dahulu.")
		}
		else
		{
			$this.html("<i class='fa fa-spin fa-spinner'></i> Memindahkan ruangan...").prop('disabled',true);
			$(".btn-simpan-perubahan").prop('disabled',true);
		}
	})

	$(".cb").change(function(){
		var cb=$(this).val();
		$.ajax({
			type:'post',
			url:base_url+'e-ranap/penatajasa_api/get_i_kelompok',
			data:'cb='+cb,
			dataType:'json',
			success:function(json)
			{
				$(".klp").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
				$.each(json,function(i, d){
					$(".klp").append("<option value='"+d.id_kelompok+"'>"+d.nama_kelompok+"</option>")
				})
			}
		})
	})

	$(".kelas").change(function(){
		$.ajax({
			type:'post',
			url:base_url+'e-ranap/penatajasa_api/get_i_kmr',
			data:'ruang='+$(".ruang").val()+'&kelas='+$(".kelas").val(),
			dataType:'json',
			success:function(json)
			{
				$(".kamar").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
				$.each(json,function(i, d){
					$(".kamar").append("<option value='"+d.id_kamar+"'>"+d.nama_kamar+"</option>")
				})
			}
		})
	})

	$(".kamar").change(function(){
		$.ajax({
			type:'post',
			url:base_url+'e-ranap/penatajasa_api/get_i_bed',
			data:'kamar='+$(".kamar").val(),
			dataType:'json',
			success:function(json)
			{
				$(".bed").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
				$.each(json,function(i, d){
					$(".bed").append("<option value='"+d.id_bed+"'>"+d.nomor_bed+"</option>")
				})
			}
		})
	})
</script>