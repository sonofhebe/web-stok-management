<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Stok</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
                <div class="breadcrumb-item">Data Stok <?= $this->session->userdata('nama_dapur') ?></div>
            </div>
        </div>
    </section>

    </script>

    <div class="row">
        <div class="col-lg-12">
            <h5>Data Stok di <br>"<?= $this->session->userdata('nama_dapur') ?>"</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-bordered text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori Bahan</th>
                                <th>Bahan</th>
                                <th>Stok</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $n = 1;
                            foreach ($stok as $data) { ?>
                                <tr>
                                    <td><?= $n; ?></td>
                                    <td><?= $data->nama_kategori ?></td>
                                    <td><?= $data->nama_bahan ?></td>
                                    <td><?= $data->jumlah ?></td>
                                    <td><?= $data->nama_satuan ?></td>
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