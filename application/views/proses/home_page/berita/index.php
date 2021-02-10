<div class="content-wrapper">
  <section class="content-header">
    <h1>Home Page<small>Berita</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Daftar Berita</li>
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
            <h3 class="box-title">Daftar Berita</h3>
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
                <th style="width: 15%">File</th>
                <th style="width: 80%">Judul/Deskripsi</th>
              </thead>
              <tbody>
                <?php $nom=1; foreach ($list_data as $dt): ?>
                  <tr>
                    <td><?php echo $nom;?></td>
                    <td>
                      <a href="assets/upload/berita/<?php echo $dt['file_img'];?>" data-fancybox data-caption="File Gambar"><img src="assets/upload/berita/<?php echo $dt['file_img'];?>" width="100px"></a>
                    </td>
                    <td><b>Judul</b> : <?php echo $dt['judul'];?><br>
                      <b>Deskripsi</b> : <?php echo substr($dt['deskripsi'], 0, 200);?> ...<br>
                      <b>Posting</b> : <?php echo $dt['post_data'];?><br>
                      <b>Status</b> : <?php if ($dt['status']==1): ?>
                        Headline
                      <?php else: ?>
                        Lates
                      <?php endif ?><br>
                      &nbsp;<button type="button" class="btn btn-primary tbl_edit" id="<?php echo $dt['id'];?>" title="Edit Berita" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></button>&nbsp;<button type="button" class="btn btn-danger tbl_hapus" id="<?php echo $dt['id'];?>" title="Hapus Berita"><i class="fa fa-remove"></i></button>
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
      <form action="<?php echo base_url();?>berita/simpan_data" method="post" onsubmit="return konfirm()" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="inp_tampilan">Kategori Berita</label>
            <select class="form-control" id="pil_kategori" name="pil_kategori">
              <?php 
              foreach ($list_kategori as $dt_k) {
                echo "<option value=".$dt_k['id'].">".$dt_k['nm_kategori']."</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="inp_kategori">Judul</label>
            <input type="text" name="inp_judul" id="inp_judul" class="form-control" maxlength="100" required>
          </div>
          <div class="form-group">
            <label for="inp_kategori">Deskripsi</label>
            <textarea name="inp_deskripsi" id="inp_deskripsi" class="form-control" required></textarea>
          </div>
          <div class="form-group">
            <label for="inp_url">Url</label>
            <input type="text" name="inp_url" id="inp_url" maxlength="200" class="form-control">
          </div>
          <div class="form-group">
            <label for="inp_isi">Isi Berita</label>
            <textarea name="inp_isi" id="inp_isi" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #000; padding: 10px;"></textarea>
          </div>
          <div class="form-group">
            <label for="inp_tampilan">Tampilan Berita</label>
            <select class="form-control" id="pil_tampilan" name="pil_tampilan">
              <?php 
              $arr_pil = array("1"=>"Headline", "2"=>"Lates");
              foreach ($arr_pil as $key => $value) {
                echo "<option value=".$key.">".$value."</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="inp_kategori">Upload File (* dimention recomended (745px X 450px))</label>
            <input type="file" name="inp_file" id="inp_file" class="form-control" required onchange="readURL(this);">
          </div>
          <div class="form-group" align="center">
            <img src="assets/dist/img/icon_images.png" class="picture-src" id="img_preview" title="" height="200px">
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
    CKEDITOR.replace('inp_isi');
    $(".tbl_edit").on("click", function()
    {
      var id_data = this.id;
      $("#frm_modal").load("<?php echo base_url();?>berita/edit_data/"+id_data);
    });
    $(".tbl_hapus").on("click", function()
    {
      var id_data = this.id;
      var psn = confirm("Yakin akan menghapus data ?");
      if(psn==true)
      {
        $.ajax (
        {
            url : "<?php echo site_url();?>berita/hapus_data",
            type : "post",
            data : {id_data:id_data},
            success : function(d)
            {
                alert(d)
                window.location.assign("<?php echo base_url();?>berita");
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