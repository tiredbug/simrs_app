<script src="<?php echo base_url()?>template/neon/js/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url()?>template/neon/js/ckeditor/adapters/jquery.js"></script>

<div class="col-sm-12">
	<div class="panel panel-warning konten ">
	    <!-- heading  -->
	    <div class="panel-heading">
	        <div class="panel-title">
	            <i class="entypo-info"></i> INFORMASI PASIEN & PEMERIKSAAN
	        </div>
	        <div class="panel-options">
	            <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
	            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
	            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
	            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
	        </div>
	    </div>

	    <div class="panel-body body-form-gue">
	    	<div class="col-sm-6 nopadding">
		    	<table class="table  table-hover table-form nomargin-bottom ">
		    			
		    		<tr>
		    			<th class="label-tabel" style="width: 40%">No. Medrec</th>
		    			<th class="label-tabel" width="2">:</th>
		    			<th style="font-weight: bold;" id="medrec"><?php echo $info['norekammedis']?></th>
		    		</tr>

		    		<tr>
		    			<th class="label-tabel" style="width: 40%">Nama</th>
		    			<th class="label-tabel" width="2">:</th>
		    			<th style="font-weight: bold;" id="nama"><?php echo $info['nama_pasien']?></th>
		    		</tr>
	    			<tr>
	    				<th class="label-tabel" style="width: 40%">Unit Pengirim</th>
	    				<th class="label-tabel" width="2">:</th>
	    				<th style="font-weight: bold;" id="pengirim"><?php echo $info['unit_pengirim']?></th>
	    			</tr>
	    			<tr>
	    				<th class="label-tabel" style="width: 40%">Dokter Pengirim</th>
	    				<th class="label-tabel" width="2">:</th>
	    				<th style="font-weight: bold;" id="dokter_pengirim"><?php echo $info['nama_belakang'].' '.$info['dokter_pengirim'].', '.$info['gelar']?></th>
	    			</tr>
	    			<tr>
	    				<th class="label-tabel" style="width: 40%">Alamat</th>
	    				<th class="label-tabel" width="2">:</th>
	    				<th style="font-weight: bold;" id="alamat"><?php echo $info['alamat_ktp'].' Desa .'.$info['nama_kelurahan'].' Kec.'.$info['nama_kecamatan'].' Kab.'.$info['nama_kota'].' Prov.'.$info['nama_provinsi']?></th>
	    			</tr>
	    		</table>
	    	</div>

	    	<div class="col-sm-6 nopadding">
		    	<table class="table  table-hover table-form nomargin-bottom ">
		    			
		    		<tr>
		    			<th class="label-tabel" style="width: 40%">No. Register</th>
		    			<th class="label-tabel" width="2">:</th>
		    			<th style="font-weight: bold;" id="nolab"><?php echo sprintf("%010d",$info['nomor_lab'])?></th>
		    		</tr>

		    		<tr>
		    			<th class="label-tabel" style="width: 40%">Tgl Order</th>
		    			<th class="label-tabel" width="2">:</th>
		    			<th style="font-weight: bold;" id=""><?php echo tgl_biasa($info['tgl_order'])?></th>
		    		</tr>
	    			<tr>
	    				<th class="label-tabel" style="width: 40%">Tgl Periksa</th>
	    				<th class="label-tabel" width="2">:</th>
	    				<th style="font-weight: bold;" id=""><?php echo tgl_biasa($info['tgl_periksa'])?></th>
	    			</tr>
	    			<tr>
	    				<th class="label-tabel" style="width: 40%">Petugas</th>
	    				<th class="label-tabel" width="2">:</th>
	    				<th style="font-weight: bold;" id=""><?php echo $info['petugas']?></th>
	    			</tr>
	    			<tr>
	    				<th class="label-tabel" style="width: 40%">Dokter</th>
	    				<th class="label-tabel" width="2">:</th>
	    				<th style="font-weight: bold;" id=""><?php echo $info['dokter']?></th>
	    			</tr>
	    		</table>
	    	</div>

	    </div>

	    <div class="panel-heading">
	        <div class="panel-title">
	            <i class="entypo-pencil"></i> FORM INPUT HASIL PEMERIKSAAN LABORATURIUM
	        </div>
	        <div class="panel-options">
	            
	        </div>
	    </div>

	    <form class="form-data-hasil">
	    <div class="panel-body data_hasil_lab nopadding body-form-gue ">
	    </div>
	    </form>
	    <div class="panel-body nopadding body-form-gue ">
	    	<table class="table table-hover table-form nomargin table-datagrid nomargin-bottom ">
				<!-- table header start -->
				<thead>
					<tr>
						<th>
						<label class='control-label'>Keterangan :</label>
						<textarea class="form-control ckeditor" rows="5" name="ket" id="ket"><?php echo $info['keterangan']?></textarea>
						</th>
					</tr>
				</thead>
			</table>
	    </div>
	    
	   

	    <div class="panel-heading">
	        <div class="panel-title">
	        	<label>
	        		<input type="checkbox" name="selesai" id="selesai">Sudah selesai diperiksa, hapus dari list pemeriksaan.
				</label>
	        </div>
	        <div class="pull-right" style="margin:5px">
	       		<button type="button" class="btn btn-info btn-kembali">Kembali</button>
	            <button type="button" class="btn btn-success btn-simpan">Simpan</button>
	            <button type='button' class="btn btn-success btn-cetak">Cetak Hasil</button>
	        </div>
	    </div>

	</div>
</div>
<style type="text/css">
	.cetak {
		display: none;
	}
</style>
<div class="cetak ">
</div>

<script type="text/javascript">
	$(document).ready(function(){
		load_data_hasil_lab(base_url+'lab/hasil_api/get_data_hasil_lab?nolab=<?php echo $info['nomor_lab']?>')
	})
	function load_data_hasil_lab(url)
	{
		loading_show();
		$(".data_hasil_lab").load(url, function(responseTxt, statusTxt, xhr){
			if(statusTxt=="success")
			{
				loading_hide();
			}
			else if(statusTxt=='error')
			{
				alert("Gagal mengambil form data hasil lab dari server.")
				loading_hide();
			}
		})
	}

	function loading_show()
	{
		var $this = $(".data_hasil_lab");
        blockUI($this)
        $this.addClass('reloading');
	}

	function loading_hide()
	{
		var $this = $(".data_hasil_lab");
        unblockUI($this)
        $this.removeClass('reloading');
	}
	$(".btn-simpan").click(function(){
		$(this).html("<i class='fa fa-spinner fa-spin'></i> Menyimpan...").addClass('disabled')
		// call fungsi simpan keterangan 
		simpan_keterangan();
		// call fungsi status periksa 
		status_periksa();

		var form_data=$(".form-data-hasil").serialize();
		
		loading_show()
		$.ajax({
			type:"POST",
			url:base_url+'lab/hasil_api/simpan_hasil_lab',
			data:form_data+'&selesai='+selesai,
			dataType:'json',
			error:function()
			{
				alert('Gagal terhubung ke server.');
				$(".btn-simpan").html("Simpan").removeClass('disabled')
				loading_hide();
			},
			success:function(json)
			{
				if(json.success)
				{
					alert('Berhasil disimpan hasil pemeriksaan lab.')
				}
				else
				{
					alert(json.pesan_err)
				}
				$(".btn-simpan").html("Simpan").removeClass('disabled')
				loading_hide();
			}
		})

		// call template laporan 
		
		
	})
	$(".btn-cetak").click(function(){	
		var url=base_url+'lab/hasil_api/lap_hasillab?nolab=<?php echo $info['nomor_lab']?>'
		loading_show();
		$(".cetak").load(url, function(responseTxt, statusTxt, xhr){
			if(statusTxt=="success")
			{
				loading_hide();
				$("div.cetak").printArea();	
			}
			else if(statusTxt=='error')
			{
				alert("Gagal memuat laporan.")
				loading_hide();
			}
		})
	})

	$(".btn-kembali").click(function(){
		window.location.href=base_url+'lab/hasil'
	})

	function simpan_keterangan()
	{
		var ket=$("#ket").val();
		var nolab='<?php echo $info['nomor_lab']?>';
		loading_show();
		$.ajax({
			type:"POST",
			url:base_url+'lab/hasil_api/update_keterangan',
			data:'ket='+ket+'&nolab='+nolab,
			error:function()
			{
				alert('Gagal update keterangan.');
				loading_hide();
			},
			success:function()
			{
				loading_hide();
			}
		})
	}
	function status_periksa()
	{
		var nolab='<?php echo $info['nomor_lab']?>';
		var periksa='';
		if(document.getElementById('selesai').checked == true)
		{
			periksa='Y';
		}
		else
		{
			periksa='N';
		}
		loading_show();
		$.ajax({
			type:"POST",
			url:base_url+'lab/hasil_api/checkout',
			data:'nolab='+nolab+'&periksa='+periksa,
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
					loading_hide();
				}
				else
				{
					alert(json.pesan_err);
					loading_hide()
				}
			}
		})
	}
</script>