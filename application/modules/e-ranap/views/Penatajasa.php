<div class="col-sm-6">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title bold">
				<i class="entypo-info"></i> Informasi pasien
			</div>
		</div>

		<div class="panel-body">
			<form class="form-horizontal">
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
			<form class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-3 control-label">Cara Bayar :</label>
					<div class="col-sm-9">
						<select name="cb" class="form-control">
							<option value="">-- Pilih--</option>
						</select>
					</div>
					
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Kelompok :</label>
					<div class="col-sm-9">
						<select name="klp" class="form-control">
							<option value="">-- Pilih--</option>
						</select>
					</div>
					
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Ruang / Kelas :</label>
					<div class="col-sm-5">
						<select name="ruang" class="form-control">
							<option value="">-- Pilih--</option>
						</select>
					</div>
					<div class="col-sm-4">
						<select name="kelas" class="form-control">
							<option value="">-- Pilih--</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Kamar / Bed :</label>
					<div class="col-sm-5">
						<select name="kamar" class="form-control">
							<option value="">-- Pilih--</option>
						</select>
					</div>
					<div class="col-sm-4">
						<select name="bed" class="form-control">
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
				<div class="col-sm-12">
					<form class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-sm-1 bold">Kode : </label>
							<div class="col-sm-2">
								<input type="text" name="kode" class="form-control" placeholder="kode tindakan...">
							</div>
							<div class="col-sm-8">
								<input type="text" name="kode" class="form-control" placeholder="tindakan...">
							</div>
							<div class="col-sm-1">
								<input type="text" name="kode" class="form-control" placeholder="qty">
							</div>
						</div>
					</form>
				</div>
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
					}
				})
			}
		}
	})
</script>