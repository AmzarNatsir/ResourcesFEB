<div class="content-wrapper">
  <section class="content-header">
    <h1>Penyusunan <small>Rencana Pembelajaran Semester (RPS)</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>Home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Rencana Pembelajaran Semester (RPS)</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Identitas Matakuliah</h3>
          </div>
          <div class="box-body">
            <input type="hidden" name="id_head_rps" id="id_head_rps" value="<?php echo encrypt_decrypt('encrypt', $dt_head->id_rps);?>">
            <div class="row">
                <label class="col-sm-2 col-form-label">Program Studi</label>
                <label class="col-sm-4">: <?php echo $dt_head->nama_ps;?> (<?php echo $dt_head->nm_jenjang;?>)</label>
                <label class="col-sm-2 col-form-label">Mata Kuliah</label>
                <label class="col-sm-4">: <?php echo $dt_head->nama_matakuliah;?></label>
            </div>
            <div class="row">
                <label class="col-sm-2 col-form-label">Rumpun Matakuliah</label>
                <label class="col-sm-4">: <?php echo $dt_head->jenis_matakuliah;?></label>
                <label class="col-sm-2 col-form-label">Kode / SKS/ Semester</label>
                <label class="col-sm-4">: <?php echo $dt_head->kode_matakuliah."/".$dt_head->sks."/".$dt_head->semester;?></label>
            </div>
            <div class="row">
                <label class="col-sm-2 col-form-label">Dosen Pengampuh</label>
                <label class="col-sm-4">: 
                <?php
                $nom=1;
                foreach ($list_dsn as $key => $value) {
                    echo $nom.". ".$value."<br>";
                    $nom++;
                }
                ?>
                </label>
                <label class="col-sm-2 col-form-label">Kurikulum Tahun</label>
                <label class="col-sm-4">: <?php echo $dt_head->tahun;?></label>
            </div>
          </div>
        </div>
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Capaian pembelajaran</h3>
          </div>
          <div class="box-body">
            <form id="form_inp" name="form_inp">
              <div class="row">
                <div class="col-xs-12">
                  <h3 class="page-header">
                    <strong>CPL-PRODI</small>
                  </h2>
                </div>
              </div>
              <div class="form-group">
                <label>A. Aspek Sikap (S)</label>
                <select class="select2" id="pil_aspek_sikap" name="pil_aspek_sikap[]" multiple="multiple" data-placeholder="Pilih aspek sikap" style="width: 100%;">
                  <?php foreach ($list_aspek_sikap as $dt_ak) { ?>
                  <option value="<?php echo $dt_ak['id_sikap'];?>">(S<?php echo $dt_ak['no_urut'];?>). <?php echo $dt_ak['aspek_sikap'];?></option>
                  <?php } ?>
                </select>
              </div>
              
              <div class="form-group">
                <label>B. Aspek Pengetahuan (P)</label>
                <select class="select2" id="pil_pengetahuan" name="pil_pengetahuan[]" multiple="multiple" data-placeholder="Pilih aspek pengetahuan" style="width: 100%;">
                <?php foreach ($list_aspek_pengetahuan as $dt_ap) { ?>
                    <option value="<?php echo $dt_ap['id_pengetahuan'];?>">(P<?php echo $dt_ap['no_urut'];?>). <?php echo $dt_ap['aspek_pengetahuan'];?></option>
                <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label>C. Aspek Keterampilan Umum (KU)</label>
                <select class="select2" id="pil_keterampilan_umum" name="pil_keterampilan_umum[]" multiple="multiple" data-placeholder="Pilih aspek keterampilan umum" style="width: 100%;">
                <?php foreach ($list_aspek_ku as $dt_ku) { ?>
                    <option value="<?php echo $dt_ku['id_ku'];?>">(KU<?php echo $dt_ku['no_urut'];?>). <?php echo $dt_ku['keterampilan_umum'];?></option>
                <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label>D. Aspek Keterampilan Khusus (KK)</label>
                <select class="select2" id="pil_keterampilan_khusus" name="pil_keterampilan_khusus[]" multiple="multiple" data-placeholder="Pilih aspek keterampilan khusus" style="width: 100%;">
                <?php foreach ($list_aspek_kk as $dt_kk) { ?>
                    <option value="<?php echo $dt_kk['id_kk'];?>">(KK<?php echo $dt_kk['no_urut'];?>). <?php echo $dt_kk['keterampilan_khusus'];?></option>
                <?php } ?>
                </select>
              </div>
              <div class="form-footer">
                  <button type="button" class="btn btn-danger tbl_kembali"><< Kembali</button>
                  <button type="button" class="btn btn-success tbl_simpan"><i class="fa fa-check-square-o"></i> Simpan data capaian pembelajaran lulusan program studi (CPL-PRODI)</button>
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
        $(".tbl_simpan").on("click", function()
        {
            var id_rps = $("#id_head_rps").val();
            var pil_asp_sikap = $("#pil_aspek_sikap").val();
            var pil_asp_pengetahuan = $("#pil_pengetahuan").val();
            var pil_asp_ku = $("#pil_keterampilan_umum").val();
            var pil_asp_kk = $("#pil_keterampilan_khusus").val();
            if(pil_asp_sikap==null)
            {
                alert("Kolom pilihan aspek sikap tidak boleh kosong");
                return false;
            } else if(pil_asp_pengetahuan==null)
            {
                alert("Kolom pilihan aspek pengetahuan tidak boleh kosong");
                return false;
            } else if(pil_asp_ku==null && pil_asp_kk==null)
            {
                alert("Kolom pilihan aspek keterampilan (umum atau khusus) tidak boleh kosong");
                return false;
            } else {
                var pesan = confirm("Yakin akan menyimpan data ?");
                if(pesan==true)
                {
                    $.ajax (
                    {
                        url : "<?php echo site_url();?>rps/simpan_capaian_pembelajaran",
                        type : "post",
                        data : {pil_asp_sikap:pil_asp_sikap.join(), pil_asp_pengetahuan:pil_asp_pengetahuan.join(), pil_asp_ku:pil_asp_ku.join(), pil_asp_kk:pil_asp_kk.join(), id_rps:id_rps},
                        success : function(d)
                        {
                            alert(d);
                            window.location.assign("<?php echo base_url();?>rps/add_capaian_pembelajaran_mk/"+id_rps);
                        }
                     });
                    
                } else {
                    return false;
                }
            }
            
        });
         $(".tbl_kembali").on("click", function()
        {
            window.location.assign("<?php echo base_url();?>rps/add_identitas");
        });
    });
</script>