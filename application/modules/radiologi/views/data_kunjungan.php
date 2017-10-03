<div class="panel panel-primary konten">
	<div class="panel-heading">
		<div class="panel-title bold">
			<i class='entypo-folder'></i> Data Kunjungan
		</div>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered table-hover" id="tabel_data_kunjungan_radiologi" style="width:100%">
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
							<th width="63">Pilihan</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		loading_data_tabel();
	})


	

	function checkout(id)
	{
		swal({
			title:'Checkout ?',
			text:'checkout menandakan pasien sudah selesai diperiksa, lanjutkan ?',
			showCancelButton:true,
			confirmButtonText:'Iya, checkout',
			confirmButtonColor:'#21a9e1',
			closeOnConfirm:false,
			showLoaderOnConfirm:true,
			type:'warning'
		},
			function()
			{
				$.ajax({
					type:'POST',
					url:base_url+'radiologi/kunjungan_api/checkout',
					data:'id='+id,
					dataType:'json',
					error:function(){
						swal({
							title:'Koneksi terputus',
							text:'koneksi ke server terputus, periksa dan coba lagi.',
							imageUrl:base_url+'template/assets/img/diskonek.png'
						})
					},
					success:function(json)
					{
						if(json.success)
						{
							swal('Sukses','checkout kunjungan berhasil.','success')
							$("#tabel_data_kunjungan_radiologi").DataTable().ajax.reload();
						}
						else
						{
							swal('Gagal','checkout kunjungan gagal.','error')
						}
					}
				})
			}
		)
	}

	function loading_data_tabel()
	{
		$("#tabel_data_kunjungan_radiologi").DataTable({
			'ordering':false,
			'language':{
				'search':"<b>Nomor Medrec :</b>"
			},
			'serverSide':true,
			'processing':true,
			'ajax':{
				type:'post',
				url:base_url+'radiologi/kunjungan_api/get_data_kunjungan',
				data:function(filter)
				{
					
				}
			},
			'rowCallback':function(row, data, index){
				$("td:eq(9)",row).html(
					"<a href='"+base_url+"radiologi/kunjungan/detail/"+data[2]+"' class='btn btn-success' title='informasi detail'><i class='fa fa-search'></i></a> <a href='javascript:checkout("+data[2]+")' class='btn btn-danger' title='Checkout'><i class='fa fa-external-link'></i></a>"
					)
			}
		})
		
		$("#tabel_data_kunjungan_radiologi").closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
            minimumResultsForSearch: -1
	    });
	}
</script>