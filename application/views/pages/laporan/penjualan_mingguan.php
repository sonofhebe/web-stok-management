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
                    <br>Pada tanggal : <?= $awal ?> s/d <?php echo date('Y-m-d', strtotime($awal. ' + 6 days')); ?>
                    <br>Produk terlaris : <?= $terlaris ?> </h6>
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
                                    <th rowspan="3">NO</th>
                                    <th rowspan="3">NAMA PRODUK</th>
                                    <th colspan="7">PRODUK TERJUAL</th>
                                    <th rowspan="3">TOTAL TERJUAL</th>
                                </tr>
                                <tr>
                                    <th>JUMAT</th>
                                    <th>SABTU</th>
                                    <th>MINGGU</th>
                                    <th>SENIN</th>
                                    <th>SELASA</th>
                                    <th>RABU</th>
                                    <th>KAMIS</th>
                                </tr>
                                <tr>
                                      <th><?= $awal ?></th>
                                      <th><?php echo date('Y-m-d', strtotime($awal. ' + 1 days')); ?></th>
                                      <th><?php echo date('Y-m-d', strtotime($awal. ' + 2 days')); ?></th>
                                      <th><?php echo date('Y-m-d', strtotime($awal. ' + 3 days')); ?></th>
                                      <th><?php echo date('Y-m-d', strtotime($awal. ' + 4 days')); ?></th>
                                      <th><?php echo date('Y-m-d', strtotime($awal. ' + 5 days')); ?></th>
                                      <th><?php echo date('Y-m-d', strtotime($awal. ' + 6 days')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                <?php $n = 1;
                                  foreach ($produk as $ds) { ?>
                                        <td><?= $n; ?></td>
                                        <td><?= $ds->nama_produk ?></td>
                                        <!-- PRODUK TERJUAL -->
                                <?php 
                                  $this->db->select_sum('jumlah');
                                  if ($id_dapur==0) {
                                    $this->db->where('id_produk', $ds->id_produk);
                                  } else {
                                    $this->db->where('id_produk', $ds->id_produk);
                                    $this->db->where('id_dapur ="'. $id_dapur .'"');
                                  }
                                  $this->db->where('tanggal = "'. $awal.'"');
                                  $d1 = $this->db->get('penjualan')->result();
                                  ?><td>
                                    <?PHP foreach ($d1 as $j) {
                                    if (!$j->jumlah) {
                                      echo "-";
                                    } else {
                                        echo $j->jumlah;
                                    }
                                } ?> </td>
                                <?php 
                                  $this->db->select_sum('jumlah');
                                  if ($id_dapur==0) {
                                    $this->db->where('id_produk', $ds->id_produk);
                                  } else {
                                    $this->db->where('id_produk', $ds->id_produk);
                                    $this->db->where('id_dapur ="'. $id_dapur .'"');
                                  }
                                  $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 1 DAY');
                                  $d2 = $this->db->get('penjualan')->result();
                                  ?><td>
                                  <?PHP foreach ($d2 as $j) {
                                    if (!$j->jumlah) {
                                      echo "-";
                                    } else {
                                        echo $j->jumlah;
                                    }
                                } ?> </td>
                                <?php
                                  $this->db->select_sum('jumlah');
                                   if ($id_dapur==0) {
                                    $this->db->where('id_produk', $ds->id_produk);
                                  } else {
                                    $this->db->where('id_produk', $ds->id_produk);
                                    $this->db->where('id_dapur ="'. $id_dapur .'"');
                                  }
                                  $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 2 DAY');
                                  $d3 = $this->db->get('penjualan')->result();
                                  ?><td>
                                  <?PHP foreach ($d3 as $j) {
                                    if (!$j->jumlah) {
                                      echo "-";
                                    } else {
                                        echo $j->jumlah;
                                    }
                                } ?> </td>
                                <?php
                                  $this->db->select_sum('jumlah');
                                   if ($id_dapur==0) {
                                    $this->db->where('id_produk', $ds->id_produk);
                                  } else {
                                    $this->db->where('id_produk', $ds->id_produk);
                                    $this->db->where('id_dapur ="'. $id_dapur .'"');
                                  }
                                  $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 3 DAY');
                                  $d4 = $this->db->get('penjualan')->result();
                                  ?><td>
                                  <?PHP foreach ($d4 as $j) {
                                    if (!$j->jumlah) {
                                      echo "-";
                                    } else {
                                        echo $j->jumlah;
                                    }
                                } ?> </td>
                                <?php
                                  $this->db->select_sum('jumlah');
                                   if ($id_dapur==0) {
                                    $this->db->where('id_produk', $ds->id_produk);
                                  } else {
                                    $this->db->where('id_produk', $ds->id_produk);
                                    $this->db->where('id_dapur ="'. $id_dapur .'"');
                                  }
                                  $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 4 DAY');
                                  $d5 = $this->db->get('penjualan')->result();
                                  ?><td>
                                  <?PHP foreach ($d5 as $j) {
                                    if (!$j->jumlah) {
                                      echo "-";
                                    } else {
                                        echo $j->jumlah;
                                    }
                                } ?> </td>
                                <?php
                                  $this->db->select_sum('jumlah');
                                   if ($id_dapur==0) {
                                    $this->db->where('id_produk', $ds->id_produk);
                                  } else {
                                    $this->db->where('id_produk', $ds->id_produk);
                                    $this->db->where('id_dapur ="'. $id_dapur .'"');
                                  }
                                  $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 5 DAY');
                                  $d6 = $this->db->get('penjualan')->result();
                                  ?><td>
                                  <?PHP foreach ($d6 as $j) {
                                    if (!$j->jumlah) {
                                      echo "-";
                                    } else {
                                        echo $j->jumlah;
                                    }
                                } ?> </td>
                                <?php 
                                  $this->db->select_sum('jumlah');
                                  if ($id_dapur==0) {
                                    $this->db->where('id_produk', $ds->id_produk);
                                  } else {
                                    $this->db->where('id_produk', $ds->id_produk);
                                    $this->db->where('id_dapur ="'. $id_dapur .'"');
                                  }
                                  $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 6 DAY');
                                  $d7 = $this->db->get('penjualan')->result();
                                  ?><td>
                                  <?PHP foreach ($d7 as $j) {
                                    if (!$j->jumlah) {
                                      echo "-";
                                    } else {
                                        echo $j->jumlah;
                                    }
                                } ?> </td>
                                <!-- TOTAL -->
                                <?php 
                                  $this->db->select_sum('jumlah');
                                  if ($id_dapur==0) {
                                    $this->db->where('id_produk', $ds->id_produk);
                                  } else {
                                    $this->db->where('id_produk', $ds->id_produk);
                                    $this->db->where('id_dapur ="'. $id_dapur .'"');
                                  }
                                  $this->db->where('tanggal BETWEEN "'. $awal.'"AND "'. $awal.'"+ INTERVAL 6 DAY');
                                  $tot = $this->db->get('penjualan')->result();
                                  ?><td><?PHP 
                                  foreach ($tot as $t) {
                                    if (!$t->jumlah) {
                                      echo "-";
                                    } else {
                                        echo $t->jumlah;
                                    }
                                } ?> </td>
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