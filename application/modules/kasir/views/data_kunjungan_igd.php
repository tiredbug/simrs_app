<div class="panel konten panel-primary">
	<div class="panel-heading">
		<div class="panel-title bold">
			<i class="entypo-cc-nd"></i> DATA KUNJUNGAN IGD
		</div>
	</div>

	<div class="panel-body">
		
			<table class="table table-bordered table_data_kunjungan_igd" style="width: 100%">
				<thead>
					<tr>
						<th>No. Kunjungan</th>
						<th>No. Medrec</th>
						<th>Nama Lengkap</th>
						<th>Alamat</th>
						<th>Jenis Kelamin</th>
						<th>M. Bayar</th>
						<th>Dokter</th>
						<th>Diagnosa</th>
						<th>Penanggung Jawab</th>
						<th></th>
					</tr>
				</thead>
			</table>
		
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		loading_data_tabel_kunjungan_igd();
	})

	function loading_data_tabel_kunjungan_igd()
	{
		$(".table_data_kunjungan_igd").DataTable({
			'ordering':false,
			'language':{
				'search':"<b>No. Medrec : </b>"
			},
			'serverSide':true,
			'processing':true,
			'ajax':
			{
				type:'POST',
				url:base_url+'kasir/kunjungan_api/get_data_kunjungan_igd',
			},
			'rowCallback':function(row, data, index)
			{
				$("td:eq(9)",row).html("<a href='javascript:checkout(\""+data[0]+"\")' class='btn btn-danger' title='Checkout'><i class='fa fa-external-link'></i></a>")
			}
		})
		$(".table_data_kunjungan_igd").closest('.dataTables_wrapper').find('select').select2({
			minimumResultsForSearch:-1
		})
	}

	function checkout(no_kunjungan)
	{
		window.location.href=base_url+'kasir/kunjungan/checkout?asal=<?php echo $this->uri->segment(3)?>&nokunjungan='+no_kunjungan
	}
</script>