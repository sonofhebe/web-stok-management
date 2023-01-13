<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=pemakaian-bulanan-$nama_dapur-$bulan.xls"); 

?>
<p align="center" style="font-weight:bold;font-size:14pt">Data Pemakaian Bahan dari <?= $nama_dapur ?>
<br>Pada Periode : <?= $bulan ?></p>

<div class="table-responsive">
<table id="print" style="width:100%" border='1'>
    <thead>
    <tr>
<th rowspan="2">NO</th>
<th rowspan="2">NAMA BAHAN</th>
<th rowspan="2">STOK AWAL</th>
<th rowspan="2">STOK MASUK</th>
<th rowspan="2">TOTAL STOK</th>
<th colspan="31">PENGGUNAAN BAHAN</th>
<th rowspan="2">TOTAL PEMAKAIAN</th>
</tr>
<tr>
<?php
for ($x = 1; $x <= 31; $x++) {
?><th><?php echo $x; ?></th><?php
}
?>
</tr>
</thead>
<tbody>
<tr>
<?php $n = 1;
$cpsa = 0;
$masuk = 0;
foreach ($bahan as $ds) { ?>
    <td align='center'><?= $n; ?></td>
    <td><?= $ds->nama_bahan ?></td>
    <!-- STOK AWAL -->
<?php 
$this->db->select_max('cpsa');
if ($id_dapur==0) {
$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
} else {
$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
$this->db->where('id_dapur ="'. $id_dapur .'"');
}
$this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
$this->db->where('drop_stok.id_bahan', $ds->id_bahan);
$this->db->where("DATE_FORMAT(tanggal,'%Y-%m') = '".$bulan."' - INTERVAL 1 MONTH");
$tot = $this->db->get('drop_stok')->result();
?><td align='center'><?PHP 
foreach ($tot as $t) {
if (!$t->cpsa) {
    echo "-";
    $cpsa = 0;
} else {
    echo $t->cpsa;
    $cpsa = $t->cpsa;
}
} ?> </td>
<!-- STOK MASUK -->
<?php 
$this->db->select_sum('jumlah');
if ($id_dapur==0) {
$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
} else {
$this->db->join('bahan', 'bahan.id_bahan=drop_stok.id_bahan');
$this->db->where('id_dapur ="'. $id_dapur .'"');
}
$this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
$this->db->where('drop_stok.id_bahan', $ds->id_bahan);
$this->db->where("DATE_FORMAT(tanggal,'%Y-%m') = '".$bulan."' - INTERVAL 1 MONTH");
$tot = $this->db->get('drop_stok')->result();
?><td align='center'><?PHP 
foreach ($tot as $t) {
if (!$t->jumlah) {
    echo "-";
    $masuk = 0;
} else {
    echo $t->jumlah;
    $masuk = $t->jumlah;
}
} ?> </td>
    <td align='center'><?= $cpsa + $masuk ?></td>
    <!-- PEMAKAIAN -->
    <?php
for ($x = 1; $x <= 31; $x++) {
$this->db->select_sum('jumlah');
$this->db->from('pemakaian');
if ($id_dapur==0) {
$this->db->join('bahan', 'bahan.id_bahan=pemakaian.id_bahan');
} else {
$this->db->join('bahan', 'bahan.id_bahan=pemakaian.id_bahan');
$this->db->where('id_dapur ="'. $id_dapur .'"');
}
$this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
$this->db->where('pemakaian.id_bahan', $ds->id_bahan);
if ($x<=9) {
$this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "'.$bulan.'-0'.$x.'"');
} else {
$this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "'.$bulan.'-'.$x.'"');
}
$hasil = $this->db->get()->result();
?><?PHP 
foreach ($hasil as $j) {
if (!$j->jumlah) {
    ?><td align='center'><?php echo "-"; ?></td><?php
} else {
    ?><td align='center'><?php echo $j->jumlah; ?></td><?php
}
}
}
?>
<!-- TOTAL -->
<?php 
$this->db->select_sum('jumlah');
$this->db->from('pemakaian');
if ($id_dapur==0) {
$this->db->join('bahan', 'bahan.id_bahan=pemakaian.id_bahan');
} else {
$this->db->join('bahan', 'bahan.id_bahan=pemakaian.id_bahan');
$this->db->where('id_dapur ="'. $id_dapur .'"');
}
$this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
$this->db->where('pemakaian.id_bahan', $ds->id_bahan);
$this->db->where("DATE_FORMAT(tanggal,'%Y-%m') = '".$bulan."'");
$tot = $this->db->get()->result();
?><td align='center'><?PHP 
foreach ($tot as $t) {
if (!$t->jumlah) {
    echo "-";
} else {
    echo $t->jumlah;
}
} ?> </td>
</tr>
<?php $n++;
} ?>
</tbody>
</table>
</div>