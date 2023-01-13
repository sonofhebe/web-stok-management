<?php
class kategoriproduk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        role1();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('kategoriproduk_model');
    }

    public function index()
    {
        $data = array(
            'title'     => 'Kategori Produk',
            'kategoriproduk'  => $this->kategoriproduk_model->getKategoriproduk()
        );
        $this->load->view('template/header.php', $data);
        $this->load->view('template/sidebar.php', $data);
        $this->load->view('pages/produk/kategoriproduk.php', $data);
        $this->load->view('template/footer.php');
    }

    public function tambahkategoriproduk()
    {
        $this->form_validation->set_rules('nama_kategoriproduk', 'Nama Kategori produk', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $nk = $this->input->post('nama_kategoriproduk');

            $data = array(
                'nama_kategoriproduk'     => $nk,
                'tgl_input'         => date('Y-m-d H:i:s')
            );
            $this->kategoriproduk_model->inputkategoriproduk($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');

            redirect(base_url('kategoriproduk'), 'refresh');
        }
    }

    public function hapuskategoriproduk($id)
    {
        //ccek apakah kattegori ada di produk ?
        $cek = $this->kategoriproduk_model->cekId($id);

        if ($cek) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Data gagal di hapus. Karena terdapat di produk, sialahkan hapus dulu di produk !</div>');
            redirect(base_url('kategoriproduk'), 'refresh');
        } else {
            $this->kategoriproduk_model->hapuskategoriproduk($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus!</div>');
            redirect(base_url('kategoriproduk'), 'refresh');
        }
    }

    public function editkategoriproduk($id)
    {
        $nk = $this->input->post('nama_kategoriproduk');

        $data = array(
            'nama_kategoriproduk' => $nk,
            'tgl_update'     => date("Y-m-d H:i:s")
        );
        $this->kategoriproduk_model->editKategoriproduk($data, $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di edit!</div>');
        redirect(base_url('kategoriproduk'), 'refresh');
    }
}
