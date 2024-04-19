
<?php
class takaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('takaran_model');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data = array(
            'title'     => 'Data takaran',
            'bahan'    => $this->takaran_model->getbahan(),
            'takaran'    => $this->takaran_model->gettakaran()
        );
        $this->load->view('template/header.php', $data);
        $this->load->view('template/sidebar.php', $data);
        $this->load->view('pages/bahan/takaran.php', $data);
        $this->load->view('template/footer.php');
    }


    public function tambahtakaran()
    {
        role1();
        $nama = $this->input->post('nama_takaran');
        $bahan = $this->input->post('id_bahan');

        $data = array(
            'nama_takaran'   => $nama,
            'id_bahan'   => $bahan
        );
        $this->takaran_model->inputtakaran($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
        redirect(base_url('takaran'), 'refresh');
    }

    public function hapustakaran($id)
    {
        role1();
        $this->takaran_model->hapustakaran($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus!</div>');
        redirect(base_url('takaran'), 'refresh');
    }

    public function edittakaran($id)
    {
        role1();
        $nama = $this->input->post('nama_takaran');
        $bahan = $this->input->post('id_bahan');

        $data = array(
            'nama_takaran'   => $nama,
            'id_bahan'   => $bahan
        );
        $this->takaran_model->edittakaran($data, $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di edit !</div>');
        redirect(base_url('takaran'), 'refresh');
    }
}
