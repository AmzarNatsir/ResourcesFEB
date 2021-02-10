<div class="content-wrapper">
  <section class="content-header">
    <h1>Penyusunan <small>Rencana Pembelajaran Semester (RPS)</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>Home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Rencana Pembelajaran Semester (RPS)</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Identitas Matakuliah</h3>
          </div>
          <div class="box-body">
            <form id="form_inp" name="form_inp">
                <div class="form-group row">
                    <label for="pil_tahun" class="col-sm-2 col-form-label">Kurikulum Tahun</label>
                    <div class="col-sm-10">
                        <select class="select2" name="pil_tahun" id="pil_tahun" style="width: 100%">
                            <?php
                            $thn_awal = 2010;
                            $thn_skr = date("Y");
                            for($i=$thn_awal; $i<=$thn_skr; $i++)
                            {
                                if($i==$thn_skr)
                                {
                                    echo "<option value=".$i." selected>".$i."</option>";
                                } else {
                                    echo "<option value=".$i.">".$i."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pil_ps" class="col-sm-2 col-form-label">Program Studi *</label>
                    <div class="col-sm-10">
                        <select class="select2" name="pil_ps" id="pil_ps" style="width: 100%">
                            <option value="0">- Pilihan Program Studi -</option>
                            <?php foreach ($list_ps as $dt_ps) { ?>
                                <option value="<?php echo $dt_ps['id_ps'];?>"><?php echo $dt_ps['nama_ps'];?> (<?php echo $dt_ps['nm_jenjang'];?>)</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pil_matkul" class="col-sm-2 col-form-label">Mata Kuliah *</label>
                    <div class="col-sm-10">
                        <select class="select2" name="pil_matkul" id="pil_matkul" style="width: 100%"></select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pil_matkul" class="col-sm-2 col-form-label">Kode</label>
                    <div class="col-sm-2">
                        <input type="text" name="kode_mk" id="kode_mk" class="form-control" disabled>
                    </div>
                    <label for="pil_matkul" class="col-sm-2 col-form-label">Jumlah SKS</label>
                    <div class="col-sm-2">
                        <input type="text" name="jumlah_sks" id="jumlah_sks" class="form-control" disabled>
                    </div>
                    <label for="pil_matkul" class="col-sm-2 col-form-label">Semester</label>
                    <div class="col-sm-2">
                        <input type="text" name="semester" id="semester" class="form-control" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pil_dosen" class="col-sm-2 col-form-label">Team Teaching *</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" name="pil_dosen[]" id="pil_dosen" multiple="multiple" data-placeholder="Pilih dosen" style="width: 100%;">
                          <option value="0">- Pilihan Dosen -</option>
                          <?php foreach ($list_dosen as $dt_dsn) { ?>
                              <option value="<?php echo $dt_dsn['id_dosen'];?>"><?php echo $dt_dsn['nidn'];?> | <?php echo $dt_dsn['nama_dosen'];?></option>
                          <?php } ?>
                      </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="desk_matkul" class="col-sm-12 col-form-label">Deskripsi Mata Kuliah *</label>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <textarea name="desk_matkul" id="desk_matkul" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #000; padding: 10px;"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="desk_matkul" class="col-sm-12 col-form-label">Materi Pembelajaran/Pokok Bahasan *</label>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <textarea name="desk_materi" id="desk_materi" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #000; padding: 10px;"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pil_pustakan_utama" class="col-sm-3 col-form-label">Pustaka (Utama)</label>
                    <div class="col-sm-9">
                        <select class="select2" id="pil_pustakan_utama" name="pil_pustakan_utama[]" multiple="multiple" data-placeholder="Pilihan Pustaka" style="width: 100%;">
                          <?php foreach ($list_referensi as $dt_ref) { ?>
                            <option value="<?php echo $dt_ref['id_rps_referensi'];?>">
                            <?php if ($dt_ref['id_kategori']==1): ?>
                                <?php echo $dt_ref['penulis'];?>, <?php echo $dt_ref['judul'];?>,<?php echo $dt_ref['tahun'];?>, <?php echo $dt_ref['penerbit'];?>, ISBN : <?php echo $dt_ref['isbn'];?> (Kategori : Buku)
                            <?php elseif ($dt_ref['id_kategori']==2) : ?>
                                <?php echo $dt_ref['penulis'];?>, <?php echo $dt_ref['judul'];?>, <?php echo $dt_ref['tahun'];?>, <?php echo $dt_ref['nama_jurnal'];?>, ISSN : <?php echo $dt_ref['issn'];?> (Kategori : Jurnal)
                            <?php else : ?>
                                <?php echo $dt_ref['penulis'];?>, <?php echo $dt_ref['nama_halaman_web'];?>, <?php echo $dt_ref['tahun'];?>, <?php echo $dt_ref['nama_url'];?> (Kategori : Website)
                            <?php endif ?>
                            </option>
                          <?php } ?>
                          </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pil_pustakan_pendukung" class="col-sm-3 col-form-label">Pustaka (Pendukung)</label>
                    <div class="col-sm-9">
                        <select class="select2" id="pil_pustakan_pendukung" name="pil_pustakan_pendukung[]" multiple="multiple" data-placeholder="Pilihan Pustaka" style="width: 100%;">
                          <?php foreach ($list_referensi as $dt_ref) { ?>
                            <option value="<?php echo $dt_ref['id_rps_referensi'];?>">
                            <?php if ($dt_ref['id_kategori']==1): ?>
                                <?php echo $dt_ref['penulis'];?>, <?php echo $dt_ref['judul'];?>,<?php echo $dt_ref['tahun'];?>, <?php echo $dt_ref['penerbit'];?>, ISBN : <?php echo $dt_ref['isbn'];?> (Kategori : Buku)
                            <?php elseif ($dt_ref['id_kategori']==2) : ?>
                                <?php echo $dt_ref['penulis'];?>, <?php echo $dt_ref['judul'];?>, <?php echo $dt_ref['tahun'];?>, <?php echo $dt_ref['nama_jurnal'];?>, ISSN : <?php echo $dt_ref['issn'];?> (Kategori : Jurnal)
                            <?php else : ?>
                                <?php echo $dt_ref['penulis'];?>, <?php echo $dt_ref['nama_halaman_web'];?>, <?php echo $dt_ref['tahun'];?>, <?php echo $dt_ref['nama_url'];?> (Kategori : Website)
                            <?php endif ?>
                            </option>
                          <?php } ?>
                          </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inp_media_lunak" class="col-sm-3 col-form-label">Media Pembelajaran (Perangkat Lunak)</label>
                    <div class="col-sm-9">
                        <input type="text" name="inp_media_lunak" id="inp_media_lunak" class="form-control" maxlength="100">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inp_media_keras" class="col-sm-3 col-form-label">Media Pembelajaran (Perangkat Keras)</label>
                    <div class="col-sm-9">
                        <input type="text" name="inp_media_keras" id="inp_media_keras" class="form-control" maxlength="100">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Mata Kuliah Prasyarat *</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="prasyarat" name="prasyarat"></textarea>
                    </div>
                </div>
                <div class="form-footer">
                    <button type="button" class="btn btn-success tbl_simpan"><i class="fa fa-check-square-o"></i> Simpan data Identitas dan Deskripsi Matakuliah</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
  $(document).ready(function()
  {
    CKEDITOR.replace('desk_matkul');
    CKEDITOR.replace('desk_materi');
    $("#pil_ps").on("change", function()
    {
        var pil_prodi = $("#pil_ps").val();
        hapus_teks();
        $("#pil_matkul").load("<?php echo base_url();?>rps/list_mk/"+pil_prodi);
    });
    $("#pil_matkul").on("change", function()
    {
        var pil_mk = $("#pil_matkul").val();
        hapus_teks();
        $.ajax (
        {
            url : "<?php echo site_url();?>rps/get_profil_mk",
            type : "post",
            data : {id_data:pil_mk},
            success : function(d)
            {
                var dt = d.split("#");
                $("#kode_mk").val(dt[0]);
                $("#jumlah_sks").val(dt[1]);
                $("#semester").val(dt[2]);
            }
         });
    });
    $(".tbl_simpan").on("click", function()
        {
            var pil_tahun = $("#pil_tahun").val();
            var pil_prodi = $("#pil_ps").val();
            var pil_matkul = $("#pil_matkul").val();
            var pil_dosen = $("#pil_dosen").val().join();
            var inp_deskripsi = CKEDITOR.instances['desk_matkul'].getData();
            var inp_desk_materi = CKEDITOR.instances['desk_materi'].getData();
            var pil_ref_utama = $("#pil_pustakan_utama").val().join();
            var pil_ref_pendukung = $("#pil_pustakan_pendukung").val().join();
            var inp_perangkat_lunak = $("#inp_media_lunak").val();
            var inp_perangkat_keras = $("#inp_media_keras").val();
             var inp_prasyarat = $("#prasyarat").val();
            if(pil_prodi==0)
            {
                alert("Kolom pilihan program studi tidak boleh kosong");
                return false;
            } else if(pil_matkul==0)
            {
                alert("Kolom pilihan matakuliah tidak boleh kosong");
                return false;
            } else if(pil_dosen==null)
            {
                alert("Kolom pilihan dosen pengampuh tidak boleh kosong");
                return false;
            } else {
                var pesan = confirm("Yakin akan menyimpan data ?");
                if(pesan==true)
                {
                    $.ajax (
                    {
                        url : "<?php echo site_url();?>rps/simpan_identitas",
                        type : "post",
                        data : {pil_tahun:pil_tahun, pil_prodi:pil_prodi, pil_matkul:pil_matkul, inp_prasyarat:inp_prasyarat, pil_dosen:pil_dosen, inp_deskripsi:inp_deskripsi, inp_desk_materi:inp_desk_materi, inp_perangkat_lunak:inp_perangkat_lunak, inp_perangkat_keras:inp_perangkat_keras, pil_ref_utama:pil_ref_utama, pil_ref_pendukung:pil_ref_pendukung},
                        success : function(d)
                        {
                            var id_rps = d;
                            alert("Data Identitas dan Deskripsi Matakuliah berhasil disimpan. Tahap berikutnya adalah pengisian capaian pembelajaran");
                            window.location.assign("<?php echo base_url();?>rps/add_capaian_pembelajaran/"+id_rps);
                        }
                     });
                    
                } else {
                    return false;
                }
            }
            
        });
    function hapus_teks()
    {
        $("#kode_mk").val("");
        $("#jumlah_sks").val("");
        $("#semester").val("");
    }
  });
</script>