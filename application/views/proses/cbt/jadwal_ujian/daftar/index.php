<div class="content-wrapper">
  <section class="content-header">
    <h1>Computer Based Test (CBT) <small>Jadwal Ujian</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Daftar Jadwal Ujian</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">JADWAL UJIAN</h3>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <div class="box-body table-responsive">
                  <table class="table" style="width: 100%;">
                  <thead>
                    <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 10%;">Tanggal</th>
                    <th style="width: 10%;">Jam</th>
                    <th style="width: 10%;">Durasi</th>
                    <th style="width: 10%;">TA</th>
                    <th style="width: 15%;">Prodi</th>
                    <th style="width: 25%;">Matakuliah</th>
                    <th style="width: 10%;">Kode Ujian</th>
                    <th style="width: 5%;"></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $nom=1; foreach($list_jadwal as $list) { ?>
                    <tr>
                    <td><?php echo $nom;?></td>
                    <td><?php echo date_format(date_create($list['tanggal_ujian']), "d/m/Y");?></td>
                    <td><?php echo $list['jam_ujian'];?></td>
                    <td><?php echo $list['lama_pengerjaan'];?></td>
                    <td><?php echo $list['nama_tahun'];?></td>
                    <td><?php echo $list['nama_ps'];?></td>
                    <td><?php echo $list['nama_matakuliah'];?></td>
                    <td><?php echo $list['kode_ujian'];?></td>
                    <td><a href="<?php echo base_url();?>cbt/jadwal_ujian_detail/<?php echo encrypt_decrypt('encrypt', $list['id']);?>"><i class="btn btn-primary fa fa-eye" title="Detail Jadwal Ujian"></i></a></td>
                    </tr>
                    <?php
                    $nom++;
                  } ?>
                  <tr>
                  <td></td>
                  </tr>
                  </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>