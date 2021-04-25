<table class="table" style="width: 100%;">
<thead>
    <th style="width: 5%;">No</th>
    <th style="width: 10%;">Kode</th>
    <th style="width: 25%;">Nama Matakuliah</th>
    <th style="width: 20%;">Jenis Matakuliah</th>
    <th style="width: 10%;">Semester</th>
    <th style="width: 10%;">Sks</th>
    <th style="width: 10%;">Jumlah Pertemuan</th>
    <th style="width: 10%;">Jumlah Menit</th>
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
    <td><?= $ls['jumlah_pertemuan'] ?></td>
    <td><?= $ls['jumlah_menit_pertemuan'] ?></td>
</tr>
<?php $nom++; } ?>
</tbody>
</table>