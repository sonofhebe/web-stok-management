<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <?php if ($this->session->userdata('role_id') == 1) { ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-dark"><b>Welcome Muara 1 Prima</b></h5>
                    </div>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Request Belum direspon</h4>
                            </div>
                            <div class="card-body">
                                <?= $request ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                        <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Produk Terjual</h4>
                            </div>
                            <div class="card-body">
                                <?= $penjualan ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                        <i class="fas fa-utensils"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Produk</h4>
                            </div>
                            <div class="card-body">
                                <?= $produk ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                        <i class="fas fa-building"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Dapur Cabang</h4>
                            </div>
                            <div class="card-body">
                                <?= $dapur ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                    <div class="section-header">
                        <div class="card-body rounded-0">
                            <h6><b>Data Stok Bahan Baku Menipis</b></h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table id="cek-stok" class="table table-bordered text-center" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Bahan</th>
                                                    <th>Satuan</th>
                                                    <th>Harga</th>
                                                    <th>Stok</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $n = 1;
                                                foreach ($cekstok as $data) { ?>
                                                    <tr>
                                                        <td><?= $n; ?></td>
                                                        <td><?= $data->nama_bahan ?></td>
                                                        <td><?= $data->nama_satuan ?></td>
                                                        <td>Rp. <?= number_format($data->harga, 0, ".", ".") ?> / <?= $data->per ?> <?= $data->nama_satuan ?></td>
                                                        <td><span class="badge badge-danger"><?= $data->stok ?></span></td>
                                                    </tr>
                                                <?php $n++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            

                            <h6><b>Produk terlaris 1 minggu lalu</b></h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table id="cek-stok" class="table table-bordered text-center" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Kategori</th>
                                                    <th>Nama Bahan</th>
                                                    <th>Terjual</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                foreach ($katproduk as $data) { ?>
                                                    <tr>
                                                        <td><?= $data->nama_kategoriproduk ?></td>
                                                        <?php 
                                                        $this->db->select('sum(jumlah) as tot, nama_produk');
                                                        $this->db->group_by('penjualan.id_produk'); 
                                                        $this->db->join('produk', 'produk.id_produk=penjualan.id_produk');
                                                        $this->db->join('kategoriproduk', 'kategoriproduk.id_kategoriproduk=produk.id_kategoriproduk');
                                                        $this->db->where('produk.id_kategoriproduk', $data->id_kategoriproduk);
                                                        $this->db->where('tanggal BETWEEN SYSDATE() - INTERVAL 1 WEEK AND SYSDATE()');
                                                        $this->db->order_by('sum(jumlah)', 'DESC');
                                                        $this->db->limit(1);
                                                        $produk = $this->db->get('penjualan')->result();
                                                        foreach ($produk as $p){?>
                                                            <td><?= $p->nama_produk ?></td>
                                                        <td><span class="badge badge-success"><?= $p->tot ?></span></td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        <h6><b>Produk terlaris 1 bulan lalu</b></h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table id="cek-stok" class="table table-bordered text-center" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Kategori</th>
                                                    <th>Nama Bahan</th>
                                                    <th>Terjual</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($katproduk as $data) { ?>
                                                    <tr>
                                                        <td><?= $data->nama_kategoriproduk ?></td>
                                                        <?php 
                                                        $this->db->select('sum(jumlah) as tot, nama_produk');
                                                        $this->db->group_by('penjualan.id_produk'); 
                                                        $this->db->join('produk', 'produk.id_produk=penjualan.id_produk');
                                                        $this->db->join('kategoriproduk', 'kategoriproduk.id_kategoriproduk=produk.id_kategoriproduk');
                                                        $this->db->where('produk.id_kategoriproduk', $data->id_kategoriproduk);
                                                        $this->db->where('tanggal BETWEEN SYSDATE() - INTERVAL 1 month AND SYSDATE()');
                                                        $this->db->order_by('sum(jumlah)', 'DESC');
                                                        $this->db->limit(1);
                                                        $produk = $this->db->get('penjualan')->result();
                                                        foreach ($produk as $p){?>
                                                            <td><?= $p->nama_produk ?></td>
                                                        <td><span class="badge badge-success"><?= $p->tot ?></span></td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        <?php } else if ($this->session->userdata('role_id') == 2) { ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-dark"><b>Welcome <?= $namadapur->nama_dapur ?></b></h5>
                    </div>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Request Belum direspon</h4>
                            </div>
                            <div class="card-body">
                                <?= $requestc ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                        <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Produk Terjual</h4>
                            </div>
                            <div class="card-body">
                                <?= $penjualanc ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                        <i class="fas fa-utensils"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Produk</h4>
                            </div>
                            <div class="card-body">
                                <?= $produk ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                        <i class="fas fa-building"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Dapur Cabang</h4>
                            </div>
                            <div class="card-body">
                                <?= $dapur ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                    <div class="section-header">
                        <div class="card-body rounded-0">
                            <h6><b>Data Stok Bahan Baku <?= $namadapur->nama_dapur ?> Menipis</b></h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table id="cek-stok" class="table table-bordered text-center" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Bahan</th>
                                                    <th>Satuan</th>
                                                    <th>Harga</th>
                                                    <th>Stok</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $n = 1;
                                                foreach ($cekstokc as $data) { ?>
                                                    <tr>
                                                        <td><?= $n; ?></td>
                                                        <td><?= $data->nama_bahan ?></td>
                                                        <td><?= $data->nama_satuan ?></td>
                                                        <td>Rp. <?= number_format($data->harga, 0, ".", ".") ?> / <?= $data->per ?> <?= $data->nama_satuan ?></td>
                                                        <td><span class="badge badge-danger"><?= $data->jumlah ?></span></td>
                                                    </tr>
                                                <?php $n++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            

                            <h6><b>Produk terlaris 1 minggu lalu</b></h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table id="cek-stok" class="table table-bordered text-center" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Kategori</th>
                                                    <th>Nama Bahan</th>
                                                    <th>Terjual</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($katproduk as $data) { ?>
                                                    <tr>
                                                        <td><?= $data->nama_kategoriproduk ?></td>
                                                        <?php 
                                                        $this->db->select('sum(jumlah) as tot, nama_produk');
                                                        $this->db->group_by('penjualan.id_produk'); 
                                                        $this->db->join('produk', 'produk.id_produk=penjualan.id_produk');
                                                        $this->db->join('kategoriproduk', 'kategoriproduk.id_kategoriproduk=produk.id_kategoriproduk');
                                                        $this->db->where('id_dapur', $this->session->userdata('id_dapur'));
                                                        $this->db->where('produk.id_kategoriproduk', $data->id_kategoriproduk);
                                                        $this->db->where('tanggal BETWEEN SYSDATE() - INTERVAL 1 WEEK AND SYSDATE()');
                                                        $this->db->order_by('sum(jumlah)', 'DESC');
                                                        $this->db->limit(1);
                                                        $produk = $this->db->get('penjualan')->result();
                                                        foreach ($produk as $p){?>
                                                            <td><?= $p->nama_produk ?></td>
                                                        <td><span class="badge badge-success"><?= $p->tot ?></span></td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        <h6><b>Produk terlaris 1 bulan lalu</b></h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table id="cek-stok" class="table table-bordered text-center" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Kategori</th>
                                                    <th>Nama Bahan</th>
                                                    <th>Terjual</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                foreach ($katproduk as $data) { ?>
                                                    <tr>
                                                        <td><?= $data->nama_kategoriproduk ?></td>
                                                        <?php 
                                                        $this->db->select('sum(jumlah) as tot, nama_produk');
                                                        $this->db->group_by('penjualan.id_produk'); 
                                                        $this->db->join('produk', 'produk.id_produk=penjualan.id_produk');
                                                        $this->db->join('kategoriproduk', 'kategoriproduk.id_kategoriproduk=produk.id_kategoriproduk');
                                                        $this->db->where('id_dapur', $this->session->userdata('id_dapur'));
                                                        $this->db->where('produk.id_kategoriproduk', $data->id_kategoriproduk);
                                                        $this->db->where('tanggal BETWEEN SYSDATE() - INTERVAL 1 month AND SYSDATE()');
                                                        $this->db->order_by('sum(jumlah)', 'DESC');
                                                        $this->db->limit(1);
                                                        $produk = $this->db->get('penjualan')->result();
                                                        foreach ($produk as $p){?>
                                                            <td><?= $p->nama_produk ?></td>
                                                        <td><span class="badge badge-success"><?= $p->tot ?></span></td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </section>
</div>