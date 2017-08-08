<form class="form-nota">
<div class="panel panel-warning konten ">
    <div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-docs"></i> Form Transaksi Return Barang
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
                <th class="label-tabel" style="width: 30%">No. Transaksi Return</th>
                <th class="label-tabel" width="2">:</th>
                <th style="padding:0px;padding-left: 5px;padding-top: 2px;">
                    <div class="col-sm-3 nopadding">
                        <input type="text" name="nota" id="nota" autofocus="" class="form-control input-sm" style="font-size:12px;font-weight:bold">
                    </div>
                </th>
            </tr>

            <tr>
                <th class="label-tabel" style="width: 30%">Tgl Return</th>
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
                    
                    </div>
                </th>
            </tr>

            <tr>
                <th class="label-tabel" style="width: 30%">Diserahkan Oleh</th>
                <th class="label-tabel" width="2">:</th>
                <th style="padding:0px;padding-left: 5px;padding-top: 2px;">
                    <div class="col-sm-7 nopadding">
                        <input type="text" name="serah" id="serah"  class="form-control input-sm" >
                    </div>
                </th>
            </tr>

            <tr>
                <th class="label-tabel" style="width: 30%">Diterima Oleh</th>
                <th class="label-tabel" width="2">:</th>
                <th style="padding:0px;padding-left: 5px;padding-top: 2px;">
                    <div class="col-sm-7 nopadding">
                        <input type="text" name="terima" id="terima"  class="form-control input-sm" >
                    </div>
                </th>
            </tr>

            <tr>
                <th class="label-tabel" style="width: 30%">No. Transaksi Penerimaan</th>
                <th class="label-tabel" width="2">:</th>
                <th style="padding:0px;padding-left: 5px;padding-top: 2px;">
                    <div class="col-sm-7 nopadding">
                        <input type="text" name="notamasuk" id="notamasuk"  class="form-control input-sm" >
                    </div>
                </th>
            </tr>


            <tr>
                <th class="label-tabel" style="width: 30%">Keterangan Lain</th>
                <th class="label-tabel" width="2">:</th>
                <th style="padding:0px;padding-left: 5px;padding-top: 2px;">
                    <div class="col-sm-12 nopadding">
                        <textarea class="form-control ckeditor" rows="5" name="keterangan" placeholder="Tuliskan keterangan tambahan disini, apabila dibutuhkan..."></textarea>
                    </div>
                </th>
            </tr>

        </table>
    </div>

    <div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-download"></i> Daftar Rekaman Barang Masuk
        </div>
    </div>

    <div class="panel-body body-form-gue">
        <table class="table table-bordered table-hover table-data nomargin-bottom table-center" style="width: 100%">
            <thead>
                <tr>
                    <th rowspan="2" style="background: #eef3f9">BARANG</th>
                    <th colspan="4" style="background: #eef3f9">STOK</th>
                </tr>
                <tr>
                    <th style="background: #fffcfc;width: 150px">MASUK</th>
                    <th style="background: #fff7f7;width: 150px">KELUAR</th>
                    <th style="background: #f1fff8;width: 150px">SISA STOK</th>
                    <th style="background: #ffd5d1;width: 150px">RETURN</th>
                </tr>
            </thead>
            <tbody class="data">
                
            </tbody>
        </table>
    </div>


    <div class="panel-heading">
        <div class="pull-right" style="margin:5px">
            <button type="button" class="btn btn-info btn-kembali">Kembali</button>
            <button type="button" class="btn btn-success btn-simpan">Proses Return</button>
        </div>
    </div>


</div>
</form>
<!-- <script src="<?php echo base_url()?>template/neon/js/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url()?>template/neon/js/ckeditor/adapters/jquery.js"></script> -->
<script type="text/javascript">
    $(document).ready(function(){
        $("#nota").keypress(function(e){
            if(e.which==13)
            {
                $("#tgl").focus();
            }
        })
        $("#tgl").change(function(){
            $("#bln").focus();
        })
        $("#bln").change(function(){
            $("#tahun").focus();
        })
        $("#tahun").change(function(){
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
                $("#notamasuk").focus()
            }
        })
        $("#notamasuk").keyup(function(){
            var notamasuk=$(this).val();
            $.ajax({
                type:"POST",
                url:base_url+'gudangobat/returnobat_api/get_data_penerimaan',
                data:'notamasuk='+notamasuk,
                success:function(html)
                {
                    $(".data").html(html)
                }
            })
        })
    })
    $(".btn-simpan").click(function(){
        var e=confirm("Semua data sudah benar ?");
        if(e)
        {
            loading('show')
            var data=$(".form-nota").serialize();
            $.ajax({
                type:'post',
                url:base_url+'gudangobat/returnobat_api/savereturn',
                data:data,
                dataType:'json',
                error:function(){
                    toastr.error("Gagal terhubung ke server.")
                    loading('hide')
                },
                success:function(json)
                {
                    if(json.success)
                    {
                        toastr.info("Transaksi return barang disimpan.")
                        loading('hide')
                        $(".form-nota").trigger('reset');
                        $(".data").html('')
                        $("#nota").focus();
                    }
                    else
                    {
                        toastr.error(json.pesan_err);
                        loading('hide')
                    }
                }
            })
        }
    })
    $(".btn-kembali").click(function(){
        window.location.href=base_url+'gudangobat/returnobat/data'
    })
    function loading(ket)
    {
        var $this=$(".panel");
        if(ket=='show')
        {
            blockUI($this);
            $this.addClass('reloading')
        }
        else
        {
            unblockUI($this);
            $this.removeClass("reloading");
        }
    }
</script>