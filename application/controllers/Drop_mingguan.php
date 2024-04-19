
<?php
class drop_mingguan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        role1();
        $this->load->model('dropmingguan_model');
    }

    public function index()
    {
        $awal = $this->input->post('awal');
        $id_kategori = $this->input->post('id_kategori');
        $id_dapur = $this->input->post('id_dapur');
        $dapur = $this->dropmingguan_model->dapur($id_dapur);
        if ($id_dapur == 0) {
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
            'bahan'        => $this->dropmingguan_model->bahan($id_kategori),
            'tanggal'        => $this->dropmingguan_model->tanggal($awal),
            'drop'        => $this->dropmingguan_model->drop_stok($awal, $id_kategori, $id_dapur)
        );

        $this->load->view('template/header.php', $data);
        $this->load->view('template/sidebar.php', $data);
        $this->load->view('pages/laporan/drop_mingguan.php', $data);
        $this->load->view('template/footer.php');
    }

    public function print()
    {
        $awal = $this->input->post('awal');
        $id_kategori = $this->input->post('id_kategori');
        $id_dapur = $this->input->post('id_dapur');
        $dapur = $this->dropmingguan_model->dapur($id_dapur);
        if ($id_dapur == 0) {
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
            'bahan'        => $this->dropmingguan_model->bahan($id_kategori),
            'tanggal'        => $this->dropmingguan_model->tanggal($awal),
            'drop'        => $this->dropmingguan_model->drop_stok($awal, $id_kategori, $id_dapur)
        );
        $this->load->view('pages/laporan/print/drop_mingguan.php', $data);
    }
}
