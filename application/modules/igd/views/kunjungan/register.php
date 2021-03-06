<?php if(! defined("BASEPATH")) exit ("No direct script access allowed");?>
<div class="panel panel-primary konten">
    <div class="panel-heading">
        <div class="panel-title bold">
            <i class="entypo-user-add"></i> FORM REGISTRASI KUNJUNGAN
        </div>
        <div class="panel-options">
            <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
    </div>
    <div class="panel-body">
        <form class="form-horizontal form-igd">
        <div class="row">
            <div class="col-sm-7">
                <h6 class="bold"><i class='entypo-sweden'></i> INFORMASI KUNJUNGAN</h6>
                <br>
                <div class="form-group">
                    <label class="control-label col-sm-3">No. Medrec :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control  " name="nrm" id="nrm" autofocus=""  placeholder="Nomor rekam medis pasien..." />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Metode Pembayaran :</label>
                    <div class="col-sm-9">
                        <select class="form-control  " name="cb" id="cb">
                            <option value="">-- Pilih --</option>
                            <?php 
                                foreach($cb->result() as $c)
                                {
                                    echo"<option value='".$c->id_carabayar."'>".$c->nama_carabayar."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Kelompok Peserta :</label>
                    <div class="col-sm-9">
                        <select name="kelompok" class="form-control" id="kelompok">
                        <option value=''>-- Pilih --</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Kelas Perawatan :</label>
                    <div class="col-sm-9">
                        <select name="kelas" class="form-control" id="kelas">
                            <option value=''>-- Pilih --</option>
                            <?php 
                            foreach($kelas->result() as $kls)
                                {
                                    echo"<option value='".$kls->id_kelasperawatan."'>".$kls->nama_kelasperawatan."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Tgl dan Jam Daftar :</label>
                    <div class="col-sm-5">
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="tgl_daftar" id="tgl_daftar" data-format="dd-mm-yyyy" value="<?php echo tgl_biasa(date("d-m-Y"))?>">
                            <div class="input-group-addon">
                                <a href="#"><i class="entypo-calendar"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <input type="text" class="form-control timepicker" data-template="dropdown" data-show-seconds="true" data-default-time="<?php echo date("H:i:s")?>" data-show-meridian="false" data-minute-step="5" data-second-step="5"  id="jam_daftar" name="jam_daftar" />      
                                <div class="input-group-addon">
                                    <a href="#"><i class="entypo-clock"></i></a>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Cara Rujuk :</label>
                    <div class="col-sm-9">
                        <select class="form-control  " name="cr" id="cr">
                            <option value=''>-- Pillih --</option>
                            <?php 
                                foreach($cara_rujuk->result() as $c_r)
                                {
                                    echo"<option value='".$c_r->id_cararujuk."'>".$c_r->nama_cararujuk."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-3">Nomor Rujukan :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control  " name="nomor_rujukan" id="nomor_rujukan" placeholder="Nomor rujukan..." />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Asal Rujukan :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control  " name="asal_rujuk" id="asal_rujuk" placeholder="Asal rujukan..." />
                    </div>
                </div>

                

                <div class="form-group">
                    <label class="control-label col-sm-3">Tgl, Jam Rujukan :</label>
                    <div class="col-sm-5">
                        <div class="input-group">
                                <input type="text" class="form-control datepicker" name="tgl_rujukan" id="tgl_rujukan" data-format="dd-mm-yyyy" value="<?php echo tgl_biasa(date("d-m-Y"))?>">
                                <div class="input-group-addon">
                                    <a href="#"><i class="entypo-calendar"></i></a>
                                </div>
                            </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group">
                                <input type="text" class="form-control timepicker" data-template="dropdown" data-show-seconds="true" data-default-time="<?php echo date("H:i:s")?>" data-show-meridian="false" data-minute-step="5" data-second-step="5"  id="jam_rujuk" name="jam_rujuk" />        
                                <div class="input-group-addon">
                                    <a href="#"><i class="entypo-clock"></i></a>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">PPK Rujukan :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control  " name="ppk_rujuk"  id="ppk_rujuk" placeholder="PPK Rujukan..." />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Diagnosa :</label>
                    <div class="col-sm-9">
                        <input type="hidden" class="diagnosa form-control" id='diagnosa' name="diagnosa"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Jenis Pasien :</label>
                    <div class="col-sm-9">
                        <input type="radio" value="Pasien Baru" name="j_p"  /> Pasien Baru
                        <input type="radio" value="Pasien Lama" name="j_p" checked="" /> Pasien Lama
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-3">Deposito :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control  " name="deposito" id="deposito" placeholder="Rp..." />
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-3">Dokter :</label>
                    <div class="col-sm-9">
                        <select class="form-control select2" name="dokter" id="dokter">
                            <option value=''>-- Pilih --</option>

                            <?php
                            $dokter_umum=$this->db->query("SELECT 
                                                            d.kode_dokter id, CONCAT(d.nama_belakang,' ',d.nama_dokter) nama
                                                            FROM admin_masterdokter d
                                                            WHERE d.jenis_dokter IN('umum') OR d.jenis_dokter IN('Spesialis')"); 
                            foreach ($dokter_umum->result() as $d) {
                                # code...
                                echo "<option value='".$d->id."'>".$d->nama."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

            </div>

            <div class="col-sm-5">
                <div class="profile">
                <div class="col-sm-3 col-sm-offset-4">
                    <img src="<?php echo base_url() ?>template/neon/images/avatar5.png" alt="" class="img-circle" width="100">
                </div>
                <div class="row col-sm-12">
                    <h6 class="bold"><i class='entypo-user'></i> BIODATA PASIEN</h6>
                </div>
                
                <table class="table table-condesed">
                    <tr>
                        <th width="120">Nama Lengkap</th> 
                        <th>:</th>
                        <th class="nama"></th>
                    </tr>

                    <tr>
                        <th>Nomor NIK</th> 
                        <th>:</th>
                        <th class="nik"></th>
                    </tr>

                    <tr>
                        <th>Nomor Asuransi</th> 
                        <th>:</th>
                        <th class="as"></th>
                    </tr>

                    <tr>
                        <th>Jenis Kelamin</th> 
                        <th>:</th>
                        <th class="jkel"></th>
                    </tr>

                    <tr>
                        <th>Umur</th> 
                        <th>:</th>
                        <th class="umur"></th>
                    </tr>

                    <tr>
                        <th>Kunjungan Terakhir</th> 
                        <th>:</th>
                        <th class="kt"></th>
                    </tr>

                    <tr>
                        <th>Alamat</th> 
                        <th>:</th>
                        <th class="alamat"></th>
                    </tr>


                </table>

                <div class="bs-callout bs-callout-info nomargin-top nomargin-bottom">
                    <h4>Perhatian : </h4>
                    <p>Sebelum melakukan register masukkan nomor rekam medis lalu tekan enter, perhatikan data biodata pasien pastikan data-data tersebut benar.</p>
                    
                </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-7">
                <h6 class="bold"><i class='entypo-sweden'></i> PENANGGUNG JAWAB</h6>
                <br>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Lengkap :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control  " name="nm_k" id="nm_k" placeholder="Nama penanggung keluarga..." />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Hub. Keluarga :</label>
                    <div class="col-sm-9">
                        <select class="form-control  " name="hub_k" id="hub_k">
                            <option value=''>-- Pilih --</option>
                            <?php 
                            foreach ($hub->result() as $h) {
                                # code...
                                echo"<option value='".$h->id."'>".$h->hubungan."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">No. HP :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control  " name="hp_k" id="hp_k" placeholder="Nomor handphone..." />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Alamat Lengkap :</label>
                    <div class="col-sm-9">
                        <textarea class="form-control  " name="alamat_k" id="alamat_k"  placeholder="Ketikkan alamat penanggung jawab..."></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <p>
                            <button class="btn btn-success btn-register" type="button">Registrasi kunjungan</button>
                            <button class="btn btn-danger" type="button">Batal</button>
                        </p>
                    </div>
                </div>
                
            </div>

            
        </div>
        </form>
    </div>
</div>




<script src="<?php echo base_url()?>template/neon/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url()?>template/neon/js/bootstrap-timepicker.min.js"></script>
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

    $("#nrm").keypress(function(e){
        if(e.which==13)
        {
            loading_show();
            var nrm=$(this).val()
            $.ajax({
                type:"POST",
                url:base_url+'igd/kunjungan_api/cek_pasien',
                data:'nrm='+nrm,
                dataType:"json",
                error:function(xhr, desc, err)
                {
                    swal({
                        title:'Koneksi terputus !',
                        text:'Periksa koneksi jaringan anda lalu coba kembali',
                        imageUrl:base_url+'template/assets/img/diskonek.png',
                    })
                    loading_hide();
                },
                success:function(json)
                {
                    loading_hide();
                    if(json.success)
                    {
                        $(".nama").html(json.data.nama)
                        $(".nik").html(json.data.nik)
                        $(".as").html(json.data.asu)
                        $(".jkel").html(json.data.jk)
                        $(".umur").html(json.data.umur)
                        $(".kt").html(json.data.kunjungan_t+' yang lalu.')
                        $(".alamat").html(json.data.alamat)
                        $("#nrm").closest('div.form-group').removeClass('has-error').addClass('has-success').find('.text-danger').remove();
                    }
                    else
                    {
                        
                        swal(json.pesan.title,json.pesan.isi,'error')
                        $("#nrm").val('').focus();

                        $(".nama").html('')
                        $(".nik").html('')
                        $(".as").html('')
                        $(".jkel").html('')
                        $(".umur").html('')
                        $(".kt").html('')
                        $(".alamat").html('')
                    }

                    if(json.data.stt_k_last)
                    {
                        sweetAlert("Kunjungan terakhir", json.data.kunjungan_t+' yang lalu.', "success");
                    }

                }
            })
        }
    })
    
    $("#cb").change(function(){
        loading_show();
        var cb=$(this).val();
        $.ajax({
            type:"POST",
            url:base_url+'igd/kunjungan_api/get_klp',
            data:'cb='+cb,
            error:function(xhr, desc, err)
            {
                swal({
                    title:'Koneksi terputus.',
                    text:'Koneksi keserver terputus, periksa koneksi lalu coba lagi',
                    imageUrl:base_url+'template/assets/img/diskonek.png'
                })
                loading_hide()
            },
            success:function(html)
            {
                $("#kelompok").html(html).focus();
                loading_hide();
            }
        })
    })
    
    $(".btn-register").click(function(){
        var $this=$(this);
        var data=$(".form-igd").serialize();
        $this.html("<i class='fa fa-spin fa-spinner'></i> Menyimpan kunjungan...");
        loading('show');
        $.ajax({
            type:"POST",
            url:base_url+'igd/kunjungan_api/register_kunjungan',
            data:data,
            dataType:'json',
            error:function()
            {
                $this.html("Register kunjungan");
                swal("Gagal terhubung ke server","Periksa jaringan LAN atau koneksi jaringan anda dan coba kembali","error");
                loading('hide')
            },
            success:function(json)
            {
                
                if(json.success)
                {
                    $(".form-group").removeClass('has-error')
                                    .removeClass('has-success');
                    $(".text-danger").remove();
                    $this.html("Register kunjungan");
                    loading('hide')
                    swal("Berhasil",'Kunjungan IGD berhasil didaftarkan','success');
                    $(".form-igd").trigger('reset')

                        $("#nrm").val('').focus();

                        $(".nama").html('')
                        $(".nik").html('')
                        $(".as").html('')
                        $(".jkel").html('')
                        $(".umur").html('')
                        $(".kt").html('')
                        $(".alamat").html('')

                }
                else
                {
                    $.each(json.message,function(i, val)
                    {
                        var elemen=$("#"+i);
                        elemen.closest('div.form-group')
                        .removeClass("has-error")
                        .addClass(val.length > 0 ?'has-error':'has-success')
                        .find('.text-danger').remove();
                        elemen.after(val)
                    })
                    $this.html("Register kunjungan");
                    loading('hide')
                    if(json.pesan_err!='')
                    {
                        swal("Gagal",pesan_err,'error')
                    }
                }
            }
        })
    })

    function loading(ket)
    {
        var $this=$(".panel");
        if(ket=='show')
        {
            blockUI($this);
            $this.addClass("reloading");
        }
        else
        {
            unblockUI($this);
            $this.removeClass("reloading")
        }
    }

    //funsi select icx keypress
        $(".diagnosa").select2({
            minimumInputLength: 1,
            ajax: {
                    url: base_url+'igd/kunjungan_api/search_icdx',
                    type:'GET',
                    dataType: 'json',
                    delay: 50,
                    data: function (query) {
                        return {
                            q: query
                        };
                    },
                    results: function (data) {
                      var parsed = [];

                      try {
                        parsed = _.chain(data.data)
                          .map(function (item, index) {
                            return {
                              id: item.id,
                              text: item.slug
                            };
                          })
                          .value();
                      } catch (e) { }

                      return {
                        results: parsed
                      };
                    },
                    cache: true
            }
        });
        // end
   
</script>