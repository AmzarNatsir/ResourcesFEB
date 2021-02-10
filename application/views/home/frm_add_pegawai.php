<form role="form" method="post" action="<?php echo base_url();?>home/simpan_akun_pegawai" onsubmit="return konfirm()">
  <div class="modal-body">
    <div class="box-body">
      <div class="form-group row">
        <label for="pil_dosen" class="col-sm-2 col-form-label">Pilih Pegawai</label>
        <div class="col-sm-10">
          <select class="form-control select2" name="pil_pegawai" id="pil_pegawai" style="width: 100%">
            <option value="0">- Pilihan Pegawai -</option>
            <?php foreach ($all_pegawai as $pegawai): ?>
            <option value="<?= $pegawai['id_pegawai'].'#'.$pegawai['NIP/ No Induk']; ?>"><?= $pegawai['NIP/ No Induk']." | ".$pegawai['nama_pegawai']; ?></option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="inp_nidn" class="col-sm-2 col-form-label">Nomor Induk</label>
        <div class="col-sm-10">
          <input type="text" name="inp_nomor_induk" id="inp_nomor_induk" class="form-control" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="inp_email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" name="inp_email" id="inp_email" class="form-control" disabled required>
        </div>
      </div>
      <div class="form-group row">
        <label for="inp_passwd" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="password" name="inp_passwd" id="inp_passwd" class="form-control" maxlength="20" disabled required>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
    <button type="submit" class="btn btn-outline" id="tbl_simpan" disabled>Simpan Data</button>
  </div>
</form>
<script type="text/javascript">
  $('.select2').select2();
  $("#pil_pegawai").on("change", function()
  {
    var v_pil = $("#pil_pegawai").val();
    var arr_pil = v_pil.split("#");
    $("#inp_email").val("");
    $("#inp_passwd").val("");
    $("#inp_nomor_induk").val("");
    if(v_pil!=0)
    {
      if(arr_pil[1]=="")
      {
        alert("Nomor Induk Pegawai yang anda pilih masih kosong.");
        return false;
      }
      $.ajax (
      {
          url : "<?php echo site_url();?>home/cari_akun_pegawai",
          type : "post",
          data : {id_pegawai:arr_pil[0]},
          success : function(d)
          {
              var result = d;
              if(result==1)
              {
                alert("Akun Pegawai sudah terdaftar. Silahkan periksa di daftar akun aktif");
                $("#inp_email").attr("disabled", true);
                $("#inp_passwd").attr("disabled", true);
                $("#tbl_simpan").attr("disabled", true);

              } else {
                $("#inp_nomor_induk").val(arr_pil[1]);
                $("#inp_email").attr("disabled", false);
                $("#inp_passwd").attr("disabled", false);
                $("#tbl_simpan").attr("disabled", false);
              }
          }
       });
    } else {
      alert("Silahkan pilih Pegawai");
      $("#inp_email").attr("disabled", true);
      $("#inp_passwd").attr("disabled", true);
      $("#tbl_simpan").attr("disabled", true);
      return false;
    }
    
    //alert(arr_pil[1]);
  });
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