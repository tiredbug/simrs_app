<div class="panel konten panel-primary">
	<div class="panel-heading">
		<h4 class="panel-title bold">
			<i class="entypo-book-open"></i>
			DATA HISTORI PEMERIKSAAN
		</h4>
		<div class="panel-options">
			<a href="" class="bold" data-toggle='modal' data-target='#modal-filter' title="Klik disini untuk memfilter data yang ditampilkan." >
				<i class="entypo-search" ></i> Filter
			</a>
		</div>
	</div>

	<div class="panel-body">
		<div class="row">
        	<div class="col-sm-12">
	            <table class="table table-bordered tabel_data table-hover" style="width: 100%">
	            	<thead>
	            		<tr>
	            			<th width="20"></th>
	            			<th>No. Register</th>
	            			<th>No. Medrec</th>
	            			<th>Nama Lengkap</th>
	            			<th>Jenis-Kelamin</th>
	            			<th>Alamat</th>
	            			<th>Tgl Register</th>
	            		</tr>
	            	</thead>
	            </table>
            </div>
        </div>
	</div>
</div>


<!-- modal filter  -->
<div class="modal fade invert" id="modal-filter">
	<div class="modal-dialog">

		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title bold"><i class="entypo-sweden"></i> FILTER DATA YANG AKAN DITAMPILKAN</h4>
			</div>

			<div class="modal-body">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-sm-2">Tgl Register</label>
					
						<div class="col-sm-3">
                            <select class="form-control input-sm" name="tgl" id="tgl">
                              	<option value="">-Pilih-</option>
                                <?php 
                                    for ($i=1; $i < 31+1; $i++) { 
                                   # code...
                            	        $i=$i<10?'0'.$i:$i;
                        	            echo"<option value='".$i."'>".$i."</option>";
                                    }
                                ?>
                            </select>
                        </div>


                        <div class="col-sm-4">
                            <select class="form-control input-sm" name='bln' id="bln">
                                <option value="">Pilih</option>
                                <?php 
                                    for ($i=1; $i < 12+1; $i++) { 
                                    # code...
                        	            $i=$i<10?'0'.$i:$i;
                                        echo"<option value='".$i."'>".bln($i)."</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="col-sm-3">
                            <select name="tahuns" id="tahun" class="form-control input-sm">
                                <option value="">Pilih</option>
                                <?php 
                                    $thn=date("Y");
                                    for ($i=$thn; $i >= $thn-15; $i--) { 
                                        # code...
                                        echo"<option value='".$i."'>".$i."</option>";
                                    }
                                ?>
                            </select>
                        </div>
						
					</div>
				</form>
			</div>

			<div class="modal-footer">
				<button class="btn btn-success btn-filter">Tampilkan</button>
			</div>
		</div>
	</div>
</div>
<!-- end  -->

<script type="text/javascript">
	$(document).ready(function(){
		// hide_sidebar_menu(false);
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
				url:base_url+'e-lab/kunjungan_api/histori_layanan',
				data:function(filter)
                {
                    filter.tgl 			= $("#tgl").val();
                    filter.bln 			= $("#bln").val();
                    filter.tahun 		= $("#tahun").val();
                }
			},
			"rowCallback":function(row,data,index)
			{
				
				$("td:eq(0)",row).html("<div class='btn-group'><button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false' title='Lihat opsi pilihan.'><i class='entypo-down-open-big'></i></button><ul class='dropdown-menu dropdown-blue' role='menu'><li><a href='#' onClick='cetakulang(\""+data[1]+"\",\""+index+"\")'><i class='entypo-right'></i>Cetak ulang hasil.</a></li></ul></div>")
			}
		})

		$(".tabel_data").closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
            minimumResultsForSearch: -1
        });
	}


	$(".btn-filter").click(function(){
		$(".tabel_data").DataTable().ajax.reload();
        $("#modal-filter").modal('hide');
	})

	function cetakulang(nolab) {
		// body...
		window.open(base_url+'e-lab/kunjungan/cetakhasil?nolab='+nolab,'_blank')
	}

	
</script>