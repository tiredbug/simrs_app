<div class="panel panel-primary konten">
    <div class="panel-heading">
        <div class="panel-title bold">
            <i class="entypo-user-add"></i> FORM REGISTRASI PASIEN
        </div>
        <!-- end panel titel -->
        <div class="panel-options">
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
    </div>

    <div class="panel-body">
    <form class="form-horizontal form-data form-register-pasien">
        <h6 class="bold"><i class='entypo-sweden'></i> IDENTITAS</h6>
        <br>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-3">No. Medrec :</label>
                    <div class="col-sm-9">
                        <input type="hidden" name="id"  value="<?php echo $row['nomor_rekammedis']?>">
                        <input type="text" class="form-control " name="norek" id="norek" disabled="" value="<?php echo $row['nomor_rekammedis']?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Nomor NIK :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control " name="nik" id="nik" value="<?php echo $row['nomor_nik']?>" placeholder="Nomor NIK sesuai KTP atau KK...">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">No Asuransi :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control " name="noasuransi" id="noasuransi" placeholder="Nomor kartu asuransi..." value="<?php echo $row['nomor_asuransi']?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Nama Lengkap :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control " name="nama" id="nama" value="<?php echo $row['nama_lengkap']?>" placeholder="Nama lengkap pasien...">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Jenis Kelamin :</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="jk" id="jk">
                            <option value=''>-- Pilih --</option>
                            <option value="Laki-Laki" <?php echo $row['jenis_kelamin']=="Laki-Laki"?'selected':''?> >Laki-Laki</option>
                            <option value="Perempuan" <?php echo $row['jenis_kelamin']=="Perempuan"?'selected':''?> >Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Agama :</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="agama" id="agama">
                            <option value=''>-- Pilih --</option>
                            <?php 
                            foreach ($agama->result() as $ag)
                            {
                                echo"<option value='".$ag->id."'";
                                echo $row['agama']==$ag->id?'selected':'';
                                echo">".$ag->agama."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-3">Tempat Lahir :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control " name="tp_lahir" value="<?php echo $row['tp_lahir']?>" id="tp_lahir" placeholder="Tempat lahir pasien...">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Tgl Lahir :</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="tgl_lahir" id="tgl_lahir" data-format="dd-mm-yyyy" value="<?php echo date("d-m-Y",strtotime($row['tgl_lahir']))?>">
                            <div class="input-group-addon">
                                <a href="#"><i class="entypo-calendar"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Pendidikan :</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="pdd" id="pdd">
                            <option value=''>-- Pilih --</option>
                            <?php 
                            foreach ($pendidikan->result() as $pdd)
                            {
                                echo"<option value='".$pdd->id_pendidikan."'";
                                echo$row['kode_pendidikan']==$pdd->id_pendidikan?'selected':'';
                                echo">".$pdd->nama_pendidikan."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-3">Pekerjaan :</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="pkj" id="pkj">
                            <option value=''>-- Pilih --</option>
                            <?php 
                            foreach ($pekerjaan->result() as $p)
                            {
                                echo"<option value='".$p->id_pekerjaan."'";
                                echo$row['kode_pekerjaan']==$p->id_pekerjaan?'selected':'';
                                echo">".$p->nama_pekerjaan."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-3">Status :</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="stt" id="stt">
                            <option value="Kawin" <?php echo $row['status_pasien']=="Kawin"?'selected':''?> >Kawin</option>
                            <option value="Belum Kawin" <?php echo $row['status_pasien']=="Belum Kawin"?'selected':''?> >Belum Kawin</option>
                            <option value="Janda" <?php echo $row['status_pasien']=="Janda"?'selected':''?> >Janda</option>
                            <option value="Duda" <?php echo $row['status_pasien']=="Duda"?'selected':''?> >Duda</option>
                            <option value="Cerai Mati" <?php echo $row['status_pasien']=="Cerai Mati"?'selected':''?> >Cerai Mati</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>


        <h6 class="bold"><i class='entypo-sweden'></i> INFORMASI DOMISILI</h6>
        <br>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-3">Alamat lengkap :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="Alamat sesuai dengan kartu identitas..." name="alamatktp" id="alamatktp" value="<?php echo $row['alamat_ktp']?>"/>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-3">Provinsi :</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="prov_ktp" id="prov_ktp">
                            <?php 
                            echo"<option value=''>-- Pilih --</option>";
                            foreach($provinsi->result() as $prov_ktp)
                            {
                                echo"<option value='".$prov_ktp->id_provinsi."'";
                                echo$row['kode_provinsi']==$prov_ktp->id_provinsi?'selected':'';
                                echo">".$prov_ktp->nama_provinsi."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Kabupaten :</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="kab_ktp" id="kab_ktp">
                            <option value="">-- Pilih --</option>
                            <?php 
                            foreach($kab_ktp->result() as $kt)
                            {
                                echo"<option value='".$kt->id_kota."'";
                                echo$row['kode_kabupaten']==$kt->id_kota?'selected':'';
                                echo">".$kt->nama_kota."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

            </div>


            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-3">Kecamatan :</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="kec_ktp" id="kec_ktp">
                            <option value="">-- Pilih --</option>
                            <?php 
                            foreach($kec_ktp->result() as $kc)
                            {
                                echo"<option value='".$kc->id_kecamatan."'";
                                echo$row['kode_kecamatan']==$kc->id_kecamatan?'selected':'';
                                echo">".$kc->nama_kecamatan."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Desa :</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="desa_ktp" id="desa_ktp">
                            <option value="">-- Pilih --</option>
                            <?php 
                            foreach($des_ktp->result() as $dst)
                            {
                                echo"<option value='".$dst->id_kelurahan."'";
                                echo$row['kode_desa']==$dst->id_kelurahan?'selected':'';
                                echo">".$dst->nama_kelurahan."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

            </div>
        </div>

        <h6 class="bold"><i class='entypo-sweden'></i> INFORMASI LANJUTAN</h6>
        <br>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                <label class="control-label col-sm-3">No. Hp :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nohp" id="nohp" placeholder="No hp pasien..."  value="<?php echo $row['hp_pasien']?>"/>
                    </div>
                </div>

                <div class="form-group">
                <label class="control-label col-sm-3">Email :</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Ketikkan email pasien..." value="<?php echo $row['email']?>"/>
                    </div>
                </div>

                <div class="form-group">
                <label class="control-label col-sm-3">Keluarga :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nama_k" id="nama_k" placeholder="Nama suami/istri atau orang tua..."  value="<?php echo $row['keluarga']?>"/>
                    </div>
                </div>

                <div class="form-group">
                <label class="control-label col-sm-3">Kontak :</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="nohp_k" id="nohp_k" placeholder="No tlfn atau hp keluarga..." value="<?php echo $row['hp_keluarga']?>"/>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="">
                    <p class="pull-right">
                        <button type="button" class="btn btn-info btn-simpan">Simpan Perubahan</button>
                        <a href="<?php echo base_url().'pendaftaran/pasien/database'?>" class="btn btn-primary btn-cancel">Kembali</a>
                    </p>
                </div>
                               
            </div>
        </div>

    </form>
    </div>

</div>




<script src="<?php echo base_url()?>template/neon/js/bootstrap-datepicker.js"></script>
<script>
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
    $(".form-register-pasien").submit(function(e){
        e.preventDefault();
    })
    
    
    $("#prov_ktp").change(function(){
        loading_show();
        $.ajax({
            type:"POST",
            url:base_url+'pendaftaran/ajax_api/get_kab',
            data:'id_provinsi='+$(this).val(),
            error:function(xhr, desc, err){
                alert('Gagal mengambil data kabupaten dari server.');
                loading_hide();
            },
            success:function(respon){
                loading_hide();
                $("#kab_ktp").html(respon);
            }
        })
    })
    
    $("#kab_ktp").change(function(){
        loading_show();
        $.ajax({
            type:"POST",
            url:base_url+'pendaftaran/ajax_api/get_kec',
            data:'id_kab='+$(this).val(),
            error:function(xhr, desc, err){
                alert('Gagal mengambil data kecamatan dari server.');
                loading_hide();
            },
            success:function(respon){
                loading_hide();
                $("#kec_ktp").html(respon);
            }
        })
    })
    
    $("#kec_ktp").change(function(){
        loading_show();
        $.ajax({
            type:"POST",
            url:base_url+'pendaftaran/ajax_api/get_desa',
            data:'id_kec='+$(this).val(),
            error:function(xhr, desc, err){
                alert('Gagal mengambil data kelurahan dari server.');
                loading_hide();
            },
            success:function(respon){
                loading_hide();
                $("#desa_ktp").html(respon);
            }
        })
    })
    
    $(".btn-simpan").click(function(e){
        var data_registrasi=$(".form-register-pasien").serialize();
        

        loading_show();
        swal({
            title:"Lanjutkan update ?",
            text:"Data pasien akan disimpan, pastikan semua data sudah benar klik tombol setuju apaila sudah benar.",
            type:"warning",
            showCancelButton:true,
            confirmButtonText:"Ya , saya setuju.",
            confirmButtonColor:"#21a9e1",
            closeOnConfirm:false
        },
        function(){
            
            $.ajax({
                type:"Post",
                url:base_url+'pendaftaran/ajax_api/void_update',
                data:data_registrasi,
                dataType:'json',
                beforeSend:function(){
                    $(".btn-simpan").html("<i class='fa fa-spin fa-spinner '></i> Menyimpan perubahan...")
                },
                error:function()
                {
                    loading_hide();
                    swal("Gagal terhubung ke server","periksa jaringan LAN atau koneksi jaringan anda dan coba kembali.",'error')
                    $(".btn-simpan").html("Simpan perubahan")
                },
                success:function(json)
                {
                    if(json.success)
                    {
                        
                        $(".form-group").removeClass('has-error')
                                        .removeClass('has-success')
                        $('.text-danger').remove();
                        swal("Berhasil !",'Data pasien berhasil diperbaharui.','success');

                        loading_hide();

                        swal({
                            title: "Berhasil !",
                            text: "Data pasien berhasil diperbaharui.",
                            type:'success',
                        },
                            function(){
                                window.location.href=base_url+'pendaftaran/pasien/database'
                            }
                        )

                        $(".btn-simpan").html("Simpan perubahan")
                    }
                    else
                    {
                        $.each(json.message,function(i, val){
                            var elemen=$("#"+i);
                            elemen.closest('div.form-group')
                            .removeClass('has-error')
                            .addClass(val.length > 0 ?'has-error':'has-success')
                            .find('.text-danger').remove();
                            elemen.after(val)
                        })
                        swal("Gagal !",json.pesan_err,'error')
                        loading_hide();
                        $(".btn-simpan").html("Simpan perubahan")
                    }

                    
                    
                }
            })
        }
        )
    
    })

</script>
