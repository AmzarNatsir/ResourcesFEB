<div class="content-wrapper">
  <section class="content-header">
    <h1>Home Page<small>Kuesioner</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url();?>kuesioner"><i class="fa fa-home"></i> List Kuesioner</a></li>
      <li class="active">Buat Pertanyaan Kuesioner</li>
    </ol>
  </section>
  <section class="content">
    <?php if ($this->session->flashdata('info')): ?>
      <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-info"></i> Konfirmasi !</h4>
        <?php echo $this->session->flashdata('info'); ?>
      </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tema Kuesioner</label>
                        <label class="col-sm-10 col-form-label">: <?php echo $dt_hk->tema_kue;?></label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Masa aktif</label>
                        <label class="col-sm-4 col-form-label">: <?php echo convert_tanggal($dt_hk->tgl_start);?> s/d <?php echo convert_tanggal($dt_hk->tgl_end);?></label>
                        <label class="col-sm-2 col-form-label">Display</label>
                        <label class="col-sm-4 col-form-label">: <?php if($dt_hk->display==1) { echo "Umum"; } else if($dt_hk->display==2) { echo "Mahasiswa"; } else { echo "Dosen"; }?></label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Jenis Kuesioner</label>
                        <label class="col-sm-4 col-form-label">: <?php 
                        $arr_jenis = array("1"=>"Multiple Choice", "2"=>"Essay", "3"=>"Collaboration");
                        foreach ($arr_jenis as $key => $value) {
                          if($key==$dt_hk->jenis_kuesioner)
                          {
                            echo $value;
                          }
                        }?></label>
                        <label class="col-sm-2 col-form-label">Kriteria</label>
                        <label class="col-sm-4 col-form-label">: <?php 
                        $arr_krit = array("1"=>"Skala Likert", "2"=>"Skala Gutman");
                        foreach ($arr_krit as $key => $value) {
                          if($key==$dt_hk->kat_kue)
                          {
                            echo $value;
                          } 
                        }
                        ?></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Form pembuatan pertanyaan kuesioner</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form class="form-horizontal" name="frm_kue_pertanyaan" method="post" action="<?php echo site_url();?>kuesioner/simpan_kue_d" onsubmit="return konfirm()">
              <input type="hidden" name="id_head_enc" id="id_head_enc" value="<?php echo encrypt_decrypt('encrypt', $dt_hk->id);?>">
              <input type="hidden" name="id_head" id="id_head" value="<?php echo $dt_hk->id;?>">
              <input type="hidden" name="pil_kriteria_kue" id="pil_kriteria_kue" value="<?php echo $dt_hk->kat_kue;?>">
              <input type="hidden" name="pil_jenis_kue_head" id="pil_jenis_kue_head" value="<?php echo $dt_hk->jenis_kuesioner;?>">
              <input type="hidden" name="sub_tema" id="sub_tema" value="<?php echo $dt_hk->sub_tema;?>">
              <input type="hidden" name="jumlah_pil_head" id="jumlah_pil_head" value="<?php echo $dt_hk->jumlah_pilihan;?>">
                <div class="form-group row">
                    <label class="col-sm-12 col-form-label">Pertanyaan</label>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12"><textarea class="form-control" name="inp_pertanyaan" id="inp_pertanyaan" required></textarea></div>
                </div>
                <?php
                if($dt_hk->jenis_kuesioner==1) { ?>
                  <?php if($dt_hk->kat_kue==1) { ?>
                    <div class="form-group row">
                      <label class="col-sm-12 col-form-label">Pilihan Jawaban</label>
                    </div>
                    <?php if($dt_hk->jumlah_pilihan==1) { ?>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">A.</label>
                        <div class="col-sm-11">
                            <input type="text" name="p_j_1" id="p_j_1" class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">B.</label>
                        <div class="col-sm-11">
                            <input type="text" name="p_j_2" id="p_j_2" class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <?php } elseif($dt_hk->jumlah_pilihan==2) { ?>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">A.</label>
                        <div class="col-sm-11">
                            <input type="text" name="p_j_1" id="p_j_1" class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">B.</label>
                        <div class="col-sm-11">
                            <input type="text" name="p_j_2" id="p_j_2" class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">C.</label>
                        <div class="col-sm-11">
                            <input type="text" name="p_j_3" id="p_j_3" class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <?php } elseif($dt_hk->jumlah_pilihan==3) { ?>
                    <div class="form-group row">
                      <label class="col-sm-1 col-form-label">A.</label>
                      <div class="col-sm-11">
                          <input type="text" name="p_j_1" id="p_j_1" class="form-control" maxlength="100" required>
                      </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">B.</label>
                        <div class="col-sm-11">
                            <input type="text" name="p_j_2" id="p_j_2" class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">C.</label>
                        <div class="col-sm-11">
                            <input type="text" name="p_j_3" id="p_j_3" class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">D.</label>
                        <div class="col-sm-11">
                            <input type="text" name="p_j_4" id="p_j_4" class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <?php } elseif($dt_hk->jumlah_pilihan==4) { ?>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">A.</label>
                        <div class="col-sm-11">
                            <input type="text" name="p_j_1" id="p_j_1" class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">B.</label>
                        <div class="col-sm-11">
                            <input type="text" name="p_j_2" id="p_j_2" class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">C.</label>
                        <div class="col-sm-11">
                            <input type="text" name="p_j_3" id="p_j_3" class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">D.</label>
                        <div class="col-sm-11">
                            <input type="text" name="p_j_4" id="p_j_4" class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">E.</label>
                        <div class="col-sm-11">
                            <input type="text" name="p_j_5" id="p_j_5" class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <?php } elseif($dt_hk->jumlah_pilihan==5) { ?>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">A.</label>
                        <div class="col-sm-11">
                            <input type="text" name="p_j_1" id="p_j_1" class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">B.</label>
                        <div class="col-sm-11">
                            <input type="text" name="p_j_2" id="p_j_2" class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">C.</label>
                        <div class="col-sm-11">
                            <input type="text" name="p_j_3" id="p_j_3" class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">D.</label>
                        <div class="col-sm-11">
                            <input type="text" name="p_j_4" id="p_j_4" class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">E.</label>
                        <div class="col-sm-11">
                            <input type="text" name="p_j_5" id="p_j_5" class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">F.</label>
                        <div class="col-sm-11">
                            <input type="text" name="p_j_6" id="p_j_6" class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <?php } ?>
                  <?php 
                  } else { ?>
                  <div class="form-group row">
                      <label class="col-sm-1 col-form-label">A.</label>
                      <div class="col-sm-11">
                          <input type="text" name="p_j_1" id="p_j_1" class="form-control" maxlength="100" required>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-1 col-form-label">B.</label>
                      <div class="col-sm-11">
                          <input type="text" name="p_j_2" id="p_j_2" class="form-control" maxlength="100" required>
                      </div>
                  </div>
                  <?php 
                  }
                } ?>
                <?php
                if($dt_hk->jenis_kuesioner==3) { ?>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis Kuesioner</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="pil_jenis_kuesioner" id="pil_jenis_kuesioner">
                          <option value="1" selected>Multiple Choice</option>
                          <option value="2">Essay</option>
                        </select>
                    </div>
                    <label class="col-sm-2 col-form-label">Jumlah Pilihan Jawaban</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="pil_jumlah_pilihan" id="pil_jumlah_pilihan">
                          <option value="0">-- Pilihan --</option>
                          <option value="1">2 Pilihan</option>
                          <option value="2">3 Pilihan</option>
                          <option value="3">4 Pilihan</option>
                          <option value="4">5 Pilihan</option>
                          <option value="5">6 Pilihan</option>
                        </select>
                    </div>
                  </div>
                <?php } ?>
                <div id="posSubTema"></div>
                <div class="form-footer" align="center">
                    <button type="submit" class="btn btn-success tbl_simpan_h"><i class="fa fa-check-square-o"></i> SIMPAN</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Daftar pertanyaan kuesioner</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="card-body table-responsive">
              <table class="table" width="100%" style="font-size: small;">
                <?php $nom=1; foreach ($dt_dk as $dl): ?>
                  <?php if ($dl['tipe_jawaban']==1): ?>
                    <tr>
                      <td style="width: 3%"><?php echo $nom;?>.</td>
                      <td style="width: 80%"><?php echo $dl['pertanyaan'];?></td>
                      <td style="width: 17%">
                        <button type="button" class="btn btn-primary tbl_edit" id="<?php echo encrypt_decrypt('encrypt', $dl['id']);?>" data-toggle="modal" data-target="#modal-edit" title="Edit pertanyaan"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger tbl_hapus" id="<?php echo encrypt_decrypt('encrypt', $dl['id']);?>" title="Hapus pertanyaan"><i class="fa fa-remove"></i></button>
                      </td>
                    </tr>
                    <tr>
                      <td style="width: 3%"></td>
                      <td style="width: 97%" colspan="2">
                        <?php if ($dl['jumlah_pilihan']==1): ?>
                          <a href="#" class="btn btn-alt btn-sm btn-success">A.</a> <label class="col-form-label"><?php echo $dl['pil_1'];?></label>
                          <a href="#" class="btn btn-alt btn-sm btn-success">B.</a> <label class="col-form-label"><?php echo $dl['pil_2'];?></label>
                        <?php elseif ($dl['jumlah_pilihan']==2): ?>
                          <a href="#" class="btn btn-alt btn-sm btn-success">A.</a> <label class="col-form-label"><?php echo $dl['pil_1'];?></label>
                          <a href="#" class="btn btn-alt btn-sm btn-success">B.</a> <label class="col-form-label"><?php echo $dl['pil_2'];?></label>
                          <a href="#" class="btn btn-alt btn-sm btn-success">C.</a> <label class="col-form-label"><?php echo $dl['pil_3'];?></label>
                        <?php elseif ($dl['jumlah_pilihan']==3): ?>
                          <a href="#" class="btn btn-alt btn-sm btn-success">A.</a> <label class="col-form-label"><?php echo $dl['pil_1'];?></label>
                          <a href="#" class="btn btn-alt btn-sm btn-success">B.</a> <label class="col-form-label"><?php echo $dl['pil_2'];?></label>
                          <a href="#" class="btn btn-alt btn-sm btn-success">C.</a> <label class="col-form-label"><?php echo $dl['pil_3'];?></label>
                          <a href="#" class="btn btn-alt btn-sm btn-success">D.</a> <label class="col-form-label"><?php echo $dl['pil_4'];?></label>
                        <?php elseif ($dl['jumlah_pilihan']==4): ?>
                          <a href="#" class="btn btn-alt btn-sm btn-success">A.</a> <label class="col-form-label"><?php echo $dl['pil_1'];?></label>
                          <a href="#" class="btn btn-alt btn-sm btn-success">B.</a> <label class="col-form-label"><?php echo $dl['pil_2'];?></label>
                          <a href="#" class="btn btn-alt btn-sm btn-success">C.</a> <label class="col-form-label"><?php echo $dl['pil_3'];?></label>
                          <a href="#" class="btn btn-alt btn-sm btn-success">D.</a> <label class="col-form-label"><?php echo $dl['pil_4'];?></label>
                          <a href="#" class="btn btn-alt btn-sm btn-success">E.</a> <label class="col-form-label"><?php echo $dl['pil_5'];?></label>
                        <?php else: ?>
                          <a href="#" class="btn btn-alt btn-sm btn-success">A.</a> <label class="col-form-label"><?php echo $dl['pil_1'];?></label>
                          <a href="#" class="btn btn-alt btn-sm btn-success">B.</a> <label class="col-form-label"><?php echo $dl['pil_2'];?></label>
                          <a href="#" class="btn btn-alt btn-sm btn-success">C.</a> <label class="col-form-label"><?php echo $dl['pil_3'];?></label>
                          <a href="#" class="btn btn-alt btn-sm btn-success">D.</a> <label class="col-form-label"><?php echo $dl['pil_4'];?></label>
                          <a href="#" class="btn btn-alt btn-sm btn-success">E.</a> <label class="col-form-label"><?php echo $dl['pil_5'];?></label>
                          <a href="#" class="btn btn-alt btn-sm btn-success">F.</a> <label class="col-form-label"><?php echo $dl['pil_6'];?></label>
                        <?php endif ?>
                        
                      </td>
                    </tr>
                  <?php else: ?>
                    <tr>
                      <td style="width: 3%"><?php echo $nom;?>.</td>
                      <td style="width: 80%"><?php echo $dl['pertanyaan'];?></td>
                      <td style="width: 17%">
                        <button type="button" class="btn btn-primary tbl_edit" id="<?php echo encrypt_decrypt('encrypt', $dl['id']);?>" data-toggle="modal" data-target="#modal-edit" title="Edit pertanyaan"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger tbl_hapus" id="<?php echo encrypt_decrypt('encrypt', $dl['id']);?>"><i class="fa fa-remove"></i></button>
                      </td>
                    </tr>
                  <?php endif ?>
                <?php $nom++; endforeach ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- Modal Form -->
<!-- Modal Add -->
<div class="modal modal-default fade" id="modal-add" data-backdrop="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Data</h4>
      </div>
      <div id="frm_modal_add"></div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Modal Add -->
<div class="modal modal-default fade" id="modal-edit" data-backdrop="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Data</h4>
      </div>
      <div id="frm_modal_edit"></div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
  $(document).ready(function()
  {
    window.setTimeout(function() { $(".alert").alert('close'); }, 2000);
    $(".tbl_edit").on("click", function()
    {
        var id_data = this.id;
        $("#frm_modal_edit").load("<?php echo base_url();?>kuesioner/edit_pertanyaan/"+id_data);
        //window.location.assign("<?php echo base_url();?>kuesioner/edit_pertanyaan/"+id_data);
    });
    $(".tbl_hapus").on("click", function()
    {
      var id_head = $("#id_head_enc").val();
      var id_data = this.id;
      var psn = confirm("Yakin akan menghapus data ?");
      if(psn==true)
      {
        $.ajax (
        {
            url : "<?php echo site_url();?>kuesioner/hapus_pertanyaan",
            type : "post",
            data : {id_data:id_data},
            success : function(d)
            {
                alert(d)
                window.location.assign("<?php echo base_url();?>kuesioner/pertanyaan/"+id_head);
            }
         });
      }
    });
    $("#pil_jenis_kuesioner").on("change", function()
    {
      var pil = $("#pil_jenis_kuesioner").val();
      $("#posSubTema").empty();
      $("#pil_jumlah_pilihan").empty();
      if(pil==1)
      {
        $("#pil_jumlah_pilihan").append(`
          <option value="0">Pilihan</option>
          <option value="1">2 Pilihan</option>
          <option value="2">3 Pilihan</option>
          <option value="3">4 Pilihan</option>
          <option value="4">5 Pilihan</option>
          <option value="5">6 Pilihan</option>
          `);
      } 
      else 
      {
        $("#pil_jumlah_pilihan").append(`
          <option value="7">Tidak Ada Pilihan</option>
          `);
      }
    });
    $("#pil_jumlah_pilihan").on("change", function()
    {
      var jml_pilihan = $("#pil_jumlah_pilihan").val();
      $("#posSubTema").empty();
      if(jml_pilihan==0 )
      {
        $("#posSubTema").empty();
      }
      else if(jml_pilihan==1)
      {
        $("#posSubTema").append(`
          <div class="form-group row">
              <label class="col-sm-12 col-form-label">Pilihan Jawaban</label>
          </div>
          <div class="form-group row">
              <label class="col-sm-1 col-form-label">A.</label>
              <div class="col-sm-11">
                  <input type="text" name="p_j_1" id="p_j_1" class="form-control" maxlength="100" required>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-1 col-form-label">B.</label>
              <div class="col-sm-11">
                  <input type="text" name="p_j_2" id="p_j_2" class="form-control" maxlength="100" required>
              </div>
          </div>
        `);
      } 
      else if(jml_pilihan==2)
      {
        $("#posSubTema").append(`
          <div class="form-group row">
              <label class="col-sm-12 col-form-label">Pilihan Jawaban</label>
          </div>
          <div class="form-group row">
              <label class="col-sm-1 col-form-label">A.</label>
              <div class="col-sm-11">
                  <input type="text" name="p_j_1" id="p_j_1" class="form-control" maxlength="100" required>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-1 col-form-label">B.</label>
              <div class="col-sm-11">
                  <input type="text" name="p_j_2" id="p_j_2" class="form-control" maxlength="100" required>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-1 col-form-label">C.</label>
              <div class="col-sm-11">
                  <input type="text" name="p_j_3" id="p_j_3" class="form-control" maxlength="100" required>
              </div>
          </div>
        `);
      } 
      else if(jml_pilihan==3)
      {
        $("#posSubTema").append(`
          <div class="form-group row">
                  <label class="col-sm-12 col-form-label">Pilihan Jawaban</label>
              </div>
              <div class="form-group row">
                  <label class="col-sm-1 col-form-label">A.</label>
                  <div class="col-sm-11">
                      <input type="text" name="p_j_1" id="p_j_1" class="form-control" maxlength="100" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-1 col-form-label">B.</label>
                  <div class="col-sm-11">
                      <input type="text" name="p_j_2" id="p_j_2" class="form-control" maxlength="100" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-1 col-form-label">C.</label>
                  <div class="col-sm-11">
                      <input type="text" name="p_j_3" id="p_j_3" class="form-control" maxlength="100" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-1 col-form-label">D.</label>
                  <div class="col-sm-11">
                      <input type="text" name="p_j_4" id="p_j_4" class="form-control" maxlength="100" required>
                  </div>
              </div>
        `);
      } 
      else if(jml_pilihan==4)
      {
        $("#posSubTema").append(`
          <div class="form-group row">
                  <label class="col-sm-12 col-form-label">Pilihan Jawaban</label>
              </div>
              <div class="form-group row">
                  <label class="col-sm-1 col-form-label">A.</label>
                  <div class="col-sm-11">
                      <input type="text" name="p_j_1" id="p_j_1" class="form-control" maxlength="100" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-1 col-form-label">B.</label>
                  <div class="col-sm-11">
                      <input type="text" name="p_j_2" id="p_j_2" class="form-control" maxlength="100" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-1 col-form-label">C.</label>
                  <div class="col-sm-11">
                      <input type="text" name="p_j_3" id="p_j_3" class="form-control" maxlength="100" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-1 col-form-label">D.</label>
                  <div class="col-sm-11">
                      <input type="text" name="p_j_4" id="p_j_4" class="form-control" maxlength="100" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-1 col-form-label">E.</label>
                  <div class="col-sm-11">
                      <input type="text" name="p_j_5" id="p_j_5" class="form-control" maxlength="100" required>
                  </div>
              </div>
        `);
      } 
      else if(jml_pilihan==5)
      {
        $("#posSubTema").append(`
          <div class="form-group row">
                  <label class="col-sm-12 col-form-label">Pilihan Jawaban</label>
              </div>
              <div class="form-group row">
                  <label class="col-sm-1 col-form-label">A.</label>
                  <div class="col-sm-11">
                      <input type="text" name="p_j_1" id="p_j_1" class="form-control" maxlength="100" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-1 col-form-label">B.</label>
                  <div class="col-sm-11">
                      <input type="text" name="p_j_2" id="p_j_2" class="form-control" maxlength="100" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-1 col-form-label">C.</label>
                  <div class="col-sm-11">
                      <input type="text" name="p_j_3" id="p_j_3" class="form-control" maxlength="100" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-1 col-form-label">D.</label>
                  <div class="col-sm-11">
                      <input type="text" name="p_j_4" id="p_j_4" class="form-control" maxlength="100" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-1 col-form-label">E.</label>
                  <div class="col-sm-11">
                      <input type="text" name="p_j_5" id="p_j_5" class="form-control" maxlength="100" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-1 col-form-label">F.</label>
                  <div class="col-sm-11">
                      <input type="text" name="p_j_6" id="p_j_6" class="form-control" maxlength="100" required>
                  </div>
              </div>
        `);
      }
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