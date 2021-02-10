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
                  <input type="hidden" name="id_head_enc" id="id_head_enc" value="<?php echo encrypt_decrypt('encrypt', $dt_hk->id);?>">
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
            <h3 class="box-title">Daftar pertanyaan kuesioner</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="card-body table-responsive">
                <table class="table" width="100%" style="font-size: small;">
                    <?php $nom_subtema=1; foreach ($list_subtema as $subtema): ?>
                      <?php $result_pertanyaan = $this->Model_tmp_kuesioner->get_data_pertanyaan_subtema($dt_hk->id, $subtema['id']); ?>
                      <tr>
                        <td style="width: 3%"><strong><?php echo $nom_subtema;?></strong></td>
                        <td style="width: 80%" colspan="2"><strong><?php echo strtoupper($subtema['sub_tema']);?></strong></td>
                        <td style="width: 17%">
                          <button type="button" class="btn btn-warning tbl_add" id="<?php echo $subtema['id'];?>" data-toggle="modal" data-target="#modal-add" title="Buat pertanyaan baru"><i class="fa fa-plus"></i></button>
                        </td>
                      </tr>
                      <?php if (count($result_pertanyaan)>0): ?>
                        <?php $nom=1; foreach ($result_pertanyaan as $dl): ?>
                          <?php if ($dl['tipe_jawaban']==1): ?>
                            <tr>
                              <td style="width: 3%"></td>
                              <td style="width: 3%"><?php echo $nom;?>.</td>
                              <td style="width: 77%"><?php echo $dl['pertanyaan'];?></td>
                              <td style="width: 19%">
                                <button type="button" class="btn btn-primary tbl_edit" id="<?php echo encrypt_decrypt('encrypt', $dl['id']);?>" data-toggle="modal" data-target="#modal-edit" title="Edit pertanyaan"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-danger tbl_hapus" id="<?php echo encrypt_decrypt('encrypt', $dl['id']);?>" title="Hapus pertanyaan"><i class="fa fa-remove"></i></button>
                              </td>
                            </tr>
                            <tr>
                              <td style="width: 3%"></td>
                              <td colspan="3">
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
                              <td style="width: 3%"></td>
                              <td style="width: 3%"><?php echo $nom;?>.</td>
                              <td style="width: 77%"><?php echo $dl['pertanyaan'];?></td>
                              <td style="width: 17%">
                                <button type="button" class="btn btn-primary tbl_edit" id="<?php echo encrypt_decrypt('encrypt', $dl['id']);?>" data-toggle="modal" data-target="#modal-edit" title="Edit pertanyaan"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-danger tbl_hapus" id="<?php echo encrypt_decrypt('encrypt', $dl['id']);?>"><i class="fa fa-remove"></i></button>
                              </td>
                            </tr>
                          <?php endif ?>
                        <?php $nom++; endforeach ?>
                      <?php endif ?>
                    <?php $nom_subtema++; endforeach ?>
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
    $(".tbl_add").on("click", function()
        {
          var id_data = this.id;
          $("#frm_modal_add").load("<?php echo base_url();?>kuesioner/pertanyaan_subtema/"+id_data);
        });
    $(".tbl_edit").on("click", function()
    {
        var id_data = this.id;
        $("#frm_modal_edit").load("<?php echo base_url();?>kuesioner/edit_pertanyaan_subtema/"+id_data);
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