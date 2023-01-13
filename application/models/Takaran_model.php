<?php
class takaran_model extends CI_Model
{
    public function getbahan()
    {
        $this->db->order_by('bahan.id_kategori', 'ASC');
        $this->db->order_by('bahan.nama_bahan', 'ASC');
        $this->db->join('kategori', 'kategori.id_kategori=bahan.id_kategori');
        return $this->db->get('bahan')->result();
    }
    public function inputtakaran($data)
    {
        $this->db->insert('takaran', $data);
    }

    public function gettakaran()
    {
        $this->db->order_by('id_takaran', 'DESC');
        $this->db->join('bahan', 'bahan.id_bahan=takaran.id_bahan');
        $this->db->join('satuan', 'satuan.id_satuan=bahan.id_satuan');
        $this->db->join('kategori', 'kategori.id_kategori=bahan.id_kategori');
        return $this->db->get('takaran')->result();
    }

    public function hapustakaran($id)
    {
        $this->db->where('id_takaran', $id);
        $this->db->delete('takaran');
    }

    public function edittakaran($data, $id)
    {
        $this->db->where('id_takaran', $id);
        $this->db->set($data);
        $this->db->update('takaran');
    }
}
