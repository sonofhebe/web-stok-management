<?php
class stok extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        role1();
        $this->load->model('stok_model');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data = array(
            'title'     => 'Stok Dapur',
            'dapur'    => $this->stok_model->getdapur()
        );
        $this->load->view('template/header.php', $data);
        $this->load->view('template/sidebar.php', $data);
        $this->load->view('pages/dapur/stok.php', $data);
        $this->load->view('template/footer.php');
    }
}
