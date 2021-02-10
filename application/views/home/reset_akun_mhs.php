<form role="form" method="post" action="<?php echo base_url();?>home/simpan_akun_baru_mahasiswa" onsubmit="return konfirm()">
  <input type="hidden" name="id_tabel" name="id_tabel" value="<?php echo $res->id;?>">
  <div class="modal-body">
    <div class="box-body">
      <div class="form-group">
        <label for="inp_nim">NIM</label>
        <input type="text" class="form-control" name="inp_nim" id="inp_nim" value="<?php echo $res->nim;?>" required>
      </div>
      <div class="form-group">
        <label for="inp_nama">Nama Mahasiswa</label>
        <input type="text" class="form-control" name="inp_nama" id="inp_nama" value="<?php echo $res->nama_mahasiswa;?>" readonly>
      </div>
      <div class="form-group">
        <label for="inp_email">Email</label>
        <input type="email" class="form-control" name="inp_email" id="inp_email" value="<?php echo $res->email;?>" readonly>
      </div>
      <div class="form-group">
        <label for="inp_passwd">Password Baru</label>
        <input type="password" class="form-control" name="inp_passwd" id="inp_passwd" maxlength="20" required>
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