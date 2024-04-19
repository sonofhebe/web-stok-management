<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=drop-mingguan-$nama_dapur-$awal.xls");

?>
<p align="center" style="font-weight:bold;font-size:14pt">Data Drop Bahan dari <?= $nama_dapur ?>
	<br>Pada tanggal : <?= $awal ?> s/d
	<?php echo date('Y-m-d', strtotime($awal . ' + 6 days')); ?>
</p>

<div class="table-responsive">
	<table id="print" style="width:100%" border='1'>
		<thead>
			<tr>
				<th rowspan="4">NO</th>
				<th rowspan="4">NAMA BAHAN</th>
				<th rowspan="4">STOK AWAL</th>
				<th colspan="14">PENGIRIMAN STOK</th>
				<th rowspan="4">TOTAL DROP STOK</th>
				<th rowspan="4">TOTAL HARGA</th>
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
				<th>Jumlah</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Harga</th>
			</tr>
		</thead>
		<tbody>
			<tr>

				<?php $n = 1;
				foreach ($bahan as $ds) { ?>
					<td align='center'><?= $n; ?></td>
					<td><?= $ds->nama_bahan ?></td>
					<!-- STOK AWAL -->

					<!-- GET STOK AWAL -->

					<?php
					$this->db->select_sum('jumlah');
					$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
					if ($id_dapur != 0) {
						$this->db->where('id_dapur', $id_dapur);
					}
					$this->db->where('drop_stok.id_bahan', $ds->id_bahan);
					$this->db->where('tanggal <', $awal);
					$querySumDropStok = $this->db->get('drop_stok');
					$sumDropStok = $querySumDropStok->row()->jumlah;

					// Query untuk mendapatkan sum jumlah dari pemakaian
					$this->db->select_sum('jumlah');
					if ($id_dapur != 0) {
						$this->db->where('id_dapur', $id_dapur);
					}
					$this->db->where('id_bahan', $ds->id_bahan);
					$this->db->where('tanggal <', $awal);
					$querySumPemakaian = $this->db->get('pemakaian');
					$sumPemakaian = $querySumPemakaian->row()->jumlah;

					// Menghitung stok awal
					$stokAwal = $sumDropStok - $sumPemakaian; ?>
					<!-- END GET STOK AWAL -->

					<!-- STOK AWAL -->
					<td align='center'><?= $stokAwal ?></td>

					<!-- STOK KELUAR -->

					<?php
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
					$this->db->where('tanggal = "' . $awal . '"');
					$sab = $this->db->get()->result();
					foreach ($sab as $j) {
						if (!$j->jml) {
					?><td align='center'>-</td>
							<td align='center'>-</td>
						<?php
						} else {
						?><td align='center'><?= $j->jml ?></td>
							<td align='center'>Rp. <?= number_format($j->total_harga, 0, ".", ".") ?></td>
						<?php
						}
					}
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
					$this->db->where('tanggal = "' . $awal . '"+ INTERVAL 1 DAY');
					$min = $this->db->get()->result();
					foreach ($min as $j) {
						if (!$j->jml) {
						?><td align='center'>-</td>
							<td align='center'>-</td>
						<?php
						} else {
						?><td align='center'><?= $j->jml ?></td>
							<td align='center'>Rp. <?= number_format($j->total_harga, 0, ".", ".") ?></td>
						<?php
						}
					}
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
					$this->db->where('tanggal = "' . $awal . '"+ INTERVAL 2 DAY');
					$sen = $this->db->get()->result();
					foreach ($sen as $j) {
						if (!$j->jml) {
						?><td align='center'>-</td>
							<td align='center'>-</td>
						<?php
						} else {
						?><td align='center'><?= $j->jml ?></td>
							<td align='center'>Rp. <?= number_format($j->total_harga, 0, ".", ".") ?></td>
						<?php
						}
					}
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
					$this->db->where('tanggal = "' . $awal . '"+ INTERVAL 3 DAY');
					$sel = $this->db->get()->result();
					foreach ($sel as $j) {
						if (!$j->jml) {
						?><td align='center'>-</td>
							<td align='center'>-</td>
						<?php
						} else {
						?><td align='center'><?= $j->jml ?></td>
							<td align='center'>Rp. <?= number_format($j->total_harga, 0, ".", ".") ?></td>
						<?php
						}
					}
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
					$this->db->where('tanggal = "' . $awal . '"+ INTERVAL 4 DAY');
					$ra = $this->db->get()->result();
					foreach ($ra as $j) {
						if (!$j->jml) {
						?><td align='center'>-</td>
							<td align='center'>-</td>
						<?php
						} else {
						?><td align='center'><?= $j->jml ?></td>
							<td align='center'>Rp. <?= number_format($j->total_harga, 0, ".", ".") ?></td>
						<?php
						}
					}
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
					$this->db->where('tanggal = "' . $awal . '"+ INTERVAL 5 DAY');
					$kam = $this->db->get()->result();
					foreach ($kam as $j) {
						if (!$j->jml) {
						?><td align='center'>-</td>
							<td align='center'>-</td>
						<?php
						} else {
						?><td align='center'><?= $j->jml ?></td>
							<td align='center'>Rp. <?= number_format($j->total_harga, 0, ".", ".") ?></td>
						<?php
						}
					}
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
					$this->db->where('tanggal = "' . $awal . '"+ INTERVAL 6 DAY');
					$jum = $this->db->get()->result();
					foreach ($jum as $j) {
						if (!$j->jml) {
						?><td align='center'>-</td>
							<td align='center'>-</td>
						<?php
						} else {
						?><td align='center'><?= $j->jml ?></td>
							<td align='center'>Rp. <?= number_format($j->total_harga, 0, ".", ".") ?></td>
					<?php
						}
					} ?>
					<!-- TOTAL -->

					<?php
					$this->db->select('SUM(jumlah) as jml');
					if ($id_dapur == 0) {
						$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
					} else {
						$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
						$this->db->where('id_dapur ="' . $id_dapur . '"');
					}
					$this->db->where('bahan.id_kategori ="' . $id_kategori . '"');
					$this->db->where('drop_stok.id_bahan', $ds->id_bahan);
					$this->db->where('tanggal BETWEEN "' . $awal . '"AND "' . $awal . '"+ INTERVAL 6 DAY');
					$tot = $this->db->get('drop_stok')->result();
					foreach ($tot as $t) {
						if (!$t->jml) {
					?><td align='center'>-</td>
						<?php
						} else {
						?><td align='center'><?= $t->jml ?></td>
					<?php
						}
					} ?>

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
					$this->db->where('tanggal BETWEEN "' . $awal . '"AND "' . $awal . '"+ INTERVAL 6 DAY');
					$tot = $this->db->get('drop_stok')->result();
					foreach ($tot as $t) {
						if (!$t->jml) {
					?><td align='center'>-</td>
						<?php
						} else {
						?><td align='center'>Rp. <?= number_format($t->jml, 0, ".", ".") ?></td>
					<?php
						}
					} ?>
			</tr>

		<?php $n++;
				}

				/////// total bawah
		?>
		</tbody>
		<tfoot>
			<td align='center' colspan="3" style="background-color:#FFFF99 ;">Total</td>

			<?php $this->db->select('SUM(total_harga) as tothar');
			$this->db->from('drop_stok');
			if ($id_dapur == 0) {
				$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
			} else {
				$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
				$this->db->where('id_dapur ="' . $id_dapur . '"');
			}
			$this->db->where('bahan.id_kategori ="' . $id_kategori . '"');
			$this->db->where('tanggal ', $awal);
			$a = $this->db->get()->result();
			foreach ($a as $j) {
				if (!$j->tothar) {
			?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">-</td>
				<?php
				} else {
				?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">Rp. <?= number_format($j->tothar, 0, ".", ".") ?></td>
				<?php
				}
			}
			$this->db->select('SUM(total_harga) as tothar');
			$this->db->from('drop_stok');
			if ($id_dapur == 0) {
				$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
			} else {
				$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
				$this->db->where('id_dapur ="' . $id_dapur . '"');
			}
			$this->db->where('bahan.id_kategori ="' . $id_kategori . '"');
			$this->db->where('tanggal = "' . $awal . '"+ INTERVAL 1 DAY');
			$a = $this->db->get()->result();
			foreach ($a as $j) {
				if (!$j->tothar) {
				?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">-</td>
				<?php
				} else {
				?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">Rp. <?= number_format($j->tothar, 0, ".", ".") ?></td>
				<?php
				}
			}
			$this->db->select('SUM(total_harga) as tothar');
			$this->db->from('drop_stok');
			if ($id_dapur == 0) {
				$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
			} else {
				$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
				$this->db->where('id_dapur ="' . $id_dapur . '"');
			}
			$this->db->where('bahan.id_kategori ="' . $id_kategori . '"');
			$this->db->where('tanggal = "' . $awal . '"+ INTERVAL 2 DAY');
			$a = $this->db->get()->result();
			foreach ($a as $j) {
				if (!$j->tothar) {
				?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">-</td>
				<?php
				} else {
				?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">Rp. <?= number_format($j->tothar, 0, ".", ".") ?></td>
				<?php
				}
			}
			$this->db->select('SUM(total_harga) as tothar');
			$this->db->from('drop_stok');
			if ($id_dapur == 0) {
				$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
			} else {
				$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
				$this->db->where('id_dapur ="' . $id_dapur . '"');
			}
			$this->db->where('bahan.id_kategori ="' . $id_kategori . '"');
			$this->db->where('tanggal = "' . $awal . '"+ INTERVAL 3 DAY');
			$a = $this->db->get()->result();
			foreach ($a as $j) {
				if (!$j->tothar) {
				?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">-</td>
				<?php
				} else {
				?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">Rp. <?= number_format($j->tothar, 0, ".", ".") ?></td>
				<?php
				}
			}
			$this->db->select('SUM(total_harga) as tothar');
			$this->db->from('drop_stok');
			if ($id_dapur == 0) {
				$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
			} else {
				$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
				$this->db->where('id_dapur ="' . $id_dapur . '"');
			}
			$this->db->where('bahan.id_kategori ="' . $id_kategori . '"');
			$this->db->where('tanggal = "' . $awal . '"+ INTERVAL 4 DAY');
			$a = $this->db->get()->result();
			foreach ($a as $j) {
				if (!$j->tothar) {
				?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">-</td>
				<?php
				} else {
				?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">Rp. <?= number_format($j->tothar, 0, ".", ".") ?></td>
				<?php
				}
			}
			$this->db->select('SUM(total_harga) as tothar');
			$this->db->from('drop_stok');
			if ($id_dapur == 0) {
				$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
			} else {
				$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
				$this->db->where('id_dapur ="' . $id_dapur . '"');
			}
			$this->db->where('bahan.id_kategori ="' . $id_kategori . '"');
			$this->db->where('tanggal = "' . $awal . '"+ INTERVAL 5 DAY');
			$a = $this->db->get()->result();
			foreach ($a as $j) {
				if (!$j->tothar) {
				?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">-</td>
				<?php
				} else {
				?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">Rp. <?= number_format($j->tothar, 0, ".", ".") ?></td>
				<?php
				}
			}
			$this->db->select('SUM(total_harga) as tothar');
			$this->db->from('drop_stok');
			if ($id_dapur == 0) {
				$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
			} else {
				$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
				$this->db->where('id_dapur ="' . $id_dapur . '"');
			}
			$this->db->where('bahan.id_kategori ="' . $id_kategori . '"');
			$this->db->where('tanggal = "' . $awal . '"+ INTERVAL 6 DAY');
			$a = $this->db->get()->result();
			foreach ($a as $j) {
				if (!$j->tothar) {
				?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">-</td>
				<?php
				} else {
				?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">Rp. <?= number_format($j->tothar, 0, ".", ".") ?></td>
				<?php
				}
			}
			$this->db->select('SUM(total_harga) as tothar');
			$this->db->from('drop_stok');
			if ($id_dapur == 0) {
				$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
			} else {
				$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
				$this->db->where('id_dapur ="' . $id_dapur . '"');
			}
			$this->db->where('tanggal BETWEEN "' . $awal . '"AND "' . $awal . '"+ INTERVAL 6 DAY');
			$this->db->where('bahan.id_kategori ="' . $id_kategori . '"');
			$a = $this->db->get()->result();
			foreach ($a as $j) {
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