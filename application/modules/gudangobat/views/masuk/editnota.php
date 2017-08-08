<div class="panel panel-primary konten">
    <div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-layout"></i> Form Perubahan Nota Transaksi Barang Masuk
        </div>
        <div class="panel-options">
            
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
    </div>
    <div class="panel-body">
		<form class="form-horizontal form-nota">
		<input type="hidden" name="no_transaksi" value="<?php echo $row['no_transaksi']?>">
			<div class="row">
				<div class="col-sm-8">
					<div class="form-group">
						<label class="control-label col-sm-2">No. Transaksi</label>
						<div class="col-sm-10">
							<input type="text" name="nota" id="nota" autofocus="" class="form-control  bold" value="<?php echo $row['no_transaksi'] ?>" disabled=''>
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
				    					echo$i==date("d",strtotime($row['tgl_transaksi']))?'selected':'';
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
					    				echo$i==date("m",strtotime($row['tgl_transaksi']))?'selected':'';
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
				    					echo"<option value='".$i."'";
				    					echo$i==date("Y",strtotime($row['tgl_transaksi']))?'selected':'';
				    					echo">".$i."</option>";
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
				    				echo"<option value='".$s->kode."'";
		    						echo$s->kode==$row['kode_supplier']?'selected':'';
		    						echo">".$s->nama_supplier."</option>";
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
							<input type="text" name="faktur" id="faktur" class="form-control" value="<?php echo $row['no_faktur']?>">
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
				    					echo$i==date("d",strtotime($row['tgl_faktur']))?'selected':'';
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
					    				echo$i==date("m",strtotime($row['tgl_faktur']))?'selected':'';
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
				    					echo"<option value='".$i."'";
				    					echo$i==date("Y",strtotime($row['tgl_faktur']))?'selected':'';
				    					echo">".$i."</option>";
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
							<input type="text" name="serah" id="serah"  class="form-control input-sm" value="<?php echo $row['penyerah']?>">
						</div>
					</div>
					<!-- end form group  -->

					<!-- start form group -->
					<div class="form-group">
						<label class="control-label col-sm-2">Diterima Oleh </label>
						<div class="col-sm-10">
							<input type="text" name="terima" id="terima"  class="form-control input-sm" value="<?php echo $row['penerima']?>">
						</div>
					</div>
					<!-- end form group  -->

					<!-- start form group -->
					<div class="form-group">
						<label class="control-label col-sm-2">Keterangan Lain </label>
						<div class="col-sm-10">
		    				<textarea class="form-control" rows="5" name="keterangan" placeholder="Tuliskan keterangan tambahan disini, apabila dibutuhkan..."><?php echo $row['keterangan_lain']?></textarea>
						</div>
					</div>
					<!-- end form group  -->
				</div>
				<!-- end col-sm-8 -->


				<div class="col-sm-4 hidden-xs">
					<div class="bs-callout bs-callout-info nomargin-top">
					<h4>Tahap update data :</h4>
					<ul>	
						<li>Input semua isi form, sesuai dengan perubahan</li>
						<li>Klik <span class="text-success bold">Simpan Perubahan</span> untuk menyimpan perubahan yang sudah benar.</li>
						<li>Klik tombol <span class="text-red bold">Batal</span> apabila tidak jadi simpan perubahan data, dan kembali kehalaman data nota transaksi.</li>
					</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8">
					<p class="pull-right">
						<button type="button" class="btn btn-red btn-batal">Batal</button>
	        			<button type="button" class="btn btn-success btn-simpan">Simpan Perubahan</button>
					</p>
				</div>
			</div>
		</form>
	</div>

</div>
</form>
<script type="text/javascript">
	$(".btn-batal").click(function(){
		window.location.href=base_url+'gudangobat/masuk/datanotamasuk'
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
	
	$(".btn-simpan").click(function()
	{
		var $this=$(this)
		loadin("show");
		$this.html("<i class='fa fa-spin fa-spinner'></i> Menympan perubahan...")
		var data=$(".form-nota").serialize();
		$.ajax({
			type:"POST",
			url:base_url+'gudangobat/masuk_api/update_nota',
			data:data,
			dataType:'json',
			error:function()
			{
				toastr.error("Gagal terhubung ke server.")
				$this.html("Simpan Perubahan");
				loadin("hide")
			},
			success:function(json)
			{
				if(json.success)
				{
					toastr.info("Berhasil simpan perubahan.");
					window.location.href=base_url+'gudangobat/masuk/datanotamasuk'
				}
				else
				{
					toastr.error(json.pesan_err)
				}
			}
		})

	})

	function loadin(jenis)
	{
		var $this=$(".panel");
		if(jenis=="show")
		{
			blockUI($this);
			$this.addClass('reloading')
		}
		else
		{
			unblockUI($this);
			$this.removeClass('reloading')
		}
	}
	
</script>