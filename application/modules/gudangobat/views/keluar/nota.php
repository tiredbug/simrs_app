<div class="panel panel-primary konten">
	<div class="panel-heading">
		<div class="panel-title">
			<i class="entypo-layout"></i> Form Nota Transaksi Barang Keluar
		</div>
		<!-- end panel titel -->
		<div class="panel-options">
			<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
		</div>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-sm-8">
				<form class="form-horizontal form-nota">
					<div class="form-group">
						<label class="control-label col-sm-2">No. Transaksi</label>
						<div class="col-sm-10">
							<input type="text" name="nota" id="nota" autofocus="" class="form-control bold">
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-sm-2">Tgl Transaksi</label>
						<div class="col-sm-3">
							<div class="input-group">
								<span class="input-group-addon">Tgl
								</span>
								<select class="form-control" name="tgl" id="tgl">
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
		    			</div>

		    			<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">Bln</span>
								<select class="form-control " name='bln' id="bln">
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
		    			</div>

		    			<div class="col-sm-3">
							<div class="input-group">
								<span class="input-group-addon">Thn</span>
								<select name="tahun" id="tahun" class="form-control ">
				    				<?php 
				    				$thn=date("Y");
				    				for ($i=$thn; $i >= $thn-2; $i--) { 
				    					# code...
				    					echo"<option value='".$i."'>".$i."</option>";
				    				}
				    				?>
				    			</select>
							</div>
		    			</div>
					</div>
					<!-- end form group  -->

					<div class="form-group">
						<label class="control-label col-sm-2">Diserahkan Oleh</label>
						<div class="col-sm-10">
							<input type="text" name="serah" id="serah"  class="form-control " >
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-2">Diterima Oleh</label>
						<div class="col-sm-10">
							<input type="text" name="terima" id="terima"  class="form-control " >
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-2">Client </label>
						<div class="col-sm-10">
							<select name="client" id="client" class="form-control input-sm">
				    			<?php
				    			foreach($client->result() as $c)
				    			{
				    				echo"<option value='".$c->kode_client."'>".$c->unit_client."</option>";
				    			}
				    			?>
				    		</select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-2">Keterangan Lain </label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="7" name="keterangan" placeholder="Tuliskan keterangan tambahan disini, apabila dibutuhkan..."></textarea>
						</div>
					</div>


				</form>
			</div>
		</div>
	</div>

</div>


<form class="form-nota">
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

	<div class="panel-heading">
	    <div class="pull-right" style="margin:5px">
	    	<button type="button" class="btn btn-info btn-kembali">Kembali</button>
	    	<button type="button" class="btn btn-red btn-clear">Clear</button>
	        <button type="button" class="btn btn-success btn-simpan">Simpan Saja</button>
	        <button type='button' class="btn btn-success btn-simpan-lanjut">Simpan dan Lanjutkan</button>
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

	$(".btn-kembali").click(function(){
		window.location.href=base_url+'gudangobat/keluar/datanotakeluar';
	})

	$(".btn-clear").click(function(){
		$(".form-nota").trigger('reset')
		$(".ckeditor").val('');
		$("#nota").focus();
	})

	$(".btn-simpan").click(function(){
		var e=confirm("Semua data sudah benar ?");
		if(e)
		{
			$(this).html("<i class='fa fa-spin fa-spinner'></i> Menyimpan...");
			simpan_nota(function(respon){
				if(respon.success==true)
				{
					toastr.info("Nota transaksi barang keluar berhasil dibuat.")
					$(".btn-simpan").html("Simpan Saja")
					$(".form-nota").trigger('reset');
					$(".ckeditor").val('');
				}
				else
				{
					toastr.error(respon.pesan_err)
					$(".btn-simpan").html("Simpan Saja")
				}
			})
		}
	})

	$(".btn-simpan-lanjut").click(function(){
		var e=confirm("Semua data sudah benar ?");
		if(e)
		{
			$(this).html("<i class='fa fa-spin fa-spinner'></i> Menyimpan...");
			simpan_nota(function(respon){
				if(respon.success)
				{
					window.location.href=base_url+'gudangobat/keluar/listkeluar?nota='+respon.nota;
				}
				else
				{
					toastr.error(respon.pesan_err)
					$(".btn-simpan-lanjut").html("Simpan dan Lanjutkan");
				}
			})
		}
	})

	function simpan_nota(respon)
	{
		var data=$(".form-nota").serialize();
		$.ajax({
			type:"POST",
			url:base_url+'gudangobat/keluar_api/simpan_nota',
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