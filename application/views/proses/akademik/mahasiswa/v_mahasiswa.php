<table class="table" style="width: 100%;">
<thead>
    <th style="width: 5%;">No</th>
    <th style="width: 10%;">NIM</th>
    <th style="width: 35%;">Nama Mahasiswa</th>
    <th style="width: 10%;">Jenkel</th>
    <th style="width: 40%;">Tempat/Tgl. Lahir</th>
</thead>
<tbody>
<?php
$nom=1;
foreach($list_mahasiswa as $ls){?>
<tr>
    <td><?= $nom ?></td>
    <td><?= $ls['nim'] ?></td>
    <td><?= $ls['nama_mahasiswa'] ?></td>
    <td><?= ($ls['jenis_kelamin']==1) ? "Laki-Laki" : "Perempuan" ?></td>
    <td><?= $ls['tempat_lahir'] ?><?= (empty($ls['tanggal_lahir'])) ? "" : date_format(date_create($ls['tanggal_lahir']), "d-m-Y") ?></td>
</tr>
<?php $nom++; } ?>
</tbody>
</table>