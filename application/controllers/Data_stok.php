<?php
class data_stok extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        role1();
        $this->load->model('datastok_model');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function inputsession()
    {
        if(isset($_POST['idd']))
        { 
        $_SESSION["idd"]=$_POST["idd"];
        }
        $this->session->userdata('idd', $_POST['idd']);
        redirect(base_url('data-stok'), 'refresh');
    }

    public function index()
    {
        $data = array(
            'title'     => 'Data Stok',
            'dapur'    => $this->datastok_model->getdapur(),
            'bahan'    => $this->datastok_model->getbahan(),
            'stok'    => $this->datastok_model->getstok()
        );
        $this->load->view('template/header.php', $data);
        $this->load->view('template/sidebar.php', $data);
        $this->load->view('pages/dapur/data_stok.php', $data);
        $this->load->view('template/footer.php');
    }


    public function tambahstok()
    {
        $this->form_validation->set_rules('id_bahan', 'Bahan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            //cek apakah bahan sudah ada ?
            $dapur = $this->input->post('id_dapur');
            $bahan = $this->input->post('id_bahan');
            $cek = $this->datastok_model->cekId($dapur, $bahan);
            if ($cek) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Bahan sudah ada didalam stok dapur ini!</div>');
                redirect(base_url('data_stok'), 'refresh');
            } else {
            $dapur = $this->session->userdata('idd');
            $bahan = $this->input->post('id_bahan');

            $data = array(
                'id_dapur'   => $dapur,
                'id_bahan'   => $bahan,
                'tgl_input'     => date('Y-m-d H:i:s')
            );
            $this->datastok_model->inputstok($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
            redirect(base_url('data_stok'), 'refresh');
        }
        }
    }

    public function hapusstok($id)
    {
        $this->datastok_model->hapusstok($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus!</div>');
        redirect(base_url('data_stok'), 'refresh');
    }
}
