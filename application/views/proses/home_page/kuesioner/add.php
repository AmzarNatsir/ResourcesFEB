<div class="content-wrapper">
  <section class="content-header">
    <h1>Home Page<small>Kuesioner</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url();?>kuesioner"><i class="fa fa-home"></i> List Kuesioner</a></li>
      <li class="active">Buat Kuesioner Baru</li>
    </ol>
  </section>
  <section class="content">
    <?php if ($this->session->flashdata('info')): ?>
      <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-info"></i> Konfirmasi !</h4>
        <?php echo $this->session->flashdata('info'); ?>
      </div>
    <?php endif; ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Form pembuatan kuesioner</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
             <form class="form-horizontal" name="frm_kue" method="post" action="<?php echo site_url();?>kuesioner/simpan_kue_h" onsubmit="return konfirm()">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Masa Aktif</label>
                    <div class="col-sm-4">
                      <div class="input-group input-daterange" data-date-format="mm/dd/yyyy">
                          <input type="text" id="tgl_start" name="tgl_start" class="form-control text-center" placeholder="Tanggal Mulai" required>
                          <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                          <input type="text" id="tgl_end" name="tgl_end" class="form-control text-center" placeholder="Tanggal Selesai" required>
                      </div>
                    </div>
                    <label class="col-sm-2 col-form-label">Display</label>
                    <div class="col-sm-4">
                      <select class="form-control select2" name="pil_display[]" id="pil_display" multiple="multiple" data-placeholder="Pilih display kuesioner" style="width: 100%;" required>
                        <option value="0">- Pilihan -</option>
                        <?php $arr_disp = array("1"=>"Umum", "2"=>"Mahasiswa", "3"=>"Dosen", "4"=>"Pegawai");
                        foreach($arr_disp as $key1 => $value1)
                        {
                            echo "<option value=".$key1.">".$value1."</option>";
                        } ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-6">
                    <label for="ket_kuesioner_awal">Redaksi Pembuka</label>
                    <textarea name="ket_kuesioner_awal" id="ket_kuesioner_awal" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #000; padding: 10px;"></textarea>
                  </div>
                  <div class="col-sm-6">
                    <label for="ket_kuesioner_akhir">Redaksi Penutup</label>
                    <textarea name="ket_kuesioner_akhir" id="ket_kuesioner_akhir" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #000; padding: 10px;"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis Kuesioner</label>
                    <div class="col-sm-2">
                        <select class="form-control" name="pil_jenis_kuesioner" id="pil_jenis_kuesioner">
                          <option value="1" selected>Multiple Choice</option>
                          <option value="2">Essay</option>
                          <option value="3">Collaboration</option>
                        </select>
                    </div>
                    <label class="col-sm-2 col-form-label">Kriteria Kuesioner</label>
                    <div class="col-sm-2">
                        <select class="form-control" name="pil_kriteria_kuesioner" id="pil_kriteria_kuesioner">
                          <option value="1">Skala Likert</option>
                          <option value="2">Skala Gutman</option>
                          <!--<option value="3">Skala Semantik</option>-->
                        </select>
                    </div>
                    <label class="col-sm-2 col-form-label">Jumlah Pilihan Jawaban</label>
                    <div class="col-sm-2">
                        <select class="form-control" name="pil_jumlah_pilihan" id="pil_jumlah_pilihan">
                          <option value="1">2 Pilihan</option>
                          <option value="2">3 Pilihan</option>
                          <option value="3">4 Pilihan</option>
                          <option value="4">5 Pilihan</option>
                          <option value="5">6 Pilihan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tema Kuesioner</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="tema_kuesioner" name="tema_kuesioner"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-2"></div>
                  <div class="col-md-10">
                    <label class="checkbox-inline" for="check_subtema">
                        <input type="checkbox" id="check_subtema" name="check_subtema"> Beri tanda centang jika ingin menambahkan sub tema
                    </label>
                  </div>
                </div>
                <div id="posSubTema" style="display: none">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Sub Tema</label>
                        <div class="col-sm-9">
                          <textarea class="form-control" id="subtema_kuesioner[]" name="subtema_kuesioner[]"></textarea>
                      </div>
                      <div class="col-md-1">
                        <button type="button" id="addSubTema" data-toggle="tooltip" data-placement="right" data-original-title="Tambah Sub Tema" class="btn btn-success btn-sm waves-effect waves-light"><i class="fa fa-plus"></i></button>   
                      </div>
                    </div>
                </div>
                <div class="form-footer">
                  <button type="submit" class="btn btn-success tbl_simpan_h"><i class="fa fa-check-square-o"></i> SIMPAN</button>.
                  <hr>
                  <code>* Klik tombol simpan untuk menyimpan tema dan keterangan kuesioner. Selanjutnya masuk ke tahap pembuatan pertanyaan.</code>
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
    CKEDITOR.replace('ket_kuesioner_awal');
    CKEDITOR.replace('ket_kuesioner_akhir');
    $('.input-datepicker, .input-daterange').datepicker({weekStart: 1, format:'dd/mm/yyyy'});
        $('.input-datepicker-close').datepicker({weekStart: 1}).on('changeDate', function(e){ $(this).datepicker('hide'); });

    $("#pil_jenis_kuesioner").on("change", function()
    {
      var pil = $("#pil_jenis_kuesioner").val();
      $("#pil_jumlah_pilihan").empty();
      $("#pil_kriteria_kuesioner").empty();
      if(pil==1)
      {
        $("#pil_jumlah_pilihan").append(`
          <option value="1">2 Pilihan</option>
          <option value="2">3 Pilihan</option>
          <option value="3">4 Pilihan</option>
          <option value="4">5 Pilihan</option>
          <option value="5">6 Pilihan</option>
          `);
        $("#pil_kriteria_kuesioner").append(`
          <option value="1">Skala Likert</option>
          <option value="2">Skala Gutman</option>
          `);
      } else if(pil==2)
      {
        $("#pil_jumlah_pilihan").append(`
          <option value="7">Tidak Ada Pilihan</option>
          `);
        $("#pil_kriteria_kuesioner").append(`
          <option value="0">- Pilihan -</option>
          `);
      } else {
        $("#pil_jumlah_pilihan").append(`
          <option value="6" selected >Collaboration</option>
          `);
        $("#pil_kriteria_kuesioner").append(`
          <option value="0">- Pilihan -</option>
          `);
      }
    });
    $("#pil_kriteria_kuesioner").on("change", function()
    {
      var pil_krit = $("#pil_kriteria_kuesioner").val();
      $("#pil_jumlah_pilihan").empty();
      if(pil_krit==1)
      {
        $("#pil_jumlah_pilihan").append(`
          <option value="1">2 Pilihan</option>
          <option value="2">3 Pilihan</option>
          <option value="3">4 Pilihan</option>
          <option value="4">5 Pilihan</option>
          <option value="5">6 Pilihan</option>
          `);
      } else {
        $("#pil_jumlah_pilihan").append(`
          <option value="1" selected>2 Pilihan</option>
          `);
      }
    });
    $("#check_subtema").on("click", function(event)
    {
        var stscheck = $(this).prop("checked");
        if(stscheck == true){
          $("#posSubTema").show();
        } else {
          $("#posSubTema").hide();
        }
    });
    $("#addSubTema").on('click', function(e){
        e.preventDefault();
            let content = `<div class="form-group row"><label class="col-sm-2 col-form-label"></label><div class="col-md-9"><textarea class="form-control" id="subtema_kuesioner[]" name="subtema_kuesioner[]"></textarea></div><div class="col-md-1"><button id="removeSubTema" rel="tooltip" name="btnRemove[]" data-toggle="tooltip" data-placement="right" data-original-title="Hapus Sub Tema"class="btn btn-danger btn-sm waves-effect waves-light"><i class="fa fa-minus"></i></button></div></div>`
            $("#posSubTema").append(content);
        $("#posSubTema").on('click','#removeSubTema',function(e){
            e.preventDefault();
            $(this).closest('div.form-group').remove();                                          
        });
    });
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