<div class="content-wrapper">
  <section class="content-header">
    <h1>Akademik <small>Matakuliah</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Matakuliah</li>
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
            <h3 class="box-title">MATAKULIAH</h3>
            <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" onclick="goTambahData()"><i class="fa fa-plus"></i> Tambah Data</button>
            </div>
            <hr>
            <fieldset>
              <div class="form-group row">
                <label class="col-md-2 control-label" for="pil_ps">Program Studi</label>
                <div class="col-md-4">
                  <select id="pil_ps" name="pil_ps" class="select2 form-control" data-placeholder="Pilihan Program Studi" style="width: 100%;">
                    <option></option>
                    <?php foreach ($mst_prodi as $ps): ?>
                    <option value="<?php echo $ps['id_ps'];?>"><?php echo $ps['nama_ps'];?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="col-md-6">
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
          <div class="table-responsive" id="view_result"></div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
    $(document).ready(function()
    {
        $('.select2').select2();
        $("#tbl_filter").on("click", function()
        {
          var pil_ps = $("#pil_ps").val();
          if(pil_ps=="")
          {
            alert("Pilihan program studi masih kosong..");
            return false;
          } else {
            $("#view_result").load("<?php echo base_url();?>akademik/tampilkan_matakuliah/"+pil_ps);
          }
        });
    });
    var goTambahData = function()
    {
    window.location.assign("<?php echo base_url();?>akademik/tambah_matakuliah");
    }
</script>