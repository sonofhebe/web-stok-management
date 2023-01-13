  <div id="app">
      <div class="main-wrapper main-wrapper-1">
          <div class="navbar-bg"></div>
          <nav class="navbar navbar-expand-lg main-navbar">
              <form class="form-inline mr-auto">
                  <ul class="navbar-nav mr-3">
                      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                  </ul>
                  <h6 class="text-left text-white mt-3">Sistem Informasi Stok</h6>
              </form>
              <ul class="navbar-nav navbar-right">
                  <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
                          <img alt="image" src="<?= base_url('./assets/profile/') . $this->session->userdata('profile'); ?>" class="foto">
                          <div class="d-sm-none d-lg-inline-block">Hi Admin</div>
                      </a>
                        <div class="dropdown-menu dropdown-menu">
                          <a href="<?= base_url('profiles-user') ?>" class="dropdown-item has-icon">
                              <i class="far fa-user"></i> Profile
                          </a>
                          <div class="dropdown-divider"></div>
                          <a href="<?= base_url('logout') ?>" class="dropdown-item has-icon text-danger">
                              <i class="fas fa-sign-out-alt"></i> Logout
                          </a>
                      </div>
                  </li>
              </ul>
          </nav>
          <div class="main-sidebar sidebar-style-2">
              <aside id="sidebar-wrapper">
                  <div class="sidebar-brand">
                      
                      <a href="<?= base_url('dashboard') ?>"><img src="<?= base_url(); ?>./assets/img/logo.png" alt="logo" width="45"></a>
                  </div>
                  <ul class="sidebar-menu">
                      <li class="menu-header">Dashboard</li>
                      <li class="dropdown <?= $this->uri->segment('1') == 'dashboard' ? 'active' : '' ?>">
                          <a href="<?= base_url('dashboard'); ?>" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
                      </li>
                  </ul>
                  <?php if ($this->session->userdata('role_id') == 1) { ?>
                      <ul class="sidebar-menu">
                      <li class="menu-header">PRODUK</li>
                          <li class="dropdown <?= $this->uri->segment('1') == 'kategoriproduk' || $this->uri->segment('1') == 'data-produk' || $this->uri->segment('1') == 'jadwal' || $this->uri->segment('1') == 'data_jadwal' || $this->uri->segment('1') == 'data_resep' ? 'active' : '' ?>">
                              <a href="#" class="nav-link has-dropdown"><i class="fas fa-utensils"></i> <span>Produk</span></a>
                              <ul class="dropdown-menu">
                                  <li class="<?= $this->uri->segment('1') == 'jadwal' || $this->uri->segment('1') == 'data_jadwal' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url("jadwal") ?>">Jadwal</a></li>
                                  <li class="<?= $this->uri->segment('1') == 'data-produk' || $this->uri->segment('1') == 'data_resep' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url("data-produk") ?>">Data Produk</a></li>
                                  <li class="<?= $this->uri->segment('1') == 'kategoriproduk' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url("kategoriproduk") ?>">Kategori Produk</a></li>
                              </ul>
                          </li>
                          <li class="dropdown <?= $this->uri->segment('1') == 'kategori' || $this->uri->segment('1') == 'data-bahan' || $this->uri->segment('1') == 'satuan' || $this->uri->segment('1') == 'takaran' ? 'active' : '' ?>">
                              <a href="#" class="nav-link has-dropdown"><i class="fas fa-seedling"></i> <span>Bahan</span></a>
                              <ul class="dropdown-menu">
                                  <li class="<?= $this->uri->segment('1') == 'data-bahan' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url("data-bahan") ?>">Data Bahan</a></li>
                                  <li class="<?= $this->uri->segment('1') == 'takaran' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url("takaran") ?>">Takaran Bahan</a></li>
                                  <li class="<?= $this->uri->segment('1') == 'kategori' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url("kategori") ?>">Kategori Bahan</a></li>
                                  <li class="<?= $this->uri->segment('1') == 'satuan' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url("satuan") ?>">Satuan Bahan</a></li>
                              </ul>
                          </li>

                          <?php $this->db->where('status = "Tunggu"');
                            $notif = $this->db->get('req')->num_rows();
                            ?>
                          <li class="menu-header">Manajemen Stok</li>
                          <li class="<?= $this->uri->segment('1') == 'stok' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('stok') ?>"><i class="fas fa-server"></i>
                          <span>Stok Cabang</span></a></li>
                          <li class="<?= $this->uri->segment('1') == 'drop-stok' || $this->uri->segment('1') == 'drop-stok-' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('drop-stok') ?>"><i class="fas fa-dolly-flatbed"></i>
                          <span>Drop Stok</span></a></li>
                          <li class="<?= $this->uri->segment('1') == 'request' || $this->uri->segment('1') == 'request-' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('request'); ?>"><i class="fas fa-envelope"></i>
                          <span>Request Bahan</span>
                          <?php if ($notif > 0) { ?>
                          <h6 class="badge badge-danger"><?= $notif ?></h6>
                          <?php } ?>
                          </a></li>

                        <li class="menu-header">Laporan</li>
                        <li class="dropdown <?= $this->uri->segment('1') == 'laporan-pemakaian' || $this->uri->segment('1') == 'laporan-drop' || $this->uri->segment('1') == 'laporan-penjualan' || $this->uri->segment('1') == 'pemakaian-mingguan' || $this->uri->segment('1') == 'pemakaian-bulanan' || $this->uri->segment('1') == 'drop-mingguan' || $this->uri->segment('1') == 'drop-bulanan' || $this->uri->segment('1') == 'penjualan-mingguan' || $this->uri->segment('1') == 'penjualan-bulanan' || $this->uri->segment('1') == 'sc-mingguan' || $this->uri->segment('1') == 'sc-bulanan' ? 'active' : '' ?>">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-download"></i> <span>Laporan</span></a>
                            <ul class="dropdown-menu">
                                <li class="<?= $this->uri->segment('1') == 'laporan-pemakaian' || $this->uri->segment('1') == 'pemakaian-mingguan' || $this->uri->segment('1') == 'pemakaian-bulanan' || $this->uri->segment('1') == 'sc-mingguan' || $this->uri->segment('1') == 'sc-bulanan' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url("laporan-pemakaian") ?>">Laporan Pemakaian</a></li>
                                <li class="<?= $this->uri->segment('1') == 'laporan-drop' || $this->uri->segment('1') == 'drop-mingguan' || $this->uri->segment('1') == 'drop-bulanan' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url("laporan-drop") ?>">Laporan Drop</a></li>
                                <li class="<?= $this->uri->segment('1') == 'laporan-penjualan' || $this->uri->segment('1') == 'penjualan-mingguan' || $this->uri->segment('1') == 'penjualan-bulanan' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url("laporan-penjualan") ?>">Laporan Penjualan</a></li>
                            </ul>
                        </li>

                          <li class="menu-header">Data Dapur</li>
                          <li class="<?= $this->uri->segment('1') == 'dapur' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('dapur') ?>"><i class="fas fa-building"></i>
                          <span>Dapur Cabang</span></a></li>
                          <li class="<?= $this->uri->segment('1') == 'data-user' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('data-user') ?>"><i class="fas fa-user">
                          </i> <span>Data User</span></a>
                            </li>
                          <br>
                          <li class="menu-header"><center>version 1.2.0</center></li>
                      </ul>
                  <?php } else if ($this->session->userdata('role_id') == 2) { ?>
                    <ul class="sidebar-menu">
                    <li class="menu-header">PRODUK</li>
                          <li class="dropdown <?= $this->uri->segment('1') == 'kategoriproduk' || $this->uri->segment('1') == 'data-produk' || $this->uri->segment('1') == 'jadwal' || $this->uri->segment('1') == 'data_jadwal' || $this->uri->segment('1') == 'data_resep' ? 'active' : '' ?>">
                              <a href="#" class="nav-link has-dropdown"><i class="fas fa-utensils"></i> <span>Produk</span></a>
                              <ul class="dropdown-menu">
                                  <li class="<?= $this->uri->segment('1') == 'jadwal' || $this->uri->segment('1') == 'data_jadwal' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url("jadwal") ?>">Jadwal</a></li>
                                  <li class="<?= $this->uri->segment('1') == 'data-produk' || $this->uri->segment('1') == 'data_resep' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url("data-produk") ?>">Data Produk</a></li>
                              </ul>
                          </li>
                          <li class="dropdown <?= $this->uri->segment('1') == 'kategori' || $this->uri->segment('1') == 'resep' || $this->uri->segment('1') == 'data-bahan' || $this->uri->segment('1') == 'satuan' || $this->uri->segment('1') == 'takaran' ? 'active' : '' ?>">
                              <a href="#" class="nav-link has-dropdown"><i class="fas fa-seedling"></i> <span>Bahan</span></a>
                              <ul class="dropdown-menu">
                                  <li class="<?= $this->uri->segment('1') == 'data-bahan' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url("data-bahan") ?>">Data Bahan</a></li>
                                  <li class="<?= $this->uri->segment('1') == 'takaran' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url("takaran") ?>">Takaran Bahan</a></li>
                              </ul>
                          </li>

                          <li class="menu-header">Input Data</li>
                          <li class="<?= $this->uri->segment('1') == 'penjualan' || $this->uri->segment('1') == 'penjualan-' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('penjualan') ?>"><i class="fas fa-book"></i>
                          <span>Penjualan Produk</span></a></li>
                          <li class="<?= $this->uri->segment('1') == 'pemakaian' || $this->uri->segment('1') == 'pemakaian-' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('pemakaian') ?>"><i class="fas fa-clipboard-list"></i>
                          <span>Pemakaian Bahan</span></a></li>
                          <li class="<?= $this->uri->segment('1') == 'request-cabang' || $this->uri->segment('1') == 'request-cabang-' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('request-cabang'); ?>"><i class="fas fa-envelope"></i>
                          <span>Request Bahan</span></a></li>

                          <li class="menu-header">Manajemen Stok</li>
                          <li class="<?= $this->uri->segment('1') == 'stok-cabang' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('stok-cabang') ?>"><i class="fas fa-server"></i>
                          <span>Stok <?= $this->session->userdata('nama_dapur') ?></span></a></li>
                          <li class="<?= $this->uri->segment('1') == 'bahan-masuk' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('bahan-masuk') ?>"><i class="fas fa-dolly-flatbed"></i>
                          <span>Bahan Masuk</span></a></li>
                          <br>
                          <li class="menu-header"><center>version 1.2.0</center></li>
                      </ul>
                      <?php } ?>
              </aside>
          </div>