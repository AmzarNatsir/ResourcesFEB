<form role="form" method="post" action="<?php echo base_url();?>home/rubah_akun_mahasiswa" onsubmit="return konfirm()">
  <input type="hidden" name="id_tabel" name="id_tabel" value="<?php echo $res->id;?>">
  <div class="modal-body">
    <div class="box-body">
      <div class="form-group">
        <label for="nomor_urut">Status Akun</label>
        <select class="form-control custom-select" name="pil_status" id="pil_status">
          <?php
          $arr_sts = array('0' => 'Belum Aktif' , '1' => 'Aktif', '2' => 'Tidak Aktif');
          foreach ($arr_sts as $key => $value) {
            if($key==$res->status)
            { ?>
              <option value="<?php echo $key;?>" selected><?php echo $value;?></option>
            <?php } else { ?>
              <option value="<?php echo $key;?>"><?php echo $value;?></option>
            <?php 
            }
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