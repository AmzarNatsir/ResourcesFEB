<?php
$nom=1;
foreach ($list_permohonan as $dt) { ?>
<tr>
  <td><?php echo $nom;?></td>
  <td><?php echo $dt['nama_tahun'];?></td>
  <td><?php echo $dt['nama_ps'];?></td>
  <td><?php echo $dt['nim'];?></td>
  <td><?php echo $dt['nama_mahasiswa'];?></td>
  <td><?php echo $dt['ukuran_baju'];?></td>
  <td>
    Nama Instansi : <b><?php echo $dt['nama_instansi_1'];?></b><br>
    Alamat : <b><?php echo $dt['alamat_1'];?></b><br>
    No. Telpon : <b><?php echo $dt['no_telpon_1'];?></b><br>
    Kontak Person : <b><?php echo $dt['kontak_person_1'];?></b>
  </td>
  <td>
    Nama Instansi : <b><?php echo $dt['nama_instansi_2'];?></b><br>
    Alamat : <b><?php echo $dt['alamat_2'];?></b><br>
    No. Telpon : <b><?php echo $dt['no_telpon_2'];?></b><br>
    Kontak Person : <b><?php echo $dt['kontak_person_2'];?></b>
  </td>
  <td><?php echo date_format(date_create($dt['tgl_post']), 'd-m-Y');?></td>
  <td>
    <button class="btn btn-success" id="tbl_apply" name="tbl_apply" onclick="getProfilPengajuan(this)" value="<?php echo $dt['id'];?>">Detail</button>
  </td>
</tr>
<?php $nom++; } ?>
<script type="text/javascript">
  var getProfilPengajuan = function(el)
  {
      window.location.assign("<?php echo base_url();?>permohonan_kkp/detail_permohonan/"+el.value);
  }
</script>