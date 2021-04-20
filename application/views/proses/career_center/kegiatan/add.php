<div class="content-wrapper">
  <section class="content-header">
    <h1>Career Center<small> Informasi Kegiatan</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>career/info_kegiatan"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Informasi Kegiatan</li>
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
            <h3 class="box-title">Input Informasi Kegiatan Baru</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <form action="<?php echo base_url();?>career/simpan_info_kegiatan" method="post" onsubmit="return konfirm()" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <label for="inp_tampilan">Kategori Kegiatan</label>
                    <select id="pil_kategori" name="pil_kategori" class="select2" data-placeholder="Pilihan Katgeori Lowongan Kerja" style="width: 100%;">
                    <?php foreach($kat_kegiatan as $kat) {
                        echo "<option value=".$kat['id'].">".$kat['nama_kategori']."</option>";
                    } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inp_nama">Nama Kegiatan</label>
                    <input type="text" class="form-control" name="inp_nama" id="inp_nama" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label for="inp_pelaksana">Pelaksana Kegiatan</label>
                    <input type="text" class="form-control" name="inp_pelaksana" id="inp_pelaksana" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label for="inp_tempat">Tempat Kegiatan</label>
                    <input type="text" class="form-control" name="inp_tempat" id="inp_tempat" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label for="inp_deskripsi">Deskripsi</label>
                    <textarea name="inp_deskripsi" id="inp_deskripsi" class="form-control" required></textarea>
                </div>

                <hr>
                <div class="form-group form-actions">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-angle-right"></i> Submit</button>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="inp_sumber">Sumber/Link</label>
                    <input type="text" class="form-control" name="inp_sumber" id="inp_sumber" maxlength="200">
                </div>
                <div class="form-group">
                    <label for="inp_pelaksana">Tanggal Pelaksanaan</label>
                    <div class="input-group input-daterange" data-date-format="dd-mm-yyyy">
                        <input type="date" id="tgl_star" name="tgl_star" class="form-control text-center" placeholder="Mulai" value="<?php echo date("d-m-Y");?>" required>
                        <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                        <input type="date" id="tgl_end" name="tgl_end" class="form-control text-center" placeholder="Sampai" value="<?php echo date("d-m-Y");?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 control-label">Upload Gambar ?</label>
                    <div class="col-md-8">
                        <label class="radio-inline" for="pil_ya">
                            <input type="radio" id="pil_ya" name="upload_gambar" value="1" checked> Ya
                        </label>
                        <label class="radio-inline" for="pil_tidak">
                            <input type="radio" id="pil_tidak" name="upload_gambar" value="2"> Tidak
                        </label>
                    </div>
                </div>
                <hr> 
                <div id="area_upload">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="file" name="inp_gambar" id="inp_gambar" class="form-control" onchange="loadFile_file(this)" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12" style="text-align: center;">
                            <img id="preview_file" style="width: 100%; height: auto;" src="">
                        </div>
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
    CKEDITOR.replace('inp_deskripsi');
    $("input[name='upload_gambar']").on("change", function()
    {
        var isi = $("input[name=upload_gambar]:checked").val();
        if(isi==1) {
            $("#area_upload").show(1000);
        } else {
            $("#area_upload").hide(1000);
        }
    });
  });
  var _validFileExtensions = [".jpg", ".jpeg", ".png"];
var loadFile_file = function(oInput) {
if (oInput.type == "file") {
    var sFileName = oInput.value;
    var sSizeFile = oInput.files[0].size;
    var output = document.getElementById('preview_file');
    //alert(sSizeFile);
    if (sFileName.length > 0) {
        var blnValid = false;
        for (var j = 0; j < _validFileExtensions.length; j++) {
            var sCurExtension = _validFileExtensions[j];
            if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                blnValid = true;
                break;
            }
        }
        
        if (!blnValid) {
            alert("Maaf, " + sFileName + " tidak valid, jenis file yang boleh di upload adalah: " + _validFileExtensions.join(", "));
            oInput.value = "";
            output.src = "";
            return false;
        } 
        if(sSizeFile>500000) //50 KB
        {
            alert("Maaf, " + sFileName + " tidak valid, Ukuran file terlalu besar: " + sSizeFile);
            oInput.value = "";
            output.src = "";
            return false;
        } else {
            
            output.src = URL.createObjectURL(oInput.files[0]);
        }
    }
    
}
return true;

}; 
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