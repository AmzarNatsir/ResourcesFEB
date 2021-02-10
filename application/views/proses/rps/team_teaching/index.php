<div class="content-wrapper">
  <section class="content-header">
    <h1>Penyusunan <small>Team Teaching Rencana Pembelajaran Semester (RPS)</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Team Teaching RPS</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">DAFTAR TEAM TEACHING</h3>
            <hr>
            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-tambah" title="Tambah data baru"><i class="fa fa-plus"></i> Tambah Data</button>
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
                  <th style="width: 10%">No.</th>
                  <th>Team Teaching</th>
                  <th>Mata Kuliah</th>
                  <th>Status RPS</th>
                  <th></th>
              </thead>
              <tbody>
                <?php $nom_urut=1; foreach ($list_rps as $dt): ?>
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
                  <td><?php echo $nom_urut;?></td>
                  <td>
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
                  <td>
                    <strong>Program Studi : </strong><?php echo $dt['nama_ps'];?><br>
                    <strong>Kode MK : </strong><?php echo $dt['kode_matakuliah'];?><br>
                    <strong>Nama MK : </strong><?php echo $dt['nama_matakuliah'];?><br>
                    <strong>Rumpun MK : </strong><?php echo $dt['jenis_matakuliah'];?><br>
                    <strong>SKS : </strong><?php echo $dt['sks'];?><strong> Semester : </strong><?php echo $dt['semester'];?><br>
                    <strong>Kurikulum Tahun : </strong><?php echo $dt['tahun'];?><br>
                    <strong>Tgl. Penyusunan : </strong><?php echo date_format(date_create($dt['tgl_post']), "d/m/Y");?>
                  </td>
                  <td>
                    <?php if ($dt['status_rps']==1): ?>
                      <label class="label label-danger">Belum Terpublikasi</label>
                    <?php else: ?>
                      <label class="label label-success"><i class="fa fa-check"></i> Terpublikasi</label>
                    <?php endif ?>
                  </td>
                  <td>
                    <?php if ($dt['status_rps']==1): ?>
                     <div class="btn-group">
                        <button type="button" class="btn btn-success">Aksi</button>
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#" data-toggle="modal" class="tbl_edit_team" data-target="#modal-edit" id="<?php echo encrypt_decrypt('encrypt', $dt['id_rps']);?>"><i class="fa fa-edit"></i>Edit Team</a></li>
                        </ul>
                      </div>
                      <?php endif ?>
                  </td>
                </tr>
                <?php $nom_urut++; endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- Modal Area -->
<div class="modal modal-primary fade" id="modal-tambah" data-backdrop="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Penyusunan Team Teaching</h4>
      </div>
      <form role="form" method="post" action="<?php echo base_url();?>rps/team_teaching_simpan" onsubmit="return konfirmasi()">
      <div class="modal-body">
        <div class="box-body">
          <div class="form-group row">
              <label for="pil_tahun" class="col-sm-2 col-form-label">Kurikulum Tahun</label>
              <div class="col-sm-2">
                  <select class="select2" name="pil_tahun" id="pil_tahun" style="width: 100%">
                      <?php
                      $thn_awal = 2010;
                      $thn_skr = date("Y");
                      for($i=$thn_awal; $i<=$thn_skr; $i++)
                      {
                          if($i==$thn_skr)
                          {
                              echo "<option value=".$i." selected>".$i."</option>";
                          } else {
                              echo "<option value=".$i.">".$i."</option>";
                          }
                      }
                      ?>
                  </select>
              </div>
              <label for="pil_ps" class="col-sm-2 col-form-label">Program Studi</label>
              <div class="col-sm-6">
                  <select class="select2" name="pil_ps" id="pil_ps" style="width: 100%">
                      <option value="0">- Pilihan Program Studi -</option>
                      <?php foreach ($list_ps as $dt_ps) { ?>
                          <option value="<?php echo $dt_ps['id_ps'];?>"><?php echo $dt_ps['nama_ps'];?> (<?php echo $dt_ps['nm_jenjang'];?>)</option>
                      <?php } ?>
                  </select>
              </div>
          </div>
          <div class="form-group row">
              <label for="pil_matkul" class="col-sm-2 col-form-label">Mata Kuliah</label>
              <div class="col-sm-10">
                  <select class="select2" name="pil_matkul" id="pil_matkul" style="width: 100%"></select>
              </div>
          </div>
          <div class="form-group row">
              <label for="pil_matkul" class="col-sm-2 col-form-label">Ketua Team</label>
              <div class="col-sm-10">
                  <select class="form-control select2" name="pil_ketua_team" id="pil_ketua_team" data-placeholder="Pilih ketua team" style="width: 100%;">
                      <option value="0">- Pilihan -</option>
                      <?php foreach ($list_dosen as $dt_dsn) { ?>
                          <option value="<?php echo $dt_dsn['id_dosen'];?>"><?php echo $dt_dsn['nidn'];?> | <?php echo $dt_dsn['nama_dosen'];?></option>
                      <?php } ?>
                  </select>
              </div>
          </div>
          <div class="form-group">
            <label for="pil_anggota_team">Anggota</label>
            <select class="form-control select2" name="pil_anggota_team[]" id="pil_anggota_team" multiple="multiple" data-placeholder="Pilih anggota team" style="width: 100%;">
                <option value="0">- Pilihan -</option>
                <?php foreach ($list_dosen as $dt_dsn) { ?>
                    <option value="<?php echo $dt_dsn['id_dosen'];?>"><?php echo $dt_dsn['nidn'];?> | <?php echo $dt_dsn['nama_dosen'];?></option>
                <?php } ?>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-outline" id="tbl_simpan">Simpan Data</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal Edit -->
<div class="modal modal-primary fade" id="modal-edit" data-backdrop="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Data</h4>
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
    $("#pil_ps").on("change", function()
    {
        var pil_prodi = $("#pil_ps").val();
        $("#pil_matkul").load("<?php echo base_url();?>rps/list_mk/"+pil_prodi);
    });
    $("#pil_matkul").on("change", function()
    {
        var pil_tahun = $("#pil_tahun").val();
        var pil_prodi = $("#pil_ps").val();
        var pil_mk = $("#pil_matkul").val();
        //hapus_teks();
        $.ajax (
        {
            url : "<?php echo site_url();?>rps/team_teaching_cek_matkul_proses",
            type : "post",
            data : {pil_tahun:pil_tahun, pil_prodi:pil_prodi, pil_mk:pil_mk},
            success : function(d)
            {
                if(d==1)
                {
                  aktif_teks(true);
                } else {
                  aktif_teks(false);
                }
            }
         });
    });
    $(".tbl_edit_team").on("click", function()
    {
      var id_data = this.id;
      $("#frm_modal").load("<?php echo base_url();?>rps/team_teaching_edit/"+id_data);
    });
    function aktif_teks(tf)
    {
      $("#pil_ketua_team").attr("disabled", tf);
      $("#pil_anggota_team").attr("disabled", tf);
      $("#tbl_simpan").attr("disabled", tf);
    }
  });
  function konfirmasi()
  {
    var psn = confirm("Yakin akan menyimpan data ?");
    if(psn==true)
    {
      return true;
    } else {
      return false;
    }
  }
</script>