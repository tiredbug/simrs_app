<div class="col-sm-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title bold">
				<i class="entypo-print"></i> Laporan bulanan
			</div>
		</div>

		<div class="panel-body">
			<div class="row">
				<div class="col-sm-7">
					<div class="well well-sm" style="background: #FFF">
						<p><b>Informasi :</b></p>
						<p>
							Pilih bulan kunjungan untuk diciptakan informasi kedalam bentuk laporan, kemudian pilih pilihan tampilkan, atau perolah laporan dalam format <b class="text-danger">.pdf</b> <b class="text-success">.xls</b>
						</p>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="well well-sm">
						<div class="row">
							<div class="col-sm-12">
								<form class="form-horizontal">
									<div class="form-group">
										<label class="control-label col-sm-2">Bulan:</label>
										<div class="col-sm-10">
											<select name="bulan"  class="bulan form-control">
												<option value="">-- Pilih --</option>
												<?php 
												for ($i=1; $i <13 ; $i++) { 
													# code...
													echo "<option value='";
													echo $i<10?'0'.$i:$i;
													echo "'>";
													echo $i<10?bln('0'.$i):bln($i);
													echo "</option>";
												}
												?>
											</select>
										</div>
										
									</div>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-10 col-sm-offset-2">
								<button class="btn btn-blue btn_tampilkan"><i class='fa fa-search'></i> Tampilkan </button>
								<button class="btn btn-danger btn_lap_pdf"><i class='fa fa-file-pdf-o'></i> PDF </button>
								<button class="btn btn-success"><i class='fa fa-file-excel-o'></i> Excel &nbsp</button>
								<button class="btn btn-default"><i class='fa fa-print'></i> Cetak </button>
							</div>
						</div>
					</div>
				</div>
				
			</div>

			<div class="row">
				<div class="col-sm-12">
					<table class="table table-bordered laporan_bulanan">
						<thead>
							<tr>
								<th>No. MR</th>
								<th>Nama Lengkap</th>
								<th>Jenis Kelamin</th>
								<th>M.Bayar</th>
								<th>Kelas</th>
								<th>Kamar</th>
								<th>Bed</th>
								<th>Tgl Masuk</th>
								<th>Tgl Keluar</th>
								<th>Cara Keluar</th>
								<th>Asal</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		load_laporan();
	})

	function load_laporan()
	{
		$(".laporan_bulanan").DataTable({
			'ordering':false,
			'serverSide':true,
			'processing':true,
			'ajax':{
				type:'POST',
				url:base_url+'e-ranap/laporan/laporanbulanan_api',
				data:function(filter)
				{
					filter.bulan=$(".bulan").val();
				}
			},
			'language':{
				'search':"<b>No Medrec : </b>"
			}
		})
		$(".laporan_bulanan").closest('.dataTables_wrapper').find('select').select2({
			minimumResultsForSearch:-1
		})
	}
	$(".btn_tampilkan").click(function(){
		$(".laporan_bulanan").DataTable().ajax.reload();
	})
	$(".btn_lap_pdf").click(function(){
		window.open(base_url+'e-ranap/laporan/laporanbulanan?format=pdf&bulan='+$(".bulan").val());
	})
</script>