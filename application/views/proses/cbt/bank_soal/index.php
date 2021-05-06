<div class="content-wrapper">
  <section class="content-header">
    <h1>Computer Based Test (CBT) <small>Bank Soal</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Bank Soal</li>
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
            <h3 class="box-title">BANK SOAL</h3>
            <hr>
            <fieldset>
              <table class="table" style="width: 100%;">
                  <thead>
                  <th style="width: 5%;">No</th>
                  <th style="width: 15%;">Program Studi</th>
                  <th style="width: 10%;">Kode Soal</th>
                  <th style="width: 25%;">Matakuliah</th>
                  <th style="width: 10%;">Soal</th>
                  <th>Team Pembuat Soal</th>
                  <th style="width: 10%;">Aksi</th>
                  </thead>
                  <tbod>
                  <?php
                  if(count($head_soal)<=0) {?>
                  <tr>
                  <td colspan="6" style="text-align: center;">Belum Ada Soal..</td>
                  </tr>
                  <?php } else {
                  $nom=1;
                  foreach($head_soal as $dt) {    
                  ?>
                  <tr>
                  <td><?= $nom ?></td>
                  <td><?= $dt['nama_ps'] ?></td>
                  <td><?= $dt['kode_soal'] ?></td>
                  <td><?= $dt['nama_matakuliah'] ?></td>
                  <td><?php echo count($this->model_cbt->get_detail_soal($dt['id']));?> Soal</td>
                  <td><?php 
                  $arr_dosen = explode(",", $dt['team_dosen']);
                  for ($i=0; $i < count($arr_dosen); $i++) 
                  { 
                      $all_dosen[] = $this->model_dosen->get_profil_dosen($arr_dosen[$i])->nama_dosen;
                  }
                  $nom=1;
                  foreach ($all_dosen as $key => $value) {
                      echo $nom.". ".$value."<br>";
                      $nom++;
                  }
                  unset($all_dosen); ?></td>
                  <td>
                  <a href="<?php echo base_url();?>cbt/bank_soal_detail/<?php echo encrypt_decrypt('encrypt', $dt['id']);?>"><i class="btn btn-primary fa fa-eye" title="Tampilkan Soal"></i></a>
                  </td>
                  </tr>
                  <?php 
                  $nom++; }
                  } ?>
                  </tbod>
              </table>
            </fieldset>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
    $(document).ready(function()
    {
      window.setTimeout(function() { $(".alert").alert('close'); }, 2000);
      $('.select2').select2();
    });
</script>