<div class="col-sm-6 "> 
	<div class="panel panel-warning konten">
		<div class="panel-heading">
	        <div class="panel-title">
	            <i class="entypo-user-add"></i> INFORMASI KUNJUNGAN
	        </div>
	        <div class="panel-options">
	            
	        </div>
    	</div>
    	<div class="panel-body body-form-gue">
    		<form class="form-kunjungan">
    		<input type="hidden" value="<?php echo $no_register;?>" name="no_register" id="no_register">
            <input type="hidden" value="<?php echo $info_orderan['no_kunjungan'];?>" name="no_kunjungan" id="no_kunjungan">
            <input type="hidden" value="<?php echo $info_orderan['no_orderan']?>" name='no_orderan' id='no_orderan'>
            <input type="hidden" value="<?php echo $info_orderan['unit_pengirim']?>" name="unit_pengirim" id='unit_pengirim'>
            <input type="hidden" value="<?php echo $info_orderan['dokter_pengirim']?>" name="dokter_pengirim" id='dokter_pengirim'>
    		<table class="table  table-hover table-form" style="margin-bottom:0px">
    			<tr>
    				<th class="label-tabel" style="width: 40%">Nomor Register</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="font-weight: bold;" id=""><?php echo $no_register;?></th>
    			</tr>

    			<tr>
    				<th class="label-tabel" style="width: 40%">Tgl Pemeriksaan</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="padding:0px;padding-left: 5px;padding-top: 2px;border-top: none;" >
    					<div class="col-sm-9 nopadding">
    						<div class="input-group">
                            <input type="text" class="form-control datepicker input-sm" name="tgl_periksa" value="<?php echo date("d-m-Y") ?>" id="tgl_periksa" data-format="dd-mm-yyyy">
                            <div class="input-group-addon">
                                <a href="#"><i class="entypo-calendar"></i></a>
                            </div>
                        </div>
    					</div>
    				</th>
    			</tr>

    			<tr>
    				<th class="label-tabel" style="width: 40%">Jam Pemeriksaan</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="padding:0px;padding-left: 5px;padding-top: 2px;border-top: none;" >
    					<div class="col-sm-9 nopadding">
    						<div class="input-group">
								<input type="text" class="form-control timepicker" data-template="dropdown" data-show-seconds="true" data-default-time="<?php echo date("H:i:s")?>" data-show-meridian="false" data-minute-step="5" data-second-step="5"  id="jam_periksa" name="jam_periksa" />		
								<div class="input-group-addon">
								    <a href="#"><i class="entypo-clock"></i></a>
								</div>
							</div>
    					</div>
    				</th>
    			</tr>

    			<tr>
    				<th class="label-tabel" style="width: 40%">Dokter Penanggung Jawab</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="padding:0px;padding-left: 5px;padding-top: 2px;border-top: none;" >
    					<div class="col-sm-11 nopadding">
    						<select class="form-control input-sm" name="dokter" id="dokter">
    							<?php 
    							foreach($dokter->result() as $dr)
    							{
    								echo"<option value='".$dr->kode_dokter."'>".$dr->nama_lengkap."</option>";
    							}
    							?>
    						</select>
    					</div>
    				</th>
    			</tr>

    			<tr>
    				<th class="label-tabel" style="width: 40%">Petugas Penanggung Jawab</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="padding:0px;padding-left: 5px;padding-top: 2px;border-top: none;" >
    					<div class="col-sm-11 nopadding">
    						<select class="form-control input-sm" name="petugas" id="petugas">
    							<?php 
    							foreach($petugas->result() as $ptg)
    							{
    								echo"<option value='".$ptg->kode_petugas."'>".$ptg->nama_petugas."</option>";
    							}
    							?>
    						</select>
    					</div>
    				</th>
    			</tr>
    			<tr>
    				<td colspan="3">
    					<div class="btn btn-gue btn-simpan-kunjungan">Simpan Pemeriksaan</div>
    				</td>
    			</tr>
    		</table>
    		</form>
    	</div>
	</div>
</div>

<div class="col-sm-6 "> 
	<div class="panel panel-warning konten">
		<div class="panel-heading">
	        <div class="panel-title">
	            <i class="entypo-user-add"></i> INFORMASI ORDERAN
	        </div>
	        <div class="panel-options">
	            
	        </div>
    	</div>

    	<div class="panel-body body-form-gue" >
    		<table class="table  table-hover table-form">
    			<tr>
    				<th class="label-tabel" style="width: 40%">No. Orderan</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="font-weight: bold;" id=""><?php echo sprintf("%010d",$info_orderan['no_orderan'])?></th>
    			</tr>
    			<tr>
    				<th class="label-tabel">No. Medrec</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="font-weight: bold;" id=""><?php echo $info_orderan['nomor_rekammedis']?></th>
    			</tr>
    			<tr>
    				<th class="label-tabel">Nama Lengkap</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="font-weight: bold;" id=""><?php echo $info_orderan['nama_lengkap']?></th>
    			</tr>
    			<tr>
    				<th class="label-tabel">Tgl Order</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="font-weight: bold;" id=""><?php echo $info_orderan['tgl_order']?></th>
    			</tr>
    			<tr>
    				<th class="label-tabel">Unit Pengirim</th>
    				<th class="label-tabel" width="2" >:</th>
    				<th style="font-weight: bold;" id=""><?php echo $info_orderan['unit_pengirim']?></th>
    			</tr>
    			<tr>
    				<th class="label-tabel">Dokter Pengirim</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="font-weight: bold;" id="">dr <?php echo $info_orderan['nama_dokter']?>, <?php echo $info_orderan['gelar']?></th>
    			</tr>
   			</table>
    	</div>

	</div>
</div>

<div class="col-sm-12"> 
	<div class="panel panel-warning konten">
		<div class="panel-heading">
	        <div class="panel-title">
	            <i class="entypo-bookmark"></i> LIST PERMINTAAN PEMERIKSAAN
	        </div>
	        <div class="panel-options">
	            
	        </div>
    	</div>

    	<div class="panel-body body-form-gue" id="table-data-pemeriksaan">
    	</div>

	</div>
</div>
<script src="<?php echo base_url()?>template/neon/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url()?>template/neon/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		load_data_pemeriksaan(base_url+'lab/orderan_api/get_tabel_list_orderan?noorderan=<?php echo $info_orderan['no_orderan'] ?>');
	})


	function load_data_pemeriksaan(url)
    {
        $("#table-data-pemeriksaan").load(url, function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
            {
                loading_hide();
            }
            if(statusTxt=="error")
            {
                loading_hide();
                alert('Gagal memuat halaman data penata jasa')
            }
        })
    }

    $(".btn-simpan-kunjungan").click(function(){
        var e=confirm('Semua data sudah benar ?');
        if(e)
        {
            var form_data=$(".form-kunjungan").serialize();
            $(this).html("<i class='fa fa-spinner fa-spin'></i> Menyimpan kunjungan...").addClass('disabled')
            $.ajax({
                type:"POST",
                url:base_url+'lab/orderan_api/simpan_kunjungan',
                data:form_data,
                dataType:'json',
                error:function()
                {
                    alert('Gagal terhubung ke server.');
                    $(".btn-simpan-kunjungan").html('Simpan pemeriksaan').removeClass('disabled');
                },
                success:function(json)
                {
                    if(json.success)
                    {
                        alert('Kunjungan berhasil disimpan.')
                        window.location.href=base_url+'lab/orderan';
                    }
                    else
                    {
                        alert(json.pesan_err)
                    }
                    $(".btn-simpan-kunjungan").html('Simpan pemeriksaan').removeClass('disabled');
                }

            }) 
        }       
    })
   
</script>