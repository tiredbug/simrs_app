<div class="panel panel-primary konten">
	<div class="panel-heading">
		<div class="panel-title bold"><i class='entypo-pencil'></i> ENTRI TINDAKAN PELAYANAN DI IGD</div>
		<div class="panel-options">
			
		</div>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-sm-7">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-sm-3 bold">Nomor Medrec :</label>
						<div class="col-sm-9">
							<input type="text" name="norek" class="form-control" disabled="" value="<?php echo $i['norek']?>">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3 bold">Nomor Kunjungan :</label>
						<div class="col-sm-9">
							<input type="text" name="nokunjungan" class="form-control" disabled="" value="<?php echo $i['nokunjungan']?>">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3 bold">Nama Lengkap :</label>
						<div class="col-sm-9">
							<input type="text" name="nama" class="form-control" disabled="" value="<?php echo $i['nama_lengkap']?>">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3 bold">Jenis Kelamin :</label>
						<div class="col-sm-9">
							<input type="text" name="jk" class="form-control" disabled="" value="<?php echo $i['jk']?>">
						</div>
					</div>
				</form>
			</div>

			<div class="col-sm-5">
				<div class="bs-callout bs-callout-danger nomargin-top nomargin-bottom">
                    <h4><i class="fa fa-bullhorn"></i></h4>
                    <p>Pastikan data pasien benar sebelum melakukan entri data tindakan pelayanan di IGD.<br/>apabila ada kesalahan atau kekeliruan dari aplikasi segera hubungi pihak IT</p>
                    
                </div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="bs-callout bs-callout-success ">
	                <div class="row">
	                	<div class="col-sm-7">
	                		<form class="form-horizontal form_tindakan">
	                			<input type="hidden" name="nokunjungan" id='nokunjungan' value='<?php echo $i['nokunjungan']?>'>
	                			<input type="hidden" name="tgl_daftar" value='<?php echo $i['tgl_daftar']?>'>
	                			<input type="hidden" name="tarif" id="tarif">
	                			<div class="form-group">
	                				<label class="control-label col-sm-3">Kode :</label>
	                				<div class="col-sm-9">
	                					<input type="text" name="kode" class="form-control" id="kode" autofocus="">
	                				</div>
	                			</div>

	                			<div class="form-group">
	                				<label class="control-label col-sm-3">Nama tindakan :</label>
	                				<div class="col-sm-9">
	                					<input type="text" name="t" class="form-control" id="t" >
	                				</div>
	                			</div>

	                			<div class="form-group">
	                				<label class="control-label col-sm-3">Qty :</label>
	                				<div class="col-sm-9">
	                					<input type="text" name="q" class="form-control" id="q" >
	                				</div>
	                			</div>


	                		</form>
	                	</div>

	                	<div class="col-sm-5">
	                		<h4><i class="entypo-menu"></i> Pilihan</h4>
	                		<p class="bx-example">
	                			<button class="btn btn-blue btn-icon icon-left btn_kembali"><i class='entypo-back'></i> Kembali</button>
	                			<button class="btn btn-danger btn-icon icon-left btn_tutup_transaksi"><i class='entypo-block'></i> Tutup transaksi</button>
	                			
	                		</p>
	                		<p class="bx-example">
	                			<button class="btn btn-red btn-icon icon-left btn_hapus_kunjungan"><i class='entypo-trash'></i> Hapus kunjungan</button>
	                			<button class="btn btn-info btn-icon icon-left btn_informasi_lengkap"><i class='entypo-info'></i> Informasi lengkap</button>
	                		</p>

	                	</div>
	                </div>

	                <div class="row">
	                	<div class="col-sm-12">
	                		<table class="table table-bordered table-hover bold tabel_tindakan">
	                			<thead>
	                				<tr>
	                					<th width="30"></th>
	                					<th>Kode</th>
	                					<th>Tindakan</th>
	                					<th>Tarif</th>
	                					<th>@</th>
	                					<th>Total</th>
	                				</tr>
	                			</thead>
	                			<tbody>
	                				<?php 
	                				$stotal=0;
	                				foreach ($t->result() as $t) {
	                					# code...
	                					echo "<tr id='".$t->id."'>
	                						<td><a href='javascript:hapus(\"$t->id\")' class='btn btn-xs btn-red btn-flat'>hapus</a></td>
	                						<td>".$t->kode."</td>
	                						<td>".$t->tindakan."</td>
	                						<td>Rp. ".number_format($t->tarif,0,'.','.')."</td>
	                						<td>".$t->qty."</td>
	                						<td>Rp. ".number_format($t->total,0,'.','.')."</td>
	                					</tr>";
	                					$stotal=$stotal+$t->total;
	                				}
	                				?>
	                			</tbody>
	                		</table>
	                		<div class="well well-sm">
	                			<div class="row">
	                				<div class="col-sm-9">
	                					<h3 class="bold">Sub total <div class="pull-right">:</div></h3><br/>
	                				</div>
	                				<div class="col-sm-3">
	                					<h3 class="bold total">Rp. <?php echo number_format($stotal,2,',','.')?></h3>
	                				</div>
	                			</div>
	                		</div>
	                	</div>
	                </div>
	                    
	            </div>
			</div>
		</div>


	</div>
</div>

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
										<div class="panel-body nopadding">
											<table class="table table-bordered nomargin" id="tabel_history_kunjungan">
												<thead>
													<tr>
														<th>No.</th>
														<th>No. kunjungan</th>
														<th>Tgl masuk</th>
														<th>Tgl keluar</th>
														<th>Jenis kunjungan</th>
													</tr>
												</thead>
												<tbody>
													
												</tbody>
											</table>
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



<script type="text/javascript">
	$("#kode").keypress(function(e)
	{
		var $this=$(this);
		if(e.which=='13')
		{
			if($this.val() =='')
			{
				toastr.warning('Masukkan kode tindakan.');
				$this.focus();
			}
			else
			{
				$.ajax({
					type:'post',
					url:base_url+'igd/kunjungan_api/i_tindakan',
					data:$(".form_tindakan").serialize(),
					dataType:'json',
					error:function(){
						swal({
							title:'Koneksi terputus',
							text:'gagal terhubung ke server mengambil informasi tindakan, periksa jaringan anda dan coba kembali.',
							imageUrl:base_url+'template/assets/img/diskonek.png',
						})
					},
					success:function(json)
					{
						if(json.success)
						{
							$("#t").val(json.data.tindakan)
							$("#tarif").val(json.data.tarif)
							$("#q").val('1').focus()
						}	
						else
						{
							toastr.error(json.pesan_err);
							$(".form_tindakan").trigger('reset');
							$("#tarif").val('')
							$this.focus();
						}
					}
				})
			}
		}
	})

	$("#q").keypress(function(e){
		if(e.which==13)
		{
			$.ajax({
				type:'post',
				url:base_url+'igd/kunjungan_api/insert_tindakan',
				data:$(".form_tindakan").serialize(),
				dataType:'json',
				error:function(){
					swal({
						title:'Koneksi terputus',
						text:'gagal terhubung ke server mengambil menyimpan tindakan, periksa jaringan anda dan coba kembali.',
						imageUrl:base_url+'template/assets/img/diskonek.png',
					})
				},
				success:function(json)
				{
					if(json.success)
					{
						$(".form_tindakan").trigger('reset');
						$("#kode").focus();
						load_data();
					}
					else
					{
						toastr.error(json.pesan_err);
					}
				}
			})
		}
	})

	function load_data()
	{
		$.ajax({
			type:'post',
			url:base_url+'igd/kunjungan_api/load_data_tindakan',
			data:'id='+$("#nokunjungan").val(),
			dataType:'json',
			error:function()
			{
				swal({
					title:'Koneksi terputus',
					text:'gagal terhubung ke server refresh data tindakan, periksa jaringan anda dan coba kembali.',
					imageUrl:base_url+'template/assets/img/diskonek.png',
				})
			},
			success:function(json)
			{
				if(json.success)
				{
					$(".tabel_tindakan tbody").empty();
					$.each(json.data,function(i, v){
                		$(".tabel_tindakan tbody").append("<tr id="+v[0]+">"+
                				"<td><a href='javascript:hapus(\""+v[0]+"\")' class='btn btn-xs btn-red btn-flat'>hapus</a></td>"+
                				"<td>"+v[1]+"</td>"+
                				"<td>"+v[2]+"</td>"+
                				"<td>Rp. "+v[3]+"</td>"+
                				"<td>"+v[4]+"</td>"+
                				"<td>Rp. "+v[5]+"</td>"+
                			"</tr>")
                	})
                	$(".total").html("Rp. "+json.total)
				}
			}
		})
	}

	function hapus(id)
	{
		$.ajax({
			type:'post',
			url:base_url+'igd/kunjungan_api/delete_tindakan',
			data:'id='+id,
			error:function()
			{
				swal({
					title:'Koneksi terputus',
					text:'gagal terhubung ke server menghapus data tindakan, periksa jaringan anda dan coba kembali.',
					imageUrl:base_url+'template/assets/img/diskonek.png',
				})
			},
			success:function()
			{
				load_data();
			}
		})
		
	}

	$(".btn_kembali").click(function(){
		window.location.href=base_url+'igd/kunjungan/data'
	})

	$(".btn_hapus_kunjungan").click(function()
	{
		hapus_kunjungan($("#nokunjungan").val())
	})

	function hapus_kunjungan(nokunjungan)
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
							window.location.href=base_url+'igd/kunjungan/data'
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

	$(".btn_tutup_transaksi").click(function(){
		tutuptransaksi($("#nokunjungan").val());
	})
	function tutuptransaksi(nokunjungan)
	{
		swal({
			title:'Tutup transaksi ?',
			text:'setelah transaksi ditutup, data kunjungan ini tidak bisa diakses lagi dari modul IGD',
			type:'warning',
			showCancelButton:true,
			cancelButtonText:'Batal',
			confirmButtonText:'Iya, tutup transaksi',
			confirmButtonColor:"#CC2424",
			closeOnCancel:true,
			closeOnConfirm:false,
			showLoaderOnConfirm:true
		},
			function()
			{
				$.ajax({
					type:'post',
					url:base_url+'igd/kunjungan_api/tutuptransaksi',
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
							swal("Berhasil",'transaksi berhasil ditutup.','success');
							window.location.href=base_url+'igd/kunjungan/data'
						}
						else
						{
							swal("Gagal",json.pesan_err,'error')
						}
					}
				})
			}
		)
	}
	$(".btn_informasi_lengkap").click(function(){
		load_informasi_kunjungan($("#nokunjungan").val())
		$("#modal_informasi_kunjungan").modal('show')
	})

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

                

                // periksa jumlah history 
                if(json.i_history.length > 0)
                {
                	$("#tabel_history_kunjungan > tbody").empty();
                	var no=1;
                	$.each(json.i_history,function(i, v){
                		$("#tabel_history_kunjungan").append("<tr>"+
                				"<td>"+no+"</td>"+
                				"<td>"+v.no_kunjungan+"</td>"+
                				"<td>"+v.tgl_daftar+"</td>"+
                				"<td>"+v.tgl_checkout+"</td>"+
                				"<td>"+v.jenis+"</td>"+
                			"</tr>");
                		no++;
                	})
                }
                else
                {
                	$("#tabel_history_kunjungan > tbody").empty().append("<tr><td colspan='5'>Belum pernah berobat sebelumnya.</td></tr>")
                }
            }
        })
	}
</script>