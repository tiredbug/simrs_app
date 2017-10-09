<style type="text/css">

.table-bill{
  width: 100%;
  background-color: #f3f3f3;
}

.table-bill tbody{
    height:300px;
    overflow-y:auto;
    width: 100%;
    }
.table-bill thead > tr > td >th,.table-bill tbody > tr > td >th, .table-bill tfoot > tr > td >th {
    display:block;
  }
.table-bill tbody td{
    
      float:left;
    
  }
.table-bill thead > tr > th, .table-bill tfoot > tr > th{
    
       float:left;
       background-color: #f39c12;
       border-color:#e67e22;
       font-weight: bold;
   
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
		<hr>
		<div class="row">
			<div class="col-sm-7">
				<table class="table  tabel_billing table-fixed table-bill">
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
									<td class='col-xs-3'>Rp ".number_format($r->tarif,2,',','.')."</td>
									<td class='col-xs-1'>".$r->qty."</td>
									<td class='col-xs-3'>Rp ".number_format($r->total,2,',','.')."</td>
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
				<form class="form-horizontal well well-sm form_checkout">
					<input type="hidden" name="nobilling" class="nobilling" value="">
					<div class="form-group">
						<label class="control-label col-sm-4">Tgl Keluar :</label>
						<div class="col-sm-8">
							<div class="input-group">
								<div class="input-group-addon">
	                                <a href="#"><i class="entypo-calendar"></i></a>
	                            </div>
	                            <input type="text" class="form-control datepicker" name="tgl_keluar" id="tgl_keluar" data-format="dd-mm-yyyy" value='<?php echo date("d-m-Y")?>'>
	                            
	                        </div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4">Jam Keluar :</label>
						<div class="col-sm-8">
							<div class="input-group">
								<div class="input-group-addon">
	                                <a href="#"><i class="entypo-clock"></i></a>
	                            </div>
	                            <input type="text" class="form-control timepicker" data-template="dropdown" data-show-seconds="true" data-default-time="<?php echo date("H:i:s")?>" data-show-meridian="false" data-minute-step="5" data-second-step="5"  id="jam_keluar" name="jam_keluar" />      
	                                
	                        </div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4">Keterangan :</label>
						<div class="col-sm-8">
							<select class="form-control " name="keterangan">
								<option value="">-- Pilih --</option>
								<?php 
								foreach ($i_k->result() as $k) {
									# code...
									echo "<option value='".$k->id_stt."'>".$k->stt_keluar."</option>";
								}
								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4">Tagihan :</label>
						<div class="col-sm-8">
							<div class="input-group">
								<span class="input-group-addon bold">Rp </span>
								<input type="text" name="tagihan" class="form-control bold tagihan" value="<?php echo number_format($total,0,'.','.')?>" disabled>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4">Deposit :</label>
						<div class="col-sm-8">
							<div class="input-group">
								<span class="input-group-addon bold">Rp </span>
								<input type="text" name="deposit" class="form-control deposit bold" value="<?php echo number_format($i['deposito'],0,'.','.')?>" disabled>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4">Saldo Pasien :</label>
						<div class="col-sm-8">
							<div class="input-group">
								<span class="input-group-addon bold ">Rp </span>
								<input type="text" name="saldo" class="form-control saldo bold" value="<?php echo number_format('0',0,'.','.')?>" disabled>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4">Jumlah Bayar :</label>
						<div class="col-sm-8">
							<div class="input-group">
								<span class="input-group-addon bold ">Rp </span>
								<input type="text" name="jumlah_bayar" class="form-control jumlah_bayar bold" value="0" >
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4">Kembalian :</label>
						<div class="col-sm-8">
							<div class="input-group">
								<span class="input-group-addon bold ">Rp </span>
								<input type="text" name="kembalian" class="form-control bold kembalian" disabled="" value="0">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4">Piutang :</label>
						<div class="col-sm-8">
							<div class="input-group">
								<span class="input-group-addon bold ">Rp </span>
								<input type="text" name="piutang" class="form-control bold piutang" disabled="" value="0">
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-4">
							<button class="btn btn-success btn_checkout" type="button" >Checkout</button>
							<button class="btn btn-success btn_cetak_billing" type="button" disabled="">Cetak Billing</button>
						</div>
					</div>


				</form>
			</div>
			
		</div>
	</div>
</div>

<script src="<?php echo base_url()?>template/neon/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url()?>template/neon/js/bootstrap-timepicker.min.js"></script>

<script type="text/javascript">
	$(document).ready(function()
	{
		kalkulasi();
	})


	$(".jumlah_bayar").keyup(function(e){
		kalkulasi();
	})

	function kalkulasi()
	{
		var s_tagihan=$(".tagihan").val();
		var s_deposit=$(".deposit").val();
		var s_saldo=$(".saldo").val();
		var s_jmlh=$(".jumlah_bayar").val();
		var s_kembalian=$(".kembalian").val();
		var s_piutang=$(".piutang").val();


		var int_tagihan=parseInt(s_tagihan.split('.').join(''));
		var int_deposit=parseInt(s_deposit.split('.').join(''));
		var int_saldo=parseInt(s_saldo.split('.').join(''));
		var int_jmlh=parseInt(s_jmlh.split('.').join(''));
		var int_kembalian=parseInt(s_kembalian.split('.').join(''));
		var int_piutang=parseInt(s_piutang.split('.').join(''));
		if(s_jmlh=='')
		{
			int_jmlh='0';
		}
		$(".jumlah_bayar").val(parseInt(int_jmlh).format(0, 3, '.', '.'));
		var h_kembalian='';
		var h_piutang='';

		var sisa=int_tagihan-int_deposit;
		if(sisa > 0)
		{
			sisa1=int_jmlh-sisa;
			if(sisa1>0)
			{
				h_kembalian=sisa1;
				h_piutang='0';
			}
			else
			{
				h_kembalian='0';
				h_piutang=Math.abs(sisa1);
			}
		}
		else
		{
			h_piutang='0';
			h_kembalian=int_jmlh+(int_deposit-int_tagihan)
		}
		$(".kembalian").val(parseInt(h_kembalian).format(0, 3, '.', '.'));
		$(".piutang").val(parseInt(h_piutang).format(0, 3, '.', '.'));
	}

	Number.prototype.format = function(n, x, s, c) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
        num = this.toFixed(Math.max(0, ~~n));
    return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));

	};

	$(".btn_checkout").click(function(){
    	swal({
    		title:"Checkout ?",
    		text:"checkout pasien & buat billing tagihan ?",
    		confirmButtonText:'Checkout',
    		confirmButtonColor:"#3085d6",
    		showCancelButton:true,
    		cancelButtonText:'Batal',
    		imageUrl:base_url+'template/assets/img/confirm.png',
    		closeOnConfirm:false
    	},
    		function()
    		{
    			var s_tagihan=$(".tagihan").val();
				var s_deposit=$(".deposit").val();
				var s_saldo=$(".saldo").val();
				var s_jmlh=$(".jumlah_bayar").val();
				var s_kembalian=$(".kembalian").val();
				var s_piutang=$(".piutang").val();

    			var no_kunjungan='<?php echo $_GET['nokunjungan']?>';
    			var int_tagihan=parseInt(s_tagihan.split('.').join(''));
				var int_deposit=parseInt(s_deposit.split('.').join(''));
				var int_saldo=parseInt(s_saldo.split('.').join(''));
				var int_piutang=parseInt(s_piutang.split('.').join(''));


    			$.ajax({
    				type:'post',
    				url:base_url+'kasir/kunjungan_api/proses_checkout',
    				data:'no_k='+no_kunjungan+'&tagihan='+int_tagihan+'&deposit='+int_deposit+'&saldo='+int_saldo+'&piutang='+int_piutang+'&'+$(".form_checkout").serialize(),
    				dataType:'json',
    				error:function()
    				{
    					swal({
    						title:'Koneksi Terputus',
    						text:'periksa koneksi anda ke server, lalu coba lagi.',
    						imageUrl:base_url+'template/assets/img/diskonek.png'
    					})
    				},
    				success:function(json)
    				{
    					if(json.success)
    					{
    						swal({
    							title:'Berhasil',
    							text:"catat nomor billing <b style='color:red'>"+json.no_billing+"</b> untuk mencetak billing lain kali, cetak billing sekarang ?",
    							type:'success',
    							html: true,
    							showCancelButton:true,
    							confirmButtonText:"Cetak Billing",
    							confirmButtonColor:"#3085d6",
    							closeOnConfirm:true
    						},
    							function ()
    							{
    								window.open(base_url+'kasir/kunjungan/cetakbilling?nobilling='+json.no_billing,'_blank')
    							}
    						)
    						$(".btn_cetak_billing").prop('disabled',false)
    						$(".nobilling").val(json.no_billing);
    					}
    					else
    					{
    						swal({
    							title:'Gagal',
    							text:json.message,
    							type:'error'
    						})
    					}
    				}
    			})
    		}
    	)
    })

    $(".btn_cetak_billing").click(function(){
    	window.open(base_url+'kasir/kunjungan/cetakbilling?nobilling='+$(".nobilling").val(),'_blank');
    })

</script>