      <!-- Main Content -->
      <div class="main-content">
      	<section class="section">
      		<div class="section-header">
      			<h1>Produk Resep Detail</h1>
      			<div class="section-header-breadcrumb">
      				<div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
      				<div class="breadcrumb-item"><a href="<?= base_url('data-produk') ?>">Data Produk</a></div>
      				<div class="breadcrumb-item"><a href="<?= base_url('data-produk/resep/' . $resep[0]->id_produk) ?>">Resep</a></div>
      				<div class="breadcrumb-item">Detail</div>
      			</div>
      		</div>

      		<div class="section-body">
      			<h2 class="section-title"><?= $resep[0]->nama ?></h2>
      		</div>
      	</section>



      	<div class="row">
      		<div class="col-lg-12">
      			<div class="card">
      				<div class="card-body">

      					<?php if ($this->session->userdata('role_id') == 1) { ?>
      						<button class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#tambahproduk"><i class="fas fa-plus-circel"></i>Tambah Data</button>

      					<?php } ?>
      					<div class="flashdata" id="flashdata" onload="clearmy()">
      						<?= $this->session->flashdata('message'); ?>
      					</div>
      					<div class="table-responsive">
      						<table id="table" class="table table-bordered text-center" style="width:100%">
      							<thead>
      								<tr>
      									<th>No</th>
      									<th>Nama Bahan</th>
      									<th>Jumlah per Produksi</th>

      									<?php if ($this->session->userdata('role_id') == 1) { ?>
      										<th>Aksi</th>

      									<?php } ?>
      								</tr>
      							</thead>
      							<tbody>

      								<?php $n = 1;
										foreach ($resep_detail as $data) { ?>
      									<tr>
      										<td><?= $n; ?></td>

      										<!-- Modal Modal -->
      										<div class="modal fade" id="hapus<?= $data->id_produk_resep_detail ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      											<div class="modal-dialog">
      												<div class="modal-content">
      													<div class="modal-header bg-danger text-white">
      														<h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
      													</div>
      													<div class="modal-body">
      														<div class="alert alert-warning text-center text-dark">
      															<b>JANGAN HAPUS JIKA MASIH MEMBUTUHKAN DATA INI ! KARNA SEMUA DATA YANG BERKAITAN DENGAN <?= $data->nama_bahan ?> AKAN TERHAPUS, SEPERTI (LAPORAN, STOK, DLL)</b>
      															<p><b>Apakah anda yakin akan menghapus data ini ?</b></p>
      														</div>
      													</div>
      													<div class="modal-footer">
      														<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
      														<a href="<?= base_url('data-produk/resep/detail/hapus/' . $resep[0]->id_produk_resep . '/' .  $data->id_produk_resep_detail) ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus Data</a>
      													</div>
      												</div>
      											</div>
      										</div>


      										<!-- Modal Edit -->
      										<div class="modal fade" id="edit<?= $data->id_produk_resep_detail ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      											<div class="modal-dialog modal-md">
      												<div class="modal-content">
      													<div class="modal-header bg-warning">
      														<h5 class="modal-title" id="exampleModalLabel">Edit Data Resep Detail</h5>
      														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      															<span aria-hidden="true">&times;</span>
      														</button>
      													</div>
      													<div class="modal-body">
      														<div class="row">
      															<div class="col-lg-12">
      																<form action="<?= base_url('data-produk/resep/detail/edit/') . $resep[0]->id_produk_resep . '/' . $data->id_produk_resep_detail ?>" method="post" enctype="multipart/form-data">
      																	<div class="row">
      																		<div class="col-md-12">
      																			<div class="form-group">
      																				<div class="form-group">
      																					<label for="">Pilih Bahan</label>
      																					<select name="id_bahan" id="" class="form-control" required>
      																						<option value="" selected disabled>-- PILIH Bahan --</option>

      																						<?php foreach ($bahan as $data_b) { ?>
      																							<option value="<?= $data_b->id_bahan ?>" <?= $data_b->id_bahan == $data->id_bahan ? 'selected' : '' ?>><?= $data_b->nama_bahan ?></option>

      																						<?php } ?>
      																					</select>
      																				</div>
      																				<div class="form-group">
      																					<label for="">Jumlah</label>
      																					<input type="number" name="jumlah" class="form-control" placeholder="Jumlah per produksi" value="<?= $data->jumlah ?>" required>
      																				</div>
      																			</div>
      																			<div class="form-group">
      																				<button class="btn btn-success btn-sm" type="submit">Simpan</button>
      																			</div>
      																		</div>
      																</form>
      															</div>
      														</div>
      													</div>
      												</div>
      											</div>
      										</div>

      										<td><?= $data->nama_bahan ?></td>
      										<td><?= $data->jumlah ?> <?= $data->nama_satuan ?></td>

      										<?php if ($this->session->userdata('role_id') == 1) { ?>
      											<td>
      												<div class="btn-group">
      													<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data->id_produk_resep_detail ?>"><i class="fas fa-trash-alt"></i></button>
      													<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?= $data->id_produk_resep_detail ?>"><i class="fas fa-edit"></i></button>
      												</div>
      											</td>

      										<?php } ?>
      										<!--<td>Rp. < number_format($data->harga, 0, ".", ".") ?></td>-->
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
      	<div class="modal fade" id="tambahproduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      		<div class="modal-dialog modal-md">
      			<div class="modal-content">
      				<div class="modal-header bg-success">
      					<h5 class="modal-title text-white" id="exampleModalLabel">Tambah Data Produk</h5>
      					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      						<span aria-hidden="true">&times;</span>
      					</button>
      				</div>
      				<div class="modal-body">
      					<div class="row">
      						<div class="col-lg-12">
      							<form action="<?= base_url('data-produk/resep/detail/tambah') ?>" method="post" enctype="multipart/form-data">
      								<div class="row">
      									<div class="col-md-12">
      										<input type="hidden" name="id_produk_resep" value="<?= $resep[0]->id_produk_resep ?>">
      										<div class="form-group">
      											<label for="">Pilih Bahan</label>
      											<select name="id_bahan" id="" class="form-control" required>
      												<option value="" selected disabled>-- PILIH Bahan --</option>

      												<?php foreach ($bahan as $data) { ?>
      													<option value="<?= $data->id_bahan ?>"><?= $data->nama_bahan ?></option>

      												<?php } ?>
      											</select>
      										</div>
      										<div class="form-group">
      											<label for="">Jumlah</label>
      											<input type="number" name="jumlah" class="form-control" placeholder="Jumlah per produksi" required>
      										</div>
      										<div class="form-group">
      											<button class="btn btn-success btn-sm" type="submit">Simpan</button>
      										</div>
      									</div>
      							</form>
      						</div>
      					</div>
      				</div>
      			</div>
      		</div>
      	</div>


      </div>