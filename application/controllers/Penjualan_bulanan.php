<?php
class penjualan_bulanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        role1();
        $this->load->model('penjualanbulanan_model');
    }

    public function index()
    {
        $bulan = $this->input->post('bulan');
        $id_dapur = $this->input->post('id_dapur');
        $dapur = $this->penjualanbulanan_model->dapur($id_dapur);
        if ($id_dapur==0) {
        $nama_dapur = 'SEMUA DAPUR';
        $idd = 0;
        } else {
        $nama_dapur = $dapur->nama_dapur;
        $idd = 1;
        }
        if ($idd == 0){
            foreach ($this->penjualanbulanan_model->terlaris($bulan) as $laris){
                $terlaris = $laris->nama_produk;
            }
        } else {
            foreach ($this->penjualanbulanan_model->terlarisc($bulan, $id_dapur) as $laris){
                $terlaris = $laris->nama_produk;
            }
        }
        if (isset($terlaris)) {
            $terlariss=$terlaris;
        } else {
            $terlariss="-";
        }
        $data = array(
            'title' => 'Cetak Laporan',
            'bulan' => $bulan,
            'id_dapur' => $id_dapur,
            'nama_dapur'        => $nama_dapur,
            'tanggal'        => $this->penjualanbulanan_model->tanggal($bulan),
            'terlaris'        => $terlariss,
            'produk'        => $this->penjualanbulanan_model->produk()
        );

        $this->load->view('template/header.php', $data);
        $this->load->view('template/sidebar.php', $data);
        $this->load->view('pages/laporan/penjualan_bulanan.php', $data);
        $this->load->view('template/footer.php');
    }

    public function print()
    {
        $bulan = $this->input->post('bulan');
        $id_dapur = $this->input->post('id_dapur');
        $dapur = $this->penjualanbulanan_model->dapur($id_dapur);
        if ($id_dapur==0) {
        $nama_dapur = 'SEMUA DAPUR';
        } else {
        $nama_dapur = $dapur->nama_dapur;
        }
        foreach ($this->penjualanbulanan_model->terlaris($bulan) as $laris){
            $terlaris = $laris->nama_produk;
        }
        $data = array(
            'title' => 'Cetak Laporan',
            'bulan' => $bulan,
            'id_dapur' => $id_dapur,
            'nama_dapur'        => $nama_dapur,
            'tanggal'        => $this->penjualanbulanan_model->tanggal($bulan),
            'terlaris'        => $terlaris,
            'produk'        => $this->penjualanbulanan_model->produk()
        );
        $this->load->view('pages/laporan/print/penjualan_bulanan.php', $data);
    }
}