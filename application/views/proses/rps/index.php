<div class="content-wrapper">
  <section class="content-header">
    <h1>Penyusunan <small>Rencana Pembelajaran Semester (RPS)</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>Home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Rencana Pembelajaran Semester (RPS)</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">DAFTAR RENCANA PEMBELAJARAN SEMESTER</h3>
            <hr>
            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <button type="button" class="btn btn-info tbl_add" title="Tambah data baru"><i class="fa fa-plus"></i> Buat baru</button>
              </div>
            </div>
          </div>
          <?php if ($this->session->flashdata('konfirm')): ?>
            <div class="alert alert-info alert-dismissible" id="success-alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info"></i> Konfirmasi !</h4>
              <?php echo $this->session->flashdata('konfirm'); ?>
            </div>
          <?php endif; ?> 
          <div class="box-body table-responsive">
            <table class="table tabel_list" width="100%">
                  <thead>
                      <th>No.</th>
                      <th colspan="2">Mata Kuliah</th>
                      <th>Status RPS</th>
                      <th></th>
                  </thead>
                  <tbody>
                      <?php $nom=1; foreach ($list_rps as $dt): ?>
                      <?php 
                      if(!empty($dt['ketua_team']))
                      {
                        $ketua_team = "1. ".$this->model_rps->get_profil_dosen($dt['ketua_team'])->nama_dosen." (Ketua Team)";
                      } else {
                        $ketua_team="1. Ketua team belum ditentukan.";
                      }
                      $arr_dosen = explode(",", $dt['id_dosen']);
                      for ($i=0; $i < count($arr_dosen); $i++) 
                      { 
                        $all_dosen[] = $this->model_rps->get_profil_dosen($arr_dosen[$i])->nama_dosen;
                      } ?>
                      <tr>
                          <td style="width: 5%"><?php echo $nom;?></td>
                          <td style="width: 30%">
                            <strong>Program Studi : </strong><?php echo $dt['nama_ps'];?><br>
                            <strong>Kode MK : </strong><?php echo $dt['kode_matakuliah'];?><br>
                            <strong>Nama MK : </strong><?php echo $dt['nama_matakuliah'];?><br>
                            <strong>Team Teaching : </strong><br>
                            <strong><?php echo $ketua_team;?></strong><br>
                            <?php 
                            $nom=2;
                            foreach ($all_dosen as $key => $value) {
                                echo $nom.". ".$value." (Anggota)<br>";
                                $nom++;
                            }
                            unset($all_dosen);
                            ?>
                          </td>
                          <td style="width: 30%">
                            <strong>Rumpun MK : </strong><?php echo $dt['jenis_matakuliah'];?><br>
                            <strong>SKS : </strong><?php echo $dt['sks'];?><br>
                            <strong> Semester : </strong><?php echo $dt['semester'];?><br>
                            <strong>Kurikulum Tahun : </strong><?php echo $dt['tahun'];?><br>
                            <strong>Tgl. Penyusunan : </strong><?php echo date_format(date_create($dt['tgl_post']), "d/m/Y");?>
                          </td>
                          <td style="width: 15%">
                            <?php if ($dt['status_rps']==1): ?>
                              <label class="label label-danger">Belum Terpublikasi</label>
                            <?php else: ?>
                              <label class="label label-success"><i class="fa fa-check"></i> Terpublikasi</label>
                            <?php endif ?>
                          </td>
                          <td  style="width: 20%">
                            <div class="btn-group">
                              <button type="button" class="btn btn-success">Aksi</button>
                              <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <?php if ($dt['status_rps']==1): ?>
                                  <li><a href="<?php echo base_url();?>rps/add_capaian_pembelajaran_mk/<?php echo encrypt_decrypt('encrypt', $dt['id_rps']);?>"><i class="fa fa-plus"></i> Tambah CP Matakuliah</a></li>
                                  <li><a href="<?php echo base_url();?>rps/add_matriks_pembelajaran/<?php echo encrypt_decrypt('encrypt', $dt['id_rps']);?>"><i class="fa fa-plus"></i> Tambah Matriks Pembelajaran</a></li>
                                  <li class="divider"></li>
                                <?php endif ?>
                                <li><a href="<?php echo base_url();?>rps/detail/<?php echo encrypt_decrypt('encrypt', $dt['id_rps']);?>"><i class="fa fa-eye"></i> Detail RPS</a></li>
                                <li><a href="<?php echo base_url();?>rps/cetak/<?php echo encrypt_decrypt('encrypt', $dt['id_rps']);?>" class="tbl_print" target="_new"><i class="fa fa-print"></i> Cetak RPS</a></li>
                                <?php if ($dt['status_rps']==1): ?>
                                  <li><a href="<?php echo site_url();?>rps/hapus_rps/<?php echo encrypt_decrypt('encrypt', $dt['id_rps']);?>" onclick="return konfHapus()"><i class="fa fa-remove"></i> Hapus RPS</a></li>
                                <?php endif ?>
                                <li class="divider"></li>
                                <?php if ($dt['status_rps']==1): ?>
                                  <li><a href="<?php echo base_url();?>rps/edit_identitas_matakuliah/<?php echo encrypt_decrypt('encrypt', $dt['id_rps']);?>"><i class="fa fa-edit"></i> Edit Identitas Matakuliah</a></li>
                                  <li><a href="<?php echo base_url();?>rps/edit_capaian_pembelajaran/<?php echo encrypt_decrypt('encrypt', $dt['id_rps']);?>"><i class="fa fa-edit"></i>Edit Capaian Pembelajaran</a></li>
                                  <li><a href="<?php echo base_url();?>rps/edit_matriks_pembelajaran/<?php echo encrypt_decrypt('encrypt', $dt['id_rps']);?>"><i class="fa fa-edit"></i>Edit Matriks Pembelajaran</a></li>
                                <?php endif ?>
                                <li><a href="#" data-toggle="modal" class="tbl_edit_status" data-target="#modal-edit" id="<?php echo encrypt_decrypt('encrypt', $dt['id_rps']);?>"><i class="fa fa-edit"></i>Edit Status Publikasi</a></li>
                              </ul>
                            </div>
                          </td>
                      </tr>
                      <?php $nom++; endforeach ?>
                  </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- Modal Edit -->
<div class="modal modal-primary fade" id="modal-edit" data-backdrop="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Status Publikasi RPS</h4>
      </div>
      <div id="frm_modal"></div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
  $(document).ready(function()
  {
    window.setTimeout(function () { $("#success-alert").alert('close'); }, 2000);
    $(".tbl_add").on("click", function()
    {
      window.location.assign("<?php echo base_url();?>rps/add_identitas");
    });
    $(".tbl_edit_status").on("click", function()
    {
      var id_data = this.id;
      $("#frm_modal").load("<?php echo base_url();?>rps/edit_status_rps/"+id_data);
    });
  });
  function konfHapus()
  {
    var pesan = confirm("Yakin akan menghapus data rps ?");
    if(pesan==true)
    {
      return true;
    } else {
      return false;
    }
  }
</script>