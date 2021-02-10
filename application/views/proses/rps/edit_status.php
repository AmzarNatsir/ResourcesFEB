<form role="form" method="post" action="<?php echo base_url();?>rps/rubah_status_rps" onsubmit="return konfirm()">
  <input type="hidden" name="id_tabel" name="id_tabel" value="<?php echo $res->id_rps;?>">
  <div class="modal-body">
    <div class="box-body">
      <div class="form-group">
        <label for="pil_status_publikasi">Status Publikasi RPS</label>
        <select class="form-control" name="pil_status_publikasi" id="pil_status_publikasi">
          <?php 
          $arr_status = array("1"=>"Tidak Terpublikasi", "2"=>"Terpublikasi");
          foreach ($arr_status as $key => $value) {
            if ($key==$res->status_rps) { ?>
              <option value="<?php echo $key;?>" selected><?php echo $value;?></option>
            <?php } else {?> 
              <option value="<?php echo $key;?>"><?php echo $value;?></option>
            <?php }
          }
          ?>
        </select>
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