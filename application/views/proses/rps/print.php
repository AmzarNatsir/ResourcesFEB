<table width="100%" style="border-collapse:collapse" border="1">
<tr bgcolor="#cce6ff">
    <td width="15%" height="120px" align="center"><img src="<?php echo FCPATH;?>assets/dist/img/logo_febunismuh.png" width="100px"></td>
    <td width="85%" align="left" style="font-family: Arial; font-size: 17pt;">
    	<strong>&nbsp;UNIVERSITAS MUHAMMADIYAH MAKASSAR<br>
    	&nbsp;FAKULTAS EKONOMI DAN BISNIS (FEB)<br>
    	&nbsp;<?php echo strtoupper($dt_rps->nama_ps);?>/<?php echo strtoupper($dt_rps->nm_jenjang);?>
    	</strong>
    </td>
</tr>
<tr bgcolor="#cce6ff">
	<td colspan="2" align="center" height="30px" style="font-family: Arial; font-size: 13pt;"><strong>RENCANA PEMBELAJARAN STUDI</strong></td>
</tr>
</table>
<table width="100%" style="font-family: Arial; font-size: 12pt;border-collapse:collapse" border="1">
	<tr bgcolor="#ebebe0">
		<td width="30%" height="30px" align="left"><strong>MATA KULIAH</strong></td>
		<td width="10%" align="left"><strong>KODE</strong></td>
		<td width="23%" align="left"><strong>Rumpun MK</strong></td>
		<td width="12%" align="left"><strong>BOBOT (sks)</strong></td>
		<td width="10%" align="left"><strong>SEMESTER</td>
		<td width="15%" align="left"><strong>Tgl.Penyusunan</strong></td>
	</tr>
	<tr>
		<td height="30px"><?php echo $dt_rps->nama_matakuliah;?></td>
		<td><?php echo $dt_rps->kode_matakuliah;?></td>
		<td><?php echo $dt_rps->jenis_matakuliah;?></td>
		<td align="center"><?php echo $dt_rps->sks;?></td>
		<td align="center"><?php echo $dt_rps->semester;?></td>
		<td><?php echo date_format(date_create($dt_rps->tgl_post), "d/m/Y");?></td>
	</tr>
</table>
<table width="100%" style="font-family: Arial; font-size: 12pt;border-collapse:collapse" border="1">
	<tr>
		<td width="30%" height="40px" rowspan="2" valign="top"><strong>OTORISASI</strong></td>
		<td width="23%" valign="top" bgcolor="#ebebe0"><strong>Dosen Pengembang RPS</strong></td>
		<td width="22%" valign="top" bgcolor="#ebebe0"><strong>Koordinator RMK</strong></td>
		<td width="25%" valign="top" bgcolor="#ebebe0"><strong>Ka PRODI</strong></td>
	</tr>
	<tr>
		<td height="70px"></td>
		<td></td>
		<td></td>
	</tr>
</table>
<?php $rows_cp = count($list_aspek_sikap) + count($list_aspek_pengetahuan) + count($list_aspek_ku) + count($list_aspek_kk); ?>
<table width="100%" style="font-family: Arial; font-size: 12pt;border-collapse:collapse" border="1">
	<tr>
	  <td style="width: 25%" rowspan="<?php echo $rows_cp+1;?>" valign="top"><strong>Capaian Pembelajaran (CP)</strong></td>
	  <td colspan="2" bgcolor="#ebebe0"><strong>CPL-PRODI</strong></td>
	</tr>
	<?php
	foreach ($list_aspek_sikap as $sikap) { ?>
	<tr>
	  <td style="width: 5%" height="30px"><strong><?php echo $sikap['kode']; ?></strong></td>
	  <td style="width: 70%"><?php echo $sikap['desk']; ?></td>
	</tr>
	<?php }?>
	<?php foreach ($list_aspek_pengetahuan as $pengetahuan) { ?>
	<tr>
	  <td style="width: 5%" height="30px"><strong><?php echo $pengetahuan['kode']; ?></strong></td>
	  <td style="width: 70%"><?php echo $pengetahuan['desk']; ?></td>
	</tr>
	<?php }?>
	<?php foreach ($list_aspek_ku as $ku) { ?>
	<tr>
	  <td style="width: 5%" height="30px"><strong><?php echo $ku['kode']; ?></strong></td>
	  <td style="width: 70%"><?php echo $ku['desk']; ?></td>
	</tr>
	<?php }?>
	<?php foreach ($list_aspek_kk as $kk) { ?>
	<tr>
	  <td style="width: 5%" height="30px"><strong><?php echo $kk['kode']; ?></strong></td>
	  <td style="width: 70%"><?php echo $kk['desk']; ?></td>
	</tr>
	<?php }?>
</table>
<table width="100%" style="font-family: Arial; font-size: 12pt;border-collapse:collapse" border="1">
<tr>
  <td style="width: 25%" rowspan="<?php echo count($list_cpmk)+1;?>"></td>
  <td colspan="2" style="width: 85%" bgcolor="#ebebe0"><strong>CPL-MK</strong></td>
</tr>
<?php foreach ($list_cpmk as $dt_cpmk): ?>
  <?php 
  $s_teks="";
  $p_teks="";
  $ku_teks="";
  $kk_teks="";
  $unsur_cpl="";
  if(!empty($dt_cpmk['unsur_s'])){
    $arr_aspek_sikap = explode(",", $dt_cpmk['unsur_s']);
    for ($i=0; $i < count($arr_aspek_sikap); $i++) { 
      $hasil = $this->model_rps->get_profil_aspek_sikap($arr_aspek_sikap[$i]);
      if($i==0)
      {
        $s_teks = "S-".$hasil->no_urut;
      } else {
        $s_teks .= ", S-".$hasil->no_urut;
      }
      //$all_aspek_sikap[] = $hasil->aspek_sikap." (S-".$hasil->no_urut.")";
    }
  } 
  if(!empty($dt_cpmk['unsur_p'])){
    $arr_aspek_pengetahuan = explode(",", $dt_cpmk['unsur_p']);
    for ($i=0; $i < count($arr_aspek_pengetahuan); $i++) { 
      $hasil = $this->model_rps->get_profil_aspek_pengetahuan($arr_aspek_pengetahuan[$i]);
      if($i==0)
      {
        if(!empty($s_teks)) 
        { 
          $p_teks .= ", P-".$hasil->no_urut; 
        } else { 
          $p_teks = "P-".$hasil->no_urut; 
        }
      } else {
        $p_teks .= ", P-".$hasil->no_urut;
      }
    }
  }
  if(!empty($dt_cpmk['unsur_ku'])){
    $arr_aspek_ku = explode(",", $dt_cpmk['unsur_ku']);
    for ($i=0; $i < count($arr_aspek_ku); $i++) { 
      $hasil = $this->model_rps->get_profil_aspek_ku($arr_aspek_ku[$i]);
      if($i==0)
      {
        if(!empty($p_teks)) 
        { 
          $ku_teks .= ", KU-".$hasil->no_urut; 
        } else { 
          $ku_teks = "KU-".$hasil->no_urut; 
        }
      } else {
        $ku_teks .= ", KU-".$hasil->no_urut;
      }
    }
  }
  if(!empty($dt_cpmk['unsur_kk'])){
     $arr_aspek_kk = explode(",", $dt_cpmk['unsur_kk']);
    for ($i=0; $i < count($arr_aspek_kk); $i++) { 
      $hasil = $this->model_rps->get_profil_aspek_kk($arr_aspek_kk[$i]);
      if($i==0)
      {
        if(!empty($ku_teks)) 
        { 
          $kk_teks .= ", KK-".$hasil->no_urut; 
        } else { 
          $kk_teks = "KK-".$hasil->no_urut;
        }
      } else {
        $kk_teks .= ", KK-".$hasil->no_urut;
      }
    }
  }
  $unsur_cpl = " (".$s_teks.$p_teks.$ku_teks.$kk_teks.")";
  ?>
  <tr>
    <td width="5%"><strong>M<?php echo $dt_cpmk['no_urut']; ?></strong></td>
    <td width="70%"><?php echo $dt_cpmk['deskripsi'].$unsur_cpl; ?></td>
  </tr>
<?php endforeach ?>
</table>
<table width="100%" style="font-family: Arial; font-size: 12pt;border-collapse:collapse" border="1">
  <tr>
    <td valign="top" width="25%" height="30%"><strong>Deskripsi Singkat MK</strong></td>
    <td valign="top" width="75%"><?php echo $dt_rps->deskripsi_matkul;?></td>
  </tr>
  <tr>
    <td valign="top" height="30%"><strong>Materi Pembelajaran/Pokok Bahasan</strong></td>
    <td valign="top"><?php echo $dt_rps->pokok_bahasan;?></td>
  </tr>
  <tr>
    <td valign="top" height="30%"><strong>Pustaka</strong></td>
    <td bgcolor="#ebebe0"><strong>Utama :</strong></td>
  </tr>
  <tr>
    <td></td>
    <td height="30%">
      <?php
      foreach ($list_referensi as $key => $value) 
      {
          echo $value."<br>";
      }
      ?>
    </td>
  </tr>
  <tr>
    <td height="30%"></td>
    <td bgcolor="#ebebe0"><strong>Pendukung :</strong></td>
  </tr>
  <tr>
    <td valign="top" height="30%"><strong>Media Pembelajaran</strong></td>
    <td bgcolor="#ebebe0"><strong>Perangkat Lunak :</strong></td>
  </tr>
  <tr>
    <td height="30%"></td>
    <td><?php echo $dt_rps->perangkat_lunak;?></td>
  </tr>
  <tr>
    <td height="30%"></td>
    <td bgcolor="#ebebe0"><strong>Perangkat Keras :</strong></td>
  </tr>
  <tr>
    <td height="30%"></td>
    <td><?php echo $dt_rps->perangkat_keras;?></td>
  </tr>
  <tr>
    <td valign="top" height="30%"><strong>Team Teaching</strong></td>
    <td>
      <?php
      if(!empty($dt_rps->ketua_team))
      {
        $res = $this->model_rps->get_profil_dosen($dt_rps->ketua_team);
        $nama_ketua = $res->nama_dosen;
      } else {
        $nama_ketua= "Ketua team belum ditentukan";
      } ?>
      <?php echo "1. ".$nama_ketua;?> (Ketua)<br>
      <?php $nom=2; foreach ($list_dsn as $key => $value): ?>
        <?php echo $nom.". ".$value;?> (Anggota)<br>
      <?php $nom++; endforeach ?>
    </td>
  </tr>
  <tr>
    <td valign="top" height="30%"><strong>Matakuliah Syarat</strong></td>
    <td><?php echo $dt_rps->prasyarat_matkul;?></td>
  </tr>
</table>
<table width="100%" style="font-family: Arial; font-size: 12pt;border-collapse:collapse" border="1">
<tr bgcolor="#ebebe0">
    <th style="width: 5%; text-align: center; vertical-align: top">Mg Ke-</th>
    <th style="width: 20%; text-align: center; vertical-align: top">Sub-CP-MK (sbg kemampuan akhir yg diharapkan</th>
    <th style="width: 20%; text-align: center; vertical-align: top">Indikator Penilaian</th>
    <th style="width: 15%; text-align: center; vertical-align: top">Kriteria & Bentuk Penilaian</th>
    <th style="width: 15%; text-align: center; vertical-align: top">Metode Pembelajaran</th>
    <th style="width: 15%; text-align: center; vertical-align: top">Materi Pembelajaran</th>
    <th style="width: 10%; text-align: center; vertical-align: top">Bobot Penilaian (%)</th>
</tr>
<tr bgcolor="#ebebe0">
    <th style="text-align: center">(1)</th>
    <th style="text-align: center">(2)</th>
    <th style="text-align: center">(3)</th>
    <th style="text-align: center">(4)</th>
    <th style="text-align: center">(5)</th>
    <th style="text-align: center">(6)</th>
    <th style="text-align: center">(7)</th>
</tr>
<?php foreach ($list_matriks as $dt_matriks): ?>
<?php if ($dt_matriks['sub']==1): ?>
    <tr bgcolor="#ebebe0">
        <td height="30%" align="center"><?php echo $dt_matriks['pertemuan_ke'];?></td>
        <td><?php echo $dt_matriks['nama_sub'];?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
<?php else: ?>
    <tr>
        <td valign="top" align="center"><?php echo $dt_matriks['pertemuan_ke'];?></td>
        <td valign="top"><?php echo $dt_matriks['capaian_pembelajaran'];?></td>
        <td valign="top"><?php echo $dt_matriks['indikator_penilaian'];?></td>
        <td valign="top"><?php echo $dt_matriks['teknik_penilaian'];?></td>
        <td valign="top"><?php echo $dt_matriks['metode_pembelajaran'];?></td>
        <td valign="top"><?php echo $dt_matriks['bahasan_kajian'];?></td>
        <td style="text-align: center" valign="top"><?php echo $dt_matriks['bobot_tagihan'];?></td>
    </tr>
<?php endif ?>
<?php endforeach ?>
</table>
<?php if(!empty($dt_rps->catatan)) { ?>
<table width="100%" style="font-family: Arial; font-size: 12pt;border-collapse:collapse">
  <tr>
    <td height="30px"><strong>Catatan :</strong></td>
  </tr>
  <tr>
    <td height="30px"><?php echo $dt_rps->catatan;?></td>
  </tr>
</table>
<?php } ?>