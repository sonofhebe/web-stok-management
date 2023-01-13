<?php
class drop_bulanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        role1();
        $this->load->model('dropbulanan_model');
    }

    public function index()
    {
        $bulan = $this->input->post('bulan');
        $id_kategori = $this->input->post('id_kategori');
        $id_dapur = $this->input->post('id_dapur');
        $dapur = $this->dropbulanan_model->dapur($id_dapur);
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
            'bahan'        => $this->dropbulanan_model->bahan($id_kategori),
            'tanggal'        => $this->dropbulanan_model->tanggal($bulan),
            'drop'        => $this->dropbulanan_model->drop_stok($bulan,$id_kategori,$id_dapur)
        );

        $this->load->view('template/header.php', $data);
        $this->load->view('template/sidebar.php', $data);
        $this->load->view('pages/laporan/drop_bulanan.php', $data);
        $this->load->view('template/footer.php');
    }

    public function print()
    {
        $bulan = $this->input->post('bulan');
        $id_kategori = $this->input->post('id_kategori');
        $id_dapur = $this->input->post('id_dapur');
        $dapur = $this->dropbulanan_model->dapur($id_dapur);
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
            'bahan'        => $this->dropbulanan_model->bahan($id_kategori),
            'tanggal'        => $this->dropbulanan_model->tanggal($bulan),
            'drop'        => $this->dropbulanan_model->drop_stok($bulan,$id_kategori,$id_dapur)
        );
        $this->load->view('pages/laporan/print/drop_bulanan.php', $data);
    }
}