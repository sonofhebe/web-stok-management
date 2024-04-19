
<?php

class Kategori_model extends CI_Model
{
    public function inputkategori($data)
    {
        $this->db->insert('kategori', $data);
    }

    public function getKategori()
    {
        $this->db->order_by('id_kategori', 'DESC');
        return $this->db->get('kategori')->result();
    }

    public function hapuskategori($id)
    {
        $this->db->where('id_kategori', $id);
        $this->db->delete('kategori');
    }

    public function editKategori($data, $id)
    {
        $this->db->where('id_kategori', $id);
        $this->db->set($data);
        $this->db->update('kategori');
    }

    public function cekId($id)
    {
        $this->db->where('id_kategori', $id);
        return $this->db->get('produk')->row();
    }
}
