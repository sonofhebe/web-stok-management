<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=pemakaian-bulanan-$nama_dapur-$bulan.xls");

?>
<p align="center" style="font-weight:bold;font-size:14pt">Data Pemakaian Bahan dari <?= $nama_dapur ?>
	<br>Pada Periode : <?= $bulan ?>
</p>

<div class="table-responsive">
	<table id="print" style="width:100%" border='1'>
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
					<td align='center'><?= $n; ?></td>
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


					<td align='center'><?= $stokAwal ?></td>
					<td align='center'><?= $masuk ?></td>
					<td align='center'><?= $stokAwal + $masuk ?></td>
					<td align='center'><?= $stokRusak ?></td>
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
						?><td align='center'>
									<?php echo "-"; ?></td>
							<?php
							} else {
							?><td align='center'>
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
					?><td align='center'>
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

					<!-- total stok akhir -->
					<td align='center'><?= ($stokAwal + $masuk) - $stokRusak - $totalPemakaian ?></td>
			</tr>

		<?php $n++;
				} ?>
		</tbody>
	</table>
</div>