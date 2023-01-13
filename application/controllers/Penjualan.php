<?php
class penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        role2();
        $this->load->model('penjualan_model');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $tglll = $this->input->post('tanggal');
        if (!isset($tglll)) {
            $tgll    =  date('Y-m-d');
        } else {
            $tgll = $this->input->post('tanggal');
        }
        
        $this->session->set_userdata('tglll', $tgll);

        $id_dapur  = $this->session->userdata('id_dapur');
        $data = array(
            'title'     => 'Data Penjualan',
            'produk'    => $this->penjualan_model->getProduk(),
            'tgl'            => $tgll,
            'penjualan'    => $this->penjualan_model->getpenjualan($id_dapur, $tgll)
        );
        $this->load->view('template/header.php', $data);
        $this->load->view('template/sidebar.php', $data);
        $this->load->view('pages/produk/penjualan.php', $data);
        $this->load->view('template/footer.php');
    }

    public function index2()
    {
        $tgll = $this->session->userdata('tglll');
        
        $id_dapur  = $this->session->userdata('id_dapur');
        $data = array(
            'title'     => 'Data Penjualan',
            'produk'    => $this->penjualan_model->getProduk(),
            'tgl'            => $tgll,
            'penjualan'    => $this->penjualan_model->getpenjualan($id_dapur, $tgll)
        );
        $this->load->view('template/header.php', $data);
        $this->load->view('template/sidebar.php', $data);
        $this->load->view('pages/produk/penjualan.php', $data);
        $this->load->view('template/footer.php');
    }

    public function tambahpenjualan()
    {
        $id_dapur  = $this->session->userdata('id_dapur');
            //cek apakah produk sudah ada ?
            $id_dapur = $this->session->userdata('id_dapur');
            $tgl    = $this->input->post('tanggal');
            $produk = $this->input->post('id_produk');
            $cek = $this->penjualan_model->cek($id_dapur, $produk, $tgl);
            if ($cek) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Produk sudah di input !</div>');
                redirect(base_url('penjualan-'), 'refresh');
            } else {

            $id_dapur = $this->session->userdata('id_dapur');
            $id_p = $this->input->post('id_produk');
            $jumlah = $this->input->post('jumlah');
            $tgl    = $this->input->post('tanggal');

            $data = array(
                'id_dapur'     => $id_dapur,
                'id_produk'   => $id_p,
                'jumlah'   => $jumlah,
                'tanggal'     =>    $tgl
            );
            $this->penjualan_model->inputpenjualan($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
            redirect(base_url('penjualan-'), 'refresh');
        }
    }

    public function hapuspenjualan($id)
    {
        $this->penjualan_model->hapuspenjualan($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus!</div>');
        redirect(base_url('penjualan-'), 'refresh');
    }

    public function editpenjualan($id)
    {
        $jumlah = $this->input->post('jumlah');

        $data = array(
            'jumlah'          => $jumlah
        );
        $this->penjualan_model->editpenjualan($data, $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di edit !</div>');
        redirect(base_url('penjualan-'), 'refresh');
    }
}
