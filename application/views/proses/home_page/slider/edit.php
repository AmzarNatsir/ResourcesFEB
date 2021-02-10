<form action="<?php echo base_url();?>slide/rubah_data" method="post" onsubmit="return konfirm()" enctype="multipart/form-data">
  <input type="hidden" name="id_tabel" id="id_tabel" value="<?php echo $res->id;?>">
  <div class="modal-body">
    <div class="form-group">
      <label for="inp_kategori">Judul Slide</label>
      <input type="text" name="inp_judul" id="inp_judul" class="form-control" maxlength="50" value="<?php echo $res->judul;?>">
    </div>
    <div class="form-group">
      <label for="inp_kategori">Deskripsi Slide</label>
      <textarea class="form-control" name="inp_deskripsi" id="inp_deskripsi"><?php echo $res->keterangan;?></textarea>
    </div>
    <div class="form-group">
      <label for="inp_kategori">Upload File (dimensions recommended (px) : 1920 X 780)</label>
      <input type="file" name="inp_file" id="inp_file" class="form-control" onchange="readURL_2(this);">
      <input type="hidden" name="temp_file" id="temp_file" value="<?php echo $res->img_file;?>">
    </div>
    <div class="form-group" align="center">
      <img src="<?php if (empty($res->img_file)): ?>
        assets/images/icon_images.png
      <?php else: ?>
        assets/upload/slide/<?php echo $res->img_file;?>
      <?php endif ?>
      " class="picture-src img-responsive" id="img_preview_edit" title="" height="200px">
    </div>
    <div class="form-group">
      <label for="inp_kategori">Status</label>
      <select class="form-control" name="pil_status">
        <?php $arr_sts = array("1"=>"Aktif", "2"=>"Tidak Aktif"); 
        foreach ($arr_sts as $key => $value): ?>
          <?php if ($key==$res->disp): ?>
            <option value="<?php echo $key;?>" selected><?php echo $value;?></option>
          <?php else: ?>
            <option value="<?php echo $key;?>"><?php echo $value;?></option>
          <?php endif ?>
        <?php endforeach ?>
      </select>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
    <button type="submit" class="btn btn-outline">Simpan Data</button>
  </div>
</form>
<script type="text/javascript">
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
  function readURL_2(input) 
  {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#img_preview_edit')
                  .attr('src', e.target.result);
          };

          reader.readAsDataURL(input.files[0]);
      }
  }
</script>