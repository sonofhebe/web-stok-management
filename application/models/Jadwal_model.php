
<?php
class jadwal_model extends CI_Model
{
    public function gethari()
    {
        $this->db->where('hari', $this->session->userdata('hari'));
        return $this->db->get('jadwal')->result();
    }

    public function getjadwal()
    {
        $this->db->where('hari', $this->session->userdata('hari'));
        $this->db->order_by('jadwal.id_produk', 'asc');
        $this->db->join('produk', 'produk.id_produk=jadwal.id_produk');
        $this->db->join('kategoriproduk', 'kategoriproduk.id_kategoriproduk=produk.id_kategoriproduk');
        return $this->db->get('jadwal')->result();
    }

    public function getproduk()
    {
        $this->db->order_by('produk.id_kategoriproduk, nama_produk', 'asc');
        $this->db->join('kategoriproduk', 'kategoriproduk.id_kategoriproduk=produk.id_kategoriproduk');
        return $this->db->get('produk')->result();
    }

    public function inputjadwal($data)
    {
        $this->db->insert('jadwal', $data);
    }

    public function hapusjadwal($id)
    {
        $this->db->where('id_jadwal', $id);
        $this->db->delete('jadwal');
    }

    public function cekId($hari, $produk)
    {
        $this->db->where('hari', $hari);
        $this->db->where('id_produk', $produk);
        return $this->db->get('jadwal')->row();
    }
}
