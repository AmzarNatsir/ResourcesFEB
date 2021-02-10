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
              <table class="table" width="100%">
                <thead>
                  <th style="width: 5%; text-align: center;">No.</th>
                  <th style="width: 45%; text-align: center;">Pertanyaan</th>
                  <th style="text-align: center;">P</th>
                  <th style="text-align: center;">Skor</th>
                  <th style="text-align: center;">Error</th>
                </thead>
                <tbody>
                  <?php 
                  $nom=1; 
                  $tot_1=0; 
                  $tot_0=0; 
                  $tot_p = 0;
                  $tot_pertanyaan = count($dt_dk);
                  foreach ($dt_dk as $dt): ?>
                    <?php
                    $jml_pilihan_1 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $dt['id'], 2));
                    $jml_pilihan_0 = count($this->Model_kuesioner->get_responden_pilihan($dt_hk->id, $dt['id'], 1));
                    $tot_res = $jml_pilihan_1 + $jml_pilihan_0;
                    $p = $jml_pilihan_1/$tot_res;
                    ?>
                    <tr>
                      <td style="text-align: center;"><?php echo $nom;?></td>
                      <td><?php echo $dt['pertanyaan'];?></td>
                      <td style="text-align: center;"><?php echo round($p, 2);?></td>
                      <td style="text-align: center;"><?php echo $jml_pilihan_1;?></td>
                      <td style="text-align: center;"></td>
                    </tr>
                  <?php $nom++; $tot_1+=$jml_pilihan_1; $tot_0+=$jml_pilihan_0; $tot_p+=$p; endforeach ?>
                  <tr class="btn-primary">
                    <td colspan="2" style="text-align: right;">TOTAL</td>
                    <td  style="text-align: center;"><?php echo round($tot_p, 2);?></td>
                    <td style="text-align: center;"><?php echo $tot_1;?></td>
                    <td></td>
                  </tr>
                  <tr class="btn-primary">
                    <td colspan="5" style="text-align: left;">OUTPUT</td>
                  </tr>
                  <tr class="btn-primary">
                    <td colspan="5" style="text-align: left;">Potensial Error : 
                      <?php echo $tot_pertanyaan * ($tot_1 + $tot_0); ?>
                    </td>
                  </tr>
                  <tr class="btn-primary">
                    <td colspan="5" style="text-align: left;">Jumlah Error : 
                      <?php echo $tot_pertanyaan * ($tot_1 + $tot_0); ?>
                    </td>
                  </tr>
                  <tr class="btn-primary">
                    <td colspan="5" style="text-align: left;">Koefisien Reprodusibilitas : 
                      <?php echo $tot_pertanyaan * ($tot_1 + $tot_0); ?>
                    </td>
                  </tr>
                  <tr class="btn-primary">
                    <td colspan="5" style="text-align: left;">Koefisien Skalabilitas : 
                      <?php echo $tot_pertanyaan * ($tot_1 + $tot_0); ?>
                    </td>
                  </tr>
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>