<form role="form" method="post" action="<?php echo base_url();?>home/rubah_akun_dosen" onsubmit="return konfirm()">
  <div class="modal-body">
    <input type="hidden" name="id_akun" id="id_akun" value="<?php echo $profil_akun->id;?>">
    <div class="box-body">
      <div class="form-group row">
        <label for="inp_nidn" class="col-sm-2 col-form-label">NIDN</label>
        <div class="col-sm-10">
          <input type="text" name="inp_nidn" id="inp_nidn" class="form-control" value="<?php echo $profil_akun->nidn;?>" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="inp_nama" class="col-sm-2 col-form-label">Nama Dosen</label>
        <div class="col-sm-10">
          <input type="text" name="inp_nama" id="inp_nama" class="form-control" value="<?php echo $profil_akun->nama_dosen;?>" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="inp_email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" name="inp_email" id="inp_email" class="form-control" value="<?php echo $profil_akun->email;?>" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="inp_passwd" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="password" name="inp_passwd" id="inp_passwd" class="form-control" maxlength="20" required>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
    <button type="submit" class="btn btn-outline" id="tbl_simpan">Simpan Data</button>
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