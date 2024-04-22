
<?php
class stok_rusak extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('stok_rusak_model');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$tglll = $this->input->post('tanggal');
		if (!isset($tglll)) {
			$tgl    =  date('Y-m-d');
		} else {
			$tgl = $this->input->post('tanggal');
		}

		$dapur = null;
		$id_dapur = null;
		if ($this->session->userdata('role_id') != 1) {
			$id_dapur  = $this->session->userdata('id_dapur');
			foreach ($this->stok_rusak_model->dapur($id_dapur) as $dpr) {
				$dapur = $dpr->nama_dapur;
			}
		}

		$data = array(
			'title'     => 'Data Request',
			'dapur'    => $dapur,
			'bahan'    => $this->stok_rusak_model->getbahan($id_dapur),
			'tunggu'    => $this->stok_rusak_model->tunggu($id_dapur),
			'tgl'       => $tgl,
			'data'    => $this->stok_rusak_model->getstokrusak($id_dapur, $tgl)
		);

		$this->load->view('template/header.php', $data);
		$this->load->view('template/sidebar.php', $data);
		$this->load->view('pages/stok/stok_rusak.php', $data);
		$this->load->view('template/footer.php');
	}

	public function tambah()
	{
		role2();
		$id_dapur = $this->session->userdata('id_dapur');
		$id_bahan = $this->input->post('id_bahan');
		$jumlah = $this->input->post('jumlah');
		$tgl    = $this->input->post('tanggal');
		$sebab    = $this->input->post('sebab');
		$catatan    = $this->input->post('catatan');

		$data = array(
			'id_dapur'     => $id_dapur,
			'id_bahan'   => $id_bahan,
			'jumlah'   => $jumlah,
			'sebab'   => $sebab,
			'catatan'   => $catatan,
			'tanggal'     =>    $tgl
		);

		$cekStok = $this->stok_rusak_model->cekstok($id_dapur, $id_bahan)[0];
		if ($cekStok->jumlah < $jumlah) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Jumlah melebihi stok dapur!</div>');
			redirect(base_url('stok-rusak'), 'refresh');
		}

		$this->stok_rusak_model->input($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
		redirect(base_url('stok-rusak'), 'refresh');
	}

	public function batal($id)
	{
		role2();
		$this->db->where('id_stok_rusak', $id);
		$this->db->delete('stok_rusak');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Laporan berhasil dibatalkan!</div>');
		redirect(base_url('stok-rusak'), 'refresh');
	}

	public function konfirmasi($id)
	{
		role1();
		$dataRusak = $this->db->where('id_stok_rusak', $id)->get('stok_rusak')->result()[0];
		$update = $this->db->where('id_stok_rusak', $id)->set(['status' => 2])->update('stok_rusak');
		if ($update) {
			$stok = $this->db->where('id_dapur', $dataRusak->id_dapur)->where('id_bahan', $dataRusak->id_bahan);
			$newJumlah = $stok->get('stok')->result()[0]->jumlah - $dataRusak->jumlah;
			$this->db->where('id_dapur', $dataRusak->id_dapur)->where('id_bahan', $dataRusak->id_bahan)->set(['jumlah' => $newJumlah])->update('stok');
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dikonfirmasi!</div>');
		redirect(base_url('stok-rusak'), 'refresh');
	}

	public function tolak($id)
	{
		role1();
		$dataRusak = $this->db->where('id_stok_rusak', $id)->get('stok_rusak')->result()[0];
		$update = $this->db->where('id_stok_rusak', $id)->set(['status' => 3])->update('stok_rusak');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di tolak!</div>');
		redirect(base_url('stok-rusak'), 'refresh');
	}

	public function hapus($id)
	{
		role1();
		$dataRusak = $this->db->where('id_stok_rusak', $id)->get('stok_rusak')->result()[0];
		$delete = $this->db->where('id_stok_rusak', $id)->delete('stok_rusak');
		if ($delete) {
			$stok = $this->db->where('id_dapur', $dataRusak->id_dapur)->where('id_bahan', $dataRusak->id_bahan);
			$newJumlah = $stok->get('stok')->result()[0]->jumlah + $dataRusak->jumlah;
			$this->db->where('id_dapur', $dataRusak->id_dapur)->where('id_bahan', $dataRusak->id_bahan)->set(['jumlah' => $newJumlah])->update('stok');
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus!</div>');
		redirect(base_url('stok-rusak'), 'refresh');
	}
}
