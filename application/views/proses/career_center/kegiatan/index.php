<div class="content-wrapper">
  <section class="content-header">
    <h1>Career Center<small> Informasi Kegiatan</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Informasi Kegiatan</li>
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
            <h3 class="box-title">Daftar Informasi Kegiatan</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" id="tbl_add"><i class="fa fa-plus"></i> Tambah Data</button>
            </div>
            <!-- /. tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table" width="100%">
              <thead>
                <th style="width: 5%">No.</th>
                <th style="width: 15%;"></th>
                <th style="width: 10%">Posting/User</th>
                <th style="width: 30%">Judul Kegiatan</th>
                <th style="width: 30%">Deskripsi</th>
                <th style="width: 10%;"></th>
              </thead>
              <tbody>
                <?php 
                $nom=1;
                foreach($all_kegiatan as $dt1) {?>
                <tr>
                <td><?php echo $nom;?></td>
                <td style="text-align: center;">
                  <?php if($dt1['ada_file']==1){?>
                    <img src="../../<?php echo file_kegiatan.$dt1['file_gambar'];?>" alt="Gambar" style="width: 50%;">
                  <?php } else {?>
                  Tidak Ada File
                  <?php } ?>
                </td>
                <td><?php echo date_format(date_create($dt1['tgl_posting']), "d/m/y");?><br><?php echo (empty($dt1['id_user'])) ? "Admin" : "Alumni" ?></td>
                <td><strong><?php echo $dt1['judul_kegiatan'];?></strong>
                <p class="push-bit">Pelaksana : <b><?php echo $dt1['pelaksana'];?></b><br>
                Tanggal Pelaksanaan : <b><?php echo date_format(date_create($dt1['tgl_awal']), "d-m-Y");?> s/d <?php echo date_format(date_create($dt1['tgl_akhir']), "d-m-Y");?></b><br>
                Tempat : <b><?php echo $dt1['tempat'];?></b><br>
                Sumber : <b><?php echo $dt1['sumber_link'];?></b>
                </p>
                <p class="push-bit">Kategori : <?php echo $dt1['nama_kategori'];?> | <?php echo $dt1['pengunjung'];?></p>
                </td>
                <td><?php echo $dt1['deskripsi'];?></td>
                <td>
                <button type="button" class="btn btn-primary tbl_edit" id="<?php echo encrypt_decrypt('encrypt', $dt1['id']);?>" data-toggle="tooltip" title="Edit Data" onclick="goEdit(this)"><i class="fa fa-edit"></i></button>
                <?php if(empty($dt1['id_user'])){ ?>
                <a href="<?= base_url() ?>career/hapus_info_kegiatan/<?php echo encrypt_decrypt('encrypt', $dt1['id']) ?>" class="btn btn-danger" onclick="return konfirmHapus()" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-remove"></i></a>
                <?php } ?>
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
<script type="text/javascript">
  $(document).ready(function()
  {
    window.setTimeout(function() { $(".alert").alert('close'); }, 2000);
    $('.select2').select2();
    //CKEDITOR.replace('inp_isi');
    $("#tbl_add").on("click", function()
    {
      window.location.assign("<?php echo base_url();?>career/tambah_info_kegiatan");
    });
  });
  var goEdit = function(el) {
    window.location.assign("<?php echo base_url();?>career/edit_info_kegiatan/"+el.id);
  }
  function konfirmHapus()
  {
    var psn = confirm("Yakin akan menghapus data ?");
    if(psn==true)
    {
      return true;
    } else {
      return false;
    }

  }
</script>