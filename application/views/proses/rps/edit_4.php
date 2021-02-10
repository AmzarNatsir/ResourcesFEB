<div class="content-wrapper">
  <section class="content-header">
    <h1>Penyusunan <small>Rencana Pembelajaran Semester (RPS)</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>Home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url();?>rps"><i class="fa fa-table"></i> Daftar RPS</a></li>
      <li class="active">Rencana Pembelajaran Semester (RPS)</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Identitas Matakuliah</h3>
          </div>
          <div class="box-body">
            <input type="hidden" name="id_head_rps" id="id_head_rps" value="<?php echo encrypt_decrypt('encrypt', $dt_head->id_rps);?>">
            <div class="row">
                <label class="col-sm-2 col-form-label">Program Studi</label>
                <label class="col-sm-4">: <?php echo $dt_head->nama_ps;?> (<?php echo $dt_head->nm_jenjang;?>)</label>
                <label class="col-sm-2 col-form-label">Mata Kuliah</label>
                <label class="col-sm-4">: <?php echo $dt_head->nama_matakuliah;?></label>
            </div>
            <div class="row">
                <label class="col-sm-2 col-form-label">Rumpun Matakuliah</label>
                <label class="col-sm-4">: <?php echo $dt_head->jenis_matakuliah;?></label>
                <label class="col-sm-2 col-form-label">Kode / SKS/ Semester</label>
                <label class="col-sm-4">: <?php echo $dt_head->kode_matakuliah."/".$dt_head->sks."/".$dt_head->semester;?></label>
            </div>
            <div class="row">
                <label class="col-sm-2 col-form-label">Dosen Pengampuh</label>
                <label class="col-sm-4">: 
                <?php
                $nom=1;
                foreach ($list_dsn as $key => $value) {
                    echo $nom.". ".$value."<br>";
                    $nom++;
                }
                ?>
                </label>
                <label class="col-sm-2 col-form-label">Kurikulum Tahun</label>
                <label class="col-sm-4">: <?php echo $dt_head->tahun;?></label>
            </div>
          </div>
        </div>
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Matrik Rencana Pembelajaran</h3>
          </div>
          <div class="box-body">
            <div class="form-group">
                <div class="col-sm-12 table-responsive">
                    <table class="table" width="100%">
                  <thead>
                  <tr>
                      <th rowspan="2" style="width: 10%"></th>
                      <th style="width: 5%; text-align: center; vertical-align: top">Mg Ke-</th>
                      <th style="width: 15%; text-align: center; vertical-align: top">Sub-CP-MK (sbg kemampuan akhir yg diharapkan</th>
                      <th style="width: 15%; text-align: center; vertical-align: top">Indikator Penilaian</th>
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
                              <td>
                                <div class="btn-group">
                                  <button type="button" class="btn btn-success">Aksi</button>
                                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                  </button>
                                  <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" class="tbl_edit" id="<?php echo $dt_matriks['id_rps_matriks'];?>" data-toggle="modal" data-target="#modal-edit">Edit</a></li>
                                    <li><a href="#" class="tbl_hapus" id="<?php echo $dt_matriks['id_rps_matriks'];?>">Hapus</a></li>
                                  </ul>
                                </div>
                              </td>
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
                            <td>
                              <div class="btn-group">
                                <button type="button" class="btn btn-success">Aksi</button>
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="#" class="tbl_edit" id="<?php echo $dt_matriks['id_rps_matriks'];?>" data-toggle="modal" data-target="#modal-edit">Edit</a></li>
                                  <li><a href="#" class="tbl_hapus" id="<?php echo $dt_matriks['id_rps_matriks'];?>">Hapus</a></li>
                                </ul>
                              </div>
                            </td>
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
            <div class="form-group row">
                <label for="desk_catatan" class="col-sm-12 col-form-label">Catatan</label>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <textarea name="desk_catatan" id="desk_catatan" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #000; padding: 10px;"><?php echo $dt_head->catatan;?></textarea>
                </div>
            </div>
            <div class="form-footer">
                <button type="button" class="btn btn-success tbl_simpan_catatan"><i class="fa fa-check-square-o"></i> Simpan Catatan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- Modal Area -->
<div class="modal modal-primary fade" id="modal-edit" data-backdrop="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Data</h4>
      </div>
      <div class="modal-body">
        <div class="box-body">
            <div id="frm_modal"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-outline tbl_simpan">Simpan Data</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
    $(document).ready(function()
    {
      CKEDITOR.replace('desk_catatan');
      $(".tbl_edit").on("click", function()
      {
        var id_data = this.id;
        $("#frm_modal").load("<?php echo base_url();?>rps/edit_matriks_pembelajaran_baris/"+id_data);
      });
      $(".tbl_hapus").on("click", function()
      {
        var id_rps = $("#id_head_rps").val();
        var id_data = this.id;
        var psn = confirm("Yakin akan menghapus data ?");
        if(psn==true)
        {
          $.ajax (
          {
              url : "<?php echo site_url();?>rps/hapus_matriks_pembelajaran_baris",
              type : "post",
              data : {id_data:id_data, id_rps: id_rps},
              success : function(d)
              {
                  alert(d)
                  window.location.assign("<?php echo base_url();?>rps/edit_matriks_pembelajaran/"+id_rps);
              }
           });
        }
      });
      $(".tbl_simpan_catatan").on("click", function()
      {
        var id_rps = $("#id_head_rps").val();
        var inp_catatan = CKEDITOR.instances['desk_catatan'].getData();
        if(inp_catatan.length==0)
        {
          alert("Kolom inputan deskripsi catatan tidak boleh kosong");
          return false;
        } else {
          var pesan = confirm("Yakin akan menyimpan data ?");
            if(pesan==true)
            {
                $.ajax (
                {
                    url : "<?php echo site_url();?>rps/simpan_matriks_pembelajaran_catatan",
                    type : "post",
                    data : {id_rps:id_rps, inp_catatan:inp_catatan},
                    success : function(d)
                    {
                      alert(d);
                      window.location.assign("<?php echo base_url();?>rps/add_matriks_pembelajaran/"+id_rps);
                    }
                 });
                
            } else {
                return false;
            }
        }
      });
    });
</script>