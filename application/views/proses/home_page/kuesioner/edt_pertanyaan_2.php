<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                        <label class="col-sm-3 col-form-label">Jenis Kuesioner</label>
                        <label class="col-sm-3 col-form-label">: <?php 
                        $arr_jenis = array("1"=>"Multiple Choice", "2"=>"Essay", "3"=>"Collaboration");
                        foreach ($arr_jenis as $key => $value) {
                          if($key==$dt_subtema->jenis_kuesioner)
                          {
                            echo $value;
                          }
                        }?></label>
                        <label class="col-sm-3 col-form-label">Status</label>
                        <label class="col-sm-3 col-form-label">: <?php if($dt_subtema->status==1) { echo "Aktif"; } else { echo "Tidak Aktif"; } ?></label>
                    </div>
                <div class="form-group">
                    <label class="col-sm-3 col-form-label">Tema Kuesioner</label>
                    <label class="col-sm-9 col-form-label">: <?php echo $dt_subtema->tema_kue;?></label>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-form-label">Sub Tema Kuesioner</label>
                    <label class="col-sm-9 col-form-label">: <?php echo $dt_subtema->sub_tema;?></label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header" style="text-align: center;">
                <h3 class="box-title">Form edit pertanyaan kuesioner</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form class="form-horizontal" name="frm_kue_pertanyaan" method="post" action="<?php echo site_url();?>kuesioner/rubah_kue_d" onsubmit="return konfirm()">
                    <input type="hidden" name="id_head" id="id_head" value="<?php echo $dt_dk->idh;?>">
                    <input type="hidden" name="id_detail" id="id_detail" value="<?php echo $dt_dk->id;?>">
                    <input type="hidden" name="id_jenis_kues" id="id_jenis_kues" value="<?php echo $dt_dk->tipe_jawaban;?>">
                    <input type="hidden" name="id_jumlah_pilihan" id="id_jumlah_pilihan" value="<?php echo $dt_dk->jumlah_pilihan;?>">
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label">Pertanyaan</label>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12"><textarea class="form-control" name="inp_pertanyaan" id="inp_pertanyaan" required><?php echo $dt_dk->pertanyaan;?></textarea></div>
                    </div>
                    <?php if($dt_dk->tipe_jawaban==1 && $dt_dk->jumlah_pilihan==1) {?>
                        <div class="form-group row">
                          <label class="col-sm-12 col-form-label">Pilihan Jawaban</label>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label">A.</label>
                          <div class="col-sm-11">
                              <input type="text" name="p_j_1" id="p_j_1" class="form-control" maxlength="100" value="<?php echo $dt_dk->pil_1;?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label">B.</label>
                          <div class="col-sm-11">
                              <input type="text" name="p_j_2" id="p_j_2" class="form-control" maxlength="100" value="<?php echo $dt_dk->pil_2;?>" required>
                          </div>
                        </div>
                    <?php } ?>
                    <?php if($dt_dk->tipe_jawaban==1 && $dt_dk->jumlah_pilihan==2) {?>
                        <div class="form-group row">
                          <label class="col-sm-12 col-form-label">Pilihan Jawaban</label>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label">A.</label>
                          <div class="col-sm-11">
                              <input type="text" name="p_j_1" id="p_j_1" class="form-control" maxlength="100" value="<?php echo $dt_dk->pil_1;?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label">B.</label>
                          <div class="col-sm-11">
                              <input type="text" name="p_j_2" id="p_j_2" class="form-control" maxlength="100" value="<?php echo $dt_dk->pil_2;?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label">C.</label>
                          <div class="col-sm-11">
                              <input type="text" name="p_j_3" id="p_j_3" class="form-control" maxlength="100" value="<?php echo $dt_dk->pil_3;?>" required>
                          </div>
                        </div>
                    <?php } ?>
                    <?php if($dt_dk->tipe_jawaban==1 && $dt_dk->jumlah_pilihan==3) {?>
                        <div class="form-group row">
                          <label class="col-sm-12 col-form-label">Pilihan Jawaban</label>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label">A.</label>
                          <div class="col-sm-11">
                              <input type="text" name="p_j_1" id="p_j_1" class="form-control" maxlength="100" value="<?php echo $dt_dk->pil_1;?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label">B.</label>
                          <div class="col-sm-11">
                              <input type="text" name="p_j_2" id="p_j_2" class="form-control" maxlength="100" value="<?php echo $dt_dk->pil_2;?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label">C.</label>
                          <div class="col-sm-11">
                              <input type="text" name="p_j_3" id="p_j_3" class="form-control" maxlength="100" value="<?php echo $dt_dk->pil_3;?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label">D.</label>
                          <div class="col-sm-11">
                              <input type="text" name="p_j_4" id="p_j_4" class="form-control" maxlength="100" value="<?php echo $dt_dk->pil_4;?>" required>
                          </div>
                        </div>
                    <?php } ?>
                    <?php if($dt_dk->tipe_jawaban==1 && $dt_dk->jumlah_pilihan==4) {?>
                        <div class="form-group row">
                          <label class="col-sm-12 col-form-label">Pilihan Jawaban</label>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label">A.</label>
                          <div class="col-sm-11">
                              <input type="text" name="p_j_1" id="p_j_1" class="form-control" maxlength="100" value="<?php echo $dt_dk->pil_1;?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label">B.</label>
                          <div class="col-sm-11">
                              <input type="text" name="p_j_2" id="p_j_2" class="form-control" maxlength="100" value="<?php echo $dt_dk->pil_2;?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label">C.</label>
                          <div class="col-sm-11">
                              <input type="text" name="p_j_3" id="p_j_3" class="form-control" maxlength="100" value="<?php echo $dt_dk->pil_3;?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label">D.</label>
                          <div class="col-sm-11">
                              <input type="text" name="p_j_4" id="p_j_4" class="form-control" maxlength="100" value="<?php echo $dt_dk->pil_4;?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label">E.</label>
                          <div class="col-sm-11">
                              <input type="text" name="p_j_5" id="p_j_5" class="form-control" maxlength="100" value="<?php echo $dt_dk->pil_5;?>" required>
                          </div>
                        </div>
                    <?php } ?>
                    <?php if($dt_dk->tipe_jawaban==1 && $dt_dk->jumlah_pilihan==5) {?>
                        <div class="form-group row">
                          <label class="col-sm-12 col-form-label">Pilihan Jawaban</label>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label">A.</label>
                          <div class="col-sm-11">
                              <input type="text" name="p_j_1" id="p_j_1" class="form-control" maxlength="100" value="<?php echo $dt_dk->pil_1;?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label">B.</label>
                          <div class="col-sm-11">
                              <input type="text" name="p_j_2" id="p_j_2" class="form-control" maxlength="100" value="<?php echo $dt_dk->pil_2;?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label">C.</label>
                          <div class="col-sm-11">
                              <input type="text" name="p_j_3" id="p_j_3" class="form-control" maxlength="100" value="<?php echo $dt_dk->pil_3;?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label">D.</label>
                          <div class="col-sm-11">
                              <input type="text" name="p_j_4" id="p_j_4" class="form-control" maxlength="100" value="<?php echo $dt_dk->pil_4;?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label">E.</label>
                          <div class="col-sm-11">
                              <input type="text" name="p_j_5" id="p_j_5" class="form-control" maxlength="100" value="<?php echo $dt_dk->pil_5;?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label">F.</label>
                          <div class="col-sm-11">
                              <input type="text" name="p_j_6" id="p_j_6" class="form-control" maxlength="100" value="<?php echo $dt_dk->pil_6;?>" required>
                          </div>
                        </div>
                    <?php } ?>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary tbl_simpan_h">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>