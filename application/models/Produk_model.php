
<?php
class Produk_model extends CI_Model
{
	public function getKategoriproduk()
	{
		$this->db->order_by('id_kategoriproduk', 'DESC');
		return $this->db->get('kategoriproduk')->result();
	}

	public function inputproduk($data)
	{
		$this->db->insert('produk', $data);
	}

	public function getOne($id)
	{
		$this->db->select('produk.*, nama_kategoriproduk',  false);
		$this->db->from('produk');
		$this->db->join('kategoriproduk', 'kategoriproduk.id_kategoriproduk=produk.id_kategoriproduk');
		$this->db->where('produk.id_produk', $id);

		return $this->db->get()->result();
	}

	public function getProduk()
	{
		$this->db->select('produk.*, nama_kategoriproduk, GROUP_CONCAT(IFNULL(jadwal.hari, "-")) as jadwal_hari',  false);
		$this->db->from('produk');
		$this->db->join('kategoriproduk', 'kategoriproduk.id_kategoriproduk=produk.id_kategoriproduk');
		$this->db->join('jadwal', 'jadwal.id_produk = produk.id_produk', 'left'); // Menggunakan LEFT JOIN
		$this->db->group_by('produk.id_produk'); // Group by ID produk untuk menggunakan GROUP_CONCAT
		$this->db->order_by('produk.id_kategoriproduk, nama_produk', 'ASC');

		return $this->db->get()->result();
	}

	public function hapusProduk($id)
	{
		$this->db->where('id_produk', $id);
		$deleteProduk = $this->db->delete('produk');
		if ($deleteProduk) {
			$this->db->where('id_produk', $id)->delete('produk_variant');
		}
	}

	public function editProduk($data, $id)
	{
		$this->db->where('id_produk', $id);
		$this->db->set($data);
		$this->db->update('produk');
	}

	public function getProdukVariant($id)
	{
		$this->db->where('produk_variant.id_produk', $id);
		$this->db->join('produk', 'produk.id_produk=produk_variant.id_produk');
		return $this->db->get('produk_variant')->result();
	}

	public function getProdukResep($id)
	{
		$this->db->where('produk_resep.id_produk', $id);
		$this->db->join('produk', 'produk.id_produk=produk_resep.id_produk');
		return $this->db->get('produk_resep')->result();
	}
	public function getProdukResepDetail($id)
	{
		$this->db->where('id_produk_resep', $id);
		$this->db->order_by('id_produk_resep_detail', 'DESC');
		$this->db->join('bahan', 'bahan.id_bahan=produk_resep_detail.id_bahan');
		$this->db->join('satuan', 'satuan.id_satuan=bahan.id_satuan');
		return $this->db->get('produk_resep_detail')->result();
	}

	public function getProdukPackaging($id)
	{
		$this->db->where('id_produk_variant', $id);
		$this->db->order_by('id_produk_packaging', 'DESC');
		$this->db->join('bahan', 'bahan.id_bahan=produk_packaging.id_bahan');
		return $this->db->get('produk_packaging')->result();
	}
	public function getOneVariant($id)
	{
		$this->db->where('produk_variant.id_produk_variant', $id);
		$this->db->join('produk', 'produk.id_produk=produk_variant.id_produk');
		return $this->db->get('produk_variant')->result();
	}
	public function getOneResep($id)
	{
		$this->db->where('produk_resep.id_produk_resep', $id);
		$this->db->join('produk', 'produk.id_produk=produk_resep.id_produk');
		return $this->db->get('produk_resep')->result();
	}
	public function getPackaging()
	{
		$this->db->where('id_kategori', '7');
		$this->db->order_by('nama_bahan', 'DESC');
		return $this->db->get('bahan')->result();
	}
	public function getBahan()
	{
		$this->db->where('id_kategori', '6');
		$this->db->order_by('nama_bahan', 'DESC');
		return $this->db->get('bahan')->result();
	}
}
