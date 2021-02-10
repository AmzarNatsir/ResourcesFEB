<div class="content-wrapper">
  <section class="content-header">
    <h1>Opsi | Career Center | <small>Kategori Informasi</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Kategori Informasi</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">DAFTAR KATEGORI</h3>
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
          <div class="box-body">
            
              <table id="tabel_data" class="table table-bordered tabel_data table-striped">
                  <thead>
                      <tr>
                      <th style="width: 5%">No.</th>
                      <th style="width: 80%">Kategori</th>
                      <th style="width: 15%"></th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php $nom=1; foreach ($list_data as $dt) {?>
                      <tr>
                          <td><?php echo $nom;?></td>
                          <td><?php echo $dt['nama_kategori'];?></td>
                          <td>
                              <div class="btn-group">
                                <button type="button" class="btn btn-warning">Aksi</button>
                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="#" data-toggle="modal" class="tbl_edit" data-target="#modal-edit" id="<?php echo $dt['id'];?>">Edit</a></li>
                                  <li><a href="#" class="tbl_hapus" id="<?php echo $dt['id'];?>">Hapus</a></li>
                                </ul>
                              </div>
                          </td>
                      </tr>
                      <?php $nom++; } ?>
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Data</h4>
      </div>
      <form role="form" method="post" action="<?php echo base_url();?>opsi/kategori_informasi_career_simpan" onsubmit="return konfirm()">
      <div class="modal-body">
        <div class="box-body">
          <div class="form-group">
            <label for="nm_kategori">Nama Kategori Informasi</label>
            <input type="text" name="nm_kategori" id="nm_kategori" class="form-control" maxlength="100" required>
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
<!-- /.modal -->
<!-- Modal Edit -->
<div class="modal modal-primary fade" id="modal-edit" data-backdrop="false">
  <div class="modal-dialog">
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
    $('#tabel_data').DataTable();
    window.setTimeout(function () { $("#success-alert").alert('close'); }, 2000);
    $(".tbl_edit").on("click", function()
    {
      var id_data = this.id;
      $("#frm_modal").load("<?php echo base_url();?>opsi/kategori_informasi_career_edit/"+id_data);
    });
    $(".tbl_hapus").on("click", function()
    {
      var id_data = this.id;
      var psn = confirm("Yakin akan menghapus data ?");
      if(psn==true)
      {
        $.ajax (
        {
            url : "<?php echo site_url();?>opsi/kategori_informasi_career_hapus",
            type : "post",
            data : {id_data:id_data},
            success : function(d)
            {
                alert(d)
                window.location.assign("<?php echo base_url();?>opsi/kategori_informasi_career");
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