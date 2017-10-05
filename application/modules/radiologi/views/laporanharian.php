<div class="col-sm-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title bold">
				<i class="entypo-print"></i> Laporan harian
			</div>
		</div>

		<div class="panel-body">
			<div class="row">
				<div class="col-sm-7">
					<div class="well well-sm" style="background: #FFF">
						<p><b>Informasi :</b></p>
						<p>
							Masukkan tanggal kunjungan untuk diciptakan informasi kedalam bentuk laporan, kemudian pilih pilihan tampilkan, atau perolah laporan dalam format <b class="text-danger">.pdf</b> <b class="text-success">.xls</b>
						</p>
					</div>
				</div>

				<div class="col-sm-5">
					<div class="well well-sm">
						<div class="row">
							<div class="col-sm-12">
								<form class="form-horizontal">
									<div class="form-group">
										<label class="control-label col-sm-2">Tgl :</label>
										<div class="col-sm-10">
											<input type="text" name="tgl" class="tgl form-control datepicker" data-format="dd-mm-yyyy" value="<?php echo date("d-m-Y")?>">
										</div>
										
									</div>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-10 col-sm-offset-2">
								<button class="btn btn-blue btn_tampilkan"><i class='fa fa-search'></i> Preview</button>
								<button class="btn btn-danger btn_lap_pdf"><i class='fa fa-file-pdf-o'></i> PDF</button>
								<button class="btn btn-success btn_lap_excel"><i class='fa fa-file-excel-o'></i> Excel</button>
								<button class="btn btn-default"><i class='fa fa-print'></i> Cetak</button>
							</div>
						</div>
					</div>
				</div>
				
			</div>

			<div class="row">
				<div class="col-sm-12">
					<table class="table table-bordered laporan_harian">
						<thead>
							<tr>
								<th>MR</th>
								<th>No. Kunjungan</th>
								<th>No. Radiologi</th>
								<th>Nama Lengkap</th>
								<th>Jenis Kelamin</th>
								<th>Tgl Permintaan</th>
								<th>Pengirim</th>
								<th>Dokter</th>
								<th>Register By</th>
								<th>Pemeriksaan</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url()?>template/neon/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url()?>template/neon/js/bootstrap-timepicker.min.js"></script>


<script type="text/javascript">
	$(document).ready(function(){
		load_laporan();
	})

	function load_laporan()
	{
		$(".laporan_harian").DataTable({
			'ordering':false,
			'serverSide':true,
			'processing':true,
			'ajax':{
				type:'POST',
				url:base_url+'radiologi/laporan/laporanharian_api',
				data:function(filter)
				{
					filter.tgl=$(".tgl").val();
				}
			},
			'language':{
				'search':"<b>No Medrec : </b>",
			}
		})
		$(".laporan_harian").closest('.dataTables_wrapper').find('select').select2({
			minimumResultsForSearch:-1
		})
	}
	$(".btn_tampilkan").click(function(){
		$(".laporan_harian").DataTable().ajax.reload();
	})
	$(".btn_lap_pdf").click(function(){
		window.open(base_url+'radiologi/laporan/laporanharian?format=pdf&tgl='+$(".tgl").val());
	})

	$(".btn_lap_excel").click(function(){
		window.open(base_url+'radiologi/laporan/laporanharian?format=excel&tgl='+$(".tgl").val());
	})

	
</script>