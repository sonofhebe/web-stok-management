
<?php
class dropstok_model extends CI_Model
{
	public function getdapur()
	{
		$this->db->order_by('id_dapur', 'DESC');
		return $this->db->get('dapur')->result();
	}

	public function getbahan()
	{
		$this->db->order_by('bahan.id_kategori', 'ASC');
		$this->db->order_by('nama_bahan', 'ASC');
		$this->db->join('satuan', 'satuan.id_satuan=bahan.id_satuan');
		$this->db->join('kategori', 'kategori.id_kategori=bahan.id_kategori');
		return $this->db->get('bahan')->result();
	}

	public function getharga($id_bahan)
	{
		$this->db->where('id_bahan', $id_bahan);
		return $this->db->get('bahan')->result();
	}

	public function getdropstok($tgll)
	{
		$this->db->where('tanggal', $tgll);
		$this->db->order_by('id_drop_stok', 'DESC');
		$this->db->join('dapur', 'dapur.id_dapur=drop_stok.id_dapur');
		$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
		$this->db->join('satuan', 'satuan.id_satuan=bahan.id_satuan');
		return $this->db->get('drop_stok')->result();
	}

	public function getdropstokcabang($tgll)
	{
		$this->db->where('drop_stok.id_dapur', $this->session->userdata('id_dapur'));
		$this->db->where('tanggal', $tgll);
		$this->db->order_by('id_drop_stok', 'DESC');
		$this->db->join('dapur', 'dapur.id_dapur=drop_stok.id_dapur');
		$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
		$this->db->join('satuan', 'satuan.id_satuan=bahan.id_satuan');
		return $this->db->get('drop_stok')->result();
	}

	public function cpsa($id_dapur, $id_bahan, $tgl)
	{
		$this->db->where('id_dapur', $id_dapur);
		$this->db->where('id_bahan', $id_bahan);
		$this->db->where('tanggal <', $tgl);
		$this->db->order_by('tanggal', 'desc');
		return $this->db->get('drop_stok')->result();
	}

	public function cekId($id_dapur, $id_bahan)
	{
		$this->db->where('id_dapur', $id_dapur);
		$this->db->where('id_bahan', $id_bahan);
		return $this->db->get('stok')->row();
	}

	public function cekstok($id_bahan)
	{
		$this->db->select('stok');
		$this->db->where('id_bahan', $id_bahan);
		return $this->db->get('bahan')->result();
	}

	public function tambahstok($stok)
	{
		$this->db->insert('stok', $stok);
	}
	public function updatestokCabang($id_dapur, $id_bahan, $jumlahStokTotal)
	{
		$this->db->where('id_dapur', $id_dapur);
		$this->db->where('id_bahan', $id_bahan);
		$this->db->update('stok', ['jumlah' => $jumlahStokTotal]);
	}
	public function updatestokBahan($id_bahan, $jumlahStokTotal)
	{
		$stokAwal = $this->db->where('id_bahan', $id_bahan)->get('bahan')->row()->stok;
		$this->db->where('id_bahan', $id_bahan)->update('bahan', ['stok' => $stokAwal - $jumlahStokTotal]);
	}
	public function inputdropstok($data)
	{
		$this->db->insert('drop_stok', $data);
	}

	public function hapusdropstok($id)
	{
		$drop = $this->db->where('id_drop_stok', $id)->get('drop_stok')->row();
		$stokBahan = $this->db->where('id_bahan', $drop->id_bahan)->get('bahan')->row()->stok;
		$stokCabang = $this->db->where('id_dapur', $drop->id_dapur)->where('id_bahan', $drop->id_bahan)->get('stok')->row()->jumlah;
		$this->db->where('id_bahan', $drop->id_bahan)->update('bahan', ['stok' => $stokBahan + $drop->jumlah]);
		$this->db->where('id_dapur', $drop->id_dapur)->where('id_bahan', $drop->id_bahan)->update('stok', ['jumlah' => $stokCabang - $drop->jumlah]);
		$this->db->where('id_drop_stok', $id);
		$this->db->delete('drop_stok');
	}
}
