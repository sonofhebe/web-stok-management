
<?php
class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        role1();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('Kategori_model');
    }

    public function index()
    {
        $data = array(
            'title'     => 'Kategori Produk',
            'kategori'  => $this->Kategori_model->getKategori()
        );
        $this->load->view('template/header.php', $data);
        $this->load->view('template/sidebar.php', $data);
        $this->load->view('pages/produk/kategori.php', $data);
        $this->load->view('template/footer.php');
    }

    public function tambahkategori()
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $nk = $this->input->post('nama_kategori');

            $data = array(
                'nama_kategori'     => $nk,
                'tgl_input'         => date('Y-m-d H:i:s')
            );
            $this->Kategori_model->inputkategori($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');

            redirect(base_url('kategori'), 'refresh');
        }
    }

    public function hapuskategori($id)
    {
        //ccek apakah kattegori ada di produk ?
        $cek = $this->Kategori_model->cekId($id);

        if ($cek) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Data gagal di hapus. Karena terdapat di produk, sialahkan hapus dulu di produk !</div>');
            redirect(base_url('kategori'), 'refresh');
        } else {
            $this->Kategori_model->hapuskategori($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus!</div>');
            redirect(base_url('kategori'), 'refresh');
        }
    }

    public function editkategori($id)
    {
        $nk = $this->input->post('nama_kategori');

        $data = array(
            'nama_kategori' => $nk,
            'tgl_update'     => date("Y-m-d H:i:s")
        );
        $this->Kategori_model->editKategori($data, $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di edit!</div>');
        redirect(base_url('kategori'), 'refresh');
    }
}
