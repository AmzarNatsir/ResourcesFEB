<div class="content-wrapper">
  <section class="content-header">
    <h1>Home Page<small>Mitra</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Daftar Mitra</li>
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
            <h3 class="box-title">Daftar Mitra</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-add"><i class="fa fa-plus"></i> Tambah Data</button>
            </div>
            <!-- /. tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table" width="100%">
              <thead>
                <th style="width: 5%">No.</th>
                <th style="width: 95%">Mitra/Keterangan</th>
              </thead>
              <tbody>
                <?php $nom=1; foreach ($list_data as $dt): ?>
                  <tr>
                    <td><?php echo $nom;?></td>
                    <td><b>Keterangan</b> : <?php echo $dt['keterangan'];?><br>
                      <a href="assets/upload/mitra/<?php echo $dt['img_file'];?>" data-fancybox data-caption="File Slide"><button class='btn btn-success' title="Preview"><i class='fa fa-check'></i> File Ada (<?php echo $dt['img_file'];?>)</button></a>&nbsp;<button type="button" class="btn btn-primary tbl_edit" id="<?php echo $dt['id'];?>" title="Edit Slide" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></button>&nbsp;<button type="button" class="btn btn-danger tbl_hapus" id="<?php echo $dt['id'];?>" title="Hapus Slide"><i class="fa fa-remove"></i></button>
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
<!-- Modal Input -->
<div class="modal modal-primary fade" id="modal-add" data-backdrop="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Input Data Baru</h4>
      </div>
      <form action="<?php echo base_url();?>mitra/simpan_data" method="post" onsubmit="return konfirm()" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="inp_kategori">Keterangan</label>
            <input type="text" name="inp_keterangan" id="inp_keterangan" class="form-control" maxlength="100">
          </div>
          <div class="form-group">
            <label for="inp_kategori">Upload File (dimensions recommended (px) : 200 X 200)</label>
            <input type="file" name="inp_file" id="inp_file" class="form-control" required onchange="readURL(this);">
          </div>
          <div class="form-group" align="center">
            <img src="assets/dist/img/icon_images.png" class="picture-src img-responsive" id="img_preview" title="" height="200px">
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
<!-- Modal Edit -->
<div class="modal modal-warning fade" id="modal-edit" data-backdrop="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Data </h4>
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
    window.setTimeout(function()
    {
      $(".alert").alert('close'); }, 2000);
    $(".tbl_edit").on("click", function()
    {
      var id_data = this.id;
      $("#frm_modal").load("<?php echo base_url();?>mitra/edit_data/"+id_data);
    });
    $(".tbl_hapus").on("click", function()
    {
      var id_data = this.id;
      var psn = confirm("Yakin akan menghapus data ?");
      if(psn==true)
      {
        $.ajax (
        {
            url : "<?php echo site_url();?>mitra/hapus_data",
            type : "post",
            data : {id_data:id_data},
            success : function(d)
            {
                alert(d)
                window.location.assign("<?php echo base_url();?>mitra");
            }
         });
      }
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
  function readURL(input) 
  {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#img_preview')
                  .attr('src', e.target.result);
          };

          reader.readAsDataURL(input.files[0]);
      }
  }
</script>