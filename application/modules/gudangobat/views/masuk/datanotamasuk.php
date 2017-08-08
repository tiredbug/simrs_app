<div class="panel panel-primary konten">
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
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <form class="form-horizontal">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tgl Transaksi</label>
                                <div class="col-sm-9">
                                    <select name="tgl_transaksi" class="form-control tgl_transaksi ">
                                        <option value="">Pilih</option>
                                        <?php 
                                        foreach ($tgl_transaksi->result() as $tgl) {
                                            # code...
                                            echo"<option value='".$tgl->tgl_transaksi."'>".tgl_biasa($tgl->tgl_transaksi)."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label">Supplier</label>
                                <div class="col-sm-9">
                                    <select name="supplier" class="form-control supplier">
                                        <option value="">Pilih</option>
                                        <?php 
                                        foreach ($supplier->result() as $sp) {
                                            # code...
                                            echo"<option value='".$sp->kode_supplier."'>".$sp->nama_supplier."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">No. Faktur</label>
                                <div class="col-sm-9">
                                    <input type="text" name="no_faktur" class="form-control no_faktur">
                                </div>
                            </div>

                        </div>


                        <div class="col-sm-6">

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Diserahkan Oleh</label>
                                <div class="col-sm-9">
                                    <select name="serah" class="form-control penyerah">
                                        <option value="">Pilih</option>
                                        <?php 
                                        foreach ($penyerah->result() as $p) {
                                            # code...
                                            echo"<option value='".$p->penyerah."'>".$p->penyerah."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Diterima Oleh</label>
                                <div class="col-sm-9">
                                    <select name="serah" class="form-control penerima">
                                        <option value="">Pilih</option>
                                        <?php 
                                        foreach ($penerima->result() as $pn) {
                                            # code...
                                            echo"<option value='".$pn->penerima."'>".$pn->penerima."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">No. Transaksi</label>
                                <div class="col-sm-9">
                                    <input type="text" name="no_transaksi" class="form-control no_transaksi">
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    <table class="table table-bordered tabel_nota" width='100%'>
                        <thead>
                            <tr>
                                <th>NO. TRANSAKSI</th>
                                <th>TGL TRANSAKSI</th>
                                <th>SUPPLIER</th>
                                <th>NO. FAKTUR</th>
                                <th>DI SERAH</th>
                                <th>DI TERIMA</th>
                                <th width="120" class="text-center">PILIHAN</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
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
                $('td:eq(6)', row).html(
                    "<a href='javascript:edit(\""+data[0]+"\")' class='btn btn-info btn-sm btn-icon icon-left'><i class='fa fa-pencil'></i>Edit</a>"
                    +'&nbsp'+
                    "<a href='javascript:cetak(\""+data[0]+"\")' class='btn btn-orange btn-sm btn-icon icon-left'><i class='fa fa-print'></i>Print</a>"
                    )
            },
            "ajax":{
                type:'post',
                url:base_url+'gudangobat/masuk_api/get_data_nota',
                data:function(filter)
                {
                    filter.tgl_transaksi    =   $(".tgl_transaksi").val();
                    filter.supplier         =   $(".supplier").val();
                    filter.penyerah         =   $(".penyerah").val();
                    filter.penerima         =   $(".penerima").val();
                    filter.no_faktur        =   $(".no_faktur").val();
                    filter.no_transaksi     =   $(".no_transaksi").val();
                }
            }
        })

        $(".tabel_nota").closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
            minimumResultsForSearch: -1
        });
    }
    function refresh_data()
    {
        $(".tabel_nota").DataTable().ajax.reload();
    }
    $(".tgl_transaksi").change(function()
    {
        refresh_data();
    })
    $(".supplier").change(function()
    {
        refresh_data();
    })
    $(".penyerah").change(function()
    {
        refresh_data();
    })
    $(".penerima").change(function()
    {
        refresh_data();
    })
    $(".no_faktur").keyup(function()
    {
        refresh_data();
    })
     $(".no_transaksi").keyup(function()
    {
        refresh_data();
    })
    function edit(nota)
    {
        window.location.href=base_url+'gudangobat/masuk/editnota?nota='+nota;
    }

    function cetak(nota)
    {
        loading("show");
        var url=base_url+'gudangobat/masuk_api/cetak?nota='+nota;
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

