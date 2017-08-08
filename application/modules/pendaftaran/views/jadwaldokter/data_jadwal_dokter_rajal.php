<div class="row">
	<div class="col-sm-12">
		<table class="table  datatable ">
			<thead>
				<tr>
					<th style="width: 10%;font-weight: bold;" class="bg-primary">TANGGAL</th>
					<th style="width: 10%;font-weight: bold;" class='bg-success' style='color:#000'>HARI</th>
					<th class="bg-warning" style="font-weight: bold;">DOKTER</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$this->load->helper('hari');
				for($i=1;$i<=$data['tgl_akhir'];$i++)
				{
					$tgl=$i."-".$data['bulan']."-".date('Y');
					echo"<tr>";
						// coloum tgl
						echo "<td class='";
						if(hari_indo(date("l",strtotime($tgl)))=='Minggu' || hari_indo(date("l",strtotime($tgl)))=='Sabtu')
						{
							echo "bg-danger' style='color:#000'>";
							echo $tgl;
						}
						else
						{
							echo "bg-primary'";
							echo "style='color:#000' >";
							echo $tgl;
						}
						echo "</td>";

						// coloum hari
						echo "<td class='";
						if(hari_indo(date("l",strtotime($tgl)))=='Minggu' || hari_indo(date("l",strtotime($tgl)))=='Sabtu')
						{
							echo "bg-danger' style='color:#000'>";
							echo hari_indo(date("l",strtotime($tgl)));
						}
						else
						{
							echo "bg-success'";
							echo "style='color:#000' >";
							echo hari_indo(date("l",strtotime($tgl)));
						}
						echo "</td>";

						// coloum dokter
						echo "<td class='";
						if(hari_indo(date("l",strtotime($tgl)))=='Minggu' || hari_indo(date("l",strtotime($tgl)))=='Sabtu')
						{
							echo "bg-danger' style='color:#000'>";
							echo "<i></i>";
						}
						else
						{
							echo"'  style='color:#222'>";
							echo"<ul class='list-jadwal-dokter'>";
							foreach($this->m_function->get_dokterpiket($tgl,$data['poli'])->result() as $dr)
							{
								echo"<li id='".$dr->id_jadwaldokter."'><i class='entypo-user'></i>".$dr->nama_belakang.' '.$dr->nama_dokter.','.$dr->gelar;

								if(strtotime($tgl) >= strtotime(date("d-m-Y")))
								{
									echo" <a href='javascript:hapus(".$dr->id_jadwaldokter.")' style='color:red' title='hapus dokter.'><i class='entypo-trash'></i></a>";
								}
								echo"</li>";
							}
							
							if(strtotime($tgl) >= strtotime(date("d-m-Y")))
							{
								echo"<li><a href='javascript:add(\"{$tgl}\",\"{$data['poli']}\")' class='' title='add dokter piket.' style='color:#00A651'><i class='entypo-user-add'></i></a></li>";
							}	
							echo"</ul>";					
						}
						echo "</td>";
					echo"</tr>";
				}
				?>
			</tbody>
		</table>
	</div>
</div>

<!-- form modal -->
<div class="modal fade" id="modal-dokter" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class='entypo-user-add'></i> ADD DOKTER PIKET</h4>
			</div>
				
			<div class="modal-body">
			
				
			</div>
				
			<div class="modal-footer">
				<button type="button" class="btn btn-gue btn-simpan" id="btn-add-dokter-piket">Add</button>
				<button type="button" class="btn btn-danger-gue btn-reset" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>




<script type="text/javascript">
	function loading_body_show()
    {
        var $this = $("#modal-dokter .modal-body");
        blockUI($this);
        $this.addClass('reloading');
    }
    function loading_body_hide()
    {
        var $this = $("#modal-dokter .modal-body");
        unblockUI($this)
        $this.removeClass('reloading');
    }
	function hapus(id)
	{
		var e=confirm("Hapus dokter ?");
		if(e)
		{
			loading_show();
			$.ajax({
				type:"POST",
				url:base_url+'pendaftaran/jadwaldokter_api/hapus_dokter',
				data:'id='+id,
				error:function(xhr, desc, err)
				{
					alert("Gagal menghapus dokter.");
					loading_hide();
				},
				success:function()
				{
					$("#"+id).hide();
					loading_hide();
				}
			})
		}
	}
	function add(tgl, poli)
	{
		jQuery('#modal-dokter').modal('show');
		loading_body_show()
		jQuery.ajax({
				url: base_url+"pendaftaran/jadwaldokter_api/form_add_dokter_piket?tgl="+tgl+"&poli="+poli,
				error:function()
				{
					alert("Gagal memuat halaman form add dokter piket.");
				},
				success: function(response)
				{
					jQuery('#modal-dokter .modal-body').html(response);
				}
			});
		loading_body_hide()
	}
	$("#btn-add-dokter-piket").click(function(){
		loading_body_show();
		var data_dokter=$("#form-add-dokter-piket").serialize();
		jQuery.ajax({
			type:"POST",
			url:base_url+'pendaftaran/jadwaldokter_api/add_dokter_piket',
			data:data_dokter,
			dataType:'json',
			error:function()
			{
				alert('Gagal menyimpan data dokter piket.');
				loading_body_hide();
			},
			success:function(json)
			{
				if(json.success)
				{
					$("#modal-dokter").modal('hide')
				}
				else
				{
					alert(json.pesan_err);
				}
			}
		})
	})

	$('#modal-dokter').on('hidden.bs.modal', function (e) {
		var poli=$("#poli").val();
        var bulan=$("#bulan").val();
		tampil_piket(base_url+'pendaftaran/Jadwaldokter_api/load_piket_rajal?poli='+poli+'&bulan='+bulan);
				
	})
</script>