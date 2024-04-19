
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
			'produk_resep'            => $this->pemakaian_model->getProdukResep(),
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
			'produk_resep'            => $this->pemakaian_model->getProdukResep(),
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
		$id_produk_resep  = $this->input->post('id_produk_resep');
		$sc  = $this->input->post('sc');
		$id_dapur  = $this->session->userdata('id_dapur');
		$tgl    = $this->input->post('inputtanggal');

		$this->session->set_userdata('tglll', $tgl);

		//cek stok dapur
		$cekStok = $this->pemakaian_model->cekStok($id_produk_resep, $id_dapur, $sc);
		if (!is_array($cekStok)) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Produk Resep Kosong !</div>');
			redirect(base_url('pemakaian-'), 'refresh');
		}
		if (count($cekStok) == 0) {
			$this->pemakaian_model->inputpemakaian($id_produk_resep, $id_dapur, $sc, $tgl);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
			redirect(base_url('pemakaian-'), 'refresh');
		} else {
			$bahanKurang = implode(', ', $cekStok);
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Stok bahan (' . $bahanKurang . ') tidak mencukupi</div>');
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
