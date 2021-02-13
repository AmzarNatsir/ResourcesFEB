<form role="form" method="post" action="<?php echo base_url();?>opsi/kelurahan_simpan" onsubmit="return konfirm()">
<input type="hidden" name="id_provinsi" value="<?php echo $res_kecamatan->id_provinsi;?>">
<input type="hidden" name="id_kabupaten" value="<?php echo $res_kecamatan->id_kabupaten;?>">
<input type="hidden" name="id_kecamatan" value="<?php echo $res_kecamatan->id;?>">
<div class="modal-body">
<div class="box-body">
    <div class="form-group">
        <label for="nm_provinsi">Nama Provinsi</label>
        <input type="text" name="nm_provinsi" id="nm_provinsi" class="form-control" value="<?php echo $res_kecamatan->nama_provinsi;?>" readonly>
    </div>
    <div class="form-group">
        <label for="nm_kabupaten">Nama Kabupaten/Kota</label>
        <input type="text" name="nm_kabupaten" id="nm_kabupaten" class="form-control" value="<?php echo $res_kecamatan->nama_kabupaten;?>" readonly>
    </div>
    <div class="form-group">
        <label for="nm_kecamatan">Nama Kecamatan</label>
        <input type="text" name="nm_kecamatan" id="nm_kecamatan" class="form-control" value="<?php echo $res_kecamatan->nama_kecamatan;?>" readonly>
    </div>
    <div class="form-group">
        <label for="nm_kelurahan">Nama Kelurahan</label>
        <input type="text" name="nm_kelurahan" id="nm_kelurahan" class="form-control" maxlength="100" required>
    </div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
<button type="submit" class="btn btn-outline">Simpan Data</button>
</div>
</form>