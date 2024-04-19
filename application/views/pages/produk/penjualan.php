      <!-- Main Content -->
      <div class="main-content">
      	<section class="section">
      		<div class="section-header">
      			<h1>Penjualan Produk</h1>
      			<div class="section-header-breadcrumb">
      				<div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
      				<div class="breadcrumb-item"><a href="<?= base_url('penjualan') ?>">Drop Stok</a></div>
      				<div class="breadcrumb-item">Data</div>
      			</div>
      		</div>
      	</section>

      	<div class="row">
      		<div class="col-lg-12">
      			<div class="card">
      				<div class="card-body">
      					<div class="col-lg-3">
      						<div class="form-group">
      							<form action="<?= base_url('penjualan') ?>" method="post" enctype="multipart/form-data">
      								<label for="tgl">Tanggal</label>
      								<input type="date" value="<?= $tgl ?>" name="tanggal" id="tgl" class="form-control" max="<?= date('Y-m-d'); ?>">
      								<button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
      							</form>
      						</div>
      						<button class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#tambahpenjualan"><i class="fas fa-plus-circel"></i>Tambah penjualan Harian</button>
      					</div>
      					<div class="flashdata" id="flashdata" onload="clearmy()">
      						<?= $this->session->flashdata('message'); ?>
      					</div>
      					<div class="table-responsive">
      						<table id="table" class="table table-bordered text-center" style="width:100%">
      							<thead>
      								<tr>
      									<th>No</th>
      									<th>Kategori Produk</th>
      									<th>Nama Produk (Variant)</th>
      									<th>Packaging</th>
      									<th>Jumlah</th>
      									<th>Aksi</th>
      								</tr>
      							</thead>
      							<tbody>

      								<?php $n = 1;
										foreach ($penjualan as $jual) { ?>
      									<tr>
      										<td><?= $n; ?></td>
      										<td><?= $jual->nama_kategoriproduk ?></td>
      										<td><?= $jual->nama ?></td>
      										<td>
      											<div class="btn-group">
      												<a href="<?= base_url('data-produk/variant/packaging/' . $jual->id_produk_variant) ?>" class="btn btn-warning btn-sm">Lihat Packaging</a>
      											</div>
      										</td>
      										<td><?= $jual->jumlah ?></td>
      										<td>
      											<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $jual->id_penjualan ?>"><i class="fas fa-edit"></i></button>
      											<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $jual->id_penjualan ?>"><i class="fas fa-trash-alt"></i></button>
      										</td>

      										<!-- Modal Hapus -->
      										<div class="modal fade" id="hapus<?= $jual->id_penjualan ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      											<div class="modal-dialog">
      												<div class="modal-content">
      													<div class="modal-header bg-danger">
      														<h5 class="modal-title text-white" id="exampleModalLabel">Konfirmasi Hapus</h5>
      													</div>
      													<div class="modal-body">
      														<div class="alert alert-warning text-center" role="alert">

      															<p><b>Apakah anda yakin ingin menghapus data ini ?</b></p>
      															<b class="text-dark"><?= $jual->nama_produk ?></b>

      														</div>
      													</div>
      													<div class="modal-footer">
      														<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
      														<a href="<?= base_url('hapus-penjualan/') . $jual->id_penjualan ?>" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus Data</a>
      													</div>
      												</div>
      											</div>
      										</div>

      										<!-- Modal Edit -->
      										<div class="modal fade" id="edit<?= $jual->id_penjualan ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      											<div class="modal-dialog modal-lg">
      												<div class="modal-content">
      													<div class="modal-header bg-warning">
      														<h5 class="modal-title" id="exampleModalLabel">Edit penjualan</h5>
      														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      															<span aria-hidden="true">&times;</span>
      														</button>
      													</div>
      													<div class="modal-body">
      														<div class="row">
      															<div class="col-lg-12">
      																<form action="<?= base_url('edit-penjualan/') . $jual->id_penjualan ?>" method="post" enctype="multipart/form-data">
      																	<label for="">Produk</label>
      																	<input type="text" name="nama_produk" class="form-control" required value="<?= $jual->nama_produk ?>" disabled>
      																	<div class="form-group">
      																		<label for="">Jumlah</label>
      																		<input type="number" name="jumlah" value="<?= $jual->jumlah ?>" class="form-control" required>
      																	</div>
      															</div>
      															<div class="modal-footer">
      																<button class="btn btn-success btn-sm" type="submit">Simpan</button>
      															</div>
      															</form>
      														</div>
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
      	<div class="modal fade" id="tambahpenjualan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      		<div class="modal-dialog">
      			<div class="modal-content">
      				<div class="modal-header bg-success">
      					<h5 class="modal-title text-white" id="exampleModalLabel">Tambah Data penjualan</h5>
      					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      						<span aria-hidden="true">&times;</span>
      					</button>
      				</div>
      				<div class="modal-body">
      					<div class="rpw">
      						<div class="col-lg-12">
      							<form action="<?= base_url('tambah-penjualan') ?>" method="post" enctype="multipart/form-data">
      								<div class="form-group">
      									<label for="pk">Pilih Produk</label>
      									<select name="id_produk" id="ds" class="form-control" required>
      										<option value="" selected disabled>-- PILIH PRODUK VARIANT --</option>

      										<?php foreach ($produk as $p) { ?>
      											<option value="<?= $p->id_produk_variant ?>"><?= $p->nama_kategoriproduk ?> : <?= $p->nama ?></option>

      										<?php } ?>
      									</select>
      								</div>
      								<div class="form-group">
      									<label for="jml">Jumlah Terjual</label>
      									<input type="number" name="jumlah" id="jml" class="form-control" required>
      								</div>
      								<div class="form-group">
      									<input type="date" value="<?= $tgl ?>" name="tanggal" id="tgl" class="form-control" required readonly>
      								</div>
      								<div class="form-group">
      									<button class="btn btn-success btn-sm" type="submit">Simpan</button>
      								</div>
      							</form>
      						</div>
      					</div>
      				</div>
      			</div>
      		</div>
      	</div>

      </div>