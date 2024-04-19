
<?php
class Satuan_model extends CI_Model
{
	public function inputdata($data)
	{
		$this->db->insert('satuan', $data);
	}

	public function getSatuan()
	{
		$this->db->order_by('id_satuan', 'DESC');
		return $this->db->get('satuan')->result();
	}

	public function Hapussatuan($id)
	{
		$this->db->where('id_satuan', $id);
		$this->db->delete('satuan');
	}

	public function editSatuan($data, $id)
	{
		$this->db->where('id_satuan', $id);
		$this->db->set($data);
		$this->db->update('satuan');
	}

	public function cekId($id)
	{
		$this->db->where('id_satuan', $id);
		return $this->db->get('bahan')->row();
	}
}
