<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Pengiriman Stok Perbulanan</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
				<div class="breadcrumb-item"><a href="<?= base_url('laporan-drop') ?>">Laporan Drop</a></div>
				<div class="breadcrumb-item">Pengiriman Stok Perbulan</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">Pengiriman Stok Perbulan</h2>
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
					<form action="<?= base_url('print-drop-bulanan') ?>" method="post" enctype="multipart/form-data">
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
									<th rowspan="3">NO</th>
									<th rowspan="3">NAMA BAHAN</th>
									<th rowspan="3">STOK AWAL</th>
									<th colspan="62">PENGIRIMAN BAHAN</th>
									<th rowspan="3">TOTAL DROP STOK</th>
									<th rowspan="3">TOTAL HARGA</th>
								</tr>
								<tr>

									<?php
									for ($x = 1; $x <= 31; $x++) {
									?><th colspan="2">
											<?php echo $x; ?></th>
									<?php
									}
									?>
								</tr>
								<tr>

									<?php
									for ($x = 1; $x <= 31; $x++) {
									?><th>Jumlah</th>
										<th>Harga</th>
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
										<!-- END GET STOK AWAL -->

										<!-- STOK AWAL -->
										<td><?= $stokAwal ?></td>

										<!-- DROP STOK -->

										<?php
										for ($x = 1; $x <= 31; $x++) {
											$this->db->select('SUM(jumlah) as jml, total_harga');
											$this->db->from('drop_stok');
											if ($id_dapur == 0) {
												$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
											} else {
												$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
												$this->db->where('id_dapur ="' . $id_dapur . '"');
											}
											$this->db->where('bahan.id_kategori ="' . $id_kategori . '"');
											$this->db->where('drop_stok.id_bahan', $ds->id_bahan);
											if ($x <= 9) {
												$this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "' . $bulan . '-0' . $x . '"');
											} else {
												$this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "' . $bulan . '-' . $x . '"');
											}
											$hasil = $this->db->get()->result();
										?>
											<?php
											foreach ($hasil as $j) {
												if (!$j->jml) {
											?><td>-</td>
													<td>-</td>
												<?php
												} else {
												?><td><?= $j->jml ?></td>
													<td>Rp. <?= number_format($j->total_harga, 0, ".", ".") ?></td>
										<?php
												}
											}
										}
										?>
										<!-- TOTAL -->

										<?php
										$this->db->select('SUM(jumlah) as jml');
										$this->db->from('drop_stok');
										if ($id_dapur == 0) {
											$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
										} else {
											$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
											$this->db->where('id_dapur ="' . $id_dapur . '"');
										}
										$this->db->where('bahan.id_kategori ="' . $id_kategori . '"');
										$this->db->where('drop_stok.id_bahan', $ds->id_bahan);
										$this->db->where("DATE_FORMAT(tanggal,'%Y-%m') = '" . $bulan . "'");
										$tot = $this->db->get()->result();
										?><td>
											<?php
											foreach ($tot as $t) {
												if (!$t->jml) {
													echo "-";
												} else {
													echo $t->jml;
												}
											} ?> </td>

										<!-- TOTAL HARGA -->

										<?php
										$this->db->select('SUM(total_harga) as jml');
										if ($id_dapur == 0) {
											$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
										} else {
											$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
											$this->db->where('id_dapur ="' . $id_dapur . '"');
										}
										$this->db->where('bahan.id_kategori ="' . $id_kategori . '"');
										$this->db->where('drop_stok.id_bahan', $ds->id_bahan);
										$this->db->where("DATE_FORMAT(tanggal,'%Y-%m') = '" . $bulan . "'");
										$tot = $this->db->get('drop_stok')->result();
										foreach ($tot as $t) {
											if (!$t->jml) {
										?><td>-</td>
											<?php
											} else {
											?><td>Rp. <?= number_format($t->jml, 0, ".", ".") ?></td>
										<?php
											}
										} ?>
								</tr>

							<?php $n++;
									} ?>

							<!-- TOTAL BAWAH -->
							<tfoot>
								<td colspan="3" style="background-color:#FFFF99 ;">Total</td>

								<?php
								for ($x = 1; $x <= 31; $x++) {
									$this->db->select('SUM(total_harga) as tothar');
									$this->db->from('drop_stok');
									if ($id_dapur == 0) {
										$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
									} else {
										$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
										$this->db->where('id_dapur ="' . $id_dapur . '"');
									}
									$this->db->where('bahan.id_kategori ="' . $id_kategori . '"');
									if ($x <= 9) {
										$this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "' . $bulan . '-0' . $x . '"');
									} else {
										$this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "' . $bulan . '-' . $x . '"');
									}
									$hasil = $this->db->get()->result();
								?>
									<?php
									foreach ($hasil as $j) {
										if (!$j->tothar) {
									?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">-</td>
										<?php
										} else {
										?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">Rp. <?= number_format($j->tothar, 0, ".", ".") ?></td>
								<?php
										}
									}
								}
								//TOTAAALLLL
								$this->db->select('SUM(total_harga) as tothar');
								$this->db->from('drop_stok');
								if ($id_dapur == 0) {
									$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
								} else {
									$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
									$this->db->where('id_dapur ="' . $id_dapur . '"');
								}
								$this->db->where('bahan.id_kategori ="' . $id_kategori . '"');
								$this->db->where('DATE_FORMAT(tanggal,"%Y-%m") = "' . $bulan . '"');
								$hasil = $this->db->get()->result();
								?>
								<?php
								foreach ($hasil as $j) {
									if (!$j->tothar) {
								?><td align='center' colspan="2" style="background-color:#FFFF99 ;">-</td>
									<?php
									} else {
									?><td align='center' colspan="2" style="background-color:#FFFF99 ;">Rp. <?= number_format($j->tothar, 0, ".", ".") ?></td>
								<?php
									}
								}

								?>
							</tfoot>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>


</div>