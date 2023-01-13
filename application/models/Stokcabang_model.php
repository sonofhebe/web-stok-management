<?php
class stokcabang_model extends CI_Model
{
    public function getstok()
    {
        $this->db->where('id_dapur', $this->session->userdata('id_dapur'));
        $this->db->order_by('bahan.id_satuan', 'DESC');
        $this->db->join('bahan', 'bahan.id_bahan=stok.id_bahan');
        $this->db->join('kategori', 'kategori.id_kategori=bahan.id_kategori');
        $this->db->join('satuan', 'satuan.id_satuan=bahan.id_satuan');
        return $this->db->get('stok')->result();
    }
}
