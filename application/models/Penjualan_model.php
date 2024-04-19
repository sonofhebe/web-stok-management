
<?php
class penjualan_model extends CI_Model
{
	public function getProduk()
	{
		$this->db->join('kategoriproduk', 'kategoriproduk.id_kategoriproduk=produk.id_kategoriproduk');
		$this->db->order_by('produk.id_kategoriproduk, nama_produk', 'ASC');
		return $this->db->get('produk')->result();
	}

	public function getProdukVariant()
	{
		$this->db->join('produk', 'produk.id_produk=produk_variant.id_produk');
		$this->db->join('kategoriproduk', 'kategoriproduk.id_kategoriproduk=produk.id_kategoriproduk');
		$this->db->order_by('produk.id_kategoriproduk, produk.nama_produk', 'ASC');
		return $this->db->get('produk_variant')->result();
	}

	public function getpenjualan($id_dapur, $tgll)
	{
		$this->db->where('id_dapur', $id_dapur);
		$this->db->where('tanggal', $tgll);
		$this->db->order_by('id_penjualan', 'DESC');
		$this->db->join('produk_variant', 'produk_variant.id_produk_variant=penjualan.id_produk');
		$this->db->join('produk', 'produk.id_produk=produk_variant.id_produk');
		$this->db->join('kategoriproduk', 'kategoriproduk.id_kategoriproduk=produk.id_kategoriproduk');
		return $this->db->get('penjualan')->result();
	}

	public function inputpenjualan($data)
	{
		$this->db->insert('penjualan', $data);
		return $this->db->insert_id();
	}
	public function usePackaging($data, $id_penjualan)
	{
		$produk_packaging = $this->db->where('id_produk_variant', $data['id_produk'])->get('produk_packaging')->result();
		foreach ($produk_packaging as $key => $bahan) {
			$id_bahan = $bahan->id_bahan;
			$bahan_qty = $this->db->where('id_dapur', $data['id_dapur'])->where('id_bahan', $id_bahan)->get('stok')->result()[0]->jumlah - $data['jumlah'];

			//update stok
			$this->db->where('id_dapur', $data['id_dapur'])->where('id_bahan', $id_bahan)->set('jumlah', $bahan_qty)->update('stok');

			//add pemakaian
			$data = array(
				'id_dapur'     => $data['id_dapur'],
				'id_resep'   => $id_penjualan,
				'id_bahan'   => $id_bahan,
				'sc'   => $data['jumlah'],
				'jumlah'   => $data['jumlah'],
				'tanggal'     =>    $data['tanggal']
			);
			$this->db->insert('pemakaian', $data);
		}
	}

	public function cek($id_dapur, $produk, $tgl)
	{
		$this->db->where('id_dapur', $id_dapur);
		$this->db->where('id_produk', $produk);
		$this->db->where('tanggal', $tgl);
		return $this->db->get('penjualan')->result();
	}

	public function cekStok($id_dapur, $produk, $jumlah)
	{
		//get bahan packaging
		$this->db->where('id_produk_variant', $produk);
		$packaging = $this->db->get('produk_packaging')->result();

		// cek stok di dapur
		$stokKurang = [];
		foreach ($packaging as $key => $bahan) {
			$stokDapur = $this->db->where('id_dapur', $id_dapur)->where('id_bahan', $bahan->id_bahan)->get('stok')->result();
			if ($stokDapur) {
				$stokDapur = $stokDapur[0]->jumlah;
				// jika stok dapur lebih sedikit dari pakai, brarti stok tidak cukup
				if ($stokDapur < $jumlah) {
					$stokKurang[] = $this->db->where('id_bahan', $bahan->id_bahan)->get('bahan')->result()[0]->nama_bahan;
				}
			} else {
				// handle jika stok bahan belum ada
				$stokKurang[] = $this->db->where('id_bahan', $bahan->id_bahan)->get('bahan')->result()[0]->nama_bahan;
			}
		}
		return $stokKurang;
	}

	public function hapuspenjualan($id)
	{
		// Update stok
		$penjualan = $this->db->where('id_penjualan', $id)->get('penjualan')->result();
		$batalStok = $penjualan[0]->jumlah;

		// Delete penjualan entry
		$this->db->where('id_penjualan', $id);
		$this->db->delete('penjualan');

		// Fetch id_bahan from penjualan table
		$produk_packaging = $this->db->where('id_produk_variant', $penjualan[0]->id_produk)->get('produk_packaging')->result();
		foreach ($produk_packaging as $key => $bahan) {
			$id_bahan = $bahan->id_bahan;
			if ($stok_cabang = $this->db->where('id_dapur', $penjualan[0]->id_dapur)->where('id_bahan', $id_bahan)->get('stok')->result()[0]) {
				$bahan_qty = $stok_cabang->jumlah + $batalStok;
			}

			$this->db->where('id_dapur', $penjualan[0]->id_dapur)->where('id_bahan', $id_bahan);
			$this->db->set('jumlah', $bahan_qty);
			$this->db->update('stok');
		}

		//hapus pemakaian
		$this->db->where('id_resep', $id);
		$this->db->delete('pemakaian');
	}

	public function editpenjualan($data, $id)
	{
		$penjualan = $this->db->where('id_penjualan', $id)->get('penjualan')->result();
		$oldJumlah = $penjualan[0]->jumlah;

		$this->db->where('id_penjualan', $id);
		$this->db->set($data);
		$this->db->update('penjualan');

		$penjualan2 = $this->db->where('id_penjualan', $id)->get('penjualan')->result();
		$newJumlah = $penjualan2[0]->jumlah;

		$jumlah = $newJumlah - $oldJumlah;

		$produk_packaging = $this->db->where('id_produk_variant', $penjualan[0]->id_produk)->get('produk_packaging')->result();
		foreach ($produk_packaging as $key => $bahan) {
			$id_bahan = $bahan->id_bahan;
			$bahan_qty = $this->db->where('id_dapur', $penjualan[0]->id_dapur)->where('id_bahan', $id_bahan)->get('stok')->result()[0]->jumlah - $jumlah;

			//update stok
			$this->db->where('id_dapur', $penjualan[0]->id_dapur)->where('id_bahan', $id_bahan);
			$this->db->set('jumlah', $bahan_qty);
			$this->db->update('stok');

			// update pemakaian
			$this->db->where('id_dapur', $penjualan[0]->id_dapur)->where('id_resep', $id)->where('id_bahan', $id_bahan);
			$this->db->set('sc', $newJumlah);
			$this->db->set('jumlah', $newJumlah);
			$this->db->update('pemakaian');
		}
	}
}
