<div class="content-wrapper">
  <section class="content-header">
    <h1>Home Page<small>FAQ</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Daftar FAQ</li>
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
            <h3 class="box-title">Daftar FAQ</h3>
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
                <th style="width: 10%">Kategori</th>
                <th style="width: 75%">FAQ</th>
                <th style="width: 10%"></th>
              </thead>
              <tbody>
                <?php $nom=1; foreach ($list_data as $dt): ?>
                  <tr>
                    <td><?php echo $nom;?></td>
                    <td><?php echo $dt['nm_kat_faq'];?></td>
                    <td>
                      <strong class="label label-default">Pertanyaan :</strong><br>
                      <?php echo $dt['pertanyaan'];?><br>
                      <strong class="label label-success">Jawaban :</strong><br>
                      <?php echo $dt['jawaban'];?>
                    </td>
                    <td>
                      &nbsp;<button type="button" class="btn btn-primary tbl_edit" id="<?php echo $dt['id_faq'];?>" title="Edit Berita" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></button>&nbsp;<button type="button" class="btn btn-danger tbl_hapus" id="<?php echo $dt['id_faq'];?>" title="Hapus Berita"><i class="fa fa-remove"></i></button>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Input Data Baru</h4>
      </div>
      <form action="<?php echo base_url();?>faq/simpan_data" method="post" onsubmit="return konfirm()" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="inp_tampilan">Kategori FAQ</label>
            <select class="form-control" id="pil_kategori" name="pil_kategori">
              <?php 
              foreach ($list_kategori as $dt_k) {
                echo "<option value=".$dt_k['id_kat_faq'].">".$dt_k['nm_kat_faq']."</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="inp_pertanyaan">Pertanyaan</label>
            <textarea name="inp_pertanyaan" id="inp_pertanyaan" class="form-control" required></textarea>
          </div>
          <div class="form-group">
            <label for="inp_jawaban">Jawaban</label>
            <textarea name="inp_jawaban" id="inp_jawaban" class="form-control" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-outline">Simpan Data</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Edit -->
<div class="modal modal-warning fade" id="modal-edit" data-backdrop="false">
  <div class="modal-dialog modal-lg">
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
    window.setTimeout(function() { $(".alert").alert('close'); }, 2000);
    $(".tbl_edit").on("click", function()
    {
      var id_data = this.id;
      $("#frm_modal").load("<?php echo base_url();?>faq/edit_data/"+id_data);
    });
    $(".tbl_hapus").on("click", function()
    {
      var id_data = this.id;
      var psn = confirm("Yakin akan menghapus data ?");
      if(psn==true)
      {
        $.ajax (
        {
            url : "<?php echo site_url();?>faq/hapus_data",
            type : "post",
            data : {id_data:id_data},
            success : function(d)
            {
                alert(d)
                window.location.assign("<?php echo base_url();?>faq");
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
</script>