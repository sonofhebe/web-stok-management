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

    public function getProduk()
    {
        $this->db->order_by('produk.id_kategoriproduk, nama_produk', 'ASC');
        $this->db->join('kategoriproduk', 'kategoriproduk.id_kategoriproduk=produk.id_kategoriproduk');
        return $this->db->get('produk')->result();
    }

    public function hapusProduk($id)
    {
        $this->db->where('id_produk', $id);
        $this->db->delete('produk');
    }

    public function editProduk($data, $id)
    {
        $this->db->where('id_produk', $id);
        $this->db->set($data);
        $this->db->update('produk');
    }
}
