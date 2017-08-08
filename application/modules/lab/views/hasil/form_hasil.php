<div class="col-sm-12 dataorder" style="padding: 0px;border-radius: 4px 4px 0px 0px;background-color: #FFF">   
	<table class="table table-bordered datatable table-hover nomargin" id="tabel-pemeriksaan">
	    <thead>
			<tr >
	            <th>No. Register</th>
	            <th>No. Medrec</th>
	            <th>Nama Lengkap</th>
	            <th>Tgl Periksa</th>
	            <th>Unit Pengirim</th>
	            <th>Dokter Pengirim</th>
	            <th>Dokter P.Jawab</th>
	            <th  width="10"></th>
	        </tr>
	    </thead>

	</table>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#tabel-pemeriksaan").DataTable({
			"serverSide":true,
			"processing":true,
			"ordering":false,
			"ajax":base_url+'lab/hasil_api/get_data_pemeriksaan'
		});
		$("#tabel-pemeriksaan").closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
            minimumResultsForSearch: -1
		});
	})
</script>