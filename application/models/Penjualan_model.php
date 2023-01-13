<?php
class penjualan_model extends CI_Model
{
    public function getProduk()
    {
        $this->db->join('kategoriproduk', 'kategoriproduk.id_kategoriproduk=produk.id_kategoriproduk');
        $this->db->order_by('produk.id_kategoriproduk, nama_produk', 'ASC');
        return $this->db->get('produk')->result();
    }

    public function getpenjualan($id_dapur, $tgll)
    {
        $this->db->where('id_dapur', $id_dapur);
        $this->db->where('tanggal', $tgll);
        $this->db->order_by('id_penjualan', 'DESC');
        $this->db->join('produk', 'produk.id_produk=penjualan.id_produk');
        $this->db->join('kategoriproduk', 'kategoriproduk.id_kategoriproduk=produk.id_kategoriproduk');
        return $this->db->get('penjualan')->result();
    }

    public function inputpenjualan($data)
    {
        $this->db->insert('penjualan', $data);
    }

    public function cek($id_dapur, $produk, $tgl)
    {
        $this->db->where('id_dapur', $id_dapur);
        $this->db->where('id_produk', $produk);
        $this->db->where('tanggal', $tgl);
        return $this->db->get('penjualan')->result();
    }

    public function hapuspenjualan($id)
    {
        $this->db->where('id_penjualan', $id);
        $this->db->delete('penjualan');
    }

    public function editpenjualan($data, $id)
    {
        $this->db->where('id_penjualan', $id);
        $this->db->set($data);
        $this->db->update('penjualan');
    }
}
