<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=penjualan-bulanan-$nama_dapur-$bulan.xls"); 

?>
<p align="center" style="font-weight:bold;font-size:14pt">Data Penjualan Produk dari <?= $nama_dapur ?>
<br>Pada Periode : <?= $bulan ?>
<br>Produk terlaris : <?= $terlaris ?></p>

<div class="table-responsive">
<table id="print" style="width:100%" border='1'>
<thead>
<tr>
<th rowspan="2">NO</th>
        <th rowspan="2">NAMA PRODUK</th>
        <th colspan="31">PRODUK TERJUAL</th>
        <th rowspan="2">TOTAL TERJUAL</th>
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
        foreach ($produk as $ds) { ?>
            <td align='center'><?= $n; ?></td>
            <td><?= $ds->nama_produk ?></td>
            <!-- PENJUALAN PRODUK -->
            <?php
    for ($x = 1; $x <= 31; $x++) {
        $this->db->select_sum('jumlah');
        if ($id_dapur==0) {
        $this->db->where('id_produk', $ds->id_produk);
        } else {
        $this->db->where('id_produk', $ds->id_produk);
        $this->db->where('id_dapur ="'. $id_dapur .'"');
        }
        if ($x<=9) {
        $this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "'.$bulan.'-0'.$x.'"');
        } else {
        $this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "'.$bulan.'-'.$x.'"');
        }
        $hasil = $this->db->get('penjualan')->result();
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
        if ($id_dapur==0) {
        $this->db->where('id_produk', $ds->id_produk);
        } else {
        $this->db->where('id_produk', $ds->id_produk);
        $this->db->where('id_dapur ="'. $id_dapur .'"');
        }
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m') = '".$bulan."'");
        $tot = $this->db->get('penjualan')->result();
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