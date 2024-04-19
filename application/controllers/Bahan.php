
<?php
class bahan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('bahan_model');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$data = array(
			'title'     => 'Data Bahan',
			'satuan'    => $this->bahan_model->getSatuan(),
			'kategori'  => $this->bahan_model->getKategori(),
			'bahan'    => $this->bahan_model->getbahan()
		);
		$this->load->view('template/header.php', $data);
		$this->load->view('template/sidebar.php', $data);
		$this->load->view('pages/bahan/data_bahan.php', $data);
		$this->load->view('template/footer.php');
	}


	public function tambahbahan()
	{
		role1();
		$id_k = $this->input->post('id_kategori');
		$id_s = $this->input->post('id_satuan');
		$nama = $this->input->post('nama_bahan');
		$stok = $this->input->post('stok');
		$harga = $this->input->post('harga');
		$per = $this->input->post('per');

		$data = array(
			'id_kategori'   => $id_k,
			'id_satuan'     => $id_s,
			'nama_bahan'   => $nama,
			'stok'          => $stok,
			'harga'          => $harga,
			'per'          => $per,
			'tgl_input'     => date('Y-m-d H:i:s')
		);
		$this->bahan_model->inputbahan($data);
		foreach ($this->bahan_model->last() as $last) {
			$id_b = $last->id_bahan;
		}

		// $data2 = array(
		// 	'nama_takaran'   => $nama,
		// 	'id_bahan'          => $id_b
		// );
		// $this->bahan_model->inputtakaran($data2);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
		redirect(base_url('data-bahan'), 'refresh');
	}

	public function hapusbahan($id)
	{
		role1();
		$this->bahan_model->hapusbahan($id);
		// $this->bahan_model->hapustakaran($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus!</div>');
		redirect(base_url('data-bahan'), 'refresh');
	}

	public function editbahan($id)
	{
		role1();
		$id_k = $this->input->post('id_kategori');
		$id_s = $this->input->post('id_satuan');
		$nama = $this->input->post('nama_bahan');
		$stok = $this->input->post('stok');
		$harga = $this->input->post('harga');
		$per = $this->input->post('per');

		$data = array(
			'id_kategori'   => $id_k,
			'id_satuan'     => $id_s,
			'nama_bahan'   => $nama,
			'stok'          => $stok,
			'harga'          => $harga,
			'per'          => $per,
			'tgl_update'     => date('Y-m-d H:i:s')
		);
		$this->bahan_model->editbahan($data, $id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di edit !</div>');
		redirect(base_url('data-bahan'), 'refresh');
	}
}
