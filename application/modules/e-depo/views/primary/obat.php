<div class="row">
	<div class="col-sm-12">
		<div class="bs-callout bs-callout-warning nomargin-top ">
			<span class="bold"><i>Keterangan :</i></span>
			<p>
				Barang dalam keadaan status aktifnya <span class="bold text-info">Tidak</span> tidak dapat digunakan pada transaksi apapun, agar bisa menggunakannya pada sebuah transaksi geser status menjadi <span class="bold text-info">Ya</span>
			</p>
		</div>
	</div>

	<div class="col-sm-12">
		<div class="panel panel-primary konten">
			<!-- <div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-water"></i> Data Primary Barang
				</div>
			</div> -->

			<div class="panel-body">
				<table class="table table-bordered tabel_obat table-hover" width="100%">
					<thead>
						<tr>
							<th>Kode Obat</th>
							<th>Kode - Obat</th>
							<th>Satuan</th>
							<th>Status Aktif</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function()
	{
		data_tabel();
	})
	function data_tabel()
	{
		$(".tabel_obat").DataTable({
			"ordering" : false,
			"serverSide":true,
			'processing':true,
			'ajax':
			{
				url:base_url+'e-depo/primary_api/get_data_obat',
				type:'post'
			},
			"columns":[
				{
					"visible" :false
				},
				null,
				null,
				{
					render:function(data, type, full, meta)
					{
						var ch=data=='0'?'checked':''
						return "<div class='make-switch switch-small'><input type='checkbox' "+ch+" value="+full[0]+" onChange='stt(this)'></div>";
					}
				}
			],
			"fnDrawCallback":function()
			{
				$("[type='make-switch']").bootstrapSwitch();
			}

		})
		$(".tabel_obat").closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
            minimumResultsForSearch: -1
        });
	}

	function stt(e)
	{
		e.checked?checklist(e.value):uncheck(e.value)
	}

	function checklist(kode)
	{
		loading('show');
		$.ajax({
			type:"POST",
			url:
		})
	}

	function uncheck(kode)
	{
		loading('hide');
	}
	function loading(ket)
	{
		var $this=$('.panel');
		if(ket=='show')
		{
			blockUI($this);
			$this.addClass('realoading')
		}
		else
		{
			unblockUI($this);
			$this.removeClass("realoading")
		}
	}
</script>



