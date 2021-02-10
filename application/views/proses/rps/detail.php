<div class="content-wrapper">
  <section class="content-header">
    <h1>Rencana Pembelajaran Semester (RPS) <small>Detail</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>Home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url();?>rps"><i class="fa fa-table"></i> Daftar RPS</a></li>
      <li class="active">Rencana Pembelajaran Semester (RPS)</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content invoice">
    <div class="row">
      <div class="col-xs-12">
        <h3 class="page-header">
          <strong>Program Studi : </strong> <?php echo $dt_rps->nama_ps;?>/<?php echo $dt_rps->nm_jenjang;?><small class="pull-right"><?php echo date_format(date_create($dt_rps->tgl_post), "d/m/Y");?></small>
        </h2>
      </div>
    </div>
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        MATAKULIAH/KODE<address><strong><?php echo $dt_rps->nama_matakuliah;?> / <?php echo $dt_rps->kode_matakuliah;?></strong></address>
      </div>
      <div class="col-sm-4 invoice-col">
        RUMPUN MK<address><strong><?php echo $dt_rps->jenis_matakuliah;?></strong></address>
      </div>
      <div class="col-sm-4 invoice-col">
        BOBOT/SEMESTER<address><strong><?php echo $dt_rps->sks;?> (sks) / <?php echo $dt_rps->semester;?></strong></address>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <?php 
        $rows_cp = count($list_aspek_sikap) + count($list_aspek_pengetahuan) + count($list_aspek_ku) + count($list_aspek_kk); ?>
        <table class="table" width="100%">
          <tr>
              <td style="width: 15%" rowspan="<?php echo $rows_cp+1;?>"><strong>Capaian Pembelajaran (CP)</strong></td>
              <td colspan="2"><strong>CPL-PRODI</strong></td>
          </tr>
          <?php
          foreach ($list_aspek_sikap as $sikap) { ?>
          <tr>
              <td style="width: 5%"><strong><?php echo $sikap['kode']; ?></strong></td>
              <td style="width: 80%"><?php echo $sikap['desk']; ?></td>
          </tr>
          <?php }?>
          <?php foreach ($list_aspek_pengetahuan as $pengetahuan) { ?>
          <tr>
              <td style="width: 5%"><strong><?php echo $pengetahuan['kode']; ?></strong></td>
              <td style="width: 80%"><?php echo $pengetahuan['desk']; ?></td>
          </tr>
          <?php }?>
          <?php foreach ($list_aspek_ku as $ku) { ?>
          <tr>
              <td style="width: 5%"><strong><?php echo $ku['kode']; ?></strong></td>
              <td style="width: 80%"><?php echo $ku['desk']; ?></td>
          </tr>
          <?php }?>
          <?php foreach ($list_aspek_kk as $kk) { ?>
          <tr>
              <td style="width: 5%"><strong><?php echo $kk['kode']; ?></strong></td>
              <td style="width: 80%"><?php echo $kk['desk']; ?></td>
          </tr>
          <?php }?>
        </table>
        <table class="table" width="100%">
        <tr>
          <td style="width: 15%" rowspan="<?php echo count($list_cpmk)+1;?>"></td>
          <td colspan="2" style="width: 85%"><strong>CPL-MK</strong></td>
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
            <td><strong>M<?php echo $dt_cpmk['no_urut']; ?></strong></td>
            <td><?php echo $dt_cpmk['deskripsi'].$unsur_cpl; ?></td>
          </tr>
        <?php endforeach ?>
        </table>
        <table class="table" width="100%">
          <tr>
            <td valign="top"><strong>Deskripsi Singkat MK</strong></td>
            <td valign="top"><?php echo $dt_rps->deskripsi_matkul;?></td>
          </tr>
          <tr>
            <td valign="top" style="width: 15%"><strong>Materi Pembelajaran/Pokok Bahasan</strong></td>
            <td valign="top" style="width: 85%"><?php echo $dt_rps->pokok_bahasan;?></td>
          </tr>
          <tr>
            <td valign="top"><strong>Pustaka</strong></td>
            <td><strong>Utama :</strong></td>
          </tr>
          <tr>
            <td></td>
            <td>
              <?php
              foreach ($list_referensi as $key => $value) 
              {
                  echo $value."<br>";
              }
              ?>
            </td>
          </tr>
          <tr>
            <td></td>
            <td><strong>Pendukung :</strong></td>
          </tr>
          <tr>
            <td valign="top"><strong>Media Pembelajaran</strong></td>
            <td><strong>Perangkat Lunak :</strong></td>
          </tr>
          <tr>
            <td></td>
            <td><?php echo $dt_rps->perangkat_lunak;?></td>
          </tr>
          <tr>
            <td></td>
            <td><strong>Perangkat Keras :</strong></td>
          </tr>
          <tr>
            <td></td>
            <td><?php echo $dt_rps->perangkat_keras;?></td>
          </tr>
          <tr>
            <td valign="top"><strong>Team Teaching</strong></td>
            <td>
              <?php $nom=1; foreach ($list_dsn as $key => $value): ?>
                <?php echo $nom.". ".$value;?><br>
              <?php $nom++; endforeach ?>
            </td>
          </tr>
          <tr>
            <td valign="top"><strong>Matakuliah Syarat</strong></td>
            <td><?php echo $dt_rps->prasyarat_matkul;?></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table" width="100%">
        <thead>
        <tr>
            <th style="width: 5%; text-align: center; vertical-align: top">Mg Ke-</th>
            <th style="width: 20%; text-align: center; vertical-align: top">Sub-CP-MK (sbg kemampuan akhir yg diharapkan</th>
            <th style="width: 20%; text-align: center; vertical-align: top">Indikator Penilaian</th>
            <th style="width: 15%; text-align: center; vertical-align: top">Kriteria & Bentuk Penilaian</th>
            <th style="width: 15%; text-align: center; vertical-align: top">Metode Pembelajaran</th>
            <th style="width: 15%; text-align: center; vertical-align: top">Materi Pembelajaran</th>
            <th style="width: 10%; text-align: center; vertical-align: top">Bobot Penilaian (%)</th>
        </tr>
        <tr>
            <th style="text-align: center">(1)</th>
            <th style="text-align: center">(2)</th>
            <th style="text-align: center">(3)</th>
            <th style="text-align: center">(4)</th>
            <th style="text-align: center">(5)</th>
            <th style="text-align: center">(6)</th>
            <th style="text-align: center">(7)</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($list_matriks as $dt_matriks): ?>
            <?php if ($dt_matriks['sub']==1): ?>
                <tr bgcolor="#e3e3e3">
                    <td><?php echo $dt_matriks['pertemuan_ke'];?></td>
                    <td><?php echo $dt_matriks['nama_sub'];?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td><?php echo $dt_matriks['pertemuan_ke'];?></td>
                    <td><?php echo $dt_matriks['capaian_pembelajaran'];?></td>
                    <td><?php echo $dt_matriks['indikator_penilaian'];?></td>
                    <td><?php echo $dt_matriks['teknik_penilaian'];?></td>
                    <td><?php echo $dt_matriks['metode_pembelajaran'];?></td>
                    <td><?php echo $dt_matriks['bahasan_kajian'];?></td>
                    <td style="text-align: center"><?php echo $dt_matriks['bobot_tagihan'];?></td>
                </tr>
            <?php endif ?>
            <?php endforeach ?>
        </tbody>
        </table>
      </div>
    </div>
    <?php if(!empty($dt_rps->catatan)) { ?>
    <div class="row">
      <div class="col-sm-12 invoice-col"><strong>Catatan</strong></div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <?php echo $dt_rps->catatan;?>
      </div>
    </div>
    <?php } ?>
  </section>
  <div class="clearfix"></div>
</div>