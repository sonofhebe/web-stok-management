<?php
class pemakaianmingguan_model extends CI_Model
{
    public function dapur($id_dapur)
    {
        $this->db->where('id_dapur ="'. $id_dapur .'"');
        $this->db->order_by('id_dapur', 'DESC');
        return $this->db->get('dapur')->row();
    }
    
    public function bahan($id_kategori)
    {
        $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
        $this->db->order_by('nama_bahan', 'ASC');
        $this->db->join('kategori', 'kategori.id_kategori=bahan.id_kategori');
        return $this->db->get('bahan')->result();
    }

    public function tanggal($awal)
    {
        $this->db->select('tanggal, DAYNAME(tanggal) as hari');
        $this->db->where('tanggal BETWEEN"'. $awal. '" AND "'. $awal .'" + INTERVAL 1 WEEK');
        $this->db->order_by('tanggal', 'ASC');
        return $this->db->get('pemakaian')->result();
    }
    
    public function pemakaian($awal,$id_kategori,$id_dapur)
    {
        $this->db->join('bahan', 'bahan.id_bahan=pemakaian.id_bahan');
        $this->db->distinct()->select('pemakaian.id_bahan, bahan.nama_bahan');
        $this->db->where('id_dapur ="'. $id_dapur .'"');
        $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
        $this->db->where('tanggal BETWEEN"'. $awal. '" AND "'. $awal .'" + INTERVAL 1 WEEK');
        $this->db->order_by('pemakaian.id_bahan', 'ASC');
        return $this->db->get('pemakaian')->result();
    }

}
