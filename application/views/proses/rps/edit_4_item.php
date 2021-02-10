<form id="form_inp" name="form_inp">
    <input type="hidden" name="id_tabel" id="id_tabel" value="<?php echo $dt_matriks->id_rps_matriks;?>">
    <input type="hidden" name="id_rps" id="id_rps" value="<?php echo encrypt_decrypt('encrypt', $dt_matriks->id_rps);?>">
    <input type="hidden" name="kat_item" id="kat_item" value="<?php echo $dt_matriks->sub;?>">
    <div class="form-group py-2">
        <div class="icheck-material-white">
            <input type="checkbox" id="check_sub_item" disabled>
                <label for="check_sub_item">Sub Item</label>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-12 col-form-label">1. Pertemuan Ke-<?php echo $dt_matriks->pertemuan_ke;?></label>
        <input type="hidden" name="pertemuan_ke" id="pertemuan_ke" class="form-control" value="<?php echo $dt_matriks->pertemuan_ke;?>">
    </div>
    <div id="sub_item" style="display: none">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">2. Nama Sub Item</label>
            <div class="col-sm-9">
                <input type="text" name="inp_nama_sub_item" id="inp_nama_sub_item" class="form-control" maxlength="100" value="<?php echo $dt_matriks->nama_sub;?>">
            </div>
        </div>
    </div>
    <div id="not_sub_item">
        <div class="form-group row">
            <label class="col-sm-12 col-form-label">2. Sub-CP-MK (sbg kemampuan akhir yg diharapkan)</label>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
              <textarea name="desk_capaian_belajar" id="desk_capaian_belajar" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #000; padding: 10px;"><?php echo $dt_matriks->capaian_pembelajaran;?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-form-label">3. Indiator Penilaian</label>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
              <textarea name="desk_indikator_penilaian" id="desk_indikator_penilaian" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #000; padding: 10px;"><?php echo $dt_matriks->indikator_penilaian;?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-form-label">4. Kriteria & Bentuk Penilaian</label>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
              <textarea name="desk_teknik_penilaian" id="desk_teknik_penilaian" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #000; padding: 10px;"><?php echo $dt_matriks->teknik_penilaian;?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-form-label">5. Metode Pembelajaran</label>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
              <textarea name="desk_metode_belajar" id="desk_metode_belajar" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #000; padding: 10px;"><?php echo $dt_matriks->metode_pembelajaran;?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-form-label">6. Materi Pembelajaran</label>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
              <textarea name="desk_bahasan_kajian" id="desk_bahasan_kajian" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #000; padding: 10px;"><?php echo $dt_matriks->bahasan_kajian;?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-10 col-form-label">7. Bobot Penilaian (%)</label>
            <div class="col-sm-2">
                <input type="text" name="inp_bobot_tagihan" id="inp_bobot_tagihan" class="form-control angka" maxlength="3" value="<?php echo $dt_matriks->bobot_tagihan;?>">
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
  $(document).ready(function()
  {
    CKEDITOR.replace('desk_capaian_belajar');
    CKEDITOR.replace('desk_indikator_penilaian');
    CKEDITOR.replace('desk_teknik_penilaian');
    CKEDITOR.replace('desk_metode_belajar');
    CKEDITOR.replace('desk_bahasan_kajian');
    $(".angka").number(true, 0);
    var sts_sub = $("#kat_item").val();
    //alert(sts_sub);
    if(sts_sub==1)
    {
      $("#check_sub_item").prop("checked", true);
      $("#not_sub_item").hide();
      $("#sub_item").show();
    } else {
      $("#check_sub_item").prop("checked", false);
      $("#not_sub_item").show();
      $("#sub_item").hide();
    }
    $("#check_sub_item").on("click", function()
    {
        var sts_check = $("#check_sub_item").prop("checked");
        if(sts_check==true)
        {
            $("#not_sub_item").hide();
            $("#sub_item").show();
        } else {
            $("#not_sub_item").show();
            $("#sub_item").hide();
        }
        
    });
   $(".tbl_simpan").on("click", function()
    {
      var sts_simpan = "n";
      var pil_sub_item = $("#check_sub_item").prop("checked");
      var id_rps = $("#id_rps").val();
      var id_matriks = $("#id_tabel").val();
      var nama_sub = $("#inp_nama_sub_item").val();
      var nom_pertemuan = $("#pertemuan_ke").val();
      var capaian = CKEDITOR.instances['desk_capaian_belajar'].getData(); // $("#desk_capaian_belajar").val();
      var bahasan = CKEDITOR.instances['desk_bahasan_kajian'].getData(); //$("#desk_bahasan_kajian").val();
      var metode = CKEDITOR.instances['desk_metode_belajar'].getData(); //$("#desk_metode_belajar").val();
      var indikator_penilaian = CKEDITOR.instances['desk_indikator_penilaian'].getData(); //$("#desk_indikator_penilaian").val();
      var teknik_penilaian = CKEDITOR.instances['desk_teknik_penilaian'].getData(); //$("#desk_teknik_penilaian").val();
      var bobot_tagihan = $("#inp_bobot_tagihan").val();
      if(pil_sub_item==true)
      {
          if(nama_sub.length<5)
          {
              alert("Kolom inputan nama sub item minimal 5 karakter atau tidak boleh kosong");
              sts_simpan="n";
              return false;
          }
          else {
              sts_simpan="y";
          }
      } else {
          if(capaian.length<10)
          {
              alert("Kolom inputan deskripsi capaian pembelajaran minimal 10 karakter atau tidak boleh kosong");
              sts_simpan="n";
              return false;
          } else if(bahasan.length<10)
          {
              alert("Kolom inputan deskripsi materi pembelajaran minimal 10 karakter atau tidak boleh kosong");
              sts_simpan="n";
              return false;
          } else if(indikator_penilaian.length<10)
          {
              alert("Kolom inputan indikator penilaian minimal 10 karakter atau tidak boleh kosong");
              sts_simpan="n";
              return false;
          } else if(teknik_penilaian.length<10)
          {
              alert("Kolom inputan bentuk penilaian minimal 10 karakter atau tidak boleh kosong");
              sts_simpan="n";
              return false;
          } else if(metode.length<10)
          {
              alert("Kolom inputan metode pembelajaran minimal 10 karakter atau tidak boleh kosong");
              sts_simpan="n";
              return false;
          } else if(bobot_tagihan==0)
          {
              alert("Kolom inputan bobot penilaian tidak boleh null");
              sts_simpan="n";
              return false;
          } else {
              sts_simpan="y";
          }
      }
      
      if(sts_simpan=="n")  
      {
          return false;
      } else {
          var pesan = confirm("Yakin akan menyimpan data ?");
          if(pesan==true)
          {
              $.ajax (
              {
                  url : "<?php echo site_url();?>rps/rubah_matriks_pembelajaran_baris",
                  type : "post",
                  data : {id_rps:id_rps, id_matriks:id_matriks, pil_sub_item:pil_sub_item, nom_pertemuan:nom_pertemuan, nama_sub:nama_sub, capaian:capaian, bahasan:bahasan, metode:metode, indikator_penilaian:indikator_penilaian, teknik_penilaian:teknik_penilaian, bobot_tagihan:bobot_tagihan},
                  success : function(d)
                  {
                      if(d==1)
                      {
                          alert("Data matriks rencana pembelajaran berhasil disimpan.");
                          window.location.assign("<?php echo base_url();?>rps/edit_matriks_pembelajaran/"+id_rps);
                      } else {
                          alert("Data matriks rencana pembelajaran gagal disimpan.");
                          return false;
                      }
                  }
               });
              
          } else {
              return false;
          }
      }
    });
  });
</script>