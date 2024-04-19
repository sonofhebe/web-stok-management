
<?php

class kategoriproduk_model extends CI_Model
{
    public function inputkategoriproduk($data)
    {
        $this->db->insert('kategoriproduk', $data);
    }

    public function getKategoriproduk()
    {
        $this->db->order_by('id_kategoriproduk', 'DESC');
        return $this->db->get('kategoriproduk')->result();
    }

    public function hapuskategoriproduk($id)
    {
        $this->db->where('id_kategoriproduk', $id);
        $this->db->delete('kategoriproduk');
    }

    public function editKategoriproduk($data, $id)
    {
        $this->db->where('id_kategoriproduk', $id);
        $this->db->set($data);
        $this->db->update('kategoriproduk');
    }

    public function cekId($id)
    {
        $this->db->where('id_kategoriproduk', $id);
        return $this->db->get('produk')->row();
    }
}
