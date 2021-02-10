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
                <h3 class="box-title">Form pembuatan pertanyaan kuesioner</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form class="form-horizontal" name="frm_kue_pertanyaan" method="post" action="<?php echo site_url();?>kuesioner/simpan_kue_d" onsubmit="return konfirm()">
                    <input type="hidden" name="id_head_enc" id="id_head_enc" value="<?php echo encrypt_decrypt('encrypt', $dt_subtema->idh);?>">
                    <input type="hidden" name="id_head" id="id_head" value="<?php echo $dt_subtema->idh;?>">
                    <input type="hidden" name="pil_jenis_kue_head" id="pil_jenis_kue_head" value="<?php echo $dt_subtema->jenis_kuesioner;?>">
                    <input type="hidden" name="id_subtema" id="id_subtema" value="<?php echo $dt_subtema->id;?>">
                    <input type="hidden" name="sub_tema" id="sub_tema" value="<?php echo $dt_subtema->pil_subtema;?>">
                    <input type="hidden" name="pil_kriteria_kue" id="pil_kriteria_kue" value="<?php echo $dt_subtema->kat_kue;?>">
                    <input type="hidden" name="jumlah_pil_head" id="jumlah_pil_head" value="<?php echo $dt_subtema->jumlah_pilihan;?>">

                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label">Pertanyaan</label>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12"><textarea class="form-control" name="inp_pertanyaan" id="inp_pertanyaan" required></textarea></div>
                    </div>
                    <?php
                    if($dt_subtema->jenis_kuesioner==1) { ?>
                      <?php if($dt_subtema->kat_kue==1) { ?>
                        <div class="form-group row">
                          <label class="col-sm-12 col-form-label">Pilihan Jawaban</label>
                        </div>
                        <?php if($dt_subtema->jumlah_pilihan==1) { ?>
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
                        <?php } elseif($dt_subtema->jumlah_pilihan==2) { ?>
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
                        <?php } elseif($dt_subtema->jumlah_pilihan==3) { ?>
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
                        <?php } elseif($dt_subtema->jumlah_pilihan==4) { ?>
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
                        <?php } elseif($dt_subtema->jumlah_pilihan==5) { ?>
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
                    if($dt_subtema->jenis_kuesioner==3) { ?>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary tbl_simpan_h">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function()
  {
    //window.setTimeout(function() { $(".alert").alert('close'); }, 2000);
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