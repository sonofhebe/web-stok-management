<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=penjualan-bulanan-$nama_dapur-$bulan.xls");

?>
<p align="center" style="font-weight:bold;font-size:14pt">Data Penjualan Produk dari <?= $nama_dapur ?>
	<br>Pada Periode : <?= $bulan ?>
	<br>Produk terlaris : <?= $terlaris ?>
</p>

<div class="table-responsive">
	<table id="print" style="width:100%" border='1'>
		<thead>
			<tr>
				<th rowspan="2">NO</th>
				<th rowspan="2">NAMA PRODUK</th>
				<th colspan="31">PRODUK TERJUAL</th>
				<th rowspan="2">TOTAL TERJUAL</th>
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
					<td align='center'><?= $n; ?></td>
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
							echo "<td align='center'>-</td>";
							echo "<td align='center'>-</td>";
						} else {
							echo "<td align='center'>" . $t->jumlah . "</td>";
							echo "<td align='center'>Rp." . number_format($t->jumlah * $harga, 0, ".", ".") . "</td>";
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
		?><td align='center'>
						<?php echo "-"; ?></td>
				<?php
				} else {
				?><td align='center'>
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