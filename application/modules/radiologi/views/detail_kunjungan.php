<div class="panel panel-primary konten">
	<div class="panel-heading">
		<div class="panel-title bold">
			<i class='entypo-search'></i> Detail Kunjungan
		</div>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-sm-6">
				<h6 class="bold"><i class='entypo-user'></i> Data Pasien</h6>
				<table class="table table-stripe">
					<tbody>
						<tr>
							<th>No. Kunjungan</th>
							<th>:</th>
							<th><?php echo $d['no_k']?></th>
						</tr>

						<tr>
							<th>Tgl Masuk RS</th>
							<th>:</th>
							<th><?php echo $d['tgl_daftar']?></th>
						</tr>

						<tr>
							<th>Cara Bayar</th>
							<th>:</th>
							<th><?php echo $d['cb']?></th>
						</tr>

						<tr>
							<th>Cara Rujuk</th>
							<th>:</th>
							<th><?php echo $d['c_r']?></th>
						</tr>

						<tr>
							<th>Asal Rujuk</th>
							<th>:</th>
							<th><?php echo $d['asal_rujuk']?></th>
						</tr>

						<tr>
							<th>No Rujukan</th>
							<th>:</th>
							<th><?php echo $d['no_r']?></th>
						</tr>

						<tr>
							<th>Kelas</th>
							<th>:</th>
							<th><?php echo $d['kls']?></th>
						</tr>

						<tr>
							<th>Diagnosa Masuk</th>
							<th>:</th>
							<th><?php echo $d['icd']?></th>
						</tr>

						<tr>
							<th>No. Sep</th>
							<th>:</th>
							<th><?php echo $d['sep']?></th>
						</tr>

						<tr>
							<th>Jenis Pasien</th>
							<th>:</th>
							<th><?php echo $d['j_p']?></th>
						</tr>

						<tr>
							<th>Umur</th>
							<th>:</th>
							<th><?php echo $d['umur']?></th>
						</tr>

					</tbody>
				</table>
			</div>

			<div class="col-sm-6 ">
				<h6 class="bold"><i class='entypo-info'></i> Data Kunjungan</h6>
				<table class="table table-stripe">
					<tbody>
						<tr>
							<th>No. MR</th>
							<th>:</th>
							<th><?php echo $d['norek']?></th>
						</tr>

						<tr>
							<th>No. NIK</th>
							<th>:</th>
							<th><?php echo $d['nik']?></th>
						</tr>

						<tr>
							<th>No. BPJS</th>
							<th>:</th>
							<th><?php echo $d['no_as']?></th>
						</tr>

						<tr>
							<th>Nama</th>
							<th>:</th>
							<th><?php echo $d['nama']?></th>
						</tr>

						<tr>
							<th>Jenis Kelamin</th>
							<th>:</th>
							<th><?php echo $d['jk']?></th>
						</tr>

						<tr>
							<th>Agama</th>
							<th>:</th>
							<th><?php echo $d['agama']?></th>
						</tr>

						<tr>
							<th>Tp/Tgl Lahir</th>
							<th>:</th>
							<th><?php echo $d['tp_tgllahir']?></th>
						</tr>

						<tr>
							<th>Status</th>
							<th>:</th>
							<th><?php echo $d['stt']?></th>
						</tr>

						<tr>
							<th>No. Hp</th>
							<th>:</th>
							<th><?php echo $d['hp_pasien']?></th>
						</tr>

						<tr>
							<th>Alamat</th>
							<th>:</th>
							<th><?php echo $d['alamat_ktp']?></th>
						</tr>

					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
