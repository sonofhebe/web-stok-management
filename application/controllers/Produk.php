
<?php
class Produk extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('Produk_model');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$data = array(
			'title'     => 'Data Produk',
			'kategoriproduk'  => $this->Produk_model->getKategoriproduk(),
			'produk'    => $this->Produk_model->getProduk()
		);
		$this->load->view('template/header.php', $data);
		$this->load->view('template/sidebar.php', $data);
		$this->load->view('pages/produk/data_produk.php', $data);
		$this->load->view('template/footer.php');
	}

	public function variant($id)
	{
		$data = array(
			'title'     => 'Data Produk Variant',
			'produk'    => $this->Produk_model->getOne($id),
			'variant'    => $this->Produk_model->getProdukVariant($id)
		);
		$this->load->view('template/header.php', $data);
		$this->load->view('template/sidebar.php', $data);
		$this->load->view('pages/produk/variant.php', $data);
		$this->load->view('template/footer.php');
	}
	public function resep($id)
	{
		$data = array(
			'title'     => 'Data Produk Resep',
			'produk'    => $this->Produk_model->getOne($id),
			'resep'    => $this->Produk_model->getProdukResep($id)
		);
		$this->load->view('template/header.php', $data);
		$this->load->view('template/sidebar.php', $data);
		$this->load->view('pages/produk/resep.php', $data);
		$this->load->view('template/footer.php');
	}
	public function resepdetail($id)
	{
		$data = array(
			'title'     => 'Data Produk Resep Detail',
			'resep'    => $this->Produk_model->getOneResep($id),
			'bahan'    => $this->Produk_model->getBahan(),
			'resep_detail'    => $this->Produk_model->getProdukResepDetail($id)
		);
		$this->load->view('template/header.php', $data);
		$this->load->view('template/sidebar.php', $data);
		$this->load->view('pages/produk/resep_detail.php', $data);
		$this->load->view('template/footer.php');
	}
	public function produkpackaging($id)
	{
		$data = array(
			'title'     => 'Data Produk Packaging',
			'variant'    => $this->Produk_model->getOneVariant($id),
			'packaging'    => $this->Produk_model->getPackaging(),
			'produk_packaging'    => $this->Produk_model->getProdukPackaging($id)
		);
		$this->load->view('template/header.php', $data);
		$this->load->view('template/sidebar.php', $data);
		$this->load->view('pages/produk/produk_packaging.php', $data);
		$this->load->view('template/footer.php');
	}
	public function tambahvariant()
	{
		role1();
		$id_produk = $this->input->post('id_produk');
		$nama = $this->input->post('nama');
		$harga = $this->input->post('harga');

		$data = array(
			'id_produk'   => $id_produk,
			'nama'   => $nama,
			'harga'         => $harga
		);
		$this->db->insert('produk_variant', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
		redirect(base_url('data-produk/variant/' . $id_produk), 'refresh');
	}
	public function tambahresep()
	{
		role1();
		$id_produk = $this->input->post('id_produk');
		$nama = $this->input->post('nama');

		$data = array(
			'id_produk'   => $id_produk,
			'nama'   => $nama,
		);
		$this->db->insert('produk_resep', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
		redirect(base_url('data-produk/resep/' . $id_produk), 'refresh');
	}
	public function tambahresepdetail()
	{
		role1();
		$id_produk_resep = $this->input->post('id_produk_resep');
		$id_bahan = $this->input->post('id_bahan');
		$jumlah = $this->input->post('jumlah');

		$data = array(
			'id_produk_resep'   => $id_produk_resep,
			'id_bahan'   => $id_bahan,
			'jumlah'   => $jumlah,
		);
		$this->db->insert('produk_resep_detail', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
		redirect(base_url('data-produk/resep/detail/' . $id_produk_resep), 'refresh');
	}

	public function tambahprodukpackaging()
	{
		role1();
		$id_produk_variant = $this->input->post('id_produk_variant');
		$id_bahan = $this->input->post('id_bahan');

		$data = array(
			'id_produk_variant'   => $id_produk_variant,
			'id_bahan'   => $id_bahan,
		);
		$this->db->insert('produk_packaging', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
		redirect(base_url('data-produk/variant/packaging/' . $id_produk_variant), 'refresh');
	}

	public function tambahproduk()
	{
		role1();
		$id_k = $this->input->post('id_kategoriproduk');
		$nama = $this->input->post('nama_produk');
		// $harga = $this->input->post('harga');

		$data = array(
			'id_kategoriproduk'   => $id_k,
			'nama_produk'   => $nama,
			// 'harga'         => $harga,
			'tgl_input'     => date('Y-m-d H:i:s')
		);
		$this->Produk_model->inputproduk($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
		redirect(base_url('data-produk'), 'refresh');
	}

	public function hapusproduk($id)
	{
		role1();
		$this->Produk_model->hapusProduk($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus!</div>');
		redirect(base_url('data-produk'), 'refresh');
	}
	public function hapusvariant($id_produk, $id)
	{
		role1();
		$this->db->where('id_produk_variant', $id);
		$this->db->delete('produk_variant');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus!</div>');
		redirect(base_url('data-produk/variant/' . $id_produk), 'refresh');
	}
	public function hapusprodukpackaging($id_produk_variant, $id)
	{
		role1();
		$this->db->where('id_produk_packaging', $id);
		$this->db->delete('produk_packaging');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus!</div>');
		redirect(base_url('data-produk/variant/packaging/' . $id_produk_variant), 'refresh');
	}
	public function hapusprodukresepdetail($id_produk_resep, $id)
	{
		role1();
		$this->db->where('id_produk_resep_detail', $id);
		$this->db->delete('produk_resep_detail');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus!</div>');
		redirect(base_url('data-produk/resep/detail/' . $id_produk_resep), 'refresh');
	}
	public function hapusprodukresep($id_produk_resep, $id)
	{
		role1();
		$this->db->where('id_produk_resep', $id);
		$this->db->delete('produk_resep');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus!</div>');
		redirect(base_url('data-produk/resep/' . $id_produk_resep), 'refresh');
	}

	public function editproduk($id)
	{
		role1();
		$id_k = $this->input->post('id_kategoriproduk');
		$nama = $this->input->post('nama_produk');
		// $harga = $this->input->post('harga');

		$data = array(
			'id_kategoriproduk'   => $id_k,
			'nama_produk'   => $nama,
			// 'harga'         => $harga,
			'tgl_update'     => date('Y-m-d H:i:s')
		);
		$this->Produk_model->editProduk($data, $id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di edit !</div>');
		redirect(base_url('data-produk'), 'refresh');
	}
	public function editvariant($id_produk, $id)
	{
		role1();
		$nama = $this->input->post('nama');
		$harga = $this->input->post('harga');

		$data = array(
			'nama'   => $nama,
			'harga'  => $harga,
		);
		$this->db->where('id_produk_variant', $id);
		$this->db->set($data);
		$this->db->update('produk_variant');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di edit !</div>');
		redirect(base_url('data-produk/variant/' . $id_produk), 'refresh');
	}
	public function editprodukresep($id_produk, $id)
	{
		role1();
		$nama = $this->input->post('nama');

		$data = array(
			'nama'   => $nama,
		);
		$this->db->where('id_produk_resep', $id);
		$this->db->set($data);
		$this->db->update('produk_resep');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di edit !</div>');
		redirect(base_url('data-produk/resep/' . $id_produk), 'refresh');
	}
	public function editprodukpackaging($id_produk_variant, $id)
	{
		role1();
		$id_bahan = $this->input->post('id_bahan');

		$data = array(
			'id_bahan'   => $id_bahan,
		);
		$this->db->where('id_produk_packaging', $id);
		$this->db->set($data);
		$this->db->update('produk_packaging');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di edit !</div>');
		redirect(base_url('data-produk/variant/packaging/' . $id_produk_variant), 'refresh');
	}
	public function editprodukresepdetail($id_produk_resep, $id)
	{
		role1();
		$id_bahan = $this->input->post('id_bahan');
		$jumlah = $this->input->post('jumlah');

		$data = array(
			'id_bahan'   => $id_bahan,
			'jumlah'   => $jumlah,
		);
		$this->db->where('id_produk_resep_detail', $id);
		$this->db->set($data);
		$this->db->update('produk_resep_detail');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di edit !</div>');
		redirect(base_url('data-produk/resep/detail/' . $id_produk_resep), 'refresh');
	}
}
