<div class="panel panel-primary konten">
	<div class="panel-heading">
		<div class="panel-title bold">
			<i class='entypo-folder'></i> PASIEN RAWAT JALAN
		</div>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered table-hover" id="tabel_data_kunjungan_rajal" style="width:100%">
					<thead>
						<tr>
							<th>No. Kunjungan</th>
							<th>No. Medrec</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>Jenis-Kelamin</th>
							<th>M.Bayar</th>
							<th>Rujuk inap</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		get_data_tabel_rajal();
	})

	function get_data_tabel_rajal()
	{
		$("#tabel_data_kunjungan_rajal").DataTable({
			'ordering':false,
			'serverSide':true,
			'processing':true,
			'ajax':{
				type:'post',
				url:base_url+'coranap/kunjungan_api/get_data_kunjungan_rajal',
				data:function(filter)
				{

				}
			},
			'language':{
				'search':"<b>No. Medrec : </b>"
			},
			rowCallback:function(row, data, index){
				$('td:eq(6)', row).html("<a href='"+base_url+"coranap/kunjungan/rujukinap/"+data[0]+"/rajal' class='label label-success'>Register ke rawat inap.</a>")
			}
			
		})

		$("#tabel_data_kunjungan_rajal").closest(".dataTables_wrapper").find('select').select2({
			minimumResultsForSearch:-1
		})
	}
</script>