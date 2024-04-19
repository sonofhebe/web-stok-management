
<?php
class request extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('request_model');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		role2();
		$tglll = $this->input->post('tanggal');
		if (!isset($tglll)) {
			$tgl    =  date('Y-m-d');
		} else {
			$tgl = $this->input->post('tanggal');
		}

		$this->session->set_userdata('tglll', $tgl);

		$id_dapur  = $this->session->userdata('id_dapur');
		foreach ($this->request_model->dapur($id_dapur) as $dpr) {
			$dapur = $dpr->nama_dapur;
		}
		$data = array(
			'title'     => 'Data Request',
			'dapur'    => $dapur,
			'bahan'    => $this->request_model->getbahan(),
			'tunggu'    => $this->request_model->tunggu(),
			'tgl'            => $tgl,
			'req'    => $this->request_model->getrequest($id_dapur, $tgl)
		);
		$this->load->view('template/header.php', $data);
		$this->load->view('template/sidebar.php', $data);
		$this->load->view('pages/stok/request_cabang.php', $data);
		$this->load->view('template/footer.php');
	}

	public function index2()
	{
		role2();
		$tgl = $this->session->userdata('tglll');
		$id_dapur  = $this->session->userdata('id_dapur');
		foreach ($this->request_model->dapur($id_dapur) as $dpr) {
			$dapur = $dpr->nama_dapur;
		}
		$data = array(
			'title'     => 'Data Request',
			'dapur'    => $dapur,
			'bahan'    => $this->request_model->getbahan(),
			'tunggu'    => $this->request_model->tunggu(),
			'tgl'            => $tgl,
			'req'    => $this->request_model->getrequest($id_dapur, $tgl)
		);
		$this->load->view('template/header.php', $data);
		$this->load->view('template/sidebar.php', $data);
		$this->load->view('pages/stok/request_cabang.php', $data);
		$this->load->view('template/footer.php');
	}

	public function utama()
	{
		role1();
		$tglll = $this->input->post('tanggal');
		if (!isset($tglll)) {
			$tgl    =  date('Y-m-d');
		} else {
			$tgl = $this->input->post('tanggal');
		}

		$this->session->set_userdata('tglll', $tgl);

		$data = array(
			'title'     => 'Data Request',
			'tgl'            => $tgl,
			'bahan'    => $this->request_model->getbahan(),
			'tunggu'    => $this->request_model->tunggu(),
			'req'    => $this->request_model->getrequest2($tgl)
		);
		$this->load->view('template/header.php', $data);
		$this->load->view('template/sidebar.php', $data);
		$this->load->view('pages/stok/request.php', $data);
		$this->load->view('template/footer.php');
	}

	public function utama2()
	{
		role1();
		$tgl = $this->session->userdata('tglll');
		$data = array(
			'title'     => 'Data Request',
			'tgl'            => $tgl,
			'bahan'    => $this->request_model->getbahan(),
			'tunggu'    => $this->request_model->tunggu(),
			'req'    => $this->request_model->getrequest2($tgl)
		);
		$this->load->view('template/header.php', $data);
		$this->load->view('template/sidebar.php', $data);
		$this->load->view('pages/stok/request.php', $data);
		$this->load->view('template/footer.php');
	}

	public function tambah()
	{
		role2();
		$id_dapur = $this->session->userdata('id_dapur');
		$id_bahan = $this->input->post('id_bahan');
		$jumlah = $this->input->post('jumlah');
		$status    = $this->input->post('status');
		$tgl    = $this->input->post('tanggal');
		foreach ($this->request_model->getharga($id_bahan) as $h) {
			$hargasatuan = $h->harga / $h->per;
		}
		$total_harga      = $jumlah * $hargasatuan;

		$data = array(
			'id_dapur'     => $id_dapur,
			'id_bahan'   => $id_bahan,
			'jumlah'   => $jumlah,
			'total_harga'   => $total_harga,
			'status'   => $status,
			'tanggal'     =>    $tgl
		);
		$this->request_model->inputreq($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
		redirect(base_url('request-cabang-'), 'refresh');
	}

	public function hapus($id)
	{
		role2();
		$this->request_model->hapusreq($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus!</div>');
		redirect(base_url('request-cabang-'), 'refresh');
	}

	public function input($id)
	{
		role1();
		$id_dapur  = $this->input->post('id_dapur');
		$id_bahan  = $this->input->post('id_bahan');
		$jml        = $this->input->post('jumlah');
		$total_harga        = $this->input->post('total_harga');
		$status        = $this->input->post('status');
		if ($this->request_model->cpsa($id_dapur, $id_bahan)) {
			foreach ($this->request_model->cpsa($id_dapur, $id_bahan) as $sa) {
				$cpsa = $sa->jumlah;
			}
		} else {
			$cpsa = 0;
		}
		$tgl        =  $this->input->post('tanggal');
		foreach ($this->request_model->cekstok($id_bahan) as $stok) {
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
				$data2 = array(
					'status'     => $status
				);
				$jumlahStokTotal = $cpsa + $jml;
				if ($this->request_model->cekId($id_dapur, $id_bahan)) {
					$this->request_model->inputdropstok($data);
					$this->request_model->updatestokCabang($id_dapur, $id_bahan, $jumlahStokTotal);
					$this->request_model->updatestokBahan($id_bahan, $jml);
					$this->request_model->status($data2, $id);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
					redirect(base_url('request-'), 'refresh');
				} else {
					$stok = array(
						'id_dapur'     => $id_dapur,
						'id_bahan'     => $id_bahan,
						'jumlah'        => $jumlahStokTotal,
						'tgl_input'     => date('Y-m-d H:i:s')
					);
					$this->request_model->tambahstok($stok);
					$this->request_model->updatestokBahan($id_bahan, $jml);
					$this->request_model->inputdropstok($data);
					$this->request_model->status($data2, $id);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
					redirect(base_url('request-'), 'refresh');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Stok bahan tidak cukup, silahkan update stok terlebih dahulu.</div>');
				redirect(base_url('request-'), 'refresh');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Stok tidak bisa Nol !</div>');
			redirect(base_url('request-'), 'refresh');
		}
	}
}
