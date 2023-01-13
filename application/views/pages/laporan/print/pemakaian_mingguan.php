<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=pemakaian-mingguan-$nama_dapur-$awal.xls"); 

?>
<p align="center" style="font-weight:bold;font-size:14pt">Data Pemakaian Bahan dari <?= $nama_dapur ?>
<br>Pada tanggal : <?= $awal ?> s/d <?php echo date('Y-m-d', strtotime($awal. ' + 6 days')); ?></p>

<div class="table-responsive">
<table id="print" style="width:100%" border='1'>
<thead>
<tr>
    <th rowspan="3">NO</th>
    <th rowspan="3">NAMA BAHAN</th>
    <th rowspan="3">STOK AWAL</th>
    <th rowspan="3">STOK MASUK</th>
    <th rowspan="3">TOTAL STOK</th>
    <th colspan="7">PENGGUNAAN BAHAN</th>
    <th rowspan="3">TOTAL PEMAKAIAN</th>
</tr>
<tr>
    <th>SABTU</th>
    <th>MINGGU</th>
    <th>SENIN</th>
    <th>SELASA</th>
    <th>RABU</th>
    <th>KAMIS</th>
    <th>JUMAT</th>
</tr>
<tr>
        <th><?= $awal ?></th>
        <th><?php echo date('Y-m-d', strtotime($awal. ' + 1 days')); ?></th>
        <th><?php echo date('Y-m-d', strtotime($awal. ' + 2 days')); ?></th>
        <th><?php echo date('Y-m-d', strtotime($awal. ' + 3 days')); ?></th>
        <th><?php echo date('Y-m-d', strtotime($awal. ' + 4 days')); ?></th>
        <th><?php echo date('Y-m-d', strtotime($awal. ' + 5 days')); ?></th>
        <th><?php echo date('Y-m-d', strtotime($awal. ' + 6 days')); ?></th>
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
    $this->db->where('tanggal BETWEEN "'. $awal.'"- INTERVAL 7 DAY AND "'. $awal.'"- INTERVAL 1 DAY');
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
    $this->db->where('tanggal BETWEEN "'. $awal.'"- INTERVAL 1 DAY AND "'. $awal.'"+ INTERVAL 5 DAY');
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
    $this->db->where('tanggal = "'. $awal.'"');
    $sab = $this->db->get()->result();
    ?><td align='center'><?PHP 
    foreach ($sab as $j) {
    if (!$j->jumlah) {
        echo "-";
    } else {
        echo $j->jumlah;
    }
} ?> </td>
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
    $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 1 DAY');
    $min = $this->db->get()->result();
    ?><td align='center'><?PHP 
    foreach ($min as $j) {
    if (!$j->jumlah) {
        echo "-";
    } else {
        echo $j->jumlah;
    }
} ?> </td>
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
    $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 2 DAY');
    $sen = $this->db->get()->result();
    ?><td align='center'><?PHP 
    foreach ($sen as $j) {
    if (!$j->jumlah) {
        echo "-";
    } else {
        echo $j->jumlah;
    }
} ?> </td>
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
    $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 3 DAY');
    $sel = $this->db->get()->result();
    ?><td align='center'><?PHP 
    foreach ($sel as $j) {
    if (!$j->jumlah) {
        echo "-";
    } else {
        echo $j->jumlah;
    }
} ?> </td>
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
    $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 4 DAY');
    $ra = $this->db->get()->result();
    ?><td align='center'><?PHP 
    foreach ($ra as $j) {
    if (!$j->jumlah) {
        echo "-";
    } else {
        echo $j->jumlah;
    }
} ?> </td>
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
    $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 5 DAY');
    $kam = $this->db->get()->result();
    ?><td align='center'><?PHP 
    foreach ($kam as $j) {
    if (!$j->jumlah) {
        echo "-";
    } else {
        echo $j->jumlah;
    }
} ?> </td>
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
    $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 6 DAY');
    $jum = $this->db->get()->result();
    ?><td align='center'><?PHP 
    foreach ($jum as $j) {
    if (!$j->jumlah) {
        echo "-";
    } else {
        echo $j->jumlah;
    }
} ?> </td>
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
    $this->db->where('tanggal BETWEEN "'. $awal.'" AND "'. $awal.'"+ INTERVAL 6 DAY');
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