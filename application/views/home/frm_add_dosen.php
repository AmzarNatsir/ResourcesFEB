<form role="form" method="post" action="<?php echo base_url();?>home/simpan_akun_dosen" onsubmit="return konfirm()">
  <div class="modal-body">
    <div class="box-body">
      <div class="form-group row">
        <label for="pil_dosen" class="col-sm-2 col-form-label">Pilih Dosen</label>
        <div class="col-sm-10">
          <select class="form-control select2" name="pil_dosen" id="pil_dosen" style="width: 100%">
            <option value="0">- Pilihan Dosen -</option>
            <?php foreach ($all_dosen as $dsn): ?>
            <option value="<?= $dsn['id_dosen'].'#'.$dsn['nidn']; ?>"><?= $dsn['nidn']." | ".$dsn['nama_dosen']; ?></option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="inp_nidn" class="col-sm-2 col-form-label">NIDN</label>
        <div class="col-sm-10">
          <input type="text" name="inp_nidn" id="inp_nidn" class="form-control" readonly>
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
  $("#pil_dosen").on("change", function()
  {
    var v_pil = $("#pil_dosen").val();
    var arr_pil = v_pil.split("#");
    $("#inp_email").val("");
    $("#inp_passwd").val("");
    $("#inp_nidn").val("");
    if(v_pil!=0)
    {
      if(arr_pil[1]=="")
      {
        alert("NIDN Dosen yang anda pilih masih kosong.");
        return false;
      }
      $.ajax (
      {
          url : "<?php echo site_url();?>home/cari_akun_dosen",
          type : "post",
          data : {nidn:arr_pil[1]},
          success : function(d)
          {
              var result = d;
              if(result==1)
              {
                alert("Akun Dosen sudah terdaftar. Silahkan periksa di daftar akun aktif");
                $("#inp_email").attr("disabled", true);
                $("#inp_passwd").attr("disabled", true);
                $("#tbl_simpan").attr("disabled", true);

              } else {
                $("#inp_nidn").val(arr_pil[1]);
                $("#inp_email").attr("disabled", false);
                $("#inp_passwd").attr("disabled", false);
                $("#tbl_simpan").attr("disabled", false);
              }
          }
       });
    } else {
      alert("Silahkan pilih dosen");
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