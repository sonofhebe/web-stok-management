<?php
class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Produk_model');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data = array(
            'title'     => 'Data Produk',
            'kategoriproduk'  => $this->Produk_model->getKategoriproduk(),
            'produk'    => $this->Produk_model->getProduk()
        );
        $this->load->view('template/header.php', $data);
        $this->load->view('template/sidebar.php', $data);
        $this->load->view('pages/produk/data_produk.php', $data);
        $this->load->view('template/footer.php');
    }


    public function tambahproduk()
    {
        role1();
        $id_k = $this->input->post('id_kategoriproduk');
        $nama = $this->input->post('nama_produk');
        //$harga = $this->input->post('harga');

        $data = array(
            'id_kategoriproduk'   => $id_k,
            'nama_produk'   => $nama,
            //'harga'         => $harga,
            'tgl_input'     => date('Y-m-d H:i:s')
        );
        $this->Produk_model->inputproduk($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
        redirect(base_url('data-produk'), 'refresh');
    }

    public function hapusproduk($id)
    {
        role1();
        $this->Produk_model->hapusProduk($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus!</div>');
        redirect(base_url('data-produk'), 'refresh');
    }

    public function editproduk($id)
    {
        role1();
        $id_k = $this->input->post('id_kategoriproduk');
        $nama = $this->input->post('nama_produk');
        //$harga = $this->input->post('harga');

        $data = array(
            'id_kategoriproduk'   => $id_k,
            'nama_produk'   => $nama,
            //'harga'         => $harga,
            'tgl_update'     => date('Y-m-d H:i:s')
        );
        $this->Produk_model->editProduk($data, $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di edit !</div>');
        redirect(base_url('data-produk'), 'refresh');
    }
}
