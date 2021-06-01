<div class="content-wrapper">
  <section class="content-header">
    <h1>Computer Based Test (CBT) <small>Jadwal Ujian</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Detail Jadwal Ujian</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">JADWAL UJIAN</h3>
            <hr>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label-left">PROGRAM STUDI</label>
                    <label class="col-sm-4 control-label-left">:
                    <?php echo $head_jadwal->nama_ps;?>
                    </label>
                    <label class="col-sm-2 control-label-left">TAHUN AKADEMIK</label>
                    <label class="col-sm-4 control-label-left">:
                    <?php echo $head_jadwal->nama_tahun;?>
                    </label>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label-left">KODE UJIAN</label>
                    <label class="col-sm-4 control-label-left">:
                    <?php echo $head_jadwal->kode_ujian;?>
                    </label>
                    <label class="col-sm-2 control-label-left">MATAKULIAH</label>
                    <label class="col-sm-4 control-label-left">:
                    <?php echo $head_jadwal->nama_matakuliah;?>
                    </label>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label-left">TANGGAL UJIAN</label>
                    <label class="col-sm-4 control-label-left">:
                    <?php echo date_format(date_create($head_jadwal->tanggal_ujian), "d/m/Y");?>
                    </label>
                    <label class="col-sm-2 control-label-left">TEAM</label>
                    <label class="col-sm-4 control-label-left">:
                    <?php
                            $arr_dosen = explode(",", $head_jadwal->team_dosen);
                            for ($i=0; $i < count($arr_dosen); $i++) 
                            { 
                                $all_dosen[] = $this->model_dosen->get_profil_dosen($arr_dosen[$i])->nama_dosen;
                            }
                            $nom=1;
                            foreach ($all_dosen as $key => $value) {
                                echo $nom.". ".$value."<br>";
                                $nom++;
                            }
                            unset($all_dosen);
                            ?>
                    </label>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label-left">JAM UJIAN</label>
                    <label class="col-sm-4 control-label-left">:
                    <?php echo $head_jadwal->jam_ujian;?>
                    </label>
                    <label class="col-sm-2 control-label-left">DURASU UJIAN</label>
                    <label class="col-sm-4 control-label-left">:
                    <?php echo $head_jadwal->lama_pengerjaan;?>
                    </label>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label-left">INDIKATOR PENILAI</label>
                    <div class="col-sm-10">
                        <table style="width: 50%; border-collapse:collapse" border="1">
                            <tr>
                            <td rowspan="2" style="width: 20%; text-align: center">Nilai Huruf</td>
                            <td colspan="2" style="text-align: center; height: 30px;">Range Nilai</td>
                            </tr>
                            <tr>
                            <td style="width: 15%; height: 30px; text-align: center;">Batas Awal</td>
                            <td style="width: 15%; text-align: center">Batal Akhir</td>
                            </tr>
                            <tr>
                            <td style="text-align: center;">A</td>
                            <td style="text-align: center; height: 30px;"><?php echo $head_jadwal->range_a_1;?></td>
                            <td style="text-align: center;"><?php echo $head_jadwal->range_a_2;?></td>
                            </tr>
                            <tr>
                            <td style="text-align: center;">B</td>
                            <td style="text-align: center; height: 30px;"><?php echo $head_jadwal->range_b_1;?></td>
                            <td style="text-align: center;"><?php echo $head_jadwal->range_b_2;?></td>
                            </tr>
                            <tr>
                            <td style="text-align: center;">C</td>
                            <td style="text-align: center; height: 30px;"><?php echo $head_jadwal->range_c_1;?></td>
                            <td style="text-align: center;"><?php echo $head_jadwal->range_c_2;?></td>
                            </tr>
                            <tr>
                            <td style="text-align: center;">D</td>
                            <td style="text-align: center; height: 30px;"><?php echo $head_jadwal->range_d_1;?></td>
                            <td style="text-align: center;"><?php echo $head_jadwal->range_d_2;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">PESERTA UJIAN</h3>
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-add"><i class="fa fa-plus"></i> Tambah Peserta</button>
                    </div>
                    <hr>
                    <div class="row">
                    <div class="col-md-12">
                        <div class="box-body table-responsive">
                        <table class="table" style="width: 100%;">
                        <thead>
                            <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 15%;">NIM</th>
                            <th style="width: 70%;">Nama Mahasiswa</th>
                            <th style="width: 10%;">Nilai</th>
                            </tr>
                        </thead>
                        </table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
</div>