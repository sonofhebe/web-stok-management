<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=sc-mingguan-$nama_dapur-$awal.xls"); 

?>
<p align="center" style="font-weight:bold;font-size:14pt">Data Pemakaian SC dari <?= $nama_dapur ?>
<br>Pada tanggal : <?= $awal ?> s/d <?php echo date('Y-m-d', strtotime($awal. ' + 6 days')); ?></p>

<div class="table-responsive">
<table id="print" style="width:100%" border='1'>
<thead>
<tr>
<th rowspan="3">NO</th>
    <th rowspan="3">NAMA TAKARAN/BAHAN</th>
</tr>
<tr>
        <th colspan="2"><?= $awal ?></th>
        <th colspan="2"><?php echo date('Y-m-d', strtotime($awal. ' + 1 days')); ?></th>
        <th colspan="2"><?php echo date('Y-m-d', strtotime($awal. ' + 2 days')); ?></th>
        <th colspan="2"><?php echo date('Y-m-d', strtotime($awal. ' + 3 days')); ?></th>
        <th colspan="2"><?php echo date('Y-m-d', strtotime($awal. ' + 4 days')); ?></th>
        <th colspan="2"><?php echo date('Y-m-d', strtotime($awal. ' + 5 days')); ?></th>
        <th colspan="2"><?php echo date('Y-m-d', strtotime($awal. ' + 6 days')); ?></th>
</tr>
<tr>
    <th>Jumlah SC</th>
    <th>Total Gram</th>
    <th>Jumlah SC</th>
    <th>Total Gram</th>
    <th>Jumlah SC</th>
    <th>Total Gram</th>
    <th>Jumlah SC</th>
    <th>Total Gram</th>
    <th>Jumlah SC</th>
    <th>Total Gram</th>
    <th>Jumlah SC</th>
    <th>Total Gram</th>
    <th>Jumlah SC</th>
    <th>Total Gram</th>
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
    $this->db->where('tanggal = "'. $awal.'"');
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
        $this->db->where('tanggal = "'. $awal.'"');
        $j1 = $this->db->get()->result();
        foreach ($j1 as $j) { ?>
        <td align='center'><?PHP echo $sc->sc;?> </td>
        <td align='center'><?PHP echo $j->jumlah;?> </td><?php 
        }
    }
} 
///////////////////////////////////////////////////////////////////?>
<?php //////////////////////////////////////////////////////////////////
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
    $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 1 DAY');
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
        $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 1 DAY');
        $j1 = $this->db->get()->result();
        foreach ($j1 as $j) { ?>
        <td align='center'><?PHP echo $sc->sc;?> </td>
        <td align='center'><?PHP echo $j->jumlah;?> </td><?php 
        }
    }
} 
///////////////////////////////////////////////////////////////////?>
<?php //////////////////////////////////////////////////////////////////
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
    $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 2 DAY');
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
        $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 2 DAY');
        $j1 = $this->db->get()->result();
        foreach ($j1 as $j) { ?>
        <td align='center'><?PHP echo $sc->sc;?> </td>
        <td align='center'><?PHP echo $j->jumlah;?> </td><?php 
        }
    }
} 
///////////////////////////////////////////////////////////////////?>
<?php //////////////////////////////////////////////////////////////////
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
    $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 3 DAY');
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
        $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 3 DAY');
        $j1 = $this->db->get()->result();
        foreach ($j1 as $j) { ?>
        <td align='center'><?PHP echo $sc->sc;?> </td>
        <td align='center'><?PHP echo $j->jumlah;?> </td><?php 
        }
    }
} 
///////////////////////////////////////////////////////////////////?>
<?php //////////////////////////////////////////////////////////////////
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
    $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 4 DAY');
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
        $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 4 DAY');
        $j1 = $this->db->get()->result();
        foreach ($j1 as $j) { ?>
        <td align='center'><?PHP echo $sc->sc;?> </td>
        <td align='center'><?PHP echo $j->jumlah;?> </td><?php 
        }
    }
} 
///////////////////////////////////////////////////////////////////?>
<?php //////////////////////////////////////////////////////////////////
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
    $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 5 DAY');
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
        $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 5 DAY');
        $j1 = $this->db->get()->result();
        foreach ($j1 as $j) { ?>
        <td align='center'><?PHP echo $sc->sc;?> </td>
        <td align='center'><?PHP echo $j->jumlah;?> </td><?php 
        }
    }
} 
///////////////////////////////////////////////////////////////////?>
<?php //////////////////////////////////////////////////////////////////
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
    $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 6 DAY');
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
        $this->db->where('tanggal = "'. $awal.'"+ INTERVAL 6 DAY');
        $j1 = $this->db->get()->result();
        foreach ($j1 as $j) { ?>
        <td align='center'><?PHP echo $sc->sc;?> </td>
        <td align='center'><?PHP echo $j->jumlah;?> </td><?php 
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