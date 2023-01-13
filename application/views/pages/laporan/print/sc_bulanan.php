<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=sc-bulanan-$nama_dapur-$bulan.xls"); 

?>
<p align="center" style="font-weight:bold;font-size:14pt">Data SC Bahan dari <?= $nama_dapur ?>
<br>Pada Periode : <?= $bulan ?></p>

<div class="table-responsive">
<table id="print" style="width:100%" border='1'>
<thead>
<tr>
<th rowspan="3">NO</th>
        <th rowspan="3">NAMA TAKARAN/BAHAN</th>
    </tr>
    <tr>
    <?php for ($x = 1; $x <= 31; $x++) {
        ?><th colspan="2"><?php echo $x; ?></th>
        <?php } ?>
        </tr>
    <tr>
        <?php for ($y = 1; $y <= 31; $y++) { ?>
            <th>Jumlah SC</th>
            <th>Total Gram</th>
            <?php } ?>
    </tr>
</thead>
<tbody>
        <tr>
    <?php $n = 1;
        foreach ($takaran as $ds) { ?>
            <td align='center'><?= $n; ?></td>
            <td><?= $ds->nama_takaran ?></td>
            <!-- PEMAKAIAN -->
    <?php //////////////////////////////////////////////////////////////////
    for ($x = 1; $x <= 31; $x++) {
        $this->db->select_sum('sc');
        $this->db->from('pemakaian');
        if ($id_dapur==0) {
        $this->db->join('resep', 'resep.id_resep=pemakaian.id_resep');
        } else {
        $this->db->join('resep', 'resep.id_resep=pemakaian.id_resep');
        $this->db->where('id_dapur ="'. $id_dapur .'"');
        }
        $this->db->join('takaran', 'takaran.id_takaran=resep.id_takaran');
        $this->db->join('bahan', 'bahan.id_bahan=pemakaian.id_bahan');
        $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
        $this->db->where('takaran.id_takaran', $ds->id_takaran);
        if ($x<=9) {
        $this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "'.$bulan.'-0'.$x.'"');
        } else {
        $this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "'.$bulan.'-'.$x.'"');
        }
        $sc1 = $this->db->get()->result();
        foreach ($sc1 as $sc) {
        if (!$sc->sc) {
            ?><td align='center'><?PHP echo "-";?> </td>
            <td align='center'><?PHP echo "-";?> </td><?php 
        } else {
            $this->db->select_sum('pemakaian.jumlah');
            $this->db->from('pemakaian');
            if ($id_dapur==0) {
            $this->db->join('resep', 'resep.id_resep=pemakaian.id_resep');
            } else {
            $this->db->join('resep', 'resep.id_resep=pemakaian.id_resep');
            $this->db->where('id_dapur ="'. $id_dapur .'"');
            }
            $this->db->join('takaran', 'takaran.id_takaran=resep.id_takaran');
            $this->db->join('bahan', 'bahan.id_bahan=pemakaian.id_bahan');
            $this->db->where('bahan.id_kategori ="'. $id_kategori .'"');
            $this->db->where('takaran.id_takaran', $ds->id_takaran);
            if ($x<=9) {
            $this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "'.$bulan.'-0'.$x.'"');
            } else {
            $this->db->where('DATE_FORMAT(tanggal,"%Y-%m-%d") = "'.$bulan.'-'.$x.'"');
            }
            $j1 = $this->db->get()->result();
            foreach ($j1 as $j) { ?>
            <td align='center'><?PHP echo $sc->sc;?> </td>
            <td align='center'><?PHP echo $j->jumlah;?> </td><?php 
            }
        }
    } 
    }
    ///////////////////////////////////////////////////////////////////?>
        </tr>
        <?php $n++;
        } ?>
</tbody>
</table>
</div>