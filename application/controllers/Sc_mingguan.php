<?php
class sc_mingguan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        role1();
        $this->load->model('scmingguan_model');
    }

    public function index()
    {
        $awal = $this->input->post('awal');
        $id_kategori = $this->input->post('id_kategori');
        $id_dapur = $this->input->post('id_dapur');
        $dapur = $this->scmingguan_model->dapur($id_dapur);
        if ($id_dapur==0) {
        $nama_dapur = 'SEMUA DAPUR';
        } else {
        $nama_dapur = $dapur->nama_dapur;
        }
        $data = array(
            'title' => 'Cetak Laporan',
            'awal' => $awal,
            'id_dapur' => $id_dapur,
            'id_kategori' => $id_kategori,
            'nama_dapur'        => $nama_dapur,
            'takaran'        => $this->scmingguan_model->takaran($id_kategori),
            'tanggal'        => $this->scmingguan_model->tanggal($awal),
            'pemakaian'        => $this->scmingguan_model->pemakaian($awal,$id_kategori,$id_dapur)
        );

        $this->load->view('template/header.php', $data);
        $this->load->view('template/sidebar.php', $data);
        $this->load->view('pages/laporan/sc_mingguan.php', $data);
        $this->load->view('template/footer.php');
    }

    public function print()
    {
        $awal = $this->input->post('awal');
        $id_kategori = $this->input->post('id_kategori');
        $id_dapur = $this->input->post('id_dapur');
        $dapur = $this->scmingguan_model->dapur($id_dapur);
        if ($id_dapur==0) {
        $nama_dapur = 'SEMUA DAPUR';
        } else {
        $nama_dapur = $dapur->nama_dapur;
        }
        $data = array(
            'title' => 'Cetak Laporan',
            'awal' => $awal,
            'id_dapur' => $id_dapur,
            'id_kategori' => $id_kategori,
            'nama_dapur'        => $nama_dapur,
            'takaran'        => $this->scmingguan_model->takaran($id_kategori),
            'tanggal'        => $this->scmingguan_model->tanggal($awal),
            'pemakaian'        => $this->scmingguan_model->pemakaian($awal,$id_kategori,$id_dapur)
        );
        $this->load->view('pages/laporan/print/sc_mingguan.php', $data);
    }
}