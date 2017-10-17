<div class="panel konten panel-primary">
	<div class="panel-heading">
		<div class="panel-title bold">
			<i class="entypo-cc-nd"></i> Data Billing
		</div>
	</div>


	<div class="panel-body">
		<table class="table table-bordered table_billing">
			<thead>
				<tr>
					<th>No. Billing</th>
					<th>No. Kunjungan</th>
					<th>No. RM</th>
					<th>Nama Pasien</th>
					<th>Tgl Masuk</th>
					<th>Tgl Keluar</th>
					<th>Kunjungan</th>
					<th></th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		loading_data_tabel_billing();
	})

	function loading_data_tabel_billing()
	{
		$(".table_billing").DataTable({
			'ordering':false,
			'language':{
				'search':"<b>No. Billing : </b>"
			}
		})
	}
</script>