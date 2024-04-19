<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Stok Dapur</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
                <div class="breadcrumb-item">Stok Dapur</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Stok Dapur</h2>
        </div>
    </section>



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="flashdata" id="flashdata" onload="clearmy()">
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Dapur</th>
                                    <th>Status Dapur</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $n = 1;
                                foreach ($dapur as $data) { ?>
                                    <tr>
                                        <td><?= $n; ?></td>
                                        <td><?= $data->nama_dapur ?></td>
                                        <td><span class="badge badge-<?= $data->is_active_dapur == 1 ? 'success' : 'danger' ?>"><?= $data->is_active_dapur == 1 ? 'Aktif' : 'Tidak Aktif' ?></span></td>
                                        <td>
                                            <div class="btn-group">
                                                <form action="<?= base_url('inputsession-stok') ?>" method="post">
                                                    <input type="hidden" id="idd" name="idd" value="<?= $data->id_dapur ?>">
                                                    <input type="submit" class="btn btn-warning btn-sm" value="Lihat Stok">
                                                </form>
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
</div>