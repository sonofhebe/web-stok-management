<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('Dashboard_model');
	}

	public function index()
	{
		$terlaris = 0;
		$terlarisc = 0;
		$terbahan = 0;
		$terbahanc = 0;
        $id_dapur = $this->session->userdata('id_dapur');
		foreach ($this->Dashboard_model->terlaris() as $laris){
			$terlaris = $laris->nama_produk;
		}
        foreach ($this->Dashboard_model->terbahan() as $laris){
            $terbahan = $laris->nama_bahan;
        }
		foreach ($this->Dashboard_model->terlarisc($id_dapur) as $laris){
			$terlarisc = $laris->nama_produk;
		}
		foreach ($this->Dashboard_model->terbahanc($id_dapur) as $laris){
			$terbahanc = $laris->nama_bahan;
		} 
		if ($terlaris == 0) {
			$terlaris = '';
		} else if ($terlarisc == 0) {
			$terlarisc = '';
		} else if ($terbahan == 0) {
			$terbahan = '';
		} else if ($terbahanc == 0) {
			$terbahanc = '';
		}
		$data = array(
			'title'			=> 'Dashboard',
			'namadapur'		=> $this->Dashboard_model->namadapur(),
			'dapur'			=> $this->Dashboard_model->dapur(),
			'produk'		=> $this->Dashboard_model->produk(),
			'penjualan'		=> $this->Dashboard_model->penjualan(),
			'penjualanc'	=> $this->Dashboard_model->penjualanc(),
			'katproduk'		=> $this->Dashboard_model->katproduk(),
			'terlaris'		=> $terlaris,
			'terlarisc'		=> $terlarisc,
			'request'		=> $this->Dashboard_model->request(),
			'requestc'		=> $this->Dashboard_model->requestc(),
			'cekstok'		=> $this->Dashboard_model->stoktipis(),
			'cekstokc'		=> $this->Dashboard_model->stoktipisc(),
			'terbahan'		=> $terbahan,
			'terbahanc'		=> $terbahanc
		);

		$this->load->view('template/header.php', $data);
		$this->load->view('template/sidebar.php', $data);
		$this->load->view('pages/dashboard.php', $data);
		$this->load->view('template/footer.php');
	}
	
	public function index2()
	{
		$data = array(
			'title'			=> 'Belum Tersedia'
		);
		$this->load->view('template/header.php', $data);
		$this->load->view('template/sidebar.php', $data);
		$this->load->view('template/belumtersedia.php', $data);
		$this->load->view('template/footer.php');
	}
}
