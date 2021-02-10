<div class="content-wrapper">
  <section class="content-header">
    <h1>Home Page<small>Kuesioner</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url();?>kuesioner"><i class="fa fa-home"></i> List Kuesioner</a></li>
      <li class="active">Hasil Kuesioner</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Hasil kuesioner</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tema Kuesioner</label>
                <label class="col-sm-10 col-form-label">: <?php echo $dt_hk->tema_kue;?></label>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Masa aktif</label>
                <label class="col-sm-4 col-form-label">: <?php echo convert_tanggal($dt_hk->tgl_start);?> s/d <?php echo convert_tanggal($dt_hk->tgl_end);?></label>
                <label class="col-sm-2 col-form-label">Display</label>
                <label class="col-sm-4 col-form-label">
                  <?php 
                $arr_disp = array("1"=>"Umum", "2"=>"Mahasiswa", "3"=>"Dosen", "4"=>"Pegawai");
                $arr_dt_disp = explode(",", $dt_hk->display);
                $jml_data = count($arr_dt_disp);

                foreach ($arr_disp as $key1 => $value1) 
                {
                  for($i=0; $i<=(int)$jml_data-1; $i++)
                  {
                    if($key1==$arr_dt_disp[$i])
                    {
                      echo "- ".$value1."<br>";
                    }
                  }
                } 
               ?>
                </label>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kuesioner</label>
                <label class="col-sm-4 col-form-label">: <?php 
                $arr_jenis = array("1"=>"Multiple Choice", "2"=>"Essay", "3"=>"Collaboration");
                foreach ($arr_jenis as $key => $value) {
                  if($key==$dt_hk->jenis_kuesioner)
                  {
                    echo $value;
                  }
                }?></label>
                <label class="col-sm-2 col-form-label">Kriteria</label>
                <label class="col-sm-4 col-form-label">: <?php 
                $arr_krit = array("1"=>"Skala Likert", "2"=>"Skala Gutman");
                foreach ($arr_krit as $key => $value) {
                  if($key==$dt_hk->kat_kue)
                  {
                    echo $value;
                  } 
                }
                ?></label>
            </div>
          </div>
          <div class="box-body">
              <?php $nom_subtema=65; foreach ($dt_subtema as $dt_subtema): ?>
                <?php $res_detail_subtema = $this->Model_tmp_kuesioner->get_data_kuesioner_d_subtema($dt_hk->id, $dt_subtema['id']);?>
                <div class="box-header">
                  <h3 class="box-title"><strong><?php echo chr($nom_subtema).". ".$dt_subtema['sub_tema'];?></strong></h3>
                </div>
                <?php if($dt_hk->jumlah_pilihan==1) {?>
              <table class="table" style="width: 100%">
                <thead>
                  <tr>
                    <th rowspan="2" style="text-align: center;">No.</th>
                    <th rowspan="2" style="text-align: center;">Pertanyaan</th>
                    <th rowspan="2" style="text-align: center;">Responden</th>
                    <th colspan="2" style="text-align: center;">Pilihan</th>
                    <th rowspan="2" style="text-align: center;">Total</th>
                    <th rowspan="2" style="text-align: center;">Interpretasi</th>
                    <th rowspan="2" style="text-align: center;">Kategori</th>
                  </tr>
                  <tr>
                    <th style="text-align: center;">2</th>
                    <th style="text-align: center;">1</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $nom=1; foreach ($res_detail_subtema as $det): ?>
                    <?php $jml_resp = count($this->Model_kuesioner->get_responden($dt_hk->id, $det['id']));?>
                    <tr>
                      <td style="text-align: center;"><?php echo $nom;?></td>
                      <td><?php echo $det['pertanyaan'];?></td>
                      <td style="text-align: center;"><?php echo $jml_resp;?></td>
                      <td style="text-align: center;"><?php echo $det['pil_1'];?></td>
                      <td style="text-align: center;"><?php echo $det['pil_2'];?></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
              <?php
              $interval_1_awal = 0; $interval_1_akhir=49.99;
              $interval_2_awal = 50; $interval_2_akhir=100;
              $jml_res_1 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 1));
              $jml_res_2 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 2));
              $tot_skor_1 = $jml_res_1 * 1;
              $tot_skor_2 = $jml_res_2 * 2;
              $total_skor = $tot_skor_1 + $tot_skor_2;
              $y = 2 * $jml_resp;
              $x = 1 * $jml_resp;
              $interpretasi = round($total_skor / $y * 100);

              if(intval($interpretasi) >= $interval_1_awal && intval($interpretasi) <= $interval_1_akhir)
              {
                $kesimpulan = $det['pil_2'];
              } else {
                $kesimpulan = $det['pil_1'];
              }
              ?>
                    <tr class="btn-info">
                      <td colspan="3" style="text-align: center;"><strong>Total Jawaban Responden</strong></td>
                      <td style="text-align: center;"><strong><?php echo $tot_skor_2;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $tot_skor_1;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $total_skor;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $interpretasi;?> %</strong></td>
                      <td style="text-align: center;"><?php echo $kesimpulan;?></td>
                    </tr>

                  <?php $nom++; endforeach ?>
                </tbody>
              </table>
              <?php } ?>
              <?php if($dt_hk->jumlah_pilihan==2) {?>
              <table class="table" style="width: 100%">
                <thead>
                  <tr>
                    <th rowspan="2" style="text-align: center;">No.</th>
                    <th rowspan="2" style="text-align: center;">Pertanyaan</th>
                    <th rowspan="2" style="text-align: center;">Responden</th>
                    <th colspan="3" style="text-align: center;">Pilihan</th>
                    <th rowspan="2" style="text-align: center;">Total</th>
                    <th rowspan="2" style="text-align: center;">Interpretasi</th>
                    <th rowspan="2" style="text-align: center;">Kategori</th>
                  </tr>
                  <tr>
                    <td style="text-align: center;">3</td>
                    <td style="text-align: center;">2</td>
                    <td style="text-align: center;">1</td>
                  </tr>
                </thead>
                <tbody>
                  <?php $nom=1; foreach ($res_detail_subtema as $det): ?>
                    <?php $jml_resp = count($this->Model_kuesioner->get_responden($dt_hk->id, $det['id']));?>
                    <tr>
                      <td style="text-align: center;"><?php echo $nom;?></td>
                      <td><?php echo $det['pertanyaan'];?></td>
                      <td style="text-align: center;"><?php echo $jml_resp;?></td>
                      <td style="text-align: center;"><?php echo $det['pil_1'];?></td>
                      <td style="text-align: center;"><?php echo $det['pil_2'];?></td>
                      <td style="text-align: center;"><?php echo $det['pil_3'];?></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
              <?php
              $interval_1_awal = 0; $interval_1_akhir=33;
              $interval_2_awal = 34; $interval_2_akhir=66;
              $interval_3_awal = 67; $interval_3_akhir=100;
              $jml_res_1 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 1));
              $jml_res_2 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 2));
              $jml_res_3 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 3));
              $tot_skor_1 = $jml_res_1 * 1;
              $tot_skor_2 = $jml_res_2 * 2;
              $tot_skor_3 = $jml_res_3 * 3;
              $total_skor = $tot_skor_1 + $tot_skor_2 + $tot_skor_3;
              $y = 3 * $jml_resp;
              $x = 1 * $jml_resp;
              $interpretasi = round($total_skor / $y * 100);

              if(intval($interpretasi) >= $interval_1_awal && intval($interpretasi) <= $interval_1_akhir)
              {
                $kesimpulan = $det['pil_3'];
              } elseif(intval($interpretasi) >= $interval_2_awal  && intval($interpretasi) <= $interval_2_akhir) {
                $kesimpulan = $det['pil_2'];
              } else {
                $kesimpulan = $det['pil_1'];
              }
              ?>
                    <tr class="btn-info">
                      <td colspan="3" style="text-align: center;"><strong>Total Jawaban Responden</strong></td>
                      <td style="text-align: center;"><strong><?php echo $tot_skor_3;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $tot_skor_2;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $tot_skor_1;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $total_skor;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $interpretasi;?> %</strong></td>
                      <td style="text-align: center;"><?php echo $kesimpulan;?></td>
                    </tr>
                  <?php $nom++; endforeach ?>
                </tbody>
              </table>
              <?php } ?>
              <?php if($dt_hk->jumlah_pilihan==3) {?>
              <table class="table" style="width: 100%">
                <thead>
                  <tr>
                    <th rowspan="2" style="text-align: center;">No.</th>
                    <th rowspan="2" style="text-align: center;">Pertanyaan</th>
                    <th rowspan="2" style="text-align: center;">Responden</th>
                    <th colspan="4" style="text-align: center;">Pilihan</th>
                    <th rowspan="2" style="text-align: center;">Total</th>
                    <th rowspan="2" style="text-align: center;">Interpretasi</th>
                    <th rowspan="2" style="text-align: center;">Kategori</th>
                  </tr>
                  <tr>
                    <td style="text-align: center;">4</td>
                    <td style="text-align: center;">3</td>
                    <td style="text-align: center;">2</td>
                    <td style="text-align: center;">1</td>
                  </tr>
                </thead>
                <tbody>
                  <?php $nom=1; foreach ($res_detail_subtema as $det): ?>
                    <?php $jml_resp = count($this->Model_kuesioner->get_responden($dt_hk->id, $det['id']));?>
                    <tr>
                      <td style="text-align: center;"><?php echo $nom;?></td>
                      <td><?php echo $det['pertanyaan'];?></td>
                      <td style="text-align: center;"><?php echo $jml_resp;?></td>
                      <td style="text-align: center;"><?php echo $det['pil_1'];?></td>
                      <td style="text-align: center;"><?php echo $det['pil_2'];?></td>
                      <td style="text-align: center;"><?php echo $det['pil_3'];?></td>
                      <td style="text-align: center;"><?php echo $det['pil_4'];?></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
              <?php
              $interval_1_awal = 0; $interval_1_akhir=24.99;
              $interval_2_awal = 25; $interval_2_akhir=49.99;
              $interval_3_awal = 50; $interval_3_akhir=74.99;
              $interval_4_awal = 75; $interval_4_akhir=100;
              
              $jml_res_1 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 1));
              $jml_res_2 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 2));
              $jml_res_3 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 3));
              $jml_res_4 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 4));
              $tot_skor_1 = $jml_res_1 * 1;
              $tot_skor_2 = $jml_res_2 * 2;
              $tot_skor_3 = $jml_res_3 * 3;
              $tot_skor_4 = $jml_res_4 * 4;
              $total_skor = $tot_skor_1 + $tot_skor_2 + $tot_skor_3 + $tot_skor_4;
              $y = 4 * $jml_resp;
              $x = 1 * $jml_resp;
              $interpretasi = round($total_skor / $y * 100);

              if(intval($interpretasi) >= $interval_1_awal && intval($interpretasi) <= $interval_1_akhir)
              {
                $kesimpulan = $det['pil_4'];
              } elseif(intval($interpretasi) >= $interval_2_awal  && intval($interpretasi) <= $interval_2_akhir) {
                $kesimpulan = $det['pil_3'];
              } elseif(intval($interpretasi) >= $interval_3_awal  && intval($interpretasi) <= $interval_3_akhir) {
                $kesimpulan = $det['pil_2'];
              } else {
                $kesimpulan = $det['pil_1'];
              }
              ?>
                    <tr class="btn-info">
                      <td colspan="3" style="text-align: center;"><strong>Total Jawaban Responden</strong></td>
                      <td style="text-align: center;"><strong><?php echo $tot_skor_4;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $tot_skor_3;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $tot_skor_2;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $tot_skor_1;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $total_skor;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $interpretasi;?> %</strong></td>
                      <td style="text-align: center;"><?php echo $kesimpulan;?></td>
                    </tr>

                  <?php $nom++; endforeach ?>
                </tbody>
              </table>
              <?php } ?>
              <?php if($dt_hk->jumlah_pilihan==4) {?>
              <table class="table" style="width: 100%">
                <thead>
                  <tr class="btn-primary">
                    <th rowspan="2" style="text-align: center;">No.</th>
                    <th rowspan="2" style="text-align: center;">Pertanyaan</th>
                    <th rowspan="2" style="text-align: center;">Responden</th>
                    <th colspan="5" style="text-align: center;">Pilihan</th>
                    <th rowspan="2" style="text-align: center;">Total</th>
                    <th rowspan="2" style="text-align: center;">Interpretasi</th>
                    <th rowspan="2" style="text-align: center;">Kategori</th>
                  </tr>
                  <tr class="btn-primary">
                    <td style="text-align: center;">5</td>
                    <td style="text-align: center;">4</td>
                    <td style="text-align: center;">3</td>
                    <td style="text-align: center;">2</td>
                    <td style="text-align: center;">1</td>
                  </tr>
                </thead>
                <tbody>
                  <?php $nom=1; foreach ($res_detail_subtema as $det): ?>
                    <?php $jml_resp = count($this->Model_kuesioner->get_responden($dt_hk->id, $det['id']));?>
                    <tr>
                      <td style="text-align: center;"><?php echo $nom;?></td>
                      <td><?php echo $det['pertanyaan'];?></td>
                      <td style="text-align: center;"><?php echo $jml_resp;?></td>
                      <td style="text-align: center;"><?php echo $det['pil_1'];?></td>
                      <td style="text-align: center;"><?php echo $det['pil_2'];?></td>
                      <td style="text-align: center;"><?php echo $det['pil_3'];?></td>
                      <td style="text-align: center;"><?php echo $det['pil_4'];?></td>
                      <td style="text-align: center;"><?php echo $det['pil_5'];?></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <?php
              $interval_1_awal = 0; $interval_1_akhir=19.99;
              $interval_2_awal = 20; $interval_2_akhir=39.99;
              $interval_3_awal = 40; $interval_3_akhir=59.99;
              $interval_4_awal = 60; $interval_4_akhir=79.99;
              $interval_5_awal = 80; $interval_5_akhir=100;

              $jml_res_1 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 1));
              $jml_res_2 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 2));
              $jml_res_3 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 3));
              $jml_res_4 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 4));
              $jml_res_5 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 5));
              $tot_skor_1 = $jml_res_1 * 1;
              $tot_skor_2 = $jml_res_2 * 2;
              $tot_skor_3 = $jml_res_3 * 3;
              $tot_skor_4 = $jml_res_4 * 4;
              $tot_skor_5 = $jml_res_5 * 5;
              $total_skor = $tot_skor_1 + $tot_skor_2 + $tot_skor_3 + $tot_skor_4 + $tot_skor_5;
              $y = 5 * $jml_resp;
              $x = 1 * $jml_resp;
              $interpretasi = round($total_skor / $y * 100);

              if(intval($interpretasi) >= $interval_1_awal && intval($interpretasi) <= $interval_1_akhir)
              {
                $kesimpulan = $det['pil_5'];
              } elseif(intval($interpretasi) >= $interval_2_awal  && intval($interpretasi) <= $interval_2_akhir) {
                $kesimpulan = $det['pil_4'];
              } elseif(intval($interpretasi) >= $interval_3_awal  && intval($interpretasi) <= $interval_3_akhir) {
                $kesimpulan = $det['pil_3'];
              } elseif(intval($interpretasi) >= $interval_4_awal  && intval($interpretasi) <= $interval_4_akhir) {
                $kesimpulan = $det['pil_2'];
              } else {
                $kesimpulan = $det['pil_1'];
              }
              ?>
                    <tr class="btn-info">
                      <td colspan="3"><strong>Total Jawaban Responden</strong></td>
                      <td style="text-align: center;"><strong><?php echo $tot_skor_5;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $tot_skor_4;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $tot_skor_3;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $tot_skor_2;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $tot_skor_1;?></strong></td>
                      <td><strong><?php echo $total_skor;?></strong></td>
                      <td><strong><?php echo $interpretasi;?> %</strong></td>
                      <td><?php echo $kesimpulan;?></td>
                    </tr>
                  <?php $nom++; endforeach ?>
                </tbody>
              </table>
              <?php } ?>
              <?php if($dt_hk->jumlah_pilihan==5) {?>
              <table class="table" style="width: 100%">
                <thead>
                  <tr>
                    <th rowspan="2" style="text-align: center;">No.</th>
                    <th rowspan="2" style="text-align: center;">Pertanyaan</th>
                    <th rowspan="2" style="text-align: center;">Responden</th>
                    <th colspan="6" style="text-align: center;">Pilihan</th>
                    <th rowspan="2" style="text-align: center;">Total Poin</th>
                    <th rowspan="2" style="text-align: center;">Interpretasi</th>
                    <th rowspan="2" style="text-align: center;">Kategori</th>
                  </tr>
                  <tr>
                    <td style="text-align: center;">6</td>
                    <td style="text-align: center;">5</td>
                    <td style="text-align: center;">4</td>
                    <td style="text-align: center;">3</td>
                    <td style="text-align: center;">2</td>
                    <td style="text-align: center;">1</td>
                  </tr>
                </thead>
                <tbody>
                  <?php $nom=1; foreach ($res_detail_subtema as $det): ?>
                    <?php $jml_resp = count($this->Model_kuesioner->get_responden($dt_hk->id, $det['id']));?>
                    <tr>
                      <td><?php echo $nom;?></td>
                      <td><?php echo $det['pertanyaan'];?></td>
                      <td><?php echo $jml_resp;?></td>
                      <td><?php echo $det['pil_1'];?></td>
                      <td><?php echo $det['pil_2'];?></td>
                      <td><?php echo $det['pil_3'];?></td>
                      <td><?php echo $det['pil_4'];?></td>
                      <td><?php echo $det['pil_5'];?></td>
                      <td><?php echo $det['pil_6'];?></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
              <?php
              $interval_1_awal = 0; $interval_1_akhir=15.99;
              $interval_2_awal = 16; $interval_2_akhir=31.99;
              $interval_3_awal = 32; $interval_3_akhir=47.99;
              $interval_4_awal = 48; $interval_4_akhir=63.99;
              $interval_5_awal = 64; $interval_5_akhir=79.99;
              $interval_6_awal = 78; $interval_6_akhir=100;

              $jml_res_1 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 1));
              $jml_res_2 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 2));
              $jml_res_3 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 3));
              $jml_res_4 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 4));
              $jml_res_5 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 5));
              $jml_res_6 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 6));
              $tot_skor_1 = $jml_res_1 * 1;
              $tot_skor_2 = $jml_res_2 * 2;
              $tot_skor_3 = $jml_res_3 * 3;
              $tot_skor_4 = $jml_res_4 * 4;
              $tot_skor_5 = $jml_res_5 * 5;
              $tot_skor_6 = $jml_res_6 * 6;
              $total_skor = $tot_skor_1 + $tot_skor_2 + $tot_skor_3 + $tot_skor_4 + $tot_skor_5 + $tot_skor_6;
              $y = 6 * $jml_resp;
              $x = 1 * $jml_resp;
              $interpretasi = round($total_skor / $y * 100);

              if(intval($interpretasi) >= $interval_1_awal && intval($interpretasi) <= $interval_1_akhir)
              {
                $kesimpulan = $det['pil_6'];
              } elseif(intval($interpretasi) >= $interval_2_awal  && intval($interpretasi) <= $interval_2_akhir) {
                $kesimpulan = $det['pil_5'];
              } elseif(intval($interpretasi) >= $interval_3_awal  && intval($interpretasi) <= $interval_3_akhir) {
                $kesimpulan = $det['pil_4'];
              } elseif(intval($interpretasi) >= $interval_4_awal  && intval($interpretasi) <= $interval_4_akhir) {
                $kesimpulan = $det['pil_3'];
              } elseif(intval($interpretasi) >= $interval_5_awal  && intval($interpretasi) <= $interval_5_akhir) {
                $kesimpulan = $det['pil_2'];
              } else {
                $kesimpulan = $det['pil_1'];
              }
              ?>
                    <tr class="btn-info">
                      <td colspan="3"><strong>Total Jawaban Responden</strong></td>
                      <td style="text-align: center;"><strong><?php echo $tot_skor_6;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $tot_skor_5;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $tot_skor_4;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $tot_skor_3;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $tot_skor_2;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $tot_skor_1;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $total_skor;?></strong></td>
                      <td style="text-align: center;"><strong><?php echo $interpretasi;?> %</strong></td>
                      <td style="text-align: center;"><?php echo $kesimpulan;?></td>
                    </tr>
                  <?php $nom++; endforeach ?>
                </tbody>
              </table>
              <?php } ?>
              <?php $nom_subtema++; endforeach ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>