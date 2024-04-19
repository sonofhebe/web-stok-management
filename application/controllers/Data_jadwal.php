
<?php
class data_jadwal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('jadwal_model');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data = array(
            'title'     => 'Jadwal Produk',
            'hari'    => $this->session->userdata('hari'),
            'jadwal'    => $this->jadwal_model->getjadwal(),
            'produk'    => $this->jadwal_model->getproduk()
        );
        $this->load->view('template/header.php', $data);
        $this->load->view('template/sidebar.php', $data);
        $this->load->view('pages/produk/data_jadwal.php', $data);
        $this->load->view('template/footer.php');
    }

    public function inputsession()
    {
        if (isset($_POST['hari'])) {
            $_SESSION["hari"] = $_POST["hari"];
        }
        $this->session->userdata('hari', $_POST['hari']);
        redirect(base_url('data_jadwal'), 'refresh');
    }

    public function tambahjadwal()
    {
        role1();
        $this->form_validation->set_rules('id_produk', 'Produk', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            //cek apakah produk sudah ada ?
            $hari = $this->session->userdata('hari');
            $produk = $this->input->post('id_produk');
            $cek = $this->jadwal_model->cekId($hari, $produk);
            if ($cek) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Produk sudah ada dijadwal !</div>');
                redirect(base_url('data_jadwal'), 'refresh');
            } else {

                $hari = $this->session->userdata('hari');
                $id_p = $this->input->post('id_produk');

                $data = array(
                    'hari'          => $hari,
                    'id_produk'   => $id_p,
                    'tgl_input'     => date('Y-m-d H:i:s')
                );
                $this->jadwal_model->inputjadwal($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
                redirect(base_url('data_jadwal'), 'refresh');
            }
        }
    }

    public function hapusjadwal($id)
    {
        role1();
        $this->jadwal_model->hapusjadwal($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus!</div>');
        redirect(base_url('data_jadwal'), 'refresh');
    }
}
