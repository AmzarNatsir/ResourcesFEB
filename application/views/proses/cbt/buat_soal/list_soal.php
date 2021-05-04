<div class="content-wrapper">
    <section class="content-header">
        <h1>Computer Based Test (CBT) <small>Bank Soal</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><i class="fa fa-table"></i> Daftar Soal</li>
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
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">BANK SOAL</h3>
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
                        <h3 class="box-title">DETAIL SOAL</h3>
                        <hr>
                        <div class="table-responsive">
                        <table class="table" width="100%">
                            <thead>
                                <th>No.</th>
                                <th>Soal</th>
                            </thead>
                            <tbody>
                                <?php
                                $nom=1;
                                foreach ($dt_d as $dt2) 
                                {
                                    ?>
                                    <tr>
                                        <td style="width: 5%" valign="top"><?php echo $nom?></td>
                                        <td style="width: 95%" colspan="8"><font color="blue"><?php echo $dt2['soal_teks'];?></font>
                                            <?php
                                            if($dt2['kat_gambar']==1)
                                            {
                                                ?>
                                                <br>
                                                <img src="<?php echo base_url();?>assets/upload/cbt/head/<?php echo $dt2['soal_gambar'];?>" width="300px">
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td style="width: 4%" valign="top"><strong>A.</strong></td>
                                        <td style="width: 20%" valign="top"><?php 
                                        if($dt2['s_a']==1) 
                                        { 
                                            echo $dt2['a_1']; 
                                        } 
                                        else 
                                        { ?>
                                            <img src="<?php echo base_url();?>assets/upload/cbt/detail/<?php echo $dt2['a_2'];?>" width="100px">
                                        <?php
                                        }
                                        ?></td>

                                        <td style="width: 4%" valign="top"><strong>B.</strong></td>
                                        <td style="width: 20%" valign="top"><?php 
                                        if($dt2['s_b']==1) 
                                        { 
                                            echo $dt2['b_1']; 
                                        }
                                        else
                                        {
                                            ?>
                                            <img src="<?php echo base_url();?>assets/upload/cbt/detail/<?php echo $dt2['b_2'];?>" width="100px">
                                            <?php
                                        }?>
                                            

                                        </td>

                                        <td style="width: 4%" valign="top"><strong>C.</strong></td>
                                        <td style="width: 20%" valign="top"><?php 
                                        if($dt2['s_c']==1) 
                                        { 
                                            echo $dt2['c_1']; 
                                        }
                                        else
                                        {
                                            ?>
                                            <img src="<?php echo base_url();?>assets/upload/cbt/detail/<?php echo $dt2['c_2'];?>" width="100px">
                                            <?php
                                        }?></td>

                                        <td style="width: 4%" valign="top"><strong>D.</strong></td>
                                        <td style="width: 20%" valign="top"><?php 
                                        if($dt2['s_d']==1) 
                                        { 
                                            echo $dt2['d_1']; 
                                        }
                                        else
                                        {
                                            ?>
                                            <img src="<?php echo base_url();?>assets/upload/cbt/detail/<?php echo $dt2['d_2'];?>" width="100px">
                                            <?php
                                        }?></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="8"><font color="red"><strong>Jawaban : <?php echo $dt2['jawaban'];?></strong></font></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="8"><button class="btn btn-primary tbl_edit" name="tbl_edit" id="<?php echo $dt2['id'];?>">Edit Soal</button> | <a href="<?php echo site_url();?>cbt/hapus_soal_detail/<?php echo encrypt_decrypt('encrypt', $dt2['id']);?>" class="btn btn-warning" onclick="return konfHapus()">Hapus Soal</a></td>
                                    </tr>
                                    <?php
                                    $nom++;
                                }
                                
                                ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
$(document).ready(function()
{
    window.setTimeout(function () { $(".alert").alert('close'); }, 2000);
});
var konfHapus = function()
{
    var pesan = confirm("Yakin akan menghapus data ?");
    if(pesan==true)
    {
        return true;
    } else {
        return false;
    }
}
</script>