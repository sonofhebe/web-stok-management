
<?php
class dataresep_model extends CI_Model
{
    public function getProduk()
    {
        $this->db->where('id_produk', $this->session->userdata('idp'));
        return $this->db->get('produk')->result();
    }

    public function gettakaran()
    {
        $this->db->order_by('bahan.id_kategori, nama_bahan', 'ASC');
        $this->db->join('bahan', 'bahan.id_bahan=takaran.id_bahan');
        $this->db->join('kategori', 'kategori.id_kategori=bahan.id_kategori');
        return $this->db->get('takaran')->result();
    }

    public function getresep()
    {
        $this->db->where('resep.id_produk', $this->session->userdata('idp'));
        $this->db->order_by('bahan.id_kategori, nama_bahan', 'ASC');
        $this->db->join('produk', 'produk.id_produk=resep.id_produk');
        $this->db->join('takaran', 'takaran.id_takaran=resep.id_takaran');
        $this->db->join('bahan', 'bahan.id_bahan=takaran.id_bahan');
        $this->db->join('kategori', 'kategori.id_kategori=bahan.id_kategori');
        $this->db->join('satuan', 'satuan.id_satuan=bahan.id_satuan');
        return $this->db->get('resep')->result();
    }

    public function inputresep($data)
    {
        $this->db->insert('resep', $data);
    }

    public function cekId($takaran, $produk)
    {
        $this->db->where('id_takaran', $takaran);
        $this->db->where('id_produk', $produk);
        return $this->db->get('resep')->row();
    }

    public function bahan($takaran)
    {
        $this->db->where('id_takaran', $takaran);
        return $this->db->get('takaran')->result();
    }

    public function hapusresep($id)
    {
        $this->db->where('id_resep', $id);
        $this->db->delete('resep');
    }

    public function editresep($data, $id)
    {
        $this->db->where('id_resep', $id);
        $this->db->set($data);
        $this->db->update('resep');
    }
}
