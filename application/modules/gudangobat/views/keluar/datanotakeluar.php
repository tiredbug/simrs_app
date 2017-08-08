<div class="panel panel-warning konten ">
    <div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-search"></i> Filter Data Yang Ditampilkan
        </div>
        <div class="panel-options">
            <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg" title="Klik disini untuk input data master obat lebih banyak lagi."><i class="entypo-plus"></i></a>
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
    </div>

    <div class="panel-body ">
        <form class="form-horizontal">
        <div class="well well-sm no-margin nopadding">
            <div class="row">
                <div class='col-sm-6'>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Unit Client</label>
                        <div class="col-sm-8">
                            <select name="client" class="form-control client">
                                <option value="">Pilih</option>
                                <?php 
                                foreach ($client->result() as $c) {
                                    # code...
                                    echo"<option value='".$c->kode_client."'>".$c->unit_client."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">No. Transaksi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="no_transaksi" id="no_transaksi">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Tgl Transaksi</label>
                        <div class="col-sm-2 nopadding-right">
                            <select class="form-control input-sm" name="tgl" id="tgl">
                                <option value="">Pilih</option>
                                <?php 
                                for ($i=1; $i < 31+1; $i++) { 
                                    # code...
                                    $i=$i<10?'0'.$i:$i;
                                    echo"<option value='".$i."'>".$i."</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-sm-3 nopadding-right" >
                            <select class="form-control input-sm" name='bln' id="bln">
                                <option value="">Pilih</option>
                                <?php 
                                for ($i=1; $i < 12+1; $i++) { 
                                    # code...
                                    $i=$i<10?'0'.$i:$i;
                                    echo"<option value='".$i."'>".bln($i)."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="col-sm-3 " >
                            <select name="tahun" id="tahun" class="form-control input-sm">
                                <option value="">Pilih</option>
                                <?php 
                                $thn=date("Y");
                                for ($i=$thn; $i >= $thn-15; $i--) { 
                                    # code...
                                    echo"<option value='".$i."'>".$i."</option>";
                                }
                                ?>
                            </select>
                        </div>

                    </div>
                </div>

                <!-- kolom sebelah kanan  -->
                <div class="col-sm-6">

                    <div class="form-group">
                        <label class="control-label col-sm-3">Diserahkan</label>
                        <div class="col-sm-8">
                            <input type="text" name="penyerah" class="form-control serah">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Penyerah</label>
                        <div class="col-sm-8"> 
                            <input type="text" name="terima" class="form-control terima">
                        </div>
                    </div>

                </div>

            </div>
        </div>
        </form>
    </div>


    <div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-upload"></i> Data Nota Barang Keluar
        </div>
    </div>

    <div class="panel-body no-padding">
        <table class="table table-bordered tabel_nota">
            <thead>
                <tr>
                    <th>NO. TRANSAKSI</th>
                    <th>TGL TRANSAKSI</th>
                    <th>CLIENT</th>
                    <th>DI SERAH</th>
                    <th>DI TERIMA</th>
                    <th width="100" class="text-center">PILIHAN</th>
                </tr>
            </thead>
        </table>
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
	$(document).ready(function(){
        //hide_sidebar_menu(false)
        tabel_nota();
    })

	function tabel_nota()
    {
        $(".tabel_nota").DataTable({
            "ordering":false,
            "searching":false,
            "processing":true,
            "serverSide":true,
            "language":{
                "info"       : "Menampilkan _START_ s/d _END_ baris data dari _TOTAL_ data",
                "infoEmpty"  : "Tidak Ada Data",
                "emptyTable" : "Tidak Ada Data",
                "lengthMenu" : "Tampilkan _MENU_ Baris per laman.",
                "sZeroRecords": "Tidak ada data."
            },
            "rowCallback":function(row, data, index)
            {
                $('td:eq(5)', row).html(
                    "<a href='javascript:edit(\""+data[0]+"\")' class='btn btn-xs btn-info '><i class='fa fa-tags'></i> Edit</a>"
                    +' | '+
                    "<a href='javascript:cetak(\""+data[0]+"\")' class='btn btn-xs btn-danger'><i class='fa fa-print'></i> Print</a>"
                    )
            },
            "ajax":{
                type:'post',
                url:base_url+'gudangobat/keluar_api/get_data_nota',
                data:function(filter)
                {
                    filter.client               =   $(".client").val();
                    filter.no_transaksi         =   $("#no_transaksi").val();
                    filter.tgl                  =   $("#tgl").val();
                    filter.tahun                =   $("#tahun").val();
                    filter.bulan                =   $("#bln").val();
                    filter.serah                =   $(".serah").val();
                    filter.terima               =   $(".terima").val();
                }
            }
        })

        $(".tabel_nota").closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
            minimumResultsForSearch: -1
        });
    }
    function refresh()
    {
    	$(".tabel_nota").DataTable().ajax.reload();
    }
    $(".client").change(function(){
    	refresh();
    })
    $("#no_transaksi").keyup(function(e)
    {
        refresh()
    })
    $("#tahun").change(function(){
        refresh()
    })
    $("#bln").change(function(){
        refresh()
    })
    $("#tgl").change(function(){
        refresh()
    })
    $(".serah").keyup(function(){
        refresh();
    })
    $(".terima").keyup(function(){
        refresh();
    })

    function edit(nota)
    {
        window.location.href=base_url+'gudangobat/keluar/editnota?nota='+nota;
    }

    function cetak(nota)
    {
        loading("show");
        var url=base_url+'gudangobat/keluar_api/cetak?nota='+nota;
        $(".cetak").load(url, function(responseTxt, statusTxt, xhr){
            if(statusTxt=="success")
            {
                loading('hide');
                $("div.cetak").printArea(); 
            }
            else if(statusTxt=='error')
            {
                loading('hide');
                toastr.error("Gagal memuat laporan.");
            }
        })
    }
    function loading(ket)
    {
        var $this=$(".panel");
        if(ket=='show')
        {
            blockUI($this);
            $this.addClass('reloading');
        }
        else
        {
            unblockUI($this);
            $this.removeClass("reloading");
        }
    }
</script>