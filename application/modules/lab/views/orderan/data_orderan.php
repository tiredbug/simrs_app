<div class="col-sm-12 dataorder" style="padding: 0px;border-radius: 4px 4px 0px 0px;background-color: #FFF">   
	<table class="table table-bordered datatable table-hover" id="tabel-orderan">
	    <thead>
			<tr >
	            <th>No. Orderan</th>
	            <th>No. Medrec</th>
	            <th>Nama Lengkap</th>
	            <th>Tgl Order</th>
	            <th>Unit Pengirim</th>
	            <th>Dokter Pengirim</th>
	            <th class="text-center" width="152">Action</th>
	        </tr>
	    </thead>

	</table>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		$("#tabel-orderan").DataTable({
			'serverSide':true,
			'processing':true,
			'ordering':false,
			'ajax':base_url+'lab/orderan_api/get_data_orderan'
		})

		$("#tabel-orderan").closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
            minimumResultsForSearch: -1
		});
	})

	function hapus(id)
	{
		var e=confirm('Hapus data orderan pemeriksaan ?');
		if(e)
		{
			loading_show();
			$.ajax({
				type:"POST",
				url:base_url+'lab/orderan_api/delete_orderan',
				data:'id='+id,
				dataType:'json',
				error:function ()
				{
					alert('Gagal terubung ke server.');
					loading_hide();
				},
				success:function(json)
				{
					if(json.success)
					{
						var table = $('#tabel-orderan').dataTable();
						table.fnReloadAjax();
					}
					else
					{
						alert(json.pesan_err)
					}
					loading_hide()
				}
			})
		}
	}
	
	function loading_show()
    {
        var $this = $("#tabel-orderan");
        blockUI($this);
        $this.addClass('reloading');
    }
    
    function loading_hide()
    {
        var $this = $("#tabel-orderan");
        unblockUI($this)
        $this.removeClass('reloading');
    }
</script>