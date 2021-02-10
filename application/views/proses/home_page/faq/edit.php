<form action="<?php echo base_url();?>faq/rubah_data" method="post" onsubmit="return konfirm()" enctype="multipart/form-data">
  <input type="hidden" name="id_tabel" id="id_tabel" value="<?php echo $res->id_faq;?>">
  <div class="modal-body">
    <div class="form-group">
      <label for="inp_tampilan">Kategori FAQ</label>
      <select class="form-control" id="pil_kategori" name="pil_kategori">
        <?php 
        foreach ($list_kategori as $dt_k) {
          if($dt_k['id_kat_faq']==$res->id_kat_faq){
            echo "<option value=".$dt_k['id_kat_faq']." selected>".$dt_k['nm_kat_faq']."</option>";
          }
          else {
            echo "<option value=".$dt_k['id_kat_faq'].">".$dt_k['nm_kat_faq']."</option>";
          }
        }
        ?>
      </select>
    </div>
    <div class="form-group">
      <label for="inp_pertanyaan">Pertanyaan</label>
      <textarea name="inp_pertanyaan" id="inp_pertanyaan" class="form-control" required><?php echo $res->pertanyaan;?></textarea>
    </div>
    <div class="form-group">
      <label for="inp_jawaban">Jawaban</label>
      <textarea name="inp_jawaban" id="inp_jawaban" class="form-control" required><?php echo $res->jawaban;?></textarea>
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
</script>