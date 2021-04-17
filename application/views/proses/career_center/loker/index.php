<div class="content-wrapper">
  <section class="content-header">
    <h1>Career Center<small>Lowongan Kerja</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Lowongan Kerja</li>
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
            <h3 class="box-title">Daftar Informasi Lowongan Kerja</h3>
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
                <th style="width: 20%;"></th>
                <th style="width: 10%">Posting/User</th>
                <th style="width: 55%">Deskripsi</th>
                <th style="width: 10%;"></th>
              </thead>
              <tbody>
                <?php 
                $nom=1;
                foreach($all_loker as $dt1) {?>
                <tr>
                <td><?php echo $nom;?></td>
                <td style="text-align: center;">
                  <?php if($dt1['ada_file']==1){?>
                    <img src="../../<?php echo file_loker.$dt1['file_lampiran'];?>" alt="Gambar" style="width: 50%;">
                  <?php } else {?>
                  Tidak Ada File
                  <?php } ?>
                </td>
                <td><?php echo date_format(date_create($dt1['tgl_posting']), "d/m/y");?><br><?php echo (empty($dt1['id_user'])) ? "Admin" : "Alumni" ?></td>
                <td>
                <strong><?php echo $dt1['nama_perusahaan'];?></strong>
                <p class="push-bit"><?php echo strtoupper($dt1['alamat'].", ".$dt1['nama_kabupaten'].", ".$dt1['nama_provinsi']);?></p>
                <p class="push-bit"><strong>Waktu Proses Lamaran : <?php echo date_format(date_create($dt1['tgl_mulai']), "d-m-Y");?> s/d <?php echo date_format(date_create($dt1['tgl_akhir']), "d-m-Y");?></strong></p>
                <p class="push-bit">Kategori : <?php echo $dt1['nama_kategori'];?> | <?php echo $dt1['pengunjung'];?></p>
                </td>
                <td>
                <button type="button" class="btn btn-primary tbl_edit" id="<?php echo encrypt_decrypt('encrypt', $dt1['id']);?>" data-toggle="tooltip" title="Edit Data" onclick="goEdit(this)"><i class="fa fa-edit"></i></button>
                <?php if(empty($dt1['id_user'])){ ?>
                <a href="<?= base_url() ?>career/hapus_lowongan_kerja/<?php echo encrypt_decrypt('encrypt', $dt1['id']) ?>" class="btn btn-danger" onclick="return konfirmHapus()" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-remove"></i></a>
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
      window.location.assign("<?php echo base_url();?>career/tambah_lowongan_kerja");
    });
  });
  var goEdit = function(el) {
    window.location.assign("<?php echo base_url();?>career/edit_lowongan_kerja/"+el.id);
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