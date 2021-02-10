<form role="form" method="post">
  <input type="hidden" name="id_cpmk" id="id_cpmk" value="<?php echo $res_cpmk->id_cpmk;?>">
  <input type="hidden" name="id_rps" id="id_rps" value="<?php echo encrypt_decrypt('encrypt', $res_cpmk->id_rps);?>">
  <div class="modal-body">
    <div class="box-body">
      <div class="form-group">
        <label for="nomor_urut">Nomor Urut</label>
        <input type="text" class="form-control" id="nomor_urut" name="nomor_urut" value="<?php echo $res_cpmk->no_urut;?>" readonly style="width: 150px">
      </div>
      <div class="form-group">
        <label for="inp_deskripsi">Deskripsi</label>
        <textarea class="form-control" id="inp_deskripsi" name="inp_deskripsi" required><?php echo $res_cpmk->deskripsi   ;?></textarea>
      </div>
      <div class="form-group">
        <label>A. Aspek Sikap (S)</label>
        <select class="select2" id="pil_unsur_sikap" name="pil_unsur_sikap[]" multiple="multiple" data-placeholder="Pilih aspek sikap" style="width: 100%;">
          <?php foreach ($list_aspek_sikap as $dt_ak) { ?>
          <option value="<?php echo $dt_ak['id_sikap'];?>" 
            <?php
            foreach ($pil_unsur_s as $key => $pil) 
            {
                if($dt_ak['id_sikap']==$pil) 
                {
                    echo "selected";
                }
            }
            ?>
            >(S<?php echo $dt_ak['no_urut'];?>). <?php echo $dt_ak['aspek_sikap'];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label>B. Aspek Pengetahuan (P)</label>
        <select class="select2" id="pil_unsur_pengetahuan" name="pil_unsur_pengetahuan[]" multiple="multiple" data-placeholder="Pilih aspek pengetahuan" style="width: 100%;">
        <?php foreach ($list_aspek_pengetahuan as $dt_ap) { ?>
            <option value="<?php echo $dt_ap['id_pengetahuan'];?>" 
            <?php
            foreach ($pil_unsur_p as $key => $pil) 
            {
                if($dt_ap['id_pengetahuan']==$pil) 
                {
                    echo "selected";
                }
            }
            ?>
            >(P<?php echo $dt_ap['no_urut'];?>). <?php echo $dt_ap['aspek_pengetahuan'];?></option>
        <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label>C. Aspek Keterampilan Umum (KU)</label>
        <select class="select2" id="pil_unsur_keterampilan_umum" name="pil_unsur_keterampilan_umum[]" multiple="multiple" data-placeholder="Pilih aspek keterampilan umum" style="width: 100%;">
        <?php foreach ($list_aspek_ku as $dt_ku) { ?>
            <option value="<?php echo $dt_ku['id_ku'];?>" \
            <?php
            foreach ($pil_unsur_ku as $key => $pil) 
            {
                if($dt_ku['id_ku']==$pil) 
                {
                    echo "selected";
                }
            }
            ?>
            >(KU<?php echo $dt_ku['no_urut'];?>). <?php echo $dt_ku['keterampilan_umum'];?></option>
        <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label>D. Aspek Keterampilan Khusus (KK)</label>
        <select class="select2" id="pil_unsur_keterampilan_khusus" name="pil_unsur_keterampilan_khusus[]" multiple="multiple" data-placeholder="Pilih aspek keterampilan khusus" style="width: 100%;">
        <?php foreach ($list_aspek_kk as $dt_kk) { ?>
            <option value="<?php echo $dt_kk['id_kk'];?>" 
            <?php
            foreach ($pil_unsur_kk as $key => $pil) 
            {
                if($dt_kk['id_kk']==$pil) 
                {
                    echo "selected";
                }
            }
            ?>
            >(KK<?php echo $dt_kk['no_urut'];?>). <?php echo $dt_kk['keterampilan_khusus'];?></option>
        <?php } ?>
        </select>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
    <button type="button" class="btn btn-outline tbl_simpan">Simpan Data</button>
  </div>
</form>
<script type="text/javascript">
  $(document).ready(function()
  {
    $('.select2').select2();
    $(".tbl_simpan").on("click", function()
    {
        var id_rps = $("#id_rps").val();
        var id_cpmk = $("#id_cpmk").val();
        var inp_deskripsi = $("#inp_deskripsi").val();
        var pil_u_sikap = $("#pil_unsur_sikap").val();
        var pil_u_pengetahuan = $("#pil_unsur_pengetahuan").val();
        var pil_u_ku = $("#pil_unsur_keterampilan_umum").val();
        var pil_u_kk = $("#pil_unsur_keterampilan_khusus").val();
        if(inp_deskripsi.length<10)
        {
            alert("Kolom inputan deskripsi CP-Matakuliah tidak boleh kosong");
            return false;
        } else {
            var pesan = confirm("Yakin akan menyimpan data ?");
            if(pesan==true)
            {
                $.ajax (
                {
                    url : "<?php echo site_url();?>rps/rubah_cp_mk",
                    type : "post",
                    data : {id_cpmk:id_cpmk, inp_deskripsi:inp_deskripsi, pil_u_sikap:pil_u_sikap.join(), pil_u_pengetahuan:pil_u_pengetahuan.join(), pil_u_ku:pil_u_ku.join(), pil_u_kk:pil_u_kk.join()},
                    success : function(d)
                    {
                        alert(d);
                        window.location.assign("<?php echo base_url();?>rps/edit_capaian_pembelajaran/"+id_rps);
                    }
                 });
                
            } else {
                return false;
            }
        }
        
    });
  });
</script>