<form role="form" method="post" action="<?php echo base_url();?>rps/team_teaching_rubah" onsubmit="return konfirmasi()">
  <input type="hidden" name="id_tabel" id="id_tabel" value="<?php echo $dt_rps->id_rps;?>">
  <div class="modal-body">
    <div class="box-body">
      <div class="form-group row">
          <label for="pil_tahun" class="col-sm-2 col-form-label">Kurikulum Tahun</label>
          <div class="col-sm-2">
              <select class="select2" name="pil_tahun" id="pil_tahun" style="width: 100%" disabled>
                  <?php
                  $thn_awal = 2010;
                  $thn_skr = date("Y");
                  for($i=$thn_awal; $i<=$thn_skr; $i++)
                  {
                      if($i==$dt_rps->tahun)
                      {
                          echo "<option value=".$i." selected>".$i."</option>";
                      } else {
                          echo "<option value=".$i.">".$i."</option>";
                      }
                  }
                  ?>
              </select>
          </div>
          <label for="pil_ps" class="col-sm-2 col-form-label">Program Studi</label>
          <div class="col-sm-6">
              <select class="select2" name="pil_ps" id="pil_ps" style="width: 100%" disabled>
                  <option value="0">- Pilihan Program Studi -</option>
                  <?php foreach ($list_ps as $dt_ps) { ?>
                    <?php if ($dt_ps['id_ps']==$dt_rps->id_prodi): ?>
                      <option value="<?php echo $dt_ps['id_ps'];?>" selected><?php echo $dt_ps['nama_ps'];?> (<?php echo $dt_ps['nm_jenjang'];?>)</option>
                    <?php else: ?>
                      <option value="<?php echo $dt_ps['id_ps'];?>"><?php echo $dt_ps['nama_ps'];?> (<?php echo $dt_ps['nm_jenjang'];?>)</option>
                    <?php endif ?>
                  <?php } ?>
              </select>
          </div>
      </div>
      <div class="form-group row">
          <label for="pil_matkul" class="col-sm-2 col-form-label">Mata Kuliah</label>
          <div class="col-sm-10">
              <select class="select2" name="pil_matkul" id="pil_matkul" style="width: 100%" disabled>
                <?php foreach ($list_mk as $dt_mk) { ?>
                    <?php if ($dt_mk['id_matakuliah']==$dt_rps->id_matkul): ?>
                      <option value="<?php echo $dt_mk['id_matakuliah'];?>" selected><?php echo $dt_mk['kode_matakuliah'];?> | <?php echo $dt_mk['nama_matakuliah'];?>)</option>
                    <?php else: ?>
                      <option value="<?php echo $dt_mk['id_matakuliah'];?>"><?php echo $dt_mk['kode_matakuliah'];?>| <?php echo $dt_mk['nama_matakuliah'];?>)</option>
                    <?php endif ?>
                  <?php } ?>
              </select>
          </div>
      </div>
      <div class="form-group row">
          <label for="pil_matkul" class="col-sm-2 col-form-label">Ketua Team</label>
          <div class="col-sm-10">
              <select class="form-control select2" name="pil_ketua_team" id="pil_ketua_team" data-placeholder="Pilih ketua team" style="width: 100%;">
                  <option value="0">- Pilihan -</option>
                  <?php foreach ($list_dosen as $dt_dsn) { ?>
                    <?php if ($dt_dsn['id_dosen']==$dt_rps->ketua_team): ?>
                      <option value="<?php echo $dt_dsn['id_dosen'];?>" selected><?php echo $dt_dsn['nidn'];?> | <?php echo $dt_dsn['nama_dosen'];?></option>
                    <?php else: ?>
                      <option value="<?php echo $dt_dsn['id_dosen'];?>"><?php echo $dt_dsn['nidn'];?> | <?php echo $dt_dsn['nama_dosen'];?></option>
                    <?php endif ?>
                  <?php } ?>
              </select>
          </div>
      </div>
      <div class="form-group">
        <label for="pil_anggota_team">Anggota</label>
        <select class="form-control select2" name="pil_anggota_team[]" id="pil_anggota_team" multiple="multiple" data-placeholder="Pilih anggota team" style="width: 100%;">
            <option value="0">- Pilihan -</option>
            <?php 
            $arr_dosen = explode(",", $dt_rps->id_dosen);
            for ($i=0; $i < count($arr_dosen); $i++) 
            { 
              $all_dosen[] = $arr_dosen[$i];
            } 
            ?>
            <?php foreach ($list_dosen as $dt_dsn) { ?>
                <option value="<?php echo $dt_dsn['id_dosen'];?>" 
                <?php
                foreach ($all_dosen as $key => $pil) 
                {
                    if($dt_dsn['id_dosen']==$pil) 
                    {
                        echo "selected";
                    }
                }
                ?>
                ><?php echo $dt_dsn['nidn'];?> | <?php echo $dt_dsn['nama_dosen'];?></option>
            <?php } ?>
        </select>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
    <button type="submit" class="btn btn-outline" id="tbl_simpan">Simpan Data</button>
  </div>
</form>
<script type="text/javascript">
  $(document).ready(function()
  {
    $('.select2').select2();

  });
  function konfirmasi()
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