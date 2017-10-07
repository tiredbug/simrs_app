<style type="text/css">

.table-fixed{
  width: 100%;
  background-color: #f3f3f3;
}

.table-fixed  tbody{
    height:300px;
    overflow-y:auto;
    width: 100%;
    }
.table-fixed thead,tbody,tfoot,tr,td,th{
    display:block;
  }
.table-fixed tbody td{
    
      float:left;
    
  }
.table-fixed thead > tr > th, .table-fixed tfoot > tr > th{
    
       float:left;
       background-color: #f39c12;
       border-color:#e67e22;
   
  }
</style>
<div class="panel konten">
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-6">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-sm-3">No. MR :</label>
						<div class="col-sm-9">
							<input type="text" name="" disabled="" class="form-control" value="<?php echo $i['nomr']?>">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3">No. Asuransi :</label>
						<div class="col-sm-9">
							<input type="text" name="" disabled="" class="form-control" value="<?php echo $i['no_as']?>">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3">No. NIK :</label>
						<div class="col-sm-9">
							<input type="text" name="" disabled="" class="form-control" value="<?php echo $i['nik']?>">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3">Nama Lengkap :</label>
						<div class="col-sm-9">
							<input type="text" name="" disabled="" class="form-control" value="<?php echo $i['nama']?>">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3">Jenis-Kelamin :</label>
						<div class="col-sm-9">
							<input type="text" name="" disabled="" class="form-control" value="<?php echo $i['jk']?>">
						</div>
					</div>


				</form>
			</div>
			<div class="col-sm-6">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-sm-3">No. Kunjungan :</label>
						<div class="col-sm-9">
							<input type="text" name="" disabled="" class="form-control" value="<?php echo $i['no_k']?>">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3">Tgl Masuk :</label>
						<div class="col-sm-9">
							<input type="text" name="" disabled="" class="form-control" value="<?php echo $i['jam_masuk']?>">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3">Dokter :</label>
						<div class="col-sm-9">
							<input type="text" name="" disabled="" class="form-control" value="<?php echo $i['dokter']?>">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3">Diagnosa :</label>
						<div class="col-sm-9">
							<input type="text" name="" disabled="" class="form-control" value="<?php echo $i['icd']?>">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3">Cara Bayar :</label>
						<div class="col-sm-9">
							<input type="text" name="" disabled="" class="form-control" value="<?php echo $i['cb']?>">
						</div>
					</div>

				</form>
			</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-sm-7">
				<table class="table  tabel_billing table-fixed">
					<thead>
						<tr>
							<th class="col-xs-1">Kode</th>
							<th class="col-xs-4">Tindakan</th>
							<th class="col-xs-3">Tarif</th>
							<th class="col-xs-1">Qty</th>
							<th class="col-xs-3">Total</th>
						</tr>
					</thead>
					<tbody >
						<?php 
						$total=0;
						switch ($_GET['asal']) {
							case 'igd':
								# code...
							foreach ($i_t_igd->result() as $r) {
								# code...
								echo "<tr>
									<td class='col-xs-1'>".strtoupper($r->kode)."</td>
									<td class='col-xs-4'>".$r->tndk."</td>
									<td class='col-xs-3'>Rp. ".number_format($r->tarif,2,',','.')."</td>
									<td class='col-xs-1'>".$r->qty."</td>
									<td class='col-xs-3'>Rp. ".number_format($r->total,2,',','.')."</td>
								</tr>";
								$total=$total+$r->total;
							}
								break;
						}
						?>
					</tbody>

					<tfoot >
						<tr >
							<th colspan="4" class="bold col-xs-8" style="color:#222;font-size:16px">Total</th>
							<th  class="bold col-xs-4" style="color:#222;font-size:16px">Rp. <?php echo number_format($total,2,',','.')?></th>
						</tr>
					</tfoot>
				</table> 
			</div>

			<div class="col-sm-5">
				<form class="form-horizontal well well-sm">
					<div class="form-group">
						<label class="control-label col-sm-4">Tgl Keluar :</label>
						<div class="col-sm-8">
							<input type="text" name="tgl_keluar" class="form-control ">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4">Jam Keluar :</label>
						<div class="col-sm-8">
							<input type="text" name="tgl_keluar" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4">Pembayaran :</label>
						<div class="col-sm-8">
							<input type="text" name="tgl_keluar" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4">Tagihan :</label>
						<div class="col-sm-8">
							<div class="input-group">
								<span class="input-group-addon bold">Rp </span>
								<input type="text" name="tgl_keluar" class="form-control">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4">Deposit :</label>
						<div class="col-sm-8">
							<div class="input-group">
								<span class="input-group-addon bold">Rp </span>
								<input type="text" name="tgl_keluar" class="form-control">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4">Saldo Pasien :</label>
						<div class="col-sm-8">
							<div class="input-group">
								<span class="input-group-addon bold ">Rp </span>
								<input type="text" name="tgl_keluar" class="form-control">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4">Jumlah Bayar :</label>
						<div class="col-sm-8">
							<div class="input-group">
								<span class="input-group-addon bold ">Rp </span>
								<input type="text" name="tgl_keluar" class="form-control">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4">Kembalian :</label>
						<div class="col-sm-8">
							<div class="input-group">
								<span class="input-group-addon bold ">Rp </span>
								<input type="text" name="tgl_keluar" class="form-control">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4">Sisa Saldo :</label>
						<div class="col-sm-8">
							<div class="input-group">
								<span class="input-group-addon bold ">Rp </span>
								<input type="text" name="tgl_keluar" class="form-control">
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-4">
							<button class="btn btn-success" type="button">Checkout</button>
							<button class="btn btn-success" type="button" disabled="">Cetak Billing</button>
						</div>
					</div>


				</form>
			</div>
			
		</div>
	</div>
</div>
