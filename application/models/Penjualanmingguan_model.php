<?php
class penjualanmingguan_model extends CI_Model
{
    public function dapur($id_dapur)
    {
        $this->db->where('id_dapur ="'. $id_dapur .'"');
        $this->db->order_by('id_dapur', 'DESC');
        return $this->db->get('dapur')->row();
    }

    public function tanggal($awal)
    {
        $this->db->select('tanggal, DAYNAME(tanggal) as hari');
        $this->db->where('tanggal BETWEEN"'. $awal. '" AND "'. $awal .'" + INTERVAL 1 WEEK');
        $this->db->order_by('tanggal', 'ASC');
        return $this->db->get('penjualan')->result();
    }
    
    public function produk()
    {
        $this->db->order_by('nama_produk', 'ASC');
        return $this->db->get('produk')->result();
    }

    public function terlaris($awal)
    {
        $this->db->select('sum(jumlah), nama_produk');
        $this->db->group_by('penjualan.id_produk'); 
        $this->db->where('tanggal BETWEEN"'. $awal. '" AND "'. $awal .'" + INTERVAL 1 WEEK');
        $this->db->join('produk', 'produk.id_produk=penjualan.id_produk');
        $this->db->order_by('sum(jumlah)', 'DESC');
        $this->db->limit(1);
        return $this->db->get('penjualan')->result();
    }

    public function terlarisc($awal, $id_dapur)
    {
        $this->db->select('sum(jumlah), nama_produk');
        $this->db->group_by('penjualan.id_produk'); 
        $this->db->where('tanggal BETWEEN"'. $awal. '" AND "'. $awal .'" + INTERVAL 1 WEEK');
        $this->db->where('id_dapur', $id_dapur);
        $this->db->join('produk', 'produk.id_produk=penjualan.id_produk');
        $this->db->order_by('sum(jumlah)', 'DESC');
        $this->db->limit(1);
        return $this->db->get('penjualan')->result();
    }
}
