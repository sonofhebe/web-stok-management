<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Laporan Penjualan</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
				<div class="breadcrumb-item"><a href="<?= base_url('laporan-penjualan') ?>">Laporan Penjualan</a></div>
				<div class="breadcrumb-item">Penjualan Perminggu</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">Penjualan Perminggu</h2>
		</div>
	</section>

	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<di class="card-header">
					<h6>Data dari <?= $nama_dapur ?>
						<br>Pada tanggal : <?= $awal ?> s/d
						<?php echo date('Y-m-d', strtotime($awal . ' + 6 days')); ?>
						<br>Produk terlaris : <?= $terlaris ?>
					</h6>
				</di>
				<div class="card-body">
					<form action="<?= base_url('print-penjualan-mingguan') ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id_dapur" value="<?= $id_dapur ?>">
						<input type="hidden" name="awal" value="<?= $awal ?>">
						<button class="btn btn-success btn-sm" type="submit"><i class="fas fa-download"></i> Download Excel</button>
					</form>
					<div class="flashdata" id="flashdata" onload="clearmy()">
						<?= $this->session->flashdata('message'); ?>
					</div>
					<div class="table-responsive">
						<table id="print" class="table table-striped table-bordered text-center" style="width:100%">
							<thead>
								<tr>
									<th rowspan="4">NO</th>
									<th rowspan="4">NAMA PRODUK</th>
									<th colspan="14">PRODUK TERJUAL</th>
									<th rowspan="3" colspan="2">TOTAL TERJUAL</th>
								</tr>
								<tr>
									<th colspan="2">JUMAT</th>
									<th colspan="2">SABTU</th>
									<th colspan="2">MINGGU</th>
									<th colspan="2">SENIN</th>
									<th colspan="2">SELASA</th>
									<th colspan="2">RABU</th>
									<th colspan="2">KAMIS</th>
								</tr>
								<tr>
									<th colspan="2"><?= $awal ?></th>
									<th colspan="2">
										<?php echo date('Y-m-d', strtotime($awal . ' + 1 days')); ?></th>
									<th colspan="2">
										<?php echo date('Y-m-d', strtotime($awal . ' + 2 days')); ?></th>
									<th colspan="2">
										<?php echo date('Y-m-d', strtotime($awal . ' + 3 days')); ?></th>
									<th colspan="2">
										<?php echo date('Y-m-d', strtotime($awal . ' + 4 days')); ?></th>
									<th colspan="2">
										<?php echo date('Y-m-d', strtotime($awal . ' + 5 days')); ?></th>
									<th colspan="2">
										<?php echo date('Y-m-d', strtotime($awal . ' + 6 days')); ?></th>
								</tr>
								<tr>

									<?php for ($i = 0; $i < 7; $i++) { ?>
										<th>JUMLAH</th>
										<th>HARGA</th>

									<?php } ?>
									<th>JUMLAH</th>
									<th>HARGA</th>
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
										<!-- PRODUK TERJUAL -->

										<?php
										$this->db->select_sum('jumlah');
										if ($id_dapur == 0) {
											$this->db->where('id_produk', $ds->id_produk_variant);
										} else {
											$this->db->where('id_produk', $ds->id_produk_variant);
											$this->db->where('id_dapur ="' . $id_dapur . '"');
										}
										$this->db->where('tanggal = "' . $awal . '"');
										$d1 = $this->db->get('penjualan')->result();
										?>

										<?php foreach ($d1 as $j) {
											if (!$j->jumlah) {
												echo "<td>-</td>";
												echo "<td>-</td>";
											} else {
												echo "<td>" . $j->jumlah . "</td>";
												echo "<td>Rp." . number_format($j->jumlah * $harga, 0, ".", ".") . "</td>";
											}
										} ?>

										<?php
										$this->db->select_sum('jumlah');
										if ($id_dapur == 0) {
											$this->db->where('id_produk', $ds->id_produk_variant);
										} else {
											$this->db->where('id_produk', $ds->id_produk_variant);
											$this->db->where('id_dapur ="' . $id_dapur . '"');
										}
										$this->db->where('tanggal = "' . $awal . '"+ INTERVAL 1 DAY');
										$d2 = $this->db->get('penjualan')->result();
										?>

										<?php foreach ($d2 as $j) {
											if (!$j->jumlah) {
												echo "<td>-</td>";
												echo "<td>-</td>";
											} else {
												echo "<td>" . $j->jumlah . "</td>";
												echo "<td>Rp." . number_format($j->jumlah * $harga, 0, ".", ".") . "</td>";
											}
										} ?>

										<?php
										$this->db->select_sum('jumlah');
										if ($id_dapur == 0) {
											$this->db->where('id_produk', $ds->id_produk_variant);
										} else {
											$this->db->where('id_produk', $ds->id_produk_variant);
											$this->db->where('id_dapur ="' . $id_dapur . '"');
										}
										$this->db->where('tanggal = "' . $awal . '"+ INTERVAL 2 DAY');
										$d3 = $this->db->get('penjualan')->result();
										?>

										<?php foreach ($d3 as $j) {
											if (!$j->jumlah) {
												echo "<td>-</td>";
												echo "<td>-</td>";
											} else {
												echo "<td>" . $j->jumlah . "</td>";
												echo "<td>Rp." . number_format($j->jumlah * $harga, 0, ".", ".") . "</td>";
											}
										} ?>

										<?php
										$this->db->select_sum('jumlah');
										if ($id_dapur == 0) {
											$this->db->where('id_produk', $ds->id_produk_variant);
										} else {
											$this->db->where('id_produk', $ds->id_produk_variant);
											$this->db->where('id_dapur ="' . $id_dapur . '"');
										}
										$this->db->where('tanggal = "' . $awal . '"+ INTERVAL 3 DAY');
										$d4 = $this->db->get('penjualan')->result();
										?>

										<?php foreach ($d4 as $j) {
											if (!$j->jumlah) {
												echo "<td>-</td>";
												echo "<td>-</td>";
											} else {
												echo "<td>" . $j->jumlah . "</td>";
												echo "<td>Rp." . number_format($j->jumlah * $harga, 0, ".", ".") . "</td>";
											}
										} ?>

										<?php
										$this->db->select_sum('jumlah');
										if ($id_dapur == 0) {
											$this->db->where('id_produk', $ds->id_produk_variant);
										} else {
											$this->db->where('id_produk', $ds->id_produk_variant);
											$this->db->where('id_dapur ="' . $id_dapur . '"');
										}
										$this->db->where('tanggal = "' . $awal . '"+ INTERVAL 4 DAY');
										$d5 = $this->db->get('penjualan')->result();
										?>

										<?php foreach ($d5 as $j) {
											if (!$j->jumlah) {
												echo "<td>-</td>";
												echo "<td>-</td>";
											} else {
												echo "<td>" . $j->jumlah . "</td>";
												echo "<td>Rp." . number_format($j->jumlah * $harga, 0, ".", ".") . "</td>";
											}
										} ?>

										<?php
										$this->db->select_sum('jumlah');
										if ($id_dapur == 0) {
											$this->db->where('id_produk', $ds->id_produk_variant);
										} else {
											$this->db->where('id_produk', $ds->id_produk_variant);
											$this->db->where('id_dapur ="' . $id_dapur . '"');
										}
										$this->db->where('tanggal = "' . $awal . '"+ INTERVAL 5 DAY');
										$d6 = $this->db->get('penjualan')->result();
										?>

										<?php foreach ($d6 as $j) {
											if (!$j->jumlah) {
												echo "<td>-</td>";
												echo "<td>-</td>";
											} else {
												echo "<td>" . $j->jumlah . "</td>";
												echo "<td>Rp." . number_format($j->jumlah * $harga, 0, ".", ".") . "</td>";
											}
										} ?>

										<?php
										$this->db->select_sum('jumlah');
										if ($id_dapur == 0) {
											$this->db->where('id_produk', $ds->id_produk_variant);
										} else {
											$this->db->where('id_produk', $ds->id_produk_variant);
											$this->db->where('id_dapur ="' . $id_dapur . '"');
										}
										$this->db->where('tanggal = "' . $awal . '"+ INTERVAL 6 DAY');
										$d7 = $this->db->get('penjualan')->result();
										?>

										<?php foreach ($d7 as $j) {
											if (!$j->jumlah) {
												echo "<td>-</td>";
												echo "<td>-</td>";
											} else {
												echo "<td>" . $j->jumlah . "</td>";
												echo "<td>Rp." . number_format($j->jumlah * $harga, 0, ".", ".") . "</td>";
											}
										} ?>
										<!-- TOTAL -->

										<?php
										$this->db->select_sum('jumlah');
										if ($id_dapur == 0) {
											$this->db->where('id_produk', $ds->id_produk_variant);
										} else {
											$this->db->where('id_produk', $ds->id_produk_variant);
											$this->db->where('id_dapur ="' . $id_dapur . '"');
										}
										$this->db->where('tanggal BETWEEN "' . $awal . '"AND "' . $awal . '"+ INTERVAL 6 DAY');
										$tot = $this->db->get('penjualan')->result();

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
							<tr>
								<td align='center' colspan="2" style="background-color:#FFFF99 ;">TOTAL</td>

								<?php

								//TOTAL BAWAH
								$totalBawah1 = $this->db
									->select('SUM(jumlah) as totaljumlah, SUM(jumlah * harga) as totalharga')
									->from('penjualan')
									->join('produk_variant', 'penjualan.id_produk = produk_variant.id_produk_variant')
									->where('penjualan.tanggal', $awal);
								if ($id_dapur != 0) {
									$totalBawah1 = $totalBawah1->where('penjualan.id_dapur', $id_dapur);
								}
								$totalBawah1 = $totalBawah1->get()->row();
								if (!$totalBawah1 || !$totalBawah1->totaljumlah) {
									echo "<td align='center' style='background-color:#FFFFE0 ;'>-</td>";
									echo "<td align='center' style='background-color:#FFFFE0 ;'>-</td>";
								} else {
									echo "<td align='center' style='background-color:#FFFFE0 ;'>" . $totalBawah1->totaljumlah . "</td>";
									echo "<td align='center' style='background-color:#FFFFE0 ;'>Rp." . number_format($totalBawah1->totalharga, 0, ".", ".") . "</td>";
								}

								$totalBawah2 = $this->db
									->select('SUM(jumlah) as totaljumlah, SUM(jumlah * harga) as totalharga')
									->from('penjualan')
									->join('produk_variant', 'penjualan.id_produk = produk_variant.id_produk_variant')
									->where('tanggal = "' . $awal . '"+ INTERVAL 1 DAY');
								if ($id_dapur != 0) {
									$totalBawah2 = $totalBawah2->where('penjualan.id_dapur', $id_dapur);
								}
								$totalBawah2 = $totalBawah2->get()->row();
								if (!$totalBawah2 || !$totalBawah2->totaljumlah) {
									echo "<td align='center' style='background-color:#FFFFE0 ;'>-</td>";
									echo "<td align='center' style='background-color:#FFFFE0 ;'>-</td>";
								} else {
									echo "<td align='center' style='background-color:#FFFFE0 ;'>" . $totalBawah2->totaljumlah . "</td>";
									echo "<td align='center' style='background-color:#FFFFE0 ;'>Rp." . number_format($totalBawah2->totalharga, 0, ".", ".") . "</td>";
								}

								$totalBawah3 = $this->db
									->select('SUM(jumlah) as totaljumlah, SUM(jumlah * harga) as totalharga')
									->from('penjualan')
									->join('produk_variant', 'penjualan.id_produk = produk_variant.id_produk_variant')
									->where('tanggal = "' . $awal . '"+ INTERVAL 2 DAY');
								if ($id_dapur != 0) {
									$totalBawah3 = $totalBawah3->where('penjualan.id_dapur', $id_dapur);
								}
								$totalBawah3 = $totalBawah3->get()->row();
								if (!$totalBawah3 || !$totalBawah3->totaljumlah) {
									echo "<td align='center' style='background-color:#FFFFE0 ;'>-</td>";
									echo "<td align='center' style='background-color:#FFFFE0 ;'>-</td>";
								} else {
									echo "<td align='center' style='background-color:#FFFFE0 ;'>" . $totalBawah3->totaljumlah . "</td>";
									echo "<td align='center' style='background-color:#FFFFE0 ;'>Rp." . number_format($totalBawah3->totalharga, 0, ".", ".") . "</td>";
								}

								$totalBawah4 = $this->db
									->select('SUM(jumlah) as totaljumlah, SUM(jumlah * harga) as totalharga')
									->from('penjualan')
									->join('produk_variant', 'penjualan.id_produk = produk_variant.id_produk_variant')
									->where('tanggal = "' . $awal . '"+ INTERVAL 3 DAY');
								if ($id_dapur != 0) {
									$totalBawah4 = $totalBawah4->where('penjualan.id_dapur', $id_dapur);
								}
								$totalBawah4 = $totalBawah4->get()->row();
								if (!$totalBawah4 || !$totalBawah4->totaljumlah) {
									echo "<td align='center' style='background-color:#FFFFE0 ;'>-</td>";
									echo "<td align='center' style='background-color:#FFFFE0 ;'>-</td>";
								} else {
									echo "<td align='center' style='background-color:#FFFFE0 ;'>" . $totalBawah4->totaljumlah . "</td>";
									echo "<td align='center' style='background-color:#FFFFE0 ;'>Rp." . number_format($totalBawah4->totalharga, 0, ".", ".") . "</td>";
								}

								$totalBawah5 = $this->db
									->select('SUM(jumlah) as totaljumlah, SUM(jumlah * harga) as totalharga')
									->from('penjualan')
									->join('produk_variant', 'penjualan.id_produk = produk_variant.id_produk_variant')
									->where('tanggal = "' . $awal . '"+ INTERVAL 4 DAY');
								if ($id_dapur != 0) {
									$totalBawah5 = $totalBawah5->where('penjualan.id_dapur', $id_dapur);
								}
								$totalBawah5 = $totalBawah5->get()->row();
								if (!$totalBawah5 || !$totalBawah5->totaljumlah) {
									echo "<td align='center' style='background-color:#FFFFE0 ;'>-</td>";
									echo "<td align='center' style='background-color:#FFFFE0 ;'>-</td>";
								} else {
									echo "<td align='center' style='background-color:#FFFFE0 ;'>" . $totalBawah5->totaljumlah . "</td>";
									echo "<td align='center' style='background-color:#FFFFE0 ;'>Rp." . number_format($totalBawah5->totalharga, 0, ".", ".") . "</td>";
								}

								$totalBawah6 = $this->db
									->select('SUM(jumlah) as totaljumlah, SUM(jumlah * harga) as totalharga')
									->from('penjualan')
									->join('produk_variant', 'penjualan.id_produk = produk_variant.id_produk_variant')
									->where('tanggal = "' . $awal . '"+ INTERVAL 5 DAY');
								if ($id_dapur != 0) {
									$totalBawah6 = $totalBawah6->where('penjualan.id_dapur', $id_dapur);
								}
								$totalBawah6 = $totalBawah6->get()->row();
								if (!$totalBawah6 || !$totalBawah6->totaljumlah) {
									echo "<td align='center' style='background-color:#FFFFE0 ;'>-</td>";
									echo "<td align='center' style='background-color:#FFFFE0 ;'>-</td>";
								} else {
									echo "<td align='center' style='background-color:#FFFFE0 ;'>" . $totalBawah6->totaljumlah . "</td>";
									echo "<td align='center' style='background-color:#FFFFE0 ;'>Rp." . number_format($totalBawah6->totalharga, 0, ".", ".") . "</td>";
								}

								$totalBawah7 = $this->db
									->select('SUM(jumlah) as totaljumlah, SUM(jumlah * harga) as totalharga')
									->from('penjualan')
									->join('produk_variant', 'penjualan.id_produk = produk_variant.id_produk_variant')
									->where('tanggal = "' . $awal . '"+ INTERVAL 6 DAY');
								if ($id_dapur != 0) {
									$totalBawah7 = $totalBawah7->where('penjualan.id_dapur', $id_dapur);
								}
								$totalBawah7 = $totalBawah7->get()->row();
								if (!$totalBawah7 || !$totalBawah7->totaljumlah) {
									echo "<td align='center' style='background-color:#FFFFE0 ;'>-</td>";
									echo "<td align='center' style='background-color:#FFFFE0 ;'>-</td>";
								} else {
									echo "<td align='center' style='background-color:#FFFFE0 ;'>" . $totalBawah7->totaljumlah . "</td>";
									echo "<td align='center' style='background-color:#FFFFE0 ;'>Rp." . number_format($totalBawah7->totalharga, 0, ".", ".") . "</td>";
								}




								$totalAkhir = $this->db
									->select('SUM(penjualan.jumlah) as totaljumlah, SUM(penjualan.jumlah * produk_variant.harga) as totalharga')
									->from('penjualan')
									->join('produk_variant', 'penjualan.id_produk = produk_variant.id_produk_variant')
									->where('penjualan.tanggal BETWEEN "' . $awal . '" AND DATE_ADD("' . $awal . '", INTERVAL 6 DAY)', null, false);
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
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>


</div>