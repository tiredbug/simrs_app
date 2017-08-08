<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-water"></i> Data Master Obat
        </div>
        <div class="panel-options">
            <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg" title="Klik disini untuk input data master obat lebih banyak lagi."><i class="entypo-plus"></i></a>
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
    </div>
    <div class="panel-body no-padding">
        <table class="table table-bordered tabel_obat">
            <thead>
                <tr>
                    <th>KODE</th>
                    <th>NAMA OBAT</th>
                    <th>MERK / TYPE</th>
                    <th>SATUAN</th>
                    <th width="120" class="text-center">PILIHAN</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Sample Modal (Skin inverted) -->
    <div class="modal invert fade" id="sample-modal-dialog-1">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Form input data master obat</h4>
                </div>
                
                <div class="modal-body">
                    <form class="form-modal form-horizontal ">
                        <input type="hidden" name="method" id="method">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Kode Obat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control kode" name="kode_obat" autofocus="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Nama Obat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control nama" name="nama_obat">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2">Merk / Type</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control merk" name="merk">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Satuan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control satuan" name="satuan">
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="bs-callout bs-callout-info">
                                <h4>Perhatikan : </h4>
                                Satuan obat adalah satuan pendistribusian kepada klien atau pasien, satuan ini merubah satuan yang diadopsi oleh modul departement lain.
                                Contoh : apabila pendistribusian kepada pasien menggunakan satuan kapsul maka gunakan satuan tersebut.
                                <span class="bold text-info">Kebiasan digunakan satuan terkecil.</span>
                            </div>
                        </div>
                    </div>                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info btn-simpan">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            var tabel='';
            data_table();
        })
        function data_table()
        {
            tabel=$(".tabel_obat").DataTable({
                "ordering":false,
                "serverSide":true,
                "processing":true,
                "ajax":base_url+'gudangobat/master_api/get_dataobat',
                "language": {
                    "search"     :"Pencarian",
                    "info"       : "Menampilkan _START_ s/d _END_ baris data dari _TOTAL_ data",
                    "infoEmpty"  : "Tidak Ada Data",
                    "emptyTable" : "Tidak Ada Data",
                    "lengthMenu" : "_MENU_ Data Per Halaman",
                    "sZeroRecords": "Tidak ada data."
                },
                "rowCallback":function(row, data, index)
                {
                    $('td:eq(4)',row).html(
                        "<a href='javascript:edit(\""+data[0]+"\")' class='btn btn-orange btn-sm btn-icon icon-left'><i class='fa fa-pencil'></i>Edit</a>"
                        +'&nbsp'+
                        "<a href='javascript:hapus(\""+data[0]+"\")' class='btn btn-danger btn-sm btn-icon icon-left'><i class='fa fa-trash'></i>Del</a>"
                        );
                }
            });
            $(".tabel_obat").closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
            minimumResultsForSearch: -1
            });
        }

        function edit(kode){
            loading_show(".panel");
            $.ajax({
                type:"POST",
                url:base_url+'gudangobat/master_api/get_row_obat',
                data:'kode='+kode,
                dataType:'json',
                error:function()
                {
                    toastr.error("Gagal terhubung ke server.");
                    loading_hide(".panel")
                },
                success:function(json)
                {
                    if(json.success)
                    {
                        $("#method").val('update');
                        $("#sample-modal-dialog-1").modal('show')
                        $(".kode").val(json.data.kode_obat)
                        $(".nama").val(json.data.nama_obat);
                        $(".merk").val(json.data.merk_type);
                        $(".satuan").val(json.data.satuan_obat);
                    }
                    else
                    {
                        toastr.error(json_pesan_err)
                    }
                    loading_hide(".panel");
                }
            })
        }
        
        function hapus(kode)
        {
            loading_show(".panel");
            var e=confirm("Hapus data master obat ini ?");
            if(e)
            {
                $.ajax({
                    type:"POST",
                    url:base_url+'gudangobat/master_api/delete_obat',
                    data:'kode='+kode,
                    dataType:'json',
                    error:function()
                    {
                        alert('Gagal terhubung ke server.')
                        loading_hide(".panel")
                    },
                    success:function(json)
                    {
                        if(json.success)
                        {
                            tabel.ajax.reload()
                        }
                        else
                        {
                            alert(json.pesan_err)
                        }
                        loading_hide(".panel")
                    }
                })
            }
            else
            {
                loading_hide(".panel")
            }
        }

        $(".kode").keypress(function(e)
        {
            if(e.which==13)
            {
                $(".nama").focus();
            }
        })
        $(".nama").keypress(function(e){
            if(e.which==13)
            {
                $(".merk").focus();
            }
        })
        $(".merk").keypress(function(e)
        {
            if(e.which==13)
            {
                $(".satuan").focus();
            }
        })

        $(".satuan").keypress(function(e)
        {
            if(e.which==13)
            {
                entri_data();
            }
        })

        $(".btn-simpan").click(function(){
            entri_data();
        })
        function entri_data()
        {
            loading_show('.form-modal')
            $(".btn-simpan").html("<i class='fa fa-spinner fa-spin'></i> Menyimpan data...")
            var data=$(".form-modal").serialize();
            $.ajax({
                type:"POST",
                url:base_url+'gudangobat/master_api/obat_proces',
                data:data,
                dataType:'json',
                error:function()
                {
                    alert("Gagal terhubung ke server.");
                    loading_hide(".form-modal");
                    $(".btn-simpan").html("Simpan Data")
                },
                success:function(json)
                {
                    if(json.success)
                    {
                        tabel.ajax.reload();
                        $(".kode").focus();
                        toastr.info('Data berhasil disimpan.');
                        if($("#method").val()=='update')
                        {
                            $("#sample-modal-dialog-1").modal('hide')
                        }
                        $(".form-modal").trigger('reset')
                    }
                    else
                    {
                        toastr.error(json.pesan_err)
                        $(".kode").focus();
                    }
                    loading_hide(".form-modal")
                    $(".btn-simpan").html("Simpan Data")
                }
            })
        }

        function loading_show(elemen)
        {
            var $this = $(elemen);
            blockUI($this)
            $this.addClass('reloading');
        }

        function loading_hide(elemen)
        {
            var $this = $(elemen);
            unblockUI($this)
            $this.removeClass('reloading');
        }
        $('#sample-modal-dialog-1').on('hidden.bs.modal', function () {
            // do something…
            $("#method").val('')
        })
    </script>