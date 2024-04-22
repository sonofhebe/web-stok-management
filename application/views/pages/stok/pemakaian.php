      <!-- Main Content -->
      <div class="main-content">
      	<section class="section">
      		<div class="section-header">
      			<h1>Pemakaian Bahan</h1>
      			<div class="section-header-breadcrumb">
      				<div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
      				<div class="breadcrumb-item"><a href="<?= base_url('pemakaian') ?>">Pemakaian Bahan</a></div>
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
      							<form id="tglForm" action="<?= base_url('pemakaian') ?>" method="post" enctype="multipart/form-data">
      								<label for="tgl">Tanggal</label>
      								<input type="date" value="<?= $tgl ?>" name="tanggal" id="tgl" class="form-control" max="<?= date('Y-m-d'); ?>">
      								<!-- <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button> -->
      							</form>
      						</div>
      						<button class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#tambahkeluar"><i class="fas fa-plus-circel"></i>Tambah Pemakaian Bahan</button>
      					</div>
      					<div class="flashdata" id="flashdata" onload="clearmy()">
      						<?= $this->session->flashdata('message'); ?>
      					</div>
      					<div class="table-responsive">
      						<table id="table" class="table table-bordered text-center" style="width:100%">
      							<thead>
      								<tr>
      									<th>No</th>
      									<th>Nama Produk(variant)</th>
      									<th>Nama Bahan</th>
      									<th>Takaran Perproduksi</th>
      									<th>Jumlah Produksi</th>
      									<th>Total Digunakan</th>
      									<th>Tanggal</th>
      									<th>Aksi</th>
      								</tr>
      							</thead>
      							<tbody>

      								<?php $n = 1;
										foreach ($data_keluar as $keluar) { ?>
      									<tr>
      										<td><?= $n; ?></td>
      										<td><?= $keluar->nama ?></td>
      										<td><?= $keluar->nama_bahan ?></td>
      										<td><?= $keluar->jumlah / $keluar->sc ?> <?= $keluar->nama_satuan ?></td>
      										<td><?= $keluar->sc ?></td>
      										<td><?= ($keluar->jumlah / $keluar->sc) * $keluar->sc ?> <?= $keluar->nama_satuan ?></td>
      										<td><?= $keluar->tanggal ?></td>
      										<td>
      											<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $keluar->id_pemakaian ?>"><i class="fas fa-trash-alt"></i></button>
      										</td>

      										<!-- Modal Hapus -->
      										<div class="modal fade" id="hapus<?= $keluar->id_pemakaian ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      											<div class="modal-dialog">
      												<div class="modal-content">
      													<div class="modal-header bg-danger">
      														<h5 class="modal-title text-white" id="exampleModalLabel">Konfirmasi Hapus</h5>
      													</div>
      													<div class="modal-body">
      														<div class="alert alert-warning text-center" role="alert">

      															<p><b>Apakah anda yakin ingin menghapus data ini ?</b></p>
      															<b class="text-dark"><?= $keluar->nama ?> : <?= $keluar->nama_bahan ?></b>

      														</div>
      													</div>
      													<div class="modal-footer">
      														<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
      														<a href="<?= base_url('hapus-pemakaian/') . $keluar->id_pemakaian ?>" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus Data</a>
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
      	<div class="modal fade" id="tambahkeluar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      		<div class="modal-dialog">
      			<div class="modal-content">
      				<div class="modal-header bg-success">
      					<h5 class="modal-title text-white" id="exampleModalLabel">Tambah Data Ppemakaian</h5>
      					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      						<span aria-hidden="true">&times;</span>
      					</button>
      				</div>
      				<div class="modal-body">
      					<div class="rpw">
      						<div class="col-lg-12">
      							<form action="<?= base_url('tambah-pemakaian') ?>" method="post" enctype="multipart/form-data">
      								<div class="form-group">
      									<label>Pilih Resep Produk</label>
      									<select name="id_produk_resep" class="form-control" required>
      										<option value="" selected disabled>-- PILIH NAMA RESEP --</option>

      										<?php foreach ($produk_resep as $p) { ?>
      											<option value="<?= $p->id_produk_resep ?>"><?= $p->nama_kategoriproduk ?> : <?= $p->nama ?></option>

      										<?php } ?>
      									</select>
      								</div>
      								<div class="form-group">
      									<label for="sc">Jumlah Produksi</label>
      									<input type="number" name="sc" id="jml" class="form-control" required>
      								</div>
      								<div class="form-group">
      									<input type="date" value="<?= $tgl ?>" name="inputtanggal" id="tgl" class="form-control" required readonly>
      								</div>
      								<div class="form-group">
      									<button class="btn btn-success btn-sm" type="submit">Input data</button>
      								</div>
      							</form>
      						</div>
      					</div>
      				</div>
      			</div>
      		</div>
      	</div>

      </div>
      <script>
      	$('#tgl').on('change', function() {
      		$('#tglForm').submit();
      	});
      </script>