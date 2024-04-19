
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satuan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
		role1();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Satuan_model');
	}

	public function index()
	{
		$data = array(
			'title'            => 'Data Satuan',
			'satuan'           => $this->Satuan_model->getSatuan()
		);

		$this->load->view('template/header.php', $data);
		$this->load->view('template/sidebar.php', $data);
		$this->load->view('pages/satuan/satuan.php', $data);
		$this->load->view('template/footer.php');
	}

	public function tambahdata()
	{
		$this->form_validation->set_rules('nama_satuan', 'Nama Satuan', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$nama  = $this->input->post('nama_satuan');

			$data = array(
				'nama_satuan'   => $nama,
				'tgl_input'     => date("Y-m-d H:i:s")
			);
			$this->Satuan_model->inputdata($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');

			redirect(base_url('satuan'), 'refresh');
		}
	}

	public function hapussatuan($id)
	{
		//cek apakah ada data satuan di table produk ?
		$cek = $this->Satuan_model->cekId($id);

		if ($cek) {
			$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Data gagal di hapus, karena satuan digunakan didata bahan ! !</div>');
			redirect(base_url('satuan'), 'refresh');
		} else {

			$this->Satuan_model->Hapussatuan($id);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus !</div>');

			redirect(base_url('satuan'), 'refresh');
		}
	}

	public function editsatuan($id)
	{
		$nama = $this->input->post('nama_satuan');
		$data = array(
			'nama_satuan'    => $nama,
			'tgl_update'     => date("Y-m-d H:i:s")
		);

		$this->Satuan_model->editSatuan($data, $id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di edit !</div>');

		redirect(base_url('satuan'), 'refresh');
	}
}
