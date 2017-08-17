<div class="panel konten panel-primary">
	<div class="panel-heading">
		<div class="panel-title bold">
			<i class="entypo-drive"></i> DATA KUNJUNGAN IGD
		</div>
	</div>
	<div class="panel-body">
		<table class="table table-bordered table-hover" id="tabel-kunjungan-igd" width="100%">
			<thead>
				<tr>
					<th width="85"></th>
					<th>No. Kunjungan</th>
					<th>No.Medrec</th>
					<th>Nama Lengkap</th>
					<th>Alamat</th>
					<th>Jenis-Kelamin</th>
					<th>M.Bayar</th>
					<th>Dokter</th>
					<th>Diagnosa</th>
					<th>Penanggung Jawab</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<input type="hidden" name="nokunjungan" id="nokunjungan" >

<!-- modal informasi kunjungna -->
	<div class="modal invert fade" id="modal_informasi_kunjungan">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title bold"><i class="entypo-sweden"></i> INFORMASI LENGKAP KUNJUNGAN</h4>
                </div>
                
                <div class="modal-body body-modal-informasi">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="row">
                                <img src="<?php echo base_url().'template/assets/img/user-icon.png'?>" >
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-block btn-primary btn-icon icon-left"><i class='entypo-pencil'></i> Entry tindakan pelayanan</button>
                                    <button class="btn btn-block btn-danger btn-icon icon-left"><i class='entypo-trash'></i> Hapus kunjungan</button>
                                    <button class="btn btn-block btn-orange btn-icon icon-left"><i class='entypo-block'></i> Tutup transaksi</button>
                                    <button class="btn btn-block btn-success btn-icon icon-left"><i class='entypo-cancel'></i> Tutup Form</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="" class="norek-h">
                        <div class="col-sm-9">
		
							<div class="panel-group joined" id="accordion-test-2">
				
								<div class="panel panel-success">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion-test-2" href="#informasi_pasien">
												<i class='entypo-user'></i> Informasi pasien
											</a>
										</h4>
									</div>
									<div id="informasi_pasien" class="panel-collapse collapse in">
										<div class="panel-body">
											<div class="row">
												<div class="col-sm-6">
													<table class="table table-stripped">
														<tr>
															<td>No.Medrec</td>
															<td>:</td>
															<td id="i_norek"></td>
														</tr>
														<tr>
															<td>Nama Lengkap</td>
															<td>:</td>
															<td id="i_nama"></td>
														</tr>
														<tr>
															<td>Nomor NIK</td>
															<td>:</td>
															<td id="i_nik"></td>
														</tr>

														<tr>
															<td>Nomor Asuransi</td>
															<td>:</td>
															<td id="i_asu"></td>
														</tr>

														<tr>
															<td>Gender</td>
															<td>:</td>
															<td id="i_gender"></td>
														</tr>

														<tr>
															<td>Agama</td>
															<td>:</td>
															<td id="i_agama"></td>
														</tr>

													</table>
												</div>

												<div class="col-sm-6">
													<table class="table table-stripped">
														<tr>
															<td>Tgl lahir</td>
															<td>:</td>
															<td id="i_tgllahir"></td>
														</tr>
														<tr>
															<td>Alamat</td>
															<td>:</td>
															<td id="i_alamat"></td>
														</tr>
														<tr>
															<td>Provinsi</td>
															<td>:</td>
															<td id="i_prov"></td>
														</tr>
														<tr>
															<td>Kabupaten</td>
															<td>:</td>
															<td id="i_kab"></td>
														</tr>
														<tr>
															<td>Kecamatan</td>
															<td>:</td>
															<td id="i_kec"></td>
														</tr>
														<tr>
															<td>Desa</td>
															<td>:</td>
															<td id="i_des"></td>
														</tr>
														
													</table>
												</div>

											</div>
										</div>
									</div>
								</div>
					
								<div class="panel panel-success">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-2" class="collapsed">
												<i class='entypo-info'></i> Informasi kunjungan
											</a>
										</h4>
									</div>
									<div id="collapseTwo-2" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="row">
												<div class="col-sm-6">
													<table class="table table-stripped">
														<tr>
															<td>No. Kunjungan</td>
															<td>:</td>
															<td id="i_nokunjungan"></td>
														</tr>

														<tr>
															<td>M. Bayar</td>
															<td>:</td>
															<td id="i_mbayar"></td>
														</tr>

														<tr>
															<td>Kelas</td>
															<td>:</td>
															<td id="i_kelas"></td>
														</tr>

														<tr>
															<td>Tgl Daftar</td>
															<td>:</td>
															<td id="i_tgldaftar"></td>
														</tr>

														<tr>
															<td>Cara Rujuk</td>
															<td>:</td>
															<td id="i_cr"></td>
														</tr>

														<tr>
															<td>Asal Rujuk</td>
															<td>:</td>
															<td id="i_ar"></td>
														</tr>

														<tr>
															<td>No. Rujukan</td>
															<td>:</td>
															<td id="i_norujuk"></td>
														</tr>
													</table>
												</div>

												<div class="col-sm-6">
													<table class="table table-stripped">
														<tr>
															<td>No. SEP</td>
															<td>:</td>
															<td id="i_sep"></td>
														</tr>

														<tr>
															<td>Diagnosa</td>
															<td>:</td>
															<td id="i_diagnosa"></td>
														</tr>

														<tr>
															<td>Jenis Pasien</td>
															<td>:</td>
															<td id="i_jp"></td>
														</tr>

														<tr>
															<td>Dokter</td>
															<td>:</td>
															<td id="i_dokter"></td>
														</tr>

														<tr>
															<td>Deposit</td>
															<td>:</td>
															<td id="i_deposit"></td>
														</tr>

														<tr>
															<td>P. Jawab</td>
															<td>:</td>
															<td id="i_pjawab"></td>
														</tr>

														
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
					
								<div class="panel panel-success">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseThree-2" class="collapsed">
												<i class='entypo-doc-text-inv'></i> History kunjungan
											</a>
										</h4>
									</div>
									<div id="collapseThree-2" class="panel-collapse collapse">
										<div class="panel-body">
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-info btn-simpan">Perubahan Data</button>
                    <button type="button" class="btn btn-orange btn-cetak">Kartu Berobat</button>
                </div> -->
            </div>
        </div>
    </div>
<!-- end modal informasi kunjungan -->


<!-- modal tutup transaksi -->
<!-- end modal tutup transaksi -->
<script type="text/javascript">
	$(document).ready(function(){
		load_tabel();
		hide_sidebar_menu(false);
	})


	function load_tabel()
	{
		$("#tabel-kunjungan-igd").DataTable({
			'ordering':false,
			'language':{
				'search':"<b>No.Medrec</b>",
				"info"       	: "Menampilkan _START_ s/d _END_ baris data dari _TOTAL_ data",
                "infoEmpty"  	: "Tidak Ada Data",
                "emptyTable" 	: "Tidak Ada Data",
                "lengthMenu" 	: "Tampilkan _MENU_ Baris per halaman.",
                "sZeroRecords"	: "Tidak ada data.",
			},
			'serverSide':true,
			'processing':true,
			'ajax':{
				type:'post',
				url:base_url+'igd/kunjungan_api/get_data_kunjungan_igd'
			},
			"rowCallback":function(row, data, index)
            {
            	$("td:eq(0)",row).html("<div class='btn-group'>"+
            								"<button type='button' class='btn btn-danger'>Pilihan</button>"+
            								"<button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false' title='Lihat opsi pilihan.'><i class='entypo-down-open-big'></i></button>"+
            								"<ul class='dropdown-menu dropdown-blue' role='menu'>"+
            									"<li>"+
            										"<a href='#' onClick='entrytindakan(\""+data[1]+"\")'title='entry tindakan pelayanan.'><i class='entypo-right'></i>Entry tindakan pelayanan</a>"+
            									"</li>"+
            									"<li>"+
            										"<a href='#' onClick='hapus(\""+data[1]+"\",\""+index+"\")'><i class='entypo-right'></i>Hapus kunjungan</a>"+
            									"</li>"+
            									"<li>"+
            										"<a href='#' onClick='informasi(\""+data[1]+"\")'><i class='entypo-right'></i>Informasi kunjungan</a>"+
            									"</li>"+
            									"<li class='divider'>"+
            									"</li>"+
            									"<li>"+
            										"<a href='#' onClick='chekcout(\""+data[1]+"\")'><i class='entypo-right'></i>Tutup transaksi</a>"+
            									"</li>"+
            								"</ul>"+
            							"</div>")
            }
		})
		$("#tabel-kunjungan-igd").closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
            minimumResultsForSearch: -1
        });;
	}


	function entrytindakan(nokunjungan)
	{
		window.location.href=base_url+'igd/kunjungan/entrytindakan?nokunjungan='+nokunjungan;
	}

	function hapus(nokunjungan)
	{
		swal({
			title:'Hapus ?',
			text:'Data kunjungan akan dihapus, anda tidak dapat mengaksesnya lagi.',
			type:'warning',
			showCancelButton:true,
			confirmButtonText:'Iya, saya yakin',
			cancelButtonText:'Batal',
			confirmButtonColor:'#CC2424',
			closeOnConfirm:false,
			closeOnCancel:true,
			showLoaderOnConfirm:true
		},
			function()
			{
				$.ajax({
					type:'post',
					url:base_url+'igd/kunjungan_api/hapus_kunjungan',
					data:'id='+nokunjungan,
					dataType:'json',
					error:function()
					{
						swal({
							title:'Putus koneksi',
							text:'Koneksi ke server terputus, periksa jaringan anda lalu coba kembali',
							imageUrl:base_url+'template/assets/img/diskonek.png'
						})
					},
					success:function(json)
					{
						if(json.success)
						{
							swal('Berhasil',json.pesan_sukses,'success');
							$("#tabel-kunjungan-igd").DataTable().ajax().reload();
						}
						else
						{
							swal("Gagal",json.pesan_err,'error');
						}
					}
				})
			}
		)
	}


	function informasi(nokunjungan)
	{
		$("#modal_informasi_kunjungan").modal('show')
		$("#nokunjungan").val(nokunjungan);
		load_informasi_kunjungan(nokunjungan)
	}


	function load_informasi_kunjungan(nokunjungan)
	{
		$this=$(".body-modal-informasi");
        blockUI($this)
        $this.addClass('reloading');

        $.ajax({
            type:'post',
            url:base_url+'igd/kunjungan_api/get_informasi_kunjungan_lengkap',
            data:'id='+nokunjungan,
            dataType:'json',
            error:function()
            {
                swal({
					title:'Putus koneksi',
					text:'Koneksi ke server terputus, periksa jaringan anda lalu coba kembali',
					imageUrl:base_url+'template/assets/img/diskonek.png'
				})
            },
            success:function(json)
            {
                unblockUI($this)
                $this.removeClass('reloading');
                // panel i-pasien
                $("#i_norek").html(json.i_pasien.norek)
                $("#i_nama").html(json.i_pasien.nama)
                $("#i_nik").html(json.i_pasien.nik)
                $("#i_asu").html(json.i_pasien.asu)
                $("#i_gender").html(json.i_pasien.jk)
                $("#i_agama").html(json.i_pasien.ag)
                $("#i_tgllahir").html(json.i_pasien.tgllahir)
                $("#i_alamat").html(json.i_pasien.alamat)
                $("#i_prov").html(json.i_pasien.prov)
                $("#i_kab").html(json.i_pasien.kab)
                $("#i_kec").html(json.i_pasien.kec)
                $("#i_des").html(json.i_pasien.des)
                // end


                // panel i-kunjungan
                $("#i_nokunjungan").html(json.i_kunjungan.no_kunjungan)
                $("#i_mbayar").html(json.i_kunjungan.cb)
                $("#i_kelas").html(json.i_kunjungan.kls)
                $("#i_tgldaftar").html(json.i_kunjungan.tgl_d)
                $("#i_cr").html(json.i_kunjungan.cr)
                $("#i_ar").html(json.i_kunjungan.asal)
                $("#i_norujuk").html(json.i_kunjungan.norujuk)
                $("#i_sep").html(json.i_kunjungan.sep)
                $("#i_diagnosa").html(json.i_kunjungan.diagnosa)
                $("#i_jp").html(json.i_kunjungan.jp)
                $("#i_dokter").html(json.i_kunjungan.dokter)
                $("#i_deposit").html(json.i_kunjungan.deposito)
                $("#i_pjawab").html(json.i_kunjungan.pjawab)
                // end
            }
        })
	}
</script>