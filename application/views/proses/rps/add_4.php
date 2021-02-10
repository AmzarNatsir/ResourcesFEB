<div class="content-wrapper">
  <section class="content-header">
    <h1>Penyusunan <small>Rencana Pembelajaran Semester (RPS)</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>Home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url();?>rps"><i class="fa fa-table"></i> Daftar RPS</a></li>
      <li class="active">Rencana Pembelajaran Semester (RPS)</li>
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
            <h3 class="box-title">Matrik Rencana Pembelajaran</h3>
            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <button type="button" class="btn btn-primary btn-block m-1" data-toggle="modal" data-target="#largesizemodal"><i class="fa fa-plus"></i> Tambah data matriks</button>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
                <div class="col-sm-12 table-responsive">
                    <table class="table" width="100%">
                  <thead>
                  <tr>
                      <th style="width: 5%; text-align: center; vertical-align: top">Mg Ke-</th>
                      <th style="width: 20%; text-align: center; vertical-align: top">Sub-CP-MK (sbg kemampuan akhir yg diharapkan</th>
                      <th style="width: 20%; text-align: center; vertical-align: top">Indikator Penilaian</th>
                      <th style="width: 15%; text-align: center; vertical-align: top">Kriteria & Bentuk Penilaian</th>
                      <th style="width: 15%; text-align: center; vertical-align: top">Metode Pembelajaran</th>
                      <th style="width: 15%; text-align: center; vertical-align: top">Materi Pembelajaran</th>
                      <th style="width: 10%; text-align: center; vertical-align: top">Bobot Penilaian (%)</th>
                  </tr>
                  <tr>
                      <th style="text-align: center">(1)</th>
                      <th style="text-align: center">(2)</th>
                      <th style="text-align: center">(3)</th>
                      <th style="text-align: center">(4)</th>
                      <th style="text-align: center">(5)</th>
                      <th style="text-align: center">(6)</th>
                      <th style="text-align: center">(7)</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($list_matriks as $dt_matriks): ?>
                      <?php if ($dt_matriks['sub']==1): ?>
                          <tr bgcolor="#e3e3e3">
                              <td><?php echo $dt_matriks['pertemuan_ke'];?></td>
                              <td><?php echo $dt_matriks['nama_sub'];?></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>
                      <?php else: ?>
                          <tr>
                              <td><?php echo $dt_matriks['pertemuan_ke'];?></td>
                              <td><?php echo $dt_matriks['capaian_pembelajaran'];?></td>
                              <td><?php echo $dt_matriks['indikator_penilaian'];?></td>
                              <td><?php echo $dt_matriks['teknik_penilaian'];?></td>
                              <td><?php echo $dt_matriks['metode_pembelajaran'];?></td>
                              <td><?php echo $dt_matriks['bahasan_kajian'];?></td>
                              <td style="text-align: center"><?php echo $dt_matriks['bobot_tagihan'];?></td>
                          </tr>
                      <?php endif ?>
                      <?php endforeach ?>
                  </tbody>
                  </table>
                </div>
            </div>
            <div class="form-group row">
                <label for="desk_catatan" class="col-sm-12 col-form-label">Catatan</label>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <textarea name="desk_catatan" id="desk_catatan" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #000; padding: 10px;"><?php echo $dt_head->catatan;?></textarea>
                </div>
            </div>
            <div class="form-footer">
                <button type="button" class="btn btn-success tbl_simpan_catatan"><i class="fa fa-check-square-o"></i> Simpan Catatan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- Modal Area -->
<div class="modal modal-primary fade" id="largesizemodal" data-backdrop="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Data</h4>
      </div>
      <div class="modal-body">
        <div class="box-body">
            <form id="form_inp" name="form_inp">
              <div class="form-group py-2">
                  <div class="icheck-material-white">
                      <input type="checkbox" id="check_sub_item">
                          <label for="check_sub_item">Sub Item</label>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-12 col-form-label">1. Pertemuan Ke-<?php echo $no_urut;?></label>
                  <input type="hidden" name="pertemuan_ke" id="pertemuan_ke" class="form-control" value="<?php echo $no_urut;?>">
              </div>
              <div id="sub_item" style="display: none">
                  <div class="form-group row">
                      <label class="col-sm-3 col-form-label">2. Nama Sub Item</label>
                      <div class="col-sm-9">
                          <input type="text" name="inp_nama_sub_item" id="inp_nama_sub_item" class="form-control" maxlength="100">
                      </div>
                  </div>
              </div>
              <div id="not_sub_item">
                  <div class="form-group row">
                      <label class="col-sm-12 col-form-label">2. Sub-CP-MK (sbg kemampuan akhir yg diharapkan)</label>
                  </div>
                  <div class="form-group row">
                      <div class="col-sm-12">
                        <textarea name="desk_capaian_belajar" id="desk_capaian_belajar" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #000; padding: 10px;"></textarea>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-12 col-form-label">3. Indiator Penilaian</label>
                  </div>
                  <div class="form-group row">
                      <div class="col-sm-12">
                        <textarea name="desk_indikator_penilaian" id="desk_indikator_penilaian" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #000; padding: 10px;"></textarea>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-12 col-form-label">4. Kriteria & Bentuk Penilaian</label>
                  </div>
                  <div class="form-group row">
                      <div class="col-sm-12">
                        <textarea name="desk_teknik_penilaian" id="desk_teknik_penilaian" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #000; padding: 10px;"></textarea>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-12 col-form-label">5. Metode Pembelajaran</label>
                  </div>
                  <div class="form-group row">
                      <div class="col-sm-12">
                        <textarea name="desk_metode_belajar" id="desk_metode_belajar" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #000; padding: 10px;"></textarea>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-12 col-form-label">6. Materi Pembelajaran</label>
                  </div>
                  <div class="form-group row">
                      <div class="col-sm-12">
                        <textarea name="desk_bahasan_kajian" id="desk_bahasan_kajian" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #000; padding: 10px;"></textarea>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-10 col-form-label">7. Bobot Penilaian (%)</label>
                      <div class="col-sm-2">
                          <input type="text" name="inp_bobot_tagihan" id="inp_bobot_tagihan" class="form-control angka" maxlength="3" value="0">
                      </div>
                  </div>
              </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-outline tbl_simpan">Simpan Data</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
    $(document).ready(function()
    {
      CKEDITOR.replace('desk_catatan');
      CKEDITOR.replace('desk_capaian_belajar');
      CKEDITOR.replace('desk_indikator_penilaian');
      CKEDITOR.replace('desk_teknik_penilaian');
      CKEDITOR.replace('desk_metode_belajar');
      CKEDITOR.replace('desk_bahasan_kajian');
      $(".angka").number(true, 0);
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
        var id_rps = $("#id_head_rps").val();
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
                    url : "<?php echo site_url();?>rps/simpan_matriks_pembelajaran",
                    type : "post",
                    data : {id_rps:id_rps, pil_sub_item:pil_sub_item, nom_pertemuan:nom_pertemuan, nama_sub:nama_sub, capaian:capaian, bahasan:bahasan, metode:metode, indikator_penilaian:indikator_penilaian, teknik_penilaian:teknik_penilaian, bobot_tagihan:bobot_tagihan},
                    success : function(d)
                    {
                        if(d==1)
                        {
                            alert("Data matriks rencana pembelajaran berhasil disimpan.");
                            window.location.assign("<?php echo base_url();?>rps/add_matriks_pembelajaran/"+id_rps);
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
      $(".tbl_simpan_catatan").on("click", function()
      {
        var id_rps = $("#id_head_rps").val();
        var inp_catatan = CKEDITOR.instances['desk_catatan'].getData();
        if(inp_catatan.length==0)
        {
          alert("Kolom inputan deskripsi catatan tidak boleh kosong");
          return false;
        } else {
          var pesan = confirm("Yakin akan menyimpan data ?");
            if(pesan==true)
            {
                $.ajax (
                {
                    url : "<?php echo site_url();?>rps/simpan_matriks_pembelajaran_catatan",
                    type : "post",
                    data : {id_rps:id_rps, inp_catatan:inp_catatan},
                    success : function(d)
                    {
                      alert(d);
                      window.location.assign("<?php echo base_url();?>rps/add_matriks_pembelajaran/"+id_rps);
                    }
                 });
                
            } else {
                return false;
            }
        }
      });
      $(".tbl_kembali").on("click", function()
      {
          window.location.assign("<?php echo base_url();?>Panel_Admin/RPS_Add_Capaian_Pembelajaran_Lulusan");
      });
    });
</script>