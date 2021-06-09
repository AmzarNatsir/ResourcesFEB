<form action="<?php echo base_url();?>cbt/simpan_peserta" method="post" onsubmit="return konfirm()">
    <input type="hidden" name="id_soal" id="id_soal" value="<?php echo $head_jadwal->id;?>">
    <input type="hidden" name="kd_soal" id="kd_soal" value="<?php echo $head_jadwal->kode_ujian;?>">
    <div class="modal-body">
        <div class="box-body">
            <div class="panel-body">
                <table class="table" style="width: 100%;">
                <caption><strong>Check list mahasiswa yang akan mengikuti ujian pada daftar dibawah</strong></caption>
                <tr>
                    <td style="width: 5%">Act</td>
                    <td style="width: 15%;">NIM</td>
                    <td>Nama Mahasiswa</td>
                </tr>
                <?php 
                foreach($list_mahasiswa as $mhs) {
                    $sts_check = "";
                    foreach($list_peserta as $psrt) {
                        if($mhs['id_mahasiswa']==$psrt['id_mahasiswa']) {
                            $sts_check = "checked disabled";
                        }
                    }
                    ?>
                    <tr>
                        <td><input name="mahasiswa_id[]" type="checkbox" value="<?php echo $mhs['id_mahasiswa'];?>" class="custom-control-input" id="<?php echo $mhs['id_mahasiswa'];?>" data-parsley-mincheck="2" <?= $sts_check ?>></td>
                        <td><?php echo $mhs['nim'];?></td>
                        <td><?php echo $mhs['nama_mahasiswa'];?></td>
                    </tr>
                    <?php
                 } ?>
                 <tfoot>
                 <tr>
                 <td colspan="3">
                 <hr>
                 <button type="submit" name="tbl_simpan_peserta" id="tbl_simpan_peserta" class="btn btn-primary">Simpan Peserta</button></td>
                 </tr>
                 </tfoot>
                </table>
            </div>
        </div>
    </div>
</form>