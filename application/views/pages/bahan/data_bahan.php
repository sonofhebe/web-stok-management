<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data bahan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
                <div class="breadcrumb-item">Data Bahan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Data bahan</h2>
        </div>
    </section>



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                  <?php if ($this->session->userdata('role_id') == 1) { ?>
                    <button class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#tambahbahan"><i class="fas fa-plus-circel"></i>Tambah Data</button>
                        <?php } ?>
                    <div class="flashdata" id="flashdata" onload="clearmy()">
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Nama</th>
                                    <th>Stok Dapur Utama</th>
                                    <th>Harga Jual</th>
                  <?php if ($this->session->userdata('role_id') == 1) { ?>
                                    <th>Aksi</th>
                        <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $n = 1;
                                  foreach ($bahan as $data) { ?>
                                    <tr>
                                        <td><?= $n; ?></td>

                                        <!-- Modal Modal -->
                                        <div class="modal fade" id="hapus<?= $data->id_bahan ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="alert alert-warning text-center text-dark">
                                                            <b>JANGAN HAPUS JIKA MASIH MEMBUTUHKAN DATA INI ! KARNA SEMUA DATA YANG BERKAITAN DENGAN <?= $data->nama_bahan ?> AKAN TERHAPUS, SEPERTI (LAPORAN, STOK, DLL)</b>
                                                            <p><b>Apakah anda yakin akan menghapus data ini ?</b></p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
                                                        <a href="<?= base_url('hapus-bahan/') . $data->id_bahan ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus Data</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="edit<?= $data->id_bahan ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data bahan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <form action="<?= base_url('edit-bahan/') . $data->id_bahan ?>" method="post" enctype="multipart/form-data">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="">Detail</label>
                                                                            <div class="form-group">
                                                                                <label for="">Nama bahan</label>
                                                                                <input type="text" name="nama_bahan" value="<?= $data->nama_bahan ?>" class="form-control" required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="">Kategori</label>
                                                                                <select name="id_kategori" id="" class="form-control" required>
                                                                                    <option value="" selected disabled>-- PILIH KATEGORI --</option>
                                                                                    <?php foreach ($kategori as $data_k) { ?>
                                                                                        <option value="<?= $data_k->id_kategori ?>" <?= $data_k->id_kategori == $data->id_kategori ? 'selected' : '' ?>><?= $data_k->nama_kategori ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="">Stok bahan</label>
                                                                                <input type="number" name="stok" value="<?= $data->stok ?>" class="form-control" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="">Jual</label>
                                                                            <div class="form-group">
                                                                                <label for="">Harga bahan</label>
                                                                                <input type="number" name="harga" value="<?= $data->harga ?>" class="form-control" required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="">Per</label>
                                                                                <input type="number" name="per" value="<?= $data->per ?>" class="form-control" required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="">Satuan</label>
                                                                                <select name="id_satuan" id="" class="form-control" required>
                                                                                    <option value="" selected disabled>-- PILIH SATUAN --</option>
                                                                                    <?php foreach ($satuan as $data_s) { ?>
                                                                                        <option value="<?= $data_s->id_satuan ?>" <?= $data_s->id_satuan == $data->id_satuan ? 'selected' : '' ?>><?= $data_s->nama_satuan ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <button class="btn btn-success btn-sm" type="submit">Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <td><?= $data->nama_kategori ?></td>
                                        <td><?= $data->nama_bahan ?></td>
                                        <td><?= $data->stok ?> <?= $data->nama_satuan ?></td>
                                        <td>Rp. <?= number_format($data->harga, 0, ".", ".") ?> / <?= $data->per ?> <?= $data->nama_satuan ?></td>
                  <?php if ($this->session->userdata('role_id') == 1) { ?>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data->id_bahan ?>"><i class="fas fa-trash-alt"></i></button>
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $data->id_bahan ?>"><i class="fas fa-edit"></i></button>
                                            </div>
                                        </td>
                        <?php } ?>
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
    <div class="modal fade" id="tambahbahan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Data bahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?= base_url('tambah-bahan') ?>" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Detail</label>
                                        <div class="form-group">
                                            <label for="">Nama bahan</label>
                                            <input type="text" name="nama_bahan" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kategori</label>
                                            <select name="id_kategori" id="" class="form-control" required>
                                                <option value="" selected disabled>-- PILIH KATEGORI --</option>
                                                <?php foreach ($kategori as $data_k) { ?>
                                                    <option value="<?= $data_k->id_kategori ?>"><?= $data_k->nama_kategori ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Stok bahan</label>
                                            <input type="number" name="stok" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Jual</label>
                                        <div class="form-group">
                                            <label for="">Harga</label>
                                            <input type="number" name="harga" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Per</label>
                                            <input type="number" name="per" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Satuan</label>
                                            <select name="id_satuan" id="" class="form-control" required>
                                                <option value="" selected disabled>-- PILIH SATUAN --</option>
                                                <?php foreach ($satuan as $data_s) { ?>
                                                    <option value="<?= $data_s->id_satuan ?>"><?= $data_s->nama_satuan ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success btn-sm" type="submit">Simpan</button>
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