<table class="table" style="width: 100%;">
<thead>
    <th style="width: 5%;">No</th>
    <th style="width: 10%;">Kode</th>
    <th style="width: 35%;">Nama Matakuliah</th>
    <th style="width: 30%;">Jenis Matakuliah</th>
    <th style="width: 10%;">Semester</th>
    <th style="width: 10%;">Sks</th>
</thead>
<tbody>
<?php
$nom=1;
foreach($res_matkul as $ls){?>
<tr>
    <td><?= $nom ?></td>
    <td><?= $ls['kode_matakuliah'] ?></td>
    <td><?= $ls['nama_matakuliah'] ?></td>
    <td><?= $ls['jenis_matakuliah'] ?></td>
    <td><?= $ls['semester'] ?></td>
    <td><?= $ls['sks'] ?></td>
</tr>
<?php $nom++; } ?>
</tbody>
</table>