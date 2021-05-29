<div class="content-wrapper">
  <section class="content-header">
    <h1>Computer Based Test (CBT) <small>Jadwal Ujian</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pembuatan Jadwal Ujian</li>
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
            <h3 class="box-title">FORM PEMBUATAN JADWAL UJIAN</h3>
            <hr>
            <div class="row">
              <div class="col-md-6">
              <form action="<?php echo base_url();?>cbt/simpan_soal_head" method="post" onsubmit="return konfirm()">
                <fieldset>
                    <div class="form-group row">
                        <label class="col-md-3 control-label" for="pil_ta">Tahun Akademik</label>
                        <div class="col-md-9">
                            <select id="pil_ta" name="pil_ta" class="select2 form-control" data-placeholder="Pilihan Tahun Akademik" style="width: 100%;">
                                <option></option>
                                <?php foreach ($mst_ta as $ta): ?>
                                <option value="<?php echo $ta['id_thn_akademik'];?>"><?php echo $ta['nama_tahun'];?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 control-label" for="pil_ps">Program Studi</label>
                        <div class="col-md-9">
                        <select id="pil_ps" name="pil_ps" class="select2 form-control" data-placeholder="Pilihan Program Studi" style="width: 100%;" onchange="cekSoal(this)">
                            <option></option>
                            <?php foreach ($mst_prodi as $ps): ?>
                            <option value="<?php echo $ps['id_ps'];?>"><?php echo $ps['nama_ps'];?></option>
                            <?php endforeach ?>
                        </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-md-3 control-label" for="pil_soal">Pilih Soal Ujian</label>
                        <div class="col-md-9">
                        <select id="pil_soal" name="pil_soal" class="select2 form-control" data-placeholder="Pilihan Soal Ujian" style="width: 100%;" onchange="cekTeam(this)">
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 control-label">Team Penyusun</label>
                      <label class="col-md-9" id="lbl_team"></label>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 control-label" for="inp_kode_ujian">Kode Ujian</label>
                        <div class="col-md-9">
                            <input type="text" name="inp_kode_ujian" id="inp_kode_ujian" class="form-control" value="<?php echo $kode_ujian;?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 control-label" for="inp_tanggal">Tanggal Ujian</label>
                        <div class="col-md-9">
                            <input type="text" name="inp_tanggal" id="inp_tanggal" class="form-control" value="<?= date("d/m/Y")?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 control-label" for="inp_jam">Jam Ujian</label>
                        <div class="col-md-9">
                            <input type="text" name="inp_jam" id="inp_jam" class="form-control jam" placeholder="jam:menit:detik (00:00:00)" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 control-label" for="inp_lama_pengerjaan">Lama Pengerjaan</label>
                        <div class="col-md-9">
                            <input type="text" name="inp_lama_pengerjaan" id="inp_lama_pengerjaan" class="form-control jam" placeholder="jam:menit:detik (00:00:00)" required>
                        </div>
                    </div>
                </fieldset>
              </form>
              </div>
              <div class="col-md-6">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">DAFTAR JADWAL UJIAN</h3>
                </div>
                <div class="box-body table-responsive"></div>
              </div>
            </div>
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
      $(".jam").mask("00:00:00");
      $('.select2').select2();
    });
    //var getMatkul = function(el){
    //  var id_prodi = $(el).val();
    //  $("#pil_matkul").load("<?php echo base_url();?>cbt/tampilkan_matkul_per_prodi/"+id_prodi);
    //}
    var cekSoal = function(el)
    {
      var id_prodi = $(el).val();
      $.ajax({
        type : "post",
        url : "<?php echo base_url();?>cbt/tampilkan_soal_per_prodi_jadwal",
        data : {id_prodi:id_prodi},
        //beforeSend : function()
        //{
        //    $("#loaderDiv").show();
        //},
        success : function(respond)
        {
            $("#pil_soal").html(respond);
            //$("#loaderDiv").hide();
        }
      });
    }
    var cekTeam = function(el)
    {
      var id_soal = $(el).val();
      $.ajax({
        type : "post",
        url : "<?php echo base_url();?>cbt/tampilkan_team_penyusun_soal_jadwal",
        data : {id_soal:id_soal},
        //beforeSend : function()
        //{
        //    $("#loaderDiv").show();
        //},
        success : function(respond)
        {
            $("#lbl_team").html(respond);
            //$("#loaderDiv").hide();
        }
      });
    }
</script>