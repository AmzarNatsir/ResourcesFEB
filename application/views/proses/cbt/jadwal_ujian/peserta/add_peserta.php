<form action="<?php echo base_url();?>cbt/simpan_peserta" method="post" onsubmit="return konfirm()">
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
                foreach($list_mahasiswa as $mhs){
                    ?>
                    <tr>
                        <td><input name="mahasiswa_id[]" type="checkbox" value="<?php echo $mhs['id_mahasiswa'];?>" class="custom-control-input" id="<?php echo $mhs['id_mahasiswa'];?>" data-parsley-mincheck="2"></td>
                        <td><?php echo $mhs['nim'];?></td>
                        <td><?php echo $mhs['nama_mahasiswa'];?></td>
                    </tr>
                    <?php
                 } ?>
                 <tfoot>
                 <tr>
                 <td colspan="3">
                 <hr>
                 <button type="button" name="tbl_simpan_peserta" id="tbl_simpan_peserta" class="btn btn-primary">Simpan Peserta</button></td>
                 </tr>
                
                 </tfoot>
                </table>
            </div>
        </div>
    </div>
</form>