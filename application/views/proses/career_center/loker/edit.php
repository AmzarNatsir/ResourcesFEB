<div class="content-wrapper">
  <section class="content-header">
    <h1>Career Center<small>Lowongan Kerja</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>career/lowongan_kerja"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Lowongan Kerja</li>
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
            <h3 class="box-title">Edit Informasi Lowongan Kerja</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <form action="<?php echo base_url();?>career/rubah_lowongan_kerja" method="post" onsubmit="return konfirm()" enctype="multipart/form-data">
          <input type="hidden" name="id_tabel" value="<?php echo $res->id;?>">
          <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="inp_tampilan">Kategori Lowongan Kerja</label>
                    <select id="pil_kategori" name="pil_kategori" class="select2" data-placeholder="Pilihan Katgeori Lowongan Kerja" style="width: 100%;">
                    <?php foreach($kategori_loker as $kat) {
                        if($kat['id']==$res->id_kategori){
                            echo "<option value=".$kat['id']." selected>".$kat['nama_kategori']."</option>";
                        } else {
                            echo "<option value=".$kat['id'].">".$kat['nama_kategori']."</option>";
                        }
                    } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inp_kategori">Nama Perusahaan</label>
                    <input type="text" class="form-control" name="inp_nama_perusahaan" id="inp_nama_perusahaan" maxlength="200"  value="<?php echo $res->nama_perusahaan;?>" required>
                </div>
                <div class="form-group">
                    <label for="inp_url">Alamat Perusahaan</label>
                    <input type="text" class="form-control" name="inp_alamat_perusahaan" id="inp_alamat_perusahaan" maxlength="200" value="<?php echo $res->alamat;?>" required>
                </div>
                <div class="form-group">
                    <label for="inp_kategori">Deskripsi</label>
                    <textarea name="inp_deskripsi" id="inp_deskripsi" class="form-control" required><?php echo $res->deskripsi;?></textarea>
                </div>
                <hr>
                <div class="form-group">
                    <label class="col-md-5 control-label" for="pil_tampil">Tampilkan di Site (Career Center)</label>
                    <div class="col-md-7">
                        <label class="radio-inline" for="pil_tampil">
                                <input type="radio" id="pil_tampil" name="tampilkan_info" value="1" <?php echo ($res->tampilkan==1)? "checked" : "" ?>> Ya
                            </label>
                            <label class="radio-inline" for="pil_tidak_tampil">
                                <input type="radio" id="pil_tidak_tampil" name="tampilkan_info" value="2" <?php echo ($res->tampilkan==2)? "checked" : "" ?>> Tidak
                            </label>
                    </div>
                </div>
               
                <div class="form-group form-actions">
                    <div class="col-md-12">
                    <hr>
                        <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-angle-right"></i> Submit</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="pil_provinsi">Provinsi</label>
                    <select class="select2" name="pil_provinsi" id="pil_provinsi" data-placeholder="Pilihan Provinsi" style="width: 100%;" required>
                    <option></option>
                    <?php 
                    foreach($provinsi as $prov){ 
                        if($prov['id']==$res->id_provinsi){
                            echo "<option value=".$prov['id']." selected>".strtoupper($prov['nama_provinsi'])."</option>";
                        } else {
                            echo "<option value=".$prov['id'].">".strtoupper($prov['nama_provinsi'])."</option>";
                        }
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pil_kabupaten">Kabupaten/Kota</label>
                    <select class="select2" name="pil_kabupaten" id="pil_kabupaten" data-placeholder="Pilihan Kabupaten/Kota" style="width: 100%;" required>
                    <option></option>
                    <?php 
                    foreach($kabupaten as $kab){ 
                        if($kab['id']==$res->id_kabupaten){
                            echo "<option value=".$kab['id']." selected>".strtoupper($kab['nama_kabupaten'])."</option>";
                        } else {
                            echo "<option value=".$kab['id'].">".strtoupper($kab['nama_kabupaten'])."</option>";
                        }
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inp_kontak_person">Kontak Person</label>
                    <input type="text" class="form-control" name="inp_kontak_person" id="inp_kontak_person" maxlength="100" value="<?php echo $res->kontak_person;?>">
                </div>
                <div class="form-group">
                    <label for="inp_pelaksana">Masa Aktif Lowongan Kerja</label>
                    <div class="input-group input-daterange" data-date-format="dd-mm-yyyy">
                        <input type="date" id="tgl_star" name="tgl_star" class="form-control text-center" placeholder="Mulai" value="<?php echo $res->tgl_mulai;?>" required>
                        <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                        <input type="date" id="tgl_end" name="tgl_end" class="form-control text-center" placeholder="Sampai" value="<?php echo $res->tgl_akhir;?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inp_sumber">Sumber/Link</label>
                    <input type="text" class="form-control" name="inp_sumber" id="inp_sumber" maxlength="200" value="<?php echo $res->sumber_link;?>">
                </div>
                <div class="form-group row">
                    <label class="col-md-4 control-label">Upload Gambar ?</label>
                    <div class="col-md-8">
                        <label class="radio-inline" for="pil_ya">
                            <input type="radio" id="pil_ya" name="upload_gambar" value="1" <?php echo ($res->ada_file==1)? "checked" : "" ?>> Ya
                        </label>
                        <label class="radio-inline" for="pil_tidak">
                            <input type="radio" id="pil_tidak" name="upload_gambar" value="2" <?php echo ($res->ada_file==2)? "checked" : "" ?>> Tidak
                        </label>
                    </div>
                </div>
                <hr> 
                <div id="area_upload" style="<?php echo($res->ada_file==1)? "" : "display:none" ?> ">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="file" name="inp_gambar" id="inp_gambar" class="form-control" onchange="loadFile_file(this)">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12" style="text-align: center;">
                            <img id="preview_file" style="width: 100%; height: auto;" 
                            <?php if($res->ada_file==1) {?> 
                                src="<?php echo "../../../".file_loker.$res->file_lampiran;?>"
                            <?php } else {?> 
                                src=""
                            <?php } ?>>
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
    $("#pil_provinsi").on("change", function()
    {
        var id_prov = $("#pil_provinsi").val();
        $("#pil_kabupaten").load("<?php echo base_url();?>career/tampilkan_kabupaten/"+id_prov);
    });
    $("input[name='upload_gambar']").on("change", function()
    {
        var isi = $("input[name=upload_gambar]:checked").val();
        if(isi==1) {
            $("#area_upload").show(1000);
            $("#inp_gambar").attr("required", true);
        } else {
            $("#inp_gambar").attr("required", false);
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