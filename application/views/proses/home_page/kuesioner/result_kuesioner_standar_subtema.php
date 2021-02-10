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
                <label class="col-sm-4 col-form-label"><?php 
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
               ?></label>
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
                if(empty($dt_hk->kat_kue) || $dt_hk->kat_kue==0)
                {
                  echo "Standar";
                } else {
                  foreach ($arr_krit as $key => $value) {
                    if($key==$dt_hk->kat_kue)
                    {
                      echo $value;
                    } 
                  }
                }
                ?></label>
            </div>
          </div>
          <div class="box-body">
            <?php 
            $jml_cols=0; 
            $nom_subtema=65; 
            $jml_pertanyaan = count($dt_dk);
            foreach ($dt_subtema as $dt_subtema): ?>
              <?php $res_detail_subtema = $this->Model_tmp_kuesioner->get_data_kuesioner_d_subtema($dt_hk->id, $dt_subtema['id']);?>
              <div class="box-header">
                <h3 class="box-title"><strong><?php echo chr($nom_subtema).". ".$dt_subtema['sub_tema'];?></strong></h3>
              </div>
              <table class="table" style="width: 100%" border="1">
                <thead>
                  <tr bgcolor="#3c8dbc" style="color: white">
                    <th style="text-align: center; width: 5%">No.</th>
                    <th style="text-align: left" colspan="3">Pertanyaan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $nom=1; foreach ($res_detail_subtema as $det): ?>
                    <?php 
                    $jml_resp = count($this->Model_kuesioner->get_responden($dt_hk->id, $det['id']));
                    $jml_res_6 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 6));
                    $jml_res_5 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 5));
                    $jml_res_4 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 4));
                    $jml_res_3 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 3));
                    $jml_res_2 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 2));
                    $jml_res_1 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 1));
                    $pers_6 = ($jml_res_6!=0)?($jml_res_6 / $jml_resp)*100:0;
                    $pers_5 = ($jml_res_5!=0)?($jml_res_5 / $jml_resp)*100:0;
                    $pers_4 = ($jml_res_4!=0)?($jml_res_4 / $jml_resp)*100:0;
                    $pers_3 = ($jml_res_3!=0)?($jml_res_3 / $jml_resp)*100:0;
                    $pers_2 = ($jml_res_2!=0)?($jml_res_2 / $jml_resp)*100:0;
                    $pers_1 = ($jml_res_1!=0)?($jml_res_1 / $jml_resp)*100:0;
                    $res_0 = $this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $det['id'], 0);
                    ?>
                    <tr bgcolor="#9ec8e0">
                      <td style="text-align: center;"><?php echo $nom;?></td>
                      <td colspan="3"><?php echo $det['pertanyaan'];?></td>
                    </tr>
                    <?php if ($det['tipe_jawaban']==1 && $det['jumlah_pilihan']==1): ?>
                      <tr>
                        <td></td>
                        <td style="width: 75%"><?php echo $det['pil_1'];?></td>
                        <td style="width: 10%; text-align: center;"><?php echo $jml_res_2; ?></td>
                        <td style="width: 10%; text-align: center;"><?php echo number_format($pers_2,2);?> %</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td><?php echo $det['pil_2'];?></td>
                        <td style="text-align: center;"><?php echo $jml_res_1; ?></td>
                        <td style="text-align: center;"><?php echo number_format($pers_1,2);?> %</td>
                      </tr>
                      <tr bgcolor="#d8e9f3">
                        <td></td>
                        <td><b>TOTAL RESPONDEN</b></td>
                        <td style="text-align: center;"><b><?php echo $jml_res_2 + $jml_res_1 ?></b></td>
                        <td style="text-align: center;"><?php echo number_format($pers_2,2) + number_format($pers_1,2);?> %</td>
                      </tr>
                    <?php elseif($det['tipe_jawaban']==1 && $det['jumlah_pilihan']==2): ?>
                      <tr>
                        <td></td>
                        <td style="width: 75%"><?php echo $det['pil_1'];?></td>
                        <td style="width: 10%; text-align: center;"><?php echo $jml_res_3; ?></td>
                        <td style="width: 10%; text-align: center;"><?php echo number_format($pers_3,2);?> %</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td><?php echo $det['pil_2'];?></td>
                        <td style="text-align: center;"><?php echo $jml_res_2; ?></td>
                        <td style="text-align: center;"><?php echo number_format($pers_2,2);?> %</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td><?php echo $det['pil_3'];?></td>
                        <td style="text-align: center;"><?php echo $jml_res_1; ?></td>
                        <td style="text-align: center;"><?php echo number_format($pers_1,2);?> %</td>
                      </tr>
                      <tr bgcolor="#d8e9f3">
                        <td></td>
                        <td><b>TOTAL RESPONDEN</b></td>
                        <td style="text-align: center;"><b><?php echo $jml_res_3 + $jml_res_2 + $jml_res_1 ?></b></td>
                        <td style="text-align: center;"><?php echo number_format($pers_3,2) + number_format($pers_2,2) + number_format($pers_1,2);?> %</td>
                      </tr>
                    <?php elseif($det['tipe_jawaban']==1 && $det['jumlah_pilihan']==3): ?>
                      <tr>
                        <td></td>
                        <td style="width: 75%"><?php echo $det['pil_1'];?></td>
                        <td style="width: 10%; text-align: center;"><?php echo $jml_res_4; ?></td>
                        <td style="width: 10%; text-align: center;"><?php echo number_format($pers_4,2);?> %</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td><?php echo $det['pil_2'];?></td>
                        <td style="text-align: center;"><?php echo $jml_res_3; ?></td>
                        <td style="text-align: center;"><?php echo number_format($pers_3,2);?> %</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td><?php echo $det['pil_3'];?></td>
                        <td style="text-align: center;"><?php echo $jml_res_2; ?></td>
                        <td style="text-align: center;"><?php echo number_format($pers_2,2);?> %</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td><?php echo $det['pil_4'];?></td>
                        <td style="text-align: center;"><?php echo $jml_res_1; ?></td>
                        <td style="text-align: center;"><?php echo number_format($pers_1,2);?> %</td>
                      </tr>
                      <tr bgcolor="#d8e9f3">
                        <td></td>
                        <td><b>TOTAL RESPONDEN</b></td>
                        <td style="text-align: center;"><b><?php echo $jml_res_4 + $jml_res_3 + $jml_res_2 + $jml_res_1 ?></b></td>
                        <td style="text-align: center;"><?php echo number_format($pers_4,2) + number_format($pers_3,2) + number_format($pers_2,2) + number_format($pers_1,2);?> %</td>
                      </tr>
                    <?php elseif($det['tipe_jawaban']==1 && $det['jumlah_pilihan']==4): ?>
                      <tr>
                        <td></td>
                        <td style="width: 75%"><?php echo $det['pil_1'];?></td>
                        <td style="width: 10%; text-align: center;"><?php echo $jml_res_5; ?></td>
                        <td style="width: 10%; text-align: center;"><?php echo number_format($pers_5,2);?> %</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td><?php echo $det['pil_2'];?></td>
                        <td style="text-align: center;"><?php echo $jml_res_4; ?></td>
                        <td style="text-align: center;"><?php echo number_format($pers_4,2);?> %</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td><?php echo $det['pil_3'];?></td>
                        <td style="text-align: center;"><?php echo $jml_res_3; ?></td>
                        <td style="text-align: center;"><?php echo number_format($pers_3,2);?> %</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td><?php echo $det['pil_4'];?></td>
                        <td style="text-align: center;"><?php echo $jml_res_2; ?></td>
                        <td style="text-align: center;"><?php echo number_format($pers_2,2);?> %</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td><?php echo $det['pil_5'];?></td>
                        <td style="text-align: center;"><?php echo $jml_res_1; ?></td>
                        <td style="text-align: center;"><?php echo number_format($pers_1,2);?> %</td>
                      </tr>
                      <tr bgcolor="#d8e9f3">
                        <td></td>
                        <td><b>TOTAL RESPONDEN</b></td>
                        <td style="text-align: center;"><b><?php echo $jml_res_5 + $jml_res_4 + $jml_res_3 + $jml_res_2 + $jml_res_1 ?></b></td>
                        <td style="text-align: center;"><?php echo number_format($pers_5,2) + number_format($pers_4,2) + number_format($pers_3,2) + number_format($pers_2,2) + number_format($pers_1,2);?> %</td>
                      </tr>
                    <?php elseif($det['tipe_jawaban']==1 && $det['jumlah_pilihan']==5): ?>
                      <tr>
                        <td></td>
                        <td style="width: 75%"><?php echo $det['pil_1'];?></td>
                        <td style="width: 10%; text-align: center;"><?php echo $jml_res_6; ?></td>
                        <td style="width: 10%; text-align: center;"><?php echo number_format($pers_6,2);?> %</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td><?php echo $det['pil_2'];?></td>
                        <td style="text-align: center;"><?php echo $jml_res_5; ?></td>
                        <td style="text-align: center;"><?php echo number_format($pers_5,2);?> %</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td><?php echo $det['pil_3'];?></td>
                        <td style="text-align: center;"><?php echo $jml_res_4; ?></td>
                        <td style="text-align: center;"><?php echo number_format($pers_4,2);?> %</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td><?php echo $det['pil_4'];?></td>
                        <td style="text-align: center;"><?php echo $jml_res_3; ?></td>
                        <td style="text-align: center;"><?php echo number_format($pers_3,2);?> %</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td><?php echo $det['pil_5'];?></td>
                        <td style="text-align: center;"><?php echo $jml_res_2; ?></td>
                        <td style="text-align: center;"><?php echo number_format($pers_2,2);?> %</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td><?php echo $det['pil_6'];?></td>
                        <td style="text-align: center;"><?php echo $jml_res_1; ?></td>
                        <td style="text-align: center;"><?php echo number_format($pers_1,2);?> %</td>
                      </tr>
                      <tr bgcolor="#d8e9f3">
                        <td></td>
                        <td><b>TOTAL RESPONDEN</b></td>
                        <td style="text-align: center;"><b><?php echo $jml_res_6 + $jml_res_5 + $jml_res_4 + $jml_res_3 + $jml_res_2 + $jml_res_1; ?></b></td>
                        <td style="text-align: center;"><?php echo number_format($pers_6,2) + number_format($pers_5,2) + number_format($pers_4,2) + number_format($pers_3,2) + number_format($pers_2,2) + number_format($pers_1,2);?> %</td>
                      </tr>
                    <?php else: ?>
                      <?php $nom_jwb_teks=1; foreach ($res_0 as $list_teks): ?>
                        <tr>
                          <td style="text-align: right;"><?php echo $nom_jwb_teks;?></td>
                          <td colspan="3"><?php echo $list_teks['jawaban_teks'];?></td>
                        </tr>
                      <?php $nom_jwb_teks++; endforeach ?>
                    <?php endif ?>
                  <?php $nom++; endforeach ?>
                </tbody>
              </table>
            <?php $nom_subtema++; endforeach ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>