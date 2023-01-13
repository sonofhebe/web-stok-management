<?php
$tglll = '';
class pemakaian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        role2();
        $this->load->model('pemakaian_model');
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        $tglll = $this->input->post('tanggal');
        if (!isset($tglll)) {
            $tgl    =  date('Y-m-d');
        } else {
            $tgl = $this->input->post('tanggal');
        }
        
        $this->session->set_userdata('tglll', $tgl);
        
        $id_dapur  = $this->session->userdata('id_dapur');
        $data = array(
            'title'             => 'Pemakaian Harian',
            'produk'            => $this->pemakaian_model->getproduk(),
            'takaran'            => $this->pemakaian_model->gettakaran(),
            'tgl'            => $tgl,
            'data_keluar'        => $this->pemakaian_model->getpemakaian($id_dapur, $tgl)
        );
        $this->load->view('template/header.php', $data);
        $this->load->view('template/sidebar.php', $data);
        $this->load->view('pages/stok/pemakaian.php', $data);
        $this->load->view('template/footer.php');
    }

    public function index2()
    {
        $tgl = $this->session->userdata('tglll');
        $id_dapur  = $this->session->userdata('id_dapur');
        $data = array(
            'title'             => 'Pemakaian Harian',
            'produk'            => $this->pemakaian_model->getproduk(),
            'takaran'            => $this->pemakaian_model->gettakaran(),
            'tgl'            => $tgl,
            'data_keluar'        => $this->pemakaian_model->getpemakaian($id_dapur, $tgl)
        );
        $this->load->view('template/header.php', $data);
        $this->load->view('template/sidebar.php', $data);
        $this->load->view('pages/stok/pemakaian.php', $data);
        $this->load->view('template/footer.php');
    }

    public function tambah()
    {
        $id_produk  = $this->input->post('id_produk');
        $id_takaran  = $this->input->post('id_takaran');
        $sc  = $this->input->post('sc');
        $id_dapur  = $this->session->userdata('id_dapur');
        $tgl    = $this->input->post('inputtanggal');
        $id_resep = 0;
        $id_bahan = 0;
        $persc = 0;
        foreach ($this->pemakaian_model->cekresep($id_produk, $id_takaran) as $rsp){
            $id_resep = $rsp->id_resep; 
            $id_bahan = $rsp->id_bahan;
            $persc = $rsp->jumlah;
        }
        $jumlah = $sc * $persc;
        $stok = 0;
        foreach ($this->pemakaian_model->cekstok($id_dapur, $id_bahan) as $stk){
            $stok = $stk->jumlah;
        }
        $this->session->set_userdata('tglll', $tgl);
        if ($this->pemakaian_model->cekresep($id_produk, $id_takaran)) {
            if ($jumlah <= $stok) {
                $data = array(
                    'id_dapur'     => $id_dapur,
                    'id_resep'   => $id_resep,
                    'id_bahan'   => $id_bahan,
                    'sc'   => $sc,
                    'jumlah'   => $jumlah,
                    'tanggal'     =>    $tgl
                );
                $this->pemakaian_model->inputpemakaian($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
                redirect(base_url('pemakaian-'), 'refresh');
            }else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Stok bahan tidak mencukupi</div>');
                redirect(base_url('pemakaian-'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Produk tersebut tidak menggunakan bahan yg dipilih</div>');
            redirect(base_url('pemakaian-'), 'refresh');
        }
    }

    public function hapus($id)
    {
        $this->pemakaian_model->hapuspemakaian($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus !</div>');
        redirect(base_url('pemakaian-'), 'refresh');
    }
}
