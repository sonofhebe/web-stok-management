
<?php
class data_resep extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('dataresep_model');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function inputsession()
    {
        if (isset($_POST['idp'])) {
            $_SESSION["idp"] = $_POST["idp"];
        }
        $this->session->userdata('idp', $_POST['idp']);
        redirect(base_url('data_resep'), 'refresh');
    }

    public function index()
    {
        $data = array(
            'title'     => 'Data Resep',
            'produk'    => $this->dataresep_model->getProduk(),
            'takaran'    => $this->dataresep_model->gettakaran(),
            'resep'    => $this->dataresep_model->getresep()
        );
        $this->load->view('template/header.php', $data);
        $this->load->view('template/sidebar.php', $data);
        $this->load->view('pages/bahan/data_resep.php', $data);
        $this->load->view('template/footer.php');
    }


    public function tambahresep()
    {
        role1();
        //cek apakah takaran sudah ada ?
        $takaran = $this->input->post('id_takaran');
        $produk = $this->input->post('id_produk');
        $cek = $this->dataresep_model->cekId($takaran, $produk);
        if ($cek) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">takaran sudah ada didalam resep !</div>');
            redirect(base_url('data_resep'), 'refresh');
        } else {

            $id_p = $this->input->post('id_produk');
            $takaran = $this->input->post('id_takaran');
            foreach ($this->dataresep_model->bahan($takaran) as $bhn) {
                $bahan = $bhn->id_bahan;
            }
            $jumlah = $this->input->post('jumlah');

            $data = array(
                'id_produk'   => $id_p,
                'id_takaran'   => $takaran,
                'id_bahan'   => $bahan,
                'jumlah'   => $jumlah,
                'tgl_input'     => date('Y-m-d H:i:s')
            );
            $this->dataresep_model->inputresep($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
            redirect(base_url('data_resep'), 'refresh');
        }
    }

    public function hapusresep($id)
    {
        role1();
        $this->dataresep_model->hapusresep($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus!</div>');
        redirect(base_url('data_resep'), 'refresh');
    }

    public function editresep($id)
    {
        role1();
        $jumlah = $this->input->post('jumlah');

        $data = array(
            'jumlah'          => $jumlah,
            'tgl_update'     => date('Y-m-d H:i:s')
        );
        $this->dataresep_model->editresep($data, $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di edit !</div>');
        redirect(base_url('data_resep'), 'refresh');
    }
}
