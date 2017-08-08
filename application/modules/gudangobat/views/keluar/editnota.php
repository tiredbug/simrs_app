<form class="form-nota">
<input type="hidden" name="no_transaksi" value="<?php echo $this->input->get('nota')?>">
<div class="panel panel-warning konten ">
    <div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-upload"></i> Form Nota Barang Keluar
        </div>
        <div class="panel-options">
            
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
    </div>
    <div class="panel-body body-form-gue">
		<table class="table table-bordered datatable table-hover nomargin-bottom" >
			<tr>
		    	<th class="label-tabel" style="width: 30%">No. Transaksi</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="padding:0px;padding-left: 5px;padding-top: 2px;">
		    		<div class="col-sm-3 nopadding">
		    			<input type="text" name="nota" id="nota" autofocus="" class="form-control input-sm" style="font-size:12px;font-weight:bold" value="<?php echo $this->input->get('nota')?>" disabled=''>
		    		</div>
		    	</th>
		    </tr>

		    <tr>
		    	<th class="label-tabel" style="width: 30%">Tgl Transaksi</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="padding:0px;padding-left: 5px;padding-top: 2px;">
		    		<div class="col-sm-1 nopadding">
		    			<select class="form-control input-sm" name="tgl" id="tgl">
		    				<?php 
		    				for ($i=1; $i < 31+1; $i++) { 
		    					# code...
		    					$i=$i<10?'0'.$i:$i;
		    					echo"<option value='".$i."'";
		    					echo$i==date("d",strtotime($row['tgl_transaksi']))?'selected':'';
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
			    				echo$i==date("m",strtotime($row['tgl_transaksi']))?'selected':'';
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
		    					echo"<option value='".$i."'";
		    					echo$i==date("Y",strtotime($row['tgl_transaksi']))?'selected':'';
		    					echo">".$i."</option>";
		    				}
		    				?>
		    			</select>
		    		</div>
		    		
		    		</div>
		    	</th>
		    </tr>

		    <tr>
		    	<th class="label-tabel" style="width: 30%">Diserahkan Oleh</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="padding:0px;padding-left: 5px;padding-top: 2px;">
		    		<div class="col-sm-7 nopadding">
		    			<input type="text" name="serah" id="serah"  class="form-control input-sm" value="<?php echo $row['penyerah']?>">
		    		</div>
		    	</th>
		    </tr>

		    <tr>
		    	<th class="label-tabel" style="width: 30%">Diterima Oleh</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="padding:0px;padding-left: 5px;padding-top: 2px;">
		    		<div class="col-sm-7 nopadding">
		    			<input type="text" name="terima" id="terima"  class="form-control input-sm" value="<?php echo $row['penerima']?>">
		    		</div>
		    	</th>
		    </tr>

		    <tr>
		    	<th class="label-tabel" style="width: 30%">Client Farmasi</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="padding:0px;padding-left: 5px;padding-top: 2px;">
		    		<div class="col-sm-7 nopadding">
		    			<select name="client" id="client" class="form-control input-sm">
		    			<?php
		    			foreach($client->result() as $c)
		    			{
		    				echo"<option value='".$c->kode_client."'>".$c->unit_client."</option>";
		    			}
		    			?>
		    			</select>
		    		</div>
		    	</th>
		    </tr>


		    <tr>
		    	<th class="label-tabel" style="width: 30%">Keterangan Lain</th>
		    	<th class="label-tabel" width="2">:</th>
		    	<th style="padding:0px;padding-left: 5px;padding-top: 2px;">
		    		<div class="col-sm-12 nopadding">
		    			<textarea class="form-control ckeditor" rows="7" name="keterangan" placeholder="Tuliskan keterangan tambahan disini, apabila dibutuhkan..."></textarea>
		    		</div>
		    	</th>
		    </tr>

		</table>
	</div>

	<div class="panel-heading">
	    <div class="pull-right" style="margin:5px">
	    	<button type="button" class="btn btn-red btn-batal">Batal</button>
	        <button type="button" class="btn btn-success btn-simpan">Simpan Perubahan</button>
	    </div>
	</div>

</div>
</form>

<script src="<?php echo base_url()?>template/neon/js/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url()?>template/neon/js/ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

	})
	$("#nota").keypress(function(e){
		if(e.which==13)
		{
			$("#tgl").focus();
		}
	})
	$("#tgl").change(function()
	{
		$("#bln").focus();
	})
	$("#bln").change(function()
	{
		$("#tahun").focus();
	})
	$("#tahun").change(function()
	{
		$("#serah").focus();
	})
	$("#serah").keypress(function(e){
		if(e.which==13)
		{
			$("#terima").focus();
		}
	})
	$("#terima").keypress(function(e){
		if(e.which==13)
		{
			$("#client").focus();
		}
	})

	$(".btn-batal").click(function(){
		window.location.href=base_url+'gudangobat/keluar/datanotakeluar';
	})

	$(".btn-simpan").click(function(){
		var e=confirm("Semua data sudah benar ?");
		if(e)
		{
			$(this).html("<i class='fa fa-spin fa-spinner'></i> Menyimpan...");
			simpan_nota(function(respon){
				if(respon.success==true)
				{
					window.location.href=base_url+'gudangobat/keluar/datanotakeluar'
				}
				else
				{
					toastr.error(respon.pesan_err)
					$(".btn-simpan").html("Simpan Perubahan")
				}
			})
		}
	})


	function simpan_nota(respon)
	{
		var data=$(".form-nota").serialize();
		$.ajax({
			type:"POST",
			url:base_url+'gudangobat/keluar_api/update_nota',
			data:data,
			dataType:'json',
			error:function()
			{
				var arr={success:false,pesan_err:'Gagal terhubugn ke server.'}
				respon(arr)
			},
			success:function(json)
			{
				respon(json)
			}
		})

	}
</script>