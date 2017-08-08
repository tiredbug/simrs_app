<ul class='nav nav-tabs'><!-- available classes 'bordered', 'right-aligned' -->
<?php 
$no=1;
foreach ($tab->result() as $t) {
	echo"
	<li class='";
	echo$no==1?'active':'';
	echo"'>
		<a href='#".$t->id."' data-toggle='tab'>
			<span class='visible-xs'><i class='entypo-home'></i></span>
			<span class='hidden-xs'>".$t->produk."</span>
		</a>
	</li>";
	$no++;
}?>
</ul>
<div class='tab-content scroll'>
	<?php
	$no=1;
	foreach ($tab->result() as $t_c) {
		$paket=$this->m_function->get_tab_conten($t_c->id);
		echo"
		<div class='tab-pane  ";
		echo $no==1?'active':'';
		echo"' id='".$t_c->id."'>";
			echo"<ul class='list-produk'>";
				foreach ($paket->result() as $list) {
					echo"<li>";
						echo"
						<div class='text'>
							<div class='row'>
								<div class='col-sm-9 bold'>
									<input type='checkbox' onchange='pilih(this)' value='".$list->kode."' ";
									echo $this->m_function->cek_stt_check($list->kode,$norek)->num_rows() > 0?'checked':'';
									echo">
										".$list->produk."
								</div>
								<div class='col-sm-3 '>
									<div class='bold pull-right'>
										".$list->jum."
									</div>
								</div>
							</div>
						</div>
					</li>";
				}
			echo"<ul>";
		echo"</div>";
		$no++;
	}?>
</div>

<script type="text/javascript">
	function pilih(el) {
		// body...
		var stt='';
		var norek=$(".norek").val()

		if(el.checked)
		{
		    stt='c';
		}else{
		    stt='uc';
		}
		loading_modal('show');
		$.ajax({
			type:"POST",
			url:base_url+'e-lab/kunjungan_api/chart_layanan',
			data:'norek='+norek+'&stt='+stt+'&kode='+el.value,
			dataType:'json',
			error:function()
			{
				loading_modal('hide');
				toastr.error("Gagal terhubung ke server.");
				if(stt='c')
				{
					el.checked=false
				}
				else
				{
					el.checked=true
				}
			},
			success:function(json)
			{
				loading_modal('hide')
				if(json.success)
				{
					
					if(stt=='c')
					{
						$(".item-c ul").append("<li id='"+el.value+"'><div class=text><i class='entypo-tag'></i> "+json.data.produk+"</div></li>")
					}
					else
					{
						$("#"+el.value).remove();
					}
				}
				else
				{
					if(stt='c')
					{
						el.checked=false
					}
					else
					{
						el.checked=true
					}
					toastr.error("Terjadi kesalahan.")
				}
			}
		})
	}

</script>