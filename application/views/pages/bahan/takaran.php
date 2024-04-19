<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Takaran</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
                <div class="breadcrumb-item">Data Takaran</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Data Takaran</h2>
        </div>
    </section>



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <?php if ($this->session->userdata('role_id') == 1) { ?>
                        <button class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#tambahtakaran"><i class="fas fa-plus-circel"></i>Tambah Data</button>

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
                                    <th>Nama Takaran</th>
                                    <th>Bahan Dasar</th>
                                    <th>Satuan</th>

                                    <?php if ($this->session->userdata('role_id') == 1) { ?>
                                        <th>Aksi</th>

                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $n = 1;
                                foreach ($takaran as $data) { ?>
                                    <tr>
                                        <td><?= $n; ?></td>

                                        <!-- Modal Modal -->
                                        <div class="modal fade" id="hapus<?= $data->id_takaran ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="alert alert-warning text-center text-dark">
                                                            <p><b>Apakah anda yakin akan menghapus data ini ?</b></p>
                                                            <b><?= $data->nama_takaran ?></b>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
                                                        <a href="<?= base_url('hapus-takaran/') . $data->id_takaran ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus Data</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="edit<?= $data->id_takaran ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data takaran</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <form action="<?= base_url('edit-takaran/') . $data->id_takaran ?>" method="post" enctype="multipart/form-data">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label for="">Detail</label>
                                                                            <div class="form-group">
                                                                                <label for="">Nama takaran</label>
                                                                                <input type="text" name="nama_takaran" value="<?= $data->nama_takaran ?>" class="form-control" required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="">Bahan Dasar</label>
                                                                                <select name="id_bahan" id="" class="form-control" required>
                                                                                    <option value="" selected disabled>-- PILIH BAHAN --</option>

                                                                                    <?php foreach ($bahan as $b) { ?>
                                                                                        <option value="<?= $b->id_bahan ?>" <?= $b->id_bahan == $data->id_bahan ? 'selected' : '' ?>><?= $b->nama_kategori ?> : <?= $b->nama_bahan ?></option>

                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <button class="btn btn-success btn-sm" type="submit">Simpan</button>
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


                                        <td><?= $data->nama_kategori ?></td>
                                        <td><?= $data->nama_takaran ?></td>
                                        <td><?= $data->nama_bahan ?></td>
                                        <td><?= $data->nama_satuan ?></td>

                                        <?php if ($this->session->userdata('role_id') == 1) { ?>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data->id_takaran ?>"><i class="fas fa-trash-alt"></i></button>
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $data->id_takaran ?>"><i class="fas fa-edit"></i></button>
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
    <div class="modal fade" id="tambahtakaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Data takaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?= base_url('tambah-takaran') ?>" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Detail</label>
                                        <div class="form-group">
                                            <label for="">Nama takaran</label>
                                            <input type="text" name="nama_takaran" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Bahan Dasar</label>
                                            <select name="id_bahan" id="" class="form-control" required>
                                                <option value="" selected disabled>-- PILIH BAHAN --</option>

                                                <?php foreach ($bahan as $b) { ?>
                                                    <option value="<?= $b->id_bahan ?>"><?= $b->nama_kategori ?> : <?= $b->nama_bahan ?></option>

                                                <?php } ?>
                                            </select>
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