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
            <h3 class="box-title">Jadwal Perkuliahan</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table" width="100%">
              <tr>
                <th>No.</th>
                <th>TA</th>
                <th>Prodi</th>
                <th>Tanggal Mulai</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Hari</th>
                <th>Matakuliah</th>
                <th>Dosen</th>
                <th>Kelas</th>
                <th>Gedung</th>
                <th>Ruang</th>
              </tr>
              <?php $nom=1; foreach ($list_jadwal as $dt): ?>
              <tr>
                <td><?php echo $nom;?></td>
                <td><?php echo $dt['nama_tahun'];?></td>
                <td><?php echo $dt['nama_ps'];?></td>
                <td><?php echo date_format(date_create($dt['tanggal_mulai']), 'd/m/Y');?></td>
                <td><?php echo $dt['jam_mulai'];?></td>
                <td><?php echo $dt['jam_akhir'];?></td>
                <td><?php echo $dt['hari'];?></td>
                <td><?php echo $dt['kode_matakuliah']."-".$dt['nama_matakuliah'];?></td>
                <td><?php echo $dt['nama_dosen'];?></td>
                <td><?php echo $dt['nama_kelas'];?></td>
                <td><?php echo $dt['nama_bangunan'];?></td>
                <td><?php echo $dt['jenis_ruang'];?></td>
              </tr>
              <?php $nom++; endforeach ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>