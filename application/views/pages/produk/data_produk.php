      <!-- Main Content -->
      <div class="main-content">
      	<section class="section">
      		<div class="section-header">
      			<h1>Data Produk</h1>
      			<div class="section-header-breadcrumb">
      				<div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
      				<div class="breadcrumb-item">Data Produk</div>
      			</div>
      		</div>

      		<div class="section-body">
      			<h2 class="section-title">Data Produk</h2>
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
      									<th>Kategori Produk</th>
      									<th>Nama</th>
      									<th>Jadwal</th>
      									<th>Variant</th>
      									<th>Resep</th>

      									<?php if ($this->session->userdata('role_id') == 1) { ?>
      										<th>Aksi</th>

      									<?php } ?>
      								</tr>
      							</thead>
      							<tbody>

      								<?php $n = 1;
										foreach ($produk as $data) { ?>
      									<tr>
      										<td><?= $n; ?></td>

      										<!-- Modal Modal -->
      										<div class="modal fade" id="hapus<?= $data->id_produk ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      											<div class="modal-dialog">
      												<div class="modal-content">
      													<div class="modal-header bg-danger text-white">
      														<h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
      													</div>
      													<div class="modal-body">
      														<div class="alert alert-warning text-center text-dark">
      															<b>JANGAN HAPUS JIKA MASIH MEMBUTUHKAN DATA INI ! KARNA SEMUA DATA YANG BERKAITAN DENGAN <?= $data->nama_produk ?> AKAN TERHAPUS, SEPERTI (LAPORAN, STOK, DLL)</b>
      															<p><b>Apakah anda yakin akan menghapus data ini ?</b></p>
      														</div>
      													</div>
      													<div class="modal-footer">
      														<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
      														<a href="<?= base_url('hapus-produk/') . $data->id_produk ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus Data</a>
      													</div>
      												</div>
      											</div>
      										</div>


      										<!-- Modal Edit -->
      										<div class="modal fade" id="edit<?= $data->id_produk ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      																<form action="<?= base_url('edit-produk/') . $data->id_produk ?>" method="post" enctype="multipart/form-data">
      																	<div class="row">
      																		<div class="col-md-12">
      																			<div class="form-group">
      																				<label for="">Kategori Produk</label>
      																				<select name="id_kategoriproduk" id="" class="form-control" required>
      																					<option value="" selected disabled>-- PILIH KATEGORI PRODUK --</option>

      																					<?php foreach ($kategoriproduk as $data_k) { ?>
      																						<option value="<?= $data_k->id_kategoriproduk ?>" <?= $data_k->id_kategoriproduk == $data->id_kategoriproduk ? 'selected' : '' ?>><?= $data_k->nama_kategoriproduk ?></option>

      																					<?php } ?>
      																				</select>
      																			</div>
      																			<div class="form-group">
      																				<label for="">Nama Produk</label>
      																				<input type="text" name="nama_produk" value="<?= $data->nama_produk ?>" class="form-control" required>
      																			</div>
      																			<!-- <div class="form-group">
      																				<label for="">Harga Produk</label>
      																				<div class="input-group">
      																					<div class="input-group-prepend">
      																						<span class="input-group-text">Rp.</span>
      																					</div>
      																					<input type="number" name="harga" value="<?= $data->harga ?>" class="form-control">
      																				</div>
      																			</div> -->
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

      										<td><?= $data->nama_kategoriproduk ?></td>
      										<td><?= $data->nama_produk ?></td>
      										<td><?= $data->jadwal_hari ?></td>
      										<td>
      											<div class="btn-group">
      												<a href="<?= base_url('data-produk/variant/' . $data->id_produk) ?>" class="btn btn-warning btn-sm">Lihat Variant</a>
      											</div>
      										</td>
      										<td>
      											<div class="btn-group">
      												<a href="<?= base_url('data-produk/resep/' . $data->id_produk) ?>" class="btn btn-warning btn-sm">Lihat Resep</a>
      											</div>
      										</td>

      										<?php if ($this->session->userdata('role_id') == 1) { ?>
      											<td>
      												<div class="btn-group">
      													<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data->id_produk ?>"><i class="fas fa-trash-alt"></i></button>
      													<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?= $data->id_produk ?>"><i class="fas fa-edit"></i></button>
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
      							<form action="<?= base_url('tambah-produk') ?>" method="post" enctype="multipart/form-data">
      								<div class="row">
      									<div class="col-md-12">
      										<div class="form-group">
      											<label for="">Kategori Produk</label>
      											<select name="id_kategoriproduk" id="" class="form-control" required>
      												<option value="" selected disabled>-- PILIH KATEGORI PRODUK --</option>

      												<?php foreach ($kategoriproduk as $data_k) { ?>
      													<option value="<?= $data_k->id_kategoriproduk ?>"><?= $data_k->nama_kategoriproduk ?></option>

      												<?php } ?>
      											</select>
      										</div>
      										<div class="form-group">
      											<label for="">Nama Produk</label>
      											<input type="text" name="nama_produk" class="form-control" required>
      										</div>
      										<!-- <div class="form-group">
      											<label for="">Harga Produk</label>
      											<div class="input-group">
      												<div class="input-group-prepend">
      													<span class="input-group-text">Rp.</span>
      												</div>
      												<input type="number" name="harga" class="form-control" required>
      											</div>
      										</div> -->
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