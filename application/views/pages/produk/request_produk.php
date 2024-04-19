      <!-- Main Content -->
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <h1>Data Request Produk</h1>
                  <div class="section-header-breadcrumb">
                      <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
                      <div class="breadcrumb-item"><a href="<?= base_url('request-produk') ?>">Request Produk</a></div>
                      <div class="breadcrumb-item">Data</div>
                  </div>
              </div>

              <div class="section-body">
                  <h2 class="section-title">Data Request Produk</h2>

              </div>
          </section>

          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <di class="card-header">
                          Data Request Produk
                      </di>
                      <div class="card-body">

                          <?php if ($this->session->userdata('role_id') == 4 || $this->session->userdata('role_id') == 1) { ?>
                              <!-- jika role id user yang login == 4 atau gudang maka tampilkan button tambah request -->
                              <button class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#tambah-data "><i class="fas fa-plus-circel"></i>Tambah Data</button>

                          <?php } ?>
                          <div class="flashdata" id="flashdata" onload="clearmy()">
                              <?= $this->session->flashdata('message'); ?>
                          </div>
                          <small class="text-danger"><?= form_error('id_produk') ?></small>
                          <small class="text-danger"><?= form_error('id_pemasok') ?></small>
                          <small class="text-danger"><?= form_error('jumlah') ?></small>
                          <small class="text-danger"> <?= form_error('tanggal_kirim') ?></small>
                          <small class="text-danger"><?= form_error('status') ?></small>
                          <div class="table-responsive">
                              <table id="request-produk" class="table table-bordered text-center" style="width:100%">
                                  <thead>

                                      <tr>
                                          <th>No</th>
                                          <th>Aksi</th>
                                          <th>Nama Produk</th>
                                          <th>Nama Pemasok</th>
                                          <th>Jumlah</th>
                                          <th>Tanggal Kirim</th>
                                          <th>Status</th>
                                      </tr>

                                  </thead>
                                  <tbody>

                                      <?php $n = 1;
                                        foreach ($request as $r) { ?>
                                          <tr>
                                              <td><?= $n; ?></td>
                                              <td>

                                                  <div class="btn-group">

                                                      <?php if ($this->session->userdata('role_id') != 3) { ?>
                                                          <!-- jika role id user == 4 atau gudang tampilkan button ini -->
                                                          <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $r->id_request_produk ?>"><i class="fas fa-trash-alt"></i></button>
                                                          <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $r->id_request_produk ?>"><i class="fas fa-edit"></i></button>

                                                      <?php } ?>

                                                      <?php if ($this->session->userdata('role_id') != 4 && $r->status != 5) { ?>
                                                          <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#konfirmasi<?= $r->id_request_produk ?>"><i class="fas fa-check-circle"></i> Konfirmasi</button>

                                                      <?php } else if ($this->session->userdata('role_id') == 1) { ?>
                                                          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#konfirmasi<?= $r->id_request_produk ?>"><i class="fas fa-check-circle"></i> Konfirmasi</button>

                                                      <?php } ?>

                                                      <?php if ($r->status == 4 && $this->session->userdata('role_id') == 4) { ?>
                                                          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#konfirmasi<?= $r->id_request_produk ?>"><i class="fas fa-check-circle"></i> Konfirmasi</button>

                                                      <?php } ?>
                                                  </div>


                                                  <!-- Modal -->
                                                  <div class="modal fade" id="hapus<?= $r->id_request_produk ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                          <div class="modal-content">
                                                              <div class="modal-header bg-danger">
                                                                  <h5 class="modal-title text-white" id="exampleModalLabel">Konfirmasi Hapus Data</h5>
                                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                  </button>
                                                              </div>
                                                              <div class="modal-body">
                                                                  <div class="alert alert-danger">
                                                                      <p>
                                                                          <b>Apakah anda yakin akan menghapus data ini ?</b>
                                                                      </p>
                                                                      <p>
                                                                          <b class="text-dark text-center"><?= $r->nama_produk ?> | <?= $r->nama_pemasok ?></b>
                                                                      </p>
                                                                  </div>
                                                              </div>
                                                              <div class="modal-footer">
                                                                  <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
                                                                  <a href="<?= base_url('hapus-request-produk/') . $r->id_request_produk ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus Data</a>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>



                                                  <!-- Modal -->
                                                  <div class="modal fade" id="konfirmasi<?= $r->id_request_produk ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                          <div class="modal-content">
                                                              <div class="modal-header bg-warning">
                                                                  <h5 class="modal-title text-dark" id="exampleModalLabel">Konfirmasi Request Produk</h5>
                                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                  </button>
                                                              </div>
                                                              <div class="modal-body">
                                                                  <div class="alert alert-info">
                                                                      <p>
                                                                          <b>Konfrimasi Request Produk</b>
                                                                      </p>
                                                                      <p>
                                                                          <b><?= $r->nama_produk ?> | Jumlah : <?= $r->jumlah ?></b>
                                                                      </p>
                                                                  </div>
                                                                  <form action="<?= base_url('update-status/') . $r->id_request_produk ?>" method="post" enctype="multipart/form-data">

                                                                      <?php if ($this->session->userdata('role_id') != 4) { ?>
                                                                          <div class="form-group">
                                                                              <label for="stkr""><b>Konfirmasi Request</b></label>
                                                                            <select name=" status" id="stkr" class="form-control">
                                                                                  <option value="">-- PILIH KONFIRMASI REQUEST --</option>
                                                                                  <option value="0" <?= $r->status == '0' ? 'selected' : '' ?>>Stok Habis</option>
                                                                                  <option value="1" <?= $r->status == '1' ? 'selected' : '' ?>>Menunggu Konfirmasi</option>
                                                                                  <option value="2" <?= $r->status == '2' ? 'selected' : '' ?>>Dikonfirmasi</option>
                                                                                  <option value="3" <?= $r->status == '3' ? 'selected' : '' ?>>Menunggu Dikirim</option>
                                                                                  <option value="4" <?= $r->status == '4' ? 'selected' : '' ?>>Dikirim</option>

                                                                                  <?php if ($this->session->userdata('role_id') == 1) { ?>
                                                                                      <option value="5" <?= $r->status == '5' ? 'selected' : '' ?>>Diterima</option>

                                                                                  <?php } ?>
                                                                                  </select>
                                                                          </div>

                                                                      <?php } else if ($this->session->userdata('role_id') == 4 && $r->status == 4) { ?>
                                                                          <div class="form-group">
                                                                              <label for="stkr""><b>Konfirmasi Request</b></label>
                                                                            <select name=" status" id="stkr" class="form-control">
                                                                                  <option value="">-- PILIH KONFIRMASI REQUEST --</option>
                                                                                  <option value="5" <?= $r->status == '5' ? 'selected' : '' ?>>Diterima</option>
                                                                                  </select>
                                                                          </div>

                                                                      <?php } ?>
                                                                      <div class="form-group">
                                                                          <button class="btn btn-success btn-sm" type="submit">Simpan</button>
                                                                      </div>
                                                                  </form>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>



                                              </td>



                                              <!-- Modal Edit-->
                                              <div class="modal fade" id="edit<?= $r->id_request_produk ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog">
                                                      <div class="modal-content">
                                                          <div class="modal-header bg-warning">
                                                              <h5 class="modal-title text-white" id="exampleModalLabel">Edit data request</h5>
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                              </button>
                                                          </div>
                                                          <div class="modal-body">
                                                              <div class="row">
                                                                  <div class="col-lg-12">
                                                                      <form action="<?= base_url('edit-request-produk/') . $r->id_request_produk ?>" method="post" enctype="multipart/form-data">
                                                                          <div class="form-group">
                                                                              <label for="">Data Produk</label>
                                                                              <select name="id_produk" id="" class="form-control">
                                                                                  <option value="" selected disabled>-- PILIH PRODUK --</option>

                                                                                  <?php foreach ($produk as $dp) { ?>
                                                                                      <option value="<?= $dp->id_produk ?>" <?= $dp->id_produk == $r->id_produk ? 'selected' : '' ?>><?= $dp->nama_produk ?> | <?= $dp->kode_produk ?></option>

                                                                                  <?php } ?>
                                                                              </select>
                                                                          </div>
                                                                          <div class="form-group">
                                                                              <label for="">Data Produk</label>
                                                                              <select name="id_pemasok" id="" class="form-control">
                                                                                  <option value="" selected disabled>-- PILIH PEMASOK --</option>

                                                                                  <?php foreach ($pemasok as $pp) { ?>
                                                                                      <option value="<?= $pp->id_produk ?>" <?= $pp->id_produk == $r->id_produk ? 'selected' : '' ?>><?= $pp->nama_pemasok ?> | <?= $pp->nama_produk ?> - <?= $pp->kode_produk ?></option>

                                                                                  <?php } ?>
                                                                              </select>
                                                                          </div>
                                                                          <div class="form-group">
                                                                              <label for="">Jumlah</label>
                                                                              <input type="number" name="jumlah" value="<?= $r->jumlah ?>" id="" class="form-control">
                                                                          </div>
                                                                          <div class="form-group">
                                                                              <label for="">Tanggal Kirim</label>
                                                                              <input type="date" name="tanggal_kirim" value="<?= $r->tanggal_kirim ?>" class="form-control">
                                                                          </div>
                                                                          <div class="form-group">
                                                                              <button class="btn btn-success btn-sm" type="sumbit">Simpan</button>
                                                                          </div>
                                                                      </form>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>



                                              <td>
                                                  <?= $r->nama_produk ?>
                                              </td>
                                              <td>
                                                  <?= $r->nama_pemasok ?>
                                              </td>
                                              <td>
                                                  <?= $r->jumlah ?>
                                              </td>
                                              <td>
                                                  <?= $r->tanggal_kirim ?>
                                              </td>
                                              <td>

                                                  <?php

                                                    if ($r->status == 0) {
                                                        echo '<span class="badge badge-dark">Stok Habis</span>';
                                                    } else if ($r->status == 1) {
                                                        echo '<span class="badge badge-danger">Menunggu Dikonfirmasi</span>';
                                                    } else if ($r->status == 2) {
                                                        echo '<span class="badge badge-warning">Dikonfirmasi</span>';
                                                    } else if ($r->status == 3) {
                                                        echo '<span class="badge badge-primary">Menunggu Dikirim</span>';
                                                    } else if ($r->status == 4) {
                                                        echo '<span class="badge badge-info">Dikirim</span>';
                                                    } else if ($r->status == 5) {
                                                        echo '<span class="badge badge-success">Diterima</span>';
                                                    } else {
                                                        echo '<span class="badge badge-danger">Not Found !</span>';
                                                    }

                                                    ?>
                                              </td>
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

          <!-- Modal -->
          <div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header bg-success">
                          <h5 class="modal-title text-white" id="exampleModalLabel">Tambah data request</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-lg-12">
                                  <form action="<?= base_url('tambah-request-produk') ?>" method="post" enctype="multipart/form-data">
                                      <div class="form-group">
                                          <label for="">Data Produk</label>
                                          <select name="id_produk" id="" class="form-control">
                                              <option value="" selected disabled>-- PILIH PRODUK --</option>

                                              <?php foreach ($produk as $dp) { ?>
                                                  <option value="<?= $dp->id_produk ?>"><?= $dp->nama_produk ?> | <?= $dp->kode_produk ?></option>

                                              <?php } ?>
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <label for="">Data Produk</label>
                                          <select name="id_pemasok" id="" class="form-control">
                                              <option value="" selected disabled>-- PILIH PEMASOK --</option>

                                              <?php foreach ($pemasok as $pp) { ?>
                                                  <option value="<?= $pp->id_produk ?>"><?= $pp->nama_pemasok ?> | <?= $pp->nama_produk ?> - <?= $pp->kode_produk ?></option>

                                              <?php } ?>
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <label for="">Jumlah</label>
                                          <input type="number" name="jumlah" id="" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <label for="">Tanggal Kirim</label>
                                          <input type="date" name="tanggal_kirim" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <button class="btn btn-success btn-sm" type="sumbit">Simpan</button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>


      </div>