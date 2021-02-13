<form role="form" method="post" action="<?php echo base_url();?>opsi/kecamatan_rubah" onsubmit="return konfirm()">
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
            <label for="nm_kabupaten">Nama Kabupaten</label>
            <select id="nm_kabupaten" name="nm_kabupaten" class="form-control select2" style="width: 100%;">
            <?php foreach($res_kabupaten as $kab) { 
                if($kab['id'] == $res->id_kabupaten) { ?>
                <option value="<?php echo $kab['id'];?>" selected><?php echo $kab['nama_kabupaten'];?></option>
                <?php
                } else { ?>
                <option value="<?php echo $kab['id'];?>"><?php echo $kab['nama_kabupaten'];?></option> 
            <?php }
            } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="nm_kecamatan">Nama Kecamatan</label>
            <input type="text" name="nm_kecamatan" id="nm_kecamatan" class="form-control" maxlength="100" value="<?php echo $res->nama_kecamatan;?>" required>
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
        $("#nm_provinsi").on("change", function() {
            var id_provinsi = $("#nm_provinsi").val();
            $("#nm_kabupaten").load("<?php echo base_url();?>opsi/filter_kabupaten/"+id_provinsi);
        });
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