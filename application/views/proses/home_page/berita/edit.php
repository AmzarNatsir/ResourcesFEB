<form action="<?php echo base_url();?>berita/rubah_data" method="post" onsubmit="return konfirm()" enctype="multipart/form-data">
  <input type="hidden" name="id_tabel" id="id_tabel" value="<?php echo $res->id;?>">
  <div class="modal-body">
    <div class="form-group">
      <label for="inp_tampilan">Kategori Berita</label>
      <select class="form-control" id="pil_kategori" name="pil_kategori">
        <?php 
        foreach ($list_kategori as $dt_k) {
          if($dt_k['id']==$res->kategori){
            echo "<option value=".$dt_k['id']." selected>".$dt_k['nm_kategori']."</option>";
          }
          else {
            echo "<option value=".$dt_k['id'].">".$dt_k['nm_kategori']."</option>";
          }
        }
        ?>
      </select>
    </div>
    <div class="form-group">
      <label for="inp_kategori">Judul</label>
      <input type="text" name="inp_judul" id="inp_judul" class="form-control" maxlength="100" value="<?php echo $res->judul;?>">
    </div>
    <div class="form-group">
      <label for="inp_deskripsi">Deskripsi</label>
      <textarea name="inp_deskripsi" id="inp_deskripsi" class="form-control" required><?php echo $res->deskripsi;?></textarea>
    </div>
    <div class="form-group">
      <label for="inp_url">Url</label>
      <input type="text" name="inp_url" id="inp_url" maxlength="200" class="form-control" value="<?php echo $res->url;?>">
    </div>
    <div class="form-group">
      <label for="inp_isi_edit">Isi Berita</label>
      <textarea name="inp_isi_edit" id="inp_isi_edit" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #000; padding: 10px;"><?php echo $res->isi;?></textarea>
    </div>
    <div class="form-group">
      <label for="inp_tampilan">Tampilan Berita</label>
      <select class="form-control" id="pil_tampilan" name="pil_tampilan">
        <?php 
        $arr_pil = array("1"=>"Headline", "2"=>"Lates");
        foreach ($arr_pil as $key => $value): ?>
          <?php if ($key==$res->status): ?>
            <option value="<?php echo $key;?>" selected><?php echo $value;?></option>
          <?php else: ?>
            <option value="<?php echo $key;?>"><?php echo $value;?></option>
          <?php endif ?>
        <?php endforeach ?>
        ?>
      </select>
    </div>
    <div class="form-group">
      <label for="inp_kategori">Upload File (* dimention recomended (745px X 450px))</label>
      <input type="file" name="inp_file" id="inp_file" class="form-control" onchange="readURL_2(this);">
      <input type="hidden" name="temp_file" id="temp_file" value="<?php echo $res->file_img;?>">
    </div>
    <div class="form-group" align="center">
      <img src="<?php if (empty($res->file_img)): ?>
        assets/dist/img/icon_images.png
      <?php else: ?>
        assets/upload/berita/<?php echo $res->file_img;?>
      <?php endif ?>
      " class="picture-src" id="img_preview_edit" title="" height="200px">
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
    <button type="submit" class="btn btn-outline">Simpan Data</button>
  </div>
</form>
<script type="text/javascript">
  $(document).ready(function()
  {
    CKEDITOR.replace('inp_isi_edit');
  });
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