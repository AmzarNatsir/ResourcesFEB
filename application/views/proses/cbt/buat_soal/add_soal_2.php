<div class="content-wrapper">
    <section class="content-header">
        <h1>Computer Based Test (CBT) <small>Buat Soal</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><i class="fa fa-pencil"></i> Buat Soal</li>
            <li><a href="<?php echo base_url();?>cbt/daftar_soal/<?php echo encrypt_decrypt('encrypt', $dt_h->id);?>" target="_new"><i class="fa fa-table"></i> Daftar Soal</a></li>
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
        <form class="form-horizontal" name="form_buat_soal">
        <div class="row">
        <div class="col-md-12">
            <input type="hidden" name="id_soal" id="id_soal" value="<?php echo encrypt_decrypt('encrypt', $dt_h->id);?>">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">FORM PEMBUATAN SOAL</h3>
                    <hr>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label-left">KODE SOAL</label>
                            <label class="col-sm-4 control-label-left">:
                            <?php echo $dt_h->kode_soal;?>
                            </label>
                            <label class="col-sm-2 control-label-left">PROGRAM STUDI</label>
                            <label class="col-sm-4 control-label-left">:
                            <?php echo $dt_h->nama_ps;?>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label-left">MATAKULIAH</label>
                            <label class="col-sm-4 control-label-left">: <?php echo $dt_h->nama_matakuliah;?></label>
                            <label class="col-sm-2 control-label-left">TEAM</label>
                            <label class="col-sm-4 control-label-left">: <?php
                            $arr_dosen = explode(",", $dt_h->team_dosen);
                            for ($i=0; $i < count($arr_dosen); $i++) 
                            { 
                                $all_dosen[] = $this->model_dosen->get_profil_dosen($arr_dosen[$i])->nama_dosen;
                            }
                            $nom=1;
                            foreach ($all_dosen as $key => $value) {
                                echo $nom.". ".$value."<br>";
                                $nom++;
                            }
                            unset($all_dosen);
                            ?></label>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                    <h3 class="box-title">INPUT SOAL</h3>
                    <hr>
                    <div class="panel-body">
                        <div class="form-group row">
                            <label class="col-sm-1 control-label-left">Soal</label>
                            <div class="col-sm-9" id="soal_tks">
                                <div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor">
                                    <textarea class="form-control" id="editor" name="isi_soal"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="checkbox">
                                    <label><input type="checkbox" id="soal_teks" name="soal_teks" checked disabled> Text</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" id="pil_soal_gbr" name="pil_soal_gbr"> Image</label>
                                </div>
                            </div>
                            <div class="col-sm-9" id="soal_gbr" style="display: none;">
                                <div class="col-lg-offset-1 col-lg-11">
                                <br>
                                    <input type="file" id="soal_gambar" name="soal_gambar"><p class="help-block">Masukkan File Gambar</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 control-label-left">Pilihan Jawaban</label>
                        </div>
                        <hr>

                        <div class="form-group row">
                            <label class="col-sm-1 control-label-left">A</label>
                            <div class="col-sm-9" id="kolom_tks_a">
                                <div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor_a">
                                    <textarea class="form-control" id="editor_a" name="isi_pil_jawaban_a"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-9" id="kolom_gbr_a" style="display: none;">
                                <input type="file" id="j_gbr_a" name="file_a"><p class="help-block">Masukkan File Gambar</p>
                            </div>
                            <div class="col-sm-2">
                                <div class="radio">
                                        <label><input type="radio" id="1" name="j_a" value="1" checked> Text</label>
                                </div>
                                <div class="radio">
                                        <label><input type="radio" id="2" name="j_a" value="2"> Image</label>
                                </div>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-sm-1 control-label-left">B</label>
                            <div class="col-sm-9" id="kolom_tks_b">
                                <div class="btn-toolbar" data-role="editor-toolbar"
        data-target="#editor_b">
                                    <textarea class="form-control" id="editor_b" name="isi_pil_jawaban_b"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-9" id="kolom_gbr_b" style="display: none;">
                                <input type="file" id="j_gbr_b" name="file_b"><p class="help-block">Masukkan File Gambar</p>
                            </div>
                            <div class="col-sm-2">
                                <div class="radio">
                                        <label><input type="radio" id="1" name="j_b" value="1" checked> Text</label>
                                </div>
                                <div class="radio">
                                        <label><input type="radio" id="2" name="j_b" value="2"> Image</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-1 control-label-left">C</label>
                            <div class="col-sm-9" id="kolom_tks_c">
                                <div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor_c">
                                    <textarea class="form-control" id="editor_c" name="isi_pil_jawaban_c"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-9" id="kolom_gbr_c" style="display: none;">
                                <input type="file" id="j_gbr_c" name="file_c"><p class="help-block">Masukkan File Gambar</p>
                            </div>
                            <div class="col-sm-2">
                                <div class="radio">
                                        <label><input type="radio" id="1" name="j_c" value="1" checked> Text</label>
                                </div>
                                <div class="radio">
                                        <label><input type="radio" id="2" name="j_c" value="2"> Image</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-1 control-label-left">D</label>
                            <div class="col-sm-9" id="kolom_tks_d">
                                <div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor_d">
                                    <textarea class="form-control" id="editor_d" name="isi_pil_jawaban_d"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-9" id="kolom_gbr_d" style="display: none;">
                                <input type="file" id="j_gbr_d" name="file_d"><p class="help-block">Masukkan File Gambar</p>
                            </div>
                            <div class="col-sm-2">
                                <div class="radio">
                                    <label><input type="radio" id="1" name="j_d" value="1" checked> Text</label>
                                </div>
                                <div class="radio">
                                        <label><input type="radio" id="2" name="j_d" value="2"> Image</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-1 control-label-left">Jawaban</label>
                            <div class="col-sm-11">
                                <input type="text" class="form-control" id="jawaban" name="jawaban" maxlength="1" style="width:50px">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group" align="center">
                            <div class="col-sm-12">
                            <button type="button" class="btn btn-danger" id="tbl_simpan" name="tbl_simpan">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </form>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function()
    {
      window.setTimeout(function() { $(".alert").alert('close'); }, 2000);
      $('.select2').select2();
      CKEDITOR.replace( 'isi_soal', {
            uiColor: '#368EE0',
            height : 100,
            toolbar: [
                [ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList'],
                [ 'FontSize', 'TextColor', 'BGColor' ]
            ]
        });
        CKEDITOR.replace( 'isi_pil_jawaban_a', {
            uiColor: '#368EE0',
            height : 100,
            toolbar: [
                [ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList'],
                [ 'FontSize', 'TextColor', 'BGColor' ]
            ]
        });
        CKEDITOR.replace( 'isi_pil_jawaban_b', {
            uiColor: '#368EE0',
            height : 100,
            toolbar: [
                [ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList'],
                [ 'FontSize', 'TextColor', 'BGColor' ]
            ]
        });
        CKEDITOR.replace( 'isi_pil_jawaban_c', {
            uiColor: '#368EE0',
            height : 100,
            toolbar: [
                [ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList'],
                [ 'FontSize', 'TextColor', 'BGColor' ]
            ]
        });
        CKEDITOR.replace( 'isi_pil_jawaban_d', {
            uiColor: '#368EE0',
            height : 100,
            toolbar: [
                [ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList'],
                [ 'FontSize', 'TextColor', 'BGColor' ]
            ]
        });
        $("#pil_soal_gbr").on("click", function()
        {
            check = $("#pil_soal_gbr").is(":checked");
            if(check)
            {
                $("#soal_gbr").show();
            }
            else
            {
                $("#soal_gbr").hide();
            }
        });
        $("input:radio[name=j_a]").on("click", function()
        {
            var pil_val = $(this).attr('id');
            if(pil_val==1)
            {
                $("#kolom_tks_a").show();
                $("#kolom_gbr_a").hide();
            }
            else
            {
                $("#kolom_tks_a").hide();
                $("#kolom_gbr_a").show();
            }
        });
        $("input:radio[name=j_b]").on("click", function()
        {
            var pil_val = $(this).attr('id');
            if(pil_val==1)
            {
                $("#kolom_tks_b").show();
                $("#kolom_gbr_b").hide();
            }
            else
            {
                $("#kolom_tks_b").hide();
                $("#kolom_gbr_b").show();
            }
        });
        $("input:radio[name=j_c]").on("click", function()
        {
            var pil_val = $(this).attr('id');
            if(pil_val==1)
            {
                $("#kolom_tks_c").show();
                $("#kolom_gbr_c").hide();
            }
            else
            {
                $("#kolom_tks_c").hide();
                $("#kolom_gbr_c").show();
            }
        });
        $("input:radio[name=j_d]").on("click", function()
        {
            var pil_val = $(this).attr('id');
            if(pil_val==1)
            {
                $("#kolom_tks_d").show();
                $("#kolom_gbr_d").hide();
            }
            else
            {
                $("#kolom_tks_d").hide();
                $("#kolom_gbr_d").show();
            }
        });
        $("#tbl_simpan").on("click", function()
        {
            var form = $('form').get(0); 
            var dataform = new FormData(form);
            //field tabel head
            var id_head = $("#id_soal").val();
            //field tabel soal
            var isi_soal = CKEDITOR.instances['editor'].getData();
            dataform.append('v_isi_soal', isi_soal);
            var jawaban = $("#jawaban").val();
            var pil_sts_a = $("input:radio[name=j_a]:checked").attr('id');
            var pil_sts_b = $("input:radio[name=j_b]:checked").attr('id');
            var pil_sts_c = $("input:radio[name=j_c]:checked").attr('id');
            var pil_sts_d = $("input:radio[name=j_d]:checked").attr('id');
            var isi_pil_a = CKEDITOR.instances['editor_a'].getData();
            var isi_pil_b = CKEDITOR.instances['editor_b'].getData();
            var isi_pil_c = CKEDITOR.instances['editor_c'].getData();
            var isi_pil_d = CKEDITOR.instances['editor_d'].getData();
            dataform.append('v_isi_pil_a', isi_pil_a);
            dataform.append('v_isi_pil_b', isi_pil_b);
            dataform.append('v_isi_pil_c', isi_pil_c);
            dataform.append('v_isi_pil_d', isi_pil_d);
            var msg = confirm("Yakin Soal Akan Disimpan ?");
            if (msg==true) 
            {
                $.ajax (
                {
                    url : "<?php echo site_url('cbt/simpan_data');?>",
                    type : "post",
                    data : dataform,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success : function(d)
                    {
                        $dt = d.split("-");
                        if($dt[1]==1)
                        {
                            alert($dt[0]);
                            window.location.assign("<?php echo site_url();?>cbt/tambah_soal/"+id_head);
                        }
                        else
                        {
                            alert($dt[0]);
                            return false;   
                        }
                    }
                });
                return false;
            }
            else
            {
                return false;
            }
        });
    });
</script>