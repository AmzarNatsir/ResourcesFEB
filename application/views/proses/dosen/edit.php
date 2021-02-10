<form role="form" method="post" action="<?php echo base_url();?>dosen/rubah_data" onsubmit="return konfirm()">
  <input type="hidden" name="id_tabel" name="id_tabel" value="<?php echo $profil->id_dosen;?>">
  <div class="modal-body">
    <div class="box-body">
      <div class="form-group row">
        <label for="inp_nidn" class="col-sm-2 col-form-label">NIDN</label>
        <div class="col-sm-10">
          <input type="text" name="inp_nidn" id="inp_nidn" class="form-control" maxlength="20" value="<?php echo $profil->nidn;?>" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="inp_nip" class="col-sm-2 col-form-label">NIP</label>
        <div class="col-sm-10">
          <input type="text" name="inp_nip" id="inp_nip" class="form-control" maxlength="20" value="<?php echo $profil->nip;?>">
        </div>
      </div>
      <div class="form-group row">
        <label for="inp_nbm" class="col-sm-2 col-form-label">NBM</label>
        <div class="col-sm-10">
          <input type="text" name="inp_nbm" id="inp_nbm" class="form-control" maxlength="20" value="<?php echo $profil->nbm;?>">
        </div>
      </div>
      <div class="form-group row">
        <label for="inp_nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
        <div class="col-sm-10">
          <input type="text" name="inp_nama" id="inp_nama" class="form-control" maxlength="200" value="<?php echo $profil->nama_dosen;?>" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="pil_jabfung" class="col-sm-2 col-form-label">Jabatan Fungsional</label>
        <div class="col-sm-10">
          <select class="form-control select2" name="pil_jabfung" id="pil_jabfung" required style="width: 100%">
              <option value="0">Pilihan</option>
              <?php foreach ($list_jabfung as $dt_jabfung): ?>
                <?php if ($dt_jabfung['id_jabfung']==$profil->jabatan_fungsional): ?>
                  <option value="<?php echo $dt_jabfung['id_jabfung'];?>" selected><?php echo $dt_jabfung['nama_jabfung'];?></option>
                <?php else: ?>
                  <option value="<?php echo $dt_jabfung['id_jabfung'];?>"><?php echo $dt_jabfung['nama_jabfung'];?></option>
                <?php endif ?>    
              <?php endforeach ?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="pil_jabakademik" class="col-sm-2 col-form-label">Jabatan Akademik</label>
        <div class="col-sm-10">
          <select class="form-control select2" name="pil_jabakademik" id="pil_jabakademik" required style="width: 100%">
              <option value="0">Pilihan</option>
              <?php foreach ($list_jabakademik as $dt_jabaka): ?>
                <?php if ($dt_jabaka['id_jabatan']==$profil->jabatan_akademik): ?>
                  <option value="<?php echo $dt_jabaka['id_jabatan'];?>" selected><?php echo $dt_jabaka['nama_jabatan'];?></option>
                <?php else: ?>
                  <option value="<?php echo $dt_jabaka['id_jabatan'];?>"><?php echo $dt_jabaka['nama_jabatan'];?></option>
                <?php endif ?>    
              <?php endforeach ?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="inp_link_photo" class="col-sm-2 col-form-label">Link Photo</label>
        <div class="col-sm-10">
          <input type="text" name="inp_link_photo" id="inp_link_photo" class="form-control" value="<?php echo $profil->link_image;?>" maxlength="200">
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
    <button type="submit" class="btn btn-outline">Simpan Data</button>
  </div>
</form>
<script type="text/javascript">
  $('.select2').select2();
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