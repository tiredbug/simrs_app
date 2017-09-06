<?php if(! defined("BASEPATH")) exit ("No direct script access allowed");?>
<style type="text/css">
    .form-horizontal .checkbox{
        float: left;
        padding-top: 6px;
    }
    .form-horizontal .checkbox label{
        font-weight: bold;
    }
    .checkbox input[type="checkbox"]
    {
        margin-left: -15px;
    }
</style>
<div class="panel panel-warning konten ">
    <!-- heading  -->
    <div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-user-add"></i> INFORMASI KUNJUNGAN
        </div>
        <div class="panel-options">
            <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
    </div>

    <!-- body  -->
    <form class="form-kunjungan">
    <input type="hidden" name="no_kunjungan" id='no_kunjungan'/>
    <div class="panel-body body-form-gue">
    	<div class="col-sm-6 nopadding">
    		<table class="table  table-hover table-form nomargin-bottom ">
    			<tr>
    				<th class="label-tabel" style="width: 40%">Nomor Rekam Medis</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="padding:0px;padding-left: 5px;padding-top: 2px; " >
    					<div class="col-sm-7 nopadding">
    						<input type="text" class="form-control input-sm" name="nrm" id="nrm" autofocus="" />
    					</div>
    				</th>
    			</tr>

    			<tr>
    				<th class="label-tabel" style="width: 40%">Nama Lengkap</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="font-weight: bold;" id="nama"></th>
    			</tr>

    			<tr>
    				<th class="label-tabel" style="width: 40%">Nomor NIK</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="font-weight: bold;" id="nik"></th>
    			</tr>

    			<tr>
    				<th class="label-tabel" style="width: 40%">Nomor Asuransi</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="font-weight: bold;" id="asuransi"></th>
    			</tr>

    			<tr>
    				<th class="label-tabel" style="width: 40%">Alamat Lengkap</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="font-weight: bold;" id="alamat"></th>
    			</tr>

    		</table>
    	</div>

    	<div class="col-sm-6 nopadding">
    		<table class="table  table-hover table-form nomargin-bottom ">
    			<tr>
    				<th class="label-tabel" style="width: 40%">Cara Bayar</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="padding:0px;padding-left: 5px;padding-right:5px;padding-top: 2px; " >
    					<div class="col-sm-12 nopadding">
    						<select name="cb" id="cb" class="form-control input-sm">
    							<?php 
    							echo"<option value=''>-- Pilih --</option>";
    							foreach($bayar->result() as $cb)
    							{
    								echo"<option value='".$cb->id_carabayar."'>".$cb->nama_carabayar."</option>";
    							}
    							?>
    						</select>
    					</div>
    				</th>
    			</tr>
    			<tr>
    				<th class="label-tabel" style="width: 40%">Kelompok Peserta</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="padding:0px;padding-left: 5px;padding-right:5px;padding-top: 2px; " >
    					<div class="col-sm-12 nopadding">
    						<select name="klp" id="klp" class="form-control input-sm">
    							
    						</select>
    					</div>
    				</th>
    			</tr>
    			<tr>
    				<th class="label-tabel" style="width: 40%">Kelas</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="padding:0px;padding-left: 5px;padding-right:5px;padding-top: 2px; " >
    					<div class="col-sm-12 nopadding">
    						<select name="kelas" id="kelas" class="form-control input-sm">
    							<?php 
    							foreach($kelas->result() as $k)
    							{
    								echo"<option value='".$k->id_kelasperawatan."'>".$k->nama_kelasperawatan."</option>";
    							}
    							?>
    						</select>
    					</div>
    				</th>
    			</tr>
    			<tr>
    				<th class="label-tabel" style="width: 40%">Dokter</th>
    				<th class="label-tabel" width="2">:</th>
    				<th style="padding:0px;padding-left: 5px;padding-right:5px;padding-top: 2px; " >
    					<div class="col-sm-12 nopadding">
    						<select class="form-control input-sm" name="dokter" id="dokter"  >
                            </select>
    					</div>
    				</th>
    			</tr>
                <tr>
                    <td colspan="3" id="btn-update-form-penata-jasa" class="hidden">
                        <button type='button' class='btn btn-gue' id='update_form'>Simpan Perubahan</button>
                    </td>
                </tr>
    		</table>
    	</div>
    </div>
    <!-- end body -->
    </form>


    <!-- start heading  -->
    <div class="panel-heading">
        <div class="panel-title" style="padding-bottom: 0px; padding-top: 0px;">
            <ul class="nav nav-tabs "><!-- available classes "bordered", "right-aligned" -->
                    <li class="active">
                        <a href="#penatajasa" data-toggle="tab">
                            <span class=""><i class="entypo-bookmarks"></i></span>
                            <span class="hidden-xs">PENATA JASA</span>
                        </a>
                    </li>
                    <li>
                        <a href="#tabcatatandokter" data-toggle="tab">
                            <span class=""><i class="entypo-tag"></i></span>
                            <span class="hidden-xs">CATATAN DOKTER</span>
                        </a>
                    </li>
                    <li>
                        <a href="#tabresepobat" data-toggle="tab">
                            <span class=""><i class="entypo-bag"></i></span>
                            <span class="hidden-xs">RESEP OBAT</span>
                        </a>
                    </li>
                    <li>
                        <a href="#taborderlab" data-toggle="tab">
                            <span class=""><i class="entypo-export"></i></span>
                            <span class="hidden-xs">ORDER LABORATURIUM</span>
                        </a>
                    </li>
                    <li>
                        <a href="#taborderrad" data-toggle="tab">
                            <span class=""><i class="entypo-export"></i></span>
                            <span class="hidden-xs">ORDER RADIOLOGI</span>
                        </a>
                    </li>
                    <li>
                        <a href="#tabrujukinteren" data-toggle="tab">
                            <span class=""><i class="entypo-shuffle"></i></span>
                            <span class="hidden-xs">RUJUK INTEREN</span>
                        </a>
                    </li>

                </ul>
        </div>
    </div>
    <!-- end heading  -->

    <!-- start body -->
    <div class="panel-body body-form-gue">
        <div class="col-sm-12 nopadding">
            <div class="tab-content">
                <div class="tab-pane active" id="penatajasa">
                    <form class="form-tindakan-jasa">
                        <input type="hidden" name="id_kunjunganrajal" id="id_kunjunganrajal"/>
                        <input type="hidden" name="tarif" id="tarif"/>
                        <table class="table  table-hover table-form nomargin-bottom ">
                            <tr>
                                <th class="label-tabel" style="width: 10%">KODE</th>
                                <th class="label-tabel" style="width: 1%">:</th>
                                <th style="padding:0px;padding-left: 5px;padding-top: 2px; width: 10%;padding-right: 5px" >
                                    <div class="col-sm-12 nopadding">
                                        <input type="text" class="form-control input-sm" name="kode" id="kode"/>
                                    </div>
                                </th>
                                <th class="label-tabel" style="width: 10%">TINDAKAN :</th>
                                <th style="width: 53%" class="nama_tindakan"></th>
                                <th class="label-tabel" style="width: 5%">QTY</th>
                                <th class="label-tabel" style="width: 1%">:</th>
                                <th style="padding:0px;padding-left: 5px;padding-top: 2px; width: 10%;padding-right: 5px" >
                                    <div class="col-sm-12 nopadding">
                                        <input type="text" class="form-control input-sm" name="qty" id="qty" />
                                    </div>
                                </th>
                            </tr>
                        </table>
                    </form>

                    <!-- tabel isi data jasa dan tindakan  -->
                    <div class="col-sm-12 nopadding" id='table-jasa-dan-tindakan'>

                    </div>
                    <!-- endt tabel isi data jasa dan tindakan  -->

                </div>
                    
                <!-- tab catatan dokter -->
                <div class="tab-pane" id="tabcatatandokter">
                    tab catatan dokter
                </div>

                <!-- tab resep obat -->
                <div class="tab-pane" id="tabresepobat">
                    tab resep obat
                </div>

                <!-- tab order lab -->
                <div class="tab-pane" id="taborderlab">
                   

                </div>

                <!-- tab order radiologi -->
                <div class="tab-pane" id="taborderrad">
                    tab order radiologi
                </div>

                <!-- tab rujuk interen -->
                <div class="tab-pane" id="tabrujukinteren">
                    <form class="form_data_rujuk_interen">
                    <input type="hidden" name="tgl_daftar" id="tgl_daftar">
                    <table class="table  table-hover table-form nomargin-bottom ">
                        <tr>
                            <th class="label-tabel" style="width: 15%">Poliklinik</th>
                            <th class="label-tabel" style="width: 1%">:</th>
                            <th style="padding:0px;padding-left: 5px;padding-top: 2px; width: 90%;padding-right: 5px" >
                                <div class="col-sm-2 nopadding">
                                    <select name="polirujuk" id="polirujuk" class="form-control input-sm">
                                    <option></option>
                                        <?php 
                                            foreach ($poli->result() as $p) {
                                                # code...
                                                echo "<option value='".$p->id_poliklinik."'>Poliklinik ".$p->nama_poliklinik."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </th>
                        </tr>

                        <tr>
                            <th class="label-tabel" style="width: 15%">Dokter</th>
                            <th class="label-tabel" style="width: 1%">:</th>
                            <th style="padding:0px;padding-left: 5px;padding-top: 2px; width: 90%;padding-right: 5px" >
                                <div class="col-sm-3 nopadding">
                                    <select name="dokterrujuk" id="dokterrujuk" class="form-control input-sm">
                                    </select>
                                </div>
                            </th>
                        </tr>

                        <tr>
                            <input type="hidden" name="dokter_pengirim" id="dokter_pengirim">
                            <th class="label-tabel" style="width: 15%">Dokter Pengirim</th>
                            <th class="label-tabel" style="width: 1%">:</th>
                            <th style="font-weight: bold;" id='dokterpengirim'></th>
                        </tr>

                        <tr>
                            <th class="label-tabel" style="width: 15%">Catatan Pengantar</th>
                            <th class="label-tabel" style="width: 1%">:</th>
                            <th style="padding:0px;padding-left: 5px;padding-top: 2px;padding-bottom: 2px; width: 90%;padding-right: 5px" >
                                <div class="col-sm-12 nopadding">
                                    <textarea class="form-control input-sm" rows="5" name="ctt_pengantar" placeholder="Catatan pengantar rujukan ..."></textarea>
                                </div>
                            </th>
                        </tr>

                        <tr>
                            <th style="width: 15%" colspan="2"></th>
                            <th >
                                <button type='button' class='btn btn-gue' id='btn_kirim_rujukan_interen'>Kirim Pasien</button>
                            </th>
                        </tr>

                    </table>
                    </form>
                </div>

            </div> 
        </div>
    </div>
    <!-- end body panel  -->


</div>


<script type="text/javascript">
    $(document).ready(function(){
        $(".form-kunjungan").submit(function(e){
            e.preventDefault();
        })
        $("#nrm").keypress(function(e){
            var nrm=$(this).val()
            if(e.which==13)
            {
                if(nrm=='')
                {
                    alert('Masukkan nomor rekam medis pasien.')
                }
                else
                {
                    // loading_show()
                    jQuery.ajax({
                        type:"POST",
                        url:base_url+'rajal/penatajasa_api/get_data_kunjungan',
                        data:'nrm='+nrm,
                        dataType:'json',
                        error:function(xhr, desc, err)
                        {
                            alert('Gagal terhubung ke server.')
                            loading_hide()
                        },
                        success:function(json)
                        {
                            if(json.success)
                            {
                                // append data master 
                                $("#klp").empty();
                                $.each(json.master_klp, function(i, isi)
                                    {
                                        var c=''
                                        if(isi.id==json.data_pasien.klp)
                                        {
                                            c='selected';
                                        }
                                        $("#klp").append('<option value=' + isi.id_kelompok + '  '+ c +'>' + isi.nama_kelompok + '</option>')
                                    }
                                )

                                $("#dokter").empty();
                                $.each(json.data_dr, function(i, isi)
                                    {
                                        var c='';
                                        if(isi.id==json.data_pasien.kode_dokter)
                                        {
                                            c='selected';
                                        }
                                        $("#dokter").append('<option value='+ isi.kode_dokter +'  '+ c +'>'+ isi.nama_dokter +'</option>');
                                    }
                                )

                                // set data pasien dan knjungan
                                $("#nama").html(json.data_pasien.nama);
                                $("#nik").html(json.data_pasien.nik);
                                $("#asuransi").html(json.data_pasien.asuransi);
                                $("#alamat").html(json.data_pasien.alamat);
                                $("#cb").val(json.data_pasien.cb);
                                $("#kelas").val(json.data_pasien.kelas);
                                $("#no_kunjungan").val(json.data_pasien.no_kunjungan)

                                // menampilkan tomobol simpan perubahan 
                                $("#btn-update-form-penata-jasa").removeClass('hidden')
                                $("#kode").focus();

                                //set dokter pengirim
                                $("#tgl_daftar").val(json.tgl_daftar);
                                $("#dokterpengirim").html(json.dokter_pengirim);

                                loading_hide();
                                load_data_penata_jasa(base_url+'rajal/penatajasa_api/load_tabel_data_penata_jasa?id='+json.data_pasien.id)
                                $("#id_kunjunganrajal").val(json.data_pasien.id);
                            }
                            else
                            {
                                alert(json.pesan_err)
                                $("#nrm").val('').focus();
                                clear_data_pasien();
                                loading_hide();
                                load_data_penata_jasa(base_url+'rajal/penatajasa_api/load_tabel_data_penata_jasa?id=')
                            }
                        }
                    })
                }
            }

           
        })

        function clear_data_pasien()
        {
            $("#nama").html('');
            $("#nik").html('');
            $("#asuransi").html('');
            $("#alamat").html('');
            $("#cb").val('');
            $("#klp").empty();
            $("#kelas").val('');
            $("#dokter").empty();
            $("#no_kunjungan").val('');
            $("#id_kunjunganrajal").val('');
            $("#tgl_daftar").val('');
            $("#dokterpengirim").html('');
            // hide tomobol simpan perubahan
            $("#btn-update-form-penata-jasa").addClass('hidden')
        }

    })
    function loading_show()
    {
        var $this = $(".panel");
        blockUI($this);
        $this.addClass('reloading');
    }
    
    function loading_hide()
    {
        var $this = $(".panel");
        unblockUI($this)
        $this.removeClass('reloading');
    }
     // change cara bayar
    $("#cb").change(function(){
        loading_show();
        var cb=$(this).val();
        $.ajax({
            type:"POST",
            url:base_url+'rajal/penatajasa_api/get_klp',
            data:'cb='+cb,
            dataType:'json',
            error:function(xhr, desc, err)
            {
                alert("Gagal terhubung ke server.")
                loading_hide();
            },
            success:function(json)
            {
                if(json.success)
                {
                    $("#klp").empty();
                    $.each(json.klp, function(i, isi){
                        $("#klp").append('<option value='+ isi.id +'>'+isi.value+'</option>')
                    })
                }
                else
                {
                    alert(json.pesan_err);
                }
                loading_hide();
            }
        })
    })

    $("#update_form").click(function(e){
        loading_show();
        var form =$(".form-kunjungan").serialize();
        $.ajax({
            type:"POST",
            url:base_url+'rajal/penatajasa_api/update_data_kunjungan',
            data:form,
            dataType:'json',
            error:function(xhr, desc, err)
            {
                alert('Gagal terhubung ke server.');
                loading_hide();
            },
            success:function(json)
            {
                if(json.success)
                {
                    alert('Berhasil diperbaharui.');
                }
                else
                {
                    alert(json.pesan_err);
                }
                loading_hide()
            }
        })
    })

    function load_data_penata_jasa(url)
    {
        loading_show();
        $("#table-jasa-dan-tindakan").load(url, function(responseTxt, statusTxt, xhr){
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

    $("#kode").keypress(function(e){
        if(e.which==13)
        {
            loading_show();
            var kode=$(this).val();  
            var nokunjungan=$("#no_kunjungan").val();          
            $.ajax({
                type:"POST",
                url:base_url+'rajal/penatajasa_api/get_tindakan_jasa',
                data:'kode='+kode+'&nokunjungan='+nokunjungan,
                dataType:'json',
                error:function(xhr, desc, err)
                {
                    alert('Gagal terhubung ke server.');
                    loading_hide();
                },
                success:function(json)
                {
                    loading_hide();
                    if(json.success)
                    {
                        $(".nama_tindakan").html(json.nama_tindakan);
                        $("#tarif").val(json.tarif)
                        $("#qty").val('1').focus();
                    }
                    else
                    {
                        $(".nama_tindakan").html('');
                        $("#qty").val('');
                        $("#kode").focus();
                        $("#tarif").val('')
                        alert(json.pesan_err)
                    }
                }
            })
        }
    })

    $("#qty").keypress(function(e){
        if(e.which==13)
        {
            loading_show();
            var form_data=$(".form-tindakan-jasa").serialize();
            $.ajax({
                type:"POST",
                url:base_url+'rajal/penatajasa_api/simpan_tindakan',
                data:form_data,
                dataType:'json',
                error:function(xhr, desc, err)
                {
                    alert('Gagal terhubung ke server.');
                    loading_hide();
                },
                success:function(json)
                {
                    loading_hide();
                    if(json.success)
                    {
                        load_data_penata_jasa(base_url+'rajal/penatajasa_api/load_tabel_data_penata_jasa?id='+$("#id_kunjunganrajal").val())
                        $("#qty").val('');
                        $(".nama_tindakan").html('');
                        $("#kode").val('').focus();
                    }
                    else
                    {
                        alert(json.pesan_err).
                        $("#qty").focus();
                    }
                }
            })
        }
    })

    function hapus(ID)
    {
        var e=confirm("Hapus jasa & tindakan ini ?")
        if(e)
        {
            loading_show();
            $.ajax({
                type:"POST",
                url:base_url+'rajal/penatajasa_api/hapus_tindakan',
                data:'id='+ID,
                dataType:'json',
                error:function()
                {
                    alert('Gagal terhubung ke server.');
                    loading_hide();
                },
                success:function(json)
                {
                    if(json.success)
                    {
                        load_data_penata_jasa(base_url+'rajal/penatajasa_api/load_tabel_data_penata_jasa?id='+$("#id_kunjunganrajal").val())
                    }
                    else
                    {
                        alert(json.pesan_err)
                    }
                }
            })
        }
    }

    $("#polirujuk").change(function(){
        var id_polirujuk=$(this).val();
        var tgl_daftar=$("#tgl_daftar").val();
        loading_show();
        
        $.ajax({
            type:"POST",
            url:base_url+'rajal/penatajasa_api/get_dokter_piket',
            data:'polirujuk='+id_polirujuk+'&tgl_daftar='+tgl_daftar,
            dataType:'json',
            error:function()
            {
                alert('Gagal terhubung ke server.');
                loading_hide();
            },
            success:function(json)
            {
                $("#dokterrujuk").empty();
                $.each(json, function(i, isi){
                    $("#dokterrujuk").append('<option value='+ isi.id +'>'+isi.value+'</option>')
                })
                loading_hide()
            }
        })
    })

    $("#btn_kirim_rujukan_interen").click(function(){
        var tanya=confirm("Semua data akan dikirim ke poliklinik tujuan, proses pada poliklinik sekarang akan ditutup. Kirim sekarang ?")
        if(tanya)
        {
            var data_rujuk=$(".form_data_rujuk_interen").serialize();
            var nomor_kunjungan_rujuk=$("#no_kunjungan").val();
            var id_kunjunganrajal=$("#id_kunjunganrajal").val();
            loading_show();
            $.ajax({
                type:"POST",
                url:base_url+'rajal/penatajasa_api/kirim_rujukan_interent',
                data:data_rujuk+'&nomor_kunjungan='+nomor_kunjungan_rujuk+'&id_kunjunganrajal='+id_kunjunganrajal,
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
                        alert("Rujukan berhasil dikirim.");
                        window.location.href='<?php echo base_url().'rajal/penatajasa'?>'
                    }
                    else
                    {
                        alert(json.pesan_err)
                    }

                    loading_hide();
                }
            })
        }

    })

    // proses kirim orderan lab
    $("#btn_kirim_orderan_lab").click(function(){
        var form_data=$(".form_orderan_lab").serialize();
        var nokunjungan=$("#no_kunjungan").val();   
        var id_kunjunganrajal=$("#id_kunjunganrajal").val();
        if(form_data.length=='')
        {
            alert('Pilih minimal satu pemeriksaan.')
        }
        else
        {
            var e =confirm("Data akan dikirim ke instalasi laboraturium, semua sudah benar ?");
            if(e)
            {
                loading_show();
                $.ajax({
                    type:"POST",
                    url:base_url+'rajal/penatajasa_api/kirim_orderan_lab',
                    data:form_data+'&nokunjungan='+nokunjungan+'&id_kunjunganrajal='+id_kunjunganrajal,
                    dataType:'json',
                    error:function()
                    {
                        alert('Gaga terhubung ke server.');
                        loading_hide();
                    },
                    success:function(json)
                    {
                        if(json.success)
                        {
                            alert('Berhasil mengirim orderan lab.');
                            $(".form_orderan_lab").trigger('reset');
                        }
                        else
                        {
                            alert(json.pesan_err)
                        }
                        loading_hide();
                    }
                })
            }
        }
    })

    // cancel orderan lab
    $("#btn_cancel_orderan_lab").click(function(){
        $(".form_orderan_lab").trigger('reset')
    })
</script>