<?php
class sc_bulanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        role1();
        $this->load->model('scbulanan_model');
    }

    public function index()
    {
        $bulan = $this->input->post('bulan');
        $id_kategori = $this->input->post('id_kategori');
        $id_dapur = $this->input->post('id_dapur');
        $dapur = $this->scbulanan_model->dapur($id_dapur);
        if ($id_dapur==0) {
        $nama_dapur = 'SEMUA DAPUR';
        } else {
        $nama_dapur = $dapur->nama_dapur;
        }
        $data = array(
            'title' => 'Cetak Laporan',
            'bulan' => $bulan,
            'id_dapur' => $id_dapur,
            'id_kategori' => $id_kategori,
            'nama_dapur'        => $nama_dapur,
            'takaran'        => $this->scbulanan_model->takaran($id_kategori),
            'tanggal'        => $this->scbulanan_model->tanggal($bulan),
            'pemakaian'        => $this->scbulanan_model->pemakaian($bulan,$id_kategori,$id_dapur)
        );

        $this->load->view('template/header.php', $data);
        $this->load->view('template/sidebar.php', $data);
        $this->load->view('pages/laporan/sc_bulanan.php', $data);
        $this->load->view('template/footer.php');
    }

    public function print()
    {
        $bulan = $this->input->post('bulan');
        $id_kategori = $this->input->post('id_kategori');
        $id_dapur = $this->input->post('id_dapur');
        $dapur = $this->scbulanan_model->dapur($id_dapur);
        if ($id_dapur==0) {
        $nama_dapur = 'SEMUA DAPUR';
        } else {
        $nama_dapur = $dapur->nama_dapur;
        }
        $data = array(
            'title' => 'Cetak Laporan',
            'bulan' => $bulan,
            'id_dapur' => $id_dapur,
            'id_kategori' => $id_kategori,
            'nama_dapur'        => $nama_dapur,
            'takaran'        => $this->scbulanan_model->takaran($id_kategori),
            'tanggal'        => $this->scbulanan_model->tanggal($bulan),
            'pemakaian'        => $this->scbulanan_model->pemakaian($bulan,$id_kategori,$id_dapur)
        );
        $this->load->view('pages/laporan/print/sc_bulanan.php', $data);
    }
}