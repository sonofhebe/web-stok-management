      <!-- Main Content -->
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <h1>Drop Stok</h1>
                  <div class="section-header-breadcrumb">
                      <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
                      <div class="breadcrumb-item"><a href="<?= base_url('drop-stok') ?>">Drop Stok</a></div>
                      <div class="breadcrumb-item">Data</div>
                  </div>
              </div>
          </section>

          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">
                      <div class="col-lg-4">
                      <?php if ($this->session->userdata('role_id') == 1) { ?>
                      <div class="form-group">
                            <form action="<?= base_url('drop-stok') ?>" method="post" enctype="multipart/form-data">
                                <label for="tgl">Tanggal</label>
                                <input name="tanggal" id="tgl" value="<?= $tgl ?>" class="form-control" type="date"> 
                                <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                            </form>
                            </div>
                      <?php } else if ($this->session->userdata('role_id') == 2) { ?>
                      <div class="form-group">
                            <form action="<?= base_url('bahan-masuk') ?>" method="post" enctype="multipart/form-data">
                                <label for="tgl">Tanggal</label>
                                <input name="tanggal" id="tgl" value="<?= $tgl ?>" class="form-control" type="date"> 
                                <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                            </form>
                            </div>
                        <?php } ?>
                      </div>
                      <?php if ($this->session->userdata('role_id') == 1) { ?>
                      <button class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#tambahmasuk"><i class="fas fa-plus-circel"></i>Drop Stok Manual</button>
                        <?php $this->db->where('status = "Tunggu"');
                            $notif = $this->db->get('req')->num_rows();
                            ?>
                            <?php if ($notif > 0) { ?>
                                <button class="btn btn-danger btn-sm mb-2" onclick="document.location='<?= base_url('request') ?>'">Lihat Request : <?= $notif ?></button>
                                <?php } ?>
                        <?php } ?>

                          <div class="flashdata" id="flashdata" onload="clearmy()">
                              <?= $this->session->flashdata('message'); ?>
                          </div>
                          
                          <div class="table-responsive">
                              <table id="table" class="table table-bordered text-center" style="width:100%">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Dapur Tujuan</th>
                                          <th>Nama Bahan</th>
                                          <th>Jumlah</th>
                                          <th>Total Harga</th>
                                          <th>Tanggal</th>
                      <?php if ($this->session->userdata('role_id') == 1) { ?>
                                          <th>Aksi</th>
                        <?php } ?>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $n = 1;
                                        foreach ($data_masuk as $masuk) { ?>
                                          <tr>
                                              <td><?= $n; ?></td>
                                              <td><?= $masuk->nama_dapur ?></td>
                                              <td><?= $masuk->nama_bahan ?></td>
                                              <td><?= $masuk->jumlah ?> <?= $masuk->nama_satuan ?></td>
                                              <td>Rp. <?= number_format($masuk->total_harga, 0, ".", ".") ?></td>
                                              <td><?= $masuk->tanggal ?></td>
                      <?php if ($this->session->userdata('role_id') == 1) { ?>
                                              <td>
                                                  <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $masuk->id_drop_stok ?>"><i class="fas fa-trash-alt"></i></button>
                                              </td>
                        <?php } ?>

                                              <!-- Modal Hapus -->
                                              <div class="modal fade" id="hapus<?= $masuk->id_drop_stok ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog">
                                                      <div class="modal-content">
                                                          <div class="modal-header bg-danger">
                                                              <h5 class="modal-title text-white" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                                          </div>
                                                          <div class="modal-body">
                                                              <div class="alert alert-warning text-center" role="alert">

                                                                  <p><b>Apakah anda yakin ingin menghapus data ini ?</b></p>
                                                                  <b class="text-dark"><?= $masuk->nama_bahan ?></b>

                                                              </div>
                                                          </div>
                                                          <div class="modal-footer">
                                                              <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
                                                              <a href="<?= base_url('hapus-drop-stok/') . $masuk->id_drop_stok ?>" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus Data</a>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
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


          <!-- Modal Tambah -->
          <div class="modal fade" id="tambahmasuk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header bg-success">
                          <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Data Masuk</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="rpw">
                              <div class="col-lg-12">
                                  <form action="<?= base_url('tambah-drop-stok') ?>" method="post" enctype="multipart/form-data">
                                  <div class="form-group">
                                          <label for="pk">Pilih Dapur</label>
                                          <select name="id_dapur" id="ds" class="form-control" required>
                                              <option value="" selected disabled>-- PILIH DAPUR --</option>
                                              <?php foreach ($dapur as $dpr) { ?>
                                                  <option value="<?= $dpr->id_dapur ?>"><?= $dpr->nama_dapur ?></option>
                                              <?php } ?>
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <label for="pk">Pilih Bahan</label>
                                          <select name="id_bahan" id="ds" class="form-control" required>
                                              <option value="" selected disabled>-- PILIH BAHAN --</option>
                                              <?php foreach ($bahan as $bhn) { ?>
                                                  <option value="<?= $bhn->id_bahan ?>"><?= $bhn->nama_kategori ?> : <?= $bhn->nama_bahan ?> (<?= $bhn->nama_satuan ?>)</option>
                                              <?php } ?>
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <label for="jml">Jumlah</label>
                                          <input type="number" name="jumlah" id="jml" class="form-control" required>
                                      </div>
                                      <div class="form-group">
                                          <label for="tgl">Tanggal</label>
                                          <input type="text" name="tanggal" value="<?= $tgl ?>" id="tgl" class="form-control" readonly>
                                      </div>
                                      <div class="form-group">
                                          <button class="btn btn-success btn-sm" type="submit">Simpan</button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

      </div>