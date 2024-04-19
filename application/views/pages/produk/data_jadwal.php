<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Jadwal</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
				<div class="breadcrumb-item active"><a href="<?= base_url('jadwal') ?>">Jadwal</a></div>
				<div class="breadcrumb-item"><?= $hari ?></div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">Jadwal Produk Hari "<?= $hari ?>"</h2>
		</div>
	</section>
	<div class="col-md-3">
		<form action="<?= base_url('inputsession-jadwal') ?>" method="post">
			<label for="">Pilih Hari</label>
			<select onchange="this.form.submit();" name="hari" id="" class="form-control">
				<option value="Senin" <?= $hari == 'Senin' ? 'selected' : '' ?>>Senin</option>
				<option value="Selasa" <?= $hari == 'Selasa' ? 'selected' : '' ?>>Selasa</option>
				<option value="Rabu" <?= $hari == 'Rabu' ? 'selected' : '' ?>>Rabu</option>
				<option value="Kamis" <?= $hari == 'Kamis' ? 'selected' : '' ?>>Kamis</option>
				<option value="Jum'at" <?= $hari == "Jum'at" ? 'selected' : '' ?>>Jum'at</option>
				<option value="Sabtu" <?= $hari == 'Sabtu' ? 'selected' : '' ?>>Sabtu</option>
				<option value="Minggu" <?= $hari == 'Minggu' ? 'selected' : '' ?>>Minggu</option>
			</select>
		</form>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">

					<?php if ($this->session->userdata('role_id') == 1) { ?>
						<button class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#tambahjadwal"><i class="fas fa-plus-circel"></i>Tambah Produk</button>

					<?php } ?>
					<div class="flashdata" id="flashdata" onload="clearmy()">
						<?= $this->session->flashdata('message'); ?>
					</div>
					<div class="table-responsive">
						<table id="table" class="table table-bordered text-center" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Produk</th>
									<th>Kategori</th>

									<?php if ($this->session->userdata('role_id') == 1) { ?>
										<th>Aksi</th>

									<?php } ?>
								</tr>
							</thead>
							<tbody>

								<?php $n = 1;
								foreach ($jadwal as $data) { ?>
									<tr>
										<td><?= $n; ?></td>
										<td><?= $data->nama_produk ?></td>
										<td><?= $data->nama_kategoriproduk ?></td>

										<?php if ($this->session->userdata('role_id') == 1) { ?>
											<td>
												<div class="btn-group">
													<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data->id_jadwal ?>"><i class="fas fa-trash-alt"></i></button>
												</div>
											</td>

										<?php } ?>

										<!-- Modal Hapus -->
										<div class="modal fade deleteModal" id="hapus<?= $data->id_jadwal ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header bg-danger text-white">
														<h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
													</div>
													<div class="modal-body">
														<div class="alert alert-warning text-center text-dark">
															<p><b>Apakah anda yakin akan menghapus data ini ?</b></p>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
														<a href="<?= base_url('hapus-jadwal/') . $data->id_jadwal ?>" onclick="deleteModal()" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus Data</a>
													</div>
												</div>
											</div>
										</div>
									</tr>

								<?php $n++;
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Tambah -->
	<div class="modal fade" id="tambahjadwal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header bg-success">
					<h5 class="modal-title text-white" id="exampleModalLabel">Tambah Produk</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('tambah-jadwal') ?>" method="post" enctype="multipart/form-data" id="tambah-jadwal-form">
						<div class="form-group">
							<label for="">Produk</label>
							<select name="id_produk" id="id_produk" class="form-control" required>
								<option value="" selected disabled>-- PILIH PRODUK --</option>

								<?php foreach ($produk as $data_p) { ?>]
								<option value="<?= $data_p->id_produk ?>"><?= $data_p->nama_kategoriproduk ?> : <?= $data_p->nama_produk ?></option>

							<?php } ?>
							</select>
						</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success btn-sm butonsubmit" type="submit" onclick="submitForm()">Simpan</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>