<?php

class Dashboard_model extends CI_Model
{
    public function  namadapur()
    {
        $this->db->where('id_dapur', $this->session->userdata('id_dapur'));
        return $this->db->get('dapur')->row();
    }

    public function  penjualan()
    {
        return $this->db->get('penjualan')->num_rows();
    }

    public function  produk()
    {
        return $this->db->get('produk')->num_rows();
    }

    public function  dapur()
    {
        return $this->db->get('dapur')->num_rows();
    }

    public function  penjualanc()
    {
        $this->db->where('id_dapur', $this->session->userdata('id_dapur'));
        return $this->db->get('penjualan')->num_rows();
    }

    public function request()
    {
        $this->db->where('status = "Tunggu"');
        return $this->db->get('req')->num_rows();
    }

    public function requestc()
    {
        $this->db->where('status = "Tunggu"');
        $this->db->where('id_dapur', $this->session->userdata('id_dapur'));
        return $this->db->get('req')->num_rows();
    }

    public function katproduk()
    {
        return $this->db->get('kategoriproduk')->result();
    }

    public function stoktipis()
    {
        $this->db->order_by('id_bahan', 'DESC');
        $this->db->where('stok <=', '5000');
        $this->db->where('id_kategori', '6');
        $this->db->join('satuan', 'satuan.id_satuan=bahan.id_satuan');
        return $this->db->get('bahan')->result();
    }

    public function stoktipisc()
    {
        $this->db->order_by('jumlah', 'DESC');
        $this->db->where('jumlah <=', '5000');
        $this->db->where('id_kategori', '6');
        $this->db->where('id_dapur', $this->session->userdata('id_dapur'));
        $this->db->join('bahan', 'bahan.id_bahan=stok.id_bahan');
        $this->db->join('satuan', 'satuan.id_satuan=bahan.id_satuan');
        return $this->db->get('stok')->result();
    }

    public function terlaris()
    {
        $this->db->select('sum(jumlah), nama_produk');
        $this->db->group_by('penjualan.id_produk'); 
        $this->db->where('tanggal BETWEEN SYSDATE() - INTERVAL 1 WEEK AND SYSDATE()');
        $this->db->join('produk', 'produk.id_produk=penjualan.id_produk');
        $this->db->order_by('sum(jumlah)', 'DESC');
        $this->db->limit(1);
        return $this->db->get('penjualan')->result();
    }

    public function terlarisc($id_dapur)
    {
        $this->db->select('sum(jumlah), nama_produk');
        $this->db->group_by('penjualan.id_produk'); 
        $this->db->where('tanggal BETWEEN SYSDATE() - INTERVAL 1 WEEK AND SYSDATE()');
        $this->db->where('id_dapur', $id_dapur);
        $this->db->join('produk', 'produk.id_produk=penjualan.id_produk');
        $this->db->order_by('sum(jumlah)', 'DESC');
        $this->db->limit(1);
        return $this->db->get('penjualan')->result();
    }

    public function terbahan()
    {
        $this->db->select('sum(jumlah), nama_bahan');
        $this->db->group_by('pemakaian.id_bahan'); 
        $this->db->where('tanggal BETWEEN SYSDATE() - INTERVAL 1 WEEK AND SYSDATE()');
        $this->db->join('bahan', 'bahan.id_bahan=pemakaian.id_bahan');
        $this->db->order_by('sum(jumlah)', 'DESC');
        $this->db->limit(1);
        return $this->db->get('pemakaian')->result();
    }

    public function terbahanc($id_dapur)
    {
        $this->db->select('sum(jumlah), nama_bahan');
        $this->db->group_by('pemakaian.id_bahan'); 
        $this->db->where('tanggal BETWEEN SYSDATE() - INTERVAL 1 WEEK AND SYSDATE()');
        $this->db->where('id_dapur', $id_dapur);
        $this->db->join('bahan', 'bahan.id_bahan=pemakaian.id_bahan');
        $this->db->order_by('sum(jumlah)', 'DESC');
        $this->db->limit(1);
        return $this->db->get('pemakaian')->result();
    }
}
