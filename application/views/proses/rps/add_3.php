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
            <h3 class="box-title">Capaian pembelajaran</h3>
            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-tambah" title="Tambah data baru"><i class="fa fa-plus"></i> Tambah data baru</button>
              </div>
            </div>
          </div>
          <div class="box-body">
            <form id="form_inp" name="form_inp">
              <div class="row">
                <div class="col-xs-12">
                  <h3 class="page-header">
                    <strong>CP-MK</strong>
                  </h3>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <table class="table" width="100%">
                    <thead>
                      <th style="width: 10%">Kode</th>
                      <th style="width: 30%">Deskripsi</th>
                      <th style="width: 60%">Unsur CPL</th>
                    </thead>
                    <tbody>
                      <?php 
                      $all_aspek_sikap = array();
                      $all_aspek_pengetahuan = array();
                      $all_aspek_ku = array();
                      $all_aspek_kk = array();
                      foreach ($list_cpmk as $dt_cpmk): ?>
                        <?php 
                        if(!empty($dt_cpmk['unsur_s'])){
                          $arr_aspek_sikap = explode(",", $dt_cpmk['unsur_s']);
                          for ($i=0; $i < count($arr_aspek_sikap); $i++) { 
                            $hasil = $this->model_rps->get_profil_aspek_sikap($arr_aspek_sikap[$i]);
                            $all_aspek_sikap[] = array("kode"=>"S-".$hasil->no_urut, "desk"=>$hasil->aspek_sikap);
                            //$all_aspek_sikap[] = $hasil->aspek_sikap." (S-".$hasil->no_urut.")";
                          }
                        }
                        if(!empty($dt_cpmk['unsur_p'])){
                          $arr_aspek_pengetahuan = explode(",", $dt_cpmk['unsur_p']);
                          for ($i=0; $i < count($arr_aspek_pengetahuan); $i++) { 
                            $hasil = $this->model_rps->get_profil_aspek_pengetahuan($arr_aspek_pengetahuan[$i]);
                            $all_aspek_pengetahuan[] = array("kode"=>"P-".$hasil->no_urut, "desk"=>$hasil->aspek_pengetahuan);
                            //$all_aspek_sikap[] = $hasil->aspek_sikap." (S-".$hasil->no_urut.")";
                          }
                        }
                        if(!empty($dt_cpmk['unsur_ku'])){
                          $arr_aspek_ku = explode(",", $dt_cpmk['unsur_ku']);
                          for ($i=0; $i < count($arr_aspek_ku); $i++) { 
                            $hasil = $this->model_rps->get_profil_aspek_ku($arr_aspek_ku[$i]);
                            $all_aspek_ku[] = array("kode"=>"KU-".$hasil->no_urut, "desk"=>$hasil->keterampilan_umum);
                            //$all_aspek_sikap[] = $hasil->aspek_sikap." (S-".$hasil->no_urut.")";
                          }
                        }
                        if(!empty($dt_cpmk['unsur_kk'])){
                           $arr_aspek_kk = explode(",", $dt_cpmk['unsur_kk']);
                          for ($i=0; $i < count($arr_aspek_kk); $i++) { 
                            $hasil = $this->model_rps->get_profil_aspek_kk($arr_aspek_kk[$i]);
                            $all_aspek_kk[] = array("kode"=>"KK-".$hasil->no_urut, "desk"=>$hasil->keterampilan_khusus);
                            //$all_aspek_sikap[] = $hasil->aspek_sikap." (S-".$hasil->no_urut.")";
                          }
                        }
                        ?>
                        <tr>
                          <td>M<?php echo $dt_cpmk['no_urut'];?></td>
                          <td><?php echo $dt_cpmk['deskripsi'];?></td>
                          <td>
                            <table class="table" width="100%">
                              <tr>
                                <td colspan="2"><strong>Aspek Sikap (S)</strong></td>
                              </tr>
                              <?php if(count($all_aspek_sikap)>0) { foreach ($all_aspek_sikap as $sikap) { ?>
                              <tr>
                                <td style="width: 10%"><strong><?php echo $sikap['kode']; ?>.</strong></td>
                                <td style="width: 90%"><?php echo $sikap['desk']; ?></td>
                              </tr>
                              <?php } }?>
                              <tr>
                                <td colspan="2"><strong>Aspek Pengetahuan (P)</strong></td>
                              </tr>
                              <?php if(count($all_aspek_pengetahuan)>0) { foreach ($all_aspek_pengetahuan as $p) { ?>
                              <tr>
                                <td style="width: 10%"><strong><?php echo $p['kode']; ?>.</strong></td>
                                <td style="width: 90%"><?php echo $p['desk']; ?></td>
                              </tr>
                              <?php } }?>
                              <tr>
                                <td colspan="2"><strong>Aspek Keterampilan Umum (KU)</strong></td>
                              </tr>
                              <?php if(count($all_aspek_ku)>0) { foreach ($all_aspek_ku as $ku) { ?>
                              <tr>
                                <td style="width: 10%"><strong><?php echo $ku['kode']; ?>.</strong></td>
                                <td style="width: 90%"><?php echo $ku['desk']; ?></td>
                              </tr>
                              <?php } }?>
                              <tr>
                                <td colspan="2"><strong>Aspek Keterampilan Khusus (KK)</strong></td>
                              </tr>
                              <?php if(count($all_aspek_kk)>0) { foreach ($all_aspek_kk as $kk) { ?>
                              <tr>
                                <td style="width: 10%"><strong><?php echo $kk['kode']; ?>.</strong></td>
                                <td style="width: 90%"><?php echo $kk['desk']; ?></td>
                              </tr>
                              <?php } }?>
                            </table>
                          </td>
                        </tr>
                        <?php 
                        if (!empty($all_aspek_sikap)) { unset($all_aspek_sikap); }
                        if (!empty($all_aspek_pengetahuan)) { unset($all_aspek_pengetahuan); }
                        if (!empty($all_aspek_ku)) { unset($all_aspek_ku); }
                        if (!empty($all_aspek_kk)) { unset($all_aspek_kk); }  
                        ?>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="form-footer">
                  <button type="button" class="btn btn-danger tbl_kembali"><< Kembali</button>
                  <button type="button" class="btn btn-success tbl_matriks">Input matriks rencana pembelajaran >></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- Modal Area -->
<div class="modal modal-primary fade" id="modal-tambah" data-backdrop="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Data</h4>
      </div>
      <form role="form" method="post">
      <div class="modal-body">
        <div class="box-body">
          <div class="form-group">
            <label for="nomor_urut">Nomor Urut</label>
            <input type="text" class="form-control" id="nomor_urut" name="nomor_urut" value="<?php echo $nom_urut;?>" readonly style="width: 150px">
          </div>
          <div class="form-group">
            <label for="inp_deskripsi">Deskripsi</label>
            <textarea class="form-control" id="inp_deskripsi" name="inp_deskripsi" required></textarea>
          </div>
          <div class="form-group">
            <label>A. Aspek Sikap (S)</label>
            <select class="select2" id="pil_aspek_sikap" name="pil_aspek_sikap[]" multiple="multiple" data-placeholder="Pilih aspek sikap" style="width: 100%;">
              <?php foreach ($list_aspek_sikap as $dt_ak) { ?>
              <option value="<?php echo $dt_ak['id_sikap'];?>">(S<?php echo $dt_ak['no_urut'];?>). <?php echo $dt_ak['aspek_sikap'];?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>B. Aspek Pengetahuan (P)</label>
            <select class="select2" id="pil_pengetahuan" name="pil_pengetahuan[]" multiple="multiple" data-placeholder="Pilih aspek pengetahuan" style="width: 100%;">
            <?php foreach ($list_aspek_pengetahuan as $dt_ap) { ?>
                <option value="<?php echo $dt_ap['id_pengetahuan'];?>">(P<?php echo $dt_ap['no_urut'];?>). <?php echo $dt_ap['aspek_pengetahuan'];?></option>
            <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>C. Aspek Keterampilan Umum (KU)</label>
            <select class="select2" id="pil_keterampilan_umum" name="pil_keterampilan_umum[]" multiple="multiple" data-placeholder="Pilih aspek keterampilan umum" style="width: 100%;">
            <?php foreach ($list_aspek_ku as $dt_ku) { ?>
                <option value="<?php echo $dt_ku['id_ku'];?>">(KU<?php echo $dt_ku['no_urut'];?>). <?php echo $dt_ku['keterampilan_umum'];?></option>
            <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>D. Aspek Keterampilan Khusus (KK)</label>
            <select class="select2" id="pil_keterampilan_khusus" name="pil_keterampilan_khusus[]" multiple="multiple" data-placeholder="Pilih aspek keterampilan khusus" style="width: 100%;">
            <?php foreach ($list_aspek_kk as $dt_kk) { ?>
                <option value="<?php echo $dt_kk['id_kk'];?>">(KK<?php echo $dt_kk['no_urut'];?>). <?php echo $dt_kk['keterampilan_khusus'];?></option>
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
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
    $(document).ready(function()
    {
        //$('.select2').select2();
        $(".tbl_simpan").on("click", function()
        {
            var id_rps = $("#id_head_rps").val();
            var inp_no_urut = $("#nomor_urut").val();
            var inp_deskripsi = $("#inp_deskripsi").val();
            var pil_asp_sikap = $("#pil_aspek_sikap").val();
            var pil_asp_pengetahuan = $("#pil_pengetahuan").val();
            var pil_asp_ku = $("#pil_keterampilan_umum").val();
            var pil_asp_kk = $("#pil_keterampilan_khusus").val();
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
                        url : "<?php echo site_url();?>rps/simpan_capaian_pembelajaran_mk",
                        type : "post",
                        data : {inp_no_urut:inp_no_urut, inp_deskripsi:inp_deskripsi, pil_asp_sikap:pil_asp_sikap.join(), pil_asp_pengetahuan:pil_asp_pengetahuan.join(), pil_asp_ku:pil_asp_ku.join(), pil_asp_kk:pil_asp_kk.join(), id_rps:id_rps},
                        success : function(d)
                        {
                            alert(d);
                            window.location.assign("<?php echo base_url();?>rps/add_capaian_pembelajaran_mk/"+id_rps);
                        }
                     });
                    
                } else {
                    return false;
                }
            }
            
        });
        $(".tbl_matriks").on("click", function()
        {
          var id_rps = $("#id_head_rps").val(); 
          window.location.assign("<?php echo base_url();?>rps/add_matriks_pembelajaran/"+id_rps);
        });
        $(".tbl_kembali").on("click", function()
        {
          var id_rps = $("#id_head_rps").val();
          window.location.assign("<?php echo base_url();?>rps/add_capaian_pembelajaran/"+id_rps);
        });
    });
</script>