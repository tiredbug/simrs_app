
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

<div class="row margin-top-20">
	<div class="col-md-12">
		<div class="profile-sidebar">
			<div class="portlet light profile-sidebar-portlet">
				<div class="profile-userpic">
					<img src="<?php echo base_url()?>template/metro/assets/admin/pages/media/profile/user.png" class="img-responsive" alt="">
				</div>
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						<?php echo $i_u['nama']?>
					</div>
					<div class="profile-usertitle-job">
						Operator
					</div>
				</div>

				<div class="profile-userbuttons">
					<button type="button" class="btn btn-circle green-haze btn-sm">Reset</button>
					<button type="button" class="btn btn-circle btn-danger btn-sm">Blokir</button>
				</div>

				<div class="profile-usermenu">
					<ul class="nav ">
						<li class="active">
							<a href="#tab_1_1" data-toggle="tab">
							<i class="icon-user"></i>
							Biodata </a>
						</li>
						<li>
							<a href="#tab_1_2" data-toggle="tab">
								<i class="icon-settings"></i>
							Account Settings </a>
						</li>
						<li>
							<a href="#tab_1_3" data-toggle="tab">
							<i class="icon-rocket"></i>
							Tasks </a>
						</li>
						<li>
							<a href="#tab_1_4" data-toggle="tab">
							<i class="icon-info"></i>
							Help </a>
						</li>
					</ul>
				</div>			
			</div>
		</div>

		<div class="profile-content">
			<div class="row">
				<div class="col-md-12">
					<div class="portlet light">
						<div class="portlet-title tabbable-line">
							<div class="caption caption-md">
								<i class="icon-globe theme-font hide"></i>
								<span class="caption-subject font-blue-madison bold "><i class="icon-info"></i> Informasi</span>
							</div>

							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#tab_1_1" data-toggle="tab">
									Biodata </a>
								</li>
								<li>
									<a href="#tab_1_2" data-toggle="tab">
									Account Setting </a>
								</li>

								<li>
									<a href="#tab_1_3" data-toggle="tab">
									Tasks </a>
								</li>

								<li>
									<a href="#tab_1_4" data-toggle="tab">
									Help </a>
								</li>
							</ul>

						</div>

						<div class="portlet-body">
							<!--BEGIN TABS-->
							<div class="tab-content">
								<div class="tab-pane active" id="tab_1_1">
									<div class="scroller" style="height: 420px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">

										<table class="table table-light" style="font-size: 14px">
											<tbody>
												<tr>
													<td width="140">Nama Lengkap</td>
													<td width="1">:</td>
													<td><?php echo $i_u['nama']?></td>
												</tr>

												<tr>
													<td width="140">Username</td>
													<td width="1">:</td>
													<td><?php echo $i_u['username']?></td>
												</tr>

												<tr>
													<td width="140">Password Text</td>
													<td width="1">:</td>
													<td><?php echo $i_u['password']?></td>
												</tr>

												<tr>
													<td width="140">Password Encrypt</td>
													<td width="1">:</td>
													<td><?php echo $i_u['passwordmd5']?></td>
												</tr>

												<tr>
													<td width="140">Status Akun</td>
													<td width="1">:</td>
													<td><?php echo $i_u['status_akun']=='Aktif'?"<span class='label label-sm label-success'>Masih Aktif</span>":"<span class='label label-sm label-danger'>Tidak Aktif</span>"?></td>
												</tr>

												<tr>
													<td width="140">Last Login</td>
													<td width="1">:</td>
													<td><?php echo date("d-m-Y H:i:s",strtotime($i_u['last_login']))?></td>
												</tr>

												<tr>
													<td width="140">Password Encrypt</td>
													<td width="1">:</td>
													<td><?php echo date("d-m-Y H:i:s",strtotime($i_u['last_updateakun']))?></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>

								<div class="tab-pane" id="tab_1_2">
									<div class="scroller" style="height: 420px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
										<form class="form-horizontal form_akun_setting">
				
											<div class="form-body">
												<div class="form-group">
													<label class="col-md-3 control-label">Nama Lengkap : </label>
													<div class="col-md-7">
														<input type="text" name="nama" class="form-control" value="<?php echo $i_u['nama']?>">
													</div>
												</div>


												<div class="form-group">
													<label class="col-md-3 control-label">Username : </label>
													<div class="col-md-7">
														<input type="text" name="username" class="form-control" value='<?php echo $i_u['username']?>' disabled>
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-3 control-label">Password Lama : </label>
													<div class="col-md-7">
														<input type="text" name="password_lm" class="form-control" disabled="" value='<?php echo $i_u['password']?>'>
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-3 control-label">Password Baru : </label>
													<div class="col-md-7">
														<input type="password" name="password_br" class="form-control">
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-3 control-label">Ulangi Password : </label>
													<div class="col-md-7">
														<input type="password" name="password_br_u" class="form-control">
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-3 control-label">Status Akun : </label>
													<div class="col-md-7">
														<select name="stt" class="form-control">
															<option value=''>-- Pilih --</option>
															<option value='Aktif' <?php echo $i_u['status_akun']=='Aktif'?'selected':''?>>Aktif</option>
															<option value='Tidak Aktif' <?php echo $i_u['status_akun']=='Tidak Aktif'?'selected':''?>>Tidak Aktif</option>
														</select>
													</div>
												</div>


											</div>

											<div class="form-actions">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<button type="button" class="btn green btn_simpan_perubahan"><i class='fa fa-save'></i> Simpan perubahan</button>
													</div>
												</div>
											</div>

										</form>
									</div>
								</div>


								<div class="tab-pane" id="tab_1_3">
									<div class="scroller" style="height: 420px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
										<ul class="feeds">
											<?php
											foreach ($i_l->result() as $l) {
												# code...
											?>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-danger">
																<i class="fa fa-rocket"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<?php echo $l->pesan?>
															</div>
														</div>
													</div>
												</div>

												<div class="col2">
													<div class="date">
														 <?php echo date("d-m-Y H:i:s",strtotime($l->waktu))?>
													</div>
												</div>
											</li>
											<?php
											}
											?>
										</ul>
									</div>
								</div>

								<div class="tab-pane" id="tab_1_4">
									<div class="scroller" style="height: 420px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
										<div class="note note-success">
											<p>
												<i class="fa fa-info"></i> Biodata<br/>
												<i>Menampilkan data-data user</i>
											</p>


											<p>
												<i class="fa fa-info"></i> Account Setting<br/>
												<i>Form setting untuk akun pengguna</i>
											</p>

											<p>
												<i class="fa fa-info"></i> Task<br/>
												<i>Aktifitas yang pernah dilakukan oleh user</i>
											</p>


										</div>	
									</div>
								</div>


								<!-- END PORTLET -->
							</div>
						</div>
						
					</div>
					<!-- END PROFILE CONTENT -->
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		$(".btn_simpan_perubahan").click(function(){
			var $this=$(this);
			$this.html("<i class='fa fa-spin fa-spinner'></i> Menyimpan perubahan...").prop('disabled',true)
			var data=$(".form_akun_setting").serialize();
			$.ajax({
				type:'post',
				url:base_url+'admin/manageuser_api/update_user/corajal',
				data:data,
				dataType:'json',
				error:function()
				{
					alert('Koneksi terputus, periksa jaringan dan coba lagi.');
					$this.html("<i class='fa fa-save'></i> Simpan perubahan").prop("disabled",false);
				},
				success:function(json)
				{

				}
			})
		})
	})
</script>