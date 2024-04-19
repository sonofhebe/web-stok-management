<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Laporan Penjualan</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
				<div class="breadcrumb-item"><a href="<?= base_url('laporan-penjualan') ?>">Laporan Penjualan</a></div>
				<div class="breadcrumb-item">Penjualan Perbulan</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">Penjualan Perbulan</h2>
		</div>
	</section>

	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<di class="card-header">
					<h6>Data dari <?= $nama_dapur ?>
						<br>Pada periode <?= $bulan ?>
						<br>Produk terlaris : <?= $terlaris ?>
					</h6>
				</di>
				<div class="card-body">
					<form action="<?= base_url('print-penjualan-bulanan') ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id_dapur" value="<?= $id_dapur ?>">
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
									<th rowspan="2">NAMA PRODUK</th>
									<th colspan="31">PRODUK TERJUAL</th>
									<th rowspan="2" colspan="2">TOTAL TERJUAL</th>
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
									foreach ($produk as $ds) {
										$harga = $this->db->where('id_produk_variant', $ds->id_produk_variant)->get('produk_variant')->result()[0]->harga;
									?>
										<td><?= $n; ?></td>
										<td><?= $ds->nama ?></td>
										<!-- PENJUALAN PRODUK -->

										<?php
										for ($x = 1; $x <= 31; $x++) {
											$this->db->select_sum('jumlah');
											if ($id_dapur == 0) {
												$this->db->where('id_produk', $ds->id_produk_variant);
											} else {
												$this->db->where('id_produk', $ds->id_produk_variant);
												$this->db->where('id_dapur ="' . $id_dapur . '"');
											}
											if ($x <= 9) {
												$this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "' . $bulan . '-0' . $x . '"');
											} else {
												$this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "' . $bulan . '-' . $x . '"');
											}
											$hasil = $this->db->get('penjualan')->result();
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
										if ($id_dapur == 0) {
											$this->db->where('id_produk', $ds->id_produk_variant);
										} else {
											$this->db->where('id_produk', $ds->id_produk_variant);
											$this->db->where('id_dapur ="' . $id_dapur . '"');
										}
										$this->db->where("DATE_FORMAT(tanggal,'%Y-%m') = '" . $bulan . "'");
										$tot = $this->db->get('penjualan')->result();
										?>
										<?php
										foreach ($tot as $t) {
											if (!$t->jumlah) {
												echo "<td>-</td>";
												echo "<td>-</td>";
											} else {
												echo "<td>" . $t->jumlah . "</td>";
												echo "<td>Rp." . number_format($t->jumlah * $harga, 0, ".", ".") . "</td>";
											}
										} ?>
								</tr>

							<?php $n++;
									} ?>
							<td align='center' colspan="2" style="background-color:#FFFF99 ;">TOTAL</td>
							<!-- <td align='center' colspan="31" style="background-color:#FFFFE0 ;"></td> -->

							<?php $n = 1;
							for ($x = 1; $x <= 31; $x++) {
								$this->db->select_sum('jumlah');
								if ($id_dapur != 0) {
									$this->db->where('id_dapur ="' . $id_dapur . '"');
								}
								if ($x <= 9) {
									$this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "' . $bulan . '-0' . $x . '"');
								} else {
									$this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "' . $bulan . '-' . $x . '"');
								}
								$hasil = $this->db->get('penjualan')->result();

								foreach ($hasil as $j) {
									if (!$j->jumlah) {
							?><td>
											<?php echo "-"; ?></td>
									<?php
									} else {
									?><td>
											<?php echo $j->jumlah; ?>
										</td>
							<?php
									}
								}
							}

							// TOTAL UJUNG 
							$this->db->select_sum('jumlah');
							if ($id_dapur != 0) {
								$this->db->where('id_dapur ="' . $id_dapur . '"');
							}
							$this->db->where("DATE_FORMAT(tanggal,'%Y-%m') = '" . $bulan . "'");
							$tot = $this->db->get('penjualan')->result();
							?>
							<?php
							$totalAkhir = $this->db
								->select('SUM(penjualan.jumlah) as totaljumlah, SUM(penjualan.jumlah * produk_variant.harga) as totalharga')
								->from('penjualan')
								->join('produk_variant', 'penjualan.id_produk = produk_variant.id_produk_variant')
								->where("DATE_FORMAT(tanggal,'%Y-%m') = '" . $bulan . "'");
							if ($id_dapur != 0) {
								$totalAkhir = $totalAkhir->where('penjualan.id_dapur', $id_dapur);
							}
							$totalAkhir = $totalAkhir->get()->row();
							if (!$totalAkhir || !$totalAkhir->totaljumlah) {
								echo "<td align='center' style='background-color:#FFFF99 ;'>-</td>";
								echo "<td align='center' style='background-color:#FFFF99 ;'>-</td>";
							} else {
								echo "<td align='center' style='background-color:#FFFF99 ;'>" . $totalAkhir->totaljumlah . "</td>";
								echo "<td align='center' style='background-color:#FFFF99 ;'>Rp." . number_format($totalAkhir->totalharga, 0, ".", ".") . "</td>";
							}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>


</div>