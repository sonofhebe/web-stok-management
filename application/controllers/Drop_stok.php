
<?php
class drop_stok extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('dropstok_model');
		date_default_timezone_set("Asia/Jakarta");
	}

	public function index()
	{
		role1();
		$tglll = $this->input->post('tanggal');
		if (!isset($tglll)) {
			$tgll    =  date('Y-m-d');
		} else {
			$tgll = $this->input->post('tanggal');
		}

		$this->session->set_userdata('tglll', $tgll);

		$data = array(
			'title'             => 'Drop Stok',
			'dapur'            => $this->dropstok_model->getdapur(),
			'bahan'            => $this->dropstok_model->getbahan(),
			'tgl'            => $tgll,
			'data_masuk'        => $this->dropstok_model->getdropstok($tgll)
		);
		$this->load->view('template/header.php', $data);
		$this->load->view('template/sidebar.php', $data);
		$this->load->view('pages/stok/drop_stok.php', $data);
		$this->load->view('template/footer.php');
	}

	public function index2()
	{
		role1();
		$tgll = $this->session->userdata('tglll');
		$data = array(
			'title'             => 'Drop Stok',
			'dapur'            => $this->dropstok_model->getdapur(),
			'bahan'            => $this->dropstok_model->getbahan(),
			'tgl'            => $tgll,
			'data_masuk'        => $this->dropstok_model->getdropstok($tgll)
		);
		$this->load->view('template/header.php', $data);
		$this->load->view('template/sidebar.php', $data);
		$this->load->view('pages/stok/drop_stok.php', $data);
		$this->load->view('template/footer.php');
	}

	public function tambah()
	{
		role1();
		$id_dapur  = $this->input->post('id_dapur');
		$id_bahan  = $this->input->post('id_bahan');
		$jml        = $this->input->post('jumlah');
		$tgl        =  $this->input->post('tanggal');
		foreach ($this->dropstok_model->getharga($id_bahan) as $h) {
			$hargasatuan = $h->harga / $h->per;
		}
		$total_harga      = $jml * $hargasatuan;
		// $getCPSA = $this->dropstok_model->cpsa($id_dapur, $id_bahan, $tgl);
		// if (count($getCPSA) > 0) {
		// 	$cpsa = $getCPSA[0]->cpsa + $getCPSA[0]->jumlah;
		// } else {

		$cpsa = 0;
		// }

		foreach ($this->dropstok_model->cekstok($id_bahan) as $stok) {
			$stk = $stok->stok;
		}

		if ($jml > 0) {
			if ($jml <= $stk) {
				$data = array(
					'id_dapur'     => $id_dapur,
					'id_bahan'     => $id_bahan,
					'jumlah'        => $jml,
					'total_harga'   => $total_harga,
					'cpsa'       => $cpsa,
					'tanggal'       => $tgl,
					'tgl_input'     => date('Y-m-d H:i:s')
				);
				$jumlahStokTotal = $cpsa + $jml;
				if ($this->dropstok_model->cekId($id_dapur, $id_bahan)) {
					$this->dropstok_model->updatestokCabang($id_dapur, $id_bahan, $jumlahStokTotal);
					$this->dropstok_model->updatestokBahan($id_bahan, $jml);
					$this->dropstok_model->inputdropstok($data);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
					redirect(base_url('drop-stok-'), 'refresh');
				} else {
					$stok = array(
						'id_dapur'     => $id_dapur,
						'id_bahan'     => $id_bahan,
						'jumlah'        => $jumlahStokTotal,
						'tgl_input'     => date('Y-m-d H:i:s')
					);
					$this->dropstok_model->tambahstok($stok);
					$this->dropstok_model->updatestokBahan($id_bahan, $jml);
					$this->dropstok_model->inputdropstok($data);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
					redirect(base_url('drop-stok-'), 'refresh');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Stok bahan tidak cukup, silahkan update stok terlebih dahulu.</div>');
				redirect(base_url('drop-stok-'), 'refresh');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Stok tidak bisa Nol !</div>');
			redirect(base_url('drop-stok-'), 'refresh');
		}
	}

	public function hapus($id)
	{
		role1();
		$this->dropstok_model->hapusdropstok($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus !</div>');
		redirect(base_url('drop-stok-'), 'refresh');
	}

	//cabang

	public function cabang()
	{
		role2();
		$tglll = $this->input->post('tanggal');
		if (!isset($tglll)) {
			$tgll    =  date('Y-m-d');
		} else {
			$tgll = $this->input->post('tanggal');
		}

		$this->session->set_userdata('tglll', $tgll);
		$id_dapur = $this->session->userdata('id_dapur');

		$data = array(
			'title'             => 'Drop Stok',
			'dapur'            => $this->dropstok_model->getdapur(),
			'bahan'            => $this->dropstok_model->getbahan(),
			'tgl'            => $tgll,
			'data_masuk'        => $this->dropstok_model->getdropstokcabang($tgll)
		);
		$this->load->view('template/header.php', $data);
		$this->load->view('template/sidebar.php', $data);
		$this->load->view('pages/stok/drop_stok.php', $data);
		$this->load->view('template/footer.php');
	}
}
