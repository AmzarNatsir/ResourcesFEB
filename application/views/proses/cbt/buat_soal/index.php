<div class="content-wrapper">
  <section class="content-header">
    <h1>Computer Based Test (CBT) <small>Buat Soal</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Buat Soal</li>
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
            <h3 class="box-title">FORM PEMBUATAN SOAL (STEP 1)</h3>
            <hr>
            <div class="row">
              <div class="col-md-6">
              <form action="<?php echo base_url();?>cbt/simpan_soal_head" method="post" onsubmit="return konfirm()">
                <fieldset>
                  <div class="form-group row">
                    <label class="col-md-3 control-label" for="pil_ps">Program Studi</label>
                    <div class="col-md-9">
                      <select id="pil_ps" name="pil_ps" class="select2 form-control" data-placeholder="Pilihan Program Studi" style="width: 100%;" onchange="getMatkul(this)">
                        <option></option>
                        <?php foreach ($mst_prodi as $ps): ?>
                        <option value="<?php echo $ps['id_ps'];?>"><?php echo $ps['nama_ps'];?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 control-label" for="pil_matkul">Matakuliah</label>
                    <div class="col-md-9">
                      <select id="pil_matkul" name="pil_matkul" class="select2 form-control" data-placeholder="Pilihan Matakuliah" style="width: 100%;" onchange="cekSoal(this)">
                        <option></option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 control-label" for="pil_dosen">Team Pembuat Soal</label>
                    <div class="col-md-9">
                      <select id="pil_dosen" name="pil_dosen[]" class="select2 form-control" multiple="multiple" data-placeholder="Pilihan Team" style="width: 100%;" required>
                          <option></option>
                          <?php foreach ($list_dosen as $dosen): ?>
                          <option value="<?php echo $dosen['id_dosen'];?>"><?php echo $dosen['nama_dosen'];?></option>
                          <?php endforeach ?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 control-label" for="inp_kode_soal">Kode Soal</label>
                    <div class="col-md-9">
                      <input type="text" name="inp_kode_soal" id="inp_kode_soal" class="form-control" maxlength="10" oninput="cekKodeSoal(this)" required>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group form-actions">
                      <div class="col-md-12">
                          <button type="submit" class="btn btn-md btn-primary" id="tbl_simpan" disabled><i class="fa fa-angle-right"></i> Klik untuk melanjutkan ke tahap pembuatan soal (Step 2)</button>
                      </div>
                  </div>
                </fieldset>
              </form>
              </div>
              <div class="col-md-6">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">DAFTAR SOAL</h3>
                </div>
                <div class="box-body table-responsive" id="view_soal"></div>
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
      $('.select2').select2();
    });
    var getMatkul = function(el){
      var id_prodi = $(el).val();
      $("#pil_matkul").load("<?php echo base_url();?>cbt/tampilkan_matkul_per_prodi/"+id_prodi);
    }
    var cekSoal = function(el)
    {
      var id_mk = $(el).val();
      $.ajax({
        type : "post",
        url : "<?php echo base_url();?>cbt/tampilkan_soal_per_matakuliah",
        data : {id_mk:id_mk},
        //beforeSend : function()
        //{
        //    $("#loaderDiv").show();
        //},
        success : function(respond)
        {
            $("#view_soal").html(respond);
            //$("#loaderDiv").hide();
        }
      });
    }
    var cekKodeSoal = function(el)
    {
      var kode = $(el).val();
      if(kode.length==0){
        $("#tbl_simpan").attr("disabled", true);
      } else {
        $.ajax (
        {
          url : "<?php echo site_url();?>cbt/cek_kode_soal",
          type : "post",
          data : {kode:kode},
          success : function(d)
          {
              if(d=="true")
              {
                alert("Kode Matakuliah Sudah Terdaftar");
                $("#tbl_simpan").attr("disabled", true);
                return false;
              } else {
                $("#tbl_simpan").attr("disabled", false);
                return false;
              }
          }
        });
      }
    }
</script>