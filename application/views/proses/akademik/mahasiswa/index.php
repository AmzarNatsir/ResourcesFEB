<div class="content-wrapper">
  <section class="content-header">
    <h1>Akademik <small>Mahasiswa</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Mahasiswa</li>
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
            <h3 class="box-title">MAHASISWA</h3>
            <hr>
            <fieldset>
              <div class="form-group row">
                <label class="col-md-2 control-label" for="pil_ta">Tahun Akademik</label>
                <div class="col-md-2">
                  <select id="pil_ta" name="pil_ta" class="form-control select2" style="width: 100%;" data-placeholder="Pilihan Tahun Akademik">
                    <option></option>
                    <?php foreach ($mst_ta as $ta): ?>
                    <option value="<?php echo $ta['id_thn_akademik'];?>"><?php echo $ta['nama_tahun'];?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <label class="col-md-2 control-label" for="pil_ps">Program Studi</label>
                <div class="col-md-4">
                  <select id="pil_ps" name="pil_ps" class="form-control select2" style="width: 100%;" data-placeholder="Pilihan Program Studi">
                    <option></option>
                    <?php foreach ($mst_prodi as $ps): ?>
                    <option value="<?php echo $ps['id_ps'];?>"><?php echo $ps['nama_ps'];?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="col-md-2">
                  <button type="button" class="btn btn-sm btn-primary" id="tbl_filter" title="Filter Data"><i class="fa fa-search"></i></button>
                  <button class="btn btn-gradient-primary" type="button" id="loaderDiv" style="display: none" disabled>
                  <i class="fa fa-sync-alt"></i><span class="sr-only">Loading...</span>
                    </button>
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
          <div class="table-responsive" id="view_data"></div>
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
        $("#tbl_filter").on("click", function()
        {
            var pil_ta = $("#pil_ta").val();
            var pil_ps = $("#pil_ps").val();
            $.ajax({
            type : "post",
            url : "<?php echo base_url();?>akademik/tampilkan_mahasiswa",
            data : {pil_ta:pil_ta, pil_ps:pil_ps},
            beforeSend : function()
            {
                $("#loaderDiv").show();
            },
            success : function(respond)
            {
                $("#view_data").html(respond);
                $("#loaderDiv").hide();
            }
            });
        });
    });
</script>