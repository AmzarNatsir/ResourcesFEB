<form role="form" method="post" action="<?php echo base_url();?>opsi/keterampilan_khusus_rubah" onsubmit="return konfirm()">
  <input type="hidden" name="id_tabel" name="id_tabel" value="<?php echo $res->id_kk;?>">
  <div class="modal-body">
    <div class="box-body">
      <div class="form-group">
        <label for="nomor_urut">Nomor Urut</label>
        <input type="text" class="form-control" id="nomor_urut" name="nomor_urut" value="<?php echo $res->no_urut;?>"" readonly>
      </div>
      <div class="form-group">
        <label for="nm_aspek_kk">Nama Aspek Keterampilan khusus</label>
        <textarea class="form-control" id="nm_aspek_kk" name="nm_aspek_kk" required><?php echo $res->keterampilan_khusus;?></textarea>
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