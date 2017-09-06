
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="index.html">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Manage user</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">co rajal</a>
		</li>
	</ul>
	<div class="page-toolbar">
		
	</div>
</div>


<h3 class="page-title">
	User <small>kelola &amp; kontrol pengguna aplikasi</small>
</h3>

<div class="row">
	<div class="col-sm-12">
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-info font-grey-gallery"></i>
					<span class="caption-subject bold font-grey-gallery uppercase">DATABASE</span>
					<span class="caption-helper">pengguna aplikasi central opname rawat jalan.</span>
				</div>

				<div class="actions">
					<a href="javascript:;" class="btn btn-circle btn-default" title="tambah pengguna modul central opname rawat jalan.">
					<i class="fa fa-plus"></i> Add pengguna </a>
					<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
					</a>
				</div>



			</div>
			<div class="portlet-body">
				<table class="table table-striped table-hover" id="data_co_rajal">
					<thead>
						<tr>
							<th>Id</th>
							<th>Nama pengguna</th>
							<th>Username</th>
							<th>Password</th>
							<th>Status Akun</th>
							<th>Login terakhir</th>
							<th>Update akun</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#data_co_rajal").dataTable({
			'ordering':false,
			'language':{
				'search':'Nama pengguna : '
			},
			'serverSide':true,
			'processing':true,
			'ajax':{
				type:'post',
				url:base_url+'admin/manageuser_api/get_data_user_co_rajal',
			},
			rowCallback:function(row, data, index)
			{
				$("td:eq(0)",row).html("<a href='"+base_url+"admin/manageuser/detail/"+data[0]+"/corajal'>"+data[1]+"</a>")
			},
			'columnDefs':[
				{
					'targets':[0],
					'visible':false
				}
			]
		})
		$("#data_co_rajal").find('.dataTables_length select').select2();
	})
</script>