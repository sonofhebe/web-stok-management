
<?php
class stok_model extends CI_Model
{
    public function getdapur()
    {
        $this->db->order_by('id_dapur', 'DESC');
        return $this->db->get('dapur')->result();
    }
}
