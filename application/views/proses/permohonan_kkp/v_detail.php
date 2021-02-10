<link href="<?php echo base_url();?>assets/css/jquery.fancybox.min.css" rel="stylesheet">
<div class="content-wrapper">
  <section class="content-header">
    <h1>Akademik <small>Permohonan KKP</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url();?>permohonan_kkp"><i class="fa fa-table"></i> Daftar Permohonan KKP</a></li>
      <li class="active">Permohonan KKP</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">DETAIL PERMOHONAN KKP</h3>
            <hr>
            <fieldset>
              <div class="form-group row">
                <label class="col-md-3 control-label">Nama Lengkap</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="<?php echo $profil->nama_mahasiswa;?>" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 control-label">No. Stambuk</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="<?php echo $profil->nim;?>" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 control-label">Program Studi/TA</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="<?php echo $profil->nama_ps.'/'.$profil->nama_tahun;?>" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 control-label">Tempat/Tanggal Lahir</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="<?php echo $profil->tempat_lahir;?><?php echo (!empty($profil->tgl_lahir))? " / ".date_format(date_create($profil->tgl_lahir), 'd-m-Y') : '';?>" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 control-label">Daerah Asal/Alamat</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="<?php echo $profil->daerah_asal;?><?php echo (!empty($profil->alamat))? " / ".$profil->alamat : '';?>" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 control-label">No. Telp/HP</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="<?php echo $profil->no_tlp;?>" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 control-label">Ukuran Baju </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="<?php echo $profil->ukuran_baju;?>" readonly>
                </div>
              </div>
            </fieldset>
            <h3 class="box-title">LOKASI KKP - ALTERNATIF I</h3>
            <hr>
            <fieldset>
              <div class="form-group">
                  <label for="inp_instansi_1">Nama Instansi</label>
                  <input type="text" id="inp_instansi_1" name="inp_instansi_1" class="form-control" maxlength="200" value="<?php echo $profil->nama_instansi_1;?>" readonly>
              </div>
              <div class="form-group">
                  <label for="inp_alamat_1">Alamat</label>
                  <input type="text" id="inp_alamat_1" name="inp_alamat_1" class="form-control" maxlength="200" value="<?php echo $profil->alamat_1;?>" readonly>
              </div>
              <div class="form-group">
                  <label for="inp_notelp_1">No. Telepon</label>
                  <input type="text" id="inp_notelp_1" name="inp_notelp_1" class="form-control" maxlength="50" value="<?php echo $profil->no_telpon_1;?>" readonly>
              </div>
              <div class="form-group">
                  <label for="inp_kontak_1">Kontak Person</label>
                  <input type="text" id="inp_kontak_1" name="inp_kontak_1" class="form-control" maxlength="100" value="<?php echo $profil->kontak_person_1;?>" readonly>
              </div>
            </fieldset>
            <h3 class="box-title">LOKASI KKP - ALTERNATIF II (Cadangan)</h3>
            <hr>
            <fieldset>
              <div class="form-group">
                  <label for="inp_instansi_2">Nama Instansi</label>
                  <input type="text" id="inp_instansi_2" name="inp_instansi_2" class="form-control" maxlength="200" value="<?php echo $profil->nama_instansi_2;?>" readonly>
              </div>
              <div class="form-group">
                  <label for="inp_alamat_2">Alamat</label>
                  <input type="text" id="inp_alamat_2" name="inp_alamat_2" class="form-control" maxlength="200" value="<?php echo $profil->alamat_2;?>" readonly>
              </div>
              <div class="form-group">
                  <label for="inp_notelp_2">No. Telepon</label>
                  <input type="text" id="inp_notelp_2" name="inp_notelp_2" class="form-control" maxlength="50" value="<?php echo $profil->no_telpon_2;?>" readonly>
              </div>
              <div class="form-group">
                  <label for="inp_kontak_2">Kontak Person</label>
                  <input type="text" id="inp_kontak_2" name="inp_kontak_2" class="form-control" maxlength="100" value="<?php echo $profil->kontak_person_2;?>" readonly>
              </div>
            </fieldset>
            <h3 class="box-title">FILE DOKUMEN</h3>
            <hr>
            <fieldset>
              <div class="row media-filter-items">
                <div class="col-sm-6 col-lg-3">
                    <div class="media-items animation-fadeInQuickInv">
                        <div class="media-items-content" style="padding: 10px 0 10px">
                          <?php
                          $fl_nm = $profil->file_bukti_pembayaran_kuliah;
                          $arr_fl = explode(".", $fl_nm);
                          if($arr_fl[1]=="pdf")
                          { ?>
                            <a class="gallerypdf" data-fancybox-type="iframe" href="https://mahasiswa.feb.unismuh.ac.id/assets/upload/permohonan_kkp/<?php echo $profil->nim;?>/<?php echo $profil->file_bukti_pembayaran_kuliah;?>"><img src="<?php echo base_url();?>assets/dist/img/pdf_icon.png" style="width: 20%; height: auto"></a>
                          <?php } else {?>
                            <a href="https://mahasiswa.feb.unismuh.ac.id/assets/upload/permohonan_kkp/<?php echo $profil->nim;?>/<?php echo $profil->file_bukti_pembayaran_kuliah;?>" data-fancybox data-caption="Bukti Pembayaran Kuliah Semester 1-6"><img src="https://mahasiswa.feb.unismuh.ac.id/assets/upload/permohonan_kkp/<?php echo $profil->nim;?>/<?php echo $profil->file_bukti_pembayaran_kuliah;?>" style="width: 100%; height: auto"></a>
                          <?php } ?>
                        </div>
                        <h4>
                            <strong>Bukti Pembayaran Kuliah Semester 1-6</strong>
                        </h4>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="media-items animation-fadeInQuickInv">
                        <div class="media-items-content" style="padding: 10px 0 10px">
                          <?php
                          $fl_nm = $profil->file_krs;
                          $arr_fl = explode(".", $fl_nm);
                          if($arr_fl[1]=="pdf")
                          { ?>
                            <a class="gallerypdf" data-fancybox-type="iframe" href="https://mahasiswa.feb.unismuh.ac.id/assets/upload/permohonan_kkp/<?php echo $profil->nim;?>/<?php echo $profil->file_krs;?>"><img src="<?php echo base_url();?>assets/dist/img/pdf_icon.png" style="width: 20%; height: auto"></a>
                          <?php } else {?>
                            <a href="https://mahasiswa.feb.unismuh.ac.id/assets/upload/permohonan_kkp/<?php echo $profil->nim;?>/<?php echo $profil->file_krs;?>" data-fancybox data-caption="KRS semester I-6/transkrip nilai 110 SKS"><img src="https://mahasiswa.feb.unismuh.ac.id/assets/upload/permohonan_kkp/<?php echo $profil->nim;?>/<?php echo $profil->file_krs;?>" style="width: 100%; height: auto"></a>
                          <?php } ?>
                        </div>
                        <h4>
                            <strong>KRS semester I-6/transkrip nilai 110 SKS</strong>
                        </h4>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="media-items animation-fadeInQuickInv">
                        <div class="media-items-content" style="padding: 10px 0 10px">
                          <?php
                          $fl_nm = $profil->file_bukti_pembayaran_kkp;
                          $arr_fl = explode(".", $fl_nm);
                          if($arr_fl[1]=="pdf")
                          { ?>
                            <a class="gallerypdf" data-fancybox-type="iframe" href="https://mahasiswa.feb.unismuh.ac.id/assets/upload/permohonan_kkp/<?php echo $profil->nim;?>/<?php echo $profil->file_bukti_pembayaran_kkp;?>"><img src="<?php echo base_url();?>assets/dist/img/pdf_icon.png" style="width: 20%; height: auto"></a>
                          <?php } else {?>
                            <a href="https://mahasiswa.feb.unismuh.ac.id/assets/upload/permohonan_kkp/<?php echo $profil->nim;?>/<?php echo $profil->file_bukti_pembayaran_kkp;?>" data-fancybox data-caption="Bukti Pembayaran KKP"><img src="https://mahasiswa.feb.unismuh.ac.id/assets/upload/permohonan_kkp/<?php echo $profil->nim;?>/<?php echo $profil->file_bukti_pembayaran_kkp;?>" style="width: 100%; height: auto"></a>
                          <?php } ?>
                        </div>
                        <h4>
                            <strong>Bukti Pembayaran KKP</strong>
                        </h4>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="media-items animation-fadeInQuickInv">
                        <div class="media-items-content" style="padding: 10px 0 10px">
                          <?php
                          $fl_nm = $profil->file_lulus_mengaji;
                          $arr_fl = explode(".", $fl_nm);
                          if($arr_fl[1]=="pdf")
                          { ?>
                            <a class="gallerypdf" data-fancybox-type="iframe" href="https://mahasiswa.feb.unismuh.ac.id/assets/upload/permohonan_kkp/<?php echo $profil->nim;?>/<?php echo $profil->file_lulus_mengaji;?>"><img src="<?php echo base_url();?>assets/dist/img/pdf_icon.png" style="width: 20%; height: auto"></a>
                          <?php } else {?>
                            <a href="https://mahasiswa.feb.unismuh.ac.id/assets/upload/permohonan_kkp/<?php echo $profil->nim;?>/<?php echo $profil->file_lulus_mengaji;?>" data-fancybox data-caption="Bukti Lulus Mengaji"><img src="https://mahasiswa.feb.unismuh.ac.id/assets/upload/permohonan_kkp/<?php echo $profil->nim;?>/<?php echo $profil->file_lulus_mengaji;?>" style="width: 100%; height: auto"></a>
                          <?php } ?>
                        </div>
                        <h4>
                            <strong>Bukti Lulus Mengaji</strong>
                        </h4>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="media-items animation-fadeInQuickInv">
                        <div class="media-items-content" style="padding: 10px 0 10px">
                          <?php
                          $fl_nm = $profil->file_syahadah;
                          $arr_fl = explode(".", $fl_nm);
                          if($arr_fl[1]=="pdf")
                          { ?>
                            <a class="gallerypdf" data-fancybox-type="iframe" href="https://mahasiswa.feb.unismuh.ac.id/assets/upload/permohonan_kkp/<?php echo $profil->nim;?>/<?php echo $profil->file_syahadah;?>"><img src="<?php echo base_url();?>assets/dist/img/pdf_icon.png" style="width: 20%; height: auto"></a>
                          <?php } else {?>
                            <a href="https://mahasiswa.feb.unismuh.ac.id/assets/upload/permohonan_kkp/<?php echo $profil->nim;?>/<?php echo $profil->file_syahadah;?>" data-fancybox data-caption="Syahadah atau Surat Keterangan DAD atau BA"><img src="https://mahasiswa.feb.unismuh.ac.id/assets/upload/permohonan_kkp/<?php echo $profil->nim;?>/<?php echo $profil->file_syahadah;?>" style="width: 100%; height: auto"></a>
                          <?php } ?>
                        </div>
                        <h4>
                            <strong>Syahadah atau Surat Keterangan DAD atau BA</strong>
                        </h4>
                    </div>
                </div>
              </div>
            </fieldset>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.fancybox.min.js"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
      $(".gallerypdf").fancybox(
        {
            openEffect: 'elastic',
            closeEffect: 'elastic',
            autoSize: true,
            type: 'iframe',
            iframe: {
                preload: false // fixes issue with iframe and IE
            }
        });
        $("#tbl_filter").on("click", function()
        {
          var pil_ta = $("#pil_ta").val();
          var pil_ps = $("#pil_ps").val();
          $("#view_result").load("<?php echo base_url();?>permohonan_kkp/filter_data/"+pil_ta+"/"+pil_ps);
        });
    });
</script>