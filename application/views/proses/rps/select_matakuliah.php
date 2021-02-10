<option value="0">- Pilihan Matakuliah -</option>
<?php foreach ($list_matkul as $dt_matkul) { ?>
<option value="<?php echo $dt_matkul['id_matakuliah'];?>"><?php echo strtoupper($dt_matkul['kode_matakuliah']);?> | <?php echo strtoupper($dt_matkul['nama_matakuliah']);?></option>
<?php } ?>