<table class="table" style="width: 100%;">
    <thead>
    <th style="width: 5%;">No</th>
    <th style="width: 15%;">Kode Soal</th>
    <th>Team Pembuat Soal</th>
    <th style="width: 10%;">Soal</th>
    <th style="width: 10%;">Aksi</th>
    </thead>
    <tbod>
    <?php
    if(count($list_soal)<=0) {?>
    <tr>
    <td colspan="4" style="text-align: center;">Belum Ada Soal..</td>
    </tr>
    <?php } else {
    $nom=1;
    foreach($list_soal as $dt) {    
    ?>
    <tr>
    <td><?= $nom ?></td>
    <td><?= $dt['kode_soal'] ?></td>
    <td><?php 
    $arr_dosen = explode(",", $dt['team_dosen']);
    for ($i=0; $i < count($arr_dosen); $i++) 
    { 
        $all_dosen[] = $this->model_dosen->get_profil_dosen($arr_dosen[$i])->nama_dosen;
    }
    $nom=1;
    foreach ($all_dosen as $key => $value) {
        echo $nom.". ".$value."<br>";
        $nom++;
    }
    unset($all_dosen); ?></td>
    <td><?php echo count($this->model_cbt->get_detail_soal($dt['id']));?> Soal</td>
    <td>
    <a href="#"><i class="btn btn-primary fa fa-plus-square-o add_data" title="Tambah Data Soal" id="<?php echo encrypt_decrypt('encrypt', $dt['id']);?>"></i></a>
    </td>
    </tr>
    <?php 
    $nom++; }
    } ?>
    </tbod>
</table>
<script>
$(document).ready(function()
{
    $(".add_data").on("click", function()
    {
        var id_soal = this.id;
        window.location.assign("<?php echo site_url();?>cbt/tambah_soal/"+id_soal);
    });
});
</script>