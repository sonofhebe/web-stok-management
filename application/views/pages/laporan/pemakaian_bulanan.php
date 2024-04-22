<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Pemakaian Bulanan</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
				<div class="breadcrumb-item"><a href="<?= base_url('laporan-pemakaian') ?>">Laporan Pemakaian</a></div>
				<div class="breadcrumb-item">Data Pemakaian Bulanan</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">Pemakaian Bulanan</h2>
		</div>
	</section>

	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<di class="card-header">
					<h6>Data dari <?= $nama_dapur ?>
						<br>Pada periode <?= $bulan ?>
					</h6>
				</di>
				<div class="card-body">
					<form action="<?= base_url('print-pemakaian-bulanan') ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id_dapur" value="<?= $id_dapur ?>">
						<input type="hidden" name="id_kategori" value="<?= $id_kategori ?>">
						<input type="hidden" name="bulan" value="<?= $bulan ?>">
						<button class="btn btn-success btn-sm" type="submit"><i class="fas fa-download"></i> Download Excel</button>
					</form>
					<div class="flashdata" id="flashdata" onload="clearmy()">
						<?= $this->session->flashdata('message'); ?>
					</div>
					<div class="table-responsive">
						<table id="print" class="table table-striped table-bordered text-center" style="width:100%">
							<thead>
								<tr>
									<th rowspan="2">NO</th>
									<th rowspan="2">NAMA BAHAN</th>
									<th rowspan="2">STOK AWAL</th>
									<th rowspan="2">STOK MASUK</th>
									<th rowspan="2">TOTAL STOK</th>
									<th rowspan="2">STOK RUSAK</th>
									<th colspan="31">PENGGUNAAN BAHAN</th>
									<th rowspan="2">TOTAL PEMAKAIAN</th>
									<th rowspan="2">STOK AKHIR</th>
								</tr>
								<tr>

									<?php
									for ($x = 1; $x <= 31; $x++) {
									?><th>
											<?php echo $x; ?></th>
									<?php
									}
									?>
								</tr>
							</thead>
							<tbody>
								<tr>

									<?php $n = 1;
									foreach ($bahan as $ds) { ?>
										<td><?= $n; ?></td>
										<td><?= $ds->nama_bahan ?></td>

										<!-- get stok masuk -->

										<?php
										$this->db->select_sum('jumlah');
										if ($id_dapur == 0) {
											$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
										} else {
											$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
											$this->db->where('id_dapur ="' . $id_dapur . '"');
										}
										$this->db->where('bahan.id_kategori ="' . $id_kategori . '"');
										$this->db->where('drop_stok.id_bahan', $ds->id_bahan);
										// $this->db->where("DATE_FORMAT(tanggal,'%Y-%m') = '" . $bulan . "' - INTERVAL 1 MONTH");
										$this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $bulan);
										$tot = $this->db->get('drop_stok')->result();
										foreach ($tot as $t) {
											if (!$t->jumlah) {
												$masuk = 0;
											} else {
												$masuk = $t->jumlah;
											}
										} ?>

										<!-- GET STOK AWAL -->

										<?php
										$this->db->select_sum('jumlah');
										$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
										if ($id_dapur != 0) {
											$this->db->where('id_dapur', $id_dapur);
										}
										$this->db->where('drop_stok.id_bahan', $ds->id_bahan);
										$this->db->where('tanggal <', $bulan . '-01');
										$querySumDropStok = $this->db->get('drop_stok');
										$sumDropStok = $querySumDropStok->row()->jumlah;

										// Query untuk mendapatkan sum jumlah dari pemakaian
										$this->db->select_sum('jumlah');
										if ($id_dapur != 0) {
											$this->db->where('id_dapur', $id_dapur);
										}
										$this->db->where('id_bahan', $ds->id_bahan);
										$this->db->where('tanggal <', $bulan . '-01');
										$querySumPemakaian = $this->db->get('pemakaian');
										$sumPemakaian = $querySumPemakaian->row()->jumlah;

										// Menghitung stok awal
										$stokAwal = $sumDropStok - $sumPemakaian; ?>

										<!-- get stok rusak -->
										<?php
										$this->db->select_sum('jumlah');
										if ($id_dapur == 0) {
											$this->db->join('bahan', 'bahan.id_bahan=stok_rusak.id_bahan');
										} else {
											$this->db->join('bahan', 'bahan.id_bahan=stok_rusak.id_bahan');
											$this->db->where('id_dapur ="' . $id_dapur . '"');
										}
										$this->db->where('bahan.id_kategori ="' . $id_kategori . '"');
										$this->db->where('stok_rusak.id_bahan', $ds->id_bahan);
										$this->db->where('stok_rusak.status', 2);
										$this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $bulan);
										$tot = $this->db->get('stok_rusak')->result();
										foreach ($tot as $t) {
											if (!$t->jumlah) {
												$stokRusak = 0;
											} else {
												$stokRusak = $t->jumlah;
											}
										} ?>

										<!-- END GET STOK AWAL -->

										<!-- STOK AWAL -->
										<td><?= $stokAwal ?></td>
										<!-- STOK MASUK -->
										<td><?= $masuk ?></td>
										<!-- TOTAL STOK -->
										<td><?= $stokAwal + $masuk ?></td>
										<!-- STOK rusak -->
										<td><?= $stokRusak ?></td>
										<!-- PEMAKAIAN -->



										<!-- PEMAKAIAN -->

										<?php
										for ($x = 1; $x <= 31; $x++) {
											$this->db->select_sum('jumlah');
											$this->db->from('pemakaian');
											if ($id_dapur == 0) {
												$this->db->join('bahan', 'bahan.id_bahan=pemakaian.id_bahan');
											} else {
												$this->db->join('bahan', 'bahan.id_bahan=pemakaian.id_bahan');
												$this->db->where('id_dapur ="' . $id_dapur . '"');
											}
											$this->db->where('bahan.id_kategori ="' . $id_kategori . '"');
											$this->db->where('pemakaian.id_bahan', $ds->id_bahan);
											if ($x <= 9) {
												$this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "' . $bulan . '-0' . $x . '"');
											} else {
												$this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "' . $bulan . '-' . $x . '"');
											}
											$hasil = $this->db->get()->result();
										?>
											<?php
											foreach ($hasil as $j) {
												if (!$j->jumlah) {
											?><td>
														<?php echo "-"; ?></td>
												<?php
												} else {
												?><td>
														<?php echo $j->jumlah; ?></td>
										<?php
												}
											}
										}
										?>
										<!-- TOTAL -->

										<?php
										$this->db->select_sum('jumlah');
										$this->db->from('pemakaian');
										if ($id_dapur == 0) {
											$this->db->join('bahan', 'bahan.id_bahan=pemakaian.id_bahan');
										} else {
											$this->db->join('bahan', 'bahan.id_bahan=pemakaian.id_bahan');
											$this->db->where('id_dapur ="' . $id_dapur . '"');
										}
										$this->db->where('bahan.id_kategori ="' . $id_kategori . '"');
										$this->db->where('pemakaian.id_bahan', $ds->id_bahan);
										$this->db->where("DATE_FORMAT(tanggal,'%Y-%m') = '" . $bulan . "'");
										$tot = $this->db->get()->result();
										?><td>
											<?php
											foreach ($tot as $t) {
												if (!$t->jumlah) {
													$totalPemakaian = 0;
													echo 0;
												} else {
													$totalPemakaian = $t->jumlah;
													echo $t->jumlah;
												}
											} ?> </td>
										<!-- get total stok akhir -->
										<td><?= ($stokAwal + $masuk) - $stokRusak - $totalPemakaian ?></td>
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


</div>