<div class="panel konten panel-primary">
	<div class="panel-heading">
		<div class="panel-title bold">
			<i class="entypo-folder"></i> DATA KUNJUNGAN RANAP
		</div>
		<div class="panel-options">
			<a href="#" class="bg btn_filter"><i class="entypo-search bold"></i></a>
		</div>
	</div>

	<div class="panel-body">
		
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered table-hover" id="tabel_data_kunjungan_ranap" style="width:100%">
					<thead>
						<tr>
							<th width="65"></th>
							<th>No. Kunjungan</th>
							<th>No. Medrec</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>Jenis-Kelamin</th>
							<th>M.Bayar</th>
							<th>ICDX</th>
							<th>Asal</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		datatable_ranap();
	})

	function datatable_ranap()
	{
		$("#tabel_data_kunjungan_ranap").DataTable({
			'ordering':false,
			'serverSide':true,
			'processing':true,
			'language':{
				'search':'<b>No. Medrec :</b>'
			},
			'ajax':{
				type:'post',
				url:base_url+'coranap/kunjungan_api/ranap',
				data:function(filter){

				}
			},
			rowCallback:function(row, data, index)
			{
				$("td:eq(0)",row).html("<div class='btn-group'>"+
				"<button type='button' class='btn btn-default btn-xs'>Pilihan</button>"+
					"<button type='button' class='btn btn-primary btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='false' title='Lihat opsi pilihan.'><i class='entypo-down-open-big'></i></button>"+
					"<ul class='dropdown-menu dropdown-default' role='menu'>"+
						"<li><a href='#' onClick='cetaksep(\""+data[1]+"\")'title='cetak sep kunjungan'><i class='entypo-print'></i>Print SEP</a></li>"+
						"<li><a href='#' onClick='cetakina(\""+data[1]+"\",\""+index+"\")'><i class='entypo-print'></i>Print INA</a></li>"+
						"<li class='divider'></li>"+
						"<li><a href='#' onClick='hapus(\""+data[1]+"\")'><i class='entypo-trash'></i>Hapus admission</a></li>"+
					"</ul>"+
				"</div>")
			}
		})

		$("#tabel_data_kunjungan_ranap").closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
            minimumResultsForSearch: -1
		});
	}
</script>