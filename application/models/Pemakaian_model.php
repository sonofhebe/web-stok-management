
<?php
class pemakaian_model extends CI_Model
{
	public function getProdukResep()
	{
		$this->db->join('produk', 'produk.id_produk=produk_resep.id_produk');
		$this->db->join('kategoriproduk', 'kategoriproduk.id_kategoriproduk=produk.id_kategoriproduk');
		$this->db->order_by('kategoriproduk.id_kategoriproduk', 'ASC');
		$this->db->order_by('nama', 'ASC');
		return $this->db->get('produk_resep')->result();
	}

	public function getpemakaian($id_dapur, $tgl)
	{
		$this->db->where('tanggal', $tgl);
		$this->db->where('pemakaian.id_dapur', $id_dapur);
		$this->db->join('produk_resep', 'produk_resep.id_produk_resep=pemakaian.id_resep');
		// $this->db->join('produk', 'produk.id_produk=produk_resep.id_produk');
		$this->db->join('bahan', 'bahan.id_bahan=pemakaian.id_bahan');
		$this->db->join('satuan', 'satuan.id_satuan=bahan.id_satuan');
		$this->db->order_by('id_pemakaian', 'DESC');
		return $this->db->get('pemakaian')->result();
	}

	public function cek($id_dapur, $produk, $tgl)
	{
		$this->db->join('resep', 'resep.id_resep=pemakaian.id_resep');
		$this->db->where('id_dapur', $id_dapur);
		$this->db->where('tanggal', $tgl);
		$this->db->where('id_produk', $produk);
		return $this->db->get('pemakaian')->result();
	}

	public function cekStok($id_produk_resep, $id_dapur, $sc)
	{
		//get resep detail bahan
		$this->db->where('id_produk_resep', $id_produk_resep);
		$resep = $this->db->get('produk_resep_detail')->result();

		if (!$resep) {
			return false;
		}
		// cek stok di dapur
		$stokKurang = [];
		foreach ($resep as $key => $bahan) {
			$stokDapur = $this->db->where('id_dapur', $id_dapur)->where('id_bahan', $bahan->id_bahan)->get('stok')->result();
			if ($stokDapur) {
				$stokDapur = $stokDapur[0]->jumlah;
				$stokPakai = $bahan->jumlah * $sc;
				// jika stok dapur lebih sedikit dari pakai, brarti stok tidak cukup
				if ($stokDapur < $stokPakai) {
					$stokKurang[] = $this->db->where('id_bahan', $bahan->id_bahan)->get('bahan')->result()[0]->nama_bahan;
				}
			} else {
				// handle jika stok bahan belum ada
				$stokKurang[] = $this->db->where('id_bahan', $bahan->id_bahan)->get('bahan')->result()[0]->nama_bahan;
			}
		}
		return $stokKurang;
	}

	public function inputpemakaian($id_produk_resep, $id_dapur, $sc, $tgl)
	{
		//get resep detail bahan
		$this->db->where('id_produk_resep', $id_produk_resep);
		$resep = $this->db->get('produk_resep_detail')->result();

		// cek stok di dapur
		foreach ($resep as $key => $bahan) {
			$stokDapur = $this->db->where('id_dapur', $id_dapur)->where('id_bahan', $bahan->id_bahan)->get('stok')->result()[0]->jumlah;
			$stokPakai = $bahan->jumlah * $sc;
			$newStok = $stokDapur - $stokPakai;
			// Update the stok table
			$this->db->where('id_dapur', $id_dapur)->where('id_bahan', $bahan->id_bahan)->update('stok', ['jumlah' => $newStok]);

			//add pemakaian
			$data = array(
				'id_dapur'     => $id_dapur,
				'id_resep'   => $id_produk_resep,
				'id_bahan'   => $bahan->id_bahan,
				'sc'   => $sc,
				'jumlah'   => $stokPakai,
				'tanggal'     =>    $tgl
			);
			$this->db->insert('pemakaian', $data);
		}
	}

	public function hapuspemakaian($id)
	{
		$pemakaian = $this->db->where('id_pemakaian', $id)->get('pemakaian')->result()[0];
		$stokDapur = $this->db->where('id_dapur', $pemakaian->id_dapur)->where('id_bahan', $pemakaian->id_bahan)->get('stok')->result()[0]->jumlah;
		$newStok = $stokDapur + $pemakaian->jumlah;

		$this->db->where('id_pemakaian', $id);
		$this->db->delete('pemakaian');
		// Update the stok table
		$this->db->where('id_dapur', $pemakaian->id_dapur)->where('id_bahan', $pemakaian->id_bahan)->update('stok', ['jumlah' => $newStok]);
	}
}
