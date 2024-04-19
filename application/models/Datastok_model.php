
<?php
class datastok_model extends CI_Model
{
    public function getdapur()
    {
        $this->db->where('id_dapur', $this->session->userdata('idd'));
        return $this->db->get('dapur')->result();
    }

    public function getstok()
    {
        $this->db->where('id_dapur', $this->session->userdata('idd'));
        $this->db->order_by('bahan.id_satuan', 'DESC');
        $this->db->join('bahan', 'bahan.id_bahan=stok.id_bahan');
        $this->db->join('kategori', 'kategori.id_kategori=bahan.id_kategori');
        $this->db->join('satuan', 'satuan.id_satuan=bahan.id_satuan');
        return $this->db->get('stok')->result();
    }

    public function getbahan()
    {
        $this->db->order_by('bahan.id_satuan', 'DESC');
        $this->db->join('kategori', 'kategori.id_kategori=bahan.id_kategori');
        $this->db->join('satuan', 'satuan.id_satuan=bahan.id_satuan');
        return $this->db->get('bahan')->result();
    }

    public function inputstok($data)
    {
        $this->db->insert('stok', $data);
    }

    public function cekId($dapur, $bahan)
    {
        $this->db->where('id_dapur', $dapur);
        $this->db->where('id_bahan', $bahan);
        return $this->db->get('stok')->row();
    }

    public function hapusstok($id)
    {
        $this->db->where('id_stok', $id);
        $this->db->delete('stok');
    }
}
