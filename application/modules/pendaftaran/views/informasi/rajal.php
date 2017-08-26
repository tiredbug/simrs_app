<div class="panel panel-primary konten">
    <div class="panel-heading">
        <div class="panel-title bold">
            <i class="entypo-folder
            "></i> DATA KUNJUNGAN RAWAT JALAN
        </div>
        <div class="panel-options">
            <a href="#" data-toggle="modal" data-target="#modal-filter" class="bold bg" title="Filter data kunjungan."><i class="entypo-search"></i></a>
        </div>
    </div>


    <div class="panel-body">

        <div class="row">
        	<div class="col-sm-12">
	            <table class="table table-bordered tabel_data" style="width: 100%">
	            	<thead>
	            		<tr>
	            			<th>No. Medrec</th>
	            			<th>No. Kunjungan</th>
	            			<th>Nama</th>
	            			<th>Metode Bayar</th>
	            			<th>Nomor SEP</th>
	            			<th>Tgl Daftar</th>
                            <th>Poliklinik</th>
	            			<th>Status Kunjungan</th>
	            		</tr>
	            	</thead>
	            </table>
            </div>
        </div>

    </div>

</div>


    <!-- modal filter data -->
    <div class="modal invert fade" id="modal-filter">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title bold"><i class="entypo-search"></i> FILTER DATA </h4>
                </div>
                
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label col-sm-2">Tgl :</label>
                                    <div class="col-sm-2">
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


                                    <div class="col-sm-5">
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
                                <div class="form-group">
                                    <label class="control-label col-sm-2">Poliklinik :</label>
                                    <div class="col-sm-10">
                                        <select class="form-control input-sm" name="poli" id="poli">
                                            <option value=''>- Pilih Poliklinik -</option>
                                            <?php 
                                            foreach ($poli->result() as $p) {
                                                # code...
                                                echo"<option value='".$p->id_poliklinik."'>Poliklinik ".$p->nama_poliklinik."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-tutup">Tutup</button>
                    <button class="btn btn-success btn-tampil">Tampilkan data</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal filter data  -->

<script type="text/javascript">
	$(document).ready(function(){
        //hide_sidebar_menu(false)
        tabel_nota();
    })

	$(".btn-tampil").click(function(){
		$(".tabel_data").DataTable().ajax.reload();
        $("#modal-filter").modal('hide');
	})

    $(".btn-tutup").click(function(){
        $("#modal-filter").modal('hide');
    })

	function tabel_nota()
    {
        $(".tabel_data").DataTable({
            "ordering":false,
            "searching":true,
            "processing":true,
            "serverSide":true,
            "language":{
                "info"       	: "Menampilkan _START_ s/d _END_ baris data dari _TOTAL_ data",
                "infoEmpty"  	: "Tidak Ada Data",
                "emptyTable" 	: "Tidak Ada Data",
                "lengthMenu" 	: "Tampilkan _MENU_ Baris per laman.",
                "sZeroRecords"	: "Tidak ada data.",
                "search"		: 'No. Medrec'
            },
            "rowCallback":function(row, data, index)
            {
                $('td:eq(7)', row).html(data[7]=='Selesai dirawat'?"<span class='badge badge-danger badge-roundless'>Selesai dirawat</span>":"<span class='badge badge-primary badge-roundless'>Masih dirawat</span>")
            },
            "ajax":{
                type:'post',
                url:base_url+'pendaftaran/informasi_api/get_data_kunjungan',
                data:function(filter)
                {
                    filter.tgl 			= $("#tgl").val();
                    filter.bln 			= $("#bln").val();
                    filter.tahun 		= $("#tahun").val();
                    filter.poli 		= $("#poli").val();
                }
            }
        })

        $(".tabel_data").closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
            minimumResultsForSearch: -1
        });
    }
</script>