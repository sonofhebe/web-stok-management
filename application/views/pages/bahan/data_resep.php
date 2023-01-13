<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Resep</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="<?= base_url('data-produk') ?>">Data Produk</a></div>
                <div class="breadcrumb-item">Data Resep</div>
            </div>
        </div>
    </section>

</script>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                        <?php foreach ($produk as $data) { ?>
                            <h5>Resep Produk <br>"<?= $data->nama_produk ?>"</h5>
                        <?php } ?>
                  <?php if ($this->session->userdata('role_id') == 1) { ?>
                    <button class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#tambahresep"><i class="fas fa-plus-circel"></i>Tambah Resep</button>
                        <?php } ?>
                    <div class="flashdata" id="flashdata" onload="clearmy()">
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                    <div class="table-responsive">
                        <table id="resep" class="table table-bordered text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Takaran/Bahan</th>
                                    <th>Jumlah Per SC</th>
                                    <th>Satuan</th>
                  <?php if ($this->session->userdata('role_id') == 1) { ?>
                                    <th>Aksi</th>
                        <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $n = 1;
                                  foreach ($resep as $data) { ?>
                                    <tr>
                                        <td><?= $n; ?></td>

                                        <!-- Modal Modal -->
                                        <div class="modal fade" id="hapus<?= $data->id_resep ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        <a href="<?= base_url('hapus-resep/') . $data->id_resep ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus Data</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="edit<?= $data->id_resep ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit resep</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <form action="<?= base_url('edit-resep/') . $data->id_resep ?>" method="post" enctype="multipart/form-data">
                                                                <label for="">Takaran/Bahan</label>
                                                                    <input type="text" name="nama_produk" class="form-control" value="<?= $data->nama_takaran ?>" disabled>
                                                                    <div class="form-group">
                                                                <label for="">Jumlah Per SC</label>
                                                                    <input type="number" name="jumlah" value="<?= $data->jumlah ?>" class="form-control" required>
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
                                            </div>
                                        <td><?= $data->nama_kategori ?></td>
                                        <td><?= $data->nama_takaran ?></td>
                                        <td><?= $data->jumlah ?></td>
                                        <td><?= $data->nama_satuan ?></td>
                  <?php if ($this->session->userdata('role_id') == 1) { ?>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data->id_resep ?>"><i class="fas fa-trash-alt"></i></button>
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $data->id_resep ?>"><i class="fas fa-edit"></i></button>
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
    <div class="modal fade" id="tambahresep" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Data resep</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                            <form action="<?= base_url('tambah-resep')?>" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id_produk" class="form-control" value="<?= $data->id_produk ?>">
                                        <div class="form-group">
                                            <label for="">Takaran/Bahan</label>
                                            <select name="id_takaran" id="" class="form-control" required>
                                                <option value="" selected disabled>-- PILIH TAKARAN --</option>
                                                <?php foreach ($takaran as $data_b) { ?>]
                                                    <option value="<?= $data_b->id_takaran ?>"><?= $data_b->nama_kategori ?> : <?= $data_b->nama_takaran?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jumlah Per SC</label>
                                            <input type="number" name="jumlah" class="form-control" required>
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