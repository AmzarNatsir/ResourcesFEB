<form role="form" method="post" action="<?php echo base_url();?>opsi/kategori_berita_rubah" onsubmit="return konfirm()">
  <input type="hidden" name="id_tabel" name="id_tabel" value="<?php echo $res->id;?>">
  <div class="modal-body">
    <div class="box-body">
      <div class="form-group">
        <label for="nm_kategori">Nama Kategori</label>
        <input type="text" name="nm_kategori" id="nm_kategori" class="form-control" maxlength="50" value="<?php echo $res->nm_kategori;?>" required>
      </div>
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