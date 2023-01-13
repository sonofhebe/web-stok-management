<?php
class request_model extends CI_Model
{
    public function getbahan()
    {
        $this->db->join('kategori', 'kategori.id_kategori=bahan.id_kategori');
        $this->db->order_by('bahan.id_kategori', 'ASC');
        $this->db->order_by('nama_bahan', 'ASC');
        return $this->db->get('bahan')->result();
    }
    
    public function getharga($id_bahan)
    {
        $this->db->where('id_bahan', $id_bahan);
        return $this->db->get('bahan')->result();
    }

    public function dapur($id_dapur)
    {
        $this->db->where('id_dapur', $id_dapur);
        return $this->db->get('dapur')->result();
    }

    public function getrequest($id_dapur, $tgl)
    {
        $this->db->where('req.id_dapur', $id_dapur);
        $this->db->where('tanggal', $tgl);
        $this->db->order_by('id_req', 'DESC');
        $this->db->join('dapur', 'dapur.id_dapur=req.id_dapur');
        $this->db->join('bahan', 'bahan.id_bahan=req.id_bahan');
        $this->db->join('satuan', 'satuan.id_satuan=bahan.id_satuan');
        return $this->db->get('req')->result();
    }

    public function getrequest2($tgl)
    {
        $this->db->where('tanggal', $tgl);
        $this->db->order_by('id_req', 'DESC');
        $this->db->join('dapur', 'dapur.id_dapur=req.id_dapur');
        $this->db->join('bahan', 'bahan.id_bahan=req.id_bahan');
        $this->db->join('satuan', 'satuan.id_satuan=bahan.id_satuan');
        return $this->db->get('req')->result();
    }

    public function tunggu()
    {
        $this->db->group_by('req.id_dapur,CAST(tanggal AS DATE)'); 
        $this->db->join('dapur', 'dapur.id_dapur=req.id_dapur');
        $this->db->where('status = "Tunggu"');
        $this->db->order_by('id_req', 'DESC');
        return $this->db->get('req')->result();
    }

    public function inputreq($data)
    {
        $this->db->insert('req', $data);
    }

    public function hapusreq($id)
    {
        $this->db->where('id_req', $id);
        $this->db->delete('req');
    }
    
    public function status($data2, $id)
    {
        $this->db->where('id_req', $id);
        $this->db->set($data2);
        $this->db->update('req');
    }

    public function cpsa($id_dapur, $id_bahan)
    {
        $this->db->where('id_dapur', $id_dapur);
        $this->db->where('id_bahan', $id_bahan);
        return $this->db->get('stok')->result();
    }

    public function cekId($id_dapur, $id_bahan)
    {
        $this->db->where('id_dapur', $id_dapur);
        $this->db->where('id_bahan', $id_bahan);
        return $this->db->get('stok')->row();
    }
    
    public function cekstok($id_bahan)
    {
        $this->db->select('stok');
        $this->db->where('id_bahan', $id_bahan);
        return $this->db->get('bahan')->result();
    }
    
    public function tambahstok($stok)
    {
        $this->db->insert('stok', $stok);
    }

    public function inputdropstok($data)
    {
        $this->db->insert('drop_stok', $data);
    }

    public function no()
    {
        $this->db->where('role_id = 1');
        return $this->db->get('users')->result();
    }
}
