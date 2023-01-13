<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pengiriman Stok Perminggu</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="<?= base_url('laporan-drop') ?>">Laporan Drop</a></div>
                <div class="breadcrumb-item">Pengiriman Stok Perminggu</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Pengiriman Stok Perminggu</h2>
        </div>
    </section>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <di class="card-header">
                    <h6>Data dari <?= $nama_dapur ?>  
                    <br>Pada tanggal : <?= $awal ?> s/d <?php echo date('Y-m-d', strtotime($awal. ' + 6 days')); ?></h6>
                </di>
                <div class="card-body">
                <form action="<?= base_url('print-drop-mingguan') ?>" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id_dapur" value="<?= $id_dapur ?>">
                  <input type="hidden" name="id_kategori" value="<?= $id_kategori ?>">
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
                                      <th colspan="2"><?php echo date('Y-m-d', strtotime($awal. ' + 1 days')); ?></th>
                                      <th colspan="2"><?php echo date('Y-m-d', strtotime($awal. ' + 2 days')); ?></th>
                                      <th colspan="2"><?php echo date('Y-m-d', strtotime($awal. ' + 3 days')); ?></th>
                                      <th colspan="2"><?php echo date('Y-m-d', strtotime($awal. ' + 4 days')); ?></th>
                                      <th colspan="2"><?php echo date('Y-m-d', strtotime($awal. ' + 5 days')); ?></th>
                                      <th colspan="2"><?php echo date('Y-m-d', strtotime($awal. ' + 6 days')); ?></th>
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
                                        <td><?= $n; ?></td>
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
                                  $this->db->where('tanggal BETWEEN "'. $awal.'"- INTERVAL 7 DAY AND "'. $awal.'"- INTERVAL 1 DAY');
                                  $tot = $this->db->get('drop_stok')->result();
                                  ?><td><?PHP 
                                  foreach ($tot as $t) {
                                    if (!$t->cpsa) {
                                        echo "-";
                                    } else {
                                        echo $t->cpsa;
                                    }
                                } ?> </td>
                                
                                        <!-- STOK KELUAR -->
                                <?php 
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
                                  $this->db->where('tanggal = "'. $awal.'"');
                                  $sab = $this->db->get()->result();
                                  foreach ($sab as $j) {
                                    if (!$j->jml) {
                                      ?><td>-</td>
                                      <td>-</td> <?php
                                    } else {
                                      ?><td><?= $j->jml ?></td>
                                      <td>Rp. <?= number_format($j->total_harga, 0, ".", ".") ?></td> <?php
                                    }
                                }
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
                                  $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 1 DAY');
                                  $min = $this->db->get()->result();
                                  foreach ($min as $j) {
                                    if (!$j->jml) {
                                      ?><td>-</td>
                                      <td>-</td> <?php
                                    } else {
                                      ?><td><?= $j->jml ?></td>
                                      <td>Rp. <?= number_format($j->total_harga, 0, ".", ".") ?></td> <?php
                                    }
                                } 
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
                                  $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 2 DAY');
                                  $sen = $this->db->get()->result();
                                  foreach ($sen as $j) {
                                    if (!$j->jml) {
                                      ?><td>-</td>
                                      <td>-</td> <?php
                                    } else {
                                      ?><td><?= $j->jml ?></td>
                                      <td>Rp. <?= number_format($j->total_harga, 0, ".", ".") ?></td> <?php
                                    }
                                } 
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
                                  $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 3 DAY');
                                  $sel = $this->db->get()->result();
                                  foreach ($sel as $j) {
                                    if (!$j->jml) {
                                      ?><td>-</td>
                                      <td>-</td> <?php
                                    } else {
                                      ?><td><?= $j->jml ?></td>
                                      <td>Rp. <?= number_format($j->total_harga, 0, ".", ".") ?></td> <?php
                                    }
                                } 
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
                                  $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 4 DAY');
                                  $ra = $this->db->get()->result();
                                  foreach ($ra as $j) {
                                    if (!$j->jml) {
                                      ?><td>-</td>
                                      <td>-</td> <?php
                                    } else {
                                      ?><td><?= $j->jml ?></td>
                                      <td>Rp. <?= number_format($j->total_harga, 0, ".", ".") ?></td> <?php
                                    }
                                } 
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
                                  $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 5 DAY');
                                  $kam = $this->db->get()->result();
                                  foreach ($kam as $j) {
                                    if (!$j->jml) {
                                      ?><td>-</td>
                                      <td>-</td> <?php
                                    } else {
                                      ?><td><?= $j->jml ?></td>
                                      <td>Rp. <?= number_format($j->total_harga, 0, ".", ".") ?></td> <?php
                                    }
                                } 
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
                                  $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 6 DAY');
                                  $jum = $this->db->get()->result();
                                  foreach ($jum as $j) {
                                    if (!$j->jml) {
                                      ?><td>-</td>
                                      <td>-</td> <?php
                                    } else {
                                      ?><td><?= $j->jml ?></td>
                                      <td>Rp. <?= number_format($j->total_harga, 0, ".", ".") ?></td> <?php
                                    }
                                } ?> 
                                <!-- TOTAL -->
                                <?php 
                                  $this->db->select('SUM(jumlah) as jml');
                                  if ($id_dapur==0) {
                                    $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                  } else {
                                    $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                    $this->db->where('id_dapur ="'. $id_dapur .'"');
                                  }
                                  $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
                                  $this->db->where('drop_stok.id_bahan', $ds->id_bahan);
                                  $this->db->where('tanggal BETWEEN "'. $awal.'"AND "'. $awal.'"+ INTERVAL 6 DAY');
                                  $tot = $this->db->get('drop_stok')->result();
                                  foreach ($tot as $t) {
                                    if (!$t->jml) {
                                      ?><td>-</td><?php
                                    } else {
                                      ?><td><?= $t->jml ?></td><?php
                                    }
                                } ?>
                                
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
                                  $this->db->where('tanggal BETWEEN "'. $awal.'"AND "'. $awal.'"+ INTERVAL 6 DAY');
                                  $tot = $this->db->get('drop_stok')->result();
                                  foreach ($tot as $t) {
                                    if (!$t->jml) {
                                      ?><td>-</td><?php
                                    } else {
                                      ?><td>Rp. <?= number_format($t->jml, 0, ".", ".") ?></td><?php
                                    }
                                } ?>
                                 </tr>
                                 <?php $n++;
                                 }
                                 
                                 /////// total bawah?>
                            </tbody>
                            <tfoot>
                              <td colspan="3" style="background-color:#FFFF99 ;">Total</td>
                              <?php $this->db->select('SUM(total_harga) as tothar');
                                    $this->db->from('drop_stok');
                                  if ($id_dapur==0) {
                                    $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                  } else {
                                    $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                    $this->db->where('id_dapur ="'. $id_dapur .'"');
                                  }
                                  $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
                                  $this->db->where('tanggal ', $awal);
                                  $a = $this->db->get()->result();
                                  foreach ($a as $j) {
                                    if (!$j->tothar) {
                                      ?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">-</td> <?php
                                    } else {
                                      ?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">Rp. <?= number_format($j->tothar, 0, ".", ".") ?></td> <?php
                                    }
                                } 
                                $this->db->select('SUM(total_harga) as tothar');
                                      $this->db->from('drop_stok');
                                    if ($id_dapur==0) {
                                      $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                    } else {
                                      $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                      $this->db->where('id_dapur ="'. $id_dapur .'"');
                                    }
                                    $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
                                    $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 1 DAY');
                                    $a = $this->db->get()->result();
                                    foreach ($a as $j) {
                                      if (!$j->tothar) {
                                        ?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">-</td> <?php
                                      } else {
                                        ?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">Rp. <?= number_format($j->tothar, 0, ".", ".") ?></td> <?php
                                      }
                                  }
                                  $this->db->select('SUM(total_harga) as tothar');
                                        $this->db->from('drop_stok');
                                      if ($id_dapur==0) {
                                        $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                      } else {
                                        $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                        $this->db->where('id_dapur ="'. $id_dapur .'"');
                                      }
                                      $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
                                      $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 2 DAY');
                                      $a = $this->db->get()->result();
                                      foreach ($a as $j) {
                                        if (!$j->tothar) {
                                          ?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">-</td> <?php
                                        } else {
                                          ?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">Rp. <?= number_format($j->tothar, 0, ".", ".") ?></td> <?php
                                        }
                                    }
                                    $this->db->select('SUM(total_harga) as tothar');
                                          $this->db->from('drop_stok');
                                        if ($id_dapur==0) {
                                          $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                        } else {
                                          $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                          $this->db->where('id_dapur ="'. $id_dapur .'"');
                                        }
                                        $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
                                        $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 3 DAY');
                                        $a = $this->db->get()->result();
                                        foreach ($a as $j) {
                                          if (!$j->tothar) {
                                            ?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">-</td> <?php
                                          } else {
                                            ?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">Rp. <?= number_format($j->tothar, 0, ".", ".") ?></td> <?php
                                          }
                                      }
                                      $this->db->select('SUM(total_harga) as tothar');
                                            $this->db->from('drop_stok');
                                          if ($id_dapur==0) {
                                            $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                          } else {
                                            $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                            $this->db->where('id_dapur ="'. $id_dapur .'"');
                                          }
                                          $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
                                          $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 4 DAY');
                                          $a = $this->db->get()->result();
                                          foreach ($a as $j) {
                                            if (!$j->tothar) {
                                              ?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">-</td> <?php
                                            } else {
                                              ?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">Rp. <?= number_format($j->tothar, 0, ".", ".") ?></td> <?php
                                            }
                                        }
                                        $this->db->select('SUM(total_harga) as tothar');
                                              $this->db->from('drop_stok');
                                            if ($id_dapur==0) {
                                              $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                            } else {
                                              $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                              $this->db->where('id_dapur ="'. $id_dapur .'"');
                                            }
                                            $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
                                            $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 5 DAY');
                                            $a = $this->db->get()->result();
                                            foreach ($a as $j) {
                                              if (!$j->tothar) {
                                                ?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">-</td> <?php
                                              } else {
                                                ?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">Rp. <?= number_format($j->tothar, 0, ".", ".") ?></td> <?php
                                              }
                                          }
                                          $this->db->select('SUM(total_harga) as tothar');
                                                $this->db->from('drop_stok');
                                              if ($id_dapur==0) {
                                                $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                              } else {
                                                $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                                $this->db->where('id_dapur ="'. $id_dapur .'"');
                                              }
                                              $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
                                              $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 6 DAY');
                                              $a = $this->db->get()->result();
                                              foreach ($a as $j) {
                                                if (!$j->tothar) {
                                                  ?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">-</td> <?php
                                                } else {
                                                  ?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">Rp. <?= number_format($j->tothar, 0, ".", ".") ?></td> <?php
                                                }
                                            }
                                            $this->db->select('SUM(total_harga) as tothar');
                                                  $this->db->from('drop_stok');
                                                if ($id_dapur==0) {
                                                  $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                                } else {
                                                  $this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
                                                  $this->db->where('id_dapur ="'. $id_dapur .'"');
                                                }
                                                $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
                                                $a = $this->db->get()->result();
                                                foreach ($a as $j) {
                                                  if (!$j->tothar) {
                                                    ?><td align='center' colspan="2" style="background-color:#FFFFE0 ;">-</td> <?php
                                                  } else {
                                                    ?><td align='center' colspan="2" style="background-color:#FFFF99 ;">Rp. <?= number_format($j->tothar, 0, ".", ".") ?></td> <?php
                                                  }
                                              }
                                   ?> 
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>