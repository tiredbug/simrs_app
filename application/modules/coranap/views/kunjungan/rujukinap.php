<?php 
if($i_k['no_kunjungan']=='')
{
	echo "<script>
	swal({
		'title':'Tidak ditemukan',
		'text':'kunjugan tidak ditemukan, kembali kehalaman data kunjungan sebelumnya.'
	},function(){
		window.location.href=base_url+'coranap/home'
	})
	</script>";
}
?>
<div class="panel panel-primary konten">
	<div class="panel-heading">
		<div class="panel-title bold">
			<i class="fa fa-bed"></i> FORM RUJUK RAWAT INAP
		</div>
	</div>

	<div class="panel-body">
		<form class="form-horizontal form_data">
		<input type="hidden" name="no_kunjungan" value='<?php echo $i_k['no_kunjungan']?>'>
		<input type="hidden" name="asal" value='<?php echo $this->uri->segment(5)?>'>
		<h6 class="bold"><i class='entypo-sweden'></i> INFORMASI KUNJUNGAN</h6>
        <br>

        <div class="row">

			<div class="col-sm-6">
				<div class="form-group">
					<label class="control-label col-sm-3">No. Medrec :</label>
					<div class="col-sm-9">
						<input type="text" name="nomedrec" class="form-control" value="<?php echo $i_k['norek'] ?>" disabled>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">Nama Lengkap :</label>
					<div class="col-sm-9">
						<input type="text" name="nama" class="form-control" value="<?php echo $i_k['nama'] ?>" disabled=''>
					</div>
				</div>


				<div class="form-group">
					<label class="control-label col-sm-3">Tempat/tgl lahir :</label>
					<div class="col-sm-9">
						<input type="text" name="tptg" class="form-control" value="<?php echo $i_k['tptg'] ?>" disabled>
					</div>
				</div>


				<div class="form-group">
					<label class="control-label col-sm-3">Jenis Kelamin :</label>
					<div class="col-sm-9">
						<input type="text" name="jk" class="form-control" value="<?php echo $i_k['jk'] ?>" disabled>
					</div>
				</div>


				<div class="form-group">
					<label class="control-label col-sm-3">Alamat :</label>
					<div class="col-sm-9">
						<input type="text" name="alamat" class="form-control" value="<?php echo $i_k['alamat'] ?>" disabled>
					</div>
				</div>


			</div>


			<div class="col-sm-6">

				<div class="form-group">
					<label class="control-label col-sm-3">Tgl Masuk :</label>
					<div class="col-sm-9">
						<input type="text" name="tglmasuk" class="form-control" value="<?php echo $i_k['tgl_masuk'] ?>" disabled>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">Dokter Pengirim :</label>
					<div class="col-sm-9">
						<input type="text" name="dokter" class="form-control" value="<?php echo $i_k['dokter_pengirim'] ?>" disabled>
					</div>
				</div>


				<div class="form-group">
					<label class="control-label col-sm-3">Asal Pasien :</label>
					<div class="col-sm-9">
						<input type="text" name="asal" class="form-control" value="<?php echo $i_k['asal'] ?>" disabled>
					</div>
				</div>



				<div class="form-group">
					<label class="control-label col-sm-3">Metode Bayar :</label>
					<div class="col-sm-9">
						<input type="text" name="cb" class="form-control" value="<?php echo $i_k['cb'] ?>" disabled>
					</div>
				</div>

			</div>
		</div>

        <h6 class="bold"><i class='entypo-sweden'></i> INFORMASI PERAWATAN</h6>
        <br>
        <div class="row">

			<div class="col-sm-6">
				<div class="form-group">
					<label class="control-label col-sm-3">Ruang Rawat :</label>
					<div class="col-sm-9">
						<select name='ruang' class="form-control ruang" id='ruang'>
							<option value=''>-- Pilih --</option>
							<?php
							foreach ($ruang->result() as $r) {
								# code...
								echo "<option value='".$r->id_ruangan."'>".$r->nama_ruangan."</option>";
							}
							?>
						</select>
					</div>
				</div>


				<div class="form-group">
					<label class="control-label col-sm-3">Kelas :</label>
					<div class="col-sm-9">
						<select name='kelas'  id='kelas' class="form-control kelas">
							<option value=''>-- Pilih --</option>
							<?php
							foreach ($kelas->result() as $k) {
								# code...
								echo "<option value='".$k->id_kelasperawatan."'>".$k->nama_kelasperawatan."</option>";
							}
							?>
						</select>
					</div>
				</div>


				<div class="form-group">
					<label class="control-label col-sm-3">Kamar :</label>
					<div class="col-sm-9">
						<select name='kamar' class="form-control kamar" id='kamar'>
							<option value=''>-- Pilih --</option>
						</select>
					</div>
				</div>


				<div class="form-group">
					<label class="control-label col-sm-3">Nomor BED :</label>
					<div class="col-sm-9">
						<select name='bed' class="form-control bed" id='bed'>
							<option value=''>-- Pilih --</option>

						</select>
					</div>
				</div>




			</div>


			<div class="col-sm-6">

				<div class="form-group">
					<label class="control-label col-sm-3">ICD (masuk):</label>
					<div class="col-sm-9">
						<input type="hidden" class="icdx form-control" id='icdx' name="icdx"/>
					</div>
				</div>


				

				<div class="form-group">
					<label class="control-label col-sm-3">Dokter :</label>
					<div class="col-sm-9">
						<select class="form-control select2" name="dokter" id='dokter'>
							<option value="">-- Pilih --</option>
							<?php
							foreach ($dokter->result() as $d) {
								# code...
								echo"<option value='".$d->id."'>".$d->nama."</option>";
							}
							?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">Deposit Rp :</label>
					<div class="col-sm-9">
						<input type="text" name="nomedrec" class="form-control" placeholder="Rp..." value='<?php echo $i_k['dp']?>'>
					</div>
				</div>

			</div>
		</div>

        <h6 class="bold"><i class='entypo-sweden'></i> INFORMASI PENANGGUNG JAWAB</h6>
        <br>


		<div class="row">

			<div class="col-sm-6">
				<div class="form-group">
					<label class="control-label col-sm-3">Nama Lengkap :</label>
					<div class="col-sm-9">
						<input type="text" name="nama_p"  id="nama_p" class="form-control" value='<?php echo $i_k['pj']?>'>
					</div>
				</div>

			</div>


			<div class="col-sm-6">
				<div class="form-group">
					<label class="control-label col-sm-3">Hub.Keluarga :</label>
					<div class="col-sm-9">
						<select name="hub" id='hub' class="form-control">
								<option value="">-- Pilih --</option> 
								<?php
								foreach ($m_hub->result() as $h) {
									# code...
									echo "<option value='".$h->id."'";
									echo $h->id==$i_k['hub']?'selected':'';
									echo">".$h->hubungan."</option>";
								}
								?>
						</select>
					</div>
				</div>

			</div>


			<div class="col-sm-6">
				<div class="form-group">
					<label class="control-label col-sm-3">No. Hp :</label>
					<div class="col-sm-9">
						<input type="text" name="hp_p" id='hp_p' class="form-control" value='<?php echo $i_k['hp_p']?>'>
					</div>
				</div>

			</div>


			<div class="col-sm-6">
				<div class="form-group">
					<label class="control-label col-sm-3">Alamat :</label>
					<div class="col-sm-9">
						<input type="text" name="alamat_p" id='alamat_p' class="form-control" value='<?php echo $i_k['alamat_p']?>'>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-9 col-sm-offset-3">
						<p class="pull-right">
							<button type="button" class="btn btn-success btn-simpan-ranap">Simpan kunjungan rawat inap</button>
						</p>
					</div>
				</div>

			</div>

		</div>
		</form>
	</div>

</div>



<script type="text/javascript">
	$(document).ready(function(){
		$(".kelas").change(function(){
			var ruang=$(".ruang").val();
			var kelas=$(this).val();
			if(ruang=='')
			{
				$(this).val('')
				toastr.warning('Pilih ruang dulu.')
			}
			else
			{
				$.ajax({
					type:'post',
					url:base_url+'coranap/kunjungan_api/get_data_ruang',
					data:'ruang='+ruang+'&kelas='+kelas,
					dataType:'json',
					error:function()
					{
						swal({
							title:"Koneksi terputus",
							text:'periksa koneksi jaringan anda lalu coba kembali',
							imageUrl:base_url+'template/assets/img/diskonek.png'
						})
					},
					success:function(json)
					{
						$('.kamar').empty().append("<option value=''>-- Pilih --</option>");
						$.each(json.data, function(i,v){
							$(".kamar").append("<option value='"+v.id+"'>"+v.kamar+"</option>")
						})
					}
				})
			}
		})

		$(".kamar").change(function(){
			var kamar=$(this).val();
			$.ajax({
				type:'post',
				url:base_url+'coranap/Kunjungan_api/get_bed',
				data:'id_kamar='+kamar,
				dataType:'json',
				error:function()
				{
					swal({
						title:'Koneksi terputus.',
						text:'koneksi terputus, periksa koneksi anda lalu coba kembali.',
						imageUrl:base_url+'template/assets/img/diskonek.png'
					})
				},
				success:function(json)
				{
					$('.bed').empty().append("<option value=''>-- Pilih --</option>");
					$.each(json.data, function(i,v){
						$(".bed").append("<option value='"+v.id+"'>"+v.bed+"</option>")
					})
				}
			})
		})

		function loading(ket)
		{
			var $this=$('.panel');
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


		//funsi select icx keypress
		$(".icdx").select2({
			minimumInputLength: 1,
			ajax: {
				    url: base_url+'coranap/kunjungan_api/search_icdx',
						type:'GET',
				    dataType: 'json',
				    delay: 50,
				    data: function (query) {

				      return {
				        q: query
				      };
				    },
				    results: function (data) {
				      var parsed = [];

				      try {
				        parsed = _.chain(data.data)
				          .map(function (item, index) {
				            return {
				              id: item.id,
				              text: item.slug
				            };
				          })
				          .value();
				      } catch (e) { }

				      return {
				        results: parsed
				      };
				    },
				    cache: true
  			}
		});
		// end

		// fungsi tombol simpan kunjungan ranap
		$(".btn-simpan-ranap").click(function(){
			var $this=$(this),form_data=$(".form_data").serialize();
			$this.html("<i class='fa fa-spin fa-spinner'></i> Menyimpan pasien ke rawat inap...").prop('disabled',true)
			$.ajax({
				type:'post',
				url:base_url+'coranap/kunjungan_api/save_kunjungan_ranap',
				data:form_data,
				dataType:'json',
				error:function()
				{
					swal({
						title:'Koneksi terputus.',
						text:'periksa koneksi jaringan anda ke server. lalu coba lagi.',
						imageUrl:base_url+'template/assets/img/diskonek.png'
					})
					$this.html("Simpan kunjungan rawat inap").prop('disabled',false)
				},
				success:function(json)
				{
					if(json.success)
					{
							$(".form-group").removeClass('has-error')
											.removeClass('has-success');
							$(".text-danger").remove();
							$this.html("Simpan kunjungan rawat inap").prop('disabled',false)
							loading('hide')
							swal({
								title:'Berhasil',
								text:'pasien berhasil dipindahkan ke layanan rawat inap.',
								type:'success'
							},function()
								{
									window.location.href=base_url+'coranap/kunjungan/ranap'
								}
							)
					}
					else
					{
							$.each(json.message,function(i, val)
							{
									var elemen=$("#"+i);
									elemen.closest('div.form-group')
									.removeClass("has-error")
									.removeClass('has-success')
									.addClass(val.length > 0 ?'has-error':'has-success')
									.find('.text-danger').remove();
									elemen.after(val)
							})
							loading('hide')

							// apabila ada pesan errro
							if(json.pesan_err!='')
							{
								swal("Gagal",json.pesan_err,'error')
							}
							// end


							$this.html("Simpan kunjungan rawat inap").prop('disabled',false)
					}
				}
			})
		})
		// end
	})
</script>
