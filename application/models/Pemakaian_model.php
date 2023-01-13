<?php
class pemakaian_model extends CI_Model
{
    public function getproduk()
    {
        $this->db->order_by('produk.id_kategoriproduk, nama_produk', 'ASC');
        $this->db->join('kategoriproduk', 'kategoriproduk.id_kategoriproduk=produk.id_kategoriproduk');
        $this->db->order_by('produk.id_kategoriproduk', 'ASC');
        $this->db->order_by('nama_produk', 'ASC');
        return $this->db->get('produk')->result();
    }
    
    public function gettakaran()
    {
        $this->db->join('bahan', 'bahan.id_bahan=takaran.id_bahan');
        $this->db->join('kategori', 'kategori.id_kategori=bahan.id_kategori');
        $this->db->order_by('bahan.id_kategori', 'ASC');
        $this->db->order_by('nama_takaran', 'ASC');
        return $this->db->get('takaran')->result();
    }

    public function getpemakaian($id_dapur, $tgl)
    {
        $this->db->where('tanggal', $tgl);
        $this->db->where('pemakaian.id_dapur', $id_dapur);
        $this->db->join('resep', 'resep.id_resep=pemakaian.id_resep');
        $this->db->join('produk', 'produk.id_produk=resep.id_produk');
        $this->db->join('takaran', 'takaran.id_takaran=resep.id_takaran');
        $this->db->join('bahan', 'bahan.id_bahan=resep.id_bahan');
        $this->db->join('satuan', 'satuan.id_satuan=bahan.id_satuan');
        $this->db->order_by('id_pemakaian', 'DESC');
        return $this->db->get('pemakaian')->result();
    }

    public function cekresep($id_produk, $id_takaran)
    {
        $this->db->where('id_produk', $id_produk);
        $this->db->where('id_takaran', $id_takaran);
        return $this->db->get('resep')->result();
    }

    public function cekstok($id_dapur, $id_bahan)
    {
        $this->db->where('id_dapur', $id_dapur);
        $this->db->where('id_bahan', $id_bahan);
        return $this->db->get('stok')->result();
    }

    public function cek($id_dapur, $produk, $tgl)
    {
        $this->db->join('resep', 'resep.id_resep=pemakaian.id_resep');
        $this->db->where('id_dapur', $id_dapur);
        $this->db->where('tanggal', $tgl);
        $this->db->where('id_produk', $produk);
        return $this->db->get('pemakaian')->result();
    }

    public function inputpemakaian($data)
    {
        $this->db->insert('pemakaian', $data);
    }

    public function hapuspemakaian($id)
    {
        $this->db->where('id_pemakaian', $id);
        $this->db->delete('pemakaian');
    }
}
