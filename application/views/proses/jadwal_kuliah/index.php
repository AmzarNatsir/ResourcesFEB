<div class="content-wrapper">
  <section class="content-header">
    <h1>Akademik <small>Jadwal Perkuliahan</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Jadwal Perkuliahan</li>
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
            <h3 class="box-title">Jadwal Kuliah Kelas Reguler Pagi Semester Genap T.A 2020/2021</h3>
            <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" onclick="goTambahData()"><i class="fa fa-plus"></i> Tambah Data</button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table" width="100%">
              <tr>
                <th>No.</th>
                <th>Jam</th>
                <th>Hari</th>
                <th>Prodi/Jurusan</th>
                <th>Matakuliah</th>
                <th>Pengampu</th>
                <th>Ruang</th>
              </tr>
              <?php $nom=1; foreach ($list_jadwal as $dt): ?>
              <tr>
                <td><?php echo $nom;?></td>
                <td><?php echo $dt['jam_mulai'];?>-<?php echo $dt['jam_akhir'];?></td>
                <td><?php echo $dt['hari'];?></td>
                <td><?php echo $dt['nama_ps'];?> | <?php echo $dt['nama_kelas'];?></td>
                <td><?php echo $dt['kode_matakuliah']."-".$dt['nama_matakuliah'];?></td>
                <td><?php echo $dt['nama_dosen'];?></td>
                <td><?php echo $dt['nama_ruang'];?></td>
              </tr>
              <?php $nom++; endforeach ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script>
var goTambahData = function()
{
  window.location.assign("<?php echo base_url();?>jadwal_perkuliahan/tambah_data");
}
</script>