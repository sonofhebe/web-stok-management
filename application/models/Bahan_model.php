
<?php
class bahan_model extends CI_Model
{
	public function getSatuan()
	{
		$this->db->order_by('id_satuan', 'DESC');
		return $this->db->get('satuan')->result();
	}

	public function getKategori()
	{
		$this->db->order_by('id_kategori', 'DESC');
		return $this->db->get('kategori')->result();
	}

	public function inputbahan($data)
	{
		$this->db->insert('bahan', $data);
	}

	public function inputtakaran($data2)
	{
		$this->db->insert('bahan', $data2);
	}

	public function getbahan()
	{
		$this->db->order_by('id_bahan', 'DESC');
		$this->db->join('satuan', 'satuan.id_satuan=bahan.id_satuan');
		$this->db->join('kategori', 'kategori.id_kategori=bahan.id_kategori');
		return $this->db->get('bahan')->result();
	}

	public function hapusbahan($id)
	{
		$this->db->where('id_bahan', $id);
		$this->db->delete('bahan');
	}

	public function last()
	{
		$this->db->select('id_bahan');
		$this->db->order_by('id_bahan', 'DESC');
		$this->db->limit(1);
		return $this->db->get('bahan')->result();
	}

	public function hapustakaran($id)
	{
		$this->db->where('id_bahan', $id);
		$this->db->delete('takaran');
	}

	public function editbahan($data, $id)
	{
		$this->db->where('id_bahan', $id);
		$this->db->set($data);
		$this->db->update('bahan');
	}
}
