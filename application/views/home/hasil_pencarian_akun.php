<?php
if(!empty($mhs_all ))  
{ ?>
  <table class="table tabel_list" width="100%">
    <thead>
        <th style="width: 5%; text-align: center;">No.</th>
        <th style="width: 10%; text-align: left;"></th>
        <th style="width: 10%; text-align: left;">NIM</th>
        <th style="width: 75%; text-align: left;">Nama Mahasiswa</th>
        <th style="width: 10%"></th>
    </thead>
    <tbody>
      <?php $nom=1; foreach ($mhs_all as $dt_mhs): ?>
        <tr>
          <td style="text-align: center;"><?php echo $nom;?></td>
          <td style="text-align: center;">
            <?php if(empty($dt_mhs['img_profil'])) { ?>
            <img class="direct-chat-img" src="<?php echo base_url();?>assets/dist/img/no_image.jpg" alt="" style="width: 60px; height: 60px; border-radius: 50%" />
            <?php } else { ?>
            <a href="https://mahasiswa.feb.unismuh.ac.id/assets/upload/profil/mhs/<?php echo $dt_mhs['img_profil'];?>" data-fancybox data-caption="Photo">
            <img class="direct-chat-img" src="https://mahasiswa.feb.unismuh.ac.id/assets/upload/profil/mhs/<?php echo $dt_mhs['img_profil'];?>" alt="" style="width: 60px; height: 60px; border-radius: 50%" /></a>
            <?php }?>
          </td>
          <td style="text-align: left;"><?php echo $dt_mhs['nim'];?></td>
          <td style="text-align: left;"><?php echo $dt_mhs['nama_mahasiswa'];?></td>
          <td>
              <button type="button" class="btn btn-danger tbl_reset" data-toggle="modal" data-target="#modal-reset" title="Reset Akun" id="<?php echo $dt_mhs['id'];?>"><i class="fa fa-lock"></i> Reset Akun</button>
          </td>
        </tr>
      <?php $nom++; endforeach ?>
    </tbody>
  </table>
<?php  
}  

else  
{  
    echo 'Data Not Found';  
} 
?>
<!-- FModal Reset-->
<div class="modal modal-primary fade" id="modal-reset" data-backdrop="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Reset Akun</h4>
      </div>
      <div id="frm_modal_reset"></div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
  $(document).ready(function() 
  {
    $(".tabel_list").on("click", ".tbl_edit", function()
    {
      var id_data = this.id;
      $("#frm_modal").load("<?php echo base_url();?>home/edit_akun_mahasiswa/"+id_data);
    });
    $(".tabel_list").on("click", ".tbl_reset", function()
    {
      var id_data = this.id;
      $("#frm_modal_reset").load("<?php echo base_url();?>home/reset_akun_mahasiswa/"+id_data);
    });
  });
</script>