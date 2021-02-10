<div class="content-wrapper">
  <section class="content-header">
    <h1>Home Page<small>Akademik</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Kalender Akademik</li>
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
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Kalender Akademik</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-add"><i class="fa fa-plus"></i> Tambah Tahun Akademik</button>
            </div>
            <!-- /. tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table" width="100%">
              <?php foreach ($list_ta as $dt_ta): ?>
                <tr>
                  <td colspan="5">
                    <h4 class="box-title"><strong>Tahun Akademik : <?php echo $dt_ta['ta'];?> Semester : <?php echo ($dt_ta['semester']==1)?"Ganjil":"Genap"; ?> (
                      <?php if($dt_ta['status']==1) { echo "Aktif"; } else { echo "Tidak Aktif"; } ?>
                      ) </strong> <button type="button" class="btn btn-warning tbl_edit_ta" id="<?php echo $dt_ta['id'];?>" title="Edit Tahun Akademik" data-toggle="modal" data-target="#modal-edit-ta"><i class="fa fa-edit"></i>
                    </h4>
                    <button type="button" class="btn btn-danger btn-sm tbl_add_kegiatan" data-toggle="modal" data-target="#modal-add-kegiatan" id="<?php echo $dt_ta['id'];?>"><i class="fa fa-plus"></i> Tambah Kegiatan</button>
                  </td>
                </tr>
                <tr>
                  <td rowspan="2" style="width: 5%; text-align: center;">No.</td>
                  <td rowspan="2" style="width: 35%; text-align: center;">Kegiatan</td>
                  <td colspan="2" style="text-align: center;">Tanggal Pelaksanaan</td>
                  <td rowspan="2" style="width: 10%; text-align: center;">Warna</td>
                  <td rowspan="2" style="width: 10%; text-align: center;">Aksi</td>
                </tr>
                <tr>
                  <td style="width: 20%; text-align: center;">Awal</td>
                  <td style="width: 20%; text-align: center;">Akhir</td>
                </tr>
                <?php
                $nom=1;
                $result_detail = $this->model_ka->get_detail_ka($dt_ta['id']);
                foreach ($result_detail as $detail) { ?>
                <tr>
                  <td style="text-align: center;"><?php echo $nom;?></td>
                  <td><?php echo $detail['kegiatan'];?></td>
                  <td style="text-align: center;"><?php echo date_format(date_create($detail['tgl_awal']), 'd/m/Y'); ?></td>
                  <td style="text-align: center;"><?php echo date_format(date_create($detail['tgl_akhir']), 'd/m/Y'); ?></td>
                  <td><?php echo $detail['warna'];?> <button class="btn" style="background: <?php echo $detail['warna'];?>"></button></td>
                  <td>
                    <button type="button" class="btn btn-primary tbl_edit" id="<?php echo $detail['id'];?>" title="Edit Item" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></button>&nbsp;<button type="button" class="btn btn-danger tbl_hapus" id="<?php echo $detail['id'];?>" title="Hapus Item"><i class="fa fa-remove"></i></button>
                  </td>
                </tr>
                <?php 
                $nom++; 
                } ?>
              <?php endforeach ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- Modal Input -->
<div class="modal modal-primary fade" id="modal-add" data-backdrop="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Input Data Baru</h4>
      </div>
      <form action="<?php echo base_url();?>kalender_akademik/simpan_data_head" method="post" onsubmit="return konfirm()" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tahun Akademik</label>
            <div class="col-sm-3">
              <input type="text" class="form-control mask_ta" name="inp_ta" id="inp_ta" maxlength="9" required>
            </div>
            <label class="col-sm-3 col-form-label">Semester</label>
            <div class="col-sm-3">
              <select class="form-control" id="pil_semester" name="pil_semester">
                <option value="1">Ganjil</option>
                <option value="2">Genap</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-outline">Simpan Data</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Add Kegiatan -->
<div class="modal modal-primary fade" id="modal-add-kegiatan" data-backdrop="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Input Data Baru</h4>
      </div>
      <div id="frm_modal_kegiatan"></div>
    </div>
  </div>
</div>
<!-- Modal Edit Kegiatan -->
<div class="modal modal-warning fade" id="modal-edit" data-backdrop="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Data Kegiatan </h4>
      </div>
      <div id="frm_modal_edit"></div>
    </div>
    <!-- /.modal-content -->
  </div>
</div>
  <!-- /.modal-dialog -->
<!-- Modal Edit Kegiatan -->
<div class="modal modal-warning fade" id="modal-edit-ta" data-backdrop="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Data Tahun Akademik</h4>
      </div>
      <div id="frm_modal_edit_ta"></div>
    </div>
    <!-- /.modal-content -->
  </div>
</div>
  <!-- /.modal-dialog -->
<script type="text/javascript">
  $(document).ready(function()
  {
    window.setTimeout(function() { $(".alert").alert('close'); }, 2000);
    $(".mask_ta").mask("9999/9999");
    $('.input-datepicker, .input-daterange').datepicker({weekStart: 1, format:'dd/mm/yyyy'});
        $('.input-datepicker-close').datepicker({weekStart: 1}).on('changeDate', function(e){ $(this).datepicker('hide'); });
    $(".tbl_add_kegiatan").on("click", function()
    {
      var id_data = this.id;
      $("#frm_modal_kegiatan").load("<?php echo base_url();?>kalender_akademik/add_kegiatan/"+id_data);
    });
    $(".tbl_edit").on("click", function()
    {
      var id_data = this.id;
      $("#frm_modal_edit").load("<?php echo base_url();?>kalender_akademik/edit_kegiatan/"+id_data);
    });
    $(".tbl_hapus").on("click", function()
    {
      var id_data = this.id;
      var psn = confirm("Yakin akan menghapus data ?");
      if(psn==true)
      {
        $.ajax (
        {
            url : "<?php echo site_url();?>kalender_akademik/hapus_detail",
            type : "post",
            data : {id_data:id_data},
            success : function(d)
            {
                alert(d)
                window.location.assign("<?php echo base_url();?>kalender_akademik");
            }
         });
      }
    });
    $(".tbl_edit_ta").on("click", function()
    {
      var id_data = this.id;
      $("#frm_modal_edit_ta").load("<?php echo base_url();?>kalender_akademik/edit_head/"+id_data);
    });
  });
  function konfirm()
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