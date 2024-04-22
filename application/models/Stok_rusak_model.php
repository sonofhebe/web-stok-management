
<?php
class stok_rusak_model extends CI_Model
{
	public function getbahan($id_dapur)
	{
		$daftar_bahan = array();
		$stok_bahan = array();
		if ($id_dapur) {
			$stok = $this->db->where('id_dapur', $id_dapur)->get('stok')->result();
			foreach ($stok as $row) {
				if ($row->jumlah > 0) {
					$daftar_bahan[] = $row->id_bahan;
				}
			}
		}

		$bahan = $this->db->join('kategori', 'kategori.id_kategori=bahan.id_kategori')
			->join('satuan', 'satuan.id_satuan=bahan.id_satuan')
			->order_by('bahan.id_kategori', 'ASC')
			->order_by('nama_bahan', 'ASC');
		if (count($daftar_bahan) > 0) {
			$bahan = $bahan->where_in('id_bahan', $daftar_bahan);
		}

		return $bahan->get('bahan')->result();
	}

	public function dapur($id_dapur)
	{
		$this->db->where('id_dapur', $id_dapur);
		return $this->db->get('dapur')->result();
	}

	public function getstokrusak($id_dapur, $tgl)
	{
		$stokRusak = $this->db->where('tanggal', $tgl)
			->order_by('id_stok_rusak', 'DESC')
			->order_by('id_stok_rusak', 'DESC')
			->join('dapur', 'dapur.id_dapur=stok_rusak.id_dapur')
			->join('bahan', 'bahan.id_bahan=stok_rusak.id_bahan')
			->join('satuan', 'satuan.id_satuan=bahan.id_satuan');

		if ($id_dapur) {
			$stokRusak = $stokRusak->where('stok_rusak.id_dapur', $id_dapur);
		}

		return $stokRusak->get('stok_rusak')->result();
	}

	public function tunggu($id_dapur)
	{
		$tunggu = $this->db->group_by('stok_rusak.id_dapur,CAST(tanggal AS DATE)')
			->join('dapur', 'dapur.id_dapur=stok_rusak.id_dapur')
			->where('status', 1)
			->order_by('id_stok_rusak', 'DESC');
		if ($id_dapur) {
			$tunggu = $tunggu->where('stok_rusak.id_dapur', $id_dapur);
		}

		return $tunggu->get('stok_rusak')->result();
	}

	public function input($data)
	{
		$this->db->insert('stok_rusak', $data);
	}

	public function hapusreq($id)
	{
		$this->db->where('id_stok_rusak', $id);
		$this->db->delete('stok_rusak');
	}

	public function status($data, $id)
	{
		$this->db->where('id_stok_rusak', $id);
		$this->db->set($data);
		$this->db->update('stok_rusak');
	}

	public function cekstok($id_dapur, $id_bahan)
	{
		$this->db->select('jumlah');
		$this->db->where('id_dapur', $id_dapur);
		$this->db->where('id_bahan', $id_bahan);
		return $this->db->get('stok')->result();
	}
}
