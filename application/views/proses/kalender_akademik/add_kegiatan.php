<form action="<?php echo base_url();?>kalender_akademik/simpan_detail" method="post" onsubmit="return konfirm()" enctype="multipart/form-data">
  <div class="modal-body">
    <input type="hidden" name="id_head" id="id_head" value="<?php echo $id_head;?>">
    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Tanggal Pelaksanaan</label>
      <div class="col-sm-9">
        <div class="form-group">
            <div class="input-group input-daterange" data-date-format="mm/dd/yyyy">
                <input type="text" id="tgl_start" name="tgl_start" class="form-control text-center" placeholder="Tanggal Mulai">
                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                <input type="text" id="tgl_end" name="tgl_end" class="form-control text-center" placeholder="Tanggal Selesai">
            </div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="inp_deskripsi">Deskripsi Kegiatan</label>
      <textarea name="inp_deskripsi" id="inp_deskripsi" class="form-control" required></textarea>
    </div>
    <div class="form-group">
      <label for="inp_warna">Warna Latar belakang (Color Hex : #FFFFFF)</label>
      <input type="text" name="inp_warna" id="inp_warna" class="form-control" maxlength="50" required>
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
    $('.input-datepicker, .input-daterange').datepicker({weekStart: 1, format:'dd/mm/yyyy'});
        $('.input-datepicker-close').datepicker({weekStart: 1}).on('changeDate', function(e){ $(this).datepicker('hide'); });
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