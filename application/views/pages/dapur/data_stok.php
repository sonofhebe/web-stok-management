<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Stok</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="<?= base_url('stok') ?>">Stok</a></div>
                <div class="breadcrumb-item">Data Stok</div>
            </div>
        </div>
    </section>

    </script>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <?php foreach ($dapur as $data) { ?>
                    <h5>Data Stok di <br>"<?= $data->nama_dapur ?>"</h5>

                <?php } ?>
                <div class="card-body">
                    <div class="flashdata" id="flashdata" onload="clearmy()">
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori Bahan</th>
                                    <th>Bahan</th>
                                    <th>Stok</th>
                                    <th>Satuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $n = 1;
                                foreach ($stok as $data) { ?>
                                    <tr>
                                        <td><?= $n; ?></td>
                                        <!-- Modal Modal -->
                                        <div class="modal fade" id="hapus<?= $data->id_stok ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="alert alert-warning text-center text-dark">
                                                            <p><b>Apakah anda yakin akan menghapus bahan ini ?</b></p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
                                                        <a href="<?= base_url('hapus-stok/') . $data->id_stok ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus Data</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <td><?= $data->nama_kategori ?></td>
                                        <td><?= $data->nama_bahan ?></td>
                                        <td><?= $data->jumlah ?></td>
                                        <td><?= $data->nama_satuan ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data->id_stok ?>"><i class="fas fa-trash-alt"></i></button>
                                            </div>
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



    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahstok" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Bahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('tambah-stok') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_dapur" class="form-control" value="<?= $data->id_dapur ?>">
                        <div class="form-group">
                            <label for="">Bahan</label>
                            <select name="id_bahan" id="" class="form-control" required>
                                <option value="" selected disabled>-- PILIH BAHAN --</option>

                                <?php foreach ($bahan as $data_b) { ?>]
                                <option value="<?= $data_b->id_bahan ?>"><?= $data_b->nama_kategori ?> : <?= $data_b->nama_bahan ?></option>

                            <?php } ?>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-sm" type="submit">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>


</div>