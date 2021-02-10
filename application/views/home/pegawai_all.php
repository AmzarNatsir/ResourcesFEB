<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Dashboard</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dasboard User</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">DAFTAR AKUN PEGAWAI (AKTIF)</h3>
            <hr>
            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <button type="button" class="btn btn-info add_form" data-toggle="modal" data-target="#modal-tambah" title="Tambah data baru"><i class="fa fa-plus"></i> Tambah Akun Baru</button>
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
                  <th>NO.Induk</th>
                  <th>Nama Pegawai</th>
                  <th>Email</th>
                  <th>Tanggal Aktif</th>
                  <th></th>
              </thead>
              <tbody>
                <?php $nom=1; foreach ($pegawai_all_aktif as $list_aktif): ?>
                  <tr>
                    <td><?= $nom; ?></td>
                    <td><?= $list_aktif['no_induk']; ?></td>
                    <td><?= $list_aktif['nama_pegawai']; ?></td>
                    <td><?= $list_aktif['email']; ?></td>
                    <td><button type="button" class="btn btn-warning edit_form" data-toggle="modal" data-target="#modal-edit" title="Edit Password Pegawai" id="<?= $list_aktif['id'];?>"><i class="fa fa-key"></i> Rubah Password</button></td>
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
<div class="modal modal-primary fade" id="modal-tambah" data-backdrop="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Data</h4>
      </div>
      <div id="frm_modal"></div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- FModal Reset-->
<div class="modal modal-warning fade" id="modal-edit" data-backdrop="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Rubah Password</h4>
      </div>
      <div id="frm_modal_edit"></div>
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
    $(".add_form").on("click", function()
    {
      $("#frm_modal").load("<?php echo base_url();?>home/add_akun_pegawai");
    });
    $(".tabel_list").on("click", ".edit_form", function()
    {
      var id_data = this.id;
      $("#frm_modal_edit").load("<?php echo base_url();?>home/edit_akun_pegawai/"+id_data);
    });
  });
</script>
