<form role="form" method="post" action="<?php echo base_url();?>opsi/kabupaten_rubah" onsubmit="return konfirm()">
  <input type="hidden" name="id_tabel" name="id_tabel" value="<?php echo $res->id;?>">
  <div class="modal-body">
    <div class="box-body">
        <div class="form-group">
            <label for="nm_provinsi">Nama Provinsi</label>
            <select id="nm_provinsi" name="nm_provinsi" class="form-control select2" style="width: 100%;">
            <?php foreach($res_provinsi as $list) { 
                if($list['id'] == $res->id_provinsi) { ?>
                <option value="<?php echo $list['id'];?>" selected><?php echo $list['nama_provinsi'];?></option>
                <?php
                } else { ?>
                <option value="<?php echo $list['id'];?>"><?php echo $list['nama_provinsi'];?></option> 
            <?php }
            } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="nm_kabupaten">Nama Kabupaten/Kota</label>
            <input type="text" name="nm_kabupaten" id="nm_kabupaten" class="form-control" maxlength="100" value="<?php echo $res->nama_kabupaten;?>" required>
        </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
    <button type="submit" class="btn btn-outline">Simpan Data</button>
  </div>
</form>
<script type="text/javascript">
    $(document).ready(function() 
    {
        $('.select2').select2();
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