<?php
$date_skr = strtotime(date("Y-m-d"));
$tgl_ujian = strtotime($head_jadwal->tanggal_ujian);
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Computer Based Test (CBT) <small>Jadwal Ujian</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Detail Jadwal Ujian</li>
    </ol>
  </section>
  <section class="content">
    <?php if ($this->session->flashdata('info')): ?>
      <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-info"></i> Konfirmasi !</h4>
        <?php echo $this->session->flashdata('info'); ?>
      </div>
    <?php endif; ?>
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
                    <div class="col-sm-8">
                        <table style="width: 45%; border-collapse:collapse" border="1">
                            <tr>
                            <td rowspan="2" style="width: 15%; text-align: center">Nilai Huruf</td>
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
                    <?php
                    if($tgl_ujian > $date_skr) { ?>
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-info btn-sm tbl_add_peserta" data-toggle="modal" data-target="#modal-add"><i class="fa fa-plus"></i> Tambah Peserta</button>
                    </div>
                    <?php } ?>
                    <hr>
                    <div class="row">
                    <div class="col-md-12">
                        <div class="box-body table-responsive">
                        <table class="table" style="width: 100%;">
                        <thead>
                            <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 15%;">NIM</th>
                            <th style="width: 50%;">Nama Mahasiswa</th>
                            <th style="width: 10%; text-align: center;">Jam Mulai</th>
                            <th style="width: 19%; text-align: center">Jam Selesai</th>
                            <th style="width: 10%; text-align: center">Nilai</th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                          $nom=1;
                          if(count($list_peserta) <=0)
                          {
                            echo "<tr><td colspan='7'>Peserta Ujian Masih Kosong</td></tr>";
                          } else {
                            foreach($list_peserta as $psrt)
                            {
                              ?>
                              <tr>
                                <td><?= $nom ?></td>
                                <td><?= $psrt['nim'] ?></td>
                                <td><?= $psrt['nama_mahasiswa'] ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                <?php
                                if($tgl_ujian > $date_skr) { ?>
                                  <a href="<?php echo base_url();?>cbt/hapus_peserta/<?php echo $psrt['id'];?>/<?php echo $head_jadwal->id;?>" title='Hapus peserta' onclick='return HapusPeserta()'><i class='fa fa-remove btn btn-danger'></i></a>
                                <?php } ?>
                                </td>
                              </tr>
                              <?php
                              $nom++;
                            }
                          }?>
                        </tbody>
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
<!-- Add Kegiatan -->
<div class="modal fade" id="modal-add" data-backdrop="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Peserta Ujian</h4>
      </div>
      <div id="frm_modal_peserta"></div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function()
    {
      window.setTimeout(function() { $(".alert").alert('close'); }, 2000);
      $(".tbl_add_peserta").on("click", function()
      {
          // $("#frm_modal_peserta").load("<?php echo base_url();?>cbt/tambah_peserta/"+obj);
        var id_jadwal = "<?php echo $head_jadwal->id;?>";
          $.ajax({
            type : "POST",
            url : "<?php echo base_url();?>cbt/tambah_peserta",
            data : {id_jadwal:id_jadwal},
            success : function(respond) {
              $("#frm_modal_peserta").html(respond);
            }
          });
          //console.log(obj);   

          //alert(obj.profil[0].id_ta);
      });
    });
    var HapusPeserta = function(el)
    {
      //var id_peserta = $(el).val();
      var psn = confirm("Yakin data peserta akan dihapus ?");
      if(psn==true)
      {
        return true;
      } else {
        return false;
      }
    }
    function konfirm()
    {
      var psn = confirm("Yakin data peserta ujian akan disimpan ?");
      if(psn==true)
      {
        return true;
      } else {
        return false;
      }
    } 
</script>