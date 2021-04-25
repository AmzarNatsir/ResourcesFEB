<div class="content-wrapper">
  <section class="content-header">
    <h1>Akademik <small>Matakuliah</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>akademik/matakuliah"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Tambah Matakuliah Baru</li>
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
            <h3 class="box-title">INPUT MATAKULIAH BARU</h3>
            <hr>
            <fieldset>
            <form action="<?php echo base_url();?>akademik/simpan_matakuliah" method="post" onsubmit="return konfirm()">
                <div class="form-group row">
                    <label class="col-md-2 control-label" for="inp_kode">Kode Matakuliah</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="inp_kode_matkul" id="inp_kode_matkul" maxlength="20" required oninput="cekKodeMatkul(this)">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 control-label" for="inp_nama_matkul">Nama Matakuliah</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="inp_nama_matkul" id="inp_nama_matkul" maxlength="100" required disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 control-label" for="pil_jenis">Jenis Matakuliah</label>
                    <div class="col-md-6">
                        <select id="pil_jenis" name="pil_jenis" class="select2 form-control" data-placeholder="Pilihan Jenis Matakuliah" style="width: 100%;" disabled>
                            <option></option>
                            <?php foreach ($jenis_matkul as $jenis): ?>
                            <option value="<?php echo $jenis['id_jenis_mk'];?>"><?php echo $jenis['jenis_matakuliah'];?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 control-label" for="pil_ps">Program Studi</label>
                    <div class="col-md-2">
                        <select id="pil_ps" name="pil_ps" class="select2 form-control" data-placeholder="Pilihan Program Studi" style="width: 100%;" disabled>
                            <option></option>
                            <?php foreach ($mst_prodi as $ps): ?>
                            <option value="<?php echo $ps['id_ps'];?>"><?php echo $ps['nama_ps'];?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <label class="col-md-2 control-label" for="pil_semester">Semester</label>
                    <div class="col-md-2">
                        <select id="pil_semester" name="pil_semester" class="select2 form-control" data-placeholder="Pilihan Semester" style="width: 100%;" disabled>
                            <option></option>
                            <?php foreach ($semester as $sms): ?>
                            <option value="<?php echo $sms['id'];?>"><?php echo $sms['semester'];?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <label class="col-md-2 control-label" for="inp_sks">SKS</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control angka" name="inp_sks" id="inp_sks" value="0" required maxlength="2" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 control-label" for="inp_jumlah_pertemuan">Jumlah Pertemuan</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control angka" name="inp_jumlah_pertemuan" id="inp_jumlah_pertemuan" value="0" maxlength="3" disabled>
                    </div>
                    <label class="col-md-2 control-label" for="inp_menit_pertemuan">Total Menit Pertemuan</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control angka" name="inp_menit_pertemuan" id="inp_menit_pertemuan" value="0" disabled>
                    </div>
                </div>
                <hr>
                <div class="form-group form-actions">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-md btn-primary" id="tbl_simpan" disabled><i class="fa fa-angle-right"></i> Submit</button>
                    </div>
                </div>
            </form>
            </fieldset>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
    $(document).ready(function()
    {
        $('.select2').select2();
        $(".angka").number(true, 0);
    });
    var cekKodeMatkul = function(el)
    {
        var kode = $(el).val();
        $.ajax (
        {
            url : "<?php echo site_url();?>akademik/cek_kode_matakuliah",
            type : "post",
            data : {kode:kode},
            success : function(d)
            {
                if(d=="true")
                {
                    alert("Kode Matakuliah Sudah Terdaftar");
                    aktif_teks(true);
                    return false;
                } else {
                    aktif_teks(false);
                    return false;
                }
                //window.location.assign("<?php echo base_url();?>kalender_akademik");
            }
         });
    }
    function aktif_teks(tf)
    {
        $("#inp_nama_matkul").attr("disabled", tf);
        $("#pil_jenis").attr("disabled", tf);
        $("#pil_ps").attr("disabled", tf);
        $("#pil_semester").attr("disabled", tf);
        $("#inp_sks").attr("disabled", tf);
        $("#inp_jumlah_pertemuan").attr("disabled", tf);
        $("#inp_menit_pertemuan").attr("disabled", tf);
        $("#tbl_simpan").attr("disabled", tf);
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