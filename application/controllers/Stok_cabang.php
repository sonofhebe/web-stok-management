<?php
class stok_cabang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        role2();
        $this->load->model('stokcabang_model');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data = array(
            'title'     => 'Data Stok',
            'stok'    => $this->stokcabang_model->getstok()
        );
        $this->load->view('template/header.php', $data);
        $this->load->view('template/sidebar.php', $data);
        $this->load->view('pages/stok/stok_cabang.php', $data);
        $this->load->view('template/footer.php');
    }
}
