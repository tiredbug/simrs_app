<div class="panel panel-warning konten ">
    <div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-docs"></i> Detail Transaksi Return Barang
        </div>
        <div class="panel-options">
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
    </div>

    <div class="panel-body body-form-gue">
        <table class="table table-bordered datatable table-hover nomargin-bottom" >
        <input type="hidden" name="nota" id="nota" value="<?php echo $this->input->get('nota')?>">
            <tr>
                <th class="label-tabel" style="width: 30%">No. Transaksi Return</th>
                <th class="label-tabel" width="2">:</th>
                <th class="label-tabel-text">
                    <?php 
                        echo $row['no_transaksi']
                    ?>
                </th>
            </tr>

            <tr>
                <th class="label-tabel" style="width: 30%">Tgl Return</th>
                <th class="label-tabel" width="2">:</th>
                <th class="label-tabel-text">
                    <?php 
                        echo tgl_biasa($row['tgl_return'])
                    ?>
                </th>
            </tr>

            <tr>
                <th class="label-tabel" style="width: 30%">Diserahkan Oleh</th>
                <th class="label-tabel" width="2">:</th>
                <th class="label-tabel-text">
                    <?php 
                        echo $row['penyerah']!=''?$row['penyerah']:'-';
                    ?>
                </th>
            </tr>

            <tr>
                <th class="label-tabel" style="width: 30%">Diterima Oleh</th>
                <th class="label-tabel" width="2">:</th>
                <th class="label-tabel-text">
                    <?php 
                        echo $row['penerima']!=''?$row['penerima']:'-';
                    ?>
                </th>
            </tr>

            <tr>
                <th class="label-tabel" style="width: 30%">No. Transaksi Penerimaan</th>
                <th class="label-tabel" width="2">:</th>
                <th class="label-tabel-text">
                    <?php 
                        echo $row['nota_masuk'];
                    ?>
                </th>
            </tr>


            <tr>
                <th class="label-tabel" style="width: 30%">Keterangan Lain</th>
                <th class="label-tabel" width="2">:</th>
                <th class="label-tabel-text">
                    <?php 
                        echo $row['keterangan_lain'];
                    ?>
                </th>
            </tr>
        </table>
    </div>

    <div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-docs"></i> Daftar Barang Direturn
        </div>
    </div>

    <div class="panel-body body-form-gue">
        <table class="table table-bordered table-hover table-data nomargin-bottom" style="width: 100%">
            <thead>
                <tr>
                    <th width='50' style="text-align: center">No.</th>
                    <th>Kode Obat</th>
                    <th>Nama Obat</th>
                    <th>No. Batch</th>
                    <th>Tgl Expired</th>
                    <th>Jumlah Return</th>
                </tr>
            </thead>
            <tbody >
                <?php
                $no=1; 
                foreach ($list->result() as $l) {
                    # code...
                    echo "<tr>
                        <td style='text-align: center'>".$no."</td>
                        <td>".$l->kode_obat."</td>
                        <td>".$l->nama_obat."</td>
                        <td>".$l->no_batch."</td>
                        <td>".tgl_biasa($l->expired)."</td>
                        <td>".$l->jumlah_return." ".$l->satuan_obat."</td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>


    <div class="panel-heading">
        <div class="pull-right" style="margin:5px">
            <button type="button" class="btn btn-info btn-kembali">Kembali</button>
            <button type="button" class="btn btn-success btn-cetak">Cetak Nota Return </button>
        </div>
    </div>

</div>
<!-- // tag untuk menampung output nota transaksi -->

<style type="text/css">
    .cetak {
        display: none;
    }
</style>
<div class="cetak ">
</div>

<!-- end -->
<script type="text/javascript">
    $(".btn-kembali").click(function(){
        window.location.href=base_url+'gudangobat/returnobat/data';
    })

    $(".btn-cetak").click(function(){
        loading('show');
        var $this=$(".btn-cetak");
        $this.html("<i class='fa fa-spin fa-spinner'></i> Membuat nota transaksi...");
        var url=base_url+'gudangobat/returnobat_api/cetak?nota='+$("#nota").val();
        $(".cetak").load(url, function(responseTxt, statusTxt, xhr){
            if(statusTxt=="success")
            {
                loading('hide');
                $("div.cetak").printArea(); 
                $this.html("Cetak Nota Return")
            }
            else if(statusTxt=='error')
            {
                loading('hide');
                toastr.error("Gagal memuat laporan.");
                $this.html("Cetak Nota Return")
            }
        })
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
            $this.removeClass('reloading')
        }
    }

</script>