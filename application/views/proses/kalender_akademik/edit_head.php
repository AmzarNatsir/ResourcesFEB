<form action="<?php echo base_url();?>kalender_akademik/rubah_data_head" method="post" onsubmit="return konfirm()" enctype="multipart/form-data">
  <input type="hidden" name="id_head" id="id_head" value="<?php echo $head->id;?>">
  <div class="modal-body">
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Tahun Akademik</label>
      <div class="col-sm-2">
        <input type="text" class="form-control mask_ta" name="inp_ta" id="inp_ta" value="<?php echo $head->ta;?>" maxlength="9" required>
      </div>
      <label class="col-sm-2 col-form-label">Semester</label>
      <div class="col-sm-2">
        <select class="form-control" id="pil_semester" name="pil_semester">
          <?php $arr_sms = array('1' => 'Ganjil', '2' => 'Genap');
          foreach ($arr_sms as $key => $sms) {
            if($key==$head->semester)
            {
              echo "<option value=".$key." selected>".$sms."</option>";
            } else {
              echo "<option value=".$key.">".$sms."</option>";
            }
          } ?>
        </select>
      </div>
      <label class="col-sm-2 col-form-label">Aktif/Tidak Aktif</label>
      <div class="col-sm-2">
        <select class="form-control" id="pil_aktif" name="pil_aktif">
          <?php $arr_aktif = array('1' => 'Aktif', '2' => 'Tidak Aktif');
          foreach ($arr_aktif as $key => $aktif) {
            if($key==$head->status)
            {
              echo "<option value=".$key." selected>".$aktif."</option>";
            } else {
              echo "<option value=".$key.">".$aktif."</option>";
            }
          } ?>
        </select>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
    <button type="submit" class="btn btn-outline">Simpan Data</button>
  </div>
</form>