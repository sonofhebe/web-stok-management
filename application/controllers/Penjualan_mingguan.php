
<?php
class penjualan_mingguan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cek_login();
		role1();
		$this->load->model('penjualanmingguan_model');
	}

	public function index()
	{
		$awal = $this->input->post('awal');
		$id_dapur = $this->input->post('id_dapur');
		$dapur = $this->penjualanmingguan_model->dapur($id_dapur);
		if ($id_dapur == 0) {
			$nama_dapur = 'SEMUA DAPUR';
			$idd = 0;
		} else {
			$nama_dapur = $dapur->nama_dapur;
			$idd = 1;
		}
		if ($idd == 0) {
			foreach ($this->penjualanmingguan_model->terlaris($awal) as $laris) {
				$terlaris = $laris->nama;
			}
		} else {
			foreach ($this->penjualanmingguan_model->terlarisc($awal, $id_dapur) as $laris) {
				$terlaris = $laris->nama;
			}
		}
		if (isset($terlaris)) {
			$terlariss = $terlaris;
		} else {
			$terlariss = "-";
		}
		$data = array(
			'title' => 'Cetak Laporan',
			'awal' => $awal,
			'id_dapur' => $id_dapur,
			'nama_dapur'        => $nama_dapur,
			'tanggal'        => $this->penjualanmingguan_model->tanggal($awal),
			'terlaris'        => $terlariss,
			'produk'        => $this->penjualanmingguan_model->produk()
		);

		$this->load->view('template/header.php', $data);
		$this->load->view('template/sidebar.php', $data);
		$this->load->view('pages/laporan/penjualan_mingguan.php', $data);
		$this->load->view('template/footer.php');
	}

	public function print()
	{
		$awal = $this->input->post('awal');
		$id_dapur = $this->input->post('id_dapur');
		$dapur = $this->penjualanmingguan_model->dapur($id_dapur);
		if ($id_dapur == 0) {
			$nama_dapur = 'SEMUA DAPUR';
		} else {
			$nama_dapur = $dapur->nama_dapur;
		}
		foreach ($this->penjualanmingguan_model->terlaris($awal) as $laris) {
			$terlaris = $laris->nama;
		}
		if (isset($terlaris)) {
			$terlaris = $terlaris;
		} else {
			$terlaris = "-";
		}

		$data = array(
			'title' => 'Cetak Laporan',
			'awal' => $awal,
			'id_dapur' => $id_dapur,
			'nama_dapur'        => $nama_dapur,
			'tanggal'        => $this->penjualanmingguan_model->tanggal($awal),
			'terlaris'        => $terlaris,
			'produk'        => $this->penjualanmingguan_model->produk()
		);
		$this->load->view('pages/laporan/print/penjualan_mingguan.php', $data);
	}
}
