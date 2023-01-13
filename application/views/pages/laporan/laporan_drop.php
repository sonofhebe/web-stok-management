      <!-- Main Content -->
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <h1>Laporan Drop Stok</h1>
                  <div class="section-header-breadcrumb">
                      <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
                      <div class="breadcrumb-item">Laporan Drop Stok</div>
                  </div>
              </div>

              <div class="section-body">
                  <h2 class="section-title">Lihat dan Cetak Laporan</h2>

              </div>
          </section>


          <div class="card">
              <div class="card-body">
                  <div class="row">
                      <div class="col-lg-12">
                          <h5 class="ml-2 mt-2 mb2"><b>Laporan Drop Stok</b></h5>
                          <div class="row">
                                <div class="col-md-6">
                                  <div class="card">
                                      <div class="card-body">
                                        <h6>Mingguan</h6>
                                          <form action="<?= base_url('drop-mingguan') ?>" method="post" enctype="multipart/form-data">
                                              <div class="row">
                                                  <div class="col-12">
                                                      <div class="form-group">
                                                          <div class="row">
                                                              <label>Pilih Dapur</label>
                                                            <select name="id_dapur" id="" class="form-control" required>
                                                                <option value="" selected disabled>-- PILIH DAPUR --</option>
                                                                <?php foreach ($dapur as $data_d) { ?>
                                                                    <option value="<?= $data_d->id_dapur ?>"><?= $data_d->nama_dapur ?></option>
                                                                <?php } ?>
                                                                <option value="0">SEMUA DAPUR</option>
                                                            </select>
                                                              <div class="col-md-6">
                                                              <label>Kategori Bahan</label>
                                                            <select name="id_kategori" id="" class="form-control" required>
                                                                <option value="" selected disabled>-- PILIH KATEGORI --</option>
                                                                <?php foreach ($katbahan as $data_k) { ?>
                                                                    <option value="<?= $data_k->id_kategori ?>"><?= $data_k->nama_kategori ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            </div>
                                                              <div class="col-md-6">
                                                                <label>Minggu</label>
                                                              <input name="awal" id="awl" class="form-control" required type="dategate" placeholder="pilih tanggal awal">  
                                                              </div>  
                                                          </div>
                                                        </div>
                                                      <div class="form-group">
                                                          <button type="submit" class="btn btn-block btn-warning"><i class="far fa-eye"></i> Lihat Laporan</button>
                                                      </div>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="card">
                                      <div class="card-body">
                                        <h6>Bulanan</h6>
                                          <form action="<?= base_url('drop-bulanan') ?>" method="post" enctype="multipart/form-data">
                                              <div class="row">
                                                  <div class="col-12">
                                                      <div class="form-group">
                                                          <div class="row">
                                                              <label>Pilih Dapur</label>
                                                            <select name="id_dapur" id="" class="form-control" required>
                                                                <option value="" selected disabled>-- PILIH DAPUR --</option>
                                                                <?php foreach ($dapur as $data_d) { ?>
                                                                    <option value="<?= $data_d->id_dapur ?>"><?= $data_d->nama_dapur ?></option>
                                                                <?php } ?>
                                                                <option value="0">SEMUA DAPUR</option>
                                                            </select>
                                                              <div class="col-md-6">
                                                              <label>Kategori Bahan</label>
                                                            <select name="id_kategori" id="" class="form-control" required>
                                                                <option value="" selected disabled>-- PILIH KATEGORI --</option>
                                                                <?php foreach ($katbahan as $data_k) { ?>
                                                                    <option value="<?= $data_k->id_kategori ?>"><?= $data_k->nama_kategori ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            </div>
                                                              <div class="col-md-6">
                                                                <label>Bulan</label>
                                                                <input class="form-control" required type="month" name="bulan">
                                                              </div>  
                                                          </div>
                                                        </div>
                                                      <div class="form-group">
                                                          <button type="submit" class="btn btn-block btn-warning"><i class="far fa-eye"></i> Lihat Laporan</button>
                                                      </div>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                  </div>
              </div>
          </div>
      </div>