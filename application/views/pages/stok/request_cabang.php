      <!-- Main Content -->
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <h1>Request Bahan</h1>
                  <div class="section-header-breadcrumb">
                      <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
                      <div class="breadcrumb-item">Request Bahan</div>
                  </div>
              </div>
          </section>

          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">
                          <div class="col-lg-3">
                              <div class="form-group">
                                  <form action="<?= base_url('request-cabang') ?>" method="post" enctype="multipart/form-data">
                                      <label for="tgl">Tanggal</label>
                                      <input type="date" value="<?= $tgl ?>" name="tanggal" id="tgl" class="form-control" max="<?= date('Y-m-d'); ?>">
                                      <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                                  </form>
                              </div>
                          </div>
                          <button class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#tambahkeluar"><i class="fas fa-plus-circel"></i>Request Bahan</button>
                      </div>
                      <div class="flashdata" id="flashdata" onload="clearmy()">
                          <?= $this->session->flashdata('message'); ?>
                      </div>
                      <div class="table-responsive">
                          <table id="table" class="table table-bordered text-center" style="width:100%">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Nama Bahan</th>
                                      <th>Jumlah</th>
                                      <th>Harga</th>
                                      <th>Status</th>
                                      <th>Tanggal</th>
                                      <th>Aksi</th>
                                  </tr>
                              </thead>
                              <tbody>

                                  <?php $n = 1;
                                    foreach ($req as $r) { ?>
                                      <tr>
                                          <td><?= $n; ?></td>
                                          <td><?= $r->nama_bahan ?></td>
                                          <td><?= $r->jumlah ?> <?= $r->nama_satuan ?></td>
                                          <td>Rp. <?= number_format($r->total_harga, 0, ".", ".") ?></td>
                                          <td>
                                              <?php if ($r->status == 'Tunggu') {
                                                ?><span class="badge badge-warning">Tunggu</span></td>
                                      <?php
                                                } else {
                                        ?><span class="badge badge-success">Dikirim</span></td>
                                      <?php
                                                } ?>
                                      <td><?= $r->tanggal ?></td>
                                      <td>
                                          <?php if ($r->status == 'Tunggu') {
                                            ?><button class="btn btn-danger btn-sm mb-2" data-toggle="modal" data-target="#hapus<?= $r->id_req ?>"><i class="fas fa-trash-alt"></i> Batal</button>
                                          <?php
                                            } else {
                                            ?><span class="badge badge-success">Selesai</span></td>
                                  <?php
                                            } ?>

                                  </td>

                                  <!-- Modal Hapus -->
                                  <div class="modal fade" id="hapus<?= $r->id_req ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header bg-danger">
                                                  <h5 class="modal-title text-white" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                              </div>
                                              <div class="modal-body">
                                                  <div class="alert alert-warning text-center" role="alert">

                                                      <p><b>Apakah anda yakin membatalkan request bahan ini ?</b></p>
                                                      <b class="text-dark"><?= $r->nama_bahan ?></b>

                                                  </div>
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
                                                  <a href="<?= base_url('hapus-request/') . $r->id_req ?>" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus Data</a>
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
      <div class="modal fade" id="tambahkeluar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header bg-success">
                      <h5 class="modal-title text-white" id="exampleModalLabel">Request Bahan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="rpw">
                          <div class="col-lg-12">
                              <form action="<?= base_url('tambah-request') ?>" method="post" enctype="multipart/form-data">
                                  <div class="form-group">
                                      <label>Pilih Bahan</label>
                                      <select name="id_bahan" class="form-control" required>
                                          <option value="" selected disabled>-- PILIH BAHAN --</option>

                                          <?php foreach ($bahan as $p) { ?>
                                              <option value="<?= $p->id_bahan ?>"><?= $p->nama_kategori ?> : <?= $p->nama_bahan ?></option>

                                          <?php } ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label for="sc">Jumlah</label>
                                      <input type="number" name="jumlah" id="jml" class="form-control" required>
                                      <input type="hidden" name="status" id="jml" class="form-control" value="Tunggu" required>
                                  </div>
                                  <div class="form-group">
                                      <input type="date" value="<?= $tgl ?>" name="tanggal" id="tgl" class="form-control" readonly>
                                  </div>
                                  <div class="form-group">
                                      <button class="btn btn-success btn-sm" type="submit">Input data</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      </div>