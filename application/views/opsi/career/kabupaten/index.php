<div class="content-wrapper">
  <section class="content-header">
    <h1>Opsi | Career Center | <small>Kabupaten/Kota</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Kabupaten/Kota</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">DAFTAR KABUPATEN/KOTA</h3>
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
                      <th style="width: 10%">Provinsi</th>
                      <th style="width: 65%">Kabupaten</th>
                      <th style="width: 20%"></th>
                      </tr>
                  </thead>
                  <tbody>
                        <?php $nom=1; 
                        foreach ($list_provinsi as $dt) {
                            $all_kab = $this->model_career->get_all_kabupaten($dt['id']);
                            ?>
                            <tr>
                                <td><?php echo $nom;?>- <?php echo $dt['id'];?></td>
                                <td colspan="2"><?php echo $dt['nama_provinsi'];?></td>
                                <td>
                                    <button type="button" class="btn btn-primary tbl_add" data-toggle="modal" data-target="#modal-tambah" id="<?php echo $dt['id'];?>"><i class="fa fa-plus"></i> Tambah Kabupaten</button>
                                </td>
                            </tr>
                            <?php
                            if(!empty($all_kab))
                            { 
                                foreach($all_kab as $kab) 
                                { ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo $kab['nama_kabupaten'];?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-warning">Aksi</button>
                                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" data-toggle="modal" class="tbl_edit" data-target="#modal-edit" id="<?php echo $kab['id'];?>">Edit</a></li>
                                            <li><a href="#" class="tbl_hapus" id="<?php echo $kab['id'];?>">Hapus</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php 
                                } 
                            } ?>
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
      <div id="frm_modal_add"></div>
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
    //$('#tabel_data').DataTable();
    window.setTimeout(function () { $("#success-alert").alert('close'); }, 2000);
    $(".tabel_data").on("click", ".tbl_add", function()
    {
      var id_data = this.id;
      $("#frm_modal_add").load("<?php echo base_url();?>opsi/kabupaten_add/"+id_data);
    });
    $(".tabel_data").on("click", ".tbl_edit", function()
    {
      var id_data = this.id;
      $('.select2').select2();
      $("#frm_modal").load("<?php echo base_url();?>opsi/kabupaten_edit/"+id_data);
    });
    $(".tabel_data").on("click", ".tbl_hapus", function()
    {
      var id_data = this.id;
      var psn = confirm("Yakin akan menghapus data ?");
      if(psn==true)
      {
        $.ajax (
        {
            url : "<?php echo site_url();?>opsi/kabupaten_hapus",
            type : "post",
            data : {id_data:id_data},
            success : function(d)
            {
                alert(d)
                window.location.assign("<?php echo base_url();?>opsi/kabupaten");
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