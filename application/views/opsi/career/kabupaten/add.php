<form role="form" method="post" action="<?php echo base_url();?>opsi/kabupaten_simpan" onsubmit="return konfirm()">
<input type="hidden" name="id_provinsi" value="<?php echo $res_provinsi->id;?>">
<div class="modal-body">
<div class="box-body">
    <div class="form-group">
        <label for="nm_provinsi">Nama Provinsi</label>
        <input type="text" name="nm_provinsi" id="nm_provinsi" class="form-control" value="<?php echo $res_provinsi->nama_provinsi;?>" readonly>
    </div>
    <div class="form-group">
        <label for="nm_kabupaten">Nama Kabupaten/Kota</label>
        <input type="text" name="nm_kabupaten" id="nm_kabupaten" class="form-control" maxlength="100" required>
    </div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
<button type="submit" class="btn btn-outline">Simpan Data</button>
</div>
</form>