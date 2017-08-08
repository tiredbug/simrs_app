<div class="panel panel-primary konten">
    <div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-layout"></i> Form Nota Transaksi Barang Masuk
        </div>
        <div class="panel-options">
            
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
    </div>
    <div class="panel-body">
		<form class="form-horizontal form-nota">
			<div class="row">
				<div class="col-sm-8">
					<div class="form-group">
						<label class="control-label col-sm-2">No. Transaksi</label>
						<div class="col-sm-10">
							<input type="text" name="nota" id="nota" autofocus="" class="form-control  bold" >
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

					<!-- start form group -->
					<div class="form-group">
						<label class="control-label col-sm-2">Supplier</label>
						<div class="col-sm-10">
							<select name="supplier" id="supplier" class="form-control " id="supplier">
				    			<?php
				    			foreach($supplier->result() as $s)
				    			{
				    				echo"<option value='".$s->kode."'>".$s->nama_supplier."</option>";
				    			}
				    			?>
				    		</select>
						</div>
					</div>
					<!-- end form group  -->

					<!-- start form group -->
					<div class="form-group">
						<label class="control-label col-sm-2">No. Faktur</label>
						<div class="col-sm-10">
							<input type="text" name="faktur" id="faktur" class="form-control " >
						</div>
					</div>
					<!-- end form group  -->

					<!-- start form group -->
					<div class="form-group">
						<label class="control-label col-sm-2">Tgl Faktur</label>
						<div class="col-sm-3">
							<div class="input-group">
								<span class="input-group-addon">Tgl
								</span>
								<select class="form-control " name="tglf" id="tglf">
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
								<select class="form-control " name='blnf' id="blnf">
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
								<select name="tahunf" id="tahunf" class="form-control ">
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

					<!-- start form group -->
					<div class="form-group">
						<label class="control-label col-sm-2">Diserahkan Oleh </label>
						<div class="col-sm-10">
							<input type="text" name="serah" id="serah"  class="form-control " >
						</div>
					</div>
					<!-- end form group  -->

					<!-- start form group -->
					<div class="form-group">
						<label class="control-label col-sm-2">Diterima Oleh </label>
						<div class="col-sm-10">
							<input type="text" name="terima" id="terima"  class="form-control " >
						</div>
					</div>
					<!-- end form group  -->

					<!-- start form group -->
					<div class="form-group">
						<label class="control-label col-sm-2">Keterangan Lain </label>
						<div class="col-sm-10">
							<textarea class="form-control " rows="5" name="keterangan" placeholder="Tuliskan keterangan tambahan disini, apabila dibutuhkan..."></textarea>
						</div>
					</div>
					<!-- end form group  -->
				</div>
				<!-- end col-sm-8 -->


				<div class="col-sm-4 hidden-xs">
					<div class="bs-callout bs-callout-info nomargin-top">
					<h4>Penjelasan :</h4>
					<ul>	
						<li>Tombol <span class='text-info bold'>kembali</span> untuk kembali kehalaman utama aplikasi.</li>
						<li>Tombol <span class="text-red bold">Clear</span> untuk membersihkan semua control input pada form.</li>
						<li>Klik tombol <span class="text-success bold">Simpan</span> untuk menyimpan data saja.</li>
						<li>Klik tombol <span class="text-success bold">Simpan dan Lanjutkan</span> untuk menyimpan data kemudian akan dilanjutkan ke halaman input list barang yang diterima secara otomatis.</li>
					</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8">
					<p class="pull-right">
						<button type="button" class="btn btn-info btn-kembali">Kembali</button>
						<button type="button" class="btn btn-red btn-clear">Clear</button>
						<button type="button" class="btn btn-success btn-simpan">Simpan Saja</button>
						<button type='button' class="btn btn-success btn-simpan-lanjut">Simpan dan Lanjutkan</button>
					</p>
				</div>
			</div>
		</form>
	</div>

</div>
</form>
<script src="<?php echo base_url()?>template/neon/js/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url()?>template/neon/js/ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
	$(".btn-kembali").click(function(){
		window.location.href=base_url+'gudangobat/home';
	})
	$(".btn-clear").click(function(){
		$(".form-nota").trigger('reset');
		$(".ckeditor").val('');
	})
	$("#nota").keypress(function(e){
		if(e.which==13)
		{
			$("#tgl").focus();
		}
	})

	$("#tgl").change(function(e)
	{
		$("#bln").focus()
	})
	$("#bln").change(function()
	{
		$("#tahun").focus();
	})
	$("#tahun").change(function()
	{
		$("#supplier").focus()
	})
	$("#supplier").change(function(){
		$("#faktur").focus();
	})
	$("#faktur").keypress(function(e){
		if(e.which==13)
		{
			$("#tglf").focus();
		}
	})
	$("#tglf").change(function(){
		$("#blnf").focus();
	})
	$("#blnf").change(function(){
		$("#tahunf").focus();
	})
	$("#tahunf").change(function(e){
		$("#serah").focus()
	})
	$("#serah").keypress(function(e){
		if(e.which==13)
		{
			$("#terima").focus()
		}
	})
	$("#terima").keypress(function(e){
		if(e.which==13)
		{
			$(".ckeditor").focus()
		}
	})
	
	function simpan_nota(respon)
	{
		var data=$(".form-nota").serialize();
		$.ajax({
			type:"POST",
			url:base_url+'gudangobat/masuk_api/simpan_nota',
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
	$(".btn-simpan").click(function(){
		$(this).html("<i class='fa fa-spin fa-spinner'></i> Menyimpan...");
		simpan_nota(function(respon){
			if(respon.success==true)
			{
				toastr.info("Nota transaksi barang masuk berhasil dibuat.")
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
	})
	$(".btn-simpan-lanjut").click(function(){
		$(this).html("<i class='fa fa-spin fa-spinner'></i> Menyimpan...");
		simpan_nota(function(respon){
			if(respon.success)
			{
				window.location.href=base_url+'gudangobat/masuk/listmasuk?nota='+respon.nota;
			}
			else
			{
				toastr.error(respon.pesan_err)
				$(".btn-simpan-lanjut").html("Simpan dan Lanjutkan");
			}
		})
		
	})
</script>