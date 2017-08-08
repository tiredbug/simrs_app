<div class="panel panel-primary konten">
	<div class="panel-heading">
		<h4 class="panel-title bold"><i class="entypo-pencil"></i> HALAMAN INPUT HASIL PEMERIKSAAN LABORATURIUM</h4>
	</div>

	<div class="panel-body">
		<form class="form-horizontal form-data">
		<input type="hidden" name="nolab" value="<?php echo $_GET['nolab']?>" class='nolab'>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label class="control-label col-sm-3">No. Register :</label>
					<div class="col-sm-9">
						<input type="text" name="noregis" value="<?php echo $r['nolab']?>"  class="form-control bold" disabled=''>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">No.Medrec :</label>
					<div class="col-sm-9">
						<input type="text" name="norek" value="<?php echo $r['norek']?>" class="form-control bold" disabled=''>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">Nama :</label>
					<div class="col-sm-9">
						<input type="text" name="nama" value="<?php echo $r['nama']?>" class="form-control bold" disabled=''>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">Jenis-Kelamin :</label>
					<div class="col-sm-9">
						<input type="text" name="jk" value="<?php echo $r['jk']?>" class="form-control bold" disabled=''>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">Alamat :</label>
					<div class="col-sm-9">
						<textarea class="form-control bold" rows='3' name="alamat" disabled=''><?php echo $r['alamat']?></textarea>
					</div>
				</div>

			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label class="control-label col-sm-3">Tgl Register :</label>
					<div class="col-sm-9">
						<input type="text" name="tgl" value="<?php echo $r['tgl']?>" class="form-control bold" disabled=''>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">Asal-Unit :</label>
					<div class="col-sm-9">
						<input type="text" name="asal" value="<?php echo $r['asal']?>" class="form-control bold" disabled=''>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">M. Bayar :</label>
					<div class="col-sm-9">
						<input type="text" name="bayar" value="<?php echo $r['bayar']?>" class="form-control bold" disabled=''>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">Dokter Pengirim :</label>
					<div class="col-sm-9">
						<input type="text" name="dokterp" value="<?php echo $r['dokterp']?>" class="form-control bold" disabled=''>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">Dokter Periksa :</label>
					<div class="col-sm-9">
						<input type="text" name="dokterl" value="<?php echo $r['dokter']?>" class="form-control bold" disabled=''>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">Register Oleh :</label>
					<div class="col-sm-9">
						<input type="text" name="user" value="<?php echo $r['user']?>" class="form-control bold" disabled=''>
					</div>
				</div>

			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered table-hover"> 
					<thead>
						<tr>
							<th>KODE</th>
							<th>PEMERIKSAAN</th>
							<th>NILAI NORMAL</th>
							<th>SATUAN</th>
							<th>METODE</th>
							<th>HASIL</th>
							<th>KETERANGAN</th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach ($list->result() as $l) {
						 	# code...
						 	switch ($l->jenis) {
						 		case 'paket':
						 			# code...
						 			echo"
						 			<tr>
						 				<td class='bold'>LAB07".$l->kode."</td>
										<td>".$l->produk."</td>
										<td>".$l->normal."</td>
										<td>".$l->satuan."</td>
										<td></td>
										<td></td>
										<td></td>
						 			</tr>
						 			";
						 			break;
						 		
						 		case 'list':
						 			# code...
						 			// cek sublist
						 			$cek_sub_list=$this->m_function->cek_sub_list_join_produk($l->kode);
						 			if($cek_sub_list->num_rows() > 0)
						 			{
						 				echo"
							 			<tr>
							 				<td class='bold'>LAB0".$l->kode."</td>
											<td><i class='entypo-right'></i>".$l->produk."</td>
											<td>".$l->normal."</td>
											<td>".$l->satuan."</td>
											<td></td>
											<td></td>
											<td></td>
							 			</tr>
							 			";

						 				foreach ($cek_sub_list->result() as $sl) {
						 					# code...
						 					echo"
								 			<tr>
								 				<td class='bold'></td>
												<td><i class='entypo-level-down'></i>".$sl->produk."</td>
												<td>".$sl->nilai_normal."</td>
												<td>".$sl->satuan."</td>
												<td>
													<select class='form-control' name='metode_".$sl->id."'>
														<option value=''>-- Pilih --</option>
														<option value='Sederhana'";
														echo $sl->metode_periksa=="Sederhana"?'selected':'';
														echo">Sederhana</option>
														<option value='Canggih'";
														echo $sl->metode_periksa=="Canggih"?'selected':'';
														echo">Canggih</option>
													</select>
												</td>
												<td>
													<input type='text' class='form-control' name='hasil_".$sl->id."' value='".$sl->hasil_periksa."'/>
												</td>
												<td>
													<input type='text' class='form-control' name='ket_".$sl->id."' value='".$sl->keterangan."'/>
												</td>
								 			</tr>
								 			";

						 				}
						 			}
						 			else
						 			{
						 				echo"
							 			<tr>
							 				<td class='bold'>&nbsp&nbsp&nbsp<i class='entypo-level-down'></i></td>
											<td><i class='entypo-right'></i>".$l->produk."</td>
											<td>".$l->normal."</td>
											<td>".$l->satuan."</td>
											<td>
												<select class='form-control' name='metode_".$l->id."'>
													<option value=''>-- Pilih --</option>
													<option value='Sederhana'";
													echo $l->metode_periksa=="Sederhana"?'selected':'';
													echo">Sederhana</option>
													<option value='Canggih'";
													echo $l->metode_periksa=="Canggih"?'selected':'';
													echo">Canggih</option>
												</select>
											</td>
											<td>
												<input type='text' class='form-control' name='hasil_".$l->id."' value='".$l->hasil_periksa."'/>
											</td>
											<td>
												<input type='text' class='form-control' name='ket_".$l->id."' value='".$l->keterangan."'/>
											</td>
							 			</tr>
							 			";
						 			}
						 			break;
						 	}
						 } 
					?>
						
					</tbody>
				</table>
			</div>
			<div class="col-sm-12">
				<textarea placeholder="Keterangan lain...." class="form-control" name="keterangan" rows="3"><?php echo$r['keterangan']?></textarea>
			</div>

			<div class="col-sm-12">

			</div>


			<div class="col-sm-12">
				<p class="" style="margin-top: 5px">
					<button class="btn btn-success btn-simpan" type="button">Simpan hasil saja</button>
					<button class="btn btn-danger btn-simpan-c" type="button">Simpan hasil dan checkout kunjungan</button>
				</p>
			</div>

		</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	$(".btn-simpan").click(function(){
		var $this=$(this);
		var data=$(".form-data").serialize()
		$this.html("<i class='fa fa-spin fa-spinner'></i> Menyimpan hasil lab...");
		$.ajax({
			type:"post",
			url:base_url+'e-lab/kunjungan_api/simpan_hasil',
			data:data,
			dataType:'json',
			error:function()
			{
				swal("Koneksi terputus",'Koneksi ke server terputus, periksa koneksi anda lalu coba lagi.','error');
				$this.html("Simpan hasil saja");
			},
			success:function(json)
			{
				if(json.success)
				{
					swal({
						title:"Cetak hasil ?",
						text:'data hasil pemeriksaan laboraturium berhasil disimpan, apakah ingin melanjutkan cetak hasil ?',
						showCancelButton:true,
						imageUrl:base_url+'template/assets/img/printer.png',
						cancelButtonText:'Tidak',
						confirmButtonText:'Iya, Cetak',
						confirmButtonColor:"#008d45",
						closeOnConfirm:true
					},
						function(){
							var win=window.open(base_url+'e-lab/kunjungan/cetakhasil?nolab='+$(".nolab").val(),'_blank');
						}
					)

					$this.html("Simpan hasil saja");
				}
				else
				{
					$this.html("Simpan hasil saja");
				}
			}
		})
	})

	$(".btn-simpan-c").click(function(){
		var $this=$(this);
		var data=$(".form-data").serialize()
		$this.html("<i class='fa fa-spin fa-spinner'></i> Menyimpan hasil lab...");
		$.ajax({
			type:"post",
			url:base_url+'e-lab/kunjungan_api/simpan_hasil',
			data:data+'&c=y',
			dataType:'json',
			error:function()
			{
				swal("Koneksi terputus",'Koneksi ke server terputus, periksa koneksi anda lalu coba lagi.','error');
				$this.html("Simpan hasil saja");
			},
			success:function(json)
			{
				if(json.success)
				{
					$this.html("Simpan hasil dan checkout kunjungan");
					swal({
						title:"Cetak hasil ?",
						text:'data hasil pemeriksaan laboraturium berhasil disimpan, apakah ingin melanjutkan cetak hasil ?',
						showCancelButton:true,
						imageUrl:base_url+'template/assets/img/printer.png',
						cancelButtonText:'Tidak',
						confirmButtonText:'Iya, Cetak',
						confirmButtonColor:"#008d45",
						closeOnConfirm:true
					},
						function(isConfirm){
							if(isConfirm){
								var win=window.open(base_url+'e-lab/kunjungan/cetakhasil?nolab='+$(".nolab").val(),'_blank');
								window.location.href=base_url+'e-lab/kunjungan/datakunjungan';
							}
							else
							{
								window.location.href=base_url+'e-lab/kunjungan/datakunjungan';
							}
							
						}
					)
					
				}
				else
				{
					$this.html("Simpan hasil dan checkout kunjungan");
				}
			}
		})
	})
</script>