<div class="panel panel-warning konten"  style="position: static; zoom: 1;">
	<div class="panel-heading">
		<div class="panel-title">
			<i class="entypo-retweet"></i> Checkout
		</div>
		<div class="panel-options">
			<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
	        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
	        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
	        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
		</div>
	</div>
	<div class="panel-body body-form-gue">
		
		<table class="table table-bordered datatable table-hover nomargin-bottom" >
			<tr>
		    	<th class="label-tabel" style="width: 30%">No. Medrec</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="padding:0px;padding-left: 5px;padding-top: 2px;">
		    		<div class="col-sm-3 nopadding">
		    			<input type="text" name="nrm" id="nrm" autofocus="" class="form-control input-sm" style="font-size:13px;font-weight:bold">
		    		</div>
		    	</th>
		    </tr>
		    <form class="form-billing">
		    <input type="hidden" name="nomor_kunjungan" id="nomor_kunjungan">
			<input type="hidden" name="deposito" id="deposito">
			<input type="hidden" name="jumlah_tagihan" id="jumlah_tagihan">
			<input type="hidden" name="sisa_byr" id="sisa_byr">
			<input type="hidden" name="kembali" id="kembali">
		    <tr>
		    	<th class="label-tabel" style="width: 30%">Nama Lengkap</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="font-weight: bold;" id="nama"></th>
		    </tr>

		    <tr>
		    	<th class="label-tabel" style="width: 30%">No. Nik dan BPJS</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="font-weight: bold;" id="card"></th>
		    </tr>

		    <tr>
		    	<th class="label-tabel" style="width: 30%">Cara Pembayaran</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="font-weight: bold;" id="cb"></th>
		    </tr>

		    <tr>
		    	<th class="label-tabel" style="width: 30%">Kelompok Peserta</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="font-weight: bold;" id="klp"></th>
		    </tr>

		    <tr>
		    	<th class="label-tabel" style="width: 30%">Kelas Perawatan</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="font-weight: bold;" id="kls"></th>
		    </tr>

		    <tr>
		    	<th class="label-tabel" style="width: 30%">Poliklinik</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="font-weight: bold;" id="poli"></th>
		    </tr>

		    <tr>
		    	<th class="label-tabel" style="width: 30%">Dokter</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="font-weight: bold;" id="dr"></th>
		    </tr>
		    <tr>
		    	<th class="label-tabel" style="width: 30%">Tgl, Jam Daftar</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="font-weight: bold;" id="tjd"></th>
		    </tr>

		    <tr>
		    	<th class="label-tabel" style="width: 30%">Tgl, Jam Checkout</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="padding:0px;padding-left: 5px;padding-top: 2px;">
		    		<div class="col-sm-1 nopadding">
		    			<select class="form-control input-sm" name="tgl" id="tgl">
		    				<?php 
		    				for ($i=1; $i < 31+1; $i++) { 
		    					# code...
		    					$i=$i<10?'0'.$i:$i;
		    					echo"<option value='".$i."'";
		    					echo$i==date("d")?'selected':'';
		    					echo">".$i."</option>";
		    				}
		    				?>
		    			</select>
		    		</div>
		    		<div class="col-sm-2 nopadding margin-left" >
		    			<select class="form-control input-sm" name='bln' id="bln">
			    			<?php 
			    			for ($i=1; $i < 12+1; $i++) { 
			    				# code...
			    				$i=$i<10?'0'.$i:$i;
			    				echo"<option value='".$i."'";
			    				echo$i==date("m")?'selected':'';
			    				echo">".bln($i)."</option>";
			    			}
			    			?>
		    			</select>
		    		</div>
		    		<div class="col-sm-2 nopadding margin-left" >
		    			<select name="tahun" id="tahun" class="form-control input-sm">
		    				<?php 
		    				$thn=date("Y");
		    				for ($i=$thn; $i >= $thn-2; $i--) { 
		    					# code...
		    					echo"<option value='".$i."'>".$i."</option>";
		    				}
		    				?>
		    			</select>
		    		</div>
		    		<div class="col-sm-1 nopadding margin-left" >
		    			<select name="jam" id="jam" class="form-control input-sm">
		    				<?php 
			    			for ($i=0; $i < 23+1; $i++) { 
			    				# code...
			    				$i=$i<10?'0'.$i:$i;
			    				echo"<option value='".$i."'";
			    				echo$i==date("h")?'selected':'';
			    				echo">".$i."</option>";
			    			}
			    			?>
		    			</select>
		    		</div>
		    		<div class="col-sm-1 nopadding margin-left" >
		    			<select name="menit" id="menit" class="form-control input-sm">
		    			<?php 
		    			for ($i=0; $i < 60+1; $i++) { 
		    				# code...
		    				$i=$i<10?'0'.$i:$i;
		    				echo"<option value='".$i."'";
		    				echo$i==date("m")?'selected':'';
		    				echo">".$i."</option>";
		    			}
		    			?>
		    			</select>
		    		</div>
		    		<div class="col-sm-1 nopadding margin-left" >
		    			<select name="ss" id="ss" class="form-control input-sm">
		    			<?php 
		    			for ($i=0; $i < 60+1; $i++) { 
		    				# code...
		    				$i=$i<10?'0'.$i:$i;
		    				echo"<option value='".$i."'";
		    				echo$i==date("i")?'selected':'';
		    				echo">".$i."</option>";
		    			}
		    			?>
		    			</select>
		    		</div>
		    	</th>
		    </tr>
		    <tr>
		    	<th class="label-tabel" style="width: 30%">Metode Checkout</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th>
		    		<div class="col-sm-4 nopadding">
		    			<select class="form-control input-sm" name="mtd_c" id="mtd_c">
		    				<?php 
		    				foreach ($metode->result() as $m) {
		    					# code...
		    					echo"<option value='".$m->id."'>".$m->nama_metode."</option>";
		    				}
		    				?>
		    			</select>
		    		</div>
		    	</th>
		    </tr>
		    <tr>
		    	<th class="label-tabel" style="width: 30%">Jumlah Tagihan</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="font-weight: bold;" id="tg"></th>
		    </tr>

		    <tr>
		    	<th class="label-tabel" style="width: 30%">Deposit</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="font-weight: bold;" id="dp"></th>
		    </tr>

		    <tr>
		    	<th class="label-tabel" style="width: 30%">Sisa Tagihan</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="font-weight: bold;" id="sisa"></th>
		    </tr>

		    <tr>
		    	<th class="label-tabel" style="width: 30%">Jumlah Pembayaran</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="padding:0px;padding-left: 5px;padding-top: 2px;">
		    		<div class="col-sm-1" style="font-weight: bold;padding-left:4px;padding-top: 4px;width: 4%">
		    			Rp. 
		    		</div>
		    		<div class="col-sm-3 nopadding">
		    			<input type="number" name="jum_bayar" id="jum_bayar" class="form-control input-sm" style="font-size:14px;font-weight:bold">
		    		</div>
		    	</th>
		    </tr>

		    <tr>
		    	<th class="label-tabel" style="width: 30%">Kembalian</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="font-weight: bold;" id="kmb"></th>
		    </tr>

		</table>
	</form>
	</div>
	<div class="panel-heading">
		<div class="panel-title">
		</div>
		<div class="pull-right" style="margin:5px;">
			<button class="btn btn-success btn-checkout">Check Out</button>
			<button class="btn btn-success btn-cetak"><i class='entypo-print'></i> Cetak Billing</button>
		</div>
	</div>
</div>
<style type="text/css">
	.cetak {
		display: none;
	}
</style>
<div class="cetak">
</div>
<script>
    $(document).ready(function(){
    	

        $("#nrm").keypress(function(e){
            if(e.which==13)
            {
            	loading_show();
            	$.ajax({
            		type:"POST",
            		url:base_url+'kasirrajal/checkout_api/cek_norek',
            		data:'norek='+$("#nrm").val(),
            		dataType:'json',
            		error:function()
            		{
            			alert("Gagal terhubung ke server.");
            			loading_hide();
            		},
            		success:function(json)
            		{
            			if(json.success)
            			{
            				$("#nama").html(json.data.nama)
            				$("#card").html(json.data.card)
            				$("#cb").html(json.data.cb)
            				$("#klp").html(json.data.klp)
            				$("#kls").html(json.data.kls)
            				$("#poli").html(json.data.poli)
            				$("#dr").html(json.data.dr)
            				$("#tjd").html(json.data.tjd)
            				$("#dp").html(json.data.dp)
            				$("#tg").html(json.data.tg)
            				$("#sisa").html(json.data.ss)
            				$("#kmb").html(json.data.kmb)
            				$("#nomor_kunjungan").val(json.data.no_kunjungan);
            				$("#deposito").val(json.data.dt_dp);
            				$("#jumlah_tagihan").val(json.data.dt_tg)
            				$("#kembali").val(json.data.dt_kembali)


            				$("#tgl").focus();
            			}
            			else
            			{
            				alert(json.pesan_err)

            				$("#nama").html('')
            				$("#card").html('')
            				$("#cb").html('')
            				$("#klp").html('')
            				$("#kls").html('')
            				$("#poli").html('')
            				$("#dr").html('')
            				$("#tjd").html('')
            				$("#dp").html('')
            				$("#tg").html('')
            				$("#sisa").html('')
            				$("#kmb").html('')
            				$("#nomor_kunjungan").val('');
            				$("#deposito").val('');
            				$("#jumlah_tagihan").val('')
            				$("#kembali").val('')

            			}
            			loading_hide()
            		}
            	})
            }
        })

      	formatMoney = function(n, c, d, t){
		var n = n, 
		    c = isNaN(c = Math.abs(c)) ? 2 : c, 
		    d = d == undefined ? "." : d, 
		    t = t == undefined ? "," : t, 
		    s = n < 0 ? "-" : "", 
		    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
		    j = (j = i.length) > 3 ? j % 3 : 0;
		   	return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");

		 };
		 
    })
    $("#tgl").change(function(){
    	$("#bln").focus();
    })
    $("#bln").change(function(){
    	$("#tahun").focus();
    })
    $("#tahun").change(function(){
    	$("#jam").focus();
    })
    $("#jam").change(function(){
    	$("#menit").focus();
    })
    $("#menit").change(function(){
    	$("#ss").focus();
    })
    $("#ss").change(function(){

    })
    $("#jum_bayar").keyup(function(){
    	var jumlah=$(this).val();
    	var deposito=$("#deposito").val();
    	var jumlah_tagihan=$("#jumlah_tagihan").val();
    	var kembali=$("#kembali").val();
    	var sisa='Rp. 0';
    	var kembalian='Rp. 0';

    	if(kembali > 0)
    	{
    		kembalian=kembali+jumlah;
    	}
    	else
    	{
    		if(jumlah-jumlah_tagihan < 0)
    		{
    			sisa=jumlah_tagihan-jumlah;
    		}
    		else
    		{
    			sisa='0';
    			kembalian=jumlah-jumlah_tagihan;
    		}
    	}
    	$("#kmb").html('Rp. '+formatMoney(kembalian,2, '.', ','))
    	$("#sisa").html('Rp. '+formatMoney(sisa,2, '.', ','))
    	$("#sisa_byr").val(sisa)
    	

    })
    $('.form-billing').submit(function(e){
        e.preventDefault();
    })
    function loading_show()
	{
		var $this = $(".panel");
        blockUI($this)
        $this.addClass('reloading');
	}

	function loading_hide()
	{
		var $this = $(".panel");
        unblockUI($this)
        $this.removeClass('reloading');
	}
	$(".btn-checkout").click(function(){
		// alert($(".form-billing").serialize())
		loading_show()
		$(this).html("<i class='fa fa-spinner fa-spin'></i> Menyimpan pembayaran...")
		$.ajax({
			type:"POST",
			url:base_url+'kasirrajal/checkout_api/checkout_proses',
			data:$(".form-billing").serialize(),
			dataType:'json',
			error:function()
			{
				alert('Gagal terhubung ke server.');
				$('.btn-checkout').html("Check Out");
				loading_hide();
			},
			success:function(json)
			{
				if(json.success)
				{
					alert('Checkout success.');
				}
				else
				{
					alert(json.pesan_err);
				}
				loading_hide();
				$('.btn-checkout').html("Check Out");
			}
		})
	})
	$(".btn-cetak").click(function(){
		loading_show();
		$(this).html("<i class='fa fa-spinner fa-spin'></i> Membuat billing...")
		var nomor_kunjungan=$("#nomor_kunjungan").val();
		var url=base_url+'kasirrajal/checkout_api/billing?no_kunjungan='+nomor_kunjungan;
		$(".cetak").load(url, function(responseTxt, statusTxt, xhr){
			if(statusTxt=="success")
			{
				loading_hide();
				$(".btn-cetak").html("<i class='entypo-print'></i> Cetak Billing")
				$("div.cetak").printArea();	
			}
			else if(statusTxt=='error')
			{
				alert("Gagal memuat laporan.")
				$(".btn-cetak").html("<i class='entypo-print'></i> Cetak Billing")
				loading_hide();
			}
			
		})
		
	})
</script>