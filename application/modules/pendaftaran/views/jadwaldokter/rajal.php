<?php if(! defined("BASEPATH")) exit ("No direct script access allowed");?>
<div class="panel panel-warning konten ">
    <div class="panel-heading">
        <div class="panel-title">
            <b><i class="entypo-clock"></i> JADWAL DOKTER</b>
        </div>
        <div class="panel-options">
            <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
    </div>
    <div class="panel-body" style="padding-bottom: 0px">
        <div class="row">
            <div class="col-sm-6 nopadding-right">
                <div class="form-group">
                    <select name="poli" id="poli" class="form-control input-sm">
                        <option value="">POLIKLINIK</option>
                        <?php 
                        foreach($poli->result() as $p)
                        {
                            echo"<option value='".$p->id_poliklinik."'>Poliklinik ".$p->nama_poliklinik."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-6 nopadding-left">
                <div class="form-group">
                    <select name="bulan" id="bulan" class="form-control input-sm">
                        <option value="">BULAN</option>
                        <option value="01">JANUARI</option>
                        <option value="02">FEBRUARI</option>
                        <option value="03">MARET</option>
                        <option value="04">APRIL</option>
                        <option value="05">MEI</option>
                        <option value="06">JUNI</option>
                        <option value="07">JULI</option>
                        <option value="08">AGUSTUS</option>
                        <option value="09">SEPTEMBER</option>
                        <option value="10">OKTOBER</option>
                        <option value="11">NOVEMBER</option>
                        <option value="12">DESEMBER</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body konten-jadwal-dokter" style="padding-top: 0px">
        
    </div>

</div>


<script type="text/javascript">
    $(document).ready(function(){
        tampil_piket("<?php echo base_url().'pendaftaran/Jadwaldokter_api/load_piket_rajal'?>")
    })

    $("#poli").change(function(){
        var poli=$(this).val();
        var bulan=$("#bulan").val();

        tampil_piket(base_url+'pendaftaran/Jadwaldokter_api/load_piket_rajal?poli='+poli+'&bulan='+bulan);
    })

    $("#bulan").change(function(){
        var bulan=$(this).val();
        var poli=$("#poli").val();

        tampil_piket(base_url+'pendaftaran/Jadwaldokter_api/load_piket_rajal?poli='+poli+'&bulan='+bulan);
    })

    function tampil_piket(url)
    {
        loading_show();
        $(".konten-jadwal-dokter").load(url, function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
            {
                loading_hide();
            }
            if(statusTxt=="error")
            {
                loading_hide();
                alert('Gagal memuat halaman piket dokter, silahkan reload kembali.')
            }
        })
    }
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
</script>