<form role="form" method="post" action="<?php echo base_url();?>opsi/provinsi_rubah" onsubmit="return konfirm()">
  <input type="hidden" name="id_tabel" name="id_tabel" value="<?php echo $res->id;?>">
  <div class="modal-body">
    <div class="box-body">
      <div class="form-group">
        <label for="nm_provinsi">Nama Provinsi</label>
        <input type="text" name="nm_provinsi" id="nm_provinsi" class="form-control" maxlength="100" value="<?php echo $res->nama_provinsi;?>" required>
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