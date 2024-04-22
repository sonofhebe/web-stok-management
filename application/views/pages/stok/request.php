      <!-- Main Content -->
      <div class="main-content">
      	<section class="section">
      		<div class="section-header">
      			<h1>Request Bahan</h1>
      			<div class="section-header-breadcrumb">
      				<div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
      				<div class="breadcrumb-item">Request Bahan</div>
      			</div>
      		</div>
      	</section>

      	<div class="row">
      		<div class="col-lg-12">
      			<div class="card">
      				<div class="card-body">
      					<div class="col-lg-3">
      						<div class="form-group">
      							<form id="tglForm" action="<?= base_url('request') ?>" method="post" enctype="multipart/form-data">
      								<label for="tgl">Tanggal</label>
      								<input type="date" value="<?= $tgl ?>" name="tanggal" id="tgl" class="form-control" max="<?= date('Y-m-d'); ?>">
      								<!-- <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button> -->
      							</form>
      						</div>
      					</div>
      				</div>
      				<div class="flashdata" id="flashdata" onload="clearmy()">
      					<?= $this->session->flashdata('message'); ?>
      				</div>
      				<div class="table-responsive">
      					<table id="table" class="table table-bordered text-center" style="width:100%">
      						<thead>
      							<tr>
      								<th>No</th>
      								<th>Dapur</th>
      								<th>Nama Bahan</th>
      								<th>Jumlah</th>
      								<th>Harga</th>
      								<th>Status</th>
      								<th>Tanggal</th>
      								<th>Aksi</th>
      							</tr>
      						</thead>
      						<tbody>

      							<?php $n = 1;
									foreach ($req as $r) { ?>
      								<tr>
      									<td><?= $n; ?></td>
      									<td><?= $r->nama_dapur ?></td>
      									<td><?= $r->nama_bahan ?></td>
      									<td><?= $r->jumlah ?> <?= $r->nama_satuan ?></td>
      									<td>Rp. <?= number_format($r->total_harga, 0, ".", ".") ?></td>

      									<?php if ($r->status == 'Tunggu') {
											?><td><span class="badge badge-warning">Tunggu</span></td>
      									<?php
											} else {
											?><td><span class="badge badge-success">Terkirim</span></td>
      									<?php
											} ?>
      									<td><?= $r->tanggal ?></td>

      									<?php if ($r->status == 'Tunggu') {
											?><td><button class="btn btn-info btn-sm mb-2" data-toggle="modal" data-target="#input<?= $r->id_req ?>">Kirim Bahan</button></td>
      									<?php
											} else {
											?><td><span class="badge badge-success">Sudah Dikirim</span></td>
      									<?php
											} ?>
      									</td>
      									<!-- Modal Tambah -->
      									<div class="modal fade" id="input<?= $r->id_req ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      										<div class="modal-dialog">
      											<div class="modal-content">
      												<div class="modal-header bg-success">
      													<h5 class="modal-title text-white" id="exampleModalLabel">Kirim Bahan</h5>
      													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      														<span aria-hidden="true">&times;</span>
      													</button>
      												</div>
      												<div class="modal-body">
      													<div class="rpw">
      														<div class="col-lg-12">
      															<form action="<?= base_url('input-request/') . $r->id_req ?>" method="post" enctype="multipart/form-data">
      																<div class="form-group">
      																	<label for="sc">Tujuan</label>
      																	<input type="hidden" name="id_dapur" id="jml" class="form-control" value="<?= $r->id_dapur ?>" required>
      																	<input type="text" name="nama_dapur" id="jml" class="form-control" value="<?= $r->nama_dapur ?>" readonly>
      																	<label for="sc">Bahan</label>
      																	<input type="hidden" name="id_bahan" id="jml" class="form-control" value="<?= $r->id_bahan ?>" required>
      																	<input type="text" name="nama_bahan" id="jml" class="form-control" value="<?= $r->nama_bahan ?>" readonly>
      																	<label for="sc">Jumlah</label>
      																	<input type="number" name="jumlah" id="jml" class="form-control" value="<?= $r->jumlah ?>" readonly>
      																	<label for="sc">Harga</label>
      																	<br>Rp. <input type="number" name="total_harga" id="jml" class="form-control" value="<?= $r->total_harga ?>" readonly>
      																	<label for="sc">Tanggal Drop</label>
      																	<input type="hidden" name="status" id="jml" class="form-control" value="Terkirim" required>
      																	<input type="date" value="<?= date('Y-m-d') ?>" name="tanggal" id="tgl" class="form-control" readonly>
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
      								</tr>

      							<?php $n++;
									} ?>
      						</tbody>
      					</table>
      				</div>
      			</div>
      		</div>
      	</div>



      	<?php $this->db->where('status = "Tunggu"');
			$notif = $this->db->get('req')->num_rows();
			?>

      	<?php if ($notif > 0) { ?>
      		<div class="row">
      			<div class="col-lg-12">
      				<div class="card">
      					<div class="card-body text-white bg-success">
      						<h6><b>Request yang belum dikirim</b></h6>

      						<?php foreach ($tunggu as $t) {
									echo "- " . $t->tanggal . " : " . $t->nama_dapur . "<br>";
								}
								?>
      					</div>
      				</div>
      			</div>
      		</div>

      	<?php } ?>

      </div>
      </div>

      <script>
      	$('#tgl').on('change', function() {
      		$('#tglForm').submit();
      	});
      </script>