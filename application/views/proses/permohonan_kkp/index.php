<div class="content-wrapper">
  <section class="content-header">
    <h1>Akademik <small>Permohonan KKP</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Permohonan KKP</li>
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
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">FILTER DATA</h3>
            <hr>
            <fieldset>
              <div class="form-group row">
                <label class="col-md-2 control-label" for="pil_ta">Tahun Akademik</label>
                <div class="col-md-2">
                  <select id="pil_ta" name="pil_ta" class="form-control" style="width: 100%;">
                    <option value="0">ALL</option>
                    <?php foreach ($mst_ta as $ta): ?>
                    <option value="<?php echo $ta['id_thn_akademik'];?>"><?php echo $ta['nama_tahun'];?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <label class="col-md-2 control-label" for="pil_ps">Program Studi</label>
                <div class="col-md-4">
                  <select id="pil_ps" name="pil_ps" class="form-control" style="width: 100%;">
                    <option value="0">ALL</option>
                    <?php foreach ($mst_prodi as $ps): ?>
                    <option value="<?php echo $ps['id_ps'];?>"><?php echo $ps['nama_ps'];?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="col-md-2">
                  <button type="button" class="btn btn-sm btn-primary" id="tbl_filter" title="Filter Data"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </fieldset>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="table-responsive">
            <table class="table" style="width: 100%; font-size: 10pt">
              <tr>
                <th>No.</th>
                <th>TA</th>
                <th>Program Studi</th>
                <th>NIM</th>
                <th>Mahasiswa</th>
                <th>Ukuran Baju</th>
                <th>Lokasi KKP (Alternatif I)</th>
                <th>Cadangan Lokasi KKP (Alternatif II)</th>
                <th>Tanggal Pengajuan</th>
                <th></th>
              </tr>
              <tbody id="view_result">
                <?php
                $nom=1;
                foreach ($list_permohonan as $dt) { ?>
                <tr>
                  <td><?php echo $nom;?></td>
                  <td><?php echo $dt['nama_tahun'];?></td>
                  <td><?php echo $dt['nama_ps'];?></td>
                  <td><?php echo $dt['nim'];?></td>
                  <td><?php echo $dt['nama_mahasiswa'];?></td>
                  <td><?php echo $dt['ukuran_baju'];?></td>
                  <td>
                    Nama Instansi : <b><?php echo $dt['nama_instansi_1'];?></b><br>
                    Alamat : <b><?php echo $dt['alamat_1'];?></b><br>
                    No. Telpon : <b><?php echo $dt['no_telpon_1'];?></b><br>
                    Kontak Person : <b><?php echo $dt['kontak_person_1'];?></b>
                  </td>
                  <td>
                    Nama Instansi : <b><?php echo $dt['nama_instansi_2'];?></b><br>
                    Alamat : <b><?php echo $dt['alamat_2'];?></b><br>
                    No. Telpon : <b><?php echo $dt['no_telpon_2'];?></b><br>
                    Kontak Person : <b><?php echo $dt['kontak_person_2'];?></b>
                  </td>
                  <td><?php echo date_format(date_create($dt['tgl_post']), 'd-m-Y');?></td>
                  <td>
                    <button class="btn btn-success" id="tbl_apply" name="tbl_apply" onclick="getProfilPengajuan(this)" value="<?php echo $dt['id'];?>">Detail</button>
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
        $("#tbl_filter").on("click", function()
        {
          var pil_ta = $("#pil_ta").val();
          var pil_ps = $("#pil_ps").val();
          $("#view_result").load("<?php echo base_url();?>permohonan_kkp/filter_data/"+pil_ta+"/"+pil_ps);
        });
    });
    var getProfilPengajuan = function(el)
  {
      window.location.assign("<?php echo base_url();?>permohonan_kkp/detail_permohonan/"+el.value);
  }
</script>