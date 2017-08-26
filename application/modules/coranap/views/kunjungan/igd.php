<div class="panel konten panel-primary">
	<div class="panel-heading">
		<div class="panel-title bold">
			<i class="entypo-folder"></i> DATA KUNJUNGAN IGD
		</div>
		<div class="panel-options">
			<a href="#" class="bg btn_filter"><i class="entypo-search bold"></i></a>
		</div>
	</div>

	<div class="panel-body">
		<div class="row form_filter" style="display: none">
			<div class="col-sm-12">
				<div class="well well-sm">
					form filter
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered table-hover" id="tabel_data_kunjungan_igd" style="width:100%">
					<thead>
						<tr>
							<th>No. Kunjungan</th>
							<th>No. Medrec</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>Jeni-Kelamin</th>
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
		load_data_tabel_kunjungan_igd();
	})

	function load_data_tabel_kunjungan_igd()
	{
		$("#tabel_data_kunjungan_igd").DataTable({
			'ordering':false,
			'serverSide':true,
			'processing':true,
			'language':{
				'search':"<b>No. Medrec : </b>"
			},
			"ajax":{
				type:'post',
				url:base_url+'coranap/kunjungan_api/get_kunjungan_igd',
				data:function(filter)
				{

				}
			},
			"rowCallback":function(row, data, index)
            {
                if(data[6]=='N')
                {
                	$('td:eq(6)', row).html("<div class='label label-secondary'><i class='fa fa-ban'></i> Belum ditutup transkasi.</div>")
                }
                else
                {
                	$('td:eq(6)', row).html("<a href='"+base_url+"coranap/kunjungan/rujukinap/"+data[0]+"' class='label label-success'>Register ke rawat inap.</a>")
                }

            }
		})

		$("#tabel_data_kunjungan_igd").closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
            minimumResultsForSearch: -1
		});
	}

	$(".btn_filter").click(function(){
		$(".form_filter").toggle();
	})
</script>