<div class="content-wrapper">
  <section class="content-header">
    <h1>Akademik<small>Jadwal Perkuliahan</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>jadwal_perkuliahan"><i class="fa fa-dashboard"></i> Home</a></li>
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
            <h3 class="box-title">Input Data Baru</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <form action="<?php echo base_url();?>career/simpan_info_kegiatan" method="post" onsubmit="return konfirm()" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-sm-2" for="pil_ta">Tahun Akademik</label>
                    <div class="col-sm-2">
                        <select id="pil_ta" name="pil_ta" class="select2" data-placeholder="Pilihan Tahun Akademik" style="width: 100%;">
                        <option></option>
                        <?php
                        foreach($list_ta as $ta){
                          echo "<option value=".$ta['id_thn_akademik'].">".$ta['nama_tahun']."</option>";
                        }?>
                        </select>
                    </div>
                    <label class="col-sm-2" for="pil_sm">Semester</label>
                    <div class="col-sm-2">
                        <select id="pil_sm" name="pil_sm" class="select2" data-placeholder="Pilihan Semester" style="width: 100%;">
                        <option></option>
                        <option value="1">Ganjil</option>
                        <option value="2">Genap</option>
                        </select>
                    </div>
                    <label class="col-sm-2" for="pil_prodi">Program Studi</label>
                    <div class="col-sm-2">
                        <select id="pil_prodi" name="pil_prodi" class="select2" data-placeholder="Pilihan Program Studi" style="width: 100%;" onchange="getMatkul(this)">
                        <option></option>
                        <?php
                        foreach($list_prodi as $prodi){
                          echo "<option value=".$prodi['id_ps'].">".$prodi['nama_ps']."</option>";
                        }?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2" for="pil_mk">Mata Kuliah</label>
                    <div class="col-sm-6">
                        <select id="pil_mk" name="pil_mk" class="select2" data-placeholder="Pilihan Matakuliah" style="width: 100%;" onchange="getProfilMatkul(this)">
                        <option></option>
                        </select>
                    </div>
                    <label class="col-sm-2" for="inp_sms_sks">Semester/SKS</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="inp_sms_sks" id="inp_sms_sks" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2" for="pil_kelas">Kelas</label>
                    <div class="col-sm-2">
                        <select id="pil_kelas" name="pil_kelas" class="select2" data-placeholder="Pilihan Kelas" style="width: 100%;">
                        <option></option>
                        </select>
                    </div>
                    <label class="col-sm-2" for="pil_hari">Hari</label>
                    <div class="col-sm-2">
                        <select id="pil_hari" name="pil_hari" class="select2" data-placeholder="Pilihan Hari" style="width: 100%;">
                        <option></option>
                        </select>
                    </div>
                    <label class="col-sm-2" for="pil_jam">Jam</label>
                    <div class="col-sm-2">
                        <select id="pil_jam" name="pil_jam" class="select2" data-placeholder="Pilihan Jam" style="width: 100%;">
                        <option></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2" for="pil_ruang">Ruangan</label>
                    <div class="col-sm-2">
                        <select id="pil_ruang" name="pil_ruang" class="select2" data-placeholder="Pilihan Ruangan" style="width: 100%;">
                        <option></option>
                        </select>
                    </div>
                    <label class="col-sm-2" for="pil_pengampu">Pengampu</label>
                    <div class="col-sm-6">
                        <select id="pil_pengampu" name="pil_pengampu" class="select2" data-placeholder="Pilihan Pengampu" style="width: 100%;">
                        <option></option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group form-actions">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-angle-right"></i> Submit</button>
                    </div>
                </div>
            </div>
          </div>
          </form>
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
  });
  var getMatkul = function(el){
    var id_prodi = $(el).val();
    $("#pil_mk").load("<?php echo base_url();?>jadwal_perkuliahan/tampilkan_matkul_per_prodi/"+id_prodi);
    $("#inp_sms_sks").val("");
  }
  var getProfilMatkul = function(el) {
    var id_matkul = $(el).val();
    $("#inp_sms_sks").load("<?php echo base_url();?>jadwal_perkuliahan/tampilkan_profil_matkul/"+id_matkul, function(response, status, xhr){
      $("#inp_sms_sks").val(response);
    });
  }
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