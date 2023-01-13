<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=drop-bulanan-$nama_dapur-$bulan.xls"); 

?>
<p align="center" style="font-weight:bold;font-size:14pt">Data Drop Bahan dari <?= $nama_dapur ?>
<br>Pada Periode : <?= $bulan ?></p>

<div class="table-responsive">
<table id="print" style="width:100%" border='1'>
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
                                  ?><th colspan="2"><?php echo $x; ?></th><?php
                                }
                                ?>
                                </tr>
                                <tr>
                                <?php
                                for ($x = 1; $x <= 31; $x++) {
                                  ?><th>Jumlah</th>
                                  <th>Harga</th><?php
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
                                        <!-- STOK AWAL -->
                                <?php 
                                  $this->db->select_max('cpsa');
                                  if ($id_dapur==0) {
                                    $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                  } else {
                                    $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                    $this->db->where('id_dapur ="'. $id_dapur .'"');
                                  }
                                  $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
                                  $this->db->where('drop_stok.id_bahan', $ds->id_bahan);
                                  $this->db->where("DATE_FORMAT(tanggal,'%Y-%m') = '".$bulan."' - INTERVAL 1 MONTH");
                                  $tot = $this->db->get('drop_stok')->result();
                                  ?><td align='center'><?PHP 
                                  foreach ($tot as $t) {
                                    if (!$t->cpsa) {
                                        echo "-";
                                    } else {
                                        echo $t->cpsa;
                                    }
                                } ?> </td>
                                        <!-- DROP STOK -->
                                        <?php
                                for ($x = 1; $x <= 31; $x++) {
                                  $this->db->select('SUM(jumlah) as jml, total_harga');
                                  $this->db->from('drop_stok');
                                  if ($id_dapur==0) {
                                    $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                  } else {
                                    $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                    $this->db->where('id_dapur ="'. $id_dapur .'"');
                                  }
                                  $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
                                  $this->db->where('drop_stok.id_bahan', $ds->id_bahan);
                                  if ($x<=9) {
                                    $this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "'.$bulan.'-0'.$x.'"');
                                  } else {
                                    $this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "'.$bulan.'-'.$x.'"');
                                  }
                                  $hasil = $this->db->get()->result();
                                  ?><?PHP 
                                  foreach ($hasil as $j) {
                                    if (!$j->jml) {
                                      ?><td align='center'>-</td>
                                      <td align='center'>-</td><?php
                                    } else {
                                      ?><td align='center'><?= $j->jml ?></td>
                                      <td align='center'>Rp. <?= number_format($j->total_harga, 0, ".", ".") ?></td> <?php
                                    }
                                }
                                }
                                ?>
                                <!-- TOTAL -->
                                <?php 
                                  $this->db->select('SUM(jumlah) as jml');
                                  $this->db->from('drop_stok');
                                  if ($id_dapur==0) {
                                    $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                  } else {
                                    $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                    $this->db->where('id_dapur ="'. $id_dapur .'"');
                                  }
                                  $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
                                  $this->db->where('drop_stok.id_bahan', $ds->id_bahan);
                                  $this->db->where("DATE_FORMAT(tanggal,'%Y-%m') = '".$bulan."'");
                                  $tot = $this->db->get()->result();
                                  ?><td align='center'><?PHP 
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
                                  if ($id_dapur==0) {
                                    $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                  } else {
                                    $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                    $this->db->where('id_dapur ="'. $id_dapur .'"');
                                  }
                                  $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
                                  $this->db->where('drop_stok.id_bahan', $ds->id_bahan);
                                  $this->db->where("DATE_FORMAT(tanggal,'%Y-%m') = '".$bulan."'");
                                  $tot = $this->db->get('drop_stok')->result();
                                  foreach ($tot as $t) {
                                    if (!$t->jml) {
                                      ?><td align='center'>-</td><?php
                                    } else {
                                      ?><td align='center'>Rp. <?= number_format($t->jml, 0, ".", ".") ?></td><?php
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
                                  if ($id_dapur==0) {
                                    $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                  } else {
                                    $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                    $this->db->where('id_dapur ="'. $id_dapur .'"');
                                  }
                                  $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
                                  if ($x<=9) {
                                    $this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "'.$bulan.'-0'.$x.'"');
                                  } else {
                                    $this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "'.$bulan.'-'.$x.'"');
                                  }
                                  $hasil = $this->db->get()->result();
                                  ?><?PHP 
                                  foreach ($hasil as $j) {
                                    if (!$j->tothar) {
                                      ?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">---</td> <?php
                                    } else {
                                      ?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">Rp. <?= number_format($j->tothar, 0, ".", ".") ?></td> <?php
                                    }
                                }
                                }
                                //TOTAAALLLL
                                $this->db->select('SUM(total_harga) as tothar');
                                $this->db->from('drop_stok');
                                if ($id_dapur==0) {
                                  $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                } else {
                                  $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                  $this->db->where('id_dapur ="'. $id_dapur .'"');
                                }
                                $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
                                $this->db->where('DATE_FORMAT(tanggal,"%Y-%m") = "'.$bulan.'"');
                                $hasil = $this->db->get()->result();
                                ?><?PHP 
                                foreach ($hasil as $j) {
                                  if (!$j->tothar) {
                                    ?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">-</td> <?php
                                  } else {
                                    ?><td align='center' colspan="2" style="background-color:#FFFF99 ;">Rp. <?= number_format($j->tothar, 0, ".", ".") ?></td> <?php
                                  }
                              }

                                ?>
                                </tfoot>
</tbody>
</table>
</div>