<div class="content-wrapper">
  <section class="content-header">
    <h1>Penyusunan <small>Rencana Pembelajaran Semester (RPS)</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>Home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url();?>rps"><i class="fa fa-table"></i> Daftar RPS</a></li>
      <li class="active">Edit identitas matakuliah</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Identitas Matakuliah</h3>
          </div>
          <div class="box-body">
            <input type="hidden" name="id_head_rps" id="id_head_rps" value="<?php echo encrypt_decrypt('encrypt', $dt_head->id_rps);?>">
            <div class="row">
                <label class="col-sm-2 col-form-label">Program Studi</label>
                <label class="col-sm-4">: <?php echo $dt_head->nama_ps;?> (<?php echo $dt_head->nm_jenjang;?>)</label>
                <label class="col-sm-2 col-form-label">Mata Kuliah</label>
                <label class="col-sm-4">: <?php echo $dt_head->nama_matakuliah;?></label>
            </div>
            <div class="row">
                <label class="col-sm-2 col-form-label">Rumpun Matakuliah</label>
                <label class="col-sm-4">: <?php echo $dt_head->jenis_matakuliah;?></label>
                <label class="col-sm-2 col-form-label">Kode / SKS/ Semester</label>
                <label class="col-sm-4">: <?php echo $dt_head->kode_matakuliah."/".$dt_head->sks."/".$dt_head->semester;?></label>
            </div>
            <div class="row">
                <label class="col-sm-2 col-form-label">Dosen Pengampuh</label>
                <label class="col-sm-4">: 
                <?php
                $nom=1;
                foreach ($list_dsn as $key => $value) {
                    echo $nom.". ".$value."<br>";
                    $nom++;
                }
                ?>
                </label>
                <label class="col-sm-2 col-form-label">Kurikulum Tahun</label>
                <label class="col-sm-4">: <?php echo $dt_head->tahun;?></label>
            </div>
          </div>
        </div>
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Identitas Matakuliah</h3>
          </div>
          <div class="box-body">
            <form id="form_inp" name="form_inp">
                <div class="form-group row">
                    <label for="desk_matkul" class="col-sm-12 col-form-label">Deskripsi Matakuliah</label>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                    <textarea name="desk_matkul" id="desk_matkul" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #000; padding: 10px;"><?php echo $dt_head->deskripsi_matkul;?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="desk_materi" class="col-sm-12 col-form-label">Materi Pembelajaran/Pokok Bahasan *</label>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <textarea name="desk_materi" id="desk_materi" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #000; padding: 10px;"><?php echo $dt_head->pokok_bahasan;?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pil_pustakan_utama" class="col-sm-3 col-form-label">Pustaka (Utama)</label>
                    <div class="col-sm-9">
                        <select class="select2" id="pil_pustakan_utama" name="pil_pustakan_utama[]" multiple="multiple" data-placeholder="Pilihan Pustaka" style="width: 100%;">
                        <?php 
                        $all_pustaka_utama = array();
                        $all_pustaka_pendukung = array();
                        $arr_pustaka_utama = explode(",", $dt_head->pil_referensi);
                        for ($i=0; $i < count($arr_pustaka_utama); $i++) { 
                            $all_pustaka_utama[] = $arr_pustaka_utama[$i];
                        }
                        $arr_pustaka_pendudkung = explode(",", $dt_head->pil_pustaka_pendukung);
                        for ($i=0; $i < count($arr_pustaka_pendudkung); $i++) { 
                            $all_pustaka_pendukung[] = $arr_pustaka_pendudkung[$i];
                        }
                        ?>
                        <?php foreach ($list_referensi as $dt_ref) { ?>

                            <option value="<?php echo $dt_ref['id_rps_referensi'];?>" 
                            <?php
                            foreach ($all_pustaka_utama as $key => $pil) 
                            {
                                if($dt_ref['id_rps_referensi']==$pil) 
                                {
                                    echo "selected";
                                }
                            }
                            ?>
                            >
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
                        <option value="<?php echo $dt_ref['id_rps_referensi'];?>" 
                        <?php
                        foreach ($all_pustaka_pendukung as $key => $pil) 
                        {
                            if($dt_ref['id_rps_referensi']==$pil) 
                            {
                                echo "selected";
                            }
                        }
                        ?>
                        >
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
                    <label for="inp_media_lunak" class="col-sm-4 col-form-label">Media Pembelajaran (Perangkat Lunak)</label>
                    <div class="col-sm-8">
                        <input type="text" name="inp_media_lunak" id="inp_media_lunak" class="form-control" maxlength="100" value="<?php echo $dt_head->perangkat_lunak;?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inp_media_keras" class="col-sm-4 col-form-label">Media Pembelajaran (Perangkat Keras)</label>
                    <div class="col-sm-8">
                        <input type="text" name="inp_media_keras" id="inp_media_keras" class="form-control" maxlength="100" value="<?php echo $dt_head->perangkat_keras;?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="desk_matkul" class="col-sm-12 col-form-label">Matakuliah Prasyarat</label>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <textarea class="form-control" id="prasyarat" name="prasyarat" rows="3"><?php echo $dt_head->prasyarat_matkul;?></textarea>
                    </div>
                </div>
                <div class="form-footer">
                    <button type="button" class="btn btn-success tbl_simpan"><i class="fa fa-check-square-o"></i> Update data</button>
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
    $(".tbl_simpan").on("click", function()
    {
        var id_rps = $("#id_head_rps").val();
        
        var inp_deskripsi = CKEDITOR.instances['desk_matkul'].getData();
        var inp_desk_materi = CKEDITOR.instances['desk_materi'].getData();
        var pil_ref_utama = $("#pil_pustakan_utama").val().join();
        var pil_ref_pendukung = $("#pil_pustakan_pendukung").val().join();
        var inp_perangkat_lunak = $("#inp_media_lunak").val();
        var inp_perangkat_keras = $("#inp_media_keras").val();
        var inp_prasyarat = $("#prasyarat").val();
        var pesan = confirm("Yakin akan menyimpan data ?");
        if(pesan==true)
        {
            $.ajax (
            {
                url : "<?php echo site_url();?>rps/rubah_identitas",
                type : "post",
                data : {id_rps:id_rps, inp_deskripsi:inp_deskripsi, inp_desk_materi:inp_desk_materi, pil_ref_utama:pil_ref_utama, pil_ref_pendukung:pil_ref_pendukung, inp_perangkat_lunak:inp_perangkat_lunak, inp_perangkat_keras:inp_perangkat_keras, inp_prasyarat:inp_prasyarat},
                success : function(d)
                {
                    //var id_rps = d;
                    alert("Perubahan data identitas matakuliah berhasil disimpan");
                    window.location.assign("<?php echo base_url();?>rps");
                }
             });
            
        } else {
            return false;
        }            
    });
  });
</script>