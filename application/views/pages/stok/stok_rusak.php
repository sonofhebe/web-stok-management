      <!-- Main Content -->
      <div class="main-content">
      	<section class="section">
      		<div class="section-header">
      			<h1>Stok Rusak</h1>
      			<div class="section-header-breadcrumb">
      				<div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
      				<div class="breadcrumb-item">Stok Rusak</div>
      			</div>
      		</div>
      	</section>

      	<div class="row">
      		<div class="col-lg-12">
      			<div class="card">
      				<div class="card-body">
      					<div class="col-lg-3">
      						<div class="form-group">
      							<form id="tglForm" action="<?= base_url('stok-rusak') ?>" method="post" enctype="multipart/form-data">
      								<label for="tgl">Tanggal</label>
      								<input type="date" value="<?= $tgl ?>" name="tanggal" id="tgl" class="form-control" max="<?= date('Y-m-d'); ?>">
      							</form>
      						</div>
      						<button class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#tambahkeluar"><i class="fas fa-plus-circel"></i>Buat Laporan</button>
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
      								<th>Sebab</th>
      								<th>Catatan</th>
      								<th>Status</th>
      								<th>Tanggal</th>
      								<th>Aksi</th>
      							</tr>
      						</thead>
      						<tbody>

      							<?php $n = 1;
									foreach ($data as $r) {
										$status = '';
										$aksi = '';
										if ($r->status == 1) {
											$status = '<span class="badge badge-warning">Tunggu</span>';
											if ($this->session->userdata('role_id') == 1) {
												$aksi = '<button class="btn btn-info btn-sm mb-2 mr-2" data-toggle="modal" data-target="#konfirmasi' . $r->id_stok_rusak . '">Update</button>';
											} else {
												$aksi = '<button class="btn btn-danger btn-sm mb-2 mr-2" data-toggle="modal" data-target="#batal' . $r->id_stok_rusak . '">Batal</button>';
											}
										} else if ($r->status == 2) {
											$status = '<span class="badge badge-success">Terkonfirmasi</span>';
											if ($this->session->userdata('role_id') == 1) {
												$aksi = '<button class="btn btn-danger btn-sm mb-2 mr-2" data-toggle="modal" data-target="#hapus' . $r->id_stok_rusak . '">Hapus</button>';
											}
										} else if ($r->status == 3) {
											$status = '<span class="badge badge-danger">Ditolak</span>';
											if ($this->session->userdata('role_id') == 1) {
												$aksi = '<button class="btn btn-danger btn-sm mb-2 mr-2" data-toggle="modal" data-target="#hapus' . $r->id_stok_rusak . '">Hapus</button>';
											}
										}

										$sebab = '';
										if ($r->sebab == 1) {
											$sebab = 'Rusak';
										} else if ($r->sebab == 2) {
											$sebab = 'Kadaluarsa';
										} else if ($r->sebab == 3) {
											$sebab = 'Sebab lain';
										}
									?>
      								<tr>
      									<td><?= $n; ?></td>
      									<td><?= $r->nama_dapur ?></td>
      									<td><?= $r->nama_bahan ?></td>
      									<td><?= $r->jumlah ?> <?= $r->nama_satuan ?></td>
      									<td><?= $sebab ?></td>
      									<td><?= $r->catatan ?></td>
      									<td><?= $status ?></td>
      									<td><?= $r->tanggal ?></td>
      									<td><?= $aksi ?></td>

      									<!-- Modal Hapus -->
      									<div class="modal fade" id="hapus<?= $r->id_stok_rusak ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      										<div class="modal-dialog">
      											<div class="modal-content">
      												<div class="modal-header bg-danger">
      													<h5 class="modal-title text-white" id="exampleModalLabel">Hapus Laporan</h5>
      												</div>
      												<div class="modal-body">
      													<div class="alert alert-warning text-center" role="alert">

      														<p><b>Apakah anda yakin menghapus laporan rusak ini ?</b></p>
      														<b class="text-dark"><?= $r->nama_bahan ?> <?= $r->jumlah ?> <?= $r->nama_satuan ?></b>

      													</div>
      												</div>
      												<div class="modal-footer">
      													<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
      													<a href="<?= base_url('hapus-stok-rusak/') . $r->id_stok_rusak ?>" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus Data</a>
      												</div>
      											</div>
      										</div>
      									</div>

      									<!-- Modal Batal -->
      									<div class="modal fade" id="batal<?= $r->id_stok_rusak ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      										<div class="modal-dialog">
      											<div class="modal-content">
      												<div class="modal-header bg-danger">
      													<h5 class="modal-title text-white" id="exampleModalLabel">Batalkan Laporan</h5>
      												</div>
      												<div class="modal-body">
      													<div class="alert alert-warning text-center" role="alert">

      														<p><b>Apakah anda yakin membatalkan laporan rusak ini ?</b></p>
      														<b class="text-dark"><?= $r->nama_bahan ?> <?= $r->jumlah ?> <?= $r->nama_satuan ?></b>

      													</div>
      												</div>
      												<div class="modal-footer">
      													<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
      													<a href="<?= base_url('batal-stok-rusak/') . $r->id_stok_rusak ?>" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus Data</a>
      												</div>
      											</div>
      										</div>
      									</div>

      									<!-- Modal konfirmasi -->
      									<div class="modal fade" id="konfirmasi<?= $r->id_stok_rusak ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      										<div class="modal-dialog">
      											<div class="modal-content">
      												<div class="modal-header bg-success">
      													<h5 class="modal-title text-white" id="exampleModalLabel">Konfirmasi Laporan</h5>
      												</div>
      												<div class="modal-body">
      													<div class="text-center">

      														<p><b>Update status laporan stok rusak</b></p>
      														<b class="text-dark"><?= $r->nama_bahan ?> <?= $r->jumlah ?> <?= $r->nama_satuan ?></b>

      													</div>
      												</div>
      												<div class="modal-footer">
      													<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
      													<a href="<?= base_url('tolak-stok-rusak/') . $r->id_stok_rusak ?>" type="button" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Tolak</a>
      													<a href="<?= base_url('konfirmasi-stok-rusak/') . $r->id_stok_rusak ?>" type="button" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Konfirmasi</a>
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



      	<?php
			$notif = $this->db->where('status', 1);
			if ($this->session->userdata('role_id') != 1) {
				$notif = $notif->where('id_dapur', $this->session->userdata('id_dapur'));
			}
			$notif = $notif->get('stok_rusak')->num_rows();
			?>

      	<?php if ($notif > 0) { ?>
      		<div class="row">
      			<div class="col-lg-12">
      				<div class="card">
      					<div class="card-body text-white bg-success">
      						<h6><b>Laporan yang belum di proses</b></h6>
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

      <!-- Modal Tambah -->
      <div class="modal fade" id="tambahkeluar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      	<div class="modal-dialog">
      		<div class="modal-content">
      			<div class="modal-header bg-success">
      				<h5 class="modal-title text-white" id="exampleModalLabel">Lapor Stok Rusak</h5>
      				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      					<span aria-hidden="true">&times;</span>
      				</button>
      			</div>
      			<div class="modal-body">
      				<div class="rpw">
      					<div class="col-lg-12">
      						<form action="<?= base_url('tambah-stok-rusak') ?>" method="post" enctype="multipart/form-data">
      							<div class="form-group">
      								<label>Pilih Bahan<span class="text-danger">*</span></label>
      								<select name="id_bahan" class="form-control" required>
      									<option value="" selected disabled>-- PILIH BAHAN --</option>

      									<?php
											foreach ($bahan as $p) { ?>
      										<option value="<?= $p->id_bahan ?>"><?= $p->nama_kategori ?> : <?= $p->nama_bahan ?> (<?= $p->nama_satuan ?>)</option>

      									<?php } ?>
      								</select>
      							</div>
      							<div class="form-group">
      								<label for="sc">Jumlah<span class="text-danger">*</span></label>
      								<input type="number" name="jumlah" id="jml" class="form-control" required>
      							</div>
      							<div class="form-group">
      								<label>Pilih Sebab<span class="text-danger">*</span></label>
      								<select name="sebab" class="form-control" required>
      									<option value="" selected disabled>-- PILIH SEBAB --</option>
      									<option value="1">Rusak</option>
      									<option value="2">Kadaluarsa</option>
      									<option value="3">Sebab lain</option>
      								</select>
      							</div>
      							<div class="form-group">
      								<label for="sc">Catatan</label>
      								<textarea name="catatan" id="catatan" cols="30" rows="10" class="form-control"></textarea>
      							</div>
      							<div class="form-group">
      								<label>Tanggal<span class="text-danger">*</span></label>
      								<input type="date" value="<?= $tgl ?>" name="tanggal" id="tgl" class="form-control" readonly>
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

      <script>
      	$('#tgl').on('change', function() {
      		$('#tglForm').submit();
      	});
      </script>