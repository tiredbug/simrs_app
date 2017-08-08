<div class="panel konten panel-primary">
	<div class="panel-heading">
		<h4 class="panel-title bold">
			<i class="entypo-users"></i>
			DATA KUNJUNGAN LABORATURIUM
		</h4>
		<div class="panel-options">
			<!-- <a href="" class="bold" data-toggle='modal' data-target='#modal-filter' title="Klik disini untuk memfilter data yang ditampilkan." >
				<i class="entypo-search" ></i> Filter
			</a> -->
		</div>
	</div>

	<div class="panel-body">
		<div class="row">
        	<div class="col-sm-12">
	            <table class="table table-bordered tabel_data table-hover" style="width: 100%">
	            	<thead>
	            		<tr>
	            			<th width="85"></th>
	            			<th>No. Register</th>
	            			<th>No. Medrec</th>
	            			<th>Nama Lengkap</th>
	            			<th>Jenis-Kelamin</th>
	            			<th>Alamat</th>
	            			<th>Umur</th>
	            			<th>Asal - Unit</th>
                            <th>M.Bayar</th>
	            		</tr>
	            	</thead>
	            </table>
            </div>
        </div>
	</div>


</div>

<script type="text/javascript">
	$(document).ready(function(){
		hide_sidebar_menu(false);
		tabel_kunjungan();
	})


	function tabel_kunjungan()
	{
		$(".tabel_data").DataTable({
			"ordering":false,
			"processing":true,
			"serverSide":true,
			"language":{
				"search":"<b>Cari No.Medrec : </b>"
			},
			"ajax":{
				type:'post',
				url:base_url+'e-lab/kunjungan_api/get_kunjungan_lab'
			},
			"rowCallback":function(row,data,index)
			{
				// $("td:eq(8)",row).html("<button class='btn btn-green btn-icon icon-left btn-sm' type='button' title='Klik disini untuk input hasil pemeriksaan laboraturium.' onClick='inputhasil(\""+data[0]+"\")'>Input hasil <i class='entypo-pencil'></i></button>")
				$("td:eq(0)",row).html("<div class='btn-group'><button type='button' class='btn btn-danger'>Pilihan</button><button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false' title='Lihat opsi pilihan.'><i class='entypo-down-open-big'></i></button><ul class='dropdown-menu dropdown-blue' role='menu'><li><a href='#' onClick='inputhasil(\""+data[1]+"\")'title='Klik disini untuk menginput hasil pemeriksaan laboraturium.'><i class='entypo-right'></i>Input hasil pemeriksaan</a></li><li><a href='#' onClick='hapus(\""+data[1]+"\",\""+index+"\")'><i class='entypo-right'></i>Hapus kunjungan</a></li><li><a href='#' onClick='cetakhasil(\""+data[1]+"\")'><i class='entypo-right'></i>Cetak hasil</a></li><li><a href='#' onClick='chekcout(\""+data[1]+"\")'><i class='entypo-right'></i>Checkout kunjungan</a></li></ul></div>")
			}
		})

		$(".tabel_data").closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
            minimumResultsForSearch: -1
        });
	}


	function inputhasil(id)
	{
		window.location.href=base_url+'e-lab/kunjungan/inputhasil?nolab='+id
	}

	function hapus(id,index)
	{
		swal({
			title:'Yakin hapus ?',
			text:'Data kunjungan akan dihapus dari database, anda tidak bisa menginput data hasil pemeriksaan lagi pada nomor kunjungan tesebut, lanjutkan apabila anda yakin.',
			type:'warning',
			showCancelButton:true,
			confirmButtonText:"Iya, saya yakin.",
			cancelButtonText:'Batal hapus',
			confirmButtonColor:'#CC2424',
			closeOnConfirm:false,
			closeOnCancel:true,
			showLoaderOnConfirm:true
		},
			function(){
				$.ajax({
					type:'post',
					url:base_url+'e-lab/kunjungan_api/hapus_kunjungan',
					data:'id='+id,
					dataType:'json',
					error:function()
					{
						swal("Koneksi terputus",'gagal menghapus data kunjungan pada server, koneksi terputus ketika mencoba menghubungi server. untuk mengatasi masalah ini hubungi pihak IT Server.','error');
					},
					success:function(json)
					{
						if(json.success)
						{
							swal("Berhasil",'Data kunjungan berhasil dihapus, sekarang anda tidak dapat lagi mengakses data kunjungan tersebut.','success');
							var tabel=$(".tabel_data").DataTable();
							tabel.row().draw();
						}
						else
						{
							swal("Gagal",json.pesan_err,'error');
						}
					}
				})
			}
		);
	}


	function chekcout(nolab)
	{
		swal({
			title:'Checkout kunjungan ?',
			text:'data kunjungan dihapus dari database kunjungan tidak bisa diakses dan diubah lagi, untuk mencetak ulang hasil pemeriksaan laboraturium akses melalui menu histori pelayanan.',
			type:'warning',
			showCancelButton:true,
			confirmButtonText:"Iya, checkout.",
			cancelButtonText:'Batal checkout',
			confirmButtonColor:'#CC2424',
			closeOnConfirm:false,
			closeOnCancel:true,
			showLoaderOnConfirm:true
		},
			function(){
				$.ajax({
					type:'post',
					url:base_url+'e-lab/kunjungan_api/checkout_kunjungan',
					data:'id='+nolab,
					dataType:'json',
					error:function()
					{
						swal("Koneksi terputus",'gagal menghapus data kunjungan pada server, koneksi terputus ketika mencoba menghubungi server. untuk mengatasi masalah ini hubungi pihak IT Server.','error');
					},
					success:function(json)
					{
						if(json.success)
						{
							swal("Berhasil",'chekcout kunjungan berhasil, data kunjungan tidak bisa diedit lagi tetapi masih bisa diakses melalui menu histori pelayanan.','success');
							var tabel=$(".tabel_data").DataTable();
							tabel.row().draw();
						}
						else
						{
							swal("Gagal",json.pesan_err,'error');
						}
					}
				})
			}
		);
	}

	function cetakhasil(nolab) {
		// body...
		window.open(base_url+'e-lab/kunjungan/cetakhasil?nolab='+nolab,'_blank')
	}

	
</script>