<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>SC Bulanan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="<?= base_url('laporan-pemakaian') ?>">Laporan Pemakaian</a></div>
                <div class="breadcrumb-item">Data SC Bulanan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">SC Bulanan</h2>
        </div>
    </section>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <di class="card-header">
                    <h6>Data dari <?= $nama_dapur ?>
                    <br>Pada periode <?= $bulan ?> </h6>
                </di>
                <div class="card-body">
                <form action="<?= base_url('print-sc-bulanan') ?>" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id_dapur" value="<?= $id_dapur ?>">
                  <input type="hidden" name="id_kategori" value="<?= $id_kategori ?>">
                  <input type="hidden" name="bulan" value="<?= $bulan ?>">
                  <button class="btn btn-success btn-sm" type="submit">Export Excel</button>
                </form>
                    <div class="flashdata" id="flashdata" onload="clearmy()">
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                    <div class="table-responsive">
                        <table id="print" class="table table-striped table-bordered text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th rowspan="3">NO</th>
                                    <th rowspan="3">NAMA TAKARAN/BAHAN</th>
                                </tr>
                                <tr>
                                <?php for ($x = 1; $x <= 31; $x++) {
                                  ?><th colspan="2"><?php echo $x; ?></th>
                                  <?php } ?>
                                  </tr>
                                <tr>
                                  <?php for ($y = 1; $y <= 31; $y++) { ?>
                                      <th>Jumlah SC</th>
                                      <th>Total Gram</th>
                                      <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                <?php $n = 1;
                                  foreach ($takaran as $ds) { ?>
                                        <td><?= $n; ?></td>
                                        <td><?= $ds->nama_takaran ?></td>
                                        <!-- PEMAKAIAN -->
                                <?php //////////////////////////////////////////////////////////////////
                                for ($x = 1; $x <= 31; $x++) {
                                  $this->db->select_sum('sc');
                                  $this->db->from('pemakaian');
                                  if ($id_dapur==0) {
                                    $this->db->join('resep', 'resep.id_resep=pemakaian.id_resep');
                                  } else {
                                    $this->db->join('resep', 'resep.id_resep=pemakaian.id_resep');
                                    $this->db->where('id_dapur ="'. $id_dapur .'"');
                                  }
                                  $this->db->join('takaran', 'takaran.id_takaran=resep.id_takaran');
                                  $this->db->join('bahan', 'bahan.id_bahan=pemakaian.id_bahan');
                                  $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
                                  $this->db->where('takaran.id_takaran', $ds->id_takaran);
                                  if ($x<=9) {
                                    $this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "'.$bulan.'-0'.$x.'"');
                                  } else {
                                    $this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "'.$bulan.'-'.$x.'"');
                                  }
                                  $sc1 = $this->db->get()->result();
                                  foreach ($sc1 as $sc) {
                                    if (!$sc->sc) {
                                      ?><td><?PHP echo "-";?> </td>
                                      <td><?PHP echo "-";?> </td><?php 
                                    } else {
                                      $this->db->select_sum('pemakaian.jumlah');
                                      $this->db->from('pemakaian');
                                      if ($id_dapur==0) {
                                        $this->db->join('resep', 'resep.id_resep=pemakaian.id_resep');
                                      } else {
                                        $this->db->join('resep', 'resep.id_resep=pemakaian.id_resep');
                                        $this->db->where('id_dapur ="'. $id_dapur .'"');
                                      }
                                      $this->db->join('takaran', 'takaran.id_takaran=resep.id_takaran');
                                      $this->db->join('bahan', 'bahan.id_bahan=pemakaian.id_bahan');
                                      $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
                                      $this->db->where('takaran.id_takaran', $ds->id_takaran);
                                      if ($x<=9) {
                                        $this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "'.$bulan.'-0'.$x.'"');
                                      } else {
                                        $this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "'.$bulan.'-'.$x.'"');
                                      }
                                      $j1 = $this->db->get()->result();
                                      foreach ($j1 as $j) { ?>
                                      <td><?PHP echo $sc->sc;?> </td>
                                      <td><?PHP echo $j->jumlah;?> </td><?php 
                                      }
                                    }
                                } 
                              }
                                ///////////////////////////////////////////////////////////////////?>
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