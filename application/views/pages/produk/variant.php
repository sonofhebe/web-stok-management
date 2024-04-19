      <!-- Main Content -->
      <div class="main-content">
      	<section class="section">
      		<div class="section-header">
      			<h1>Variant Produk</h1>
      			<div class="section-header-breadcrumb">
      				<div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
      				<div class="breadcrumb-item"><a href="<?= base_url('data-produk') ?>">Data Produk</a></div>
      				<div class="breadcrumb-item">Variant</div>
      			</div>
      		</div>

      		<div class="section-body">
      			<h2 class="section-title"><?= $produk[0]->nama_produk ?></h2>
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
      									<th>Nama</th>
      									<th>Harga</th>
      									<th>Packaging</th>

      									<?php if ($this->session->userdata('role_id') == 1) { ?>
      										<th>Aksi</th>

      									<?php } ?>
      								</tr>
      							</thead>
      							<tbody>

      								<?php $n = 1;
										foreach ($variant as $data) { ?>
      									<tr>
      										<td><?= $n; ?></td>

      										<!-- Modal Modal -->
      										<div class="modal fade" id="hapus<?= $data->id_produk_variant ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      											<div class="modal-dialog">
      												<div class="modal-content">
      													<div class="modal-header bg-danger text-white">
      														<h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
      													</div>
      													<div class="modal-body">
      														<div class="alert alert-warning text-center text-dark">
      															<b>JANGAN HAPUS JIKA MASIH MEMBUTUHKAN DATA INI ! KARNA SEMUA DATA YANG BERKAITAN DENGAN <?= $data->nama ?> AKAN TERHAPUS, SEPERTI (LAPORAN, STOK, DLL)</b>
      															<p><b>Apakah anda yakin akan menghapus data ini ?</b></p>
      														</div>
      													</div>
      													<div class="modal-footer">
      														<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
      														<a href="<?= base_url('data-produk/hapus-variant/' . $produk[0]->id_produk . '/' .  $data->id_produk_variant) ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus Data</a>
      													</div>
      												</div>
      											</div>
      										</div>


      										<!-- Modal Edit -->
      										<div class="modal fade" id="edit<?= $data->id_produk_variant ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      											<div class="modal-dialog modal-md">
      												<div class="modal-content">
      													<div class="modal-header bg-warning">
      														<h5 class="modal-title" id="exampleModalLabel">Edit Data Produk</h5>
      														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      															<span aria-hidden="true">&times;</span>
      														</button>
      													</div>
      													<div class="modal-body">
      														<div class="row">
      															<div class="col-lg-12">
      																<form action="<?= base_url('data-produk/edit-variant/') . $produk[0]->id_produk . '/' . $data->id_produk_variant ?>" method="post" enctype="multipart/form-data">
      																	<div class="row">
      																		<div class="col-md-12">
      																			<div class="form-group">
      																				<label for="">Nama Variant</label>
      																				<input type="text" name="nama" class="form-control" value="<?= $data->nama ?>" required>
      																			</div>
      																			<div class="form-group">
      																				<label for="">Harga Produk</label>
      																				<div class="input-group">
      																					<div class="input-group-prepend">
      																						<span class="input-group-text">Rp.</span>
      																					</div>
      																					<input type="number" name="harga" class="form-control" value="<?= $data->harga ?>" required>
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

      										<td><?= $data->nama ?></td>
      										<td>Rp. <?= number_format($data->harga, 0, ".", ".") ?></td>
      										<td>
      											<div class="btn-group">
      												<a href="<?= base_url('data-produk/variant/packaging/' . $data->id_produk_variant) ?>" class="btn btn-warning btn-sm">Lihat Packaging</a>
      											</div>
      										</td>

      										<?php if ($this->session->userdata('role_id') == 1) { ?>
      											<td>
      												<div class="btn-group">
      													<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data->id_produk_variant ?>"><i class="fas fa-trash-alt"></i></button>
      													<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?= $data->id_produk_variant ?>"><i class="fas fa-edit"></i></button>
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
      							<form action="<?= base_url('data-produk/tambah-variant') ?>" method="post" enctype="multipart/form-data">
      								<div class="row">
      									<div class="col-md-12">
      										<input type="hidden" name="id_produk" value="<?= $produk[0]->id_produk ?>">
      										<div class="form-group">
      											<label for="">Nama Variant</label>
      											<input type="text" name="nama" class="form-control" placeholder="<?= $produk[0]->nama_produk ?> 120gram" required>
      										</div>
      										<div class="form-group">
      											<label for="">Harga Produk</label>
      											<div class="input-group">
      												<div class="input-group-prepend">
      													<span class="input-group-text">Rp.</span>
      												</div>
      												<input type="number" name="harga" class="form-control" required>
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


      </div>